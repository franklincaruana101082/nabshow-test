<?php

/*
 * Template Name: NABShow Hybrid Schedule
 */

  get_header('nabshow');


/* 

* page_title (String, required, can use existing page title field in Wordpress)
* featured_sessions (Relationship - three MYSSessions, if zero, don't display section)
* session_sections (Repeater)
** section_title (String, required)
** section_sessions (Relationship - zero or more MYSSessions)

*/

$nab_mys_urls         = get_option( 'nab_mys_urls' );
$show_code            = isset( $nab_mys_urls['show_code'] ) ? $nab_mys_urls['show_code'] : '';
$featured_sessions    = get_field( 'featured_sessions' );
$session_sections     = get_field( 'session_sections' );
$session_type_term    = get_term_by( 'slug', 'session-type', 'session-categories' );
$session_planner_url  = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/session-details.cfm?scheduleid=';
?>
<main id="primary" class="site-main">
  <div class="decorative _lightlines-strip"></div>

  <div class="section _bottom gradient__orange-orange-corners">
    <div class="container">
      <div class="section-heading _centered">
        <h1 class="h-xxl"><?php the_title(); ?></h1>        
      </div>
      <?php
      if ( $featured_sessions && is_array( $featured_sessions ) && count( $featured_sessions ) > 0 ) {
        ?>
        <div class="thumbcards-wrapper">
          <div class="thumbcards thumbcards--3">
            <?php
            foreach ( $featured_sessions as $featured_session ) {
              
              $event_type   = '';
              $start_time   = get_post_meta( $featured_session, 'starttime', true );
              $schedule_id  = get_post_meta( $featured_session, 'scheduleid', true );

              if ( ! empty( $session_type_term ) && ! is_wp_error( $session_type_term) ) {

                $session_types = wp_get_post_terms( $featured_session, 'session-categories', array(
                  'taxonomy'  => 'session-categories',
                  'parent'    => $session_type_term->term_id,
                ));

                if ( ! empty( $session_types ) && ! is_wp_error( $session_types ) ) {
                  $event_type = wp_list_pluck( $session_types, 'name' );
                  $event_type = implode( ', ', $event_type );
                }
              }
              ?>
              <div class="thumbcard">
                <div class="thumbcard__body">
                  <h4 class="thumbcard__datetime"><?php echo esc_html( date_format( date_create( $start_time ), 'F jS - gA' ) . ' EST' ); ?></h4>
                  <h3 class="thumbcard__title"><?php echo esc_html( get_the_title( $featured_session ) ); ?></h3>
                  <h4 class="thumbcard__category"><?php echo esc_html( $event_type ); ?></h4>
                  <a href="<?php echo esc_url( $session_planner_url . $schedule_id ); ?>" class="thumbcard__cta">+ Add To My Schedule</a>
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
    </div>
  </div>

  <?php
  if ( $session_sections ) {
    ?>
    <div class="section _bottom gradient__purple-blue-slant">
      <div class="container">
        <?php
        foreach ( $session_sections as $session_section ) {
          
          $section_title    = $session_section['section_title'];
          $section_sessions = $session_section['section_sessions'];

          if ( $section_sessions && is_array( $section_sessions ) && count( $section_sessions ) > 0 ) {
            ?>
            <div class="section-heading _with-cta">
              <h2 class="h-xl"><?php echo esc_html( $section_title ); ?></h2>
            </div>
            <div class="thumbcards-wrapper">
              <div class="thumbcards thumbcards--4">
                <?php
                foreach ( $section_sessions as $section_session ) {
                  
                  $event_type   = '';
                  $start_time   = get_post_meta( $section_session, 'starttime', true );
                  $schedule_id  = get_post_meta( $section_session, 'scheduleid', true );

                  if ( ! empty( $session_type_term ) && ! is_wp_error( $session_type_term) ) {

                    $session_types = wp_get_post_terms( $section_session, 'session-categories', array(
                      'taxonomy'  => 'session-categories',
                      'parent'    => $session_type_term->term_id,
                    ));

                    if ( ! empty( $session_types ) && ! is_wp_error( $session_types ) ) {
                      $event_type = wp_list_pluck( $session_types, 'name' );
                      $event_type = implode( ', ', $event_type );
                    }
                  }
                  ?>
                  <div class="thumbcard">
                    <div class="thumbcard__body">
                      <h4 class="thumbcard__datetime"><?php echo esc_html( date_format( date_create( $start_time ), 'F jS - gA' ) . ' EST' ); ?></h4>
                      <h3 class="thumbcard__title"><?php echo esc_html( get_the_title( $section_session ) ); ?></h3>
                      <h4 class="thumbcard__category"><?php echo esc_html( $event_type ); ?></h4>
                      <a href="<?php echo esc_url( $session_planner_url . $schedule_id ); ?>" class="thumbcard__cta">+ Add To My Schedule</a>
                    </div>
                  </div>
                  <?php
                }
                ?>
              </div>
            </div>
            <?php
          }
        }
        ?>
      </div>
    </div>
    <?php
  }
  ?>

</main><!-- #main -->

<?php get_footer('nabshow');
