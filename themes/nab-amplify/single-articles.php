<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Amplify
 */

get_header();
?>

	<!-- START legacy-template: single-articles -->
	<main id="primary" class="site-main single_php">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			/*the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'nab-amplify' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'nab-amplify' ) . '</span> <span class="nav-title">%title</span>',
				)
			);*/

			

		endwhile; // End of the loop.
		?>
        <div class="nab-ad-block footer_ad">
            <broadstreet-zone zone-id="82836"></broadstreet-zone>
        </div>
        <?php /*echo do_shortcode('[rate_content]');*/ ?>
	</main><!-- #main -->
	<!-- END legacy-template -->
<?php
get_footer();
