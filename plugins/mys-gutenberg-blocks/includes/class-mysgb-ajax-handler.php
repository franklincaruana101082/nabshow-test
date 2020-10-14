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

			// Session Date list ajax filters.
			add_action( 'wp_ajax_sessions_date_list_filter', array( $this, 'mysgb_sessions_date_list_filter_ajax_callback' ) );
			add_action( 'wp_ajax_nopriv_sessions_date_list_filter', array( $this, 'mysgb_sessions_date_list_filter_ajax_callback' ) );

			// Speaker info details ajax.
			add_action( 'wp_ajax_speaker_popup_details', array( $this, 'mysgb_speaker_popup_details_ajax_callback' ) );
			add_action( 'wp_ajax_nopriv_speaker_popup_details', array( $this, 'mysgb_speaker_popup_details_ajax_callback' ) );
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
			$session_location   = filter_input( INPUT_GET, 'location', FILTER_SANITIZE_STRING );
			$listing_type       = filter_input( INPUT_GET, 'listing_type', FILTER_SANITIZE_STRING );
			$session_date       = filter_input( INPUT_GET, 'session_date', FILTER_SANITIZE_STRING );
			$featured_session   = filter_input( INPUT_GET, 'featured_session', FILTER_SANITIZE_STRING );
			$without_date       = filter_input( INPUT_GET, 'without_date', FILTER_SANITIZE_STRING );
			$without_time       = filter_input( INPUT_GET, 'without_time', FILTER_SANITIZE_STRING );

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

					$date_display_format = '';

					if ( ! empty( $date ) ) {

						if ( 'no' === $without_date && 'no' === $without_time ) {
							$date_display_format = $date . ' | ' . $start_time . ' - ' . $end_time;
						} elseif ( 'no' === $without_date ) {
							$date_display_format = $date;
						} elseif ( 'no' === $without_time ) {
							$date_display_format = $start_time . ' - ' . $end_time;
						}
					} elseif (  'no' === $without_time ) {
						$date_display_format = $start_time . ' - ' . $end_time;
					}

					$date_display_format = trim( $date_display_format, ' - ');
					$featured_post       = has_term( 'featured', 'session-categories' ) ? 'featured' : '';

					$result_post[ $i ][ 'post_id' ]       = $session_id;
					$result_post[ $i ][ 'post_title' ]    = html_entity_decode( mb_strimwidth( get_the_title(), 0, 83, '...' ) );
					$result_post[ $i ][ 'featured' ]      = $featured_post;
					$result_post[ $i ][ 'date_time' ]     = $date_display_format;
					$result_post[ $i ][ 'post_excerpt' ]  = html_entity_decode( get_the_excerpt() );
					$result_post[ $i ][ 'planner_link' ]  = $session_planner_url;

					$speakers       = get_post_meta( $session_id, 'speakers', true );
					$speaker_ids    = explode(',', $speakers);
					$total_speakers = count( $speaker_ids );

					if ( ! empty( $speakers ) && $total_speakers > 0 ) {

						$final_speakers = array();

						foreach ( $speaker_ids as $speaker_id ) {

							$speaker_name = get_the_title( $speaker_id );
							$speaker_name = explode(',', $speaker_name, 2);
							$speaker_name = isset( $speaker_name[1] ) ? $speaker_name[1] . ' ' . $speaker_name[0] : $speaker_name[0];
							$final_speakers[] = $speaker_name;

						}

						if ( count( $final_speakers ) > 0 ) {

							$result_post[ $i ][ 'speakers' ] = implode( ', ', $final_speakers );
						}
					}

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

			// Second Query for Meta search.
			$meta_query2 = array();
			if ( ! empty( $post_search ) ) {
				$meta_query2 = array( 'relation' => 'OR' );

				$meta_query2[] = array (
					'key'     => 'crossreferences',
					'value'   => $post_search,
					'compare' => 'LIKE',
				);

				$query_arg2 = $query_arg;

				unset($query_arg2['s']);

				$query_arg2[ 'meta_query' ] = $meta_query2;

				$exhibitor_query2 = new WP_Query( $query_arg2 );

				$meta_query = array( 'relation' => 'OR' );
				$meta_query[] = array (
					'key'     => 'crossreferences',
					'value'   => '',
					'compare' => 'NOT EXIST',
				);
				$meta_query[] = array (
					'key'     => 'crossreferences',
					'value'   => $post_search,
					'compare' => 'NOT LIKE',
				);

				$query_arg[ 'meta_query' ] = $meta_query;
			}

			$exhibitor_query = new WP_Query( $query_arg );

			$total_pages = $exhibitor_query->max_num_pages;

			// Merging both queries.
			if ( 0 !== count( $meta_query2 ) ) {
				$result                      = new WP_Query();
				$result->posts               = array_unique( array_merge( $exhibitor_query->posts, $exhibitor_query2->posts ), SORT_REGULAR );
				$exhibitor_query->posts      = $result->posts;
				$exhibitor_query->post_count = count( $result->posts );

				$found_posts       = $exhibitor_query->found_posts;
				$found_posts2      = $exhibitor_query2->found_posts;
				$total_found_posts = $found_posts + $found_posts2;
				$total_pages       = ceil( $total_found_posts / $post_limit );
			}

			if ( $exhibitor_query->have_posts() ) {

				$i                  = 0;
				$MYSGutenbergBlocks = new MYSGutenbergBlocks();
				$show_code          = $MYSGutenbergBlocks->mysgb_get_mys_show_code();

				while ( $exhibitor_query->have_posts() ) {

					$exhibitor_query->the_post();

					$exhibitor_id    = get_the_ID();
					$booth_number    = get_post_meta( $exhibitor_id, 'boothnumbers', true );
					$crossreferences = get_post_meta( $exhibitor_id, 'crossreferences', true );
					$exh_id          = get_post_meta( $exhibitor_id, 'exhid', true );
					$exh_url         = 'https://' . $show_code . '.mapyourshow.com/8_0/exhibitor/exhibitor-details.cfm?exhid=' . $exh_id;
					$featured_post   = has_term( 'featured', 'exhibitor-keywords' ) ? 'featured' : '';
					$thumbnail_url   = has_post_thumbnail() ? get_the_post_thumbnail_url() : '';

					$result_post[ $i ]['post_id']         = $exhibitor_id;
					$result_post[ $i ]['post_title']      = html_entity_decode( get_the_title() );
					$result_post[ $i ]['featured']        = $featured_post;
					$result_post[ $i ]['boothnumber']     = $booth_number;
					$result_post[ $i ]['post_excerpt']    = html_entity_decode( get_the_excerpt() );
					$result_post[ $i ]['thumbnail_url']   = $thumbnail_url;
					$result_post[ $i ]['planner_link']    = $exh_url;
					$result_post[ $i ]['crossreferences'] = $crossreferences;

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
			$exclude_speaker    = filter_input( INPUT_GET, 'exclude_speaker', FILTER_SANITIZE_STRING );
			$session_speakers   = filter_input( INPUT_GET, 'session_speakers', FILTER_SANITIZE_STRING );
			$order              = 'date' === $order_by ? 'DESC' : 'ASC';

			$query_arg = array(
				'post_type'      => 'speakers',
				'posts_per_page' => $post_limit,
				'paged'          => $page_number,
				'orderby'        => $order_by,
				'order'          => $order,
			);

			if ( ! empty( $session_speakers ) ) {

				$all_session_speakers = explode( ',', $session_speakers );

				if ( is_array( $all_session_speakers ) && count( $all_session_speakers ) > 0 ) {

					$all_session_speakers              = array_unique( $all_session_speakers );
					$query_arg['post__in']             = $all_session_speakers;
					$query_arg['ignore_sticky_posts']  = true;
				}
			}

			if ( ! empty( trim( $exclude_speaker ) ) ) {

				$final_speakers = explode( ',' , str_replace( ' ', '', $exclude_speaker ) );

				if ( is_array( $final_speakers ) && count( $final_speakers ) > 0 ) {

					$query_arg['post__not_in'] = $final_speakers;
				}
			}

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

					$speaker_name                    = html_entity_decode( get_the_title() );
					$speaker_name                    = explode( ',', $speaker_name, 2 );
					$speaker_name                    = isset( $speaker_name[1] ) ? $speaker_name[1] . ' ' . $speaker_name[0] : $speaker_name[0];
					$result_post[ $i ]['post_title'] = $speaker_name;

					$result_post[ $i ][ 'featured' ]      = $featured_post;
					$result_post[ $i ][ 'thumbnail_url' ] = $thumbnail_url;
					$result_post[ $i ][ 'job_title' ]     = html_entity_decode( $speaker_job_title );
					$result_post[ $i ][ 'company' ]       = html_entity_decode( $speaker_company );

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

		/**
		 * Return session according to filters
		 *
		 * @return json
		 * @since 1.0.0
		 */
		public function mysgb_sessions_date_list_filter_ajax_callback() {
			
			$result_post    = array();
			$final_result   = array();

			$page_number        = filter_input( INPUT_GET, 'page_number', FILTER_SANITIZE_NUMBER_INT );
			$post_limit         = filter_input( INPUT_GET, 'post_limit', FILTER_SANITIZE_NUMBER_INT );		
			$post_search        = filter_input( INPUT_GET, 'post_search', FILTER_SANITIZE_STRING );
			$channel      		= filter_input( INPUT_GET, 'channel', FILTER_SANITIZE_STRING );		
			$session_date       = filter_input( INPUT_GET, 'session_date', FILTER_SANITIZE_STRING );
			$display_order      = filter_input( INPUT_GET, 'display_order', FILTER_SANITIZE_STRING );
			$channel_list      	= filter_input( INPUT_GET, 'channel_list', FILTER_SANITIZE_STRING );
			$session_format		= filter_input( INPUT_GET, 'format', FILTER_SANITIZE_STRING );
			$session_community	= filter_input( INPUT_GET, 'community', FILTER_SANITIZE_STRING );

			$query_arg = array(
				'post_type'      => 'sessions',
				'posts_per_page' => $post_limit,
				'paged'          => $page_number,				
			);

			$meta_query_args    = array( 'relation' => 'AND' );

			$meta_query_args[ 'session_date_clause' ] = array (
				'key'       => 'session_date',
				'compare'   => 'EXISTS',
			);

			$meta_query_args[ 'start_time_clause' ] = array (
				'key'       => 'start_time',
				'compare'   => 'EXISTS',
			);

			if ( ! empty( $post_search ) ) {
				$query_arg[ 's' ] = $post_search;
			}			

			if ( ! empty( $session_date ) ) {
				
				$meta_query_args[] = array (
					
					'key' 	=> 'session_date',
					'value'	=> $session_date,
					'type'  => 'DATE',
				);				
			}

			$tax_query_args = array( 'relation' => 'AND' );

			if ( ! empty( $session_format ) ) {
				$tax_query_args[] =  array (
					'taxonomy' => 'session-format',
					'field'    => 'slug',
					'terms'    => $session_format,
				);
			}

			if ( ! empty( $session_community ) ) {
				$tax_query_args[] = array (
					'taxonomy' => 'session-community',
					'field'    => 'slug',
					'terms'    => $session_community,
				);
			}

			if ( count( $tax_query_args ) > 1 ) {
				$query_arg[ 'tax_query' ] = $tax_query_args;
			}

			if ( ! empty( $channel_list ) ) {
				
				$all_channel = explode( ',', $channel_list );
				
				if ( ! empty( $channel ) && in_array( $channel, $all_channel ) ) {
					$all_channel = array( $channel );
				} else if ( ! empty( $channel ) ) {
					$all_channel = array('');
				}
				
				$channel_meta_arr = array( 'relation' => 'OR' );

				foreach( $all_channel as $ch ) {
					
					$channel_meta_arr[] = array(
						'key'     => 'session_channel',
						'value'   => '"' . $ch . '"',
						'compare' => 'LIKE'
					);
				}

				if ( count( $channel_meta_arr ) > 1 ) {

					$meta_query_args[] = $channel_meta_arr;
				}				

			} else if ( ! empty( $channel ) ) {
				
				$meta_query_args[] = array(
					array(
						'key'     => 'session_channel',
						'value'   => '"' . $channel . '"',
						'compare' => 'LIKE'
					)
				);
			}			
				
			$query_arg[ 'meta_query' ] = $meta_query_args;			

			$query_arg[ 'orderby' ] = array(
				'session_date_clause'   => $display_order,
				'start_time_clause'     => 'ASC',
			);
			

			$session_query = new WP_Query( $query_arg );

			$total_pages = $session_query->max_num_pages;

			if ( $session_query->have_posts() ) {

				$i = 0;				

				while ( $session_query->have_posts() ) {

					$session_query->the_post();

					$session_id     = get_the_ID();
					$date           = get_field( 'session_date',  $session_id );
					$start_time     = get_field( 'start_time',  $session_id );
					$end_time       = get_field( 'end_time',  $session_id );
					$is_open_to     = get_field( 'is_open_to',  $session_id );
                	$is_open_to     = 'Select Open To' === $is_open_to ? '' : $is_open_to;
					$schedule_class = 'white_bg';
					$button_text    = 'Learn More';					

					if ( ! empty( $date ) ) {
						$current_date   = current_time('Ymd');
						$session_date   = date_format( date_create( $date ), 'Ymd' );
						$date1          = new DateTime( $session_date );
						$now            = new DateTime( $current_date );

						if ( $date1 < $now )  {
							$schedule_class = 'gray_bg';
							$button_text    = 'Watch On Demand';
						} elseif ( $date1 > $now ) {
							$schedule_class = 'white_bg';
							$button_text    = 'Learn More';
						} else if ( $session_date === $current_date ) {
							
							$current_time   = current_time('g:i a');                    
							$time1          = DateTime::createFromFormat('H:i a', $current_time);
							$time2          = DateTime::createFromFormat('H:i a', $start_time);
							$time3          = DateTime::createFromFormat('H:i a', $end_time);
															
							if ( $time1 > $time2 && $time1 < $time3 ) {
								$schedule_class = 'green_bg show_desc';
								$button_text    = 'Tune in Now';
							} elseif ( $time1 <= $time2) {
								$schedule_class = 'white_bg';
								$button_text    = 'Learn More';
							} elseif ( $time1 >= $time3 ) {
								$schedule_class = 'gray_bg';
								$button_text    = 'Watch On Demand';
							}
						}
					}

					if ( ! empty( $date ) ) {
						$date       = date_format( date_create( $date ), 'l, F j' );
					}
					
					if ( ! empty( $start_time ) ) {

						$start_time = str_replace( array( 'am','pm' ), array( 'a.m.','p.m.' ), date_format( date_create( $start_time ), 'g:i a' ) );
						$start_time = str_replace(':00', '', $start_time );
	
					}
					if ( ! empty( $end_time ) ) {
	
						$end_time   = str_replace( array( 'am','pm' ), array( 'a.m.','p.m.' ), date_format( date_create( $end_time ), 'g:i a' ) );
						$end_time   = str_replace(':00', '', $end_time );
	
					}
					
					if ( false !== strpos( $start_time, 'a.m.' ) && false !== strpos( $end_time, 'a.m.' ) ) {
						$start_time = str_replace(' a.m.', '', $start_time );
					}
	
					if ( false !== strpos( $start_time, 'p.m.' ) && false !== strpos( $end_time, 'p.m.' ) ) {
						$start_time = str_replace(' p.m.', '', $start_time );
					}																	
				
					$result_post[ $i ][ 'post_title' ]    	= html_entity_decode( get_the_title() );
					$result_post[ $i ][ 'post_link' ]    	= get_the_permalink();										
					$result_post[ $i ][ 'time' ]     	  	= $start_time . ' - ' . $end_time . ' ET';
					$result_post[ $i ][ 'post_content' ]  	= html_entity_decode( get_the_excerpt( $session_id ) );
					$result_post[ $i ][ 'more_text' ]  		= $button_text;					
					$result_post[ $i ][ 'pass_name' ]  		= html_entity_decode( $is_open_to );
					$result_post[ $i ][ 'session_date' ]  	= $date;
					$result_post[ $i ][ 'schedule_class' ]	= $schedule_class;
					$result_post[ $i ][ 'thumbnail_url' ] 	= has_post_thumbnail() ? get_the_post_thumbnail_url() : plugins_url( 'assets/images/session-placeholder.png', dirname( __FILE__ ) );

					$channel = get_field( 'session_channel',  $session_id );

					if ( is_array( $channel ) && count( $channel ) > 0 ) {

						$final_channels = array();
						$cnt			= 0;

						foreach( $channel as $ch ) {

							$final_channels[ $cnt ][ 'title' ]	= html_entity_decode( get_the_title( $ch ) );
							$final_channels[ $cnt ][ 'link' ]	= get_the_permalink( $ch );

							$cnt++;
						}

						if ( count( $final_channels ) > 0 ) {
							$result_post[ $i ][ 'channel' ]	= $final_channels;
						}

					}

					$rows = get_field( 'speaker_list' );

					if ( $rows ) {

						$final_speakers = array();												
						$cnt 			= 0;

						foreach( $rows as $row ) {
							
							$speaker_id = $row['session_speaker'];
							
							if ( ! empty( $speaker_id ) ) {
								
								$speaker_name	= get_the_title( $speaker_id );
								$speaker_name   = explode(',', $speaker_name, 2);
								$speaker_name   = isset( $speaker_name[1] ) ? $speaker_name[1] . ' ' . $speaker_name[0] : $speaker_name[0];
								
								$final_speakers[ $cnt ][ 'speaker_name' ] 	= html_entity_decode( $speaker_name );
								$final_speakers[ $cnt ][ 'speaker_id' ] 	= $speaker_id;

								$cnt++;
							}
						}

						if ( count( $final_speakers ) > 0 ) {

							$result_post[ $i ][ 'speakers' ] = $final_speakers;
						}
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
		 * Return speaker details.
		 *
		 * @return json
		 * @since 1.0.0
		 */
		public function mysgb_speaker_popup_details_ajax_callback() {
			
			$result_post 		= array();
			$speaker_id			= filter_input( INPUT_GET, 'speaker_id', FILTER_SANITIZE_NUMBER_INT );
			$thumbnail_url 		= has_post_thumbnail( $speaker_id ) ? get_the_post_thumbnail_url( $speaker_id ) : plugins_url( 'assets/images/speaker-placeholder.png', dirname( __FILE__ ) );
			$speaker_content	= get_the_content( '', false, $speaker_id );
			$speaker_content	= apply_filters( 'the_content', $speaker_content );
			$MYSGutenbergBlocks = new MYSGutenbergBlocks();
			$speaker_company    = get_the_terms( $speaker_id, 'speaker-companies' );
			$speaker_company    = $MYSGutenbergBlocks->mysgb_get_pipe_separated_term_list( $speaker_company );
			
			$result_post[ 'thumbnail_url' ] = $thumbnail_url;
			$result_post[ 'title' ] 		= get_the_title( $speaker_id );
			$result_post[ 'sub_title' ]		= get_field( 'title',  $speaker_id );
			$result_post[ 'content' ] 		= $speaker_content;
			$result_post[ 'company' ]		= $speaker_company;
			
			echo wp_json_encode( $result_post );
			wp_die();

		}

	}

	new MYSAjaxHandler();
}
