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

		/**
		 * Class Constructor
		 */
		public function __construct() {

			add_action( 'admin_post_sync_exhibitors_request', array( $this, 'nab_mys_exh_csv' ) );

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

				$filename             = 'exhibitors-' . time() . '.csv';
				$exh_target_dir       = WP_PLUGIN_DIR . "/mys-modules/assets/uploads/";
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

							if (empty($data[0])) { // ignore blank lines
								continue;
							}

							$num = 0 !== count($columns) ? count($columns) : count( $data );

							for ( $c = 0; $c < $num; $c ++ ) {

								if ( 0 === $row ) {
									if ( ! empty( $data[ $c ] ) ) {
										$columns[] = $data[ $c ];
									}
								} else {
									$exh_data[ $row - 1 ][ $columns[ $c ] ] = $data[ $c ];
								}
							}
							$row ++;
						}
						fclose( $handle );
					}

					if ( isset( $exh_data ) && is_array( $exh_data ) ) {

						$obj_endpoints = new NAB_MYS_Endpoints();

						$group_id = $obj_endpoints->nab_mys_random_id();

						//Insert a pending row in History table
						$history_id = $obj_endpoints->nab_mys_db->nab_mys_db_history_data( "exhibitors-csv", "insert", $group_id );

						$obj_endpoints->nab_mys_db->nab_mys_db_insert_data_to_custom( "exhibitors-csv", $exh_data, $history_id, "wpajax" );

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

			wp_safe_redirect( admin_url( 'admin.php?page=mys-exhibitors&success=' . $success ) );
			exit();

		}

	}
}
new NAB_MYS_Exhibitors();
