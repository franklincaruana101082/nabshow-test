<?php
/*
Plugin Name: Sprout Invoices Add-on - PDF Service
Plugin URI: https://sproutinvoices.com/sprout-invoices/sprout-pdfs/
Description: Generates PDFs via a Sprout Invoices API to create better looking PDFs.<br/><b>Note:</b> The PDF Service is now free for all pro license holders.
Author: Sprout Invoices
ID: 3445
Version: 1
Author URI: https://sproutinvoices.com
*/

/**
 * Plugin Info for updates
 */
define( 'SA_ADDON_SPROUT_PDFS_VERSION', '1.0' );
define( 'SA_ADDON_SPROUT_PDFS_DOWNLOAD_ID', 3445 );
define( 'SA_ADDON_SPROUT_PDFS_NAME', 'Sprout Invoices PDF Service (beta)' );
define( 'SA_ADDON_SPROUT_PDFS_FILE', __FILE__ );
define( 'SA_ADDON_SPROUT_PDFS_PATH', dirname( __FILE__ ) );
define( 'SA_ADDON_SPROUT_PDFS_URL', plugins_url( '', __FILE__ ) );


if ( ! defined( 'SI_DEV' ) ) {
	define( 'SI_DEV', false );
}

if ( ! function_exists( 'sa_load_si_pdf_service_addon' ) ) {
		// Load up after SI is loaded.
	add_action( 'sprout_invoices_loaded', 'sa_load_si_pdf_service_addon' );
	function sa_load_si_pdf_service_addon() {
		if ( class_exists( 'Sprout_PDFs_Controller' ) ) {
			return;
		}

		require_once( 'vendor/pdfcrowd.php' );
		require_once( 'inc/PDF_Service_Controller.php' );
		require_once( 'inc/PDF_Service_API.php' );
		require_once( 'inc/PDF_Service_Settings.php' );
		require_once( 'inc/PDF_Service_Attachments.php' );
		require_once( 'inc/PDF_Service_Views.php' );

		if ( ( SI_Updates::license_status() != false && SI_Updates::license_status() == 'valid' ) || SI_DEV ) {
			SI_Sprout_PDFs_Controller::init();
				// init sub classes
				SI_Sprout_PDFs_API::init();
				SI_Sprout_PDFs_Settings::init();
				SI_Sprout_PDFs_Attachments::init();
				SI_Sprout_PDFs_Views::init();
		}
	}
}
