<?php
/* Template Name: Custom Search - Thoughts gallery*/
get_header(); ?>
	<div id="internal-banner" class="wp-block-nab-multipurpose-gutenberg-block has-full is-block-center has-background-size has-background-opacity has-background-opacity-50" style="background-image:url(https://nabshow.com/ny2020/wp-content/uploads/sites/5/2020/05/homepage-hero.jpg);margin-top:-40px;margin-bottom:40px">
		<div class="wp-block-nab-multipurpose-gutenberg-block has-fixed is-block-center" style="padding-top:40px;padding-bottom:20px"></div>
	</div>
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
						echo "<h4 class='noresult'>" . esc_html( 'No search results found.' ) . "</h4>";
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