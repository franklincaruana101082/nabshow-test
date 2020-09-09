<?php

/**
 * All theme setup functions located in this file
 *
 * @package amplify
 */

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */

function amplify_front_scripts()
{
	//Scripts enqueue.
	wp_enqueue_script( 'nab-bx-slider-js', get_template_directory_uri() . '/assets/js/jquery.bxslider.min.js', [ 'jquery' ], null, true );
	wp_enqueue_script('amplify-custom-js', get_template_directory_uri() . '/assets/js/nab-amplify.js', ['jquery'], '1.0.0', true);
	wp_localize_script( 'amplify-custom-js', 'amplifyJS', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nabNonce' => wp_create_nonce('nab-ajax-nonce'),
	));

	//Styles enqueue.
	wp_enqueue_style('amplify-style', get_stylesheet_uri());
	wp_enqueue_style('amplify-font-css', get_template_directory_uri() . '/assets/fonts/fonts.css');
	wp_enqueue_style('amplify-font-awesome-css', get_template_directory_uri() . '/assets/fonts/font-awesome.min.css');
	wp_enqueue_style('amplify-front-css', get_template_directory_uri() . '/assets/css/custom.css');
	wp_enqueue_style('amplify-media-css', get_template_directory_uri() . '/assets/css/media.css');
}


function amplify_admin_scripts()
{
	wp_enqueue_style('amplify-admin-style', get_template_directory_uri() . '/assets/css/admin.css');
}

if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page( array(
		'page_title' => 'Theme Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false,
	) );

}
