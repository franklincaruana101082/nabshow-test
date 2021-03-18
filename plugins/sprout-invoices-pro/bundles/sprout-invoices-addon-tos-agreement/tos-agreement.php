<?php
/*
Plugin Name: Sprout Invoices Add-on - TOS Agreement
Plugin URI: https://sproutinvoices.com/marketplace/
Description: Prevent client credit card payment unless customizable terms are agreed (with a simple check box).
ID: 0
Version: 1
Author URI: https://sproutinvoices.com
*/

/**
 * Plugin Info for updates
 */
define( 'SA_ADDON_TOS_AGREEMENT_VERSION', '1' );
define( 'SA_ADDON_TOS_AGREEMENT_DOWNLOAD_ID', 0 );
define( 'SA_ADDON_TOS_AGREEMENT_NAME', 'Sprout Invoices TOS Agreement' );
define( 'SA_ADDON_TOS_AGREEMENT_FILE', __FILE__ );
define( 'SA_ADDON_TOS_AGREEMENT_PATH', dirname( __FILE__ ) );
define( 'SA_ADDON_TOS_AGREEMENT_URL', plugins_url( '', __FILE__ ) );
if ( ! defined( 'SI_DEV' ) ) {
	define( 'SI_DEV', false );
}

if ( ! function_exists( 'sa_load_tos_agreement_addon' ) ) {

	// Load up after SI is loaded.
	add_action( 'sprout_invoices_loaded', 'sa_load_tos_agreement_addon' );
	function sa_load_tos_agreement_addon() {

		require_once( 'inc/TOS_Checkbox.php' );

		SI_TOS_Checkbox::init();
	}
}
