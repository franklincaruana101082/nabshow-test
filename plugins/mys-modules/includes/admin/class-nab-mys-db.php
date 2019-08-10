<?php
/**
 * DataBase Queries Class
 *
 * @package MYS Modules
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

//Class File - Media
require_once( MYS_PLUGIN_DIR . '/includes/admin/class-nab-mys-media.php' );

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
			$this->nab_mys_create_custom_tables();

			$this->nab_mys_media = new NAB_MYS_MEDIA();

		}

		/**
		 * Create Custom DB Tables if not alread created
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_create_custom_tables() {

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

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

			dbDelta( $history_table_sql ); //phpcs:ignore
			dbDelta( $data_table_sql ); //phpcs:ignore
		}

		/**
		 * Insert MYS API Data in the Database.
		 *
		 * @param string $current_request MYS API Data Requested For: Sessions / Speakers / Exhibitors / etc.
		 * @param array|mixed|object $data Response Body from MYS API
		 *
		 * @return string
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		public function nab_mys_insert_data( $current_request, $data, $history_id ) {

			$this->current_request = $current_request;
			$this->history_id      = $history_id;
			$this->data_array      = $data;
			$this->data_json       = wp_json_encode( $data );
			//ne_quetion => use below?
			//$this->data_json = str_replace( "'", "\'", $this->data_json);

			//Insert entry in wp_mys_api_history
			$history_insertion_status = $this->nab_mys_update_history_data( $current_request, "update", $this->group_id ); //ne_info here passing parameters is meaning less

			if ( "modified-sessions" === $current_request ) {

				//make actions...

				$session_modified_array = $data[0]->sessions;

				//simplifiying modified array to make easy execution.
				$this->session_modified_array = array();
				foreach ( $session_modified_array as $single_modified ) {
					$this->session_modified_array[ $single_modified->sessionid ] = $single_modified->sessionstatus;
				}

				update_option( 'modified_sessions_' . $this->group_id, $this->session_modified_array );

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

					case "speakers":
						$all_items = $data[0]->speakers;
						break;
				}

				//check which session ids from $data are available in $this->session_modified_array
				$total_items_inserted = 0;
				$insertion_values     = '';

				$session_modified_array = $this->session_modified_array = get_option( 'modified_sessions_' . $this->group_id );

				delete_option( 'modified_sessions_' . $this->group_id );

				global $wpdb;

				foreach ( $all_items as $item ) {

					$item_session_id = isset ( $item->sessionid ) ? $item->sessionid : "";
					$item_session_id = isset ( $item->schedules[0]->sessionid ) ? $item->schedules[0]->sessionid : $item_session_id;

					if ( array_key_exists( $item_session_id, $this->session_modified_array ) ) {

						//Insert the $item_session_id
						$item_status = $this->session_modified_array[ $item_session_id ];

						//$inserted = $this->nab_mys_update_custom_table( $item, $item_status, $item_session_id );
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

						if ( 2 === $total_items_inserted ) {
							break;
						}

						$total_items_inserted ++;
					}
				}

				$inserted_ids = $this->nab_mys_wpdb_bulk_insert( 'wp_mys_data', $rows );
			}

			return true;
		}

		// Bulk inserts records into a table using WPDB.  All rows must contain the same keys.
		// Returns number of affected (inserted) rows.
		public function nab_mys_wpdb_bulk_insert( $table, $rows ) {
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
					foreach ( $row as $key => $value ) {
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
		 * @return int status of the query
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		public function nab_mys_update_history_data( $current_request, $query_type, $group_id ) {

			global $wpdb;

			//This will have same value in each cron.
			$this->group_id = $group_id;


			if ( "insert" === $query_type ) {

				$sql = $wpdb->insert( $wpdb->prefix . 'mys_history', array(
					'HistoryStatus'        => 0,
					'HistoryGroupID'       => $this->group_id,
					'HistoryMigrationType' => 1,
					'HistoryDataType'      => $current_request,
					'HistoryStartTime'     => date( 'Y-m-d H:i:s' )
				), array( '%d', '%s', '%d', '%s', '%s' ) );

				return $wpdb->insert_id;

			} else {


				/*if( "speakers" === $current_request ) {
					echo $this->data_json;

					$this->data_json = str_replace( "'", "\'", $this->data_json );
					echo "\n\n\n";

					echo $this->data_json;

					die;
				}

				$this->data_json = "testing faisal";*/

				if ( "speakers" === $current_request ) {
					//$this->data_json = "testing faisal";
				}
				$sql = $wpdb->update( $wpdb->prefix . 'mys_history', array(
					/*'HistoryStatus'  => 1,*/
					'HistoryEndTime' => date( 'Y-m-d H:i:s' ),
					'HistoryData'    => $this->data_json
				), array( 'HistoryID' => $this->history_id ) );


				if ( "speakers" === $current_request ) {
//				if( "sessions" === $current_request ) {

					echo '<pre>';
					print_r( get_defined_vars() );
					die( '<br><---died here' );
				}

				return $sql;
			}

			//SQL Operation Status
			/*if ( $sql ) {
				return $wpdb->insert_id;
			} else {
				return false;
			}*/
		}

		/**
		 * Update MYS History with Success Flag.
		 *
		 * @return int status of update query
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		public function nab_mys_update_history_status( $status ) {

			global $wpdb;

			$sql = $wpdb->update( $wpdb->prefix . 'mys_history', array(
				'HistoryStatus' => $status
			), array( 'HistoryID' => $this->history_id ) );

			return $sql;

		}

		public function nab_mys_migrate_data( $limit ) {

			global $wpdb;

			$data_to_migrate = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM wp_mys_data WHERE AddedStatus = 0 ORDER BY DataID ASC LIMIT %d", $limit ) );

			if ( count( $data_to_migrate ) > 0 ) {
				$result = $this->nab_mys_insert_to_master( $data_to_migrate );
			} else {
				$result = "All data migrated successfully to the master table.";
			}


			return $result;

		}

		public function nab_mys_insert_to_master( $data_to_migrate ) {

			$result = array();

			foreach ( $data_to_migrate as $item ) {

				$data_id   = $item->DataID;
				$data_type = $item->DataType;

				switch ( $data_type ) {
					case 'sessions':
						$result[ "DataID-" . $data_id ] = $this->nab_mys_master_sessions( $item );
						break;

					case 'speakers':
						$result[ "DataID-" . $data_id ] = $this->nab_mys_master_speakers( $item );
						break;
				}
			}

			return $result;

		}

		public function nab_mys_master_sessions( $item ) {

			$data_json = str_replace( "\'", "'", $item->DataJson );
			$data      = json_decode( $data_json, true );

			$default_fields = array(
				'title',
				'description'
			);

			$title                = $data['title'];
			$description          = $data['description'];
			//$image_url            = $data['image_url'];
			$sessionid            = $data['sessionid'];
			$sessionid_meta_value = "session#" . $sessionid;
			$data['sessionid']    = $sessionid_meta_value;

			/**
			 * 0 - Deleted
			 * 1 - Added
			 * 2 - Updated
			 */
			$item_status = $item->ItemStatus;

			global $wpdb;

			$already_available_id = $wpdb->get_col( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'sessionid' AND meta_value = %s", $sessionid_meta_value ) );

			/*if ( isset( $already_available_id[0] ) && "2973" === $already_available_id[0] ) {
				$item_status = 0;
			}*/

			if ( 0 === $item_status ) {

				if ( isset( $already_available_id[0] ) ) {

					$update_post_id = $already_available_id[0];
					wp_trash_post( $update_post_id ); //or use wp_delete_post ?

					$post_detail = "trash-session-" . $update_post_id;
				}

			} else {

				//If Session Already Available
				if ( isset( $already_available_id[0] ) ) {

					$update_post_id = $already_available_id[0];

					$update_post = array(
						'ID'           => $update_post_id,
						'post_title'   => "faisal-testing-" . $title,
						'post_content' => $description,
						'post_status'  => 'publish',
					);

					$post_id = wp_update_post( $update_post );

					foreach ( $data as $name => $value ) {
						if ( ! in_array( $name, $default_fields, true ) ) {
							update_post_meta( $update_post_id, $name, $value );
						}
					}

					$post_detail = "update-session-" . $post_id;

				} else {
					//NEW POST

					$post_id = wp_insert_post( array(
						'post_title'   => "faisal-testing-" . $title,
						'post_type'    => 'sessions',
						'post_content' => $description,
						'post_status'  => 'publish',
					) );

					if ( $post_id ) {
						// insert post meta
						foreach ( $data as $name => $value ) {
							if ( ! in_array( $name, $default_fields, true ) ) {
								add_post_meta( $post_id, $name, $value );
							}
						}
					}

					$post_detail = "new-session-" . $post_id;
				}









				//$image_url    = 'http://1.bp.blogspot.com/_Nyiipr-yxiQ/TRwwhhYxv1I/AAAAAAAAOo0/FrI3FQno2M0/s400/Cartoon_voice_actors_05.jpg';
				$image_url    = 'https://nab20.mapyourshow.com/mys_shared/NAB20/showfeatures/562/FB127_LX_Front45.png';

				$image_uploaded = $this->nab_mys_media->nab_mys_upload_media( $post_id, $image_url );

			}















			//ne_temp disabled
			//$this->nab_mys_master_confirmed( $item->DataID );

			return $post_detail;
		}

		public function nab_mys_master_speakers( $item ) {

			$data_json = str_replace( "\'", "'", $item->DataJson );
			$data      = json_decode( $data_json, true );

			$default_fields = array(
				'firstname',
				'lastname',
				'bio'
			);

			$title       = $data['firstname'] . " " . $data['lastname'];
			$description = $data['bio'];

			$schedules = $data['schedules'][0];
			unset( $data['schedules'] );
			$data                 = array_merge( $data, $schedules );
			$sessionid            = $schedules['sessionid'];
			$sessionid_meta_value = "speaker#" . $sessionid;
			$data['sessionid']    = $sessionid_meta_value;

			/**
			 * 0 - Deleted
			 * 1 - Added
			 * 2 - Updated
			 */
			$item_status = $item->ItemStatus;

			global $wpdb;

			$already_available_id = $wpdb->get_col(
				$wpdb->prepare(
					"SELECT post_id FROM $wpdb->postmeta
								WHERE meta_key = 'sessionid'
								AND meta_value = %s", $sessionid_meta_value ) );

			/*if ( isset( $already_available_id[0] ) && "2973" === $already_available_id[0] ) {
				$item_status = 0;
			}*/

			if ( 0 === $item_status ) {

				if ( isset( $already_available_id[0] ) ) {

					$update_post_id = $already_available_id[0];
					wp_trash_post( $update_post_id ); //or use wp_delete_post ?

					$post_detail = "trash-speaker-" . $update_post_id;
				}

			} else {

				//If Session Already Available
				if ( isset( $already_available_id[0] ) ) {

					$update_post_id = $already_available_id[0];

					$update_post = array(
						'ID'           => $update_post_id,
						'post_title'   => "faisal-testing-" . $title,
						'post_content' => $description,
						'post_status'  => 'publish',
					);

					$post_id = wp_update_post( $update_post );

					foreach ( $data as $name => $value ) {
						if ( ! in_array( $name, $default_fields, true ) ) {
							update_post_meta( $update_post_id, $name, $value );
						}
					}

					$post_detail = "update-speaker-" . $post_id;

				} else {
					//NEW POST

					$post_id = wp_insert_post( array(
						'post_title'   => "faisal-testing-" . $title,
						'post_type'    => 'speakers',
						'post_content' => $description,
						'post_status'  => 'publish',
					) );

					if ( $post_id ) {
						// insert post meta
						foreach ( $data as $name => $value ) {
							if ( ! in_array( $name, $default_fields, true ) ) {
								add_post_meta( $post_id, $name, $value );
							}
						}
					}

					$post_detail = "new-speaker-" . $post_id;
				}


				$image_url    = 'https://thumbs.dreamstime.com/z/tragic-actor-theater-stage-man-medieval-suit-retro-cartoon-character-design-vector-illustration-77130060.jpg';

				$image_uploaded = $this->nab_mys_media->nab_mys_upload_media( $post_id, $image_url );
			}

			$this->nab_mys_master_confirmed( $item->DataID );

			return $post_detail;
		}

		public function nab_mys_master_confirmed( $data_id ) {

			global $wpdb;

			$update_status = $wpdb->query(
				$wpdb->prepare(
					"UPDATE wp_mys_data
											SET AddedStatus = %d
											WHERE DataID = %d"
					, 1, $data_id ) );

		}

		/**
		 * Insert/Update MYS History Table.
		 *
		 * @return string
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		public function nab_mys_update_custom_table( $single_item_array, $item_status, $item_session_id ) {

			$single_item_json = wp_json_encode( $single_item_array );

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

			global $wpdb;

			$sql = $wpdb->insert( $wpdb->prefix . 'mys_data', array(
				'DataGroupID'   => $this->group_id,
				'HistoryID'     => $this->history_id,
				'AddedStatus'   => 0,
				'ItemStatus'    => $item_status_int,
				'DataType'      => $this->current_request,
				'ModifiedID'    => $item_session_id,
				'DataStartTime' => date( 'Y-m-d H:i:s' ),
				'DataJson'      => $single_item_json
			), array( '%s', '%d', '%d', '%d', '%s', '%s', '%s' ) );

			return $wpdb->insert_id;
		}
	}
}
