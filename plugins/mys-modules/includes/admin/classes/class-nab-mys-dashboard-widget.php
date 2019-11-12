<?php
/**
 * DataBase Dashboard Widget Class
 *
 * @package MYS Modules
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'NAB_MYS_Dashboard_Widget' ) ) {

	/**
	 * Class NAB_MYS_Dashboard_Widget
	 */
	class NAB_MYS_Dashboard_Widget {

		private $glance_data;

		/**
		 * Class Constructor
		 */
		public function __construct() {

			//Register Custom Dashboard Widget
			add_action( 'wp_dashboard_setup', array( $this, 'nab_mys_dashboard_widget' ) );

		}

		/**
		 * Register Dashboard Widget
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_dashboard_widget() {

			global $wp_meta_boxes;

			wp_add_dashboard_widget( 'custom_mys_widget', '<img id="mys_widget_title" src="' . WP_PLUGIN_URL . '/mys-modules/assets/images/icon.svg" /> MYS Stats', array( $this, 'nab_mys_stats_widget' ) );

		}

		/**
		 * Html for the MYS Stats widget
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_stats_widget() {

			//The Summary data from history table
			$this->glance_data = NAB_MYS_DB_History::nab_mys_dashboard_glance();

			//HTML for widget
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-dashbord-widget.php' );

		}

	}
}
new NAB_MYS_Dashboard_Widget();
