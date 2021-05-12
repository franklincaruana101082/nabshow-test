<?php
/**
 * Template Name: Resource Page
 * Description: Resources pages
 *
 */


get_header();
?>

	<div id="primary" class="container">
		<main id="main" class="site-main">

		<?php
if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
