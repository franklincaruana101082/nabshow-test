<?php

/*
* Template Name: NABShow Hybrid Education
*/

get_header('hybrid');



/* =============================================

* page_title (String, required, can use existing page title field in Wordpress)
* teaser_video (Relationship - one ShowVideo)
* teaser_track (Relationship - one MYSTrack - note: content team will need to add an image to each track in the CMS) 
* popular_sessions_title (String)
* popular_sessions (Relationship - zero or more MYSSessions, if zero, don't display the section)
* featured_sessions_title (String)
* featured_sessions (Relationship - two or more ShowVideos, if zero, don't display section)
* banner (image, if not set, don't display section)

================================================ */

$nab_mys_urls             = get_option( 'nab_mys_urls' );
$show_code                = isset( $nab_mys_urls['show_code'] ) ? $nab_mys_urls['show_code'] : '';
$teaser_video             = get_field( 'teaser_video' );
$teaser_track             = get_field( 'teaser_track' );
$popular_sessions_title   = get_field( 'popular_sessions_title' );
$popular_sessions         = get_field( 'popular_sessions' );
$featured_sessions_title  = get_field( 'featured_sessions_title' );
$featured_sessions        = get_field( 'featured_sessions' );
$banner                   = get_field( 'banner' );
$ad_code                  = get_field( 'ad_code' );
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

        if ( ! empty( $teaser_track ) ) {
          
          $track_details = get_term_by( 'ID', $teaser_track, 'tracks' );
          $track_mys_url = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/#/searchtype/sessiontrack/search/';

          if ( $track_details && ! empty( $track_details ) ) {
            
            $track_mys_url  .= $track_details->name . '/show/all';
            $track_image    = get_term_meta( $track_details->term_id, 'tax-image-id', true );
            ?>
            <!-- teaser_track (this is a MYSTrack)-->
            <div class="exhibit-teaser__aside teaser-aside teaser-border">
              <div class="teaser-aside__content">
                <div class="teaser-aside__company">
                  <?php
                  if ( ! empty( $track_image ) ) {

                    $track_image_url = wp_get_attachment_url( $track_image );
                    ?>
                    <img class="teaser-aside__media" src="<?php echo esc_url( $track_image_url ); ?>" alt="<?php echo esc_attr( $track_details->name ); ?>"/>
                    <?php
                  }
                  ?>
                  <h4 class="teaser-aside__title"><?php echo esc_html( $track_details->name ); ?></h4>
                </div>
                <div class="teaser-aside__ctas">            
                <ul class="teaser-aside__cta">
                  <li><a href="<?php echo esc_url( $track_mys_url ); ?>" class="button _solid _compact">See all sessions</a></li>           
                </ul>
                </div>
              </div>
            </div>
            <!-- END teaser_track -->
            <?php
          }
        }
        ?>
      </div>
    </div>
  </div>
  
  <?php
  if ( $popular_sessions && is_array( $popular_sessions ) && count( $popular_sessions ) > 0 ) {
    ?>
    <div class="section container">
      <div class="section-heading _centered">
        <h2 class="h-xl"><?php echo esc_html( $popular_sessions_title ); ?></h2>
      </div>
      <div class="thumbcards-wrapper">
        <div class="thumbcards thumbcards--3">
          <?php
          
          $session_type_term    = get_term_by( 'slug', 'session-type', 'session-categories' );
          $session_planner_url  = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/session-details.cfm?scheduleid=';

          foreach ( $popular_sessions as $current_session ) {

            $event_type   = '';
            $start_time   = get_post_meta( $current_session, 'starttime', true );
            $schedule_id  = get_post_meta( $current_session, 'scheduleid', true );

            if ( ! empty( $session_type_term ) && ! is_wp_error( $session_type_term) ) {

              $session_types = wp_get_post_terms( $current_session, 'session-categories', array(
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
                <h3 class="thumbcard__title"><?php echo esc_html( get_the_title( $current_session ) ); ?></h3>
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

  if ( $featured_sessions && is_array( $featured_sessions ) && count( $featured_sessions ) > 0 ) {
    ?>
    <div class="section container">
      <div class="section-heading _centered">
        <h2 class="h-xl"><?php echo esc_html( $featured_sessions_title ); ?></h2>
      </div>
      <div class="teasers teasers--stacked">
        <?php

        foreach ( $featured_sessions as $featured_session ) {
          
          $video_category = get_the_terms( $featured_session, 'video-library' );
          $link           = get_field( 'link', $featured_session );
          ?>
          <div class="teaser">
            <div class="teaser__media">
              <div class="video-embed">
                <?php the_field( 'embed_code', $featured_session ); ?>
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
                <p><?php echo esc_html( get_the_title( $featured_session ) ); ?></p>
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

  <?php
  if ( ! empty( $ad_code ) ) {
  ?>
    <div class="ad _banner">
        <?php echo do_shortcode( $ad_code ); ?>
    </div>
  <?php
  }
  ?>
  
  <!-- INCLUDE template_parts/content-upcoming-mys-sessions.php -->
  <?php get_template_part( 'template-parts/content', 'upcoming-mys-sessions' ); ?> 

  <div class="decorative _lightlines-footer-strip"></div>
</main><!-- #main -->

<?php get_footer('hybrid');
