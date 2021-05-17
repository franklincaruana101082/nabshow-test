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
		<h2 class="intro__title"><?php the_field('header_big_title');?></h2>
	</div>
</div>
<div class="decorative _lightlines-bottom-right">
	<div class="container">
		<div class="resource-intro">
			<div class="resource-intro-content">
				<div class="resource-intro-body">
				<?php if(the_field('header_body')): ?>
					<?php the_field('header_body') ?>
				<?php endif; ?>

				<?php
					$header_cta_text = get_field('header_cta_text');
					$header_cta_url = get_field('header_cta_url');
					if(!empty($header_cta_text) && !empty($header_cta_url)): ?>				
					<a href="<?php echo esc_url($header_cta_url); ?>" class="button _solid _cta"><?php echo $header_cta_text; ?></a>
				<?php endif; ?>
				</div>

				<?php
				$header_image = get_field('header_image'); 
				if(!empty($header_image)):
				?>
					<div class="resource-intro-image figure">
						<img src="<?php echo esc_url($header_image['url']); ?>" class="figure__media" alt="<?php echo esc_attr($header_image['alt']); ?>" />
					</div>
				<?php endif; ?>
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
				<h2 class="jump-links__label">Quick links:</h2>
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
	while( have_rows('opportunities') ): the_row(); 
		if ( get_sub_field('opportunities_title') || get_sub_field('opportunities_copy') || have_rows('opportunities_items') ) :
	?>
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
						<?php 
						$url = get_sub_field('opportunity_url'); 
						if( !empty($url)):
						?>
						<a href="<?php echo esc_url($url); ?>">
						<?php 
						endif;
						$img = get_sub_field('opportunity_image'); 
						if( !empty($img)):
						?>
						<img class="card__image" src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
						<?php endif; ?>
						<div class="card__body">
							<h3 class="card__title"><?php the_sub_field('opportunity_title'); ?></h3>
							<?php the_sub_field('opportunity_copy'); ?>
						</div>
						<?php if( !empty($url)): ?>
						</a>
						<?php endif; ?>

					</div>
					<?php endwhile; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
<?php endif; endwhile; endif; ?>

<?php /*if($post->post_content): ?>
	<div class="decorative _lightlines-bottom-right">
		<?php the_content(); ?>
	</div>
<?php endif;*/ ?>

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
					<li><a href="https://nabshow.com/2021/wp-content/uploads/sites/4/2021/05/21LV_Meet-the-Sales-Team.pdf" class="button _solid">Meet The Team</a></li>
					<li><a href="/exhibit/contact-a-sales-rep" class="button _solid">Explore More Details</a></li>
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
			<div class="amp-signup">
				<div class="amp-signup__content">
					<?php dynamic_sidebar('Sign Up'); ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<div class="decorative _lightlines-footer-corner"></div>