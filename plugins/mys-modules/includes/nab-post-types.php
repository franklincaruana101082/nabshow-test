<?php
/**
 * MYS Dependent Post Types are registered in this file.
 *
 * @package MYS Modules
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register Taxonomies for Sessions.
 *
 * @package MYS Modules
 * @since 1.0.0
 */
function nab_mys_sessions_taxonomies() {

	$session_slug = MYS_IS_AMPLIFY_VERSION ? 'mys-sessions' : 'sessions';

	// Taxonomy - tracks
	$tracks_labels = array(
		'name'              => __( 'Tracks', 'taxonomy general name', 'mys-modules' ),
		'singular_name'     => __( 'Tracks', 'taxonomy singular name', 'mys-modules' ),
		'search_items'      => __( 'Search Tracks', 'mys-modules' ),
		'all_items'         => __( 'All Tracks', 'mys-modules' ),
		'parent_item'       => __( 'Parent Track', 'mys-modules' ),
		'parent_item_colon' => __( 'Parent Track:', 'mys-modules' ),
		'edit_item'         => __( 'Edit Track', 'mys-modules' ),
		'update_item'       => __( 'Update Track', 'mys-modules' ),
		'add_new_item'      => __( 'Add New Track', 'mys-modules' ),
		'new_item_name'     => __( 'New Genre Track', 'mys-modules' ),
		'menu_name'         => __( 'Tracks', 'mys-modules' ),
	);

	$tracks_args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $tracks_labels,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'tracks' ),
	);

	register_taxonomy( 'tracks', array( $session_slug ), $tracks_args );

	// Taxonomy - session-categories
	$category_labels = array(
		'name'              => __( 'Categories', 'taxonomy general name', 'mys-modules' ),
		'singular_name'     => __( 'Categories', 'taxonomy singular name', 'mys-modules' ),
		'search_items'      => __( 'Search Categories', 'mys-modules' ),
		'all_items'         => __( 'All Categories', 'mys-modules' ),
		'parent_item'       => __( 'Parent Category', 'mys-modules' ),
		'parent_item_colon' => __( 'Parent Category:', 'mys-modules' ),
		'edit_item'         => __( 'Edit Category', 'mys-modules' ),
		'update_item'       => __( 'Update Category', 'mys-modules' ),
		'add_new_item'      => __( 'Add New Category', 'mys-modules' ),
		'new_item_name'     => __( 'New Genre Category', 'mys-modules' ),
		'menu_name'         => __( 'Categories', 'mys-modules' ),
	);

	$category_args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $category_labels,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'session-categories' ),
	);

	register_taxonomy( 'session-categories', array( $session_slug ), $category_args );

	// Taxonomy - session-levels
	$level_labels = array(
		'name'              => __( 'Levels', 'taxonomy general name', 'mys-modules' ),
		'singular_name'     => __( 'Levels', 'taxonomy singular name', 'mys-modules' ),
		'search_items'      => __( 'Search Levels', 'mys-modules' ),
		'all_items'         => __( 'All Levels', 'mys-modules' ),
		'parent_item'       => __( 'Parent Level', 'mys-modules' ),
		'parent_item_colon' => __( 'Parent Level:', 'mys-modules' ),
		'edit_item'         => __( 'Edit Level', 'mys-modules' ),
		'update_item'       => __( 'Update Level', 'mys-modules' ),
		'add_new_item'      => __( 'Add New Level', 'mys-modules' ),
		'new_item_name'     => __( 'New Genre Level', 'mys-modules' ),
		'menu_name'         => __( 'Levels', 'mys-modules' ),
	);

	$level_args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $level_labels,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'session-levels' ),
	);

	register_taxonomy( 'session-levels', array( $session_slug ), $level_args );

	// Taxonomy - session-types
	$type_labels = array(
		'name'              => __( 'Types', 'taxonomy general name', 'mys-modules' ),
		'singular_name'     => __( 'Types', 'taxonomy singular name', 'mys-modules' ),
		'search_items'      => __( 'Search Types', 'mys-modules' ),
		'all_items'         => __( 'All Types', 'mys-modules' ),
		'parent_item'       => __( 'Parent Type', 'mys-modules' ),
		'parent_item_colon' => __( 'Parent Type:', 'mys-modules' ),
		'edit_item'         => __( 'Edit Type', 'mys-modules' ),
		'update_item'       => __( 'Update Type', 'mys-modules' ),
		'add_new_item'      => __( 'Add New Type', 'mys-modules' ),
		'new_item_name'     => __( 'New Genre Type', 'mys-modules' ),
		'menu_name'         => __( 'Types', 'mys-modules' ),
	);

	$type_args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $type_labels,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'session-types' ),
	);

	register_taxonomy( 'session-types', array( $session_slug ), $type_args );

	// Taxonomy - session-locations
	$location_labels = array(
		'name'              => __( 'Locations', 'taxonomy general name', 'mys-modules' ),
		'singular_name'     => __( 'Locations', 'taxonomy singular name', 'mys-modules' ),
		'search_items'      => __( 'Search Locations', 'mys-modules' ),
		'all_items'         => __( 'All Locations', 'mys-modules' ),
		'parent_item'       => __( 'Parent Location', 'mys-modules' ),
		'parent_item_colon' => __( 'Parent Location:', 'mys-modules' ),
		'edit_item'         => __( 'Edit Location', 'mys-modules' ),
		'update_item'       => __( 'Update Location', 'mys-modules' ),
		'add_new_item'      => __( 'Add New Location', 'mys-modules' ),
		'new_item_name'     => __( 'New Genre Location', 'mys-modules' ),
		'menu_name'         => __( 'Locations', 'mys-modules' ),
	);

	$location_args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $location_labels,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'session-locations' ),
	);

	register_taxonomy( 'session-locations', array( $session_slug ), $location_args );

}

