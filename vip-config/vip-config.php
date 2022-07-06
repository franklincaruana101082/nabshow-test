<?php
/**
 * Hi there, VIP dev!
 *
 * vip-config.php is where you put things you'd usually put in wp-config.php. Don't worry about database settings
 * and such, we've taken care of that for you. This is just for if you need to define an API key or something
 * of that nature.
 *
 * WARNING: This file is loaded very early (immediately after `wp-config.php`), which means that most WordPress APIs,
 *   classes, and functions are not available. The code below should be limited to pure PHP.
 *
 * @see https://vip.wordpress.com/documentation/vip-go/understanding-your-vip-go-codebase/
 *
 * Happy Coding!
 *
 * - The WordPress.com VIP Team
 **/

if ( isset( $_SERVER['HTTP_HOST'] ) ) {
    $http_host   = $_SERVER['HTTP_HOST'];
    $request_uri = $_SERVER['REQUEST_URI'];

    $redirect_domains = [
    'nabshow.com'   => [
        'nabshow-com.go-vip.net',
    ],
    'nabshowexpress.com'   => [
        'www.nabshowexpress.com',
        'express.nabshow.com',
        'nabshow.com/express',
    ],
    'amplify.nabshow.com'   => [
        'nabamplify.com',
        'www.nabamplify.com',
        'nabshowamplify.com',
        'www.nabshowamplify.com',
        'nabshow.com/amplify',
    ],
    'cineemerge.nabshow.com'   => [
        'cineemerge.com',
        'www.cineemerge.com',
    ],
    'radio.nabshow.com'   => [
        'radioshowweb.com',
        'www.radioshowweb.com',
    ],
    'smte.nabshow.com'   => [
        'nabsmte.com',
        'www.nabsmte.com',
    ],
];

    // Safety checks for redirection:
    // 1. Don't redirect for '/cache-healthcheck?' or monitoring will break
    // 2. Don't redirect in WP CLI context
    foreach ( $redirect_domains as $redirect_to => $redirect_from_domains ) {
        if (
                '/cache-healthcheck?' !== $request_uri && // safety
                ! ( defined( 'WP_CLI' ) && WP_CLI ) && // safety
                $redirect_to !== $http_host && in_array( $http_host, $redirect_from_domains, true )
            ) {
            header( 'Location: https://' . $redirect_to . $request_uri, true, 301 );
            exit;
        }
    }
}

define('JWT_AUTH_SECRET_KEY', 'jhBvSg>3AVZ;+?}OvbtL:|,v26`V+zG|#.aQXpm^}(w4feLQb?dLZF{o7-h5J)F/');
