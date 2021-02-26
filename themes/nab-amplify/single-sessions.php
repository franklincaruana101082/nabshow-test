<?php
/**
 * The template for displaying all single sessions
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Amplify
 */

get_header();
?>

	<main id="primary" class="site-main single_php">
        
		<?php
		while ( have_posts() ) :
			the_post();

			?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php
                    the_title( '<h1 class="entry-title">', '</h1>' );
                    ?>
                </header><!-- .entry-header -->    

                <div class="entry-content">        
                    <?php                    
                    $speakers                   = get_field( 'speakers' );
                    $company                    = get_field( 'company' );
                    $session_status             = get_field( 'session_status' );
                    $pre_event_registration_id  = get_field( 'pre_event_registration_id' );
                    $pre_event_survey_id        = get_field( 'pre_event_survey_id' );
                    $live_event_survey_id       = get_field( 'live_event_survey_id' );
                    $post_event_survey_id       = get_field( 'post_event_survey_id' );
                    $chat_room_id               = get_field( 'chat_room_id' );
                    $video_embed                = get_field( 'video_embed' );
                    ?>
                    <div class="session-item">                        
                        <?php
                        // list session speaker
                        if ( ! empty( $speakers ) && is_array( $speakers ) && count( $speakers ) > 0 ) {
                            ?>
                            <div class="speaker-details">
                                <?php
                                // loop throught the speakers.
                                foreach ( $speakers as $speaker_id ) {
                                    
                                    $first_name         = get_field( 'first_name', $speaker_id );
                                    $last_name          = get_field( 'last_name', $speaker_id );
                                    $title              = get_field( 'title', $speaker_id );
                                    $speaker_company    = get_field( 'company', $speaker_id );
                                    $headshot           = get_field( 'headshot', $speaker_id );
                                    $amplify_user       = get_field( 'amplify_user', $speaker_id );
                                    $user_profile_url   = '';
                                    
                                    if ( ! empty( $amplify_user ) ) {
                                        $user_profile_url = bp_core_get_user_domain( $amplify_user );
                                    }
                                    ?>
                                    <div class="seaker-item">
                                        <?php
                                        if ( ! empty( $headshot ) ) {
                                            
                                            ?>
                                            <div class="speaker-headshot">
                                                <?php
                                                if ( ! empty( $user_profile_url ) ) {
                                                    ?>                                            
                                                    <a href="<?php echo esc_url( $user_profile_url ); ?>">
                                                        <img src="<?php echo esc_url( $headshot['url'] ); ?>" alt="<?php echo esc_attr( $headshot['alt'] ); ?>" />
                                                    </a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="<?php echo esc_url( $headshot['url'] ); ?>" alt="<?php echo esc_attr( $headshot['alt'] ); ?>" />
                                                    <?php
                                                }
                                                ?>
                                            </div>                                        
                                            <?php
                                        }
                                        ?>
                                        <div class="speaker-info">
                                            <h3 class="speaker-name">
                                                <?php
                                                if ( ! empty( $user_profile_url ) ) {
                                                    ?>                                            
                                                    <a href="<?php echo esc_url( $user_profile_url ); ?>"><?php echo esc_html( $first_name . ' ' . $last_name ); ?></a>
                                                    <?php
                                                } else {
                                                    echo esc_html( $first_name . ' ' . $last_name );
                                                }
                                                ?>
                                            </h3>
                                            <span class="speaker-company"><?php echo esc_html( $speaker_company ); ?></span>
                                            <span class="speaker-title"><?php echo esc_html( $title ); ?></span>                                        
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="session-info">
                            <?php
                            if ( ! empty( $company ) ) {
                                ?>
                                <p class="session-company"><?php echo esc_html( get_the_title( $company ) ); ?></p>
                                <?php
                            }
                            ?>
                            <p class="session-status"><?php echo esc_html( $session_status ); ?></p>                                                                    
                            <p class="pre-event-registration-id"><?php echo esc_html( $pre_event_registration_id ); ?></p>                        
                            <p class="pre-event-survey-id"><?php echo esc_html( $pre_event_survey_id ); ?></p>                                                
                            <p class="live-event-survey-id"><?php echo esc_html( $live_event_survey_id ); ?></p>
                            <p class="live-event-survey-id"><?php echo esc_html( $live_event_survey_id ); ?></p>
                            <p class="post-event-survey-id"><?php echo esc_html( $post_event_survey_id ); ?></p>
                            <p class="chat-room-id"><?php echo esc_html( $chat_room_id ); ?></p>
                            <div class="session-video-embed">
                                <?php echo $video_embed; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    the_content(
                        sprintf(
                            wp_kses(
                                /* translators: %s: Name of current post. Only visible to screen readers */
                                __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'nab-amplify' ),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            wp_kses_post( get_the_title() )
                        )
                    );

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nab-amplify' ),
                            'after'  => '</div>',
                        )
                    );
                    ?>		
                </div><!-- .entry-content -->
            </article><!-- #post-<?php the_ID(); ?> -->
            <?php		

		endwhile; // End of the loop.
		?>        
	</main><!-- #main -->
<?php
get_footer();
