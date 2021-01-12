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

// Customizer settings
add_action( 'customize_register', 'nab_customize_register' );

/*Action for enqueue scripts for backend side.*/
add_action( 'wp_enqueue_scripts', 'amplify_block_front_assets' );

add_shortcode( 'nab_display_author', 'nab_amplify_display_author' );

/*Enqueue Javascripts admin side.*/
add_action( 'admin_enqueue_scripts', 'amplify_admin_scripts' );

/*Redirecting templates.*/
add_action( 'template_redirect', 'nab_amplify_template_redirect' );

/*Action for add new block categorie.*/
add_filter( 'block_categories', 'nab_amplify_plugin_block_categories', 10, 2 );

/* Action to check if password matches confirm password */
add_action( 'woocommerce_registration_errors', 'nab_confirm_password_matches_checkout', 10, 3 );

// Ajax to upload user images.
add_action( "wp_ajax_nab_amplify_upload_images", "nab_amplify_upload_images" );
add_action( "wp_ajax_nopriv_nab_amplify_upload_images", "nab_amplify_upload_images" );

// Ajax to remove user images.
add_action( "wp_ajax_nab_amplify_remove_images", "nab_amplify_remove_images" );
add_action( "wp_ajax_nopriv_nab_amplify_remove_images", "nab_amplify_remove_images" );

// Ajax to show product edit popup.
add_action( "wp_ajax_nab_amplify_edit_product", "nab_amplify_edit_product" );
add_action( "wp_ajax_nopriv_nab_amplify_edit_product", "nab_amplify_edit_product" );

// My Purchases content.
add_action( 'woocommerce_account_my-purchases_endpoint', 'nab_amplify_my_purchases_content_callback' );

// My Connections content.
add_action( 'woocommerce_account_my-connections_endpoint', 'nab_amplify_my_connections_content_callback' );

// My Events endpoint.
add_action( 'woocommerce_account_my-events_endpoint', 'nab_amplify_my_events_content_callback' );

// My Bookmarks endpoint.
add_action( 'woocommerce_account_my-bookmarks_endpoint', 'nab_amplify_my_bookmarks_content_callback' );

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

// Action to add SVG support in file uploads.
add_action( 'upload_mimes', 'nab_amplify_add_file_types_to_uploads' );

// Removes password strength js
add_action( 'wp_print_scripts', 'nab_remove_password_strength', 10 );

// validates reset password form
add_action( 'validate_password_reset', 'nab_reset_password_validation', 10, 2 );

// Save first name and last name field
add_action( 'woocommerce_created_customer', 'nab_save_name_fields', 10, 1 );

add_action( 'woocommerce_payment_complete', 'nab_amplify_completed_order_after_payment_complete' );

add_action( 'woocommerce_thankyou', 'nab_amplify_completed_zero_order' );

add_action( 'woocommerce_checkout_process', 'nab_attendee_field_process' );

add_action( 'woocommerce_checkout_update_order_meta', 'nab_save_event_fields', 10, 1 );

add_action( 'wp_head', 'nab_header_scripts' );

add_action( 'woocommerce_created_customer', 'nab_user_registration_sync', 10, 3 );

add_action( 'woocommerce_after_cart', 'nab_bulk_purchase_cart' );

add_action( 'init', 'nab_create_attendee_table' );

// Register custom rest route.
add_action( 'rest_api_init', 'amplify_register_api_endpoints' );

add_action( 'wp_authenticate', 'nab_create_jwt_token', 10, 2 );

// Apply coupon code from the url
add_action( 'wp_loaded', 'amplify_apply_coupon_code_from_url', PHP_INT_MAX );

// Add coupon code when a product is added to cart once
add_action( 'woocommerce_add_to_cart', 'amplify_add_coupon_code_to_cart', PHP_INT_MAX );

/* Parent-Child add to cart actions start */
add_action( 'woocommerce_remove_cart_item', 'nab_remove_cocart_item', 10, 2 );

add_action( 'woocommerce_load_cart_from_session', 'nab_load_cart_action_cookie', 10 );

add_action( 'wp_logout', 'nab_maybe_clear_cart_cookie' );
/* Parent-Child add to cart actions end */

