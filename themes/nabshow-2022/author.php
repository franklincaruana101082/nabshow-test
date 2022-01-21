<?php
/**
 * Template part for displaying thought gallery author's posts listing.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NABShow_LV
 */
get_header();
$author_name =  get_query_var('author_name');
?>
    <div id="primary" class="container">
        <div class="page-main thought-gallery-page">
            <h1>Posts by : <?php echo esc_html( nabhsow_lv_current_author_name() ); ?> </h1>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 content-with-sidebar">
					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							get_template_part( 'template-parts/content', 'thought-gallery' );
						}

					} else {
						echo "<h4 class='noresult'>".esc_html('No results found.')."</h4>";
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