add_action( 'init', 'nab_mys_sessions_taxonomies', 0 );

/**
 * Register Session Post Type
 *
 * @package MYS Modules
 * @since 1.0.0
 */
function nab_mys_sessions_post_type() {

	$labels = array(
		'name'               => __( 'MYS Sessions', 'mys-modules' ),
		'singular_name'      => __( 'MYS Session', 'mys-modules' ),
		'add_new'            => __( 'Add New', 'mys-modules' ),
		'add_new_item'       => __( 'Add New MYS Session', 'mys-modules' ),
		'edit_item'          => __( 'Edit', 'mys-modules' ),
		'new_item'           => __( 'New MYS Session', 'mys-modules' ),
		'all_items'          => __( 'All MYS Sessions', 'mys-modules' ),
		'view_item'          => __( 'View MYS Sessions', 'mys-modules' ),
		'search_items'       => __( 'Search MYS Sessions', 'mys-modules' ),
		'not_found'          => __( 'No MYS Sessions found', 'mys-modules' ),
		'not_found_in_trash' => __( 'No MYS Sessions found in Trash', 'mys-modules' ),
		'parent_item_colon'  => __( '', 'mys-modules' ),
		'menu_name'          => __( 'MYS Sessions', 'mys-modules' )
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'taxonomies'          => array( 'tracks' ),
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'exclude_from_search' => false,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_rest'        => true,
		'has_archive'         => true,
		'show_admin_column'   => true,
		'query_var'           => true,
		'capability_type'     => 'post',
		'hierarchical'        => true,
		'menu_icon'           => 'dashicons-money',
		'supports'            => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'revisions',
			'trackbacks',
			'page-attributes',
			'menu_order',
			'custom-fields'
		),
		'capabilities' => array(
			'create_posts'	=> 'do_not_allow',		
		),
	);

	// change post type slug for amplify site.
	$session_slug = MYS_IS_AMPLIFY_VERSION ? 'mys-sessions' : 'sessions';

	register_post_type( $session_slug, $args );
	register_taxonomy_for_object_type( 'tracks', $session_slug );

}

add_action( 'init', 'nab_mys_sessions_post_type' );

/**
 * Register Taxonomies for Speakers.
 *
 * @package MYS Modules
 * @since 1.0.0
 */
