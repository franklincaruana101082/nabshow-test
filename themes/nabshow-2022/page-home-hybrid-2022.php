<?php
/**
 * Template Name: Hybrid Home Page 2022
 * Description: Home page template for during the show
 *
 */

get_header();

$headline      = get_field('banner_headline');
$subhead       = get_field('banner_subtitle');
$video_sponsor = get_field('video_sponsor_ad');
$banner_cta    = get_field('banner_cta');

$video         = get_field('video_embed');
$video_style   = "";
$video_file    = get_field('video_file');
if($video_file) {
  $aspect_height = (100 * ($video_file['height'] / $video_file['width']));
  $aspect_width = (100 * ($video_file['width'] / $video_file['height']));
  $video_style = 'padding-top: '.$aspect_height.'%;';
  $video = '<video class="hybrid__video" muted loop autoplay><source src="'.esc_url($video_file['url']).'" type="'.esc_attr($video_file['mime_type']).'"></video>';
}
?>

<main id="main" class="hybrid">
  <div class="banner--hybrid">
    <div class="container">
      <?php if($subhead) { ?>
        <h2 class="intro__label"><?php echo esc_html($subhead); ?></h2>
      <?php } ?>
      <?php if($headline) { ?>
        <h1 class="intro__title"><?php echo esc_html($headline); ?></h1>
      <?php } ?>

      <div class="banner__vs">
        <?php if($video): ?>
          <div class="banner__video">
            <div class="embed-wrapper _video" style="<?php echo esc_attr($video_style); ?>">
              <?php echo($video); ?>              
            </div>
            <div class="banner__cta">
              <?php if ($video_sponsor) { ?>
              <div class="banner__sponsor">
                <?php echo do_shortcode($video_sponsor); ?>
              </div>
              <?php } ?>
              <?php if($banner_cta) : 
                $banner_cta_url = $banner_cta['url'];
                $banner_cta_title = $banner_cta['title'];
                $banner_cta_target = $banner_cta['target'] ? $banner_cta['target'] : '_self';
              ?>
              <a class="button" href="<?php echo esc_url($banner_cta_url); ?>" target="<?php echo esc_attr($banner_cta_target); ?>"><?php echo esc_html($banner_cta_title); ?></a>
            <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>
        
        <?php if(have_rows('banner_show_schedule')): ?>
          <div class="banner__schedule schedule">
            <?php if (get_field('banner_schedule_title')) { ?>
            <h4 class="schedule__title"><?php the_field('banner_schedule_title'); ?></h4>
            <?php } ?>
            <ul class="schedule__main">
            <?php while(have_rows('banner_show_schedule')): the_row();
              $sch_date = strtotime(get_sub_field('day'));
              $first_schedule = '';
              if(get_row_index() == 1) {
                $first_schedule = '_shown';
              }
            ?>
              <li class="schedule__day">
                <button class="schedule__date js-schedule-day <?php echo esc_attr($first_schedule); ?>"><?php echo esc_html(date('D d', $sch_date));?></button>
                <ul class="schedule__list js-schedule <?php echo esc_attr($first_schedule); ?>">
                <?php while(have_rows('schedule')): the_row();
                  $sch_time = get_sub_field('time');
                  $sch_title = get_sub_field('title');
                ?>
                  <li class="schedule__item">
                    <div class="schedule__time"><?php echo esc_html($sch_time); ?></div>
                    <div class="schedule__name"><?php echo esc_html($sch_title); ?></div>
                  </li>
                <?php endwhile; ?>
                </ul>
              </li>
            <?php endwhile; ?>
            </ul>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="hybrid__lighting1">
<?php

$quick_links          = get_field( 'quick_links' );

