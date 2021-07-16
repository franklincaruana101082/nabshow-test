<?php
/**
 * Template Name: Home Page 
 * Description: Home page template for NAB Show
 *
 */
 

get_header();

$hero = get_field('banner_background_image');
$logo = get_field('banner_logo_image');
$cta1 = get_field('banner_main_cta');
$cta2 = get_field('banner_secondary_cta');
?>

<main id="main">
  <div class="hero" style="background-image: url(<?php echo esc_url($hero); ?>);">
    <div class="container">
      <div class="hero__inner" style="background-image: url(<?php echo esc_url($hero); ?>);">
        <div class="hero__content">
          <h1 class="hero__label"><?php the_field('banner_date'); ?></h1>
          <?php if (!empty($logo)):?>
          <img class="hero__logo" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
          <?php endif; ?>
          <ul class="hero__ctas">
            <?php if (!empty($cta1)):?>
            <li class="hero__cta">
              <a href="<?php echo esc_url( $cta1['url'] ); ?>" target="<?php echo esc_attr($cta1['target'] ? $cta1['target'] : '_self'); ?>" class="button _solid"><?php echo esc_html($cta1['title']);?></a>
            </li>
            <?php endif;
            if (!empty($cta2)):?>
            <li class="hero__cta">
              <a href="<?php echo esc_url( $cta2['url'] ); ?>" target="<?php echo esc_attr($cta2['target'] ? $cta2['target'] : '_self'); ?>" class="button _arrow _large"><?php echo esc_html($cta2['title']);?></a>
            </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>


  <?php 
  if( have_rows('quick_links_nav')):
  ?>
  <div class="container section">
    <div class="jump-links">
      <h2 class="jump-links__label">Quick Links:</h2>
      <ul class="jump-links__menu">
        <?php while( have_rows('quick_links_nav')) : the_row();
          $link = get_sub_field('link');
        ?>
        <li class="jump-links__item"><a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ? $link['target'] : '_self'); ?>" class="button _arrow _full"><?php echo esc_html($link['title']); ?></a></li>
        <?php endwhile; ?>
      </ul>
    </div>
  </div>
  <?php endif; ?>
  <div class="container section">
    <?php 
      the_content();
    ?>
  </div>

  <div class="container">
    <?php dynamic_sidebar('broadstreet-home-leaderboard'); ?>
  </div>

  <div class="section _bottom attending-section">
    <div class="container">
      <div class="attending">
        <h2 class="h-xl attending-title">Who’s Attending This Year</h2>
        <div class="attending-panels">
          <div class="attending-panel">
            <span class="attending-item">
              <b class="attending-item-name">ABC</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">Apple</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">CBS</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">Dallas Cowboys</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">Department of Defense</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">Discovery Channel</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">Disney Streaming Services</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">Dreamworks</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">Epic Games</b>
            </span>
          </div>
          <div class="attending-panel">            
            <span class="attending-item">
              <b class="attending-item-name">ESPN</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">Facebook</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">FIFA</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">Formula 1</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">Fox</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">Google</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">HULU</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">iHeartMedia</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">Jaguar Land Rover</b>
            </span>
          </div>
          <div class="attending-panel">
            <span class="attending-item">
              <b class="attending-item-name">Los Angeles Police Department</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">Lululemon</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">NBC</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">Netflix</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">Paramount Studios</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">ROKU</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">Spotify</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">Utah Jazz</b>
            </span>
            <span class="attending-item">
              <b class="attending-item-name">Youtube</b>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
    $midbanner = get_field('mid_page_wide_angle_image');
    if(!empty($midbanner)):
  ?>
  <div class="section _toplarge">
    <div class="banner">
      <img src="<?php echo esc_url($midbanner['url']); ?>" alt="<?php echo esc_attr($midbanner['alt']); ?>" class="banner__image" />
    </div>
  </div>
  <?php endif; ?>

