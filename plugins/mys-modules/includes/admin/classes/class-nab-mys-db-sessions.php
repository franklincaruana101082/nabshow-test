<?php
/**
 * DataBase Queries Class
 *
 * @package MYS Modules
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'NAB_MYS_DB_Sessions' ) ) {

	/**
	 * Class NAB_MYS_DB_Sessions
	 */
	class NAB_MYS_DB_Sessions extends NAB_MYS_DB_Parent {

		/**
		 * Class Constructor
		 */
		public function __construct() {
			parent::__construct();
		}

		/**
		 * Insert MYS API Data in the Database.
		 *
		 * @param string $current_request = Session/Speakers/etc.
		 * @param array $data The full data coming from API.
		 * @param int $history_id The same history ID which is stored in the begining.
		 * @param string $flow The flow is from JSON or a CRON.
		 *
		 * @return array The result of DB Action.
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		public function nab_mys_db_insert_data_to_custom( $current_request, $data, $history_id, $flow ) {

			$this->current_request = $current_request;
			$this->history_id      = $history_id;
			$this->nab_mys_db_set_data_json( wp_json_encode( $data ) );
			$total_item_statuses = array();

			if ( "modified-sessions" === $current_request ) {

				$session_modified_array = $data[0]->sessions;

				if ( 0 === count( $session_modified_array ) ) {

					$this->nab_mys_db_history_data( "modified-sessions", "update", $this->group_id, 5 );

					return array( 'total_counts' => 0, 'status' => false, 'total_item_statuses' => array() );

				} else {

					//simplifiying modified array to make easy execution.
					$this->session_modified_array = array();
					foreach ( $session_modified_array as $single_modified ) {

						$this->session_modified_array[ $single_modified->sessionid ] = $single_modified->sessionstatus;
						$total_item_statuses[ $single_modified->sessionstatus ][]    = '';
					}

					$total_counts = count( $session_modified_array );

					update_option( 'modified_sessions_' . $this->group_id, $this->session_modified_array );
					$this->nab_mys_db_history_data( "modified-sessions", "update", $this->group_id, 0, $total_counts );


					return array( 'total_counts' => $total_counts, 'status' => true, 'total_item_statuses' => $total_item_statuses );
				}

				/**
				 * done - Get Modifed first and save as an array
				 * Get all other 1 by 1 and save as json and row wise if available in modified array!
				 * and also keep making the status from 0 to 1
				 */

				//1 by 1 covert json to rows only if session id available in Modified Array.
				//Then make 1 by 1 History status to 1 = success

			} else {

				switch ( $current_request ) {

					case "sessions":
						$all_items = $data[0]->sessions;
						break;

					case "tracks":
						$all_items = $data[0]->tracks;
						break;

					case "speakers":
						$all_items = $data[0]->speakers;
						break;

					case "sponsors":
						$all_items = $data[0]->sponsors;
						break;
				}

				//check which session ids from $data are available in $this->session_modified_array
				$total_items_inserted = 0;
				$insertion_values     = '';

				$session_modified_array = $this->session_modified_array = get_option( 'modified_sessions_' . $this->group_id );
				$type_sessions_array    = get_option( 'type_sessions_' . $this->group_id ); // This is used to check the type of Ssssions.

				// If somehow the option does not exist, return false.
				if ( false === $session_modified_array ) {
					return array( 'total_counts' => 0, 'status' => false );
				}

				$rows = $master_array = array();

				$affected_items = 0;

				$referer = filter_input( INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_URL );
				if ( isset( $referer ) ) {
					$total_rows = explode( 'rows=', $referer );
				}
				$total_rows = isset ( $total_rows[1] ) ? (int) $total_rows[1] : 10000;

				$limit_reached        = 0;

				foreach ( $all_items as $item ) {

					//Tracks
					if ( "tracks" === $current_request ) {

						if ( ! isset ( $item->sessions ) || ! is_array( $item->sessions ) ) {

							// 0 stands for No sessions are linked.
							$master_array[0][]                   = $item;
							$total_item_statuses['Unassigned'][] = '';

						} else {
							foreach ( $item->sessions as $session ) {

								if ( array_key_exists( $session->sessionid, $this->session_modified_array ) ) {

									$item_mys_id = $session->sessionid;

									$item_to_add = $item;
									unset( $item_to_add->sessions );

									$master_array[ $session->sessionid ][] = $item_to_add;

									$track_affected = 1;

								}
							}

							$total_item_statuses[ $this->session_modified_array[ $item_mys_id ] ][] = '';
						}


						$affected_items ++;

					} else {

						$item_affected = 0;

						$multiple_sessions = array();

						if ( isset( $item->sessionid ) ) {
							//Add types of sessions in the array
							//this will be used to filter items and allow only "Complete" type items.
							if ( isset ( $session_modified_array[ $item->sessionid ] ) ) {
								$type_sessions_array[ $item->sessionid ] = isset( $item->type ) ? $item->type : '';
							}
							$multiple_sessions[] = $item->sessionid;
						} else if ( isset( $item->schedules ) ) {
							foreach ( $item->schedules as $schedule ) {
								$multiple_sessions[] = $schedule->sessionid;
							}
						}

						//Initiate the type check variable so to handle
						//3 conditions:
						//1) Session not available in Modified Array so SKIP it.
						//2) Session is available but Type is NOT "Complete" so DELETE it.
						//3) Session is available and Type is "Complete" INCLUDE it.
						$item_type = '';
						foreach ( $multiple_sessions as $item_mys_id ) {

							if ( array_key_exists( $item_mys_id, $this->session_modified_array ) ) {

								if ( isset ( $type_sessions_array[ $item_mys_id ] )
								     && "Complete" === $type_sessions_array[ $item_mys_id ] ) {
									$master_array[ $item_mys_id ][] = $item;
									$item_affected                  = 1;
									$item_type                      = 'valid';
								} else {
									$item_type = 'invalid';
								}
							}
						}

						if ( 1 === $item_affected ) {
							$total_item_statuses[ $session_modified_array[ $item_mys_id ] ][] = '';

							$affected_items ++;

							//For speakers & sponsors, prepare items not having even a single session with "Complete" type.
						} else if ( "invalid" === $item_type ) {

							if ( "sessions" === $current_request ) {
								$master_array[ $item_mys_id ][]   = $item;
								$total_item_statuses['Deleted'][] = '';

								// Changing the status to "Delete"
								$session_modified_array[ $item_mys_id ] = 'Deleted';
							} else {
								//0 tells there is no need of session id because we will delete the $item anyway.
								//$master_array_deleted[0][] = $item;
								$master_array['trash'][] = $item;
							}
						}

					}
					if ( $total_rows === $affected_items ) {
						$limit_reached = 1;
						break;
					}
				}

				if ( "sessions" === $current_request ) {
					//Store the array which has Types of sessions.
					add_option( 'type_sessions_' . $this->group_id, $type_sessions_array );
				}

				//Update the modified array as some items might have changed the status to "Deleted".
				if ( 'sessions' === $current_request && 1 !== $limit_reached ) {
					update_option( 'modified_sessions_' . $this->group_id, $session_modified_array );
				} else {
					//Handle the trash status for sponsors and speakers.
					$session_modified_array['trash'] = 'Deleted';
				}

				foreach ( $master_array as $item_mys_id => $item ) {

					// If tracks, we might not have any assigned session,
					// so skip checking status of sessionid in modified_array.
					if( "tracks" === $current_request ) {
						$item_status = "Updated";
					} else {
						$item_status = $session_modified_array[ $item_mys_id ];
					}

					switch ( $item_status ) {

						case "Updated":
							$item_status_int = 2;
							break;

						case "Added":
							$item_status_int = 1;
							break;

						case "Deleted":
							$item_status_int = 0;
							break;
					}

					$single_item_json = wp_json_encode( $item );

					if ( 0 !== $total_items_inserted ) {
						$insertion_values .= ", ";
					}

					$rows[] = array(
						'DataGroupID'   => $this->group_id,
						'HistoryID'     => $this->history_id,
						'AddedStatus'   => 0,
						'ItemStatus'    => $item_status_int,
						'DataType'      => $this->current_request,
						'ModifiedID'    => $item_mys_id,
						'DataStartTime' => current_time( 'Y-m-d H:i:s' ),
						'DataJson'      => $single_item_json
					);

					$total_items_inserted ++;

				}

				global $wpdb;

				// If there are no changes.
				if ( 0 === count( $master_array ) ) {
					$bulk_status = 1;
				} else {
					$bulk_status = $this->nab_mys_db_bulk_insert( $wpdb->prefix . 'mys_data', $rows );
				}

				$total_counts = $affected_items;

				//Insert entry in wp_mys_api_history
				$this->nab_mys_db_history_data( $current_request, "update", $this->group_id, $bulk_status, $total_counts );

				if ( 2 === $bulk_status ) {

					$this->nab_mys_db_history_data( "modified-sessions", "update", $this->group_id, $bulk_status, 'nochange' );
					delete_option( 'modified_sessions_' . $this->group_id );
					delete_option( 'type_sessions_' . $this->group_id );

					return array( 'total_counts' => $total_counts, 'status' => 'failed', 'total_item_statuses' => $total_item_statuses );
				}

				$sequence_completes = 0;

				if ( "sessions" !== $current_request && "restapi" === $flow ) {
					// Check total 4 records (sessions/tracks/speakers/sponsors) with HistoryStatus = 1 and HistoryGroupID = $this->group_id are available or not.
					// If yes, it means CRON sequence is now completed successfully.

					$completed_data = $wpdb->get_results(
						$wpdb->prepare(
							"SELECT HistoryID FROM %1smys_history
								WHERE HistoryStatus != '0'
								AND HistoryGroupID = '%s'",
							$wpdb->prefix, $this->group_id )
					);

					if ( 4 <= count( $completed_data ) ) {
						$sequence_completes = 1;
					}

				} else if ( "sponsors" === $current_request && "wpajax" === $flow ) {
					// If its AJAX call, and sponsors request, sequence is now completed successfully.
					$sequence_completes = 1;
				}

				if ( 1 === $sequence_completes ) {

					$this->nab_mys_db_history_data( "modified-sessions", "finish", $this->group_id, $bulk_status, 'nochange' );
					delete_option( 'modified_sessions_' . $this->group_id );
					delete_option( 'type_sessions_' . $this->group_id );

					return array( 'total_counts' => $total_counts, 'status' => 'done', 'total_item_statuses' => $total_item_statuses );

				}

			}

			return array( 'total_counts' => $total_counts, 'status' => true, 'total_item_statuses' => $total_item_statuses );
		}

		/**
		 * Check a lock for sessions sequence.
		 *
		 * @param string $group_id A unique group id.
		 *
		 * @return array|string Pending data or a text 'open'
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_db_check_lock( $group_id ) {

			global $wpdb;

			$pending_data = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT * FROM %1smys_history
							WHERE HistoryStatus = '0'
							AND HistoryGroupID != %s
							AND HistoryDataType = 'modified-sessions'"
					, $wpdb->prefix, $group_id )
			);

			// Rows found? means there is a modified-sessions row
			// with 0 status in the History table, which means
			// lock is open for current request only if the request
			// type is not 1 (i.e. not for sessions).
			if ( count( $pending_data ) > 0 ) {

				$pending_groupid = $pending_data[0]->HistoryGroupID;

				// Get previous state of attempt
				$previous_rows = $wpdb->get_var(
					$wpdb->prepare(
						"SELECT count(*) FROM %1smys_data
							WHERE DataGroupID = %s"
						, $wpdb->prefix, $pending_groupid )
				);

				// Record the state
				$old_session_attempt_state = get_option( 'session_attempt_state' );
				update_option( 'session_attempt_state', $previous_rows );

				if ( $previous_rows === $old_session_attempt_state ) {
					return $pending_data;
				} else {
					// Resetting attempts as the sequence has increased records than earlier.
					update_option( 'mys_data_attempt_sessions', 0 );

					return 'stop';
				}


			} else {

				return "open";

			}
		}

	}
}
