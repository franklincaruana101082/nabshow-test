<?php
/*
Plugin Name: Sprout Invoices Add-on - zelle Cash Payments
Plugin URI: https://sproutinvoices.com/marketplace/zelle
Description: Accept zelle Cash Payments with Sprout Invoices.
Author: Sprout Invoices
Version: 1.0.1
Author URI: https://sproutinvoices.com
*/

/**
 * Plugin File
 */
define( 'SA_ADDON_ZELLE_VERSION', '1.0.1' );
define( 'SA_ADDON_ZELLE_DOWNLOAD_ID', 565307 );
define( 'SA_ADDON_ZELLE_FILE', __FILE__ );
define( 'SA_ADDON_ZELLE_PATH', dirname( __FILE__ ) );
define( 'SA_ADDON_ZELLE_NAME', 'Sprout Invoices Zelle Payments' );
define( 'SA_ADDON_ZELLE_URL', plugins_url( '', __FILE__ ) );


// Load up the processor before updates
add_action( 'si_estimate_submission', 'sa_load_zelle' );
function sa_load_zelle() {
	require_once( 'inc/SA_Zelle.php' );
}

// Load up the updater after si is completely loaded
add_action( 'sprout_invoices_loaded', 'sa_load_zelle_updates' );
function sa_load_zelle_updates() {
	if ( class_exists( 'SI_Updates' ) ) {
		require_once( 'inc/sa-updates/SA_Updates.php' );
	}
}
