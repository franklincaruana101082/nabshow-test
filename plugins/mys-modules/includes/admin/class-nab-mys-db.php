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

//Class File - Media
require_once WP_PLUGIN_DIR . '/mys-modules/includes/admin/class-nab-mys-media.php';

if ( ! class_exists( 'NAB_MYS_DB' ) ) {

	class NAB_MYS_DB {

		private $data_array;

		private $data_json = "";

		private $group_id = "";

		private $current_request;

		private $history_id;

		private $session_modified_array;

		private $nab_mys_media;

		/**
		 * Class Constructor
		 */
		public function __construct() {

			//Create Custom DB Tables if not alread created
			$this->nab_mys_db_create_custom_tables();

			$this->nab_mys_media = new NAB_MYS_MEDIA();

		}

		/**
		 * Create Custom DB Tables if not alread created
		 *
		 * @package MYS Modules
		 * @since   1.0.0
		 */
		public function nab_mys_db_create_custom_tables() {

			global $wpdb;

			$charset_collate = $wpdb->get_charset_collate();

			$history_table_name = $wpdb->prefix . 'mys_history';
			$history_table_sql  = "CREATE TABLE $history_table_name (
	          HistoryID int(11) unsigned NOT NULL AUTO_INCREMENT,
	          HistoryGroupID varchar(20) NOT NULL,
	          HistoryStatus int(11) unsigned NOT NULL,
	          HistoryMigrationType int(11) unsigned NOT NULL,
	          HistoryDataType varchar(50) NOT NULL,
	          HistoryStartTime datetime NOT NULL,
	          HistoryEndTime datetime NOT NULL,
	          HistoryData longtext NOT NULL,
	          PRIMARY KEY  (HistoryID),
	          INDEX HistoryID (HistoryID),
	          INDEX HistoryGroupID (HistoryGroupID),
			  INDEX HistoryStatus (HistoryStatus),
			  INDEX HistoryMigrationType (HistoryMigrationType),
			  INDEX HistoryDataType (HistoryDataType)
     		) $charset_collate;";

			$data_table_name = $wpdb->prefix . 'mys_data';
			$data_table_sql  = "CREATE TABLE $data_table_name (
	          DataID int(11) unsigned NOT NULL AUTO_INCREMENT,
	          HistoryID int(11) unsigned NOT NULL,
	          DataGroupID varchar(20) NOT NULL,
	          AddedStatus int(11) unsigned NOT NULL,
	          ItemStatus int(11) unsigned NOT NULL,
	          DataType varchar(50) NOT NULL,
	          ModifiedID int(11) unsigned NOT NULL,
	          DataStartTime datetime NOT NULL,
	          DataEndTime datetime NOT NULL,
	          DataJson longtext NOT NULL,
	          PRIMARY KEY (DataID),
	          INDEX DataID (DataID),
	          INDEX HistoryID (HistoryID),
	          INDEX DataGroupID (DataGroupID),
			  INDEX AddedStatus (AddedStatus),
			  INDEX ItemStatus (ItemStatus),
			  INDEX ModifiedID (ModifiedID)
     		) $charset_collate;";

			include_once ABSPATH . 'wp-admin/includes/upgrade.php';

			dbDelta( $history_table_sql ); //phpcs:ignore
			dbDelta( $data_table_sql ); //phpcs:ignore
			//@todo remove above comment before creating PR
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
			$this->data_array      = $data;
			$this->data_json       = wp_json_encode( $data );

			if ( "modified-sessions" === $current_request ) {

				$session_modified_array = $data[0]->sessions;

				if ( 0 === count( $session_modified_array ) ) {

					$this->nab_mys_db_history_data( "modified-sessions", "update", $this->group_id, 1 );

					return false;

				} else {

					//simplifiying modified array to make easy execution.
					$this->session_modified_array = array();
					foreach ( $session_modified_array as $single_modified ) {
						$this->session_modified_array[ $single_modified->sessionid ] = $single_modified->sessionstatus;
					}
					update_option( 'modified_sessions_' . $this->group_id, $this->session_modified_array );
					$this->nab_mys_db_history_data( "modified-sessions", "update", $this->group_id );

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
					return false;
				}

				$rows = $master_array = array();

				foreach ( $all_items as $item ) {

					//Tracks
					if ( "tracks" === $current_request ) {
						$item_sessions_array = isset( $item->sessions ) ? $item->sessions : "";

						foreach ( $item_sessions_array as $session ) {


							//ne_test remove ! sign
							if ( array_key_exists( $session->sessionid, $this->session_modified_array ) ) {

								$item_session_id = $session->sessionid;

								$item_to_add = $item;
								unset( $item_to_add->sessions );

								$master_array[ $session->sessionid ][] = $item_to_add;

							}
						}

					} else {
						$item_session_id = isset( $item->sessionid ) ? $item->sessionid : "";
						$item_session_id = isset( $item->schedules[0]->sessionid ) ? $item->schedules[0]->sessionid : $item_session_id;


						//ne_test remove comment from  condition


						if ( array_key_exists( $item_session_id, $this->session_modified_array ) ) {
							$item_to_add = $item;
							if ( isset ( $item_to_add->schedules ) ) {
								unset( $item_to_add->schedules );
							}
							$master_array[ $item_session_id ][] = $item_to_add;
						}
					}


				}

				//ne_testing purpose only.. remove beore PR.
				$total_rows = explode( 'rows=', $_SERVER['HTTP_REFERER'] ); //phpcs:ignore
				$total_rows = isset ( $total_rows[1] ) ? (int) $total_rows[1] - 1 : 10000;

				foreach ( $master_array as $item_session_id => $item ) {

					$item_status = $this->session_modified_array[ $item_session_id ];

					$single_item_json = wp_json_encode( $item );
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
						'ModifiedID'    => $item_session_id,
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

				//Insert entry in wp_mys_api_history
				$this->nab_mys_db_history_data( $current_request, "update", $this->group_id, 1 );

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
					$this->nab_mys_db_history_data( "modified-sessions", "update", $this->group_id, 1 );
					delete_option( 'modified_sessions_' . $this->group_id );
					update_option( 'mys_data_attempt', 0 );

					return "done";
				}

			}

			return true;
		}

		/**
		 * Bulk inserts records into a table using WPDB.  All rows must contain the same keys.
		 *
		 * @param string $table Table name
		 * @param array $rows Individual Full Data for Session/Speakers/etc.
		 *
		 * @return int Returns number of affected (inserted) rows.
		 */
		public function nab_mys_db_bulk_insert( $table, $rows ) {

			global $wpdb;

			// Extract column list from first row of data
			if ( count( $rows ) > 0 ) {

				$columns = array_keys( $rows[0] );

				asort( $columns );
				$columnList = '`' . implode( '`, `', $columns ) . '`';
				// Start building SQL, initialise data and placeholder arrays
				$query = "INSERT INTO `$table` ($columnList) VALUES\n";

				$placeholders = array();
				$data         = array();
				// Build placeholders for each row, and add values to data array
				foreach ( $rows as $row ) {
					ksort( $row );
					$rowPlaceholders = array();
					foreach ( $row as $value ) {
						$data[]            = $value;
						$rowPlaceholders[] = is_numeric( $value ) ? '%d' : '%s';
					}
					$placeholders[] = '(' . implode( ', ', $rowPlaceholders ) . ')';
				}
				// Stitch all rows together
				$query .= implode( ",\n", $placeholders );

				$result = $wpdb->query( $wpdb->prepare( $query, $data ) ); //phpcs:ignore

				return $result;
			}
		}

		/**
		 * Insert/Update MYS History Table.
		 *
		 * @param string $current_request Session/Speakers/etc.
		 * @param string $query_type "insert" or "update"
		 * @param string $group_id a unique Group ID used in whole process.
		 *
		 * @return false|int returns inserted ID or record update status
		 */
		public function nab_mys_db_history_data( $current_request, $query_type, $group_id, $history_status = 0, $flow = null ) {

			global $wpdb;

			$request_type = ( "restapi" === $flow ) ? 1 : 2;

			//This will have same value in each cron.
			$this->group_id = $group_id;


			if ( "insert" === $query_type ) {

				$sql = $wpdb->insert(
					$wpdb->prefix . 'mys_history', array(
					'HistoryStatus'        => 0,
					'HistoryGroupID'       => $this->group_id,
					'HistoryMigrationType' => $request_type,
					'HistoryDataType'      => $current_request,
					'HistoryStartTime'     => date( 'Y-m-d H:i:s' )
				), array( '%d', '%s', '%d', '%s', '%s' )
				); //db call ok; no-cache ok

				return $wpdb->insert_id;

			} else {

				$sql = $wpdb->update(
					$wpdb->prefix . 'mys_history', array(
					'HistoryEndTime' => date( 'Y-m-d H:i:s' ),
					'HistoryStatus'  => $history_status,
					'HistoryData'    => $this->data_json
				), array(
						'HistoryGroupID'  => $this->group_id,
						'HistoryDataType' => $current_request,
					)
				); //db call ok; no-cache ok

				return $sql;
			}

		}

		public function nab_mys_db_check_lock( $group_id ) {

			global $wpdb;

			$pending_data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}mys_history WHERE HistoryStatus = '0'" ); //db call ok; no-cache ok

			// Equal to 1, there is a modified-sessions row with 0 status in the History table, which means lock is open for current request only if thre request type is not 1.
			if ( count( $pending_data ) > 0 && $group_id !== $pending_data[0]->HistoryGroupID ) {

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

		/**
		 * CRON: Migration from Custom to Master
		 *
		 * @param int $limit the limit of rows to migrate in single call.
		 *
		 * @return array    List of DataID -> PostID
		 *         string   Message to show that No more data available to migrate.
		 */
		public function nab_mys_corn_migrate_data( $limit, $dataids, $groupid ) {

			global $wpdb;

			//ne_temp REMOVE $dataids parameter and below code as it was just for testing.
			if ( ! empty( $dataids ) ) {
				$where_clause = "DataID IN ($dataids)";
			} else if ( ! empty( $groupid ) ) {
				$where_clause = "DataGroupID = '$groupid'";
			} else {
				$where_clause = "AddedStatus = 0";
			}

			$data_to_migrate = $wpdb->get_results(
				$wpdb->prepare( "SELECT * FROM {$wpdb->prefix}mys_data WHERE {$where_clause} ORDER BY DataID ASC LIMIT %d", $limit ) //phpcs:ignore
			); //db call ok; no-cache ok


			if ( count( $data_to_migrate ) > 0 ) {
				$result = $this->nab_mys_cron_master_flow( $data_to_migrate );
			} else {
				$result = "All data migrated successfully to the master table.";
			}

			return $result;
		}

		/**
		 * Separating the migration flow according to the type of data.
		 *
		 * @param array $data_to_migrate the data to migrate.
		 *
		 * @return array List of DataID -> PostID
		 */
		public function nab_mys_cron_master_flow( $data_to_migrate ) {

			$result = array();

			foreach ( $data_to_migrate as $item ) {

				$data_id   = $item->DataID;
				$data_type = $item->DataType;
				$sessionid = $item->ModifiedID;
				$data_json = str_replace( "\'", "'", $item->DataJson );
				$data      = json_decode( $data_json, true );

				$prepared_data         = array();
				$prepared_data['item'] = $item;

				switch ( $data_type ) {
					case 'sessions':

						$prepared_data['post_type']         = 'sessions';
						$prepared_data['exclude_from_meta'] = array( 'title', 'description' );
						$prepared_data['typeidname']        = 'sessionid';
						$prepared_data['sessionid']         = $sessionid;
						$prepared_data['data']              = $data;

						$prepared_data['title_name']       = 'title';
						$prepared_data['description_name'] = 'description';
						$prepared_data['image_name']       = 'image';

						$result[ "DataID-" . $data_id ] = $this->nab_mys_cron_insert_to_master( $prepared_data );
						break;

					case 'tracks':

						$prepared_data['post_type']         = 'tracks';
						$prepared_data['exclude_from_meta'] = array( 'title', 'description' );
						$prepared_data['sessionid']         = $sessionid;
						$prepared_data['data']              = $data;
						$prepared_data['typeidname']        = 'trackid';

						$result[ "DataID-" . $data_id ] = $this->nab_mys_cron_master_tracks( $prepared_data );


						break;

					case 'speakers':

						$prepared_data['post_type']         = 'speakers';
						$prepared_data['exclude_from_meta'] = array( 'firstname', 'lastname', 'bio', 'photo' );
						$prepared_data['typeidname']        = 'speakerid';
						$prepared_data['sessionid']         = $sessionid;
						$prepared_data['data']              = $data;

						$prepared_data['title_name']       = 'firstname';
						$prepared_data['description_name'] = 'bio';
						$prepared_data['image_name']       = 'photo';

						$result[ "DataID-" . $data_id ] = $this->nab_mys_cron_insert_to_master( $prepared_data );
						break;

					case 'sponsors':

						$prepared_data['post_type']         = 'sponsors';
						$prepared_data['exclude_from_meta'] = array( 'sponsorname', 'logo' );
						$prepared_data['typeidname']        = 'sponsorid';
						$prepared_data['sessionid']         = $sessionid;
						$prepared_data['data']              = $data;

						$prepared_data['title_name']       = 'sponsorname';
						$prepared_data['description_name'] = '';
						$prepared_data['image_name']       = 'logo';

						$result[ "DataID-" . $data_id ] = $this->nab_mys_cron_insert_to_master( $prepared_data );
						break;
				}


			}

			return $result;
		}

		/**
		 * CRON: Migration from Custom table to Master table.
		 *
		 * @param array $prepared_data Required data for migration.
		 *
		 * @return string Dispalys the status of the migration with migrated IDs in the form of DataID -> PostID.
		 */
		public function nab_mys_cron_insert_to_master( $prepared_data ) {

			$data              = $prepared_data['data'];
			$item              = $prepared_data['item'];
			$post_type         = $prepared_data['post_type'];
			$exclude_from_meta = $prepared_data['exclude_from_meta'];
			$sessionid         = $prepared_data['sessionid'];
			$typeidname        = $prepared_data['typeidname'];


			$title_name       = $prepared_data['title_name'];
			$description_name = $prepared_data['description_name'];
			$image_name       = $prepared_data['image_name'];


			/**
			 * 0 - Deleted (This type will only available in Sessions)
			 * 1 - Added
			 * 2 - Updated
			 */
			$item_status = (int) $item->ItemStatus;

			$post_detail                 = '';
			$post_ids_to_save_in_session = '';

			foreach ( $data as $individual_item ) {

				if ( "firstname" === $title_name ) {
					$title = $individual_item['firstname'] . ' ' . $individual_item['lastname'];
				} else {
					$title = $individual_item[ $title_name ];
				}
				$description = ( '' !== $description_name ) ? $individual_item[ $description_name ] : '';
				$image       = $individual_item[ $image_name ];
				$typeid      = $individual_item[ $typeidname ];

				//If session status is not to "delete", get exisitng Post ID
				if ( 0 !== $item_status ) {
					$args = array(
						'post_type'  => array( $post_type ),
						'meta_query' => array(
							array(
								'key'   => $typeidname,
								'value' => $typeid,
							),
						),
					);

					//The Query
					$already_available = new WP_Query( $args );

					if ( isset( $already_available->posts[0]->ID ) ) {
						$already_available_id = $already_available->posts[0]->ID;
					}

					// Restore original Post Data
					wp_reset_postdata();
				}

				if ( 0 === $item_status ) {
					// This is for sessions only

					if ( isset( $already_available_id ) ) {

						$update_post_id = $already_available_id;
						wp_trash_post( $update_post_id );

						$post_detail .= "trash-$post_type-" . $update_post_id;
					}

				} else {

					// session to add, so tracks maybe already there, if yes, no need to update them; if no, add them but..
					// session to update, so tracks should be checked if available, if yes, update them otherwise add them.

					//Item may Already Available
					if ( isset( $already_available_id ) && 2 === $item_status ) {

						$update_post_id = $already_available_id;

						$update_post = array(
							'ID'           => $update_post_id,
							'post_title'   => "crontest-" . $title,
							'post_content' => $description,
							'post_author'  => 1,
							'post_status'  => 'publish',
						);

						$post_id = wp_update_post( $update_post );

						foreach ( $individual_item as $name => $value ) {
							if ( ! in_array( $name, $exclude_from_meta, true ) ) {
								update_post_meta( $update_post_id, $name, $value );
							}
						}

						if ( "sessions" === $post_type ) {
							update_post_meta( $update_post_id, 'sessionid', $sessionid );
						}

						$post_detail .= "update-$post_type-" . $post_id;

					} else if ( ! isset( $already_available_id ) ) {
						//NEW

						$post_id = wp_insert_post(
							array(
								'post_title'   => "crontest-" . $title,
								'post_type'    => $post_type,
								'post_content' => $description,
								'post_author'  => 1, /*ne_change the author id*/
								'post_status'  => 'publish',
							)
						);

						if ( $post_id ) {
							// insert post meta
							foreach ( $individual_item as $name => $value ) {
								if ( ! in_array( $name, $exclude_from_meta, true ) ) {
									add_post_meta( $post_id, $name, $value );
								}
							}
							update_post_meta( $post_id, 'sessionid', $sessionid );
						}

						$post_detail .= "new-$post_type-" . $post_id;
					}

					// Upload image if (1) item was new and added status was new OR (2) Item needs to be updated
					if ( ( ! isset( $already_available_id ) && 1 === $item_status ) || 2 === $item_status ) {

						/**
						 * This is a dummy third party image array for testing.
						 */
						$image_url_array = array(
							'https://thumbs.dreamstime.com/z/tragic-actor-theater-stage-man-medieval-suit-retro-cartoon-character-design-vector-illustration-77130060.jpg',
							'http://1.bp.blogspot.com/_Nyiipr-yxiQ/TRwwhhYxv1I/AAAAAAAAOo0/FrI3FQno2M0/s400/Cartoon_voice_actors_05.jpg',
							'https://image.shutterstock.com/image-photo/beautiful-water-drop-on-dandelion-260nw-789676552.jpg',
							'https://image.shutterstock.com/image-photo/white-transparent-leaf-on-mirror-260nw-577160911.jpg',
							'https://helpx.adobe.com/content/dam/help/en/stock/how-to/visual-reverse-image-search/jcr_content/main-pars/image/visual-reverse-image-search-v2_intro.jpg',
							'http://wallperio.com/data/out/184/images_605127984.jpg'
						);

						$random_image_key = array_rand( $image_url_array );
						$image_url        = $image_url_array[ $random_image_key ];


						//Upload Third Party Image to WP Media Library
						$attach_id = $this->nab_mys_media->nab_mys_upload_media( $post_id, $image_url, $post_type );

						$post_detail .= '-attach_id-' . $attach_id;
					}

				}

				//Save taxonomies.
				if ( "sessions" === $post_type ) {

					$level = $individual_item['level'];
					if ( "" !== $level ) {
						$post_detail .= $this->nab_mys_cron_assign_single_term_by_name( $level, "session-levels", $post_id );
					}

					$type = $individual_item['type'];
					if ( "" !== $type ) {
						$post_detail .= $this->nab_mys_cron_assign_single_term_by_name( $type, "session-types", $post_id );
					}

				} else if ( "speakers" === $post_type ) {

					$company = $individual_item['company'];
					if ( "" !== $company ) {
						$post_detail .= $this->nab_mys_cron_assign_single_term_by_name( $company, "speaker-companies", $post_id );
					}

				}

				$post_ids_to_save_in_session .= $post_id . ',';
				$post_detail                 .= '|';

			}

			if ( "sessions" !== $post_type ) {
				$post_ids_to_save_in_session = rtrim( $post_ids_to_save_in_session, ',' );

				// Reseting sessions meta where (speaker/sponsors) are comma separated and adding new ids.
				$session_post_id = $this->nab_mys_cron_get_session_postid( $sessionid );
				update_post_meta( $session_post_id, $post_type, $post_ids_to_save_in_session );

				if ( '' !== $session_post_id ) {
					$post_detail .= "to_session-$session_post_id";
				} else {
					$post_detail .= "not-found-sessionid-$sessionid";
				}
			}


			//$this->nab_mys_cron_master_confirmed( $item->DataID );


			return $post_detail;
		}

		/**
		 * Update AddedStatus from 0 to 1 after migration process completes.
		 *
		 * @param int $data_id Primary Key of the wp_mys_data table.
		 *
		 * @return bool|false|int The status of the update query.
		 */
		public function nab_mys_cron_master_confirmed( $data_id ) {

			global $wpdb;

			$update_status = $wpdb->query(
				$wpdb->prepare( "UPDATE {$wpdb->prefix}mys_data SET AddedStatus = %d WHERE DataID = %d", 1, $data_id )
			); //db call ok; no-cache ok @todo remove all these type of comments before creating PR

			return $update_status;
		}


		public function nab_mys_cron_assign_single_term_by_name( $title, $taxonomy, $post_id ) {


			$post_detail = '';

			//Check if same name available
			$existing_term_data = get_term_by( 'name', $title, $taxonomy );

			$post_detail .= "|assigned-term-";

			if ( isset( $existing_term_data->term_id ) ) {

				//if yes, get its id and assign to $session_post_id
				$term_post_id = $existing_term_data->term_id;
				$post_detail  .= "old";

			} else {
				// insert new term if not already available

				$term_id_data = wp_insert_term(
					$title,
					$taxonomy
				);

				//Term already available on this point, then use it.
				if ( isset( $term_id_data->error_data['term_exists'] ) ) {
					$term_post_id = $term_id_data->error_data['term_exists'];
					$post_detail  .= "old";
				} else {
					$term_post_id = $term_id_data['term_id'];
					$post_detail  .= "new";
				}

			}
			$post_detail .= "-$term_post_id|";

			//rememebter to flush existing one before assigning
			wp_set_post_terms( $post_id, $term_post_id, $taxonomy );

			return $post_detail;
		}

		public function nab_mys_cron_master_tracks( $data_to_migrate ) {

			$data      = $data_to_migrate['data'];
			$item      = $data_to_migrate['item'];
			$sessionid = $data_to_migrate['sessionid'];

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

			$session_post_id = $this->nab_mys_cron_get_session_postid( $sessionid );

			/**
			 * @todo
			 * Add new session if not available
			 */

			$track_post_ids = array();

			$return_detail = '';

			foreach ( $data as $track ) {

				$title       = $track['title'];
				$description = $track['description'];
				$icon        = $track['icon'];
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

					/**
					 * This is a dummy third party image array for testing.
					 */
					$image_url_array = array(
						'https://thumbs.dreamstime.com/z/tragic-actor-theater-stage-man-medieval-suit-retro-cartoon-character-design-vector-illustration-77130060.jpg',
						'http://1.bp.blogspot.com/_Nyiipr-yxiQ/TRwwhhYxv1I/AAAAAAAAOo0/FrI3FQno2M0/s400/Cartoon_voice_actors_05.jpg',
						'https://image.shutterstock.com/image-photo/beautiful-water-drop-on-dandelion-260nw-789676552.jpg',
						'https://image.shutterstock.com/image-photo/white-transparent-leaf-on-mirror-260nw-577160911.jpg',
						'https://helpx.adobe.com/content/dam/help/en/stock/how-to/visual-reverse-image-search/jcr_content/main-pars/image/visual-reverse-image-search-v2_intro.jpg',
						'http://wallperio.com/data/out/184/images_605127984.jpg'
					);

					$random_image_key = array_rand( $image_url_array );
					$image_url        = $image_url_array[ $random_image_key ];


					//Upload Third Party Image to WP Media Library
					$attach_id = $this->nab_mys_media->nab_mys_upload_media( $track_post_id, $image_url, "tracks" );

				}
				$track_post_ids[] = $track_post_id;

				$return_detail .= "-track-$track_post_id|";

				if ( $attach_id ) {
					$return_detail .= "-attach_id_$attach_id|";
				}

			}

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


			//$this->nab_mys_cron_master_confirmed( $item->DataID );

			return $return_detail;
		}

		public function nab_mys_cron_get_session_postid( $sessionid ) {

			$session_post_id = '';

			// WP_Query arguments
			$args = array(
				'post_type'  => array( "sessions" ),
				'meta_query' => array(
					array(
						'key'   => "sessionid",
						'value' => $sessionid,
					),
				),
			);

			//The Query
			$session_post = new WP_Query( $args );
			if ( isset( $session_post->posts[0]->ID ) ) {
				$session_post_id = $session_post->posts[0]->ID;
			}

			// Restore original Post Data
			wp_reset_postdata();

			return $session_post_id;

		}

		public function nab_mys_cron_get_latest_groupid( $requested_for ) {

			global $wpdb;

			$pending_data = $wpdb->get_results(
				"SELECT HistoryGroupID FROM {$wpdb->prefix}mys_history
						WHERE HistoryStatus = '0'
						AND HistoryDataType = 'modified-sessions'
						ORDER BY HistoryID
						DESC LIMIT 1
						"
			); //db call ok; no-cache ok

			if ( 0 === count( $pending_data ) ) {
				return 0;
			}

			$group_id = $pending_data[0]->HistoryGroupID;

			$exist_data = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT HistoryID FROM {$wpdb->prefix}mys_history
						WHERE HistoryDataType = '%s'
						AND HistoryGroupID = '%s'",
					$requested_for, $group_id ) ); //db call ok; no-cache ok

			if ( 0 === count( $exist_data ) ) {

				return $group_id;

			} else {

				return 1;

			}

		}
	}
}
