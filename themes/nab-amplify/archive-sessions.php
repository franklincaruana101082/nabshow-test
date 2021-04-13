<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Amplify
 */

get_header();

$newTZ = wp_timezone();
$now = new DateTime(gmdate('Y-m-d H:i:s'));
$now->setTimezone($newTZ);
$date_now = $now->format('Y-m-d H:i:s');

$sessions = get_posts( array(
		'posts_per_page' => -1,
		'post_type' => 'sessions',
		'meta_query' => array(
				array(
						'key' => 'session_end_time',
						'compare' => '>=',
						'value' => $date_now,
						'type' => 'DATETIME'
				),
				array(
						'key' => 'session_status',
						'compare' => 'IN',
						'value' => 'live, pre-event'
				),
		),
		'order' => 'ASC',
		'orderby' => 'meta_value',
		'meta_key' => 'session_date',
		'meta_type' => 'DATETIME'
));


?>

<main id="primary" class="site-main archive-sessions_php">

		<?php if ( $sessions ) : ?>

	<header class="intro">
		<div class="container">
			<h1 class="intro__title">NAB Amplify Events</h1>
		</div>
	</header>
	<div class="main">
		<div class="container">
			<?php
				$i = 0;
				$last_event = count($sessions);
				foreach ( $sessions as $post ) {
								
					$company                    = get_field( 'company' );
					$session_status             = get_field( 'session_status' );
					$session_start              = get_field( 'session_date' );
					$session_end                = get_field( 'session_end_time' );

					$month                      = gmdate('F', strtotime($session_start));
					$day                        = gmdate('d', strtotime($session_start));
					$time_start                 = gmdate('g:i', strtotime($session_start));
					$time_end                   = gmdate('g:i A', strtotime($session_end));
								
				?>

				<?php 
				if($i === 0) : ?>
				<div class="nabcard">
					<div class="nabcard__content">
						<ul class="events__featured">
				<?php endif; ?>
				<?php 
				if($i === 3) : ?>
				<div class="nabcard">
					<div class="nabcard__content">
						<ul class="events__list">
				<?php endif; ?>
							<li>
								<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="event<?php if($i===0||$i===1||$i===2):?> _big<?php endif; ?>">
									<div class="event__date">
										<div class="event__month"><?php echo esc_html($month); ?></div>
										<div class="event__day text-gradient _blue"><?php echo esc_html($day); ?></div>
									</div>
									<div class="event__photo">
										<div class="event__link link _plus">Learn More</div>
										<!-- <img class="event__image" src="square-image" /> -->
									</div>
									<div class="event__info">
										<h4 class="event__title"><?php echo esc_html( get_the_title() ); ?></h4>
										<div class="event__time"><?php echo esc_html($time_start); ?> - <?php echo esc_html($time_end); ?> ET</div>
										<?php
										if ( ! empty( $company ) ) {
										?>
										<div class="event__host _company" data-company="<?php echo $company ?>">
											<img src="<?php nab_amplify_get_featured_image( $company_id, false ); ?>" class="event__host-photo" style="width: auto; height: auto;" />
											<div class="event__host-name">Hosted by <?php echo get_the_title($company);?></div>
										</div>
										<?php } ?>
									</div>
									<div class="event__link link _plus">Learn More</div>
								</a>
							</li>
				<?php 
				if($i == 2 || $i == $last_event - 1) : ?>
						</ul> <!--.events__featured -->
					</div> <!--.nabcard__content -->
				</div> <!--.nabcard -->
					<?php if ($i <= 2) : ?>
						<?php /* (INSERT AD)*/ ?>
					<?php endif; ?>
				<?php endif; ?>
				
				<?php
				++$i;
		}

		else :
			?>
			<div class="container">
			<?php
			get_template_part( 'template-parts/content', 'none' );
			?>
			</div>
			<?php

		endif;
		?>
		</div><!--.container -->
	</div><!--.main-->
</main>

<?php
get_footer();