function nab_mys_speakers_taxonomies() {

	$speaker_slug = MYS_IS_AMPLIFY_VERSION ? 'mys-speakers' : 'speakers';
	// Taxonomy - speaker-categories
	$category_labels = array(
		'name'              => __( 'Categories', 'taxonomy general name', 'mys-modules' ),
		'singular_name'     => __( 'Categories', 'taxonomy singular name', 'mys-modules' ),
		'search_items'      => __( 'Search Categories', 'mys-modules' ),
		'all_items'         => __( 'All Categories', 'mys-modules' ),
		'parent_item'       => __( 'Parent Category', 'mys-modules' ),
		'parent_item_colon' => __( 'Parent Category:', 'mys-modules' ),
		'edit_item'         => __( 'Edit Category', 'mys-modules' ),
		'update_item'       => __( 'Update Category', 'mys-modules' ),
		'add_new_item'      => __( 'Add New Category', 'mys-modules' ),
		'new_item_name'     => __( 'New Genre Category', 'mys-modules' ),
		'menu_name'         => __( 'Categories', 'mys-modules' ),
	);

	$category_args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $category_labels,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'speaker-categories' ),
	);

	register_taxonomy( 'speaker-categories', array( $speaker_slug ), $category_args );

	// Taxonomy - speaker-companies
	$company_labels = array(
		'name'              => __( 'Companies', 'taxonomy general name', 'mys-modules' ),
		'singular_name'     => __( 'Companies', 'taxonomy singular name', 'mys-modules' ),
		'search_items'      => __( 'Search Companies', 'mys-modules' ),
		'all_items'         => __( 'All Companies', 'mys-modules' ),
		'parent_item'       => __( 'Parent Company', 'mys-modules' ),
		'parent_item_colon' => __( 'Parent Company:', 'mys-modules' ),
		'edit_item'         => __( 'Edit Company', 'mys-modules' ),
		'update_item'       => __( 'Update Company', 'mys-modules' ),
		'add_new_item'      => __( 'Add New Company', 'mys-modules' ),
		'new_item_name'     => __( 'New Genre Company', 'mys-modules' ),
		'menu_name'         => __( 'Companies', 'mys-modules' ),
	);

	$company_args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $company_labels,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'speaker-companies' ),
	);

	register_taxonomy( 'speaker-companies', array( $speaker_slug ), $company_args );

}

add_action( 'init', 'nab_mys_speakers_taxonomies', 0 );

/**
 * Register Speakers Post Type
 *
 * @package MYS Modules
 * @since 1.0.0
 */
function nab_mys_speakers_post_type() {

	$labels = array(
		'name'               => __( 'MYS Speakers', 'mys-modules' ),
		'singular_name'      => __( 'MYS Speaker', 'mys-modules' ),
		'add_new'            => __( 'Add New', 'mys-modules' ),
		'add_new_item'       => __( 'Add New MYS Speaker', 'mys-modules' ),
		'edit_item'          => __( 'Edit', 'mys-modules' ),
		'new_item'           => __( 'New MYS Speaker', 'mys-modules' ),
		'all_items'          => __( 'All MYS Speakers', 'mys-modules' ),
		'view_item'          => __( 'View MYS Speakers', 'mys-modules' ),
		'search_items'       => __( 'Search MYS Speakers', 'mys-modules' ),
		'not_found'          => __( 'No MYS Speakers found', 'mys-modules' ),
		'not_found_in_trash' => __( 'No MYS Speakers found in Trash', 'mys-modules' ),
		'parent_item_colon'  => __( '', 'mys-modules' ),
		'menu_name'          => __( 'MYS Speakers', 'mys-modules' )
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'show_in_rest'        => true,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'exclude_from_search' => false,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'has_archive'         => true,
		'query_var'           => true,
		'capability_type'     => 'post',
		'hierarchical'        => true,
		'menu_icon'           => 'dashicons-megaphone',
		'supports'            => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'revisions',
			'trackbacks',
			'page-attributes',
			'menu_order',
			'custom-fields'
		),
		'capabilities' => array(
			'create_posts'	=> 'do_not_allow',		
		),
	);

	// change post type slug for amplify site.
	$speaker_slug = MYS_IS_AMPLIFY_VERSION ? 'mys-speakers' : 'speakers';

	register_post_type( $speaker_slug, $args );

}

