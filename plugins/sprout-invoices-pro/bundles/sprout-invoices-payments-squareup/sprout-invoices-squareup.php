<?php
/*
Plugin Name: Sprout Invoices Add-on - Square Payments
Plugin URI: https://sproutinvoices.com/marketplace/square-payments/
Description: Accept Square Payments with Sprout Invoices.
Author: Sprout Invoices
Version: 1.0.1
Author URI: https://sproutinvoices.com
*/

/**
 * Plugin File
 */
define( 'SA_ADDON_SQUARE_VERSION', '1.0.1' );
define( 'SA_ADDON_SQUARE_DOWNLOAD_ID', 676199 );
define( 'SA_ADDON_SQUARE_FILE', __FILE__ );
define( 'SA_ADDON_SQUARE_NAME', 'Sprout Invoices Square Payments' );

if ( ! defined( 'SA_ADDON_SQUARE_URL' ) ) {
	define( 'SA_ADDON_SQUARE_URL', plugins_url( '', __FILE__ ) );
}

// Load up the processor before updates
add_action( 'si_payment_processors_loaded', 'sa_load_square' );
function sa_load_square() {
	require_once 'inc/Square_Up.php';
}

// Load up the updater after si is completely loaded
add_action( 'sprout_invoices_loaded', 'sa_load_square_updates' );
function sa_load_square_updates() {
	if ( class_exists( 'SI_Updates' ) ) {
		require_once 'inc/sa-updates/SA_Updates.php';
	}
}
