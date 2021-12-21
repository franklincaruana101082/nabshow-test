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

<!-- Schedule Table Begins here -->
	<div class="section _bottom">
		<div class="section _bottom-only container">
			<?php dynamic_sidebar('broadstreet-internal-top'); ?>
		</div>
		<div class="decorative _blur _blur-middle">
			<div class="schedule-table-container">
				<div class="schedule-table">
					<div class="schedule-table-intro">
						<h2 class="h-xl"><?php echo esc_html( get_field( 'schedule_table_title' ) );?></h2>
					</div>
					<div class="schedule-table-table">
						<?php
						$featured_event			= get_field( 'featured_event' );
						$schedule_event_details = get_field( 'schedule_event_details' );
						?>
						<table>
							<caption><?php echo esc_html( get_field( 'schedule_table_caption' ) );?></caption>
							<thead>
								<?php
								if ( $featured_event && is_array( $featured_event ) ) {									
									?>
									<tr>
										<th scope="col" class="col-heading"><?php echo esc_html( $featured_event['title'] ); ?></th>
										<?php
										if ( is_array( $featured_event['featured_event_schedule'] ) && count( $featured_event['featured_event_schedule'] ) > 0 ) {
											
											foreach ( $featured_event['featured_event_schedule'] as $featured_event_date ) {

												if ( isset( $featured_event_date['event_date'] ) && ! empty( $featured_event_date['event_date'] ) ) {
													$featured_create_date	= date_create( $featured_event_date['event_date'] );													
													$date_day				= date_format( $featured_create_date, 'l' );
													$day_part1				= substr( $date_day, 0, 3 );
													$day_part2				= substr( $date_day, 2 );
													$final_date				= date_format( $featured_create_date, 'd' );
													?>
													<th scope="col" class="col-date"><?php echo esc_html( $day_part1 ); ?><span><?php echo esc_html( $day_part2 ); ?></span><b><?php echo esc_html( $final_date ); ?></b></th>
													<?php
												}
											}
										}
										?>										
									</tr>
									<?php
								}
								?>
							</thead>
							<?php
							if ( $schedule_event_details && is_array( $schedule_event_details ) ) {
								
								foreach ( $schedule_event_details as $schedule_detail ) {
									
									$link			= '#';
									$title_part1	= '';
									$title_part2	= '';
									$link_target	= '_self';

									if ( isset( $schedule_detail['link'] ) && is_array( $schedule_detail['link'] ) ) {
										
										$link			= $schedule_detail['link']['url'];
										$link_target	= ! empty( $schedule_detail['link']['target'] ) ? $schedule_detail['link']['target'] : $link_target;
										
										if ( ! empty( $schedule_detail['link']['title'] ) ) {

											$title_array	= explode( ' ', $schedule_detail['link']['title'] );
											$last_index		= count( $title_array ) - 1;
											
											if ( count( $title_array ) > 1 ) {
												$title_part2 = $title_array[ $last_index ];
												unset( $title_array[ $last_index ] );
												$title_part1 = implode( ' ', $title_array );
											} else {
												$title_part1 = $schedule_detail['link']['title'];
											}
										}										
									}
									?>
									<tr>
										<th scope="row" class="row-heading"><a href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $title_part1 ); ?> <b><?php echo esc_html( $title_part2 ); ?></b></a></th>
										<?php
										if ( isset( $schedule_detail['event_dates'] ) && is_array( $schedule_detail['event_dates'] ) ) {
											
											foreach ( $schedule_detail['event_dates'] as $current_event ) {
												
												if ( isset( $current_event['date'] ) && ! empty( $current_event['date'] ) )  {
													
													$schedule_create_date	= date_create( $current_event['date'] );
													$final_schedule_date	= date_format( $schedule_create_date, 'l, F d' );
													?>
													<td class="row-date"><span><?php echo esc_html( $final_schedule_date ); ?></span></td>
													<?php
												} else {
													?>
													<td class="row-date"></td>
													<?php
												}												
											}
										}										
										?>										
									</tr>
									<?php
								}								
							}
							?>							
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="section container">
			<?php dynamic_sidebar('broadstreet-ros-middle'); ?>
		</div>
	</div>
<!-- END Schedule Table -->

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
				<?php if( have_rows('sessions_slider') ) : ?>
				<div class="schedule__sessions">
					<?php while( have_rows('sessions_slider') ): the_row(); 
						$session_id = get_sub_field('session');
						$session = get_post($session_id);
						$session_meta = get_post_meta($session_id);
						if(array_key_exists('cta', $session_meta)):
							$session_cta = unserialize($session_meta['cta'][0]);
						endif;
						if(array_key_exists('logo', $session_meta)):
							$session_logo = get_post($session_meta['logo'][0]);
						endif;
						if(array_key_exists('start_time', $session_meta)):
							$session_start = new DateTime($session_meta['start_time'][0]);
						endif;
						if(array_key_exists('end_time', $session_meta)):
							$session_end = new DateTime($session_meta['end_time'][0]);
						endif;

						?>
					<div class="schedule__session">
						<?php if(!empty($session_cta)): ?>
						<a href="<?php echo esc_url($session_cta['url']); ?>" target="<?php echo($session_cta['target'] !== '' ? $session_cta['target'] : '_self' ); ?>" class="schedule__session-item">
						<?php else: ?>
						<div class="schedule__session-item">
						<?php endif; ?>
							<?php if($session_logo->guid):?>
							<img src="<?php echo esc_url($session_logo->guid); ?>" alt="<?php echo esc_attr($session_logo->post_name); ?>" />
							<?php endif; ?>
							<?php if(!empty($session_cta)): ?>
							<div class="schedule__session-item-content">
								<h5 class="schedule__session-item-title"><?php echo esc_html($session->post_title); ?></h5>
								<div class="schedule__session-item-body">
									<?php echo apply_filters( 'the_content', $session->post_content ); ?>
								</div>
								<h6 class="schedule__session-item-time"><?php echo($session_start->format('g:iA').' - '.$session_end->format('g:iA')); ?></h6>
								<?php if(!empty($session_cta)): ?>
								<div class="schedule__session-item-cta">
									<span class="button _solid _compact"><?php echo esc_html($session_cta['title']); ?></span>
								</div>
								<?php endif; ?>
							</div>
							<?php endif; ?>
						<?php if(empty($session_cta)): ?>
						</div>
						<?php else: ?>
						</a>
						<?php endif; ?>
					</div>
					<?php endwhile; ?>
				</div>
				<?php endif; ?>
			</div>
			<?php endwhile; ?>
		</div>
	</div>
<?php endif; ?>

<?php
	dynamic_sidebar('broadstreet-internal-top');
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

<div class="container">
	<?php dynamic_sidebar('broadstreet-ros-bottom'); ?>
</div>

<div class="decorative _lightlines-footer-strip"></div>