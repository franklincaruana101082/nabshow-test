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

if ( ! class_exists( 'NAB_MYS_Main' ) ) {

	class NAB_MYS_Main {

		private $nab_mys_sync_parent_object;

		private $nab_mys_db_history_object;

		private $nab_mys_db_cron_object;

		public function __construct() {

			//Register Post Types & Taxonomies
			$this->nab_mys_register_post_types();

			//Load Important Classes
			$this->nab_mys_load_global_classes();
		}

		/**
		 * Plugin Setup (On Activation)
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		static function nab_mys_plugin_activate( $plugin = false ) {

			delete_option( 'mys_login_form_success' );
			/*delete_option( 'nab_mys_credentials_u' );
			delete_option( 'nab_mys_credentials_p' );*/

			update_option( 'nab_mys_show_wizard', 1 );

			if ( MYS_PLUGIN_BASE === $plugin ) {
				wp_redirect( esc_url( admin_url( 'admin.php?page=mys-login' ) ) );
				exit();
			}
		}

		/**
		 * Plugin Setup (On Deactivation)
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		static function nab_mys_plugin_deactivate() {

			//Delete a MYS API Token from Transient Cache
			delete_transient( 'nab_mys_token' );
			delete_option( 'mys_login_form_success' );
			delete_option( 'nab_mys_show_wizard' );

		}

		public function nab_mys_run() {

			//Initialze the sync process.
			$this->nab_mys_load_sync_classes();

			//Register MYS Plugin Page
			add_action( 'admin_menu', array( $this, 'nab_mys_page_fun' ), 9 ); /*Priority changed for the dependent plugin - 'MYS Blocks' */

			//Register Assets
			add_action( 'admin_enqueue_scripts', array( $this, 'nab_mys_page_assets' ) );
		}

		public function nab_mys_register_post_types() {

			//Register MYS Dependent Post Types & Taxonomies.
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/nab-post-types.php' );

			//Develop Tracks Custom Fields
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-tax.php' );

		}

		public function nab_mys_load_global_classes() {

			//Class File - Scripts & Styles
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/class-nab-scripts.php' );

			//Class File - Database - CRON
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-db-cron.php' );

			$this->nab_mys_db_cron_object = new NAB_MYS_DB_CRON();

		}

		public function nab_mys_load_history_class() {

			//Class File - Database - History
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-db-history.php' );

			$this->nab_mys_db_history_object = new NAB_MYS_DB_History();

		}

		public function nab_mys_load_sync_classes() {

			//Class File - Database
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-db-parent.php' );

			//Class File - MYS API Sync
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-sync-parent.php' );

			$this->nab_mys_sync_parent_object = new NAB_MYS_Sync_Parent();

			//Class File - Sessions
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-sync-sessions.php' );

			//Class File - Exhibitors
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-sync-exhibitors.php' );

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
				array( $this, 'nab_mys_sync_page' ),
				WP_PLUGIN_URL . '/mys-modules/assets/images/icon.svg'
			);

			add_submenu_page( 'mys-sync', 'MYS Sync', 'MYS Sync', 'manage_options', 'mys-sync', array( $this, 'nab_mys_sync_page' ) );

			add_submenu_page( 'null', 'MYS Login', 'MYS Login', 'manage_options', 'mys-login', array( $this, 'nab_mys_login_page_fun' ) );
			add_submenu_page( 'null', 'MYS History', 'MYS History', 'manage_options', 'mys-history', array( $this, 'nab_mys_history_page_fun' ) );
			add_submenu_page( 'null', 'MYS Setting', 'MYS Setting', 'manage_options', 'mys-setting', array( $this, 'nab_mys_setting_page_fun' ) );
			add_submenu_page( 'null', 'MYS About', 'MYS About', 'manage_options', 'mys-about', array( $this, 'nab_mys_about_page_fun' ) );
			add_submenu_page( 'null', 'MYS Dashboard', 'MYS Dashboard', 'manage_options', 'mys-dashboard', array( $this, 'nab_mys_dashboard_page_fun' ) );
			add_submenu_page( 'null', 'MYS Exhibitors', 'MYS Exhibitors', 'manage_options', 'mys-exhibitors', array( $this, 'nab_mys_exhibitors_page_fun' ) );

		}

		/**
		 * HTML of the MYS Plugin Page - Call back function
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_sync_page() {

			//Generate a New MYS API Token on load if expired after 1 hour
			$this->nab_mys_sync_parent_object->nab_mys_api_token_from_cache();

			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-sync-page.php' );
		}

		public function nab_mys_login_page_fun() {

			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-login-page.php' );
		}

		public function nab_mys_setting_page_fun() {

			$this->nab_mys_load_history_class();

			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-setting-page.php' );
		}

		public function nab_mys_about_page_fun() {
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-about-page.php' );
		}

		public function nab_mys_dashboard_page_fun() {

			$this->nab_mys_load_history_class();

			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-dashbord-page.php' );
		}

		public function nab_mys_history_page_fun() {

			$this->nab_mys_load_history_class();

			$history_groupid = FILTER_INPUT( INPUT_GET, 'groupid', FILTER_SANITIZE_STRING );

			//Load Page
			$this->nab_mys_db_history_object->nab_mys_history_page_loader($history_groupid, $this->nab_mys_db_cron_object);

		}

		public function nab_mys_exhibitors_page_fun() {

			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-exhibitors-page.php' );

		}
	}
}
