<?php
/*
 * Template Name: Without Title
 */

get_header();
    ?>
	<!-- START legacy-template: template-without-title -->
	<div class="container">
	<main id="primary" class="site-main page_php">
		<?php
		while ( have_posts() ) :
            
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                    <?php
                    the_content();
                    ?>
                </div><!-- .entry-content -->
            </article>
            <?php
		endwhile; // End of the loop.
		?>
	</main><!-- #main -->
	</div><!-- .container -->
	<!-- END legacy-template -->
    <?php
get_footer();
