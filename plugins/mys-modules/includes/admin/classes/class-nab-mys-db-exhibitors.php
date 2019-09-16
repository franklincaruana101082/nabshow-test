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

if ( ! class_exists( 'NAB_MYS_DB_Exhibitors' ) ) {

	class NAB_MYS_DB_Exhibitors extends NAB_MYS_DB_Parent {

		/**
		 * Class Constructor
		 */
		public function __construct() {
		}

		public function nab_mys_db_exh_rows_maker( $data_type, $history_id, $group_id, $exhibitor_modified_array, $added_status ) {

			$rows = array();

			foreach ( $exhibitor_modified_array as $item ) {

				$data_json = wp_json_encode( $item );
				//$item = $item[0];

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
					'DataStartTime' => date( 'Y-m-d H:i:s' ),
					'DataJson'      => $data_json
				);
			}

			global $wpdb;

			$this->nab_mys_db_bulk_insert( $wpdb->prefix . 'mys_data', $rows );

			return count( $rows );

		}

		public function nab_mys_db_exh_categories( $exhibitor_categories ) {

			foreach ( $exhibitor_categories as $single_cat ) {

				$category_mys_id = $single_cat->categoryid;
				$categoryname    = $single_cat->categoryname;

				$args                  = array();
				$args['mys_item_id']   = $category_mys_id;
				$args['mys_item_name'] = 'categoryid';
				$args['mys_parent_id'] = $single_cat->parentcategoryid;
				$args['description']   = $single_cat->categorydisplay;

				if ( "" !== $categoryname ) {
					$this->nab_mys_cron_assign_single_term_by_name( $categoryname, "exhibitor-categories", 0, $args );
				}

			}

		}

	}
}
