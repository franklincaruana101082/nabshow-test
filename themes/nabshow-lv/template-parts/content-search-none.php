<?php
/**
 * Template part for displaying a message that posts cannot be found in search
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NABShow_LV
 */

$search_post_type = filter_input( INPUT_GET, 'post_type', FILTER_SANITIZE_STRING );
$search_post_type = ! empty( $search_post_type ) ? $search_post_type : 'page';

$most_search_post = get_transient( 'nab-most-search-post-' . $search_post_type );

if ( false === $most_search_post ) {

    $most_search_post = new WP_Query(
		array(
			'post_type'      => $search_post_type,
			'posts_per_page' => 5,
			'meta_key'       => 'search_view_count',
			'orderby'        => 'meta_value_num',
			'order'          => 'DESC'
		)
	);

	if ( $most_search_post->have_posts() ) {
		set_transient( 'nab-most-search-post-' . $search_post_type, $most_search_post, 5 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
    }

}

?>
<div class="resultNotFound">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
                <h2>We’re sorry. We could not find any matches for your search term(s).</h2>

                <?php
                    if ( $most_search_post->have_posts() ) {
                    ?>
                        <p>Try revising your search above or view our most searched-for results:</p>
                        <ul>

                        <?php

                        while ( $most_search_post->have_posts() ) {

                            $most_search_post->the_post();
                        ?>
                            <li><?php nabshow_lv_get_search_result_post_link( $search_post_type, get_the_ID(), get_the_title() ); ?></li>
                        <?php

                        }
                        ?>

                        </ul>
                        <p>Still can’t find what you’re looking for? <a href="#">Contact NAB Show.</a></p>
                    <?php

                    } else {
                    ?>
                        <p>Try revising your search above or Still can’t find what you’re looking for? <a href="#">Contact NAB Show.</a></p>
                    <?php
                    }
                    wp_reset_postdata();
                ?>
			</div>
		</div>
	</div>
</div>
