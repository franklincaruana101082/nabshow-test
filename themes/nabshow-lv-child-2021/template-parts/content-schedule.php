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
	<div class="intro__body"><?php the_field('subtitle');?></div>
</div>

<?php if(have_rows('feature_timeline')): ?>
	<div class="schedule">
		<div class="schedule__menu">
		<?php while (have_rows('feature_timeline')): the_row(); 
			$day = new DateTime(get_sub_field('day'));
			$day_number = $day->format('d');
			$day_name = $day->format('l');
			if(substr($day_name, 0, 1) == 'T' || substr($day_name, 0, 1) == 'S') {
				$day_abbr = substr($day_name, 0,2);
			} else {
				$day_abbr = substr($day_name, 0,1);
			}
			?>
			<div class="schedule__menu-item">
				<span class="schedule__menu-item-day-short"><?php echo($day_abbr);?></span>
				<span class="schedule__menu-item-day"><?php echo($day_name); ?></span>
				<span class="schedule__menu-item-num"><?php echo($day_number); ?></span>
			</div>
			<?php endwhile; ?>
		</div>
	
		<div class="schedule__days">
			<?php while (have_rows('feature_timeline')): the_row(); 
				$bg_image = get_sub_field('timeline_feature_background_image');
				$start_time = new DateTime(get_sub_field('start_time'));
				$end_time = new DateTime(get_sub_field('end_time'));
				$cta = get_sub_field('cta');
				if(!empty($cta)):
					$cta_target = $cta['target'] ? $cta['target'] : '_self';
				endif;
			?>
			<div class="schedule__day">
				<div class="schedule__day-wrapper" style="background-image: url('<?php echo esc_url($bg_image['url']);?>');">
					<div class="container">
						<div class="schedule__day-content">
							<h3 class="schedule__day-time"><?php echo($start_time->format('g:iA').' - '.$end_time->format('g:iA')); ?></h3>
							<h4 class="schedule__day-title"><?php the_sub_field('timeline_feature_title'); ?></h4>
							<div class="schedule__day-body"><?php the_sub_field('timeline_feature_copy'); ?></div>
							<?php if($cta): ?>
							<div class="schedule__day-cta">
								<a href="<?php echo esc_url( $cta['url'] ); ?>" target="<?php echo esc_attr( $cta_target ); ?>" class="button _solid"><?php echo esc_html( $cta['title'] ); ?></a>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
	</div>
<?php endif; ?>

<?php
	$banner = get_field('banner_image');
	if(!empty($banner)): 
	?>
	<div class="section _toplarge">
		<div class="banner">
			<img src="<?php echo esc_url($banner['url']); ?>" alt="<?php echo esc_attr($banner['alt']); ?>" class="banner__image" />
		</div>
	</div>
<?php endif; ?>



<?php 
	$hide_sign_up = get_field('hide_sign_up');
	if (!$hide_sign_up): ?>
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

<div class="decorative _lightlines-footer-strip"></div>