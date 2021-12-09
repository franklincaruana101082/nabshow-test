<?php
/**
 * Template Name: Home Page Update
 * Description: Home page template design update
 *
 */


get_header();

$hero = get_field('banner_background_image');
$video= get_field('banner_video_embed');
$logo = get_field('banner_logo_image');
$cta1 = get_field('banner_main_cta');
$cta2 = get_field('banner_secondary_cta');
//print_r($cta1);
?>

<main id="main" class="new">
  <div class="hero-banner" style="background-image: url('<?php echo esc_url($hero); ?>');">
    <div class="showinfo">
      <div class="showinfo__when"><?php the_field('banner_date'); ?> | <?php the_field('banner_location'); ?></div>
      <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" class="showinfo__logo" width="<?php echo( $logo['width'] ); ?>"height="<?php echo( $logo['height'] ); ?>" />
      <div class="showinfo__cta"><a href="<?php echo esc_url( $cta1['url'] ); ?>" class="button" target="<?php echo esc_attr( $cta1['target'] ); ?>"><?php echo( $cta1['title'] ); ?></a></div>

    </div>
    <?php //the_field('banner_video_embed'); ?>
  </div>
  
<?php
/*
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
*/

$quick_links          = get_field( 'quick_links' );
$testimonials         = get_field( 'testimonials' );
$attending_companies  = get_field( 'attending_companies' );
$exhibitor_companies  = get_field( 'exhibitor_companies' );
$display_safety       = get_field( 'display_safety' );

if ( is_array( $quick_links ) && count( $quick_links ) > 0 ) {
  ?>
  <div class="container">
    <div class="jump-links">
      <h2 class="jump-links__label">Resources For:</h2>
      <ul class="jump-links__menu">
        <?php
        foreach ( $quick_links as $link ) {

          $link_url     = $link['link']['url'];
          $link_title   = $link['link']['title'];
          $link_target  = isset( $link['link']['target'] ) && ! empty( $link['link']['target'] ) ? $link['link']['target'] : '_self';
          ?>
          <li class="jump-links__item"><a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="button _arrow _full"><?php echo esc_html( $link_title ); ?></a></li>
          <?php
        }
        ?>
      </ul>
    </div>
  </div>
  <?php
}
  $stories = get_field('stories');
  if( $stories ):
    while( have_rows('stories')): the_row();
      if( have_rows('story_items')):
?>
  <div class="section container">
    <div class="section-heading">
      <h4 class="stories__intro"><?php echo $stories['stories_title']; ?></h4>
    </div>

    <div class="stories">
      <?php 
        while( have_rows('story_items')): the_row();
          $image = get_sub_field('story_image');
          $link = get_sub_field('story_link');
      ?>
      <div class="story">
        <div class="story__media">
          <figure class="figure">
            <div class="figure__media">
              <a class="story__medialink" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ? $link['target'] : '_self'); ?>">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
              </a>
            </div>              
          </figure>
        </div>
      
        <div class="story__body">
          <h4 class="story__title"><?php the_sub_field('story_title'); ?></h4>
          <p>
            <?php the_sub_field('story_teaser_copy'); ?>
          </p>
          <a class="story__button button" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ? $link['target'] : '_self'); ?>"><?php echo $link['title']; ?></a>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
  <?php
      endif; 
    endwhile;
  endif;
  ?>


  <div class="section container">
    <?php dynamic_sidebar('broadstreet-home-leaderboard'); ?>
  </div>
<?php
/*
if ( is_array( $testimonials ) && count( $testimonials ) > 0 ) {
  ?>
  <div class="testimonials-wrapper">
    <div class="container">
      <div class="testimonials">
        <?php
        foreach ( $testimonials as $testimonial ) {
          $quote  = $testimonial['quote'];
          $source = $testimonial['source'];
          ?>
          <figure class="testimonial">
            <blockquote><?php echo esc_html( $quote ); ?></blockquote>
            <figcaption><?php echo esc_html( $source ); ?></figcaption>
          </figure>
          <?php
        }
        ?>
      </div>
    </div>
  </div>
  <?php
}*/
?>




<?php
if ( is_array( $attending_companies ) && count( $attending_companies ) > 0 ) {
  ?>
  <div class="section _bottom">
    <div class="container">
      <div class="attending">
        <h3 class="attending-subtitle">Thousands of attendees are ready</h3>
        <h2 class="h-xl attending-title">You’ll Be In Good Company</h2>
          <div class="attending-panel">
            <?php
            foreach ( $attending_companies as $company ) {

              if ( ! empty( $company['company'] ) ) {
                ?>
                <span class="attending-item">
                  <b class="attending-item-name"><?php echo esc_html( $company['company'] ); ?></b>
                </span>
                <?php
              }
            }
            ?>
          </div>
          <div class="attending-more">
            <a href="<?php echo site_url('/youll-be-in-good-company/'); ?>" class="button _solid">View more</a>
          </div>
      </div>
    </div>
  </div>
  <?php
}

