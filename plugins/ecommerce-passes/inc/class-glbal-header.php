<?php
/**
 * Class for Global Header.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Amplify_Global_Header' ) ) {

    class Amplify_Global_Header {

        /**
         * Initialize hooks
         */
        public function __construct() {
            $this->init_hooks();
        }

        /**
         * Defines all hooks
         */
        public function init_hooks() {

            // Customizer settings
            add_action( 'customize_register', array( $this, 'ep_customize_register' ) );

            // Global header shortcode
            add_shortcode( 'nab-global-header', array( $this, 'ep_global_header' ) );

            // Global header action
            add_action( 'nab_global_header', array( $this, 'ep_nab_global_header' ) );

            // Enqueue Styles and Scritps
            add_action( 'wp_enqueue_scripts', array( $this, 'ep_enqueue_required_scripts' ) );

            // Filter to add a custom class to body tag
            add_filter( 'body_class', array( $this, 'ep_body_classes' ) );

            // Shortcode for add to cart button
            add_shortcode( 'nab-add-to-cart', array( $this, 'ep_add_to_cart_btn' ) );

            // Add to cart message popup
            add_action( 'wp_footer', array( $this, 'ep_cart_message_popup' ) );

            // AJAX Actions for add to cart
            add_action( 'wp_ajax_ep_add_cart' , array( $this, 'ep_add_cart_callback' ) );
            add_action( 'wp_ajax_nopriv_ep_add_cart' , array( $this, 'ep_add_cart_callback' ) );
        }

        /**
         * Adds styles and scripts on frontend
         */
        public function ep_enqueue_required_scripts() {

            wp_enqueue_style( 'ep-roboto-mono', 'https://fonts.googleapis.com/css2?family=Roboto+Mono:ital@0;1&display=swap' );
            wp_enqueue_style( 'ep-proxima-nova', 'https://use.typekit.net/iig3loy.css');
            wp_enqueue_style( 'ep-amplify-style', EP_PLUGIN_URL . 'assets/css/ep-amplify.css' );

            wp_enqueue_script( 'ep-add-cart', EP_PLUGIN_URL . 'assets/js/ep-add-to-cart.js', array('jquery'), '1.0.1', true );

            wp_localize_script( 'ep-add-cart', 'epObj', array(
                'isUserLoggedIn'      => is_user_logged_in(),
                'mdLoggedUserId'      => get_current_user_id(),
                'ajaxUrl'             => admin_url( 'admin-ajax.php' ),
                'nabCartKey'          => uniqid(),
                'nabParentAPIUrl'     => get_option( 'ep_parent_site_url', '' ),
                'nabCookieBaseDomain' => EP_COOKIE_BASE_DOMAIN,
                'nabNonce'            => wp_create_nonce('nab-ajax-nonce'),
                'postid'              => get_the_ID(),
            ) );
        }

        /**
         * Creates Customizer option for Global header
         *
         * @param object $wp_customize
         */
        public function ep_customize_register( $wp_customize ) {
            $wp_customize->add_section( 'global_header_settings', array(
                'title'    => __( 'Global Header Settings', 'nabshow-ny' ),
                'priority' => 999,
            ) );

            $wp_customize->add_setting('nab_show_global_menu', array(
                'default'    => false
            ));

            $wp_customize->add_control(
                new WP_Customize_Control(
                    $wp_customize,
                    'nab_show_global_menu',
                    array(
                        'label'     => 'Show Global Menu',
                        'section'   => 'global_header_settings',
                        'settings'  => 'nab_show_global_menu',
                        'type'      => 'checkbox',
                    )
                )
            );
        }

        /**
         * Header HTML
         *
         * @return string
         */
        public function ep_global_header() {
            ob_start();
            ?>

            <div class="nab-header-secondary">
                <div class="container">
                    <div class="nab-header-inner">
                        <div class="nab-head-mobile">
                            <div class="nab-mobile-toggle">
                                <div class="nab-mobile-icon"></div>
                            </div>
                        </div>
                        <div class="nab-nav-wrap">
                            <nav class="nab-left-navigation">
                                <?php
                                $header_logos = $this->ep_get_header_logos();
                                if( ! empty( $header_logos ) ) { ?>
                                    <ul class="nab-navigation-menu">
                                    <?php foreach( $header_logos as $logo ) { ?>
                                        <li>
                                            <a href="<?php echo esc_url( $logo['url'] ); ?>"><?php echo esc_html($logo['site_label']); ?></a>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                <?php } ?>
                            </nav>
                            <?php
                            $parent_url = get_option( 'ep_parent_site_url' );
                            $cart_url   = ( ! empty( $parent_url ) ) ? trailingslashit( $parent_url ) . 'cart/' : '#';
                            $my_account = ( ! empty( $parent_url ) ) ? trailingslashit( $parent_url ) . 'my-account/' : '#';
                            $sign_up = ( ! empty( $parent_url ) ) ? trailingslashit( $parent_url ) . 'sign-up/' : '#';

                            $current_site_id = get_current_blog_id();
                            ?>

                            <nav class="nab-sec-navigation">
                                <!-- <div class="nab-header-cart">
                                    <a href="<?php // echo esc_url( $cart_url ); ?>"><i class="fa fa-shopping-cart"></i>Cart</a>
                                    <span class="nab-cart-count "><?php // echo $this->ep_get_cart(); ?></span>
                                </div> -->
                                <div class="nab-profile-menu">
                                <?php
                                        if($current_site_id != 4) {
                                            if ( is_user_logged_in() ) {
                                            $current_user    = wp_get_current_user();
                                            $user_images     	= $this->ep_get_user_images( $current_user->ID );
                                            $user_thumb      	= isset( $user_images['profile_picture'] ) ? $user_images['profile_picture'] : get_avatar_url( $current_user->ID );
                                            $edit_my_profile = ( ! empty( $parent_url ) ) ? $my_account . 'edit-my-profile/' : '#';
                                            ?>
                                            <ul class="nab-profile nab-logged-in">
                                                <li>
                                                    <a href="<?php echo esc_url( $edit_my_profile ); ?>">
                                                        <div class="nab-avatar-wrp">
                                                            <div class="nab-avatar"><img src="<?php echo esc_url( $user_thumb ); ?>"></div>
                                                            <span class="nab-profile-name"><?php echo $current_user->display_name; ?></span>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        <?php } else { ?>
                                            <ul class="nab-profile">
                                                <li>
                                                    <a class="amplifySignUp" href="<?php echo esc_url( $sign_up ); ?>"><?php esc_html_e( 'Sign Up', 'nab-amplify' ); ?></a>
                                                </li>
                                                <li>
                                                    <a class="amplifyGuestSignIn" href="<?php echo esc_url( $my_account ); ?>"><?php esc_html_e( 'Sign In', 'nab-amplify' ); ?></a>
                                                </li>
                                            </ul>
                                        <?php
                                            }
                                        } 
                                ?>
                                </div>
                            </nav><!-- #site-navigation -->
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $global_header_html = ob_get_clean();

            return $global_header_html;
        }

        /**
         * Add global header
         */
        public function ep_nab_global_header() {

            echo do_shortcode( '[nab-global-header]' );
        }

        /**
         * Returns the global header logos added in Amplify
         *
         * @return array|string
         */
        public function ep_get_header_logos() {

            $api_base_url = get_option( 'ep_parent_site_url' );

            if( empty( $api_base_url ) ) {
              return '';
            }

            $logos = get_transient( 'amplify_header_logos' );

            if( false === $logos || is_user_logged_in() ) {
                $api_url          = $api_base_url . 'wp-json/nab/request/get-header-logos';
                $get_header_logos = wp_remote_get( $api_url );
                $response         = wp_remote_retrieve_body( $get_header_logos );

                if( isset( $response ) && ! empty( $response ) ) {
                  $logos = json_decode( $response, true );
                  set_transient( 'amplify_header_logos', $logos, 1 * DAY_IN_SECONDS );
                } else {
                  return '';
                }
            }

            // get current site url
            $site_url = home_url('/');

            $sorted_logos = [];
            foreach( $logos as $key => $value ) {
                if( $site_url === trailingslashit( $value['url'] )  ) {
                  array_unshift( $sorted_logos, $value );
                } else {
                  array_push( $sorted_logos, $value );
                }
            }

            return $sorted_logos;

        }

        /**
         * Returns the global header logos added in Amplify
         *
         * @return array|string
         */
	    public function ep_get_user_images( $user_id ) {

            $api_base_url = get_option( 'ep_parent_site_url' );

            if( empty( $api_base_url ) ) {
              return '';
            }

            $api_url         = $api_base_url . 'wp-json/nab/request/get-user-images?user_id=' . $user_id;
            $get_user_images = wp_remote_get( $api_url );
            $response        = wp_remote_retrieve_body( $get_user_images );

            if( isset( $response ) && ! empty( $response ) ) {
              $user_images = json_decode( $response, true );
            } else {
              return '';
            }

            return $user_images;
        }

        /**
         * Gets the cart quanity
         *
         * @return int
         */
        public function ep_get_cart() {
            $cart_qty = 0;

            $nab_parent_site_api_url = get_option( 'ep_parent_site_url' );

            if( ! empty( $nab_parent_site_api_url ) ) {
                if ( is_user_logged_in() ) {
                    $user_id = get_current_user_id();
                    $token   = get_user_meta( $user_id, 'nab_jwt_token', true );

                    if ( ! empty( $token ) ) {
                        $api_url  = $nab_parent_site_api_url . 'wp-json/wc/store/cart';
                        $args     = array(
                            'headers' => array(
                                'Authorization' => 'Bearer ' . $token,
                            ),
                        );
                        $response = wp_remote_get( $api_url, $args );

                        if ( 200 === wp_remote_retrieve_response_code( $response ) ) {
                            $body     = json_decode( wp_remote_retrieve_body( $response ), true );
                            $cart_qty = $body['items_count'];
                        }
                    }

                } else {
                    if ( isset( $_COOKIE['nabCartKey'] ) && ! empty( $_COOKIE['nabCartKey'] ) ) {
                        $cart_key = $_COOKIE['nabCartKey'];

                        $api_url  = add_query_arg( 'cart_key', $cart_key, $nab_parent_site_api_url . 'wp-json/cocart/v1/count-items' );
                        $response = wp_remote_get( $api_url );

                        if ( 200 === wp_remote_retrieve_response_code( $response ) ) {
                            $cart_qty = wp_remote_retrieve_body( $response );
                        }
                    }
                }
            }

            return $cart_qty;
        }

        /**
         * Body Classes
         *
         * @param array $classes
         *
         * @return array
         */
        public function ep_body_classes( $classes ) {

            // check if show global menu option is selected
            $amplify_global_menu = get_theme_mod( 'nab_show_global_menu' );

            if( isset( $amplify_global_menu ) && true === $amplify_global_menu ) {
                $classes[] = 'show_sec_menu';
            }

            return $classes;
        }

        /**
         * Add to cart button shortcode
         *
         * @param array $atts
         *
         * @return string
         */
        public function ep_add_to_cart_btn( $atts ) {

            // Return if no product id is passed
            if( ! isset( $atts['product_id'] ) || empty( $atts['product_id'] ) ) {
                return '';
            }

            $product_id = $atts['product_id'];
            $btn_text   = ( isset( $atts['label'] ) && ! empty( $atts['label'] ) ) ? $atts['label'] : 'Get Pass';

            ob_start();
            ?>
            <div class="wp-block-buttons">
                <div class="wp-block-button is-style-fill purple-plain">
                    <a class="wp-block-button__link has-background no-border-radius nabCustomAddCart" href="javascript:void(0)" style="background-color:#ab3e97" data-pid="<?php echo esc_attr( $product_id ); ?>"><?php echo esc_html( $btn_text ); ?></a>
                </div>
            </div>
            <?php
            $add_to_cart_btn = ob_get_clean();

            return $add_to_cart_btn;
        }

        /**
         * Popup for cart message
         *
         * @return string
         */
        public function ep_cart_message_popup() {
            ?>
            <div class="nab-cart-message-popup">
                <div class="nab-cart-message"></div>
            </div>
        <?php
        }

        /**
         * AJAX Callback for Add To Cart
         *
         * @return string
         */
        public function ep_add_cart_callback() {
            $product_id = filter_input( INPUT_POST, 'product_id' );
            $cart_key   = filter_input( INPUT_POST, 'cart_key' );
            $nab_nonce 	= filter_input( INPUT_POST, 'nabNonce', FILTER_SANITIZE_STRING );

            $args = [];
            $res  = [];

            //verify nonce
            if ( ! isset( $nab_nonce ) || false === wp_verify_nonce( $nab_nonce, 'nab-ajax-nonce' ) ) {

                $res[ 'err' ]     	= 1;
                $res[ 'message' ]	= 'Authentication failed. Please reload the page and try again.';

                wp_send_json( $res, 200 );
            }

            if( empty( $product_id ) ) {
                $res['err'] = 1;
                $res['message'] = 'Product id not found';

                wp_send_json( $res, 200 );
            }

            $api_base_url = get_option( 'ep_parent_site_url' );

            if( empty( $api_base_url ) ) {
                $res['err'] = 1;
                $res['message'] = 'Parent site URL not found!';

                wp_send_json( $res, 200 );
            }

            $api_url = $api_base_url . 'wp-json/cocart/v1/add-item/';

            if( is_user_logged_in() ) {

                $user_id    = get_current_user_id();

                $user_token = get_user_meta( $user_id, 'nab_jwt_token', true );

                if( empty( $user_token ) ) {
                    $res['err'] = 1;
                    $res['message'] = 'User token missing! Please sign out and sign in again.';

                    wp_send_json( $res, 200 );
                }

                $bearer = 'Bearer ' . $user_token;
                $headers = array(
                    'Accept: application/json',
                    'Content-Type: application/json',
                    'Authorization: ' . $bearer,
                );

                $api_url = add_query_arg( 'return_cart', 'true', $api_url );

            } else {

                if( empty( $cart_key ) ) {
                    $res['err'] = 1;
                    $res['message'] = 'Cart key missing! Please try again.';

                    wp_send_json( $res, 200 );
                }

                $headers = array(
                    'Accept: application/json',
                    'Content-Type: application/json',
                );

                $api_url = add_query_arg( array(
                    'cart_key'    => $cart_key,
                    'return_cart' => 'true',
                ), $api_url );

            }

            $curl = curl_init();

            $args = json_encode(array(
                'product_id' => $product_id,
                'quantity' => 1
            ));

            curl_setopt_array( $curl, array(
                CURLOPT_URL => $api_url,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $args,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTPHEADER => $headers
            ) );

            $response = curl_exec($curl);

            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);

            if( 200 === $httpcode ) {
                $res['err'] = 0;
                $res['body'] = json_decode( $response, true );
            } else {
                $res['err'] = 1;
                $res['requested_url'] = $api_url;
                $response_body = json_decode( $response, true );
                $res['message'] = ( isset( $response_body['message'] ) && ! empty( $response_body['message'] ) ) ? $response_body['message'] : 'Something went wrong. Please try again!';
            }

            wp_send_json( $res, 200 );
        }

    }

    new Amplify_Global_Header();

}
