<?php
/**
 * Template Name: Attending Page
 * Description: Attending page template
 *
 */

get_header();

$page_title  = get_field( 'page_title' );
$page_subtitle  = get_field( 'page_subtitle' );
?>

<main id="main">
  <div class="intro _lightlines-strip">
    <div class="container intro__container">
      <h1 class="intro__label"><?php echo esc_html( $page_title ); ?></h1>
      <h2 class="intro__title"><?php echo esc_html( $page_subtitle ); ?></h2>
      <div class="intro__body"><?php the_content(); ?></div>
    </div>
  </div>
  <?php
  $quick_links = get_field( 'quick_links' );

  if ( is_array( $quick_links ) && count( $quick_links ) > 0 ) {
    ?>
    <div class="section container">
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
  ?>

  <?php
  
  if( have_rows('attendees') ):
  ?>
  
  <div class="section container _wide">
    <?php
    if( get_field( 'attendees_title' ) ) {
    ?>
    <h2 class="attending-title"><?php the_field( 'attendees_title' ); ?></h2>
    <?php } ?>
    <ul class="attending-list">
    <?php
    // Loop through rows.
    while( have_rows('attendees') ) : the_row();
        ?>
        <li class="attending-item">
          <div class="attending-list-item-id">
            <h4 class="attending-list-item-name"><?php the_sub_field('name'); ?></h4>
            <div class="attending-list-item-title"><?php the_sub_field('title'); ?></div>
            <div class="attending-list-item-company"><?php the_sub_field('company_name'); ?></div>
          </div>
          <div class="attending-list-item-copy"><?php the_sub_field('copy'); ?></div>
        </li>
        <?php
    // End loop.
    endwhile;
    ?>
    </ul>
  </div>
  
    <?php
  endif;
  ?>  
  <?php if(is_active_sidebar('broadstreet-ros-middle')) { ?>
  <div class="container">
    <?php dynamic_sidebar('broadstreet-ros-bottom'); ?>
  </div>
  <?php }
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
get_footer();


