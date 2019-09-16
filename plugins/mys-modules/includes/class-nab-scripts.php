<?php
/**
 * MYS Plugin Scripts and Styles are registered here.
 *
 * Register new Scripts and Styles in this file.
 *
 * @package MYS Modules
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'NAB_MYS_Scripts' ) ) {

	class NAB_MYS_Scripts {

		public function __construct() {

			//Action to add script on MYS Sync Page.
			add_action( 'admin_enqueue_scripts', array( $this, 'nab_mys_admin_script' ) );

		}

		/**
		 * Registering Script for the MYS Sync Page.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_admin_script() {

			if ( ! wp_script_is( 'nab-mys-sync-script', 'registered' ) ) {
				wp_register_script(
					'nab-mys-sync-script',
					MYS_PLUGIN_URL . 'assets/js/nab-mys-script.js',
					array( 'jquery' ),
					'1.0.0',
					true
				);
				wp_localize_script(
					'nab-mys-sync-script',
					'mysHandler',
					array(
						'ajaxurl'  => admin_url( 'admin-ajax.php' ),
						'security' => wp_create_nonce( 'mys-ajax-nonce' )
					) );

				wp_enqueue_script( 'nab-mys-sync-script' );
			}

		}

	}
}
new NAB_MYS_Scripts();
