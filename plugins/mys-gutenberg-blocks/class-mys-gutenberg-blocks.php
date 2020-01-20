<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit();
}

if ( ! class_exists('MYSGutenbergBlocks') ) {

    class MYSGutenbergBlocks {

        /**
         * Use for load date picker js
         * @var boolean
         */
        private $date_picker = false;

        /**
         * Initializes WP hooks and filter
         *
         * @since 1.0.0
         */
        public function mysgb_init_hook() {

            // Filter for register new categories for custom block
            add_filter( 'block_categories', array( $this, 'mysgb_custom_block_category' ), 10, 2 );

            // Filter for add custom where
            add_filter( 'posts_where', array( $this, 'mysgb_set_content_custom_posts_where' ), 10, 2 );

            // Register new rest route to fetch all terms
            add_action( 'rest_api_init', array( $this, 'mysgb_register_api_endpoints' ) );

            //Action for add gutenberg custom block
            add_action( 'enqueue_block_editor_assets', array( $this, 'mysgb_add_block_editor_script' ) );

            // Action to register all dynamic blocks
            add_action( 'init', array( $this, 'mysgb_register_dynamic_blocks' ) );

            // Action to Enqueue script and style
            add_action( 'wp_enqueue_scripts', array( $this, 'mysgb_enqueue_front_script' ), 999 );

            add_action( 'after_setup_theme', array( $this, 'mysgb_add_required_image_size' ) );
        }

        public function mysgb_add_required_image_size() {
	        add_image_size( 'dynamic-slide', 275, 165 );
        }


        /**
         * Register new category for MYS custom block
         *
         * @param array $categories
         *
         * @return array
         * @since 1.0.0
         */
        public static function mysgb_custom_block_category( $categories ) {

            $categories = array_merge(
                    array(
                        array(
                            'slug'  => 'mysgb',
                            'title' => __( 'MYS Blocks', 'mys-gutenberg-blocks' ),
                        ),
                    ),
                    $categories
                );

            return $categories;
        }

        /**
         * Added content_with parameter in post where
         *
         * @param $where
         * @param $query
         *
         * @return string
         * @since 1.0.0
         */
        public static function mysgb_set_content_custom_posts_where( $where, $query ) {

            global $wpdb;

            $content_with = $query->get( 'content_with' );

            if ( $content_with ) {
                $where .= " AND trim( coalesce( $wpdb->posts.post_content , '' ) ) <> ''";
            }

            if ( strpos( $where, 'destination_type_$' ) > -1 ) {

	            $where = str_replace("meta_key = 'destination_type_$", "meta_key LIKE 'destination_type_%", $where );
            }

            return $where;
        }

        /**
         * Register custom api endpoints to fetch all terms & Sponsors Types
         *
         * @since 1.0.0
         */
        public static function mysgb_register_api_endpoints() {

            register_rest_route( 'nab_api', '/request/all_terms', array(
                'methods'  => 'GET',
                'callback' => array( __CLASS__, 'mysgb_get_all_terms' ),
            ) );

	        register_rest_route( 'nab_api', '/request/sponsor-acf-types', array(
		        'methods'  => 'GET',
		        'callback' => array( __CLASS__, 'mysgb_get_sponsor_acf_types' ),
	        ) );
        }

        /**
         * Get all terms according to taxonomy
         *
         * @return WP_REST_Response
         * @since 1.0.0
         */
        public static function mysgb_get_all_terms() {

            $return = array();

            //get all terms
            $terms = get_terms();

            //arrange term according to taxonomy
            foreach ( $terms as $term ) {

                $return[ $term->taxonomy ][] = array( "term_id" => $term->term_id, "name" => $term->name, "slug" => $term->slug );
            }

            //set response into the cache
            set_transient( 'mysgb-get-all-terms-cache', $return, 60 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );

            return new WP_REST_Response( $return, 200 );

        }

	    /**
	     * Get all terms according to taxonomy
	     *
	     * @return WP_REST_Response
	     * @since 1.0.0
	     */
	    public static function mysgb_get_sponsor_acf_types() {


		    $sponsors_destination = array();

		    $acf_fields = get_field_object( 'field_5e09d6ef21e49' );

		    if ( isset( $acf_fields[ 'choices' ] ) && is_array( $acf_fields[ 'choices' ] ) ) {

			    $cnt = 0;

			    foreach ( $acf_fields[ 'choices' ] as $field_val => $field_label ) {

				    $sponsors_destination[ $cnt ][ 'label' ] = $field_label;
				    $sponsors_destination[ $cnt ][ 'value' ] = $field_val;
				    $cnt++;
			    }

		    }

		    return new WP_REST_Response( $sponsors_destination, 200 );

	    }

        /*
         * Enqueue gutenberg custom block script
         *
         * @since 1.0.0
         */
        public static function mysgb_add_block_editor_script() {

            wp_enqueue_script( 'mysgb-gutenberg-block', plugins_url( 'assets/js/blocks/block.build.js', __FILE__ ), array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components', 'jquery' ), '2.5' );

            if ( 'nabshow-lv' !== get_option( 'stylesheet' ) ) {

                wp_enqueue_script( 'mysgb-bx-slider',  plugins_url( 'assets/js/jquery.bxslider.min.js', __FILE__ ), array( 'jquery' ), null, true );

	            wp_enqueue_style( 'mysgb-bxslider-style', plugin_dir_url( __FILE__ ) . 'assets/css/jquery.bxslider.css' );
                wp_enqueue_style( 'mysgb-blocks-style', plugin_dir_url( __FILE__ ) . 'assets/css/mysgb-blocks-admin.css' );

            }
        }

        /*
         * Enqueue gutenberg custom block script and style for front side
         *
         * @since 1.0.0
         */
        public function mysgb_enqueue_front_script() {

            if ( $this->date_picker ) {
                wp_enqueue_script( 'jquery-ui-datepicker' );
	            wp_enqueue_style('jquery-ui', plugin_dir_url(__FILE__) . 'assets/css/jquery-ui.min.css', array(), false );
            }

            if ( 'nabshow-lv' !== get_option( 'stylesheet' ) ) {

	            if ( ! wp_script_is( 'bootstrap' ) && ! wp_script_is( 'bootstrap-js' ) ) {
		            wp_enqueue_script( 'bootstrap-modal', plugins_url( 'assets/js/modal.min.js', __FILE__ ), array( 'jquery' ), null, true );
	            }

                wp_enqueue_script( 'mysgb-blocks-script', plugins_url( 'assets/js/mysgb-blocks.js', __FILE__ ), array( 'jquery' ), null, true );
                wp_enqueue_script( 'mysgb-bx-slider',  plugins_url( 'assets/js/jquery.bxslider.min.js', __FILE__ ), array( 'jquery' ), null, true );

	            wp_localize_script( 'mysgb-blocks-script', 'mysGbCustom', array(
                        'ajax_url'                  => admin_url( 'admin-ajax.php' ),
                        'mysgb_browse_filter_nonce' => wp_create_nonce( 'browse_filter_nonce' ),
	            ) );

	            if ( ! wp_style_is( 'bootstrap' ) && ! wp_style_is( 'bootstrap-css' ) ) {
		            wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'assets/css/bootstrap.min.css' );
                }

                wp_enqueue_style( 'mysgb-blocks-style', plugin_dir_url( __FILE__ ) . 'assets/css/mysgb-blocks.css' );
                wp_enqueue_style( 'mysgb-bxslider-style', plugin_dir_url( __FILE__ ) . 'assets/css/jquery.bxslider.css' );
            }
        }

        /**
         * Register all dynamic blocks
         *
         * @since 1.0.0
         */
        public function mysgb_register_dynamic_blocks() {

            require_once( plugin_dir_path( __FILE__ ) . 'includes/mysgb-register-block.php' );
        }

        /**
         * Fetch dynamic slider slide according to block attributes
         *
         * @param $attributes
         *
         * @return string
         * @since 1.0.0
         */
        public function mysgb_dynamic_slider_render_callback( $attributes ) {

            ob_start();

	        include( plugin_dir_path( __FILE__ ) . 'includes/mysgb-dynamic-slider-callback.php' );

            $html = ob_get_clean();

            return $html;

        }

        /**
         * Fetch dynamic session slider item/slide according to attributes
         *
         * @param $attributes
         *
         * @return string
         * @since 1.0.0
         */
        public function mysgb_session_slider_render_callback( $attributes ) {

            ob_start();

	        include( plugin_dir_path( __FILE__ ) . 'includes/mysgb-session-slider-callback.php' );

            $html = ob_get_clean();

            return $html;

        }

        /**
         * Fetch dynamic Exhibitors slider item/slide according to attributes
         *
         * @param $attributes
         *
         * @return string
         * @since 1.0.0
         */
        public function mysgb_exhibitors_slider_render_callback( $attributes ) {

            ob_start();

            include( plugin_dir_path( __FILE__ ) . 'includes/mysgb-exhibitor-slider-callback.php' );

            $html = ob_get_clean();

            return $html;

        }

        /**
         * Fetch dynamic speaker slider item/slide according to block attributes
         *
         * @param $attributes
         *
         * @return string
         * @since 1.0.0
         */
        public function mysgb_speaker_slider_render_callback( $attributes ) {

            ob_start();

            include( plugin_dir_path( __FILE__ ) . 'includes/mysgb-speaker-slider-callback.php' );

            $html = ob_get_clean();

            return $html;

        }

        /**
         * Fetch dynamic sponsors and partner according to block attributes
         *
         * @param $attributes
         *
         * @return string
         * @since 1.0.0
         */
        public function mysgb_sponsors_partners_render_callback( $attributes ) {

            ob_start();

	        include( plugin_dir_path( __FILE__ ) . 'includes/mysgb-sponsor-partner-callback.php' );

            $html = ob_get_clean();

            return $html;

        }

        /**
         * Fetch dynamic product winner according to block attributes
         *
         * @param $attributes
         *
         * @return string
         * @since 1.0.0
         */
        public function mysgb_product_winner_render_callback( $attributes ) {

            ob_start();

	        include( plugin_dir_path( __FILE__ ) . 'includes/mysgb-product-winner-callback.php' );

            $html = ob_get_clean();

            return $html;

        }

        /**
         * Fetch sessions tracks or exhibitor category according to block attributes
         *
         * @param $attributes
         *
         * @return string
         * @since 1.0.0
         */
        public function mysgb_category_slider_render_callback( $attributes ) {

            ob_start();

	        include( plugin_dir_path( __FILE__ ) . 'includes/mysgb-category-slider-callback.php' );

            $html = ob_get_clean();

            return $html;

        }

        /**
         * Fetch product post type categories according to block attributes
         *
         * @param $attributes
         *
         * @return string
         * @since 1.0.0
         */
        public function mysgb_product_categories_render_callback( $attributes ) {

            ob_start();

	        include( plugin_dir_path( __FILE__ ) . 'includes/mysgb-product-categories-callback.php' );

            $html = ob_get_clean();

            return $html;

        }

        /**
         * Fetch dynamic product item/slide according to block attributes.
         *
         * @param $attributes
         *
         * @return string
         *
         * @since 1.0.0
         */
        public function mysgb_product_slider_render_callback( $attributes ) {

	        ob_start();

	        include( plugin_dir_path( __FILE__ ) . 'includes/mysgb-product-slider-callback.php' );

	        $html = ob_get_clean();

	        return $html;

        }

        /**
         * Fire on plugin activation and check the MYS Modules plugin is active or not.
         *
         * @since 1.0.0
         */
        public static function mysgb_plugin_activation() {

            if ( ! is_plugin_active( 'mys-modules/mys-modules.php' ) ) {

                deactivate_plugins( plugin_basename( __FILE__ ) );

                $error_msg = sprintf( 'This plugin required Map Your Show Modules plugin to work correctly. <a href="%s">Return</a>', admin_url( 'plugins.php' ) );
                $element_array = array( 'a' => array( 'href' => array() ) );
                wp_die( wp_kses( $error_msg, $element_array ));
            }
        }

	    /**
         * Return the default placeholder image when speaker have not featured image.
         *
	     * @return string
         *
         * @since 1.0.0
	     */
        public function mysgb_get_speaker_thumbnail_url() {

            return plugins_url( 'assets/images/speaker-placeholder.png', __FILE__ );
        }

        /**
         * Get mys show code.
         *
         * @return string
         *
         * @since 1.0.0
         */
        public function mysgb_get_mys_show_code() {

            $nab_mys_urls = get_option( 'nab_mys_urls' );
            $show_code    = isset( $nab_mys_urls[ 'show_code' ] ) ? $nab_mys_urls[ 'show_code' ] : '';
            return $show_code;
        }

	    /**
         * Return pipe separated term list from given terms array.
         *
	     * @param array $terms
	     * @param string $type
	     *
	     * @return string
         *
         * @since 1.0.0
	     */
        public function mysgb_get_pipe_separated_term_list ( $terms = array(), $type = 'name' ) {

            $all_terms = array();

            if ( $terms && ! is_wp_error( $terms ) ) {

                foreach ( $terms as $term ) {
                    $all_terms[] = $term->{$type};
                }

            }

            return implode( ' | ', $all_terms );
        }

	    /**
         * Generate cache key according to taxonomies and terms.
         *
	     * @param $taxonomies
	     * @param $terms
	     *
	     * @return string
         *
         * @since 1.0.0
	     */
        public function mysgb_get_taxonomy_term_cache_key( $taxonomies, $terms ) {

            $cache_key = '';

            if ( is_array( $taxonomies ) && ! empty( $taxonomies ) ) {

                foreach ( $taxonomies as $taxonomy ) {

                    if ( isset($terms->{$taxonomy}) && count($terms->{$taxonomy}) > 0 ) {
                        $cache_key .= $taxonomy . '-' . implode('-', $terms->{$taxonomy} );
                    }
                }
            }

            return $cache_key;

        }

	    /**
         * Prepare tax_query argument according to given taxonomies and terms.
         *
	     * @param $taxonomies
	     * @param $terms
	     * @param string $taxonomy_relation
	     *
	     * @return array
         *
         * @since 1.0.0
	     */
        public function mysgb_get_tax_query_argument( $taxonomies, $terms, $taxonomy_relation = 'OR' ) {

            $tax_query_args = array( 'relation' => $taxonomy_relation );

            if ( is_array( $taxonomies ) && ! empty( $taxonomies ) ) {

                foreach ( $taxonomies as $taxonomy ) {

                    if ( isset($terms->{$taxonomy}) && count($terms->{$taxonomy}) > 0 ) {
                        $tax_query_args[] = array (
                            'taxonomy' => $taxonomy,
                            'field'    => 'slug',
                            'terms'    => $terms->{$taxonomy},
                        );
                    }
                }
            }

            return $tax_query_args;

        }

	    /**
         * Prepare common slider attributes.
         *
	     * @param int $min_slides
	     *
	     * @return array
         *
         * @since 1.0.0
	     */
        public function mysgb_get_common_slider_attributes( $min_slides = 4 ) {

            $slider_attributes = array(
                        'sliderActive' => array(
                            'type'    => 'boolean',
                            'default' => true
                        ),
                        'minSlides'    => array(
                            'type'    => 'number',
                            'default' => $min_slides
                        ),
                        'autoplay'     => array(
                            'type'    => 'boolean',
                            'default' => false
                        ),
                        'infiniteLoop' => array(
                            'type'    => 'boolean',
                            'default' => true
                        ),
                        'pager'        => array(
                            'type'    => 'boolean',
                            'default' => false
                        ),
                        'controls'     => array(
                            'type'    => 'boolean',
                            'default' => true
                        ),
                        'sliderSpeed'  => array(
                            'type'    => 'number',
                            'default' => 500
                        ),
                        'slideWidth'   => array(
                            'type'    => 'number',
                            'default' => 400
                        ),
                        'slideMargin'  => array(
                            'type'    => 'number',
                            'default' => 30
                        ),
                        'arrowIcons' => array(
                            'type' => 'string',
                            'default' => 'slider-arrow-1'
                        )
                );
           return $slider_attributes;
        }

	    /**
	     * Generate popup link for session, speaker and exhibitor.
         *
	     * @param $post_id
	     * @param $post_type
	     * @param string $display_text
	     * @param string $class_name
         *
         * @since 1.0.0
	     */
        public function mysgb_generate_popup_link( $post_id, $post_type, $display_text = '', $class_name = '') {

            ?>
            <a href="#" class="detail-list-modal-popup <?php echo esc_attr( $class_name ); ?>" data-postid="<?php echo esc_attr( $post_id ); ?>" data-posttype="<?php echo esc_attr( $post_type ); ?>"> <?php echo esc_html( $display_text ); ?></a>
            <?php
        }

	    /**
	     * Create drop-down options for given taxonomy terms.
	     *
	     * @param string $taxonomy
	     * @param string $pre_selected
	     *
	     * @since 1.0.0
	     */
        public function mysgb_get_term_list_options( $taxonomy = '', $pre_selected = '' ) {

            if ( ! empty( $taxonomy ) ) {

                $all_terms = get_terms( array(
                    'taxonomy' => $taxonomy,
                    'hide_empty' => true,
                ) );

                if ( is_array( $all_terms ) && ! is_wp_error( $all_terms ) ) {

                    foreach ( $all_terms as $term ) {

                    	if ( ! empty( $pre_selected ) ) {
                            ?>
	                        <option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $term->slug, $pre_selected ); ?>><?php echo esc_html( $term->name ); ?></option>
		                    <?php
	                    } else {
		                    ?>
		                    <option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></option>
		                    <?php
	                    }
                    }
                }
            }
        }

	    /**
	     * Fetch sponsor type according destination and sponsor id
	     *
	     * @param $destination_type
	     * @param $current_post_ID
	     *
	     * @return string
	     *
	     * @since 1.0.0
	     */
        public function mysgb_get_sponsor_type( $destination_type, $current_post_ID ) {

	        $sponsor_type = '';

	        if ( ! empty( $destination_type ) ) {

		        $destination_field_types = get_field( 'destination_type', $current_post_ID );

		        if ( is_array( $destination_field_types ) && count( $destination_field_types ) > 0 ) {

			        foreach ( $destination_field_types as $field_type ) {

				        if ( isset( $field_type[ 'destination' ] ) && $destination_type === $field_type[ 'destination' ] ) {

					        $sponsor_type =	$field_type[ 'sponsor_type' ];
					        break;
				        }
			        }
		        }

	        } else {

		        $all_sponsor_type = get_the_terms( $current_post_ID, 'sponsor-types' );
		        $sponsor_type     = $this->mysgb_get_pipe_separated_term_list( $all_sponsor_type );
	        }

	        return $sponsor_type;
        }
    }
}
