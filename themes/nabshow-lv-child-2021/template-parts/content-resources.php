<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NABShow_LV
 */

?>
<div class="intro _lightlines-strip">
	<div class="container intro__container">
		<?php
			the_title( '<h1 class="intro__label">', '</h1>' );
		?>
		<h2 class="intro__title"><?php the_field('big_title');?></h2>
	</div>
</div>
<div class="decorative _lightlines-bottom-right">
	<div class="container">
		<div class="resource-intro">
			<div class="resource-intro-content">
				<?php
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'nabshow-lv' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );		
				?>
			</div>

			<?php if(have_rows('stats')): ?>
			<div class="resource-intro-stats">
				<ul class="stats">
					<?php while(have_rows('stats')) : the_row(); ?>
								<li class="stat">
									<span class="stat__label"><?php the_sub_field('stat_title');?></span>
										<span class="stat__number"><?php the_sub_field('stat');?></span>
								</li>
								<?php endwhile; ?>
							</ul>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<?php if(have_rows('resource_links')) : ?>
	<div class="container">
			<div class="jump-links">
				<h2 class="jump-links__label">Resources For:</h2>
				<ul class="jump-links__menu">
					<?php while(have_rows('resource_links')): the_row(); ?>
					<li class="jump-links__item"><a href="<?php the_sub_field('link'); ?>" class="button _arrow _full"><?php the_sub_field('link_text'); ?></a></li>
					<?php endwhile; ?>
				</ul>
			</div>
		</div>
	<?php endif; ?>
</div>

<?php if(have_rows('opportunities')) : 
	while( have_rows('opportunities') ): the_row(); ?>
	<div class="section opportunities">
		<div class="container">
			<div class="intro-body-text">
				<h2 class="h-xl"><?php the_sub_field('opportunities_title'); ?></h2>
				<?php the_sub_field('opportunities_copy'); ?>
			</div>
			<?php if(have_rows('opportunities_items')) : ?>
			<div class="cards-wrapper">
				<div class="cards">
					<?php while(have_rows('opportunities_items')): the_row(); ?>
					<div class="card">
						<?php $img = get_sub_field('opportunity_image'); 
						if( !empty($img)):
						?>
						<img class="card__image" src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
						<?php endif; ?>
						<div class="card__body">
							<h3 class="card__title"><?php the_sub_field('opportunity_title'); ?></h3>
							<?php the_sub_field('opportunity_copy'); ?>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
<?php endwhile; endif; ?>

<?php if(have_rows('additional_sections')): 
		while (have_rows('additional_sections')): the_row();
		
			$hide_team = get_sub_field('hide_team_section');
			$hide_sign_up = get_sub_field('hide_sign_up_form');

		endwhile;
	endif;


?>
<?php if (!$hide_team): ?>
	<div class="container section _toplarge">
		<div class="feature">
			<?php dynamic_sidebar('Team'); ?>
			<div class="feature__cta">
				<ul class="button-group">
					<li><a href="#" class="button _solid">Meet The Team</a></li>
					<li><a href="#" class="button _solid">Explore More Details</a></li>
				</ul>
			</div>
		</div>
	</div>
<?php endif; /*?>

	<?php // TO DO set up broadstreet ads ?>
	<div class="ad _banner">
		<div class="container">
			<a href="#"><img src="assets/images/ad-banner.jpg" alt="advertisement alt text" /></a>
		</div>
	</div>

<?php */ if (!$hide_sign_up): ?>
	<div class="section">
		<div class="container">
			<div class="signup">
				<div class="signup__content">
					<?php dynamic_sidebar('Sign Up'); ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<div class="decorative _lightlines-footer-corner"></div>