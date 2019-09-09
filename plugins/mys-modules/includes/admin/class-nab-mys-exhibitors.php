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

	class NAB_MYS_Exhibitors {

		private $obj_endpoints;

		private $requested_for;

		private $current_request;

		private $past_request;

		private $total_counts;

		private $finished_counts;

		private $final_stack_item;

		private $group_id;

		private $history_id;

		private $exhid;

		private $dataid;

		private $data_json;

		private $data_array;

		private $flow;

		private $exhibitor_modified_array;

		private $mys_request_url;


		/**
		 * Class Constructor
		 */
		public function __construct() {

			//Upload CSV
			add_action( 'admin_post_sync_exhibitors_request', array( $this, 'nab_mys_exh_csv' ) );

			//Action for the Ajax Call from ( /assets/js/nab-mys-script.js ).
			add_action( 'wp_ajax_nab_mys_exhibitor_data', array( $this, 'nab_mys_exh_api' ) );
			add_action( 'wp_ajax_nopriv_nab_mys_exhibitor_data', array( $this, 'nab_mys_exh_api' ) );

			$this->obj_endpoints = new NAB_MYS_Endpoints();

			//Intitialize the Rest End Point
			add_action( 'rest_api_init', array( $this, 'nab_mys_cron_exh_end_points' ) );

		}

		public function nab_mys_exh_api() {

			$requested_for = filter_input( INPUT_POST, 'requested_for', FILTER_SANITIZE_STRING );
			$group_id      = filter_input( INPUT_POST, 'group_id', FILTER_SANITIZE_STRING );
			$past_request  = filter_input( INPUT_POST, 'past_request', FILTER_SANITIZE_STRING );
			//$this->total_counts    = filter_input( INPUT_POST, 'totalCounts', FILTER_SANITIZE_STRING );
			$this->finished_counts = (int) filter_input( INPUT_POST, 'finished_counts', FILTER_SANITIZE_STRING );

			if ( isset( $requested_for ) ) {

				check_ajax_referer( 'mys-ajax-nonce', 'security' );

				$this->group_id     = ( "" !== sanitize_text_field( $group_id ) ) ? sanitize_text_field( $group_id ) : "";
				$this->past_request = ( "" !== sanitize_text_field( $past_request ) ) ? sanitize_text_field( $past_request ) : "";
				$this->flow         = 'wpajax';

			} else {

				//$requested_for = $this->requested_for = null === $this->past_request ? 'exhibitors' : 'single-exhibitor';

				$this->flow = 'restapi';

				//$this->past_request = "modified-exhibitors";

			}

			$this->requested_for = $requested_for = ( '' === $past_request || null === $past_request ) ? 'exhibitors' : 'single-exhibitor';

			//$this->final_stack_item = $this->requested_for;

			//checking lock
			if ( "exhibitors" === $requested_for ) {

				$pending_data = $this->obj_endpoints->nab_mys_db->nab_mys_cron_get_latest_groupid( $requested_for );

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

						$this->finished_counts = $this->obj_endpoints->nab_mys_db->nab_mys_db_row_finished_counts( $this->group_id );
						$this->requested_for   = $requested_for = 'single-exhibitor';

					}
				}
			}

			if ( "exhibitors" === $requested_for ) {

				//fetch categories...
				/*$this->mys_request_url = $this->obj_endpoints->nab_mys_get_request_url( 'exhibitor-categories' );
				$mys_response_body = $this->nab_mys_exh_get_response();
				$exhibitor_categories = $mys_response_body[0]->categories;
				$cats_updated = $this->obj_endpoints->nab_mys_db->nab_mys_db_exh_categories( $exhibitor_categories );*/

				$this->current_request = 'exhibitors';

				//If fresh button clicked, Generate a uniqe 10 digit alphanumeric string for Group ID.
				if ( empty( $this->group_id ) ) {
					$this->group_id = $this->obj_endpoints->nab_mys_random_id();
				}

				//Insert a pending row in History table
				$this->history_id = $this->obj_endpoints->nab_mys_db->nab_mys_db_history_data( 'modified-exhibitors', "insert", $this->group_id, 0, $this->flow );

			} else {

				$this->current_request = 'single-exhibitor';

				// get 1 row where data is blank and group id = $this->>groupid
				$single_exh_data = $this->obj_endpoints->nab_mys_db->nab_mys_db_row_getter( $this->group_id );

				if ( isset ( $single_exh_data[0]->ModifiedID ) ) {

					$this->exhid  = $single_exh_data[0]->ModifiedID;
					$this->dataid = $single_exh_data[0]->DataID;

				} else {

					// if there are no rows.. make main modified-exhibitors row's status from 0 to 1 in history table
					$this->obj_endpoints->nab_mys_db->nab_mys_db_history_data( "modified-exhibitors", "finish", $this->group_id );
					// This will open a lock !!

					//If the stack is still not empty, re call main function to fetch next data.
					if ( "wpajax" === $this->flow ) {


						$this->current_request = ''; //this will stop recurring ajax

						echo wp_json_encode(
							array(
								"pastItem"     => $this->current_request,
								"requestedFor" => $requested_for,
								"groupID"      => $this->group_id
							)
						);
						wp_die();


					} else {

						echo esc_html( "CRON sequence ($this->group_id) is now completed successfully." );
						die();

					}
				}

			}

			//Get MYS API Request URL.
			$this->mys_request_url = $this->obj_endpoints->nab_mys_get_request_url( $this->current_request );

			$this->mys_request_url = isset( $this->exhid ) ? $this->mys_request_url . '?exhid=' . $this->exhid : $this->mys_request_url;

			$mys_response_body = $this->nab_mys_exh_get_response();

			if ( 'exhibitors' === $this->current_request ) {

				$exhibitor_modified_array = $mys_response_body[0]->exhibitors;

				//ne_testing purpose only.. remove beore PR.
				if ( isset( $_SERVER['HTTP_REFERER'] ) ) {
					$total_rows = explode( 'rows=', $_SERVER['HTTP_REFERER'] ); //phpcs:ignore
				}
				$total_rows               = isset ( $total_rows[1] ) ? (int) $total_rows[1] : 10000;
				$exhibitor_modified_array = array_slice( $exhibitor_modified_array, 0, $total_rows );

				if ( 0 === count( $exhibitor_modified_array ) ) {

					$this->obj_endpoints->nab_mys_db->nab_mys_db_history_data( "modified-exhibitors", "update", $this->group_id, 1 );

					$error_message      = "Modifed Sessions array is empty";
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


					//simplifiying modified array to make easy execution.
					/*$this->exhibitor_modified_array = array();
					foreach ( $exhibitor_modified_array as $single_modified ) {
						$this->exhibitor_modified_array[ $single_modified->exhid ] = $single_modified->exhstatus;
					}*/


					//ne_think
					//update_option( 'modified_exhibitors_' . $this->group_id, $this->exhibitor_modified_array );


					//set data_json in DB Class to pass modified data to update in db indirectly.
					$this->obj_endpoints->nab_mys_db->nab_mys_db_set_data_json( $this->data_json );

					$this->obj_endpoints->nab_mys_db->nab_mys_db_history_data( "modified-exhibitors", "update", $this->group_id );

					//Let's add rows with blank mys data.
					$this->obj_endpoints->nab_mys_db->nab_mys_db_rows_maker( 'single-exhibitor', $this->history_id, $this->group_id, $exhibitor_modified_array, 3 );
				}

				$this->total_counts = count( $exhibitor_modified_array );

			} else {

				$this->data_array[0] = $this->data_array[0]->exhibitor;
				$this->data_json     = wp_json_encode( $this->data_array );

				$this->obj_endpoints->nab_mys_db->nab_mys_db_row_filler( $this->dataid, $this->data_json );

				$this->finished_counts = $this->finished_counts + 1;

			}

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
						"requestedFor"   => $this->current_request, /*'single-exhibitor',*/ /*$this->requested_for*/
						"groupID"        => $this->group_id,
						"totalCounts"    => $this->total_counts,
						"finishedCounts" => $this->finished_counts
					)
				);
				wp_die();


			} else {

				$this->nab_mys_exh_api();

			}
		}

		public function nab_mys_exh_get_response() {

			//Get Token from Cache, If not available, Generate New and Store in the Cache.
			$nab_mys_token_data = $this->obj_endpoints->nab_mys_api_token_from_cache();

			//If Cached token expired and New token generation failed, throw error.
			if ( 200 !== $nab_mys_token_data['token_status_code'] ) {

				$error_message = "Error " . $nab_mys_token_data['token_status_code'] . ": " . $nab_mys_token_data['token_response'];

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
				$nab_mys_token_response = $nab_mys_token_data['token_response'];

				//Authorization string for the API Call.
				$authorization = "Bearer " . $nab_mys_token_response;

				//Attempt to Fetch Data from MYS
				$mys_response = $this->obj_endpoints->nab_mys_api_call( $this->mys_request_url, $authorization );

				$mys_response_body = $mys_response['body'];

				$mys_response_status = $mys_response['status'];

				if ( 200 === $mys_response_status['code'] ) {

					/**
					 * Attempt Success - Response Data Received.
					 * Insert the Response data in Database.
					 */

					$this->data_array = $mys_response_body;
					$this->data_json  = wp_json_encode( $mys_response_body );

					return $mys_response_body;

				} else {
					//Attempt Failed - Response Data NOT Received.

					$mys_response_message = isset ( $mys_response_status['message']->error ) ? $mys_response_status['message']->error : $mys_response_status['message'];
					$mys_response_message = isset ( $mys_response_message ) ? $mys_response_message : "Something went wrong.";

					$error_message = "Error " . $mys_response_status['code'] . ": " . $mys_response_message . ' (Click PULL button again to continue.)';

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

				}
			}
		}

		/**
		 * Rest End Points
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

			/*$parameters = $request->get_params();

			$this->datatype = $parameters['datatype'];*/

			return $this->nab_mys_exh_api();
		}

		public function nab_mys_exh_csv() {

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

				if ( ! file_exists( WP_PLUGIN_DIR . '/mys-modules/assets/uploads' ) ) {
					wp_mkdir_p( WP_PLUGIN_DIR . '/mys-modules/assets/uploads' );
				}

				$group_id = $this->obj_endpoints->nab_mys_random_id();

				$filename = 'exhibitors-' . $group_id . '.csv';

				$exh_target_dir       = wp_get_upload_dir()['basedir'] . '/mys-uploads/';
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

					if ( ( $handle = fopen( $exh_target_file, "r" ) ) !== false ) {

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

						//Insert a pending row in History table
						$history_id = $this->obj_endpoints->nab_mys_db->nab_mys_db_history_data( "modified-exhibitors-csv", "insert", $group_id );

						//$custom_status = $this->obj_endpoints->nab_mys_db->nab_mys_db_insert_data_to_custom( "modified-exhibitors-csv", $exh_data, $history_id, "wpajax" );
						$custom_status = $this->obj_endpoints->nab_mys_db->nab_mys_db_rows_maker( 'single-exhibitor-csv', $history_id, $group_id, $exh_data, 0 );

						//set data_json in DB Class to pass modified data to update in db indirectly.
						$data_json = wp_json_encode( $exh_data );
						$this->obj_endpoints->nab_mys_db->nab_mys_db_set_data_json( $data_json );
						$this->obj_endpoints->nab_mys_db->nab_mys_db_history_data( "modified-exhibitors-csv", "update", $group_id, 1 );

						//ne_rem use below..
						//$custom_status['total_counts'];

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

			//ne_rems
			//Use unlink() to remove those temp files]

			if(1 === $success) {
				$exh_target_file_url = explode('wp-content', $exh_target_file);
				$exh_target_file_url = get_site_url() . '/wp-content' . $exh_target_file_url[1];

				$success = "1&csvlink=$exh_target_file_url";
			}

			wp_safe_redirect( admin_url( 'admin.php?page=mys-exhibitors&success=' . $success ) );
			exit();

		}

	}
}
new NAB_MYS_Exhibitors();
