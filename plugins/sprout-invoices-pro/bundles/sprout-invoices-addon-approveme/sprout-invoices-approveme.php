<?php
/*
Plugin Name: Sprout Invoices Add-on - Legally Binding Digital Signatures with WP E-Signature
Plugin URI: https://sproutinvoices.com/marketplace/time-tracking/
Description: Integrates ApproveMe with the Sprout Invoices
Author: Sprout Invoices
Version: 1.1
ID: 63999
Author URI: https://sproutinvoices.com
*/

/**
 * Plugin Info for updates
 */
define( 'SA_ADDON_APPROVEME_VERSION', '1.1' );
define( 'SA_ADDON_APPROVEME_DOWNLOAD_ID', 63999 );
define( 'SA_ADDON_APPROVEME_NAME', 'Sprout Invoices ApproveMe' );
define( 'SA_ADDON_APPROVEME_FILE', __FILE__ );
define( 'SA_ADDON_APPROVEME_PATH', dirname( __FILE__ ) );
define( 'SA_ADDON_APPROVEME_URL', plugins_url( '', __FILE__ ) );

if ( ! defined( 'SI_DEV' ) ) {
	define( 'SI_DEV', false );
}

if ( ! defined( 'SI_WPES_USE_COOKIES' ) ) {
	define( 'SI_WPES_USE_COOKIES', true );
}

if ( ! function_exists( 'sa_load_si_approveme_addon' ) ) {
	// Load up after SI is loaded.
	add_action( 'sprout_invoices_loaded', 'sa_load_si_approveme_addon' );
	function sa_load_si_approveme_addon() {
		if ( class_exists( 'ApproveMe_Controller' ) ) {
			return;
		}

		require_once( 'inc/Approveme_Controller.php' );
		require_once( 'inc/Approveme_Settings.php' );

		ApproveMe_Controller::init();
			// init sub classes
			ApproveMe_Settings::init();
	}

	if ( ! apply_filters( 'is_bundle_addon', false ) ) {
		if ( SI_DEV ) { error_log( 'not bundled: sa_load_si_approveme_updates' ); }
		// Load up the updater after si is completely loaded
		add_action( 'sprout_invoices_loaded', 'sa_load_si_approveme_updates' );
		function sa_load_si_approveme_updates() {
			if ( class_exists( 'SI_Updates' ) ) {
				require_once( 'inc/sa-updates/SA_Updates.php' );
				SA_ApproveMe_Updates::init();
			}
		}
	}
}
