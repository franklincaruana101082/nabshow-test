<?php

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {

	// wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css', array(), '1.1' );

	$css_mod_time = filemtime(get_stylesheet_directory() . '/style.css');

	wp_enqueue_style ( 'parent-style', get_stylesheet_directory_uri() . '/style.css', false, $css_mod_time );

}