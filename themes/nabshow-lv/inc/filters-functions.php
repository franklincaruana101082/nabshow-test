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

    $categories =  array_merge(
            array(
                array(
                    'slug'  => 'nabshow',
                    'title' => __( 'NABShow Blocks', 'nabshow-lv' ),
                ),
            ),
            $categories
        );

	return $categories;
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

    $manage_columns = array();

    foreach( $columns as $key => $value ) {
        if ( 'title' === $key ) {
            $manage_columns['featured_image'] = 'Image';
            $manage_columns[$key] = $value;
            $manage_columns['featured_term'] = 'Featured Posts';
        }
        $manage_columns[$key] = $value;

    }

    return $manage_columns;
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

    return nabshow_lv_common_set_and_remove_as_featured_bulk_action_handler( $redirect_to, $doaction, $post_ids, 'exhibitor-keywords');
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
 * Set as featured not to be missed handler.
 *
 * @param $redirect_to
 * @param $doaction
 * @param $post_ids
 * @return string
 */
function nabshow_lv_set_and_remove_as_featured_bulk_not_to_be_missed_handler( $redirect_to, $doaction, $post_ids ) {

    return nabshow_lv_common_set_and_remove_as_featured_bulk_action_handler( $redirect_to, $doaction, $post_ids, 'featured-category');
}

/**
 * Set as featured thought gallery handler.
 *
 * @param $redirect_to
 * @param $doaction
 * @param $post_ids
 * @return string
 */
function nabshow_lv_set_and_remove_as_featured_bulk_thought_gallery_handler( $redirect_to, $doaction, $post_ids ) {

    return nabshow_lv_common_set_and_remove_as_featured_bulk_action_handler( $redirect_to, $doaction, $post_ids, 'thought-gallery-category');
}

/**
 * Set as featured sessions handler.
 *
 * @param $redirect_to
 * @param $doaction
 * @param $post_ids
 * @return string
 */
function nabshow_lv_set_and_remove_as_featured_bulk_sessions_handler( $redirect_to, $doaction, $post_ids ) {

    return nabshow_lv_common_set_and_remove_as_featured_bulk_action_handler( $redirect_to, $doaction, $post_ids, 'session-categories');
}

/**
 * Set as featured speakers handler.
 *
 * @param $redirect_to
 * @param $doaction
 * @param $post_ids
 * @return string
 */
function nabshow_lv_set_and_remove_as_featured_bulk_speakers_handler( $redirect_to, $doaction, $post_ids ) {

    return nabshow_lv_common_set_and_remove_as_featured_bulk_action_handler( $redirect_to, $doaction, $post_ids, 'speaker-categories');
}

/**
 * Set as featured sponsors handler.
 *
 * @param $redirect_to
 * @param $doaction
 * @param $post_ids
 * @return string
 */
function nabshow_lv_set_and_remove_as_featured_bulk_sponsors_handler( $redirect_to, $doaction, $post_ids ) {

    return nabshow_lv_common_set_and_remove_as_featured_bulk_action_handler( $redirect_to, $doaction, $post_ids, 'sponsor-categories');
}

/**
 * Common function for multiple post type to set as featured post.
 * @param $redirect_to
 * @param $doaction
 * @param $post_ids
 * @param $taxonomy
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

/**
 * Added start_with parameter in post where
 * @param $where
 * @param $query
 *
 * @return string
 */
function nabshow_lv_set_custom_posts_where( $where, $query ) {
	global $wpdb;

	$starts_with = $query->get( 'starts_with' );

	if ( $starts_with ) {
		$where .= " AND $wpdb->posts.post_title LIKE '$starts_with%'";
	}

	return $where;
}

/**
 * Generate yearly archive for thought gallery post type
 * @param $wp_rewrite
 * @return array
 */
function nabshow_lv_register_post_type_rewrite_rules( $wp_rewrite ) {

	$rules          = array();
	$post_type      = get_post_type_object( 'thought-gallery' );
	$slug_archive   = $post_type->has_archive;

	if ( $slug_archive === false ) {
		return $rules;
	}
	if ( $slug_archive === true ) {
		$slug_archive = $post_type->rewrite[ 'slug' ];
	}
	$rules[$slug_archive."/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$"] = 'index.php?post_type=thought-gallery&year=' . $wp_rewrite->preg_index(1) . '&monthnum=' . $wp_rewrite->preg_index(2) . '&day=' . $wp_rewrite->preg_index(3);
	$rules[$slug_archive."/([0-9]{4})/([0-9]{1,2})/?$"]              = 'index.php?post_type=thought-gallery&year=' . $wp_rewrite->preg_index(1) . '&monthnum=' . $wp_rewrite->preg_index(2);
	$rules[$slug_archive."/([0-9]{4})/?$"]                           = 'index.php?post_type=thought-gallery&year=' . $wp_rewrite->preg_index(1);
	$wp_rewrite->rules                                               = array_merge( $rules, $wp_rewrite->rules ); // merge existing rules with custom ones

	return $wp_rewrite;
}

/**
 * Set post type in search result page
 * @param $query
 * @return mixed
 */
function nabshow_lv_set_post_type_search_filter( $query ) {

	if ( $query->is_search && ! is_admin() ) {

		$search_post_type = filter_input( INPUT_GET, 'post_type', FILTER_SANITIZE_STRING );

		if ( isset( $search_post_type ) && ! empty( $search_post_type ) ) {
			$query->set( 'post_type', array( $search_post_type ) );
		}
	}

	return $query;
}

/**
 * Modified pagination page number link
 * @param $result
 * @return string
 */
function nabshow_lv_modified_pagenum_link( $result ) {

	if ( is_search() && ! is_admin() ) {
		$result = esc_url( remove_query_arg ('post_type', $result ) );
	}
	return $result;
}

/**
 * Generate custom search form
 * @param string $form Form HTML.
 * @return string Modified form HTML.
 */
function nabshow_lv_modified_search_form( $form ) {

	if ( is_search() && ! is_admin() ) {

		$search_post_type = filter_input( INPUT_GET, 'post_type', FILTER_SANITIZE_STRING );

        ob_start();

        ?>

        <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="search-form">
            <label for="search"><span class="screen-reader-text">Search for:</span></label>
            <input type="text" name="s" class="search-field" id="search" value="<?php the_search_query(); ?>" />

            <?php
            if ( isset( $search_post_type ) && ! empty( $search_post_type ) ) {
            ?>
                <input type="hidden" name="post_type" value="<?php echo esc_attr( $search_post_type ); ?>" />
            <?php
            }
            ?>

            <input type="submit" id="search-submit" value="Search" class="search-submit" />
        </form>

        <?php

        $form = ob_get_clean();
	}

	return $form;
}