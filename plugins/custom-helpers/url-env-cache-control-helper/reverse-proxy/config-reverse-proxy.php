<?php


if ( (!empty( $_SERVER['HTTP_X_FORWARDED_HOST'])) ||
     (!empty( $_SERVER['HTTP_X_FORWARDED_FOR'])) ) {
    $_SERVER['HTTPS'] = 'on';
}

# ProxyPass Settings
# overrides the variables below to ensure that any
# request to /2022/* subdirectory is taken care of properly
$_SERVER['REQUEST_URI'] = '/2022' . $_SERVER['REQUEST_URI'];
$_SERVER['SCRIPT_NAME'] = '/2022' . $_SERVER['SCRIPT_NAME'];
$_SERVER['PHP_SELF'] = '/2022' . $_SERVER['PHP_SELF'];


// A constant defining an array of allowed IP addresses and/or CIDRs

// which equate to the possible IP addresses of your Remote Proxy

define( ‘MY_PROXY_IP_ALLOW_LIST’, [

    // ‘1.2.3.4/20’,

    // ‘5.6.7.8/20’,

    // ‘2.3.4.5’,
    "192.168.1.7"

] );

$proxy_lib = ABSPATH . ‘/wp-content/mu-plugins/lib/proxy/ip-forward.php’;

if ( ! empty( $_SERVER[‘HTTP_TRUE_CLIENT_IP’] )

    && ! empty( $_SERVER[‘HTTP_X_VIP_PROXY_VERIFICATION’] )

    && file_exists( $proxy_lib ) ) {

    require_once $proxy_lib;

// phpcs:disable WordPress.Security.ValidatedSanitizedInput.InputNotSanitized — Validated in the function call.

    Automattic\VIP\Proxy\fix_remote_address_with_verification_key(

        $_SERVER[‘HTTP_TRUE_CLIENT_IP’],

        $_SERVER[‘HTTP_X_VIP_PROXY_VERIFICATION’],
        ‘MY_PROXY_IP_ALLOW_LIST’

    );

// phpcs:enable

}