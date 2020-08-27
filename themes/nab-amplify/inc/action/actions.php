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

// Custom Meta Boxes
add_action( 'add_meta_boxes', 'amplify_custom_meta_boxes' );

// Save Product Video meta values
add_action( 'save_post', 'save_product_video_text' );

// Sync login with child sites
// add_action( 'wp_login', 'nab_sync_login', 5, 2 );

// Registration success message
add_action( 'wp', 'nab_reg_message' );

// Removes password strength js
add_action( 'wp_print_scripts', 'nab_remove_password_strength', 10 );

// validates reset password form
add_action( 'validate_password_reset', 'nab_reset_password_validation', 10, 2 );

// Save first name and last name field
add_action( 'woocommerce_created_customer', 'nab_save_name_fields', 10, 1 );
