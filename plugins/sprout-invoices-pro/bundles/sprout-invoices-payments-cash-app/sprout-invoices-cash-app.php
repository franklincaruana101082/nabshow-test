<?php
/*
Plugin Name: Sprout Invoices Add-on - CashApp Payments
Plugin URI: 
Description: Accept CashApp Payments with Sprout Invoices.
Author: Sprout Invoices
Version: 2.0
Author URI: https://sproutinvoices.com
*/

/**
 * Plugin File
 */
define( 'SA_ADDON_CASHAPP_VERSION', '2.0' );
define( 'SA_ADDON_CASHAPP_DOWNLOAD_ID', 565307 );
define( 'SA_ADDON_CASHAPP_FILE', __FILE__ );
define( 'SA_ADDON_CASHAPP_PATH', dirname( __FILE__ ) );
define( 'SA_ADDON_CASHAPP_NAME', 'Sprout Invoices Cash App Payments' );
define( 'SA_ADDON_CASHAPP_URL', plugins_url( '', __FILE__ ) );


// Load up the processor before updates
add_action( 'si_estimate_submission', 'sa_load_cash_app' );
function sa_load_cash_app() {
	require_once( 'inc/SA_Cash_App.php' );
}

// Load up the updater after si is completely loaded
add_action( 'sprout_invoices_loaded', 'sa_load_cash_app_updates' );
function sa_load_cash_app_updates() {
	if ( class_exists( 'SI_Updates' ) ) {
		require_once( 'inc/sa-updates/SA_Updates.php' );
	}
}
