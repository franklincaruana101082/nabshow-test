<?php
/*
 * Template Name: Calendar Listing
 * Description: List events and sessions
*/
?>

<?php

get_header();

$post_type = array();

$newTZ = wp_timezone();
$now = new DateTime(gmdate('Y-m-d H:i:s'));
$now->setTimezone($newTZ);
$date_now = $now->format('Y-m-d H:i:s');


$upcoming_meta_query = array(
	'key' => array('session_end_time', '_EventEndDate'),
	'compare' => '>=',
	'value' => $date_now,
	'type' => 'DATETIME',
);
$past_meta_query = array(
	'key' => array('session_end_time', '_EventEndDate'),
	'compare' => '<',
	'value' => $date_now,
	'type' => 'DATETIME',
);
$all_meta_query = array(
	'key' => array('session_end_time', '_EventEndDate'),
	'compare' => 'EXISTS',
);

$query_amount = -1;


$timeframe = get_field('event_timeframe');
if($timeframe === 'upcoming') {
	$meta_query_build = $upcoming_meta_query;
	$query_order = 'ASC';
} else if($timeframe === 'past') {
	$meta_query_build = $past_meta_query;
	$query_order = 'DESC';
	$query_amount = 20;
} else {
	$meta_query_build = $all_meta_query;
	$query_order = 'DESC';
}

$meta_query = array(
	'relation' => 'AND',
);
$meta_query[] = $meta_query_build;


//$session_terms = get_terms( 'sessions' );

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
				//'field' => 'term_id',
				//'terms' => '*',
				'operator' => 'XXX'
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
				//'field' => 'term_id',
				//'terms' => '*',
				'operator' => 'XXX'
				),
			);
	} elseif(!$session_categories && !$event_categories) {
	
		$tax_query = array(
			'relation' => 'OR',
				array(
				'taxonomy' => 'session_categories',
				//'field' => 'term_id',
				//'terms' => '*',
				'operator' => 'XXX'
				),
				array(
				'taxonomy' => 'tribe_events_cat',
				//'field' => 'term_id',
				//'terms' => '*',
				'operator' => 'XXX'
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
			//'field' => 'term_id',
			//'terms' => '*',
			'operator' => 'XXX'
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
			//'field' => 'term_id',
			//'terms' => '*',
			'operator' => 'XXX'
			),
		);
	}
}
$events = false;
$upcomingevents = false;
$pastevents = false;
if($timeframe !== 'all') {
	$events = get_posts( array(
		'posts_per_page' => $query_amount,
		'post_type' => $post_type,
		'tax_query' => $tax_query,
		'meta_query' => $meta_query,
		'order' => $query_order,
		'orderby' => 'meta_value',
		'meta_key' => array('session_date', '_EventStartDate'),
		'meta_type' => 'DATETIME'
	));
} else {
	$upcomingevents = get_posts( array(
		'posts_per_page' => -1,
		'post_type' => $post_type,
		'tax_query' => $tax_query,
		'meta_query' => $upcoming_meta_query,
		'order' => 'ASC',
		'orderby' => 'meta_value',
		'meta_key' => array('session_date', '_EventStartDate'),
		'meta_type' => 'DATETIME'
	));
	$pastevents = get_posts( array(
		'posts_per_page' => 20,
		'post_type' => $post_type,
		'tax_query' => $tax_query,
		'meta_query' => $past_meta_query,
		'order' => 'DESC',
		'orderby' => 'meta_value',
		'meta_key' => array('session_date', '_EventStartDate'),
		'meta_type' => 'DATETIME'
	));
}

$NewDateCheck = '';
$NewMonthCheck = '';
$NewDateJumpCheck = '';

