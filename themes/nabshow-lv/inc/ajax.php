<?php
/**
 * This file contains all the ajax actions and the callback functions.
 *
 *
 * @package NABShow_LV
 */

/**
 * Ajax for load more and category click event.
 *
 * @since 1.0.0
 */
add_action( 'wp_ajax_nabshow_ntb_missed_load_more_category_click', 'nabshow_lv_ntb_missed_load_more_category_click_callback' );
add_action( 'wp_ajax_nopriv_nabshow_ntb_missed_load_more_category_click', 'nabshow_lv_ntb_missed_load_more_category_click_callback' );

/**
 * Returns not to be misses post type data for ajax on load more.
 *
 * @return json
 *
 * @since 1.0.0
 */
function nabshow_lv_ntb_missed_load_more_category_click_callback() {

	check_ajax_referer( 'ntb_missed_nonce', 'term_data_nonce' );

	$result_post                  = array();
	$final_result                 = array();
	$portfolio_category_term_slug = filter_input( INPUT_GET, 'portfolio_category_term_slug', FILTER_SANITIZE_STRING );
	$page_number                  = filter_input( INPUT_GET, 'page_number', FILTER_SANITIZE_STRING );
	$fetch_item                   = filter_input( INPUT_GET, 'fetch_item', FILTER_SANITIZE_NUMBER_INT );
	$event_name                   = filter_input( INPUT_GET, 'event_name', FILTER_SANITIZE_STRING );

	$post_type_query = get_transient( 'nab-ntb-missed-' . $event_name . '-cache-' . $portfolio_category_term_slug . '-' . $page_number );

	if ( false === $post_type_query ) {

		if ( ! empty( $portfolio_category_term_slug ) ) {
			$post_type_args = array(
				'post_type' => 'not-to-be-missed',
				'tax_query' => array(
					array(
						'taxonomy' => 'featured-category',
						'field'    => 'slug',
						'terms'    => array( $portfolio_category_term_slug )
					),
				),
			);
		} else {
			$post_type_args = array(
				'post_type' => 'not-to-be-missed',
			);
		}
		if ( isset( $fetch_item ) && $fetch_item > 0 ) {
            $post_type_args['posts_per_page'] = $fetch_item;
        } else {
            $post_type_args['paged'] = $page_number;
        }

		$post_type_query = new WP_Query( $post_type_args );

		set_transient( 'nab-ntb-missed-' . $event_name . '-cache-' . $portfolio_category_term_slug . '-' . $page_number, $post_type_query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );

	}

	$total_pages = $post_type_query->max_num_pages;


	if ( $post_type_query->have_posts() ):
		$i = 0;
		while ( $post_type_query->have_posts() ):

			$post_type_query->the_post();

			$categories         = get_the_terms( get_the_ID(), 'featured-category' );
			$categories_string  = nabshow_lv_get_pipe_separated_term_list( $categories );

			$result_post[ $i ]["post_id"]        = get_the_ID();
			$result_post[ $i ]["post_title"]     = html_entity_decode( get_the_title() );
			$result_post[ $i ]["post_permalink"] = get_the_permalink();
			$result_post[ $i ]["post_thumbnail"] = get_the_post_thumbnail_url();
			$result_post[ $i ]["post_category"]  = $categories_string;


			$i ++;
		endwhile;
	endif;

	$final_result["next_page_number"] = $page_number + 1;
	$final_result["total_page"]       = $total_pages;
	$final_result["result_post"]      = $result_post;

	echo wp_json_encode( $final_result );
	wp_die();
}

add_action( 'wp_ajax_nabshow_thoughts_gallery_load_more', 'nabshow_lv_thoughts_gallery_load_more_callback' );
add_action( 'wp_ajax_nopriv_nabshow_thoughts_gallery_load_more', 'nabshow_lv_thoughts_gallery_load_more_callback' );

/**
 * Returns thought gallery post type data for ajax on load more.
 *
 * @return json
 *
 * @since 1.0.0
 */
