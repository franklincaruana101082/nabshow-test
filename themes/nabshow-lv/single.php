<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package NABShow_LV
 */

get_header();
?>

	<div id="primary" class="container">
		<main id="main" class="site-main">

		<?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', get_post_type() );

            endwhile; // End of the loop.
        endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