if ( is_array( $quick_links ) && count( $quick_links ) > 0 ) {
  ?>
  <div class="container section">
    <div class="jump-links">
      <h2 class="jump-links__label"><?php the_field('quick_links_title'); ?></h2>
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

if (get_field('ad_shortcode')) {
  ?>
  <div class="container section">
    <?php echo do_shortcode(get_field('ad_shortcode')); ?>
  </div>
  <?php
}

if(have_rows('prominent_links')) {
  ?>
  <div class="container">
    <div class="hybrid__plinks">
      <?php if(get_field('prominent_links_title')) { ?>
        <h3 class="h-xl"><?php the_field('prominent_links_title'); ?></h3>
      <?php } ?>
      <ul class="hybrid__plinksList">
      <?php while(have_rows('prominent_links')): the_row(); 
        $link         = get_sub_field('link');
        $link_url     = $link['url'];
        $link_title   = $link['title'];
        $link_target  = isset( $link['target'] ) && ! empty( $link['target'] ) ? $link['target'] : '_self';
        ?>
        <li class="hybrid__plink">
          <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="button"><?php echo esc_html( $link_title ); ?></a>
        </li>
      <?php endwhile; ?>
      </ul>
    </div>
  </div>
  <?php
}
?>

</div><?php // close .hybrid__lighting1 ?>

<?php 
  $main_stage_image = get_field('main_stage_image');
  if(!empty($main_stage_image)) { ?>
<img class="hybrid__bannerImg" src="<?php echo esc_url($main_stage_image['url']); ?>" alt="<?php echo esc_attr($main_stage_image['alt']); ?>" />
<?php } 
  
  if(get_field('main_stage_copy')){ ?>
<div class="container section">
  <div class="hybrid__copy wysiwyg-typography">
    <?php the_field('main_stage_copy'); ?>
  </div>
</div>
  <?php }


  $stories = get_field('stories');

  if( $stories ):
    while( have_rows('stories')): the_row();
      if( have_rows('story_items')):
?>
<div class="hybrid__lighting2">
  <div class="section container">
    
    <h2 class="featurette__title"><?php echo esc_html( $stories['section_header'] ); ?></h2>

    <div class="cards-wrapper">
      <div class="cards">
        <?php while(have_rows('story_items')): the_row();
          
        ?>
        <div class="card">
          <?php
          $img = get_sub_field('story_image');
          if( !empty($img)):
          ?>
          <img class="card__image" src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
          <?php endif; ?>
          <div class="card__body">
            <h3 class="card__title"><?php the_sub_field('story_title'); ?></h3>
            <?php the_sub_field('story_teaser_copy'); ?>
          </div>

        </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>
  <?php
      endif;
    endwhile;
  endif;
?>

<?php if( have_rows('news_items') || have_rows('news_ctas') || have_rows('press_links') ) : ?>
<div class="hybrid__lighting3">
  <div class="container section">
    <?php if(have_rows('news_items')): ?>
    <?php if (get_field('news_section_title')) { ?>
    <h2 class="featurette__title"><?php echo esc_html( get_field('news_section_title') ); ?></h2>
    <?php } ?>
    <div class="stories hybrid__stories">
    <?php while(have_rows('news_items')): the_row(); 
      $link_title = get_sub_field('title');
      $link_teaser = get_sub_field('summary');
      $link = get_sub_field('link');
      $link_url = $link['url'];
      $link_target = $link['target'] ? $link['target'] : '_self';
      $link_text = $link['title'];
    ?>
      <a class="story _noimg" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
        <div class="story__body">
          <?php if ($link_title) { ?>
          <h4 class="story__title"><?php echo esc_html($link_title); ?></h4>
          <?php } ?>
          <?php if ($link_teaser) { ?>
          <p>
            <?php echo esc_html($link_teaser); ?>
          </p>
          <?php } ?>
          <div class="button _arrow"><?php echo esc_html($link_text); ?></div>
        </div>
      </a>
    <?php endwhile; //end while(have_rows('news_items')): the_row(); ?>
    </div>
    <?php endif; //end if(have_rows('news_items')): ?>
    <?php if(have_rows('news_ctas')): ?>

    <div class="hybrid__plinks">
      <ul class="hybrid__plinksList">
      <?php while(have_rows('news_ctas')): the_row(); 
        $link         = get_sub_field('link');
        $link_url     = $link['url'];
        $link_title   = $link['title'];
        $link_target  = isset( $link['target'] ) && ! empty( $link['target'] ) ? $link['target'] : '_self';
        ?>
        <li class="hybrid__plink">
          <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="button"><?php echo esc_html( $link_title ); ?></a>
        </li>
      <?php endwhile; ?>
      </ul>
    </div>

    <?php endif; //end if(have_rows('news_ctas')): ?>
    <?php

    $press_links = get_field( 'press_links' );

    if ( is_array( $press_links ) && count( $press_links ) > 0 ) {
      ?>
      <div class="container">
        <div class="jump-links">
          <h2 class="jump-links__label"><?php the_field('press_links_title'); ?></h2>
          <ul class="jump-links__menu">
            <?php
            foreach ( $press_links as $link ) {

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
    ?>
  </div>
</div>
<?php endif; //end if( have_rows('news_items') || have_rows('news_ctas') || have_rows('press_links') ) : ?>


<?php if(have_rows('show_gallery')): ?>
<div class="container section hybrid__gallery">
  <?php while(have_rows('show_gallery')): the_row(); 
    $img = get_sub_field('image');
    if(!empty($img)) {
  ?>
  <div class="hybrid__galleryItem">
    <img class="hybrid__galleryImg" src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
  </div>
  <?php } endwhile; //end while(have_rows('show_gallery')): the_row(); ?>
</div>
<?php endif; //end if(have_rows('show_gallery')): ?>


<?php
$numrows = count( get_field( 'featured_topics' ) );

if( have_rows('featured_topics') ): ?>
  <div class="section topics">
    <?php if($numrows > 1): ?>
    <ul class="topics__nav">
    <?php
      while( have_rows('featured_topics') ): the_row();
        ?>
        <li class="topics__navitem"><div class="topics__navwrap"><?php the_sub_field('small_title'); ?></div></li>
        <?php
      endwhile;

      while( have_rows('featured_topics') ): the_row();
        ?>
        <li class="topics__navitem"><div class="topics__navwrap"><?php the_sub_field('small_title'); ?></div></li>
        <?php
      endwhile;
    ?>
    </ul>
    <?php endif; ?>
    <ul class="topics__main">
    <?php
      while( have_rows('featured_topics') ): the_row();
        $background = get_sub_field('background_image');
        $link = get_sub_field('link');
        ?>
        <li class="topics__item" style="background-image: url('<?php echo esc_url($background['url']); ?>');">
          <div class="topic">
            <h5 class="topic__lede"><?php the_sub_field('small_title'); ?></h5>
            <h2 class="topic__title"><?php the_sub_field('big_title'); ?></h2>
            <div class="topic__copy"><?php the_sub_field('copy'); ?></div>
            <?php if( !empty($link) ): ?>
            <a class="topic__button button" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ? $link['target'] : '_self'); ?>"><?php echo $link['title']; ?></a>
            <?php endif; ?>
          </div>
        </li>
        <?php
      endwhile;
      if($numrows > 1):
      while( have_rows('featured_topics') ): the_row();
        $background = get_sub_field('background_image');
        $link = get_sub_field('link');
        ?>
        <li class="topics__item" style="background-image: url('<?php echo esc_url($background['url']); ?>');">
          <div class="topic">
            <h5 class="topic__lede"><?php the_sub_field('small_title'); ?></h5>
            <h2 class="topic__title"><?php the_sub_field('big_title'); ?></h2>
            <div class="topic__copy"><?php the_sub_field('copy'); ?></div>
            <?php if( !empty($link) ): ?>
            <a class="topic__button button" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ? $link['target'] : '_self'); ?>"><?php echo $link['title']; ?></a>
            <?php endif; ?>
          </div>
        </li>
        <?php
      endwhile;
      endif;
    ?>
    </ul>
    <?php /* <div class="home__lighting2"></div> */ ?>
  </div>
<?php
endif;



if( have_rows('closing_featurette') ) :
  while( have_rows('closing_featurette') ): the_row();
    if(get_sub_field('closing_title')):
  ?>
  <div class="section featurette">
    <div class="container">
      <h2 class="featurette__title"><?php the_sub_field('closing_title'); ?></h2>
      <div class="featurette__copy"><?php the_sub_field('closing_copy'); ?></div>
      <?php if( have_rows('closing_Items') ) : ?>
        <ul class="featurette__list">
        <?php while( have_rows('closing_Items') ): the_row();
          $featurette_image = get_sub_field('image');
          $featurette_link = get_sub_field('link');
        ?>
          <li class="featurette__item">
            <?php if( !empty($featurette_link) ): ?>
            <a class="featurette__link" href="<?php echo esc_url($featurette_link['url']); ?>" target="<?php echo esc_attr($featurette_link['target'] ? $featurette_link['target'] : '_self'); ?>">
              <?php else: ?><div class="featurette__link">
            <?php endif; ?>
              <img class="featurette__img" src="<?php echo esc_url($featurette_image['url']); ?>" alt="<?php echo esc_attr($featurette_image['alt']); ?>" />
              <div class="featurette__itemcontent">
                <h3 class="featurette__itemtitle"><?php the_sub_field('title'); ?></h3>
                <div class="featurette__itemcopy"><?php the_sub_field('copy'); ?></div>
                <div class="featurette__linktext"><?php if( !empty($featurette_link) ) echo($featurette_link['title']); ?></div>
              </div>
            <?php if( !empty($featurette_link) ): ?>
            </a>
            <?php else: ?></div>
            <?php endif; ?>
          </li>
        <?php endwhile; ?>
        </ul>
      <?php endif; ?>

    <?php dynamic_sidebar('broadstreet-ros-bottom'); ?>
    </div>
  </div>
<?php
  endif;
 endwhile;
endif;

if ( have_posts() ) :
  ?>
  <div class="section gutenberg-blocks">
    <?php
    while ( have_posts() ) :
      the_post();
      the_content();
    endwhile;
    ?>
  </div>
  <?php
endif;
?>


  <?php //<div class="decorative _lightlines-footer-corner _pulled"></div> ?>
</main><!-- #main -->

<?php

dynamic_sidebar('broadstreet-prestitial'); 

get_footer();
