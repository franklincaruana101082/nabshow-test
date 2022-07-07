<?php


if (! defined('ABSPATH')) {
    exit;
    // Exit if accessed directly.
}

$IP = null;
// phpcs:disable WordPress.Security.ValidatedSanitizedInput.InputNotSanitized — Validated in the function call.
if(!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $IP = $_SERVER['HTTP_CF_CONNECTING_IP'];
} else if(!empty($_SERVER['REMOTE_ADDR'])) {
    $IP = $_SERVER['REMOTE_ADDR'];
} else if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $IP = $_SERVER['HTTP_CLIENT_IP'];
} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
}

$httpxforwardedfor = $IP;
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $httpxforwardedfor = $_SERVER['HTTP_X_FORWARDED_FOR'];
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
// phpcs:enable
