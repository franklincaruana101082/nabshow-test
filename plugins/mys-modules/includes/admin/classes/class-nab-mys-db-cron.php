<?php
/**
 * DataBase CRON Queries Class
 *
 * @package MYS Modules
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'NAB_MYS_DB_CRON' ) ) {

	class NAB_MYS_DB_CRON {

		private $wpdb;

		private $nab_mys_media;

		/**
		 * Class Constructor
		 */
		public function __construct() {

			global $wpdb;
			$this->wpdb = $wpdb;

			//Create Custom DB Tables if not already created
			$this->nab_mys_db_create_custom_tables();

			//Class File - Media
			require_once WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-media.php';

			$this->nab_mys_media = new NAB_MYS_MEDIA();

			//Initialize the Rest End Point
			add_action( 'rest_api_init', array( $this, 'nab_mys_cron_rest_points' ) );

			//WP Cron's custom timings.
			add_filter( 'cron_schedules', array( $this, 'nab_mys_wpcron_custom_timings' ) );

			//Master Cron function.
			add_action( 'mys_master_cron', array( $this, 'nab_mys_wpcron_custom_to_master' ), 10, 1 );
		}

		/**
		 * Custom timings for WPCron.
		 *
		 * @param array $schedules Default Scheduled time intervals.
		 *
		 * @return array Customized time intervals.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		function nab_mys_wpcron_custom_timings( $schedules ) {

			$schedules['cron_every_fifteen_sec'] = array(
				'interval' => 300,
				'display'  => __( 'Every 5 min' )
			);
			$schedules['cron_every_fifteen_sec'] = array(
				'interval' => 900,
				'display'  => __( 'Every 15 min' )
			);
			$schedules['cron_every_thrity_sec']  = array(
				'interval' => 1800,
				'display'  => __( 'Every 30 min' )
			);
			$schedules['cron_every_minute']      = array(
				'interval' => 2700,
				'display'  => __( 'Every 45 min' )
			);

			return $schedules;
		}

		/**
		 * Create Custom DB Tables if not alread created
		 *
		 * @package MYS Modules
		 * @since   1.0.0
		 */
		public function nab_mys_db_create_custom_tables() {

			$charset_collate = $this->wpdb->get_charset_collate();

			//Create History Table
			$history_table_name = $this->wpdb->prefix . 'mys_history';
			$history_table_sql  = "CREATE TABLE $history_table_name (
	          HistoryID int(11) unsigned NOT NULL AUTO_INCREMENT,
	          HistoryGroupID varchar(20) NOT NULL,
	          HistoryStatus int(11) unsigned NOT NULL,
	          HistoryUser int(11) unsigned NOT NULL,
	          HistoryDataType varchar(50) NOT NULL,
	          HistoryStartTime datetime NOT NULL,
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

			//Create Data Table
			$data_table_name = $this->wpdb->prefix . 'mys_data';
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

			dbDelta( $history_table_sql );
			dbDelta( $data_table_sql );
		}

		/**
		 * Master CRON's WP Rest End Point
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
		 * Call back Master CRON
		 *
		 * @param WP_REST_Request $request
		 *
		 * @return array    List of DataID -> PostID
		 *         string   Message to show that No more data available to migrate.
		 */
		public function nab_mys_cron_custom_to_master( WP_REST_Request $request ) {

			$parameters = $request->get_params();

			$limit = isset( $parameters['limit'] ) ? $parameters['limit'] : 3;

			$dataids = isset( $parameters['dataids'] ) ? $parameters['dataids'] : '';

			$groupid = isset( $parameters['groupid'] ) ? $parameters['groupid'] : '';

			$result = $this->nab_mys_corn_migrate_data( $limit, $dataids, $groupid );

			return $result;
		}

		public function nab_mys_wpcron_custom_to_master( $limit ) {

			$result = $this->nab_mys_corn_migrate_data( $limit, '', '' );

			return $result;
		}

		/**
		 * CRON: Migration from Custom to Master
		 *
		 * @param int $limit The limit of rows to migrate in single call.
		 * @param int|string $dataids Comma separated DataIDs.
		 * @param string $groupid A unique group id,
		 *
		 * @return array    List of DataID -> PostID
		 *         string   Message to show that No more data available to migrate.
		 */
		public function nab_mys_corn_migrate_data( $limit, $dataids, $groupid ) {

			$manual_run = 1;

			$wpdb = $this->wpdb;

			//Conditional Where Clause for Master Cron
			if ( ! empty( $dataids ) ) {
				$where_clause = "DataID IN ($dataids)";
			} else if ( ! empty( $groupid ) ) {
				$where_clause = "DataGroupID = '$groupid'";
			} else {
				$where_clause = "AddedStatus = 0";
				$manual_run  = 0;
			}

			$data_to_migrate = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT * FROM %1smys_data
							WHERE $where_clause
							ORDER BY DataID ASC LIMIT %d",
					$wpdb->prefix, $limit ) );


			if ( count( $data_to_migrate ) > 0 ) {

				if ( 0 === $manual_run ) {
					//Checking Stuck Scenario only for the Auto CRONs.
					$this->nab_mys_cron_stuck_or_not( $data_to_migrate[0] );
				}

				$result = $this->nab_mys_cron_master_flow( $data_to_migrate, $manual_run );
			} else {
				$result = "All data migrated successfully to the master table.";
			}

			return $result;
		}


		/**
		 * Check whether Master CRON Stuck on the same point or its working fine.
		 *
		 * @param array $data_to_migrate Data to migrate.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_cron_stuck_or_not( $data_to_migrate ) {

			$current_dataid = $data_to_migrate->DataID;
			$data_groupid   = $data_to_migrate->DataGroupID;

			//Counting attempts
			$master_attempts = get_option( 'master_attempts' );
			$master_attempts = explode( '#', $master_attempts );
			$previous_dataid = isset( $master_attempts[0] ) ? $master_attempts[0] : '';

			if ( $previous_dataid === $current_dataid ) {

				$count_attempt = isset( $master_attempts[1] ) ? (int) $master_attempts[1] + 1 : 1;

				if ( 2 < $count_attempt ) {

					$history_detail_link = admin_url( 'admin.php?page=mys-history&groupid=' . $data_groupid . '&timeorder=asc' );

					//Prepare Email
					$email_subject = "MYS/Wordpress Failure - Master CRON Stucked";
					$email_body    = "The master cron was stucked at Data ID: $current_dataid so it is forcefully stopped. Please investigate and take necessary actions.  <a href='$history_detail_link'>Click here</a> to view details.";
					self::nab_mys_static_email( $email_subject, $email_body );

					//Change the status from 0 to 4 for $current_dataid (Sync Forcefully Stopped)
					$this->nab_mys_reset_dataid( $current_dataid );

					//Resetting the counter
					update_option( 'master_attempts', 0 );

				} else {
					//Updating the counter value
					update_option( 'master_attempts', $current_dataid . '#' . $count_attempt );
				}

			} else {
				//Updating the counter value
				update_option( 'master_attempts', $current_dataid . '#' . 1 );
			}
		}

		/**
		 * Separating the migration flow according to the type of data.
		 *
		 * @param array $data_to_migrate the data to migrate.
		 *
		 * @return array List of DataID -> PostID
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		public function nab_mys_cron_master_flow( $data_to_migrate, $manual_run ) {

			$result = $data_group_migrated = array();

			foreach ( $data_to_migrate as $item ) {

				$data_id    = $item->DataID;
				$history_id = $item->HistoryID;
				$data_type  = $item->DataType;

				//Preparing an array to send email at the end of migration. Check end of this function.
				if ( 0 === count( $data_group_migrated ) || ! in_array( $history_id, $data_group_migrated[ $item->DataGroupID ], true ) ) {
					$data_group_migrated[ $item->DataGroupID ][ $item->DataType ] = $history_id;
				}

				$data_json = $item->DataJson;
				$data      = json_decode( $data_json, true );

				//Prepare final data to migrate.
				$prepared_data                   = array();
				$prepared_data['item']           = $item;
				$prepared_data['main_mys_key']   = 'sessionid';
				$prepared_data['main_mys_value'] = $item->ModifiedID;
				$prepared_data['data']           = $data;

				switch ( $data_type ) {
					case 'sessions':

						$prepared_data['post_type']         = 'sessions';
						$prepared_data['exclude_from_meta'] = array( 'sessionid', 'title', 'description' );
						$prepared_data['typeidname']        = 'sessionid';
						$prepared_data['title_name']        = 'title';
						$prepared_data['description_name']  = 'description';

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
						$prepared_data['title_name']        = 'firstname';
						$prepared_data['description_name']  = 'bio';
						$prepared_data['image_name']        = 'photo';

						$result[ "DataID-" . $data_id ] = $this->nab_mys_cron_insert_to_master( $prepared_data );
						break;

					case 'sponsors':

						$prepared_data['post_type']         = 'sponsors';
						$prepared_data['exclude_from_meta'] = array( 'sponsorname', 'logo' );
						$prepared_data['typeidname']        = 'sponsorid';
						$prepared_data['title_name']        = 'sponsorname';
						$prepared_data['image_name']        = 'logo';

						$result[ "DataID-" . $data_id ] = $this->nab_mys_cron_insert_to_master( $prepared_data );
						break;

					case stristr( $data_type, 'single-exhibitor' ):

						$prepared_data['post_type']         = 'exhibitors';
						$prepared_data['main_mys_key']      = 'exhid';
						$prepared_data['exclude_from_meta'] = array( 'exhid', 'exhname', 'logo', 'description' );
						$prepared_data['typeidname']        = 'exhid';
						$prepared_data['title_name']        = 'exhname';
						$prepared_data['description_name']  = 'description';
						$prepared_data['image_name']        = 'logo';

						$result[ "DataID-" . $data_id ] = $this->nab_mys_cron_insert_to_master( $prepared_data );
						break;
				}

			}

			//Check migrated data and send email if required.
			foreach ( $data_group_migrated as $groupid => $affected_history_ids ) {

				$group_rows = $this->nab_mys_cron_get_group_rows( $groupid );

				if ( count( $group_rows ) > 0 ) {

					/**
					 * Ths variable is used to check if there are still pending items which are not
					 * migrated yet for the same History ID.
					 * Only few of the History items are migrated but few are still remaining.
					 * If there are no pending items, it means the sequence is finished, now we can
					 * send an email if the sequence was started by a user (not cron).
					 */
					$pending_data_history_ids = array();

					/**
					 * This variable is used to check if there are more than one Data types,
					 * it means the its Sessions's data which migrated, otherwise Exhibitors.
					 */
					$count_data_types = array();

					foreach ( $group_rows as $row ) {
						$count_data_types[ $row->DataType ] = 1;
						if ( 1 !== (int) $row->AddedStatus ) {
							$pending_data_history_ids[] = $row->HistoryID;
						}
					}

					$data_name = 1 === count( $count_data_types ) ? 'Exhibitors' : 'Sessions';

					if ( 0 === count( $pending_data_history_ids ) ) {
						//Sequence finished
						$this->nab_mys_cron_migration_ends( $groupid, 'groupid' );
						$result['sequence_finished'][ $groupid ] = " --- FULL SEQUENCE FINISHED.";

						//Don't send email if CRON was hit manually.
						if ( 0 === $manual_run ) {

							//Send email if the user is not 0 (i.e. not cron).
							$history_data = $this->nab_mys_get_specific_group_history( $groupid );
							$history_user = $history_data->HistoryUser;

							if ( 0 !== (int) $history_user ) {

								//Prepare email
								$history_detail_link = admin_url( 'admin.php?page=mys-history&groupid=' . $groupid . '&timeorder=asc' );
								$email_subject       = "MYS/Wordpress Success - $data_name Synced";
								$email_body          = "The custom MYS Module plugin has finished syncing. <a href='$history_detail_link'>Click here</a> to view details.";
								self::nab_mys_static_email( $email_subject, $email_body );

								$result['email'][ $groupid ] = 'sent !!';
							}
						}

					} else {
						//Full sequence not finished but its's single data_type finished (for ex: speakers)
						$finished_history_ids = array_diff( $affected_history_ids, $pending_data_history_ids );

						foreach ( $finished_history_ids as $history_id ) {

							//Changing History status to 5 (i.e. Migration successful)
							$this->nab_mys_cron_migration_ends( $history_id );
							$result['history_finished'][ $history_id ] = " ~~~ History ($history_id) of the Sequence ($groupid) finished.";
						}
					}
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
			$main_mys_key      = isset ( $prepared_data['main_mys_key'] ) ? $prepared_data['main_mys_key'] : '';
			$typeidname        = $prepared_data['typeidname'];
			$title_name        = $prepared_data['title_name'];
			$description_name  = isset( $prepared_data['description_name'] ) ? $prepared_data['description_name'] : '';
			$image_name        = isset( $prepared_data['image_name'] ) ? $prepared_data['image_name'] : '';

			/**
			 * 0 - Deleted
			 * 1 - Added
			 * 2 - Updated
			 */
			$item_status = (int) $item->ItemStatus;

			$post_detail = '';

			//This variable is used to make a relation between post types.
			$post_ids_to_save_in_session = array();

			foreach ( $data as $individual_item ) {

				if ( 'firstname' === $title_name ) {
					$title = trim( $individual_item['firstname'] ) . ' ' . trim( $individual_item['lastname'] );
				} else {
					$title = trim( $individual_item[ $title_name ] );
				}
				$description = '' !== $description_name ? trim( $individual_item[ $description_name ] ) : '';
				$typeid      = $individual_item[ $typeidname ];

				$image_url =
					isset( $individual_item[ $image_name ] ) &&
					strpos( $individual_item[ $image_name ], 'http' ) !== false
						? trim( $individual_item[ $image_name ] ) : "";

				//Check if post already available
				$args              = array(
					'post_type'  => array( $post_type ),
					'meta_query' => array(
						array(
							'key'   => $typeidname,
							'value' => $typeid,
						),
					),
				);
				$already_available = new WP_Query( $args );

				if ( isset( $already_available->posts[0]->ID ) ) {
					$post_id = $already_available_id = $already_available->posts[0]->ID;
				}

				// Restore original Post Data
				wp_reset_postdata();

				//If item does not need to be deleted, proceed with this condition.
				if ( 0 !== $item_status ) {

					/**
					 * If post item already available and it should be updated.
					 */
					if ( isset( $already_available_id ) && 2 === $item_status ) {

						$update_post_id = $already_available_id;

						$update_post = array(
							'ID'           => $update_post_id,
							'post_title'   => $title,
							'post_content' => $description,
							'post_status'  => 'publish',
						);

						$post_id = wp_update_post( $update_post );

						//Updating meta
						foreach ( $individual_item as $name => $value ) {
							if ( ! in_array( $name, $exclude_from_meta, true ) && ! empty( $value ) ) {
								if ( is_array( $value ) ) {
									$value = wp_json_encode( $value, true );
								} else {
									$value = trim( $value );
								}
								update_post_meta( $update_post_id, $name, $value );
							}
						}

						//Main meta to track the post
						update_post_meta( $update_post_id, $main_mys_key, $main_mys_value );

						$post_detail .= "update-$post_type-" . $post_id;

					} else if ( ! isset( $already_available_id ) ) {
						/**
						 * If post is not available, creating it.
						 */

						$post_id = wp_insert_post(
							array(
								'post_title'   => $title,
								'post_type'    => $post_type,
								'post_content' => $description,
								'post_status'  => 'publish',
							)
						);

						//Adding meta
						if ( $post_id ) {
							foreach ( $individual_item as $name => $value ) {
								$value = trim( $value );
								if ( ! in_array( $name, $exclude_from_meta, true ) && ! empty( $value ) ) {
									if ( is_array( $value ) ) {
										$value = wp_json_encode( $value, true );
									}
									add_post_meta( $post_id, $name, $value );
								}
							}

							//Main meta to track the post
							update_post_meta( $post_id, $main_mys_key, $main_mys_value );
						}

						$post_detail .= "new-$post_type-" . $post_id;

					} else {
						$post_detail .= "already-added-$post_type-" . $already_available_id;
					}

					//Upload Image to WP Media Library and attach with the post.
					$attach_id = $this->nab_mys_media->nab_mys_upload_media( $post_id, $image_url, $post_type );

					$post_detail .= '-attach_id-' . $attach_id;

					/**
					 * Preparing taxonomies data.
					 */
					$save_taxonomies = array();

					if ( "exhibitors" === $post_type ) {

						/**
						 * Sometimes MYS sending single array and sometimes multidimentinal,
						 * so making all same using a function - nab_mys_cron_db_single_to_array().
						 */
						$booths = $this->nab_mys_cron_db_single_to_array( $individual_item['booths'] );

						$boothnumber_array = $booth_hall_string = $halls = $pavilions = array();

						foreach ( $booths as $single_booth ) {

							$hall                = $single_booth['hall'];
							$pavilion            = $single_booth['pavilion'];
							$boothnumber_array[] = $boothnumber = $single_booth['boothnumber'];
							$booth_hall_string[] = "$boothnumber@$hall@$pavilion";

							if ( ! empty( $hall ) ) {
								$halls[] = $hall;
							}
							if ( ! empty( $pavilion ) ) {
								$pavilions[] = $pavilion;
							}
						}

						$boothnumber_array = implode( ',', $boothnumber_array );
						update_post_meta( $post_id, 'boothnumbers', $boothnumber_array );

						$booth_hall_string = implode( '#', $booth_hall_string );
						update_post_meta( $post_id, 'booths_halls', $booth_hall_string );

						$save_taxonomies['halls']     = $halls;
						$save_taxonomies['pavilions'] = $pavilions;

						$c_title_array     = array();
						$productcategories = $this->nab_mys_cron_db_single_to_array( $individual_item['productcategories'] );

						if ( ! is_array( $productcategories ) && ! empty( $productcategories ) ) {
							$productcategories = explode( ',', $productcategories );
							foreach ( $productcategories as $cat_mys_id ) {
								$term_data = $this->nab_mys_cron_get_wpid_from_meta( 'exhibitor-categories', 'categoryid', $cat_mys_id, 'taxonomy' );
								if ( ! empty( $term_data ) ) {
									$c_title_array[] = $term_data->name;
								}
							}
						} else if ( is_array( $productcategories ) && 0 !== count( $productcategories ) ) {
							foreach ( $productcategories as $productcategory ) {
								$c_title_array[] = $productcategory['categoryname'];
							}
						}
						$save_taxonomies['exhibitor-categories'] = $c_title_array;

						$checkbox_cats  = array(
							'newexhibitor' => 'First-Time Exhibitor',
							'showsell'     => 'Show and Sell Participant',
							'startup'      => 'Startup',
							'member'       => 'NAB Association Member',
							'newproducts'  => 'New Product',
							'studentdisc'  => 'Student Discount',
						);
						$keywords_array = array();
						foreach ( $checkbox_cats as $c_attr => $c_title ) {
							if ( 1 === (int) $individual_item[ $c_attr ] ) {
								$keywords_array[] = $c_title;
							}
						}
						$save_taxonomies['exhibitor-keywords'] = $keywords_array;

						$dropdown_cats = array(
							'fiveg'     => '5G',
							'advadvert' => 'Advanced Advertising',
							'ai'        => 'AI/Machine Learning',
							'atsc'      => 'ATSC 3.0',
							'augreal'   => 'Augmented Reality',
							'concar'    => 'Connected Car',
							'cybersec'  => 'Cybersecurity',
							'esports'   => 'eSports',
							'hdr'       => 'HDR',
							'iptrans'   => 'IP Transition',
							'martech'   => 'MarTech',
							'mixreal'   => 'Mixed Reality',
							'other'     => 'Other',
							'ott'       => 'OTT',
							'podcast'   => 'Podcasting',
							'uhd'       => 'UHD',
							'virtreal'  => 'Virtual Reality',
							'voicerec'  => 'Voice Recognition/Interactivity',
						);
						$trends_array  = array();
						foreach ( $dropdown_cats as $d_attr => $d_title ) {
							if ( 1 === (int) $individual_item[ $d_attr ] ) {
								$trends_array[] = $d_title;
							}
						}
						$save_taxonomies['exhibitor-trends'] = $trends_array;

						//Adding/Updating Products
						$products = $individual_item['products'];
						if ( 0 !== count( $products ) ) {
							foreach ( $products as $product ) {
								$prepared_data                      = array();
								$item_prods                         = (object) array( 'ItemStatus' => 2 );
								$prepared_data['item']              = $item_prods;
								$prepared_data['main_mys_key']      = 'productname';
								$prepared_data['main_mys_value']    = $product['productname'];
								$product['exhid']                   = $post_id;
								$prepared_data['data'][]            = $product;
								$prepared_data['post_type']         = 'products';
								$prepared_data['exclude_from_meta'] = array( 'productdescription', 'categoryname', 'productname', 'productimage' );
								$prepared_data['typeidname']        = 'productname';
								$prepared_data['title_name']        = 'productname';
								$prepared_data['image_name']        = 'productimage';
								$prepared_data['description_name']  = 'productdescription';

								$post_detail   .= '[AssignedProducts|';
								$products_data = $post_detail .= $this->nab_mys_cron_insert_to_master( $prepared_data );
								$post_detail   .= 'End-of-AssignedProducts]';
							}

							//Assign comma separated wp product ids to exh.
							$products_data = explode( 'products-', $products_data );
							unset( $products_data[0] ); //first item removed as it was not required here
							$prod_ids = array();
							foreach ( $products_data as $single_product ) {
								$single_product = explode( '-', $single_product );
								if ( $single_product[0] ) {
									$prod_ids[] = $single_product[0];
								}
							}
							$prod_ids = implode( ',', $prod_ids );
							update_post_meta( $post_id, 'products_assigned', $prod_ids );
						}

					} else if ( "products" === $post_type ) {

						$save_taxonomies['exhibitor-categories'] = 'categoryname';

					} else if ( "sessions" === $post_type ) {

						//Remove 00:00:00 from date as this is not required.
						$session_date = $individual_item['date'];
						if ( ! empty( $session_date ) ) {
							$session_date = explode( ' ', $session_date );
							if ( isset( $session_date[0] ) ) {
								update_post_meta( $post_id, 'date', $session_date[0] );
							}
						}

						$level = $individual_item['level'];
						if ( ! empty( $level ) ) {
							$levels                            = explode( '^', $level );
							$save_taxonomies['session-levels'] = $levels;
						}
						$save_taxonomies['session-types']     = 'type';
						$save_taxonomies['session-locations'] = 'location';

					} else if ( "speakers" === $post_type ) {
						$save_taxonomies['speaker-companies'] = 'company';
					}

					//Adding/Updating Taxonomies
					foreach ( $save_taxonomies as $tax => $terms ) {
						$terms = ! is_array( $terms ) ? $individual_item[ $terms ] : $terms;

						if ( ( ! is_array( $terms ) && ! empty( $terms ) ) || ( is_array( $terms ) && 0 !== count( $terms ) ) ) {
							$post_detail .= $this->nab_mys_cron_assign_single_term_by_name( $terms, $tax, $post_id );
						}
					}

					$post_ids_to_save_in_session[] = $post_id;

					$post_detail .= '|';

				} else if ( isset( $already_available_id ) && ( "sessions" === $post_type || "exhibitors" === $post_type ) ) {

					// Deleting sessions or exhibitors.

					$update_post_id = $already_available_id;
					wp_trash_post( $update_post_id );

					$post_detail .= "trash-$post_type-" . $update_post_id;
				}
			}

			//Flush previous comma separated relations and add new once.
			if ( ( "speakers" === $post_type || "sponsors" === $post_type ) && null !== $data ) {

				$post_ids_to_save_in_session = implode( ',', $post_ids_to_save_in_session );

				//Resetting sessions meta where (speaker/sponsors) are comma separated and adding new ids.
				$session_post_id = $this->nab_mys_cron_get_wpid_from_meta( 'sessions', $main_mys_key, $main_mys_value );
				update_post_meta( $session_post_id, $post_type, $post_ids_to_save_in_session );

				if ( '' !== $session_post_id ) {
					$post_detail .= "to_session-$session_post_id";
				} else {
					$post_detail .= "-not-found-sessionid-$main_mys_value";
				}
			} else if ( null === $data ) {
				$post_detail .= 'JSON data is not in correct format';
			}

			//Update the final status after a successful migration
			$this->nab_mys_cron_master_confirmed( $item->DataID );

			return $post_detail;
		}

		/**
		 * @param array $single Taxonomy data
		 *
		 * @return array Adding [0] to the single arrays.
		 */
		private function nab_mys_cron_db_single_to_array( $single ) {
			return ( is_array( $single ) && 0 !== count( $single ) && ! isset ( $single[0] ) ) ? array( 0 => $single ) : $single;
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
				'DataEndTime' => current_time( 'Y-m-d H:i:s' ),
				'AddedStatus' => 1,
			), array(
					'DataID' => $data_id
				)
			);

			return $update_status;
		}

		/**
		 * Migration ending status changes.
		 *
		 * @param int $finished_id Migrated History ID
		 * @param string $type Defines whether to changes status of single History ID or a whole Group.
		 *
		 * @return false|int
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		public function nab_mys_cron_migration_ends( $finished_id, $type = 'historyid' ) {

			if ( 'groupid' === $type ) {
				$where_to_finish = array(
					'HistoryGroupID' => $finished_id,
					'HistoryStatus'  => 1
				);
			} else {
				$where_to_finish = array(
					'HistoryID'     => $finished_id,
					'HistoryStatus' => 0
				);
			}

			$update_status = $this->wpdb->update(
				$this->wpdb->prefix . 'mys_history', array(
				'HistoryStatus' => 5,
			), $where_to_finish
			);

			return $update_status;
		}


		/**
		 * Migrating Tracks
		 *
		 * @param array $data_to_migrate $data_to_migrate Tracks data
		 *
		 * @return string Migrated Data Status
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		public function nab_mys_cron_master_tracks( $data_to_migrate ) {

			$data      = $data_to_migrate['data'];
			$item      = $data_to_migrate['item'];
			$sessionid = $data_to_migrate['main_mys_value'];

			/**
			 * 1 - Added
			 * 2 - Updated
			 */
			$item_status = (int) $item->ItemStatus;

			// if sessiond = 0, it means no sessions are assigned to track
			$session_post_id = '';
			if ( 0 !== $sessionid ) {
				$session_post_id = $this->nab_mys_cron_get_wpid_from_meta( 'sessions', 'sessionid', $sessionid );
			}

			$track_post_ids = array();

			$return_detail = '';

			foreach ( $data as $track ) {

				$title       = $track['title'];
				$description = $track['description'];
				$image_url   = $track['icon'];
				$trackid     = $track['trackid'];

				//get tracks wp id from trackid of mys
				$term_data = $this->nab_mys_cron_get_wpid_from_meta( 'tracks', 'trackid', $trackid, 'taxonomy' );

				$term_id = ! empty( $term_data ) ? $term_data->term_id : '';

				if ( ! empty( $term_id ) && 2 === $item_status ) {

					//Update term
					$track_post_id = $term_id;

					wp_update_term( $track_post_id, 'tracks', array(
						'name'        => $title,
						'description' => $description,
					) );

					$return_detail .= "old";

				} else if ( empty( $term_id ) ) {

					//Insert new term
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

					//Insert term meta
					update_term_meta( $track_post_id, 'trackid', $trackid );
				}

				//Upload image
				if ( ( empty( $term_id ) && 1 === $item_status ) || 2 === $item_status ) {

					//Upload Image to WP Media Library and assign to Track
					$attach_id = $this->nab_mys_media->nab_mys_upload_media( $track_post_id, $image_url, "tracks" );

				}
				$track_post_ids[] = $track_post_id;

				$return_detail .= "-track-$track_post_id|";

				if ( $attach_id ) {
					$return_detail .= "-attach_id_$attach_id|";
				}

			}

			if ( isset( $session_post_id ) && '' !== $session_post_id ) {

				wp_set_post_terms( $session_post_id, $track_post_ids, 'tracks' );

				$return_detail .= "to_session-$session_post_id";

			} else {
				// session not exist

				$return_detail .= "|not-found-sessionid-$sessionid";
			}

			//Update the final status after a successful migration
			$this->nab_mys_cron_master_confirmed( $item->DataID );

			return $return_detail;
		}


		/**
		 * Get WP ID from the given MYS ID
		 *
		 * @param string $type_name name of item
		 * @param string $main_mys_key MYS key
		 * @param int $main_mys_value MYS value
		 * @param string $type Post Type of Taxonomy
		 *
		 * @return string Taxonomy or Post Type Data
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		public function nab_mys_cron_get_wpid_from_meta( $type_name, $main_mys_key, $main_mys_value, $type = 'post_type' ) {

			// WP_Query arguments
			$meta_args = array(
				'meta_query' => array(
					array(
						'key'   => $main_mys_key,
						'value' => $main_mys_value,
					),
				),
			);

			if ( 'post_type' === $type ) {
				$required_args = array(
					'post_type' => array( $type_name ),
				);

				$args = array_merge( $meta_args, $required_args );

				//The Query
				$wp_post = new WP_Query( $args );

				$return_data = isset( $wp_post->posts[0]->ID ) ? $wp_post->posts[0]->ID : '';

			} else {

				$required_args = array(
					'hide_empty' => false, // also retrieve terms which are not used yet
					'taxonomy'   => $type_name,
				);

				$args = array_merge( $meta_args, $required_args );

				$terms = get_terms( $args );

				$return_data = isset( $terms[0] ) ? $terms[0] : '';
			}

			// Restore original Post Data
			wp_reset_postdata();

			return $return_data;

		}


		/**
		 * Assign term to post by its name.
		 *
		 * @param array|string $titles An array of term names or a single term name as string.
		 * @param string $taxonomy The texonomy slug
		 * @param int $post_id The post id to which the taxonomies will be assigned.
		 *
		 * @return string
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		public function nab_mys_cron_assign_single_term_by_name( $titles, $taxonomy, $post_id ) {

			if ( ! is_array( $titles ) ) {
				$term     = $titles;
				$titles   = array();
				$titles[] = $term;
			}

			$terms_ids = array();

			$post_detail = '';

			foreach ( $titles as $single_title ) {

				//escaping new lines and returns
				$single_title = trim( $single_title );
				if ( empty( $single_title ) ) {
					continue;
				}

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
						$taxonomy
					);

					//Term already available on this point, then use it.
					if ( isset( $term_id_data->error_data['term_exists'] ) ) {
						$terms_ids[] = $term_post_id = $term_id_data->error_data['term_exists'];
						$post_detail .= "old";
					} else {
						$terms_ids[] = $term_post_id = $term_id_data['term_id'];
						$post_detail .= "new";
					}
				}
				$post_detail .= "-$term_post_id";
			}

			$skip_assigns = array(
				'exhibitor-keywords' => array( 'Featured' )
			);

			foreach ( $skip_assigns as $tax => $skip_terms ) {
				if ( $tax === $taxonomy ) {
					foreach ( $skip_terms as $s_term ) {
						if ( has_term( $s_term, $taxonomy, $post_id ) ) {
							//get wpid of $s_term and merge with $terms_ids..
							$existing_term_data = get_term_by( 'name', $s_term, $taxonomy );
							$terms_ids[]        = $existing_term_data->term_id;
							$post_detail        .= "|kept-$taxonomy-$term_post_id";
						}
					}
				}
			}

			//remember to flush existing one before assigning
			wp_set_post_terms( $post_id, $terms_ids, $taxonomy );

			return $post_detail;
		}


		/**
		 * Get data of recently migrated Group Id, so emails can be sent
		 *
		 * @param string $groupid A unique group id.
		 *
		 * @return array Data with the Data types and their added statues.
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		public function nab_mys_cron_get_group_rows( $groupid ) {

			$wpdb = $this->wpdb;

			$group_rows = $wpdb->get_results(
				$wpdb->prepare( "SELECT HistoryID, DataType, AddedStatus FROM %1smys_data
					WHERE DataGroupID = %s
					GROUP BY DataType, AddedStatus",
					$wpdb->prefix, $groupid ) );

			return $group_rows;
		}


		/**
		 * Get specific history's data by its group id.
		 *
		 * @param string $groupid A unique group id.
		 *
		 * @return array Data for history.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_get_specific_group_history( $groupid ) {

			$wpdb = $this->wpdb;

			$group_hisotry = $wpdb->get_row(
				$wpdb->prepare( "SELECT * FROM %1smys_history
					WHERE HistoryGroupID = %s
					", $wpdb->prefix, $groupid ) );

			return $group_hisotry;
		}


		/**
		 * Reseting data id as Master cron was stuck in it.
		 *
		 * @param int $dataid A unique data id.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_reset_dataid( $dataid ) {

			$wpdb = $this->wpdb;

			$wpdb->update(
				$wpdb->prefix . 'mys_data', array(
				'AddedStatus' => 4,
			), array( 'DataID' => $dataid ) );

		}

		/**
		 * Send Emails
		 *
		 * @param string $email_subject Subject for email.
		 * @param string $email_body HTML for email body.
		 */
		static function nab_mys_static_email( $email_subject, $email_body ) {

			$nab_mys_urls = get_option( 'nab_mys_urls' );
			$to_email     = isset ( $nab_mys_urls['to_email'] ) ? $nab_mys_urls['to_email'] : get_option( 'admin_email' );
			$cc_email     = isset ( $nab_mys_urls['cc_email'] ) ? $nab_mys_urls['cc_email'] : '';

			$headers   = array( 'Content-Type: text/html; charset=UTF-8' );
			$headers[] = 'From: NABShow <noreply@nabshow.com>';

			if ( ! empty( $cc_email ) ) {
				$cc_emails = explode( ',', $cc_email );
				foreach ( $cc_emails as $cc_email ) {
					$headers[] = 'Cc: ' . $cc_email;
				}
			}

			wp_mail( $to_email, $email_subject, $email_body, $headers );
		}

		/**
		 * Resetting sequence due to the stuck.
		 *
		 * @param string $stuck_groupid Defines whether to reset a specific group id or reset globally
		 */
		static function nab_mys_static_reset_sequence( $stuck_groupid = 'global' ) {

			global $wpdb;

			$where_to_update1 = array( 'HistoryStatus' => 0 );
			$where_to_update2 = array( 'HistoryStatus' => 1 );
			$where_to_update3 = array( 'AddedStatus' => 0 );

			if ( 'global' !== $stuck_groupid ) {
				$where_to_update1['HistoryGroupID'] = $where_to_update2['HistoryGroupID'] = $where_to_update3['DataGroupID'] = $stuck_groupid;
			}

			$wpdb->update(
				$wpdb->prefix . 'mys_history', array(
				'HistoryStatus' => 3,
			), $where_to_update1 );

			$wpdb->update(
				$wpdb->prefix . 'mys_history', array(
				'HistoryStatus' => 4,
			), $where_to_update2 );

			$wpdb->update(
				$wpdb->prefix . 'mys_data', array(
				'AddedStatus' => 4,
			), $where_to_update3 );

		}

	}
}
