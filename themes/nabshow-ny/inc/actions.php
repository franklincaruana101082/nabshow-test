<?php
// Register channel custom post type
add_action( 'init', 'nabny_register_channel_post_type' );

// Enqueue required scripts
add_action( 'wp_enqueue_scripts', 'nabny_enqueue_required_scripts' );

add_filter( 'the_content', 'nabny_restrict_session_content', 1 );