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
// define( 'WP_DEBUG', false );

define( 'VIP_GO_APP_ENVIRONMENT', 'develop' );
define( 'WPCOM_IS_VIP_ENV', true );
// define( 'WP_TESTS_MULTISITE', 1 );
// define( 'WP_TESTS_DOMAIN', 'nabshow.vipdev.lndo.site' );
define( 'VIP_GO_ENV', 'develop' );


/**
 * Set a high default limit to avoid too many revisions from polluting the database.
 *
 * Posts with extremely high revisions can result in fatal errors or have performance issues.
 *
 * Feel free to adjust this depending on your use cases.
 */
if ( ! defined( 'WP_POST_REVISIONS' ) ) {
	define( 'WP_POST_REVISIONS', 500 );
}

/**
 * The VIP_JETPACK_IS_PRIVATE constant is enabled by default in non-production environments.
 *
 * It disables programmatic access to content via the WordPress.com REST API and Jetpack Search;
 * subscriptions via the WordPress.com Reader; and syndication via the WordPress.com Firehose.
 *
 * You can disable "private" mode (e.g. for testing) in non-production environment by setting the constant to `true` below (or just by removing the lines).
 *
 * @see https://docs.wpvip.com/technical-references/restricting-site-access/controlling-content-distribution-via-jetpack/
 */
if ( ! defined( 'VIP_JETPACK_IS_PRIVATE' ) &&
	defined( 'VIP_GO_APP_ENVIRONMENT' ) &&
	'production' !== VIP_GO_APP_ENVIRONMENT ) {
	define( 'VIP_JETPACK_IS_PRIVATE', true );
}

/**
 * Disable New Relic Browser instrumentation.
 *
 * By default, the New Relic extension automatically enables Browser instrumentation.
 *
 * This injects some New Relic specific javascript onto all pages on the VIP Platform.
 *
 * This isn't always desireable (e.g. impacts performance) so let's turn it off.
 *
 * If you would like to enable Browser instrumentation, please remove the lines below.
 *
 * @see https://docs.newrelic.com/docs/agents/php-agent/features/browser-monitoring-php-agent/#disable
 * @see https://docs.wpvip.com/technical-references/tools-for-site-management/new-relic/
 */
if ( function_exists( 'newrelic_disable_autorum' ) ) {
	newrelic_disable_autorum();
}


define('JWT_AUTH_SECRET_KEY', '4PP5|I$OOktX8Kfs)`&}!>A;OI+.:<3|/VJ;[OpA%p![K-94mvCT>v.vVa*-GHiR');

