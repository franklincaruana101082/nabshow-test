<?php

add_filter( 'woocommerce_registration_redirect', 'nab_registration_redirect' );

add_filter( 'woocommerce_get_privacy_policy_text', 'nab_remove_privacy_policy_text', 99, 2 );

add_filter('two_factor_user_api_login_enable', 'nab_disable_2fa', 10, 2);