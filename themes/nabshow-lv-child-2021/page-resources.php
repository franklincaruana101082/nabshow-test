<?php
/**
 * Template Name: Resource Page
 * Description: Resources pages
 *
 */


get_header();
?>

	
<main id="main">

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'resources' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
	endif;
	?>

</main><!-- #main -->

<?php
get_footer();
