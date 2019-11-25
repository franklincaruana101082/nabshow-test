<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! class_exists('MYSAjaxHandler') ) {

	class MYSAjaxHandler {

		/**
		 * MYSAjaxHandler constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// Session ajax filters.
			add_action( 'wp_ajax_sessions_browse_filter', array( $this, 'mysgb_sessions_browse_filter_ajax_callback' ) );
			add_action( 'wp_ajax_nopriv_sessions_browse_filter', array( $this, 'mysgb_sessions_browse_filter_ajax_callback' ) );

			// Exhibitor ajax filters.
			add_action( 'wp_ajax_exhibitors_browse_filter', array( $this, 'mysgb_exhibitors_browse_filter_ajax_callback' ) );
			add_action( 'wp_ajax_nopriv_exhibitors_browse_filter', array( $this, 'mysgb_exhibitors_browse_filter_ajax_callback' ) );

			// Speaker ajax filters.
			add_action( 'wp_ajax_speakers_browse_filter', array( $this, 'mysgb_speakers_browse_filter_ajax_callback' ) );
			add_action( 'wp_ajax_nopriv_speakers_browse_filter', array( $this, 'mysgb_speakers_browse_filter_ajax_callback' ) );

			// Filter for add custom post where
			add_filter( 'posts_where', array( $this, 'mysgb_set_custom_posts_where' ), 10, 2 );

		}

		/**
		 * Return sessions according to filters
		 *
		 * @return json
		 * @since 1.0.0
		 */
		public function mysgb_sessions_browse_filter_ajax_callback() {

			check_ajax_referer( 'browse_filter_nonce', 'browse_filter_nonce' );

			$result_post    = array();
			$final_result   = array();

			$page_number        = filter_input( INPUT_GET, 'page_number', FILTER_SANITIZE_NUMBER_INT );
			$post_limit         = filter_input( INPUT_GET, 'post_limit', FILTER_SANITIZE_NUMBER_INT );
			$post_start         = filter_input( INPUT_GET, 'post_start', FILTER_SANITIZE_STRING );
			$post_search        = filter_input( INPUT_GET, 'post_search', FILTER_SANITIZE_STRING );
			$session_track      = filter_input( INPUT_GET, 'track', FILTER_SANITIZE_STRING );
			$session_level      = filter_input( INPUT_GET, 'level', FILTER_SANITIZE_STRING );
			$session_type       = filter_input( INPUT_GET, 'session_type', FILTER_SANITIZE_STRING );
			$session_location   = filter_input( INPUT_GET, 'location', FILTER_SANITIZE_STRING );
			$listing_type       = filter_input( INPUT_GET, 'listing_type', FILTER_SANITIZE_STRING );
			$session_date       = filter_input( INPUT_GET, 'session_date', FILTER_SANITIZE_STRING );
			$featured_session   = filter_input( INPUT_GET, 'featured_session', FILTER_SANITIZE_STRING );

			$query_arg = array(
				'post_type'      => 'sessions',
				'posts_per_page' => $post_limit,
				'paged'          => $page_number
			);

			if ( ! empty( $post_start ) ) {
				$query_arg[ 'starts_with' ] = $post_start;
			}

			if ( ! empty( $post_search ) ) {
				$query_arg[ 's' ] = $post_search;
			}

			$tax_query_args = array( 'relation' => 'AND' );

			if ( ! empty( $listing_type ) ) {

				$query_arg[ 'meta_key' ] = 'date';
				$query_arg[ 'orderby' ]  = 'meta_value';
				$query_arg[ 'order' ]    = 'ASC';

				$tax_query_args[] = array (
					'taxonomy' => 'session-categories',
					'field'    => 'slug',
					'terms'    => $listing_type,
				);
			}

			if ( ! empty( $featured_session ) ) {
				$tax_query_args[] = array (
					'taxonomy' => 'session-categories',
					'field'    => 'slug',
					'terms'    => $featured_session,
				);
			}

			if ( ! empty( $session_track ) ) {
				$tax_query_args[] = array (
					'taxonomy' => 'tracks',
					'field'    => 'slug',
					'terms'    => $session_track,
				);
			}

			if ( ! empty( $session_level ) ) {
				$tax_query_args[] = array (
					'taxonomy' => 'session-levels',
					'field'    => 'slug',
					'terms'    => $session_level,
				);
			}

			if ( ! empty( $session_type ) ) {
				$tax_query_args[] = array (
					'taxonomy' => 'session-types',
					'field'    => 'slug',
					'terms'    => $session_type,
				);
			}

			if ( ! empty( $session_location ) ) {
				$tax_query_args[] = array (
					'taxonomy' => 'session-locations',
					'field'    => 'slug',
					'terms'    => $session_location,
				);
			}

			if ( count( $tax_query_args ) > 1 ) {
				$query_arg[ 'tax_query' ] = $tax_query_args;
			}

			if ( ! empty( $session_date ) ) {
				$session_date              = new DateTime( $session_date );
				$session_date              = $session_date->format( 'Y-m-d' );
				$query_arg[ 'meta_value' ] = $session_date;
			}

			$session_query = new WP_Query( $query_arg );

			$total_pages = $session_query->max_num_pages;

			if ( $session_query->have_posts() ) {

				$i                  = 0;
				$MYSGutenbergBlocks = new MYSGutenbergBlocks();
				$show_code          = $MYSGutenbergBlocks->mysgb_get_mys_show_code();

				while ( $session_query->have_posts() ) {

					$session_query->the_post();

					$session_id          = get_the_ID();
					$date                = get_post_meta( $session_id, 'date', true );
					$start_time          = get_post_meta( $session_id, 'starttime', true );
					$end_time            = get_post_meta( $session_id, 'endtime', true );
					$schedule_id         = get_post_meta( $session_id, 'scheduleid', true );
					$session_planner_url = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/session-details.cfm?scheduleid=' . $schedule_id;

					if ( ! empty( $date ) ) {
						$date       = date_format( date_create( $date ), 'l, F j, Y' );
					}
					if ( ! empty( $start_time ) ) {
						$start_time = str_replace( array( 'am', 'pm' ), array( 'a.m.', 'p.m.' ), date_format( date_create( $start_time ), 'g:i a' ) );
						$start_time = str_replace(':00', '', $start_time );
					}
					if ( ! empty( $end_time ) ) {
						$end_time   = str_replace( array( 'am', 'pm' ), array( 'a.m.', 'p.m.' ), date_format( date_create( $end_time ), 'g:i a' ) );
						$end_time   = str_replace(':00', '', $end_time );
					}

					$date_display_format = ! empty( $date ) ? $date . ' | ' . $start_time . ' - ' . $end_time : $start_time . ' - ' . $end_time;
					$date_display_format = trim( $date_display_format, ' - ');
					$featured_post       = has_term( 'featured', 'session-categories' ) ? 'featured' : '';

					$result_post[ $i ][ 'post_id' ]       = $session_id;
					$result_post[ $i ][ 'post_title' ]    = mb_strimwidth( get_the_title(), 0, 83, '...' );
					$result_post[ $i ][ 'featured' ]      = $featured_post;
					$result_post[ $i ][ 'date_time' ]     = $date_display_format;
					$result_post[ $i ][ 'post_excerpt' ]  = get_the_excerpt();
					$result_post[ $i ][ 'planner_link' ]  = $session_planner_url;

					if ( ! empty( $listing_type ) ) {
						$result_post[ $i ][ 'session_date' ]  = $date;
						$result_post[ $i ][ 'thumbnail_url' ] = has_post_thumbnail() ? get_the_post_thumbnail_url() : '';
					}

					$i++;
				}
			}
			wp_reset_postdata();

			$final_result[ 'next_page_number' ] = $page_number + 1;
			$final_result[ 'total_page' ]       = $total_pages;
			$final_result[ 'result_post' ]      = $result_post;

			echo wp_json_encode( $final_result );
			wp_die();

		}

		/**
		 * Return exhibitors according to filters
		 *
		 * @return json
		 * @since 1.0.0
		 */
		public function mysgb_exhibitors_browse_filter_ajax_callback() {

			check_ajax_referer( 'browse_filter_nonce', 'browse_filter_nonce' );

			$result_post    = array();
			$final_result   = array();

			$page_number            = filter_input( INPUT_GET, 'page_number', FILTER_SANITIZE_NUMBER_INT );
			$post_limit             = filter_input( INPUT_GET, 'post_limit', FILTER_SANITIZE_NUMBER_INT );
			$post_start             = filter_input( INPUT_GET, 'post_start', FILTER_SANITIZE_STRING );
			$post_search            = filter_input( INPUT_GET, 'post_search', FILTER_SANITIZE_STRING );
			$exhibitor_category     = filter_input( INPUT_GET, 'exhibitor_category', FILTER_SANITIZE_STRING );
			$exhibitor_hall         = filter_input( INPUT_GET, 'exhibitor_hall', FILTER_SANITIZE_STRING );
			$exhibitor_pavilion     = filter_input( INPUT_GET, 'exhibitor_pavilion', FILTER_SANITIZE_STRING );
			$exhibitor_keywords     = filter_input( INPUT_GET, 'exhibitor_keywords', FILTER_SANITIZE_STRING );
			$order_by               = filter_input( INPUT_GET, 'exhibitor_order', FILTER_SANITIZE_STRING );
			$exhibitor_technology   = filter_input( INPUT_GET, 'exhibitor_technology', FILTER_SANITIZE_STRING );
			$order                  = 'date' === $order_by ? 'DESC' : 'ASC';

			$query_arg = array(
				'post_type'      => 'exhibitors',
				'posts_per_page' => $post_limit,
				'paged'          => $page_number,
				'orderby'        => $order_by,
				'order'          => $order,
			);

			if ( ! empty( $post_start ) ) {
				$query_arg[ 'starts_with' ] = $post_start;
			}

			if ( ! empty( $post_search ) ) {
				$query_arg[ 's' ] = $post_search;
			}

			$tax_query_args = array( 'relation' => 'AND' );

			if ( ! empty( $exhibitor_category ) ) {
				$tax_query_args[] = array (
					'taxonomy' => 'exhibitor-categories',
					'field'    => 'slug',
					'terms'    => $exhibitor_category,
				);
			}

			if ( ! empty( $exhibitor_hall ) ) {
				$tax_query_args[] = array (
					'taxonomy' => 'halls',
					'field'    => 'slug',
					'terms'    => $exhibitor_hall,
				);
			}

			if ( ! empty( $exhibitor_pavilion ) ) {
				$tax_query_args[] = array (
					'taxonomy' => 'pavilions',
					'field'    => 'slug',
					'terms'    => $exhibitor_pavilion,
				);
			}

			if ( ! empty( $exhibitor_technology ) ) {
				$tax_query_args[] = array (
					'taxonomy' => 'exhibitor-trends',
					'field'    => 'slug',
					'terms'    => $exhibitor_technology,
				);
			}

			if ( ! empty( $exhibitor_keywords ) ) {

				$all_keywords     = explode(',', $exhibitor_keywords );
				foreach ( $all_keywords as $keyword ) {
					$tax_query_args[] = array (
						'taxonomy' => 'exhibitor-keywords',
						'field'    => 'slug',
						'terms'    => $keyword,
					);
				}

			}

			if ( count( $tax_query_args ) > 1 ) {
				$query_arg[ 'tax_query' ] = $tax_query_args;
			}

			$exhibitor_query = new WP_Query( $query_arg );

			$total_pages = $exhibitor_query->max_num_pages;

			if ( $exhibitor_query->have_posts() ) {

				$i                  = 0;
				$MYSGutenbergBlocks = new MYSGutenbergBlocks();
				$show_code          = $MYSGutenbergBlocks->mysgb_get_mys_show_code();

				while ( $exhibitor_query->have_posts() ) {

					$exhibitor_query->the_post();

					$exhibitor_id   = get_the_ID();
					$booth_number   = get_post_meta( $exhibitor_id, 'boothnumbers', true );
					$exh_id         = get_post_meta( $exhibitor_id, 'exhid', true );
					$exh_url        = 'https://' . $show_code . '.mapyourshow.com/8_0/exhibitor/exhibitor-details.cfm?exhid=' . $exh_id;
					$featured_post  = has_term( 'featured', 'exhibitor-keywords' ) ? 'featured' : '';
					$thumbnail_url  = has_post_thumbnail() ? get_the_post_thumbnail_url() : '';

					$result_post[ $i ][ 'post_id' ]       = $exhibitor_id;
					$result_post[ $i ][ 'post_title' ]    = get_the_title();
					$result_post[ $i ][ 'featured' ]      = $featured_post;
					$result_post[ $i ][ 'boothnumber' ]   = $booth_number;
					$result_post[ $i ][ 'post_excerpt' ]  = get_the_excerpt();
					$result_post[ $i ][ 'thumbnail_url' ] = $thumbnail_url;
					$result_post[ $i ][ 'planner_link' ]  = $exh_url;

					$i++;
				}
			}
			wp_reset_postdata();

			$final_result[ 'next_page_number' ] = $page_number + 1;
			$final_result[ 'total_page' ]       = $total_pages;
			$final_result[ 'result_post' ]      = $result_post;

			echo wp_json_encode( $final_result );
			wp_die();
		}

		/**
		 * Return speakers according to filters
		 *
		 * @return json
		 * @since 1.0.0
		 */
		public function mysgb_speakers_browse_filter_ajax_callback() {

			check_ajax_referer( 'browse_filter_nonce', 'browse_filter_nonce' );

			$result_post    = array();
			$final_result   = array();

			$page_number        = filter_input( INPUT_GET, 'page_number', FILTER_SANITIZE_NUMBER_INT );
			$post_limit         = filter_input( INPUT_GET, 'post_limit', FILTER_SANITIZE_NUMBER_INT );
			$post_start         = filter_input( INPUT_GET, 'post_start', FILTER_SANITIZE_STRING );
			$post_search        = filter_input( INPUT_GET, 'post_search', FILTER_SANITIZE_STRING );
			$speaker_company    = filter_input( INPUT_GET, 'speaker_company', FILTER_SANITIZE_STRING );
			$speaker_job        = filter_input( INPUT_GET, 'speaker_job', FILTER_SANITIZE_STRING );
			$speaker_date       = filter_input( INPUT_GET, 'speaker_date', FILTER_SANITIZE_STRING );
			$featured_speaker   = filter_input( INPUT_GET, 'featured_speaker', FILTER_SANITIZE_STRING );
			$order_by           = filter_input( INPUT_GET, 'speaker_order', FILTER_SANITIZE_STRING );
			$order              = 'date' === $order_by ? 'DESC' : 'ASC';

			$query_arg = array(
				'post_type'      => 'speakers',
				'posts_per_page' => $post_limit,
				'paged'          => $page_number,
				'orderby'        => $order_by,
				'order'          => $order,
			);

			if ( ! empty( $post_start ) ) {
				$query_arg[ 'starts_with' ] = $post_start;
			}

			if ( ! empty( $post_search ) ) {
				$query_arg[ 's' ] = $post_search;
			}

			$tax_query_args = array( 'relation' => 'AND' );

			if ( ! empty( $speaker_company ) ) {
				$tax_query_args[] =  array (
					'taxonomy' => 'speaker-companies',
					'field'    => 'slug',
					'terms'    => $speaker_company,
				);
			}

			if ( ! empty( $featured_speaker ) ) {
				$tax_query_args[] = array (
					'taxonomy' => 'speaker-categories',
					'field'    => 'slug',
					'terms'    => $featured_speaker,
				);
			}

			if ( count( $tax_query_args ) > 1 ) {
				$query_arg[ 'tax_query' ] = $tax_query_args;
			}

			$meta_query = array( 'relation' => 'AND' );

			if ( ! empty( $speaker_job ) ) {
				$meta_query[] = array (
					'key'     => 'title',
					'value'   => $speaker_job,
					'compare' => 'LIKE',
				);
			}

			if ( ! empty( $speaker_date ) ) {
				$meta_query[] = array (
					'key'     => 'schedules',
					'value'   => $speaker_date,
					'compare' => 'LIKE',
				);
			}

			if ( count( $meta_query ) > 1 ) {
				$query_arg[ 'meta_query' ] = $meta_query;
			}

			$speaker_query = new WP_Query( $query_arg );

			$total_pages = $speaker_query->max_num_pages;

			if ( $speaker_query->have_posts() ) {

				$i                  = 0;
				$MYSGutenbergBlocks = new MYSGutenbergBlocks();

				while ( $speaker_query->have_posts() ) {

					$speaker_query->the_post();

					$speaker_id         = get_the_ID();
					$speaker_job_title  = get_post_meta( $speaker_id, 'title', true );
					$thumbnail_url      = has_post_thumbnail() ? get_the_post_thumbnail_url() : $MYSGutenbergBlocks->mysgb_get_speaker_thumbnail_url();
					$featured_post      = has_term( 'featured', 'speaker-categories' ) ? 'featured' : '';
					$speaker_company    = get_the_terms( $speaker_id, 'speaker-companies' );
					$speaker_company    = $MYSGutenbergBlocks->mysgb_get_pipe_separated_term_list( $speaker_company );

					$result_post[ $i ][ 'post_id' ]       = $speaker_id;
					$result_post[ $i ][ 'post_title' ]    = get_the_title();
					$result_post[ $i ][ 'featured' ]      = $featured_post;
					$result_post[ $i ][ 'thumbnail_url' ] = $thumbnail_url;
					$result_post[ $i ][ 'job_title' ]     = $speaker_job_title;
					$result_post[ $i ][ 'company' ]       = $speaker_company;

					$i++;
				}
			}
			wp_reset_postdata();

			$final_result[ 'next_page_number' ] = $page_number + 1;
			$final_result[ 'total_page' ]       = $total_pages;
			$final_result[ 'result_post' ]      = $result_post;

			echo wp_json_encode( $final_result );
			wp_die();
		}

		/**
		 * Added start_with parameter in post where
		 *
		 * @param $where
		 * @param $query
		 *
		 * @return string
		 * @since 1.0.0
		 */
		public function mysgb_set_custom_posts_where( $where, $query ) {

			global $wpdb;

			$starts_with = $query->get( 'starts_with' );

			if ( $starts_with ) {
				$where .= " AND $wpdb->posts.post_title LIKE '$starts_with%'";
			}

			return $where;
		}

	}

	new MYSAjaxHandler();
}