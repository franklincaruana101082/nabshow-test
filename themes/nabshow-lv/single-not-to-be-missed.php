<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package NABShow_LV
 */

get_header();
?>
    <div class="not-to-be-missed-single">
        <div class="header-banner">
			<?php the_post_thumbnail(); ?>
            <div class="container">
            <?php
				echo do_shortcode('[nab_yoast_breadcumb]');

                $featured_categories = get_the_terms( get_the_ID(), 'featured-category' );
                $categories_list     = nabshow_lv_get_comma_separated_term_list( $featured_categories );
            ?>
                <div class="banner-details">
                    <h1><?php the_title(); ?></h1>
                    <span class="sub-category"><?php echo esc_html( $categories_list ); ?></span>
                </div>
            </div>
        </div>
        <div id="primary" class="container">
            <div class="page-main">
                <div class="row mb40">
                    <div class="col-lg-12">
                    <?php
					 if ( have_posts() ) {
                        while ( have_posts() ) {
                            the_post();
                            the_content();
                        }
                    }
					?>
                    </div>
                </div>

			    <?php

			    $current_post_ID = get_the_ID();
			    $cross_tag_query = nabshow_lv_cross_tag_relation_posts( $current_post_ID );
			    ?>

                <div class="row">

                    <?php
				    if ( $cross_tag_query && $cross_tag_query->have_posts() ) {
					    while ( $cross_tag_query->have_posts() ) {
						    $cross_tag_query->the_post();

						    $tag_post_id = get_the_ID();

						    if ( $tag_post_id === $current_post_ID ) {
							    continue;
						    }

						    ?>

                            <div class="col-lg-6">
                                <div class="cross-promo-box">
                                    <h2 class="title"><?php echo esc_html( get_the_title() ) ?></h2>
                                    <p><?php echo esc_html( get_the_excerpt() ); ?></p>
                                    <a href="<?php echo esc_url( get_the_permalink() ); ?>">Learn More</a>
                                </div>
                            </div>

						    <?php
					    }
					    wp_reset_postdata();
				    }
				    ?>
                </div>
            </div>
        </div><!-- #primary -->
    </div>
<?php
get_footer();