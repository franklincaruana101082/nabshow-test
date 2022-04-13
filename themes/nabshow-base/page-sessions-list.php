<?php
/**
 * Template Name: Sessions List
 */

get_header();

global $wp_query;

$current_page	= filter_input( INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT );
$current_page	= isset( $current_page ) && ! empty( $current_page ) ? $current_page : 1;
$total_pages    = $wp_query->max_num_pages;
               
$session_args = array(
    'post_type'      => 'sessions',
    'posts_per_page' => -1,
    'fields'         => 'ids',
);

$session_query      = new WP_Query( $session_args );
$all_session_id     = $session_query->posts;

wp_reset_postdata();

$speaker_ids    = '';
$session_dates  = array();

if ( is_array( $all_session_id ) && count( $all_session_id ) > 0 ) {

    foreach ( $all_session_id as $current_session_id ) {

        $speaker_post_id        = get_post_meta( $current_session_id, 'speakers', true );
        $current_session_date   = get_post_meta( $current_session_id, 'date', true );

        if ( ! empty( $current_session_date ) ) {
            $session_dates[] = $current_session_date;
        }

        if ( ! empty( $speaker_post_id ) ) {

            if ( empty( $speaker_ids ) ) {
                $speaker_ids = $speaker_post_id;
            } else {
                $speaker_ids .= ',' . $speaker_post_id;
            }
        }
    }

    $speaker_ids    = trim( $speaker_ids, ',' );
    $speaker_ids    = explode( ',', $speaker_ids );
    $speaker_ids    = array_unique( $speaker_ids );
    $session_dates  = array_unique( $session_dates );
}
?>
    <div class="decorative _lightlines-strip"></div>

    <div class="container">
        <?php dynamic_sidebar('broadstreet-internal-top'); ?>
    </div>

    <div class="section decorative _lightlines-top-left-angle">
        <div class="container">

            <div class="filter-wrap-main">
                <div class="filter-row">
                    <div class="filter-column">
                        <div class="filter-column-sticky">
                            <h2 class="filter-title">Filter <span>by date or category</span></h2>
                            <div class="filter-settings-wrap">
                                <div class="filter-item-dates">
                                    <?php
                                    if ( is_array( $session_dates ) && count( $session_dates ) > 0 ) {

                                        usort( $session_dates, 'nabshow_lv_2021_date_sort' );
                                        $query_date = filter_input( INPUT_GET, 'date', FILTER_SANITIZE_STRING );  
                                        foreach ( $session_dates as $session_date ) {
                                            
                                            $session_month  = date( 'M', strtotime( $session_date ) );
                                            $session_day    = date( 'j', strtotime( $session_date ) );
                                            $date_class     = isset( $query_date ) && $query_date === $session_date ? 'filter-date active' : 'filter-date';
                                            ?>
                                            <button class="<?php echo esc_attr( $date_class ); ?>" data-date="<?php echo esc_attr( $session_date ); ?>">
                                                <?php echo esc_html( $session_month ); ?>
                                                <strong><?php echo esc_html( $session_day ); ?></strong>
                                            </button>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- .filter-item-dates -->
                                <div class="filter-item-dropdowns">

                                    <?php
                                    $fitler_programs = get_terms( array(
                                            'taxonomy' => 'tracks'
                                        )
                                    );

                                    if ( ! empty( $fitler_programs ) && ! is_wp_error( $fitler_programs ) ){
                                        
                                        $query_program = filter_input( INPUT_GET, 'program', FILTER_SANITIZE_STRING );
                                        ?>
                                        <div class="filter-dropdown">
                                            <select class="filter-program">
                                                <option value="">Program/Conference</option>
                                                <?php
                                                foreach ( $fitler_programs as $current_program ) {
                                                    ?>
                                                    <option value="<?php echo esc_attr( $current_program->term_id ); ?>" <?php selected( $query_program, $current_program->term_id ); ?>><?php echo esc_html( $current_program->name ); ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <?php
                                    }

                                    $registration_pass_term = get_term_by( 'slug', 'registration-pass', 'session-categories' );
                                    
                                    if ( ! empty( $registration_pass_term ) && ! is_wp_error( $registration_pass_term ) ) {
                                        
                                        $registration_passes = get_terms( array(
                                                'taxonomy'  => 'session-categories',
                                                'parent'    => $registration_pass_term->term_id,
                                            )
                                        );

                                        if ( ! empty( $registration_passes ) && ! is_wp_error( $registration_passes ) ) {
                                            
                                            $query_registration_pass = filter_input( INPUT_GET, 'registration_pass', FILTER_SANITIZE_STRING );
                                            ?>
                                            <div class="filter-dropdown">
                                                <select class="filter-registration-pass">
                                                    <option value="">Registration Pass</option>
                                                    <?php
                                                    foreach ( $registration_passes as $pass ) {
                                                        ?>
                                                        <option value="<?php echo esc_attr( $pass->term_id ); ?>" <?php selected( $query_registration_pass, $pass->term_id ); ?>><?php echo esc_html( $pass->name ); ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <?php
                                        }
                                    }

                                    $topic_term = get_term_by( 'slug', 'hot-topics', 'session-categories' );
                                    
                                    if ( ! empty( $topic_term ) && ! is_wp_error( $topic_term ) ) {
                                        
                                        $topics = get_terms( array(
                                                'taxonomy'  => 'session-categories',
                                                'parent'    => $topic_term->term_id,
                                            )
                                        );

                                        if ( ! empty( $topics ) && ! is_wp_error( $topics ) ) {
                                            
                                            $query_topic = filter_input( INPUT_GET, 'topic', FILTER_SANITIZE_STRING );
                                            ?>
                                            <div class="filter-dropdown">
                                                <select class="filter-topic">
                                                    <option value="">Topic</option>
                                                    <?php
                                                    foreach ( $topics as $topic ) {
                                                        ?>
                                                        <option value="<?php echo esc_attr( $topic->term_id ); ?>" <?php selected( $query_topic, $topic->term_id ); ?>><?php echo esc_html( $topic->name ); ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <?php
                                        }
                                    }

                                    $education_term = get_term_by( 'slug', 'education-partner', 'session-categories' );
                                    
                                    if ( ! empty( $education_term ) && ! is_wp_error( $education_term ) ) {
                                        
                                        $education_partners = get_terms( array(
                                                'taxonomy'  => 'session-categories',
                                                'parent'    => $education_term->term_id,
                                            )
                                        );

                                        if ( ! empty( $education_partners ) && ! is_wp_error( $education_partners ) ) {
                                            
                                            $query_education_partner = filter_input( INPUT_GET, 'education_partner', FILTER_SANITIZE_STRING );
                                            ?>
                                            <div class="filter-dropdown">
                                                <select class="filter-education-partner">
                                                    <option value="">Education Partner</option>
                                                    <?php
                                                    foreach ( $education_partners as $partner ) {
                                                        ?>
                                                        <option value="<?php echo esc_attr( $partner->term_id ); ?>" <?php selected( $query_education_partner, $partner->term_id ); ?>><?php echo esc_html( $partner->name ); ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <?php
                                        }
                                    }

                                    $session_type_term = get_term_by( 'slug', 'session-type', 'session-categories' );
                                    
                                    if ( ! empty( $session_type_term ) && ! is_wp_error( $session_type_term ) ) {
                                        
                                        $session_types = get_terms( array(
                                                'taxonomy'  => 'session-categories',
                                                'parent'    => $session_type_term->term_id,
                                            )
                                        );

                                        if ( ! empty( $session_types ) && ! is_wp_error( $session_types ) ) {
                                            
                                            $query_session_type = filter_input( INPUT_GET, 'session_type', FILTER_SANITIZE_STRING );
                                            ?>
                                            <div class="filter-dropdown">
                                                <select class="filter-session-type">
                                                    <option value="">Session Type</option>
                                                    <?php
                                                    foreach ( $session_types as $session_type ) {
                                                        ?>
                                                        <option value="<?php echo esc_attr( $session_type->term_id ); ?>" <?php selected( $query_session_type, $session_type->term_id ); ?>><?php echo esc_html( $session_type->name ); ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <?php
                                        }
                                    }
                                    $experience_level_term = get_term_by( 'slug', 'experience-level', 'session-categories' );
                                    
                                    if ( ! empty( $experience_level_term ) && ! is_wp_error( $experience_level_term ) ) {
                                        
                                        $experience_levels = get_terms( array(
                                                'taxonomy'  => 'session-categories',
                                                'parent'    => $experience_level_term->term_id,
                                            )
                                        );

                                        if ( ! empty( $experience_levels ) && ! is_wp_error( $experience_levels ) ) {
                                            
                                            $query_experience_level = filter_input( INPUT_GET, 'experience_level', FILTER_SANITIZE_STRING );
                                            ?>
                                            <div class="filter-dropdown">
                                                <select class="filter-experience-level">
                                                    <option value="">Experience Level</option>
                                                    <?php
                                                    foreach ( $experience_levels as $experience_level ) {
                                                        ?>
                                                        <option value="<?php echo esc_attr( $experience_level->term_id ); ?>" <?php selected( $query_experience_level, $experience_level->term_id ); ?>><?php echo esc_html( $experience_level->name ); ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <?php
                                        }
                                    }

                                    if ( is_array( $speaker_ids ) && count( $speaker_ids ) > 0 ) {

                                        $speaker_args = array(
                                            'post_type'         => 'speakers',
                                            'posts_per_page'    => -1,
                                            'orderby'           => 'title',
                                            'order'             => 'ASC',
                                            'post__in'          => $speaker_ids,
                                            'fields'            => 'ids',
                                        );

                                        $speaker_query  = new WP_Query( $speaker_args );
                                        $speaker_ids    = is_array( $speaker_query->posts ) && count( $speaker_query->posts ) > 0 ? $speaker_query->posts : $speaker_ids;

                                        wp_reset_postdata();

                                        $query_speaker = filter_input( INPUT_GET, 'speaker', FILTER_SANITIZE_STRING );
                                        ?>
                                        <div class="filter-dropdown">
                                            <select class="filter-speaker-name">
                                                <option value="">Speaker Name</option>
                                                <?php
                                                foreach ( $speaker_ids as $current_speaker_id ) {
                                                    ?>
                                                    <option value="<?php echo esc_attr( $current_speaker_id ); ?>" <?php selected( $query_speaker, $current_speaker_id ); ?>><?php echo esc_html( str_replace( ',', '', get_the_title( $current_speaker_id ) ) ); ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <?php
                                    }
                                    
                                    $locations = get_terms( array(
                                            'taxonomy' => 'session-locations'
                                        )
                                    );

                                    if ( ! empty( $locations ) && ! is_wp_error( $locations ) ){
                                        
                                        $query_location = filter_input( INPUT_GET, 'location', FILTER_SANITIZE_STRING );
                                        ?>
                                        <div class="filter-dropdown">
                                            <select class="filter-location">
                                                <option value="">Location</option>
                                                <?php
                                                foreach ( $locations as $current_location ) {
                                                    ?>
                                                    <option value="<?php echo esc_attr( $current_location->term_id ); ?>" <?php selected( $query_location, $current_location->term_id ); ?>><?php echo esc_html( $current_location->name ); ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <!-- .filter-item-dropdowns -->
                            </div>
                        </div>
                    </div>
                    <!-- .filter-column -->
                    <div class="filter-column" id="mys-session-list">
                        <h2 class="filter-title">Results</h2>
                        <div class="filter-result-wrap">
                            <?php
                            if ( have_posts() ) {

                                $nab_mys_urls           = get_option( 'nab_mys_urls' );
                                $show_code              = isset( $nab_mys_urls['show_code'] ) ? $nab_mys_urls['show_code'] : '';
                                $session_planner_url    = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/session-details.cfm?scheduleid=';
                                $speaker_planner_url    = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/speaker-details.cfm?speakerid=';
                                $location_url           = 'https://' . $show_code . '.mapyourshow.com/8_0/floorplan/';
                                $program_planner_url    = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/#/searchtype/sessiontrack/search/';

                                while ( have_posts() ) {

                                    the_post();

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
                                        <div class="filter-result-box-datetime">
                                            <?php echo esc_html( date_format( date_create( $date ), 'F j, Y' ) ); ?> <?php echo esc_html( $start_time ); ?> - <?php echo esc_html( $end_time ); ?>
                                            <?php
                                            if ( ! empty( $location ) ) {
                                                ?>
                                                <a href="<?php echo esc_url( $location_url ); ?>" target="_blank"><?php echo esc_html( $location ); ?></a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <!-- END datetime -->

                                        <!-- title -->
                                        <h2 class="filter-result-box-title"><a href="<?php echo esc_url( $session_planner_url . $schedule_id ); ?>" target="_blank"><?php the_title(); ?></a></h2>
                                        <!-- END title -->

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
                                        
                                        <!-- description -->
                                        <div class="filter-result-box-description">
                                            <p><?php the_excerpt(); ?></p>
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
                            }
                            ?>
                        </div>
                        <!-- .filter-result-wrap -->
                        <div class="filter-pagination">
                            <?php
                            if ( $total_pages > 1 ) {
                                
                                $allowed_tags = [
                                    'span' => [
                                        'class' => [],
                                    ],
                                    'i'    => [
                                        'class' => [],
                                    ],
                                    'a'    => [
                                        'class' => [],
                                        'href'  => [],
                                    ],
                                ];
            
                                echo wp_kses( paginate_links( array(
                                    'base'      => '#%#%',
                                    'current'   => $current_page,
                                    'total'     => $total_pages,
                                    'add_args'  => false,
                                    'prev_text' => __( 'Previous' ),
                                    'next_text' => __( 'Next' ),
                                ) ), $allowed_tags );

                            }
                            ?>
                        </div>
                        <?php dynamic_sidebar('broadstreet-ros-bottom'); ?>
                    </div>
                    <!-- .filter-column -->
                </div>
            </div>
            <!-- .filter-wrap-main -->
        </div>
    </div>

    <div class="decorative _lightlines-footer-strip"></div>
<?php
get_footer();
