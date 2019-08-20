<?php
/**
 * This file contains all filter functions.
 *
 *
 * @package NABShow_LV
 */

/**
 * Add description to top-level menu items.
 *
 * @param object $item Nav menu item.
 * @param int $depth Depth.
 * @param object $args Nav menu args.
 *
 * @return string Nav menu item start element.
 * Add a dropdown icon to top-level menu items
 */
function nabshow_lv_nav_description( $item_output, $item, $depth, $args ) {
	if ( ! empty( $item->description ) ) {
		$item_output = str_replace( $args->link_after . '</a>', '<p class="menu-item-description">' . $item->description . '</p>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}

/**
 * Register new category for custom block
 *
 * @param array $categories
 *
 * @return array
 */
function nabshow_lv_custom_block_category( $categories ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'nabshow',
				'title' => __( 'NAB Show', 'nabshow-lv' ),
			),
		)
	);
}

/**
 *
 * function call when the custom filter will get selected and
 * submit filter button.
 *
 * @param $query
 *
 * @return array $query
 * @since 1.0.0
 *
 * @global $pagenow string
 *
 */
function nabshow_lv_posts_filter( $query ) {
	global $pagenow;

	$additional_filter = filter_input( INPUT_GET, 'additional_filter', FILTER_SANITIZE_STRING );

	if ( is_admin() && 'edit.php' === $pagenow && isset( $additional_filter ) && $additional_filter !== '' ) {
		if ( 'post_title' === $additional_filter ) {
			add_filter( 'posts_search', 'nabshow_lv_search_by_title', 10, 2 );
		} elseif ( 'blank_featured_image' === $additional_filter ) {

			$query->query_vars['meta_key']     = '_thumbnail_id';
			$query->query_vars['meta_value']   = 'N/A';
			$query->query_vars['meta_compare'] = 'NOT EXISTS';

		}

	}

	return $query;
}

/**
 * Custom search the data by title.
 *
 * @param $search
 * @param $wp_query
 *
 * @return array|string
 * @since 1.0.0
 *
 */
function nabshow_lv_search_by_title( $search, $wp_query ) {

	if ( ! empty( $search ) && ! empty( $wp_query->query_vars['search_terms'] ) ) {
		global $wpdb;

		$q = $wp_query->query_vars;
		$n = ! empty( $q['exact'] ) ? '' : '%';

		$search = array();

		foreach ( ( array ) $q['search_terms'] as $term ) {
			$search[] = $wpdb->prepare( "$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like( $term ) . $n );
		}

		if ( ! is_user_logged_in() ) {
			$search[] = "$wpdb->posts.post_password = ''";
		}

		$search = ' AND ' . implode( ' AND ', $search );
	}

	return $search;
}

/**
 * Add new column of featured image in the post listing.
 *
 * @param $columns
 *
 * @return array
 * @since 1.0.0
 *
 */
function nabshow_lv_custom_columns( $columns ) {
	$columns = array(
		'cb'             => '<input type="checkbox" />',
		'featured_image' => 'Image',
		'title'          => 'Title',
		'categories'     => 'Categories',
		'featured_term'  => 'Featured Posts',
		'author'         => 'Author',
		'tags'           => 'Tags',
		'comments'       => '<span class="vers"><div title="Comments" class="comment-grey-bubble">Comment</div></span>',
		'date'           => 'Date'
	);

	return $columns;
}

/**
 * Add new columns image and featured post to page post type
 * @param $columns
 * @return array
 * @since 1.0.0
 *
 */
function nabshow_lv_page_custom_columns( $columns ) {
    $columns = array(
        'cb'             => '<input type="checkbox" />',
        'featured_image' => 'Image',
        'title'          => 'Title',
        'featured_term'  => 'Featured Posts',
        'author'         => 'Author',
        'comments'       => '<span class="vers"><div title="Comments" class="comment-grey-bubble">Comment</div></span>',
        'date'           => 'Date'
    );

    return $columns;
}

/**
 * Remove thumbnail dimensions.
 *
 * @param $html
 * @param $post_id
 * @param $post_image_id
 *
 * @return string
 */
function nabshow_lv_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );

	return $html;
}

