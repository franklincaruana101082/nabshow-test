<?php
/**
 * This file contains all custom post types and taxonomies functions.
 *
 * @package NABShow_LV
 */

/**
 * Added the not-to-be-missed-archive post type.
 *
 * @since 1.0.0
 */
function nabshow_lv_not_to_be_missed_archive() {

	$labels = array(
		'name'               => _x( 'Not-to-be-missed', 'post type general name', 'nabshow-lv' ),
		'singular_name'      => _x( 'Not-to-be-missed', 'post type singular name', 'nabshow-lv' ),
		'add_new_item'       => __( 'Add New', 'nabshow-lv' ),
		'edit_item'          => __( 'Edit', 'nabshow-lv' ),
		'new_item'           => __( 'New', 'nabshow-lv' ),
		'view_item'          => __( 'View', 'nabshow-lv' ),
		'search_items'       => __( 'Search', 'nabshow-lv' ),
		'not_found'          => __( 'No posts found.', 'nabshow-lv' ),
		'not_found_in_trash' => __( 'No posts found in Trash.', 'nabshow-lv' ),
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
			'custom-fields',
		),
	);

	register_post_type( 'not-to-be-missed', $args );

}

/**
 * Create featured-category taxonomy for ntb-missed post type.
 *
 * @since 1.0.0
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
		'public'            => false,
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
 * Added the news releases custom post type.
 *
 * @since 1.0.0
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
		'not_found_in_trash' => __( 'No posts found in Trash.', 'nabshow-lv' ),
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
			'custom-fields',
		),
	);

	register_post_type( 'news-releases', $args );

}

/**
 * Create news-category taxonomy for ntb-missed post type.
 *
 * @since 1.0.0
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
		'public'            => false,
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
 * Added the Thought Gallery custom post type.
 *
 * @since 1.0.0
 */

function nabshow_lv_thought_gallery_archive() {

	$labels = array(
		'name'               => _x( 'Thought Gallery', 'post type general name', 'nabshow-lv' ),
		'singular_name'      => _x( 'Thought Gallery', 'post type singular name', 'nabshow-lv' ),
		'add_new_item'       => __( 'Add New', 'nabshow-lv' ),
		'all_items'          => __( 'All Thought Galleries', 'nabshow-lv' ),
		'edit_item'          => __( 'Edit', 'nabshow-lv' ),
		'new_item'           => __( 'New', 'nabshow-lv' ),
		'view_item'          => __( 'View', 'nabshow-lv' ),
		'search_items'       => __( 'Search', 'nabshow-lv' ),
		'not_found'          => __( 'No posts found.', 'nabshow-lv' ),
		'not_found_in_trash' => __( 'No posts found in Trash.', 'nabshow-lv' ),
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
		'show_in_rest'       => true,
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
			'custom-fields',
		),
	);

	register_post_type( 'thought-gallery', $args );

}

/*
 * Create taxonomies featured tag.
 *
 * @since 1.0.0
 */
function nabshow_lv_create_featured_tag_taxonomies() {

	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Tags', 'taxonomy general name', 'nabshow-lv' ),
		'singular_name'              => _x( 'Tag', 'taxonomy singular name', 'nabshow-lv' ),
		'search_items'               => __( 'Search Tags', 'nabshow-lv' ),
		'popular_items'              => __( 'Popular Tags', 'nabshow-lv' ),
		'all_items'                  => __( 'All Tags', 'nabshow-lv' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Tag', 'nabshow-lv' ),
		'update_item'                => __( 'Update Tag', 'nabshow-lv' ),
		'add_new_item'               => __( 'Add New Tag', 'nabshow-lv' ),
		'new_item_name'              => __( 'New Tag Name', 'nabshow-lv' ),
		'separate_items_with_commas' => __( 'Separate tags with commas', 'nabshow-lv' ),
		'add_or_remove_items'        => __( 'Add or remove tags', 'nabshow-lv' ),
		'choose_from_most_used'      => __( 'Choose from the most used tags', 'nabshow-lv' ),
		'menu_name'                  => __( 'Tags', 'nabshow-lv' ),
	);

	register_taxonomy(
		'featured-tag',
		array( 'not-to-be-missed' ),
		array(
			'public'                => false,
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_in_rest'          => true,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'featured-tag' ),
		)
	);
}

