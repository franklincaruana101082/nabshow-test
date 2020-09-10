<?php
// Register channel custom post type
add_action( 'init', 'nabny_register_channel_post_type' );

// Enqueue required scripts
add_action( 'wp_enqueue_scripts', 'nabny_enqueue_required_scripts' );

//ACF hook for add custom field.
add_action( 'acf/save_post', 'nabny_save_date_time_acf_meta' );
