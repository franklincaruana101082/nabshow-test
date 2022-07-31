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

// define(‘WP_CACHE’, true);
// define('WP_DEBUG', false);
// define( 'WPCOM_IS_VIP_ENV', true );

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

if (isset($_ENV['PANTHEON_ENVIRONMENT'])) {
	define('FS_METHOD', 'direct');
}

if ((is_mobile())&&(strrpos($_SERVER['REQUEST_URI'],'amp') == false)) {
	header('HTTP/1.0 301 Moved Permanently');
	header('Location: https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] .'/amp');

	// Name transaction "redirect" in New Relic for improved reporting (optional).
	if (extension_loaded('newrelic')) {
	  newrelic_name_transaction("redirect");
	}
	exit();
  }
  function is_mobile() {
	if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
			$is_mobile = false;
	}
	elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false // many mobile devices (all iPhone, iPad, etc.)
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
					$is_mobile = true;
	}
	else {
			$is_mobile = false;
	}
	return $is_mobile;
  }

/** Changes location where Autoptimize stores optimized files */
define('AUTOPTIMIZE_CACHE_CHILD_DIR','/uploads/autoptimize/');

$_SERVER['SERVER_NAME'] = $_SERVER['HTTP_HOST'];

if (isset($_ENV['PANTHEON_ENVIRONMENT'])) {
  if (isset($_SERVER['HTTP_USER_AGENT_HTTPS']) && $_SERVER['HTTP_USER_AGENT_HTTPS'] === 'ON') {
    $_SERVER['SERVER_PORT'] = 443;
  }
  else {
    $_SERVER['SERVER_PORT'] = 80;
  }
}

define('FILES_ACCESS_TOKEN','r0Bly5NsU8ZORs6/4dps/sHnu/11rrsPU2HWDPxe');
