<?php

/**
 * This file included all custom endpoint callback function
 * @package NABShow_LV
 */

/**
 * Get parent page list
 * @return WP_REST_Response
 */
function nabshow_lv_get_page_parents_callback() {

	$parent_pages = get_transient( 'nab-get-parent-pages-list' );

	if ( false === $parent_pages ) {

		$parent_pages = array();
		$all_pages    = get_pages();

		if ( count( $all_pages ) > 0 ) {

			$cnt = 0;

			foreach ( $all_pages as $current_page ) {

				$children_pages = new WP_Query( array( 'post_type' => 'page', 'post_parent' => $current_page->ID, 'posts_per_page' => 1 ) );

				if ( $children_pages->have_posts() ) {

					$parent_pages[ $cnt ][ 'id' ]    = $current_page->ID;
					$parent_pages[ $cnt ][ 'title' ] = $current_page->post_title;
					$cnt ++;
				}
				wp_reset_postdata();
			}
		}
		if ( count( $parent_pages ) > 0 ) {
			set_transient( 'nab-get-parent-pages-list', $parent_pages, 30 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
		}
	}

	return new WP_REST_Response( $parent_pages, 200 );

}

/**
 * Get parent page list
 * @return WP_REST_Response
 */
function nabshow_lv_get_page_acf_fields() {

	$page_hall_options = get_transient( 'nab-get-page-acf-list' );

	if ( false === $page_hall_options ) {

		$page_hall_options = array();

		$acf_fields = get_field_object( 'field_5d8370834f786' );

		if ( isset( $acf_fields[ 'choices' ] ) && is_array( $acf_fields[ 'choices' ] ) ) {

			$cnt = 0;

			foreach ( $acf_fields[ 'choices' ] as $field_val => $field_label ) {

				$page_hall_options[ $cnt ][ 'label' ] = $field_label;
				$page_hall_options[ $cnt ][ 'value' ] = $field_val;
				$cnt++;
			}

			if ( count( $page_hall_options ) > 0 ) {

				set_transient( 'nab-get-page-acf-list', $page_hall_options, 30 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
			}
		}
	}

	return new WP_REST_Response( $page_hall_options, 200 );

}
