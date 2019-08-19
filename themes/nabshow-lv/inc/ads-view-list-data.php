<?php
// WP_List_Table is not loaded automatically so we need to load it in our application
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Create a new table class that will extend the WP_List_Table
 */
class Ads_View_List_Table extends WP_List_Table {
	/**
	 * Prepare the items for the table to process
	 *
	 * @return Void
	 */
	public function prepare_items() {
		$columns     = $this->get_columns();
		$data        = $this->table_data();
		$perPage     = 20;
		$currentPage = $this->get_pagenum();
		$totalItems  = count( $data );
		$this->set_pagination_args( array(
			'total_items' => $totalItems,
			'per_page'    => $perPage,
		) );
		$data                  = array_slice( $data, ( ( $currentPage - 1 ) * $perPage ), $perPage );
		$this->_column_headers = array( $columns );
		$this->items           = $data;
	}

	/**
	 * Override the parent columns method. Defines the columns to use in your listing table
	 *
	 * @return Array
	 */
	public function get_columns() {
		$columns = array(
			'title'  => 'Title',
			'views'  => 'Views',
			'clicks' => 'Clicks',
			'date'   => 'Date'
		);

		return $columns;
	}

	/**
	 * Get the table data
	 *
	 * @return Array
	 */
	private function table_data() {
		$data = array();
		$args = array(
			'post_type'   => 'nabshow-ads-view',
			'post_status' => 'publish',
		);

		$results = new WP_Query( $args );

		if ( $results->have_posts() ) {
			while ( $results->have_posts() ) {
				$results->the_post();

				$id = get_the_ID();

				$ad_views = get_post_meta( $id, 'nabshow_lv_ads_view', true );
				$ad_views = ! empty( $ad_views ) ? $ad_views : 0;

				$ad_clicks = get_post_meta( $id, 'nabshow_lv_ads_click', true );
				$ad_clicks = ! empty( $ad_clicks ) ? $ad_clicks : 0;

				$title = str_replace( 'ads_view_', '', get_the_title() );

				$link = get_post_meta( $id, 'nabshow_lv_ad_post_slug', true );

				$date = get_post_meta( $id, 'nabshow_lv_ad_date', true );

				$data[] = array(
					'title'  => $title,
					'views'  => $ad_views,
					'clicks' => $ad_clicks,
					'link'   => $link,
					'date'   => $date
				);
			}
		}

		return $data;
	}

	/**
	 * Define what data to show on each column of the table
	 *
	 * @param Array $item Data
	 * @param String $column_name - Current column name
	 *
	 * @return Mixed
	 */
	public function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'title':
				return '<a href="' . $item['link'] . '" target="_blank">' . $item[ $column_name ] . '</a>';
			case 'date':
				return 'Last viewed </br><abbr title="'.$item[ $column_name ].'">'. date("Y/m/d",strtotime($item[ $column_name ])) .'</abbr>';
			case 'views':
			case 'clicks':
			default :
				return $item[ $column_name ];
		}
	}
}