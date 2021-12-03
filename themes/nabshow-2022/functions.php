<?php
/**
 * NABShow 2022 functions and definitions
 *
 */

function nabshow_2022_enqueue_styles() {
    wp_enqueue_style( 'nabshow-2022', 
    	get_stylesheet_directory_uri().'/style.css'
    );
}
add_action( 'wp_enqueue_scripts', 'nabshow_2022_enqueue_styles', 101 );


