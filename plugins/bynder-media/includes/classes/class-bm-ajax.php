<?php
/**
 * Bynder Media Ajax Class
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Bynder_Media_Ajax' ) ) {


	class Bynder_Media_Ajax {

		private $bm_body;
		private $requested_by;

		public function __construct() {

			// Init popup.
			add_action( "wp_ajax_bm_init_popup", array( $this, "bm_init_popup" ) );
			add_action( "wp_ajax_nopriv_bm_init_popup", array( $this, "bm_init_popup" ) );

			// Get popup content.
			add_action( "wp_ajax_bm_fetch_assets", array( $this, "bm_fetch_assets" ) );
			add_action( "wp_ajax_nopriv_bm_fetch_assets", array( $this, "bm_fetch_assets" ) );
		}

		public function bm_init_popup() {
			ob_start();
			require_once BYNDER_MEDIA_DIR . '/includes/partials/bm-init-popup.php';
			$html = ob_get_clean();

			echo wp_json_encode( array( "bmInitPop" => $html ) );
			wp_die();
		}

		public function bm_fetch_assets() {

			$this->requested_by = filter_input( INPUT_POST, 'requestedBy', FILTER_SANITIZE_STRING );

			// Check if data available in transient.
			$bm_popup = get_transient( "bynder_" . $this->requested_by );

			if( ! $bm_popup ) {
				// Get the Bynder key.
				$bm_domain = $this->bm_get_meta( 'bm_domain' );

				$url      = $bm_domain . '/api/v4/media/';
				$args     = array(
					'includeMediaItems' => 1,
					'limit' => 50,
				);
				$response = $this->bm_run_api( $url, 'GET', $args );

				if( 200 === $response['status'] ) {

					$this->bm_body = $response['body'];
					$bm_popup = $this->bm_get_partial_popup();

					// set data in transient.
					set_transient( "bynder_" . $this->requested_by, $bm_popup, 60 * 60 );

					$return_array = array( "bmHTML" => $bm_popup );
				} else {
					$return_array = array( "error" => $response['body']->error );
				}

			} else {
				$return_array = array( "bmHTML" => $bm_popup );
			}

			echo wp_json_encode( $return_array );
			wp_die();

		}

		public function bm_get_partial_popup() {
			ob_start();
			require_once BYNDER_MEDIA_DIR . '/includes/partials/bm-popup-template.php';
			return ob_get_clean();
		}

		private function bm_run_api( $url, $method = 'POST', $args = array() ) {

			$bm_token      = $this->bm_get_meta( 'bm_token' );

			// Throw error if token not set.
			if( ! $bm_token || '' === $bm_token  ) {
				echo wp_json_encode( array( "error" => 'Please enter token on settings page.' ) );
				wp_die();
			}

			$authorization = "Bearer $bm_token";

			$headers = array(
				'Authorization' => $authorization,
				'Accept'        => 'application/json;ver=1.0',
				'Content-Type'  => 'application/json; charset=UTF-8',
			);
			$request = array(
				'headers' => $headers,
				'method'  => $method,
			);

			if ( 'GET' === $method && ! empty( $args ) && is_array( $args ) ) {
				$url = add_query_arg( $args, $url );
			} else {
				$request['body'] = wp_json_encode( $args );
			}

			//An Actual Call
			//$response = vip_safe_wp_remote_get( $url, false, 10, 5, 20, $request );
			$response = wp_remote_get( $url, $request );

			if ( isset ( $response->errors ) ) {
				$response_status = 404;
				$response_body           = $response_message = (object) array( 'error' => $response->errors['http_request_failed'][0] );
			} else {
				//Response Body
				$response_body = json_decode( $response['body'] );

				//Response Code ( 200 - OK / 401 - Unauthorized / 500 - General Error / etc. )
				$response_status = $response['response']['code'];
			}

			//Merge Body and Status Code of the Response.
			return array_merge( array( 'body' => $response_body ), array( 'status' => $response_status ) );


			/* Will result in $api_response being an array of data,
			parsed from the JSON response of the API listed above */
			//$api_response = json_decode( wp_remote_retrieve_body( $response ), true );
		}

		public function bm_get_meta( $key ) {
			return get_option( $key, true );
		}


	}
	new Bynder_Media_Ajax();
}
