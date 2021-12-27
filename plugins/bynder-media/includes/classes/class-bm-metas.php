<?php
/**
 * Bynder Media Meta Class
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Bynder_Media_Metas' ) ) {

	class Bynder_Media_Metas {

		/**
		 * Bynder_Media_Metas constructor.
		 */
		public function __construct() {

			// Add meta boxes.
			add_action( 'add_meta_boxes', array( $this, 'bm_add_metaboxes' ) );

			// Save hook to store custom meta.
			add_action( 'save_post', array( $this, 'bm_save_metas' ) );
		}

		/**
		 * Add Bynder Meta Boxes.
		 */
		public function bm_add_metaboxes() {
			$screens = [
				'post',
				'page',
				'articles',
				'tribe_events',
				'event-shows',
				'company',
				'company-products',
				'sessions',
			];
			foreach ( $screens as $screen ) {
				add_meta_box(
					'bm_metabox_meta', // Unique ID
					'Bynder Media',
					array( $this, 'bm_metabox' ),
					$screen,
					'side',
					'low'
				);
			}
		}

		/**
         * Callback for Custom Meta Box
         *
		 * @param object $post Post details.
		 */
		public function bm_metabox( $post ) {

			wp_nonce_field( 'bm_metabox_submit', 'bm_metabox_nonce' );

			$screen = get_current_screen();

			// Company Products Metas.
			if ( 'edit' === $screen->parent_base && 'company-products' === $screen->post_type ) {
				$this->bm_add_products_meta_box();
			} else {
				// Add Featured Image.
				$this->bm_add_single_meta_box( 'profile_picture' );
			}

		}

		/**
         * Add Single Meta box.
         *
		 * @param $key Meta Key.
		 */
		public function bm_add_single_meta_box( $key ) {

			global $post;

			$bm_meta_image = get_post_meta( $post->ID, $key, true );

			$this->bm_meta_box_html( $bm_meta_image, 'bm_meta_featured_image', 'Featured Image' );
		}

		/**
         * Prepare Meta Box HTML.
         *
		 * @param string $bm_meta_image Bynder URL meta value.
		 * @param string $key Meta key.
		 * @param string $label Label for Bynder Box.
		 * @param false $is_array
		 */
		public function bm_meta_box_html( $bm_meta_image, $key, $label = 'Bynder Image', $is_array = false ) {
			if ( $bm_meta_image ) {
				$bm_featured_action = 'Replace ' . $label;
				$bm_image_class     = 'selected';
			} else {
				$bm_featured_action = 'Set ' . $label;
				$bm_image_class     = '';
			}

			// Handle previously code by changing the $bynder_for value.
			$bynder_for = 'bm_meta_featured_image' === $key ? 'profile_picture' : $key;

			?>
            <div id="bm_meta_featured_outer" class="<?php echo esc_attr( $bm_image_class ) ?>">
                <input type="hidden" name="<?php echo esc_attr( $key );
				if ( $is_array ) {
					echo '[]';
				} ?>" id="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $bm_meta_image ); ?>"/>
                <p><img src="<?php echo esc_url( $bm_meta_image ); ?>" id="<?php echo esc_attr( $key ); ?>_src" style="width: 100%;"/></p>
                <a href="javascript:void(0)" class="bm-select-media components-button is-secondary" bynder-for="<?php echo esc_attr( $bynder_for ) ?>" id="bm-image" data-label="<?php echo esc_attr( $label ); ?>"><?php echo esc_html( $bm_featured_action ); ?></a>
                <a href="javascript:void(0)" class="components-button is-link is-destructive" id="bm-featured-remove">Remove <?php echo esc_html( $label ); ?></a>
            </div>
			<?php
		}

		/**
		 * Add a products meta boxes on the Company products edit post page.
		 */
		public function bm_add_products_meta_box() {

			global $post;

			$bm_meta_image = get_post_meta( $post->ID, 'product_media_bm', true );
			$bm_meta_array = explode( ',', $bm_meta_image );

			for ( $i = 0; $i < 4; $i ++ ) {

				$bm_meta_image_single = '';
				if ( isset( $bm_meta_array[ $i ] ) && ! empty( $bm_meta_array[ $i ] ) ) {
					$bm_meta_image_single = $bm_meta_array[ $i ];
				}
				$num = $i + 1;
				$this->bm_meta_box_html( $bm_meta_image_single, 'product_media_bm', "Product Image $num", true );
			}
		}

		/**
         * Save Custom Meta Box value
         *
		 * @param int $post_id Post ID.
		 */
		public function bm_save_metas( $post_id ) {

			$is_autosave    = wp_is_post_autosave( $post_id );
			$is_revision    = wp_is_post_revision( $post_id );
			$is_valid_nonce = ( isset( $_POST['bm_metabox_nonce'] ) && wp_verify_nonce( $_POST['bm_metabox_nonce'], 'bm_metabox_submit' ) ) ? 'true' : 'false';

			// Exits script depending on save status
			if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
				return;
			}

			$screen = get_current_screen();

			if ( null !== $screen ) {

				// Company Products Metas.
				if ( 'company-products' === $screen->post_type ) {
					// Post values.
					$product_media_bm = filter_input( INPUT_POST, 'product_media_bm', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );
					$product_media_bm = implode( ',', $product_media_bm );
					update_post_meta(
						$post_id,
						'product_media_bm',
						$product_media_bm
					);
				} else {
					$bm_meta_featured_image = filter_input( INPUT_POST, "bm_meta_featured_image", FILTER_SANITIZE_STRING );

					//if ( strpos( $bm_meta_featured_image, 'assets' ) !== false ) {
					update_post_meta(
						$post_id,
						'profile_picture',
						$bm_meta_featured_image
					);
					//}
				}
			}
		}
	}

	// Self call.
	new Bynder_Media_Metas();
}
