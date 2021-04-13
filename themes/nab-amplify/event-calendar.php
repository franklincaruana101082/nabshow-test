<?php
/*
 * Template Name: Event Calendar
 * Description: List upcoming events and sessions
*/
?>

<?php

wp_enqueue_script('nab-ouical', get_template_directory_uri().'/src/js/ouical.js', array(), '1.0', true);

get_header();

$post_type = array();

$hide_sessions = get_field('hide_all_sessions');
$session_categories = get_field('session_categories_to_list');

$hide_events = get_field('hide_all_events');
$event_categories = get_field('event_categories_to_list');

if(!$hide_events && !$hide_sessions) {
	$post_type = array('sessions', 'tribe_events');
	if($session_categories && $event_categories) {
	
		$tax_query = array(
			'relation' => 'OR',
				array(
				'taxonomy' => 'session_categories',
				'field' => 'term_id',
				'terms' => $session_categories,
				),
				array(
				'taxonomy' => 'tribe_events_cat',
				'field' => 'term_id',
				'terms' => $event_categories,
				),
			);
	} elseif(!$session_categories && $event_categories) {
	
		$tax_query = array(
			'relation' => 'OR',
				array(
				'taxonomy' => 'session_categories',
				'field' => 'term_id',
				'terms' => '*',
				),
				array(
				'taxonomy' => 'tribe_events_cat',
				'field' => 'term_id',
				'terms' => $event_categories,
				),
			);
	} elseif($session_categories && !$event_categories) {
	
		$tax_query = array(
			'relation' => 'OR',
				array(
				'taxonomy' => 'session_categories',
				'field' => 'term_id',
				'terms' => $session_categories,
				),
				array(
				'taxonomy' => 'tribe_events_cat',
				'field' => 'term_id',
				'terms' => '*',
				),
			);
	} elseif(!$session_categories && !$event_categories) {
	
		$tax_query = array(
			'relation' => 'OR',
				array(
				'taxonomy' => 'session_categories',
				'field' => 'term_id',
				'terms' => '*',
				),
				array(
				'taxonomy' => 'tribe_events_cat',
				'field' => 'term_id',
				'terms' => '*',
				),
			);
	}
} elseif ($hide_sessions) {
	$post_type = array('tribe_events');
	if($event_categories) {
		
		$tax_query = array(
				array(
				'taxonomy' => 'tribe_events_cat',
				'field' => 'term_id',
				'terms' => $event_categories,
				),
			);
	} else {
		$tax_query = array(
			array(
			'taxonomy' => 'tribe_events_cat',
			'field' => 'term_id',
			'terms' => '*',
			),
		);
	}
} elseif ($hide_events) {
	$post_type = array('sessions');
	if($session_categories) {
		
		$tax_query = array(
				array(
				'taxonomy' => 'session_categories',
				'field' => 'term_id',
				'terms' => $session_categories,
				),
			);
	} else {
		$tax_query = array(
				array(
				'taxonomy' => 'session_categories',
				'field' => 'term_id',
				'terms' => '*',
				),
			);
	}
}




$newTZ = wp_timezone();
$now = new DateTime(gmdate('Y-m-d H:i:s'));
$now->setTimezone($newTZ);
$date_now = $now->format('Y-m-d H:i:s');

$events = get_posts( array(
	'posts_per_page' => -1,
	'post_type' => $post_type,
	'tax_query' => $tax_query,
	'meta_query' => array(
		array(
			'key' => array('session_end_time', '_EventEndDateUTC'),
			'compare' => '>=',
			'value' => $date_now,
			'type' => 'DATETIME'
		),
	),
	'order' => 'ASC',
	'orderby' => 'meta_value',
	'meta_key' => array('session_date', '_EventStartDateUTC'),
	'meta_type' => 'DATETIME'
));

?>
<main id="primary" class="site-main event-calendar_php">
<header class="intro">
	<div class="container">
		<?php the_title( '<h1 class="intro__title">', '</h1>' ); ?>
		<div class="intro__copy introtext">
			<?php the_content(); ?>
		</div>
		<?php if(get_the_post_thumbnail_url(get_the_id())) { ?>
		<img class="intro__hero-image" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full'); ?>" />
		<?php } ?>
	</div>
</header><!-- .page-header -->

<?php if ($events) : 
//print_r($events);
	?>
