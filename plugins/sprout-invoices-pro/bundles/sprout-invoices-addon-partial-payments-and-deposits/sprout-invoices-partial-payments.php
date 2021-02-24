<?php
/*
Plugin Name: Sprout Invoices Add-on - Partial Payments & Deposits
Plugin URI: https://sproutinvoices.com/marketplace/invoice-deposits-client-set-amount/
Description: Allows the client to select the payment amount, and pay deposits.
Author: Sprout Invoices
Version: 2.0
ID: 41265
Author URI: https://sproutinvoices.com
Auto Active: true
*/

/**
 * Plugin Info for updates
 */
define( 'SA_ADDON_PARTIAL_PAYMENTS_VERSION', '2.0' );
define( 'SA_ADDON_PARTIAL_PAYMENTS_DOWNLOAD_ID', 41265 );
define( 'SA_ADDON_PARTIAL_PAYMENTS_NAME', 'Sprout Invoices Partial Payments' );
define( 'SA_ADDON_PARTIAL_PAYMENTS_FILE', __FILE__ );
define( 'SA_ADDON_PARTIAL_PAYMENTS_PATH', dirname( __FILE__ ) );
define( 'SA_ADDON_PARTIAL_PAYMENTS_URL', plugins_url( '', __FILE__ ) );

if ( ! defined( 'SI_DEV' ) ) {
	define( 'SI_DEV', false );
}

if ( ! function_exists( 'sa_load_invoicing_partial_payments_addon' ) ) {

	// Load up after SI is loaded.
	add_action( 'sprout_invoices_loaded', 'sa_load_invoicing_partial_payments_addon' );
	function sa_load_invoicing_partial_payments_addon() {
		if ( class_exists( 'SI_Partial_Payments' ) ) {
			return;
		}

		require_once( 'inc/SI_Partial_Payments.php' );
		require_once( 'inc/SI_Partial_Payments_Admin.php' );
		require_once( 'inc/SI_Partial_Payments_Views.php' );
		SI_Partial_Payments::init();
		SI_Partial_Payments_Admin::init();
		SI_Partial_Payments_Views::init();
	}
}
