<?php
/**
 * This file contains all filter hooks.
 *
 *
 * @package NABShow_LV
 */

add_filter( 'walker_nav_menu_start_el', 'nabshow_lv_nav_description', 10, 4 );

// Filter for register new categories for custom block
add_filter( 'block_categories', 'nabshow_lv_custom_block_category', 10, 2 );

add_filter( 'parse_query', 'nabshow_lv_posts_filter' );

add_filter( 'post_thumbnail_html', 'nabshow_lv_remove_thumbnail_dimensions', 10, 3 );

add_filter('admin_init', function () {

    $post_types = get_post_types( array( 'public' => true ), 'names' );

    foreach ( $post_types as $post_type ) {
        $post_type_function = str_replace( '-', '_', $post_type );
        if ( 'attachment' !== $post_type && function_exists( 'nabshow_lv_set_and_remove_as_featured_bulk_' . $post_type_function . '_handler' ) ) {
            add_filter( 'manage_' . $post_type . '_posts_columns', 'nabshow_lv_custom_columns' );
            add_filter( 'bulk_actions-edit-'.$post_type, 'nabshow_lv_custom_bulk_actions' );
            add_filter( 'handle_bulk_actions-edit-'.$post_type, 'nabshow_lv_set_and_remove_as_featured_bulk_' . $post_type_function . '_handler', 10, 3 );
        }
    }
    return true;
} );

add_filter( 'excerpt_length', 'nabshow_lv_custom_excerpt_length', 999 );

add_filter( 'excerpt_more', 'nabshow_lv_custom_excerpt_more' );


/*
 * Remove version parameter from the script and style
 */
add_filter( 'style_loader_src', 'nabshow_lv_remove_wp_ver_script', 9999 );

/**
 * Remove SRCSET from post images links.
 */
add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );

//Filter for custom search template for thoughts gallery post type.
add_filter( 'template_include', 'nabshow_lv_thought_gallery_search_template' );

// Enable default custom field meta box which is hide from ACF
add_filter('acf/settings/remove_wp_meta_box', '__return_false');