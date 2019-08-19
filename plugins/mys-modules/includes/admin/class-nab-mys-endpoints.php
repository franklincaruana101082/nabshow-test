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

//Class File - DataBase Queries
require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/class-nab-mys-db.php' );

if ( ! class_exists( 'NAB_MYS_Endpoints' ) ) {

	class NAB_MYS_Endpoints {

		private $flow;

		private $nab_mys_db;

		private $requested_for;

		private $current_request;

		private $past_request;

		private $current_request_text;

		private $mys_request_url;

		private $datatype;

		//History ID of recently added History record. This will use to upate the same record.
		private $history_id;

		//Same Group ID to assign in all records of all tables of Database.
		private $group_id;

		private $final_stack_item = "speakers";

		/**
		 * Test Cases - On/Off
		 *
		 * If $enable_test_case = 0 ; Disable Test Case
		 * If $enable_test_case = 1 ; Enable Test Case
		 *
		 */
		private $enable_test_case = 0;

		/**
		 * Test Case - Token Status
		 *
		 * If $test_token_status = 0 ; Token Failed
		 * If $test_token_status = 1 ; Token Successful
		 *
		 */
		private $test_token_status = 1;

		/**
		 * Test Case - Token Status
		 *
		 * If $test_token_status = 0 ; Token Failed
		 * If $test_token_status = 1 ; Token Successful
		 *
		 */
		private $test_data_status = 1;

		/**
		 * Class Constructor
		 */
		public function __construct() {

			//Action for the Ajax Call from ( /assets/js/nab-mys-script.js ).
			add_action( 'wp_ajax_nab_mys_sync_data', array( $this, 'nab_mys_sync_data' ) );
			add_action( 'wp_ajax_nopriv_nab_mys_sync_data', array( $this, 'nab_mys_sync_data' ) );

			//Initialize Database Class Instance to store the Response Data.
			$this->nab_mys_db = new NAB_MYS_DB();

			//Intitialize the Rest End Point
			add_action( 'rest_api_init', array( $this, 'nab_mys_rest_end_points' ) );
		}

		public function nab_mys_rest_end_points() {

			/**
			 * http://nabshow.md-staging.com/wp-json/mys/get-data?datatype=1
			 * http://nabshow.md-staging.com/wp-json/mys/get-data?datatype=2
			 */
			register_rest_route( 'mys', '/get-data', array(
					'methods'  => 'GET',
					'callback' => array( $this, 'nab_mys_restapi_sessions' )
				)
			);

			/**
			 * http://nabshow.md-staging.com/wp-json/mys/migrate-data?limit=2
			 * http://nabshow.md-staging.com/wp-json/mys/migrate-data?limit=5
			 */
			register_rest_route( 'mys', '/migrate-data', array(
					'methods'  => 'GET',
					'callback' => array( $this, 'nab_mys_restapi_start_migration' )
				)
			);
		}

		public function nab_mys_restapi_sessions( WP_REST_Request $request ) {
			$parameters = $request->get_params();

			$this->datatype = $parameters['datatype'];

			return $this->nab_mys_sync_data();
		}

		public function nab_mys_restapi_start_migration( WP_REST_Request $request ) {

			$parameters = $request->get_params();

			$limit = isset( $parameters['limit'] ) ? $parameters['limit'] : 3;

			$result = $this->nab_mys_db->nab_mys_migrate_data( $limit );

			return $result;
		}

		/**
		 * @return string returns the next pending data name
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
					"modified-sessions",
					"sessions",
					"speakers",
					"tracks",
					"sponsors"
				);

			} else if ( "exhibitors" === $queue ) {
				$requested_for_stack = array(
					"modified-exhibitors",
					"exhibitors",
					"exhibitors-category"
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

		public function nab_mys_get_datatype_name() {

			$requested_for_stack = array(
				0 => "modified-sessions",
				1 => "sessions",
				2 => "speakers",
				3 => "tracks",
				4 => "sponsors",
				5 => "exhibitors",
				6 => "exhibitors-category"
			);

			if ( isset( $this->datatype ) ) {
				return $requested_for_stack[ $this->datatype ];
			}

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
		function nab_mys_random_id( $length = 10 ) {

			$characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen( $characters );
			$randomString     = '';

			for ( $i = 0; $i < $length; $i ++ ) {
				$randomString .= $characters[ wp_rand( 0, $charactersLength - 1 ) ];
			}

			return $randomString;
		}

		/**
		 * Fetch MYS API Data and Store in Database.
		 *
		 * @return array Contains the database action status and error code.
		 * @package MYS Modules
		 *
		 * @since 1.0.0
		 */
		public function nab_mys_sync_data() {

			check_ajax_referer( 'mys-ajax-nonce', 'security' );

			$requested_for = filter_input( INPUT_POST, 'requested_for', FILTER_SANITIZE_STRING );
			$group_id      = filter_input( INPUT_POST, 'group_id', FILTER_SANITIZE_STRING );
			$past_request  = filter_input( INPUT_POST, 'past_request', FILTER_SANITIZE_STRING );

			if ( isset( $requested_for ) ) {

				$this->requested_for = sanitize_text_field( $requested_for );
				$this->group_id      = ( "" !== sanitize_text_field( $group_id ) ) ? sanitize_text_field( $group_id ) : "";
				$this->past_request  = ( "" !== sanitize_text_field( $past_request ) ) ? sanitize_text_field( $past_request ) : "";
				$this->flow          = 'wpajax';

			} else {

				$this->requested_for = $this->nab_mys_get_datatype_name();
				$this->flow          = 'restapi';

			}
			$this->final_stack_item = $this->requested_for;

			//If fresh button clicked, Generate a uniqe 10 digit alphanumeric string for Group ID.
			if ( empty( $this->group_id ) ) {
				$this->group_id = $this->nab_mys_random_id();
			}

			$this->current_request = $this->nab_mys_requested_for_stack();

			//Insert a pending row in History table
			$this->history_id = $this->nab_mys_db->nab_mys_update_history_data( $this->current_request, "insert", $this->group_id );

			//Get MYS API Request URL.
			$this->mys_request_url = $this->nab_mys_get_request_url( $this->current_request );

			//Test Cases Code - Used to prevent API Calls by passing static responses.
			if ( 1 === $this->enable_test_case ) {

				//Initialize Token Array for Testing Purpose
				$nab_mys_token_data = array();

				if ( 0 === $this->test_token_status ) {

					//Testing Purpose - Force Token Failed
					$nab_mys_token_data['token_status_code'] = 401;
					$nab_mys_token_data['token_response']    = 'Dummy Error Msg - Failed Token';

				} else {

					//Testing Purpose - Force Token Successful
					$nab_mys_token_data['token_status_code'] = 200;
					$nab_mys_token_data['token_response']    = 'Dummy-Token-5A623AB5-D785-83A0-DD8DF9228D00EC65';
				}
				//End - Test Cases Code

			} else {

				//Actual Call - No Testing code

				//Get Token from Cache, If not available, Generate New and Store in the Cache.
				$nab_mys_token_data = $this->nab_mys_get_token_from_cache();

			}

			//If Cached token expired and New token generation failed, throw error.
			if ( 200 !== $nab_mys_token_data['token_status_code'] ) {

				$message = "Error " . $nab_mys_token_data['token_status_code'] . ": " . $nab_mys_token_data['token_response'];

				$mys_message_html = '<div class="notice notice-error is-dismissible"><p>' . $message . '</p></div>';

				echo wp_json_encode( $mys_message_html );
				wp_die();
			}

			//1st Attempt to fetch and store MYS Data (This will use cached token if not experied.)
			$mys_message_html = $this->nab_mys_storing_in_db( $nab_mys_token_data['token_response'] );


			if ( strpos( $mys_message_html, "notice-error" ) !== false ) {

				//1st Attempt failed, Maybe Cached token not worked, Generate a New Token and Try again.

				//Generate a New Token for 2nd Attempt.
				$nab_mys_new_token_data = $this->nab_mys_generate_token();


				//2nd Attempt to fetch and store MYS Data (This will use a Fresh New Token)
				$mys_message_html = $this->nab_mys_storing_in_db( $nab_mys_new_token_data['token_response'] );

				/**
				 * 2nd Attempt was Successul or Failed? The answer ($mys_message_html)
				 * will be returned to the Javascript file ( /assets/js/nab-mys-script.js ).
				 */
			}

			echo wp_json_encode( $mys_message_html );
			wp_die();
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
		public function nab_mys_storing_in_db( $nab_mys_token_response ) {

			//Initialize the response status
			$mys_response_status = '';

			//Authorization string for the API Call.
			$authorization = "Bearer " . $nab_mys_token_response;

			//Test Cases Code - Used to prevent API Calls by passing static responses.
			if ( 1 === $this->enable_test_case ) {

				//Initialize Response Body for Testing Purpose
				$mys_response_body = array();

				if ( 0 === $this->test_data_status ) {

					//Testing Purpose - Force Data Failed
					$mys_response_body[0]->error    = "This is an error!";
					$mys_response_status['code']    = 501;
					$mys_response_status['message'] = "Dummy Msg - MYS fetch failed";

				} else {

					//Testing Purpose - Force Data Successful
					$mys_response_body[0]           = "IamDATA";
					$mys_response_status['code']    = 200;
					$mys_response_status['message'] = "OK";
				}
				//End - Test Cases Code

			} else {

				//Actual Call - No Testing code

				//Attempt to Fetch Data from MYS
				$mys_response = $this->nab_mys_api_call( $this->mys_request_url, $authorization );

				$mys_response_body = $mys_response['body'];

				$mys_response_status = $mys_response['status'];
			}

			if ( 200 === $mys_response_status['code'] ) {

				//Attempt Success - Response Data Received.

				//Insert the Response data in Database.
				$inser_status = $this->nab_mys_db->nab_mys_insert_data( $this->current_request, $mys_response_body, $this->history_id );

				//Now everything is done for the current request so making it a past request
				$this->past_request = $this->current_request;

				/**
				 * If the stack is still not empty, re call main function to fetch their data.
				 */
				if ( "wpajax" === $this->flow ) {

					if ( $this->final_stack_item === $this->current_request ) {
						$this->current_request = ''; //this will stop recurring ajax
					}

					return array(
						"pastItem"     => $this->current_request,
						"requestedFor" => $this->requested_for,
						"groupID"      => $this->group_id
					);

				} else {

					if ( $this->final_stack_item !== $this->current_request ) {

						$this->nab_mys_sync_data();

					} else {
						echo "Data fetched successfully";
						die();
					}
				}

				if ( true === $inser_status ) {

					$message = $this->current_request_text . " Successfully Synced.";

				} else {

					$message = "Database Insertion Unsuccessful";
				}

				$message_class = 'notice-success';

			} else {

				//Attempt Failed - Response Data NOT Received.

				$message = "Error " . $mys_response_status['code'] . ": " . $mys_response_status['message'];
				$message .= isset ( $mys_response_body[0]->error ) ? " - " . $mys_response_body[0]->error : '';

				$message_class = 'notice-error';
			}

			//Create a HTML for Message to display
			$mys_message_html = '<div class="notice ' . $message_class . ' is-dismissible"><p>' . $message . '</p><button class="mys-notice-dismiss notice-dismiss" type="button"></button></div>';

			return $mys_message_html;
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

			$args    = array( 'showCode' => "nab19" );
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

			//Response Body
			$mys_response_body = json_decode( $mys_response['body'] );

			//Response Code ( 200 - OK / 401 - Unauthorized / 500 - General Error / etc. )
			$mys_response_status = $mys_response['response'];

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
		public function nab_mys_get_token_from_cache() {

			$nab_mys_token = get_transient( 'nab_mys_token' );

			if ( false === $nab_mys_token ) {
				//If Cachced Token expired, Generate a New Token.
				$nab_mys_token_data = $this->nab_mys_generate_token();

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
		private function nab_mys_generate_token() {

			//Get MYS API Request URL
			$mys_request_url = MYS_PLUGIN_API . 'Authorize';

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
		 * @param string $requested_for MYS API Data Requested For: Sessions / Speakers / Exhibitors / etc.
		 *
		 * @return string
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		private function nab_mys_get_request_url( $current_request ) {

			switch ( $current_request ) {
				case "sessions":
					$mys_request_url            = MYS_PLUGIN_API . "Sessions/List?showCode=nab19";
					$this->current_request_text = "Sessions";
					break;

				case "tracks":
					$mys_request_url            = MYS_PLUGIN_API . "Sessions/Tracks/?showCode=nab19";
					$this->current_request_text = "Tracks";
					break;

				case "sponsors":
					$mys_request_url            = MYS_PLUGIN_API . "Sessions/Sponsors/?showCode=nab19";
					$this->current_request_text = "Sponsors";
					break;

				case "speakers":
					$mys_request_url            = MYS_PLUGIN_API . "Sessions/Speakers/?showCode=nab19";
					$this->current_request_text = "Speakers";
					break;

				case "exhibitors":
					$mys_request_url            = MYS_PLUGIN_API . "Exhibitors/?showCode=nab19&exhid=5171131";
					$this->current_request_text = "Exhibitors";
					break;

				case "exhibitors-category":
					$mys_request_url            = MYS_PLUGIN_API . "Categories/?showCode=nab19";
					$this->current_request_text = "Exhibitors Categgory";
					break;

				case "modified-sessions":
					$mys_request_url            = MYS_PLUGIN_API . "Sessions/Modified?fromDate=2019-02-20&toDate=2019-04-21";
					$this->current_request_text = "Sessions Modified";
					break;
			}

			return $mys_request_url;
		}

	}
}
new NAB_MYS_Endpoints();
