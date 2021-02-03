<?php
/**
 * Bynder Media Blocks Class
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Bynder_Media_Blocks' ) ) {


	class Bynder_Media_Blocks {

		public function __construct() {
			//Action for add gutenberg custom block
			add_action( 'enqueue_block_editor_assets', array( $this, 'bm_add_block_editor_script' ) );

			// Action to register all dynamic blocks
			//add_action( 'init', array( $this, 'bm_register_dynamic_blocks' ) );
		}

		/*
         * Enqueue gutenberg custom block script
         *
         * @since 1.0.0
         */
		public static function bm_add_block_editor_script() {
			wp_enqueue_script( 'bm-gutenberg-block', BYNDER_MEDIA_URL . 'assets/js/blocks/block.build.js', array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components', 'jquery' ), '1.0.0' );
		}

		/**
		 * Register all dynamic blocks
		 *
		 * @since 1.0.0
		 */
		public function bm_register_dynamic_blocks() {

			register_block_type( 'mys/dynamic-slider',
				array(
					'style'         => 'sg-block-front-end-styles',
					'editor_style'  => 'sg-block-editor-styles',
					'editor_script' => 'sg-block-editor-js',
				)
			);

		}
	}
	new Bynder_Media_Blocks();
}
