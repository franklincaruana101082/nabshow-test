<?php
/**
 * The template for displaying single session
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package NABShow_LV
 */
get_header();
?>
    <div id="primary" class="container">
        <div class="session-detail-page">
            <?php
            while ( have_posts() ) {
                the_post();

                $nab_mys_urls           = get_option( 'nab_mys_urls' );
                $show_code              = isset( $nab_mys_urls['show_code'] ) ? $nab_mys_urls['show_code'] : '';
                $session_planner_url    = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/session-details.cfm?scheduleid=';
                $speaker_planner_url    = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/speaker-details.cfm?speakerid=';
                $location_url           = 'https://' . $show_code . '.mapyourshow.com/8_0/floorplan/';
                $program_planner_url    = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/#/searchtype/sessiontrack/search/';

                $session_id     = get_the_ID();
                $date           = get_post_meta( $session_id, 'date', true );
                $start_time     = get_post_meta( $session_id, 'starttime', true );
                $end_time       = get_post_meta( $session_id, 'endtime', true );
                $schedule_id    = get_post_meta( $session_id, 'scheduleid', true );
                $program        = get_the_terms( $session_id, 'tracks' );
                $location_term  = get_the_terms( $session_id, 'session-locations' );
                $program_name   = '';
                $location       = '';

                if ( $program && ! is_wp_error( $program ) ) {
                    $all_programs   = wp_list_pluck( $program, 'name' );
                    $program_name   = isset( $all_programs[0] ) ? $all_programs[0] : '';
                }

                if ( $location_term && ! is_wp_error( $location_term ) ) {
                    $all_location   = wp_list_pluck( $location_term, 'name' );
                    $location       = isset( $all_location[0] ) ? $all_location[0] : '';
                }

                if ( ! empty( $start_time ) ) {
                    $start_time = str_replace( array( 'am','pm' ), array( 'a.m.','p.m.' ), date_format( date_create( $start_time ), 'g:i a' ) );
                    $start_time = str_replace(':00', '', $start_time );
                }
                if ( ! empty( $end_time ) ) {
                    $end_time   = str_replace( array( 'am','pm' ), array( 'a.m.','p.m.' ), date_format( date_create( $end_time ), 'g:i a' ) );
                    $end_time   = str_replace(':00', '', $end_time );
                }
                ?>

                <div class="filter-result-box">
                    <!-- datetime -->
                    <div class="filter-result-box-datetime"><?php echo esc_html( date_format( date_create( $date ), 'F j, Y' ) ); ?></span> <?php echo esc_html( $start_time ); ?> - <?php echo esc_html( $end_time ); ?></span>
                        <?php
                        if ( ! empty( $location ) ) {
                            ?>
                            <a href="<?php echo esc_url( $location_url ); ?>" target="_blank"><?php echo esc_html( $location ); ?></a>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- END datetime -->

                    <!-- category -->
                    <?php
                    if ( ! empty( $program_name ) ) {
                        
                        $program_url = $program_planner_url . $program_name . '/show/all'; 
                        ?>
                        <span class="filter-result-box-category"><a href="<?php echo esc_url( $program_url ); ?>" target="_blank"><?php echo esc_html( $program_name ); ?></a></span>
                        <?php
                    }
                    ?>
                    <!-- END category -->	

                    <!-- title -->
                    <h1 class="filter-result-box-title"><a href="<?php echo esc_url( $session_planner_url . $schedule_id ); ?>" target="_blank"><?php the_title(); ?></a></h1>
                    <!-- END title -->                     

                    <!-- description -->
                    <div class="filter-result-box-description">
                        <?php the_content(); ?>
                    </div>
                    <!-- END description -->

                    <?php
                    $speakers       = get_post_meta( $session_id, 'speakers', true );
                    $speaker_ids    = explode( ',', $speakers );
                    $all_speakers   = array();

                    if ( ! empty( $speakers ) && count( $speaker_ids ) > 0 ) {
                        
                        foreach ( $speaker_ids as $speaker_id ) {
                            
                            $speaker_name   = get_the_title( $speaker_id );
                            $mys_speaker_id = get_post_meta( $speaker_id, 'speakerid', true );
                            $all_speakers[] = '<a href="' . $speaker_planner_url . $mys_speaker_id . '" target="_blank">' . str_replace( ',', '', $speaker_name ) . '</a>'; 
                        }
                        ?>
                        <div class="speakers-list">
                            <i>Featured Speakers:</i>
                            <?php echo wp_kses_post( implode( ', ', $all_speakers ) ); ?>
                        </div>
                        <?php
                    }
                    ?>
                    <!-- cta -->
                    <a class="filter-result-box-cta" href="<?php echo esc_url( $session_planner_url . $schedule_id ); ?>" target="_blank">View in Planner</a>
                    <!-- END cta -->
                    
                </div>
                <?php
            }
            ?>
        </div>
    </div><!-- #primary -->
<?php
get_footer();