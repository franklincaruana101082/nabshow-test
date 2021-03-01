<?php
/**
 * Front Cropper's Main Plugin Class File.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Front_Cropper' ) ) {

	class Front_Cropper {

		/**
		 * Main Ignition Hook.
		 */
		public function fc_init_hook() {

			// Action to add script and style in front area.
			add_action( 'wp_enqueue_scripts', array( $this, 'fc_enqueue_script' ) );

			// Action to add script and style in admin area.
			add_action( 'admin_enqueue_scripts', array( $this, 'fc_enqueue_script' ) );
		}

		/*
		 * Enqueue script and style at front side.
		 *
		 * @param int $hook Hook suffix for the current admin page.
		 *
		 * @since 1.0.0
		 */
		public function fc_enqueue_script() {

			global $post;

			// Add styles.
			wp_enqueue_style( 'fc-cropper-style', 'https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.9/cropper.min.css', array(), '1.5.9' );
			wp_enqueue_style( 'fc-style', FRONT_CROPPER_URL . 'assets/css/fc-style.css', array(), '1.0.0' );

			// Add scripts.
			wp_enqueue_script( 'fc-cropper-script', 'https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.9/cropper.min.js', array( 'jquery' ), '1.5.9' );
			wp_enqueue_script( 'fc-script', FRONT_CROPPER_URL . 'assets/js/fc-script.js', array( 'jquery' ), '1.0.0' );
			wp_localize_script( 'fc-script', 'fcObj', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'postID'     => $post->ID,
			) );
		}
	}
}
