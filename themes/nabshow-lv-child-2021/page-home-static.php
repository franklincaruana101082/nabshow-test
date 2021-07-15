<?php
/**
 * Template Name: Home Page (Static)
 * Description: Static Home page template to get up quickly
 *
 */


get_header();
?>

<main id="main">
  <div class="hero" style="background-image: url(/wp-content/themes/nabshow-lv-child-2021/assets/images/las-vegas-hero.jpg);">
    <div class="container">
      <div class="hero__inner" style="background-image: url(/wp-content/themes/nabshow-lv-child-2021/assets/images/las-vegas-hero.jpg);">
        <div class="hero__content">
          <h1 class="hero__label">October 9 - 13, 2021 | Las Vegas</h1>
          <img class="hero__logo" src="/wp-content/themes/nabshow-lv-child-2021/assets/images/NAB_Show_Logo_White.png" alt="NAB Show where content comes to life" />
          <ul class="hero__ctas">
            <li class="hero__cta">
              <a href="<?php echo esc_url( get_site_url(12, '/nab-show-sign-up/?r=maritz') ); ?>" target="_blank" class="button _solid">Register To Attend</a>
            </li>
            <li class="hero__cta">
              <a href="https://book.passkey.com/event/50152379/owner/81958/home" class="button _arrow _large">Book a Hotel</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="container section">
    <div class="jump-links">
      <h2 class="jump-links__label">Quick Links:</h2>
      <ul class="jump-links__menu">
        <li class="jump-links__item"><a href="<?php echo site_url('/attend/'); ?>" class="button _arrow _full">Attend</a></li>
        <li class="jump-links__item"><a href="<?php echo site_url('/resources-for/press/'); ?>" class="button _arrow _full">Press</a></li>
        <li class="jump-links__item"><a href="<?php echo site_url('/exhibit/'); ?>" class="button _arrow _full">Exhibit</a></li>
        <li class="jump-links__item"><a href="<?php echo site_url('/sponsor/'); ?>" class="button _arrow _full">Sponsor</a></li>
      </ul>
    </div>
  </div>

  <div class="container section">
    <div class="cols">
      <div class="col intro-body-text">
        <h2 class="h-lg">IT’S SO ON</h2>
        <p><strong>This October, the wait is over -- NAB Show returns to Las Vegas.</strong> No matter where you fall in the content ecosystem, this is where you’ll reconnect to the tools, technology and people who will empower you on your path. Take the first look at brand-new products and applications. Engage in compelling conversations with current and future partners. And immerse yourself in a show floor where innovative and future-ready solutions are waiting at every turn. If you’re involved with the business of storytelling, then you belong at NAB Show. 
        </p>
        <a href="<?php echo site_url('/attend/'); ?>" class="button _arrow _alt _full">Learn More About The Show</a>
      </div>
      <div class="col">
        <figure class="figure">
          <div class="figure__media">
            <div style="position: relative; display: block; max-width: 100%;"><div style="padding-top: 56.25%;"><iframe src="https://players.brightcove.net/1496514776001/S1IGg23j_default/index.html?videoId=6015758748001" allowfullscreen="" allow="encrypted-media" style="position: absolute; top: 0px; right: 0px; bottom: 0px; left: 0px; width: 100%; height: 100%;"></iframe></div></div>
          </div>
          <figcaption class="figure__caption">
            <p>See what you've been missing.</p>        
          </figcaption>
        </figure>
      </div>
    </div>
  </div>

  <div class="container">
    <?php dynamic_sidebar('broadstreet-home-leaderboard'); ?>
  </div>

  <!-- ATTENDING -->
  <div class="section container">
    <div class="attending">
      <h2 class="h-xl attending-title">Who’s Attending This Year</h2>
      <div class="attending-panels">
        <div class="attending-panel">
          <span class="attending-item">
            <b class="attending-item-name">Company Name Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">Company Name Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">Company Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">Company Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">Company Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">Company Name Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">Company Name Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">Company Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">Company Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">Company Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
        </div>
        <div class="attending-panel">
          <span class="attending-item">
            <b class="attending-item-name">Another Name Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">Another Name Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">Another Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">Another Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">Another Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">Another Name Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">Another Name Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">Another Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">Another Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">Another Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
        </div>
        <div class="attending-panel">
          <span class="attending-item">
            <b class="attending-item-name">One Name Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">One Name Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">One Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">One Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">One Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">One Name Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">One Name Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">One Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">One Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
          <span class="attending-item">
            <b class="attending-item-name">One Goes Here</b> <span class="attending-item-title">Person's Title Goes Here</span>
          </span>
        </div>
      </div>
    </div>
  </div>
  <!-- END ATTENDING -->

  <div class="section _toplarge">
    <div class="banner">
      <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/las-vegas-banner.jpg" class="banner__image" alt="alt-here" />
    </div>
  </div>


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
<div class="container">
  <?php dynamic_sidebar('broadstreet-ros-bottom'); ?>
