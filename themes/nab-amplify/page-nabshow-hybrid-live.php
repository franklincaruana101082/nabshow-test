<?php

/*
 * Template Name: NABShow Hybrid Live
 */

  get_header('hybrid');



/*

* page_title (String, required, can use existing page title field in Wordpress)
* primary_video (Relationship - one ShowVideo)
* secondary_videos (Relationship - zero or more ShowVideos, if zero, don't display the section)
* education_videos_title (String)
* education_videos (Relationship - two or more ShowVideos, if zero, don't display section)
* banner (image, if not set, don't display section)
* exhibit_videos_title (String)
* exhibit_videos (Repeater, if zero, don't display section)
** show_video (Relationship, one ShowVideo)
** mys_exhibitor (Relationship, one MYS Exhibitor)

*/

$nab_mys_urls           = get_option( 'nab_mys_urls' );
$show_code              = isset( $nab_mys_urls['show_code'] ) ? $nab_mys_urls['show_code'] : '';
$primary_video          = get_field( 'primary_video' );
$secondary_videos       = get_field( 'secondary_videos' );
$education_videos_title = get_field( 'education_videos_title' );
$education_videos       = get_field( 'education_videos' );
$banner                 = get_field( 'banner' );
$exhibit_videos_title   = get_field( 'exhibit_videos_title' );
$exhibit_videos         = get_field( 'exhibit_videos' );
?>

<main id="primary" class="site-main">
  <div class="decorative _lightlines-strip"></div>

  <!-- Video Intro -->
  <div class="section _bottom gradient__orange-orange-corners">
    <div class="container">
      <div class="section-heading _centered">
        <h1 class="h-xxl"><?php the_title(); ?></h1>        
      </div>
      <?php
      if ( ! empty( $primary_video ) ) {
        
        $primary_video_link = get_field( 'link', $primary_video );
        ?>
        <div class="video-block">
          <div class="video-embed">
            <?php the_field( 'embed_code', $primary_video ); ?>
          </div>
          <div class="video-block__caption">
            <p><?php echo esc_html( get_the_title( $primary_video ) ); ?></p>
          </div>
          <?php
          if ( ! empty( $primary_video_link ) ) {
            
            $link_url     = $primary_video_link['url'];
            $link_title   = $primary_video_link['title'];
            $link_target  = isset( $primary_video_link['target'] ) && ! empty( $primary_video_link['target'] ) ? $primary_video_link['target'] : '_self';
            ?>
            <div class="video-block__ctas">
              <div class="video-block__cta">
                <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="button _solid"><?php echo esc_html( $link_title ); ?></a>
              </div>
            </div>          
            <?php
          }
          ?>
        </div>
        <?php
      }
      ?>  
    </div>
  </div>
  <!-- END Video Intro -->

  <?php
  if ( $secondary_videos && is_array( $secondary_videos ) && count( $secondary_videos ) > 0 ) {
    ?>
    <div class="section container">
      <div class="teasers teasers--2-up">    
        <?php
        foreach ( $secondary_videos as $secondary_video ) {
          
          $video_category = get_the_terms( $secondary_video, 'video-library' );
          $link           = get_field( 'link', $secondary_video );
          ?>
          <div class="teaser">
            <div class="teaser__media">
              <div class="video-embed">
                <?php the_field( 'embed_code', $secondary_video ); ?>
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
                <p><?php echo esc_html( get_the_title( $secondary_video ) ); ?></p>
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
  ?>

  <!-- ad_code - Leave this alone for now - will eventually be replaced with Broadstreet code -->
  <div class="ad _banner">
    <a href="#"><img src="/assets/images/ad-banner.jpg" alt="" /></a>
  </div>
  <!-- END ad_code -->

  <?php
  if ( $education_videos && is_array( $education_videos ) && count( $education_videos ) > 0 ) {
    ?>
    <div class="section container">
      <div class="section-heading _centered">
        <h2 class="h-xl"><?php echo esc_html( $education_videos_title ); ?></h2>
      </div>
      <div class="teasers teasers--stacked">
        <?php
        foreach ( $education_videos as $education_video ) {
          
          $video_category = get_the_terms( $education_video, 'video-library' );
          $link           = get_field( 'link', $education_video );
          ?>
          <div class="teaser">
            <div class="teaser__media">
              <div class="video-embed">
                <?php the_field( 'embed_code', $education_video ); ?>
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
                <p><?php echo esc_html( get_the_title( $education_video ) ); ?></p>
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

  <!-- ad_code - Leave this alone for now - will eventually be replaced with Broadstreet code -->
  <div class="ad _banner">
    <a href="#"><img src="/assets/images/ad-banner.jpg" alt="" /></a>
  </div>
  <!-- END ad_code -->

  <?php
  if ( $exhibit_videos ) {
    ?>
    <div class="section">
      <div class="container">
        <div class="section-heading">
          <h2 class="h-xl"><?php echo esc_html( $exhibit_videos_title ); ?></h2>
        </div>
        <div class="exhibit-teasers">
          <?php
          foreach ( $exhibit_videos as $exhibit_video ) {
            
            $show_video     = $exhibit_video['show_video'];
            $mys_exhibitor  = $exhibit_video['mys_exhibitor'];
            ?>
            <!-- exhibit_videos array -->
            <div class="exhibit-teaser">
              <?php
              if ( ! empty( $show_video ) ) {
                
                $video_category = get_the_terms( $show_video, 'video-library' );
                ?>
                <!-- show_video (this is a ShowVideo)-->
                <div class="exhibit-teaser__main">
                  <div class="teaser">
                    <div class="teaser__media">
                      <div class="video-embed">
                        <?php the_field( 'embed_code', $show_video ); ?>
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
                        <p><?php echo esc_html( get_the_title( $show_video ) ); ?></p>
                      </div>                
                    </div>
                  </div>
                </div>
                <!-- END show_video --> 
                <?php
              }

              if ( ! empty( $mys_exhibitor ) ) {
                
                $thumbnail_url  = has_post_thumbnail( $mys_exhibitor ) ? get_the_post_thumbnail_url( $mys_exhibitor ) : '';
                $exhibitor_name = get_the_title( $mys_exhibitor );
                $booths_detail  = get_post_meta( $mys_exhibitor, 'booths', true );
                $booth_link     = 'https://' . $show_code . '.mapyourshow.com/8_0/floorplan/';
                $exibitor_link  = 'https://' . $show_code . '.mapyourshow.com/8_0/#/';

                if ( ! empty( $booths_detail ) ) {
                  $booths_detail  = ! empty( $booths_detail ) ? json_decode( $booths_detail, true ) : $booths_detail;
                  $hallId         = isset( $booths_detail['hallid'] ) ? $booths_detail['hallid'] : '';
                  $boothnumber    = isset( $booths_detail['boothnumber'] ) ? $booths_detail['boothnumber'] : '';
                  $booth_link     .= '?hallID=' . $hallId . '&selectedBooth=' . $boothnumber;
                }
                ?>
                <!-- mys_exhibitor (this is a MYSExhibitor)-->
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
                        <li><a href="<?php echo esc_url( $exibitor_link ); ?>" class="button _solid _compact">Upcoming Events</a></li>
                        <li><a href="<?php echo esc_url( $booth_link ); ?>" class="button _solid _compact">Check Out Booth</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <!-- END mys_exhibitor -->  
                <?php
              }
              ?>               
            </div>
            <!-- END exhibit_videos array -->
            <?php
          }
          ?>
        </div>
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

<?php get_footer('hybrid');
