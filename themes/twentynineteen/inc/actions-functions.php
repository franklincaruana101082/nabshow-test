<?php
/**
 * Register Session Post Type and associated taxonomies.
 * 
 */
function amplify_register_sessions_post_type() {

	$labels = array(
		'name'               => __( 'Sessions', 'amplify' ),
		'singular_name'      => __( 'Session', 'amplify' ),
		'add_new'            => __( 'Add New', 'amplify' ),
		'add_new_item'       => __( 'Add New Session', 'amplify' ),
		'edit_item'          => __( 'Edit', 'amplify' ),
		'new_item'           => __( 'New Session', 'amplify' ),
		'all_items'          => __( 'All Sessions', 'amplify' ),
		'view_item'          => __( 'View Sessions', 'amplify' ),
		'search_items'       => __( 'Search Sessions', 'amplify' ),
		'not_found'          => __( 'No Sessions found', 'amplify' ),
		'not_found_in_trash' => __( 'No Sessions found in Trash', 'amplify' ),
		'parent_item_colon'  => __( '', 'amplify' ),
		'menu_name'          => __( 'Sessions', 'amplify' )
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,		
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
		'supports'            => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'revisions',
			'trackbacks',			
			'custom-fields'
		)
	);

	register_post_type( 'sessions', $args );
    
    // Taxonomy - Channel
	$channel_labels = array(
		'name'              => __( 'Channel', 'taxonomy general name', 'amplify' ),
		'singular_name'     => __( 'Channel', 'taxonomy singular name', 'amplify' ),
		'search_items'      => __( 'Search Channel', 'amplify' ),
		'all_items'         => __( 'All Channel', 'amplify' ),
		'parent_item'       => __( 'Parent Channel', 'amplify' ),
		'parent_item_colon' => __( 'Parent Channel:', 'amplify' ),
		'edit_item'         => __( 'Edit Channel', 'amplify' ),
		'update_item'       => __( 'Update Channel', 'amplify' ),
		'add_new_item'      => __( 'Add New Channel', 'amplify' ),
		'new_item_name'     => __( 'New Genre Channel', 'amplify' ),
		'menu_name'         => __( 'Channel', 'amplify' ),
	);

	$channel_args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $channel_labels,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'channel' ),
	);

    register_taxonomy( 'channel', array( 'sessions' ), $channel_args );
    

    // Taxonomy - Tags
	$tag_labels = array(
		'name'              => __( 'Tags', 'taxonomy general name', 'amplify' ),
		'singular_name'     => __( 'Tags', 'taxonomy singular name', 'amplify' ),
		'search_items'      => __( 'Search Tags', 'amplify' ),
		'all_items'         => __( 'All Tags', 'amplify' ),
		'parent_item'       => __( 'Parent Tag', 'amplify' ),
		'parent_item_colon' => __( 'Parent Tag:', 'amplify' ),
		'edit_item'         => __( 'Edit Tag', 'amplify' ),
		'update_item'       => __( 'Update Tag', 'amplify' ),
		'add_new_item'      => __( 'Add New Tag', 'amplify' ),
		'new_item_name'     => __( 'New Genre Tag', 'amplify' ),
		'menu_name'         => __( 'Tags', 'amplify' ),
	);

	$tag_args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $tag_labels,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'session-tags' ),
	);

	register_taxonomy( 'session-tags', array( 'sessions' ), $tag_args );

}

/**
 * Register Speakers post type.
 */
function amplify_register_speakers_post_type() {
    
    $labels = array(
		'name'               => __( 'Speakers', 'amplify' ),
		'singular_name'      => __( 'Speaker', 'amplify' ),
		'add_new'            => __( 'Add New', 'amplify' ),
		'add_new_item'       => __( 'Add New Speaker', 'amplify' ),
		'edit_item'          => __( 'Edit', 'amplify' ),
		'new_item'           => __( 'New Speaker', 'amplify' ),
		'all_items'          => __( 'All Speakers', 'amplify' ),
		'view_item'          => __( 'View Speakers', 'amplify' ),
		'search_items'       => __( 'Search Speakers', 'amplify' ),
		'not_found'          => __( 'No Speakers found', 'amplify' ),
		'not_found_in_trash' => __( 'No Speakers found in Trash', 'amplify' ),
		'parent_item_colon'  => __( '', 'amplify' ),
		'menu_name'          => __( 'Speakers', 'amplify' )
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
		'supports'            => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'revisions',
			'trackbacks',
			'custom-fields'
		)
	);

	register_post_type( 'speakers', $args );
}

/**
 * Register Sponsors post type.
 */
function amplify_register_sponsors_post_type() {

    $labels = array(
		'name'               => __( 'Sponsors', 'amplify' ),
		'singular_name'      => __( 'Sponsor', 'amplify' ),
		'add_new'            => __( 'Add New', 'amplify' ),
		'add_new_item'       => __( 'Add New Sponsor', 'amplify' ),
		'edit_item'          => __( 'Edit', 'amplify' ),
		'new_item'           => __( 'New Sponsor', 'amplify' ),
		'all_items'          => __( 'All Sponsors', 'amplify' ),
		'view_item'          => __( 'View Sponsors', 'amplify' ),
		'search_items'       => __( 'Search Sponsors', 'amplify' ),
		'not_found'          => __( 'No Sponsors found', 'amplify' ),
		'not_found_in_trash' => __( 'No Sponsors found in Trash', 'amplify' ),
		'parent_item_colon'  => __( '', 'amplify' ),
		'menu_name'          => __( 'Sponsors', 'amplify' )
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
		'supports'            => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'revisions',
			'trackbacks',			
			'custom-fields'
		)
	);

	register_post_type( 'sponsors', $args );
}

/**
 * Register Exhibitors post type.
 */
function amplify_register_exhibitors_post_type() {
    
    $labels = array(
		'name'               => __( 'Exhibitors', 'amplify' ),
		'singular_name'      => __( 'Exhibitor', 'amplify' ),
		'add_new'            => __( 'Add New', 'amplify' ),
		'add_new_item'       => __( 'Add New Exhibitor', 'amplify' ),
		'edit_item'          => __( 'Edit', 'amplify' ),
		'new_item'           => __( 'New Exhibitor', 'amplify' ),
		'all_items'          => __( 'All Exhibitors', 'amplify' ),
		'view_item'          => __( 'View Exhibitors', 'amplify' ),
		'search_items'       => __( 'Search Exhibitors', 'amplify' ),
		'not_found'          => __( 'No Exhibitors found', 'amplify' ),
		'not_found_in_trash' => __( 'No Exhibitors found in Trash', 'amplify' ),
		'parent_item_colon'  => __( '', 'amplify' ),
		'menu_name'          => __( 'Exhibitors', 'amplify' )
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
		'supports'            => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'revisions',
			'trackbacks',			
			'custom-fields'
		)
	);

	register_post_type( 'exhibitors', $args );
}