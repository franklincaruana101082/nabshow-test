<?php
/* Template Name: Custom Search - Thoughts gallery*/
get_header(); ?>
    <div id="primary" class="container">
        <div class="page-main thought-gallery-page">
        	<?php 
				echo do_shortcode('[nab_yoast_breadcumb]');
			?>
            <h3>Search Result for : <?php echo esc_html( $s ); ?> </h3>
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12 content-with-sidebar">
					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							get_template_part( 'template-parts/content', 'thought-gallery' );
						}

					} else {
						echo "<h4>" . esc_html( 'No search results found.' ) . "</h4>";
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