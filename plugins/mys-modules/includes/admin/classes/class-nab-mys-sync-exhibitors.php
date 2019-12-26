<?php
/**
 * Exhibitors Class
 *
 * @package MYS Modules
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'NAB_MYS_Exhibitors' ) ) {

	/**
	 * Class NAB_MYS_Exhibitors
	 */
	class NAB_MYS_Exhibitors extends NAB_MYS_Sync_Parent {

		private $total_counts;

		private $exhid;

		private $dataid;

		private $nab_mys_db_exh;

		/**
		 * Class Constructor
		 */
		public function __construct() {

			//Upload CSV
			add_action( 'admin_post_sync_exhibitors_request', array( $this, 'nab_mys_exh_csv' ) );

			//Action for the Ajax Call from ( /assets/js/nab-mys-script.js ).
			add_action( 'wp_ajax_nab_mys_exhibitor_data', array( $this, 'nab_mys_sync_exhibitors' ) );
			add_action( 'wp_ajax_nopriv_nab_mys_exhibitor_data', array( $this, 'nab_mys_sync_exhibitors' ) );

			//Initialize the Rest End Point
			add_action( 'rest_api_init', array( $this, 'nab_mys_cron_exh_end_points' ) );

			//Create DB Class Object
			$this->nab_mys_load_exh_db_class();

			parent::__construct();
		}

		/**
		 * Load a DB Class for Exhibitors.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_load_exh_db_class() {

			//Class File - DataBase Queries
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-db-exhibitors.php' );

			//Initialize Database Class Instance to store the Response Data.
			$this->nab_mys_db_exh = new NAB_MYS_DB_Exhibitors();

		}

		/**
		 * Start exhibitors syncing.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_sync_exhibitors() {

			$this->nab_mys_set_ajax_data();

			//checking lock
			$this->nab_mys_sync_check_lock_exh();

			//Initialize the Record
			$mys_response_body = $this->nab_mys_sync_exh_initialize();

			//Finalize the Record
			$this->nab_mys_sync_exh_finalize( $mys_response_body );

		}

		private function nab_mys_sync_exh_finalize( $mys_response_body ) {

			if ( 'exhibitors' === $this->current_request ) {

				$exhibitor_modified_array = $mys_response_body[0]->exhibitors;

				$referer = filter_input( INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_URL );
				if ( isset( $referer ) ) {
					$total_rows = explode( 'rows=', $referer );
				}
				$total_rows               = isset ( $total_rows[1] ) ? (int) $total_rows[1] : 10000;
				$exhibitor_modified_array = array_slice( $exhibitor_modified_array, 0, $total_rows );

				//set data_json in DB Class to pass modified data to update in db indirectly.
				$this->nab_mys_db_exh->nab_mys_db_set_data_json( $this->data_json );

				if ( 0 === count( $exhibitor_modified_array ) ) {

					$this->nab_mys_db_exh->nab_mys_db_history_data( "modified-exhibitors", "update", $this->group_id, 5 );

					$this->requested_for = 'empty';

					$this->nab_mys_sync_exh_finish();

				} else {

					//initialize main history row
					$this->nab_mys_db_exh->nab_mys_db_history_data( "modified-exhibitors", "update", $this->group_id, 0, count( $exhibitor_modified_array ) );

					//Let's add rows with blank mys data.
					$bulk_result = $this->nab_mys_db_exh->nab_mys_db_exh_rows_maker( 'single-exhibitor', $this->history_id, $this->group_id, $exhibitor_modified_array, 6 );
					if ( 2 === $bulk_result['bulk_status'] ) {
						$error_message = "Failed to store details in Database.";
						$this->nab_mys_display_error( $error_message );
					}
				}

				$this->total_counts = count( $exhibitor_modified_array );

			} else {

				$this->data_array[0] = $this->data_array[0]->exhibitor;
				$this->nab_mys_db_exh->nab_mys_db_set_data_json( wp_json_encode( $this->data_array ) );
				$this->nab_mys_db_exh->nab_mys_db_row_filler( $this->dataid );

				$this->finished_counts = $this->finished_counts + 1;

			}

			$this->nab_mys_sync_exh_reloop();

		}

		/**
		 * Initializing Exhibitors Sync
		 *
		 * @return mixed Response Body
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		private function nab_mys_sync_exh_initialize() {

			if ( 'exhibitors' === $this->current_request && 1 === MYS_PLUGIN_MODIFIED_SEQUENCE ) {
				$this->previous_date = $this->nab_mys_db_exh->nab_mys_db_previous_date( 'modified-exhibitors' );
			}

			//Get MYS API Request URL.
			$this->mys_request_url = $this->nab_mys_get_request_url( $this->current_request );

			if ( "exhibitors" === $this->current_request ) {

				//If fresh button clicked, Generate a unique 10 digit alphanumeric string for Group ID.
				$this->nab_mys_set_groupid();

				$mys_response_body = $this->nab_mys_get_response();

				//Insert a pending row in History table
				$this->history_id = $this->nab_mys_db_exh->nab_mys_db_history_data( 'modified-exhibitors', "insert", $this->group_id, 0 );

				return $mys_response_body;

			} else {

				// get 1 row where data is blank and group id = $this->groupid
				$single_exh_data = $this->nab_mys_db_exh->nab_mys_db_row_pending_id_getter( $this->group_id );

				if ( isset ( $single_exh_data[0]->ModifiedID ) ) {

					$this->exhid  = $single_exh_data[0]->ModifiedID;
					$this->dataid = $single_exh_data[0]->DataID;

					$this->mys_request_url = $this->mys_request_url . '?exhid=' . $this->exhid;

					$mys_response_body = $this->nab_mys_get_response();

					return $mys_response_body;

				} else {

					$this->nab_mys_sync_exh_finish();

				}

			}
		}

		/**
		 * Re-looping exhibitors sync process.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		private function nab_mys_sync_exh_reloop() {

			//Now everything is done for the current request so making it a past request
			$this->past_request = $this->current_request;

			//If the stack is still not empty, re call main function to fetch next data.
			if ( "wpajax" === $this->flow ) {

				echo wp_json_encode(
					array(
						"pastItem"       => $this->past_request,
						"requestedFor"   => 'single-exhibitor',
						"groupID"        => $this->group_id,
						"totalCounts"    => $this->total_counts,
						"finishedCounts" => $this->finished_counts
					)
				);
				wp_die();


			} else {

				$this->nab_mys_sync_exhibitors();

			}
		}

		/**
		 * Finishing Exhibitors Sync.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		private function nab_mys_sync_exh_finish() {

			// if there are no rows, make main modified-exhibitors row's status from 0 to 1 in history table
			if ( 'empty' !== $this->requested_for ) {
				$this->nab_mys_db_exh->nab_mys_db_history_data( "modified-exhibitors", "finish", $this->group_id );
			}
			// This will open a lock !!

			//If the stack is still not empty, re call main function to fetch next data.
			if ( "wpajax" === $this->flow ) {

				$this->past_request = 'finish'; //this will stop recurring ajax

				echo wp_json_encode(
					array(
						"pastItem"     => $this->past_request,
						"requestedFor" => $this->requested_for,
						"groupID"      => $this->group_id
					)
				);
				wp_die();

			} else {

				if ( 'empty' === $this->requested_for ) {
					esc_html_e( "Everything is upto date." );
				} else {
					esc_html_e( "CRON sequence ($this->group_id) is now completed successfully." );
				}
				die();

			}
		}

		/**
		 * Get exhibitors Categories and save in WordPress as taxonomy.
		 * This process will happen only once at the time of CSV Upload.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		private function nab_mys_sync_exh_categories() {

			$this->mys_request_url = $this->nab_mys_get_request_url( 'exhibitor-categories' );
			$mys_response_body     = $this->nab_mys_get_response();
			$exhibitor_categories  = $mys_response_body[0]->categories;

			$this->nab_mys_db_exh->nab_mys_db_exh_categories( $exhibitor_categories );
		}

		/**
		 * Check the lock for Exhibitor Sync.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		private function nab_mys_sync_check_lock_exh() {

			//If its cron flow, requested_for will be null, so set it to exhibitors.
			$this->requested_for = null === $this->requested_for ? 'exhibitors' : $this->requested_for;

			if ( "exhibitors" === $this->requested_for ) {

				$pending_data = $this->nab_mys_db_exh->nab_mys_db_get_latest_groupid( $this->requested_for );

				if ( 0 !== $pending_data ) {

					$this->group_id       = $pending_data[0]->HistoryGroupID;
					$history_pending_data = $pending_data[0]->HistoryData;

					$data_json = $history_pending_data;

					$data_array         = json_decode( $data_json, true );
					$this->total_counts = count( $data_array[0]['exhibitors'] );

					//Previous sequence will be forced to continue with current request = 'single-exhibitor' and old group id

					$this->finished_counts = $this->nab_mys_db_exh->nab_mys_db_rows_ready_total_getter( $this->group_id );
					$this->requested_for   = 'single-exhibitor';

					$exh_prev_finished_counts = (int) get_option( 'exh_prev_finished_counts' );
					$exh_counts_matched_on = (int) get_option( 'exh_counts_matched_on' );

					//Update Finished Counts to check it in the next attempt.
					update_option( 'exh_prev_finished_counts', $this->finished_counts );

					if ( $this->finished_counts === $exh_prev_finished_counts ) {

						if ( $exh_counts_matched_on === $exh_prev_finished_counts ) {

						//Check attempt count and stop if increased by 3.
						$mail_data                  = array();
						$mail_data['stuck_groupid'] = $this->group_id;
						$mail_data['data']          = 'Exhibitors';
						$mail_data['tag']           = 'mys_data_attempt_exhibitors';

						$this->nab_mys_increase_attempt( $mail_data );

						} else {
							update_option( 'exh_counts_matched_on', $this->finished_counts );
						}
					}
				} else {
					update_option( 'exh_prev_finished_counts', 0 );
				}
			}

			$this->current_request = $this->requested_for;

		}

		/**
		 * Rest End Points for exhibitors.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_cron_exh_end_points() {

			/**
			 * wp-json/mys/get-data?datatype=1
			 * wp-json/mys/get-data?datatype=2
			 */
			register_rest_route( 'mys', '/get-exh', array(
					'methods'  => 'GET',
					'callback' => array( $this, 'nab_mys_cron_exh_api_to_custom' )
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
		public function nab_mys_cron_exh_api_to_custom( WP_REST_Request $request ) {

			return $this->nab_mys_sync_exhibitors();

		}

		/**
		 * Upload Exhibitors CSV.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_exh_csv() {

			$sync_exhibitors_data = FILTER_INPUT( INPUT_POST, 'sync_exhibitors_nonce', FILTER_SANITIZE_STRING );
			$date_csv             = FILTER_INPUT( INPUT_POST, 'date-csv', FILTER_SANITIZE_STRING );
			$time_csv             = FILTER_INPUT( INPUT_POST, 'time-csv', FILTER_SANITIZE_STRING );
			$csv_from_date        = "$date_csv $time_csv";
			$current_time         = current_time( 'Y-m-d h:i:s' );

			if ( empty( $date_csv ) || empty( $time_csv ) || $csv_from_date > $current_time ) {
				wp_safe_redirect( admin_url( 'admin.php?page=mys-exhibitors&success=5' ) );
				exit();
			}

			if ( wp_verify_nonce( $sync_exhibitors_data, 'sync_exhibitors_data' ) ) {
				$filters = array(
					"exhibitors-csv" => array(
						"filter" => FILTER_SANITIZE_STRING,
						'flags'  => FILTER_REQUIRE_ARRAY,
					),
				);

				$exh_csv_file_data = filter_var_array( $_FILES, $filters );
				$exh_csv_file_data = $exh_csv_file_data['exhibitors-csv'];

				$exh_file_type = strtolower( pathinfo( $exh_csv_file_data['name'], PATHINFO_EXTENSION ) );

				if ( $exh_file_type !== "csv" ) {
					$success = 4;

				} else {

					$this->nab_mys_set_groupid();

					$filename = 'exhibitors-' . $this->group_id . '.csv';

					$exh_base_dir   = wp_get_upload_dir()['basedir'];
					$exh_target_dir = $exh_base_dir . '/mys-uploads/';
					if ( ! file_exists( $exh_target_dir ) ) {
						wp_mkdir_p( $exh_target_dir );
					}

					$exh_target_file = $exh_target_dir . $filename;

					$exh_target_temp_file = $exh_csv_file_data["tmp_name"];

					if ( move_uploaded_file( $exh_target_temp_file, $exh_target_file ) ) {

						$success = 1;

						global $wp_filesystem;
						if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base' ) ) {
							$creds = request_filesystem_credentials( site_url() );
							wp_filesystem( $creds );
						}

						$handle    = $wp_filesystem->get_contents( $exh_target_file );
						$delimiter = ',';
						$handle    = str_replace( "\r\n", "\r", $handle );
						$all_lines = str_getcsv( $handle, "\r" );
						if ( ! $all_lines ) {
							return false;
						}

						$handle_new = array_map(
							function ( &$line ) use ( $delimiter ) {
								return str_getcsv( $line, $delimiter );
							},
							$all_lines
						);

						$row      = 0;
						$exh_data = $columns = array();

						if ( $handle !== false ) {
							foreach ( $handle_new as $data ) {

								if ( empty( $data[0] ) ) { // ignore blank lines
									continue;
								}

								$num = 0 !== count( $columns ) ? count( $columns ) : count( $data );

								for ( $c = 0; $c < $num; $c ++ ) {

									if ( 0 === $row ) {
										if ( ! empty( $data[ $c ] ) ) {
											$columns[] = $data[ $c ];
										}
									} else {
										$exh_data[ $row - 1 ][0][ $columns[ $c ] ] = $data[ $c ];
									}
								}
								$row ++;
							}
						}

						if ( isset( $exh_data ) && is_array( $exh_data ) ) {

							//fetch categories...
							$this->nab_mys_sync_exh_categories();

							//Insert a pending row in History table
							$history_id = $this->nab_mys_db_exh->nab_mys_db_history_data( "modified-exhibitors-csv", "insert", $this->group_id );

							//From/Start date updated
							$this->nab_mys_db_exh->nab_mys_db_exh_csv_from_date( $history_id, $csv_from_date );

							//set data_json in DB Class to pass modified data to update in db indirectly.
							$data_json = wp_json_encode( $exh_data );
							$this->nab_mys_db_exh->nab_mys_db_set_data_json( $data_json );

							$bulk_result        = $this->nab_mys_db_exh->nab_mys_db_exh_rows_maker( 'single-exhibitor-csv', $history_id, $this->group_id, $exh_data, 0 );
							$no_of_exh_inserted = $bulk_result['row_counts'];
							$bulk_status        = $bulk_result['bulk_status'];

							if ( 2 === $bulk_status ) {
								$error_message = "Failed to store details in Database.";
								$this->nab_mys_display_error( $error_message );
							}
							$this->nab_mys_db_exh->nab_mys_db_history_data( "modified-exhibitors-csv", "update", $this->group_id, $bulk_status, $no_of_exh_inserted );

						} else {
							$success = 4;
						}
					} else {
						$success = 3;
					}
				}

			} else {
				$success = 2;
			}

			if ( 1 === $success ) {

				$exh_target_file_url = explode( 'wp-content', $exh_target_file );
				$exh_target_file_url = get_site_url() . '/wp-content' . $exh_target_file_url[1];

				$success = "1&exh-inserted=$no_of_exh_inserted&csv-link=$exh_target_file_url";

				add_option( 'exhibitors-csv-' . $this->group_id, $exh_target_file_url, '', 'no' );

			}

			wp_safe_redirect( admin_url( 'admin.php?page=mys-exhibitors&success=' . $success ) );
			exit();

		}

	}
}
new NAB_MYS_Exhibitors();
