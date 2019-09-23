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

if ( ! class_exists( 'NAB_MYS_DB_Parent' ) ) {

	class NAB_MYS_DB_Parent {

		protected $wpdb = '';

		protected $data_json = "";

		protected $group_id = "";

		protected $current_request;

		protected $history_id;

		protected $session_modified_array;

		protected $nab_mys_media;

		/**
		 * Class Constructor
		 */
		public function __construct() {

			$this->nab_mys_db_set_wpdb();

			//Create Custom DB Tables if not already created
			$this->nab_mys_db_create_custom_tables();

			//Class File - Media
			require_once WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-media.php';

			$this->nab_mys_media = new NAB_MYS_MEDIA();

			//Intitialize the Rest End Point
			add_action( 'rest_api_init', array( $this, 'nab_mys_cron_rest_points' ) );
		}

		public function nab_mys_db_set_wpdb() {
			global $wpdb;
			$this->wpdb = $wpdb;
		}

		/**
		 * Create Custom DB Tables if not alread created
		 *
		 * @package MYS Modules
		 * @since   1.0.0
		 */
		public function nab_mys_db_create_custom_tables() {

			$charset_collate = $this->wpdb->get_charset_collate();

			$history_table_name = $this->wpdb->prefix . 'mys_history';
			$history_table_sql  = "CREATE TABLE $history_table_name (
	          HistoryID int(11) unsigned NOT NULL AUTO_INCREMENT,
	          HistoryGroupID varchar(20) NOT NULL,
	          HistoryStatus int(11) unsigned NOT NULL,
	          HistoryUser int(11) unsigned NOT NULL,
	          HistoryDataType varchar(50) NOT NULL,
	          HistoryStartTime datetime DEFAULT (CURRENT_TIMESTAMP) NOT NULL,
	          HistoryEndTime datetime NOT NULL,
	          HistoryItemsAffected int(11) unsigned NOT NULL,
	          HistoryData longtext NOT NULL,
	          PRIMARY KEY  (HistoryID),
	          INDEX HistoryID (HistoryID),
	          INDEX HistoryGroupID (HistoryGroupID),
			  INDEX HistoryStatus (HistoryStatus),
			  INDEX HistoryUser (HistoryUser),
			  INDEX HistoryDataType (HistoryDataType)
     		) $charset_collate;";

			$data_table_name = $this->wpdb->prefix . 'mys_data';
			$data_table_sql  = "CREATE TABLE $data_table_name (
	          DataID int(11) unsigned NOT NULL AUTO_INCREMENT,
	          HistoryID int(11) unsigned NOT NULL,
	          DataGroupID varchar(20) NOT NULL,
	          AddedStatus int(11) unsigned NOT NULL,
	          ItemStatus int(11) unsigned NOT NULL,
	          DataType varchar(50) NOT NULL,
	          ModifiedID int(11) unsigned NOT NULL,
	          DataStartTime datetime DEFAULT (CURRENT_TIMESTAMP) NOT NULL,
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
		 * Bulk inserts records into a table using WPDB.  All rows must contain the same keys.
		 *
		 * @param string $table Table name
		 * @param array $rows Individual Full Data for Session/Speakers/etc.
		 *
		 * @return int Returns number of affected (inserted) rows.
		 */
		public function nab_mys_db_bulk_insert( $table, $rows ) {

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

				$result = $this->wpdb->query( $this->wpdb->prepare( $query, $data ) ); //phpcs:ignore

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
		public function nab_mys_db_history_data( $current_request, $query_type, $group_id, $history_status = 0, $items_affected = 0, $flow = null ) {

			$current_user = get_current_user_id();

			//This will have same value in each cron.
			$this->group_id = $group_id;


			if ( "insert" === $query_type ) {

				$sql = $this->wpdb->insert(
					$this->wpdb->prefix . 'mys_history', array(
					'HistoryStatus'    => 0,
					'HistoryGroupID'   => $group_id,
					'HistoryUser'      => $current_user,
					'HistoryDataType'  => $current_request,
					'HistoryStartTime' => date( 'Y-m-d H:i:s' )
				), array( '%d', '%s', '%d', '%s', '%s' )
				); //db call ok; no-cache ok

				return $this->wpdb->insert_id;

			} else if ( "update" === $query_type ) {

				$sql_values = array(
					'HistoryEndTime'       => date( 'Y-m-d H:i:s' ),
					'HistoryStatus'        => $history_status,
					'HistoryData'          => $this->data_json,
					'HistoryItemsAffected' => $items_affected
				);

				if ( 'nochange' === $items_affected ) {
					unset( $sql_values['HistoryItemsAffected'] );
				}

				$sql = $this->wpdb->update(
					$this->wpdb->prefix . 'mys_history', $sql_values, array(
						'HistoryGroupID'  => $this->group_id,
						'HistoryDataType' => $current_request,
					)
				); //db call ok; no-cache ok

				return $sql;

			} else if ( "finish" === $query_type ) {

				$sql = $this->wpdb->update(
					$this->wpdb->prefix . 'mys_history', array(
					'HistoryEndTime' => date( 'Y-m-d H:i:s' ),
					'HistoryStatus'  => 1,
				), array(
						'HistoryGroupID'  => $this->group_id,
						'HistoryDataType' => $current_request,
					)
				); //db call ok; no-cache ok

				return $sql;
			}

		}

		public function nab_mys_db_set_data_json( $data_json ) {
			$this->data_json = $data_json;
		}

		public function nab_mys_db_rows_ready_total_getter( $group_id ) {

			$wpdb = $this->wpdb;

			$ready_ids = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT DataID FROM {$wpdb->prefix}mys_data
						WHERE AddedStatus = 0
						AND DataGroupID = '%s'
						", $group_id )
			); //db call ok; no-cache ok

			return count( $ready_ids );
		}

		public function nab_mys_db_row_pending_id_getter( $group_id ) {

			$wpdb = $this->wpdb;

			$single_row = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT DataID, ModifiedID FROM {$wpdb->prefix}mys_data
						WHERE AddedStatus = 3
						AND DataGroupID = '%s'
						AND DataJson = ''
						ORDER BY DataID ASC
						LIMIT 1", $group_id )
			); //db call ok; no-cache ok

			if ( count( $single_row ) > 0 ) {

				return $single_row;

			} else {

				return "finished";

			}
		}

		public function nab_mys_db_row_filler( $dataid, $data_json ) {

			$sql = $this->wpdb->update(
				$this->wpdb->prefix . 'mys_data', array(
				'AddedStatus' => 0,
				'DataEndTime' => date( 'Y-m-d H:i:s' ),
				'DataJson'    => $data_json
			), array(
					'DataID' => $dataid,
				)
			); //db call ok; no-cache ok

			return $sql;

		}

		/**
		 * Rest End Points
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_cron_rest_points() {

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

			$result = $this->nab_mys_corn_migrate_data( $limit, $dataids, $groupid );

			return $result;
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

			$wpdb = $this->wpdb;

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
				$data_json = str_replace( "\'", "'", $item->DataJson );
				$data      = json_decode( $data_json, true );

				echo $data_type . ' | ';
				echo '<pre>';
				print_r($item);
				echo '</pre>';

				$prepared_data                   = array();
				$prepared_data['item']           = $item;
				$prepared_data['main_mys_value'] = $item->ModifiedID;
				$prepared_data['data']           = $data;

				switch ( $data_type ) {
					case 'sessions':

						$prepared_data['post_type']         = 'sessions';
						$prepared_data['exclude_from_meta'] = array( 'sessionid', 'title', 'description', 'level', 'type', 'location' );
						$prepared_data['typeidname']        = 'sessionid';

						$prepared_data['title_name']       = 'title';
						$prepared_data['description_name'] = 'description';

						$result[ "DataID-" . $data_id ] = $this->nab_mys_cron_insert_to_master( $prepared_data );
						break;

					case 'tracks':

						$prepared_data['post_type']         = 'tracks';
						$prepared_data['exclude_from_meta'] = array( 'title', 'description' );
						$prepared_data['typeidname']        = 'trackid';

						$result[ "DataID-" . $data_id ] = $this->nab_mys_cron_master_tracks( $prepared_data );


						break;

					case 'speakers':

						$prepared_data['post_type']         = 'speakers';
						$prepared_data['exclude_from_meta'] = array( 'firstname', 'lastname', 'bio', 'photo' );
						$prepared_data['typeidname']        = 'speakerid';

						$prepared_data['title_name']       = 'firstname';
						$prepared_data['description_name'] = 'bio';
						$prepared_data['image_name']       = 'photo';

						$result[ "DataID-" . $data_id ] = $this->nab_mys_cron_insert_to_master( $prepared_data );
						break;

					case 'sponsors':

						$prepared_data['post_type']         = 'sponsors';
						$prepared_data['exclude_from_meta'] = array( 'sponsorname', 'logo' );
						$prepared_data['typeidname']        = 'sponsorid';

						$prepared_data['title_name'] = 'sponsorname';
						$prepared_data['image_name'] = 'logo';

						$result[ "DataID-" . $data_id ] = $this->nab_mys_cron_insert_to_master( $prepared_data );
						break;

					case stristr( $data_type, 'single-exhibitor' ):

						$prepared_data['post_type']         = 'exhibitors';
						$prepared_data['exclude_from_meta'] = array( 'exhid', 'exhname', 'logo', 'description' );
						$prepared_data['typeidname']        = 'exhid';

						$prepared_data['title_name']       = 'exhname';
						$prepared_data['description_name'] = 'description';
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
			$main_mys_value    = isset ( $prepared_data['main_mys_value'] ) ? $prepared_data['main_mys_value'] : '';
			$main_mys_key      = ( 'exhibitors' !== $post_type ) ? 'sessionid' : 'exhid';
			$typeidname        = $prepared_data['typeidname'];


			$title_name       = $prepared_data['title_name'];
			$description_name = isset( $prepared_data['description_name'] ) ? $prepared_data['description_name'] : "";
			$image_name       = isset( $prepared_data['image_name'] ) ? $prepared_data['image_name'] : '';

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
				$description = "" !== $description_name ? $individual_item[ $description_name ] : '';
				$typeid      = $individual_item[ $typeidname ];

				$image_url =
					isset( $individual_item[ $image_name ] ) &&
					strpos( $individual_item[ $image_name ], 'http' ) !== false
						? $individual_item[ $image_name ] : "";

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

				//If session status is not to "delete", get exisitng Post ID
				if ( 0 !== $item_status ) {
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
							if ( ! in_array( $name, $exclude_from_meta, true ) && ! empty( $value ) ) {
								if ( is_array( $value ) ) {
									$value = wp_json_encode( $value, true );
								}
								update_post_meta( $update_post_id, $name, $value );
							}
						}

						update_post_meta( $update_post_id, $main_mys_key, $main_mys_value );

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
								if ( ! in_array( $name, $exclude_from_meta, true ) && ! empty( $value ) ) {
									if ( is_array( $value ) ) {
										$value = wp_json_encode( $value, true );
									}
									add_post_meta( $post_id, $name, $value );
								}
							}

							update_post_meta( $post_id, $main_mys_key, $main_mys_value );
						}

						$post_detail .= "new-$post_type-" . $post_id;
					} else {
						$post_detail .= "already-added-$post_type-" . $already_available_id;
					}

					// Upload image if (1) item was new and added status was new OR (2) Item needs to be updated
					if ( "sessions" !== $post_type &&
					     ( ( ! isset( $already_available_id ) && 1 === $item_status ) || 2 === $item_status ) &&
					     ! empty( $image_url )
					) {

						//Upload Third Party Image to WP Media Library
						$attach_id = $this->nab_mys_media->nab_mys_upload_media( $post_id, $image_url, $post_type );

						$post_detail .= '-attach_id-' . $attach_id;
					}

					//Save or Update taxonomies.
					if ( "exhibitors" === $post_type ) {

						$booths            = $this->nab_mys_db_single_to_array( $individual_item['booths'] );
						$productcategories = $this->nab_mys_db_single_to_array( $individual_item['productcategories'] );

						$booth_hall_string = '';

						$halls = $pavilions = array();

						foreach ( $booths as $single_booth ) {

							$hall              = $single_booth['hall'];
							$pavilion          = $single_booth['pavilion'];
							$boothnumber       = $single_booth['boothnumber'];
							$booth_hall_string .= "$boothnumber=$hall#";

							if ( ! empty( $hall ) ) {
								$halls[] = $hall;
							}
							if ( ! empty( $pavilion ) ) {
								$pavilions[] = $pavilion;
							}

							//ne_rems
							//exhibitor-categories

						}

						$booth_hall_string = rtrim( $booth_hall_string, '#' );
						update_post_meta( $post_id, 'booths_halls', $booth_hall_string );

						if ( count( $halls ) !== 0 ) {
							$post_detail .= $this->nab_mys_cron_assign_single_term_by_name( $halls, "halls", $post_id );
						}

						if ( count( $pavilions ) !== 0 ) {
							$post_detail .= $this->nab_mys_cron_assign_single_term_by_name( $pavilions, "pavilions", $post_id );
						}

					} else if ( "sessions" === $post_type ) {

						$level = $individual_item['level'];
						if ( "" !== $level ) {
							$post_detail .= $this->nab_mys_cron_assign_single_term_by_name( $level, "session-levels", $post_id );
						}

						$type = $individual_item['type'];
						if ( "" !== $type ) {
							$post_detail .= $this->nab_mys_cron_assign_single_term_by_name( $type, "session-types", $post_id );
						}

						$location = $individual_item['location'];
						if ( "" !== $location ) {
							$post_detail .= $this->nab_mys_cron_assign_single_term_by_name( $location, "session-locations", $post_id );
						}

					} else if ( "speakers" === $post_type ) {

						$company = $individual_item['company'];
						if ( "" !== $company ) {
							$post_detail .= $this->nab_mys_cron_assign_single_term_by_name( $company, "speaker-companies", $post_id );
						}

					}

					$post_ids_to_save_in_session .= $post_id . ',';
					$post_detail                 .= '|';

				} else if ( isset( $already_available_id ) && ( "sessions" === $post_type || "exhibitors" === $post_type ) ) {

					// Deleteing session.
					// This is for sessions only

					$update_post_id = $already_available_id;
					wp_trash_post( $update_post_id );

					$post_detail .= "trash-$post_type-" . $update_post_id;

				}

			}

			// flush previous comma separated relations and add new once.
			if ( "sessions" !== $post_type && "exhibitors" !== $post_type && null !== $data ) {
				$post_ids_to_save_in_session = rtrim( $post_ids_to_save_in_session, ',' );

				// Reseting sessions meta where (speaker/sponsors) are comma separated and adding new ids.
				$session_post_id = $this->nab_mys_cron_get_postid_from_meta( $post_type, $main_mys_key, $main_mys_value );
				update_post_meta( $session_post_id, $post_type, $post_ids_to_save_in_session );

				if ( '' !== $session_post_id ) {
					$post_detail .= "to_session-$session_post_id";
				} else {
					$post_detail .= "not-found-sessionid-$main_mys_value";
				}
			} else if ( null === $data ) {
				$post_detail .= 'JSON data is not in correct format';
			}

			$this->nab_mys_cron_master_confirmed( $item->DataID );

			return $post_detail;
		}

		protected function nab_mys_db_single_to_array( $single ) {
			return ( 0 !== count( $single ) && ! isset ( $single[0] ) ) ? array( 0 => $single ) : $single;
		}

		/**
		 * Update AddedStatus from 0 to 1 after migration process completes.
		 *
		 * @param int $data_id Primary Key of the wp_mys_data table.
		 *
		 * @return bool|false|int The status of the update query.
		 */
		public function nab_mys_cron_master_confirmed( $data_id ) {

			$update_status = $this->wpdb->update(
				$this->wpdb->prefix . 'mys_data', array(
				'DataEndTime' => date( 'Y-m-d H:i:s' ),
				'AddedStatus' => 1,
			), array(
					'DataID' => $data_id
				)
			); //db call ok; no-cache ok

			return $update_status;
		}

		public function nab_mys_cron_get_postid_from_meta( $post_type, $main_mys_key, $main_mys_value ) {

			$session_post_id = '';

			// WP_Query arguments
			$args = array(
				'post_type'  => array( $post_type ),
				'meta_query' => array(
					array(
						'key'   => $main_mys_key,
						'value' => $main_mys_value,
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

		public function nab_mys_cron_assign_single_term_by_name( $titles, $taxonomy, $post_id, $args = array() ) {

			if ( ! is_array( $titles ) ) {
				$term     = $titles;
				$titles   = array();
				$titles[] = $term;
			}

			$terms_ids = array();

			foreach ( $titles as $single_title ) {

				$mys_item_id   = isset( $args['mys_item_id'] ) ? $args['mys_item_id'] : 0;
				$mys_item_name = isset( $args['mys_item_name'] ) ? $args['mys_item_name'] : 0;
				$mys_parent_id = isset( $args['mys_parent_id'] ) ? $args['mys_parent_id'] : 0;
				$wp_parent_id  = 0;
				$description   = isset( $args['description'] ) ? $args['description'] : '';

				//get parent's wp/term id
				if ( 0 !== $mys_parent_id ) {
					//get tracks wp id from trackid of mys
					$args        = array(
						'hide_empty' => false, // also retrieve terms which are not used yet
						'meta_query' => array(
							array(
								'key'   => $mys_item_name,
								'value' => $mys_parent_id
							)
						),
						'taxonomy'   => $taxonomy,
					);
					$parent_term = get_terms( $args );

					$wp_parent_id = isset ( $parent_term[0]->term_id ) ? $parent_term[0]->term_id : 0;
				}

				$post_detail = '';

				//Check if same name available
				$existing_term_data = get_term_by( 'name', $single_title, $taxonomy );

				$post_detail .= "|assigned-$taxonomy-term-";

				if ( isset( $existing_term_data->term_id ) ) {

					//if yes, get its id and assign to $session_post_id
					$terms_ids[] = $term_post_id = $existing_term_data->term_id;
					$post_detail .= "old";

				} else {
					// insert new term if not already available

					$term_id_data = wp_insert_term(
						$single_title,
						$taxonomy,
						array(
							'description' => $description,
							'parent'      => $wp_parent_id,
						)
					);

					//Term already available on this point, then use it.
					if ( isset( $term_id_data->error_data['term_exists'] ) ) {
						$terms_ids[] = $term_post_id = $term_id_data->error_data['term_exists'];
						$post_detail .= "old";
					} else {
						$terms_ids[] = $term_post_id = $term_id_data['term_id'];
						$post_detail .= "new";
					}

					//insert term meta
					if ( 0 !== $mys_item_id ) {
						update_term_meta( $term_post_id, $mys_item_name, $mys_item_id );
					}

				}
				$post_detail .= "-$term_post_id|";

			}

			//rememebter to flush existing one before assigning
			wp_set_post_terms( $post_id, $terms_ids, $taxonomy );

			return $post_detail;
		}

		public function nab_mys_cron_get_latest_groupid( $requested_for ) {

			$wpdb = $this->wpdb;

			$data_type = 'exhibitors' === $requested_for ? 'modified-exhibitors' : 'modified-sessions';

			$pending_data = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT * FROM {$wpdb->prefix}mys_history
						WHERE HistoryStatus = '0'
						AND HistoryDataType = '%s'
						ORDER BY HistoryID
						ASC LIMIT 1
						", $data_type )
			); //db call ok; no-cache ok

			if ( 0 === count( $pending_data ) ) {

				return 0;

			} else if ( 'exhibitors' === $requested_for ) {

				return $pending_data;

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

		public function nab_mys_history_getter( $limit ) {

			$wpdb = $this->wpdb;

			$where_clause = 'HistoryDataType LIKE "%-%"';
			$order_by     = 'HistoryID';
			$order_type   = 'DESC';

			$history_result = $wpdb->get_results(
				$wpdb->prepare( "SELECT h1.* FROM {$wpdb->prefix}mys_history as h1
										INNER JOIN (SELECT DISTINCT HistoryGroupID FROM {$wpdb->prefix}mys_history LIMIT %d) as h2
										ON h1.HistoryGroupID = h2.HistoryGroupID
										ORDER BY HistoryID DESC
										", $limit )
			); //db call ok; no-cache ok

			$history_data = array();

			foreach ( $history_result as $h ) {
				$history_data[ $h->HistoryGroupID ]['Totals'][ $h->HistoryDataType ] = $h->HistoryItemsAffected;
				$history_data[ $h->HistoryGroupID ]['Details']                       = $h;
			}

			$history_total = $this->nab_mys_history_total();

			return array(
				'history_total' => $history_total,
				'history_data'  => $history_data
			);
		}

		protected function nab_mys_history_total() {

			$wpdb = $this->wpdb;

			$history_total = $wpdb->get_var( "SELECT COUNT(HistoryID) FROM {$wpdb->prefix}mys_history WHERE HistoryDataType LIKE '%-%'" ); //db call ok; no-cache ok

			return $history_total;
		}
	}
}
