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

add_action( 'wp_ajax_nab_login_add_cart' , 'nab_curl_login_add_cart_callback' );
add_action( 'wp_ajax_nopriv_nab_login_add_cart' , 'nab_curl_login_add_cart_callback' );

function nab_login_add_cart_callback() {

  $product_id = filter_input( INPUT_POST, 'product_id' );
  $cart_key   = filter_input( INPUT_POST, 'cart_key' );

  $args = [];
  $res  = [];

  if( empty( $product_id ) ) {
    $res['err'] = 1;
    $res['message'] = 'Product id not found';

    wp_send_json( $res, 200 );
  }

  $api_base_url = get_option( 'ep_parent_site_url' );

  if( empty( $api_base_url ) ) {
    $res['err'] = 1;
    $res['message'] = 'Parent site URL not found!';

    wp_send_json( $res, 200 );
  }

  $api_url = $api_base_url . 'wp-json/cocart/v1/add-item/';

  if( is_user_logged_in() ) {

    $user_id    = get_current_user_id();

    $user_token = get_user_meta( $user_id, 'nab_jwt_token', true );

    if( empty( $user_token ) ) {
      $res['err'] = 1;
      $res['message'] = 'User token missing! Please sign out and sign in again.';
  
      wp_send_json( $res, 200 );
    }

    $args['headers'] = array(
      'Content-Type' => 'application/json; charset=utf-8',
      'Authorization' => 'Bearer ' . $user_token,
    );

    $api_url = add_query_arg( 'return_cart', 'true', $api_url );

  } else {

    if( empty( $cart_key ) ) {
      $res['err'] = 1;
      $res['message'] = 'Cart key missing! Please try again.';
  
      wp_send_json( $res, 200 );
    }

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

  if( 200 === wp_remote_retrieve_response_code( $response ) ) {
    $res['err'] = 0;
    $res['body'] = json_decode( $response['body'], true );
  } else {
    $res['err'] = 1;
    $res['requested_url'] = $api_url;
    $response_body = json_decode( $response['body'], true );
    $res['message'] = ( isset( $response_body['message'] ) && ! empty( $response_body['message'] ) ) ? $response_body['message'] : 'Something went wrong. Please try again!';
  }

  wp_send_json( $res, 200 );
    
}


function nab_curl_login_add_cart_callback() {

  $product_id = filter_input( INPUT_POST, 'product_id' );
  $cart_key   = filter_input( INPUT_POST, 'cart_key' );

  $args = [];
  $res  = [];

  if( empty( $product_id ) ) {
    $res['err'] = 1;
    $res['message'] = 'Product id not found';

    wp_send_json( $res, 200 );
  }

  $api_base_url = get_option( 'ep_parent_site_url' );

  if( empty( $api_base_url ) ) {
    $res['err'] = 1;
    $res['message'] = 'Parent site URL not found!';

    wp_send_json( $res, 200 );
  }

  $api_url = $api_base_url . 'wp-json/cocart/v1/add-item/';

  if( is_user_logged_in() ) {

    $user_id    = get_current_user_id();

    $user_token = get_user_meta( $user_id, 'nab_jwt_token', true );

    if( empty( $user_token ) ) {
      $res['err'] = 1;
      $res['message'] = 'User token missing! Please sign out and sign in again.';
  
      wp_send_json( $res, 200 );
    }

    $bearer = 'Bearer ' . $user_token;
    $headers = array(
      'Accept: application/json',
      'Content-Type: application/json',
      'Authorization: ' . $bearer,
    );

    $api_url = add_query_arg( 'return_cart', 'true', $api_url );

  } else {

    if( empty( $cart_key ) ) {
      $res['err'] = 1;
      $res['message'] = 'Cart key missing! Please try again.';
  
      wp_send_json( $res, 200 );
    }

    $headers = array(
      'Accept: application/json',
      'Content-Type: application/json',
    );

    $api_url = add_query_arg( array(
      'cart_key'    => $cart_key,
      'return_cart' => 'true',
    ), $api_url );

  }

  $curl = curl_init();

  $args = json_encode(array(
    'product_id' => $product_id,
    'quantity' => 1
  ));

  curl_setopt_array( $curl, array(
    CURLOPT_URL => $api_url,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $args,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTPHEADER => $headers
  ) );

  $response = curl_exec($curl);

  $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

  curl_close($curl);

  if( 200 === $httpcode ) {
    $res['err'] = 0;
    $res['body'] = json_decode( $response, true );
  } else {
    $res['err'] = 1;
    $res['requested_url'] = $api_url;
    $response_body = json_decode( $response, true );
    $res['message'] = ( isset( $response_body['message'] ) && ! empty( $response_body['message'] ) ) ? $response_body['message'] : 'Something went wrong. Please try again!';
  }

  wp_send_json( $res, 200 );
    
}

function nabny_get_header_logos() {

  $api_base_url = get_option( 'ep_parent_site_url' );

  if( empty( $api_base_url ) ) {
    return '';
  }

  $api_url = $api_base_url . 'wp-json/nab/request/get-header-logos';
  $curl    = curl_init();

  curl_setopt_array( $curl, array(
    CURLOPT_URL => $api_url,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30
  ) );

  $response = curl_exec($curl);

  $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

  if( 200 === $httpcode ) {
    return $response;
  } else {
    return '';
  }

}