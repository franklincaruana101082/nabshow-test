<?php
/**
 * NABShow LV Child 2021 functions and definitions
 *
 */

function nabshow_lv_2021_enqueue_styles() {
	wp_enqueue_style( 'proxima-nova', 'https://use.typekit.net/qbe2mua.css', array(), '1.0');
    wp_enqueue_style( 'nabshow-lv-child-2021', 
    	get_stylesheet_directory_uri().'/assets/css/styles.min.css'
    );
    wp_enqueue_style( 'slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.0');

    //wp_enqueue_script( 'nabshow-2021-jquery', "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js", array(), '1.0', true );
    wp_enqueue_script( 'nabshow-2021-slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), '1.8.1', true);
    wp_enqueue_script( 'nabshow-2021-main', get_stylesheet_directory_uri() . '/assets/js/app.min.js', array(), '1.0', true );
    wp_enqueue_script( 'nabshow-2021-gleanin-plugin', 'https://app.webreg.me/communities/076497845fd7/engagements.js', array(), '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'nabshow_lv_2021_enqueue_styles', 100 );

function remove_unwanted_css() {
    wp_dequeue_style( 'nabshow-lv-custom-style' );
    wp_deregister_style( 'nabshow-lv-custom-style' );

    wp_dequeue_style( 'nabshow-lv-media-style' );
    wp_deregister_style( 'nabshow-lv-media-style' );

    wp_dequeue_style( 'nabshow-lv-print-style' );
	wp_deregister_style( 'nabshow-lv-print-style' );

	//wp_dequeue_style( 'nabshow-lv-bootstrap-css' );
	//wp_deregister_style( 'nabshow-lv-bootstrap-css' );
}
add_action( 'wp_enqueue_scripts', 'remove_unwanted_css', 20 );


function  nabshow_setup() {
	register_nav_menus(
		array(
			'menu-brand'  => esc_html__( 'Brand Menu 2021', 'nabshow-lv' ),
			'menu-main'   => esc_html__( 'Main Menu 2021', 'nabshow-lv`' ),
			'menu-footer' => esc_html__( 'Footer Menu 2021', 'nabshow-lv' ),
			'menu-social' => esc_html__( 'Social Menu 2021', 'nabshow-lv' ),
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
				$user_images[$user_image['name']] = get_stylesheet_directory_uri() . '/assets/images/user-image-default.jpg';
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

function nabshow_lv_2021_widgets() {
	register_sidebar( array(
		'name'			=> esc_html__( 'Team', 'nabshow_lv' ),
		'id'			=> 'team-widget',
		'description'	=> esc_html__( 'Add widgets here.', 'nabshow-lv' ),
		'before_widget' => '<div id="%1$s" class="feature__body %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="h-md">',
        'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Sign Up', 'nabshow_lv' ),
		'id'			=> 'signup-widget',
		'description'	=> esc_html__( 'Add widgets here.', 'nabshow-lv' ),
		'before_widget' => '<div id="%1$s" class="amp-signup__body %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="h-md">',
        'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Broadstreet Square Ad ROS Middle', 'nabshow_lv' ),
		'id'			=> 'broadstreet-ros-middle-square',
		'description'	=> esc_html__( 'Broadstreet Ad Placement.', 'nabshow-lv' ),
		'before_widget' => '<div id="%1$s" class="ad _300x250 _middle %2$s">',
        'after_widget'  => '</div>',
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Broadstreet Home Leaderboard', 'nabshow_lv' ),
		'id'			=> 'broadstreet-home-leaderboard',
		'description'	=> esc_html__( 'Broadstreet Ad Placement.', 'nabshow-lv' ),
		'before_widget' => '<div id="%1$s" class="ad _970x90 _home %2$s">',
        'after_widget'  => '</div>',
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Broadstreet Top Banner Ad', 'nabshow_lv' ),
		'id'			=> 'broadstreet-internal-top',
		'description'	=> esc_html__( 'Broadstreet Ad Placement.', 'nabshow-lv' ),
		'before_widget' => '<div id="%1$s" class="ad _970x90 _top %2$s">',
        'after_widget'  => '</div>',
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Broadstreet Tall Ad ROS Middle', 'nabshow_lv' ),
		'id'			=> 'broadstreet-ros-middle-tall',
		'description'	=> esc_html__( 'Broadstreet Ad Placement.', 'nabshow-lv' ),
		'before_widget' => '<div id="%1$s" class="ad _tall _middle %2$s">',
        'after_widget'  => '</div>',
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Broadstreet ROS Bottom', 'nabshow_lv' ),
		'id'			=> 'broadstreet-ros-bottom',
		'description'	=> esc_html__( 'Broadstreet Ad Placement.', 'nabshow-lv' ),
		'before_widget' => '<div id="%1$s" class="ad _728x90 _bottom %2$s">',
        'after_widget'  => '</div>',
	) );

}

add_action( 'widgets_init', 'nabshow_lv_2021_widgets' );


/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
//require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
//require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//if ( defined( 'JETPACK__VERSION' ) ) {
//	require get_template_directory() . '/inc/jetpack.php';
//}

/**
 * All action hook
 */
//require get_template_directory() . '/inc/action/actions.php';

//require get_template_directory() . '/inc/action/actions-functions.php';

/**
 * All theme setup functions
 */
//require get_template_directory() . '/inc/action/theme-setup-functions.php';

/**
 * All custom post types and taxonomies functions
 */
//require get_template_directory() . '/inc/action/custom-post-types.php';

/**
 * Custom or dynamic blocks functions
 */
// require get_template_directory() . '/inc/action/blocks-functions.php';

/**
 * All filter hook
 */
// require get_template_directory() . '/inc/filters.php';

/*
 * All filter functions
 */
// require get_template_directory() . '/inc/filters-functions.php';

/**
 * All the ajax functions.
 */
// require get_template_directory() . '/inc/ajax.php';

/**
 * All the shortcode.
 */
// require get_template_directory() . '/inc/shortcode.php';

/**
 * All the shortcode functions.
 */
// require get_template_directory() . '/inc/shortcode-functions.php';

/**
 * All the shortcode functions.
 */
// require get_template_directory() . '/inc/common-functions.php';

/**
 * All the endpoint callback function.
 */
// require get_template_directory() . '/inc/endpoints.php';

/**
 * All the block browse page filter inside this file
 */
// require get_template_directory() . '/inc/blocks-browse-filter-html.php';

/**
 * All analytics settings inside this file
 */
// require get_template_directory() . '/inc/action/segment-ga-prod.php';

/**
 *
 * @todo can't upload to VIP server it's use for internal server only.
 */

// add_filter( 'use_block_editor_for_post', '__return_true' );

/**
 *
 * @todo can't upload to VIP server it's use for internal server only.
 */
// add_filter( 'allow_subdirectory_install', '__return_true' );

/**
 * Nabshow LV 2021 custom post types. 
 */
function nabshow_lv_2021_register_custom_post_type() {
	$labels = array(
        'name'               => _x('Conference', 'Post Type General Name', 'nabshow-lv'),
        'singular_name'      => _x('Conference', 'Post Type Singular Name', 'nabshow-lv'),
        'menu_name'          => __('Conference', 'nabshow-lv'),
        'parent_item_colon'  => __('Parent Conference', 'nabshow-lv'),
        'all_items'          => __('All Conference', 'nabshow-lv'),
        'view_item'          => __('View Conference', 'nabshow-lv'),
        'add_new_item'       => __('Add New Conference', 'nabshow-lv'),
        'add_new'            => __('Add New', 'nabshow-lv'),
        'edit_item'          => __('Edit Conference', 'nabshow-lv'),
        'update_item'        => __('Update Conference', 'nabshow-lv'),
        'search_items'       => __('Search Conference', 'nabshow-lv'),
        'not_found'          => __('Not Found', 'nabshow-lv'),
        'not_found_in_trash' => __('Not found in Trash', 'nabshow-lv'),
    );

    $args = array(
        'label'               => __('Conference', 'nabshow-lv'),
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
        'supports'            => array( 'title', 'thumbnail', 'custom-fields', 'excerpt', 'author' ),

    );
    
    register_post_type( 'conference', $args );	


    $labels = array(
        'name'               => _x('Destinations', 'Post Type General Name', 'nabshow-lv'),
        'singular_name'      => _x('Destinations', 'Post Type Singular Name', 'nabshow-lv'),
        'menu_name'          => __('Destinations', 'nabshow-lv'),
        'parent_item_colon'  => __('Parent Destinations', 'nabshow-lv'),
        'all_items'          => __('All Destinations', 'nabshow-lv'),
        'view_item'          => __('View Destinations', 'nabshow-lv'),
        'add_new_item'       => __('Add New Destinations', 'nabshow-lv'),
        'add_new'            => __('Add New', 'nabshow-lv'),
        'edit_item'          => __('Edit Destinations', 'nabshow-lv'),
        'update_item'        => __('Update Destinations', 'nabshow-lv'),
        'search_items'       => __('Search Destinations', 'nabshow-lv'),
        'not_found'          => __('Not Found', 'nabshow-lv'),
        'not_found_in_trash' => __('Not found in Trash', 'nabshow-lv'),
    );

    $args = array(
        'label'               => __('Destinations', 'nabshow-lv'),
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
        'supports'            => array( 'title', 'thumbnail', 'custom-fields', 'excerpt', 'author' ),

    );
    
    register_post_type( 'destinations', $args );


    $labels = array(
        'name'               => _x('Networking', 'Post Type General Name', 'nabshow-lv'),
        'singular_name'      => _x('Networking', 'Post Type Singular Name', 'nabshow-lv'),
        'menu_name'          => __('Networking', 'nabshow-lv'),
        'parent_item_colon'  => __('Parent Networking', 'nabshow-lv'),
        'all_items'          => __('All Networking', 'nabshow-lv'),
        'view_item'          => __('View Networking', 'nabshow-lv'),
        'add_new_item'       => __('Add New Networking', 'nabshow-lv'),
        'add_new'            => __('Add New', 'nabshow-lv'),
        'edit_item'          => __('Edit Networking', 'nabshow-lv'),
        'update_item'        => __('Update Networking', 'nabshow-lv'),
        'search_items'       => __('Search Networking', 'nabshow-lv'),
        'not_found'          => __('Not Found', 'nabshow-lv'),
        'not_found_in_trash' => __('Not found in Trash', 'nabshow-lv'),
    );

    $args = array(
        'label'               => __('Networking', 'nabshow-lv'),
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
        'supports'            => array( 'title', 'thumbnail', 'custom-fields', 'excerpt', 'author' ),

    );
    
    register_post_type( 'networking', $args );
}
add_action( 'init', 'nabshow_lv_2021_register_custom_post_type' );

add_action( 'wp_head', 'nabshow_get_existing_exhibitors_ids' );
function nabshow_get_existing_exhibitors_ids() {

	if ( isset( $_GET['ex'] ) && ! empty( $_GET['ex'] ) ) {

		$query_args = array(
			'post_type' => 'exhibitors',
			'posts_per_page' => -1,
			'fields'	=> 'ids'
		);

		$exhibitors = new WP_Query( $query_args );
		$all_ids = $exhibitors->posts;
		$exhibitors_id = array();
		foreach( $all_ids as $current_id ) {
			$exhibitors_id[] = get_post_meta( $current_id, 'exhid', true );
		}

		echo '<pre>'; print_r( $exhibitors_id ); exit;
	}
}