<?php

add_filter( 'get_avatar', 'filter_nab_amplify_user_avtar', 10, 5 );

add_filter( 'get_avatar_url', 'filter_nab_amplify_get_avatar_url', 10, 5 );

add_filter( 'query_vars', 'nab_amplify_custom_menu_query_vars', 0 );

add_filter( 'the_password_form', 'nab_apmlify_the_password_form', 10, 3 );

add_filter( 'woocommerce_account_menu_items', 'nab_amplify_update_my_account_menu_items', 10, 3 );

add_filter( 'woocommerce_get_availability', 'nab_amplify_woocommerce_get_availability', 10, 3 );

add_filter( 'woocommerce_product_stock_status_options', 'nab_amplify_woocommerce_product_stock_status_options', 10, 3 );

add_filter( 'woocommerce_checkout_fields', 'nab_amplify_woocommerce_checkout_fields', 10, 3 );

add_filter( 'woocommerce_inventory_settings', 'nab_amplify_woocommerce_inventory_settings', 10, 3 );

add_filter( 'woocommerce_admin_reports', 'nab_amplify_woocommerce_admin_reports', 10, 3 );

add_filter( 'woocommerce_admin_stock_html', 'nab_amplify_woocommerce_admin_stock_html', 10, 3 );

add_filter( 'woocommerce_product_query_tax_query', 'filter_nab_amplify_hide_shop_categories' );

add_filter( 'woocommerce_coupon_message', 'filter_nab_amplify_woocommerce_coupon_to_promo', 10, 3 );

add_filter( 'woocommerce_coupon_error', 'filter_nab_amplify_woocommerce_coupon_to_promo', 10, 3 );

add_filter( 'woocommerce_cart_totals_coupon_label', 'nab_amplify_woocommerce_cart_totals_coupon_label', 10, 3 );

add_filter( 'woocommerce_cart_totals_coupon_html', 'filter_nab_amplify_woocommerce_cart_totals_coupon_html', 10, 3 );

add_filter( 'woocommerce_registration_redirect', 'nab_registration_redirect' );

add_filter( 'woocommerce_get_privacy_policy_text', 'nab_remove_privacy_policy_text', 99, 2 );

add_filter( 'woocommerce_default_address_fields', 'nab_customising_checkout_fields', 9999, 1 );

add_filter( 'woocommerce_billing_fields', 'nab_custom_billing_fields', 9999, 1 );

add_filter( 'woocommerce_my_account_my_orders_query', 'nab_my_account_orders_query_change_sorting' );

add_filter( 'woocommerce_account_orders_columns', 'nab_my_orders_columns', 10, 1 );

add_filter( 'woocommerce_before_checkout_form', 'nab_add_login_link_on_checkout_page', 999 );

add_filter( 'woocommerce_add_to_cart_fragments', 'nab_cart_count_fragments', 10, 1 );

add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );

add_filter( 'ae_pppf_comment1_parameter', 'nab_pppf_custom_parameter', 10, 2 );

add_filter( 'ae_pppf_comment2_parameter', 'nab_pppf_comment2_parameter', 10, 2 );

add_filter( 'woocommerce_email_classes', 'nab_registration_receipt_mail' );

add_filter( 'woocommerce_get_cart_item_from_session', 'nab_bulk_order', 11, 3 );

add_filter( 'woocommerce_email_enabled_customer_completed_order', 'nab_stop_bulk_order_email', 999, 2 );

add_filter( 'woocommerce_email_enabled_new_order', 'nab_stop_bulk_order_email', 999, 2 );

add_filter( 'woocommerce_add_to_cart_validation', 'nab_amplify_woocommerce_add_to_cart_validation', 10, 3);

add_filter( 'bp_template_include', 'nab_amplify_filter_bp_template_include', 10, 3 );

add_filter( 'two_factor_user_api_login_enable', 'nab_2fa_rest_api_enable', 10, 2 );

add_filter( 'jwt_auth_token_before_dispatch', 'nab_jwt_response', 10, 2 );

add_filter( 'woocommerce_cart_contents_changed', 'nab_force_bulk_quanity' );

add_filter( 'woocommerce_get_endpoint_url', 'nab_amplify_woocommerce_get_endpoint_url', 10, 4 );

add_filter( 'the_title', 'nab_title_order_received', 10, 2 );

add_filter( 'jwt_auth_expire', 'nab_token_expiry_time', 10, 2 );

add_filter( 'woocommerce_email_recipient_nab_registration_receipt' , 'nab_add_addition_email_recepient', 10, 2);

add_filter( 'manage_shop_order_posts_columns', 'nab_add_customer_name_column', 11 );

add_filter( 'posts_orderby', 'nab_change_query_order_by', 10, 2 );

add_filter( 'bp_get_add_friend_button', 'nab_bp_change_add_friend_button_text' );

add_filter( 'bp_user_query_uid_clauses', 'nab_modify_member_query', 10, 2 );

add_filter( 'bp_friends_single_friendship_request_notification', 'nab_change_bp_friend_request_notification_link' );
add_filter( 'bp_friends_multiple_friendship_request_notification', 'nab_change_bp_friend_request_notification_link' );

add_filter( 'bp_friends_single_friendship_accepted_notification', 'nab_change_bp_accepted_friend_request_notification_link' );
add_filter( 'bp_friends_multiple_friendship_accepted_notification', 'nab_change_bp_accepted_friend_request_notification_link' );

add_filter( 'woocommerce_account_menu_items', 'nab_remove_edit_address_from_my_account', 999 );

add_filter( 'single_product_archive_thumbnail_size', 'nab_single_product_archive_thumbnail_size', 10, 3 );

add_filter( 'woocommerce_my_account_get_addresses', 'nab_remove_shipping_address', 10, 1 );

add_filter( 'woocommerce_single_product_image_thumbnail_html', 'nab_add_bookmark_icon_in_product', 10, 2 );

// Modify the socail shared og image.
add_filter( 'wpseo_opengraph_image', 'nab_amplify_update_og_image' );
add_filter( 'wpseo_twitter_image', 'nab_amplify_update_og_image' );

// Mofified search query to search in the meta
add_filter( 'posts_search', 'nab_modified_search_query_to_include_meta_search', 10, 2 );
add_filter( 'posts_clauses', 'nab_moified_join_groupby_for_meta_search', 10, 2 );
add_filter( 'tiny_mce_before_init', 'nabamplify_tiny_mce_before_init' );

add_filter( 'bp_get_message_thread_excerpt', 'nab_filter_message_to_avoid_html_entity' );
//add_filter('the_content', 'nab_reorder_comment_form', 1);

add_filter( 'wp_count_comments', 'nab_update_wp_admin_comments_count', 999, 2 );
add_filter( 'bp_email_validate', 'nab_stop_bp_email_notification', 10, 2 );

function nab_stop_bp_email_notification( $retval, $class_ref) {
    return new WP_Error( 'missing_parameter', __CLASS__, $class_ref );
}

add_filter( 'pre_get_posts', 'nab_increase_session_archive_post_limit' );