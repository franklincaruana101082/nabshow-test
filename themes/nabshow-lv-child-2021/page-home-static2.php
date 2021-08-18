<?php
/**
 * Template Name: Home Page Update
 * Description: Home page template design update
 *
 */


get_header();
?>

<main id="main" class="new">
  <div class="hero-banner">
    <?php the_field('banner_video_embed'); ?>
  </div>
  <div class="showinfo">
    <span class="showinfo__when"><?php the_field('banner_date'); ?></span> |
    <span class="showinfo__where"><?php the_field('banner_location'); ?></span>
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
      </div>
      <?php endwhile; ?>
    </div>
  </div>
<?php endif; 

  endwhile; // End of the loop.
endif;

?>


  <div class="container _pull-up">
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

  <div class="testimonials-wrapper">
    <div class="container">
      <div class="testimonials">
        <figure class="testimonial">
          <blockquote>The ability to meet with a large number of our current and potential customers is the reason we return to NAB Show year after year, and that opportunity was sorely missed in 2020.</blockquote>
          <figcaption>Ken Frommert, President, Enco Systems, Inc</figcaption>
        </figure>
        <figure class="testimonial">
          <blockquote>The AES is eagerly anticipating being face-to-face with our peers in-person in Las Vegas! Our colocation with NAB Show is the perfect time to reconnect as our industry regains its footing.</blockquote>
          <figcaption>Colleen Harper, Executive Director, AES</figcaption>
        </figure>
        <figure class="testimonial">
          <blockquote>I love discovering innovations from startups in Futures Park, finding new technology on the exhibit floor, and networking... I’m  energized just thinking about the chance to see everyone face-to-face again.</blockquote>
          <figcaption>Brett Jenkins, CTO, Nextar Media Group</figcaption>
        </figure>
      </div>
    </div>
  </div>


  <div class="section _bottom-only container">
    <?php dynamic_sidebar('broadstreet-home-leaderboard'); ?>
  </div>


  <div class="section _bottom">
    <div class="container">
      <div class="attending">
        <h3 class="attending-subtitle">Thousand of attendees, hundreds of exhibitors are ready</h3>
        <h2 class="h-xl attending-title">You’ll Be In Good Company</h2>
          <div class="attending-panel">
            <span class="attending-item">
              <b class="attending-item-name">ABC</b>
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
          </div>
          <!--
          <div class="attending-more">
            <a href="<?php echo site_url('/whos-attending/'); ?>" class="button _solid">View more</a>
          </div>
          -->
      </div>
    </div>
  </div>

  <div class="section _bottom exhibiting-section">
    <div class="container exhibiting-container">
      <div class="exhibiting">
        <h3 class="exhibiting-subtitle">Discover new tech and solutions</h3>
        <h2 class="h-xl exhibiting-title">Explore the hundreds of exhibiting companies</h2>
        <div class="logo-group _small exhibiting-logo-group">
          <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/exhibitor-sony.png" alt="SONY"/>
          <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/exhibitor-canon.png" alt="canon"/>
          <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/exhibitor-telestream.png" alt="telestream"/>
          <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/exhibitor-panasonic.png" alt="panasonic"/>
          <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/exhibitor-mediakind.png" alt="mediakind"/>
          <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/exhibitor-vizrt.png" alt="vizrt"/>
          <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/exhibitor-aws.png" alt="AWS"/>
          <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/exhibitor-aja.png" alt="AJA"/>
          <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/exhibitor-grassvalley.png" alt="grass valley"/>
          <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/exhibitor-chyron.png" alt="chyron"/>
          <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/exhibitor-ross.png" alt="ross"/>
        </div>
      </div>
    </div>
  </div>

  <div class="banner">
    <img src="https://nabshow.com/2021/wp-content/uploads/sites/4/2021/07/Homepage-wide-angle.jpg" alt="NAB Show: An unrivaled audio and video experience. Together with: Radio Show, SMTE, AES Show Fall 2021, and BEA." class="banner__image">
  </div>

  <div class="safety">
    <div class="container section">
      <h2 class="h-lg safety__title">THE SAFETY OF OUR COMMUNITY IS THE #1 PRIORITY</h2>
      <div class="safety__icons">
        <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/icon-sanitizer.png" alt="Sanitizer icon" />
        <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/icon-distancing.png" alt="Social distancing icon" />
        <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/icon-broom.png" alt="Broom icon" />
      </div>
      <div class="safety__copy">
        <p>Creating a healthy and safe environment for visitors to NAB Show remains a top priority. We are following all health and safety protocols as outlined by federal and local governments. As information continues to develop, we will adjust our approach as needed.</p>
      </div>

      <ul class="safety__stats">
        <li class="safety__stat">
          <div class="safety__statTitle">Optimism is on the rise</div>
          <div class="safety__statNumber">
            79<span class="safety__statPercent">%</span>
          </div>
          <div class="safety__statFollow">are highly likely to attend a live experience this year</div>
        </li>
        <li class="safety__stat">
          <div class="safety__statTitle">There’s nothing like face to face</div>
          <div class="safety__statNumber">
            87<span class="safety__statPercent">%</span>
          </div>
          <div class="safety__statFollow">find in-person events "irreplaceable"</div>
        </li>
        <li class="safety__stat">
          <div class="safety__statTitle">Excited about what's new</div>
          <div class="safety__statNumber">
            62 <span class="safety__statPercent">%</span>
          </div>
          <div class="safety__statFollow">prefer evaluating products at events</div>
        </li>
      </ul>
      <div class="safety__fineprint">*Based on NAB Show attendee survey data</div>
    </div>  
  </div>


<div class="container">
  <?php dynamic_sidebar('broadstreet-ros-bottom'); ?>
</div>

  <div class="decorative _lightlines-footer-corner _pulled"></div>
</main><!-- #main -->


<?php
get_footer();
