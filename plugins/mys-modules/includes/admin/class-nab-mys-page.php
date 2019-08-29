<?php
/**
 * Admin Page Class
 *
 * @package MYS Modules
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'NAB_MYS_Sync' ) ) {

	class NAB_MYS_Sync {

		public function __construct() {

			//Register MYS Plugin Page
			add_action( 'admin_menu', array( $this, 'nab_mys_page_fun' ), 9 );

			add_action( 'admin_enqueue_scripts', array( $this, 'nab_mys_page_assets' ) );

		}

		public function nab_mys_page_assets() {

			// CSS
			wp_register_style( 'mys-settings-css', MYS_PLUGIN_URL . '/assets/css/nab-mys-settings.css', array(), '20130608' );
			wp_enqueue_style( 'mys-settings-css' );

			// JS
			wp_enqueue_script( 'jquery-ui-datepicker' );

			if ( ! wp_style_is( 'jquery-ui', 'registered' ) ) {
				wp_register_style(
					'jquery-ui',
					MYS_PLUGIN_URL . 'assets/css/jquery-ui.min.css'
					/*'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css'*/
				);
				wp_enqueue_style( 'jquery-ui' );
			}

		}

		/**
		 * Register a Setting Page
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_page_fun() {

			add_menu_page(
				__( 'MYS Modules', 'mys-modules' ),
				__( 'MYS Modules', 'mys-modules' ),
				'manage_options',
				'mys-sync',
				array( $this, 'nab_mys_page_html' ),
				WP_PLUGIN_URL . '/mys-modules/assets/images/icon.svg'
			);

			add_submenu_page( 'mys-sync', 'MYS Sync', 'MYS Sync', 'manage_options', 'mys-sync', array( $this, 'nab_mys_page_html' ) );

			add_submenu_page( 'null', 'MYS Login', 'MYS Login', 'manage_options', 'mys-login', array( $this, 'nab_mys_login_page_fun' ) );
			add_submenu_page( 'null', 'MYS History', 'MYS History', 'manage_options', 'mys-history', array( $this, 'nab_mys_history_page_fun' ) );
			add_submenu_page( 'null', 'MYS Setting', 'MYS Setting', 'manage_options', 'mys-setting', array( $this, 'nab_mys_setting_page_fun' ) );
			add_submenu_page( 'null', 'MYS About', 'MYS About', 'manage_options', 'mys-about', array( $this, 'nab_mys_about_page_fun' ) );
			add_submenu_page( 'null', 'MYS Dashboard', 'MYS Dashboard', 'manage_options', 'mys-dashboard', array( $this, 'nab_mys_dashboard_page_fun' ) );
			add_submenu_page( 'null', 'MYS History', 'MYS History', 'manage_options', 'mys-history', array( $this, 'nab_mys_history_page_fun' ) );
			add_submenu_page( 'null', 'MYS Exhibitors', 'MYS Exhibitors', 'manage_options', 'mys-exhibitors', array( $this, 'nab_mys_exhibitors_page_fun' ) );

		}

		public function nab_mys_login_page_fun() {
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-login-page.php' );
		}

		public function nab_mys_setting_page_fun() {
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-setting-page.php' );
		}

		public function nab_mys_about_page_fun() {
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-about-page.php' );
		}

		public function nab_mys_dashboard_page_fun() {
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-dashbord-page.php' );
		}

		public function nab_mys_history_page_fun() {
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-history-page.php' );
		}

		public function nab_mys_exhibitors_page_fun() {
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-exhibitors-page.php' );
		}

		/**
		 * HTML of the MYS Plugin Page - Call back function
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_page_html() {

			//Generate a New MYS API Token on load if expired after 1 hour
			( new NAB_MYS_Endpoints() )->nab_mys_api_token_from_cache();

			include_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-sync-page.php' );
		}
	}
}
new NAB_MYS_Sync();
