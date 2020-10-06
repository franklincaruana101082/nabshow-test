<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'avada-stylesheet' ) );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );


// Hide admin bar from non-admins


add_action('after_setup_theme', 'remove_admin_bar');
 
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

// Add class in the register now menu link button
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );

function add_menu_link_class( $atts, $item, $args ) {

  if ( 'custom' === $item->type && 'REGISTER NOW' === strtoupper( $item->title ) ) {
    $atts[ 'class' ] = $atts[ 'class' ] . ' amplifyGuestSignIn';    
  }
  
  return $atts;
}

//clear logged in user cache
add_action( 'init', 'nab_clear_cache_for_logged_in_users');

function nab_clear_cache_for_logged_in_users() {
  
  if ( ! is_admin() && is_user_logged_in() ) {    
    wp_cache_flush();
  }
}