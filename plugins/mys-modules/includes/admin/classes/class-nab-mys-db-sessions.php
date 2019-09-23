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

	class NAB_MYS_DB_Sessions extends NAB_MYS_DB_Parent {

		/**
		 * Class Constructor
		 */
		public function __construct() {
		}

		/**
		 * Insert MYS API Data in the Database.
		 *
		 * @param string $current_request = Session/Speakers/etc.
		 * @param array $data The full data coming from API.
		 * @param int $history_id The same history ID which is stored in the begining.
		 *
		 * @return bool true
		 */
		public function nab_mys_db_insert_data_to_custom( $current_request, $data, $history_id, $flow ) {

			$this->current_request = $current_request;
			$this->history_id      = $history_id;
			//$this->data_array      = $data;
			$this->data_json = wp_json_encode( $data );

			if ( "modified-sessions" === $current_request ) {

				$session_modified_array = $data[0]->sessions;

				if ( 0 === count( $session_modified_array ) ) {

					$this->nab_mys_db_history_data( "modified-sessions", "update", $this->group_id, 1 );

					return array( 'total_counts' => 0, 'status' => false );

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


				//ne_test use below for testing and skipping the modified sessions
				//$session_modified_array = $this->session_modified_array = get_option( 'modified_sessions_faisaltest' );
				$session_modified_array = $this->session_modified_array = get_option( 'modified_sessions_' . $this->group_id );

				// If somehow the option does not exist, return false.
				if ( false === $session_modified_array ) {
					return array( 'total_counts' => 0, 'status' => false );
				}

				$rows = $master_array = array();

				$affected_items      = 0;
				$total_item_statuses = array();

				foreach ( $all_items as $item ) {


					//Tracks
					if ( "tracks" === $current_request ) {

						$track_affected = 0;

						if ( ! isset ( $item->sessions ) || ! is_array( $item->sessions ) ) {
							continue;
						}

						foreach ( $item->sessions as $session ) {

							//ne_test remove ! sign
							if ( array_key_exists( $session->sessionid, $this->session_modified_array ) ) {

								$item_mys_id = $session->sessionid;

								$item_to_add = $item;
								unset( $item_to_add->sessions );

								$master_array[ $session->sessionid ][] = $item_to_add;

								$track_affected = 1;

							}
						}

						if ( 1 === $track_affected ) {

							$total_item_statuses[ $this->session_modified_array[ $item_mys_id ] ][] = '';

							$affected_items ++;
						}

					} else {

						$item_affected = 0;

						$multiple_sessions = array();

						if( isset( $item->sessionid ) ) {
							$multiple_sessions[] = $item->sessionid;
						} else if ( isset( $item->schedules ) ) {
							foreach ($item->schedules as $schedule) {
								$multiple_sessions[] = $schedule->sessionid;
							}
						}

						foreach ( $multiple_sessions as $item_mys_id ) {

							if ( array_key_exists( $item_mys_id, $this->session_modified_array ) ) {
								$item_to_add = $item;
								if ( isset ( $item_to_add->schedules ) ) {
									unset( $item_to_add->schedules );
								}
								$master_array[ $item_mys_id ][] = $item_to_add;

								$item_affected = 1;
							}
						}

						if( 1 === $item_affected ) {

							$total_item_statuses[ $this->session_modified_array[ $item_mys_id ] ][] = '';

							$affected_items ++;
						}

					}

				}


				//add sessions to delete which are in modifed array and not returned in sessions array

				if ( 'sessions' === $current_request ) {

					$sessions_to_delete = array_diff_key( $this->session_modified_array, $master_array );

					foreach ( $sessions_to_delete as $item_mys_id => $status ) {

						$master_array[ $item_mys_id ][] = $status;

						$total_item_statuses['Deleted'][] = '';

						$affected_items ++;
					}

				}

				//ne_testing purpose only.. remove beore PR.
				if ( isset( $_SERVER['HTTP_REFERER'] ) ) {
					$total_rows = explode( 'rows=', $_SERVER['HTTP_REFERER'] ); //phpcs:ignore
				}
				$total_rows = isset ( $total_rows[1] ) ? (int) $total_rows[1] - 1 : 10000;

				foreach ( $master_array as $item_mys_id => $item ) {

					$item_status = $this->session_modified_array[ $item_mys_id ];

					switch ( $item_status ) {

						case "Deleted":
							$item_status_int = 0;
							break;

						case "Added":
							$item_status_int = 1;
							break;

						case "Updated":
							$item_status_int = 2;
							break;

					}

					if ( "sessions" !== $current_request && 0 === $item_status_int ) {
						continue;
					}

					$single_item_json = wp_json_encode( $item );
					$single_item_json = str_replace( "'", "\'", $single_item_json );

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
						'DataStartTime' => date( 'Y-m-d H:i:s' ),
						'DataJson'      => $single_item_json
					);

					if ( $total_rows === $total_items_inserted ) {
						break;
					}

					$total_items_inserted ++;

				}

				global $wpdb;

				$this->nab_mys_db_bulk_insert( $wpdb->prefix . 'mys_data', $rows );

				$total_counts = $affected_items;

				//Insert entry in wp_mys_api_history
				$this->nab_mys_db_history_data( $current_request, "update", $this->group_id, 1, $total_counts );

				$sequence_completes = 0;

				if ( "sessions" !== $current_request && "restapi" === $flow ) {
					// Check total 4 records (sessions/tracks/speakers/sponsors) with HistoryStatus = 1 and HistoryGroupID = $this->group_id are available or not.
					// If yes, it means CRON sequence is now completed successfully.

					$completed_data = $wpdb->get_results(
						$wpdb->prepare(
							"SELECT HistoryID FROM {$wpdb->prefix}mys_history
						WHERE HistoryStatus = '1'
						AND HistoryGroupID = '%s'", $this->group_id )
					); //db call ok; no-cache ok

					if ( 4 <= count( $completed_data ) ) {
						$sequence_completes = 1;
					}

				} else if ( "sponsors" === $current_request && "wpajax" === $flow ) {
					// If its AJAX call, and sponsors request, sequence is now completed successfully.
					$sequence_completes = 1;
				}

				if ( 1 === $sequence_completes ) {
					$this->nab_mys_db_history_data( "modified-sessions", "update", $this->group_id, 1, 'nochange' );
					delete_option( 'modified_sessions_' . $this->group_id );
					update_option( 'mys_data_attempt', 0 );

					return array( 'total_counts' => $total_counts, 'status' => 'done', 'total_item_statuses' => $total_item_statuses );

				}

			}

			return array( 'total_counts' => $total_counts, 'status' => true, 'total_item_statuses' => $total_item_statuses );
		}

		public function nab_mys_db_check_lock( $group_id ) {

			global $wpdb;

			$pending_data = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT * FROM {$wpdb->prefix}mys_history
							WHERE HistoryStatus = '0'
							AND HistoryGroupID != %s
							AND HistoryDataType NOT LIKE '%modified-exhibitors%'"
					, $group_id )
			); //db call ok; no-cache ok

			// Equal to 1, there is a modified-sessions row with 0 status in the History table, which means lock is open for current request only if thre request type is not 1.
			if ( count( $pending_data ) > 0 ) {

				$mys_data_attempt = get_option( 'mys_data_attempt' );

				$mys_data_attempt = isset( $mys_data_attempt ) ? $mys_data_attempt + 1 : 1;

				update_option( 'mys_data_attempt', $mys_data_attempt );

				if ( $mys_data_attempt >= 3 ) {
					// send email..

				}

				return count( $pending_data );

			} else {

				return "open";

			}
		}

		public function nab_mys_cron_master_tracks( $data_to_migrate ) {

			$data      = $data_to_migrate['data'];
			$item      = $data_to_migrate['item'];
			$sessionid = $data_to_migrate['main_mys_value'];

			echo '1';

			/**
			 * 0 - Deleted (This type will only available in Sessions)
			 * 1 - Added
			 * 2 - Updated
			 */
			$item_status = (int) $item->ItemStatus;

			//reset all tracks of $sessionid
			//now get session post ID from sessionid
			//and assign the term
			$assigned_session = '';

			echo '2';

			$session_post_id = $this->nab_mys_cron_get_postid_from_meta( 'sessions', 'sessionid', $sessionid );

			echo '3';

			/**
			 * @todo
			 * Add new session if not available
			 */

			$track_post_ids = array();

			$return_detail = '';

			foreach ( $data as $track ) {

				echo '4-inarray';

				$title       = $track['title'];
				$description = $track['description'];
				$image_url   = $track['icon'];
				$trackid     = $track['trackid'];

				//get tracks wp id from trackid of mys
				$args  = array(
					'hide_empty' => false, // also retrieve terms which are not used yet
					'meta_query' => array(
						array(
							'key'   => 'trackid',
							'value' => $trackid
						)
					),
					'taxonomy'   => 'tracks',
				);
				$terms = get_terms( $args );

				if ( $terms[0]->term_id && 2 === $item_status ) {

					// update term if sesionid status is modify

					$track_post_id = $terms[0]->term_id;

					wp_update_term( $track_post_id, 'tracks', array(
						'name' => $title,
						array(
							'description' => $description
						)
					) );

					$return_detail .= "old";

				} else if ( ! isset( $terms[0] ) ) {

					// insert new term if not already available

					$track_post_id = wp_insert_term(
						$title,
						"tracks",
						array(
							'description' => $description
						)
					);

					//Term already available on this point, then use it.
					if ( isset( $track_post_id->error_data['term_exists'] ) ) {
						$track_post_id = $track_post_id->error_data['term_exists'];
						$return_detail .= "old";
					} else {
						$track_post_id = $track_post_id['term_id'];
						$return_detail .= "new";
					}

					//insert term meta
					update_term_meta( $track_post_id, 'trackid', $trackid );
				}

				// Upload image if (1) item was new and added status was new OR (2) Item needs to be updated
				if ( ( ! isset( $terms[0] ) && 1 === $item_status ) || 2 === $item_status ) {

					//Upload Third Party Image to WP Media Library
					$attach_id = $this->nab_mys_media->nab_mys_upload_media( $track_post_id, $image_url, "tracks" );

				}
				$track_post_ids[] = $track_post_id;

				$return_detail .= "-track-$track_post_id|";

				if ( $attach_id ) {
					$return_detail .= "-attach_id_$attach_id|";
				}

			}

			echo '5';

			if ( isset( $session_post_id ) && '' !== $session_post_id ) {

				$assigned_session .= $session_post_id;

				wp_set_post_terms( $session_post_id, $track_post_ids, 'tracks' );

				$track_post_ids = implode( $track_post_ids, ',' );

			} else {
				// session not exist

				$assigned_session .= "|not-found-sessionid-$sessionid";
			}

			if ( count( $track_post_ids ) !== 0 ) {
				$return_detail .= "to_session-$assigned_session";
			} else {
				$return_detail .= $assigned_session;
			}

			echo '6';

			$this->nab_mys_cron_master_confirmed( $item->DataID );

			echo '7-return';

			return $return_detail;
		}

	}
}
