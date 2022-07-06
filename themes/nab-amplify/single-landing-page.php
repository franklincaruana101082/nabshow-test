<?php
/**
 * The template for displaying landing pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Amplify
 */

if (get_field('remove_search_from_page_header')) {
	get_header('nosearch');	
} else {
	get_header();
}
$custom_class = get_field('custom_class');
?>

	<!-- START legacy-template: single -->
	<div class="container">
	<main id="primary" class="site-main single_php <?php echo esc_attr($custom_class); ?>">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );	

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
	</div><!-- .container -->
	<!-- END legacy-template -->

<?php
get_footer();
