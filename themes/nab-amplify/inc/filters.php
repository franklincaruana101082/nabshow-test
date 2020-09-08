<?php

add_filter( 'get_avatar', 'filter_nab_amplify_user_avtar', 10, 5 );

add_filter( 'get_avatar_url', 'filter_nab_amplify_get_avatar_url', 10, 5 );

add_filter( 'query_vars', 'nab_amplify_custom_menu_query_vars', 0 );

add_filter( 'the_password_form', 'nab_apmlify_the_password_form', 10, 3 );

add_filter( 'woocommerce_account_menu_items', 'nab_amplify_update_my_account_menu_items', 10, 3 );

add_filter( 'woocommerce_get_availability', 'nab_amplify_woocommerce_get_availability', 10, 3 );

add_filter( 'woocommerce_product_stock_status_options', 'nab_amplify_woocommerce_product_stock_status_options', 10, 3 );

add_filter( 'woocommerce_checkout_fields' , 'nab_amplify_woocommerce_checkout_fields', 10, 3 );

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