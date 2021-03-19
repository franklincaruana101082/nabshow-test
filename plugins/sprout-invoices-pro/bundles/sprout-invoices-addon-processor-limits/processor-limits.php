<?php
/*
Plugin Name: Sprout Invoices Add-on - Processor Limits by Payment Amount
Plugin URI: https://sproutinvoices.com/marketplace/
Description: Provides a way to limit processors based on the payment total.
Author: Sprout Invoices
ID: 0
Version: 1
Author URI: https://sproutinvoices.com
*/

/**
 * Plugin Info for updates
 */
define( 'SA_ADDON_PROCESSOR_LIMITS_VERSION', '1' );
define( 'SA_ADDON_PROCESSOR_LIMITS_DOWNLOAD_ID', 0 );
define( 'SA_ADDON_PROCESSOR_LIMITS_NAME', 'Sprout Invoices Processor Limits' );
define( 'SA_ADDON_PROCESSOR_LIMITS_FILE', __FILE__ );
define( 'SA_ADDON_PROCESSOR_LIMITS_PATH', dirname( __FILE__ ) );
define( 'SA_ADDON_PROCESSOR_LIMITS_URL', plugins_url( '', __FILE__ ) );
if ( ! defined( 'SI_DEV' ) ) {
	define( 'SI_DEV', false );
}

if ( ! function_exists( 'sa_load_processor_limits_addon' ) ) {

	// Load up after SI is loaded.
	add_action( 'sprout_invoices_loaded', 'sa_load_processor_limits_addon' );
	function sa_load_processor_limits_addon() {
		if ( class_exists( 'SI_Processor_Limits' ) ) {
			return;
		}

		require_once( 'inc/Processor_Limits.php' );

		SI_Processor_Limits::init();
	}
}
