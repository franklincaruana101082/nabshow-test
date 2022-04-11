<?php
/**
 * Template Name: Home Page 2022
 * Description: Home page template design update
 *
 */

get_header();

$hero     = get_field('banner_background_image');
$video    = get_field('banner_background_video_embed');
$headline = get_field('banner_headline');
$logo     = get_field('banner_logo_image');
$cta1     = get_field('banner_main_cta');
$cta2     = get_field('banner_secondary_cta');

if($video) {
  $aspect_height = (100 * ($video['height'] / $video['width']));
  $aspect_width  = (100 * ($video['width'] / $video['height']));
}

?>

<main id="main" class="new">
  <div class="hero-banner <?php echo($video ? esc_attr('_video') : '" style="background-image: url('.esc_url($hero).');'); ?>" >
    <div class="showinfo <?php echo esc_attr($headline ? '_headline' : ''); ?>">
      <?php if($headline) { ?>
        <h1 class="showinfo__headline"><?php echo esc_html($headline); ?></h1>
      <?php } ?>
      <?php if(get_field('banner_date') || get_field('banner_location')) { ?>
      <div class="showinfo__when">
        <?php the_field('banner_date'); ?>
        <?php if(get_field('banner_date') && get_field('banner_location')) { ?> | <?php } ?>
        <?php the_field('banner_location'); ?>
      </div>
      <?php } ?>
      <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" class="showinfo__logo" width="<?php echo( $logo['width'] ); ?>"height="<?php echo( $logo['height'] ); ?>" />
      <?php if( !empty($cta1) ): ?>
      <div class="showinfo__cta">
        <a href="<?php echo esc_url( $cta1['url'] ); ?>" class="button" target="<?php echo esc_attr( $cta1['target'] ); ?>"><?php echo( $cta1['title'] ); ?></a>
      </div>
      <?php endif; ?>
    </div>
    <?php if($video): ?>
      <div class="hero-banner__video">
        <video muted loop autoplay 
          style="
            width: <?php echo esc_attr($aspect_width); ?>vh;
            height:  100%;
            min-width: 100%;
            min-height: <?php echo esc_attr($aspect_height); ?>vw;
        ">
          <source 
            src="<?php echo esc_url($video['url']); ?>" 
            type="<?php echo esc_attr($video['mime_type']); ?>"
          >
        </video>
      </div>
    <?php endif; ?>
  </div>
  <div class="home__lighting1">
<?php

$quick_links          = get_field( 'quick_links' );
$testimonials         = get_field( 'testimonials' );
$attending_companies  = get_field( 'attending_companies' );
$exhibitor_companies  = get_field( 'exhibitor_companies' );
$display_safety       = get_field( 'display_safety' );
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
          <a class="story__button button" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ? $link['target'] : '_self'); ?>"><?php echo $link['title']; ?></a>
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
