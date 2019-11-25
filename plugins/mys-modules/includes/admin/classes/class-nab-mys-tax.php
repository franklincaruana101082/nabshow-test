<?php
/**
 * Class for Custom Taxonomy Fields
 *
 * @package MYS Modules
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'NAB_MYS_TAX' ) ) {
	/**
	 * Class NAB_MYS_TAX
	 */
	class NAB_MYS_TAX {

		/**
		 * Class Constructor
		 */
		public function __construct() {

			add_action( 'tracks_add_form_fields', array( $this, 'nab_mys_add_fields_to_new' ), 10, 2 );
			add_action( 'created_tracks', array( $this, 'nab_mys_save_fields_to_new' ), 10, 2 );
			add_action( 'tracks_edit_form_fields', array( $this, 'nab_mys_add_fields_to_existing' ), 10, 2 );
			add_action( 'edited_tracks', array( $this, 'nab_mys_save_fields_to_existing' ), 10, 2 );

			add_action( 'exhibitor-categories_add_form_fields', array( $this, 'nab_mys_add_fields_to_new' ), 10, 2 );
			add_action( 'created_exhibitor-categories', array( $this, 'nab_mys_save_fields_to_new' ), 10, 2 );
			add_action( 'exhibitor-categories_edit_form_fields', array( $this, 'nab_mys_add_fields_to_existing' ), 10, 2 );
			add_action( 'edited_exhibitor-categories', array( $this, 'nab_mys_save_fields_to_existing' ), 10, 2 );

			add_action( 'admin_enqueue_scripts', array( $this, 'nab_mys_load_media' ) );
			add_action( 'admin_footer', array( $this, 'nab_mys_add_tax_script' ) );

		}


		/**
		 * Load media for Tracks.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_load_media() {
			wp_enqueue_media();
		}

		/**
		 * Add fields to a new track page.
		 *
		 * @param string $taxonomy A Taxonomy.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_add_fields_to_new( $taxonomy ) {
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-tax-form-new.php' );
		}

		/**
		 * Save fields to a new track page.
		 *
		 * @param string $term_id A term id.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_save_fields_to_new( $term_id ) {

			$tax_image_id = filter_input( INPUT_POST, 'tax-image-id', FILTER_SANITIZE_STRING );
			$featured_tag = filter_input( INPUT_POST, 'featured_tag', FILTER_SANITIZE_STRING );

			if ( isset( $tax_image_id ) && '' !== $tax_image_id ) {
				$image = $tax_image_id;
				add_term_meta( $term_id, 'tax-image-id', $image, true );
			}
			if ( isset( $featured_tag ) && '' !== $featured_tag ) {
				$featured = $featured_tag;
				add_term_meta( $term_id, 'featured_tag', $featured, true );
			}
		}

		/**
		 * Edit fields to a existing track page.
		 *
		 * @param string $term A Term.
		 * @param string $taxonomy A Taxonomy.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_add_fields_to_existing( $term, $taxonomy ) {
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-tax-form-existing.php' );
		}

		/**
		 * Update fields to a existing track page.
		 *
		 * @param string $term_id A Term.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_save_fields_to_existing( $term_id ) {

			$tax_image_id = filter_input( INPUT_POST, 'tax-image-id', FILTER_SANITIZE_STRING );
			$featured_tag = filter_input( INPUT_POST, 'featured_tag', FILTER_SANITIZE_STRING );

			if ( isset( $tax_image_id ) && '' !== $tax_image_id ) {
				$image = $tax_image_id;
				update_term_meta( $term_id, 'tax-image-id', $image );
			} else {
				update_term_meta( $term_id, 'tax-image-id', '' );
			}

			if ( isset( $featured_tag ) && '' !== $featured_tag ) {
				$featured = $featured_tag;
				update_term_meta( $term_id, 'featured_tag', $featured );
			} else {
				update_term_meta( $term_id, 'featured_tag', '' );
			}
		}

		/**
		 * Add script for a track page.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_add_tax_script() {

			if ( ! wp_script_is( 'nab_mys_add_tax_script', 'registered' ) ) {
				wp_register_script(
					'nab_mys_add_tax_script',
					MYS_PLUGIN_URL . 'assets/js/nab-mys-taxonomy.min.js',
					array( 'jquery' ),
					'1.0.0',
					true
				);

				wp_enqueue_script( 'nab_mys_add_tax_script' );
			}
		}

	}
}
new NAB_MYS_TAX();
