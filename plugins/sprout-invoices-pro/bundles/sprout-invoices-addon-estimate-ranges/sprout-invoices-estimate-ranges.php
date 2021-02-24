<?php
/*
Plugin Name: Sprout Invoices Add-on - Estimate Ranges
Plugin URI: https://sproutinvoices.com/
Description: Allows for estimates to show a price/cost range.
Author: Sprout Invoices
Version: 1
ID: 800029
Author URI: https://sproutinvoices.com
Auto Active: true
*/

/**
 * Plugin Info for updates
 */
define( 'SA_ADDON_ESTIMATE_RANGES_VERSION', '1.0' );
define( 'SA_ADDON_ESTIMATE_RANGES_DOWNLOAD_ID', 800029 );
define( 'SA_ADDON_ESTIMATE_RANGES_NAME', 'Sprout Invoices Estimate Ranges' );
define( 'SA_ADDON_ESTIMATE_RANGES_FILE', __FILE__ );
define( 'SA_ADDON_ESTIMATE_RANGES_PATH', dirname( __FILE__ ) );
define( 'SA_ADDON_ESTIMATE_RANGES_URL', plugins_url( '', __FILE__ ) );

// Load up after SI is loaded.
add_action( 'sprout_invoices_loaded', 'sa_load_estimate_ranges_addon' );
function sa_load_estimate_ranges_addon() {
	if ( class_exists( 'Estimate_Ranges' ) ) {
		return;
	}

	require_once( 'inc/Estimate_Ranges.php' );

	SI_Estimate_Ranges::init();
}
