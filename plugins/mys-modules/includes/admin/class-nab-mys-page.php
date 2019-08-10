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
			add_action( 'admin_menu', array( $this, 'nab_mys_page_fun' ) );

			add_action( 'admin_enqueue_scripts', array( $this, 'nab_mys_page_css' ) );

		}

		public function nab_mys_page_css() {

			wp_register_style( 'mys-settings-css', MYS_PLUGIN_URL . '/assets/css/nab-mys-settings.css', array(), '20130608' );
			wp_enqueue_style( 'mys-settings-css' );
		}

		/**
		 * Register a Setting Page
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_page_fun() {

			add_menu_page(
				__( 'MYS Sync', 'mys-modules' ),
				__( 'MYS Sync', 'mys-modules' ),
				'manage_options',
				'mys-syn',
				array( $this, 'nab_mys_page_html' ) //call back fun
			);
//die("omg");

			add_submenu_page( 'null', 'MYS Login', 'MYS Login', 'manage_options', 'mys-login', array( $this, 'nab_mys__login_page_fun' ) );
			add_submenu_page( 'null', 'MYS History', 'MYS History', 'manage_options', 'mys-history', array( $this, 'nab_mys__history_page_fun' ) );
			add_submenu_page( 'null', 'MYS Setting', 'MYS Setting', 'manage_options', 'mys-setting', array( $this, 'nab_mys__setting_page_fun' ) );
			add_submenu_page( 'null', 'MYS About', 'MYS About', 'manage_options', 'mys-about', array( $this, 'nab_mys__about_page_fun' ) );
			add_submenu_page( 'null', 'MYS Dashboard', 'MYS Dashboard', 'manage_options', 'mys-dashboard', array( $this, 'nab_mys__dashboard_page_fun' ) );
			add_submenu_page( 'null', 'MYS History', 'MYS History', 'manage_options', 'mys-history', array( $this, 'nab_mys__history_page_fun' ) );
			add_submenu_page( 'null', 'MYS Exhibitors', 'MYS Exhibitors', 'manage_options', 'mys-exhibitors', array( $this, 'nab_mys__exhibitors_page_fun' ) );

		}

		public function nab_mys__login_page_fun() {
			require_once( MYS_PLUGIN_DIR . '/includes/admin/settings/html-mys-login-page.php' );
		}

		public function nab_mys__setting_page_fun() {

			//$this->my_custom_redirect();
			//add_action( 'wp_loaded', array( $this, 'my_custom_redirect' ) );

			require_once( MYS_PLUGIN_DIR . '/includes/admin/settings/html-mys-setting-page.php' );
		}

		public function nab_mys__about_page_fun() {
			require_once( MYS_PLUGIN_DIR . '/includes/admin/settings/html-mys-about-page.php' );
		}

		public function nab_mys__dashboard_page_fun() {
			require_once( MYS_PLUGIN_DIR . '/includes/admin/settings/html-mys-dashbord-page.php' );
		}

		public function nab_mys__history_page_fun() {
			require_once( MYS_PLUGIN_DIR . '/includes/admin/settings/html-mys-history-page.php' );
		}

		public function nab_mys__exhibitors_page_fun() {
			require_once( MYS_PLUGIN_DIR . '/includes/admin/settings/html-mys-exhibitors-page.php' );
		}

		public function my_custom_redirect() {
			die('adsf');
			if ( "1" === get_option( 'nab_mys_show_wizard' )
			     && "0" === get_option( 'nab_mys_credentails_valid' )
			     && "mys-login" !== $_GET['page'] ) {
				$redirect = admin_url( 'admin.php?page=mys-login' );
				wp_redirect( $redirect );
				exit;
			}
		}

		/**
		 * HTML of the MYS Plugin Page - Call back function
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_page_html() {

			//$this->my_custom_redirect();
			//add_action( 'wp_loaded', array( $this, 'my_custom_redirect' ) );

			//Generate a New MYS API Token on load if expired after 1 hour
			( new NAB_MYS_Endpoints() )->nab_mys_get_token_from_cache();

			include_once( MYS_PLUGIN_DIR . '/includes/admin/settings/html-mys-plugin-page.php' );
		}
	}
}
new NAB_MYS_Sync();
