<?php
/**
 * Template Name: Thought Gallery Detail
 *
 * @package  NABShow_LV
 * */
get_header();
?>
    <div id="primary" class="container">
        <div class="page-main thought-gallery-page thought-gallery-detail-page">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12 content-with-sidebar">
					<?php
					while ( have_posts() ) {
						the_post();

						get_template_part( 'template-parts/content', 'thought-gallery-post' );


						?>
                        <div class="related-post-list">
							<?php
							get_template_part( 'template-parts/content', 'thought-gallery-related-post' );
							?>
                        </div>
					<?php } ?>
                </div>
                <div id="sidebar" class="sidebar-wrap col-lg-3 col-md-12 col-sm-12">
					<?php get_sidebar( 'thoughts-gallery' ); ?>
                </div>
            </div>


        </div>
    </div><!-- #primary -->
<?php
get_footer();