/*
* Create thought-gallery-category taxonomy for thought-gallery post type.
*
* @since 1.0.0
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
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'thought-gallery-category' ),
	);

	register_taxonomy( 'thought-gallery-category', array( 'thought-gallery' ), $args );

}

/**
 * Create thought-gallery-category taxonomy for thought-gallery post type.
 *
 * @since 1.0.0
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
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'thought-gallery-tags' ),
	);

	register_taxonomy( 'thought-gallery-tags', array( 'thought-gallery' ), $args );

}

/**
 * Create category taxonomy for page post type.
 *
 * @since 1.0.0
 */
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
		'public'            => false,
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
 * Added the Mega Menu post type.
 *
 * @since 1.0.0
 */
function nabshow_lv_register_mega_menu_post_type() {

	$labels = array(
		'name'               => _x( 'Mega Menu', 'post type general name', 'nabshow-lv' ),
		'singular_name'      => _x( 'Mega Menu', 'post type singular name', 'nabshow-lv' ),
		'add_new_item'       => __( 'Add New', 'nabshow-lv' ),
		'edit_item'          => __( 'Edit', 'nabshow-lv' ),
		'new_item'           => __( 'New', 'nabshow-lv' ),
		'view_item'          => __( 'View', 'nabshow-lv' ),
		'search_items'       => __( 'Search', 'nabshow-lv' ),
		'not_found'          => __( 'No menu found.', 'nabshow-lv' ),
		'not_found_in_trash' => __( 'No menu found in Trash.', 'nabshow-lv' ),
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'publicly_queryable'  => false,
		'exclude_from_search' => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_rest'        => true,
		'query_var'           => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'has_archive'         => false,
		'hierarchical'        => false,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-menu',
		'supports'            => array(
			'title',
			'editor',
			'revisions',
			'author',
			'custom-fields',
		),
	);

	register_post_type( 'mega-menu', $args );
}

/**
 * Added the forms data post type and form type taxonomy
 *
 * @since 1.0.0
 */
function nabshow_lv_register_forms_data_post_type() {

	$labels = array(
		'name'               => _x( 'Forms Data', 'post type general name', 'nabshow-lv' ),
		'singular_name'      => _x( 'Forms Data', 'post type singular name', 'nabshow-lv' ),
		'add_new_item'       => __( 'Add New', 'nabshow-lv' ),
		'edit_item'          => __( 'Edit', 'nabshow-lv' ),
		'new_item'           => __( 'New', 'nabshow-lv' ),
		'view_item'          => __( 'View', 'nabshow-lv' ),
		'search_items'       => __( 'Search', 'nabshow-lv' ),
		'not_found'          => __( 'No menu found.', 'nabshow-lv' ),
		'not_found_in_trash' => __( 'No menu found in Trash.', 'nabshow-lv' ),
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'publicly_queryable'  => false,
		'exclude_from_search' => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_rest'        => false,
		'query_var'           => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'has_archive'         => false,
		'hierarchical'        => false,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-forms',
		'supports'            => array(
			'title',
			'author',
			'custom-fields',
		),
	);

	register_post_type( 'forms-data', $args );

	$labels = array(
		'name'          => _x( 'Category', 'taxonomy general name', 'nabshow-lv' ),
		'singular_name' => _x( 'Category', 'taxonomy singular name', 'nabshow-lv' ),
		'search_items'  => __( 'Search Categories', 'nabshow-lv' ),
		'all_items'     => __( 'All Categories', 'nabshow-lv' ),
		'edit_item'     => __( 'Edit Category', 'nabshow-lv' ),
		'update_item'   => __( 'Update Category', 'nabshow-lv' ),
		'add_new_item'  => __( 'Add New Category', 'nabshow-lv' ),
		'new_item_name' => __( 'New Genre Category', 'nabshow-lv' ),
		'menu_name'     => __( 'Categories', 'nabshow-lv' ),
	);

	$args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_in_rest'      => false,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'forms-category' ),
	);

	register_taxonomy( 'forms-category', array( 'forms-data' ), $args );
}

/**
 * Register landing page post type.
 */
