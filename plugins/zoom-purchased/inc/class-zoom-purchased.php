<?php
/**
 * Main Plugin Class File.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists('Zoom_Purchased') ) {

	class Zoom_Purchased {

        /**
         * Main Ignition Hook.
         */
        public function zp_init_hook() {

                // Action for add setting page
                add_action( 'admin_menu', array( $this, 'zp_add_setting_page' ) );

                // Action to add script and style in admin area.
                add_action( 'admin_enqueue_scripts', array( $this, 'zp_enqueue_admin_script' ) );

                // Action to add script and style in front area.
                add_action( 'wp_enqueue_scripts', array( $this, 'zp_enqueue_script' ) );

                // Add Zoom API Class
                $this->zp_zoom_apis();

		}

        /**
         * Add Setting Page.
         *
         * @since 1.0.0
         */
        public function zp_add_setting_page() {

            $settings_title = 'Zoom Purchased Settings';

            add_submenu_page(
                'options-general.php',
                __( esc_html( $settings_title ) , 'zoom-purchased'),
                __( esc_html( $settings_title ) , 'zoom-purchased'),
                'manage_options',
                'zoom_purchased_settings',
                array( $this, 'zp_settings_callback' )
            );
        }

        /**
         * Zoom Pruchased setting page callback function.
         *
         * @since 1.0.0
         */
        public function zp_settings_callback() {

            $jwt_token_field = filter_input( INPUT_POST, 'zp_token_key', FILTER_SANITIZE_STRING );

            if ( isset( $jwt_token_field ) && ! empty( $jwt_token_field ) ) {
                update_option( 'zp_token_key', $jwt_token_field );

                ?>
                <div class="notice notice-success is-dismissible">
                    <p><?php _e( 'Saved!', 'zoom-purchased' ); ?></p>
                </div>
                <?php
            }
            ?>
            <div class="zp-product-settings">
                <h2>Zoom Purchased Settings</h2>
                <form class="zp-settings-form" method="post">
                    <table class="form-table" role="presentation">
                        <tr>
                            <th>
                                <label for="zp_token_key">Enter JWT App Token:</label>
                            </th>
                            <td>
                                <input type="text" name="zp_token_key" id="zp_token_key" value="<?php echo esc_attr( get_option( 'zp_token_key' ) ); ?>" class="regular-text" required/>
                            </td>
                        </tr>
                    </table>
                    <?php submit_button("Save Changes"); ?>
                </form>
            </div>
            <?php
        }


        /*
         * Enqueue script and style at back end side.
         *
         * @param int $hook Hook suffix for the current admin page.
         *
         * @since 1.0.0
        */
        public function zp_enqueue_admin_script( $hook ) {

            // Enable only for..
            if ( 'settings_page_zoom_purchased_settings' !== $hook ) {
                return;
            }

            // Add styles.
            wp_enqueue_style( 'zp-admin-style', ZP_PLUGIN_URL . 'assets/css/zp-admin-style.css', array(), '1.0.0' );

            // Add scripts.
            wp_enqueue_script( 'zp-admin-script', ZP_PLUGIN_URL . 'assets/js/zp-admin-script.js', array( 'jquery' ), '1.0.0' );
            wp_localize_script( 'zp-admin-script', 'zpAdminObj', array(
                'admin_ajax'       => admin_url( 'admin-ajax.php' )
            ) );
        }

        /*
         * Enqueue script and style at front side.
         *
         * @param int $hook Hook suffix for the current admin page.
         *
         * @since 1.0.0
         */
        public function zp_enqueue_script( ) {

            // Add styles.
            wp_enqueue_style( 'zp-style', ZP_PLUGIN_URL . 'assets/css/zp-style.css', array(), '1.0.0' );

            // Add scripts.
            wp_enqueue_script( 'zp-script', ZP_PLUGIN_URL . 'assets/js/zp-style.js', array( 'jquery' ), '1.0.0' );
            wp_localize_script( 'zp-script', 'zpObj', array(
                'admin_ajax'       => admin_url( 'admin-ajax.php' )
            ) );
        }

        public function zp_zoom_apis() {

            require_once ZP_PLUGIN_DIR . 'inc/class-zoom-apis.php';

        }
	}
}