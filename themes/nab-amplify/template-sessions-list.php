<?php
/*
 * Template Name: Sessions Listing
 * Description: List Sessions (optionally by category)
*/
?>

<?php

get_header();

//define page elements before we get into the sessions loop
$ad_shortcode = get_field('broadstreet_shortcode');

$categories = get_field('categories_to_list');

if($categories) {
	$tax_query = array(
	    'tax_query' => array(
			array(
			'taxonomy' => 'session_categories',
			'field' => 'term_id',
			'terms' => $categories,
			)
		),
    );
} else {
	$tax_query = array(
		'tax_query' => array(
			array(
			'taxonomy' => 'session_categories',
			'field' => 'term_id',
			'terms' => '*',
			)
		),
	);
}

$date_now = wp_date('Y-m-d H:i:s');

$sessions = get_posts( array(
    'posts_per_page' => -1,
    'post_type' => 'sessions',
	$tax_query,
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
<main id="primary" class="site-main sessions-list_php">
<header class="intro">
	<div class="container">
		<?php the_title( '<h1 class="intro__title">', '</h1>' ); ?>
		<div class="intro__copy introtext">
			<?php the_content(); ?>
		</div>
	</div>
</header><!-- .page-header -->
<div class="main">
	<div class="container">
<?php if ( $sessions ) : ?>


	<?php 
	$i = 0;
	$last_event = count($sessions);

	foreach ( $sessions as $post ) { 

		

		$session_status             = get_field( 'session_status' );
        $session_start              = get_field( 'session_date' );
        $session_end                = get_field( 'session_end_time' );

        $month						= wp_date('F', strtotime($session_start));
        $day						= wp_date('d', strtotime($session_start));
        $time_start					= wp_date('g:i', strtotime($session_start));
        $time_end					= wp_date('g:i A T', strtotime($session_end));
        $speakers = '';
		
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
								<div class="event__day number _blue"><?php echo esc_html($day); ?></div>
							</div>
							<div class="event__photo">
								<div class="event__link link _plus">Learn More</div>
								<!-- <img class="event__image" src="square-image" /> -->
							</div>
							<div class="event__info">
								<h4 class="event__title"><?php echo esc_html( get_the_title() ); ?></h4>
								<div class="event__time"><?php echo esc_html($time_start); ?> - <?php echo esc_html($time_end); ?></div>
								<div class="event__time"><?php echo esc_html($session_start); ?> - <?php echo esc_html($session_end); ?></div>
								<?php
								// list session speaker
								if ( ! empty( $speakers ) && is_array( $speakers ) && count( $speakers ) > 0 ) {
								?>
								<div class="event__host">
								<?php
								// only display 1st speaker.
									$first_name         = get_field( 'first_name', $speakers[0] );
									$last_name          = get_field( 'last_name', $speakers[0] );
									$title              = get_field( 'title', $speakers[0] );
									$speaker_company    = get_field( 'company', $speakers[0] );
									$headshot           = get_field( 'headshot', $speakers[0] );
									
									if ( ! empty( $headshot ) ) {
									?>
									<img class="event__host-photo" src="<?php echo esc_url( $headshot['url'] ); ?>" alt="<?php echo esc_attr( $headshot['alt'] ); ?>" />
									<?php	} ?>
									<div class="event__host-info">
										<div class="event__host-name"><?php echo esc_html( $first_name . ' ' . $last_name ); ?></div>
										<div class="event__host-title"><?php echo esc_html( $title ); ?></div>
										<div class="event__host-company"><?php echo esc_html( $speaker_company ); ?></div>
									</div>
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
				<?php echo do_shortcode($ad_shortcode); ?>
			<?php endif; ?>
		<?php endif; ?>
		<?php
		++$i;

	} //end foreach ?>

	

<?php else : ?>
	<h3>No Results</h3>
	<p>There are no upcoming sessions to show.</p>
	<?php //get_template_part( 'template-parts/content/content-none' ); ?>
<?php endif; ?>
	</div><!--.container -->
</div><!--.main-->
</main>
<?php //get_footer(); ?>
