<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit();
}

if ( ! class_exists('Ecommerce_Passes') ) {

    class Ecommerce_Passes {

        public function ep_init_hook() {

            //Action for share login
            add_action( 'init', array( $this, 'ep_nab_share_login' ) );

            //Action for clear share login cookie
            add_action( 'wp_logout', array( $this, 'ep_nab_clear_share_login_cookie' ) );

            //Action for add setting page
            add_action( 'admin_menu', array( $this, 'ep_add_prodcut_setting_page' ) );

            //Filter to restrict the content
            add_filter( 'the_content', array( $this, 'ep_restrict_post_content' ), 9999 );

            //Action for add script and style
            add_action( 'admin_enqueue_scripts', array( $this, 'ep_enqueue_admin_script' ) );

            //Added custom meta box.
            add_action( 'add_meta_boxes', array( $this, 'ep_add_custom_metabox' ) );

            //Save meta box fields.
            add_action( 'save_post', array( $this, 'ep_save_custom_metabox_fields' ) );

	        //add_filter( 'wp_insert_post_data', array( $this, 'my_filter') );
            add_filter( 'wp_insert_post_data' , array( $this, 'ep_filter_post_data') , 99, 2 );

            // Add Class for Zoom.
            $this->ep_add_zoom_class();

            // Global Header Class
            $this->ep_add_global_header_class();

        }
        
        public function ep_nab_share_login() {

            if ( ! is_admin() && ! is_user_logged_in() ) {
                
                if ( isset( $_COOKIE[ 'nab_share_login' ] ) && ! empty( $_COOKIE[ 'nab_share_login' ] ) ) {
                                        
                    $user_token = $_COOKIE[ 'nab_share_login' ];
                    $remember   = 1;
                    
                    $iv         = substr( hash( 'sha256', 'nab309fr7uj34' ), 0, 16 );
                    $k          = hash( 'sha256', 'nabjd874hey64t' );
                    $user_id    = openssl_decrypt( base64_decode( $user_token ), 'AES-256-CBC', $k, 0, $iv );
                    
                    $user       = get_user_by( 'ID', $user_id );

                    if ( $user ) {
                        
                        $username = $user->user_login;

                        wp_set_current_user( $user_id, $username );
                        wp_set_auth_cookie( $user_id, ( $remember == 1 ) );
                        do_action( 'wp_login', $username, $user );
                    }
                    
                }
            }
        }

        public function ep_nab_clear_share_login_cookie() {

            unset( $_COOKIE[ 'nab_share_login' ] );
	        setcookie( 'nab_share_login', null, -1, '/', '.nabshow.com' );
        }

	    public function ep_add_zoom_class(){
            require_once EP_PLUGIN_DIR . 'inc/class-zoom-integration.php';
        }

        public function ep_add_global_header_class() {
            require_once EP_PLUGIN_DIR . 'inc/class-glbal-header.php';
        }

        public function ep_add_prodcut_setting_page() {

            add_submenu_page(
                'options-general.php',
                __('Ecommerce Passes Settings', 'ecommerce-passes'),
                __('Ecommerce Passes Settings', 'ecommerce-passes'),
                'manage_options',
                'ecommerce_passes_settings',
                array( $this, 'ep_product_settings_callback' )
            );
        }

        public function ep_product_settings_callback() {

            $parent_site_url = filter_input( INPUT_POST, 'parent_site_url', FILTER_SANITIZE_STRING );

            if ( isset( $parent_site_url ) && ! empty( $parent_site_url ) ) {
                $parent_site_url = rtrim( $parent_site_url, '/') . '/';
                update_option( 'ep_parent_site_url', $parent_site_url );
            }
            ?>
            <div class="ep-product-settings">
                <h2>Ecommerce Passes Settings</h2>
                <form class="ep-product-setting" method="post">
                    <table class="form-table" role="presentation">
                        <tr>
                            <th>
                                <label for="parent-site-url">Parent Site URL:</label>
                            </th>
                            <td>
                                <input type="text" name="parent_site_url" id="parent-site-url" value="<?php echo esc_attr( get_option( 'ep_parent_site_url' ) ); ?>" class="regular-text" required/>
                            </td>
                        </tr>
                    </table>
                    <?php submit_button("Save Changes"); ?>
                </form>
            </div>
            <?php
        }

        /**
         * Display restricted content if user has not purchased product.
         *
         * @param  string $content
         *
         * @return string
         *
         * @since 1.0.0
         */
        public function ep_restrict_post_content( $content ) {

            global $post;

            if ( isset( $post->ID ) ) {

                $associate_products = get_post_meta( $post->ID, '_associate_product', true );

                if ( ! empty( $associate_products ) && is_array( $associate_products ) ) {

                    $end_point_url  = get_option( 'ep_parent_site_url' );

                    if ( ! is_user_logged_in() ) {

                        $success = false;
                        
                        $end_point_url  .= 'wp-json/nab/request/get-product-info';

                        $response       = wp_remote_post( $end_point_url, array(
                            'method' => 'POST',                            
                            'body'	=> array(
                                'product_id' => $associate_products[0],                                
                            )
                        ) );

                        if ( ! is_wp_error( $response ) ) {
                            
                            $final_response = json_decode( wp_remote_retrieve_body( $response ) );
                            
                            if ( isset( $final_response->url ) && ! empty( $final_response->url ) ) {

                                $success = true;
                                $content = $this->ep_get_restrict_content( $content, $final_response->url, false );    
                            }
                        }

                        if ( ! $success ) {
                            $content = $this->ep_get_restrict_content( $content );
                        }

                    } else {

                        $logged_user    = wp_get_current_user();                        

                        if ( ! empty( $end_point_url ) ) {                            

                            $end_point_url  .= 'wp-json/nab/request/customer-bought-product/';

                            $query_params   = array(
                                'user_email' => $logged_user->user_email,
                                'user_id'	=> $logged_user->ID,
                                'product_ids' => $associate_products
                            );

                            $final_params = http_build_query($query_params);

                            $curl = curl_init();

                            curl_setopt_array( $curl, array(
                                CURLOPT_URL => $end_point_url,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => "",
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => "POST",
                                CURLOPT_POSTFIELDS => $final_params
                            ));
                            
                            $response = curl_exec( $curl );
                            
                            curl_close( $curl );

                            $final_response = json_decode( $response );

                            if ( is_object( $final_response ) ) {                                

                                if ( ! $final_response->success ) {

                                    $content = $this->ep_get_restrict_content( $content, $final_response->url, true );
                                } else {
                                    
                                    if ( preg_match_all('/<!--openAccess-start-->(.*?)<!--openAccess-end-->/s', $content, $matches ) ) {

                                        $content = preg_replace('/<!--openAccess-start-->(.*?)<!--openAccess-end-->/s', '', $content );
                                    }
                                }

                            } else {

                                $content = $this->ep_get_restrict_content( $content );
                            }
                        }
                    }
                }
            }

            return $content;
        }

        /**
         * Display restricted content.
         *
         * @param  string $content
         * @param  string $link
         * @param  boolean $logged_in
         *
         * @return string
         *
         * @since 1.0.0
         */
        public function ep_get_restrict_content( $content, $link = '', $logged_in = false) {

            $prodcut_name       = ! empty( $link ) ? '<a class="amplifyGuestSignIn" target="_blank" href="' . $link . '">this program</a>' : 'this program';            
            $restrict_content   = '<p class="restrict-msg">You must be registered for this program in order to view this content.';

            if ( ! $logged_in ) {
                $restrict_content .= ' If you have already registered, please <a class="amplifyGuestSignIn" href="https://amplify.nabshow.com/my-account/">sign in</a>. If you have not yet registered for this pass, please <a target="_blank" class="amplifyGuestSignIn" href="https://amplify.nabshow.com/sign-up/">click here</a> to register.';
            }            

            if ( preg_match_all('/<!--restrict-start-->(.*?)<!--restrict-end-->/s', $content, $matches ) ) {

                $final_content = preg_replace('/<!--restrict-start-->(.*?)<!--restrict-end-->/s', $restrict_content, $content );

                if ( has_blocks( $final_content ) ) {

                    $ep_content         = parse_blocks( $final_content );
                    $ep_post_content    = $this->ep_serialize_blocks( $ep_content );
                    $restrict_content   = $ep_post_content;

                } else {
                    $restrict_content   = $final_content;
                }
            } else {

                $restrict_content = $content;
            }

            return $restrict_content;
        }

        /**
         * Renders an HTML-serialized form of a list of block objects.
         *
         * @param array $blocks The list of parsed block objects.
         *
         * @return string The HTML-serialized form of the list of blocks.
         *
         * @since 1.0.0
         */
        public function ep_serialize_blocks( $blocks ) {

            return implode( "\n\n", array_map( array( $this, 'ep_serialize_block' ), $blocks ) );
        }

        /**
         * Renders an HTML-serialized form of a block object
         *
         * @param array $block The block being rendered.
         *
         * @return string The HTML-serialized form of the block.
         *
         * @since 1.0.0
         */
        public function ep_serialize_block( $block ) {

            // Non-block content has no block name.
            if ( null === $block['blockName'] ) {
                return $block['innerHTML'];
            }

            $unwanted  = array( '--', '<', '>', '&', '\"' );
            $wanted    = array( '\u002d\u002d', '\u003c', '\u003e', '\u0026', '\u0022' );
            $name      = 0 === strpos( $block['blockName'], 'core/' ) ? substr( $block['blockName'], 5 ) : $block['blockName'];
            $has_attrs = ! empty( $block['attrs'] );
            $attrs     = $has_attrs ? str_replace( $unwanted, $wanted, wp_json_encode( $block['attrs'] ) ) : '';

            // Early abort for void blocks holding no content.
            if ( empty( $block['innerContent'] ) ) {
                return $has_attrs
                    ? "<!-- wp:{$name} {$attrs} /-->"
                    : "<!-- wp:{$name} /-->";
            }

            $output            = $has_attrs
                ? "<!-- wp:{$name} {$attrs} -->\n"
                : "<!-- wp:{$name} -->\n";

            $inner_block_index = 0;

            foreach ( $block['innerContent'] as $chunk ) {
                $output .= null === $chunk
                    ? $this->ep_serialize_block( $block['innerBlocks'][ $inner_block_index ++ ] )
                    : $chunk;
                $output .= "\n";
            }

            $output .= "<!-- /wp:{$name} -->";

            return $output;
        }

        /*
         * Enqueue script and style.
         *
         * @param int $hook Hook suffix for the current admin page.
         *
         * @since 1.0.0
         */
        public static function ep_enqueue_admin_script( $hook ) {


            if ( 'post.php' !== $hook && 'post-new.php' !== $hook ) {
                return;
            }

            $end_point_url = get_option( 'ep_parent_site_url' );

            if ( ! empty( $end_point_url ) ) {
                $end_point_url .= 'wp-json/nab/request/get-product-list/';
            }


            wp_enqueue_style( 'ep-select2-style', plugins_url( 'assets/css/select2.min.css', dirname( __FILE__ ) ) );
            wp_enqueue_script( 'ep-select2-script', plugins_url( 'assets/js/select2.min.js', dirname( __FILE__ ) ));
            wp_enqueue_script( 'ep-custom-admin-script', plugins_url( 'assets/js/ecommerce-passes-admin.js', dirname( __FILE__ ) ), array( 'jquery' ), '1.0' );

            wp_localize_script( 'ep-custom-admin-script', 'ePassesObj', array(
                'product_url'       => $end_point_url
            ) );
        }

        /**
         * Add custom meta box.
         *
         * @since 1.0.0
         */
        public function ep_add_custom_metabox() {

            $all_post_types = get_post_types( array( 'public' => true ) );

            unset( $all_post_types['attachment'] );

            foreach ( $all_post_types as $screen ) {

                // Meta box to add zoom id.
                add_meta_box(
                    'zp_zoom_meta_box',
                    'Enter Zoom Detail',
                    array( $this, 'zp_zoom_id_metabox_callback' ),
                    $screen
                );

                add_meta_box(
                    'ep_product_meta_box',
                    'Associated Products',
                    array( $this, 'ep_custom_metabox_callback' ),
                    $screen
                );
            }
        }

        /**
         * Display zoom metabox content.
         *
         * @param  mixed $post
         *
         * @since 1.0.0
         */
        public function zp_zoom_id_metabox_callback( $post ) {

            $zoom_id = get_post_meta( $post->ID, 'zoom_id', true );
            $zoom_type = get_post_meta( $post->ID, 'zoom_type', true );

            ?>
            <div class="zoom-parent-wrapper">
                <?php

                if ( empty( $zoom_type ) || empty( $zoom_id ) ) {

                    ?>
                    <div class="zoom-box">
                        <p>
                            <label><strong>Select Type:</strong></label>
                        </p>
                        <p>
                            <input type="radio" name="zoom-type[]" id="zoom-meeting" class="zoom-meeting" value="Meeting" />
                            <label for="zoom-meeting">Meeting</label>
                            <input type="radio" name="zoom-type[]" id="zoom-webinar" class="zoom-webinar" value="Webinar" style="margin-left: 20px"/>
                            <label for="zoom-webinar">Webinar</label>
                        </p>

                        <p>
                            <label for="zoom-id">Enter Zoom ID:</label>
                            <input type="text" id="zoom-id" name="zoom-id" class="zoom-id" />
                        </p>
                    </div>
                    <?php

                } else { ?>
                    <div class="zoom-box">
                        <p><label>Meeting Type: <strong><?php echo esc_html( $zoom_type[0] ); ?></strong></label></p>
                        <p><label>Zoom ID: <strong><?php echo esc_html( $zoom_id ); ?></label></strong></p>
                    </div>
                <?php
                }
                ?>
            </div>
            <?php
        }

        /**
         * Display metabox content.
         *
         * @param  mixed $post
         *
         * @since 1.0.0
         */
        public function ep_custom_metabox_callback( $post ) {

            $end_point_url      = get_option( 'ep_parent_site_url' );
            $term_remote_url    = ! empty( $end_point_url ) ? $end_point_url . 'wp-json/nab/request/get-product-categories' : '';
            $product_remote_url = ! empty( $end_point_url ) ? $end_point_url . 'wp-json/nab/request/get-product-list/' : '';
            ?>
            <div class="product-parent-wrapper">
                <?php

                if ( ! empty( $term_remote_url ) ) {

                    $curl = curl_init();
                    
                    curl_setopt_array( $curl, array(
                        CURLOPT_URL => $term_remote_url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                    ));
                    
                    $response = curl_exec( $curl );
                    
                    curl_close( $curl );

                    $final_terms = json_decode( $response );

                    if ( is_array( $final_terms ) && count( $final_terms ) > 0 ) {
                        ?>
                        <div class="category-box">
                            <label for="product-category">Select Category</label>
                            <select id="product-category" class="product-category">
                                <option value="all">All</option>
                                <?php
                                foreach( $final_terms as $product_term ) {
                                    ?>
                                    <option value="<?php echo esc_attr( $product_term->term_id ); ?>"><?php echo esc_html( $product_term->name ); ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <?php
                    }
                }

                if ( ! empty( $product_remote_url ) ) {

                    $curl = curl_init();
                    
                    curl_setopt_array( $curl, array(
                        CURLOPT_URL => $product_remote_url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                    ));
                    
                    $response = curl_exec( $curl );
                    
                    curl_close( $curl );
                    
                    $final_products = json_decode( $response );

                    if ( is_array( $final_products ) && count( $final_products ) > 0 ) {

                        $associate_products = get_post_meta( $post->ID, '_associate_product', true );

                        ?>
                        <div class="product-name-box">
                            <label for="all-product-list">Select Products</label>
                            <select id='all-product-list' class="all-product-list" name="associate_products[]" multiple="multiple">
                                <?php
                                foreach( $final_products as $product ) {

                                    $current_item = '';
                                    if ( ! empty( $associate_products ) && is_array( $associate_products ) && in_array( $product->product_id, $associate_products ) ) {
                                        $current_item = $product->product_id;
                                    }
                                    ?>
                                    <option value="<?php echo esc_attr( $product->product_id ); ?>" <?php selected( $current_item, $product->product_id ); ?>><?php echo esc_html( $product->product_name ); ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <?php
        }

	    /**
         * Remove Unlinked Products.
         *
	     * @param $data
	     * @param $postarr
	     *
	     * @return mixed
	     */
        public function ep_filter_post_data( $data , $postarr ) {

	        $shop_blog_id = $this->ep_get_shop_blog();
	        $current_post_id = $postarr['ID'];

            $current_blog_id = get_current_blog_id();

            $previous_linked = maybe_unserialize( get_post_meta($current_post_id, '_associate_product', true ) );
            $new_linked = $postarr['associate_products'];
            if( ! $new_linked ) {
                $unlinked_products = $previous_linked;
            } else {
                if( is_array( $previous_linked )) {
                    $unlinked_products = array_diff( $previous_linked, $new_linked );
                }
            }

            if( $unlinked_products && 0 !== count( $unlinked_products ) ) {
                $unlinked_products_serial = implode(',', $unlinked_products);

                $url = get_site_url($shop_blog_id, '/wp-json/nab/unlink-products', 'https');

                $response = wp_remote_post($url, array(
                    'method' => 'POST',
                    'body' => array(
                        'unlinked_products' => $unlinked_products_serial,
                        'shop_blog_id' => $shop_blog_id,
                        'current_post_id' => $current_post_id,
                        'current_blog_id' => $current_blog_id
                    )
                ));
            }

            return $data;
        }


        /**
         * Save custom metabox filed.
         *
         * @param int $post_id
         *
         * @since 1.0.0
         */
        public function ep_save_custom_metabox_fields( $post_id ) {
	        $current_blog_id = get_current_blog_id();
            $current_post_id = $post_id;

	        $shop_blog_id = $this->ep_get_shop_blog();

            // Link New Products.
            if ( isset( $_POST[ 'associate_products' ]) && ! empty( $_POST[ 'associate_products' ] ) ) {

	            switch_to_blog($shop_blog_id);

                $associate_products = $_POST['associate_products'];
                foreach( $associate_products as $product_id ) {
                    $associated_content = get_post_meta( $product_id, '_associated_content', true );
	                $associated_content = $associated_content ? $associated_content : array();
	                $associated_content[ $current_blog_id ][ $current_post_id ] = 1;
	                update_post_meta( $product_id, '_associated_content', $associated_content );
                }

	            wp_reset_query();
	            // Quit multisite connection
	            restore_current_blog();

                update_post_meta( $post_id, '_associate_product', $_POST['associate_products'] );
            } else {
                delete_post_meta( $post_id, '_associate_product' );
            }

            // Save zoom details.
            if ( isset( $_POST[ 'zoom-type' ]) && ! empty( $_POST[ 'zoom-type' ] ) ) {
                update_post_meta( $post_id, 'zoom_type', $_POST[ 'zoom-type' ] );
                update_post_meta( $post_id, 'zoom_id', $_POST[ 'zoom-id' ] );
            }
        }

        public static function ep_get_shop_blog() {

            $shop_blog_id = '';

	        // Connect Shop Blog.
	        $sites = get_sites();
            foreach ($sites as $site) {
                $sitepath = $site->path;
                $sitepath = str_replace('/', '', $sitepath);
                $sitedomain = $site->domain;
                if( 'amplify' === $sitepath || false !== strpos( $sitedomain, 'amplify.' ) ) {
                    $shop_blog_id = $site->blog_id;
                    break;
                }
            }

	        // Throw error if shop blog not found.
	        if( empty( $shop_blog_id ) ) {
		        wp_die('Shop blog id not found, please make sure there is a subsite with /amplify/ subdirecotry URL.');
	        }

	        return $shop_blog_id;
        }        
    }
}
