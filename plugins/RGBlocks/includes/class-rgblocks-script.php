<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package RGBlocks
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class RGBlocks_Script
 */
class RGBlocks_Script {

	/**
	 * RGBlocks_Script constructor.
	 */
	function __construct() {
		add_action( 'enqueue_block_editor_assets', array( $this, 'rgblocks_add_block_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'rgblocks_add_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'rgblocks_add_admin_scripts' ) );
	}

	/**
	 * Function rgblocks_add_block_scripts.
	 */
	public function rgblocks_add_block_scripts() {

		wp_enqueue_script(
			'rgblocks-gutenberg-block',
			RGBLOCKS_URL . 'assets/js/gutenberg-block/block.build.js',
			array(
				'wp-blocks',
				'wp-i18n',
				'wp-element',
				'wp-editor',
				'wp-components',
			)
		);
		wp_enqueue_style( 'rgblocks-gutenberg-block-backend-css', RGBLOCKS_URL . 'assets/css/block.css', array( 'wp-edit-blocks' ) );
		register_block_type(
			'rgblocks-gutenberg-block/custom-block',
			array(
				'editor_script' => 'rgblocks-gutenberg-block',
				'editor_style'  => 'rgblocks-gutenberg-block-backend-css',
			)
		);
	}

	public function rgblocks_add_admin_styles() {
		wp_enqueue_style( 'font-awesome-css', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css', false );
		wp_enqueue_style( 'font-awesome', RGBLOCKS_URL . 'assets/css/font-awesome.min.css', array() );
		wp_enqueue_style( 'add-google-fonts', 'https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700,800', false );
		wp_enqueue_style( 'rgblocks-gutenberg-block-backend-css', RGBLOCKS_URL . 'assets/css/block.css', array( 'wp-edit-blocks' ) );
	}

	public function rgblocks_add_admin_scripts() {
		wp_enqueue_script( array( 'jquery-ui-core', 'jquery-ui-tabs' ) );
	}
}

$rgblocks_script = new RGBlocks_Script();
