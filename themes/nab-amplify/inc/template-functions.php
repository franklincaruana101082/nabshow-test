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