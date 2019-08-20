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

            // Add menu page
            add_action( 'admin_menu', array( $this, 'mysgb_add_menu_page' ) );

            // Enqueue style for setting page
            add_action( 'admin_enqueue_scripts', array( $this, 'mysgb_settings_page_style' ), 999 );

            //call register settings function
            add_action( 'admin_init', array( $this, 'mysgb_register_plugin_settings' ) );

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
        * Register a Setting Page
        * @since 1.0.0
        */
        public function mysgb_add_menu_page() {

			add_submenu_page( 'mys-sync', __( 'MYS Blocks', 'mys-gutenberg-blocks' ), __( 'MYS Blocks', 'mys-gutenberg-blocks' ), 'manage_options', 'mysgb-settings', array( $this, 'mysgb_settings_page' ) );

			add_submenu_page( null, 'About Plugin', 'About Plugin', 'manage_options', 'mysgb-about', array( $this, 'mysgb_about_plugin_page' ) );
		}

		/**
        * Enqueue setting page css
        * @since 1.0.0
        */
		public function mysgb_settings_page_style() {

            if ( ! wp_style_is('mys-settings-css', 'enqueued') ) {
                wp_enqueue_style( 'mysgb-settings-style', plugin_dir_url( __FILE__ ) . 'assets/css/mysgb-settings.css', array(), false);
		    }
        }

        /**
        * Register plugin settings
        * @since 1.0.0
        */
        public function mysgb_register_plugin_settings() {

            register_setting( 'mysgb-settings-group', 'mysgb_disable_script' );
            register_setting( 'mysgb-settings-group', 'mysgb_disable_style' );
        }

		public function mysgb_settings_page() {
            require_once( plugin_dir_path( __FILE__ ) . 'inc/html-mysgb-settings-page.php' );
		}

		public function mysgb_about_plugin_page() {
            require_once( plugin_dir_path( __FILE__ ) . 'inc/html-mysgb-about-plugin.php' );
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

            if ( 'yes' !== get_option( 'mysgb_disable_style' ) ) {
                wp_enqueue_style( 'mysgb-blocks-style', plugin_dir_url( __FILE__ ) . 'assets/css/mysgb-blocks-admin.css');
            }
        }

        /*
         * Enqueue gutenberg custom block script and style for front side
         * @since 1.0
         */
        public static function mysgb_enqueue_front_script() {

            if ( 'yes' !== get_option( 'mysgb_disable_script' ) ) {
                wp_enqueue_script( 'mysgb-blocks-script', plugins_url( 'assets/js/mysgb-blocks.js', __FILE__ ), array( 'jquery' ), null, true );
                wp_enqueue_script( 'mysgb-bx-slider',  plugins_url( 'assets/js/jquery.bxslider.min.js', __FILE__ ), array( 'jquery' ), null, true );
            }

            if ( 'yes' !== get_option( 'mysgb_disable_style' ) ) {
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
                        'slideShape'   => array(
                            'type'    => 'string',
                            'default' => 'rectangle'
                        ),
                        'sliderMode'   => array(
                            'type'    => 'string',
                            'default' => 'horizontal'
                        ),
                        'slideWidth'   => array(
                            'type'    => 'number',
                            'default' => 400
                        ),
                        'flip'         => array(
                            'type'    => 'boolean',
                            'default' => false
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
                        )

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
                        )

                    ),
                    'render_callback' => array( $this, 'mysgb_exhibitors_slider_render_callback' ),
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
            $slider_mode    = isset( $attributes['sliderMode'] ) ? $attributes['sliderMode'] : 'horizontal';
            $slider_shape   = isset( $attributes['slideShape'] ) ? $attributes['slideShape'] : 'rectangle';
            $flip           = isset( $attributes['flip'] ) ? $attributes['flip'] : false;
            $order_by       = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
            $slider_margin  = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
            $order          = 'date' === $order_by ? 'DESC' : 'ASC';
            $display_title  = isset( $attributes['displayTitle'] ) ? $attributes['displayTitle'] : false;
            $arrow_icons    = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';
            $class_name    = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';

            $query          = get_transient( 'mysgb-get-dynamic-slider-post-cache' . $post_type );

            if ( false === $query || is_user_logged_in() ) {
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

                if ( $count_query_args > 0 ) {
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
                        <div class="nab-dynamic-slider nab-box-slider <?php echo esc_attr($class_name); ?>" data-minslides="<?php echo esc_attr($min_slides);?>" data-slidewidth="<?php echo esc_attr($slide_width);?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-mode="<?php echo esc_attr($slider_mode);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
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
                        if ( $display_title || ( 'circle' === $slider_shape && true === $flip ) ) {
                        ?>
                            <div class="flip-box">
                                <div class="flip-box-inner">
                        <?php
                        }
                        ?>
                                    <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php the_title(); ?>" class="<?php echo 'circle' === $slider_shape ? esc_attr('rounded-circle') : ''; ?>">
                        <?php
                        if ( $display_title || ( 'circle' === $slider_shape && true === $flip ) ) {
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
            $post_type      = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'sessions';
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
            $slider_mode    = isset( $attributes['sliderMode'] ) ? $attributes['sliderMode'] : 'horizontal';
            $order_by       = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
            $slider_margin  = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
            $order          = 'date' === $order_by ? 'DESC' : 'ASC';
            $layout         = isset( $attributes['layout'] ) && ! empty( $attributes['layout'] ) ? $attributes['layout'] : '';
            $slider_layout  = isset( $attributes['sliderLayout'] ) && ! empty( $attributes['sliderLayout'] ) ? $attributes['sliderLayout'] : '';
            $arrow_icons    = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';

            $query          = get_transient( 'mys-get-session-slider-post-cache' . $post_type );

            if ( false === $query || is_user_logged_in() ) {
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

                if ( $count_query_args > 0 ) {
                    $query_args['tax_query'] = $tax_query_args;
                }

                $query = new WP_Query($query_args);

                set_transient( 'mys-get-session-slider-post-cache' . $post_type, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
            }

            ob_start();

            if ( $query->have_posts() ) {
                ?>
                    <div class="slider-arrow-main <?php echo esc_attr($arrow_icons); ?>">
                <?php
                if ( $slider_active ) {
                    $layout = '';
                ?>
                    <div class="nab-dynamic-slider nab-box-slider session" data-minslides="<?php echo esc_attr($min_slides);?>" data-slidewidth="<?php echo esc_attr($slide_width);?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-mode="<?php echo esc_attr($slider_mode);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
                <?php
                } else {
                ?>
                    <div class="nab-dynamic-list session row <?php echo ! empty( $layout ) ? esc_attr( $layout ) : esc_attr('');?>" id="<?php echo 'with-masonry' === $layout ? esc_attr('card_section') : esc_attr('');?>">
                <?php
                }

                while ( $query->have_posts() ) {

                    $query->the_post();

                    $date       = get_post_meta( get_the_ID(), 'date', true );
                    $start_time = get_post_meta( get_the_ID(), 'starttime', true );
                    $end_time   = get_post_meta( get_the_ID(), 'endtime', true );
                    $date       = date_format( date_create( $date ), 'M d' );
                    $start_time = date_format( date_create( $start_time ), 'h:i a' );
                    $end_time   = date_format( date_create( $end_time ), 'h:i a' );

                    $date_display_format = 'layout-1' === $slider_layout || ! $slider_active ? $date . ' | ' . $start_time . ' - ' . $end_time : $start_time . ' - ' . $end_time;
                 ?>
                    <div class="item">
                        <?php
                        if ( 'with-featured' === $layout ) {

                            if ( has_post_thumbnail( get_the_ID() ) ) {
                                $thumbnail_url = get_the_post_thumbnail_url();
                            } else {
                                $thumbnail_url = plugins_url( 'assets/images/mys-placeholder.jpg', __FILE__ );
                            }
                        ?>
                            <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                        <?php
                        }
                        ?>

                        <h4><?php echo esc_html( get_the_title() ); ?></h4>

                        <?php
                        if ( $slider_active ) {
                        ?>
                            <span class="caption"><?php echo 'layout-1' === $slider_layout ? esc_html( get_post_meta( get_the_ID(), 'type', true ) ) : esc_html( $date ); ?></span>
                        <?php
                        }
                        ?>

                        <span class="date-time"><?php echo esc_html( $date_display_format );?></span>

                        <?php
                        if ( 'with-featured' === $layout || 'with-masonry' === $layout ) {
                        ?>
                            <p><?php echo esc_html( get_the_excerpt() ); ?></p>

                            <?php
                                if ( 'with-masonry' === $layout ) {

                                    $speaker = get_post_meta( get_the_ID(), 'speakerid', true );

                                    if ( ! empty( $speaker ) ) {

                                        $speaker_query = get_transient( 'mys-session-slider-speaker-post-cache' . $speaker );

                                        if ( false === $speaker_query ) {

                                            $speaker_ids = explode(',', $speaker);

                                            $speaker_query_args = array(
                                                'post_type'      => 'speakers',
                                                'posts_per_page' => 10,
                                                'meta_key'       => 'speakerid',
                                                'meta_query'     => array(

                                                        'key'       => 'speakerid',
                                                        'value'     => $speaker_ids,
                                                        'compare'   => 'IN'
                                                )
                                            );

                                            $speaker_query = new WP_Query($speaker_query_args);

                                            set_transient( 'mys-session-slider-speaker-post-cache' . $speaker, $speaker_query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );

                                        }

                                        if ( $speaker_query->have_posts() ) {

                                            while ( $speaker_query->have_posts() ) {

                                                $speaker_query->the_post();

                                                if ( has_post_thumbnail( get_the_ID() ) ) {
                                                    $speaker_thumbnail_url = get_the_post_thumbnail_url();
                                                } else {
                                                    $speaker_thumbnail_url = plugins_url( 'assets/images/mys-placeholder.jpg', __FILE__ );
                                                }

                                                $speaker_job_title = get_post_meta( get_the_ID(), 'title', true );
                                                $speaker_company   = get_post_meta( get_the_ID(), 'company', true );

                                                ?>
                                                    <div class="speaker-single">
                                                        <div class="img-box">
                                                            <img src="<?php echo esc_url( $speaker_thumbnail_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="rounded-circle" />
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

                            <a href="<?php echo esc_url( get_the_permalink() ); ?>">Read More</a>
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
         * Fetch dynamic Exhibitors slider item/slide according to attributes
         *
         * @param $attributes
         *
         * @return string
         * @since 1.0.0
         */
        public function mysgb_exhibitors_slider_render_callback( $attributes ) {
            $post_type      = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'exhibitors';
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
            $slider_mode    = isset( $attributes['sliderMode'] ) ? $attributes['sliderMode'] : 'horizontal';
            $order_by       = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
            $slider_margin  = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
            $order          = 'date' === $order_by ? 'DESC' : 'ASC';
            $arrow_icons    = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';

            $query          = get_transient( 'mys-get-exhibitors-slider-post-cache' . $post_type );

            if ( false === $query || is_user_logged_in() ) {
                $query_args = array(
                    'post_type'      => $post_type,
                    'posts_per_page' => $posts_per_page,
                    'orderby'        => $order_by,
                    'order'          => $order,
                );

                if ( $slider_active ) {
                    $query_args['meta_key'] = '_thumbnail_id';
                }

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

                if ( $count_query_args > 0 ) {
                    $query_args['tax_query'] = $tax_query_args;
                }

                $query = new WP_Query($query_args);

                set_transient( 'mys-get-exhibitors-slider-post-cache' . $post_type, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
            }

            ob_start();

            if ( $query->have_posts() ) {
                ?>
                    <div class="slider-arrow-main <?php echo esc_attr($arrow_icons); ?>">
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
                    if ( has_post_thumbnail( get_the_ID() ) ) {
                        $thumbnail_url = get_the_post_thumbnail_url();
                    } else {
                        $thumbnail_url = plugins_url( 'assets/images/mys-placeholder.jpg', __FILE__ );
                    }
                    ?>
                        <div class="item">
                            <div class="item-inner">
                                <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">

                                <?php
                                if ( ! $slider_active ) {
                                    $booth_number = get_post_meta( get_the_ID(), 'boothnumber', true );
                                ?>
                                    <h4><?php echo esc_html( get_the_title() ); ?></h4>
                                    <span><?php echo esc_html( $booth_number ); ?></span>
                                    <p><?php echo esc_html( get_the_excerpt() ); ?></p>
                                    <a href="<?php echo esc_url( get_the_permalink() ); ?>">Read More</a>
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
    }
}
