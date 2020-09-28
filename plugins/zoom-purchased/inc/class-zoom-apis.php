<?php
/**
 * Class file for Zoom APIs.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! class_exists('Zoom_APIs') ) {

    class Zoom_APIs {

        private $token;

        private $current_order;

        private $current_order_id;

        private $user_data;

        public function __construct() {

            // Get access token.
            $this->token = $this->zp_api_get_zoom_token();

            // Add registrant on order completed.
            //add_action('woocommerce_order_status_changed', array( $this, 'zp_woo_order_status_change_custom'), 999, 5);
            add_action('woocommerce_order_status_changed', array( $this, 'zp_woo_order_status_change_custom'), 10, 3);

        }

        public function zp_woo_order_status_change_custom( $order_id, $old_status, $new_status ) {

            $this->current_order_id = $order_id;

        	// Add registrant if order is completed.
		    if( 'completed' === $new_status ) {
			    $this->zp_api_add_registrant();
		    }

        	// Remove registrant if order is changed from completed to any other status.
		    if( 'completed' === $old_status ) {
			    $this->zp_api_remove_registrant();
		    }

	    }

	    private function zp_api_remove_registrant() {

            // Get user details.
            $user_data = $this->zp_get_user_details();

            // Get meeting ids.
            $meeting_ids = $this->zp_get_meeting_ids();

            foreach ( $meeting_ids as $blog_id => $content_posts ) {

                foreach ( $content_posts as $product_and_post_id => $zoom_id ) {

                    $product_and_post_id    = explode('_', $product_and_post_id);
                    $product_id             = $product_and_post_id[0];
                    $post_id                = $product_and_post_id[1];

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
                    if( 0 === $remaining_purchased_products_for_same_zoom_id ) {

                        // De-Register Zoom Registrant.
                        $this->zp_api_update_registrant_status( $zoom_id, $user_data['email'], $action = 'deny');
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

			    foreach ( $content_posts as $product_and_post_id => $zoom_id ) {

                    $product_and_post_id    = explode('_', $product_and_post_id);
                    $product_id             = $product_and_post_id[0];
                    $post_id                = $product_and_post_id[1];

                    // Check if zoom link already generated for the given zoom id.
                    // If yes, then just add the given product id in user meta.
                    $registered_already = $this->zoom_check_registered_already( $zoom_id, $blog_id, $post_id, $product_id );





                    return;




                    echo "001";
                    if ( 'yes' === $registered_already ) {
                        echo "002-continued";
                        continue;
                    }
                    echo "003";
                    //die();
			        // Check if user just registered a seconds ago, i.e. check in the tracking array!
                    if( ! isset( $registered_meetings[ $zoom_id ] ) ) {

                        $registrants_api_url = "https://api.zoom.us/v2/meetings/$zoom_id/registrants";

                        $body = array(
                            "email" => $user_data['email'],
                            "first_name" => $user_data['first_name'],
                            "last_name" => $user_data['last_name']
                        );

                        // Adding registrant.
                        $registrant_added = $this->zp_api_call( $registrants_api_url, 'POST', $body );
                        //demo result: {"registrant_id":"IFvzWrN4QymRP5HElLt5Nw","id":93597490168,"topic":"NAB Test 002","start_time":"2020-09-30T15:30:00Z"}

                        $registrant_body = $registrant_added['body'];

                        // If meeting is NOT Registration enabled. Join URL will be received asap on registration.
                        if( isset( $registrant_body->join_url ) ) {

                            // Save meeting's unique URL in user meta.
                            $this->zp_update_usermeta_for_zoom($blog_id, $post_id, $zoom_id, 'add', $product_id, $registrant_body->join_url);

                        } else {

                            // Approve manually.
                            $this->zp_api_update_registrant_status( $zoom_id, $user_data['email'], 'approve' );

                            // If approved successfully, get join_url by fetching all registrants.
                            // Please note, only approved registrants can be fetched.
                            if( 201 === $registrant_added['response']['code'] ) {

                                $body = array(
                                    "page_size" => 300 // Maximum 300 allowed. This will fetch number of registrants.
                                );

                                // Get meeting's unique URL.
                                $list_registrants = $this->zp_api_call( $registrants_api_url, 'GET', $body, 'text/html' );

                                if( 200 === $list_registrants['response']['code'] ) {


                                    $find_registrants = $list_registrants['body']->registrants;

                                    /**
                                     * If token is not empty, it means there
                                     * is a next page with list of rest registrants,
                                     * So fetch them and merge into existing.
                                     */
                                    $next_page_token = $list_registrants['body']->next_page_token;
                                    while ( ! empty( $next_page_token ) ) {
                                        $body['next_page_token'] = $next_page_token;
                                        $list_registrants = $this->zp_api_call( $registrants_api_url, 'GET', $body, 'text/html' );

                                        if( 200 === $list_registrants['response']['code'] ) {

                                            $next_page_token = $list_registrants['body']->next_page_token;

                                            $find_registrants_next_page = $list_registrants['body']->registrants;
                                            $find_registrants = array_merge($find_registrants, $find_registrants_next_page);
                                        } else {
                                            // failed api: list next page registrants.
                                        }
                                    }

                                    // Finally search for recent email address and get its unique jon url.
                                    foreach( $find_registrants as $registrant ) {

                                        if( $user_data['email'] === $registrant->email ){

                                            $registered_meetings[$zoom_id] = $registrant->join_url;

                                            // Save meeting's unique URL in user meta.
                                            $this->zp_update_usermeta_for_zoom( $blog_id, $post_id, $zoom_id, 'add', $product_id, $registrant->join_url );

                                            break; // Stop if found.

                                        }
                                    } // end foreach - find registrant email.

                                } else {
                                    // failed api: list registrants.
                                }

                            } else {
                                // failed api: add registrant.
                            }

                        } // end if condition - to Approve manually.

                    } else {
                        // user already registered in earlier loop for the given zoom id.
                    }

		    	} // end foreach - blog wise zoom ids.

		    } // end foreach - meeting ids main array.

            return true;

	    }

	    private function zp_api_call( $url, $method = 'POST', $body = '', $content_type = 'application/json; charset=utf-8' ) {

            $args = array(
                'headers'     => array(
                    'Content-Type' => $content_type,
                    'Authorization' => 'Bearer ' . $this->token
                ),
                'method'      => $method
            );

            // Add body argument if not empty.
            if( ! empty( $body ) ) {
                $args['body'] = 'application/json; charset=utf-8' === $content_type ? json_encode( $body ) : $body;
                $args['data_format'] = 'body';
            }

            if( 'POST' === $method ) {

                $response = wp_remote_post( $url, $args );

            } else if( 'GET' === $method ) {

                $response = wp_remote_get( $url, $args );

            } else {

                $response = wp_remote_request( $url, $args );

            }

            if( is_wp_error( $response ) ) {
                $result['body'] = $result['response'] = $response->get_error_message();









                $headers = 'From: '. 'amplify@no-reply.com' . "\r\n" .
                    'Reply-To: ' . 'faisal.alvi@multidots.com' . "\r\n";

                $html = $response->get_error_message() . " <= ERROR MESSAGE, and URL = $url, and BODY = $body, and ORDER ID = ". $this->current_order_id ;

                wp_mail( 'faisal.alvi@multidots.com', 'Amplify Zoom API Failed', $html, $headers);
            } else {
                $result['body'] = json_decode( $response['body'] );
                $result['response'] = $response['response'];
            }

            return $result;
        }

	    private function zoom_check_registered_already( $zoom_id, $blog_id, $post_id, $product_id ) {

            // Set default.
            $registered_already = 'no';

            $user_id = $this->user_data['id'];
            $key = 'zoom_' . $blog_id;

            // Get user meta for zoom.
            $generated_zoom_urls = maybe_unserialize( get_user_meta( $user_id, $key, true ) );

            if( isset( $generated_zoom_urls[$post_id][$zoom_id] ) ) {
                $registered_already = 'yes';

                if( ! isset( $generated_zoom_urls[$post_id][$zoom_id]['products'][$product_id] ) ) {
                    $generated_zoom_urls[ $post_id ][ $zoom_id ]['products'][$product_id] = 1;
                    update_user_meta( $user_id, $key, $generated_zoom_urls);
                }
            }

            return $registered_already;
        }

        private function zp_update_usermeta_for_zoom( $blog_id, $post_id, $zoom_id, $action = 'add', $product_id, $meeting_url = '' ) {

            $user_id = $this->user_data['id'];
            $key = 'zoom_' . $blog_id;

            // Get user meta for zoom.
            $generated_zoom_urls = maybe_unserialize( get_user_meta( $user_id, $key, true ) );

            if( 'add' === $action ) {

                if( empty( $generated_zoom_urls )) {
                    $generated_zoom_urls = array();
                }

                // Setting arrays to prevent notices.
                $generated_zoom_urls[$post_id][$zoom_id]['url'] = $meeting_url;
                $generated_zoom_urls[$post_id][$zoom_id]['products'][$product_id] = 1;

            } else {

                if( isset( $generated_zoom_urls[$post_id][$zoom_id]['products'][$product_id] ) ) {
                    unset( $generated_zoom_urls[$post_id][$zoom_id]['products'][$product_id] );

                    // Remove meta part completely, if no other products found!
                    if( 0 === count( $generated_zoom_urls[$post_id][$zoom_id]['products'] ) ) {
                        unset( $generated_zoom_urls[$post_id] );
                    }

                }
            }

            // Update meta.
            if( 0 < count( $generated_zoom_urls ) ) {
                update_user_meta( $user_id, $key, $generated_zoom_urls);
            } else {
                delete_user_meta( $user_id, $key );
            }

            if( isset( $generated_zoom_urls[$post_id][$zoom_id]['products'] ) ) {
                $total_linked_products_for_same_zoom_id = count( $generated_zoom_urls[$post_id][$zoom_id]['products'] );
            } else {
                $total_linked_products_for_same_zoom_id = 0;
            }

            return $total_linked_products_for_same_zoom_id;
        }

	    private function zp_get_user_details() {

            $this->current_order = $order = new WC_Order($this->current_order_id);
            //$order       = wc_get_order( $this->current_order_id );

            $user_id = $order->get_user_id();
            $user_data['id'] = $user_id;

            $user_info = get_userdata($user_id);
            $user_data['email'] = $user_info->user_email;

            $user_meta = get_user_meta($user_id);
            $user_data['first_name'] = $user_meta['first_name'][0];
            $user_data['last_name'] = $user_meta['last_name'][0];

            $this->user_data = $user_data;

            return $user_data;
        }

        private function zp_api_update_registrant_status( $zoom_id, $email, $action = 'approve') {

            $url = "https://api.zoom.us/v2/meetings/$zoom_id/registrants/status";
            $body = array(
                "action" => $action,
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

			    $product_id = $item->get_product_id();
			    $associated_content = maybe_unserialize( get_post_meta( $product_id, '_associated_content', true ) );

			    if( $associated_content ) {
				    $meeting_ids = array();
				    foreach ( $associated_content as $blog_id => $ac ) {

					    // Connect to new multisite
					    switch_to_blog( $blog_id );

					    foreach ( $ac as $current_post_id => $val ) {
                            $zoom_id = get_post_meta( $current_post_id, 'zoom_id', true );
                            if( $zoom_id ) {
                                $meeting_ids[$blog_id][$product_id . '_' .$current_post_id ] = get_post_meta( $current_post_id, 'zoom_id', true );
                            }
				        }
			        }

                    wp_reset_query();
                    // Quit multisite connection
                    restore_current_blog();
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

    } new Zoom_APIs();
}