add_action( 'init', 'nab_mys_speakers_post_type' );

/**
 * Register Taxonomies for Speakers.
 *
 * @package MYS Modules
 * @since 1.0.0
 */
function nab_mys_sponsors_taxonomies() {

	$sponsors_slug = MYS_IS_AMPLIFY_VERSION ? 'mys-sponsors' : 'sponsors';

	// Taxonomy - sponsor-categories
	$category_labels = array(
		'name'              => __( 'Categories', 'taxonomy general name', 'mys-modules' ),
		'singular_name'     => __( 'Categories', 'taxonomy singular name', 'mys-modules' ),
		'search_items'      => __( 'Search Categories', 'mys-modules' ),
		'all_items'         => __( 'All Categories', 'mys-modules' ),
		'parent_item'       => __( 'Parent Category', 'mys-modules' ),
		'parent_item_colon' => __( 'Parent Category:', 'mys-modules' ),
		'edit_item'         => __( 'Edit Category', 'mys-modules' ),
		'update_item'       => __( 'Update Category', 'mys-modules' ),
		'add_new_item'      => __( 'Add New Category', 'mys-modules' ),
		'new_item_name'     => __( 'New Genre Category', 'mys-modules' ),
		'menu_name'         => __( 'Categories', 'mys-modules' ),
	);

	$category_args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $category_labels,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'sponsor-categories' ),
	);

	register_taxonomy( 'sponsor-categories', array( $sponsors_slug ), $category_args );

	// Taxonomy - sponsor-types
	$type_labels = array(
		'name'              => __( 'Types', 'taxonomy general name', 'mys-modules' ),
		'singular_name'     => __( 'Types', 'taxonomy singular name', 'mys-modules' ),
		'search_items'      => __( 'Search Types', 'mys-modules' ),
		'all_items'         => __( 'All Types', 'mys-modules' ),
		'parent_item'       => __( 'Parent Type', 'mys-modules' ),
		'parent_item_colon' => __( 'Parent Type:', 'mys-modules' ),
		'edit_item'         => __( 'Edit Type', 'mys-modules' ),
		'update_item'       => __( 'Update Type', 'mys-modules' ),
		'add_new_item'      => __( 'Add New Type', 'mys-modules' ),
		'new_item_name'     => __( 'New Genre Type', 'mys-modules' ),
		'menu_name'         => __( 'Types', 'mys-modules' ),
	);

	$type_args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $type_labels,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'sponsor-types' ),
	);

	register_taxonomy( 'sponsor-types', array( $sponsors_slug ), $type_args );
}

add_action( 'init', 'nab_mys_sponsors_taxonomies', 0 );

/**
 * Register Sponsors Post Type
 *
 * @package MYS Modules
 * @since 1.0.0
 */
