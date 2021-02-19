<?php
/**
 * The template for displaying company post.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Amplify
 */

get_header();
?>
	<!-- START legacy-template: single-company -->
	<div class="container">
	<main id="primary" class="site-main single_php">

		<?php
		while ( have_posts() ) :
			the_post();

			the_content();

		endwhile; // End of the loop.
        ?>
        
	</main><!-- #main -->
	</div><!-- .container -->
	<!-- END legacy-template -->
<?php
get_footer();
