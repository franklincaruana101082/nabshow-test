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
 * Return comma separated term list from given terms array
 * @param array $terms
 * @param string $type
 * @return string
 * @since 1.0
 */
function nabshow_lv_get_comma_separated_term_list ( $terms = array(), $type = 'name' ) {

	$all_terms = array();

	if ( $terms && ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			$all_terms[] = $term->{$type};
		}
	}
	return implode( ' | ', $all_terms );
}

/**
 * Create drop-down options for terms
 * @param string $taxonomy
 * @since 1.0
 */
function nabshow_lv_get_term_list_options( $taxonomy = '' ) {

	if ( ! empty( $taxonomy ) ) {

		$all_terms = get_terms( array(
			'taxonomy' => $taxonomy,
			'hide_empty' => true,
		) );

		if ( is_array( $all_terms ) && ! is_wp_error( $all_terms ) ) {

			foreach ( $all_terms as $term ) {
			?>
                <option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></option>
			<?php
			}
		}
	}
}

/**
 * Limited content for Session, exhibitors and speakers modal popup
 * @param $post_id
 * @param string $planner_url
 * @return string
 */
function nabshow_lv_get_popup_content( $post_id, $planner_url = '' ) {
    if ( empty( $post_id ) ) {
        return '';
    }

	$strip_tag_text = wp_strip_all_tags( get_the_content( $post_id ) );
	$final_content  = mb_strimwidth( $strip_tag_text, 0, 253, '...<a href="' . $planner_url . '" target="_blank">Read More</a>' );
	$element_array  = array( 'a' => array( 'href' => array(), 'target' => array() ) );

	echo wp_kses( $final_content, $element_array );
}

/**
 * Get mys show code
 * @return string
 */
function nabshow_lv_get_mys_show_code() {
	$nab_mys_urls = get_option( 'nab_mys_urls' );
	$show_code    = isset( $nab_mys_urls['show_code'] ) ? $nab_mys_urls['show_code'] : '';
    return $show_code;
}