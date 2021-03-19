<?php
/*
Plugin Name: Sprout Invoices Add-on - Client Summary Notification
Plugin URI: https://sproutinvoices.com/news/sprout-invoices-v10-account-credits-client-summary-notifications/
Description: Sends Invoice/Estimate Summary to the Client
Author: Sprout Invoices
ID: 0
Version: 1.0.1
Author URI: https://sproutinvoices.com
Auto Active: true
*/

/**
 * Plugin Info for updates
 */
define( 'SA_ADDON_CLIENT_SUMMARY_NOTIFICATION_VERSION', '1.0.1' );
define( 'SA_ADDON_CLIENT_SUMMARY_NOTIFICATION_DOWNLOAD_ID', 1111 );
define( 'SA_ADDON_CLIENT_SUMMARY_NOTIFICATION_FILE', __FILE__ );
define( 'SA_ADDON_CLIENT_SUMMARY_NOTIFICATION_PATH', dirname( __FILE__ ) );
define( 'SA_ADDON_CLIENT_SUMMARY_NOTIFICATION_NAME', 'Sprout Invoices ID Generation' );
define( 'SA_ADDON_CLIENT_SUMMARY_NOTIFICATION_URL', plugins_url( '', __FILE__ ) );

// Load up after SI is loaded.
add_action( 'sprout_invoices_loaded', 'sa_load_summary_notification_addon', 100 ); // delay for client dashboard check.
function sa_load_summary_notification_addon() {

	// Controller
	require_once( 'inc/SI_Summary_Notification.php' );
	require_once( 'inc/SI_Summary_Notification_Control.php' );

	SI_Summary_Notification::init();
	SI_Summary_Notification_Control::init();

	// Updates
	if ( class_exists( 'SI_Updates' ) ) {
		require_once( 'inc/sa-updates/SA_Updates.php' );
	}
}
