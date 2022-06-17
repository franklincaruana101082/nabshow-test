<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NABShow_LV
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="section container generic">

		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nabshow-lv' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
<?php if(is_active_sidebar('broadstreet-ros-bottom')) { ?>
	<div class="container">
		<?php dynamic_sidebar('broadstreet-ros-bottom'); ?>
	</div>
<?php } ?>
<div class="decorative _lightlines-footer-corner"></div>