add_action( 'add_meta_boxes', 'nab_add_custom_metabox_in_product' );

add_action( 'manage_shop_order_posts_custom_column', 'nab_customer_column_data', 10, 2 );

add_action( 'manage_users_columns', 'nab_add_user_company_column' );

add_action( 'manage_users_custom_column', 'nab_user_company_column_data', 10, 3);

add_action( 'restrict_manage_users', 'nab_add_additional_filter_for_user_list' );

add_action( 'pre_user_query', 'nab_modify_user_search_query' );

add_action( 'admin_enqueue_scripts', 'nab_add_inline_style_for_acf_upload_popup', 999 );

add_action( 'init', 'nab_register_event_shows_post_type' );

add_action( 'wp_login', 'nab_set_user_login_cookie_for_other_site', 10, 2);

add_action( 'wp_logout', 'nab_clear_share_login_cookie' );

add_action( 'woocommerce_order_status_changed', 'nab_update_product_in_user_meta', 10, 3 );

add_action( 'woocommerce_edit_account_form', 'nab_edit_acount_additional_form_fields' );

add_action( 'woocommerce_save_account_details', 'nab_save_edit_account_additional_form_fields' );

// add woocommerce edit account details in the edit my account.
add_action( 'woocommerce_account_edit-account_endpoint', 'woocommerce_account_edit_address' );

add_action( 'woocommerce_customer_save_address', 'nab_woocommerce_customer_save_changes_redirect', 99 );

add_action( 'woocommerce_save_account_details', 'nab_woocommerce_customer_save_changes_redirect', 999 );

add_action( 'admin_menu', 'nab_amplify_search_settings' );

add_action( 'init', 'nab_register_company_post_type' );

add_action( 'init', 'nab_register_landing_page_post_type' );
add_action( 'admin_init', 'nab_set_preloaded_block_in_new_landing_page' );

add_action( 'acf/save_post', 'nab_remove_company_user_meta', 5);
add_action( 'acf/save_post', 'nab_update_compnay_user', 20, 1 );

add_action( 'init', 'nab_register_article_post_type' );

add_action( 'init', 'nab_register_article_content_taxonomy' );

// Action for allowed Administrator, editor, author and contributor user to enter unfiltered html.
add_filter( 'map_meta_cap', 'nab_add_unfiltered_html_capability_to_users', 1, 3 );

/* Add products into nab-product content type
 */

add_action( 'wp_ajax_nab_add_product', 'nab_add_product' );
add_action( 'wp_ajax_nopriv_nab_add_product', 'nab_add_product' );
add_action( 'init', 'nab_register_amplify_dynamic_blocks' );
add_action( 'init', 'nab_register_company_category_taxonomy' );
add_action( 'init', 'nab_register_company_tags_taxonomy' );

// Shortcode for display article tags base on custom article fields
add_shortcode( 'article_tags', 'nab_article_tags_shortcode_callback' );

// Action to add default blocks on new article
add_action( 'admin_init', 'nab_set_default_block_in_new_article' );
add_action( 'init', 'nab_register_company_product_taxonomy' );

add_action( 'wp_ajax_nab_edit_company_social_profiles', 'nab_edit_company_social_profiles_callback' );
add_action( 'wp_ajax_nopriv_nab_edit_company_social_profiles', 'nab_edit_company_social_profiles_callback' );

add_action( 'wp_ajax_nab_update_company_profile', 'nab_update_company_profile_callback' );
add_action( 'wp_ajax_nopriv_nab_update_company_profile', 'nab_update_company_profile_callback' );

add_action( 'wp_ajax_nab_edit_company_about', 'nab_edit_company_about_callback' );
add_action( 'wp_ajax_nopriv_nab_edit_company_about', 'nab_edit_company_about_callback' );

// Action to add default blocks on new company
add_action( 'admin_init', 'nab_set_default_block_in_new_company' );
add_shortcode( 'nab_comment_form','nab_comment_form');

// Action for export users csv file
add_action( 'admin_menu', 'nab_add_export_user_menu' );
add_action( 'admin_init', 'nab_generate_users_export_csv_file' );