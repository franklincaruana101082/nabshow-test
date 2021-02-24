<?php
/*
Plugin Name: Sprout Invoices Add-on - Beanstream Payments
Plugin URI: https://sproutinvoices.com/marketplace/beanstream-payments/
Description: Accept Beanstream Payments with Sprout Invoices.
Author: Sprout Invoices
Version: 1.0.2
Author URI: https://sproutinvoices.com
*/

/**
 * Plugin File
 */
define( 'SA_ADDON_BEANSTREAM_VERSION', '1.0.2' );
define( 'SA_ADDON_BEANSTREAM_DOWNLOAD_ID', 6135 );
define( 'SA_ADDON_BEANSTREAM_FILE', __FILE__ );
define( 'SA_ADDON_BEANSTREAM_NAME', 'Sprout Invoices Beanstream Payments' );
define( 'SA_ADDON_BEANSTREAM_URL', plugins_url( '', __FILE__ ) );


// Load up the processor before updates
add_action( 'si_payment_processors_loaded', 'sa_load_beanstream' );
function sa_load_beanstream() {
	require_once( 'inc/SA_Beanstream.php' );
}

// Load up the updater after si is completely loaded
add_action( 'sprout_invoices_loaded', 'sa_load_beanstream_updates' );
function sa_load_beanstream_updates() {
	if ( class_exists( 'SI_Updates' ) ) {
		require_once( 'inc/sa-updates/SA_Updates.php' );
	}
}
