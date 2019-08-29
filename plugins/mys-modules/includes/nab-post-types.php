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
 * Register Tracks Taxonomy for Sessions.
 *
 * @package MYS Modules
 * @since 1.0.0
 */
function sessions_tracks_taxonomy() {
	register_taxonomy(
		'tracks',
		array( 'sessions' ),
		array(
			'hierarchical' => true,
			'label'        => 'Tracks',
			'query_var'    => true,
			'show_in_rest' => true,
			'rewrite'      => array(
				'slug'       => 'track',
				'with_front' => false
			)
		)
	);
}

add_action( 'init', 'sessions_tracks_taxonomy', 0 );

/**
 * Register Session Post Type
 *
 * @package MYS Modules
 * @since 1.0.0
 */
function nab_mys_session_fun() {

	$labels = array(
		'name'               => _x( 'Sessions', 'mys-modules' ),
		'singular_name'      => _x( 'Session', 'mys-modules' ),
		'add_new'            => __( 'Add New', 'mys-modules' ),
		'add_new_item'       => __( 'Add New Session', 'mys-modules' ),
		'edit_item'          => __( 'Edit', 'mys-modules' ),
		'new_item'           => __( 'New Session', 'mys-modules' ),
		'all_items'          => __( 'All Sessions', 'mys-modules' ),
		'view_item'          => __( 'View Sessions', 'mys-modules' ),
		'search_items'       => __( 'Search Sessions', 'mys-modules' ),
		'not_found'          => __( 'No Sessions found', 'mys-modules' ),
		'not_found_in_trash' => __( 'No Sessions found in Trash', 'mys-modules' ),
		'parent_item_colon'  => __( '', 'mys-modules' ),
		'menu_name'          => __( 'Sessions', 'mys-modules' )
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'taxonomies'          => array( 'tracks' ), /*'post_tag'*/
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'exclude_from_search' => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => false,
		'show_in_rest'        => true,
		'has_archive'         => true,
		'show_admin_column'   => true,
		'query_var'           => true,
		'capability_type'     => 'post',
		'hierarchical'        => true,
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
		)
	);

	register_post_type( 'sessions', $args );
	register_taxonomy_for_object_type( 'tracks', 'sessions' );

}

//Action to register Sessions Post Type
add_action( 'init', 'nab_mys_session_fun' );

/**
 * Register Speakers Post Type
 *
 * @package MYS Modules
 * @since 1.0.0
 */
function nab_mys_speaker_fun() {

	$labels = array(
		'name'               => _x( 'Speakers', 'mys-modules' ),
		'singular_name'      => _x( 'Speaker', 'mys-modules' ),
		'add_new'            => __( 'Add New', 'mys-modules' ),
		'add_new_item'       => __( 'Add New Speaker', 'mys-modules' ),
		'edit_item'          => __( 'Edit', 'mys-modules' ),
		'new_item'           => __( 'New Speaker', 'mys-modules' ),
		'all_items'          => __( 'All Speakers', 'mys-modules' ),
		'view_item'          => __( 'View Speakers', 'mys-modules' ),
		'search_items'       => __( 'Search Speakers', 'mys-modules' ),
		'not_found'          => __( 'No Speakers found', 'mys-modules' ),
		'not_found_in_trash' => __( 'No Speakers found in Trash', 'mys-modules' ),
		'parent_item_colon'  => __( '', 'mys-modules' ),
		'menu_name'          => __( 'Speakers', 'mys-modules' )
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'show_in_rest'        => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'exclude_from_search' => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => false,
		'has_archive'         => true,
		'query_var'           => true,
		'capability_type'     => 'post',
		'hierarchical'        => true,
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
		)
	);

	register_post_type( 'speakers', $args );

}

//Action to register speakers Post Type
add_action( 'init', 'nab_mys_speaker_fun' );


/**
 * Register Sponsors Post Type
 *
 * @package MYS Modules
 * @since 1.0.0
 */
function nab_mys_sponsor_fun() {

	$labels = array(
		'name'               => _x( 'Sponsors', 'mys-modules' ),
		'singular_name'      => _x( 'Sponsor', 'mys-modules' ),
		'add_new'            => __( 'Add New', 'mys-modules' ),
		'add_new_item'       => __( 'Add New Sponsor', 'mys-modules' ),
		'edit_item'          => __( 'Edit', 'mys-modules' ),
		'new_item'           => __( 'New Sponsor', 'mys-modules' ),
		'all_items'          => __( 'All Sponsors', 'mys-modules' ),
		'view_item'          => __( 'View Sponsors', 'mys-modules' ),
		'search_items'       => __( 'Search Sponsors', 'mys-modules' ),
		'not_found'          => __( 'No Sponsors found', 'mys-modules' ),
		'not_found_in_trash' => __( 'No Sponsors found in Trash', 'mys-modules' ),
		'parent_item_colon'  => __( '', 'mys-modules' ),
		'menu_name'          => __( 'Sponsors', 'mys-modules' )
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'show_in_rest'        => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'exclude_from_search' => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => false,
		'has_archive'         => true,
		'query_var'           => true,
		'capability_type'     => 'post',
		'hierarchical'        => true,
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
		)
	);

	register_post_type( 'sponsors', $args );

}

//Action to register sponsors Post Type
add_action( 'init', 'nab_mys_sponsor_fun' );

function exhibitors_category_taxonomy() {
	register_taxonomy(
		'exhibitors-category',
		array( 'exhibitors' ),
		array(
			'hierarchical' => true,
			'label'        => 'Categories',
			'query_var'    => true,
			'show_in_rest' => true,
			'rewrite'      => array(
				'slug'       => 'exhibitors-category',
				'with_front' => false
			)
		)
	);
}

add_action( 'init', 'exhibitors_category_taxonomy', 0 );


/**
 * Register Exhibitors Post Type
 *
 * @package MYS Modules
 * @since 1.0.0
 */
function nab_mys_exhibitor_fun() {

	$labels = array(
		'name'               => _x( 'Exhibitors', 'mys-modules' ),
		'singular_name'      => _x( 'Exhibitor', 'mys-modules' ),
		'add_new'            => __( 'Add New', 'mys-modules' ),
		'add_new_item'       => __( 'Add New Exhibitor', 'mys-modules' ),
		'edit_item'          => __( 'Edit', 'mys-modules' ),
		'new_item'           => __( 'New Exhibitor', 'mys-modules' ),
		'all_items'          => __( 'All Exhibitors', 'mys-modules' ),
		'view_item'          => __( 'View Exhibitors', 'mys-modules' ),
		'search_items'       => __( 'Search Exhibitors', 'mys-modules' ),
		'not_found'          => __( 'No Exhibitors found', 'mys-modules' ),
		'not_found_in_trash' => __( 'No Exhibitors found in Trash', 'mys-modules' ),
		'parent_item_colon'  => __( '', 'mys-modules' ),
		'menu_name'          => __( 'Exhibitors', 'mys-modules' )
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'taxonomies'          => array( 'exhibitors-category' ),
		'show_in_rest'        => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'exclude_from_search' => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => false,
		'has_archive'         => true,
		'query_var'           => true,
		'capability_type'     => 'post',
		'hierarchical'        => true,
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
		)
	);

	register_post_type( 'exhibitors', $args );

}

//Action to register exhibitors Post Type
add_action( 'init', 'nab_mys_exhibitor_fun' );
