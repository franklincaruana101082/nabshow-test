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

	/**
	 * Class NAB_MYS_Scripts
	 */
	class NAB_MYS_Scripts {

		/**
		 * NAB_MYS_Scripts constructor.
		 */
		public function __construct() {

			//Action to add script and style on MYS Sync Page.
			add_action( 'admin_enqueue_scripts', array( $this, 'nab_mys_assets' ) );

		}

		/**
		 * Registering Script & Style for the MYS Admin Pages.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_assets() {

			//Registering Plugin's Main JS
			if ( ! wp_script_is( 'nab-mys-sync-script', 'registered' ) ) {
				wp_register_script(
					'nab-mys-sync-script',
					MYS_PLUGIN_URL . 'assets/js/nab-mys-script.min.js',
					array( 'jquery' ),
					'1.1',
					true
				);
				wp_localize_script(
					'nab-mys-sync-script',
					'mysHandler',
					array(
						'ajaxurl'    => admin_url( 'admin-ajax.php' ),
						'mastercron' => get_rest_url( null, '/mys/migrate-data' ),
						'security'   => wp_create_nonce( 'mys-ajax-nonce' )
					) );

				wp_enqueue_script( 'nab-mys-sync-script' );
			}

			//Registering Datepicker JS
			wp_enqueue_script( 'jquery-ui-datepicker' );
			if ( ! wp_style_is( 'jquery-ui', 'registered' ) ) {
				wp_register_style(
					'jquery-ui',
					MYS_PLUGIN_URL . 'assets/css/jquery-ui.min.css'
				);
				wp_enqueue_style( 'jquery-ui' );
			}

			//Registering CSS
			wp_register_style( 'mys-settings-css', MYS_PLUGIN_URL . '/assets/css/nab-mys-settings.css', array(), '20130608' );
			wp_enqueue_style( 'mys-settings-css' );

		}

	}
}
new NAB_MYS_Scripts();
