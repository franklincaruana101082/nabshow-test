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
				'menu-2' => esc_html__( 'Brand', 'nab-amplify' ),
				'footer-1' => esc_html__( 'Footer main', 'nab-amplify' ),
				'footer-2' => esc_html__( 'Footer policy', 'nab-amplify' ),
				'footer-3' => esc_html__( 'Footer quick', 'nab-amplify' ),
				'footer-4' => esc_html__( 'Footer brand', 'nab-amplify' ),
				'social-1' => esc_html__( 'Social', 'nab-amplify' ),
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

		add_image_size( 'nab-company-product-thumb', 293, 220 , true);
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

	register_sidebar(
		array(
			'name'          => esc_html__( 'Logged in user Footer block', 'nab-amplify' ),
			'id'            => 'footer-loggedin',
			'description'   => esc_html__( 'Add widgets here.', 'nab-amplify' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'			=> esc_html__( 'Session not logged in', 'nab-amplify' ),
			'id'			=> 'session-not-logged-in',
			'description'	=> esc_html__( 'Add widgets here.', 'nab-amplify' ),
			'before_widget' => '<section id="%1$s" class="introtext widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="intro__title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'			=> esc_html__( 'Member of the press modal', 'nab-amplify' ),
			'id'			=> 'member-press-modal',
			'description'	=> esc_html__( 'Add widgets here.', 'nab-amplify' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'			=> esc_html__( 'Sign Up Terms', 'nab-amplify' ),
			'id'			=> 'sign-up-terms',
			'description'	=> esc_html__( 'Add widgets here.', 'nab-amplify' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'			=> esc_html__( 'Sign Up Terms for NAB Show', 'nab-amplify' ),
			'id'			=> 'sign-up-terms-nabshow',
			'description'	=> esc_html__( 'Add widgets here.', 'nab-amplify' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar( array(
		'name'			=> esc_html__( 'Broadstreet in Footer', 'nab-amplify' ),
		'id'			=> 'broadstreet-footer',
		'description'	=> esc_html__( 'Broadstreet Ad Placement.', 'nabshow-lv' ),
		'before_widget' => '<div id="%1$s" class="ad _footer %2$s">',
        'after_widget'  => '</div>',
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Run of Site 120x600 or 160x600', 'nab-amplify' ),
		'id'			=> 'broadstreet-82845',
		'description'	=> esc_html__( 'Broadstreet Zone 82845.', 'nab-amplify' ),
		'before_widget' => '<div id="%1$s" class="ad _82845 %2$s">',
        'after_widget'  => '</div>',
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Run of Site 300x250', 'nab-amplify' ),
		'id'			=> 'broadstreet-83096',
		'description'	=> esc_html__( 'Broadstreet Zone 83096.', 'nab-amplify' ),
		'before_widget' => '<div id="%1$s" class="ad _83096 %2$s">',
        'after_widget'  => '</div>',
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Run of Site 300x600', 'nab-amplify' ),
		'id'			=> 'broadstreet-88909',
		'description'	=> esc_html__( 'Broadstreet Zone 88909.', 'nab-amplify' ),
		'before_widget' => '<div id="%1$s" class="ad _88909 %2$s">',
        'after_widget'  => '</div>',
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Run of Site Bottom 728x90', 'nab-amplify' ),
		'id'			=> 'broadstreet-82836',
		'description'	=> esc_html__( 'Broadstreet Zone 82836.', 'nab-amplify' ),
		'before_widget' => '<div id="%1$s" class="ad _82836 %2$s">',
        'after_widget'  => '</div>',
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Run of Site Mid 728x90', 'nab-amplify' ),
		'id'			=> 'broadstreet-83512',
		'description'	=> esc_html__( 'Broadstreet Zone 83512.', 'nab-amplify' ),
		'before_widget' => '<div id="%1$s" class="ad _83512 %2$s">',
        'after_widget'  => '</div>',
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Run of Site Top 970x90', 'nab-amplify' ),
		'id'			=> 'broadstreet-82835',
		'description'	=> esc_html__( 'Broadstreet Zone 82835.', 'nab-amplify' ),
		'before_widget' => '<div id="%1$s" class="ad _82835 %2$s">',
        'after_widget'  => '</div>',
	) );

}

add_action( 'widgets_init', 'nab_amplify_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nab_amplify_scripts() {
	wp_enqueue_style( 'roboto-mono', 'https://fonts.googleapis.com/css2?family=Roboto+Mono:ital@0;1&display=swap', array(), '1.0');
	wp_enqueue_style( 'proxima-nova', 'https://use.typekit.net/iig3loy.css', array(), '1.0');
	wp_style_add_data( 'nab-amplify-style', 'rtl', 'replace' );

	// NOTE: /js/app.min.js is included automatically
	wp_enqueue_script( 'nab-amplify-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'nab-amplify-fancybox-js', get_template_directory_uri() . '/assets/js/jquery.fancybox.min.js', array(), _S_VERSION, true );

	wp_enqueue_style( 'nab-amplify-fancybox-css', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css', array(), _S_VERSION );

}

add_action( 'wp_enqueue_scripts', 'nab_amplify_scripts' );

add_action( 'woocommerce_register_form', 'nab_add_registration_privacy_policy', 100 );

function nab_add_registration_privacy_policy() {

woocommerce_form_field( 'privacy_policy_reg', array(
   'type'          => 'checkbox',
   'class'         => array('field__woowrapper'),
   'label_class'   => array('field__list-input'),
   'input_class'   => array('field__input'),
   'required'      => true,
   'label'         => 'I agree to the NAB Amplify <a href="'. site_url() . '/privacy-policy/">privacy policy</a>, <a href="' . site_url() . '/terms-of-use/">terms of use</a> and <a href="' . site_url() . '/nab-virtual-events-code-of-conduct/">code of conduct</a>.',
));

}

// Show error if user does not tick

add_filter( 'woocommerce_registration_errors', 'nab_validate_privacy_registration', 10, 3 );

function nab_validate_privacy_registration( $errors, $username, $email ) {
if ( ! is_checkout() ) {
    if ( ! (int) isset( $_POST['privacy_policy_reg'] ) ) {
        $errors->add( 'privacy_policy_reg_error', __( 'NAB Amplify Privacy Policy consent is required.', 'woocommerce' ) );
    }
}
return $errors;
}


function nab_get_geolocation($locationType) {
	if ($locationType == 'city') {
		$geo_city = do_shortcode('[geoip_detect2 property="city.name"]');
		if (!str_starts_with($geo_city, '<!--')) {
			return $geo_city;
		}
	}
	if ($locationType == 'state') {
		$geo_state = do_shortcode('[geoip_detect2 property="mostSpecificSubdivision.isoCode"]');
		if (!str_starts_with($geo_state, '<!--')) {
			return $geo_state;
		}
	}
	if ($locationType == 'country') {
		$geo_country = do_shortcode('[geoip_detect2 property="country.isoCode"]');
		if (!str_starts_with($geo_country, '<!--')) {
			return $geo_country;
		}
	}
}


// sort date array.
function nabshow_lv_2021_date_sort( $a, $b ) {
    return strtotime( $a ) - strtotime( $b );
}
/**
 * Modified session archive page default query.
 *
 * @param WP_Query $query
 */
function nabshow_lv_2021_modified_session_list_query( $query ) {

	if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'sessions' ) ) {

		$query->set( 'meta_key', 'starttime' );
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'order', 'ASC' );

		$current_page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT );

		if ( isset( $current_page ) && ! empty( $current_page ) && (int) $current_page > 1 ) {
			$query->set( 'paged', $current_page );
		}

		$tax_query_args		= nabshow_lv_2021_prepare_session_tax_query();
		$meta_query_args	= nabshow_lv_2021_prepare_session_meta_query();

		if ( is_array( $tax_query_args ) && count( $tax_query_args ) > 0 ) {
			$query->set( 'tax_query', $tax_query_args );
		}

		if ( is_array( $meta_query_args ) && count( $meta_query_args ) > 0 ) {
			$query->set( 'meta_query', $meta_query_args );
		}

    }
}
add_action( 'pre_get_posts', 'nabshow_lv_2021_modified_session_list_query' );

// function nabshow_lv_2021_register_custom_script() {

// 	wp_enqueue_script( 'nabshow-lv-2021-custom', get_stylesheet_directory_uri() . '/assets/js/nabshow-lv-2021.js', array( 'jquery' ) );
// 	wp_localize_script( 'nabshow-lv-2021-custom', 'nabObject', array(
// 		'ajax_url'			=> admin_url( 'admin-ajax.php' ),
// 		'ajax_filter_nonce' => wp_create_nonce( 'ajax_filter_nonce' ),
// 	) );
// }
// add_action( 'wp_enqueue_scripts', 'nabshow_lv_2021_register_custom_script' );

/**
 * Prepare session archive page tax query args.
 *
 * @return array
 */
function nabshow_lv_2021_prepare_session_tax_query() {

	$session_program			= filter_input( INPUT_GET, 'program', FILTER_SANITIZE_STRING );
	$session_registration_pass	= filter_input( INPUT_GET, 'registration_pass', FILTER_SANITIZE_STRING );
	$session_topic				= filter_input( INPUT_GET, 'topic', FILTER_SANITIZE_STRING );
	$session_education_partner	= filter_input( INPUT_GET, 'education_partner', FILTER_SANITIZE_STRING );
	$session_session_type		= filter_input( INPUT_GET, 'session_type', FILTER_SANITIZE_STRING );
	$session_experience_level	= filter_input( INPUT_GET, 'experience_level', FILTER_SANITIZE_STRING );
	$session_location			= filter_input( INPUT_GET, 'location', FILTER_SANITIZE_STRING );
	$tax_query_args				= array();

	if ( isset( $session_program ) && ! empty( $session_program ) ) {

		$tax_query_args[] = array(
			'taxonomy'	=> 'tracks',
			'terms'		=> $session_program,
		);
	}

	if ( isset( $session_location ) && ! empty( $session_location ) ) {

		$tax_query_args[] = array(
			'taxonomy'	=> 'session-locations',
			'terms'		=> $session_location,
		);
	}

	if ( isset( $session_registration_pass ) && ! empty( $session_registration_pass ) ) {

		$tax_query_args[] = array(
			'taxonomy'	=> 'session-categories',
			'terms'		=> $session_registration_pass,
		);
	}

	if ( isset( $session_topic ) && ! empty( $session_topic ) ) {

		$tax_query_args[] = array(
			'taxonomy'	=> 'session-categories',
			'terms'		=> $session_topic,
		);
	}

	if ( isset( $session_education_partner ) && ! empty( $session_education_partner ) ) {

		$tax_query_args[] = array(
			'taxonomy'	=> 'session-categories',
			'terms'		=> $session_education_partner,
		);
	}

	if ( isset( $session_session_type ) && ! empty( $session_session_type ) ) {

		$tax_query_args[] = array(
			'taxonomy'	=> 'session-categories',
			'terms'		=> $session_session_type,
		);
	}

	if ( isset( $session_experience_level ) && ! empty( $session_experience_level ) ) {

		$tax_query_args[] = array(
			'taxonomy'	=> 'session-categories',
			'terms'		=> $session_experience_level,
		);
	}

	return $tax_query_args;

}

/**
 * Prepare session archive page meta query args.
 *
 * @return array
 */
function nabshow_lv_2021_prepare_session_meta_query() {

	$session_date		= filter_input( INPUT_GET, 'date', FILTER_SANITIZE_STRING );
	$session_speaker	= filter_input( INPUT_GET, 'speaker', FILTER_SANITIZE_STRING );
	$meta_query_args	= array();

	if ( isset( $session_date ) && ! empty( $session_date ) ) {

		$meta_query_args[] = array(
			array(
				'key'     => 'date',
				'value'   => $session_date,
				'type'    => 'DATE'
			)
		);
	}

	if ( isset( $session_speaker ) && ! empty( $session_speaker ) ) {

		$meta_query_args[] = array(
			array(
				'key'     => 'speakers',
				'value'   => $session_speaker,
				'compare' => 'LIKE',
			)
		);
	}

	return $meta_query_args;
}

function nabshow_lv_2021_session_filter() {

	check_ajax_referer( 'ajax_filter_nonce', 'nabNonce' );

	$current_page	= filter_input( INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT );
	$current_page	= isset( $current_page ) && ! empty( $current_page ) ? $current_page : 1;

	$query_args = array(
		'post_type' => 'mys-sessions',
		'meta_key'	=> 'starttime',
		'orderby'	=> 'meta_value',
		'order'		=> 'ASC',
		'paged'		=> $current_page,
	);

	$tax_query_args		= nabshow_lv_2021_prepare_session_tax_query();
	$meta_query_args	= nabshow_lv_2021_prepare_session_meta_query();

	if ( is_array( $tax_query_args ) && count( $tax_query_args ) > 0 ) {
		$query_args['tax_query'] = $tax_query_args;
	}

	if ( is_array( $meta_query_args ) && count( $meta_query_args ) > 0 ) {
		$query_args['meta_query'] = $meta_query_args;
	}

	$session_query 	= new WP_Query( $query_args );
	$total_pages	= $session_query->max_num_pages;
	$session_html	= '';
	$pagination		= '';

	if ( $session_query->have_posts() ) {

		$nab_mys_urls           = get_option( 'nab_mys_urls' );
		$show_code              = isset( $nab_mys_urls['show_code'] ) ? $nab_mys_urls['show_code'] : '';
		$session_planner_url    = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/session-details.cfm?scheduleid=';
		$speaker_planner_url    = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/speaker-details.cfm?speakerid=';
		$location_url           = 'https://' . $show_code . '.mapyourshow.com/8_0/floorplan/';
		$program_planner_url    = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/#/searchtype/sessiontrack/search/';

		ob_start();

		while ( $session_query->have_posts() ) {

			$session_query->the_post();

			$session_id     = get_the_ID();
			$date           = get_post_meta( $session_id, 'date', true );
			$start_time     = get_post_meta( $session_id, 'starttime', true );
			$end_time       = get_post_meta( $session_id, 'endtime', true );
			$schedule_id    = get_post_meta( $session_id, 'scheduleid', true );
			$program        = get_the_terms( $session_id, 'tracks' );
			$location_term  = get_the_terms( $session_id, 'session-locations' );
			$program_name   = '';
			$location       = '';

			if ( $program && ! is_wp_error( $program ) ) {
				$all_programs   = wp_list_pluck( $program, 'name' );
				$program_name   = isset( $all_programs[0] ) ? $all_programs[0] : '';
			}

			if ( $location_term && ! is_wp_error( $location_term ) ) {
				$all_location   = wp_list_pluck( $location_term, 'name' );
				$location       = isset( $all_location[0] ) ? $all_location[0] : '';
			}

			if ( ! empty( $start_time ) ) {
				$start_time = str_replace( array( 'am','pm' ), array( 'a.m.','p.m.' ), date_format( date_create( $start_time ), 'g:i a' ) );
				$start_time = str_replace(':00', '', $start_time );
			}
			if ( ! empty( $end_time ) ) {
				$end_time   = str_replace( array( 'am','pm' ), array( 'a.m.','p.m.' ), date_format( date_create( $end_time ), 'g:i a' ) );
				$end_time   = str_replace(':00', '', $end_time );
			}
			?>

			<div class="filter-result-box">
				<!-- datetime -->
				<div class="filter-result-box-datetime">
					<?php echo esc_html( date_format( date_create( $date ), 'F j, Y' ) ); ?> <?php echo esc_html( $start_time ); ?> - <?php echo esc_html( $end_time ); ?>
					<?php
					if ( ! empty( $location ) ) {
						?>
						<a href="<?php echo esc_url( $location_url ); ?>" target="_blank"><?php echo esc_html( $location ); ?></a>
						<?php
					}
					?>
				</div>
				<!-- END datetime -->

				<!-- title -->
				<h2 class="filter-result-box-title"><a href="<?php echo esc_url( $session_planner_url . $schedule_id ); ?>" target="_blank"><?php the_title(); ?></a></h2>
				<!-- END title -->

				<!-- category -->
				<?php
				if ( ! empty( $program_name ) ) {

					$program_url = $program_planner_url . $program_name . '/show/all';
					?>
					<span class="filter-result-box-category"><a href="<?php echo esc_url( $program_url ); ?>" target="_blank"><?php echo esc_html( $program_name ); ?></a></span>
					<?php
				}
				?>
				<!-- END category -->

				<!-- description -->
				<div class="filter-result-box-description">
					<p><?php the_excerpt(); ?></p>
				</div>
				<!-- END description -->

				<?php
				$speakers       = get_post_meta( $session_id, 'speakers', true );
				$speaker_ids    = explode( ',', $speakers );
				$all_speakers   = array();

				if ( ! empty( $speakers ) && count( $speaker_ids ) > 0 ) {

					foreach ( $speaker_ids as $speaker_id ) {

						$speaker_name   = get_the_title( $speaker_id );
						$mys_speaker_id = get_post_meta( $speaker_id, 'speakerid', true );
						$all_speakers[] = '<a href="' . $speaker_planner_url . $mys_speaker_id . '" target="_blank">' . str_replace( ',', '', $speaker_name ) . '</a>';
					}
					?>
					<div class="speakers-list">
						<i>Featured Speakers:</i>
						<?php echo wp_kses_post( implode( ', ', $all_speakers ) ); ?>
					</div>
					<?php
				}
				?>

				<!-- cta -->
				<a class="filter-result-box-cta" href="<?php echo esc_url( $session_planner_url . $schedule_id ); ?>" target="_blank">View in Planner</a>
				<!-- END cta -->

			</div>
			<?php
		}

		$session_html = ob_get_clean();

		$allowed_tags = [
			'span' => [
				'class' => [],
			],
			'i'    => [
				'class' => [],
			],
			'a'    => [
				'class' => [],
				'href'  => [],
			],
		];

		$pagination = wp_kses( paginate_links( array(
			'base'      => '#%#%',
			'current'   => $current_page,
			'total'     => $total_pages,
			'add_args'  => false,
			'prev_text' => __( 'Previous' ),
			'next_text' => __( 'Next' ),
		) ), $allowed_tags );

	} else {
		ob_start();
		?>
		<p class="result-not-found">No sessions could be found. Try removing some of your filters to broaden your search.</p>
		<?php
		$session_html = ob_get_clean();
	}
	wp_reset_postdata();

	wp_send_json_success( array(
			'session_html' 	=> $session_html,
			'pagination'	=> $pagination,
		)
	);

}
add_action( 'wp_ajax_nab_2021_session_filter', 'nabshow_lv_2021_session_filter' );
add_action( 'wp_ajax_nopriv_nab_2021_session_filter', 'nabshow_lv_2021_session_filter' );

/**
 * WooCommerce - Remove Actions
 */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/* Load Gutenberg in custom post types */
function maybe_load_gutenberg_for_post_type( $can_edit, $post ) {
	$enable_for_post_types = [ 'page', 'articles', 'wp_block', 'company', 'company-products', 'landing-page' ];

	if ( in_array( $post->post_type, $enable_for_post_types, true ) ) {
		return true;
	}

	return false;
}
add_filter( 'use_block_editor_for_post', 'maybe_load_gutenberg_for_post_type', 15, 2 );

add_filter( 'use_block_editor_for_post', 'maybe_load_gutenberg_for_post_type', 15, 2 );

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
