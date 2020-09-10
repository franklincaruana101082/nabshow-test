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

    wp_localize_script( 'scripts', 'mdObj', array(
      'isUserLoggedIn' => is_user_logged_in(),
      'mdLoggedUserId' => get_current_user_id(),
      'ajaxUrl'        => admin_url( 'admin-ajax.php' ),
      'nabCartKey'     => uniqid(),
    ) );

}

/**
 * Include files for theme customize hooks.
 */
require_once get_stylesheet_directory() . '/inc/segment-ga-dev.php';


add_action( 'wp_ajax_nab_login_add_cart' , 'nab_login_add_cart_callback' );
add_action( 'wp_ajax_nopriv_nab_login_add_cart' , 'nab_login_add_cart_callback' );

function nab_login_add_cart_callback() {
  $product_id = filter_input( INPUT_POST, 'product_id' );
  $user_id    = get_current_user_id();

  $user_token = get_user_meta( $user_id, 'nab_jwt_token', true );

  if( ! empty( $user_token ) ) {
    $url = 'https://nabshow-com-develop.go-vip.net/amplify/wp-json/cocart/v1/add-item?return_cart=true';
    
    $args = array(
      'headers' => array(
        'Content-Type' => 'application/json; charset=utf-8',
        'Authorization' => 'Bearer ' . $user_token,
      ),
      'body' => wp_json_encode( [
        'product_id' => $product_id,
        'quantity' => 1
      ] ),
      'timeout' => 30
    );

    $response = wp_remote_post( $url, $args );

    wp_send_json( $response['body'], 200 );
    
  }
}