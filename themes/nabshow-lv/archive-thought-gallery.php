<?php
/**
 * The archive template for thought gallery posts.
 * @package NABShow_LV
 */
get_header();

global $wp_query;
?>
    <div id="primary" class="container">
        <div class="page-main thought-gallery-page">
            <div class="custom-head-with-title has-full">
                <div class="custom-is-block-center has-fixed">
                    <h1 class="title nab-title custom-title">Thought Gallery</h1>
                </div>
            </div>
        	 <div class="breadcrumbs-nospace">
	            <?php
	        		echo do_shortcode('[nab_yoast_breadcumb]');
	            ?>
	        </div>
	        <div class="thought-gallery-head">
	        	<div class="head-left">
	        		<p>A collection of high-level insights on topics, trends and technologies impacting the future of media and entertainment.</p>
	        	</div>
	        	<div class="head-right">
	        		<a class="btn-default" href="<?php echo esc_url( site_url() . '/thought-gallery/feed/' ); ?>">Subscribe</a>
	        	</div>
	        </div>
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
					<?php
                    if ( $wp_query->max_num_pages > 1 ) {
                        ?>
                        <div class="loadMoreArticles text-center" id="load-more-tg">
                            <a href="javascript:void(0);" class="btn-default" data-page-number="2" data-total-page="<?php echo absint( $wp_query->max_num_pages ); ?>">Load More</a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div id="sidebar" class="sidebar-wrap col-lg-4 col-md-12 col-sm-12">
					<?php get_sidebar( 'thoughts-gallery' ); ?>
                </div>
	            <?php
	            dynamic_sidebar( 'footer-advertisement-sidebar' );
	            ?>
            </div>
        </div>
    </div><!-- #primary -->
<?php
get_footer();
