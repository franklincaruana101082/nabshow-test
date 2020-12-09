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

	<main id="primary" class="site-main single_php">
        <div class="nab-ad-block header_ad">
            <broadstreet-zone zone-id="82835"></broadstreet-zone>
        </div>
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

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
        <div class="nab-ad-block footer_ad">
            <broadstreet-zone zone-id="82836"></broadstreet-zone>
        </div>
	</main><!-- #main -->
<?php
get_footer();