<div class="container">

	<!-- events-list has the events and sticky nav -->
	<div class="events-list">

		<!-- the events-->
		<div class="events-list__events">

			<?php 
			$NewDateCheck = '';
			foreach ( $events as $post ) { 
				$EventStart = '';
				if(get_post_meta($post->ID, '_EventStartDate', true)) { $EventStart = get_post_meta($post->ID, '_EventStartDate', true);}
				if(get_field('session_date')) { $EventStart = get_field('session_date');}
				$EventStart = new DateTime($EventStart);
				$EventStartDay = $EventStart->format('Y-m-d');

				$EventEnd = '';
				if(get_post_meta($post->ID, '_EventEndDate', true)) { $EventEnd = get_post_meta($post->ID, '_EventEndDate', true);}
				if(get_field('session_end_time')) { $EventEnd = get_field('session_end_time');}
				$EventEnd = new DateTime($EventEnd);

				$company_id = 0;
				if(get_field('nab_selected_company_id')) { $company_id = get_field('nab_selected_company_id');}
				if(get_field('company')) {$company_id = get_field('company');}
				if($company_id){
					$company_name = get_the_title($company_id);
					$company_img = get_the_post_thumbnail_url($company_id, array(40,40));
				}
			?>
			<!-- event start -->
			<div class="events-list__event">
				<?php 
					if ($NewDateCheck != $EventStartDay) { 
						$NewDateCheck = $EventStartDay;
				?>
				<!-- first event in day shows date -->
				<a class="events-list__date" id="<?php echo $EventStart->format('F-d');?>">
					<div class="event__month"><?php echo $EventStart->format('F');?></div>
					<div class="event__day text-gradient _blue"><?php echo $EventStart->format('d');?></div>
				</a>
				<?php } ?>
				<div class="events-list__event__card">
					<div class="events-list__event__datetime event__time">
						<?php echo $EventStart->format('D d');?><br />
						<?php 
							if($EventStart->format('i') == '00') {
								echo $EventStart->format('gA');
							} else {
								echo $EventStart->format('g:iA');
							}
						?>
					</div>
					<div class="events-list__event__main">
						<a class="events-list__event-link" href="<?php echo get_the_permalink(); ?>"><?php the_title( '<h6 class="event__title events-list__event__title">', '</h6>' ); ?></a>
						<div class="introtext events-list__event__text">
							<?php echo wp_trim_words( get_the_content(null, false, $post->ID), 25); ?>
						</div>
						<?php if($company_id){ ?>
						<div class="event__host events-list__host">
							<div class="event__host-leadin events-list__host-leadin">
								<?php esc_html_e('Presented by', 'nab-amplify'); ?>
							</div>
							<?php if($company_img) { ?>
							<img class="event__host-photo events-list__host-photo" 
								 src="<?php echo($company_img);?>" 
								 alt="<?php esc_html_e('Logo for ', 'nab-amplify'); echo esc_html($company_name);?>">
							<?php } ?>
							<div class="event__host-name events-list__host-name"><?php echo esc_html($company_name);?></div>
						</div>
						<?php } ?>
						<!-- uses ouical.js to generate add-to-calendar -->
						<div 
						class="events-list__event__add"
						data-title="<?php the_title(); ?>"
						data-start="<?php echo $EventStart->format('F d, Y H:i'); ?>"
						data-end="<?php echo $EventEnd->format('F d, Y H:i'); ?>"
						data-address="The Internet"
						data-description="<?php echo wp_trim_words( get_the_content(null, false, $post->ID), 25).' '.get_the_permalink(); ?>"
						></div>
					</div>
				</div>
			</div>
			<!-- event end -->
			<?php } ?>


		</div>
		<!-- end list of events -->

		<!-- event nav -->
		<div class="events-list__nav">
			<div class="events-list__nav__wrapper">
				<h3>Jump to date</h3>
				<ul>
					<?php
					$NewDateJumpCheck = '';
					foreach ( $events as $post ) { 
						if(get_post_meta($post->ID, '_EventStartDate', true)) { $EventJumpStart = get_post_meta($post->ID, '_EventStartDate', true);}
						if(get_field('session_date')) { $EventJumpStart = get_field('session_date');}
						$EventJumpStart = new DateTime($EventJumpStart);
						$EventJumpStartDay = $EventJumpStart->format('Y-m-d');

							if ($NewDateJumpCheck != $EventJumpStartDay) { 
								$NewDateJumpCheck = $EventJumpStartDay;
					?>
					<li>
						<!-- first event in day shows date -->
						<a href="#<?php echo $EventJumpStart->format('F-d');?>">
							<?php echo $EventJumpStart->format('l, F j');?>
						</a>
					</li>
					<?php } } ?>
				</ul>
			</div>
		</div>
		<!-- end event nav-->

	</div>
	<!-- end wrapper of events and nav -->

</div>
<?php endif; ?>
<?php get_footer(); ?>