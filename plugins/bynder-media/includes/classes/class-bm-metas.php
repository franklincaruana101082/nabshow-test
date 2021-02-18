<?php
/**
 * Bynder Media Meta Class
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Bynder_Media_Metas' ) ) {


	class Bynder_Media_Metas {

		public function __construct() {

			// Add meta boxes.
			add_action( 'add_meta_boxes', array( $this, 'bm_add_metaboxes' ) );

			// Save hook to store custom meta.
			add_action( 'save_post', array( $this, 'bm_save_metas' ) );
		}

		public function bm_add_metaboxes() {
            add_meta_box(
                'bm_metabox_meta', // Unique ID
                'Bynder Media',
                array( $this, 'bm_metabox_html' ),
                null,
                'side'
            );
		}

		// Callback for Custom Meta Box
		public function bm_metabox_html( $post ) {

			wp_nonce_field( 'bm_metabox_submit', 'bm_metabox_nonce' );

			// Add Featured Image.
			$bm_meta_featured_image = get_post_meta( $post->ID, '_bm_meta_featured_image', true );
			if ( $bm_meta_featured_image ) {
				$bm_featured_action = 'Replace';
				$bm_image_class     = 'selected';
			} else {
				$bm_featured_action = 'Set';
				$bm_image_class     = '';
			}
			?>
            <div id="bm_meta_featured_outer" class="<?php echo esc_attr( $bm_image_class ) ?>">
                <input type="hidden" name="bm_meta_featured_image" id="bm_meta_featured_image" value="<?php echo esc_attr( $bm_meta_featured_image ); ?>"/>
                <p><img src="<?php echo esc_url( $bm_meta_featured_image ); ?>" id="bm_meta_featured_image_src" style="width: 100%;"/></p>
				<a href="javascript:void(0)" class="bm-select-media components-button is-secondary" id="bm-featured-image"><?php echo esc_html( $bm_featured_action ); ?> Bynder Image</a>
				<a href="javascript:void(0)" class="components-button is-link is-destructive" id="bm-featured-remove">Remove Bynder Image</a>
            </div>
			<?php
		}

		// Save Custom Meta Box value
		public function bm_save_metas( $post_id ) {

			$is_autosave    = wp_is_post_autosave( $post_id );
			$is_revision    = wp_is_post_revision( $post_id );
			$is_valid_nonce = ( isset( $_POST['bm_metabox_nonce'] ) && wp_verify_nonce( $_POST['bm_metabox_nonce'], 'bm_metabox_submit' ) ) ? 'true' : 'false';

			// Exits script depending on save status
			if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
				return;
			}

			// Post values.
			$bm_meta_featured_image = filter_input( INPUT_POST, "bm_meta_featured_image", FILTER_SANITIZE_STRING );

			if ( $bm_meta_featured_image ) {
				update_post_meta(
					$post_id,
					'_bm_meta_featured_image',
					$bm_meta_featured_image
				);
			}
		}

	}

	new Bynder_Media_Metas();
}
