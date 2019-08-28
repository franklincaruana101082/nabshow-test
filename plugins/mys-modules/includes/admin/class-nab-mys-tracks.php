<?php
/**
 * Class for Tracks Taxonomy for Sessions Post Type
 *
 * @package MYS Modules
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'NAB_MYS_TRACKS' ) ) {

	class NAB_MYS_TRACKS {

		/**
		 * Class Constructor
		 */
		public function __construct() {

			//post_tag  iske badale me taxonomy ka slug dedena he
			add_action( 'tracks_add_form_fields', array( $this, 'nab_mys_add_tracks_fields_to_new' ), 10, 2 );
			add_action( 'created_tracks', array( $this, 'nab_mys_save_tracks_fields_to_new' ), 10, 2 );
			add_action( 'tracks_edit_form_fields', array( $this, 'nab_mys_add_tracks_fields_to_existing' ), 10, 2 );
			add_action( 'edited_tracks', array( $this, 'nab_mys_save_tracks_fields_to_existing' ), 10, 2 );
			add_action( 'admin_enqueue_scripts', array( $this, 'nab_mys_load_media' ) );
			add_action( 'admin_footer', array( $this, 'nab_mys_add_tracks_script' ) );

		}

		public function nab_mys_load_media() {
			wp_enqueue_media();
		}

		/*
		 * Add a form field in the new tracks page
		 * @since 1.0.0
		*/
		public function nab_mys_add_tracks_fields_to_new( $taxonomy ) {
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-tracks-form-new.php' );
		}

		/*
		  * Save the form field
		  * @since 1.0.0
		 */
		public function nab_mys_save_tracks_fields_to_new( $term_id, $tt_id ) {

			$tracks_image_id = filter_input( INPUT_POST, 'tracks-image-id', FILTER_SANITIZE_STRING );
			$featured_tag = filter_input( INPUT_POST, 'featured_tag', FILTER_SANITIZE_STRING );

			if ( isset( $tracks_image_id ) && '' !== $tracks_image_id ) {
				$image = $tracks_image_id;
				add_term_meta( $term_id, 'tracks-image-id', $image, true );
			}
			if ( isset( $featured_tag ) && '' !== $featured_tag ) {
				$featured = $featured_tag;
				add_term_meta( $term_id, 'featured_tag', $featured, true );
			}
		}

		/*
		 * Edit the form field
		 * @since 1.0.0
		*/
		public function nab_mys_add_tracks_fields_to_existing( $term, $taxonomy ) {
			require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-tracks-form-existing.php' );
		}

		/*
		 * Update the form field value
		 * @since 1.0.0
		 */
		public function nab_mys_save_tracks_fields_to_existing( $term_id, $tt_id ) {

			$tracks_image_id = filter_input( INPUT_POST, 'tracks-image-id', FILTER_SANITIZE_STRING );
			$featured_tag = filter_input( INPUT_POST, 'featured_tag', FILTER_SANITIZE_STRING );

			if ( isset( $tracks_image_id ) && '' !== $tracks_image_id ) {
				$image = $tracks_image_id;
				update_term_meta( $term_id, 'tracks-image-id', $image );
			} else {
				update_term_meta( $term_id, 'tracks-image-id', '' );
			}

			if ( isset( $featured_tag ) && '' !== $featured_tag ) {
				$featured = $featured_tag;
				update_term_meta( $term_id, 'featured_tag', $featured );
			} else {
				update_term_meta( $term_id, 'featured_tag', '' );
			}
		}

		/*
		 * Add script
		 * @since 1.0.0
		 */
		public function nab_mys_add_tracks_script() {

			if ( ! wp_script_is( 'nab_mys_add_tracks_script', 'registered' ) ) {
				wp_register_script(
					'nab_mys_add_tracks_script',
					MYS_PLUGIN_URL . 'assets/js/nab-mys-tracks.js',
					array( 'jquery' ),
					'1.0.0',
					true
				);

				wp_enqueue_script( 'nab_mys_add_tracks_script' );
			}
        }

	}
}
new NAB_MYS_TRACKS();