function nab_mys_sponsor_post_type() {

	$labels = array(
		'name'               => __( 'MYS Sponsors-Partners', 'mys-modules' ),
		'singular_name'      => __( 'MYS Sponsor-Partner', 'mys-modules' ),
		'add_new'            => __( 'Add New', 'mys-modules' ),
		'add_new_item'       => __( 'Add New MYS Sponsor-Partner', 'mys-modules' ),
		'edit_item'          => __( 'Edit', 'mys-modules' ),
		'new_item'           => __( 'New MYS Sponsor-Partner', 'mys-modules' ),
		'all_items'          => __( 'All MYS Sponsors-Partners', 'mys-modules' ),
		'view_item'          => __( 'View MYS Sponsors-Partners', 'mys-modules' ),
		'search_items'       => __( 'Search MYS Sponsors-Partners', 'mys-modules' ),
		'not_found'          => __( 'No MYS Sponsors-Partners found', 'mys-modules' ),
		'not_found_in_trash' => __( 'No MYS Sponsors-Partners found in Trash', 'mys-modules' ),
		'parent_item_colon'  => __( '', 'mys-modules' ),
		'menu_name'          => __( 'MYS Sponsors-Partners', 'mys-modules' )
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'show_in_rest'        => true,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'exclude_from_search' => false,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'has_archive'         => true,
		'query_var'           => true,
		'capability_type'     => 'post',
		'hierarchical'        => true,
		'menu_icon'           => 'dashicons-groups',
		'supports'            => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'revisions',
			'trackbacks',
			'page-attributes',
			'menu_order',
			'custom-fields'
		),
		'capabilities' => array(
			'create_posts'	=> 'do_not_allow',		
		),
	);

	// change post type slug for amplify site.
	$sponsors_slug = MYS_IS_AMPLIFY_VERSION ? 'mys-sponsors' : 'sponsors';

	register_post_type( $sponsors_slug, $args );

}

add_action( 'init', 'nab_mys_sponsor_post_type' );

/**
 * Register Taxonomies for Exhibitors.
 *
 * @package MYS Modules
 * @since 1.0.0
 */
