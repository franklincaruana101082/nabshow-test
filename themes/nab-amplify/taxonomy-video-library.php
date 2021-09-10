<?php

/*
 * Template for displaying video library category post.
 */

  get_header('hybrid');

  /* 

ARCHIVE PAGE for showvideo category

*/

?>

<main id="primary" class="site-main">

  <div class="decorative _lightlines-strip"></div>

  <div class="section _bottom gradient__orange-orange-corners">
    <div class="container">
      <div class="section-heading _centered">
        <h1 class="h-xxl"><?php single_term_title(); ?></h1>        
      </div>      
    </div>
  </div>
  <?php
  if ( have_posts() ) {
    ?>
    <div class="section container">
      <div class="teasers-grid">
        <?php
        while ( have_posts() ) {
          
          the_post();

          $video_category = get_the_terms( get_the_ID(), 'video-library' );
          $link           = get_field( 'link' );
          ?>
          <div class="teaser">
            <div class="teaser__media">
              <div class="video-embed">
                <?php the_field( 'embed_code' ); ?>
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
                <p><?php the_title(); ?></p>
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


  <div class="decorative _lightlines-footer-strip"></div>

</main><!-- #main -->

<?php get_footer('hybrid');