function nabshow_lv_thoughts_gallery_load_more_callback() {

	check_ajax_referer( 'thought_gallery_nonce', 'load_more_nonce' );

	$final_result       = array();
	$result_post        = array();
	$page_number        = filter_input( INPUT_GET, 'page_number', FILTER_SANITIZE_STRING );
	$current_category   = filter_input( INPUT_GET, 'current_category', FILTER_SANITIZE_STRING );

	$post_type_args  = array(
		'post_type' => 'thought-gallery',
		'paged'     => $page_number,
	);

	if ( ! empty( $current_category ) ) {

		$post_type_args['tax_query'] =  array(
			array(
				'taxonomy' => 'thought-gallery-category',
				'field'    => 'slug',
				'terms'    => $current_category
			),
		);
	}

	$post_type_query = new WP_Query( $post_type_args );

	$total_pages = $post_type_query->max_num_pages;

	if ( $post_type_query->have_posts() ):

		$i = 0;

		while ( $post_type_query->have_posts() ):

			$post_type_query->the_post();

			$post_id               = get_the_ID();
			$excerpt               = nabshow_lv_excerpt();
			$category_list         = [];
			$category_link_lists   = [];
			$category_slugs        = [];
			$tax_thought_galleries = get_the_terms( $post_id, 'thought-gallery-category' );

			if ( $tax_thought_galleries && ! is_wp_error( $tax_thought_galleries ) ) {
				foreach ( $tax_thought_galleries as $tax_thought_gallery ) {

					$category_list[]       = $tax_thought_gallery->name;
					$category_link_lists[] = get_term_link( $tax_thought_gallery->slug, 'thought-gallery-category' );
					$category_slugs[]      = $tax_thought_gallery->slug;

				}
			}

			$result_post[ $i ]["post_id"]        = $post_id;
			$result_post[ $i ]["post_title"]     = html_entity_decode( get_the_title() );
			$result_post[ $i ]["post_permalink"] = get_the_permalink();
			$result_post[ $i ]["post_thumbnail"] = has_post_thumbnail() ? get_the_post_thumbnail_url() : nabshow_lv_get_empty_thumbnail_url();
			$result_post[ $i ]["post_author"]    = get_the_author();
			$result_post[ $i ]["author_link"]    = get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) );
			$result_post[ $i ]["excerpt"]        = html_entity_decode( $excerpt );
			$result_post[ $i ]["category_lists"] = $category_list;
			$result_post[ $i ]["category_links"] = $category_link_lists;
			$result_post[ $i ]["category_slugs"] = $category_slugs;

			$i ++;
		endwhile;
	endif;

	$final_result["next_page_number"] = $page_number + 1;
	$final_result["total_page"]       = $total_pages;
	$final_result["result_post"]      = $result_post;

	echo wp_json_encode( $final_result );
	wp_die();
}

add_action( 'wp_ajax_nabshow_news_releases_load_more_post', 'nabshow_lv_news_releases_load_more_post_callback' );
add_action( 'wp_ajax_nopriv_nabshow_news_releases_load_more_post', 'nabshow_lv_news_releases_load_more_post_callback' );


/**
 * Returns news release post type data for ajax on load more.
 *
 * @return json
 *
 * @since 1.0.0
 */
function nabshow_lv_news_releases_load_more_post_callback() {

	check_ajax_referer( 'news_releases_nonce', 'load_more_nonce' );

	$result_post  = array();
	$final_result = array();
	$page_number  = filter_input( INPUT_GET, 'page_number', FILTER_SANITIZE_STRING );

	$news_args  = array(
		'post_type' => 'news-releases',
		'paged'     => $page_number,
	);
	$news_query = new WP_Query( $news_args );

	$total_pages = $news_query->max_num_pages;

	if ( $news_query->have_posts() ):

		$i = 0;

		while ( $news_query->have_posts() ):

			$news_query->the_post();

			$result_post[ $i ]["post_title"]     = html_entity_decode( get_the_title() );
			$result_post[ $i ]["excerpt"]        = html_entity_decode( nabshow_lv_excerpt() );
			$result_post[ $i ]["post_permalink"] = get_the_permalink();
			$result_post[ $i ]["post_date"]      = get_the_date();

			$i ++;

		endwhile;
	endif;
	wp_reset_postdata();

	$final_result["next_page_number"] = $page_number + 1;
	$final_result["total_page"]       = $total_pages;
	$final_result["result_post"]      = $result_post;

	echo wp_json_encode( $final_result );
	wp_die();
}

/**
 * Dashboard help & support widget send mail.
 *
 * @since 1.0.0
 */
add_action( 'wp_ajax_help_support_widget', 'nabshow_lv_help_support_ajax_callback' );
add_action( 'wp_ajax_nopriv_help_support_widget', 'nabshow_lv_help_support_ajax_callback' );

/**
 * Dashboard help & support widget send mail handler.
 *
 * @return json
 *
 * @since 1.0.0
 */
function nabshow_lv_help_support_ajax_callback() {

	check_ajax_referer( 'help_support_nonce', 'mail_nonce' );

	$mail_subject   = filter_input( INPUT_GET, 'mail_subject', FILTER_SANITIZE_STRING );
	$mail_message   = filter_input( INPUT_GET, 'mail_message', FILTER_SANITIZE_STRING );
	$to_email       = 'mayur.keshwani@multidots.com';

	$headers   = array( 'Content-Type: text/html; charset=UTF-8' );
	$headers[] = 'From: NABShow <noreply@nabshow.com>';

	$success =  wp_mail( $to_email, $mail_subject, $mail_message, $headers );

	$display_msg = $success ? 'Thank you for raising support ticket. We will contact you soon.' : 'Message not sent, please try again later.';

	$final_result = array( 'result' => array( 'success' => $success, 'display_msg' => $display_msg ) );

	echo wp_json_encode( $final_result );
	wp_die();
}
