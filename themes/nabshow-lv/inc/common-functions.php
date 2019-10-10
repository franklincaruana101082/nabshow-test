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

/**
 * Renders an HTML-serialized form of a block object
 * @param array $block The block being rendered.
 * @return string The HTML-serialized form of the block
 */
function nabshow_lv_serialize_block( $block ) {
	// Non-block content has no block name.
	if ( null === $block['blockName'] ) {
		return $block['innerHTML'];
	}
	$unwanted  = array( '--', '<', '>', '&', '\"' );
	$wanted    = array( '\u002d\u002d', '\u003c', '\u003e', '\u0026', '\u0022' );
	$name      = 0 === strpos( $block['blockName'], 'core/' ) ? substr( $block['blockName'], 5 ) : $block['blockName'];
	$has_attrs = ! empty( $block['attrs'] );
	$attrs     = $has_attrs ? str_replace( $unwanted, $wanted, wp_json_encode( $block['attrs'] ) ) : '';
	// Early abort for void blocks holding no content.
	if ( empty( $block['innerContent'] ) ) {
		return $has_attrs
			? "<!-- wp:{$name} {$attrs} /-->"
			: "<!-- wp:{$name} /-->";
	}
	$output            = $has_attrs
		? "<!-- wp:{$name} {$attrs} -->\n"
		: "<!-- wp:{$name} -->\n";
	$inner_block_index = 0;
	foreach ( $block['innerContent'] as $chunk ) {
		$output .= null === $chunk
			? nabshow_lv_serialize_block( $block['innerBlocks'][ $inner_block_index ++ ] )
			: $chunk;
		$output .= "\n";
	}
	$output .= "<!-- /wp:{$name} -->";

	return $output;
}

/**
 * Renders an HTML-serialized form of a list of block objects
 * @param array $blocks The list of parsed block objects.
 * @return string The HTML-serialized form of the list of blocks.
 */
function nabshow_lv_serialize_blocks( $blocks ) {
	return implode( "\n\n", array_map( 'nabshow_lv_serialize_block', $blocks ) );
}

/**
 * Search block using classname
 * @param $block
 * @return string
 */
function nabshow_lv_search_block( $block ) {
	if ( isset ( $block['attrs']['className'] ) ) {
		return $block['attrs']['className'] === 'related-content-with-block-main';
	}
}
/*
 * Alphabets list for browse pages
 */
function nabshow_lv_alphabets_list_filter() {
?>
    <ul class="alphabets-list">
        <li>A</li>
        <li>B</li>
        <li>C</li>
        <li>D</li>
        <li>E</li>
        <li>F</li>
        <li>G</li>
        <li>H</li>
        <li>I</li>
        <li>J</li>
        <li>K</li>
        <li>L</li>
        <li>M</li>
        <li>N</li>
        <li>O</li>
        <li>P</li>
        <li>Q</li>
        <li>R</li>
        <li>S</li>
        <li>T</li>
        <li>U</li>
        <li>V</li>
        <li>W</li>
        <li>X</li>
        <li>Y</li>
        <li>Z</li>
        <li class="clear">Clear</li>
    </ul>
<?php
}