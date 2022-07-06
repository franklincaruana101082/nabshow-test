<?php
/**
 * Template part for displaying conference/destination/networking content 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NABShow_LV
 */

$location                       = get_field( 'location' );
$featured_video                 = get_field( 'featured_video' );
$start_date                     = get_field( 'start_date' );
$end_date                       = get_field( 'end_date' );
$partner_sponsors               = get_field( 'partner_sponsors' );
$sponsors                       = get_field( 'sponsors' );
$display_speakers_and_sessions  = get_field( 'display_speakers_and_sessions' );
$display_cta_block              = get_field( 'display_cta_block' );
$ad_code                        = get_field( 'ad_code' );
$display_mailing_list_block     = get_field( 'display_mailing_list_block' );
?>
<div class="intro _lightlines-strip">
    <div class="container intro__container">
        <h2 class="intro__label"><?php echo esc_html( $location ); ?></h2>
        <h1 class="intro__title"><?php the_title(); ?></h1>
    </div>
</div>

<?php
$quick_links          = get_field( 'quick_links' );

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

<?php if(is_active_sidebar('broadstreet-internal-top')) { ?>
<div class="section container">
    <?php dynamic_sidebar('broadstreet-internal-top'); ?>
</div>
<?php } ?>

<?php
if ( ! empty( $featured_video ) ) {
    ?>
    <div class="container">
        <div class="video-embed">
            <?php echo $featured_video; ?>
        </div>
    </div>
    <?php
}

?>

