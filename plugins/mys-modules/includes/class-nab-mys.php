<?php
/**
 * Main Class File
 *
 * @package MYS Modules
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'NAB_MYS_Main' ) ) {

	/**
	 * Main Class of the plugin: NAB_MYS_Main
	 */
	class NAB_MYS_Main {

		//Sync's Parent Class Object
		private $nab_mys_sync_parent_object;

		//History's DB Class Object
		private $nab_mys_db_history_object;

		//CRON's DB Class Object
		private $nab_mys_db_cron_object;

		private $pagenow;

		/**
		 * NAB_MYS_Main constructor.
		 */
		public function __construct() {

			global $pagenow;
			$this->pagenow = $pagenow;

			//Register Post Types & Taxonomies
			$this->nab_mys_register_post_types();

			//Load Important Classes
			$this->nab_mys_load_global_classes();
		}

		/**
		 * Register MYS Dependent Post Types & Taxonomies.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_register_post_types() {

			//Register MYS Dependent Post Types & Taxonomies.
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/nab-post-types.php' );

			if ( 'edit-tags.php' === $this->pagenow || 'term.php' === $this->pagenow ) {
				//Develop Tracks Custom Fields
				require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-tax.php' );
			}
		}

		/**
		 * Load Important Classes
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_load_global_classes() {

			//Class File - Script
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/class-nab-assets.php' );

			//Class File - Database - CRON
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-db-cron.php' );

			$this->nab_mys_db_cron_object = new NAB_MYS_DB_CRON();

			//Load widget only if its a WordPress Dashboard Page
			if ( 'index.php' === $this->pagenow ) {
				$this->nab_mys_load_history_class();

				//Class File - Custom Dashboard Widget
				require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-dashboard-widget.php' );
			}
		}

		/**
		 * Load History Class
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_load_history_class() {

			//Class File - Database - History
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-db-history.php' );

			//Creating history's db class object to use in various sections of the plugin.
			$this->nab_mys_db_history_object = new NAB_MYS_DB_History();

		}

		/**
		 * Run the plugin
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_run() {

			//Initialze the sync process.
			$this->nab_mys_load_sync_classes();

			//Register MYS Plugin Page
			add_action( 'admin_menu', array( $this, 'nab_mys_pages' ), 9 ); /*Priority changed for the dependent plugin - 'MYS Blocks' */

		}

		/**
		 * Load Syncing classes
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_load_sync_classes() {

			//Class File - Database
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-db-parent.php' );

			//Class File - MYS API Sync
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-sync-parent.php' );

			//Create a Sync's parent object to use in Sessions & Exhibitors classes.
			$this->nab_mys_sync_parent_object = new NAB_MYS_Sync_Parent();

			//Class File - Sessions
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-sync-sessions.php' );

			//Class File - Exhibitors
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/classes/class-nab-mys-sync-exhibitors.php' );

		}

		/**
		 * Register Admin Pages
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_pages() {

			//Adding a new admin page for MYS
			add_menu_page(
				__( 'MYS Modules', 'mys-modules' ),
				__( 'MYS Modules', 'mys-modules' ),
				'manage_options',
				'mys-sync',
				array( $this, 'nab_mys_page_sync' ),
				WP_PLUGIN_URL . '/mys-modules/assets/images/icon.svg'
			);

			//Adding a Sync Page
			add_submenu_page( 'mys-sync', 'MYS Sync', 'MYS Sync', 'manage_options', 'mys-sync', array( $this, 'nab_mys_page_sync' ) );

			//Adding a Login Page
			add_submenu_page( 'null', 'MYS Login', 'MYS Login', 'manage_options', 'mys-login', array( $this, 'nab_mys_page_login' ) );

			//Adding a History Page
			add_submenu_page( 'null', 'MYS History', 'MYS History', 'manage_options', 'mys-history', array( $this, 'nab_mys_page_history' ) );

			//Adding a Settings Page
			add_submenu_page( 'null', 'MYS Setting', 'MYS Setting', 'manage_options', 'mys-setting', array( $this, 'nab_mys_page_setting' ) );

			//Adding an About Page
			add_submenu_page( 'null', 'MYS About', 'MYS About', 'manage_options', 'mys-about', array( $this, 'nab_mys_page_about' ) );

			//Adding a Dashboard Page
			add_submenu_page( 'null', 'MYS Dashboard', 'MYS Dashboard', 'manage_options', 'mys-dashboard', array( $this, 'nab_mys_page_dashboard' ) );

			//Adding an Exhibitors Page
			add_submenu_page( 'null', 'MYS Exhibitors', 'MYS Exhibitors', 'manage_options', 'mys-exhibitors', array( $this, 'nab_mys_page_exhibitors' ) );

		}

		/**
		 * HTML of the MYS Plugin Page - Call back function
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_page_sync() {

			//Generate a New MYS API Token on load if expired after 1 hour
			$this->nab_mys_sync_parent_object->nab_mys_api_token_from_cache();

			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-sync-page.php' );
		}

		/**
		 * HTML for Login Page
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_page_login() {

			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-login-page.php' );
		}

		/**
		 * HTML for Settings Page
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_page_setting() {

			$this->nab_mys_load_history_class();

			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-setting-page.php' );
		}

		/**
		 * HTML for About Page
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_page_about() {
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-about-page.php' );
		}

		/**
		 *  HTML for Dashboard Page
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_page_dashboard() {

			$this->nab_mys_load_history_class();

			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-dashbord-page.php' );
		}

		/**
		 * HTML for History Page
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_page_history() {

			$this->nab_mys_load_history_class();

			$history_groupid = FILTER_INPUT( INPUT_GET, 'groupid', FILTER_SANITIZE_STRING );

			//Load Page
			$this->nab_mys_db_history_object->nab_mys_history_page_loader( $history_groupid, $this->nab_mys_db_cron_object );

		}

		/**
		 * HTML for Exhibitors Page
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_page_exhibitors() {

			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-exhibitors-page.php' );

		}

		/**
		 * Plugin Setup (On Activation)
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		static function nab_mys_plugin_activate( $plugin = false ) {

			update_option( 'nab_mys_show_wizard', 1 );
			update_option( 'test_modified_sequence', 1 );

			if ( MYS_PLUGIN_BASE === $plugin ) {
				wp_redirect( esc_url( admin_url( 'admin.php?page=mys-login' ) ) );
				exit();
			}
		}

		/**
		 * Setup WP Cron for MYS plugin.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		function nab_mys_wpcron_setup() {

			$sessions_datatype = array( 1 );
			$speakers_datatype = array( 2 );
			$tracks_datatype   = array( 3 );
			$sponsors_datatype = array( 4 );

			// Sessions Cron.
			if ( ! wp_next_scheduled( 'mys_sessions_cron', $sessions_datatype ) ) {
				wp_schedule_event( time(), 'hourly', 'mys_sessions_cron', $sessions_datatype );
			}
			if ( ! wp_next_scheduled( 'mys_sessions_cron', $speakers_datatype ) ) {
				wp_schedule_event( time(), 'hourly', 'mys_sessions_cron', $speakers_datatype );
			}
			if ( ! wp_next_scheduled( 'mys_sessions_cron', $tracks_datatype ) ) {
				wp_schedule_event( time(), 'hourly', 'mys_sessions_cron', $tracks_datatype );
			}
			if ( ! wp_next_scheduled( 'mys_sessions_cron', $sponsors_datatype ) ) {
				wp_schedule_event( time(), 'hourly', 'mys_sessions_cron', $sponsors_datatype );
			}

			// Exhibitors Cron.
			if ( ! wp_next_scheduled( 'mys_exhibitors_cron' ) ) {
				wp_schedule_event( time(), 'hourly', 'mys_exhibitors_cron' );
			}

			// Master CRON.
			$limit       = 100;
			$master_args = array( $limit );
			if ( ! wp_next_scheduled( 'mys_master_cron', $master_args ) ) {
				wp_schedule_event( time(), 'hourly', 'mys_master_cron', $master_args );
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
			delete_option( 'mys_login_form_success' );
			delete_option( 'nab_mys_show_wizard' );

		}
	}
}
