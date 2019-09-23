<?php
/**
 * DataBase History Queries Class
 *
 * @package MYS Modules
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'NAB_MYS_DB_History' ) ) {

	class NAB_MYS_DB_History {

		private $wpdb = '';

		/**
		 * Class Constructor
		 */
		public function __construct() {
			global $wpdb;
			$this->wpdb = $wpdb;
		}

		public function nab_mys_history_list( $limit ) {

			$wpdb = $this->wpdb;

			$where_clause = 'HistoryDataType LIKE "%-%"';
			$order_by     = 'HistoryID';
			$order_type   = 'DESC';

			$history_result = $wpdb->get_results(
				$wpdb->prepare( "SELECT h1.*, d.* FROM {$wpdb->prefix}mys_history as h1
										
										INNER JOIN (SELECT DISTINCT HistoryGroupID FROM {$wpdb->prefix}mys_history
										ORDER BY HistoryID DESC LIMIT %d) as h2
										ON h1.HistoryGroupID = h2.HistoryGroupID
										
										LEFT JOIN (SELECT DISTINCT DataGroupID, AddedStatus FROM {$wpdb->prefix}mys_data ORDER BY DataID DESC) as d
										ON h1.HistoryGroupID = DataGroupID
										
										ORDER BY h1.HistoryID DESC
										", $limit )
			); //db call ok; no-cache ok

			$history_data = array();
			//$history_count = 1;
			foreach ( $history_result as $h ) {
				$history_data[ $h->HistoryGroupID ]['Totals'][ $h->HistoryDataType ] = $h->HistoryItemsAffected;
				$history_data[ $h->HistoryGroupID ]['Details']                       = $h;

				/*if ( 1 === $history_count ) {
					$history_start_time = $h->HistoryStartTime;
				}
				$history_count ++;*/
			}

			//$history_data[ $h->HistoryGroupID ]['Details']['HistoryStartTime'] = $history_start_time;

			$history_total = $this->nab_mys_history_total();

			return array(
				'history_total' => $history_total,
				'history_data'  => $history_data
			);
		}

		public function nab_mys_history_detail( $groupid ) {

			$wpdb = $this->wpdb;

			$where_clause = 'HistoryDataType LIKE "%-%"';
			$order_by     = 'HistoryID';
			$order_type   = 'DESC';

			$data_rows = $wpdb->get_results(
				$wpdb->prepare( "SELECT * FROM {$wpdb->prefix}mys_data
										WHERE DataGroupID = %s
										ORDER BY DataID ASC
										", $groupid )
			); //db call ok; no-cache ok

			$type_wise_data = array();

			foreach ( $data_rows as $single_row ) {

				//$single_rowistory_data[ $single_row->DataType ][ $single_row->ModifiedID ][] = $single_row;

				$data_type      = $single_row->DataType;
				$main_mys_value = $single_row->ModifiedID;
				$data_json      = $single_row->DataJson;

				//$data_json = str_replace( "\'", "'", $data_json );  //ne_temp ne_json
				$items_array = json_decode( $data_json );

				/*if ( 'single-exhibitor' === $data_type || 'single-exhibitor-csv' === $data_type ) {

					$data_type = 'exhibitors';

					$item = $items_array;

					$type_wise_data[ $data_type ][ $main_mys_value ]['item_array_data']                     = $item[0];
					$type_wise_data[ $data_type ][ $main_mys_value ]['item_mys_id_name']                    = 'exhid';
					$type_wise_data[ $data_type ][ $main_mys_value ]['item_title_name']                     = 'exhname';
					$type_wise_data[ $data_type ][ $main_mys_value ]['item_image_name']                     = 'logo';
					$type_wise_data[ $data_type ][ $main_mys_value ]['assigned_to_rows'][ $main_mys_value ] = $single_row;

					continue;
				} else */
				if ( 'sessions' === $data_type ) {

					$item = $items_array;

					$type_wise_data[ $data_type ][ $main_mys_value ]['item_array_data']                     = $item[0];
					$type_wise_data[ $data_type ][ $main_mys_value ]['item_mys_id_name']                    = 'sessionid';
					$type_wise_data[ $data_type ][ $main_mys_value ]['item_title_name']                     = 'title';
					$type_wise_data[ $data_type ][ $main_mys_value ]['assigned_to_rows'][ $main_mys_value ] = $single_row;

					continue;
				}

				foreach ( $items_array as $item ) {

					switch ( $data_type ) {

						case 'tracks':
							$item_mys_id      = $item->trackid;
							$item_mys_id_name = 'trackid';
							$item_title_name  = 'title';
							$item_image_name  = 'icon';
							break;

						case 'speakers':
							$item_mys_id      = $item->speakerid;
							$item_mys_id_name = 'speakerid';
							$item_title_name  = 'firstname';
							$item_image_name  = 'photo';
							break;

						case 'sponsors':
							$item_mys_id      = $item->sponsorid;
							$item_mys_id_name = 'sponsorid';
							$item_title_name  = 'sponsorname';
							$item_image_name  = 'logo';
							break;

					}
					$type_wise_data[ $data_type ][ $item_mys_id ]['item_array_data']                     = $item;
					$type_wise_data[ $data_type ][ $item_mys_id ]['item_mys_id_name']                    = $item_mys_id_name;
					$type_wise_data[ $data_type ][ $item_mys_id ]['item_title_name']                     = $item_title_name;
					$type_wise_data[ $data_type ][ $item_mys_id ]['item_image_name']                     = $item_image_name;
					$type_wise_data[ $data_type ][ $item_mys_id ]['assigned_to_rows'][ $main_mys_value ] = $single_row;
				}
			}

			return $type_wise_data;
		}

		private function nab_mys_history_total() {

			$wpdb = $this->wpdb;

			$history_total = $wpdb->get_var( "SELECT COUNT(HistoryID) FROM {$wpdb->prefix}mys_history WHERE HistoryDataType LIKE '%-%'" ); //db call ok; no-cache ok

			return $history_total;
		}

		public function nab_mys_history_reset() {

			$wpdb = $this->wpdb;

			$history_reset_dtable = $wpdb->query( "TRUNCATE TABLE {$wpdb->prefix}mys_data" );
			$history_reset_htable = $wpdb->query( "TRUNCATE TABLE {$wpdb->prefix}mys_history" ); //db call ok; no-cache ok

			return $history_reset_htable;
		}

		public function nab_mys_history_clear( $days = 30 ) {

			$wpdb = $this->wpdb;

			$days                   = $days - 1;
			$date_before_given_days = date( 'Y-m-d', strtotime( "-$days days" ) );

			$after_history_id = $wpdb->get_var(
				$wpdb->prepare( "
							SELECT HistoryID FROM {$wpdb->prefix}mys_history
							WHERE HistoryStartTime < %s
							ORDER BY HistoryID DESC
							LIMIT 1
						", $date_before_given_days
				) ); //db call ok; no-cache ok

			$history_clear = $wpdb->query(
				$wpdb->prepare( "
						DELETE FROM {$wpdb->prefix}mys_history
						WHERE HistoryID => %s
						AND ( HistoryStatus = 1 OR HistoryStatus = 4 )"
					, $after_history_id ) );

			$data_clear = $wpdb->query(
				$wpdb->prepare( "
						DELETE FROM {$wpdb->prefix}mys_data
						WHERE HistoryID => %s
						AND ( AddedStatus = 1 OR AddedStatus = 4 )"
					, $after_history_id ) );

			return array( 'date_before_given_days' => $date_before_given_days, 'history_clear_status' => $history_clear );
		}
	}
}
