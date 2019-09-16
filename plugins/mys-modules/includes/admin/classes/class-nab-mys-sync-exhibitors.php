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

			//Intitialize the Rest End Point
			add_action( 'rest_api_init', array( $this, 'nab_mys_cron_exh_end_points' ) );

			//Create DB Class Object
			$this->nab_mys_load_exh_db_class();

			parent::__construct();

		}

		public function nab_mys_load_exh_db_class() {

			//Class File - DataBase Queries
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-db-exhibitors.php' );

			//Initialize Database Class Instance to store the Response Data.
			$this->nab_mys_db_exh = new NAB_MYS_DB_Exhibitors();

			$this->nab_mys_db_exh->nab_mys_db_set_wpdb();

		}

		public function nab_mys_sync_exhibitors() {

			$this->nab_mys_set_ajax_data();

			//$this->requested_for = ( '' === $this->past_request || null === $this->past_request ) ? 'exhibitors' : 'single-exhibitor';

			//checking lock
			$this->nab_mys_sync_check_lock_exh();

			//Initialize the Record
			$this->nab_mys_sync_exh_initialize();

			$mys_response_body = $this->nab_mys_get_response();

			//Finalize the Record
			$this->nab_mys_sync_exh_finalize( $mys_response_body );

		}

		private function nab_mys_sync_exh_initialize() {

			//Get MYS API Request URL.
			$this->mys_request_url = $this->nab_mys_get_request_url( $this->current_request );

			if ( "exhibitors" === $this->current_request ) {

				//fetch categories...
				//$this->nab_mys_sync_exh_categories();

				//If fresh button clicked, Generate a uniqe 10 digit alphanumeric string for Group ID.
				$this->nab_mys_set_groupid();

				//Insert a pending row in History table
				$this->history_id = $this->nab_mys_db_exh->nab_mys_db_history_data( 'modified-exhibitors', "insert", $this->group_id, 0, $this->flow );

			} else {

				// get 1 row where data is blank and group id = $this->groupid
				$single_exh_data = $this->nab_mys_db_exh->nab_mys_db_row_pending_id_getter( $this->group_id );

				if ( isset ( $single_exh_data[0]->ModifiedID ) ) {

					$this->exhid  = $single_exh_data[0]->ModifiedID;
					$this->dataid = $single_exh_data[0]->DataID;

					$this->mys_request_url = $this->mys_request_url . '?exhid=' . $this->exhid;

				} else {

					$this->nab_mys_sync_exh_finish();

				}

			}
		}

		private function nab_mys_sync_exh_finalize( $mys_response_body ) {

			if ( 'exhibitors' === $this->current_request ) {

				$exhibitor_modified_array = $mys_response_body[0]->exhibitors;

				//ne_testing purpose only.. remove beore PR.
				if ( isset( $_SERVER['HTTP_REFERER'] ) ) {
					$total_rows = explode( 'rows=', $_SERVER['HTTP_REFERER'] ); //phpcs:ignore
				}
				$total_rows               = isset ( $total_rows[1] ) ? (int) $total_rows[1] : 10000;
				$exhibitor_modified_array = array_slice( $exhibitor_modified_array, 0, $total_rows );

				if ( 0 === count( $exhibitor_modified_array ) ) {

					$this->nab_mys_db_exh->nab_mys_db_history_data( "modified-exhibitors", "update", $this->group_id, 1 );

					$error_message = "Modifed Sessions array is empty";

					$this->nab_mys_display_error( $error_message );

				} else {

					//set data_json in DB Class to pass modified data to update in db indirectly.
					$this->nab_mys_db_exh->nab_mys_db_set_data_json( $this->data_json );

					$this->nab_mys_db_exh->nab_mys_db_history_data( "modified-exhibitors", "update", $this->group_id, 0, count( $exhibitor_modified_array ) );

					//Let's add rows with blank mys data.
					$this->nab_mys_db_exh->nab_mys_db_exh_rows_maker( 'single-exhibitor', $this->history_id, $this->group_id, $exhibitor_modified_array, 3 );
				}

				$this->total_counts = count( $exhibitor_modified_array );

			} else {

				$this->data_array[0] = $this->data_array[0]->exhibitor;
				$this->data_json     = wp_json_encode( $this->data_array );

				$this->nab_mys_db_exh->nab_mys_db_row_filler( $this->dataid, $this->data_json );

				$this->finished_counts = $this->finished_counts + 1;

			}

			$this->nab_mys_sync_exh_reloop();

		}

		private function nab_mys_sync_exh_reloop() {

			//Now everything is done for the current request so making it a past request
			$this->past_request = $this->current_request;

			//If the stack is still not empty, re call main function to fetch next data.
			if ( "wpajax" === $this->flow ) {

				/*if ( $this->final_stack_item === $this->current_request ) {
					$this->current_request = ''; //this will stop recurring ajax
				}*/

				echo wp_json_encode(
					array(
						"pastItem"       => $this->past_request, /* $this->current_request,*/
						"requestedFor"   => 'single-exhibitor', /*$this->current_request,*/ /*$this->requested_for*/
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

		private function nab_mys_sync_exh_finish() {

			// if there are no rows.. make main modified-exhibitors row's status from 0 to 1 in history table
			$this->nab_mys_db_exh->nab_mys_db_history_data( "modified-exhibitors", "finish", $this->group_id );
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

				echo esc_html( "CRON sequence ($this->group_id) is now completed successfully." );
				die();

			}
		}

		private function nab_mys_sync_exh_categories() {

			$this->mys_request_url = $this->nab_mys_get_request_url( 'exhibitor-categories' );
			$mys_response_body     = $this->nab_mys_get_response();
			$exhibitor_categories  = $mys_response_body[0]->categories;
			$cats_updated          = $this->nab_mys_db_exh->nab_mys_db_exh_categories( $exhibitor_categories );

			//return $cats_updated;

		}

		private function nab_mys_sync_check_lock_exh() {

			//If its cron flow, requested_for will be null, so set it to exhibitors.
			$this->requested_for = null === $this->requested_for ? 'exhibitors' : $this->requested_for;

			if ( "exhibitors" === $this->requested_for ) {

				$pending_data = $this->nab_mys_db_exh->nab_mys_cron_get_latest_groupid( $this->requested_for );

				if ( 0 !== $pending_data ) {

					$this->group_id       = $pending_data[0]->HistoryGroupID;
					$history_pending_data = $pending_data[0]->HistoryData;

					if ( empty( $history_pending_data ) ) {

						$error_message = 'New pull request can not be initialized because 1 pull request is just started, please wait until it finishes.';

						//Create a HTML Paragraph for Message to display via Ajax
						$error_message_html = "<p class='red-notice mys-error-notice'>$error_message</p>";

						if ( "wpajax" === $this->flow ) {

							echo wp_json_encode( array( "apiError" => $error_message_html ) );
							wp_die();
						} else {
							//CRON
							echo esc_html( $error_message );
							die();
						}

					} else {

						$data_json          = str_replace( "\'", "'", $history_pending_data );
						$data_array         = json_decode( $data_json, true );
						$this->total_counts = count( $data_array[0]['exhibitors'] );

						//Previous sequence will be forced to continue with current request = 'single-exhibitor' and old group id

						$this->finished_counts = $this->nab_mys_db_exh->nab_mys_db_rows_ready_total_getter( $this->group_id );
						$this->requested_for   = 'single-exhibitor';

					}
				}
			}

			$this->current_request = $this->requested_for;

		}

		/**
		 * Rest End Points
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
			public
			function nab_mys_cron_exh_end_points() {

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
			public
			function nab_mys_cron_exh_api_to_custom( WP_REST_Request $request ) {

				return $this->nab_mys_sync_exhibitors();

			}

			public
			function nab_mys_exh_csv() {

				$sync_exhibitors_data = FILTER_INPUT( INPUT_POST, 'sync_exhibitors_nonce', FILTER_SANITIZE_STRING );

				if ( wp_verify_nonce( $sync_exhibitors_data, 'sync_exhibitors_data' ) ) {
					$filters = array(
						"exhibitors-csv" => array(
							"filter" => FILTER_SANITIZE_STRING,
							'flags'  => FILTER_REQUIRE_ARRAY,
						),
					);

					$exh_csv_file_data = filter_var_array( $_FILES, $filters );
					$exh_csv_file_data = $exh_csv_file_data['exhibitors-csv'];

					if ( isset( $exh_csv_file_data['name'] ) && empty( $exh_csv_file_data['name'] ) ) {
						set_transient( 'exh_error_message', __( 'Please upload a CSV file', 'mys-modules' ), 45 );
						wp_safe_redirect( admin_url( 'admin.php?page=mys-exhibitors' ) );
						exit();
					}

					$this->nab_mys_set_groupid();

					$filename = 'exhibitors-' . $this->group_id . '.csv';

					$exh_target_dir = wp_get_upload_dir()['basedir'] . '/mys-uploads/';

					if ( ! file_exists( $exh_target_dir ) ) {
						wp_mkdir_p( $exh_target_dir );
					}

					$exh_target_file      = $exh_target_dir . $filename;
					$exh_target_temp_file = $exh_csv_file_data["tmp_name"];
					$exh_fileType         = strtolower( pathinfo( $exh_target_file, PATHINFO_EXTENSION ) );

					if ( $exh_fileType !== "csv" ) {
						set_transient( 'exh_error_message', __( 'Sorry, this file type is not allowed.', 'mys-modules' ), 45 );
						wp_safe_redirect( admin_url( 'admin.php?page=mys-exhibitors' ) );
						exit();
					}

					if ( move_uploaded_file( $exh_target_temp_file, $exh_target_file ) ) {

						$row      = 0;
						$exh_data = $columns = array();
						$handle   = fopen( $exh_target_file, "r" );
						if ( $handle !== false ) {
							while ( ( $data = fgetcsv( $handle, 0, "," ) ) !== false ) {

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
										/*$exh_data[ $row - 1 ][0]['exhibitor'][ $columns[ $c ] ] = $data[ $c ];*/
										$exh_data[ $row - 1 ][0][ $columns[ $c ] ] = $data[ $c ];
									}
								}
								$row ++;
							}
							fclose( $handle );
						}

						if ( isset( $exh_data ) && is_array( $exh_data ) ) {

							//fetch categories...
							$this->nab_mys_sync_exh_categories();

							//Insert a pending row in History table
							$history_id = $this->nab_mys_db_exh->nab_mys_db_history_data( "modified-exhibitors-csv", "insert", $this->group_id );

							//set data_json in DB Class to pass modified data to update in db indirectly.
							$data_json = wp_json_encode( $exh_data );
							$this->nab_mys_db_exh->nab_mys_db_set_data_json( $data_json );

							$no_of_exh_inserted = $this->nab_mys_db_exh->nab_mys_db_exh_rows_maker( 'single-exhibitor-csv', $history_id, $this->group_id, $exh_data, 0 );

							$this->nab_mys_db_exh->nab_mys_db_history_data( "modified-exhibitors-csv", "update", $this->group_id, 1, $no_of_exh_inserted );

							$success = 1;
						} else {
							$success = 4;
						}
					} else {
						$success = 3;
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
