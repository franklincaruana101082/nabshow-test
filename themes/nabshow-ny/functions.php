<?php

// PARENT STYLE

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {

	wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css', array(), '1.1' );

}

// WAYPOINTS

add_action('wp_enqueue_scripts', 'waypoint_enqueue_script');

function waypoint_enqueue_script() {

  wp_enqueue_script('jquery-3', '//code.jquery.com/jquery-1.12.4.min.js', array(), '1.0.0', true);
  
  wp_enqueue_script('way-points', '//cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js', array(), '1.0.0', true);

}

// THEME PAGE

add_action( 'wp_enqueue_scripts', 'ny_theme_scripts' );

function ny_theme_scripts() {

    $css_mod_time = filemtime(get_stylesheet_directory() . '/style.css');

	wp_enqueue_style ( 'style', get_stylesheet_directory_uri() . '/style.css', false, $css_mod_time );

    wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array(), '2.0.0', true );

    wp_localize_script( 'scripts', 'mdObj', array(
      'isUserLoggedIn' => is_user_logged_in(),
      'mdLoggedUserId' => get_current_user_id(),
    ) );

}

?>