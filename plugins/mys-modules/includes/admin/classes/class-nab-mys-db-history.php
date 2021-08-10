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

	/**
	 * Class NAB_MYS_DB_History
	 */
	class NAB_MYS_DB_History {

		private $wpdb = '';
		private $page_groupid = '';
		private $page_template = '';
		private $nab_mys_db_cron_object = '';
		private $where_clause_history = array();
		private $request_data = array();
		private $sorting_data = array();
		private $history_data = array();
		private $history_total = 0;

		/**
		 * @var array Allowed HTML tags for History Sections.
		 */
		private $allowed_tags = array(
			'b'    => array(),
			'br'   => array(),
			'span' => array( 'class' => array() ),
			'i'    => array( 'class' => array(), 'style' => array() ),
			'a'    => array( 'href' => array(), 'target' => array(), 'class' => array() ),
			'img'  => array( 'src' => array(), 'title' => array() ),
		);

		/**
		 * Class Constructor
		 */
		public function __construct() {
			global $wpdb;
			$this->wpdb = $wpdb;
		}

		/**
		 * Set variables for History Pages.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		private function nab_mys_history_set_vars() {

			$get_vars = array(
				's',
				'paged',
				'to_date',
				'from_date',
				'status',
				'data_type',
				'user',
				'limit',
				'orderby',
				'order',
				'timeorder',
			);

			foreach ( $get_vars as $name ) {
				$this->request_data[ $name ] = filter_input( INPUT_GET, $name, FILTER_SANITIZE_STRING );
			}

			//Define Variables
			$this->request_data['history_listing_url'] = admin_url( 'admin.php?page=mys-history' );
			$this->request_data['paged']               = null !== $this->request_data['paged'] ? (int) $this->request_data['paged'] : 1;
			$orderby                                   = $this->request_data['orderby'] = null !== $this->request_data['orderby'] ? $this->request_data['orderby'] : '';

			$order                               = $this->request_data['order'] = null !== $this->request_data['order'] ? $this->request_data['order'] : 'desc';
			$this->request_data['order_reverse'] = 'asc' === $this->request_data['order'] ? 'desc' : 'asc';

			$default_timecol                         = 'listing' === $this->page_template ? 'HistoryStartTime' : 'DataID';
			$timeorder                               = $this->request_data['timeorder'] = null !== $this->request_data['timeorder'] ? $this->request_data['timeorder'] : 'desc';
			$this->request_data['timeorder_reverse'] = 'desc' === $timeorder ? 'asc' : 'desc';
			if ( ! empty( $orderby ) ) {
				$this->request_data['order_clause'][] = "$orderby $order";
			}
			$this->request_data['order_clause'][] = "$default_timecol $timeorder";
		}

		/**
		 * Set filters data for History Pages.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		private function nab_mys_history_set_filters() {

			$data_type = $this->request_data['data_type'];	
			
			echo $this->page_template . ' template name';

			if ( 'listing' === $this->page_template ) {

				echo '<h1>MYS Module 6</h1>';

				//LISTING PAGE

				$name_date_col = 'HistoryStartTime';

				if ( null === $data_type || 'all' === $data_type ) {
					$data_type = '%-%';
				}

				// Data Type- Filter
				if ( null === $data_type || 'all' === $data_type || '%-%' === $data_type ) {
					$this->where_clause_history[] = "HistoryDataType LIKE '%-%'";
				} else {
					$this->where_clause_history[] = "HistoryDataType = '" . $data_type . "'";
				}

				// User - Filter
				$args = array(
					'blog_id' => '0',
					'role'    => 'administrator',
					'orderby' => 'display_name',
					'order'   => 'ASC'
				);

				$this->request_data['all_users'] = get_users( $args );
				$user_ids                        = array();
				foreach ( $this->request_data['all_users'] as $u ) {
					$user_ids[] = $u->ID;
				}
				if ( null !== $this->request_data['user'] && 'all' !== $this->request_data['user'] ) {
					$this->where_clause_history[] = "HistoryUser = " . (int) $this->request_data['user'];
				}

				// Status - Filter
				if ( null !== $this->request_data['status'] && 'all' !== $this->request_data['status'] ) {
					$this->where_clause_history[] = "HistoryStatus = " . (int) $this->request_data['status'];
				}

			} else {
				//DETAIL or SEARCH PAGE

				$name_date_col = 'DataStartTime';

				// Data Type- Filter
				if ( null !== $data_type && 'all' !== $data_type ) {
					if ( strpos( $data_type, 'exhibitor' ) !== false ) {
						$this->where_clause_history[] = "DataType LIKE '%exhibitor%'";
					} else {
						$this->where_clause_history[] = "DataType = '" . $data_type . "'";
					}

				}

				// Status - Filter
				if ( null !== $this->request_data['status'] && 'all' !== $this->request_data['status'] ) {
					if ( 0 === (int) $this->request_data['status'] ) {
						$this->where_clause_history[] = "( AddedStatus = 0 OR AddedStatus = 6 )";
					} else {
						$this->where_clause_history[] = "AddedStatus = " . (int) $this->request_data['status'];
					}
				}

				//Search - Filter
				if ( null !== $this->request_data['s'] && ! empty( $this->request_data['s'] ) ) {
					$s                            = $this->request_data['s'];
					$this->where_clause_history[] = "DataJson LIKE '%$s%'";
				}

			}

			//Dates - Filter
			if ( /*Both Active*/
				! empty( $this->request_data['to_date'] )
				&& 'all' !== $this->request_data['to_date']
				&& ! empty( $this->request_data['from_date'] )
				&& 'all' !== $this->request_data['from_date']
			) {
				$from_date_ = date( 'Y-m-d', strtotime( $this->request_data['from_date'] ) );
				$to_date_   = date( 'Y-m-d', strtotime( $this->request_data['to_date'] . "+1 days" ) );
				//Less than to_date..
				$this->where_clause_history[] = "( $name_date_col BETWEEN '" . $from_date_ . "' AND '" . $to_date_ . "' )";
			} else if ( /*Only To Active*/
				! empty( $this->request_data['to_date'] )
				&& 'all' !== $this->request_data['to_date']
				&& ( empty( $this->request_data['from_date'] ) || 'all' === $this->request_data['from_date'] )
			) {
				$to_date_ = date( 'Y-m-d', strtotime( $this->request_data['to_date'] . "+1 days" ) );
				//Less than to_date..
				$this->where_clause_history[] = "$name_date_col < '" . $to_date_ . "'";
			} else if ( /*Only From Active*/
				! empty( $this->request_data['from_date'] )
				&& 'all' !== $this->request_data['from_date']
				&& ( empty( $this->request_data['to_date'] ) || 'all' === $this->request_data['to_date'] )
			) {
				$from_date_ = date( 'Y-m-d', strtotime( $this->request_data['from_date'] ) );
				//Grater than from_date..
				$this->where_clause_history[] = "$name_date_col >= '" . $from_date_ . "'";
			}

		}

		/**
		 * Set ordering for History Pages.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		private function nab_mys_history_set_ordering() {

			global $current_site;

			$main_site_blog_id = $current_site->blog_id;
			$home_url          = get_home_url( $main_site_blog_id );
			$current_url       = $home_url . add_query_arg( array( $_GET ) );

			$current_url_without_pageno                       = explode( '&paged=', $current_url );
			$this->request_data['current_url_without_pageno'] = $current_url_without_pageno[0];
			$current_url_without_order                        = explode( '&orderby=', $current_url );
			$current_url_without_order                        = isset( $current_url_without_order[1] ) ? $current_url_without_order[0] : explode( '&timeorder=', $current_url );
			$current_url_without_order                        = is_array( $current_url_without_order ) ? $current_url_without_order[0] : $current_url_without_order;

			$order                = $this->request_data['order'];
			$order_reverse        = $this->request_data['order_reverse'];
			$timeorder            = $this->request_data['timeorder'];
			$timeorder_reverse    = $this->request_data['timeorder_reverse'];
			$sorted_heading_class = "sorted $order";
			$time_heading_class   = "sorted $timeorder";
			$orderby              = $this->request_data['orderby'];
			$first_order          = ! empty( $orderby ) ? "&orderby=$orderby&order=$order" : '';
			$sorted_heading_link  = "<a href='$current_url_without_order&orderby=$orderby&order=$order_reverse&timeorder=$timeorder'>";
			$sorted_heading_close = "<span class='sorting-indicator'></span></a>";

			//intialize
			$this->sorting_data['datatype_row_class'] = $this->sorting_data['user_row_class'] = $this->sorting_data['start_row_class'] = '';

			$datatype_row_title                              = 'Data Type';
			$this->sorting_data['history_datatype_row_html'] = "<a href='$current_url_without_order&orderby=HistoryDataType&timeorder=$timeorder'>$datatype_row_title</a>";
			$this->sorting_data['datatype_row_html']         = "<a href='$current_url_without_order&orderby=DataType&timeorder=$timeorder'>$datatype_row_title</a>";

			$user_row_title                      = 'User';
			$this->sorting_data['user_row_html'] = "<a href='$current_url_without_order&orderby=HistoryUser&timeorder=$timeorder'>$user_row_title</a>";

			//Default Ordering of Time
			$start_row_title                       = 'Start Time';
			$this->sorting_data['start_row_class'] = $time_heading_class;
			$this->sorting_data['start_row_html']  = "<a href='$current_url_without_order$first_order&timeorder=$timeorder_reverse'>$start_row_title<span class='sorting-indicator'></span></a>";
			//for detail
			$dataid_row_title                       = 'Data ID';
			$this->sorting_data['dataid_row_class'] = $time_heading_class;
			$this->sorting_data['dataid_row_html']  = "<a href='$current_url_without_order$first_order&timeorder=$timeorder_reverse'>$dataid_row_title<span class='sorting-indicator'></span></a>";

			switch ( $this->request_data['orderby'] ) {
				case 'DataType':
					$this->sorting_data['datatype_row_class'] = $sorted_heading_class;
					$this->sorting_data['datatype_row_html']  = $sorted_heading_link . $datatype_row_title . $sorted_heading_close;
					break;
				case 'HistoryDataType':
					$this->sorting_data['datatype_row_class']        = $sorted_heading_class;
					$this->sorting_data['history_datatype_row_html'] = $sorted_heading_link . $datatype_row_title . $sorted_heading_close;
					break;
				case 'HistoryUser':
					$this->sorting_data['user_row_class'] = $sorted_heading_class;
					$this->sorting_data['user_row_html']  = $sorted_heading_link . $user_row_title . $sorted_heading_close;
					break;
			}
		}

		/**
		 * Set Pagination for History Pages.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		private function nab_mys_history_set_pagination() {

			$current_url_without_pageno = $this->request_data['current_url_without_pageno'];
			$last_page_no               = $this->request_data['last_page_no'];
			$html_link_first_page       = $html_link_prev_page = $html_link_next_page = $html_link_last_page = '';

			if ( 1 !== $last_page_no ) {
				if ( 1 === $this->request_data['paged'] ) {
					//first page
					$next_page = $this->request_data['paged'] + 1;

					$html_link_first_page = "<span class='button disabled' aria-hidden='true'>«</span>";
					$html_link_prev_page  = "<span class='button disabled' aria-hidden='true'>‹</span>";

					$html_link_next_page = "<a class='next-page button' href='$current_url_without_pageno&paged=$next_page'><span class='button' aria-hidden='true'>›</span></a>";
					$html_link_last_page = "<a class='prev-page button' href='$current_url_without_pageno&paged=$last_page_no'><span class='button' aria-hidden='true'>»</span></a>";

				} else if ( $last_page_no !== $this->request_data['paged'] ) {
					//middle pages
					$next_page = $this->request_data['paged'] + 1;
					$prev_page = $this->request_data['paged'] - 1;

					$html_link_first_page = "<a class='first-page button' href='$current_url_without_pageno&paged=1'><span class='button' aria-hidden='true'>«</span></a>";
					$html_link_prev_page  = "<a class='prev-page button' href='$current_url_without_pageno&paged=$prev_page'><span class='button' aria-hidden='true'>‹</span></a>";

					$html_link_next_page = "<a class='next-page button' href='$current_url_without_pageno&paged=$next_page'><span class='button' aria-hidden='true'>›</span></a>";
					$html_link_last_page = "<a class='prev-page button' href='$current_url_without_pageno&paged=$last_page_no'><span class='button' aria-hidden='true'>»</span></a>";

				} else {
					//last page
					$prev_page = $this->request_data['paged'] - 1;

					$html_link_first_page = "<a class='first-page button' href='$current_url_without_pageno&paged=1'><span class='button' aria-hidden='true'>«</span></a>";
					$html_link_prev_page  = "<a class='prev-page button' href='$current_url_without_pageno&paged=$prev_page'><span class='button' aria-hidden='true'>‹</span></a>";

					$html_link_next_page = "<span class='button disabled' aria-hidden='true'>›</span>";
					$html_link_last_page = "<span class='button disabled' aria-hidden='true'>»</span>";
				}
			}

			$this->request_data['html_link_first_page'] = $html_link_first_page;
			$this->request_data['html_link_prev_page']  = $html_link_prev_page;
			$this->request_data['html_link_next_page']  = $html_link_next_page;
			$this->request_data['html_link_last_page']  = $html_link_last_page;
		}

		/**
		 * Get History Data
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		private function nab_mys_history_get_data() {

			// Prepare Data
			$this->request_data['limit']  = ! empty( $this->request_data['limit'] ) && null !== $this->request_data['limit'] ? (int) $this->request_data['limit'] : 30;
			$this->request_data['offset'] = ( $this->request_data['paged'] - 1 ) * $this->request_data['limit'];

			//Template
			if ( 'listing' === $this->page_template ) {
				//LISTING PAGE
				$history_result = $this->nab_mys_history_list();
			} else {
				//DETAIL or SEARCH PAGE

				if ( 'all' === $this->page_groupid ) {
					//search page..
					$this->request_data['page_for'] = 'Global Search';
					$this->page_groupid             = 'all';
				} else {
					//detail page..
					$this->request_data['page_for'] = 'Detail';
					$this->where_clause_history[]   = "DataGroupID = '$this->page_groupid'";
				}
				$history_result = $this->nab_mys_history_detail();
			}

			$this->history_data  = $history_result['history_data'];
			$this->history_total = (int) $history_result['history_total'];

			if ( $this->history_total > $this->request_data['limit'] ) {
				$history_last_rows                  = (int) fmod( $this->history_total, $this->request_data['limit'] );
				$this->request_data['last_page_no'] = 0 !== $history_last_rows ? 1 + ( $this->history_total - $history_last_rows ) / $this->request_data['limit'] : $this->history_total / $this->request_data['limit'];
			} else {
				$this->request_data['last_page_no'] = 1;
			}

		}


		/**
		 * Load History Page Content
		 *
		 * @param string $page_groupid A unique group id for history
		 * @param $nab_mys_db_cron_object
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_history_page_loader( $page_groupid, $nab_mys_db_cron_object ) {

			$this->page_groupid           = null === $page_groupid || empty( $page_groupid ) ? 'all' : $page_groupid;
			$this->page_template          = null === $page_groupid || empty( $page_groupid ) ? 'listing' : 'detail';
			$this->nab_mys_db_cron_object = $nab_mys_db_cron_object;

			//Set variables
			$this->nab_mys_history_set_vars();

			//Set filters
			$this->nab_mys_history_set_filters();			

			//Get History Data
			$this->nab_mys_history_get_data();

			//Ordering
			$this->nab_mys_history_set_ordering();

			//Pagination
			$this->nab_mys_history_set_pagination();

			//MYS Header
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-header-page.php' );

			//History Header
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-history-header.php' );

			if ( 'listing' === $this->page_template ) {
				require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-history-list.php' );
			} else {
				require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-history-detail.php' );
			}

		}

		/**
		 * Get History Detail Page Data.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		private function nab_mys_history_detail() {

			$wpdb                 = $this->wpdb;
			$where_clause_history = $this->where_clause_history;
			$where_clause_history = implode( ' AND ', $where_clause_history );
			$offset               = $this->request_data['offset'];
			$limit                = $this->request_data['limit'];
			$keyword              = $this->request_data['s'];
			$order_clause         = $this->request_data['order_clause'];
			$order_clause         = implode( ', ', $order_clause );

			$data_rows = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT * FROM %1smys_data
							WHERE $where_clause_history
							ORDER BY %1s LIMIT %d OFFSET %d",
					$wpdb->prefix, $order_clause, $limit, $offset ) );

			$history_total = $wpdb->get_var(
				$wpdb->prepare(
					"SELECT COUNT(DataID) FROM %1smys_data
							WHERE $where_clause_history",
					$wpdb->prefix ) );

			$group_wise_data = array();

			foreach ( $data_rows as $single_row ) {

				$groupid        = $single_row->DataGroupID;
				$data_type      = $single_row->DataType;
				$main_mys_value = $single_row->ModifiedID;
				$data_json      = $single_row->DataJson;

				$data_json   = str_replace( "\'", "'", $data_json );
				$items_array = json_decode( $data_json );

				if ( 'single-exhibitor' === $data_type || 'single-exhibitor-csv' === $data_type ) {

					$data_type = 'exhibitors';

					$item = $items_array;

					$group_wise_data[ $groupid ][ $data_type ][ $main_mys_value ]['item_array_data']                     = $item[0];
					$group_wise_data[ $groupid ][ $data_type ][ $main_mys_value ]['item_mys_id_name']                    = 'exhid';
					$group_wise_data[ $groupid ][ $data_type ][ $main_mys_value ]['item_title_name']                     = 'exhname';
					$group_wise_data[ $groupid ][ $data_type ][ $main_mys_value ]['item_image_name']                     = 'logo';
					$group_wise_data[ $groupid ][ $data_type ][ $main_mys_value ]['assigned_to_rows'][ $main_mys_value ] = $single_row;

					continue;

				} else if ( 'sessions' === $data_type ) {

					$item = $items_array;

					$group_wise_data[ $groupid ][ $data_type ][ $main_mys_value ]['item_array_data']                     = $item[0];
					$group_wise_data[ $groupid ][ $data_type ][ $main_mys_value ]['item_mys_id_name']                    = 'sessionid';
					$group_wise_data[ $groupid ][ $data_type ][ $main_mys_value ]['item_title_name']                     = 'title';
					$group_wise_data[ $groupid ][ $data_type ][ $main_mys_value ]['assigned_to_rows'][ $main_mys_value ] = $single_row;

					continue;
				}

				foreach ( $items_array as $item ) {

					$item_to_search_in = $item;
					unset( $item_to_search_in->schedules );
					$item_json = wp_json_encode( $item_to_search_in );

					//stop the sibling items from search results if they dont have a searched keyword.
					if ( null !== $keyword && ! empty( $keyword ) ) {
						$keyword   = strtolower( $keyword );
						$item_json = strtolower( $item_json );
						//global search
						if ( strpos( $item_json, $keyword ) === false ) {
							continue;
						}
					}

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
					$group_wise_data[ $groupid ][ $data_type ][ $item_mys_id ]['item_array_data']                     = $item;
					$group_wise_data[ $groupid ][ $data_type ][ $item_mys_id ]['item_mys_id_name']                    = $item_mys_id_name;
					$group_wise_data[ $groupid ][ $data_type ][ $item_mys_id ]['item_title_name']                     = $item_title_name;
					$group_wise_data[ $groupid ][ $data_type ][ $item_mys_id ]['item_image_name']                     = $item_image_name;
					$group_wise_data[ $groupid ][ $data_type ][ $item_mys_id ]['assigned_to_rows'][ $main_mys_value ] = $single_row;
				}
			}

			return array(
				'history_total' => $history_total,
				'history_data'  => $group_wise_data
			);

		}

		public function nab_mys_history_table( $groupid, $detail = '1', $limit = 100, $id = '', $where = '' ) {

			$wpdb  = $this->wpdb;
			$where = ! empty( $where ) ? "WHERE $where" : '';

			if ( "1" === $detail ) {
				$table_name = $wpdb->prefix . 'mys_data';
				$cols       = '*';
				$orderby    = $idcol = 'DataID';
				$group_col  = 'DataGroupID';
			} else {
				$table_name = $wpdb->prefix . 'mys_history';
				$cols       = 'HistoryID, HistoryGroupID, HistoryStatus,
								HistoryDataType, HistoryStartTime, HistoryEndTime, HistoryUser, HistoryItemsAffected';
				$orderby    = $idcol = 'HistoryID';
				$group_col  = 'HistoryGroupID';
			}

			if ( null !== $groupid ) {
				if ( ! empty( $where ) ) {
					$where = "WHERE $where AND $group_col = '$groupid'";
				} else {
					$where = "WHERE $group_col = '$groupid'";
				}
			}

			if ( ! empty( $id ) ) {
				$cols  = '*';
				$where = ! empty( $where ) ? "$where AND $idcol = $id" : "WHERE $idcol = $id";
			}

			$history_result = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT $cols
								FROM %1s
							$where
							ORDER BY %1s DESC
							LIMIT %d",
					$table_name, $orderby, $limit ) );

			/*$history_data = array();
			foreach ( $history_result as $h ) {
				$history_data[ $h->HistoryGroupID ][] = $h;
			}*/

			return $history_result;
		}

		/**
		 * Get History List Page Data.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		private function nab_mys_history_list() {

			$wpdb = $this->wpdb;

			$where_history = $this->where_clause_history;
			$where_history = implode( ' AND ', $where_history );
			$order_clause  = $this->request_data['order_clause'];
			$order_clause  = implode( ', ', $order_clause );
			$limit         = $this->request_data['limit'];
			$offset        = $this->request_data['offset'];

			$history_result = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT h1.* FROM %1smys_history as h1
							INNER JOIN (
								SELECT DISTINCT HistoryGroupID FROM %1smys_history
								WHERE $where_history
								ORDER BY %1s LIMIT %d OFFSET %d
								) as h2 ON h1.HistoryGroupID = h2.HistoryGroupID
							ORDER BY %1s",
					$wpdb->prefix, $wpdb->prefix, $order_clause, $limit, $offset, $order_clause ) );

			$history_data = array();
			foreach ( $history_result as $h ) {
				$history_data[ $h->HistoryGroupID ]['Totals'][ $h->HistoryDataType ] = $h->HistoryItemsAffected;

				if ( strpos( $h->HistoryDataType, '-' ) !== false ) {
					$history_data[ $h->HistoryGroupID ]['Details'] = $h;
				}
			}

			$history_total = $this->nab_mys_history_total( $where_history );

			return array(
				'history_total' => $history_total,
				'history_data'  => $history_data
			);
		}

		/**
		 * Get Total Number of found History Items.
		 *
		 * @param string $where Where clause for query
		 *
		 * @return mixed|string|null Result of query.
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		private function nab_mys_history_total( $where ) {

			$wpdb = $this->wpdb;

			$history_total = get_transient( "history_list_total_$where" );
			if ( false === $history_total ) {
				$history_total = $wpdb->get_var(
					$wpdb->prepare(
						"SELECT COUNT(HistoryID) FROM %1smys_history WHERE $where",
						$wpdb->prefix ) );
				set_transient( "history_list_total_$where", $history_total, 60 * 60 * 24 );
			}

			return $history_total;
		}


		/**
		 * Reset the plugin.
		 *
		 * @return int|false Result of the reset query.
		 * @since 1.0.0
		 *
		 * @package MYS Modules
		 */
		public function nab_mys_history_reset() {

			$wpdb = $this->wpdb;

			$wpdb->query( $wpdb->prepare( "TRUNCATE TABLE %1smys_data", $wpdb->prefix ) );
			$history_reset_htable = $wpdb->query( $wpdb->prepare( "TRUNCATE TABLE %1smys_history", $wpdb->prefix ) );

			delete_transient( 'nab_mys_token' );
			delete_option( 'nab_mys_credentials_u' );
			delete_option( 'nab_mys_credentials_p' );
			delete_option( 'mys_login_form_success' );

			return $history_reset_htable;
		}


		/**
		 * Clear history of past days.
		 *
		 * @param int $days The days to exclude in clearance process.
		 *
		 * @return array Start Date of the clearance and query status.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_history_clear( $days = 30 ) {

			$wpdb = $this->wpdb;

			$days                   = $days - 1;
			$date_before_given_days = date( 'Y-m-d', strtotime( "-$days days" ) );

			$after_history_id = $wpdb->get_var(
				$wpdb->prepare( "
						SELECT HistoryID FROM %1smys_history
						WHERE HistoryStartTime < %s
						ORDER BY HistoryID DESC
						LIMIT 1
					", $wpdb->prefix, $date_before_given_days
				) );;

			$history_clear = $wpdb->query(
				$wpdb->prepare( "
						DELETE FROM %1smys_history
						WHERE HistoryID => %s
						AND ( HistoryStatus = 1 OR HistoryStatus = 4 )"
					, $wpdb->prefix, $after_history_id ) );;

			$wpdb->query(
				$wpdb->prepare( "
						DELETE FROM %1smys_data
						WHERE HistoryID => %s
						AND ( AddedStatus = 1 OR AddedStatus = 4 )"
					, $wpdb->prefix, $after_history_id ) );;

			return array( 'date_before_given_days' => $date_before_given_days, 'history_clear_status' => $history_clear );
		}

		/**
		 * Dashboard At a glance section.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		static function nab_mys_dashboard_glance() {

			$glance_data = array();

			//Sessions
			$glance_data['Sessions']['count'] = wp_count_posts( 'sessions' )->publish;
			$glance_data['Sessions']['link']  = admin_url( "edit.php?post_type=sessions" );

			$glance_data['Sessions']['terms']['Tracks']['tcount']    = wp_count_terms( 'tracks' );
			$glance_data['Sessions']['terms']['Tracks']['tlink']     = admin_url( "edit-tags.php?taxonomy=tracks&post_type=sessions" );
			$glance_data['Sessions']['terms']['Locations']['tcount'] = wp_count_terms( 'session-locations' );
			$glance_data['Sessions']['terms']['Locations']['tlink']  = admin_url( "edit-tags.php?taxonomy=session-locations&post_type=sessions" );

			//Sponsors
			$glance_data['Sponsors']['count'] = wp_count_posts( 'sponsors' )->publish;
			$glance_data['Sponsors']['link']  = admin_url( "edit.php?post_type=sponsors" );

			//Exhibitors
			$glance_data['Exhibitors']['count'] = wp_count_posts( 'exhibitors' )->publish;
			$glance_data['Exhibitors']['link']  = admin_url( "edit.php?post_type=exhibitors" );

			$glance_data['Exhibitors']['terms']['Halls']['tcount']                 = wp_count_terms( 'halls' );
			$glance_data['Exhibitors']['terms']['Halls']['tlink']                  = admin_url( "edit-tags.php?taxonomy=halls&post_type=exhibitors" );
			$glance_data['Exhibitors']['terms']['Exhibitors Categories']['tcount'] = wp_count_terms( 'exhibitor-categories' );
			$glance_data['Exhibitors']['terms']['Exhibitors Categories']['tlink']  = admin_url( "edit-tags.php?taxonomy=exhibitor-categories&post_type=exhibitors" );
			$glance_data['Exhibitors']['terms']['Pavilions']['tcount']             = wp_count_terms( 'pavilions' );
			$glance_data['Exhibitors']['terms']['Pavilions']['tlink']              = admin_url( "edit-tags.php?taxonomy=pavilions&post_type=exhibitors" );

			return $glance_data;
		}


		/**
		 * Dashboard Activity section.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_dashboard_activity() {

			$wpdb = $this->wpdb;

			$recent_history = $wpdb->get_results(
				$wpdb->prepare( "SELECT * FROM %1smys_history
					WHERE HistoryDataType LIKE '%-%'
					ORDER BY HistoryID DESC LIMIT 5", $wpdb->prefix ) );

			return $recent_history;
		}
	}
}