</div>


<?php /*
  <div class="schedule">
    <div class="schedule__menu">
      <div class="schedule__menu-item"><span class="schedule__menu-item-day-short">TU</span><span class="schedule__menu-item-day">Tuesday</span><span class="schedule__menu-item-num">09</span></div>
      <div class="schedule__menu-item"><span class="schedule__menu-item-day-short">W</span><span class="schedule__menu-item-day">Wednesday</span><span class="schedule__menu-item-num">10</span></div>
      <div class="schedule__menu-item"><span class="schedule__menu-item-day-short">TH</span><span class="schedule__menu-item-day">Thursday</span><span class="schedule__menu-item-num">11</span></div>
      <div class="schedule__menu-item"><span class="schedule__menu-item-day-short">F</span><span class="schedule__menu-item-day">Friday</span><span class="schedule__menu-item-num">12</span></div>
      <div class="schedule__menu-item"><span class="schedule__menu-item-day-short">SA</span><span class="schedule__menu-item-day">Saturday</span><span class="schedule__menu-item-num">13</span></div>
    </div>
    <div class="schedule__days">
      <div class="schedule__day">
        <div class="schedule__day-wrapper" style="background-image: url(/wp-content/themes/nabshow-lv-child-2021/assets/images/schedule-background.jpg);">
          <div class="container">
            <div class="schedule__day-content">
              <h3 class="schedule__day-time">5:00PM - 6:30PM</h3>
              <h4 class="schedule__day-title">09 GET THE BIG PICTURE PLAN YOUR PERFECT SHOW</h4>
              <div class="schedule__day-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas, enim eu porta rutrum, nunc ligula sagittis dolor, at fringilla sem arcu quis neque. Sed sed aliquet arcu, sed accumsan libero. Aenean scelerisque magna vitae vulputate. </p>
              </div>
              <div class="schedule__day-cta">
                <a href="#" class="button _solid">View More</a>
              </div>
            </div>
          </div>          
        </div>
        <div class="schedule__sessions">
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
        </div>
      </div>
      <div class="schedule__day">
        <div class="schedule__day-wrapper" style="background-image: url(/wp-content/themes/nabshow-lv-child-2021/assets/images/schedule-background.jpg);">
          <div class="container">
            <div class="schedule__day-content">
              <h3 class="schedule__day-time">5:00PM - 6:30PM</h3>
              <h4 class="schedule__day-title">10 GET THE BIG PICTURE PLAN YOUR PERFECT SHOW</h4>
              <div class="schedule__day-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas, enim eu porta rutrum, nunc ligula sagittis dolor, at fringilla sem arcu quis neque. Sed sed aliquet arcu, sed accumsan libero. Aenean scelerisque magna vitae vulputate. </p>
              </div>
              <div class="schedule__day-cta">
                <a href="#" class="button _solid">View More</a>
              </div>
            </div>
          </div>
        </div>
        <div class="schedule__sessions">
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
        </div>
      </div>
      <div class="schedule__day">
        <div class="schedule__day-wrapper" style="background-image: url(/wp-content/themes/nabshow-lv-child-2021/assets/images/schedule-background.jpg);">
          <div class="container">
            <div class="schedule__day-content">
              <h3 class="schedule__day-time">5:00PM - 6:30PM</h3>
              <h4 class="schedule__day-title">11 GET THE BIG PICTURE PLAN YOUR PERFECT SHOW</h4>
              <div class="schedule__day-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas, enim eu porta rutrum, nunc ligula sagittis dolor, at fringilla sem arcu quis neque. Sed sed aliquet arcu, sed accumsan libero. Aenean scelerisque magna vitae vulputate. </p>
              </div>
              <div class="schedule__day-cta">
                <a href="#" class="button _solid">View More</a>
              </div>
            </div>
          </div>
        </div>
        <div class="schedule__sessions">
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
        </div>
      </div>
      <div class="schedule__day">
        <div class="schedule__day-wrapper" style="background-image: url(/wp-content/themes/nabshow-lv-child-2021/assets/images/schedule-background.jpg);">
          <div class="container">
            <div class="schedule__day-content">
              <h3 class="schedule__day-time">5:00PM - 6:30PM</h3>
              <h4 class="schedule__day-title">12 GET THE BIG PICTURE PLAN YOUR PERFECT SHOW</h4>
              <div class="schedule__day-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas, enim eu porta rutrum, nunc ligula sagittis dolor, at fringilla sem arcu quis neque. Sed sed aliquet arcu, sed accumsan libero. Aenean scelerisque magna vitae vulputate. </p>
              </div>
              <div class="schedule__day-cta">
                <a href="#" class="button _solid">View More</a>
              </div>
            </div>
          </div>
        </div>
        <div class="schedule__sessions">
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
        </div>
      </div>
      <div class="schedule__day">
        <div class="schedule__day-wrapper" style="background-image: url(/wp-content/themes/nabshow-lv-child-2021/assets/images/schedule-background.jpg);">
          <div class="container">
            <div class="schedule__day-content">
              <h3 class="schedule__day-time">5:00PM - 6:30PM</h3>
              <h4 class="schedule__day-title">13 GET THE BIG PICTURE PLAN YOUR PERFECT SHOW</h4>
              <div class="schedule__day-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas, enim eu porta rutrum, nunc ligula sagittis dolor, at fringilla sem arcu quis neque. Sed sed aliquet arcu, sed accumsan libero. Aenean scelerisque magna vitae vulputate. </p>
              </div>
              <div class="schedule__day-cta">
                <a href="#" class="button _solid">View More</a>
              </div>
            </div>
          </div>
        </div>
        <div class="schedule__sessions">
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
        </div>
      </div>
    </div>
  </div>
*/ ?>

