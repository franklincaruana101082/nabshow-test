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

            //Action for add setting page
            add_action( 'admin_menu', array( $this, 'ep_add_prodcut_setting_page' ) );

            //Filter to restrict the content
            add_filter( 'the_content', array( $this, 'ep_restrict_post_content' ), 1 );

            //Action for add script and style
            add_action( 'admin_enqueue_scripts', array( $this, 'ep_enqueue_admin_script' ) );

            //Added custom meta box.
            add_action( 'add_meta_boxes', array( $this, 'ep_add_custom_metabox' ) );

            //Save meta box fields.
            add_action( 'save_post', array( $this, 'ep_save_custom_metabox_fields' ) );
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
                    
                    if ( ! is_user_logged_in() ) {

                        $content = $this->ep_get_restrict_content( $content );

                    } else {
                        
                        $logged_user    = wp_get_current_user();
                        $end_point_url  = get_option( 'ep_parent_site_url' );

                        if ( ! empty( $end_point_url ) ) {
                            
                            $end_point_url  .= 'wp-json/nab/request/customer-bought-product/';

                            $response       = wp_remote_post( $end_point_url, array(
                                'method' => 'POST',                            
                                'body'	=> array(
                                    'user_email' => $logged_user->user_email,
                                    'user_id'	=> $logged_user->ID,
                                    'product_ids' => $associate_products
                                )
                            ) );
    
                            if ( ! is_wp_error( $response ) ) {
    
                                $final_response = json_decode( wp_remote_retrieve_body( $response ) );
    
                                if ( ! $final_response->success ) {
    
                                    $content = $this->ep_get_restrict_content( $content, $final_response->url, $final_response->title );    
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
         * @param  string $text
         * 
         * @return string
         * 
         * @since 1.0.0
         */
        public function ep_get_restrict_content( $content, $link = '', $text = '') {
            
            $prodcut_name       = ! empty( $link ) && ! empty( $text ) ? '<a href="' . $link . '">' . $text . '</a>' : 'this';       
            $restrict_content   = '<p class="restrict-msg">You must have purchase '. $prodcut_name . ' product in order to view full content of the page.</p>';

            if ( preg_match_all('/<!--restrict-start-->(.*?)<!--restrict-end-->/s', $content, $matches ) ) {
                
                $final_content = preg_replace('/<!--restrict-start-->(.*?)<!--restrict-end-->/s', $restrict_content, $content);
                
                if ( has_blocks( $final_content ) ) {
                                        
                    $ep_content         = parse_blocks( $final_content );
                    $ep_post_content    = $this->ep_serialize_blocks( $ep_content );
                    $restrict_content   .= $ep_post_content;

                } else {
                    $restrict_content   .= $final_content;
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
                
                add_meta_box(
                    'ep_product_meta_box',
                    'Associated Products',
                    array( $this, 'ep_custom_metabox_callback' ),
                    $screen
                );
            }            
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
            $term_remote_url    = ! empty( $end_point_url ) ? $end_point_url . 'wp-json/nab/request/get-product-categories/' : '';
            $product_remote_url = ! empty( $end_point_url ) ? $end_point_url . 'wp-json/nab/request/get-product-list/' : '';
            ?>            
            <div class="product-parent-wrapper">
                <?php
                
                if ( ! empty( $term_remote_url ) ) {
                    
                    $term_list = wp_remote_post( $term_remote_url );            

                    if ( ! is_wp_error( $term_list ) ) {
                        
                        $final_terms = json_decode( wp_remote_retrieve_body( $term_list ) );
                        
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
                }
                
                if ( ! empty( $product_remote_url ) ) {
                    
                    $all_products = wp_remote_post( $product_remote_url );

                    if ( ! is_wp_error( $all_products ) ) {
                        
                        $final_products     = json_decode( wp_remote_retrieve_body( $all_products ) );
                        
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
                }                            
                ?>                
            </div>
            <?php
        }
        
        /**
         * Save custom metabox filed.
         *
         * @param int $post_id
         * 
         * @since 1.0.0
         */
        public function ep_save_custom_metabox_fields( $post_id ) {

            if ( isset( $_POST[ 'associate_products' ]) && ! empty( $_POST[ 'associate_products' ] ) ) {
                update_post_meta( $post_id, '_associate_product', $_POST['associate_products'] );
            } else {
                delete_post_meta( $post_id, '_associate_product' );
            }

        }
    }
}