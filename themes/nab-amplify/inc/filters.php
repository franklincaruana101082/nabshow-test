<?php

add_filter( 'woocommerce_registration_redirect', 'nab_registration_redirect' );

add_filter( 'woocommerce_get_privacy_policy_text', 'nab_remove_privacy_policy_text', 99, 2 );

add_filter( 'woocommerce_default_address_fields', 'nab_customising_checkout_fields', 1000, 1 );

add_filter( 'woocommerce_billing_fields', 'nab_custom_billing_fields', 9999, 1 );

add_filter( 'woocommerce_my_account_my_orders_query', 'nab_my_account_orders_query_change_sorting' );

add_filter( 'woocommerce_account_orders_columns', 'nab_my_orders_columns', 10, 1 );

add_filter( 'woocommerce_before_checkout_form', 'nab_add_login_link_on_checkout_page', 999 );