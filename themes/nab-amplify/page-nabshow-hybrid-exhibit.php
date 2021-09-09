<?php

/*
* Template Name: NABShow Hybrid Exhibit
*/

get_header('nabshow');



/* =============================================


* page_title (String, required, can use existing page title field in Wordpress)
* teaser_video (Relationship - one ShowVideo)
* teaser_exhibitor (Relationship - one MYSExhibitor - note: content team will need to add an image to each Exhibitor in the CMS) 
* popular_exhibits_title (String)
* popular_exhibits (Relationship - zero or more MYSSessions, if zero, don't display the section)
* featured_exhibits_title (String)
* featured_exhibits (Relationship - two or more ShowVideos, if zero, don't display section)
* banner (image, if not set, don't display section)


================================================ */

$nab_mys_urls             = get_option( 'nab_mys_urls' );
$show_code                = isset( $nab_mys_urls['show_code'] ) ? $nab_mys_urls['show_code'] : '';
$teaser_video             = get_field( 'teaser_video' );
$teaser_exhibitor         = get_field( 'teaser_exhibitor' );
$popular_exhibits_title   = get_field( 'popular_exhibits_title' );
$popular_exhibits         = get_field( 'popular_exhibits' );
$featured_exhibits_title  = get_field( 'featured_exhibits_title' );
$featured_exhibits        = get_field( 'featured_exhibits' );
$banner                   = get_field( 'banner' );
?>

