<?php
/**
 * Template part for displaying not to be missed post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NABShow_LV
 */

    $categories_string = nabshow_lv_get_not_to_be_missed_post_term( get_the_ID() );
	?>
	<div class="cards item">
		<a href="<?php echo esc_url( get_the_permalink() ); ?>">
			<?php the_post_thumbnail(); ?>
			<div class="card-details">
				<h2 class="title"><?php the_title(); ?></h2>
				<span class="sub-category">- <?php echo esc_html( $categories_string ) ?></span>
			</div>
		</a>
	</div>