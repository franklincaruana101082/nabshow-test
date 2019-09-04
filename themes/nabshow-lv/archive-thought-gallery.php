<?php
/**
 * The archive template for thought gallery posts.
 * @package NABShow_LV
 */
get_header();
$total_posts = wp_count_posts( 'thought-gallery' )->publish;;
$posts_per_page = get_option( 'posts_per_page' );
global $wp_query;
?>
    <div id="primary" class="container">
        <div class="page-main thought-gallery-page">
            <div class="row">
				<?php
				if ( have_posts() ) {
					?>
                    <div class="thought-gallery-slider">
						<?php
						while ( have_posts() ) {
							the_post();
							get_template_part( 'template-parts/content', 'thought-gallery-item' );
						}
						wp_reset_postdata();
						?>
                    </div>
					<?php
				}
				?>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 content-with-sidebar">
                    <div class="" id="tg_wrapper">
						<?php
						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post();
								get_template_part( 'template-parts/content', 'thought-gallery' );
							}
							wp_reset_postdata();
						}
						?>
                    </div>
					<?php if ( $total_posts > $posts_per_page ) { ?>
                        <div class="loadMoreArticles text-center" id="load-more-tg">
                            <a href="javascript:void(0);" class="btn-default" data-page-number="2"
                               data-total-page="<?php echo absint( $wp_query->max_num_pages ); ?>">Load More</a>
                        </div>
					<?php } ?>
                </div>
                <div id="sidebar" class="sidebar-wrap col-lg-4 col-md-12 col-sm-12">
					<?php get_sidebar( 'thoughts-gallery' ); ?>
                </div>
            </div>


        </div>
    </div><!-- #primary -->
<?php
get_footer();