<main id="primary" class="site-main">
<div class="decorative _lightlines-strip"></div>
  <div class="section _bottom gradient__orange-orange-corners">
    <div class="container">
      <div class="section-heading _centered">
        <h1 class="h-xxl"><?php the_title(); ?></h1>        
      </div>
      <div class="exhibit-teaser">
        <?php
        if ( ! empty( $teaser_video ) ) {

          $video_category = get_the_terms( $teaser_video, 'video-library' );
          ?>
          <!-- teaser_video (this is a ShowVideo)-->
          <div class="exhibit-teaser__main">
            <div class="teaser">
              <div class="teaser__media">
                <div class="video-embed">
                  <?php the_field( 'embed_code', $teaser_video ); ?>
                </div>
              </div>
              <div class="teaser__body teaser-border">
                <div class="teaser__content wysiwyg-typography">
                  <?php
                  if ( ! empty( $video_category ) && ! is_wp_error( $video_category ) ) {
                    $video_category = wp_list_pluck( $video_category, 'name' );
                    ?>
                    <h3 class="h-xs"><?php echo esc_html( implode( ', ', $video_category ) ); ?></h3>
                    <?php
                  }
                  ?>
                  <p><?php echo esc_html( get_the_title( $teaser_video ) ); ?></p>
                </div>                
              </div>
            </div>
          </div>
          <!-- END teaser_video -->
          <?php
        }

        if ( ! empty( $teaser_exhibitor ) ) {
          
          $thumbnail_url  = has_post_thumbnail( $teaser_exhibitor ) ? get_the_post_thumbnail_url( $teaser_exhibitor ) : '';
          $exhibitor_name = get_the_title( $teaser_exhibitor );
          $booths_detail  = get_post_meta( $teaser_exhibitor, 'booths', true );
          $booth_link     = 'https://' . $show_code . '.mapyourshow.com/8_0/floorplan/';
          $exibitor_link  = 'https://' . $show_code . '.mapyourshow.com/8_0/#/';

          if ( ! empty( $booths_detail ) ) {
            $booths_detail  = ! empty( $booths_detail ) ? json_decode( $booths_detail, true ) : $booths_detail;
            $hallId         = isset( $booths_detail['hallid'] ) ? $booths_detail['hallid'] : '';
            $boothnumber    = isset( $booths_detail['boothnumber'] ) ? $booths_detail['boothnumber'] : '';
            $booth_link     .= '?hallID=' . $hallId . '&selectedBooth=' . $boothnumber;
          }
          ?>
          <!-- teaser_exhibitor (this is a MYSExhibitor)-->
          <div class="exhibit-teaser__aside teaser-aside teaser-border">
            <div class="teaser-aside__content">
              <div class="teaser-aside__company">
                <?php
                if ( ! empty( $thumbnail_url ) ) {
                  ?>
                  <img class="teaser-aside__media" src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $exhibitor_name ); ?>" />
                  <?php
                }
                ?>
                <h4 class="teaser-aside__title"><?php echo esc_html( $exhibitor_name ); ?></h4>
              </div>
              <div class="teaser-aside__ctas">
                <ul class="teaser-aside__cta">
                  <!-- note href below links to the Exhibitor page on Map Your Show  -->
                  <li><a href="<?php echo esc_url( $exibitor_link ); ?>" class="button _solid _compact">Upcoming Events</a></li>
                  <li><a href="<?php echo esc_url( $booth_link ); ?>" class="button _solid _compact">Check Out Booth</a></li>
                </ul>
              </div>
            </div>
          </div>
          <?php
        }
        ?>           
      </div>
    </div>
  </div>

  <?php
  if ( $popular_exhibits && is_array( $popular_exhibits ) && count( $popular_exhibits ) > 0 ) {
    ?>
    <div class="section container">
      <div class="section-heading _centered">
        <h2 class="h-xl"><?php echo esc_html( $popular_exhibits_title ); ?></h2>
      </div>
      <div class="thumbcards-wrapper">
        <div class="thumbcards thumbcards--3">
          <?php

          $session_type_term    = get_term_by( 'slug', 'session-type', 'session-categories' );
          $session_planner_url  = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/session-details.cfm?scheduleid=';
          
          foreach ( $popular_exhibits as $current_exhibit ) {
            
            $event_type   = '';
            $start_time   = get_post_meta( $current_exhibit, 'starttime', true );
            $schedule_id  = get_post_meta( $current_exhibit, 'scheduleid', true );

            if ( ! empty( $session_type_term ) && ! is_wp_error( $session_type_term) ) {

              $session_types = wp_get_post_terms( $current_exhibit, 'session-categories', array(
                'taxonomy'  => 'session-categories',
                'parent'    => $session_type_term->term_id,
              ));

              if ( ! empty( $session_types ) && ! is_wp_error( $session_types ) ) {
                $event_type = wp_list_pluck( $session_types, 'name' );
                $event_type = implode( ', ', $event_type );
              }
            }
            ?>
            <div class="thumbcard">
              <div class="thumbcard__body">
                <h4 class="thumbcard__datetime"><?php echo esc_html( date_format( date_create( $start_time ), 'F jS - gA' ) . ' EST' ); ?></h4>
                <h3 class="thumbcard__title"><?php echo esc_html( get_the_title( $current_exhibit ) ); ?></h3>
                <h4 class="thumbcard__category"><?php echo esc_html( $event_type ); ?></h4>
                <a href="<?php echo esc_url( $session_planner_url . $schedule_id ); ?>" class="thumbcard__cta">+ Add To My Schedule</a>
              </div>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
    <?php
  }

  if ( $featured_exhibits && is_array( $featured_exhibits ) && count( $featured_exhibits ) > 0 ) {
    ?>
    <div class="section container">
      <div class="section-heading _centered">
        <h2 class="h-xl"><?php echo esc_html( $featured_exhibits_title ); ?></h2>
      </div>
      <div class="teasers teasers--2-up">    
        <?php
        foreach ( $featured_exhibits as $featured_exhibit ) {

          $video_category = get_the_terms( $featured_exhibit, 'video-library' );
          $link           = get_field( 'link', $featured_exhibit );
          ?>
          <div class="teaser">
            <div class="teaser__media">
              <div class="video-embed">
                <?php the_field( 'embed_code', $featured_exhibit ); ?>
              </div>
            </div>
            <div class="teaser__body teaser-border">
              <div class="teaser__content wysiwyg-typography">
                <?php
                if ( ! empty( $video_category ) && ! is_wp_error( $video_category ) ) {
                  $video_category = wp_list_pluck( $video_category, 'name' );
                  ?>
                  <h3 class="h-xs"><?php echo esc_html( implode( ', ', $video_category ) ); ?></h3>
                  <?php
                }
                ?>
                <p><?php echo esc_html( get_the_title( $featured_exhibit ) ); ?></p>
              </div>
              <?php
              if ( ! empty( $link ) ) {
                
                $link_url     = $link['url'];
                $link_title   = $link['title'];
                $link_target  = isset( $link['target'] ) && ! empty( $link['target'] ) ? $link['target'] : '_self';
                ?>
                <a class="teaser__cta button _solid _compact" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                <?php
              }
              ?>
            </div>
          </div>
          <?php
        }
        ?>
    </div>
    <?php
  }

  if ( ! empty( $banner ) ) {

    $banner_image_url = wp_get_attachment_url( $banner );
    ?>
    <div class="section">
      <div class="banner">
        <img src="<?php echo esc_url( $banner_image_url ); ?>" class="banner__image" alt="<?php the_title(); ?>" />
      </div>
    </div>
    <?php
  }
  ?>

  <!-- ad_code - Leave this alone for now - will eventually be replaced with Broadstreet code -->
  <div class="ad _banner">
    <a href="#"><img src="/assets/images/ad-banner.jpg" alt="" /></a>
  </div>
  <!-- END ad_code -->

  
  <!-- INCLUDE template_parts/content-upcoming-mys-sessions.php -->
  <?php get_template_part( 'template-parts/content', 'upcoming-mys-sessions' ); ?> 

  <div class="decorative _lightlines-footer-strip"></div>
</main><!-- #main -->

<?php get_footer('nabshow');
