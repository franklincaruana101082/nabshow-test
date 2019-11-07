<?php
/**
 * This file contains all action hooks.
 *
 *
 * @package NABShow_LV
 */

add_action( 'after_setup_theme', 'nabshow_lv_setup' );

add_action( 'after_setup_theme', 'nabshow_lv_content_width', 0 );

add_action( 'widgets_init', 'nabshow_lv_widgets_init' );

add_action( 'wp_enqueue_scripts', 'nabshow_lv_scripts' );

//Action for add gutenberg custom block
add_action( 'enqueue_block_editor_assets', 'nabshow_lv_add_block_editor_assets' );

// action to add the not-to-be-missed-archive post type.
add_action( 'init', 'nabshow_lv_not_to_be_missed_archive', 1 );

// create featured category taxonomy.
add_action( 'init', 'nabshow_lv_featured_category_taxonomies', 0 );

//action to register dynamic slider block
add_action( 'init', 'nabshow_lv_register_dynamic_blocks' );

// Additional filter on listing page dropdown.
add_action( 'restrict_manage_posts', 'nabshow_lv_admin_posts_filter_restrict_manage_posts' );

/**
 * action to call after init to get all the post type and register another action for all post type.
 */
add_action( 'admin_init', function () {
	$post_types = get_post_types( array( 'public' => true ), 'names' );
	//print_r($post_types); exit();
	foreach ( $post_types as $post_type ) {
		if ( "wp_block" !== $post_type || "post" !== $post_type ) {
			nabshow_lv_register_action( $post_type );
		}
	}
} );

// function to register an action for individual post type.
function nabshow_lv_register_action( $post_type ) {

	add_action( 'manage_' . $post_type . '_posts_custom_column', 'nabshow_lv_custom_columns_data', 10, 2 );
}

/**
 * Action for Remove emoji
 */
add_action( 'get_header', 'nabshow_lv_remove_wp_emoji' );

/**
 * Action for Load JS in footer
 */
add_action( 'get_header', 'nabshow_lv_move_scripts_to_footer' );

// Action to add tag taxonomy in ntb-missed post type.
add_action( 'init', 'nabshow_lv_create_featured_tag_taxonomies', 0 );

// Action to add the thought-gallery-archive post type.
add_action( 'init', 'nabshow_lv_thought_gallery_archive' );

// Create thought gallery category taxonomy.
add_action( 'init', 'nabshow_lv_thought_gallery_category_taxonomies', 0 );

// Create thought gallery tags taxonomy.
add_action( 'init', 'nabshow_lv_thought_gallery_tags_taxonomies', 0 );

// Action to count post views of thought gallery for most popular posts.
add_action( 'wp_head', 'nabshow_lv_track_thought_gallery_views' );

// Action to get custom post types values in author template.
add_action('pre_get_posts', 'nabshow_lv_custom_type_to_author');

// Action to make posts hierarchical
add_action('registered_post_type', 'nabshow_lv_make_posts_hierarchical', 10, 2 );

// Action to enable excerpt in page
add_action('registered_post_type', 'nabshow_lv_enable_page_excerpt', 10, 2);

// Action to add taxonomy to page post type
add_action( 'init', 'nabshow_lv_page_category_taxonomy', 0 );

// Action to add the news releases post type
add_action( 'init', 'nabshow_lv_register_news_releases_post_type' );

// Action to add taxonomy to the news releases post type
add_action( 'init', 'nabshow_lv_register_news_releases_taxonomy', 0 );

//Action for register custom endpoints
add_action( 'rest_api_init', 'nabshow_lv_register_api_endpoints');