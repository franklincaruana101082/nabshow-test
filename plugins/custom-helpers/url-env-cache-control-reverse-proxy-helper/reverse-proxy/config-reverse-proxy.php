<?php

// phpcs:disable WordPress.Security.ValidatedSanitizedInput.InputNotSanitized — Validated in the function call.

$IP = !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1';

if (isset($_SERVER['HTTP_CLIENT_IP'])) {
    $IP = $_SERVER['HTTP_CLIENT_IP'];
} else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
}

$httpxforwardedfor = $IP;
if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $httpxforwardedfor = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
else if (!empty(getenv('HTTP_X_FORWARDED_FOR'))) $httpxforwardedfor = getenv('HTTP_X_FORWARDED_FOR');

$httpxvipproxyverification = null;
if (!empty(defined('HTTP_X_VIP_PROXY_VERIFICATION'))){
    $httpxvipproxyverification = HTTP_X_VIP_PROXY_VERIFICATION;
}

if ( (isset( $_SERVER['HTTP_X_FORWARDED_HOST'])) ||
     (isset( $_SERVER['HTTP_X_FORWARDED_FOR'])) ) {
    $_SERVER['HTTPS'] = 'on';
}

# ProxyPass Settings
# overrides the variables below to ensure that any
# request to /2022/* subdirectory is taken care of properly

// $_SERVER['REQUEST_URI'] = '/2022' . $_SERVER['REQUEST_URI'];
// $_SERVER['SCRIPT_NAME'] = '/2022' . $_SERVER['SCRIPT_NAME'];
// $_SERVER['PHP_SELF'] = '/2022' . $_SERVER['PHP_SELF'];

$proxy_lib = WPMU_PLUGIN_DIR . ‘/lib/proxy/ip-forward.php’;
if ( ! empty( $IP ) && file_exists( $proxy_lib ) ) {

    require_once( __DIR__ . ‘/remote-proxy-ips.php’ );

    require_once( $proxy_lib  );

    $res = Automattic\VIP\Proxy\fix_remote_address( $IP, $httpxforwardedfor, PROXY_IP_ALLOW_LIST );
    
    error_log(json_encode($rec));

}


// phpcs:enable
