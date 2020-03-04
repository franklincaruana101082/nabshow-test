<?php
/**
 * This file contains all shortcodes.
 *
 *
 * @package NABShow_LV
 */

// Shortcode for Yoast SEO Breadcrumb.
add_shortcode('nab_yoast_breadcumb', 'nabshow_lv_yoast_breadcrumb_callback' );

// Shortcode for display Date in the page according to ACF field on page.
add_shortcode( 'nab_schedule_date', 'nabshow_lv_schedule_date_callback' );

// Shortcode for display Hall according to ACF field select on page.
add_shortcode( 'nab_schedule_hall', 'nabshow_lv_schedule_hall_callback' );

// Shortcode for display current data
add_shortcode( 'nab_date_today', 'nabshow_lv_display_today_date' );