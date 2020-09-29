<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Amplify
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function nab_amplify_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_filter( 'body_class', 'nab_amplify_body_classes' );

/**
 * Retrieves the user images.
 *
 * @return array list of user images
 */
function nab_amplify_get_user_images() {

	$user_id           = get_current_user_id();
	$user_images_names = array( 'profile_picture', 'banner_image' );

	$user_images = array();
	foreach ( $user_images_names as $user_image ) {
		$user_image_id = get_user_meta( $user_id, $user_image, true );

		$user_images[ $user_image ] = $user_image_id
			? wp_get_attachment_image_src( $user_image_id )[0]
			: get_template_directory_uri() . '/assets/images/avtar.jpg';
	}

	return $user_images;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function nab_amplify_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'nab_amplify_pingback_header' );

/**
 * Checks whether the current cart has bulk purchase or not
 *
 * @return bool
 */
function nab_is_bulk_order() {
	foreach ( WC()->cart->get_cart() as $cart_val ) {
		if ( isset( $cart_val['nab_bulk_order'] ) && 'yes' === $cart_val['nab_bulk_order'] && isset( $cart_val['nab_qty'] ) && ! empty( $cart_val['nab_qty'] ) ) {
			return true;
		}
	}

	return false;
}

/**
 * Gets the Quantity in bulk order
 *
 * @return false|mixed
 */
function nab_bulk_order_quantity() {
	if ( ! nab_is_bulk_order() ) {
		return false;
	}

	foreach ( WC()->cart->get_cart() as $cart_val ) {
		if ( isset( $cart_val['nab_qty'] ) && ! empty( $cart_val['nab_qty'] ) ) {
			return $cart_val['nab_qty'];
		}
	}

	return false;
}

/**
 * Get Attendee count
 *
 * @param $order_id
 *
 * @return int|mixed
 */
function nab_get_attendee_count( $order_id ) {
	global $wpdb;

	if ( empty( $order_id ) ) {
		return 0;
	}

	$get_attendees_query = $wpdb->prepare( "SELECT COUNT(*) AS attendee_count FROM {$wpdb->prefix}nab_attendee WHERE `order_id` = %d AND `status` = 1", $order_id );
	$get_attendees_count = $wpdb->get_results( $get_attendees_query, ARRAY_A );

	if ( ! empty( $get_attendees_count ) ) {
		$attendee_count = $get_attendees_count[0]['attendee_count'];
	} else {
		$attendee_count = 0;
	}

	return $attendee_count;
}

/**
 * Checks whether all attendees are added or not
 *
 * @param $order_id
 *
 * @return bool
 */
function nab_is_all_attendee_added( $order_id ) {
	// Get quantity for this order
	$order_qty = get_post_meta( $order_id, '_nab_bulk_qty', true );

	if ( ! isset( $order_qty ) || empty( $order_qty ) ) {
		return false;
	}

	$attendee_count = nab_get_attendee_count( $order_id );

	if ( $attendee_count >= $order_qty ) {
		return true;
	} else {
		return false;
	}
}

function nab_cocart_get_cart( $customer_id, $default = false ) {
	global $wpdb;

	$value = $wpdb->get_var( $wpdb->prepare( "SELECT cart_value FROM {$wpdb->prefix}cocart_carts WHERE cart_key = %s", $customer_id ) );

	if ( is_null( $value ) ) {
		$value = $default;
	}

	return maybe_unserialize( $value );
}

/**
 * Generates JWT token 
 *
 * @param string $username
 * @param string $password
 */
function nab_generate_jwt_token( $username, $password ) {

	if ( ! empty( $username ) && ! empty( $password ) ) {
		$url  = home_url() . '/wp-json/jwt-auth/v1/token';
		$data = array(
			'username' => $username,
			'password' => $password,
		);

		$curl = curl_init();

		curl_setopt_array( $curl, array(
		    CURLOPT_URL => $url,
		    CURLOPT_CUSTOMREQUEST => "POST",
		    CURLOPT_POSTFIELDS => $data,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_TIMEOUT => 30,
		) );

		$response = curl_exec($curl);

		$response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		curl_close($curl);

		if ( 200 === $response_code && ! empty( $response ) ) {
			$response_body = json_decode( $response, true );

			if ( isset( $response_body['token'] ) && isset( $response_body['user_id'] ) ) {
				update_user_meta( $response_body['user_id'], 'nab_jwt_token', $response_body['token'] );
			}
		}
	}

}

/**
 * Get attendee details based on given id.
 *
 * @param  int $primary_id
 * 
 * @return array
 */
