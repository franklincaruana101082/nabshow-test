<?php

add_filter( 'woocommerce_registration_redirect', 'nab_registration_redirect' );

add_filter( 'woocommerce_get_privacy_policy_text', 'nab_remove_privacy_policy_text', 99, 2 );

add_filter( 'woocommerce_default_address_fields', 'nab_customising_checkout_fields', 1000, 1 );

add_filter('woocommerce_billing_fields', 'nab_custom_billing_fields', 9999, 1);