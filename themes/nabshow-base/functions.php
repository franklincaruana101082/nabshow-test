<?php
/**
 * NABShow Base functions and definitions
 *
 */


//************BEGIN Stuff from former parent theme functions file

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
 * All action hook
 */
require get_template_directory() . '/inc/action/actions.php';

require get_template_directory() . '/inc/action/actions-functions.php';

/**
 * All theme setup functions
 */
require get_template_directory() . '/inc/action/theme-setup-functions.php';

/**
 * All custom post types and taxonomies functions
 */
require get_template_directory() . '/inc/action/custom-post-types.php';

/**
 * Custom or dynamic blocks functions
 */
require get_template_directory() . '/inc/action/blocks-functions.php';

/**
 * All filter hook
 */
require get_template_directory() . '/inc/filters.php';

/*
 * All filter functions
 */
require get_template_directory() . '/inc/filters-functions.php';

/**
 * All the ajax functions.
 */
require get_template_directory() . '/inc/ajax.php';

/**
 * All the shortcode.
 */
require get_template_directory() . '/inc/shortcode.php';

/**
 * All the shortcode functions.
 */
require get_template_directory() . '/inc/shortcode-functions.php';

/**
 * All the shortcode functions.
 */
require get_template_directory() . '/inc/common-functions.php';

/**
 * All the endpoint callback function.
 */
require get_template_directory() . '/inc/endpoints.php';

/**
 * All the block browse page filter inside this file
 */
require get_template_directory() . '/inc/blocks-browse-filter-html.php';

/**
 * All analytics settings inside this file
 */
require get_template_directory() . '/inc/action/segment-ga-prod.php';

/**
 *
 * @todo can't upload to VIP server it's use for internal server only.
 */

add_filter( 'use_block_editor_for_post', '__return_true' );

/**
 *
 * @todo can't upload to VIP server it's use for internal server only.
 */
add_filter( 'allow_subdirectory_install', '__return_true' );


//************END Stuff from former parent theme functions file



if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' => 'Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug'  => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ));

}



function nabshow_base_enqueue_styles() {

	wp_enqueue_style( 'proxima-nova', UrlCacheControl::AppendTimeToUrl('https://use.typekit.net/qbe2mua.css'), array(), '1.0');
    wp_enqueue_style( 'nabshow-lv-child-2021', UrlCacheControl::AppendTimeToUrl(get_template_directory_uri().'/assets/css/styles.min.css', 1));
    wp_enqueue_style( 'slick', UrlCacheControl::AppendTimeToUrl('//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', 2), array(), '1.0');

    //wp_enqueue_script( 'nabshow-2021-jquery', "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js", array(), '1.0', true );
    wp_enqueue_script( 'nabshow-2021-slick', UrlCacheControl::AppendTimeToUrl('//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', 3), array(), '1.8.1', true);
	wp_enqueue_script('nabshow-2021-main',UrlCacheControl::AppendTimeToUrl(get_template_directory_uri() . '/assets/js/app.min.js', 4),array(), '1.0', true );
	wp_enqueue_script('nabshow-2021-gleanin-plugin', UrlCacheControl::AppendTimeToUrl('https://app.webreg.me/communities/076497845fd7/engagements.js', 5), array(), '1.0', true );
}

add_action( 'wp_enqueue_scripts', 'nabshow_base_enqueue_styles', 100 );


function  nabshow_setup() {
	register_nav_menus(
		array(
			'menu-brand'  => esc_html__( 'Brand Menu', 'nabshow-base' ),
			'menu-main'   => esc_html__( 'Main Menu', 'nabshow-base' ),
			'menu-footer' => esc_html__( 'Footer Menu', 'nabshow-base' ),
			'menu-social' => esc_html__( 'Social Menu', 'nabshow-base' ),
		)
	);
}
add_action( 'after_setup_theme', 'nabshow_setup' );

/**
 * Retrieves the user images.
 *
 * @return array list of user images
 */