function displayEvents($post) {
	global $NewDateCheck;
	global $NewMonthCheck;
	$EventStart = '';
	if(get_post_meta($post->ID, '_EventStartDate', true)) { $EventStart = get_post_meta($post->ID, '_EventStartDate', true);}
	if(get_field('session_date')) { $EventStart = get_field('session_date');}
	if($EventStart != '') { //only display event if it has a start date
	$EventStart = new DateTime($EventStart);
	$EventStartDay = $EventStart->format('Y-m-d');
	$EventStartMonth = $EventStart->format('m-Y');

	$EventEnd = '';
	if(get_post_meta($post->ID, '_EventEndDate', true)) { $EventEnd = get_post_meta($post->ID, '_EventEndDate', true);}
	if(get_field('session_end_time')) { $EventEnd = get_field('session_end_time');}
	$EventEnd = new DateTime($EventEnd);

	$company_id = 0;
	$event_url = get_the_permalink($post->ID);
	if(get_field('nab_selected_company_id')) { 
		$company_id = get_field('nab_selected_company_id');
		$event_url = get_post_meta($post->ID, '_EventURL', true);
	}
	if(get_field('company')) {
		$company_id = get_field('company');
	}
	if($company_id){
		$company_name = get_the_title($company_id);
		$company_img = nab_amplify_get_featured_image( $company_id, false );
	}
?>
<!-- event start -->
<div class="events-list__event" data-newdatecheck="<?php echo $NewDateCheck; ?>" data-EventStartDay="<?php echo $EventStartDay; ?>">
	<?php 
		if ($NewDateCheck != $EventStartDay) { 
			$NewDateCheck = $EventStartDay;
	?>
	<!-- first event in day shows date -->
	<a class="events-list__date" data-newdatecheck="<?php echo $NewDateCheck; ?>" <?php if ($NewMonthCheck != $EventStartMonth) { $NewMonthCheck = $EventStartMonth; ?>id="<?php echo $EventStart->format('m-Y');?>"<?php } ?>>
		<div class="event__month"><?php echo $EventStart->format('F');?></div>
		<div class="event__day text-gradient _blue"><?php echo $EventStart->format('d');?></div>
		<div class="event__year"><?php echo $EventStart->format('Y');?></div>
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
			<a class="events-list__event-link" href="<?php echo esc_url($event_url); ?>"><?php the_title( '<h6 class="event__title events-list__event__title">', '</h6>' ); ?></a>
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
					 src="<?php echo esc_url($company_img);?>" 
					 alt="<?php esc_html_e('Logo for ', 'nab-amplify'); echo esc_html($company_name);?>">
				<?php } ?>
				<div class="event__host-name events-list__host-name"><?php echo esc_html($company_name);?></div>
			</div>
			<?php } ?>
			<a class="events-list__more" href="<?php echo esc_url($event_url); ?>">More Details</a>
		</div>
	</div>
</div>
<!-- event end -->
<?php
	}
}

function displayJumpLink($post) {
	global $NewDateJumpCheck;
	if(get_post_meta($post->ID, '_EventStartDate', true)) { 
		$EventJumpStart = get_post_meta($post->ID, '_EventStartDate', true);
	}
	if(get_field('session_date')) { 
		$EventJumpStart = get_field('session_date');
	}
	if ($EventJumpStart != '') { //only display link if event has a start date
	$EventJumpStart = new DateTime($EventJumpStart);
	$EventJumpStartMonth = $EventJumpStart->format('m-Y');
	$EventJumpStartDay = $EventJumpStart->format('Y-m-d');

		if ($NewDateJumpCheck != $EventJumpStartMonth) { 
			$NewDateJumpCheck = $EventJumpStartMonth;
?>
<li>
	<!-- first event in day shows date -->
	<a href="#<?php echo $EventJumpStart->format('m-Y');?>">
		<?php echo $EventJumpStart->format('F Y');?>
	</a>
</li>
<?php } }
}
?>
<main id="primary" class="site-main event-calendar_php">
<header class="intro">
	<div class="container">
		<?php the_title( '<h1 class="intro__title" data-swiftype-index="false">', '</h1>' ); ?>
		<div class="intro__copy introtext">
			<?php the_content(); ?>
		</div>
		<?php if(get_the_post_thumbnail_url(get_the_id())) { ?>
		<img class="intro__hero-image" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full'); ?>" />
		<?php } ?>
	</div>
</header><!-- .page-header -->

<?php if ($events || $upcomingevents || $pastevents) : ?>
<div class="container">

	<!-- events-list has the events and sticky nav -->
	<div class="events-list">

		<!-- the events-->
		<div class="events-list__events">

			<?php 
			if ($events) {
				foreach ( $events as $post ) { 
					displayEvents($post);
				} 
			}

			if ($upcomingevents) {
				?>
				<h2 class="events-list__title">Upcoming Events</h2>
				<?php
				foreach ( $upcomingevents as $post ) { 
					displayEvents($post);
				} 
			}

			if ($pastevents) {
				?>
				<h2 class="events-list__title">Past Events</h2>
				<?php
				foreach ( $pastevents as $post ) { 
					displayEvents($post);
				} 
			}
			?>


		</div>
		<!-- end list of events -->

		<!-- event nav -->
		<div class="events-list__nav">
			<div class="events-list__nav__wrapper">
				<h3>Jump to date</h3>
				<ul>
					<?php
					if ($events) {
						foreach ( $events as $post ) { 
							displayJumpLink($post);
						}
					}
					if ($upcomingevents) {
						foreach ( $upcomingevents as $post ) { 
							displayJumpLink($post);
						}
					}
					if ($pastevents) {
						foreach ( $pastevents as $post ) { 
							displayJumpLink($post);
						}
					}
					?>
				</ul>
			</div>
		</div>
		<!-- end event nav-->

	</div>
	<!-- end wrapper of events and nav -->

</div>
<?php endif; ?>
<?php get_footer(); ?>