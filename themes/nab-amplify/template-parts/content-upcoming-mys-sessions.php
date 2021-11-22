<?php

$current_date           = date( 'Y-m-d H:i:s', current_time( 'timestamp' ) );
$upcoming_session_args  = array(
  'post_type'       => 'mys-sessions',
  'posts_per_page'  => 3,
  'post_status'     => 'publish',
  'meta_key'        => 'starttime',
  'orderby'         => 'meta_value',
  'order'           => 'ASC',
  'meta_query'      => array(
    'key'     => 'starttime',
    'value'   => $current_date,
    'compare' => '>=',
    'type'    => 'DATE',
  )
);

$query_result = new WP_Query( $upcoming_session_args );

if ( $query_result->have_posts() ) {

  $session_type_term    = get_term_by( 'slug', 'session-type', 'session-categories' );
  $nab_mys_urls         = get_option( 'nab_mys_urls' );
  $show_code            = isset( $nab_mys_urls['show_code'] ) ? $nab_mys_urls['show_code'] : '';
  $session_planner_url  = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/session-details.cfm?scheduleid=';
  ?>
  <div class="section _bottom">
    <div class="container">
      <div class="section-heading _centered">
        <h2 class="h-xl">Upcoming Events</h2>
      </div>
      <div class="thumbcards-wrapper">
        <div class="thumbcards thumbcards--3">
          <?php
          while ( $query_result->have_posts() ) {

            $query_result->the_post();

            $session_post_id  = get_the_ID();
            $event_type       = '';
            $start_time       = get_post_meta( $session_post_id, 'starttime', true );
            $schedule_id      = get_post_meta( $session_post_id, 'scheduleid', true );

            if ( ! empty( $session_type_term ) && ! is_wp_error( $session_type_term) ) {

              $session_types = wp_get_post_terms( $session_post_id, 'session-categories', array(
                'taxonomy'  => 'session-categories',
                'parent'    => $session_type_term->term_id,
              ));

              if ( ! empty( $session_types ) && ! is_wp_error( $session_types ) ) {
                $event_type = wp_list_pluck( $session_types, 'name' );
                $event_type = implode( ',', $event_type );
              }
            }
            ?>
            <div class="thumbcard">
              <div class="thumbcard__body">
                <h4 class="thumbcard__datetime"><?php echo esc_html( date_format( date_create( $start_time ), 'F jS - gA' ) . ' EST' ); ?></h4>
                <h3 class="thumbcard__title"><?php the_title(); ?></h3>
                <h4 class="thumbcard__category"><?php echo esc_html( $event_type ); ?></h4>
                <a href="<?php echo esc_url( $session_planner_url . $schedule_id ); ?>" class="thumbcard__cta">+ Add To My Schedule</a>
              </div>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
wp_reset_postdata();