function nabshow_lv_register_landing_page_post_type() {

	$labels = array(
		'name'                  => _x( 'Landing Pages', 'Post Type General Name', 'nabshow-lv' ),
		'singular_name'         => _x( 'Landing page', 'Post Type Singular Name', 'nabshow-lv' ),
		'menu_name'             => __( 'Landing Pages', 'nabshow-lv' ),
		'name_admin_bar'        => __( 'Landing Pages', 'nabshow-lv' ),
		'parent_item_colon'     => __( 'Parent Landing Page:', 'nabshow-lv' ),
		'all_items'             => __( 'All Landing Pages', 'nabshow-lv' ),
		'add_new_item'          => __( 'Add New Landing Page', 'nabshow-lv' ),
		'add_new'               => __( 'Add New', 'nabshow-lv' ),
		'new_item'              => __( 'New Landing Page', 'nabshow-lv' ),
		'edit_item'             => __( 'Edit Landing Page', 'nabshow-lv' ),
		'update_item'           => __( 'Update Landing Page', 'nabshow-lv' ),
		'view_item'             => __( 'View Landing Page', 'nabshow-lv' ),
		'view_items'            => __( 'View Landing Pages', 'nabshow-lv' ),
		'search_items'          => __( 'Search Landing Pages', 'nabshow-lv' ),
		'not_found'             => __( 'Not found', 'nabshow-lv' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'nabshow-lv' ),
		'featured_image'        => __( 'Featured Image', 'nabshow-lv' ),
		'set_featured_image'    => __( 'Set featured image', 'nabshow-lv' ),
		'remove_featured_image' => __( 'Remove featured image', 'nabshow-lv' ),
		'use_featured_image'    => __( 'Use as featured image', 'nabshow-lv' ),
		'insert_into_item'      => __( 'Insert into Landing Page', 'nabshow-lv' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'nabshow-lv' ),
		'items_list'            => __( 'Items list', 'nabshow-lv' ),
		'items_list_navigation' => __( 'Items list navigation', 'nabshow-lv' ),
		'filter_items_list'     => __( 'Filter items list', 'nabshow-lv' ),
	);
	$args   = array(
		'label'               => __( 'Landing Pages', 'nabshow-lv' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'author', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'post-formats', 'excerpt' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'menu_icon'           => 'dashicons-text-page',
		'show_in_rest'        => true,
	);
	register_post_type( 'landing-page', $args );
}

/**
 * Set preloaded resusable block in the landing page when create new page from the backend.
 */
function nabshow_lv_set_preloaded_block_in_new_landing_page() {

	global $pagenow;

	$current_post_type = filter_input( INPUT_GET, 'post_type', FILTER_SANITIZE_STRING );

	if ( 'post-new.php' === $pagenow && 'landing-page' === $current_post_type ) {

		$block_ids = array( 83974 );

		$query_args = array(
			'post_type' => 'wp_block',
			'fields'    => 'ids',
			'post__in'  => $block_ids,
			'orderby'   => 'post__in',
		);

		$block_query = new WP_Query( $query_args );

		if ( $block_query->have_posts() ) {

			$block_ids = $block_query->posts;

			if ( is_array( $block_ids ) && count( $block_ids ) > 0 ) {

				$block_template = array();

				foreach ( $block_ids as $block_id ) {
					$block_template[] = array( 'core/block', array( 'ref' => $block_id ) );
				}

				$article_object           = get_post_type_object( 'landing-page' );
				$article_object->template = $block_template;
			}
		}
	}
}

/*
 * Added the Resource Pages custom post type.
 *
 * @since 1.0.0
 */

function nabshow_lv_resource_page() {

	$labels = array(
		'name'               => _x( 'Resource Pages', 'post type general name', 'nabshow-lv' ),
		'singular_name'      => _x( 'Resource Page', 'post type singular name', 'nabshow-lv' ),
		'add_new_item'       => __( 'Add New', 'nabshow-lv' ),
		'all_items'          => __( 'All Resource Pages', 'nabshow-lv' ),
		'edit_item'          => __( 'Edit', 'nabshow-lv' ),
		'new_item'           => __( 'New', 'nabshow-lv' ),
		'view_item'          => __( 'View', 'nabshow-lv' ),
		'search_items'       => __( 'Search', 'nabshow-lv' ),
		'not_found'          => __( 'No pages found.', 'nabshow-lv' ),
		'not_found_in_trash' => __( 'No pages found in Trash.', 'nabshow-lv' ),
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
		'menu_icon'          => 'dashicons-edit-page',
		'show_in_rest'       => true,
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
			'custom-fields',
		),
	);

	register_post_type( 'resources', $args );

}

