<?php

// WAYPOINTS

add_action('wp_enqueue_scripts', 'waypoint_enqueue_script');

function waypoint_enqueue_script() {

  wp_enqueue_script('jquery-3', '//code.jquery.com/jquery-1.12.4.min.js', array(), '1.0.0', true);
  
  wp_enqueue_script('way-points', '//cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js', array(), '1.0.0', true);

}

// NY SCRIPT

add_action( 'wp_enqueue_scripts', 'ny_enqueue_styles', PHP_INT_MAX);

function ny_enqueue_styles() {

    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );

    wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array(), '2.0.0', true );

    wp_localize_script( 'scripts', 'nabshowNy', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
    ) );

}

/**
 * Include files for theme customize hooks.
 */
require_once get_stylesheet_directory() . '/inc/actions.php';
require_once get_stylesheet_directory() . '/inc/actions-functions.php';
require_once get_stylesheet_directory() . '/inc/segment-ga-prod.php';


// Hide admin bar from non-admins


add_action('after_setup_theme', 'remove_admin_bar');
 
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}