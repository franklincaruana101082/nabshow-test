<?php
/**
 * NABShow LV functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package NABShow_LV
 */

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
 * All the shortcode functions.
 */
require get_template_directory() . '/inc/ads-view-list-data.php';

add_filter( 'mime_types', 'wpse_mime_types' );
function wpse_mime_types( $existing_mimes ) {
	// Add csv to the list of allowed mime types
	$existing_mimes['csv'] = 'text/csv';

	return $existing_mimes;
}


/**
 *
 * @todo can't upload to VIP server it's use for internal server only.
 */

if ( function_exists( 'gutenberg_ramp_load_gutenberg' ) ) {
    gutenberg_ramp_load_gutenberg();
}

/**
 *
 * @todo can't upload to VIP server it's use for internal server only.
 */
add_filter( 'allow_subdirectory_install', '__return_true' );
