<?php
/*
Plugin Name: Sprout Invoices Add-on - Service Fee
Plugin URI: https://sproutinvoices.com/marketplace/service-fee/
Description: Allows for a service fee to be added based on the payment method selected at checkout.
Author: Sprout Invoices
ID: 228724
Version: 2.0.5
Author URI: https://sproutinvoices.com
*/

/**
 * Plugin Info for updates
 */
define( 'SA_ADDON_SERVICE_FEE_VERSION', '2.0.5' );
define( 'SA_ADDON_SERVICE_FEE_DOWNLOAD_ID', 228724 );
define( 'SA_ADDON_SERVICE_FEE_NAME', 'Sprout Invoices Service Fee' );
define( 'SA_ADDON_SERVICE_FEE_FILE', __FILE__ );
define( 'SA_ADDON_SERVICE_FEE_PATH', dirname( __FILE__ ) );
define( 'SA_ADDON_SERVICE_FEE_URL', plugins_url( '', __FILE__ ) );
if ( ! defined( 'SI_DEV' ) ) {
	define( 'SI_DEV', false );
}

if ( ! function_exists( 'sa_load_service_fee_addon' ) ) {

	// Load up after SI is loaded.
	add_action( 'sprout_invoices_loaded', 'sa_load_service_fee_addon' );
	function sa_load_service_fee_addon() {
		if ( class_exists( 'SI_Service_Fee' ) ) {
			return;
		}

		require_once( 'inc/Service_Fee.php' );
		require_once( 'inc/Service_Fee_Settings.php' );
		require_once( 'inc/Service_Fee_Checkout.php' );
		//require_once( 'inc/Service_Fee_Billings.php' );

		SI_Service_Fee::init();
		SI_Service_Fee_Settings::init();
		SI_Service_Fee_Checkout::init();
		//SI_Service_Fee_Billings::init();
	}
}