/**
 * Adding set as featured as bulk action.
 *
 * @param $bulk_actions
 *
 * @return mixed
 */
function nabshow_lv_custom_bulk_actions( $bulk_actions ) {
	$bulk_actions['nabshow_set_as_featured']      = __( 'Set as Featured', 'nabshow-lv' );
	$bulk_actions['nabshow_remove_from_featured'] = __( 'Remove from Featured', 'nabshow-lv' );

	return $bulk_actions;
}

/**
 * Set as featured post handler.
 * @param $redirect_to
 * @param $doaction
 * @param $post_ids
 * @return string
 */
function nabshow_lv_set_and_remove_as_featured_bulk_post_handler( $redirect_to, $doaction, $post_ids ) {

    return nabshow_lv_common_set_and_remove_as_featured_bulk_action_handler( $redirect_to, $doaction, $post_ids, 'category');

}

/**
 * Set as featured exhibitors handler.
 *
 * @param $redirect_to
 * @param $doaction
 * @param $post_ids
 * @return string
 */
function nabshow_lv_set_and_remove_as_featured_bulk_exhibitors_handler( $redirect_to, $doaction, $post_ids ) {

    return nabshow_lv_common_set_and_remove_as_featured_bulk_action_handler( $redirect_to, $doaction, $post_ids, 'exhibitors-category');
}

/**
 * Set as featured page handler.
 *
 * @param $redirect_to
 * @param $doaction
 * @param $post_ids
 * @return string
 */
function nabshow_lv_set_and_remove_as_featured_bulk_page_handler( $redirect_to, $doaction, $post_ids ) {

    return nabshow_lv_common_set_and_remove_as_featured_bulk_action_handler( $redirect_to, $doaction, $post_ids, 'page-category');
}

/**
 * Common function for multiple post type to set as featured post.
 * @param $redirect_to
 * @param $doaction
 * @param $post_ids
 * @return string
 */
function nabshow_lv_common_set_and_remove_as_featured_bulk_action_handler( $redirect_to, $doaction, $post_ids, $taxonomy ) {

    if ( $doaction !== 'nabshow_set_as_featured' && $doaction !== 'nabshow_remove_from_featured' ) {

        return $redirect_to;
    }

    foreach ( $post_ids as $post_id ) {

        if ( $doaction === 'nabshow_set_as_featured' ) {
            wp_set_object_terms( $post_id, 'featured', $taxonomy, true );
        } elseif ( $doaction === 'nabshow_remove_from_featured' ) {
            wp_remove_object_terms( $post_id, 'featured', $taxonomy );
        }

    }

    return $redirect_to;
}


/**
 * Set custom excerpt length
 * @return int
 */
function nabshow_lv_custom_excerpt_length() {
	return 20;
}

/**
 * Set custom more string
 * @return string
 */
function nabshow_lv_custom_excerpt_more() {
	return '...';
}

/**
 * Append noscript tag and modified relation attribute
 *
 * @param $tag
 *
 * @return string
 */
function nabshow_lv_append_noscript_tag( $tag ) {

	$replace_tag = str_replace( "rel='stylesheet'", "rel='preload'", $tag );

	return '<noscript>' . $tag . '</noscript>' . str_replace( ' href', ' as="style" onload="this.onload=null;this.rel=\'stylesheet\'" href', $replace_tag );
}

/**
 * Remove wp version param from enqueued scripts
 *
 * @param $src
 *
 * @return string
 */
function nabshow_lv_remove_wp_ver_script( $src ) {
	if ( strpos( $src, 'ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}

	return $src;
}

/**
 * Custom search template define for thoughts gallery.
 *
 * @param array $template
 *
 * @return array
 */
function nabshow_lv_thought_gallery_search_template( $template ) {
	global $wp_query;
	$post_type = get_query_var( 'post_type' );
	if ( $wp_query->is_search && $post_type === 'thought-gallery' ) {
		return locate_template( 'archive-search.php' );
	}

	return $template;
}