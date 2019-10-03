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

if ( ! class_exists( 'NAB_MYS_Sessions' ) ) {

	class NAB_MYS_Sessions extends NAB_MYS_Sync_Parent {

		private $datatype;

		private $final_stack_item;

		private $nab_mys_db_sess;

		/**
		 * Class Constructor
		 */
		public function __construct() {

			//Action for the Ajax Call from ( /assets/js/nab-mys-script.js ).
			add_action( 'wp_ajax_nab_mys_session_data', array( $this, 'nab_mys_sync_sessions' ) );
			add_action( 'wp_ajax_nopriv_nab_mys_session_data', array( $this, 'nab_mys_sync_sessions' ) );

			//Intitialize the Rest End Point
			add_action( 'rest_api_init', array( $this, 'nab_mys_cron_rest_points_sessions' ) );

			//Create DB Class Object
			$this->nab_mys_load_sessions_db_class();

			parent::__construct();
		}

		public function nab_mys_load_sessions_db_class() {

			//Class File - DataBase Queries
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-db-sessions.php' );

			//Initialize Database Class Instance to store the Response Data.
			$this->nab_mys_db_sess = new NAB_MYS_DB_Sessions();

		}

		/**
		 * Fetch MYS API Data and Store in Database.
		 *
		 * @return array Contains the database action status and error code.
		 * @package MYS Modules
		 *
		 * @since 1.0.0
		 */
		public function nab_mys_sync_sessions() {

			$this->nab_mys_set_ajax_data();

			$this->nab_mys_sync_check_lock_sess();

			//Initialize the Record
			$mys_response_body = $this->nab_mys_sync_sess_initialize();

			//Finalize the Record
			$this->nab_mys_sync_sess_finalize( $mys_response_body );

		}

		private function nab_mys_sync_sess_initialize() {

			$this->final_stack_item = $this->requested_for;

			$this->current_request = $this->nab_mys_sync_stack();

			if ( 'modified-sessions' === $this->current_request && 1 === MYS_PLUGIN_MODIFIED_SEQUENCE ) {
				$this->previous_date = $this->nab_mys_db_sess->nab_mys_db_previous_history( 'modified-sessions' );
			}

			//Get MYS API Request URL.
			$this->mys_request_url = $this->nab_mys_get_request_url( $this->current_request );

			$mys_response_body = $this->nab_mys_get_response();

			//If fresh button clicked, Generate a uniqe 10 digit alphanumeric string for Group ID.
			$this->nab_mys_set_groupid();

			$this->history_id = $this->nab_mys_db_sess->nab_mys_db_history_data( $this->current_request, "insert", $this->group_id, 0 );

			return $mys_response_body;

		}

		public function nab_mys_sync_check_lock_sess() {

			$check_lock = 1;

			if ( 'restapi' === $this->flow ) {

				$this->requested_for = $this->nab_mys_cron_get_datatype_name();

				if ( "sessions" !== $this->requested_for ) {

					// Get previous group_id from modified_session to link the cron types and maintain sequence..
					$this->nab_mys_cron_check_sequence();

					$check_lock = 0;
				}

			}

			if ( 1 === $check_lock ) {

				$lock_status = $this->nab_mys_db_sess->nab_mys_db_check_lock( $this->group_id );

				if ( "open" !== $lock_status && ( null === $this->past_request || empty( $this->past_request ) ) ) {

					$mail_data['stuck_groupid'] = $lock_status[0]->HistoryGroupID;
					$mail_data['data']          = 'Sessions';
					$mail_data['tag']           = 'mys_data_attempt_sessions';
					$mail_data['error_message'] = 'New pull request is locked because already 1 request in progress, please wait until it finishes.';

					$this->nab_mys_increase_attempt( $mail_data, true );
				}

			}

			return true;
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
		public function nab_mys_sync_sess_finalize( $mys_response_body ) {

			$custom_status = $this->nab_mys_db_sess->nab_mys_db_insert_data_to_custom( $this->current_request, $mys_response_body, $this->history_id, $this->flow );

			if ( false === $custom_status['status'] ) {
				//This will finish the process..
				$this->requested_for = 'empty';
			} else if ( 'failed' === $custom_status['status'] ) {
				$error_message = "Failed to store details in Database.";
				$this->nab_mys_display_error( $error_message );
			}
			$this->nab_mys_sync_sess_reloop( $custom_status );
		}

		private function nab_mys_sync_sess_reloop( $custom_status ) {

			//Now everything is done for the current request so making it a past request
			$this->past_request = $this->current_request;

			if ( $this->final_stack_item === $this->past_request || 'empty' === $this->requested_for ) {
				$this->past_request = 'finish'; //this will stop recurring ajax
			}

			//If the stack is still not empty, re call main function to fetch next data.
			if ( "wpajax" === $this->flow ) {

				echo wp_json_encode(
					array(
						"pastItem"          => $this->past_request,
						"requestedFor"      => $this->requested_for,
						"groupID"           => $this->group_id,
						"totalCounts"       => $custom_status['total_counts'],
						"totalItemStatuses" => $custom_status['total_item_statuses']
					)
				);
				wp_die();

			} else {

				if ( 'finish' !== $this->past_request ) {

					$this->nab_mys_sync_sessions();

				} else if ( 'empty' !== $this->requested_for ) {

					if ( "sessions" === $this->requested_for ) {
						echo esc_html( "New CRON sequence ($this->group_id) started. " );
					}

					echo esc_html( "$this->current_request_text fetched successfully." );

					if ( "done" === $custom_status['status'] ) {
						echo esc_html( " CRON sequence ($this->group_id) is now completed successfully." );
					}
					die();

				} else {
					echo esc_html( "Everything is upto date." );
					die();
				}
			}
		}

		/**
		 * Stack of data to migrate in sequence.
		 *
		 * @return string returns the next pending data name
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		public function nab_mys_sync_stack() {

			if ( "restapi" === $this->flow ) {
				$requested_for_stack = array(
					'modified-sessions',
					$this->requested_for
				);
			} else {
				$requested_for_stack = array(
					"modified-sessions", // ne_test commented to skip and jump to next
					"sessions",
					"tracks",
					"speakers",
					"sponsors",
				);
			}

			//If its the begenning, the first item from above array should be fethed.
			if ( ! isset( $this->past_request ) || empty( $this->past_request ) ) {
				return $requested_for_stack[0];
			}

			$index = array_search( $this->past_request, $requested_for_stack, true );

			if ( $index !== false && $index < count( $requested_for_stack ) - 1 ) {
				$next = $requested_for_stack[ $index + 1 ];
			}

			return $next;
		}

		/**
		 * Rest End Points
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_cron_rest_points_sessions() {

			/**
			 * wp-json/mys/get-data?datatype=1
			 * wp-json/mys/get-data?datatype=2
			 */
			register_rest_route( 'mys', '/get-data', array(
					'methods'  => 'GET',
					'callback' => array( $this, 'nab_mys_cron_api_to_custom' )
				)
			);

		}

		public function nab_mys_cron_check_sequence() {

			$this->group_id = $this->nab_mys_db_sess->nab_mys_db_get_latest_groupid( $this->requested_for );

			if ( 0 === $this->group_id ) {

				echo esc_html( "The new CRON sequence is not started yet. Please wait for the new CRON." );
				die();

			} else if ( 1 === $this->group_id ) {

				echo esc_html( "This data already pulled for current CRON, Please wait for the next CRON." );
				die();

			} else {
				$this->past_request = "modified-sessions";
			}
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

			return $this->nab_mys_sync_sessions();
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
				6 => "exhibitor-categories"
			);

			if ( isset( $this->datatype ) ) {
				return $requested_for_stack[ $this->datatype ];
			}

		}

	}
}
new NAB_MYS_Sessions();
