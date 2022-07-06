<?php
/**
 * Template Name: Pillar Page
 * Description: Pillars pages
 *
 */


get_header();
?>

	
<main id="main _pillar">

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();


			$flex_content_blocks = get_field('content_sections');
			$flex_content_settings = array(
				'blocks' => $flex_content_blocks
			);
			include ( locate_template( 'template-parts/part-flexibleContent.php', false, false ) );

        

		endwhile; // End of the loop.
	endif;
	?>

</main><!-- #main -->

<?php
get_footer();
