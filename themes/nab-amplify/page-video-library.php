<?php

/*
 * Template Name: Amplify Video Library
 */

  get_header();

?>

<main id="primary" class="site-main">

  <div class="section _bottom">
    <div class="container">
      <div class="section-heading _centered">
        <h1 class="h-xxl"><?php the_title(); ?></h1>
        <?php the_content(); ?>
      </div>      
      <?php if ( have_rows('video_section') ) { ?>
        <nav class="teaser__nav">
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
  if ( have_rows('video_section') ) {
    while ( have_rows('video_section') ) : the_row();
          
      $section_title  = get_sub_field('section_title');
      $section_anchor = str_replace(' ', '_', $section_title);
      $section_desc   = get_sub_field('section_description');
      $section_videos = get_sub_field('videos')
    ?>
    <div class="section container">
      <div class="section-heading _centered" id="<?php echo $section_anchor; ?>">
        <h2 class="h-xxl"><?php echo $section_title; ?></h2>
        <?php if ($section_desc): ?>
        <div><?php echo $section_desc; ?></div>
        <?php endif; ?>
      </div>
      <?php if($section_videos) : ?>
      <div class="colgrid _4up _center">
        <?php
        foreach ( $section_videos as $video ) :
          
          //$video_id = $video->ID;
          $video_title = '';
          $video_desc  = wp_strip_all_tags(get_the_excerpt($video));
          $video_img_url = get_the_post_thumbnail_url($video);
          if($video_img_url == '') {
            $video_img_url = get_template_directory_uri().'/assets/images/amplify-video-placeholder.png';
          }
          $video_company = get_the_title( get_field('company', $video) );
          ?>
          <div>
            <a class="teaser" href="<?php echo get_permalink( $video ); ?>">
              <div class="teaser__media">
                
                  <img src="<?php echo $video_img_url; ?>" class="teaser__img" alt="Preview Image for <?php echo get_the_title($video); ?>" />
                
              </div>
              <div class="teaser__body">
                <div class="teaser__content wysiwyg-typography">
                  <?php /*
                  if ( ! empty( $video_category ) && ! is_wp_error( $video_category ) ) {
                    $video_category = wp_list_pluck( $video_category, 'name' );
                    ?>
                    <h3 class="h-xs"><?php echo esc_html( implode( ', ', $video_category ) ); ?></h3>
                    <?php
                  }*/
                  ?>
                  <p class="teaser__title"><?php echo get_the_title($video); ?></p>
                  <div class="teaser__desc">
                    <?php echo $video_desc; ?>
                  </div>
                  <div class="teaser__meta">
                    <span class="teaser__company">By <?php echo $video_company; ?></span>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <?php
        endforeach;
        ?>
      </div>
    </div>
    <?php
    endif;
    endwhile;
  }
  ?>

</main><!-- #main -->

<?php get_footer();