function nab_mys_exhibitors_taxonomies() {

	$exhibitors_slug	= MYS_IS_AMPLIFY_VERSION ? 'mys-exhibitors' : 'exhibitors';
	$products_slug		= MYS_IS_AMPLIFY_VERSION ? 'mys-products' : 'products';

	// Taxonomy - exhibitor-categories
	$category_labels = array(
		'name'              => __( 'Categories', 'taxonomy general name', 'mys-modules' ),
		'singular_name'     => __( 'Categories', 'taxonomy singular name', 'mys-modules' ),
		'search_items'      => __( 'Search Categories', 'mys-modules' ),
		'all_items'         => __( 'All Categories', 'mys-modules' ),
		'parent_item'       => __( 'Parent Category', 'mys-modules' ),
		'parent_item_colon' => __( 'Parent Category:', 'mys-modules' ),
		'edit_item'         => __( 'Edit Category', 'mys-modules' ),
		'update_item'       => __( 'Update Category', 'mys-modules' ),
		'add_new_item'      => __( 'Add New Category', 'mys-modules' ),
		'new_item_name'     => __( 'New Genre Category', 'mys-modules' ),
		'menu_name'         => __( 'Categories', 'mys-modules' ),
	);

	$category_args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $category_labels,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'exhibitor-categories' ),
	);

	register_taxonomy( 'exhibitor-categories', array( $exhibitors_slug, $products_slug ), $category_args );

	// Taxonomy - halls
	$hall_labels = array(
		'name'              => __( 'Halls', 'taxonomy general name', 'mys-modules' ),
		'singular_name'     => __( 'Halls', 'taxonomy singular name', 'mys-modules' ),
		'search_items'      => __( 'Search Halls', 'mys-modules' ),
		'all_items'         => __( 'All Halls', 'mys-modules' ),
		'parent_item'       => __( 'Parent Hall', 'mys-modules' ),
		'parent_item_colon' => __( 'Parent Hall:', 'mys-modules' ),
		'edit_item'         => __( 'Edit Hall', 'mys-modules' ),
		'update_item'       => __( 'Update Hall', 'mys-modules' ),
		'add_new_item'      => __( 'Add New Hall', 'mys-modules' ),
		'new_item_name'     => __( 'New Genre Hall', 'mys-modules' ),
		'menu_name'         => __( 'Halls', 'mys-modules' ),
	);

	$hall_args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $hall_labels,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'halls' ),
	);

	register_taxonomy( 'halls', array( $exhibitors_slug ), $hall_args );

	// Taxonomy - pavilions
	$pavilion_labels = array(
		'name'              => __( 'Pavilions', 'taxonomy general name', 'mys-modules' ),
		'singular_name'     => __( 'Pavilions', 'taxonomy singular name', 'mys-modules' ),
		'search_items'      => __( 'Search Pavilions', 'mys-modules' ),
		'all_items'         => __( 'All Pavilions', 'mys-modules' ),
		'parent_item'       => __( 'Parent Pavilion', 'mys-modules' ),
		'parent_item_colon' => __( 'Parent Pavilion:', 'mys-modules' ),
		'edit_item'         => __( 'Edit Pavilion', 'mys-modules' ),
		'update_item'       => __( 'Update Pavilion', 'mys-modules' ),
		'add_new_item'      => __( 'Add New Pavilion', 'mys-modules' ),
		'new_item_name'     => __( 'New Genre Pavilion', 'mys-modules' ),
		'menu_name'         => __( 'Pavilions', 'mys-modules' ),
	);

	$pavilion_args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $pavilion_labels,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'pavilions' ),
	);

	register_taxonomy( 'pavilions', array( $exhibitors_slug ), $pavilion_args );

	// Taxonomy - exhibitor-keywords
	$keyword_labels = array(
		'name'              => __( 'Keywords', 'taxonomy general name', 'mys-modules' ),
		'singular_name'     => __( 'Keywords', 'taxonomy singular name', 'mys-modules' ),
		'search_items'      => __( 'Search Keywords', 'mys-modules' ),
		'all_items'         => __( 'All Keywords', 'mys-modules' ),
		'parent_item'       => __( 'Parent Keyword', 'mys-modules' ),
		'parent_item_colon' => __( 'Parent Keyword:', 'mys-modules' ),
		'edit_item'         => __( 'Edit Keyword', 'mys-modules' ),
		'update_item'       => __( 'Update Keyword', 'mys-modules' ),
		'add_new_item'      => __( 'Add New Keyword', 'mys-modules' ),
		'new_item_name'     => __( 'New Genre Keyword', 'mys-modules' ),
		'menu_name'         => __( 'Keywords', 'mys-modules' ),
	);

	$keyword_args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $keyword_labels,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'exhibitor-keywords' ),
	);

	register_taxonomy( 'exhibitor-keywords', array( $exhibitors_slug ), $keyword_args );

	// Taxonomy - exhibitor-trends
	$trend_labels = array(
		'name'              => __( 'Trends', 'taxonomy general name', 'mys-modules' ),
		'singular_name'     => __( 'Trends', 'taxonomy singular name', 'mys-modules' ),
		'search_items'      => __( 'Search Trends', 'mys-modules' ),
		'all_items'         => __( 'All Trends', 'mys-modules' ),
		'parent_item'       => __( 'Parent Trend', 'mys-modules' ),
		'parent_item_colon' => __( 'Parent Trend:', 'mys-modules' ),
		'edit_item'         => __( 'Edit Trend', 'mys-modules' ),
		'update_item'       => __( 'Update Trend', 'mys-modules' ),
		'add_new_item'      => __( 'Add New Trend', 'mys-modules' ),
		'new_item_name'     => __( 'New Genre Trend', 'mys-modules' ),
		'menu_name'         => __( 'Trends', 'mys-modules' ),
	);

	$trend_args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $trend_labels,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'exhibitor-trends' ),
	);

	register_taxonomy( 'exhibitor-trends', array( $exhibitors_slug ), $trend_args );
}

add_action( 'init', 'nab_mys_exhibitors_taxonomies', 0 );

/**
 * Register Exhibitors Post Type
 *
 * @package MYS Modules
 * @since 1.0.0
 */
