<?php
/**
 * This file contains all shortcodes.
 *
 *
 * @package NABShow_LV
 */

// Shortcode for create drop-down according to atts.
add_shortcode('nab_dropdown', 'nabshow_lv_dropdown_func' );

// Shortcode for Yoast SEO Breadcrumb.
add_shortcode('nab_yoast_breadcumb', 'nabshow_lv_yoast_breadcrumb_callback' );

// Shortcode for display Date in the page according to ACF field on page.
add_shortcode( 'nab_schedule_date', 'nabshow_lv_schedule_date_callback' );

// Shortcode for display Hall according to ACF field select on page.
add_shortcode( 'nab_schedule_hall', 'nabshow_lv_schedule_hall_callback' );