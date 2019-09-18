<?php
/**
 * This file contains all custom post types and taxonomies functions.
 *
 *
 * @package NABShow_LV
 */

/**
 * Added the not-to-be-missed-archive post type
 *
 * @since 1.0
 */

function nabshow_lv_not_to_be_missed_archive() {

    $labels = array(
        'name'               => _x( 'Not to be missed', 'post type general name', 'nabshow-lv' ),
        'singular_name'      => _x( 'Not to be missed', 'post type singular name', 'nabshow-lv' ),
        'add_new_item'       => __( 'Add New', 'nabshow-lv' ),
        'edit_item'          => __( 'Edit', 'nabshow-lv' ),
        'new_item'           => __( 'New', 'nabshow-lv' ),
        'view_item'          => __( 'View', 'nabshow-lv' ),
        'search_items'       => __( 'Search', 'nabshow-lv' ),
        'not_found'          => __( 'No posts found.', 'nabshow-lv' ),
        'not_found_in_trash' => __( 'No posts found in Trash.', 'nabshow-lv' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-buddicons-topics',
        'supports'           => array(
            'title',
            'editor',
            'revisions',
            'trackbacks',
            'author',
            'excerpt',
            'page-attributes',
            'thumbnail',
            'custom-fields'
        ),
    );

    register_post_type( 'not-to-be-missed', $args );

}

/**
 * Create featured-category taxonomy for ntb-missed post type.
 *
 * @since 1.0
 */
function nabshow_lv_featured_category_taxonomies() {
	$labels = array(
		'name'              => _x( 'Category', 'taxonomy general name', 'nabshow-lv' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'nabshow-lv' ),
		'search_items'      => __( 'Search Categories', 'nabshow-lv' ),
		'all_items'         => __( 'All Categories', 'nabshow-lv' ),
		'parent_item'       => __( 'Parent Category', 'nabshow-lv' ),
		'parent_item_colon' => __( 'Parent Category:', 'nabshow-lv' ),
		'edit_item'         => __( 'Edit Category', 'nabshow-lv' ),
		'update_item'       => __( 'Update Category', 'nabshow-lv' ),
		'add_new_item'      => __( 'Add New Category', 'nabshow-lv' ),
		'new_item_name'     => __( 'New Genre Category', 'nabshow-lv' ),
		'menu_name'         => __( 'Categories', 'nabshow-lv' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'featured-category' ),
	);

	register_taxonomy( 'featured-category', array( 'not-to-be-missed' ), $args );

}

/**
 * Added the news releases post type
 * @since 1.0
 */

function nabshow_lv_register_news_releases_post_type() {

	$labels = array(
		'name'               => _x( 'News Releases', 'post type general name', 'nabshow-lv' ),
		'singular_name'      => _x( 'News Releases', 'post type singular name', 'nabshow-lv' ),
		'add_new_item'       => __( 'Add New', 'nabshow-lv' ),
		'edit_item'          => __( 'Edit', 'nabshow-lv' ),
		'new_item'           => __( 'New', 'nabshow-lv' ),
		'view_item'          => __( 'View', 'nabshow-lv' ),
		'search_items'       => __( 'Search', 'nabshow-lv' ),
		'not_found'          => __( 'No posts found.', 'nabshow-lv' ),
		'not_found_in_trash' => __( 'No posts found in Trash.', 'nabshow-lv' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-media-document',
		'supports'           => array(
			'title',
			'editor',
			'revisions',
			'trackbacks',
			'author',
			'excerpt',
			'page-attributes',
			'thumbnail',
			'custom-fields'
		),
	);

	register_post_type( 'news-releases', $args );

}

/**
 * Create news-category taxonomy for ntb-missed post type.
 * @since 1.0
 */
function nabshow_lv_register_news_releases_taxonomy() {
	$labels = array(
		'name'              => _x( 'Category', 'taxonomy general name', 'nabshow-lv' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'nabshow-lv' ),
		'search_items'      => __( 'Search Categories', 'nabshow-lv' ),
		'all_items'         => __( 'All Categories', 'nabshow-lv' ),
		'parent_item'       => __( 'Parent Category', 'nabshow-lv' ),
		'parent_item_colon' => __( 'Parent Category:', 'nabshow-lv' ),
		'edit_item'         => __( 'Edit Category', 'nabshow-lv' ),
		'update_item'       => __( 'Update Category', 'nabshow-lv' ),
		'add_new_item'      => __( 'Add New Category', 'nabshow-lv' ),
		'new_item_name'     => __( 'New Genre Category', 'nabshow-lv' ),
		'menu_name'         => __( 'Categories', 'nabshow-lv' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'news-category' ),
	);

	register_taxonomy( 'news-category', array( 'news-releases' ), $args );

}

/*
 * Added the Thought Gallery post type
 * @since 1.0
 */

function nabshow_lv_thought_gallery_archive() {

    $labels = array(
        'name'               => _x( 'Thought Gallery', 'post type general name', 'nabshow-lv' ),
        'singular_name'      => _x( 'Thought Gallery', 'post type singular name', 'nabshow-lv' ),
        'add_new_item'       => __( 'Add New', 'nabshow-lv' ),
        'all_items'         => __('All Thought Galleries', 'nabshow-lv'),
        'edit_item'          => __( 'Edit', 'nabshow-lv' ),
        'new_item'           => __( 'New', 'nabshow-lv' ),
        'view_item'          => __( 'View', 'nabshow-lv' ),
        'search_items'       => __( 'Search', 'nabshow-lv' ),
        'not_found'          => __( 'No posts found.', 'nabshow-lv' ),
        'not_found_in_trash' => __( 'No posts found in Trash.', 'nabshow-lv' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-format-gallery',
        'show_in_rest' => true,
        'supports'           => array(
            'title',
            'editor',
            'comments',
            'revisions',
            'trackbacks',
            'author',
            'excerpt',
            'page-attributes',
            'thumbnail',
            'custom-fields'
        ),
    );

    register_post_type( 'thought-gallery', $args );

}

/*
 * Create taxonomies featured tag.
 * @since 1.0
 */
function nabshow_lv_create_featured_tag_taxonomies(){
    // Add new taxonomy, NOT hierarchical (like tags)
    $labels = array(
        'name' => _x( 'Tags', 'taxonomy general name', 'nabshow-lv' ),
        'singular_name' => _x( 'Tag', 'taxonomy singular name', 'nabshow-lv' ),
        'search_items' =>  __( 'Search Tags', 'nabshow-lv' ),
        'popular_items' => __( 'Popular Tags', 'nabshow-lv' ),
        'all_items' => __( 'All Tags', 'nabshow-lv' ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __( 'Edit Tag', 'nabshow-lv' ),
        'update_item' => __( 'Update Tag', 'nabshow-lv' ),
        'add_new_item' => __( 'Add New Tag', 'nabshow-lv' ),
        'new_item_name' => __( 'New Tag Name', 'nabshow-lv' ),
        'separate_items_with_commas' => __( 'Separate tags with commas', 'nabshow-lv' ),
        'add_or_remove_items' => __( 'Add or remove tags', 'nabshow-lv' ),
        'choose_from_most_used' => __( 'Choose from the most used tags', 'nabshow-lv' ),
        'menu_name' => __( 'Tags', 'nabshow-lv' ),
    );

    register_taxonomy('featured-tag',array( 'not-to-be-missed' ),array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_in_rest' => true,
        'show_ui' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array( 'slug' => 'featured-tag' ),
    ));
}

/*
* Create thought-gallery-category taxonomy for thought-gallery post type.
*
* @since 1.0
*/
function nabshow_lv_thought_gallery_category_taxonomies() {
    $labels = array(
        'name'              => _x( 'Category', 'taxonomy general name', 'nabshow-lv' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', 'nabshow-lv' ),
        'search_items'      => __( 'Search Categories', 'nabshow-lv' ),
        'all_items'         => __( 'All Categories', 'nabshow-lv' ),
        'parent_item'       => __( 'Parent Category', 'nabshow-lv' ),
        'parent_item_colon' => __( 'Parent Category:', 'nabshow-lv' ),
        'edit_item'         => __( 'Edit Category', 'nabshow-lv' ),
        'update_item'       => __( 'Update Category', 'nabshow-lv' ),
        'add_new_item'      => __( 'Add New Category', 'nabshow-lv' ),
        'new_item_name'     => __( 'New Genre Category', 'nabshow-lv' ),
        'menu_name'         => __( 'Categories', 'nabshow-lv' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'thought-gallery-category' ),
    );

    register_taxonomy( 'thought-gallery-category', array( 'thought-gallery' ), $args );

}

/**
 * Create thought-gallery-category taxonomy for thought-gallery post type.
 *
 * @since 1.0
 */
function nabshow_lv_thought_gallery_tags_taxonomies() {
    $labels = array(
        'name'              => _x( 'Tags', 'taxonomy general name', 'nabshow-lv' ),
        'singular_name'     => _x( 'Tag', 'taxonomy singular name', 'nabshow-lv' ),
        'search_items'      => __( 'Search Tag', 'nabshow-lv' ),
        'all_items'         => __( 'All Tags', 'nabshow-lv' ),
        'parent_item'       => __( 'null', 'nabshow-lv' ),
        'parent_item_colon' => __( 'null', 'nabshow-lv' ),
        'edit_item'         => __( 'Edit Tag', 'nabshow-lv' ),
        'update_item'       => __( 'Update Tag', 'nabshow-lv' ),
        'add_new_item'      => __( 'Add New Tag', 'nabshow-lv' ),
        'new_item_name'     => __( 'New Tag', 'nabshow-lv' ),
        'menu_name'         => __( 'Tags', 'nabshow-lv' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'thought-gallery-tags' ),
    );

    register_taxonomy( 'thought-gallery-tags', array( 'thought-gallery' ), $args );

}

function nabshow_lv_page_category_taxonomy() {

    $labels = array(
        'name'              => _x( 'Category', 'taxonomy general name', 'nabshow-lv' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', 'nabshow-lv' ),
        'search_items'      => __( 'Search Categories', 'nabshow-lv' ),
        'all_items'         => __( 'All Categories', 'nabshow-lv' ),
        'parent_item'       => __( 'Parent Category', 'nabshow-lv' ),
        'parent_item_colon' => __( 'Parent Category:', 'nabshow-lv' ),
        'edit_item'         => __( 'Edit Category', 'nabshow-lv' ),
        'update_item'       => __( 'Update Category', 'nabshow-lv' ),
        'add_new_item'      => __( 'Add New Category', 'nabshow-lv' ),
        'new_item_name'     => __( 'New Genre Category', 'nabshow-lv' ),
        'menu_name'         => __( 'Categories', 'nabshow-lv' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'page-category' ),
    );

    register_taxonomy( 'page-category', array( 'page' ), $args );

}

/**
 * Added the custom ads post type
 *
 * @since 1.0
 */

function nabshow_lv_custom_ads() {

	$labels = array(
		'name'               => _x( 'Ads view', 'post type general name', 'nabshow-lv' ),
		'singular_name'      => _x( 'Ad View', 'post type singular name', 'nabshow-lv' ),
		'add_new_item'       => __( 'Add New', 'nabshow-lv' ),
		'edit_item'          => __( 'Edit', 'nabshow-lv' ),
		'new_item'           => __( 'New', 'nabshow-lv' ),
		'view_item'          => __( 'View', 'nabshow-lv' ),
		'search_items'       => __( 'Search', 'nabshow-lv' ),
		'not_found'          => __( 'No Ads found.', 'nabshow-lv' ),
		'not_found_in_trash' => __( 'No Ads found in Trash.', 'nabshow-lv' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => false,
		'show_in_menu'       => false,
		'show_in_rest'       => false,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array(
			'custom-fields',
			'title'
		),
	);

	register_post_type( 'nabshow-ads-view', $args );

}
