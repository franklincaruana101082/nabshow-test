<?php
/*
Plugin Name: Sprout Invoices Add-on - Client Payment Processor Limits
Plugin URI: https://sproutinvoices.com/marketplace/
Description: Enable specific payment processors per client.
Author: Sprout Invoices
Version: 1.0.1
ID: 42
Author URI: https://sproutinvoices.com
*/

/**
 * Plugin Info for updates
 */
define( 'SA_ADDON_CLIENT_PP_OPTIONS_ID_VERSION', '1.0.1' );
define( 'SA_ADDON_CLIENT_PP_OPTIONS_ID_DOWNLOAD_ID', 1111 );
define( 'SA_ADDON_CLIENT_PP_OPTIONS_ID_FILE', __FILE__ );
define( 'SA_ADDON_CLIENT_PP_OPTIONS_ID_NAME', 'Sprout Invoices Client Payment Processor Limits' );
define( 'SA_ADDON_CLIENT_PP_OPTIONS_ID_URL', plugins_url( '', __FILE__ ) );

// Load up after SI is loaded.
add_action( 'sprout_invoices_loaded', 'sa_load_client_pp_options_addon' );
function sa_load_client_pp_options_addon() {
	// Controller
	require_once( 'inc/SI_Client_PP_Limits.php' );
	require_once( 'inc/SI_Client_PP_Meta.php' );
	// Updates
	if ( class_exists( 'SI_Updates' ) ) {
		require_once( 'inc/sa-updates/SA_Updates.php' );
	}
}
