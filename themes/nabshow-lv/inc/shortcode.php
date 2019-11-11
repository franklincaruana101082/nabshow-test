<?php
/**
 * This file contains all shortcodes.
 *
 *
 * @package NABShow_LV
 */

add_shortcode('nab_dropdown', 'nabshow_lv_dropdown_func' );

//Fetch Latest instagram post.
add_shortcode('nab_latest_instagram_post', 'nabshow_lv_latest_instagram_post_func' );

// Filter for Schedule at a Glance page
add_shortcode('nab_schedule_glance_filter', 'nabshow_lv_schedule_at_a_glance_filter' );

// Shortcode for Yoast SEO Breadcrumb
add_shortcode('nab_yoast_breadcumb', 'nabshow_lv_yoast_breadcrumb_callback' );

//Shortcode for filter options
add_shortcode( 'nab_browse_filter', 'nabshow_lv_browse_filter_callback' );

//Shortcode for display date
add_shortcode( 'nab_schedule_date', 'nabshow_lv_schedule_date_callback' );

//Shortcode for display date
add_shortcode( 'nab_schedule_hall', 'nabshow_lv_schedule_hall_callback' );