if ( is_array( $exhibitor_companies ) && count( $exhibitor_companies ) > 0 ) {
  ?>
  <div class="section _bottom exhibiting-section">
    <div class="container exhibiting-container">
      <div class="exhibiting">
        <h3 class="exhibiting-subtitle">Discover new tech and solutions</h3>
        <h2 class="h-xl exhibiting-title">Explore the hundreds of exhibiting companies</h2>
        <div class="logo-group _small exhibiting-logo-group">
          <?php
          foreach ( $exhibitor_companies as $exhibitor_company ) {

            $logo_name  = $exhibitor_company['name'];
            $logo       = isset( $exhibitor_company['logo']['ID'] ) && ! empty( $exhibitor_company['logo']['ID'] ) ? wp_get_attachment_url( $exhibitor_company['logo']['ID'] ) : '';

            if ( ! empty( $logo_name ) && ! empty( $logo ) ) {
              ?>
              <img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( $logo_name ); ?>"/>
              <?php
            }
          }
          ?>
          <br><br><a href="https://nab21.mapyourshow.com/8_0/explore/exhibitor-gallery.cfm?featured=false&amp;_ga=2.63302376.616821258.1631544224-1534644711.1613326994" data-feathr-click-track="true" class="button _solid">View More</a>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

  <div class="banner">
    <img src="https://nabshow.com/2021/wp-content/uploads/sites/4/2021/07/Homepage-wide-angle.jpg" alt="NAB Show: An unrivaled audio and video experience. Together with: Radio Show, SMTE, AES Show Fall 2021, and BEA." class="banner__image">
  </div>

<?php
  if ( $display_safety ) {

    $safety_title       = get_field( 'safety_title' );
    $safety_icons       = get_field( 'safety_icons' );
    $safety_copy        = get_field( 'safety_copy' );
    $safety_stats       = get_field( 'safety_stats' );
    $safety_fine_print  = get_field( 'safety_fine_print' );

    ?>
    <div class="safety">
      <div class="container section">
        <?php
        if ( ! empty( $safety_title ) ) {
          ?>
          <h2 class="h-lg safety__title"><?php echo esc_html( $safety_title ); ?></h2>
          <?php
        }

        if ( is_array( $safety_icons ) && count( $safety_icons ) > 0 ) {
          ?>
          <div class="safety__icons">
            <?php
            foreach ( $safety_icons as $icon ) {

              $alt  = isset( $icon['icon']['alt'] ) && ! empty( $icon['icon']['alt'] ) ? $icon['icon']['alt'] : 'Safety Icon';
              $logo = isset( $icon['icon']['ID'] ) && ! empty( $icon['icon']['ID'] ) ? wp_get_attachment_url( $icon['icon']['ID'] ) : '';
              ?>
              <img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( $alt ); ?>" />
              <?php
            }
            ?>
          </div>
          <?php
        }

        if ( ! empty( $safety_copy ) ) {
          ?>
          <div class="safety__copy">
            <p><?php echo $safety_copy; ?></p>
          </div>
          <?php
        }

        if ( is_array( $safety_stats ) && count( $safety_stats ) > 0 ) {
          ?>
          <ul class="safety__stats">
            <?php
            foreach ( $safety_stats as $stat ) {

              ?>
              <li class="safety__stat">
                <div class="safety__statTitle"><?php echo esc_html( $stat['title'] ); ?></div>
                <div class="safety__statNumber">
                  <?php echo esc_html( $stat['number'] ); ?><span class="safety__statPercent"><?php echo esc_html( $stat['unit'] ); ?></span>
                </div>
                <div class="safety__statFollow"><?php echo esc_html( $stat['subtext'] ); ?></div>
              </li>
              <?php
            }
            ?>
          </ul>
          <?php
        }

        if ( ! empty( $safety_fine_print ) ) {
          ?>
          <div class="safety__fineprint"><?php echo esc_html( $safety_fine_print ); ?></div>
          <?php
        }
        ?>
      </div>
    </div>
    <?php
  }
?>


<div class="container">
  <?php dynamic_sidebar('broadstreet-ros-bottom'); ?>
</div>

  <div class="decorative _lightlines-footer-corner _pulled"></div>
</main><!-- #main -->


<?php
get_footer();
