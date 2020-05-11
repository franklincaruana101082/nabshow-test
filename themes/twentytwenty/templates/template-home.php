<?php
/**
 * Template Name: Homepage Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */


get_header();
?>

<div class="ninetypercent">
<iframe src="http://static.frequency.com/nab-player/index.html?id=6646834083015971138" width="800" height=450" frameborder="no"></iframe>
</div>

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


<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