function nab_mys_exhibitor_post_type() {

	$labels = array(
		'name'               => __( 'MYS Exhibitors', 'mys-modules' ),
		'singular_name'      => __( 'MYS Exhibitor', 'mys-modules' ),
		'add_new'            => __( 'Add New', 'mys-modules' ),
		'add_new_item'       => __( 'Add New MYS Exhibitor', 'mys-modules' ),
		'edit_item'          => __( 'Edit', 'mys-modules' ),
		'new_item'           => __( 'New MYS Exhibitor', 'mys-modules' ),
		'all_items'          => __( 'All MYS Exhibitors', 'mys-modules' ),
		'view_item'          => __( 'View MYS Exhibitors', 'mys-modules' ),
		'search_items'       => __( 'Search MYS Exhibitors', 'mys-modules' ),
		'not_found'          => __( 'No MYS Exhibitors found', 'mys-modules' ),
		'not_found_in_trash' => __( 'No MYS Exhibitors found in Trash', 'mys-modules' ),
		'parent_item_colon'  => __( '', 'mys-modules' ),
		'menu_name'          => __( 'MYS Exhibitors', 'mys-modules' )
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'taxonomies'          => array( 'exhibitor-categories' ),
		'show_in_rest'        => true,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'exclude_from_search' => false,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'has_archive'         => true,
		'query_var'           => true,
		'capability_type'     => 'post',
		'hierarchical'        => true,
		'menu_icon'           => 'dashicons-store',
		'supports'            => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'revisions',
			'trackbacks',
			'page-attributes',
			'menu_order',
			'custom-fields'
		),
		'capabilities' => array(
			'create_posts'	=> 'do_not_allow',		
		),
	);

	// change post type slug for amplify site.
	$exhibitors_slug = MYS_IS_AMPLIFY_VERSION ? 'mys-exhibitors' : 'exhibitors';

	register_post_type( $exhibitors_slug, $args );

}

add_action( 'init', 'nab_mys_exhibitor_post_type' );

/**
 * Register Products Post Type
 *
 * @package MYS Modules
 * @since 1.0.0
 */
function nab_mys_product_post_type() {

	$labels = array(
		'name'               => __( 'MYS Products', 'mys-modules' ),
		'singular_name'      => __( 'MYS Product', 'mys-modules' ),
		'add_new'            => __( 'Add New', 'mys-modules' ),
		'add_new_item'       => __( 'Add New MYS Product', 'mys-modules' ),
		'edit_item'          => __( 'Edit', 'mys-modules' ),
		'new_item'           => __( 'New MYS Product', 'mys-modules' ),
		'all_items'          => __( 'All MYS Products', 'mys-modules' ),
		'view_item'          => __( 'View MYS Products', 'mys-modules' ),
		'search_items'       => __( 'Search MYS Products', 'mys-modules' ),
		'not_found'          => __( 'No MYS Products found', 'mys-modules' ),
		'not_found_in_trash' => __( 'No MYS Products found in Trash', 'mys-modules' ),
		'parent_item_colon'  => __( '', 'mys-modules' ),
		'menu_name'          => __( 'MYS Products', 'mys-modules' )
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'taxonomies'          => array( 'product-categories' ),
		'show_in_rest'        => true,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'exclude_from_search' => false,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'has_archive'         => true,
		'query_var'           => true,
		'capability_type'     => 'post',
		'hierarchical'        => true,
		'menu_icon'           => 'dashicons-products',
		'supports'            => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'revisions',
			'trackbacks',
			'page-attributes',
			'menu_order',
			'custom-fields'
		),
		'capabilities' => array(
			'create_posts'	=> 'do_not_allow',		
		),
	);

	// change post type slug for amplify site.
	$products_slug = MYS_IS_AMPLIFY_VERSION ? 'mys-products' : 'products';

	register_post_type( $products_slug, $args );
}

add_action( 'init', 'nab_mys_product_post_type' );

/**
 * Hide editor update and publish button from the editor
 */
function nab_mys_hide_editor_update_button() {

	global $pagenow, $post;

	if ( MYS_IS_AMPLIFY_VERSION ) {
		$post_type_list = array( 'mys-sessions', 'mys-speakers', 'mys-sponsors', 'mys-products', 'mys-exhibitors' );
	} else {
		$post_type_list = array( 'sessions', 'speakers', 'sponsors', 'products', 'exhibitors' );
	}

	if ( 'post.php' === $pagenow && in_array( get_post_type( $post ), $post_type_list ) ) {
		?>
		<style>
			#editor .edit-post-header .editor-post-publish-button__button{display:none;}
		</style>
		<?php
	}
}
 add_action( 'admin_head', 'nab_mys_hide_editor_update_button' );
