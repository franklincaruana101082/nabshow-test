<?php
/**
 * Template part for displaying not to be missed post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NABShow_LV
 */

    $featured_categories = get_the_terms( get_the_ID(), 'featured-category' );
    $categories_list     = nabshow_lv_get_pipe_separated_term_list( $featured_categories );
	?>
	<div class="cards item">
		<a href="<?php echo esc_url( get_the_permalink() ); ?>">
			<?php the_post_thumbnail(); ?>
			<div class="card-details">
				<h2 class="title"><?php the_title(); ?></h2>
				<span class="sub-category">- <?php echo esc_html( $categories_list ) ?></span>
			</div>
		</a>
	</div>