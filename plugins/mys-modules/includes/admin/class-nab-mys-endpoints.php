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

if ( ! class_exists( 'NAB_MYS_Endpoints' ) ) {

	class NAB_MYS_Endpoints {

		private $flow;

		private $nab_mys_db;

		private $requested_for;

		private $current_request;

		private $past_request;

		private $current_request_text;

		private $mys_request_url;

		private $show_code;

		private $nab_mys_urls;

		private $datatype;

		private $history_id;

		private $group_id;

		private $final_stack_item;

		/**
		 * Class Constructor
		 */
		public function __construct() {

			//Action for the Ajax Call from ( /assets/js/nab-mys-script.js ).
			add_action( 'wp_ajax_nab_mys_sync_data', array( $this, 'nab_mys_sync_api' ) );
			add_action( 'wp_ajax_nopriv_nab_mys_sync_data', array( $this, 'nab_mys_sync_api' ) );

			//Initialize Database Class Instance to store the Response Data.
			$this->nab_mys_db = new NAB_MYS_DB();

			//Get MYS URLs added in backend.
			$this->nab_mys_urls = get_option( 'nab_mys_urls' );

			$this->show_code = isset ( $this->nab_mys_urls['show_code'] ) ? $this->nab_mys_urls['show_code'] : '';

			//Intitialize the Rest End Point
			add_action( 'rest_api_init', array( $this, 'nab_mys_cron_rest_end_points' ) );
		}

		/**
		 * Fetch MYS API Data and Store in Database.
		 *
		 * @return array Contains the database action status and error code.
		 * @package MYS Modules
		 *
		 * @since 1.0.0
		 */
		public function nab_mys_sync_api() {

			$requested_for = filter_input( INPUT_POST, 'requested_for', FILTER_SANITIZE_STRING );
			$group_id      = filter_input( INPUT_POST, 'group_id', FILTER_SANITIZE_STRING );
			$past_request  = filter_input( INPUT_POST, 'past_request', FILTER_SANITIZE_STRING );
			$check_lock    = 1;

			if ( isset( $requested_for ) ) {

				check_ajax_referer( 'mys-ajax-nonce', 'security' );

				$this->requested_for = sanitize_text_field( $requested_for );
				$this->group_id      = ( "" !== sanitize_text_field( $group_id ) ) ? sanitize_text_field( $group_id ) : "";
				$this->past_request  = ( "" !== sanitize_text_field( $past_request ) ) ? sanitize_text_field( $past_request ) : "";
				$this->flow          = 'wpajax';

			} else {

				$this->requested_for = $this->nab_mys_cron_get_datatype_name();
				$this->flow          = 'restapi';

				if ( "sessions" !== $this->requested_for ) {
					// Get previous group_id from modified_session to link the cron types and maintain sequence..

					$this->group_id = $this->nab_mys_db->nab_mys_cron_get_latest_groupid( $this->requested_for );

					if ( 0 === $this->group_id ) {

						echo esc_html( "The new CRON sequence is not started yet. Please wait for the new CRON." );
						die();

					} else if ( 1 === $this->group_id ) {

						echo esc_html( "This data already pulled for current CRON, Please wait for the next CRON." );
						die();

					} else {

						$this->past_request = "modified-sessions";

					}

					$check_lock = 0;

				}

			}

			if ( 1 === $check_lock ) {

				$lock_status = $this->nab_mys_db->nab_mys_db_check_lock( $this->group_id );

				if ( "open" !== $lock_status && ( null === $this->past_request || "" === $this->past_request ) ) {

					$error_message = "New pull request is locked because already 1 request in progress, Please wait until it finishes.";

					$error_message_html = "<p class='red-notice mys-error-notice'>$error_message</p>";

					if ( "wpajax" === $this->flow ) {

						echo wp_json_encode( array( "apiError" => $error_message_html ) );
						wp_die();

					} else {
						//CRON
						echo esc_html( $error_message );
						die();
					}

				}
			}

			$this->final_stack_item = $this->requested_for;

			//If fresh button clicked, Generate a uniqe 10 digit alphanumeric string for Group ID.
			if ( empty( $this->group_id ) ) {
				$this->group_id = $this->nab_mys_random_id();
			}

			$this->current_request = $this->nab_mys_requested_for_stack();

			//Insert a pending row in History table
			$this->history_id = $this->nab_mys_db->nab_mys_db_history_data( $this->current_request, "insert", $this->group_id, $this->flow );

			//Get MYS API Request URL.
			$this->mys_request_url = $this->nab_mys_get_request_url( $this->current_request );

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
					echo esc_html( $error_message_html );
					die();
				}

			} else {
				$this->nab_mys_sync_db( $nab_mys_token_data['token_response'] );
			}
		}

		/**
		 * Attempt to Store MYS Data in Database.
		 *
		 * @param string $nab_mys_token_response Contains the API Token
		 *
		 * @return array Contains the database action status and error code.
		 * @package MYS Modules
		 *
		 * @since 1.0.0
		 */
		public function nab_mys_sync_db( $nab_mys_token_response ) {

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

				$custom_status = $this->nab_mys_db->nab_mys_db_insert_data_to_custom( $this->current_request, $mys_response_body, $this->history_id, $this->flow );

				if ( false === $custom_status ) {

					$error_message = "Modifed Sessions array is empty";
					$error_message_html = "<p class='red-notice mys-error-notice'>$error_message</p>";

					if ( "wpajax" === $this->flow ) {

						echo wp_json_encode( array( "apiError" => $error_message_html ) );
						wp_die();
					} else {
						//CRON
						echo esc_html( $error_message );
						die();
					}
				}

				//Now everything is done for the current request so making it a past request
				$this->past_request = $this->current_request;

				//If the stack is still not empty, re call main function to fetch next data.
				if ( "wpajax" === $this->flow ) {

					if ( $this->final_stack_item === $this->current_request ) {
						$this->current_request = ''; //this will stop recurring ajax
					}

					echo wp_json_encode(
						array(
							"pastItem"     => $this->current_request,
							"requestedFor" => $this->requested_for,
							"groupID"      => $this->group_id
						)
					);
					wp_die();


				} else {

					if ( $this->final_stack_item !== $this->current_request ) {

						$this->nab_mys_sync_api();

					} else {
						//CRON

						if ( "sessions" === $this->requested_for ) {
							echo esc_html( "New CRON sequence ($this->group_id) started. " );
						}

						echo esc_html( "$this->current_request_text fetched successfully." );

						if ( "done" === $custom_status ) {
							echo esc_html( " CRON sequence ($this->group_id) is now completed successfully." );
						}
						die();
					}
				}

			} else {
				//Attempt Failed - Response Data NOT Received.

				$mys_response_message = isset ( $mys_response_status['message']->error ) ? $mys_response_status['message']->error : $mys_response_status['message'];
				$mys_response_message = isset ( $mys_response_message ) ? $mys_response_message : "Something went wrong.";

				$error_message = "Error " . $mys_response_status['code'] . ": " . $mys_response_message;

				//Create a HTML Paragraph for Message to display via Ajax
				$error_message_html = "<p class='red-notice mys-error-notice'>$error_message</p>";

				if ( "wpajax" === $this->flow ) {

					echo wp_json_encode( array( "apiError" => $error_message_html ) );
					wp_die();
				} else {
					//CRON
					echo esc_html( $error_message );
					die();
				}

			}

		}

		/**
		 * Rest End Points
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_cron_rest_end_points() {

			/**
			 * wp-json/mys/get-data?datatype=1
			 * wp-json/mys/get-data?datatype=2
			 */
			register_rest_route( 'mys', '/get-data', array(
					'methods'  => 'GET',
					'callback' => array( $this, 'nab_mys_cron_api_to_custom' )
				)
			);

			/**
			 * wp-json/mys/migrate-data?limit=2
			 * wp-json/mys/migrate-data?limit=5
			 */
			register_rest_route( 'mys', '/migrate-data', array(
					'methods'  => 'GET',
					'callback' => array( $this, 'nab_mys_cron_custom_to_master' )
				)
			);
		}

		/**
		 * Call back for API to Custom Table CRON
		 *
		 * @param WP_REST_Request $request
		 *
		 * @return array
		 */
		public function nab_mys_cron_api_to_custom( WP_REST_Request $request ) {
			$parameters = $request->get_params();

			$this->datatype = $parameters['datatype'];

			return $this->nab_mys_sync_api();
		}

		/**
		 * Call back for Custom Table to Master Table CRON
		 *
		 * @param WP_REST_Request $request
		 *
		 * @return array    List of DataID -> PostID
		 *         string   Message to show that No more data available to migrate.
		 */
		public function nab_mys_cron_custom_to_master( WP_REST_Request $request ) {

			$parameters = $request->get_params();

			$limit = isset( $parameters['limit'] ) ? $parameters['limit'] : 3;

			//ne_temp remove before PR
			$dataids = isset( $parameters['dataids'] ) ? $parameters['dataids'] : '';

			$groupid = isset( $parameters['groupid'] ) ? $parameters['groupid'] : '';

			$result = $this->nab_mys_db->nab_mys_corn_migrate_data( $limit, $dataids, $groupid );

			return $result;
		}

		/**
		 * Conveting Data Type (int) from CRON's parameter to its name (string)
		 *
		 * @return mixed
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		public function nab_mys_cron_get_datatype_name() {

			$requested_for_stack = array(
				0 => "modified-sessions",
				1 => "sessions",
				2 => "speakers",
				3 => "tracks",
				4 => "sponsors",
				5 => "exhibitors",
				6 => "exhibitors - category"
			);

			if ( isset( $this->datatype ) ) {
				return $requested_for_stack[ $this->datatype ];
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
		private function nab_mys_api_call( $mys_request_url, $authorization ) {

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
			$mys_response = wp_remote_request( $mys_request_url, $request );

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
		 * @return string
		 * @package MYS Modules
		 *
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
		 * @return string
		 * @package MYS Modules
		 *
		 * @since 1.0.0
		 */
		private function nab_mys_api_token_generation() {

			//Get MYS API Request URL
			$mys_request_url = isset ( $this->nab_mys_urls['main_url'] ) ? $this->nab_mys_urls['main_url'] . '/Authorize' : '';

			//Stop the flow if Main URL is empty.
			if ( "" === $mys_request_url ) {
				return false;
			}

			$mys_username = get_option( 'nab_mys_credentials_u' );
			$mys_password = get_option( 'nab_mys_credentials_p' );

			//Authorization string for the API Call.
			$authorization = "Basic " . base64_encode( "$mys_username:$mys_password" );
			//NABUser:Cy*79GBEGfs6

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
		 * @return string
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		private function nab_mys_get_request_url( $current_request ) {

			$main_url                = isset ( $this->nab_mys_urls['main_url'] ) ? $this->nab_mys_urls['main_url'] : '';

			$fromDate   = isset ( $this->nab_mys_urls['datepicker'] ) ? $this->nab_mys_urls['datepicker'] : '';
			$fromDate = date("Y-m-d", strtotime($fromDate));
			$toDate = current_time('Y-m-d');
			$modified_sessions_url   = isset ( $this->nab_mys_urls['modified_sessions_url'] ) ? $this->nab_mys_urls['modified_sessions_url'] : '';
			$modified_sessions_url   = $modified_sessions_url . '?fromDate=' . $fromDate . '&toDate=' . $toDate;

			$sessions_url            = isset ( $this->nab_mys_urls['sessions_url'] ) ? $this->nab_mys_urls['sessions_url'] : '';
			$tracks_url              = isset ( $this->nab_mys_urls['tracks_url'] ) ? $this->nab_mys_urls['tracks_url'] : '';
			$sponsors_url            = isset ( $this->nab_mys_urls['sponsors_url'] ) ? $this->nab_mys_urls['sponsors_url'] : '';
			$speakers_url            = isset ( $this->nab_mys_urls['speakers_url'] ) ? $this->nab_mys_urls['speakers_url'] : '';
			$exhibitors_url          = isset ( $this->nab_mys_urls['exhibitors_url'] ) ? $this->nab_mys_urls['exhibitors_url'] : '';
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
					$mys_request_url            = $main_url . $exhibitors_url;
					$this->current_request_text = "Exhibitors";
					break;

				case "exhibitors-category":
					$mys_request_url            = $main_url . $exhibitors_category_url;
					$this->current_request_text = "Exhibitors Categgory";
					break;
			}

			return $mys_request_url;
		}

		/**
		 * Stack of data to migrate in sequence.
		 *
		 * @return string returns the next pending data name
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		public function nab_mys_requested_for_stack() {

			if ( strpos( $this->requested_for, "exhibitors" ) === false ) {
				$modified_item = "modified-sessions";
				$queue         = "sessions";
			} else {
				$modified_item = "modified-exhibitors";
				$queue         = "exhibitors";
			}

			$queue = ( "restapi" === $this->flow ) ? "single" : $queue;

			if ( "single" === $queue ) {

				$requested_for_stack = array(
					$modified_item,
					$this->requested_for
				);
			} else if ( "sessions" === $queue ) {
				$requested_for_stack = array(
					"modified-sessions", // ne_test commented to skip and jump to next
					"sessions",
					"tracks",
					"speakers",
					"sponsors",
				);

			} else if ( "exhibitors" === $queue ) {
				$requested_for_stack = array(
					"modified-exhibitors",
					"exhibitors",
					"exhibitors - category"
				);
			}

			//If its the begenning, the first item from above array should be fethed.
			if ( ! isset( $this->past_request ) || "" === $this->past_request ) {
				return $requested_for_stack[0];
			}

			$past_request = $this->past_request;

			$index = array_search( $past_request, $requested_for_stack, true );

			if ( $index !== false && $index < count( $requested_for_stack ) - 1 ) {
				$next = $requested_for_stack[ $index + 1 ];
			}

			return $next;
		}

		/**
		 * Generates a uniqe 10 digit alphanumeric string for Group ID.
		 *
		 * @param int $length Length of the Token
		 *
		 * @return array Contains the database action status and error code.
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		public function nab_mys_random_id( $length = 10 ) {

			$characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen( $characters );
			$randomString     = '';

			for ( $i = 0; $i < $length; $i ++ ) {
				$randomString .= $characters[ wp_rand( 0, $charactersLength - 1 ) ];
			}

			return $randomString;
		}
	}
}
new NAB_MYS_Endpoints();
