<?php

/**
 * All theme setup functions located this file
 */

if ( ! function_exists( 'nabshow_lv_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * @since 1.0.0
     */
    function nabshow_lv_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on NABShow LV, use a find and replace
         * to change 'nabshow-lv' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'nabshow-lv', get_template_directory() . '/assets/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'nabshow_lv_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );

	    /**
	     * Add user role capabilities as per the need of NABShow admins.
	     */
	    // Update Author role capabilities
	    if ( current_user_can( 'manage_options' ) ) {
		    $author_role = get_role( 'author' );
		    if ( ! empty( $author_role ) ) {
			    $author_role->add_cap( 'edit_pages' );
		    }
	    }
    }
endif;


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since 1.0.0
 */
function nabshow_lv_content_width() {

    $GLOBALS[ 'content_width' ] = apply_filters( 'nabshow_lv_content_width', 640 );
}

/**
 * Register sidebar for theme.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @since 1.0.0
 */
function nabshow_lv_widgets_init() {

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'nabshow-lv' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'nabshow-lv' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Header top left sidebar', 'nabshow-lv' ),
        'id'            => 'header-top-left-sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'nabshow-lv' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Header top right sidebar', 'nabshow-lv' ),
        'id'            => 'header-top-right-sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'nabshow-lv' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer top left sidebar', 'nabshow-lv' ),
        'id'            => 'footer-top-left-sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'nabshow-lv' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer top right sidebar', 'nabshow-lv' ),
        'id'            => 'footer-top-right-sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'nabshow-lv' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer middle sidebar', 'nabshow-lv' ),
        'id'            => 'footer-middle-sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'nabshow-lv' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer bottom left sidebar', 'nabshow-lv' ),
        'id'            => 'footer-bottom-left-sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'nabshow-lv' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer bottom right sidebar', 'nabshow-lv' ),
        'id'            => 'footer-bottom-right-sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'nabshow-lv' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

	register_sidebar( array(
		'name'          => esc_html__( 'Advertisement', 'nabshow-lv' ),
		'id'            => 'footer-advertisement-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'nabshow-lv' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

/**
 * Enqueue required scripts and styles for theme.
 *
 * @since 1.0.0
 */

function nabshow_lv_scripts() {

    wp_enqueue_script( 'nabshow-lv-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

    wp_enqueue_style( 'nabshow-lv-fonts', get_template_directory_uri() . '/assets/fonts/fonts.css' );

    wp_enqueue_style( 'wp-block-library' );

    //wp_enqueue_style( 'nabshow-lv-style', get_stylesheet_uri() );

    wp_enqueue_style( 'nabshow-lv-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );

    wp_enqueue_style( 'nabshow-lv-font-awesome', get_template_directory_uri() . '/assets/fonts/font-awesome.min.css' );

    wp_enqueue_style( 'nabshow-lv-bxslider-style', get_template_directory_uri() . '/assets/css/jquery.bxslider.css' );

    // wp_enqueue_style( 'nabshow-lv-custom-style', get_template_directory_uri() . '/assets/css/custom.css', array(), '6.7' );

    // wp_enqueue_style( 'nabshow-lv-media-style', get_template_directory_uri() . '/assets/css/media.css', array(), '6.5' );

    // wp_enqueue_style( 'nabshow-lv-print-style', get_template_directory_uri() . '/assets/css/print-css.css', array(), '1.6' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    //bx-slider script
    wp_enqueue_script( 'nabshow-lv-bx-slider', get_template_directory_uri() . '/assets/js/jquery.bxslider.min.js', array( 'jquery' ), null, true );

    wp_enqueue_script( 'nabshow-lv-bootstrap', get_template_directory_uri() . '/assets/js/modal.min.js', array( 'jquery' ), null, true  );
    wp_enqueue_script( 'nabshow-lv-iframe-resize', get_template_directory_uri() . '/assets/js/iframeResizer.min.js', array( 'jquery' ), '6.0', true );
    wp_enqueue_script( 'nabshow-lv-custom', get_template_directory_uri() . '/assets/js/nabshow-lv.js', array( 'jquery' ), '6.1', true );
	wp_localize_script( 'nabshow-lv-custom', 'nabshowLvCustom', array(
		'ajax_url'                       => admin_url( 'admin-ajax.php' ),
		'nabshow_lv_browse_filter_nonce' => wp_create_nonce( 'browse_filter_nonce' ),
	) );

    if ( has_block( 'nab/not-to-be-missed-slider' ) ) {
        wp_localize_script( 'nabshow-lv-custom', 'nabshowNtbMissed', array(
            'ajax_url'                    => admin_url( 'admin-ajax.php' ),
            'nabshow_lv_ntb_missed_nonce' => wp_create_nonce( 'ntb_missed_nonce' )
        ) );
    }

    if ( is_post_type_archive('not-to-be-missed') ):
        wp_enqueue_script( 'nabshow-lv-ntb-missed', get_template_directory_uri() . '/assets/js/nabshow-lv-ntb-missed.js', array( 'jquery' ), null, true );
        wp_localize_script( 'nabshow-lv-ntb-missed', 'nabshowLvNtbMissed', array(
            'ajax_url'                    => admin_url( 'admin-ajax.php' ),
            'nabshow_lv_ntb_missed_nonce' => wp_create_nonce( 'ntb_missed_nonce' )
        ) );
    endif;

    $current_taxonomy_term = get_queried_object();

    if ( is_post_type_archive('thought-gallery') || ( isset( $current_taxonomy_term->taxonomy ) && 'thought-gallery-category' === $current_taxonomy_term->taxonomy ) ):
        wp_enqueue_script( 'nabshow-lv-thought-gallery', get_template_directory_uri() . '/assets/js/nabshow-lv-thought-gallery.js', array( 'jquery' ), '1.0', true );
        wp_localize_script( 'nabshow-lv-thought-gallery', 'nabshowLvThoughtGallery', array(
            'ajax_url'                    => admin_url( 'admin-ajax.php' ),
            'nabshow_lv_thought_gallery_nonce' => wp_create_nonce( 'thought_gallery_nonce' )
        ) );
    endif;

	if ( is_post_type_archive('news-releases' ) ):
		wp_enqueue_script( 'nabshow-lv-news-releases', get_template_directory_uri() . '/assets/js/nabshow-lv-news-releases.js', array( 'jquery' ), '1.1', true );
		wp_localize_script( 'nabshow-lv-news-releases', 'nabshowLvNewsReleases', array(
			'ajax_url'                       => admin_url( 'admin-ajax.php' ),
			'nabshow_lv_news_releases_nonce' => wp_create_nonce( 'news_releases_nonce' )
		) );
	endif;

	//Marketo script
	wp_enqueue_script( 'nabshow-lv-marketo', '//app-ab34.marketo.com/js/forms2/js/forms2.min.js', array( 'nabshow-lv-custom' ), null, true );
	wp_add_inline_script( 'nabshow-lv-marketo', 'MktoForms2.loadForm("//app-ab34.marketo.com", "927-ARO-980", 1033);MktoForms2.loadForm("//app-ab34.marketo.com", "927-ARO-980", 1091);MktoForms2.loadForm("//app-ab34.marketo.com", "927-ARO-980", 1099);MktoForms2.loadForm("//app-ab34.marketo.com", "927-ARO-980", 1111);');

	wp_enqueue_script( 'nabshow-lv-webreg', 'https://app.webreg.me/communities/0a61a16a0610/engagements.js', array( 'nabshow-lv-custom' ), null, true );
}


/**
 * Register Settings.
 *
 * @since 1.0.0
 */
function nabshow_lv_register_settings() {
	$args = array(
		'type' => 'html',
	);
	register_setting(
		'general',
		'dymanic_schema',
		$args
	);
	add_settings_field(
		'dymanic_schema',
		'Enter Schema',
		'nabshow_lv_register_schema_field',
		'general'
	);
}

/*
 * Print schema setting field.
 *
 * @since 1.0.0
 */
function nabshow_lv_register_schema_field() {

	$dymanic_schema = get_option( 'dymanic_schema' );
	echo "<textarea id='dymanic_schema_string' name='dymanic_schema' rows='7' cols='50' type='textarea'>{$dymanic_schema}</textarea>";

}