<div class="section container">
    <div class="conference__intro">
        <div class="conference__intro-partners">
            
            <?php
            if ( $partner_sponsors ) {
                ?>
                <h3>Produced in partnership with</h3>        
                <ul class="partners-icons">
                    <?php
                    foreach( $partner_sponsors as $row ) {
                        
                        $partner_sponsor_url    = isset( $row['url'] ) && ! empty( $row['url'] ) ? $row['url'] : 'javascript:void(0);';
                        $partner_sponsor_name   = $row['name'];
                        $partner_sponsor_logo   = isset( $row['logo']['ID'] ) && ! empty( $row['logo']['ID'] ) ? wp_get_attachment_url( $row['logo']['ID'] ) : '';

                        if ( ! empty( $partner_sponsor_logo ) ) {
                            ?>                        
                            <li><a href="<?php echo esc_attr( $partner_sponsor_url ); ?>" target="_blank"><img src="<?php echo esc_url( $partner_sponsor_logo ); ?>" alt="<?php echo esc_attr( $partner_sponsor_name ); ?>" /></a></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <?php
            }
            ?>        
        </div>
    </div>
</div>


<?php
if ( $sponsors ) {
    ?>
    <div class="section container">
        <div class="sponsors-icons">
            <?php    
            foreach ( $sponsors as $row ) {
                
                $sponsor_url    = isset( $row['url'] ) && ! empty( $row['url'] ) ? $row['url'] : 'javascript:void(0);';                
                $sponsor_logo   = isset( $row['logo']['ID'] ) && ! empty( $row['logo']['ID'] ) ? wp_get_attachment_url( $row['logo']['ID'] ) : '';
                $sponsor_name   = $row['name'];
                $sponsor_type   = $row['sponsor_type'];
                ?>                
                <a href="<?php echo esc_attr( $sponsor_url ); ?>" target="_blank" class="sponsor-icon">
                    <span class="sponsor-icon-label"><?php echo esc_html( $sponsor_type ); ?></span>                    
                    <img src="<?php echo esc_url( $sponsor_logo ); ?>" alt="<?php echo esc_attr( $sponsor_name ); ?>" />
                </a>
                <?php
            }
            ?>
            <div class="">
                <?php dynamic_sidebar('broadstreet-ros-middle-square'); ?>
            </div>
        </div>
    </div>
    <?php
}



if ( $display_speakers_and_sessions ) {
    $speakers_and_sessions_heading = get_field( 'speakers_and_sessions_heading' );
    $featured_speakers_and_sessions = get_field( 'featured_speakers_and_sessions' );

    $featured_speakers_and_sessions_amount = array();
    $fss_class = '';
    if(!empty($featured_speakers_and_sessions)){
        foreach( $featured_speakers_and_sessions as $i => $row ) {
            if(!$row['hide_this_item']):
                $featured_speakers_and_sessions_amount[$i] = $i;
            endif;
        }
    }

    if( !empty($featured_speakers_and_sessions_amount) ) {
        $fss_class = "featured_all";
    }
    ?>    
    <div class="section">        
            <div class="container">
                <div class="conference-sessions">
                    <h3 class="conference-sessions-title"><?php echo($speakers_and_sessions_heading); ?></h3>
                </div>
                <div class="conference-sessions-content <?php echo($fss_class); ?>">
                    <?php if ( !empty($featured_speakers_and_sessions_amount) ) { ?>
                    <div class="conference-sessions-speakers-sticky">
                    <div class="conference-sessions-speakers">
                        <?php
                        foreach ( $featured_speakers_and_sessions as $row ) {
                            
                            $speaker_image          = isset( $row['image']['ID'] ) && ! empty( $row['image']['ID'] ) ? wp_get_attachment_url( $row['image']['ID'] ) : '';
                            $speaker_description    = $row['description'];
                            $speaker_dates          = $row['dates'];
                            $speaker_name           = $row['name'];
                            $speaker_link_url = '';
                            if( $row['link'] ) :
                                $speaker_link_url       = $row['link']['url'];
                            endif;
                            if(!$row['hide_this_item']):
                            ?>                                
                            <div class="conference-sessions-speaker">
                                <?php if($speaker_link_url): ?>
                                    <a class="conference-sessions-speaker-link" href="<?php echo esc_url($speaker_link_url); ?>" target="_blank">
                                <?php else: ?>
                                    <div class="conference-sessions-speaker-link">
                                <?php endif; ?>
                                    <div class="conference-sessions-speaker-image-wrap">
                                        <img class="conference-sessions-speaker-image" src="<?php echo esc_url( $speaker_image ); ?>" />
                                    </div>
                                <?php // <h4 class="conference-sessions-speaker-label"> Speaker</h4> ?>
                                    <h5 class="conference-sessions-speaker-name"><?php echo esc_html( $speaker_name ); ?></h5>
                                <?php if($speaker_link_url): ?>
                                    </a>
                                <?php else: ?>
                                    </div>
                                <?php endif; ?>
                                <h6 class="conference-sessions-speaker-date"><?php echo esc_html( $speaker_dates ); ?></h6>
                                <div class="conference-sessions-speaker-body">                                        
                                    <p><?php echo esc_html( $speaker_description ); ?></p>
                                </div>
                                <div class="conference-sessions-speaker-progress"></div>
                            </div>                                
                            <?php
                            endif;
                        } ?>
                    </div>
                    </div>
                    <?php } 


                $session_tracks     = get_field( 'session_tracks' );
                $session_categories = get_field( 'session_categories' );
                $manual_sessions = get_field( 'manual_sessions' );

                if ( ( $session_tracks && count( $session_tracks ) > 0 ) || ( $session_categories && count( $session_categories ) > 0 ) || ( $manual_sessions && count( $manual_sessions ) > 0 ) ) {
                    
                    $session_query_args = array(
                        'post_type'      => 'sessions',
                        'posts_per_page' => 100,
                        'post_status'    => 'publish',
                        'meta_key'       => 'starttime',
                        'orderby'        => 'meta_value',
                        'order'          => 'ASC',
                    );

                    $tax_query_args = array( 'relation' => 'AND' );

                    if ( $session_tracks && count( $session_tracks ) > 0 ) {
                        $tax_query_args[] = array(
                            'taxonomy' => 'tracks',
                            'field'    => 'term_id',
                            'terms'    => $session_tracks,
                        );
                    }

                    if ( $session_categories && count( $session_categories ) > 0 ) {
                        $tax_query_args[] = array(
                            'taxonomy' => 'session-categories',
                            'field'    => 'term_id',
                            'terms'    => $session_categories,
                        );
                    }

                    $session_query_args['tax_query'] = $tax_query_args;

                    $session_query = new WP_Query( $session_query_args );

                    if ( $session_query->have_posts() || count( $manual_sessions ) > 0) {
                        ?>
                        <div class="conference-sessions-sessions">
                            <?php
                            while ( $session_query->have_posts() ) :
                                
                                $session_query->the_post();

                                $mys_session_id         = get_the_ID();
                                $session_schedule_id    = get_post_meta( $mys_session_id, 'scheduleid', true );
                                $mys_session_start_date = get_post_meta( $mys_session_id, 'starttime', true );
                                $mys_session_summary    = get_post_meta( $mys_session_id, 'summarysummary', true );
                                $formatted_session_date = '';

                                if ( ! empty( $mys_session_start_date ) ) {
                                    
                                    if ( false !== strpos( $mys_session_start_date, '-' ) ) {
                                        $formatted_session_date = date_format( date_create( $mys_session_start_date ), 'F j, Y g:i a' );
                                    } else {
                                        $dt                     = DateTime::createFromFormat( 'F, j Y H:i:s', $mys_session_start_date );
                                        $formatted_session_date = $dt->format( 'F j, Y g:i a' );
                                    }
                                }

                                $mys_session_link = 'https://nab22.mapyourshow.com/8_0/sessions/session-details.cfm?scheduleid=' . $session_schedule_id;
                                ?>
                                <a href="<?php echo esc_url( $mys_session_link );?>" target="_blank" class="conference-sessions-session _link">
                                    <p class="conference-sessions-session-title"><?php echo esc_html( get_the_title() ); ?></p>
                                    <h6 class="datetime-small icon-calendar"><?php echo esc_html( $formatted_session_date ); ?></h6>
                                    <div class="conference-sessions-session-desc"><p><?php echo esc_html( $mys_session_summary ); ?></p></div>
                                </a>
                                <?php

                                    $mys_session_link = 'https://nab22.mapyourshow.com/8_0/sessions/session-details.cfm?scheduleid=' . $session_schedule_id;
                                    ?>
                                    <a href="<?php echo esc_url( $mys_session_link );?>" target="_blank" class="conference-sessions-session _link">
                                        <p class="conference-sessions-session-title"><?php echo esc_html( get_the_title() ); ?></p>
                                        <h6 class="conference-sessions-session-date"><?php echo esc_html( $formatted_session_date ); ?></h6>
                                        <div class="conference-sessions-session-desc"><p><?php echo esc_html( $mys_session_summary ); ?></p></div>
                                    </a>
                                    <?php

                                endwhile;
                                foreach ( $manual_sessions as $row ) {
                                ?>                        
                                    <a href="<?php echo esc_url( $row['link']['url'] );?>" target="_blank" class="conference-sessions-session _link">
                                        <p class="conference-sessions-session-title"><?php echo esc_html( $row['title'] ); ?></p>
                                        <h6 class="conference-sessions-session-date"><?php echo esc_html( $row['dates'] ); ?></h6>
                                        <div class="conference-sessions-session-desc"><p><?php echo wp_kses_post( $row['description'] ); ?></p></div>
                                    </a>
                                <?php } ?>
                            </div>
                            <?php
                            wp_reset_postdata();
                        }
                    }
                    ?>
                </div>        
            </div>
    </div>
    <?php if(is_active_sidebar('broadstreet-ros-middle')) { ?>
    <div class="section container">
        <?php dynamic_sidebar('broadstreet-ros-middle'); ?>
    </div>
    <?php } ?>
    <div class="section container">
        <?php the_content(); ?>
    </div>
    <?php
}

if ( $display_cta_block ) {

    $cta_title    = get_field( 'cta_title' );
    $cta_body     = get_field( 'cta_body' );
    $cta_button_1 = get_field( 'cta_button_1' );
    $cta_button_2 = get_field( 'cta_button_2' );
    ?>    
    <div class="section">
        <div class="cta-block">
            <div class="cta-block-content">
                <div class="cta-block-main">
                    <?php if(!empty($cta_title)) { ?>
                    <h3><?php echo esc_html( $cta_title ); ?></h3>
                    <?php } ?>
                    <?php echo wp_kses_post( $cta_body ); ?>
                </div>
                <div class="cta-block-ctas">
                    <?php if(!empty($cta_button_1)) { ?>
                    <a href="<?php esc_url( $cta_button_1['url'] ); ?>" target="<?php echo esc_attr($cta_button_1['target'] ? $cta_button_1['target'] : '_self'); ?>" class="button _solid _cta"><?php echo esc_html( $cta_button_1['title'] ); ?></a>
                    <?php }
                    if(!empty($cta_button_2)) { ?>
                    <a href="<?php esc_url( $cta_button_2['url'] ); ?>" target="<?php echo esc_attr($cta_button_2['target'] ? $cta_button_2['target'] : '_self'); ?>" class="button _solid _cta"><?php echo esc_html( $cta_button_2['title'] ); ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

if ( ! empty( $ad_code ) ) {
    ?>    
    <div class="ad _banner">
        <?php echo do_shortcode( $ad_code ); ?>
    </div>    
    <?php
}
?>

<?php
if ( $display_mailing_list_block ) {
    ?>
    <div class="section">
        <div class="container">
            <div class="amp-signup">
                <div class="amp-signup__content">
                    <?php dynamic_sidebar('Sign Up'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<?php if(is_active_sidebar('broadstreet-ros-bottom')) { ?>
<div class="section container">
    <?php dynamic_sidebar('broadstreet-ros-bottom'); ?>
</div>
<?php } ?>

<?php 
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
