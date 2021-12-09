<?php
/**
 * NABShow 2022 functions and definitions
 *
 */

function nabshow_2022_enqueue_styles() {
    wp_enqueue_style( 'nabshow-2022', 
    	get_stylesheet_directory_uri().'/style.css'
    );
    wp_enqueue_style( 'nabshow-2022-theme', 
        get_stylesheet_directory_uri().'/assets/css/styles.min.css'
    );
    wp_enqueue_script( 'nabshow-2022-main', get_stylesheet_directory_uri() . '/assets/js/app.min.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'nabshow_2022_enqueue_styles', 101 );


