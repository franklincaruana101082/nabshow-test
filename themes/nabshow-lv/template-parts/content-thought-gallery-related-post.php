<?php
/**
 * Template part for displaying thought gallery related listing.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NABShow_LV
 */

$tags_thought_galleries = get_the_terms( get_the_ID(), 'thought-gallery-tags' );

if ( empty( $tags_thought_galleries ) ) {
	return;
}

$tags_taxonomies = [];
$transient_key   = '';

if ( $tags_thought_galleries && ! is_wp_error( $tags_thought_galleries ) ) {

    foreach ( $tags_thought_galleries as $tags_thought_gallery ) {

        $tags_taxonomies[] = $tags_thought_gallery->slug;
		$transient_key     .= $tags_thought_gallery->slug . '-';
	}
}

$related_posts_query = get_transient( 'nab-thought-related-post-' . $transient_key );

if ( false === $related_posts_query ) {

    $related_posts_query = new WP_Query(
		array(
			'post_type'      => 'thought-gallery',
			'posts_per_page' => 5,
			'tax_query'      => array(
				array(
					'taxonomy' => 'thought-gallery-tags',
					'field'    => 'slug',
					'terms'    => $tags_taxonomies
				),
			),
		)
	);

	set_transient( 'nab-thought-related-post-' . $transient_key, $related_posts_query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
}
?>
<h2>You Might Also Like</h2>
<ul class="related-list">
	<?php
	if ( $related_posts_query->have_posts() ) {

	    $cnt        = 1;
	    $exclude_id = get_the_ID();
	    $is_exclude = true;

	    while ( $related_posts_query->have_posts() ) {

	        $related_posts_query->the_post();

	        if ( $is_exclude && ( $exclude_id === get_the_ID() || 4 === $cnt ) ) {

	            $is_exclude = false;
                continue;
            }
			?>
            <li>
                <div class="image-effect-wrapper">
                    <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="related-posts-img">
                        <img width="300" height="200" src="<?php echo has_post_thumbnail() ? esc_url( get_the_post_thumbnail_url() ) : esc_url( nabshow_lv_get_empty_thumbnail_url() ); ?>" alt="related-post-img">
                    </a>
                </div>
                <div class="related-content">
                    <h4 class="related-title">
                        <a href="<?php echo esc_url( get_the_permalink() ); ?>"> <?php echo esc_html( get_the_title() ); ?> </a>
                    </h4>
                    <div class="blog-list-contributor"> By <?php echo esc_html( get_the_author() ); ?></div>
                </div>
            </li>
            <?php

            $cnt++;
		}
	}
	?>
</ul>