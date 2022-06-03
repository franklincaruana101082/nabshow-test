<?php
/**
 * Template Name: Home Page 2022
 * Description: Home page template design update
 *
 */

get_header();

$hero = get_field('banner_background_image');
$video= get_field('banner_video_embed');
$logo = get_field('banner_logo_image');
$cta1 = get_field('banner_main_cta');
$cta2 = get_field('banner_secondary_cta');
$banner_copy = get_field('banner_copy');

?>

<main id="main" class="new">
  <div class="hero-banner" style="background-image: url('<?php echo esc_url($hero); ?>');">
    <div class="hero__content">
      <div class="hero__label"><?php the_field('banner_date'); ?></div>
      <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" class="hero__logo" width="<?php echo( $logo['width'] ); ?>"height="<?php echo( $logo['height'] ); ?>" />
      <?php if( !empty($cta1) ): ?>
      <div class="hero__cta">
        <a href="<?php echo esc_url( $cta1['url'] ); ?>" class="button _xxl _solid _white" target="<?php echo esc_attr( $cta1['target'] ); ?>"><?php echo( $cta1['title'] ); ?></a>
      </div>
      <?php endif; 
      if( !empty($banner_copy) ): ?>
      <div class="hero__copy"><?php echo wp_kses_post($banner_copy); ?></div>
      <?php endif; ?>
    </div>
  </div>
  <div class="home__lighting1">
<?php

$quick_links          = get_field( 'quick_links' );
$site_intro           = get_field( 'site_intro' );

if ( is_array( $quick_links ) && count( $quick_links ) > 0 ) {
  ?>
  <div class="container">
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

if ( $site_intro && ! empty( $site_intro ) ) {
  ?>
  <div class="section container">
    <div class="site__intro">
      <?php echo wp_kses_post( $site_intro ); ?>
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
    
    <h2 class="featurette__title"><?php echo esc_html( $stories['section_header'] ); ?></h2>

    <div class="featurette__intro">
      <?php echo wp_kses_post( $stories['intro_copy'] ); ?>
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
          <?php if( !empty($link) ): ?>
          <a class="story__button button _solid" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ? $link['target'] : '_self'); ?>"><?php echo $link['title']; ?></a>
          <?php endif; ?>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
    <div class="section _bottom-only container">
      <?php dynamic_sidebar('broadstreet-home-leaderboard'); ?>
    </div>
  </div>
  <?php
      endif;
    endwhile;
  endif;
  ?>

  <div class="section container">
    <?php //dynamic_sidebar('broadstreet-home-leaderboard'); ?>
  </div>
  </div><?php // close .home__lighting1 ?>
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
            <a class="topic__button button _solid _white _md" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ? $link['target'] : '_self'); ?>"><?php echo $link['title']; ?></a>
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
            <a class="topic__button button _solid _white _md" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ? $link['target'] : '_self'); ?>"><?php echo $link['title']; ?></a>
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
      $center_featurette = '';
      if(get_sub_field('center_featurette')) {
        $center_featurette = ' _centered';
      }
  ?>
  <div class="section featurette <?php echo esc_attr($center_featurette); ?>">
    <div class="container">
      <div class="closing__copy">
        <h2 class="h-xl"><?php the_sub_field('closing_title'); ?></h2>
        <div class="intro-body-text"><?php the_sub_field('closing_copy'); ?></div>
      </div>
      <?php if( have_rows('closing_Items') ) : ?>
        <div class="cards">
        <?php while( have_rows('closing_Items') ): the_row();
          $featurette_image = get_sub_field('image');
          $featurette_link = get_sub_field('link');
        ?>
          <div class="card">
            <?php if( !empty($featurette_link) ): ?>
            <a class="a" href="<?php echo esc_url($featurette_link['url']); ?>" target="<?php echo esc_attr($featurette_link['target'] ? $featurette_link['target'] : '_self'); ?>">
              <?php else: ?><div class="div">
            <?php endif; ?>
              <img class="card__image" src="<?php echo esc_url($featurette_image['url']); ?>" alt="<?php echo esc_attr($featurette_image['alt']); ?>" />
              <div class="card__body">
                <h3 class="card__title"><?php the_sub_field('title'); ?></h3>
                <?php the_sub_field('copy'); ?>
              </div>
            <?php if( !empty($featurette_link) ): ?>
            </a>
            <?php else: ?></div>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
        </div>
      <?php endif; ?>

    <?php dynamic_sidebar('broadstreet-ros-bottom'); ?>
    </div>
  </div>
