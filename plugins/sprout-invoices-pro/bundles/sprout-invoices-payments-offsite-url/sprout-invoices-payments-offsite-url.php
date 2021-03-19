<?php
/*
Plugin Name: Sprout Invoices Payments - URL Redirect
Plugin URI: https://sproutinvoices.com/marketplace/
Description: Redirect the client to a url to pay
Author: Sprout Invoices
Version: 1.0
Author URI: https://sproutinvoices.com
*/

/**
 * Plugin File
 */
define( 'SA_ADDON_PAYMENTREDIRECT_VERSION', '1.0' );
define( 'SA_ADDON_PAYMENTREDIRECT_DOWNLOAD_ID', 0000 );
define( 'SA_ADDON_PAYMENTREDIRECT_FILE', __FILE__ );
define( 'SA_ADDON_PAYMENTREDIRECT_PATH', dirname( __FILE__ ) );
define( 'SA_ADDON_PAYMENTREDIRECT_NAME', 'Sprout Invoices Payments URL Redirect' );
define( 'SA_ADDON_PAYMENTREDIRECT_URL', plugins_url( '', __FILE__ ) );


// Load up the processor before updates
add_action( 'si_payment_processors_loaded', 'sa_load_url_redirect' );
function sa_load_url_redirect() {
	require_once( 'inc/SA_Offsite_URL.php' );
}
