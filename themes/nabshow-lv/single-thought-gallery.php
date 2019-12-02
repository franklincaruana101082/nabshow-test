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
            <div class="breadcrumbs-nospace">
                <?php
                    echo do_shortcode('[nab_yoast_breadcumb]');
                ?>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 content-with-sidebar">
					<?php
					while ( have_posts() ) {
						the_post();

						get_template_part( 'template-parts/content', 'thought-gallery-post' );


						?>
                        
					<?php } ?>
                </div>
                <div id="sidebar" class="sidebar-wrap col-lg-4 col-md-12 col-sm-12">
					<?php get_sidebar( 'thoughts-gallery' ); ?>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 related-post-main">
                    <div class="related-post-list">
                        <?php
                        get_template_part( 'template-parts/content', 'thought-gallery-related-post' );
                        ?>
                    </div>
                </div>
                <div class="nab-banner-main " style="text-align: center">
                    <div class="nab-banner-inner">
                        <p class="banner-text">Advertisement</p>
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/st-footer-banner.png' ); ?>" class="banner-img" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </div><!-- #primary -->
<?php
get_footer();