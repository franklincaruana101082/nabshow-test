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
	global $post;
	wp_enqueue_script('nab-bx-slider-js', get_template_directory_uri() . '/assets/js/jquery.bxslider.min.js', ['jquery'], null, true);
	wp_enqueue_script('amplify-chosen-js', get_template_directory_uri() . '/assets/js/chosen.jquery.min.js', ['jquery'], true);
	wp_enqueue_script('amplify-select2-js', get_template_directory_uri() . '/assets/js/select2.min.js', ['jquery'], '1.0.1', true);
	wp_enqueue_script('amplify-custom-js', get_template_directory_uri() . '/assets/js/nab-amplify.js', ['jquery'], '1.0.1', true);
	wp_localize_script('amplify-custom-js', 'amplifyJS', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'nabNonce' => wp_create_nonce('nab-ajax-nonce'),
		'postID' => $post->ID,
		'postType' => is_search() ? '' : $post->post_type,
		'CompanyAdminId' => get_field('company_user_id'),
		'CurrentLoggedUser' => intval(get_current_user_id()),
		'ThemeUri' => get_template_directory_uri()
	));
	wp_enqueue_script('amplify-tag-js', get_template_directory_uri() . '/js/jquery.tagsinput.js', ['jquery'], null, true);
	wp_enqueue_media();

	wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script(
        'iris',
        admin_url( 'js/iris.min.js' ),
        array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ),
        false,
        1
    );
    wp_enqueue_script(
        'wp-color-picker',
        admin_url( 'js/color-picker.min.js' ),
        array( 'iris' ),
        false,
        1
    );
    $colorpicker_l10n = array(
        'clear' => __( 'Clear' ),
        'defaultString' => __( 'Default' ),
        'pick' => __( 'Select Color' ),
        'current' => __( 'Current Color' ),
    );
    wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n );

	//Styles enqueue.
	wp_enqueue_style('amplify-style', get_stylesheet_uri());
	wp_enqueue_style('amplify-font-css', get_template_directory_uri() . '/assets/fonts/fonts.css');
	wp_enqueue_style('amplify-font-awesome-css', get_template_directory_uri() . '/assets/fonts/font-awesome.min.css');
	wp_enqueue_style('amplify-chosen-css', get_template_directory_uri() . '/assets/css/chosen.min.css');
	wp_enqueue_style('amplify-front-css', get_template_directory_uri() . '/assets/css/custom.css', '', '1.0.0');
	wp_enqueue_style('amplify-media-css', get_template_directory_uri() . '/assets/css/media.css');
	wp_enqueue_style('amplify-media-tag-css', get_template_directory_uri() . '/assets/css/jquery.tagsinput.css');
	wp_enqueue_style('amplify-select2-css', get_template_directory_uri() . '/assets/css/select2.min.css');
}


function amplify_admin_scripts()
{
	wp_enqueue_style('amplify-admin-style', get_template_directory_uri() . '/assets/css/admin.css');
	
}

if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' => 'Theme Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false,
	));
}
