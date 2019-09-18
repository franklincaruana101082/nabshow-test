<?php
/**
 * The template for displaying all single news release
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package NABShow_LV
 */

get_header();
?>

	<div id="primary" class="container">
		<main id="main" class="site-main">
			<div class="breadcrumbs-nospace">
			    <?php
					echo do_shortcode('[nab_yoast_breadcumb]');
			    ?>
			</div>
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
