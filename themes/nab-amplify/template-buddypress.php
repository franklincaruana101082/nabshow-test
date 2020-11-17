<?php
/**
 * Template Name: Buddypress
 *
 * @package Amplify
 */

get_header();
?>

    <main id="primary" class="site-main buddy_press_php">

		<?php
		while ( have_posts() ) :
			the_post();
			?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nab-amplify' ),
							'after'  => '</div>',
						)
					);
					?>
                </div><!-- .entry-content -->

				<?php if ( get_edit_post_link() ) : ?>
                    <footer class="entry-footer">
						<?php
						edit_post_link(
							sprintf(
								wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Edit <span class="screen-reader-text">%s</span>', 'nab-amplify' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								wp_kses_post( get_the_title() )
							),
							'<span class="edit-link">',
							'</span>'
						);
						?>
                    </footer><!-- .entry-footer -->
				<?php endif; ?>
            </article><!-- #post-<?php the_ID(); ?> -->

			<?php

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

    </main><!-- #main -->

<?php
get_footer();