function nab_amplify_get_user_images($user_id = 0) {

	$user_id           = 0 !== $user_id && null !== $user_id ? $user_id : get_current_user_id();
	$user_images_names = array(
		array(
			'name'    => 'profile_picture',
			'default' => 'avtar.jpg'
		),
		array(
			'name'    => 'banner_image',
			'default' => 'search-box-cover.png'
		)
	);

	$user_images = array();
	foreach ($user_images_names as $user_image) {

		$user_image_id = get_user_meta($user_id, $user_image['name'], true);

		// If the meta value contains "assets", it has Bynder URL.
		if ( strpos( $user_image_id, 'assets') !== false ) {
			$user_images[$user_image['name']] = $user_image_id;

			// Else try to find from attachments.
		} else {
			if ('removed' === $user_image_id) {
				// Show default avatar if deleted from edit profile section.
				$user_images[$user_image['name']] = get_template_directory_uri() . '/assets/images/' . $user_image['default'];
			} else if ('profile_picture' === $user_image['name'] && empty($user_image_id)) {
				// Show WordPress avatar for fresh users, who haven't uploaded their profile pic yet.
				//$user_images[$user_image['name']] = bp_core_fetch_avatar(array('item_id' => $user_id, 'type' => 'full', 'class' => 'friend-avatar', 'html' => false));
				$user_images[$user_image['name']] = get_template_directory_uri() . '/assets/images/user-image-default.jpg';
			} else {
				// Show uploaded images or the default ones.
				$user_images[$user_image['name']] = !empty($user_image_id)
					? wp_get_attachment_image_src($user_image_id, 'full')[0]
					: get_template_directory_uri() . '/assets/images/' . $user_image['default'];
			}
		}
	}

	return $user_images;
}


/**
 * Register Team and Sign up Widgets
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function nabshow_base_widgets() {
	register_sidebar( array(
		'name'			=> esc_html__( 'Team', 'nabshow_base' ),
		'id'			=> 'team-widget',
		'description'	=> esc_html__( 'Add widgets here.', 'nabshow-base' ),
		'before_widget' => '<div id="%1$s" class="feature__body %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="h-md">',
        'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Sign Up', 'nabshow_base' ),
		'id'			=> 'signup-widget',
		'description'	=> esc_html__( 'Add widgets here.', 'nabshow-base' ),
		'before_widget' => '<div id="%1$s" class="amp-signup__body %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="h-md">',
        'after_title'   => '</h3>',
	) );


	register_sidebar( array(
		'name'			=> esc_html__( 'Broadstreet Home Leaderboard', 'nabshow_base' ),
		'id'			=> 'broadstreet-home-leaderboard',
		'description'	=> esc_html__( 'Broadstreet Ad Placement.', 'nabshow-base' ),
		'before_widget' => '<div id="%1$s" class="ad _970x90 _home %2$s">',
        'after_widget'  => '</div>',
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Broadstreet Top Banner Ad', 'nabshow_base' ),
		'id'			=> 'broadstreet-internal-top',
		'description'	=> esc_html__( 'Broadstreet Ad Placement.', 'nabshow-base' ),
		'before_widget' => '<div id="%1$s" class="ad _970x90 _top %2$s">',
        'after_widget'  => '</div>',
	) );

    register_sidebar( array(
        'name'          => esc_html__( 'Broadstreet Square Ad ROS Middle', 'nabshow_base' ),
        'id'            => 'broadstreet-ros-middle-square',
        'description'   => esc_html__( 'Broadstreet Ad Placement.', 'nabshow-base' ),
        'before_widget' => '<div id="%1$s" class="ad _300x250 _middle %2$s">',
        'after_widget'  => '</div>',
    ) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Broadstreet Tall Ad ROS Middle', 'nabshow_base' ),
		'id'			=> 'broadstreet-ros-middle-tall',
		'description'	=> esc_html__( 'Broadstreet Ad Placement.', 'nabshow-base' ),
		'before_widget' => '<div id="%1$s" class="ad _tall _middle %2$s">',
        'after_widget'  => '</div>',
	) );

    register_sidebar( array(
        'name'          => esc_html__( 'Broadstreet Banner ROS Middle', 'nabshow_base' ),
        'id'            => 'broadstreet-ros-middle',
        'description'   => esc_html__( 'Broadstreet Ad Placement.', 'nabshow-base' ),
        'before_widget' => '<div id="%1$s" class="ad _728x90 _middle %2$s">',
        'after_widget'  => '</div>',
    ) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Broadstreet ROS Bottom', 'nabshow_base' ),
		'id'			=> 'broadstreet-ros-bottom',
		'description'	=> esc_html__( 'Broadstreet Ad Placement.', 'nabshow-base' ),
		'before_widget' => '<div id="%1$s" class="ad _728x90 _bottom %2$s">',
        'after_widget'  => '</div>',
	) );

    register_sidebar( array(
        'name'          => esc_html__( 'Broadstreet Prestitial', 'nabshow_base' ),
        'id'            => 'broadstreet-prestitial',
        'description'   => esc_html__( 'Broadstreet Ad Placement.', 'nabshow-base' ),
        'before_widget' => '<div id="%1$s" class="ad _prestitial %2$s">',
        'after_widget'  => '</div>',
    ) );

}

add_action( 'widgets_init', 'nabshow_base_widgets' );


/**
 * Nabshow Base custom post types.
 */
