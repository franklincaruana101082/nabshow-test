<?php

function nab_ny_get_cart() {

    $cart_qty = 0;
    
    $nab_parent_site_api_url = get_option( 'ep_parent_site_url' );

    if( ! empty( $nab_parent_site_api_url ) ) {
        if ( is_user_logged_in() ) {
            $user_id = get_current_user_id();
            $token   = get_user_meta( $user_id, 'nab_jwt_token', true );
            if ( ! empty( $token ) ) {
                $api_url  = $nab_parent_site_api_url . 'wp-json/wc/store/cart';
                $args     = array(
                    'headers' => array(
                        'Authorization' => 'Bearer ' . $token,
                    ),
                );
                $response = wp_remote_get( $api_url, $args );
    
                if ( 200 === wp_remote_retrieve_response_code( $response ) ) {
                    $body     = json_decode( wp_remote_retrieve_body( $response ), true );
                    $cart_qty = $body['items_count'];
                }
            }
    
        } else {
            if ( isset( $_COOKIE['nabCartKey'] ) && ! empty( $_COOKIE['nabCartKey'] ) ) {
                $cart_key = $_COOKIE['nabCartKey'];
    
                $api_url  = add_query_arg( 'cart_key', $cart_key, $nab_parent_site_api_url . 'wp-json/cocart/v1/count-items' );
                $response = wp_remote_get( $api_url );
    
                if ( 200 === wp_remote_retrieve_response_code( $response ) ) {
                    $cart_qty = wp_remote_retrieve_body( $response );
                }
            }
        }
    }

	return $cart_qty;
}

add_action( 'wp_ajax_nab_login_add_cart' , 'nab_login_add_cart_callback' );
add_action( 'wp_ajax_nopriv_nab_login_add_cart' , 'nab_login_add_cart_callback' );

function nab_login_add_cart_callback() {

  $product_id = filter_input( INPUT_POST, 'product_id' );
  $cart_key   = filter_input( INPUT_POST, 'cart_key' );

  $api_base_url = get_option( 'ep_parent_site_url' );
  $api_url = $api_base_url . 'wp-json/cocart/v1/add-item/';

  if( is_user_logged_in() ) {

    $user_id    = get_current_user_id();

    $user_token = get_user_meta( $user_id, 'nab_jwt_token', true );

    $args['headers'] = array(
      'Content-Type' => 'application/json; charset=utf-8',
      'Authorization' => 'Bearer ' . $user_token,
    );

    $api_url = add_query_arg( 'return_cart', 'true', $api_url );

  } else {

    $args['headers'] = array(
      'Content-Type' => 'application/json; charset=utf-8',
    );

    $api_url = add_query_arg( array(
      'cart_key'    => $cart_key,
      'return_cart' => 'true',
    ), $api_url );

  }

  $args['body'] = wp_json_encode( [
    'product_id' => $product_id,
  ] );
  

  $response = wp_remote_post( $api_url, $args );

  wp_send_json( $response['body'], 200 );
    
}