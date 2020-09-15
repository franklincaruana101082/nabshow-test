<?php
/**
 * Template Name: Social Wall Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();
?>

<main id="site-content" role="main">

	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
		}
	}

	?>
	
	

</main><!-- #site-content -->

<div class="ninetypercent">
	<div id="flockler-embed-16ea97a3fb904adf4b2685901c2caa02"></div>
<script src="https://flockler.embed.codes/8KBeqL" async></script>
</div>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>