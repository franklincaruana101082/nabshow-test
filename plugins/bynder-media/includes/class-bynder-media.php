<?php
/**
 * Bynder Media's Main Plugin Class File.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Bynder_Media' ) ) {

	class Bynder_Media {

		/**
		 * Main Ignition Hook.
		 */
		public function bm_init_hook() {

			// Action to add script and style in admin area.
			add_action( 'admin_enqueue_scripts', array( $this, 'bm_enqueue_script' ) );

			// Action to add script and style in front area.
			add_action( 'wp_enqueue_scripts', array( $this, 'bm_enqueue_script' ) );

			// Action for add setting page
			add_action( 'admin_menu', array( $this, 'bm_add_setting_page' ) );

			// Include required clasess.
			$this->bm_included_classes();
		}

		public function bm_included_classes() {

			// Add class for custom metas.
			require_once BYNDER_MEDIA_DIR . '/includes/classes/class-bm-metas.php';

			// Add class for custom metas.
			require_once BYNDER_MEDIA_DIR . 'includes/classes/class-bm-ajax.php';

			// Add class for gutenberg blocks.
			require_once BYNDER_MEDIA_DIR . 'includes/classes/class-bm-blocks.php';
		}

		/**
		 * Add Bynder Setting Page.
		 *
		 * @since 1.0.0
		 */
		public function bm_add_setting_page() {

			$settings_title = 'Bynder Media Settings';

			add_submenu_page(
				'options-general.php',
				__( esc_html( $settings_title ), 'bynder-media' ),
				__( esc_html( $settings_title ), 'bynder-media' ),
				'manage_options',
				'bm_custom_settings',
				array( $this, 'bm_settings_callback' )
			);
		}

		/**
		 * Setting page callback function.
		 *
		 * @since 1.0.0
		 */
		public function bm_settings_callback() {

			$bm_token = filter_input( INPUT_POST, 'bm_token', FILTER_SANITIZE_STRING );
			$bm_domain = filter_input( INPUT_POST, 'bm_domain', FILTER_SANITIZE_STRING );

			if ( isset( $bm_token ) && ! empty( $bm_token ) ) {
				update_option( 'bm_token', $bm_token );
			}
			if ( isset( $bm_domain ) && ! empty( $bm_domain ) ) {
			    // remove http/https
				$bm_domain = str_replace('https', '', $bm_domain );
				$bm_domain = str_replace('http', '', $bm_domain );
				$bm_domain = str_replace('/', '', $bm_domain );
				$bm_domain = str_replace(':', '', $bm_domain );
				update_option( 'bm_domain', $bm_domain );
			}
			?>
            <div class="mp-product-settings">
                <h2>Bynder Media Settings</h2>
                <form class="bm-settings-form" method="post">
                    <table class="form-table" role="presentation">
                        <tr>
                            <th>
                                <label for="bm_domain">Bynder Domain (without http/https):</label>
                            </th>
                            <td>
                                <input type="text" name="bm_domain" id="bm_domain" value="<?php echo esc_attr( get_option( 'bm_domain' ) ); ?>" class="regular-text" required/>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="bm_token">Bynder Permanent Token:</label>
                            </th>
                            <td>
                                <input type="text" name="bm_token" id="bm_token" value="<?php echo esc_attr( get_option( 'bm_token' ) ); ?>" class="regular-text" required/>
                            </td>
                        </tr>
                    </table>
					<?php submit_button( "Save" ); ?>
                </form>
            </div>
			<?php
		}

		/*
		 * Enqueue script and style.
		 *
		 * @since 1.0.0
		 */
		public function bm_enqueue_script() {

			// Add styles.
			wp_enqueue_style( 'bm-style', BYNDER_MEDIA_URL . 'assets/css/bm-style.css', array(), '1.0.0' );

			// Add scripts.
			wp_enqueue_script( 'bm-script', BYNDER_MEDIA_URL . 'assets/js/bm-script.js', array( 'jquery' ), '1.0.0' );
			wp_localize_script( 'bm-script', 'bmObj', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'postid' => get_the_ID(),
			) );
		}
	}
}
