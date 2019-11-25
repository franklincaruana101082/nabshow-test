<?php
/**
 * Exhibitors DataBase Queries Class
 *
 * @package MYS Modules
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'NAB_MYS_DB_Exhibitors' ) ) {

	/**
	 * Class NAB_MYS_DB_Exhibitors
	 */
	class NAB_MYS_DB_Exhibitors extends NAB_MYS_DB_Parent {

		/**
		 * Class Constructor
		 */
		public function __construct() {
			parent::__construct();
		}

		/**
		 * It gets exhibitors ids and creates rows with blank json data.
		 *
		 * @param string $data_type Data type.
		 * @param int $history_id History ID
		 * @param string $group_id A unique group id
		 * @param array $exhibitor_modified_array Array of Exhibitor IDs
		 * @param int $added_status Status of migration
		 *
		 * @return array Bulk status and Number of added rows
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		public function nab_mys_db_exh_rows_maker( $data_type, $history_id, $group_id, $exhibitor_modified_array, $added_status ) {

			$rows = array();

			foreach ( $exhibitor_modified_array as $item ) {

				$data_json = wp_json_encode( $item );

				if ( isset( $item->exhid ) ) {
					// Request via Button
					$exh_id     = isset( $item->exhid ) ? (int) $item->exhid : "";
					$exh_status = isset( $item->exhstatus ) ? $item->exhstatus : 'Added';
					$data_json  = '';
				} else {
					// Request via CSV
					$exh_id     = isset( $item[0]['exhid'] ) ? (int) $item[0]['exhid'] : "";
					$exh_status = 'Added';
				}

				if ( empty( $exh_id ) ) {
					continue;
				}

				switch ( $exh_status ) {

					case 'Inactive':
						$exh_id_int = 0;
						break;

					case 'Added':
						$exh_id_int = 1;
						break;

					case 'Updated':
						$exh_id_int = 2;
						break;

				}

				$rows[] = array(
					'DataGroupID'   => $group_id,
					'HistoryID'     => $history_id,
					'AddedStatus'   => $added_status,
					'ItemStatus'    => $exh_id_int,
					'DataType'      => $data_type,
					'ModifiedID'    => $exh_id,
					'DataStartTime' => current_time( 'Y-m-d H:i:s' ),
					'DataJson'      => $data_json
				);
			}

			global $wpdb;

			$bulk_status = $this->nab_mys_db_bulk_insert( $wpdb->prefix . 'mys_data', $rows );

			return array( 'bulk_status' => $bulk_status, 'row_counts' => count( $rows ) );
		}


		/**
		 * Create/Update and assign exhibitors categories.
		 *
		 * @param array $exhibitor_categories Exhibitors Categories Data
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_db_exh_categories( $exhibitor_categories ) {

			$taxonomy      = 'exhibitor-categories';
			$mys_item_name = 'categoryid';

			foreach ( $exhibitor_categories as $single_cat ) {

				$categoryname = $single_cat->categoryname;

				$wp_parent_id  = 0;
				$mys_item_id   = isset( $single_cat->categoryid ) ? $single_cat->categoryid : 0;
				$mys_parent_id = isset( $single_cat->parentcategoryid ) ? $single_cat->parentcategoryid : 0;
				$description   = isset( $single_cat->categorydisplay ) ? $single_cat->categorydisplay : '';

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

				//Check if same name available
				$existing_term_data = get_term_by( 'name', $categoryname, $taxonomy );

				if ( isset( $existing_term_data->term_id ) ) {

					$term_post_id = $existing_term_data->term_id;

				} else {
					// insert new term if not already available

					$term_id_data = wp_insert_term(
						$categoryname,
						$taxonomy,
						array(
							'description' => $description,
							'parent'      => $wp_parent_id,
						)
					);

					//Term already available on this point, then use it.
					if ( isset( $term_id_data->error_data['term_exists'] ) ) {
						$term_post_id = $term_id_data->error_data['term_exists'];
					} else {
						$term_post_id = $term_id_data['term_id'];
					}

				}

				//insert term meta to detect parent
				if ( 0 !== $mys_item_id ) {
					update_term_meta( $term_post_id, $mys_item_name, $mys_item_id );
				}
			}
		}


		/**
		 * Change the start history date to the submitted timespan on CSV upload.
		 *
		 * @param int $history_id History ID
		 * @param string $csv_from_date Date when CSV was exported from MYS
		 *
		 * @return false|int Status of update query.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_db_exh_csv_from_date( $history_id, $csv_from_date ) {

			$sql = $this->wpdb->update(
				$this->wpdb->prefix . 'mys_history', array(
				'HistoryStartTime' => $csv_from_date
			), array(
					'HistoryID' => $history_id,
				)
			);

			return $sql;
		}
	}
}