<?php
  endif;
 endwhile;
endif;
?>

<?php
$numrows = count( get_field( 'featured_dates' ) );

if( have_rows('featured_dates') ): ?>
  <div class="section topics">
    <?php if($numrows > 1): ?>
    <ul class="topics__nav">
    <?php
      while( have_rows('featured_dates') ): the_row();
        ?>
        <li class="topics__navitem"><div class="topics__navwrap"><?php the_sub_field('small_title'); ?></div></li>
        <?php
      endwhile;

      while( have_rows('featured_dates') ): the_row();
        ?>
        <li class="topics__navitem"><div class="topics__navwrap"><?php the_sub_field('small_title'); ?></div></li>
        <?php
      endwhile;
    ?>
    </ul>
    <?php endif; ?>
    <ul class="topics__main">
    <?php
      while( have_rows('featured_dates') ): the_row();
        $background = get_sub_field('background_image');
        $link = get_sub_field('link');
        ?>
        <li class="topics__item" style="background-image: url('<?php echo esc_url($background['url']); ?>');">
          <div class="topic">
            <h5 class="topic__lede"><?php the_sub_field('small_title'); ?></h5>
            <h2 class="topic__title"><?php the_sub_field('big_title'); ?></h2>
            <div class="topic__copy"><?php the_sub_field('copy'); ?></div>
            <?php if( !empty($link) ): ?>
            <a class="topic__button button _solid _white _md" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ? $link['target'] : '_self'); ?>"><?php echo $link['title']; ?></a>
            <?php endif; ?>
          </div>
        </li>
        <?php
      endwhile;
      if($numrows > 1):
      while( have_rows('featured_dates') ): the_row();
        $background = get_sub_field('background_image');
        $link = get_sub_field('link');
        ?>
        <li class="topics__item" style="background-image: url('<?php echo esc_url($background['url']); ?>');">
          <div class="topic">
            <h5 class="topic__lede"><?php the_sub_field('small_title'); ?></h5>
            <h2 class="topic__title"><?php the_sub_field('big_title'); ?></h2>
            <div class="topic__copy"><?php the_sub_field('copy'); ?></div>
            <?php if( !empty($link) ): ?>
            <a class="topic__button button _solid _white _md" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ? $link['target'] : '_self'); ?>"><?php echo $link['title']; ?></a>
            <?php endif; ?>
          </div>
        </li>
        <?php
      endwhile;
      endif;
    ?>
    </ul>
  </div>
<?php
endif;
?>

<?php 
$closing_cta = get_field('closing_cta');
$closing_copy = get_field('closing_copy');
if ($closing_cta || $closing_copy): 
?>
<div class="section container">
  <div class="closing__content">
    <?php if ($closing_cta): ?>
    <a class="closing__button button _xxl _solid _white _border" href="<?php echo esc_url($closing_cta['url']); ?>" target="<?php echo esc_attr($closing_cta['target'] ? $closing_cta['target'] : '_self'); ?>"><?php echo $closing_cta['title']; ?></a>
    <?php endif; 
    if($closing_copy): ?>
      <?php the_field('closing_copy'); ?>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?>

</main><!-- #main -->

<?php

dynamic_sidebar('broadstreet-prestitial'); 

get_footer();
