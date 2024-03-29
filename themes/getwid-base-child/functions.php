<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'linearicons-free' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_ext1', trailingslashit( get_theme_root_uri() ) . 'getwid-base-child/Molot-webfont.woff' );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION

// Load Gutenberg Block Editor on VIP Go for this /*
add_filter( 'use_block_editor_for_post', '__return_true' );

// Add Custom Meta Box for Disclaimer Text
function event_desclaimer_text_box() {
    $screens = ['tribe_events'];
    foreach ($screens as $screen) {
        add_meta_box(
            'event_desclaimer_meta',
            'Disclaimer Text',
            'event_desclaimer_text_box_html',
            $screen
        );
    }
}
add_action('add_meta_boxes', 'event_desclaimer_text_box');

function event_desclaimer_text_box_html( $post ) {
    $value = get_post_meta($post->ID, '_event_desclaimer_text', true);

    $content   = $value;
    $editor_id = 'event_desclaimer_text_editor';
    wp_editor( $content, $editor_id );
}

function save_event_desclaimer_text( $post_id ) {
    if (array_key_exists('event_desclaimer_text_editor', $_POST)) {
        update_post_meta(
            $post_id,
            '_event_desclaimer_text',
            $_POST['event_desclaimer_text_editor']
        );
    }
}
add_action('save_post', 'save_event_desclaimer_text');

// Function to change email address

function wpb_sender_email( $original_email_address ) {
    return 'register@nab.org';
}

// Function to change sender name
function wpb_sender_name( $original_email_from ) {
    return 'Collectively Speaking, NAB Show';
}

// Hooking up our functions to WordPress filters
add_filter( 'wp_mail_from', 'wpb_sender_email' );
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );

// function logo_size_change(){
// 	remove_theme_support( 'custom-logo' );
// 	add_theme_support( 'custom-logo', array(
// 	    'height'      => 100,
// 	    'width'       => 400,
// 	    'flex-height' => true,
// 	    'flex-width'  => true,
// 	) );
// }
// add_action( 'after_setup_theme', 'logo_size_change', 11 );
