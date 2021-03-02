<?php
/**
 * Bynder Media Ajax Class
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Bynder_Media_Ajax' ) ) {


	class Bynder_Media_Ajax {

		private $url;
		private $args;
		private $bm_domain;
		private $bm_token;
		private $requested_by;
		private $collection_name;
		private $bm_body;
		private $assets_limit = 50;
		private $assets_page = 1;
		private $response;

		// Bynder configured object.
		private $bynder;

		public function __construct() {

			// Init popup.
			add_action( "wp_ajax_bm_init_popup", array( $this, "bm_init_popup" ) );
			add_action( "wp_ajax_nopriv_bm_init_popup", array( $this, "bm_init_popup" ) );

			// Include a Bynder SDK autoload.
			require_once( BYNDER_MEDIA_DIR . 'includes/bynder-php-sdk/vendor/autoload.php' );

			// Configure Bynder Object.
			require_once( BYNDER_MEDIA_DIR . 'includes/partials/bm-sdk-config.php' );

			// Get popup content.
			add_action( "wp_ajax_bm_fetch_assets", array( $this, "bm_fetch_assets" ) );
			add_action( "wp_ajax_nopriv_bm_fetch_assets", array( $this, "bm_fetch_assets" ) );

			// Create a collection.
			add_action( "wp_ajax_bm_create_collection", array( $this, "bm_create_collection" ) );
			add_action( "wp_ajax_nopriv_bm_create_collection", array( $this, "bm_create_collection" ) );

			// Create Meta Options.
			add_action( "wp_ajax_bm_create_meta_options", array( $this, "bm_create_meta_options" ) );
			add_action( "wp_ajax_nopriv_bm_create_meta_options", array( $this, "bm_create_meta_options" ) );

			// Get Metas.
			add_action( "wp_ajax_bm_get_metas", array( $this, "bm_get_metas" ) );
			add_action( "wp_ajax_nopriv_bm_get_metas", array( $this, "bm_get_metas" ) );

			// Upload Asset.
			add_action( "wp_ajax_bm_upload_asset", array( $this, "bm_upload_asset" ) );
			add_action( "wp_ajax_nopriv_bm_upload_asset", array( $this, "bm_upload_asset" ) );

			// Save Asset URL.
			add_action( "wp_ajax_bm_save_asset_url", array( $this, "bm_save_asset_url" ) );
			add_action( "wp_ajax_nopriv_bm_save_asset_url", array( $this, "bm_save_asset_url" ) );
		}

		private function bm_get_meta_ids() {
			return array(
				'UserTypeName' => '62BA8F9E-E03F-4636-8CC1784BAE7C738D'
			);
		}

		public function bm_create_meta_options() {

			$user_type_name = filter_input( INPUT_POST, 'UserTypeName', FILTER_SANITIZE_STRING );

			// Get meta ids.
			$metaids = $this->bm_get_meta_ids();

			if ( $user_type_name ) {

				$bynder_usertypename_meta = get_transient( "bynder_usertypename_meta" );

				if ( $bynder_usertypename_meta ) {
					$return_array = array( "bmHTML" => $bynder_usertypename_meta );

				} else {
					// Get the Bynder key.
					$this->bm_domain          = $this->bm_get_meta( 'bm_domain' );
					$url                      = $this->bm_domain . '/api/v4/metaproperties/' . $metaids['UserTypeName'] . '/options/';
					$user_type_name_validated = str_replace( ' ', '', $user_type_name );
					$data                     = array(
						'name'  => $user_type_name_validated,
						'label' => $user_type_name,
					);
					$args                     = array(
						'data' => json_encode( $data )
					);

					$response = $this->bm_run_api( $url, 'POST', $args, 'application/x-www-form-urlencoded' );

					if ( isset( $response['body']->statuscode ) && ( 201 === $response['body']->statuscode ) || $response['body']->existingUUID ) {

						if ( $response['body']->existingUUID ) {
							$new_option_id = $response['body']->existingUUID;
						} else {
							// Now fetch again to get the created option's id.
							$url      = $this->bm_domain . '/v4/metaproperties/' . $metaids['UserTypeName'] . '/options/?name=' . $user_type_name;
							$response = $this->bm_run_api( $url, 'GET' );

							$new_option_id = '';
							if ( ! isset( $response['body']['message'] ) ) {
								$metaoptions = $response['body'];
								foreach ( $metaoptions as $mop ) {
									if ( $user_type_name === $mop['label'] ) {
										$new_option_id = $mop['id'];
									}
								}
							}
						}
						$return_array = array( "bmHTML" => $new_option_id );

						set_transient( "bynder_usertypename_meta", $new_option_id, 24 * 7 * 60 * 60 );
					} else {
						$return_array = array( "error" => $response );
					}
				}

				echo wp_json_encode( $return_array );
				wp_die();
			}
		}

		public function bm_init_popup() {
			ob_start();
			require_once BYNDER_MEDIA_DIR . 'includes/partials/bm-init-popup.php';
			$html = ob_get_clean();

			echo wp_json_encode( array( "bmInitPop" => $html ) );
			wp_die();
		}

		public function bm_save_asset_url() {
			$url          = filter_input( INPUT_POST, 'url', FILTER_SANITIZE_STRING );
			$requested_by = filter_input( INPUT_POST, 'requestedBy', FILTER_SANITIZE_STRING );
			$postid       = filter_input( INPUT_POST, 'postid', FILTER_VALIDATE_INT );
			$page_type       = filter_input( INPUT_POST, 'pageType', FILTER_SANITIZE_STRING );

			$requested_for_user = array( 'banner_image', 'profile_picture' );
 			if ( in_array( $requested_by, $requested_for_user, true ) && 'user' === $page_type ) {
				$postid = get_current_user_id();
				update_user_meta( $postid, $requested_by, $url );
			} else {
				update_post_meta( $postid, $requested_by, $url );
			}


		}

		public function bm_upload_asset() {

			//ne_test
			$test = 0;
			if ( 1 === $test ) {
				$uploaded_mediaid = 'DCC3B3A7-6A5E-4D9B-BEEDBDD56601F682';
			}

			$this->bm_domain = $this->bm_get_meta( 'bm_domain' );

			if ( 1 !== $test ) {

				$this->args['collectionID'] = filter_input( INPUT_POST, 'collectionID', FILTER_SANITIZE_STRING );
				$this->requested_by         = filter_input( INPUT_POST, 'requestedBy', FILTER_SANITIZE_STRING );

				$metas       = filter_input( INPUT_POST, 'formFields', FILTER_SANITIZE_STRING );
				$metas_array = $this->args['metas'] = array();
				parse_str( $metas, $metas_array );
				$this->args['metas'] = $metas_array['metas'];
			}

			// Pass a file.
			if ( $_FILES['croppedImage'] || 1 === $test ) {

				if ( 1 !== $test ) {

					// Upload to WordPress.
					// These files need to be included as dependencies when on the front end.
					require_once( ABSPATH . 'wp-admin/includes/image.php' );
					require_once( ABSPATH . 'wp-admin/includes/file.php' );
					require_once( ABSPATH . 'wp-admin/includes/media.php' );


					// Let WordPress handle the upload.
					$attachment_id = media_handle_upload( 'croppedImage', 0 );

					// Get uploaded URL.
					$this->args['image_url'] = wp_get_original_image_path( $attachment_id );

					// Set name to upload.
					$this->args['image_name'] = $_FILES["croppedImage"]['name'];

					echo '<pre>';
					print_r(get_defined_vars());
					print_r($this);
					die('<br><---died here');

					// Init upload.
					require_once( BYNDER_MEDIA_DIR . 'includes/partials/bm-sdk-upload-asset.php' );
				}

				if ( 1 === $test ) {
					$this->response['success']  = true;
					$this->args['collectionID'] = true;
				}

				if ( true === $this->response['success'] ) {

					// Add asset to a collection.
					if ( $this->args['collectionID'] ) {

						if ( 1 !== $test ) {
							$uploaded_mediaid = $this->response['mediaid'];

							$url = $this->bm_domain . '/api/v4/collections/' . $this->args['collectionID'] . '/media/';

							$args = array(
								'data' => json_encode( array( $uploaded_mediaid ) )
							);

							$this->bm_run_api( $url, 'POST', $args, 'application/x-www-form-urlencoded' );
						}

					}

					$return_array = array( "bmHTML" => 'success' );

					// Delete transient to fetch the fresh data.
					$this->bm_remove_cache();

				} else {
					$return_array = array( "error" => $this->response );
				}
				echo wp_json_encode( $return_array );
				wp_die();
			}
		}

		private function bm_remove_cache() {
			return true;
		}

		public function bm_get_metas() {

			//$bm_metas = get_transient( "bynder_metas" );


			//if ( ! $bm_metas ) {


			$return_array = array();

			// Fetch Assets Now!
			require_once( BYNDER_MEDIA_DIR . 'includes/partials/bm-sdk-fetch-metas.php' );

			// If 'media' received, the call was successful!


			// ne_pending ; change the condition to corerct once acc to the respnse
			if ( is_array( $this->response ) && 0 !== count( $this->response ) ) {

				$this->bm_body = $this->response;
				$bm_metas      = $this->bm_get_partial_metas();

				// set data in transient.
				//set_transient( "bynder_metas", $bm_metas, 60 * 60 * 24 );

				$return_array = array( "bmHTML" => $bm_metas );
			} else {
				$return_array = array( "error" => $this->response );
			}


			/*} else {
				$return_array = array( "bmHTML" => $bm_metas );
			}*/


			echo wp_json_encode( $return_array );
			wp_die();
		}

		public function bm_fetch_assets() {



			// getCollections($query);
			// getCollectionAssets($collectionId);


			$this->requested_by    = filter_input( INPUT_POST, 'requestedBy', FILTER_SANITIZE_STRING );
			$this->collection_name = filter_input( INPUT_POST, 'collectionName', FILTER_SANITIZE_STRING );
			$this->collection_id   = filter_input( INPUT_POST, 'collectionID', FILTER_SANITIZE_STRING );
			$this->assets_page     = filter_input( INPUT_POST, 'assetsPage', FILTER_SANITIZE_NUMBER_INT );
			$this->is_admin     = filter_input( INPUT_POST, 'isAdmin', FILTER_VALIDATE_BOOLEAN );

			// Prepare required data.
			$this->url  = $this->bm_domain . '/api/v4/media/';
			$this->args = array(
				'includeMediaItems' => 1,
				'limit'             => 50,
			);

			// init.
			$bm_col_id    = '';
			$return_array = array();

			// If collection name found, check if its available at Bynder or not.
			if ( $this->collection_name ) {

				// Try to get data from transient.
				//$bm_popup = get_transient( 'bynder_col_' . $this->collection_name . '_' . $this->requested_by . '_page_' . $this->assets_page );

				//if ( ! $bm_popup ) {
				$bm_col_id = $this->bm_get_collection_id();

				// Ajax Exit on error or not found.
				// Ajax continue if collection ID found.
				if ( $bm_col_id ) {
					$this->args['collectionId'] = $bm_col_id;
				}
				/*} else {

					// Return from collection transient.
					$return_array = array( "bmHTML" => $bm_popup );
				}*/

			} else if ( $this->collection_id ) {
				$this->args['collectionId'] = $this->collection_id;

				// If not collection wise.
				// Check if data available in transient.
				/*$bm_popup = get_transient( "bynder_" . $this->requested_by . '_page_' . $this->assets_page );
				if ( $bm_popup ) {
					$return_array = array( "bmHTML" => $bm_popup );
				}*/
			}

			// If not found from transient, call API.
			if ( 0 === count( $return_array ) ) {

				// Fetch Assets Now!
				require_once( BYNDER_MEDIA_DIR . 'includes/partials/bm-sdk-fetch-assets.php' );

				// If 'media' received, the call was successful!
				if ( isset( $this->response['media'] ) ) {

					$this->bm_body = $this->response['media'];
					$bm_popup      = $this->bm_get_partial_popup();

					// Add collection ID in the transient to
					// fetch specific assets quickly next time.
					$transient_key = ! empty( $this->collection_name ) ? 'col_' . $this->collection_name . '_' . $this->requested_by . '_page_' . $this->assets_page : $this->requested_by . '_page_' . $this->assets_page;

					// set data in transient.
					//set_transient( "bynder_" . $transient_key, $bm_popup, 60 * 60 * 24 );

					$return_array = array( "bmHTML" => $bm_popup );

					// Send back total count to hide load more btn if required.
					if ( $this->assets_limit > $this->response['total']['count'] ) {
						$return_array['hideLoadMore'] = 1;
					}

					// Return collection ID to save in body attribute
					// and later use it to upload assets.
					if ( ! empty( $bm_col_id ) ) {
						$return_array['bmCollectionID'] = $bm_col_id;
					}
				} else {
					$return_array = array( "error" => $this->response );
				}
			}

			// Return the current page number
			// to increase it in the next call.
			$return_array['assetsPage'] = $this->assets_page;

			echo wp_json_encode( $return_array );
			wp_die();
		}

		private function bm_get_collection_id() {

			$collection_name = $this->collection_name;
			$url             = $this->bm_domain . '/api/v4/collections/';
			$args            = array(
				'keyword' => $collection_name,
				'limit'   => 10,
			);

			$response = $this->bm_run_api( $url, 'GET', $args );

			if ( 200 === $response['status'] ) {

				$collections = $response['body'];

				foreach ( $collections as $col ) {
					if ( $collection_name === $col->name ) {
						return $col->id;
					}
				}

				// Collection does not exist. Exit and ask to create one.
				$return_array = array( "bmCollectionNotFound" => 1 );

			} else {
				$return_array = array( "error" => $response['body']->error );
			}

			// Exit Ajax.
			echo wp_json_encode( $return_array );
			wp_die();

		}

		// Create collection if not available.
		public function bm_create_collection() {

			$collection_name = filter_input( INPUT_POST, 'collectionName', FILTER_SANITIZE_STRING );

			// Get the Bynder key.
			$this->bm_domain = $this->bm_get_meta( 'bm_domain' );
			$url             = $this->bm_domain . '/api/v4/collections/';
			$args            = array(
				'name' => $collection_name
			);

			$response = $this->bm_run_api( $url, 'POST', $args, 'application/x-www-form-urlencoded' );

			if ( 201 === $response['status'] ) {
				$return_array = array( "bmColCreated" => 1 );
			} else {
				$return_array = array( "error" => $response['body']->error );
			}

			echo wp_json_encode( $return_array );
			wp_die();
		}

		public function bm_get_partial_metas() {
			ob_start();
			require_once BYNDER_MEDIA_DIR . 'includes/partials/bm-metas-template.php';

			return ob_get_clean();
		}

		public function bm_get_partial_popup() {
			ob_start();
			require_once BYNDER_MEDIA_DIR . 'includes/partials/bm-popup-template.php';

			return ob_get_clean();
		}

		private function bm_run_api( $url, $method = 'POST', $args = array(), $content_type = 'application/json; charset=UTF-8' ) {

			// Add https if not available.
			if ( strpos( $url, 'http' ) === false ) {
				$url = 'https://' . $url;
			}

			if ( $this->bm_token ) {
				$bm_token = $this->bm_get_meta( 'bm_token' );
			}

			// Throw error if token not set.
			if ( ! $bm_token || '' === $bm_token ) {
				echo wp_json_encode( array( "error" => 'Please enter token on settings page.' ) );
				wp_die();
			}

			$authorization = "Bearer $bm_token";

			$headers = array(
				'Authorization' => $authorization,
				'Content-Type'  => $content_type,
			);

			// Remove authorization check.
			$remove_if_found = array( 'amazonaws.com' );
			foreach ( $remove_if_found as $item ) {
				if ( strpos( $url, $item ) !== false ) {
					unset( $headers['Authorization'] );
					break;
				}
			}

			$request = array(
				'headers' => $headers,
				'method'  => $method,
			);


			if ( 'GET' === $method && ! empty( $args ) && is_array( $args ) ) {
				$url = add_query_arg( $args, $url );

				//An Actual Call
				//$response = vip_safe_wp_remote_get( $url, false, 10, 5, 20, $request );
				$response = wp_remote_get( $url, $request );
			} else {

				$request['body'] = $args;
				$response        = wp_remote_post( $url, $request );
			}

			if ( isset ( $response->errors ) ) {
				$response_status = 404;
				$response_body   = $response_message = (object) array( 'error' => $response->errors['http_request_failed'][0] );
			} else {
				//Response Body
				$response_body = json_decode( $response['body'] );

				//Response Code ( 200 - OK / 401 - Unauthorized / 500 - General Error / etc. )
				$response_status = isset( $response['response']['code'] ) ? $response['response']['code'] : '';
			}

			//Merge Body and Status Code of the Response.
			return array_merge( array( 'body' => $response_body ), array( 'status' => $response_status ) );
		}

		public function bm_get_meta( $key ) {
			return get_option( $key, true );
		}


	}

	new Bynder_Media_Ajax();
}
