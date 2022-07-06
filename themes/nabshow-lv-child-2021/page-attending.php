<?php
/**
 * Template Name: Attending Page
 * Description: Attending page template
 *
 */

get_header();

$page_title  = get_field( 'page_title' );
$page_subtitle  = get_field( 'page_subtitle' );
$attendee_imgs  = get_field( 'attendee_images' );
$attendee_names = get_field( 'attendee_names' );
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
  if ( $attendee_imgs ) {
    
    ?>
    <div class="section _bottom container">
      <div class="logo-group">
        <?php
        foreach ( $attendee_imgs as $row ) {
          $logo_name = $row['name'];
          $logo = $row['image']['ID'];
          if ( isset( $logo ) && !empty( $logo ) ):
          ?>
          <img src="<?php echo esc_url( wp_get_attachment_url( $logo ) ); ?>" alt="<?php echo esc_attr( $logo_name ); ?>" />                    
          <?php
          endif;
        }
        ?>             
      </div>
    </div>
    <?php
  }

  if ( $attendee_names ) {
    ?>
    <div class="section attending-list-wrapper">
      <div class="container _wide">
        <ul class="attending-list">
          <?php
          foreach ( $attendee_names as $row ) {
            if( $row['name'] ):
            ?>
            <li><b class="attending-list-item-name"><?php echo esc_html( $row['name'] ); ?></b></li>
            <?php
            endif;
          }
          ?>          
        </ul>
      </div>
    </div>
    <?php
  }
  ?>  
  
</main><!-- #main -->

<div class="container">
  <?php dynamic_sidebar('broadstreet-ros-bottom'); ?>
</div>

<?php
get_footer();
