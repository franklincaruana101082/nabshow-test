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

// Ajax to upload user images.
add_action("wp_ajax_nab_amplify_upload_images", "nab_amplify_upload_images");
add_action("wp_ajax_nopriv_nab_amplify_upload_images", "nab_amplify_upload_images");

// Ajax to remove user images.
add_action("wp_ajax_nab_amplify_remove_images", "nab_amplify_remove_images");
add_action("wp_ajax_nopriv_nab_amplify_remove_images", "nab_amplify_remove_images");

// Edit My Profile content.
add_action( 'woocommerce_account_edit-my-profile_endpoint', 'nab_amplify_edit_my_profile_content_callback' );

// My Purchases content.
add_action( 'woocommerce_account_my-purchases_endpoint', 'nab_amplify_my_purchases_content_callback' );

// Register edit my profile endpoint to use for My Account page.
add_action( 'init', 'nab_amplify_add_custom_endpoints' );

// Custom Meta Boxes
add_action( 'add_meta_boxes', 'amplify_custom_meta_boxes' );

// Save Product Video meta values
add_action( 'save_post', 'save_product_video_text' );

// Sync login with child sites
add_action( 'wp_login', 'nab_sync_login', 5, 2 );

// Registration success message
add_action( 'wp', 'nab_reg_message' );

// Removes password strength js
add_action( 'wp_print_scripts', 'nab_remove_password_strength', 10 );

// validates reset password form
add_action( 'validate_password_reset', 'nab_reset_password_validation', 10, 2 );

// Save first name and last name field
add_action( 'woocommerce_created_customer', 'nab_save_name_fields', 10, 1 );

add_action('woocommerce_checkout_process', 'nab_attendee_field_process');

add_action('woocommerce_checkout_update_order_meta', 'nab_save_event_fields', 10, 1);