/**
 * Added the Schedule Pages custom post type.
 *
 * @since 1.0.0
 */

function nabshow_lv_schedule_page() {

	$labels = array(
		'name'               => _x( 'Schedule Pages', 'post type general name', 'nabshow-lv' ),
		'singular_name'      => _x( 'Schedule Page', 'post type singular name', 'nabshow-lv' ),
		'add_new_item'       => __( 'Add New', 'nabshow-lv' ),
		'all_items'          => __( 'All Schedule Pages', 'nabshow-lv' ),
		'edit_item'          => __( 'Edit', 'nabshow-lv' ),
		'new_item'           => __( 'New', 'nabshow-lv' ),
		'view_item'          => __( 'View', 'nabshow-lv' ),
		'search_items'       => __( 'Search', 'nabshow-lv' ),
		'not_found'          => __( 'No pages found.', 'nabshow-lv' ),
		'not_found_in_trash' => __( 'No pages found in Trash.', 'nabshow-lv' ),
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
		'menu_icon'          => 'dashicons-calendar',
		'show_in_rest'       => true,
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
			'custom-fields',
		),
	);

	register_post_type( 'schedule', $args );

}

/**
 * Added the Schedule Item custom post type.
 *
 * @since 1.0.0
 */
function nabshow_lv_schedule_item() {

	$labels = array(
		'name'               => __( 'Schedule Items', 'nabshow-lv' ),
		'singular_name'      => __( 'Schedule Item', 'nabshow-lv' ),
		'add_new'            => __( 'Add New', 'nabshow-lv' ),
		'add_new_item'       => __( 'Add New Schedule Item', 'nabshow-lv' ),
		'edit_item'          => __( 'Edit', 'nabshow-lv' ),
		'new_item'           => __( 'New Schedule Item', 'nabshow-lv' ),
		'all_items'          => __( 'All Schedule Items', 'nabshow-lv' ),
		'view_item'          => __( 'View Schedule Items', 'nabshow-lv' ),
		'search_items'       => __( 'Search Schedule Items', 'nabshow-lv' ),
		'not_found'          => __( 'No Schedule Items found', 'nabshow-lv' ),
		'not_found_in_trash' => __( 'No Schedule Items found in Trash', 'nabshow-lv' ),
		'parent_item_colon'  => __( '', 'nabshow-lv' ),
		'menu_name'          => __( 'Schedule Items', 'nabshow-lv' ),
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'taxonomies'          => array( 'tracks' ),
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'exclude_from_search' => true,
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
			'custom-fields',
		),
	);

	if ( 'nabshow-lv-child-2021' === get_option( 'stylesheet' ) ) {
		$args['publicly_queryable'] = true;
	}

	register_post_type( 'schedule-items', $args );
}


/**
 * Added the Schedule Table custom post type.
 *
 * @since 1.0.0
 */
function nabshow_lv_schedule_table() {

	$labels = array(
		'name'               => __( 'Schedule Tables', 'nabshow-lv' ),
		'singular_name'      => __( 'Schedule Table', 'nabshow-lv' ),
		'add_new'            => __( 'Add New', 'nabshow-lv' ),
		'add_new_item'       => __( 'Add New Schedule Table', 'nabshow-lv' ),
		'edit_item'          => __( 'Edit', 'nabshow-lv' ),
		'new_item'           => __( 'New Schedule Table', 'nabshow-lv' ),
		'all_items'          => __( 'All Schedule Tables', 'nabshow-lv' ),
		'view_item'          => __( 'View Schedule Tables', 'nabshow-lv' ),
		'search_items'       => __( 'Search Schedule Tables', 'nabshow-lv' ),
		'not_found'          => __( 'No Schedule Tables found', 'nabshow-lv' ),
		'not_found_in_trash' => __( 'No Schedule Tables found in Trash', 'nabshow-lv' ),
		'parent_item_colon'  => __( '', 'nabshow-lv' ),
		'menu_name'          => __( 'Schedule Tables', 'nabshow-lv' ),
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'taxonomies'          => array( 'tracks' ),
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'exclude_from_search' => true,
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
			'custom-fields',
		),
	);

	register_post_type( 'schedule-tables', $args );
}
