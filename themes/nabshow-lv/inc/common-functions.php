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

	$tag_id     = array();
	$post_tags  = get_the_terms( $post_id, 'featured-tag' );

	if ( is_array( $post_tags ) ) {
		foreach ( $post_tags as $tag ) {
			$tag_id[] = $tag->term_id;
		}
	}

	if ( count( $tag_id ) > 0 ) {
		$args  = array(
			'post_type' => 'not-to-be-missed',
			'tax_query' => array(
				array(
					'taxonomy' => 'featured-tag',
					'field'    => 'term_id',
					'terms'    => $tag_id,
					'operator' => 'EXISTS',
				),
			),
		);

		$query = new WP_Query( $args );

	} else {
		$query = false;
	}

	return $query;

}

/**
 * Fetch the custom placeholder image when no featured image assigned to the post.
 * @since 1.0
 * @return string image url.
 */
function nabshow_lv_get_empty_thumbnail_url() {
	$nab_placeholder_image = get_template_directory_uri() . '/assets/images/nabshow-placeholder.jpg';

	return $nab_placeholder_image;
}

/**
 * Return the default placeholder image when speaker have not featured image.
 * @since 1.0
 * @return string image url.
 */
function nabshow_lv_get_speaker_thumbnail_url() {

    $speaker_placeholder_image = get_template_directory_uri() . '/assets/images/speaker-placeholder.png';

    return $speaker_placeholder_image;
}

/**
 * Get Not to be missed term list comma separated string
 * @param $post_id
 * @since 1.0
 * @return string
 */
function nabshow_lv_get_not_to_be_missed_post_term( $post_id ) {

	$all_categories_name = array();
	$categories          = get_the_terms( get_the_ID(), 'featured-category' );

	if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
		foreach ( $categories as $category ) {
			$all_categories_name[] = $category->name;
		}
	}

	$categories_string = implode( ', ', $all_categories_name );

	return $categories_string;
}