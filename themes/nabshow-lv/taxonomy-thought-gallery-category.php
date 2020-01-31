<?php
/**
 * The template for displaying archive page of Thought gallery categories.
 * @package NABShow_LV
 */

get_header();

global $wp_query;

// get the currently queried taxonomy term, for use later in the template file
$_term = get_queried_object();
?>
    <div id="primary" class="container">
        <div class="page-main thought-gallery-page">
            <div class="breadcrumbs-nospace">
		        <?php
		        echo do_shortcode('[nab_yoast_breadcumb]');
		        ?>
            </div>
            <h3 class="mb30">Category: <?php echo esc_html( $_term->name ); ?></h3>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 content-with-sidebar">
	                <div class="" id="tg_wrapper">
						<?php
						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post();
								get_template_part( 'template-parts/content', 'thought-gallery' );
							}
						} else {
							?>
	                        <h4> Coming Soon. </h4>";
							<?php
						}
						?>
	                </div>
	                <?php
	                if ( $wp_query->max_num_pages > 1 ) {
		                ?>
		                <div class="loadMoreArticles text-center" id="load-more-tg">
			                <a href="javascript:void(0);" class="btn-default" data-category="<?php echo esc_attr( $_term->slug ); ?>" data-page-number="2" data-total-page="<?php echo absint( $wp_query->max_num_pages ); ?>">Load More</a>
		                </div>
		                <?php
	                }
	                ?>
                </div>
                <div id="sidebar" class="sidebar-wrap col-lg-4 col-md-12 col-sm-12">
		            <?php get_sidebar( 'thoughts-gallery' ); ?>
                </div>

            </div>
        </div>
    </div><!-- #primary -->
<?php get_footer(); ?>
