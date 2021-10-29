<?php

/*
 * Template Name: Amplify Video Library
 */

get_header();

$hide_videos = get_field('hide_video');

if($hide_videos) {
  $show_time = get_field('hide_videos_until');
  $show_time = new DateTime($show_time);
  $current_time = new DateTime("now");
  $current_time->setTimezone(new DateTimeZone('America/New_York'));
  $current_time_string = $current_time->format('Y-m-d H:i:s');
  $current_time_adjusted = new DateTime($current_time_string);
  
  if($show_time < $current_time_adjusted) {
    $hide_videos = false;
  }
}


?>

<main id="primary" class="site-main">

  <div class="section _bottom">
    <div class="container teaser__intro">
      <div class="section-heading teaser__desc">
        <h1 class="h-xxl"><?php the_title(); ?></h1>
        <?php the_content(); ?>
      </div>      
      <?php 
      $related_products = get_field('related_product');
      if(!empty($related_products)): 
        $related_product_ids = implode(',', $related_products);
        ?>
        <div class="teaser__products">
          <?php echo do_shortcode('[products columns="1" ids="' . $related_product_ids .'"]'); ?>
        </div>
      <?php endif; ?>
      <?php if ( have_rows('video_section') && !$hide_videos ) { ?>
        <nav class="teaser__nav">
          <h4 class="teaser__navTitle">Jump to:</h4>
        <?php
        while ( have_rows('video_section') ) : the_row();
          $section_title  = get_sub_field('section_title');
          $section_anchor = str_replace(' ', '_', $section_title);
          ?>
          <a href="#<?php echo $section_anchor; ?>" class="button _solid _compact"><?php echo $section_title; ?></a>
          <?php
        endwhile;
        ?>
        </nav>
        <?php
      }
    ?>
    </div>
  </div>
  <?php
  if ( have_rows('video_section') && !$hide_videos ) { ?>
    <div class="main _contentborder teaser__wrap">
    <?php while ( have_rows('video_section') ) : the_row();
          
      $section_title  = get_sub_field('section_title');
      $section_anchor = str_replace(' ', '_', $section_title);
      $section_desc   = get_sub_field('section_description');
      $section_videos = get_sub_field('videos');
    ?>
      <div class="section container teaser__section">
        <div class="section-heading" id="<?php echo $section_anchor; ?>">
          <h2 class="h-xxl"><?php echo $section_title; ?></h2>
          <?php if ($section_desc): ?>
          <div><?php echo $section_desc; ?></div>
          <?php endif; ?>
        </div>
        <?php if($section_videos) : ?>
        <div class="teaser__grid">
          <?php
          foreach ( $section_videos as $video ) :
            
            $video_desc  = wp_strip_all_tags(get_the_excerpt($video));
            $video_img_url = get_the_post_thumbnail_url($video);
            if($video_img_url == '') {
              $video_img_url = get_template_directory_uri().'/assets/images/amplify-video-placeholder.png';
            }
            $video_company_id = get_field('company', $video);
            if ($video_company_id) {
              $video_company = get_the_title( get_field('company', $video) );
            }
            $video_speakers = get_field('speakers', $video);
            ?>
            <a class="teaser" href="<?php echo get_permalink( $video ); ?>">
              <div class="teaser__media">
                
                  <img src="<?php echo $video_img_url; ?>" class="teaser__img" alt="Preview Image for <?php echo get_the_title($video); ?>" />
                
              </div>
              <div class="teaser__body">
                <div class="teaser__content wysiwyg-typography">
                  <p class="teaser__title"><?php echo get_the_title($video); ?></p>
                  <div class="teaser__desc">
                    <?php echo $video_desc; ?>
                  </div>
                  <?php if ($video_company_id) { ?>
                  <div class="teaser__company">By <?php echo $video_company; ?></div>
                  <?php } ?>
                  <?php if(!empty($video_speakers)) : ?>
                  <div class="teaser__speakers">
                    Featuring:
                    <?php 
                    
                    if(!empty($video_speakers)) {
                      $speaker_name = get_field('first_name',$video_speakers[0]) . ' ' . get_field('last_name',$video_speakers[0]);
                      $speaker_photo = get_field('headshot',$video_speakers[0]);
                      ?>
                      <div class="teaser__speaker">
                        <?php
                        if( !empty($speaker_photo) ) : ?>
                          <span class="author__photo">
                            <img class="event__host-photo teaser__speakerImg" src="<?php echo esc_url($speaker_photo['url']); ?>" alt="<?php echo esc_attr($speaker_photo['alt']); ?>" />
                          </span>
                        <?php endif; ?>
                        <span class="teaser__speakerName"><?php echo $speaker_name; ?></span>
                      </div>
                      <?php if (count($video_speakers) > 1) { ?>
                      <div class="teaser__speakerMore">And more</div>
                      <?php }
                    }
                    ?>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
            </a>
            <?php
          endforeach;
          ?>
        </div>
        <?php
        endif;
        ?>
      </div>
      <?php
      endwhile; ?>
  </div>
  <?php
  } else if (have_rows('video_section') && $hide_videos ) {
    ?>
    <div class="main _contentborder teaser__wrap">
      <div class="section container teaser__section">
        <div class="teaser__soon">This content will be available for streaming on <?php the_field('hide_videos_until'); ?>.</div>
      </div>
    </div>
    <?php
  }
  ?>


</main><!-- #main -->

<?php get_footer();
