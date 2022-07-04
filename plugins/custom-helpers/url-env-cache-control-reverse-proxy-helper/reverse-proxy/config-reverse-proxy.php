<?php

if (! defined('ABSPATH')) {
    exit;
    // Exit if accessed directly.
}
// phpcs:disable WordPress.Security.ValidatedSanitizedInput.InputNotSanitized — Validated in the function call.
$IP = !empty($_SERVER['HTTP_CF_CONNECTING_IP']) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : $_SERVER['REMOTE_ADDR'];

if (isset($_SERVER['HTTP_CLIENT_IP'])) {
    $IP = $_SERVER['HTTP_CLIENT_IP'];
} else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
}

$httpxforwardedfor = $IP;
if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $httpxforwardedfor = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
else if (!empty(getenv('HTTP_X_FORWARDED_FOR'))) { $httpxforwardedfor = getenv('HTTP_X_FORWARDED_FOR');
}

$httpxvipproxyverification = null;
if (!empty(defined('HTTP_X_VIP_PROXY_VERIFICATION'))) {
    $httpxvipproxyverification = HTTP_X_VIP_PROXY_VERIFICATION;
}

if ((isset($_SERVER['HTTP_X_FORWARDED_HOST'])) 
    || (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) 
) {
    $_SERVER['HTTPS'] = 'on';
}

// ProxyPass Settings
// overrides the variables below to ensure that any
// request to /2022/* subdirectory is taken care of properly

// $_SERVER['REQUEST_URI'] = '/2022' . $_SERVER['REQUEST_URI'];
// $_SERVER['SCRIPT_NAME'] = '/2022' . $_SERVER['SCRIPT_NAME'];
// $_SERVER['PHP_SELF'] = '/2022' . $_SERVER['PHP_SELF'];

$proxy_lib = ABSPATH . ‘/wp-content/mu-plugins/lib/proxy/ip-forward.php’;

if (! empty($IP) && file_exists($proxy_lib) ) {

    include_once __DIR__ . ‘/remote-proxy-ips.php’;

    include_once $proxy_lib;

    Automattic\VIP\Proxy\fix_remote_address($IP, $httpxforwardedfor, PROXY_IP_ALLOW_LIST);

}
// phpcs:enable
