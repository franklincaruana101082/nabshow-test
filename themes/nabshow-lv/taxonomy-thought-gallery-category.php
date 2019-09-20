<?php
/**
 * The template for displaying archive page of Thought gallery categories.
 * @package NABShow_LV
 */

get_header();

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
                <div class="col-lg-9 col-md-12 col-sm-12 content-with-sidebar">
					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							get_template_part( 'template-parts/content', 'thought-gallery' );
						}
					} else {
						?>
                        <h4> No results found. </h4>";
						<?php
					}
					?>
                </div>
                <div id="sidebar" class="sidebar-wrap col-lg-3 col-md-12 col-sm-12">
		            <?php get_sidebar( 'thoughts-gallery' ); ?>
                </div>

            </div>
        </div>
    </div><!-- #primary -->
<?php get_footer(); ?>