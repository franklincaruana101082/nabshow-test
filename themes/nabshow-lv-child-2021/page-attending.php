<?php
/**
 * Template Name: Attending Page
 * Description: Attending page template
 *
 */

get_header();

$page_subtitle  = get_field( 'page_subtitle' );
$attendee_imgs  = get_field( 'attendee_images' );
$attendee_names = get_field( 'attendee_names' );
?>

<main id="main">
  <div class="intro _lightlines-strip">
    <div class="container intro__container">
      <h1 class="intro__label"><?php the_title(); ?></h1>
      <h2 class="intro__title"><?php echo esc_html( $page_subtitle ); ?></h2>
      <div class="intro__body"><?php the_content(); ?></div>
    </div>
  </div>

  <?php
  if ( $attendee_imgs ) {
    
    ?>
    <div class="section _bottom container _wide">
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
            ?>
            <li><b class="attending-list-item-name"><?php echo esc_html( $row['name'] ); ?></b></li>
            <?php
          }
          ?>          
        </ul>
      </div>
    </div>
    <?php
  }
  ?>  
  
</main><!-- #main -->


<?php
get_footer('maintenance');