<?php /*
<!--   <div class="section _mnop decorative _lightlines-left-side">
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
  </div> -->

<!--   <div class="section container">
    <div class="section-heading">
      <h2 class="h-xl">STORIES FROM AMPLIFY</h2>
    </div>
    <div class="stories">
      <a class="story" href="#">
        <div class="story__media">
          <figure class="figure">
            <div class="figure__media">
              <img src="https://www.fillmurray.com/482/271" alt="alt-here" />
            </div>              
          </figure>
        </div>
        <div class="story__body">
          <h4 class="story__title">The Unrailed event for content profressionals in media.</h4>
          <p>
            Ut egestas, enim eu porta rutrum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas, enim eu porta rutrum.
          </p>
        </div>
      </a>
      <a class="story" href="#">
        <div class="story__media">
          <figure class="figure">
            <div class="figure__media">
              <img src="https://www.fillmurray.com/482/271" alt="alt-here" />
            </div>              
          </figure>
        </div>
        <div class="story__body">
          <h4 class="story__title">The Unrailed event for content profressionals in media.</h4>
          <p>
            Ut egestas, enim eu porta rutrum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas, enim eu porta rutrum.
          </p>
        </div>
      </a>
      <a class="story" href="#">
        <div class="story__media">
          <figure class="figure">
            <div class="figure__media">
              <img src="https://www.fillmurray.com/482/271" alt="alt-here" />
            </div>              
          </figure>
        </div>
        <div class="story__body">
          <h4 class="story__title">The Unrailed event for content profressionals in media.</h4>
          <p>
            Ut egestas, enim eu porta rutrum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas, enim eu porta rutrum.
          </p>
        </div>
      </a>
      <a class="story" href="#">
        <div class="story__media">
          <figure class="figure">
            <div class="figure__media">
              <img src="https://www.fillmurray.com/482/271" alt="alt-here" />
            </div>              
          </figure>
        </div>
        <div class="story__body">
          <h4 class="story__title">The Unrailed event for content profressionals in media.</h4>
          <p>
            Ut egestas, enim eu porta rutrum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas, enim eu porta rutrum.
          </p>
        </div>
      </a>
    </div>
  </div> -->
*/ ?>
  <div class="decorative _lightlines-footer-corner"></div>
</main><!-- #main -->


<?php
get_footer();
