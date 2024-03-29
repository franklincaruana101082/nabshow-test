<?php

/**
 * @package Sprout_Invoices
 * @version 19.9.3.5
 */

/*
 * Plugin Name: Sprout Invoices Pro
 * Plugin URI: https://sproutinvoices.com
 * Description: Thanks for supporting the future of Sprout Invoices! You already know what this plugin does but...this plugin allows for any WordPress site to accept estimates, create invoices and receive invoice payments. Learn more at <a href="https://sproutinvoices.com">sproutinvoices.com</a>.
 * Author: Sprout Invoices
 * Version: 19.9.3.5
 * Author URI: https://sproutinvoices.com
 * Text Domain: sprout-invoices
 * Domain Path: languages
*/


/**
 * SI directory
 */
define( 'SI_PATH', WP_PLUGIN_DIR . '/' . basename( dirname( __FILE__ ) ) );
/**
 * Plugin File
 */
define( 'SI_PLUGIN_FILE', __FILE__ );

/**
 * SI URL
 */
define( 'SI_URL', plugins_url( '', __FILE__ ) );
/**
 * URL to resources directory
 */
define( 'SI_RESOURCES', plugins_url( 'resources/', __FILE__ ) );

/**
 * Minimum supported version of WordPress
 */
define( 'SI_SUPPORTED_WP_VERSION', version_compare( get_bloginfo( 'version' ), '3.7', '>=' ) );
/**
 * Minimum supported version of PHP
 */
define( 'SI_SUPPORTED_PHP_VERSION', version_compare( phpversion(), '5.2.4', '>=' ) );

/**
 * Flag for Free and Pro
 */
define( 'SI_PRO', true );

/**
 * Load plugin
 */
require_once SI_PATH . '/load.php';

/**
 * Compatibility check
 */
if ( ! SI_SUPPORTED_WP_VERSION || ! SI_SUPPORTED_PHP_VERSION ) {
	/**
	 * Disable SI and add fail notices if compatibility check fails
	 * @return string inserted within the WP dashboard
	 */
	si_pro_deactivate_plugin();
	add_action( 'admin_head', 'si_pro_compatibility_check_fail_notices' );
	return;
}

/**
 * Load it up!
 */
add_action( 'plugins_loaded', 'sprout_invoices_load', 100 );
add_action( 'setup_theme', 'sprout_invoices_delayed_load', 100 );

/**
 * do_action when plugin is activated.
 * @package Sprout_Invoices
 * @ignore
 */
register_activation_hook( __FILE__, 'si_pro_plugin_activated' );
function si_pro_plugin_activated() {
	sprout_invoices_load(); // load before hook
	do_action( 'si_plugin_activation_hook' );
}
/**
 * do_action when plugin is deactivated.
 * @package Sprout_Invoices
 * @ignore
 */
register_deactivation_hook( __FILE__, 'si_pro_plugin_deactivated' );
function si_pro_plugin_deactivated() {
	sprout_invoices_load(); // load before hook
	do_action( 'si_plugin_deactivation_hook' );
}

/**
 * Deactivate plugin
 */
function si_pro_deactivate_plugin() {
	if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
		// Fire hooks
		do_action( 'si_plugin_deactivation_hook' );
		require_once ABSPATH.'/wp-admin/includes/plugin.php';
		deactivate_plugins( __FILE__ );
	}
}

/**
 * Error messaging for compatibility check.
 * @return string error messages
 */
function si_pro_compatibility_check_fail_notices() {
	if ( ! SI_SUPPORTED_WP_VERSION ) {
		printf( '<div class="error"><p><strong>Sprout Invoices</strong> requires WordPress %s or higher. Please upgrade WordPress and activate the Sprout Invoices Plugin again.</p></div>', SI_SUPPORTED_WP_VERSION );
	}
	if ( ! SI_SUPPORTED_PHP_VERSION ) {
		printf( '<div class="error"><p><strong>Sprout Invoices</strong> requires PHP version %s or higher to be installed on your server. Talk to your web host about using a secure version of PHP.</p></div>', SI_SUPPORTED_PHP_VERSION );
	}
}
