<?php
//Register channel custom post type
add_action( 'init', 'nabny_register_channel_post_type' );

//Enqueue required scripts
add_action( 'wp_enqueue_scripts', 'nabny_enqueue_required_scripts' );

//ACF hook for add custom field.
add_action( 'acf/save_post', 'nabny_save_date_time_acf_meta' );

//Filter for add custom column in the session list table
add_filter( 'manage_sessions_posts_columns', 'nabny_add_custom_channel_column' );

//Action for display channel in the custom channel column
add_action( 'manage_sessions_posts_custom_column', 'nabny_channel_columns_data', 10, 2 );

//Action for add custom filter drop-down in the session list table.
add_action( 'restrict_manage_posts', 'nabny_session_channel_filter_dropdown' );

//Filter for add meta key and value to filter session list table
add_filter( 'parse_query', 'nabny_session_filter_by_channel' );