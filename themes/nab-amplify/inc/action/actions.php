<?php

/**
 * This file contains all action hooks.
 *
 *
 * @package amplify
 */

/*Action for enqueue scripts.*/
add_action( 'wp_enqueue_scripts', 'amplify_front_scripts' );

/*Action for enqueue scripts for backend side.*/
add_action( 'enqueue_block_editor_assets', 'amplify_block_editor_assets' );

/*Enqueue Javascripts admin side.*/
add_action( 'admin_enqueue_scripts', 'amplify_admin_scripts' );

/*Action for add new block categorie.*/
add_filter( 'block_categories', 'nab_amplify_plugin_block_categories', 10, 2 );

/* Action to check if password matches confirm password */
add_action( 'woocommerce_registration_errors', 'nab_confirm_password_matches_checkout', 10, 3 );

add_action( 'wp_login', 'nab_sync_login', 5, 2 );

add_action( 'wp', 'nab_reg_message' );