function nabshow_base_register_custom_post_type() {
	$labels = array(
        'name'               => _x('Conference', 'Post Type General Name', 'nabshow-base'),
        'singular_name'      => _x('Conference', 'Post Type Singular Name', 'nabshow-base'),
        'menu_name'          => __('Conference', 'nabshow-base'),
        'parent_item_colon'  => __('Parent Conference', 'nabshow-base'),
        'all_items'          => __('All Conference', 'nabshow-base'),
        'view_item'          => __('View Conference', 'nabshow-base'),
        'add_new_item'       => __('Add New Conference', 'nabshow-base'),
        'add_new'            => __('Add New', 'nabshow-base'),
        'edit_item'          => __('Edit Conference', 'nabshow-base'),
        'update_item'        => __('Update Conference', 'nabshow-base'),
        'search_items'       => __('Search Conference', 'nabshow-base'),
        'not_found'          => __('Not Found', 'nabshow-base'),
        'not_found_in_trash' => __('Not found in Trash', 'nabshow-base'),
    );

    $args = array(
        'label'               => __('Conference', 'nabshow-base'),
        'labels'              => $labels,
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'can_export'          => true,
        'has_archive'         => false,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt', 'author' ),

    );

    register_post_type( 'conference', $args );


    $labels = array(
        'name'               => _x('Destinations', 'Post Type General Name', 'nabshow-base'),
        'singular_name'      => _x('Destinations', 'Post Type Singular Name', 'nabshow-base'),
        'menu_name'          => __('Destinations', 'nabshow-base'),
        'parent_item_colon'  => __('Parent Destinations', 'nabshow-base'),
        'all_items'          => __('All Destinations', 'nabshow-base'),
        'view_item'          => __('View Destinations', 'nabshow-base'),
        'add_new_item'       => __('Add New Destinations', 'nabshow-base'),
        'add_new'            => __('Add New', 'nabshow-base'),
        'edit_item'          => __('Edit Destinations', 'nabshow-base'),
        'update_item'        => __('Update Destinations', 'nabshow-base'),
        'search_items'       => __('Search Destinations', 'nabshow-base'),
        'not_found'          => __('Not Found', 'nabshow-base'),
        'not_found_in_trash' => __('Not found in Trash', 'nabshow-base'),
    );

    $args = array(
        'label'               => __('Destinations', 'nabshow-base'),
        'labels'              => $labels,
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'can_export'          => true,
        'has_archive'         => false,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt', 'author' ),

    );

    register_post_type( 'destinations', $args );


    $labels = array(
        'name'               => _x('Networking', 'Post Type General Name', 'nabshow-base'),
        'singular_name'      => _x('Networking', 'Post Type Singular Name', 'nabshow-base'),
        'menu_name'          => __('Networking', 'nabshow-base'),
        'parent_item_colon'  => __('Parent Networking', 'nabshow-base'),
        'all_items'          => __('All Networking', 'nabshow-base'),
        'view_item'          => __('View Networking', 'nabshow-base'),
        'add_new_item'       => __('Add New Networking', 'nabshow-base'),
        'add_new'            => __('Add New', 'nabshow-base'),
        'edit_item'          => __('Edit Networking', 'nabshow-base'),
        'update_item'        => __('Update Networking', 'nabshow-base'),
        'search_items'       => __('Search Networking', 'nabshow-base'),
        'not_found'          => __('Not Found', 'nabshow-base'),
        'not_found_in_trash' => __('Not found in Trash', 'nabshow-base'),
    );

    $args = array(
        'label'               => __('Networking', 'nabshow-base'),
        'labels'              => $labels,
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'can_export'          => true,
        'has_archive'         => false,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt', 'author' ),

    );

    register_post_type( 'networking', $args );
}
add_action( 'init', 'nabshow_base_register_custom_post_type' );

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

function nabshow_lv_2021_register_custom_script() {

	wp_enqueue_script( 'nabshow-lv-2021-custom', get_template_directory_uri() . '/assets/js/nabshow-lv-2021.js', array( 'jquery' ) );
	wp_localize_script( 'nabshow-lv-2021-custom', 'nabObject', array(
		'ajax_url'			=> admin_url( 'admin-ajax.php' ),
		'ajax_filter_nonce' => wp_create_nonce( 'ajax_filter_nonce' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'nabshow_lv_2021_register_custom_script' );

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
		'post_type' => 'sessions',
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


//this fixes the issue with ACF fields not displaying at all on post previews
//solution from here: https://support.advancedcustomfields.com/forums/topic/preview-solution/page/3/#post-134967
function fix_post_id_on_preview($null, $post_id) {
    if (is_preview()) {
        return get_the_ID();
    }
    else {
        $acf_post_id = isset($post_id->ID) ? $post_id->ID : $post_id;

        if (!empty($acf_post_id)) {
            return $acf_post_id;
        }
        else {
            return $null;
        }
    }
}
add_filter( 'acf/pre_load_post_id', 'fix_post_id_on_preview', 10, 2 );
