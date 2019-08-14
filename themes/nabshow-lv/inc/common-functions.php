<?php
/**
 * This file contains all common callback functions.
 *
 * @package NABShow_LV
 */

/**
 * Cross custom taxonomy related posts.
 *
 * @param $post_id
 *
 * @return \WP_Query
 */
function nabshow_lv_cross_tag_relation_posts( $post_id ) {

	$tag_id = array();

	$post_tags = get_the_terms( $post_id, 'portfolio-tag' );

	if ( is_array( $post_tags ) ) {
		foreach ( $post_tags as $tag ) {
			$tag_id[] = $tag->term_id;
		}
	}

	$args  = array(
		'post_type' => 'ntb-missed',
		'tax_query' => array(
			array(
				'taxonomy' => 'portfolio-tag',
				'field'    => 'term_id',
				'terms'    => $tag_id,
				'operator' => 'EXISTS',
			),
		),
	);
	$query = new WP_Query( $args );

	return $query;

}

/**
 * Fetch the custom placeholder image when no featured image assigned to the post.
 *
 * @since 1.0
 *
 * @return image url.
 */
function nabshow_lv_get_empty_thumbnail_url() {
	$nab_placeholder_image = get_template_directory_uri() . '/assets/images/nabshow-placeholder.jpg';

	return $nab_placeholder_image;
}