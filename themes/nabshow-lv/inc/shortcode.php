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
add_shortcode('nab_schedule_glance_filter', 'nabshow_lv_schedule_at_a_glance_filter');

// Shortcode for Yoast SEO Breadcrumb
add_shortcode('nab_yoast_breadcumb', 'nab_yoast_breadcumb_func');