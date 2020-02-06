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

	/**
	 * Class NAB_MYS_Sessions
	 */
	class NAB_MYS_Sessions extends NAB_MYS_Sync_Parent {

		private $datatype;

		private $final_stack_item;

		private $nab_mys_db_sess;

		private $individual = array();

		/**
		 * Class Constructor
		 */
		public function __construct() {

			//Action for the Ajax Call from ( /assets/js/nab-mys-script.js ).
			add_action( 'wp_ajax_nab_mys_session_data', array( $this, 'nab_mys_sync_sessions' ) );
			add_action( 'wp_ajax_nopriv_nab_mys_session_data', array( $this, 'nab_mys_sync_sessions' ) );

			//Initialize the Rest End Point
			add_action( 'rest_api_init', array( $this, 'nab_mys_cron_rest_points_sessions' ) );

			//Create DB Class Object
			$this->nab_mys_load_sessions_db_class();

			//Sessions Cron function.
			add_action( 'mys_sessions_cron', array( $this, 'nab_mys_wpcron_api_to_custom' ), 10, 1 );

			parent::__construct();
		}

		/**
		 * Triggers WP Cron for Sessions.
		 *
		 * @param int $datatype The datatype number. For ex: 1 for 'sessions'.
		 *
		 * @return array Migrated data.
		 */
		public function nab_mys_wpcron_api_to_custom( $datatype ) {

			$this->datatype = $datatype;

			return $this->nab_mys_sync_sessions();
		}

		/**
		 * Load Sessions DB Class.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_load_sessions_db_class() {

			//Class File - DataBase Queries
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-db-sessions.php' );

			//Initialize Database Class Instance to store the Response Data.
			$this->nab_mys_db_sess = new NAB_MYS_DB_Sessions();

		}

		/**
		 * Fetch MYS API Data and Store in Database.
		 *
		 * @package MYS Modules
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

		/**
		 * Initialize the Session Sync.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		private function nab_mys_sync_sess_initialize() {

			$this->final_stack_item = $this->requested_for;

			$this->current_request = $this->nab_mys_sync_stack();

			if ( 'modified-sessions' === $this->current_request && 1 === MYS_PLUGIN_MODIFIED_SEQUENCE ) {
				$this->previous_date = $this->nab_mys_db_sess->nab_mys_db_previous_date( 'modified-sessions' );
			}

			$individual_result = $this->nab_mys_sync_sess_individual();
			$initial_state     = $individual_result['initial_state'];
			$mys_response_body = $individual_result['mys_response_body'];
			$inserted          = $individual_result['inserted'];

			if ( 0 === $inserted ) {
				$this->history_id = $this->nab_mys_db_sess->nab_mys_db_history_data( $this->current_request, "insert", $this->group_id, $initial_state );
			}

			return $mys_response_body;
		}

		/**
		 * Getting isActive parameter from individual sessions.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 *
		 * @return array MYS Response and the insertion status.
		 */
		public function nab_mys_sync_sess_individual() {

			//Get MYS API Request URL.
			$inserted      = 0;
			$initial_state = 0;

			// Skipping if 2, means the individual sessions are pending to be fetched.
			if ( 2 !== count( $this->individual ) ) {
				$this->mys_request_url = $this->nab_mys_get_request_url( $this->current_request );

				$mys_response_body = $this->nab_mys_get_response();

				if ( 'modified-sessions' === $this->current_request || 'sessions' === $this->current_request ) {
					$initial_state = 10;
				}
			}

			//If fresh button clicked, Generate a unique alphanumeric string for Group ID.
			$this->nab_mys_set_groupid();

			if ( 'sessions' === $this->current_request ) {
				$inserted               = 1;
				$session_modified_array = get_option( 'modified_sessions_' . $this->group_id );

				// If 1, means sessions list is pending to be fetched.
				if ( 1 === count( $this->individual ) ) {
					$this->history_id = $this->nab_mys_db_sess->nab_mys_db_history_data( 'sessions', "insert", $this->group_id, 10 );
					// To make the status 10 and insert json data, update it.
					$this->nab_mys_db_sess->nab_mys_db_set_data_json( wp_json_encode( $mys_response_body ) );
					$this->nab_mys_db_sess->nab_mys_db_history_data( 'sessions', "update", $this->group_id, 10 );
				}

				// intersect with all sessions.
				$total_counts  = isset ( $this->total_counts ) ? $this->total_counts : 0;
				$first_attempt = 0;
				if ( 2 !== count( $this->individual ) ) {
					$first_attempt = 1;
					$total_counts  = 0;
					$all_sessions  = $mys_response_body[0]->sessions;

					foreach ( $all_sessions as $single_session ) {
						$sessionid = $single_session->sessionid;

						if ( array_key_exists( $sessionid, $session_modified_array )
						     && 'Deleted' !== $session_modified_array[ $sessionid ]['status'] ) {
							$session_modified_array[ $sessionid ]['intersect'] = 1;
							$total_counts ++;
						}
					}
					// Updating array with intersect parameter.
					update_option( 'modified_sessions_' . $this->group_id, $session_modified_array );
				}

				// Start fetching individually.
				if ( 0 === $total_counts ) {
					$first_attempt = 1;
					foreach ( $session_modified_array as $sessionid => $single_mod_session ) {
						if ( isset ( $single_mod_session['intersect'] ) && 1 === $single_mod_session['intersect'] ) {
							$total_counts ++;
						}
					}
				}
				$finished_counts = 0;
				foreach ( $session_modified_array as $sessionid => $single_mod_session ) {
					$intersect = isset ( $single_mod_session['intersect'] ) ? $single_mod_session['intersect'] : 0;

					if ( isset ( $single_mod_session['isActive'] ) ) {
						$finished_counts ++;
						continue;
					}

					if ( 1 === $intersect ) {
						$this->mys_request_url = $this->nab_mys_urls['main_url'] . '/Sessions?sessionID=' . $sessionid;

						$single_session = $this->nab_mys_get_response();
						$single_session = $single_session[0]->sessions;

						$isactive = isset( $single_session->schedules[0]->isactive ) ? $single_session->schedules[0]->isactive : 0;

						//If isActive is 1, process categories.
						if ( 1 === $isactive ) {
							$session_cats = $single_session->categories;

							$catid_array = $cat_data = array();
							foreach ( $session_cats as $session_cat ) {
								$catid              = $catid_array[] = $session_cat->categoryid;
								$cat_data[ $catid ] = $session_cat;
							}
							$catids = implode( ',', $catid_array );

							// Updating catdata to store in one go at
							// the end of all individual sessions fetch
							$prev_cat_data = get_option( 'session_cats' );
							if ( is_array( $prev_cat_data ) ) {
								$cat_data = array_replace( $cat_data, $prev_cat_data );
							}
							update_option( 'session_cats', $cat_data );

							// keep updating modified array with separated cat ids
							$session_modified_array[ $sessionid ]['categories'] = $catids;
						}

						// keep updating modified array with isactive
						$session_modified_array[ $sessionid ]['isActive'] = $isactive;
						update_option( 'modified_sessions_' . $this->group_id, $session_modified_array );

						$finished_counts ++;
						// If Ajax, send back detail to the browser.
						if ( 'wpajax' === $this->flow ) {

							$custom_status                    = array();
							$custom_status['finished_counts'] = $finished_counts;
							$custom_status['individual']      = 1;

							// Only pass total_counts on first attempt
							// to manage displaying message in the browser only once.
							if ( 1 === $first_attempt ) {
								$custom_status['total_counts'] = $total_counts;
							}

							$this->nab_mys_sync_sess_reloop( $custom_status );
						}
					}
				}

				// Create/Update sessions categories.
				$cat_data = isset ( $cat_data ) ? $cat_data : get_option( 'session_cats' );
				$this->nab_mys_db_sess->nab_mys_db_sess_categories( $cat_data );

				//Now get all sessions from DB and proceed as earlier.
				if ( ! isset( $mys_response_body[0]->sessions ) ) {
					$session_row       = $this->nab_mys_db_sess->nab_mys_db_get_sessions( $this->group_id );
					$this->history_id  = $session_row['HistoryID'];
					$mys_response_body = $session_row['HistoryData'];
				}
				$initial_state = 0;

				//Update statuses to normal
				$this->nab_mys_db_sess->nab_mys_db_set_data_json( wp_json_encode( $session_modified_array ) );
				$this->nab_mys_db_sess->nab_mys_db_history_data( 'modified-sessions', "update", $this->group_id, 0 );

				$this->nab_mys_db_sess->nab_mys_db_set_data_json( wp_json_encode( $mys_response_body ) );
				$this->nab_mys_db_sess->nab_mys_db_history_data( 'sessions', "update", $this->group_id, 0 );
			}

			return array( 'mys_response_body' => $mys_response_body, 'initial_state' => $initial_state, 'inserted' => $inserted );

		}


		/**
		 * Check Lock for the Session Sync.
		 *
		 * @return true
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
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

				if ( isset( $lock_status['individual'] ) && 'yes' === $lock_status['individual'] ) {
					$this->individual   = $lock_status['data'];
					$this->group_id     = isset ( $lock_status['data'][0]->HistoryGroupID ) ? $lock_status['data'][0]->HistoryGroupID : '';
					$this->past_request = 'modified-sessions';
				} else {

					$error_message = 'New pull request is locked because there is already a request in progress, please wait until it finishes.';
					if ( "stop" === $lock_status ) {
						$this->nab_mys_display_error( $error_message );
					} else if ( "open" !== $lock_status && ( null === $this->past_request || empty( $this->past_request ) ) ) {

						$mail_data                  = array();
						$mail_data['stuck_groupid'] = $lock_status[0]->HistoryGroupID;
						$mail_data['data']          = 'Sessions';
						$mail_data['tag']           = 'mys_data_attempt_sessions';
						$mail_data['error_message'] = $error_message;

						$this->nab_mys_increase_attempt( $mail_data, true );
					}
				}
			}

			return true;
		}

		/**
		 * Finalizing Sessions Sync.
		 *
		 * @param string $mys_response_body Response Body
		 *
		 * @package MYS Modules
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

		/**
		 * Re-looping Sessions Sync process.
		 *
		 * @param array $custom_status The details about pulled data.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		private function nab_mys_sync_sess_reloop( $custom_status ) {

			//Now everything is done for the current request so making it a past request
			$this->past_request = $this->current_request;

			if ( $this->final_stack_item === $this->past_request || 'empty' === $this->requested_for ) {
				$this->past_request = 'finish'; //this will stop recurring ajax

				// Reset the attempt count to prevent its application on other sequences.
				// Reset when Ajax
				// Or when Cron with status = 'done' (i.e. sequence completed)
				if ( "wpajax" === $this->flow || "done" === $custom_status['status'] ) {
					update_option( 'mys_data_attempt_sessions', 0 );
					delete_option( 'session_attempt_state' );
				}
			}

			//If the stack is still not empty, re call main function to fetch next data.
			if ( "wpajax" === $this->flow ) {

				echo wp_json_encode(
					array(
						"pastItem"          => $this->past_request,
						"requestedFor"      => $this->requested_for,
						"groupID"           => $this->group_id,
						"totalCounts"       => isset( $custom_status['total_counts'] ) ? $custom_status['total_counts'] : null,
						"totalItemStatuses" => isset( $custom_status['total_item_statuses'] ) ? $custom_status['total_item_statuses'] : null,
						"finishedCounts"    => isset( $custom_status['finished_counts'] ) ? $custom_status['finished_counts'] : null,
						"individual"        => isset( $custom_status['individual'] ) ? $custom_status['individual'] : null
					)
				);
				wp_die();

			} else {

				if ( 'finish' !== $this->past_request ) {

					$this->nab_mys_sync_sessions();

				} else if ( 'empty' !== $this->requested_for ) {

					if ( "sessions" === $this->requested_for ) {
						esc_html_e( "New CRON sequence ($this->group_id) started. " );
					}

					esc_html_e( "$this->current_request_text fetched successfully." );

					if ( "done" === $custom_status['status'] ) {
						esc_html_e( " CRON sequence ($this->group_id) is now completed successfully." );
					}
					die();

				} else {
					esc_html_e( "Everything is upto date." );
					die();
				}
			}
		}

		/**
		 * Stack of data to migrate in sequence.
		 *
		 * @return string returns the next pending data name
		 *
		 * @since 1.0.0
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
					"modified-sessions",
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


		/**
		 * Check the cron sequence for sessions children.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_cron_check_sequence() {

			$sequence_data = $this->nab_mys_db_sess->nab_mys_db_get_latest_groupid( $this->requested_for );

			if ( 0 === $sequence_data ) {
				esc_html_e( "The new CRON sequence is not started yet. Please wait for the new CRON." );
				die();
			}

			$exist_already  = isset( $sequence_data['exist_already'] ) ? $sequence_data['exist_already'] : '';
			$this->group_id = $sequence_data['group_id'];

			if ( 1 === $exist_already ) {

				//Check if sequence is finished or not.
				$this->nab_mys_db_sess->nab_mys_db_check_sequence( $this->group_id );

				esc_html_e( "This data already pulled for current CRON, Please wait for the next CRON." );
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
		 * @return array Migrated data.
		 */
		public function nab_mys_cron_api_to_custom( WP_REST_Request $request ) {
			$parameters = $request->get_params();

			$this->datatype = $parameters['datatype'];

			return $this->nab_mys_sync_sessions();
		}

		/**
		 * Converting Data Type (int) from CRON's parameter to its name (string)
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
				4 => "sponsors"
			);

			if ( isset( $this->datatype ) ) {
				return $requested_for_stack[ $this->datatype ];
			}

		}

	}
}
new NAB_MYS_Sessions();
