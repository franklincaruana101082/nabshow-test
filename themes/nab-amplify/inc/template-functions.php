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

	$a = [];
	$a['query'] = $wpdb->prepare( "SELECT cart_value FROM {$wpdb->prefix}cocart_carts WHERE cart_key = %s", $customer_id );
	$a['val'] = $value;

	wp_mail('hardik.thakkar@multidots.com', 'query-cart', print_r( $a, true ));

	if ( is_null( $value ) ) {
		$value = $default;
	}

	return maybe_unserialize( $value );
}