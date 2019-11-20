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

            return $where;
        }

        /**
         * Register custom api endpoints to fetch all terms
         * @since 1.0.0
         */
        public static function mysgb_register_api_endpoints() {
            register_rest_route( 'nab_api', '/request/all_terms', array(
                'methods'  => 'GET',
                'callback' => array( __CLASS__, 'mysgb_get_all_terms' ),
            ) );
        }

        /**
         * Get all terms according to taxonomy
         * @return WP_REST_Response
         * @since 1.0.0
         */
        public static function mysgb_get_all_terms()
        {
            //get data from the cache
            $response = get_transient( 'mysgb-get-all-terms-cache' );

            if ( false === $response ) {

                $return = array();
                //get all terms
                $terms = get_terms();

                //arrange term according to taxonomy
                foreach ( $terms as $term ) {
                    $return[$term->taxonomy][] = array("term_id" => $term->term_id, "name" => $term->name, "slug" => $term->slug, "");
                }

                //set response into the cache
                set_transient( 'mysgb-get-all-terms-cache', $return, 60 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );

                return new WP_REST_Response($return, 200);

            } else {
                //return cache data
                return new WP_REST_Response($response, 200);
            }

        }

        /*
         * Enqueue gutenberg custom block script
         * @since 1.0
         */
        public static function mysgb_add_block_editor_script() {
            wp_enqueue_script( 'mysgb-gutenberg-block', plugins_url( 'assets/js/blocks/block.build.js', __FILE__ ), array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components', 'jquery' ), null );

            if ( 'nabshow-lv' !== get_option( 'stylesheet' ) ) {
                wp_enqueue_style( 'mysgb-blocks-style', plugin_dir_url( __FILE__ ) . 'assets/css/mysgb-blocks-admin.css');
            }
        }

        /*
         * Enqueue gutenberg custom block script and style for front side
         * @since 1.0
         */
        public function mysgb_enqueue_front_script() {

            if ( $this->date_picker ) {
                wp_enqueue_script( 'jquery-ui-datepicker' );
	            wp_enqueue_style('jquery-ui', plugin_dir_url(__FILE__) . 'assets/css/jquery-ui.min.css', array(), false );
            }

            if ( 'nabshow-lv' !== get_option( 'stylesheet' ) ) {
                wp_enqueue_script( 'mysgb-blocks-script', plugins_url( 'assets/js/mysgb-blocks.js', __FILE__ ), array( 'jquery' ), null, true );
                wp_enqueue_script( 'mysgb-bx-slider',  plugins_url( 'assets/js/jquery.bxslider.min.js', __FILE__ ), array( 'jquery' ), null, true );

                wp_enqueue_style( 'mysgb-blocks-style', plugin_dir_url( __FILE__ ) . 'assets/css/mysgb-blocks.css' );
                wp_enqueue_style( 'mysgb-bxslider-style', plugin_dir_url( __FILE__ ) . 'assets/css/jquery.bxslider.css' );
            }
        }

        /**
         * Register all dynamic blocks
         * @since 1.0.0
         */
        public function mysgb_register_dynamic_blocks() {

            $slider_attributes   = $this->mysgb_get_common_slider_attributes();

            $dynamic_slider_attr = array(
                                    'itemToFetch'  => array(
                                        'type'    => 'number',
                                        'default' => 10,
                                    ),
                                    'postType'     => array(
                                        'type'    => 'string',
                                        'default' => 'post',
                                    ),
                                    'taxonomies'   => array(
                                        'type'    => 'array',
                                        'default' => [],
                                        'items'   => [
                                            'type' => 'string'
                                        ]
                                    ),
                                    'terms'        => array(
                                        'type' => 'string'
                                    ),
                                    'orderBy'      => array(
                                        'type'    => 'string',
                                        'default' => 'date'
                                    ),
                                    'displayTitle' => array(
                                        'type' => 'boolean',
                                        'default' => false
                                    )
                                );

            register_block_type( 'mys/dynamic-slider', array(
                    'attributes'      => array_merge( $dynamic_slider_attr, $slider_attributes ),
                    'render_callback' => array( $this, 'mysgb_dynamic_slider_render_callback' ),
                )
            );

            $session_slider_attr = array(
                                    'itemToFetch'  => array(
                                        'type'    => 'number',
                                        'default' => 10,
                                    ),
                                    'listingPage'  => array(
                                        'type'    => 'boolean',
                                        'default' => false
                                    ),
                                    'postType'     => array(
                                        'type'    => 'string',
                                        'default' => 'sessions',
                                    ),
                                    'taxonomies'   => array(
                                        'type'    => 'array',
                                        'default' => [],
                                        'items'   => [
                                            'type' => 'string'
                                        ]
                                    ),
                                    'terms'        => array(
                                        'type' => 'string'
                                    ),
                                    'orderBy'      => array(
                                        'type'    => 'string',
                                        'default' => 'date'
                                    ),
                                    'layout'      => array(
                                        'type'    => 'string',
                                        'default' => 'with-featured'
                                    ),
                                    'sliderLayout'      => array(
                                        'type'    => 'string',
                                        'default' => 'layout-1'
                                    ),
                                    'metaDate'    => array(
                                        'type'    => 'boolean',
                                        'default' => false
                                    ),
                                    'sessionDate' => array(
                                        'type'    => 'string',
                                    ),
                                    'taxonomyRelation'  => array(
                                        'type'    => 'boolean',
                                        'default' => false
                                    ),
                                    'listingType' => array(
                                        'type'    => 'string',
                                        'default' => 'none'
                                    ),
                                    'withContent'  => array(
                                        'type'    => 'boolean',
                                        'default' => false
                                    )
                            );

            register_block_type( 'mys/sessions-slider', array(
                    'attributes'      => array_merge( $session_slider_attr, $slider_attributes ),
                    'render_callback' => array( $this, 'mysgb_session_slider_render_callback' ),
                )
            );

            $exhibitors_slider_attr = array(
                                        'itemToFetch'  => array(
                                            'type'    => 'number',
                                            'default' => 10,
                                        ),
                                        'listingPage'  => array(
                                            'type'    => 'boolean',
                                            'default' => false
                                        ),
                                        'postType'     => array(
                                            'type'    => 'string',
                                            'default' => 'exhibitors',
                                        ),
                                        'taxonomies'   => array(
                                            'type'    => 'array',
                                            'default' => [],
                                            'items'   => [
                                                'type' => 'string'
                                            ]
                                        ),
                                        'terms'        => array(
                                            'type' => 'string'
                                        ),
                                        'orderBy'      => array(
                                            'type'    => 'string',
                                            'default' => 'date'
                                        ),
                                        'taxonomyRelation'  => array(
                                            'type'    => 'boolean',
                                            'default' => false
                                        ),
                                        'withThumbnail'  => array(
                                            'type'    => 'boolean',
                                            'default' => false
                                        )
                                    );

            register_block_type( 'mys/exhibitors-slider', array(
                    'attributes'      => array_merge( $exhibitors_slider_attr, $slider_attributes ),
                    'render_callback' => array( $this, 'mysgb_exhibitors_slider_render_callback' ),
                )
            );

            $speakers_slider_attr = array(
                                        'itemToFetch'  => array(
                                            'type'    => 'number',
                                            'default' => 10,
                                        ),
                                        'listingPage'  => array(
                                            'type'    => 'boolean',
                                            'default' => false
                                        ),
                                        'postType'     => array(
                                            'type'    => 'string',
                                            'default' => 'speakers',
                                        ),
                                        'taxonomies'   => array(
                                            'type'    => 'array',
                                            'default' => [],
                                            'items'   => [
                                                'type' => 'string'
                                            ]
                                        ),
                                        'terms'        => array(
                                            'type' => 'string'
                                        ),
                                        'slideShape'   => array(
                                            'type'    => 'string',
                                            'default' => 'circle'
                                        ),
                                        'orderBy'      => array(
                                            'type'    => 'string',
                                            'default' => 'date'
                                        ),
                                        'featuredListing'  => array(
                                            'type'    => 'boolean',
                                            'default' => false
                                        ),
                                        'withThumbnail'  => array(
                                            'type'    => 'boolean',
                                            'default' => false
                                        )
                                    );

            register_block_type( 'mys/speaker-slider', array(
                    'attributes'      => array_merge( $speakers_slider_attr, $slider_attributes ),
                    'render_callback' => array( $this, 'mysgb_speaker_slider_render_callback' ),
                )
            );

            $sponsors_slider_attr = array(
                                        'layout'     => array(
                                            'type'    => 'string',
                                            'default' => 'without-title',
                                        ),
                                        'itemToFetch'  => array(
                                            'type'    => 'number',
                                            'default' => 10,
                                        ),
                                        'listingPage'  => array(
                                            'type'    => 'boolean',
                                            'default' => false
                                        ),
                                        'postType'     => array(
                                            'type'    => 'string',
                                            'default' => 'sponsors',
                                        ),
                                        'taxonomies'   => array(
                                            'type'    => 'array',
                                            'default' => [],
                                            'items'   => [
                                                'type' => 'string'
                                            ]
                                        ),
                                        'terms'        => array(
                                            'type' => 'string'
                                        ),
                                        'orderBy'      => array(
                                            'type'    => 'string',
                                            'default' => 'date'
                                        )
                                    );

            register_block_type( 'mys/sponsors-partners', array(
                    'attributes'      => array_merge( $sponsors_slider_attr, $this->mysgb_get_common_slider_attributes(6 ) ),
                    'render_callback' => array( $this, 'mysgb_sponsors_partners_render_callback' ),
                )
            );
            register_block_type( 'mys/product-winner', array(
                    'attributes'      => array(
                        'itemToFetch'  => array(
                            'type'    => 'number',
                            'default' => 10,
                        ),
                        'postType'     => array(
                            'type'    => 'string',
                            'default' => 'not-to-be-missed',
                        ),
                        'taxonomies'   => array(
                            'type'    => 'array',
                            'default' => [],
                            'items'   => [
                                'type' => 'string'
                            ]
                        ),
                        'terms'        => array(
                            'type' => 'string'
                        ),
                        'orderBy'      => array(
                            'type'    => 'string',
                            'default' => 'date'
                        ),
                        'showFilter'    => array(
                            'type'      => 'boolean',
                            'default'   => false
                        )
                    ),
                    'render_callback' => array( $this, 'mysgb_product_winner_render_callback' ),
                )
            );

            $tracks_slider_attr = array(
                                    'itemToFetch'  => array(
                                        'type'    => 'number',
                                        'default' => 10,
                                    ),
                                    'order'      => array(
                                        'type'    => 'string',
                                        'default' => 'ASC'
                                    ),
                                    'featuredTag' => array(
                                        'type'    => 'boolean',
                                        'default' => false
                                    ),
                                    'categoryType' => array(
                                        'type'    => 'string',
                                        'default' => 'tracks'
                                    )
                                );

            register_block_type( 'mys/tracks-slider', array(
                    'attributes'      => array_merge( $tracks_slider_attr, $slider_attributes ),
                    'render_callback' => array( $this, 'mysgb_tracks_slider_render_callback' ),
                )
            );

            register_block_type( 'mys/product-categories', array(
                    'attributes'      => array(
                        'itemToFetch'  => array(
                            'type'    => 'number',
                            'default' => 10,
                        ),
                        'layoutType' => array(
                            'type'    => 'string',
                            'default' => 'listing'
                        )

                    ),
                    'render_callback' => array( $this, 'mysgb_product_categories_render_callback' ),
                )
            );

            $product_slider_attr = array(
                                    'itemToFetch'  => array(
                                        'type'    => 'number',
                                        'default' => 10,
                                    ),
                                    'postType'     => array(
                                        'type'    => 'string',
                                        'default' => 'not-to-be-missed',
                                    ),
                                    'taxonomies'   => array(
                                        'type'    => 'array',
                                        'default' => [],
                                        'items'   => [
                                            'type' => 'string'
                                        ]
                                    ),
                                    'terms'        => array(
                                        'type' => 'string'
                                    ),
                                    'orderBy'      => array(
                                        'type'    => 'string',
                                        'default' => 'date'
                                    )
                                );

            register_block_type( 'mys/product-slider', array(
                    'attributes'      => array_merge( $product_slider_attr, $slider_attributes ),
                    'render_callback' => array( $this, 'mysgb_product_slider_render_callback' ),
                )
            );

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
            $post_type      = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'post';
            $taxonomies     = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array();
            $terms          = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'] ): array();
            $posts_per_page = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
            $slider_active  = isset( $attributes['sliderActive'] ) ? $attributes['sliderActive'] : true;
            $min_slides     = isset( $attributes['minSlides'] ) ? $attributes['minSlides'] : 4;
            $slide_width    = isset( $attributes['slideWidth'] ) ? $attributes['slideWidth'] : 400;
            $autoplay       = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
            $infinite_loop  = isset( $attributes['infiniteLoop'] ) ? $attributes['infiniteLoop'] : true;
            $pager          = isset( $attributes['pager'] ) ? $attributes['pager'] : false;
            $controls       = isset( $attributes['controls'] ) ? $attributes['controls'] : false;
            $slider_speed   = isset( $attributes['sliderSpeed'] ) ? $attributes['sliderSpeed'] : 500;
            $order_by       = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
            $slider_margin  = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
            $order          = 'date' === $order_by ? 'DESC' : 'ASC';
            $display_title  = isset( $attributes['displayTitle'] ) ? $attributes['displayTitle'] : false;
            $arrow_icons    = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';
            $class_name     = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';

            $cache_key      = $this->mysgb_get_taxonomy_term_cache_key( $taxonomies, $terms );
            $final_key      = mb_strimwidth( 'mysgb-dynamic-slider-' . $post_type . '-' . $order_by . '-' . $posts_per_page . '-' . $cache_key, 0, 170 );
            $query          = get_transient( $final_key );

            if ( false === $query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
                $query_args = array(
                    'post_type'      => $post_type,
                    'posts_per_page' => $posts_per_page,
                    'orderby'        => $order_by,
                    'order'          => $order,
                    'meta_key'       => '_thumbnail_id',
                );

                $tax_query_args = $this->mysgb_get_tax_query_argument( $taxonomies, $terms );

                if ( count( $tax_query_args ) > 1 ) {
                    $query_args[ 'tax_query' ] = $tax_query_args;
                }

                $query = new WP_Query( $query_args );

                set_transient( $final_key, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
            }

            ob_start();

            if ( $query->have_posts() ) {
            ?>
                <div class="slider-arrow-main <?php echo esc_attr($arrow_icons); ?>">
            <?php
                    if ( $slider_active ) {
                    ?>
                        <div class="nab-dynamic-slider items-md nab-box-slider <?php echo esc_attr($class_name); ?>" data-minslides="<?php echo esc_attr($min_slides);?>" data-slidewidth="<?php echo esc_attr($slide_width);?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
                    <?php
                    } else {
                    ?>
                        <div class="nab-dynamic-list nab-box-slider <?php echo esc_attr($class_name); ?>">
                    <?php
                    }

                    while ( $query->have_posts() ) {
                        $query->the_post();
                        $thumbnail_url = get_the_post_thumbnail_url();
                    ?>
                        <div class="<?php echo $display_title ? esc_attr( 'item display-title' ) : esc_attr( 'item' ); ?>">
                        <?php
                        if ( $display_title ) {
                        ?>
                            <div class="flip-box">
                                <div class="flip-box-inner">
                        <?php
                        }
                        if ( 'page' === $post_type ) {
                        ?>
                            <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                        <?php
                        }
                        ?>
                                <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="item-logo">
                        <?php
                        if ( 'page' === $post_type ) {
                        ?>
                            </a>
                        <?php
                        }
                        if ( $display_title ) {
                        ?>
                                    <div class="flip-box-back rounded-circle">
                                        <h6>
                                        <?php
                                        if ( 'page' === $post_type ) {
                                        ?>
                                            <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                                        <?php
                                        } else {
                                            echo esc_html( get_the_title() );
                                        }
                                        ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        </div>
                    <?php
                    }
                    ?>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <p>No posts found.</p>
            <?php
            }

            wp_reset_postdata();

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

            $listing_page      = isset( $attributes['listingPage'] ) ? $attributes['listingPage'] : false;
            $with_content      = isset( $attributes['withContent'] ) ? $attributes['withContent'] : false;
            $listing_type      = isset( $attributes['listingType'] ) && ! empty( $attributes['listingType'] )? $attributes['listingType'] : 'none';
            $post_type         = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'sessions';
            $taxonomies        = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array();
            $terms             = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'] ): array();
            $posts_per_page    = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
            $slider_active     = isset( $attributes['sliderActive'] ) ? $attributes['sliderActive'] : true;
            $min_slides        = isset( $attributes['minSlides'] ) ? $attributes['minSlides'] : 4;
            $slide_width       = isset( $attributes['slideWidth'] ) ? $attributes['slideWidth'] : 400;
            $autoplay          = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
            $infinite_loop     = isset( $attributes['infiniteLoop'] ) ? $attributes['infiniteLoop'] : true;
            $pager             = isset( $attributes['pager'] ) ? $attributes['pager'] : false;
            $controls          = isset( $attributes['controls'] ) ? $attributes['controls'] : false;
            $slider_speed      = isset( $attributes['sliderSpeed'] ) ? $attributes['sliderSpeed'] : 500;
            $order_by          = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
            $slider_margin     = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
            $class_name        = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
            $taxonomy_relation = isset( $attributes['taxonomyRelation'] ) && $attributes['taxonomyRelation'] ? 'AND' : 'OR';
            $order             = 'date' === $order_by ? 'DESC' : 'ASC';
            $layout            = isset( $attributes['layout'] ) && ! empty( $attributes['layout'] ) ? $attributes['layout'] : '';
            $slider_layout     = isset( $attributes['sliderLayout'] ) && ! empty( $attributes['sliderLayout'] ) ? $attributes['sliderLayout'] : '';
            $arrow_icons       = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';
            $query             = false;
            $listing_id        = '';
            $final_key         = '';
            $cache_key         = $this->mysgb_get_taxonomy_term_cache_key( $taxonomies, $terms );
            $prepare_key       = 'mysgb-session-slider-' . $post_type . '-' . $order_by . '-' . $posts_per_page . '-' . $with_content;

            if ( ! $listing_page || 'none' !== $listing_type ) {

                if ( ( 'none' !== $listing_type || 'date-group' === $layout ) &&  ! $slider_active ) {

                    $final_key  = mb_strimwidth( $prepare_key . '-' . $listing_type . '-' . $cache_key, 0, 170 );
                    $query      = get_transient( $final_key );

                } elseif ( isset( $attributes['metaDate'] ) && $attributes['metaDate'] ) {

                    $final_key  = mb_strimwidth( $prepare_key . '-' . $attributes['sessionDate'] . '-' . $cache_key, 0, 170 );
                    $query      = get_transient( $final_key );

                } elseif ( ! empty( $cache_key ) ) {

                    $final_key  = mb_strimwidth( $prepare_key . '-' . $cache_key, 0, 170 );
                    $query      = get_transient( $final_key );

                }

            } else {

                $listing_id  = 'browse-session';
                $session_key = filter_input( INPUT_GET, 'session-key', FILTER_SANITIZE_STRING );

                if ( isset( $session_key ) && ! empty( $session_key ) ) {

                    $final_key  = mb_strimwidth( $prepare_key . '-' . $session_key . '-' . $cache_key, 0, 170 );
                    $query      = get_transient( $final_key );

                }
            }

            if ( false === $query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {

                $query_args = array(
                    'post_type'      => $post_type,
                );

                if ( ( 'none' !== $listing_type || 'date-group' === $layout ) &&  ! $slider_active ) {

                    $query_args['posts_per_page']       = $posts_per_page;
                    $query_args['meta_key']             = 'date';
                    $query_args['orderby']              = 'meta_value';
                    $query_args['order']                = 'ASC';

                } elseif ( 'rand' !== $order_by ) {

                    $query_args['posts_per_page']       = $posts_per_page;
                    $query_args['orderby']              = $order_by;
                    $query_args['order']                = $order;

                } else {

                    $query_args['posts_per_page']       = 100;
                    $query_args['fields']               = 'ids';
                    $query_args['no_found_rows']        = true;
                    $query_args['ignore_sticky_posts']  = true;

                }

                if ( ! $listing_page ) {

                    if ( $with_content ) {
                        $query_args[ 'content_with' ] = true;
                    }

                    if ( isset( $attributes['metaDate'] ) && $attributes['metaDate'] ) {

                        $session_date              = new DateTime( $attributes['sessionDate'] );
                        $session_date              = $session_date->format( 'Y-m-d' );
                        $query_args['meta_key']    = 'date';
                        $query_args['meta_value']  = $session_date;

                    }

                    $tax_query_args = $this->mysgb_get_tax_query_argument( $taxonomies, $terms, $taxonomy_relation );

                    if ( count( $tax_query_args ) > 1 ) {
                        $query_args[ 'tax_query' ] = $tax_query_args;
                    }

                } elseif ( ( $listing_page && 'none' !== $listing_type ) || ( isset( $session_key ) && ! empty( $session_key ) ) ) {

                    $session_term              = isset( $session_key ) && ! empty( $session_key ) ? strtolower( $session_key ) : $listing_type;
                    $query_args[ 'tax_query' ] = array(
                            array(
                                'taxonomy' => 'session-categories',
                                'field'    => 'slug',
                                'terms'    => $session_term
                            )
                    );
                }

                $query = new WP_Query( $query_args );

                if ( ! empty( $final_key ) && $query->have_posts() ) {
                    set_transient( $final_key, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
                }

            }

            ob_start();
            if ( 'date-group' === $layout &&  ! $slider_active ) {

                if ( $query->have_posts() ) {
                ?>

                    <div class="session-data schedule-main <?php echo esc_attr( $class_name ); ?>">

                    <?php

                    $date_group = '';
                    $counter    = 0;
                    $row_count  = 1;

                    while ( $query->have_posts() ) {

                        $query->the_post();

                        $session_id = get_the_ID();
                        $date       = get_post_meta( $session_id, 'date', true );
                        $start_time = get_post_meta( $session_id, 'starttime', true );
                        $end_time   = get_post_meta( $session_id, 'endtime', true );

                        if ( ! empty( $start_time ) ) {

                            $start_time = str_replace( array( 'am','pm' ), array( 'a.m.','p.m.' ), date_format( date_create( $start_time ), 'g:i a' ) );
                            $start_time = str_replace(':00', '', $start_time );

                        }
                        if ( ! empty( $end_time ) ) {

                            $end_time   = str_replace( array( 'am','pm' ), array( 'a.m.','p.m.' ), date_format( date_create( $end_time ), 'g:i a' ) );
                            $start_time = str_replace(':00', '', $end_time );

                        }
                        if ( $date_group !== $date ) {

                            $date_group = $date;
                            $row_count = 1;

                        ?>

                            <h2><?php echo esc_html( date_format( date_create( $date ), 'l, F j, Y' ) ); ?></h2>
                            <div class="schedule-data">

                        <?php } ?>

                        <div class="schedule-row <?php echo $row_count > 10 ? esc_attr('hide-row') : ''; ?>">
                            <div class="date">
                                <p><?php echo esc_html( $start_time ); ?> - <?php echo esc_html( $end_time ); ?></p>
                            </div>
                            <div class="name">
                            <?php
                                $session_title = mb_strimwidth( get_the_title(), 0, 83, '...' );
                            ?>
                                <strong><?php $this->mysgb_generate_popup_link( get_the_ID(), $post_type, $session_title ); ?> </strong>
                            </div>
                            <div class="details">
                            <?php

                                $speakers       = get_post_meta( $session_id, 'speakers', true );
                                $speaker_ids    = explode(',', $speakers);
                                $total_speakers = count( $speaker_ids );

                                if ( ! empty( $speakers ) && $total_speakers > 0 ) {
                                ?>
                                    <p>
                                    <?php

                                    $cnt = 1;

                                    foreach ( $speaker_ids as $speaker_id ) {
                                        $speaker_name = get_the_title( $speaker_id );
                                        if ( $total_speakers !== $cnt ) {
                                            $speaker_name .= ', ';
                                        }
                                        echo esc_html( $speaker_name );
                                        $cnt++;
                                    }

                                    ?>
                                    </p>
                                <?php
                                } else {
                                ?>
                                        <p>-</p>
                                <?php
                                }
                            ?>
                            </div>
                        </div>

                       <?php

                       if ( $row_count === 10 && $posts_per_page > 10 ) {
                       ?>
                            <div class="row-expand">
                                <a href="javascript:void(0);" class="expand-btn">Expand</a>
                            </div>

                       <?php
                       }

                       $counter++;
                       $next_post_date = isset( $query->posts[$counter]->ID ) ? get_post_meta( $query->posts[$counter]->ID, 'date', true ) : '';

                       if ( $date_group !== $next_post_date ) {
                       ?>
                            </div>
                       <?php
                       }

                       $row_count++;
                    }
                    ?>
                    </div>
                <?php
                } else {
                ?>
                    <p>No posts found.</p>
                <?php
                }
            } else {

                if ( $listing_page && 'none' === $listing_type ) {

                    require_once( plugin_dir_path( __FILE__ ) . 'includes/filters/html-mysgb-session-filter.php' );

                } elseif ( $listing_page && 'open-to-all' === $listing_type ) {

                    require_once( plugin_dir_path( __FILE__ ) . 'includes/filters/html-mysgb-open-to-all-filter.php' );

                    $this->date_picker = true;
                    $this->mysgb_enqueue_front_script();
                }

                if ( 'rand' === $order_by && $query->have_posts() ) {

                    $post_ids = $query->posts;
                    shuffle( $post_ids );
                    $post_ids = array_splice( $post_ids, 0, $posts_per_page );
                    $query    = new WP_Query( array( 'post_type' => $post_type, 'post__in' => $post_ids, 'posts_per_page' =>  count( $post_ids ), 'orderby' => 'post__in' ) );
                }

                if ( $query->have_posts() || $listing_page ) {
                    $show_code = $this->mysgb_get_mys_show_code();
                ?>
                    <div class="slider-arrow-main <?php echo esc_attr( $arrow_icons ); ?> <?php echo esc_attr( $class_name ); ?>">
                <?php
                if ( $slider_active ) {
                    $layout = '';
                ?>
                    <div class="nab-dynamic-slider nab-box-slider session" data-minslides="<?php echo esc_attr($min_slides);?>" data-slidewidth="<?php echo esc_attr($slide_width);?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
                <?php
                } else {

                    if ( 'none' !== $listing_type ) {
                        $listing_id = 'browse-session';
                    } elseif ( 'with-masonry' === $layout ) {
                        $listing_id = 'card_section';
                    }
                ?>
                    <div class="nab-dynamic-list session row <?php echo ! empty( $layout ) ? esc_attr( $layout ) : esc_attr('');?>" id="<?php echo esc_attr( $listing_id ); ?>">
                <?php
                }
                    $date_group = '';
                    $counter    = 0;
                    while ( $query->have_posts() ) {

                        $query->the_post();

                        $session_id          = get_the_ID();
                        $date                = get_post_meta( $session_id, 'date', true );
                        $start_time          = get_post_meta( $session_id, 'starttime', true );
                        $end_time            = get_post_meta( $session_id, 'endtime', true );

                        if ( ! empty( $date ) ) {
                            $date       = date_format( date_create( $date ), 'l, F j, Y' );
                        }
                        if ( ! empty( $start_time ) ) {
                            $start_time = str_replace( array('am','pm'), array('a.m.','p.m.'), date_format( date_create( $start_time ), 'g:i a' ) );
                            $start_time = str_replace(':00', '', $start_time );
                        }
                        if ( ! empty( $end_time ) ) {
                            $end_time   = str_replace( array('am','pm'), array('a.m.','p.m.'), date_format( date_create( $end_time ), 'g:i a' ) );
                            $end_time   = str_replace(':00', '', $end_time );
                        }

                        $date_display_format = ( 'layout-1' === $slider_layout || ! $slider_active ) && ! empty( $date )  ? $date . ' | ' . $start_time . ' - ' . $end_time : $start_time . ' - ' . $end_time;
                        $date_display_format = trim( $date_display_format, ' - ');

                        $all_tracks_string   = '';

                        if ( ! $listing_page ) {
                            $post_tracks         = get_the_terms( $session_id, 'tracks' );
                            $all_tracks_string   = $this->mysgb_get_comma_separated_term_list( $post_tracks, 'slug' );
						}

						$featured_post       = has_term( 'featured', 'session-categories' ) ? 'featured' : '';

                        if ( 'none' !== $listing_type && $date_group !== $date ) {
                            $date_group = $date;
                        ?>
                            <div class="listing-date-group" data-listing-type="<?php echo esc_attr( $listing_type ); ?>">
                                <h2 class="session-date"><?php echo esc_attr( $date ); ?></h2>
                        <?php
                        }
                        ?>
                            <div class="item <?php echo $listing_page && 'none' === $listing_type ? esc_attr( $featured_post ) : ''; ?>" data-featured="<?php echo esc_attr( $featured_post ); ?>" data-tracks="<?php echo esc_attr( $all_tracks_string ); ?>">
                        <?php
                            $session_has_thumbnail = has_post_thumbnail();

                            if ( ( ! $listing_page && 'with-featured' === $layout && $session_has_thumbnail ) || ( 'none' !== $listing_type && $session_has_thumbnail ) ) {
                            ?>
                                <img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="session-logo">
                            <?php
                            }
                            $title_text =  mb_strimwidth( get_the_title(), 0, 83, '...' );
                            ?>

                            <h4><?php $this->mysgb_generate_popup_link( $session_id, $post_type, $title_text); ?></h4>

                            <?php
                            if ( $slider_active ) {

                                if ( 'layout-1' === $slider_layout ) {

                                    $session_types = get_the_terms( $session_id, 'session-types' );
                                    $sub_title     =  $this->mysgb_get_comma_separated_term_list( $session_types );

                                } else {
                                    $sub_title = $date;
                                }

                            ?>
                                <span class="caption"><?php echo esc_html( $sub_title ); ?></span>
                            <?php
                            }
                            ?>

                            <span class="date-time"><?php echo esc_html( $date_display_format );?></span>

                            <?php
                            if ( 'with-featured' === $layout || 'with-masonry' === $layout ) {
                                $schedule_id         = get_post_meta( $session_id, 'scheduleid', true );
                                $session_planner_url = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/session-details.cfm?scheduleid=' . $schedule_id;
                            ?>
                                <p>
                                <?php

                                    echo esc_html( get_the_excerpt() );

                                    $this->mysgb_generate_popup_link( $session_id, $post_type, 'Read More', 'read-more-popup' );
                                ?>
                                </p>

                                <?php
                                    if ( 'with-masonry' === $layout ) {

                                        $speaker = get_post_meta( $session_id, 'speakers', true );

                                        if ( ! empty( $speaker ) ) {

                                            $speaker_ids         = explode(',', $speaker);
                                            $speaker_query_args  = array(
                                                'post_type'      => 'speakers',
                                                'posts_per_page' => count( $speaker_ids ),
                                                'post__in'       => $speaker_ids
                                            );

                                            $speaker_query = new WP_Query( $speaker_query_args );

                                            if ( $speaker_query->have_posts() ) {

                                                while ( $speaker_query->have_posts() ) {

                                                    $speaker_query->the_post();

                                                    if ( has_post_thumbnail() ) {
                                                        $speaker_thumbnail_url = get_the_post_thumbnail_url();
                                                    } else {
                                                        $speaker_thumbnail_url = $this->mysgb_get_speaker_thumbnail_url();
                                                    }
                                                    $speaker_id        = get_the_ID();
                                                    $speaker_job_title = get_post_meta( $speaker_id, 'title', true );
                                                    $speaker_company   = get_post_meta( $speaker_id, 'company', true );

                                                    ?>
                                                        <div class="speaker-single">
                                                            <div class="img-box">
                                                                <img src="<?php echo esc_url( $speaker_thumbnail_url ); ?>" alt="speaker-logo" class="rounded-circle" />
                                                            </div>
                                                            <div class="info-box">
                                                                <h4 class="title"><?php $this->mysgb_generate_popup_link( $speaker_id, 'speakers', get_the_title() ); ?></h4>
                                                                <p class="jobtilt"><?php echo esc_html( $speaker_job_title ); ?></p>
                                                                <span class="company"><?php echo esc_html( $speaker_company ); ?></span>
                                                            </div>
                                                        </div>
                                                    <?php
                                                }
                                            }
                                            wp_reset_postdata();
                                        }
                                    }
                                 ?>

                                <a class="session-planner-url" href="<?php echo esc_url( $session_planner_url ); ?>" target="_blank">View in Planner</a>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                        $counter++;
                        if ( 'none' !== $listing_type ) {
                            $next_post_date = isset( $query->posts[$counter]->ID ) ? get_post_meta( $query->posts[$counter]->ID, 'date', true ) : '';
                            if ( ! empty( $next_post_date ) ) {
                                $next_post_date = date_format( date_create( $next_post_date ), 'l, F j, Y' );
                            }
                            if ( $date_group !== $next_post_date ) {
                            ?>
                                </div>
                            <?php
                            }
                        }
                    }
                    ?>
                    </div>
                    <?php
                    if ( $listing_page ) {
                        $result_style = $query->have_posts() ? 'display: none;' : 'display: block;';
                    ?>
                        <p class="no-data" style="<?php echo esc_attr( $result_style ); ?>">Result not found.</p>
                        <div class="load-more-sessions text-center <?php echo $query->max_num_pages > 1 ? '' : esc_attr( 'display-none' ); ?>" id="load-more-sessions">
                            <a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="<?php echo esc_attr( $posts_per_page ); ?>" data-total-page="<?php echo absint( $query->max_num_pages ); ?>">Load More</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                } else {
                ?>
                    <p>No post found.</p>
                <?php
                }
            }


            wp_reset_postdata();

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

            $listing_page      = isset( $attributes['listingPage'] ) ? $attributes['listingPage'] : false;
            $with_thumbnail    = isset( $attributes['withThumbnail'] ) ? $attributes['withThumbnail'] : false;
            $post_type         = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'exhibitors';
            $taxonomies        = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array();
            $terms             = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'] ): array();
            $posts_per_page    = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
            $taxonomy_relation = isset( $attributes['taxonomyRelation'] ) && $attributes['taxonomyRelation'] ? 'AND' : 'OR';
            $slider_active     = isset( $attributes['sliderActive'] ) ? $attributes['sliderActive'] : true;
            $min_slides        = isset( $attributes['minSlides'] ) ? $attributes['minSlides'] : 4;
            $slide_width       = isset( $attributes['slideWidth'] ) ? $attributes['slideWidth'] : 400;
            $autoplay          = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
            $infinite_loop     = isset( $attributes['infiniteLoop'] ) ? $attributes['infiniteLoop'] : true;
            $pager             = isset( $attributes['pager'] ) ? $attributes['pager'] : false;
            $controls          = isset( $attributes['controls'] ) ? $attributes['controls'] : false;
            $slider_speed      = isset( $attributes['sliderSpeed'] ) ? $attributes['sliderSpeed'] : 500;
            $order_by          = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
            $slider_margin     = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
            $class_name        = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
            $order             = 'date' === $order_by ? 'DESC' : 'ASC';
            $arrow_icons       = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';

            $final_key         = '';
            $cache_key         = $this->mysgb_get_taxonomy_term_cache_key( $taxonomies, $terms );

            if ( ( ! $listing_page && ! empty( $cache_key ) ) || $with_thumbnail ) {
                $final_key  = mb_strimwidth( 'mysgb-exhibitor-slider-' . $post_type . '-' . $order_by . '-' . $posts_per_page . '-' . '-' . $with_thumbnail . $cache_key, 0, 170 );
                $query      = get_transient( $final_key );
            } else {

                $get_exkey = filter_input( INPUT_GET, 'exhibitor-key', FILTER_SANITIZE_STRING );

                if ( isset( $get_exkey ) && ! empty( $get_exkey ) ) {
                    $final_key  = 'mysgb-exhibitors-browse-post-cache-' . $get_exkey . '-' . $posts_per_page;
                    $query      = get_transient( $final_key );
                } else {
                    $query = false;
                }
            }

            if ( false === $query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {

                $query_args = array(
                    'post_type'      => $post_type,
                    'posts_per_page' => $posts_per_page,
                    'orderby'        => $order_by,
                    'order'          => $order,
                );

                if ( ! $listing_page ) {

                    if ( $with_thumbnail ) {
                        $query_args[ 'meta_key' ] = '_thumbnail_id';
                    }

                    $tax_query_args = $this->mysgb_get_tax_query_argument( $taxonomies, $terms, $taxonomy_relation );

                    if ( count( $tax_query_args ) > 1 ) {
                        $query_args[ 'tax_query' ] = $tax_query_args;
                    }

                } elseif ( isset( $get_exkey ) && ! empty( $get_exkey ) ) {
                    $query_args[ 'tax_query' ] = array(
                            array(
                                'taxonomy' => 'exhibitor-keywords',
                                'field'    => 'slug',
                                'terms'    => array( $get_exkey )
                            )
                    );
                }

                $query = new WP_Query( $query_args );

                if ( ! empty( $final_key ) && $query->have_posts() ) {
                    set_transient( $final_key, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
                }
            }

            ob_start();

            if ( $query->have_posts() || $listing_page ) {

                if ( $listing_page ) {

                    require_once( plugin_dir_path( __FILE__ ) . 'includes/filters/html-mysgb-exhibitor-filter.php' );
                }

                $show_code = $this->mysgb_get_mys_show_code();
            ?>
                <div class="slider-arrow-main <?php echo esc_attr($arrow_icons); ?> <?php echo esc_attr( $class_name ); ?>">

                <?php
                if ( $slider_active ) {
                ?>
                    <div class="nab-dynamic-slider nab-box-slider exhibitors" data-minslides="<?php echo esc_attr($min_slides);?>" data-slidewidth="<?php echo esc_attr($slide_width);?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
                <?php
                } else {
                ?>
                    <div class="nab-dynamic-list exhibitors" id="<?php echo $listing_page ? esc_attr('browse-exhibitor') : ''; ?>">
                <?php
                }

                    while ( $query->have_posts() ) {

                        $query->the_post();

                        $exhibitor_id   = get_the_ID();
                        if ( $listing_page ) {

                            $featured_post  = has_term( 'featured', 'exhibitor-keywords' ) ? 'featured' : '';
                        ?>
                            <div class="item <?php echo esc_attr( $featured_post ); ?>" data-featured="<?php echo esc_attr( $featured_post ); ?>">
                        <?php
                        } else {
                        ?>
                            <div class="item">
                        <?php
                        }
                        ?>
                            <div class="item-inner">
                                <?php
                                if ( has_post_thumbnail() ) {
                                    if ( $slider_active ) {
                                    ?>
                                        <a href="#" class="detail-list-modal-popup" data-postid="<?php echo esc_attr( $exhibitor_id ); ?>" data-posttype="<?php echo esc_attr( $post_type ); ?>">
                                    <?php
                                    }
                                    ?>
                                        <img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="exhibitor-logo">
                                    <?php
                                    if ( $slider_active ) {
                                    ?>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                <?php
                                } elseif ( $slider_active ) {
                                ?>
                                     <h4 class="exhibitor-title"><?php $this->mysgb_generate_popup_link( $exhibitor_id, $post_type, get_the_title() ); ?></h4>
                                <?php
                                }
                                if ( ! $slider_active ) {
                                    $booth_number = get_post_meta( $exhibitor_id, 'boothnumbers', true );
                                    $exh_id       = get_post_meta( $exhibitor_id, 'exhid', true );
                                    $exh_url      = 'https://' . $show_code . '.mapyourshow.com/8_0/exhibitor/exhibitor-details.cfm?exhid=' . $exh_id;
                                ?>
                                    <h4><?php $this->mysgb_generate_popup_link( $exhibitor_id, $post_type, get_the_title() ); ?></h4>
                                    <span><?php echo esc_html( $booth_number ); ?></span>
                                    <p>
                                    <?php
                                        echo esc_html( get_the_excerpt() );
                                        $this->mysgb_generate_popup_link( $exhibitor_id, $post_type, 'Read More', 'read-more-popup');
                                    ?>
                                    </p>
                                    <a href="<?php echo esc_url( $exh_url ); ?>" target="_blank">View in Planner</a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                if ( $listing_page ) {
                    $result_style = $query->have_posts() ? 'display: none;' : 'display: block;';
                ?>
                    <p class="no-data" style="<?php echo esc_attr( $result_style ); ?>">Result not found.</p>
                    <div class="load-more-sessions text-center <?php echo $query->max_num_pages > 1 ? '' : esc_attr( 'display-none' ); ?>" id="load-more-exhibitor">
                        <a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="<?php echo esc_attr( $posts_per_page ); ?>" data-total-page="<?php echo absint( $query->max_num_pages ); ?>">Load More</a>
                    </div>
                <?php
                }
                ?>
            </div>
            <?php
            } else {
            ?>
                <p>No posts found.</p>
            <?php
            }

            wp_reset_postdata();

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

            $listing_page       = isset( $attributes['listingPage'] ) ? $attributes['listingPage'] : false;
            $featured_listing   = isset( $attributes['featuredListing'] ) ? $attributes['featuredListing'] : false;
            $with_thumbnail     = isset( $attributes['withThumbnail'] ) ? $attributes['withThumbnail'] : false;
            $post_type          = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'speakers';
            $taxonomies         = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array();
            $terms              = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'] ): array();
            $posts_per_page     = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
            $slider_active      = isset( $attributes['sliderActive'] ) ? $attributes['sliderActive'] : true;
            $min_slides         = isset( $attributes['minSlides'] ) ? $attributes['minSlides'] : 4;
            $slide_width        = isset( $attributes['slideWidth'] ) ? $attributes['slideWidth'] : 400;
            $autoplay           = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
            $infinite_loop      = isset( $attributes['infiniteLoop'] ) ? $attributes['infiniteLoop'] : true;
            $pager              = isset( $attributes['pager'] ) ? $attributes['pager'] : false;
            $controls           = isset( $attributes['controls'] ) ? $attributes['controls'] : false;
            $slider_speed       = isset( $attributes['sliderSpeed'] ) ? $attributes['sliderSpeed'] : 500;
            $slider_shape       = isset( $attributes['slideShape'] ) ? $attributes['slideShape'] : 'rectangle';
            $order_by           = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
            $slider_margin      = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
            $order              = 'date' === $order_by ? 'DESC' : 'ASC';
            $arrow_icons        = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';
            $class_name         = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
            $item_class         = 'circle' === $slider_shape && $slider_active ? '' : 'display-title';

            $query              = false;
            $final_key          = '';
            $cache_key          = $this->mysgb_get_taxonomy_term_cache_key( $taxonomies, $terms );

            if ( $featured_listing || ! empty( $cache_key ) || $with_thumbnail ) {
                $final_key  = mb_strimwidth( 'mysgb-speaker-slider-' . $post_type . '-' . $order_by . '-' . $posts_per_page . '-' . $featured_listing . '-' . $with_thumbnail .'-' . $cache_key, 0, 170 );
                $query = get_transient( $final_key );
            } else {
                $speaker_key = filter_input( INPUT_GET, 'speaker-key', FILTER_SANITIZE_STRING );
                if ( isset( $speaker_key ) && ! empty( $speaker_key ) ) {
                    $final_key  = 'mysgb-speaker-slider-' . $post_type . '-' . $order_by . '-' . $posts_per_page . '-' .$speaker_key;
                    $query      = get_transient( $final_key );
                }
            }


            if ( false === $query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {

                $query_args = array(
                    'post_type'      => $post_type,
                    'posts_per_page' => $posts_per_page,
                    'orderby'        => $order_by,
                    'order'          => $order,
                );

                if ( ! $listing_page ) {

                    if ( $with_thumbnail ) {
                        $query_args[ 'meta_key' ] = '_thumbnail_id';
                    }

                    $tax_query_args = $this->mysgb_get_tax_query_argument( $taxonomies, $terms );

                    if ( count( $tax_query_args ) > 1 ) {
                        $query_args[ 'tax_query' ] = $tax_query_args;
                    }

                } elseif ( ( $listing_page && $featured_listing ) || ( isset( $speaker_key ) && ! empty( $speaker_key ) ) ) {
                    $query_args[ 'tax_query' ] = array(
                            array(
                                'taxonomy' => 'speaker-categories',
                                'field'    => 'slug',
                                'terms'    => array( 'featured' )
                            )
                    );
                }

                $query = new WP_Query( $query_args );

                if ( ! empty( $final_key ) && $query->have_posts() ) {
                    set_transient( $final_key, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
                }
            }

            ob_start();

            if ( $query->have_posts() || $listing_page ) {

                if ( $listing_page ) {

                    require_once( plugin_dir_path( __FILE__ ) . 'includes/filters/html-mysgb-speaker-filter.php' );

                    $this->date_picker = true;
                    $this->mysgb_enqueue_front_script();
                }
            ?>
                <div class="slider-arrow-main <?php echo esc_attr( $arrow_icons ); ?> <?php echo esc_attr( $class_name ); ?>">
            <?php
                    if ( $slider_active ) {
                    ?>
                        <div class="nab-dynamic-slider items-md nab-box-slider speakers" data-minslides="<?php echo esc_attr( $min_slides );?>" data-slidewidth="<?php echo esc_attr( $slide_width );?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
                    <?php
                    } else {
                    ?>
                        <div class="nab-dynamic-list nab-box-slider speakers" id="<?php echo $listing_page ? esc_attr('browse-speaker') : ''; ?>">
                    <?php
                    }

                    while ( $query->have_posts() ) {

                        $query->the_post();

                        $speaker_id = get_the_ID();

                        if ( has_post_thumbnail() ) {
                            $thumbnail_url = get_the_post_thumbnail_url();
                        } else {
                            $thumbnail_url = $this->mysgb_get_speaker_thumbnail_url();
                        }

                        if ( $listing_page ) {
                            $featured_post  = has_term( 'featured', 'speaker-categories' ) ? 'featured' : '';
                        ?>
                            <div class="item <?php echo esc_attr( $item_class ); echo ! $featured_listing && ! empty( $featured_post ) ? esc_attr( ' featured' ) : ''; ?>" data-featured="<?php echo esc_attr( $featured_post ); ?>">
                        <?php
                        } else {
                        ?>
                            <div class="item <?php echo esc_attr( $item_class ); ?>">
                        <?php
                        }

                        ?>
                            <div class="flip-box">
                                <div class="flip-box-inner">
                                    <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="speaker-logo" class="<?php echo 'circle' === $slider_shape ? esc_attr('rounded-circle') : ''; ?>">
                                    <div class="flip-box-back rounded-circle">
                                        <h6><?php $this->mysgb_generate_popup_link( $speaker_id, $post_type, get_the_title() ); ?></h6>
                                        <?php
                                         if ( ! $slider_active ) {
                                            $speaker_job_title = get_post_meta( $speaker_id, 'title', true );
                                            $speaker_company   = get_post_meta( $speaker_id, 'company', true );
                                         ?>
                                            <p class="jobtilt"><?php echo esc_attr( $speaker_job_title ); ?></p>
                                            <span class="company"><?php echo esc_attr( $speaker_company ); ?></span>
                                         <?php
                                         }
                                         ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    </div>
                    <?php
                    if ( $listing_page ) {
                        $result_style = $query->have_posts() ? 'display: none;' : 'display: block;';
                    ?>
                        <p class="no-data" style="<?php echo esc_attr( $result_style ); ?>">Result not found.</p>
                        <div class="load-more-sessions text-center <?php echo $query->max_num_pages > 1 ? '' : esc_attr( 'display-none' ); ?>" id="load-more-speaker">
                            <a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="<?php echo esc_attr( $posts_per_page ); ?>" data-total-page="<?php echo absint( $query->max_num_pages ); ?>">Load More</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            <?php
            } else {
            ?>
                <p>No posts found.</p>
            <?php
            }

            wp_reset_postdata();

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
            $listing_page    = isset( $attributes['listingPage'] ) ? $attributes['listingPage'] : false;
            $layout          = isset( $attributes['layout'] ) && ! empty( $attributes['layout'] ) ? $attributes['layout'] : 'without-title';
            $post_type       = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'sponsors';
            $taxonomies      = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array();
            $terms           = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'] ): array();
            $posts_per_page  = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
            $slider_active   = isset( $attributes['sliderActive'] ) ? $attributes['sliderActive'] : true;
            $min_slides      = isset( $attributes['minSlides'] ) ? $attributes['minSlides'] : 4;
            $slide_width     = isset( $attributes['slideWidth'] ) ? $attributes['slideWidth'] : 400;
            $autoplay        = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
            $infinite_loop   = isset( $attributes['infiniteLoop'] ) ? $attributes['infiniteLoop'] : true;
            $pager           = isset( $attributes['pager'] ) ? $attributes['pager'] : false;
            $controls        = isset( $attributes['controls'] ) ? $attributes['controls'] : false;
            $slider_speed    = isset( $attributes['sliderSpeed'] ) ? $attributes['sliderSpeed'] : 500;
            $slider_margin   = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
            $arrow_icons     = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';
            $order_by        = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
            $order           = 'date' === $order_by ? 'DESC' : 'ASC';
            $class_name      = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';

            $cache_key       = $this->mysgb_get_taxonomy_term_cache_key( $taxonomies, $terms );
            $final_key       = mb_strimwidth( 'mysgb-sponsors-partners-slider-' . $post_type . '-' . $order_by . '-' . $posts_per_page . '-' . $cache_key, 0, 170 );
            $query           = get_transient( $final_key );

            if ( false === $query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {

                $query_args = array(
                    'post_type'      => $post_type,
                    'meta_key'       => '_thumbnail_id',
                );

                if ( 'rand' === $order_by ) {
                    $query_args['posts_per_page']       = 100;
                    $query_args['fields']               = 'ids';
                    $query_args['no_found_rows']        = true;
                    $query_args['ignore_sticky_posts']  = true;
                } else {
                    $query_args['posts_per_page']       = $posts_per_page;
                    $query_args['orderby']              = $order_by;
                    $query_args['order']                = $order;
                }

                $tax_query_args = $this->mysgb_get_tax_query_argument( $taxonomies, $terms );

                if ( count( $tax_query_args ) > 1 ) {
                    $query_args[ 'tax_query' ] = $tax_query_args;
                }

                $query = new WP_Query($query_args);

                set_transient( $final_key, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
            }

            if ( 'rand' === $order_by && $query->have_posts() ) {
                $post_ids = $query->posts;
                shuffle( $post_ids );
                $post_ids = array_splice( $post_ids, 0, $posts_per_page );
                $query    = new WP_Query( array( 'post_type' => $post_type, 'post__in' => $post_ids, 'posts_per_page' =>  count( $post_ids ), 'orderby' => 'post__in' ) );
            }

            ob_start();

            if ( $query->have_posts() ) {

                if ( $listing_page ) {
                    require_once( plugin_dir_path( __FILE__ ) . 'includes/filters/html-mysgb-sponsor-filter.php' );
                }
            ?>
                <div class="slider-arrow-main <?php echo esc_attr( $arrow_icons ); ?> <?php echo esc_attr( $class_name ); ?>">
                <?php
                    if ( $slider_active ) {
                    ?>
                        <div class="nab-dynamic-slider items-md nab-box-slider sponsors" data-minslides="<?php echo esc_attr($min_slides);?>" data-slidewidth="<?php echo esc_attr($slide_width);?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
                    <?php
                    } else {
                    ?>
                        <ul class="partner-listing <?php echo esc_attr( $layout ); ?>" id="sponsors-partners-list">
                    <?php
                    }
                    while ( $query->have_posts() ) {

                        $query->the_post();

                        $thumbnail_url          = get_the_post_thumbnail_url();
                        $partners_sponsors_link = get_field( 'partners_sponsors_link',  get_the_ID() );

                        if ( $slider_active ) {
                        ?>
                            <div class="item">
                            <?php
                                if ( ! empty( $partners_sponsors_link ) ) {
                                ?>
                                    <a href="<?php echo esc_url( $partners_sponsors_link ); ?>" target="_blank">
                                <?php
                                }
                                ?>
                                    <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="sponsor-logo" />
                                <?php
                                if ( ! empty( $partners_sponsors_link ) ) {
                                ?>
                                    </a>
                                <?php
                                }
                            ?>
                            </div>
                        <?php
                        } else {
                            if ( $listing_page ) {
                                $featured_post  = has_term( 'featured', 'sponsor-categories' ) ? 'featured' : '';
                            ?>
                                <li class="<?php echo esc_attr( $featured_post ); ?>" data-title="<?php echo esc_attr( strtolower( get_the_title() ) ); ?>" data-featured="<?php echo esc_attr( $featured_post ); ?>">
                            <?php
                            } else {
                            ?>
                                <li>
                            <?php
                            }
                            if ( 'with-info' === $layout ) {
                            ?>
                                <div class="partner-inner">
                            <?php
                            }
                            ?>
                                <figure class="partner-img-box">
                                    <?php
                                    if ( ! empty( $partners_sponsors_link ) ) {
                                    ?>
                                        <a href="<?php echo esc_url( $partners_sponsors_link ); ?>" target="_blank">
                                    <?php
                                    }
                                    ?>
                                        <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="sponsor-logo">
                                    <?php
                                    if ( ! empty( $partners_sponsors_link ) ) {
                                    ?>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </figure>

                                <?php
                                if ( 'with-title' === $layout || 'with-info' === $layout ) {
                                    $all_sponsor_type = get_the_terms( get_the_ID(), 'sponsor-types' );
                                    $sponsor_type     = $this->mysgb_get_comma_separated_term_list( $all_sponsor_type );
                                ?>
                                    <span><?php echo esc_html( $sponsor_type ); ?></span>
                                <?php
                                }

                            if ( 'with-info' === $layout ) {
                            ?>
                                    <p><?php echo esc_html( get_the_excerpt() ); ?></p>
                                    <a href="<?php echo esc_url( $partners_sponsors_link ); ?>" target="_blank">Learn More</a>
                                </div>
                            <?php
                            }
                            ?>
                            </li>
                        <?php
                        }
                    }
                    if ( $slider_active ) {
                    ?>
                        </div>
                    <?php
                    } else {
                    ?>
                        </ul>
                    <?php
                    }
                    if ( $listing_page ) {
                    ?>
                        <p class="no-data display-none">Result not found.</p>
                    <?php
                    }
                    ?>
                </div>
            <?php
            } else {
            ?>
                <p>No posts found.</p>
            <?php
            }

            wp_reset_postdata();

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
            $show_filter    = isset( $attributes['showFilter'] ) ? $attributes['showFilter'] : false;
            $post_type      = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'not-to-be-missed';
            $taxonomies     = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array('featured-category');
            $terms          = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'], true ): array();
            $posts_per_page = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
            $order_by       = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
            $order          = 'date' === $order_by ? 'DESC' : 'ASC';
            $class_name     = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';

            ob_start();

            if ( $show_filter ) {
                require_once( plugin_dir_path( __FILE__ ) . 'includes/filters/html-mysgb-product-winner-filter.php' );
            }

            foreach ( $taxonomies as $taxonomy ) {

                if ( count( array_filter( ( array_values( $terms ) ) ) ) > 0 && count( $terms[$taxonomy] ) > 0 ) {
                    $final_terms = array();
                    $cnt = 0;
                    foreach ( $terms[$taxonomy] as $term ) {
                        $final_terms[$cnt] = new stdClass();
                        $final_terms[$cnt]->slug = $term['value'];
                        $final_terms[$cnt]->name = $term['label'];
                        $cnt++;
                    }

                } else {
                    $final_terms = get_terms( $taxonomy, array( 'hide_empty' => 0 ) );
                }

                foreach ( $final_terms as $term ) {

                    $args = array( 'post_type' => $post_type, $taxonomy => $term->slug, 'posts_per_page' => $posts_per_page, 'orderby' => $order_by, 'order' => $order );
                    $query = new WP_Query( $args );

                    if ( $query->have_posts() ) {
                    ?>
                        <div class="products-winners <?php echo esc_attr( $class_name ); ?>">
                            <h2 class="product-title"><?php echo esc_html( $term->name ); ?></h2>
                            <div class="product-main">
                    <?php
                        while ( $query->have_posts() ) {
                            $query->the_post();
                        ?>
                                <div class="product-item">
                                    <div class="product-inner">
                                    <?php
                                    if ( has_post_thumbnail() ) {
                                    ?>
                                        <div class="media-img">
                                            <img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" class="img" alt="<?php echo esc_attr( get_the_title() ); ?>">
                                        </div>
                                    <?php
                                    }
                                    ?>
                                        <h3 class="title">
                                            <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                                        </h3>
                                        <span class="subtitle">Company Name</span>
                                        <p class="content"><?php echo esc_html( get_the_excerpt() ); ?></p>
                                    </div>
                                </div>
                        <?php
                        }
                        ?>
                            </div>
                        </div>
                    <?php
                    }
                    wp_reset_postdata();
                }
            }

            $html = ob_get_clean();
            return $html;
        }

        /**
         * Fetch sessions tracks according to block attributes
         *
         * @param $attributes
         *
         * @return string
         * @since 1.0.0
         */
        public function mysgb_tracks_slider_render_callback( $attributes ) {
            $posts_per_page = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
            $category_type  = isset( $attributes['categoryType'] ) && ! empty( $attributes['categoryType'] ) ? $attributes['categoryType'] : 'tracks';
            $slider_active  = isset( $attributes['sliderActive'] ) ? $attributes['sliderActive'] : true;
            $min_slides     = isset( $attributes['minSlides'] ) ? $attributes['minSlides'] : 4;
            $slide_width    = isset( $attributes['slideWidth'] ) ? $attributes['slideWidth'] : 400;
            $autoplay       = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
            $infinite_loop  = isset( $attributes['infiniteLoop'] ) ? $attributes['infiniteLoop'] : true;
            $pager          = isset( $attributes['pager'] ) ? $attributes['pager'] : false;
            $controls       = isset( $attributes['controls'] ) ? $attributes['controls'] : false;
            $slider_speed   = isset( $attributes['sliderSpeed'] ) ? $attributes['sliderSpeed'] : 500;
            $order          = isset( $attributes['order'] ) ? $attributes['order'] : 'ASC';
            $slider_margin  = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
            $class_name     = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
            $featured_track = isset( $attributes['featuredTag'] ) ? $attributes['featuredTag'] : false;
            $arrow_icons    = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';
            $terms          = false;

            if ( $featured_track ) {
                $terms = get_transient( 'mysgb-category-slider-' . $category_type . '-' . $posts_per_page . '-' . $order );
            }


            if ( false === $terms || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {

                $args = array(
                    'taxonomy'   => $category_type,
                    'hide_empty' => false,
                    'number'     => $posts_per_page,
                    'orderBy'    => 'name',
                    'order'      => $order,
                );

                if ( $featured_track ) {
                    $args[ 'meta_query' ] = array(
                                array(
                                   'key'       => 'featured_tag',
                                   'value'     => 'on',
                                   'compare'   => '='
                                )
                            );
                }

                $terms = get_terms( $args );

                if ( $featured_track ) {
                    set_transient( 'mysgb-category-slider-' . $category_type . '-' . $posts_per_page . '-' . $order, $terms, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
                }

            }

            ob_start();

            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                ?>
                    <div class="slider-arrow-main <?php echo esc_attr($arrow_icons); ?> <?php echo esc_attr( $class_name ); ?>">
                <?php

                    if ( $slider_active ) {
                    ?>
                        <div class="nab-dynamic-slider nab-box-slider category-slider <?php echo esc_attr( $category_type ); ?>" data-minslides="<?php echo esc_attr($min_slides);?>" data-slidewidth="<?php echo esc_attr($slide_width);?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
                    <?php
                    } else {
                    ?>
                        <div class="nab-dynamic-list category-slider <?php echo esc_attr( $category_type ); ?>">
                    <?php
                    }

                    foreach ( $terms as $term ) {
                         $image_id = get_term_meta( $term->term_id, 'tax-image-id', true );
                    ?>
                        <div class="item">
                            <div class="item-inner">
                                <?php
                                if ( ! empty( $image_id ) ) {
                                    $image_url = wp_get_attachment_url( $image_id );
                                ?>
                                    <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $term->name ); ?>">
                                <?php } ?>
                                <h2 class="track-title"><?php echo esc_html( $term->name ); ?></h2>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            } else {
            ?>
                <p>Record Not Found.</p>
            <?php
            }

            wp_reset_postdata();

            $html = ob_get_clean();
            return $html;
        }

        /**
         * Fetch product categories
         * @param $attributes
         * @return string
         * @since 1.0.0
         */
        public function mysgb_product_categories_render_callback( $attributes ) {
            $posts_per_page = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
            $layout_type    = isset( $attributes['layoutType'] ) && ! empty( $attributes['layoutType'] ) ? $attributes['layoutType'] : 'listing';
            $class_name     = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';

            $parent_terms = get_terms( array(
                'taxonomy' => 'exhibitor-categories',
                'parent'   => 0,
                'hide_empty' => false
            ) );

            ob_start();

            if ( is_array( $parent_terms ) && ! is_wp_error( $parent_terms ) && count( $parent_terms ) > 0 ) {
                $term_counter = 1;
            ?>
                <div class="category-listing-main <?php echo esc_attr( $class_name ); ?>">
                    <?php
                    if ( 'parent-img-list' === $layout_type ) {
                    ?>
                        <ul class="parent-category-listing">
                    <?php
                    }

                    foreach ( $parent_terms as $parent_term ) {

                        $child_terms = get_terms( array(
                            'taxonomy' => 'exhibitor-categories',
                            'parent'   => $parent_term->term_id,
                            'hide_empty' => false
                        ) );

                        if ( is_array( $child_terms ) && ! is_wp_error( $child_terms ) && count( $child_terms ) > 0 ) {

                            if ( 'parent-img-list' === $layout_type ) {
                                $image_id   = get_term_meta( $parent_term->term_id, 'tax-image-id', true );
                                $image_url  = ! empty( $image_id ) ? wp_get_attachment_url( $image_id ) : nabshow_lv_get_empty_thumbnail_url();
                            ?>
                                <li>
                                    <a href="#"><img src="<?php echo esc_url( $image_url ); ?>" alt="category-logo" /></a>
                                </li>
                            <?php
                            } else {

                                $listing_class = $layout_type;

                                if ( 'accordion-list' === $layout_type ) {
                                    $listing_class .= 1 === $term_counter ? ' open' : ' close';
                                }
                                ?>
                                <div class="category-listing <?php echo esc_attr( $listing_class ); ?>">
                                    <div class="category-head">
                                        <h2 class="category-title"><?php echo esc_html( $parent_term->name ); ?></h2>
                                    </div>
                                    <div class="category-body">
                                        <ul>
                                        <?php
                                            foreach ( $child_terms as $child_term ) {
                                            ?>
                                                <li>
                                                    <a href="#">
                                                    <?php
                                                        if ( 'accordion-list' === $layout_type ) {
                                                            echo esc_html( $child_term->name );
                                                        } else {
                                                            $image_id = get_term_meta( $child_term->term_id, 'tax-image-id', true );
                                                            if ( ! empty( $image_id ) ) {
                                                                $image_url = wp_get_attachment_url( $image_id );
                                                            } else {
                                                                $image_url = nabshow_lv_get_empty_thumbnail_url();
                                                            }
                                                        ?>
                                                            <img src="<?php echo esc_url( $image_url ); ?>" alt="category-logo" data-title="<?php echo esc_attr( strtolower( $child_term->name ) ); ?>">
                                                        <?php
                                                        }
                                                    ?>
                                                    </a>
                                                </li>
                                            <?php
                                            }
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php
                            }
                            if ( $posts_per_page <= $term_counter ) {
                                break;
                            }
                            $term_counter++;
                        }
                    }

                    if ( 'listing' === $layout_type ) {
                    ?>
                        <p class="no-data display-none">Result not found.</p>
                    <?php
                    } elseif ( 'parent-img-list' === $layout_type ) {
                    ?>
                        </ul>
                    <?php
                    }
                    ?>
                </div>
            <?php
            }
            $html = ob_get_clean();
            return $html;

        }

        /**
         * Fetch dynamic product item/slide according to block attributes
         * @param $attributes
         * @return string
         * @since 1.0.0
         */
        public function mysgb_product_slider_render_callback( $attributes ) {

            $post_type          = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'not-to-be-missed';
            $taxonomies         = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array();
            $terms              = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'] ): array();
            $posts_per_page     = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
            $slider_active      = isset( $attributes['sliderActive'] ) ? $attributes['sliderActive'] : true;
            $min_slides         = isset( $attributes['minSlides'] ) ? $attributes['minSlides'] : 4;
            $slide_width        = isset( $attributes['slideWidth'] ) ? $attributes['slideWidth'] : 400;
            $autoplay           = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
            $infinite_loop      = isset( $attributes['infiniteLoop'] ) ? $attributes['infiniteLoop'] : true;
            $pager              = isset( $attributes['pager'] ) ? $attributes['pager'] : false;
            $controls           = isset( $attributes['controls'] ) ? $attributes['controls'] : false;
            $slider_speed       = isset( $attributes['sliderSpeed'] ) ? $attributes['sliderSpeed'] : 500;
            $order_by           = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
            $slider_margin      = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
            $order              = 'date' === $order_by ? 'DESC' : 'ASC';
            $arrow_icons        = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';
            $class_name         = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
            $query              = false;
            $final_key          = '';
            $cache_key          = $this->mysgb_get_taxonomy_term_cache_key( $taxonomies, $terms );

            if ( ! empty( $cache_key ) ) {
                $final_key      = mb_strimwidth( 'mysgb-product-slider-' . $post_type . '-' . $order_by . '-' . $posts_per_page . '-' . $cache_key, 0, 170 );
                $query          = get_transient( $final_key );
            }

            if ( false === $query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
                $query_args = array(
                    'post_type'      => $post_type,
                    'posts_per_page' => $posts_per_page,
                    'orderby'        => $order_by,
                    'order'          => $order,
                );

               $tax_query_args = $this->mysgb_get_tax_query_argument( $taxonomies, $terms );

                if ( count( $tax_query_args ) > 1 ) {
                    $query_args[ 'tax_query' ] = $tax_query_args;
                }

                $query = new WP_Query( $query_args );

                if ( ! empty( $cache_key ) ) {
                    set_transient( $final_key, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
                }

            }

            ob_start();

            if ( $query->have_posts() ) {
            ?>

                <div class="slider-arrow-main <?php echo esc_attr( $arrow_icons ); ?> <?php echo esc_attr( $class_name ); ?>">

                <?php
                    if ( $slider_active ) {
                    ?>
                        <div class="nab-dynamic-slider nab-box-slider products-listing-main" data-minslides="<?php echo esc_attr( $min_slides );?>" data-slidewidth="<?php echo esc_attr( $slide_width );?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
                    <?php
                    } else {
                    ?>
                        <div class="nab-dynamic-list nab-box-slider product-main products-listing-main">
                    <?php
                    }

                    while ( $query->have_posts() ) {

                        $query->the_post();

                        $thumbnail_url  = has_post_thumbnail() ? get_the_post_thumbnail_url() : plugins_url( 'assets/images/mys-placeholder.jpg', __FILE__ );

                        ?>
                        <div class="product-item">
                            <div class="product-inner">
                                <div class="media-img">
                                    <img src="<?php echo esc_url( $thumbnail_url ); ?>" class="img" alt="product-logo">
                                </div>
                                <h3 class="title">
                                    <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                                </h3>
                                <span class="subtitle">Company Name</span>
                                <p class="content"><?php echo esc_html( get_the_excerpt() ); ?></p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <p>No posts found.</p>
            <?php
            }

            wp_reset_postdata();

            $html = ob_get_clean();
            return $html;
        }

        /**
         * Fire on plugin activation and check the MYS Modules plugin is active or not
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
        * @return string
        * @since 1.0.0
        */
        public function mysgb_get_speaker_thumbnail_url() {
            return plugins_url( 'assets/images/speaker-placeholder.png', __FILE__ );
        }

        /**
         * Get mys show code
         * @return string
         * @since 1.0.0
         */
        public function mysgb_get_mys_show_code() {
            $nab_mys_urls = get_option( 'nab_mys_urls' );
            $show_code    = isset( $nab_mys_urls['show_code'] ) ? $nab_mys_urls['show_code'] : '';
            return $show_code;
        }

        /**
        * Return comma separated term list from given terms array
        * @param array $terms
        * @param string $type
        * @return string
        * @since 1.0.0
        */
        public function mysgb_get_comma_separated_term_list ( $terms = array(), $type = 'name' ) {

            $all_terms = array();

            if ( $terms && ! is_wp_error( $terms ) ) {
                foreach ( $terms as $term ) {
                    $all_terms[] = $term->{$type};
                }
            }
            return implode( ' | ', $all_terms );
        }

        /**
        * Generate cache key according to taxonomies and terms
        * @param $taxonomies
        * @param $terms
        * @return string
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
        * Prepare tax_query argument according to given taxonomies and terms
        * @param $taxonomies
        * @param $terms
        * @param $taxonomy_relation
        * @return array
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
        * Setup common slider attributes
        * @param int $min_slides
        * @return array
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
        * Generate popup link
        * @param $post_id
        * @param $post_type
        * @param string $display_text
        * @since 1.0.0
        */
        public function mysgb_generate_popup_link( $post_id, $post_type, $display_text = '', $class_name = '') {
        ?>
            <a href="#" class="detail-list-modal-popup <?php echo esc_attr( $class_name ); ?>" data-postid="<?php echo esc_attr( $post_id ); ?>" data-posttype="<?php echo esc_attr( $post_type ); ?>"> <?php echo esc_html( $display_text ); ?></a>
        <?php
        }

        /**
         * Create drop-down options for terms
         * @param string $taxonomy
         * @since 1.0
         */
        public function mysgb_get_term_list_options( $taxonomy = '' ) {

            if ( ! empty( $taxonomy ) ) {

                $all_terms = get_terms( array(
                    'taxonomy' => $taxonomy,
                    'hide_empty' => true,
                ) );

                if ( is_array( $all_terms ) && ! is_wp_error( $all_terms ) ) {

                    foreach ( $all_terms as $term ) {
                    ?>
                        <option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></option>
                    <?php
                    }
                }
            }
        }
    }
}
