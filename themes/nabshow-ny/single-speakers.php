<?php
/**
 * The template for displaying all session.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package NABShow_NY
 */

get_header();
?>

	<div id="primary" class="container">
		<main id="main" class="site-main">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile; // End of the loop.
			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->	

<?php
get_footer();
