<?php
/*
	Plugin Name: Admin Collapse Subpages
	Plugin URI: https://bravokeyl.com/admin-collapse-subpages/
	Description: Using this plugin one can easily collapse/expand pages / custom post types with children and grand children.
	Author: Alex Chalupka
	Author URI: https://bravokeyl.com
	Version: 2.4
	Text Domain: admin-collapse-subpages
	Domain Path: /languages
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html

	Admin Collapse Subpages is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 2 of the License, or
	any later version.

	Admin Collapse Subpages is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with Admin Collapse Subpages. If not, see http://www.gnu.org/licenses/gpl-2.0.html.

*/

if (!class_exists('Admin_Collapse_Subpages')) {

	class Admin_Collapse_Subpages {

		/**
		 * Records if the scripts and styles have been enqueued so that we only
		 * do so once.
		 *
		 * @var boolean
		 */
		protected static $initiated = false;

		/**
		 * Admin_Collapse_Subpages constructor.
		 */
		public function __construct() {
			if ( ! self::$initiated ) {
				$this->init_hooks();
			}
		}

		/**
		 * initialize wordpress hook and filter
		 */
		public function init_hooks() {

			self::$initiated = true;

			add_action( 'plugins_loaded', array( $this, 'acs_textdomain' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'acs_scripts' ) );

		}

		/**
		 * Load plugin text domain
		 */
		public function acs_textdomain() {
			load_plugin_textdomain( 'admin-collapse-subpages', false, basename( dirname( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Load script and add class to the admin body
		 */
		public function acs_scripts() {
			global $pagenow;

			$post_type = filter_input( INPUT_GET, 'post_type', FILTER_SANITIZE_STRING );
			$taxonomy  = filter_input( INPUT_GET, 'taxonomy', FILTER_SANITIZE_STRING );

			if ( isset( $post_type ) && ! empty( $post_type ) ) {

				if ( is_post_type_hierarchical( $post_type ) ) {

					add_filter( 'admin_body_class', array( $this, 'acs_admin_body_class' ) );
				}
			}

			if ( isset( $taxonomy ) && 'category' === $taxonomy ) {

				add_filter( 'admin_body_class', array( $this, 'acs_admin_body_class' ) );
			}

			if ( is_admin() && ( ( ! empty( $post_type ) && 'edit.php' === $pagenow ) || 'edit-tags.php' === $pagenow ) ) {

				//make sure jquery is loaded
				wp_enqueue_script( 'jquery' );

				//main collapse pages script
				wp_enqueue_script( 'acs-js', plugins_url( 'js/acs.js', __FILE__ ), array( 'jquery' ), '2.0' );

				//Load Styles
				wp_enqueue_style( 'acs-css', plugins_url( 'css/style.css', __FILE__ ), false, '2.0', 'screen' );

				wp_localize_script( 'acs-js', 'acs_l10n_vars', array(
					'lexpandall'   => __( 'Expand All', 'admin-collapse-subpages' ),
					'lcollapseall' => __( 'Collapse All', 'admin-collapse-subpages' ),
				) );

			}
		}

		/**
		 * Added admin body class
		 * @param $classes
		 * @return string
		 */
		public function acs_admin_body_class( $classes ) {

			$classes .= ' ' . 'acs-hier';

			return $classes;
		}

	}

	$collapsePages = new Admin_Collapse_Subpages();
}