<?php 
if ( have_posts() ) :
	while ( have_posts() ) : the_post();

	$schedule_page_id = get_field('schedule_page');
	if(have_rows('feature_timeline', $schedule_page_id)): ?>
	<div class="schedule">
		<div class="schedule__menu">
		<?php while (have_rows('feature_timeline', $schedule_page_id)): the_row(); 
			$day = new DateTime(get_sub_field('day', $schedule_page_id));
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
			<?php while (have_rows('feature_timeline', $schedule_page_id)): the_row(); 
				$bg_image = get_sub_field('timeline_feature_background_image', $schedule_page_id);
				$start_time = new DateTime(get_sub_field('start_time', $schedule_page_id));
				$end_time = new DateTime(get_sub_field('end_time', $schedule_page_id));
				$cta = get_sub_field('cta', $schedule_page_id);
				if(!empty($cta)):
					$cta_target = $cta['target'] ? $cta['target'] : '_self';
				endif;
			?>
			<div class="schedule__day">
				<div class="schedule__day-wrapper" style="background-image: url('<?php echo esc_url($bg_image['url']);?>');">
					<div class="container">
						<div class="schedule__day-content">
							<h3 class="schedule__day-time"><?php echo($start_time->format('g:iA').' - '.$end_time->format('g:iA')); ?></h3>
							<h4 class="schedule__day-title"><?php the_sub_field('timeline_feature_title', $schedule_page_id); ?></h4>
							<div class="schedule__day-body"><?php the_sub_field('timeline_feature_copy', $schedule_page_id); ?></div>
							<?php if($cta): ?>
							<div class="schedule__day-cta">
								<a href="<?php echo esc_url( $cta['url'] ); ?>" target="<?php echo esc_attr( $cta_target ); ?>" class="button _solid"><?php echo esc_html( $cta['title'] ); ?></a>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php if( have_rows('sessions_slider', $schedule_page_id) ) : ?>
				<div class="schedule__sessions">
					<?php while( have_rows('sessions_slider', $schedule_page_id) ): the_row(); 
						$session_id = get_sub_field('session', $schedule_page_id);
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
<?php endif; 

	endwhile; // End of the loop.
endif;

?>

<?php
  if( get_field('show_amplify_email_sign_up') ):
?>
  <div class="section _mnop decorative _lightlines-left-side">
    <div class="container">
      <div class="amplify">
        <div class="amplify__container">
          <div class="amplify__logo">
            <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/NAB_Amplify_logo.png" alt="Amplify" />
          </div>
          <div class="amplify__body">
            <h2 class="h-xl">ENTER YOUR EMAIL TO GET NAB CONTENT, NETWORKING AND DISCOVERY ALL YEAR ROUND.</h2>
          </div>
          <div class="amplify__form">
          	<form class="email-signup" id="mktoForm_1033"></form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif;

	$stories = get_field('stories');
  if( $stories ):
    while( have_rows('stories')): the_row();
    	if( have_rows('story_items')):
?>
  <div class="section container">
    <div class="section-heading">
      <h2 class="h-xl"><?php echo $stories['stories_title']; ?></h2>
    </div>

    <div class="stories">
      <?php 
        while( have_rows('story_items')): the_row();
          $image = get_sub_field('story_image');
          $link = get_sub_field('story_link');
      ?>
      <a class="story" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ? $link['target'] : '_self'); ?>">
        <div class="story__media">
          <figure class="figure">
            <div class="figure__media">
              <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            </div>              
          </figure>
        </div>
        <div class="story__body">
          <h4 class="story__title"><?php the_sub_field('story_title'); ?></h4>
          <p>
            <?php the_sub_field('story_teaser_copy'); ?>
          </p>
        </div>
      </a>
      <?php endwhile; ?>
    </div>
  </div>
  <?php
  		endif; 
    endwhile;
  endif;
  ?>
  <div class="container">
    <?php dynamic_sidebar('broadstreet-ros-bottom'); ?>
  </div>

  <div class="decorative _lightlines-footer-corner"></div>
</main><!-- #main -->


<?php
get_footer();
