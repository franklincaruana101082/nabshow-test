<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Amplify
 */

$articleTypeClass = '';
if(has_category('video')) {
	$articleTypeClass = '_video';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
	    <header class="intro">
	    	
			<?php
			the_title( '<h1 class="intro__title entry-title">', '</h1>' );
			echo do_shortcode( '[bookmark]' );
			?>


			<div class="intro__reactions post-action-wrap">
				<div class="post-action-reaction">
					<?php echo do_shortcode( '[reaction_button]' ); ?>
				</div>
			</div>
	    </header><!-- .entry-header -->

	    
	</div>

	<div class="main _contentborder <?=$articleTypeClass;?>">
		<div class="container">
			<div class="post-action-author">
				<?php echo do_shortcode( '[nab_display_author]' ); ?>
			</div>
			<?php 
			if ( isset( $post->ID ) && ! empty( $post->ID ) && ! is_user_logged_in() ) {

				$content_accessible = get_post_meta( $post->ID, 'content_accessible', true);
				if ( $content_accessible ) {
					get_template_part( 'template-parts/not-signed-in' );
				}
			} else {
			?>
			<div class="content">
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
			</div>
		<?php } ?>
		</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php nab_amplify_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
