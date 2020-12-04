<?php
/**
 * Amplify functions and definitions
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Amplify
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'nab_amplify_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function nab_amplify_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Amplify, use a find and replace
		 * to change 'nab-amplify' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'nab-amplify', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'nab-amplify' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'nab_amplify_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'nab_amplify_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nab_amplify_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nab_amplify_content_width', 640 );
}

add_action( 'after_setup_theme', 'nab_amplify_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nab_amplify_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'nab-amplify' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'nab-amplify' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer One', 'nab-amplify' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'nab-amplify' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Two', 'nab-amplify' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'nab-amplify' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Three', 'nab-amplify' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'nab-amplify' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Four', 'nab-amplify' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Add widgets here.', 'nab-amplify' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Five', 'nab-amplify' ),
			'id'            => 'footer-5',
			'description'   => esc_html__( 'Add widgets here.', 'nab-amplify' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	//© 2020 National Association of Broadcasters. All Rights Reserved
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Six', 'nab-amplify' ),
			'id'            => 'footer-6',
			'description'   => esc_html__( 'Add widgets here.', 'nab-amplify' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'nab_amplify_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nab_amplify_scripts() {
	wp_enqueue_style( 'nab-amplify-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'nab-amplify-style', 'rtl', 'replace' );

	wp_enqueue_script( 'nab-amplify-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'nab-amplify-fancybox-js', get_template_directory_uri() . '/assets/js/jquery.fancybox.min.js', array(), _S_VERSION, true );

	wp_enqueue_style( 'nab-amplify-fancybox-css', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css', array(), _S_VERSION );

}

add_action( 'wp_enqueue_scripts', 'nab_amplify_scripts' );

/**
 * WooCommerce - Remove Actions
 */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/* Load Gutenberg in custom post types */
if ( function_exists( 'wpcom_vip_load_gutenberg' ) ) {
    wpcom_vip_load_gutenberg( [ 'post_types' => [ 'page', 'articles', 'wp_block', 'company', 'company-products' ] ] );
}

/**
 * WooCommerce - Change Hooks Priority
 */
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


/**
 * All action hooks.
 */
require get_template_directory() . '/inc/action/actions.php';

/**
 * Front side setup functions.
 */
require get_template_directory() . '/inc/action/theme-setup-functions.php';

/**
 * backend side setup functions.
 */
require get_template_directory() . '/inc/action/blocks-functions.php';

/**
 * Constants
 */
require get_template_directory() . '/inc/constants.php';

/**
 * Action Callback Functions
 */
require get_template_directory() . '/inc/action/action-functions.php';

/**
 * All Filters
 */
require get_template_directory() . '/inc/filters.php';

/**
 * Filter Callback Functions
 */
require get_template_directory() . '/inc/filter-functions.php';

/**
 * Ajax Functions
 */
require_once get_template_directory() . '/inc/ajax-functions.php';

/**
 * All the user reaction related functions.
 */
require_once get_template_directory() . '/inc/user-reaction.php';

/**
 * All the company follower related functions.
 */
require_once get_template_directory() . '/inc/company-follow.php';

/**
 * Extend wordpress default walker comment class.
 */
require_once get_template_directory() . '/classes/class-custom-walker-comment.php';