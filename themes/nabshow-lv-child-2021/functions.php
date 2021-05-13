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
		'before_widget' => '<div id="%1$s" class="signup__body %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="h-md">',
        'after_title'   => '</h3>',
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