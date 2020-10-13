<?php
/**
 * Class file for Zoom APIs.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Zoom_APIs' ) ) {

	class Zoom_APIs {

		private $token;

		private $current_order;

		private $current_order_id;

		private $user_data;

		public function __construct() {

			// Get access token.
			$this->token = $this->zp_api_get_zoom_token();

			// Rest end points for zoom.
			add_action( 'rest_api_init', array( $this, 'zp_register_api_endpoints' ) );

			// Add registrant on order completed.
			add_action( 'woocommerce_order_status_changed', array( $this, 'zp_woo_order_status_change_custom' ), 10, 3 );
		}

	 	public function zp_register_api_endpoints() {

			// Add registrations on load the content page.
			register_rest_route( 'zoom', '/add-registrant', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'zp_rest_add_registrant' )
			) );

			// Get all details and print, this is for debug and personal uses.
			register_rest_route( 'zoom', '/get-details', array(
				'methods'  => 'GET',
				'callback' => array( $this, 'zp_rest_get_details' )
			) );

		}

		/**
		 * Get all the details of the current user relate to zoom.
		 *
		 * @param WP_REST_Request $request
		 *
		 */
		public function zp_rest_get_details( WP_REST_Request $request ) {

			// Get user details.
			$zoom_secret = $request->get_param( 'key' );
			$user_id = $request->get_param( 'user_id' );

			if( empty( $zoom_secret ) ) {
				die('Please pass zoom_secret to continue.');
			}

			if( ! empty( $user_id ) ) {
				$users = array( (object) array( 'ID' => $user_id ) );
			} else {
				$users = get_users( array( 'fields' => array( 'ID', 'display_name', 'user_email' ) ) );
				echo '<pre>';
				print_r($users);
				die('<br><---died here');
			}

			$Order_Array = []; //
			foreach($users as $user){

				$user_id = $user->ID;

				// Get all customer orders
				$customer_orders = get_posts(array(
					'numberposts' => -1,
					'meta_key' => '_customer_user',
					/*'orderby' => 'date',*/
					'orderby' => 'modified',
					'order' => 'DESC',
					'meta_value' => $user_id,
					'post_type' => wc_get_order_types(),
					'post_status' => array_keys(wc_get_order_statuses())
				));


				$all_metas = get_user_meta( $user_id );
				foreach ( $all_metas as $key => $value ) {
					if( strpos( $key, 'zoom') !== false ) {
						$Order_Array[$user_id]['user_meta'][$key] =  maybe_unserialize( $value[0] );
					}
				}

				foreach ($customer_orders as $customer_order) {
					$orderq = wc_get_order($customer_order);
					$Order_Array[$user_id]['orders'][$orderq->get_id()] = [
						"ID" => $orderq->get_id(),
						"Value" => $orderq->get_total(),
						"Date" => $orderq->get_date_created()->date_i18n('Y-m-d'),
						"Status" => $orderq->get_status(),
					];

					//$this->current_order = new WC_Order( $order_id );
					$this->current_order = $orderq;
					//$Order_Array[$user_id]['orders'][$orderq->get_id()]['details'] = $orderq;
					$Order_Array[$user_id]['orders'][$orderq->get_id()]['meetings'] = $this->zp_get_meeting_ids();

				}
			}


			// Get user meta for zoom.
			echo '<pre>';
			print_r($Order_Array);
			die('<br><---died here');
		}

		/**
		 * Add registrant and return the join link.
		 *
		 * @param WP_REST_Request $request
		 *
		 * @return string join_url.
		 */
		public function zp_rest_add_registrant( WP_REST_Request $request ) {

			// Get user details.
			$user_id = $request->get_param( 'user_id' );
			$this->zp_get_user_details( $user_id );

			$product_ids = $request->get_param( 'product_ids' );
			$zoom_id     = $request->get_param( 'zoom_id' );
			$zoom_type   = $request->get_param( 'zoom_type' );
			$blog_id     = $request->get_param( 'blog_id' );
			$post_id     = $request->get_param( 'post_id' );

			$join_url = $this->zp_api_create_zoom_link( $zoom_id, $zoom_type, $blog_id, $post_id, $product_ids );

			return $join_url;

		}

		public function zp_woo_order_status_change_custom( $order_id, $old_status, $new_status ) {

			$this->current_order_id = $order_id;

			// Add registrant if order is completed.
			if ( 'completed' === $new_status ) {
				$this->zp_api_add_registrant();
			}

			// Remove registrant if order is changed from completed to any other status.
			if ( 'completed' === $old_status ) {
				$this->zp_api_remove_registrant();
			}
		}

		private function zp_api_remove_registrant() {

			// Get user details.
			$user_data = $this->zp_get_user_details();

			// Get meeting ids.
			$meeting_ids = $this->zp_get_meeting_ids();

			foreach ( $meeting_ids as $blog_id => $content_posts ) {

				foreach ( $content_posts as $product_and_post_id => $zoom_id_and_type ) {

					$product_and_post_id = explode( '_', $product_and_post_id );
					$product_id          = $product_and_post_id; // keeping it as array because its required ahead.
					$post_id             = $product_and_post_id[1];

					$zoom_id   = $zoom_id_and_type['id'];
					$zoom_type = strtolower( $zoom_id_and_type['type'] );
					$zoom_type = $zoom_type . 's'; // making it plural for request url.

					/**
					 * Unlink products from user meta and
					 * check if any other purchased product
					 * exist for the same content, if yes,
					 * don't remove the zoom url, only remove
					 * refunded product id, otherwise remove
					 * zoom url from api and meta both.
					 */
					$remaining_purchased_products_for_same_zoom_id = $this->zp_update_usermeta_for_zoom( $blog_id, $post_id, $zoom_id, 'remove', $product_id );

					// If there are no other purchased products for
					// the same content, deny the registration.
					if ( 0 === $remaining_purchased_products_for_same_zoom_id ) {

						// De-Register Zoom Registrant.
						$this->zp_api_update_registrant_status( $zoom_id, $zoom_type, $user_data['email'], $action = 'deny' );
					}

				} // end foreach - blog wise zoom ids.

			} // end foreach - meeting ids main array.
		}

		private function zp_api_add_registrant() {

			// Get user details.
			$user_data = $this->zp_get_user_details();

			// Get meeting ids.
			$meeting_ids = $this->zp_get_meeting_ids();

			// Initialize log of zoom url creation, to avoid re-creation.
			$registered_meetings = array();

			foreach ( $meeting_ids as $blog_id => $content_posts ) {

				foreach ( $content_posts as $product_and_post_id => $zoom_id_and_type ) {

					$product_and_post_id = explode( '_', $product_and_post_id );
					$product_id          = $product_and_post_id[0];
					$post_id             = $product_and_post_id[1];

					$zoom_id   = $zoom_id_and_type['id'];
					$zoom_type = $zoom_id_and_type['type'];

					// Check if zoom link already generated for the given zoom id.
					// If yes, then just add the given product id in user meta.
					$registered_already = $this->zoom_check_registered_already( $zoom_id, $blog_id, $post_id, $product_id );
					if ( 'yes' === $registered_already ) {
						continue;
					}

					// Check if user just registered a seconds ago, i.e. check in the tracking array!
					if ( ! isset( $registered_meetings[ $zoom_id ] ) ) {

						$product_id = array( $product_id ); // array type is required of parameter.
						$this->zp_api_create_zoom_link( $zoom_id, $zoom_type, $blog_id, $post_id, $product_id );

					} else {
						// user already registered in earlier loop for the given zoom id.
					}

				} // end foreach - blog wise zoom ids.

			} // end foreach - meeting ids main array.

			return true;
		}

		private function zp_api_create_zoom_link( $zoom_id, $zoom_type, $blog_id, $post_id, $product_ids ) {

			$user_data           = $this->user_data;
			$zoom_type           = strtolower( $zoom_type );
			$zoom_type           = $zoom_type . 's'; // making it plural for request url.
			$registrants_api_url = "https://api.zoom.us/v2/$zoom_type/$zoom_id/registrants";

			$body = array(
				"email"      => $user_data['email'],
				"first_name" => $user_data['first_name'],
				"last_name"  => $user_data['last_name']
			);

			// Adding registrant.
			$registrant_added = $this->zp_api_call( $registrants_api_url, 'POST', $body );
			//demo result: {"registrant_id":"IFvzWrN4QymRP5HElLt5Nw","id":93597490168,"topic":"NAB Test 002","start_time":"2020-09-30T15:30:00Z"}

			$registrant_body = $registrant_added['body'];

				if ( isset( $registrant_added['response']['code'] ) ) {
					// Approve manually even if join_url is returned.
					// Because in webinar's case, we get join_url
					// even if the manual_approve is ON.
					$this->zp_api_update_registrant_status( $zoom_id, $zoom_type, $user_data['email'], 'approve' );
				} else {
					// Error detected mail sent and error body returned.
					return 'Error: ' . $registrant_body;
				}

				// If meeting is NOT Registration enabled. Join URL will be received asap on registration.
				if ( isset( $registrant_body->join_url ) ) {

					$registered_meetings[ $zoom_id ] = $registrant_body->join_url;

					// Save meeting's unique URL in user meta.
					$this->zp_update_usermeta_for_zoom( $blog_id, $post_id, $zoom_id, 'add', $product_ids, $registrant_body->join_url );

					return $registrant_body->join_url;

				} else {

					// Get join_url by fetching all registrants.
					// Please note, only approved registrants can be fetched.

					// Disabled this so that we can get join url of the
					// approve registrant who was denied earlier!
					// This will also not prevent code on false response.
					//if ( isset( $registrant_added['response']['code'] ) && 201 === $registrant_added['response']['code'] ) {

						$body = array(
							"page_size" => 300 // Maximum 300 allowed. This will fetch number of registrants.
						);

						// Get meeting's unique URL.
						$list_registrants = $this->zp_api_call( $registrants_api_url, 'GET', $body, 'text/html' );

						if ( 200 === $list_registrants['response']['code'] ) {

							$find_registrants = $list_registrants['body']->registrants;

							/**
							 * If token is not empty, it means there
							 * is a next page with list of rest registrants,
							 * So fetch them and merge into existing.
							 */
							$next_page_token = $list_registrants['body']->next_page_token;
							while ( ! empty( $next_page_token ) ) {
								$body['next_page_token'] = $next_page_token;
								$list_registrants        = $this->zp_api_call( $registrants_api_url, 'GET', $body, 'text/html' );

								if ( 200 === $list_registrants['response']['code'] ) {

									$next_page_token = $list_registrants['body']->next_page_token;

									$find_registrants_next_page = $list_registrants['body']->registrants;
									$find_registrants           = array_merge( $find_registrants, $find_registrants_next_page );
								} else {
									// failed api: list next page registrants.
								}
							}

							// Reverse array to find email quickly, because the
							// email is added at the end and response has ascending nature.
							$find_registrants = array_reverse( $find_registrants );

							// Finally search for recent email address and get its unique jon url.
							foreach ( $find_registrants as $registrant ) {

								if ( $user_data['email'] === $registrant->email ) {

									$registered_meetings[ $zoom_id ] = isset( $registrant->join_url ) ? $registrant->join_url : 'not-found-in-api-response';

									// Save meeting's unique URL in user meta.
									$this->zp_update_usermeta_for_zoom( $blog_id, $post_id, $zoom_id, 'add', $product_ids, $registrant->join_url );

									return $registrant->join_url;
									//break; // Stop if found.

								}
							} // end foreach - find registrant email.

						} else {
							// failed api: list registrants.
						}
					/*} else {
						// failed api: add registrant.
					}*/

				} // end if condition - to Approve manually.

		}

		private function zp_api_call( $url, $method = 'POST', $body = '', $content_type = 'application/json; charset=utf-8' ) {

			$args = array(
				'headers' => array(
					'Content-Type'  => $content_type,
					'Authorization' => 'Bearer ' . $this->token
				),
				'method'  => $method
			);

			// Add body argument if not empty.
			if ( ! empty( $body ) ) {
				$args['body']        = 'application/json; charset=utf-8' === $content_type ? json_encode( $body ) : $body;
				$args['data_format'] = 'body';
			}

			if ( 'POST' === $method ) {

				$response = wp_remote_post( $url, $args );

			} else if ( 'GET' === $method ) {

				$response = wp_remote_get( $url, $args );

			} else {

				$response = wp_remote_request( $url, $args );

			}

			if ( is_wp_error( $response ) || ! isset( $response['response']['code'] ) ) {
				$result['body'] = $result['response'] = $response->get_error_message();


				$headers = 'From: ' . 'amplify@no-reply.com' . "\r\n" .
				           'Reply-To: ' . 'faisal.alvi@multidots.com' . "\r\n";

				$body = implode( ' ,', $body );
				$html = $response->get_error_message() . " <= ERROR MESSAGE, and URL = $url, and BODY = $body, and ORDER ID = " . $this->current_order_id;

				wp_mail( 'faisal.alvi@multidots.com', 'Amplify Zoom API Failed', $html, $headers );
			} else {
				$result['body']     = json_decode( $response['body'] );
				$result['response'] = $response['response'];
			}

			return $result;
		}

		private function zoom_check_registered_already( $zoom_id, $blog_id, $post_id, $product_id ) {

			// Set default.
			$registered_already = 'no';

			$user_id = $this->user_data['id'];
			$key     = 'zoom_' . $blog_id;

			// Get user meta for zoom.
			$generated_zoom_urls = maybe_unserialize( get_user_meta( $user_id, $key, true ) );

			if ( isset( $generated_zoom_urls[ $post_id ][ $zoom_id ] ) ) {
				$registered_already = 'yes';

				if ( ! isset( $generated_zoom_urls[ $post_id ][ $zoom_id ]['products'][ $product_id ] ) ) {
					$generated_zoom_urls[ $post_id ][ $zoom_id ]['products'][ $product_id ] = 1;
					update_user_meta( $user_id, $key, $generated_zoom_urls );
				}
			}

			return $registered_already;
		}

		private function zp_update_usermeta_for_zoom( $blog_id, $post_id, $zoom_id, $action = 'add', $product_ids, $meeting_url = '' ) {

			$user_id = $this->user_data['id'];
			$key     = 'zoom_' . $blog_id;

			// Get user meta for zoom.
			$generated_zoom_urls = maybe_unserialize( get_user_meta( $user_id, $key, true ) );

			if ( 'add' === $action ) {

				if ( empty( $generated_zoom_urls ) ) {
					$generated_zoom_urls = array();
				}

				// Setting arrays to prevent notices.
				$generated_zoom_urls[ $post_id ][ $zoom_id ]['url'] = $meeting_url;
				foreach ( $product_ids as $product_id ) {
					$generated_zoom_urls[ $post_id ][ $zoom_id ]['products'][ $product_id ] = 1;
				}

			} else {

				foreach ( $product_ids as $product_id ) {
					if ( isset( $generated_zoom_urls[ $post_id ][ $zoom_id ]['products'][ $product_id ] ) ) {
						unset( $generated_zoom_urls[ $post_id ][ $zoom_id ]['products'][ $product_id ] );

						// Remove meta part completely, if no other products found!
						if ( 0 === count( $generated_zoom_urls[ $post_id ][ $zoom_id ]['products'] ) ) {
							unset( $generated_zoom_urls[ $post_id ] );
						}

					}
				}
			}

			// Update meta.
			if ( 0 < count( $generated_zoom_urls ) ) {
				update_user_meta( $user_id, $key, $generated_zoom_urls );
			} else {
				delete_user_meta( $user_id, $key );
			}

			if ( isset( $generated_zoom_urls[ $post_id ][ $zoom_id ]['products'] ) ) {
				$total_linked_products_for_same_zoom_id = count( $generated_zoom_urls[ $post_id ][ $zoom_id ]['products'] );
			} else {
				$total_linked_products_for_same_zoom_id = 0;
			}

			return $total_linked_products_for_same_zoom_id;
		}

		private function zp_get_user_details( $user_id = 0 ) {

			if ( 0 === $user_id ) {
				$this->current_order = $order = new WC_Order( $this->current_order_id );
				$user_id             = $order->get_user_id();
			}

			$user_data['id'] = $user_id;

			$user_info          = get_userdata( $user_id );
			$user_data['email'] = $user_info->user_email;

			$user_meta               = get_user_meta( $user_id );
			$user_data['first_name'] = isset( $user_meta['first_name'][0] ) && ! empty( $user_meta['first_name'][0] ) ? $user_meta['first_name'][0] : $user_info->display_name;
			$user_data['first_name'] = ! empty( $user_data['first_name'] ) ? $user_data['first_name'] : '-';
			$user_data['last_name']  = isset( $user_meta['last_name'][0] ) && ! empty( $user_meta['last_name'][0] ) ? $user_meta['last_name'][0] : '-';

			$this->user_data = $user_data;

			return $user_data;

		}

		private function zp_api_update_registrant_status( $zoom_id, $zoom_type, $email, $action = 'approve' ) {

			$url  = "https://api.zoom.us/v2/$zoom_type/$zoom_id/registrants/status";
			$body = array(
				"action"      => $action,
				"registrants" => array(
					0 => array(
						'email' => $email
					)
				)
			);

			// Removing registrant.
			return $this->zp_api_call( $url, 'PUT', $body );
		}

		private function zp_get_meeting_ids() {

			$items = $this->current_order->get_items();

			foreach ( $items as $item ) {

				$product_id         = $item->get_product_id();
				$associated_content = maybe_unserialize( get_post_meta( $product_id, '_associated_content', true ) );

				if ( $associated_content ) {
					$meeting_ids = array();
					foreach ( $associated_content as $blog_id => $ac ) {

						// Connect to new multisite
						switch_to_blog( $blog_id );

						foreach ( $ac as $current_post_id => $val ) {

							$zoom_id   = get_post_meta( $current_post_id, 'zoom_id', true );
							$zoom_type = get_post_meta( $current_post_id, 'zoom_type', true );
							if ( ! empty( $zoom_id ) ) {

								$meeting_ids[ $blog_id ][ $product_id . '_' . $current_post_id ]['id']   = $zoom_id;
								$meeting_ids[ $blog_id ][ $product_id . '_' . $current_post_id ]['type'] = $zoom_type[0];

							}
						}
						wp_reset_query();
						// Quit multisite connection
						restore_current_blog();
					}
				}
			}

			return $meeting_ids;
		}

		/**
		 * Get zoom token.
		 */
		private function zp_api_get_zoom_token() {

			return get_option( 'zp_token_key' );

		}

	}

	new Zoom_APIs();
}