function nab_get_order_attendee_details( $primary_id ) {
	
	global $wpdb;

	$attendee_details = array();

	// Return blank array if primary id is empty
	if ( empty( $primary_id ) ) {
		return $attendee_details;
	}

	// Get attendee details from the custom DB table
	$attendees_query = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}nab_attendee WHERE `id` = %d LIMIT 1", $primary_id );
	$attendees       = $wpdb->get_results( $attendees_query, ARRAY_A );

	// Set attendee details array from the DB result if not empty array
	if ( is_array( $attendees ) && count( $attendees ) > 0 ) {
		
		$attendee_details = $attendees[0];
	}	
	
	return $attendee_details;
}


/**
 * Get attendee table primary id according to give child order id.
 *
 * @param  mixed $child_order_id
 * 
 * @return int
 */
function nab_get_attendee_primary_id_by_order_id( $child_order_id ) {
	
	global $wpdb;

	$attendeeId = 0;

	// Return default id if child oreder id is empty
	if ( empty( $child_order_id ) ) {
		return $attendeeId;
	}

	// Get attendee primary id
	$attendees_query = $wpdb->prepare( "SELECT `id` FROM {$wpdb->prefix}nab_attendee WHERE `child_order_id` = %d LIMIT 1", $child_order_id );
	$attendees       = $wpdb->get_results( $attendees_query, ARRAY_A );

	// Set attendee primary id from the DB result if not empty array
	if ( is_array( $attendees ) && count( $attendees ) > 0 ) {
		
		$attendeeId = $attendees[0]['id'];
	}
	
	return $attendeeId;
}


/**
 * Get order attendees email list. 
 *
 * @param  int $order_id
 * 
 * @return array 
 */
function nab_get_order_attendees_email_list( $order_id ) {

	global $wpdb;

	$attendee_email = array();

	// Return empty email array if order id empty
	if ( empty( $order_id ) ) {
		return $attendee_email;		
	}

	// Get attendees email throught the order id
	$attendees_query 	= $wpdb->prepare( "SELECT `email` FROM {$wpdb->prefix}nab_attendee WHERE `order_id` = %d", $order_id );
	$order_attendees	= $wpdb->get_results( $attendees_query, ARRAY_A );

	// Get each attendee emails
	if ( is_array( $order_attendees ) && count( $order_attendees ) > 0 ) {
		
		foreach( $order_attendees as $attendee ) {

			$attendee_email[] = $attendee[ 'email' ];
		}
	}

	return $attendee_email;

}

/**
 * Get order attendees email list. 
 *
 * @param  string $email
 * @param  int $order_id
 * 
 * @return boolean 
 */
function nab_is_order_attendee_exist( $email, $order_id ) {

	global $wpdb;

	$is_email_exist = false;

	// Return false if order id or email empty
	if ( empty( $order_id ) || empty( $email ) ) {
		return $is_email_exist;		
	}

	// Get attendees email throught the order id
	$attendees_query 	= $wpdb->prepare( "SELECT `email` FROM {$wpdb->prefix}nab_attendee WHERE `order_id` = %d AND `email` = %s", $order_id, $email );
	$order_attendees	= $wpdb->get_results( $attendees_query, ARRAY_A );

	// check attendee exist or not
	if ( is_array( $order_attendees ) && count( $order_attendees ) > 0 ) {
		
		$is_email_exist = true;
	}

	return $is_email_exist;

}

/**
 * Update cocart session cart if main cart is updated
 *
 * @param string $cart_item_key
 * @param int $quantity
 * @return void
 */
function nab_update_cocart_item( $cart_item_key, $quantity ) {

	if ( isset( $_COOKIE['nabCartKey'] ) && ! empty( $_COOKIE['nabCartKey'] ) && ! is_user_logged_in() ) {
		$cart_key = $_COOKIE['nabCartKey'];

		$api_url  = add_query_arg( 'cart_key', $cart_key, home_url() . '/wp-json/cocart/v1/item/' );
		
		$headers = array(
			'Accept: application/json',
			'Content-Type: application/json',
		);

		$args = json_encode(array(
			'cart_item_key' => $cart_item_key,
			'quantity'      => $quantity,
		));

		$api_url  = add_query_arg( 'cart_key', $cart_key, home_url() . '/wp-json/cocart/v1/item' );

		$curl = curl_init();
		
		curl_setopt_array( $curl, array(
			CURLOPT_URL => $api_url,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $args,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTPHEADER => $headers
		) );

		$response = curl_exec( $curl );
	}
}