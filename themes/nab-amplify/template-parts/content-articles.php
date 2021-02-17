<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Amplify
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
		<?php
		the_title( '<h1 class="entry-title">', '</h1>' );
		echo do_shortcode( '[bookmark]' );
		?>
    </header><!-- .entry-header -->

    <div class="post-action-wrap">
		<div class="post-action-author">
			<?php echo do_shortcode( '[nab_display_author]' ); ?>
		</div>
		<div class="post-action-reaction">
			<?php echo do_shortcode( '[reaction_button]' ); ?>
		</div>
	</div>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'nab-amplify' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nab-amplify' ),
				'after'  => '</div>',
			)
		);
		?>		
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php nab_amplify_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
