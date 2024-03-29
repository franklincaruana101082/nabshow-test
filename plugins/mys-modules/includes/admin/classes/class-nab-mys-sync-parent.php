<?php
/**
 * Endpoints Class
 *
 * @package MYS Modules
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'NAB_MYS_Sync_Parent' ) ) {

	/**
	 * Class NAB_MYS_Sync_Parent
	 */
	class NAB_MYS_Sync_Parent {

		protected $flow;

		protected $requested_for;

		protected $previous_date = null;

		protected $custom_from_date = null;

		protected $custom_to_date = null;

		protected $current_request;

		protected $past_request;

		protected $current_request_text;

		protected $mys_request_url;

		protected $show_code;

		protected $nab_mys_urls;

		protected $history_id;

		protected $group_id;

		protected $data_array;

		protected $data_json;

		protected $finished_counts;

		protected $total_counts;

		/**
		 * Class Constructor
		 */
		public function __construct() {

			//Set required variable values
			$this->nab_mys_set_values();

		}

		/**
		 * Set required values.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_set_values() {

			//Get MYS URLs added in backend.
			$this->nab_mys_urls = get_option( 'nab_mys_urls' );

			$this->show_code = isset ( $this->nab_mys_urls['show_code'] ) ? $this->nab_mys_urls['show_code'] : '';

		}

		/**
		 * Set Data in variables before Syncing.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_set_ajax_data() {

			$this->requested_for   = filter_input( INPUT_POST, 'requested_for', FILTER_SANITIZE_STRING );
			$this->group_id        = isset( $this->group_id ) ? $this->group_id : filter_input( INPUT_POST, 'group_id', FILTER_SANITIZE_STRING );
			$this->past_request    = isset( $this->past_request ) ? $this->past_request : filter_input( INPUT_POST, 'past_request', FILTER_SANITIZE_STRING );
			$this->total_counts    = (int) filter_input( INPUT_POST, 'total_counts', FILTER_SANITIZE_STRING );
			$this->finished_counts = (int) filter_input( INPUT_POST, 'finished_counts', FILTER_SANITIZE_NUMBER_INT );
			$this->custom_from_date  = filter_input( INPUT_POST, 'custom_from_date', FILTER_SANITIZE_STRING );
			$this->custom_to_date  = filter_input( INPUT_POST, 'custom_to_date', FILTER_SANITIZE_STRING );

			if ( isset( $this->requested_for ) ) {

				check_ajax_referer( 'mys-ajax-nonce', 'security' );

				$this->flow = 'wpajax';

			} else {

				$this->flow = 'restapi';

			}

		}

		/**
		 * Get response from MYS API.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_get_response() {

			//Get Token from Cache, If not available, Generate New and Store in the Cache.
			$nab_mys_token_data = $this->nab_mys_api_token_from_cache();

			//If Cached token expired and New token generation failed, throw error.
			if ( 200 !== $nab_mys_token_data['token_status_code'] ) {

				$error_message = "Error " . $nab_mys_token_data['token_status_code'] . ": " . $nab_mys_token_data['token_response'];

				//Create a HTML Paragraph for Message to display via Ajax
				$error_message_html = "<p class='red-notice mys-error-notice'>$error_message</p>";

				if ( "wpajax" === $this->flow ) {

					echo wp_json_encode( array( "apiError" => $error_message_html ) );
					wp_die();
				} else {
					//CRON
					esc_html_e( $error_message );
					die();
				}

			} else {
				$nab_mys_token_response = $nab_mys_token_data['token_response'];

				//Authorization string for the API Call.
				$authorization = "Bearer " . $nab_mys_token_response;

				//Attempt to Fetch Data from MYS
				$mys_response = $this->nab_mys_api_call( $this->mys_request_url, $authorization );

				$mys_response_body = $mys_response['body'];

				$mys_response_status = $mys_response['status'];

				if ( 200 === $mys_response_status['code'] ) {

					/**
					 * Attempt Success - Response Data Received.
					 * Insert the Response data in Database.
					 */

					$this->data_array = $mys_response_body;
					$this->data_json  = wp_json_encode( $mys_response_body );

					return $mys_response_body;

				} else {
					//Attempt Failed - Response Data NOT Received.

					$mys_response_message = isset ( $mys_response_status['message']->error ) ? $mys_response_status['message']->error : $mys_response_status['message'];
					$mys_response_message = isset ( $mys_response_message ) ? $mys_response_message : "Something went wrong.";

					$error_message = "Error " . $mys_response_status['code'] . ": " . $mys_response_message . ' (Click PULL button again to continue.)';

					//Create a HTML Paragraph for Message to display via Ajax
					$error_message_html = "<p class='red-notice mys-error-notice'>$error_message</p>";

					if ( "wpajax" === $this->flow ) {

						echo wp_json_encode( array( "apiError" => $error_message_html ) );
						wp_die();
					} else {
						//CRON
						esc_html_e( $error_message );
						die();
					}

				}
			}
		}

		/**
		 * Call MYS API
		 *
		 * @param string $mys_request_url MYS API Request URL
		 * @param string $authorization Authorization string to pass in MYS API Request.
		 *
		 * @return array|mixed|object  Response Body from MYS API
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		public function nab_mys_api_call( $mys_request_url, $authorization ) {

			$args    = array( 'showCode' => $this->show_code );
			$method  = 'GET';
			$headers = array(
				'Authorization' => $authorization,
				'Accept'        => 'application/json;ver=1.0',
				'Content-Type'  => 'application/json; charset=UTF-8',
				'Host'          => 'api.mapyourshow.com'
			);
			$request = array(
				'headers' => $headers,
				'method'  => $method,
			);

			if ( 'GET' === $method && ! empty( $args ) && is_array( $args ) ) {
				$mys_request_url = add_query_arg( $args, $mys_request_url );
			} else {
				$request['body'] = wp_json_encode( $args );
			}
			
			//An Actual Call
			$mys_response = vip_safe_wp_remote_get( $mys_request_url, false, 10, 5, 20, $request );

			if ( isset ( $mys_response->errors ) ) {

				$mys_response_status = $mys_response_body = array();

				$mys_response_status['code'] = 404;

				$mys_response_message = (object) array( 'error' => $mys_response->errors['http_request_failed'][0] );

				$mys_response_body[] = $mys_response_status['message'] = $mys_response_message;

			} else {
				//This part can also have error response in body array.

				//Response Body
				$mys_response_body = json_decode( $mys_response['body'] );

				//Response Code ( 200 - OK / 401 - Unauthorized / 500 - General Error / etc. )
				$mys_response_status = $mys_response['response'];
			}

			//Merge Body and Status Code of the Response.
			$mys_response_merged = array_merge( array( 'body' => $mys_response_body ), array( 'status' => $mys_response_status ) );

			return $mys_response_merged;
		}

		/**
		 * Generate MYS API Token
		 *
		 * @return string API Token
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_api_token_from_cache() {

			$nab_mys_token = get_transient( 'nab_mys_token' );

			if ( false === $nab_mys_token ) {
				//If Cachced Token expired, Generate a New Token.
				$nab_mys_token_data = $this->nab_mys_api_token_generation();

			} else {
				//Return Token from Cache.
				$nab_mys_token_data = array( 'token_response' => $nab_mys_token, 'token_status_code' => 200 );
			}

			return $nab_mys_token_data;
		}

		/**
		 * Generate MYS API Token
		 *
		 * @return false|array False or a Token Data.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		private function nab_mys_api_token_generation() {

			//Get MYS API Request URL
			$mys_request_url = isset ( $this->nab_mys_urls['main_url'] ) ? $this->nab_mys_urls['main_url'] . '/Authorize' : '';

			//Stop the flow if Main URL is empty.
			if ( empty( $mys_request_url ) ) {
				return false;
			}

			$mys_username = get_option( 'nab_mys_credentials_u' );
			$mys_password = get_option( 'nab_mys_credentials_p' );

			//Authorization string for the API Call.
			$authorization = "Basic " . base64_encode( "$mys_username:$mys_password" );

			//Call MYS API for New Token
			$mys_response = $this->nab_mys_api_call( $mys_request_url, $authorization );

			$mys_response_body = $mys_response['body'];

			$mys_response_status = $mys_response['status'];

			$token_status_code = $mys_response_status['code'];

			/**
			 * If New Token Generated Successfully, Store Token itself in 'token_response'
			 * If New Token Generation Failed, Store Error Message in 'token_response'
			 */
			if ( 200 !== $token_status_code ) {

				$token_response = $mys_response_status['message'];

			} else {

				isset( $mys_response_body[0]->mysGUID ) && $token_response = $mys_response_body[0]->mysGUID;

				//Set Transient for MYS Token expires in 1 hour
				set_transient( 'nab_mys_token', $token_response, 60 * 60 );
			}

			$nab_mys_token_data = array( 'token_response' => $token_response, 'token_status_code' => $token_status_code );

			return $nab_mys_token_data;
		}

		/**
		 * Get MYS API URL
		 *
		 * @param string $current_request Session/Speakers/etc.
		 *
		 * @return string MYS API URL
		 *
		 * @since 1.0.0
		 * @package MYS Modules
		 */
		public function nab_mys_get_request_url( $current_request ) {

			$main_url = isset ( $this->nab_mys_urls['main_url'] ) ? $this->nab_mys_urls['main_url'] : '';

			$custom_from_date = $this->custom_from_date;
			if ( null !== $custom_from_date && ! empty( $custom_from_date ) ) {
				$fromDate = $custom_from_date;
			} else {
				$fromDate = null !== $this->previous_date ? $this->previous_date : $this->nab_mys_urls['datepicker'] . ' 00:00:00';
				$fromDate = date( "Y-m-d H:i:s", strtotime( $fromDate ) );
			}

			$custom_to_date = $this->custom_to_date;
			if ( null !== $custom_to_date && ! empty( $custom_to_date ) ) {
				$toDate = $custom_to_date;
			} else {
				$toDate = current_time( 'Y-m-d H:i:s' );
			}
			$modified_dates = '?fromDate=' . $fromDate . '&toDate=' . $toDate;

			$modified_sessions_url = isset ( $this->nab_mys_urls['modified_sessions_url'] ) ? $this->nab_mys_urls['modified_sessions_url'] : '';
			$modified_sessions_url = $modified_sessions_url . $modified_dates;
			$sessions_url          = isset ( $this->nab_mys_urls['sessions_url'] ) ? $this->nab_mys_urls['sessions_url'] : '';
			$tracks_url            = isset ( $this->nab_mys_urls['tracks_url'] ) ? $this->nab_mys_urls['tracks_url'] : '';
			$sponsors_url          = isset ( $this->nab_mys_urls['sponsors_url'] ) ? $this->nab_mys_urls['sponsors_url'] : '';
			$speakers_url          = isset ( $this->nab_mys_urls['speakers_url'] ) ? $this->nab_mys_urls['speakers_url'] : '';

			$exhibitors_url          = isset ( $this->nab_mys_urls['exhibitors_url'] ) ? $this->nab_mys_urls['exhibitors_url'] : '';
			$modified_exhibitors_url = $exhibitors_url . $modified_dates;

			$single_exhibitors_url = explode( '/Modified', $exhibitors_url );
			$single_exhibitors_url = $single_exhibitors_url[0];

			$single_session_url = '';

			$exhibitors_category_url = isset ( $this->nab_mys_urls['exhibitors_category_url'] ) ? $this->nab_mys_urls['exhibitors_category_url'] : '';

			switch ( $current_request ) {
				case "modified-sessions":
					$mys_request_url            = $main_url . $modified_sessions_url;
					$this->current_request_text = "Sessions Modified";
					break;
				case "sessions":
					$mys_request_url            = $main_url . $sessions_url;
					$this->current_request_text = "Sessions";
					break;

				case "tracks":
					$mys_request_url            = $main_url . $tracks_url;
					$this->current_request_text = "Tracks";
					break;

				case "sponsors":
					$mys_request_url            = $main_url . $sponsors_url;
					$this->current_request_text = "Sponsors";
					break;

				case "speakers":
					$mys_request_url            = $main_url . $speakers_url;
					$this->current_request_text = "Speakers";
					break;

				case "exhibitors":
					$mys_request_url            = $main_url . $modified_exhibitors_url;
					$this->current_request_text = "Exhibitors";
					break;

				case "single-exhibitor":
					$mys_request_url            = $main_url . $single_exhibitors_url;
					$this->current_request_text = "Single Exhibitor";
					break;

				case "single-session":
					$mys_request_url            = $main_url . $single_session_url;
					$this->current_request_text = "Single Session";
					break;

				case "exhibitor-categories":
					$mys_request_url            = $main_url . $exhibitors_category_url;
					$this->current_request_text = "Exhibitors Categgory";
					break;
			}

			return $mys_request_url;
		}

		/**
		 * Generates a unique 10 digit alphanumeric string for Group ID.
		 *
		 * @since 1.0.0
		 * @package MYS Modules
		 */
		public function nab_mys_set_groupid() {

			if ( empty( $this->group_id ) ) {

				$length = 11;

				$characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$charactersLength = strlen( $characters );
				$randomString     = '';

				for ( $i = 0; $i < $length; $i ++ ) {
					$randomString .= $characters[ wp_rand( 0, $charactersLength - 1 ) ];
				}

				$this->group_id = $randomString;
			}

		}

		/**
		 * Display errors.
		 *
		 * @param string $error_message An error message.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_display_error( $error_message ) {

			$error_message_html = "<p class='red-notice mys-error-notice'>$error_message</p>";

			if ( "wpajax" === $this->flow ) {

				echo wp_json_encode( array( "apiError" => $error_message_html ) );
				wp_die();
			} else {
				//CRON
				esc_html_e( $error_message );
				die();
			}
		}

		/**
		 * Increase Attempts to 3 and then force stop the request send email.
		 *
		 * @param array $mail_data Te data for email.
		 * @param bool true|false $force_stop
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_increase_attempt( $mail_data, $force_stop = false ) {

			$sequence_resetted = 0;
			$stuck_groupid     = $mail_data['stuck_groupid'];
			$data              = $mail_data['data'];
			$tag               = $mail_data['tag'];
			$default_message   = 'Please click the "Pull & Sync" button one more time. The previous pull request was blocked after several attempts. Check your inbox for more details.';
			$error_message     = isset( $mail_data['error_message'] ) ? $mail_data['error_message'] : $default_message;

			$mys_data_attempt = get_option( $tag );
			$mys_data_attempt = isset( $mys_data_attempt ) ? (int) $mys_data_attempt + 1 : 1;

			update_option( $tag, $mys_data_attempt );

			if ( $mys_data_attempt > 5 ) {
				$force_stop        = true;
				$sequence_resetted = 1;

				update_option( $tag, 0 );
				if ( 'mys_data_attempt_exhibitors' === $tag ) {
					update_option( 'exh_prev_finished_counts', 0 );
				}

				// send email..
				NAB_MYS_DB_CRON::nab_mys_static_reset_sequence( $stuck_groupid );

				$history_detail_link = admin_url( 'admin.php?page=mys-history&groupid=' . $stuck_groupid . '&timeorder=asc' );

				$email_subject = "MYS/Wordpress Failure - Five sync attempts for $data failed.";
				$email_body    = "There was an error with the custom MYS Module plugin. Tried to Sync $data. <a href='$history_detail_link'>Click here</a> to view details.";

				NAB_MYS_DB_CRON::nab_mys_static_email( $email_subject, $email_body );
			}

			if ( true === $force_stop ) {
				$error_message = 1 === $sequence_resetted ? $default_message : $error_message;
				$this->nab_mys_display_error( $error_message );
			}
		}
	}
}
