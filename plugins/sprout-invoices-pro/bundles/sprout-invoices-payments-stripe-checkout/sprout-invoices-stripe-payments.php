<?php
/*
Plugin Name: Sprout Invoices Add-on - Stripe Checkout
Plugin URI: https://sproutinvoices.com/marketplace/stripe-checkout/
Description: Accept Stripe Checkout with Sprout Invoices.
Author: Sprout Invoices
Version: 1.0
Author URI: https://sproutinvoices.com
*/

/**
 * Plugin File
 */
define( 'SA_ADDON_STRIPE_CHECKOUT_VERSION', '1.0' );
define( 'SA_ADDON_STRIPE_CHECKOUT_DOWNLOAD_ID', 141 );
define( 'SA_ADDON_STRIPE_CHECKOUT_FILE', __FILE__ );
define( 'SA_ADDON_STRIPE_CHECKOUT_PATH', dirname( __FILE__ ) );
define( 'SA_ADDON_STRIPE_CHECKOUT_URL', plugins_url( '', __FILE__ ) );
define( 'SA_ADDON_STRIPE_CHECKOUT_NAME', 'Sprout Invoices Stripe Checkout' );

if ( ! defined( 'SA_ADDON_STRIPE_CHECKOUT_URL' ) ) {
	define( 'SA_ADDON_STRIPE_CHECKOUT_URL', plugins_url( '', __FILE__ ) );
}

// Load up the processor before updates
add_action( 'si_payment_processors_loaded', 'sa_load_stripe_checkout' );
function sa_load_stripe_checkout() {
	require_once 'SI_Stripe_Checkout.php';
}
