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
         * Records if the scripts and styles have been enqueued so that we only
         * do so once.
         *
         * @var boolean
         */
        protected static $initiated = false;

        /**
         * Initializes WP hooks and filter
         * @since 1.0.0
         */
        public function mysgb_init_hook() {

            self::$initiated = true;

            // Filter for register new categories for custom block
            add_filter( 'block_categories', array( $this, 'mysgb_custom_block_category' ), 10, 2 );

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
            return array_merge(
                $categories,
                array(
                    array(
                        'slug'  => 'mysgb',
                        'title' => __( 'MYS Elements', 'mys-gutenberg-blocks' ),
                    ),
                )
            );
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
            wp_enqueue_script( 'mysgb-gutenberg-block', plugins_url( 'assets/js/blocks/block.build.js', __FILE__ ), array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components', 'jquery' ) );

            if ( 'nabshow-lv' !== get_option( 'stylesheet' ) ) {
                wp_enqueue_style( 'mysgb-blocks-style', plugin_dir_url( __FILE__ ) . 'assets/css/mysgb-blocks-admin.css');
            }
        }

        /*
         * Enqueue gutenberg custom block script and style for front side
         * @since 1.0
         */
        public static function mysgb_enqueue_front_script() {

            if ( 'nabshow-lv' !== get_option( 'stylesheet' ) ) {
                wp_enqueue_script( 'mysgb-blocks-script', plugins_url( 'assets/js/mysgb-blocks.js', __FILE__ ), array( 'jquery' ), null, true );
                wp_enqueue_script( 'mysgb-bx-slider',  plugins_url( 'assets/js/jquery.bxslider.min.js', __FILE__ ), array( 'jquery' ), null, true );

                wp_enqueue_style( 'mysgb-blocks-style', plugin_dir_url( __FILE__ ) . 'assets/css/mysgb-blocks.css');
                wp_enqueue_style( 'mysgb-bxslider-style', plugin_dir_url( __FILE__ ) . 'assets/css/jquery.bxslider.css' );
            }
        }

        /**
         * Register all dynamic blocks
         * @since 1.0.0
         */
        public function mysgb_register_dynamic_blocks() {

            register_block_type( 'mys/dynamic-slider', array(
                    'attributes'      => array(
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
                        'sliderActive' => array(
                            'type'    => 'boolean',
                            'default' => true
                        ),
                        'minSlides'    => array(
                            'type'    => 'number',
                            'default' => 4
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
                        'orderBy'      => array(
                            'type'    => 'string',
                            'default' => 'date'
                        ),
                        'slideMargin'  => array(
                            'type'    => 'number',
                            'default' => 30
                        ),
                        'displayTitle' => array(
                            'type' => 'boolean',
                            'default' => false
                        ),
                        'arrowIcons' => array(
                            'type' => 'string',
                            'default' => 'slider-arrow-1'
                        )
                    ),
                    'render_callback' => array( $this, 'mysgb_dynamic_slider_render_callback' ),
                )
            );

            register_block_type( 'mys/sessions-slider', array(
                    'attributes'      => array(
                        'itemToFetch'  => array(
                            'type'    => 'number',
                            'default' => 10,
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
                        'detailPopup'  => array(
                            'type'    => 'boolean',
                            'default' => false
                        ),
                        'sliderActive' => array(
                            'type'    => 'boolean',
                            'default' => true
                        ),
                        'minSlides'    => array(
                            'type'    => 'number',
                            'default' => 4
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
                        'orderBy'      => array(
                            'type'    => 'string',
                            'default' => 'date'
                        ),
                        'slideMargin'  => array(
                            'type'    => 'number',
                            'default' => 30
                        ),
                        'layout'      => array(
                            'type'    => 'string',
                            'default' => 'with-featured'
                        ),
                        'sliderLayout'      => array(
                            'type'    => 'string',
                            'default' => 'layout-1'
                        ),
                        'arrowIcons' => array(
                            'type' => 'string',
                            'default' => 'slider-arrow-1'
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

                    ),
                    'render_callback' => array( $this, 'mysgb_session_slider_render_callback' ),
                )
            );

            register_block_type( 'mys/exhibitors-slider', array(
                    'attributes'      => array(
                        'itemToFetch'  => array(
                            'type'    => 'number',
                            'default' => 10,
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
                        'detailPopup'  => array(
                            'type'    => 'boolean',
                            'default' => false
                        ),
                        'sliderActive' => array(
                            'type'    => 'boolean',
                            'default' => true
                        ),
                        'minSlides'    => array(
                            'type'    => 'number',
                            'default' => 4
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
                        'sliderMode'   => array(
                            'type'    => 'string',
                            'default' => 'horizontal'
                        ),
                        'slideWidth'   => array(
                            'type'    => 'number',
                            'default' => 400
                        ),
                        'orderBy'      => array(
                            'type'    => 'string',
                            'default' => 'date'
                        ),
                        'slideMargin'  => array(
                            'type'    => 'number',
                            'default' => 30
                        ),
                        'arrowIcons' => array(
                            'type' => 'string',
                            'default' => 'slider-arrow-1'
                        ),
                        'taxonomyRelation'  => array(
                            'type'    => 'boolean',
                            'default' => false
                        ),

                    ),
                    'render_callback' => array( $this, 'mysgb_exhibitors_slider_render_callback' ),
                )
            );

            register_block_type( 'mys/speaker-slider', array(
                    'attributes'      => array(
                        'itemToFetch'  => array(
                            'type'    => 'number',
                            'default' => 10,
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
                        'detailPopup'  => array(
                            'type'    => 'boolean',
                            'default' => false
                        ),
                        'sliderActive' => array(
                            'type'    => 'boolean',
                            'default' => true
                        ),
                        'minSlides'    => array(
                            'type'    => 'number',
                            'default' => 4
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
                        'slideShape'   => array(
                            'type'    => 'string',
                            'default' => 'circle'
                        ),
                        'slideWidth'   => array(
                            'type'    => 'number',
                            'default' => 400
                        ),
                        'orderBy'      => array(
                            'type'    => 'string',
                            'default' => 'date'
                        ),
                        'slideMargin'  => array(
                            'type'    => 'number',
                            'default' => 30
                        ),
                        'arrowIcons' => array(
                            'type' => 'string',
                            'default' => 'slider-arrow-1'
                        )
                    ),
                    'render_callback' => array( $this, 'mysgb_speaker_slider_render_callback' ),
                )
            );

            register_block_type( 'mys/sponsors-partners', array(
                    'attributes'      => array(
                        'layout'     => array(
                            'type'    => 'string',
                            'default' => 'without-title',
                        ),
                        'itemToFetch'  => array(
                            'type'    => 'number',
                            'default' => 10,
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
                    ),
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
                    ),
                    'render_callback' => array( $this, 'mysgb_product_winner_render_callback' ),
                )
            );

            register_block_type( 'mys/tracks-slider', array(
                    'attributes'      => array(
                        'itemToFetch'  => array(
                            'type'    => 'number',
                            'default' => 10,
                        ),
                        'sliderActive' => array(
                            'type'    => 'boolean',
                            'default' => true
                        ),
                        'minSlides'    => array(
                            'type'    => 'number',
                            'default' => 4
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
                        'order'      => array(
                            'type'    => 'string',
                            'default' => 'ASC'
                        ),
                        'slideMargin'  => array(
                            'type'    => 'number',
                            'default' => 30
                        ),
                        'arrowIcons' => array(
                            'type' => 'string',
                            'default' => 'slider-arrow-1'
                        ),
                        'featuredTag' => array(
                            'type'    => 'boolean',
                            'default' => false
                        ),
                        'categoryType' => array(
                            'type'    => 'string',
                            'default' => 'tracks'
                        )

                    ),
                    'render_callback' => array( $this, 'mysgb_tracks_slider_render_callback' ),
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
            $class_name    = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';

            $query          = get_transient( 'mysgb-get-dynamic-slider-post-cache' . $post_type );

            if ( false === $query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
                $query_args = array(
                    'post_type'      => $post_type,
                    'posts_per_page' => $posts_per_page,
                    'orderby'        => $order_by,
                    'order'          => $order,
                    'meta_key'       => '_thumbnail_id',
                );

                $tax_query_args = array('relation' => 'OR');

                foreach ( $taxonomies as $taxonomy ) {
                    if ( isset($terms->{$taxonomy}) && count($terms->{$taxonomy}) > 0 ) {
                        $tax_query_args[] = array (
                            'taxonomy' => $taxonomy,
                            'field'    => 'slug',
                            'terms'    => $terms->{$taxonomy},
                        );
                    }
                }

                $count_query_args = count($tax_query_args);

                if ( $count_query_args > 1 ) {
                    $query_args['tax_query'] = $tax_query_args;
                }

                $query = new WP_Query($query_args);

                set_transient( 'mysgb-get-dynamic-slider-post-cache' . $post_type, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
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
                        ?>
                                    <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php the_title(); ?>">
                        <?php
                        if ( $display_title ) {
                        ?>
                                    <div class="flip-box-back rounded-circle">
                                        <h6><?php echo esc_html( get_the_title() ); ?></h6>
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
            $post_type         = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'sessions';
            $taxonomies        = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array();
            $terms             = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'] ): array();
            $posts_per_page    = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
            $detail_popup      = isset( $attributes['detailPopup'] ) ? $attributes['detailPopup'] : false;
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

            if ( 'date-group' === $layout &&  ! $slider_active ) {
                $query  = get_transient( 'mys-get-session-date-group-post-cache' . $post_type );
            } elseif ( 'rand' === $order_by ) {
                $query  = get_transient( 'mys-get-session-slider-rand-post-cache' . $post_type );
            } else {
                $query  = get_transient( 'mys-get-session-slider-post-cache' . $post_type );
            }


            if ( false === $query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {

                $query_args = array(
                    'post_type'      => $post_type,
                );

                if ( 'date-group' === $layout &&  ! $slider_active ) {
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

                if ( isset( $attributes['metaDate'] ) && $attributes['metaDate'] ) {
                     $session_date   = new DateTime( $attributes['sessionDate'] );
                     $session_date   = $session_date->format( 'Y-m-d' );
                     $query_args['meta_key'] = 'date';
                     $query_args['meta_value'] = $session_date . ' 00:00:00';
                }

                $tax_query_args = array('relation' => $taxonomy_relation);

                foreach ( $taxonomies as $taxonomy ) {
                    if ( isset($terms->{$taxonomy}) && count($terms->{$taxonomy}) > 0 ) {
                        $tax_query_args[] = array (
                            'taxonomy' => $taxonomy,
                            'field'    => 'slug',
                            'terms'    => $terms->{$taxonomy},
                        );
                    }
                }

                $count_query_args = count($tax_query_args);

                if ( $count_query_args > 1 ) {
                    $query_args['tax_query'] = $tax_query_args;
                }

                $query = new WP_Query($query_args);

                if ( 'date-group' === $layout &&  ! $slider_active ) {
                    set_transient( 'mys-get-session-date-group-post-cache' . $post_type, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
                } elseif ( 'rand' !== $order_by ) {
                    set_transient( 'mys-get-session-slider-post-cache' . $post_type, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
                } else {
                    set_transient( 'mys-get-session-slider-rand-post-cache' . $post_type, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
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

                        $start_time = str_replace( array( 'am','pm' ), array( 'a.m.','p.m.' ), date_format( date_create( $start_time ), 'g:i a' ) );
                        $end_time   = str_replace( array( 'am','pm' ), array( 'a.m.','p.m.' ), date_format( date_create( $end_time ), 'g:i a' ) );

                        if ( $date_group !== $date ) {
                            $date_group = $date;
                            $row_count = 1;
                        ?>
                            <h2><?php echo esc_html( date("Y-m-d", strtotime( $date ) ) ); ?></h2>
                            <div class="schedule-data">
                        <?php
                        }
                        ?>
                        <div class="schedule-row <?php echo $row_count > 10 ? esc_attr('hide-row') : ''; ?>">
                            <div class="date">
                                <p><?php echo esc_html( $start_time ); ?> - <?php echo esc_html( $end_time ); ?></p>
                            </div>
                            <div class="name">
                                <?php
                                if ( $detail_popup ) {
                                ?>
                                    <strong>
                                        <a href="#" class="detail-list-modal-popup" data-postid="<?php echo esc_attr( get_the_ID() ); ?>" data-posttype="<?php echo esc_attr( $post_type ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                                    </strong>
                                <?php
                                } else {
                                ?>
                                    <strong><?php echo esc_html( get_the_title() ); ?></strong>
                                <?php
                                }
                                ?>

                            </div>
                            <div class="details">
                            <?php
                                $speakers    = get_post_meta( $session_id, 'speakers', true );
                                $speaker_ids = explode(',', $speakers);
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
                       $next_post_id = isset( $query->posts[$counter]->ID ) ? get_post_meta( $query->posts[$counter]->ID, 'date', true ) : '';
                       if ( $date_group !== $next_post_id ) {
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
                if ( 'rand' === $order_by ) {
                    $post_ids = $query->posts;
                    shuffle( $post_ids );
                    $post_ids = array_splice( $post_ids, 0, $posts_per_page );
                    $query = new WP_Query( array( 'post_type' => $post_type, 'post__in' => $post_ids, 'posts_per_page' =>  count( $post_ids ), 'orderby' => 'post__in' ) );
                }

                if ( $query->have_posts() ) {
                    ?>
                        <div class="slider-arrow-main <?php echo esc_attr( $arrow_icons ); ?> <?php echo esc_attr( $class_name ); ?>">
                    <?php
                    if ( $slider_active ) {
                        $layout = '';
                    ?>
                        <div class="nab-dynamic-slider nab-box-slider session" data-minslides="<?php echo esc_attr($min_slides);?>" data-slidewidth="<?php echo esc_attr($slide_width);?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
                    <?php
                    } else {
                    ?>
                        <div class="nab-dynamic-list session row <?php echo ! empty( $layout ) ? esc_attr( $layout ) : esc_attr('');?>" id="<?php echo 'with-masonry' === $layout ? esc_attr('card_section') : esc_attr('');?>">
                    <?php
                    }

                    while ( $query->have_posts() ) {

                        $query->the_post();

                        $session_id          = get_the_ID();
                        $date                = get_post_meta( $session_id, 'date', true );
                        $start_time          = get_post_meta( $session_id, 'starttime', true );
                        $end_time            = get_post_meta( $session_id, 'endtime', true );
                        $date                = date_format( date_create( $date ), 'M d' );
                        $start_time          = str_replace( array('am','pm'), array('a.m.','p.m.'), date_format( date_create( $start_time ), 'g:i a' ) );
                        $end_time            = str_replace( array('am','pm'), array('a.m.','p.m.'), date_format( date_create( $end_time ), 'g:i a' ) );
                        $date_display_format = 'layout-1' === $slider_layout || ! $slider_active ? $date . ' | ' . $start_time . ' - ' . $end_time : $start_time . ' - ' . $end_time;

						$post_tracks         = get_the_terms( $session_id, 'tracks' );
						$all_tracks_string   = $this->mysgb_get_comma_separated_term_list( $post_tracks, 'slug');
						$featured_post       = has_term( 'featured', 'session-categories' ) ? 'featured' : '';

                        ?>
                            <div class="item" data-featured="<?php echo esc_attr( $featured_post ); ?>" data-tracks="<?php echo esc_attr( $all_tracks_string ); ?>">
                        <?php
                            if ( $detail_popup && $slider_active ) {

                                $this->mysgb_generate_popup_link( $session_id, $post_type );

                            }
                            if ( 'with-featured' === $layout && has_post_thumbnail() ) {
                            ?>
                                <img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="session-logo">
                            <?php
                            }
                            ?>

                            <h4><?php echo esc_html( get_the_title() ); ?></h4>

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
                            ?>
                                <p>
                                <?php

                                    echo esc_html( get_the_excerpt() );

                                    $this->mysgb_generate_popup_link( $session_id, $post_type, 'Read More' );
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

                                                    $speaker_job_title = get_post_meta( get_the_ID(), 'title', true );
                                                    $speaker_company   = get_post_meta( get_the_ID(), 'company', true );

                                                    ?>
                                                        <div class="speaker-single">
                                                            <div class="img-box">
                                                                <img src="<?php echo esc_url( $speaker_thumbnail_url ); ?>" alt="speaker-logo" class="rounded-circle" />
                                                            </div>
                                                            <div class="info-box">
                                                                <h4 class="title"><?php echo esc_html( get_the_title() ); ?></h4>
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

                                <a href="javascript:void(0);">View in Planner</a>
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

            $post_type         = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'exhibitors';
            $taxonomies        = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array();
            $terms             = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'] ): array();
            $posts_per_page    = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
            $detail_popup      = isset( $attributes['detailPopup'] ) ? $attributes['detailPopup'] : false;
            $taxonomy_relation = isset( $attributes['taxonomyRelation'] ) && $attributes['taxonomyRelation'] ? 'AND' : 'OR';
            $slider_active     = isset( $attributes['sliderActive'] ) ? $attributes['sliderActive'] : true;
            $min_slides        = isset( $attributes['minSlides'] ) ? $attributes['minSlides'] : 4;
            $slide_width       = isset( $attributes['slideWidth'] ) ? $attributes['slideWidth'] : 400;
            $autoplay          = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
            $infinite_loop     = isset( $attributes['infiniteLoop'] ) ? $attributes['infiniteLoop'] : true;
            $pager             = isset( $attributes['pager'] ) ? $attributes['pager'] : false;
            $controls          = isset( $attributes['controls'] ) ? $attributes['controls'] : false;
            $slider_speed      = isset( $attributes['sliderSpeed'] ) ? $attributes['sliderSpeed'] : 500;
            $slider_mode       = isset( $attributes['sliderMode'] ) ? $attributes['sliderMode'] : 'horizontal';
            $order_by          = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
            $slider_margin     = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
            $class_name        = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
            $order             = 'date' === $order_by ? 'DESC' : 'ASC';
            $arrow_icons       = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';

            $query             = get_transient( 'mys-get-exhibitors-slider-post-cache' . $post_type );

            if ( false === $query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
                $query_args = array(
                    'post_type'      => $post_type,
                    'posts_per_page' => $posts_per_page,
                    'orderby'        => $order_by,
                    'order'          => $order,
                );

                $tax_query_args = array('relation' => $taxonomy_relation );

                foreach ( $taxonomies as $taxonomy ) {
                    if ( isset($terms->{$taxonomy}) && count($terms->{$taxonomy}) > 0 ) {
                        $tax_query_args[] = array (
                            'taxonomy' => $taxonomy,
                            'field'    => 'slug',
                            'terms'    => $terms->{$taxonomy},
                        );
                    }
                }

                $count_query_args = count($tax_query_args);

                if ( $count_query_args > 1 ) {
                    $query_args['tax_query'] = $tax_query_args;
                }

                $query = new WP_Query($query_args);

                set_transient( 'mys-get-exhibitors-slider-post-cache' . $post_type, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
            }

            ob_start();

            if ( $query->have_posts() ) {
                ?>
                    <div class="slider-arrow-main <?php echo esc_attr($arrow_icons); ?> <?php echo esc_attr( $class_name ); ?>">
                <?php

                    if ( $slider_active ) {
                    ?>
                        <div class="nab-dynamic-slider nab-box-slider exhibitors" data-minslides="<?php echo esc_attr($min_slides);?>" data-slidewidth="<?php echo esc_attr($slide_width);?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-mode="<?php echo esc_attr($slider_mode);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
                    <?php
                    } else {
                    ?>
                        <div class="nab-dynamic-list exhibitors">
                    <?php
                    }

                    while ( $query->have_posts() ) {

                        $query->the_post();

                        $exhibitor_id = get_the_ID();
                    ?>
                        <div class="item">
                            <?php
                            if ( $detail_popup && $slider_active ) {
                                $this->mysgb_generate_popup_link( $exhibitor_id, $post_type );
                            }
                            ?>
                            <div class="item-inner">
                                <?php
                                if ( has_post_thumbnail() ) {
                                ?>
                                    <img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="exhibitor-logo">
                                <?php
                                } elseif ( $slider_active ) {
                                ?>
                                     <h4 class="exhibitor-title"><?php echo esc_html( get_the_title() ); ?></h4>
                                <?php
                                }
                                if ( ! $slider_active ) {
                                    $booth_number = get_post_meta( $exhibitor_id, 'boothnumbers', true );
                                    $exh_id       = get_post_meta( $exhibitor_id, 'exhid', true );
                                    $exh_url      = 'https://ces20.mapyourshow.com/8_0/exhibitor/exhibitor-details.cfm?exhid=' . $exh_id;
                                ?>
                                    <h4><?php echo esc_html( get_the_title() ); ?></h4>
                                    <span><?php echo esc_html( $booth_number ); ?></span>
                                    <p>
                                    <?php
                                        echo esc_html( get_the_excerpt() );
                                        $this->mysgb_generate_popup_link( $exhibitor_id, $post_type, 'Read More');
                                    ?>
                                    </p>
                                    <a href="<?php echo esc_url( $exh_url ); ?>">View in Planner</a>
                                <?php
                                }
                                ?>
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
         * Fetch dynamic speaker slider item/slide according to block attributes
         *
         * @param $attributes
         *
         * @return string
         * @since 1.0.0
         */
        public function mysgb_speaker_slider_render_callback( $attributes ) {
            $post_type      = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'speakers';
            $taxonomies     = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array();
            $terms          = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'] ): array();
            $posts_per_page = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
            $detail_popup   = isset( $attributes['detailPopup'] ) ? $attributes['detailPopup'] : false;
            $slider_active  = isset( $attributes['sliderActive'] ) ? $attributes['sliderActive'] : true;
            $min_slides     = isset( $attributes['minSlides'] ) ? $attributes['minSlides'] : 4;
            $slide_width    = isset( $attributes['slideWidth'] ) ? $attributes['slideWidth'] : 400;
            $autoplay       = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
            $infinite_loop  = isset( $attributes['infiniteLoop'] ) ? $attributes['infiniteLoop'] : true;
            $pager          = isset( $attributes['pager'] ) ? $attributes['pager'] : false;
            $controls       = isset( $attributes['controls'] ) ? $attributes['controls'] : false;
            $slider_speed   = isset( $attributes['sliderSpeed'] ) ? $attributes['sliderSpeed'] : 500;
            $slider_shape   = isset( $attributes['slideShape'] ) ? $attributes['slideShape'] : 'rectangle';
            $order_by       = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
            $slider_margin  = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
            $order          = 'date' === $order_by ? 'DESC' : 'ASC';
            $arrow_icons    = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';
            $class_name     = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
            $item_class     = 'circle' === $slider_shape && $slider_active ? '' : 'display-title';

            $query          = get_transient( 'mysgb-get-speaker-slider-post-cache' . $post_type );

            if ( false === $query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
                $query_args = array(
                    'post_type'      => $post_type,
                    'posts_per_page' => $posts_per_page,
                    'orderby'        => $order_by,
                    'order'          => $order,
                );

                $tax_query_args = array('relation' => 'OR');

                foreach ( $taxonomies as $taxonomy ) {
                    if ( isset($terms->{$taxonomy}) && count($terms->{$taxonomy}) > 0 ) {
                        $tax_query_args[] = array (
                            'taxonomy' => $taxonomy,
                            'field'    => 'slug',
                            'terms'    => $terms->{$taxonomy},
                        );
                    }
                }

                $count_query_args = count($tax_query_args);

                if ( $count_query_args > 1 ) {
                    $query_args['tax_query'] = $tax_query_args;
                }

                $query = new WP_Query($query_args);

                set_transient( 'mysgb-get-speaker-slider-post-cache' . $post_type, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
            }

            ob_start();

            if ( $query->have_posts() ) {
            ?>
                <div class="slider-arrow-main <?php echo esc_attr($arrow_icons); ?> <?php echo esc_attr( $class_name ); ?>">
            <?php
                    if ( $slider_active ) {
                    ?>
                        <div class="nab-dynamic-slider items-md nab-box-slider speakers" data-minslides="<?php echo esc_attr($min_slides);?>" data-slidewidth="<?php echo esc_attr($slide_width);?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
                    <?php
                    } else {
                    ?>
                        <div class="nab-dynamic-list nab-box-slider speakers">
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

                    ?>
                        <div class="item <?php echo esc_attr( $item_class ); ?>">
                            <?php
                            if ( $detail_popup ) {
                                $this->mysgb_generate_popup_link( $speaker_id, $post_type );
                            }
                            ?>
                            <div class="flip-box">
                                <div class="flip-box-inner">
                                    <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="speaker-logo" class="<?php echo 'circle' === $slider_shape ? esc_attr('rounded-circle') : ''; ?>">
                                    <div class="flip-box-back rounded-circle">
                                        <h6><?php echo esc_html( get_the_title() ); ?></h6>
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
            $layout          = isset( $attributes['layout'] ) && ! empty( $attributes['layout'] ) ? $attributes['layout'] : 'without-title';
            $post_type       = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'sponsors';
            $taxonomies      = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array();
            $terms           = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'] ): array();
            $posts_per_page  = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
            $order_by        = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
            $order           = 'date' === $order_by ? 'DESC' : 'ASC';
            $class_name      = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';

            $query          = get_transient( 'mysgb-get-sponsors-partners-post-cache' . $post_type );

            if ( false === $query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {

                $query_args = array(
                    'post_type'      => $post_type,
                    'posts_per_page' => $posts_per_page,
                    'orderby'        => $order_by,
                    'order'          => $order,
                    'meta_key'       => '_thumbnail_id',
                );

                $tax_query_args = array('relation' => 'OR');

                foreach ( $taxonomies as $taxonomy ) {
                    if ( isset($terms->{$taxonomy}) && count($terms->{$taxonomy}) > 0 ) {
                        $tax_query_args[] = array (
                            'taxonomy' => $taxonomy,
                            'field'    => 'slug',
                            'terms'    => $terms->{$taxonomy},
                        );
                    }
                }

                $count_query_args = count($tax_query_args);

                if ( $count_query_args > 1 ) {
                    $query_args['tax_query'] = $tax_query_args;
                }

                $query = new WP_Query($query_args);

                set_transient( 'mysgb-get-sponsors-partners-post-cache' . $post_type, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
            }

            ob_start();

            if ( $query->have_posts() ) {
            ?>
                <ul class="partner-listing <?php echo esc_attr( $class_name ); ?>">
            <?php
                while ( $query->have_posts() ) {

                    $query->the_post();
                    $thumbnail_url = get_the_post_thumbnail_url();

                    ?>
                        <li>
                            <figure class="partner-img-box"><img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>"></figure>
                            <?php
                            if ( 'with-title' === $layout ) {
                                $sponsor_type = get_post_meta( get_the_ID(), 'sponsor_type', true );
                            ?>
                                <span><?php echo esc_html( $sponsor_type ); ?></span>
                            <?php
                            }
                            ?>
                        </li>
                    <?php
                }
            ?>
                </ul>
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
            $post_type      = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'not-to-be-missed';
            $taxonomies     = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array('featured-category');
            $terms          = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'], true ): array();
            $posts_per_page = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
            $order_by       = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
            $order          = 'date' === $order_by ? 'DESC' : 'ASC';
            $class_name     = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';

            ob_start();
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

            $terms          = get_transient( 'mys-get-category-slider-cache-' . $category_type );

            if ( false === $terms || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {

                $args = array(
                    'taxonomy'   => $category_type,
                    'hide_empty' => false,
                    'number'     => $posts_per_page,
                    'orderBy'    => 'name',
                    'order'      => $order,
                );
                if ( $featured_track ) {
                    $args['meta_query'] = array(
                                array(
                                   'key'       => 'featured_tag',
                                   'value'     => 'on',
                                   'compare'   => '='
                                )
                            );
                }
                $terms = get_terms( $args );

                set_transient( 'mys-get-category-slider-cache-' . $category_type, $terms, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
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
            return implode( ',', $all_terms );
        }

        /**
        * Generate popup link
        * @param $post_id
        * @param $post_type
        * @param string $display_text
        */
        public function mysgb_generate_popup_link( $post_id, $post_type, $display_text = '' ) {
        ?>
            <a href="#" class="detail-list-modal-popup <?php echo ! empty( $display_text ) ? esc_attr('read-more-popup') : ''; ?>" data-postid="<?php echo esc_attr( $post_id ); ?>" data-posttype="<?php echo esc_attr( $post_type ); ?>"> <?php echo esc_html( $display_text ); ?></a>
        <?php
        }
    }
}
