<?php

// Register session post type and assodicate taxonomies
add_action( 'init', 'amplify_register_sessions_post_type' );

// Register speaker post type
add_action( 'init', 'amplify_register_speakers_post_type' );

// Register sponosors post type
add_action( 'init', 'amplify_register_sponsors_post_type' );

// Register exhibitor post type
add_action( 'init', 'amplify_register_exhibitors_post_type' );

// Register Channel post type
add_action( 'init', 'amplify_register_channel_post_type' );
