<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$page_id        = isset( $attributes[ 'pageId' ] ) && ! empty( $attributes[ 'pageId' ] ) ? $attributes[ 'pageId' ] : get_the_ID();
$item_limit     = isset( $attributes[ 'itemToFetch' ] ) && ! empty( $attributes[ 'itemToFetch' ] ) ? $attributes[ 'itemToFetch' ] : 2;
$block_title    = isset( $attributes[ 'blockTitle' ] ) && ! empty( $attributes[ 'blockTitle' ] ) ? $attributes[ 'blockTitle' ] : 'Featured Speakers';
$class_name     = isset( $attributes[ 'className' ] ) && ! empty( $attributes[ 'className' ] ) ? $attributes[ 'className' ] : '';
?>
<div class="speaker-list-outer session-speakers-info <?php echo esc_attr( $class_name ); ?>">
    <h2><?php echo esc_html( $block_title ); ?></h2>
    <div class="nabny-speaker-list">
        <?php
        if ( ! empty( $page_id ) ) {

            $rows = get_field( 'speaker_list', $page_id );
            
            if ( $rows ) {

                $speaker_ids    = array();
                $speaker_labels = array();
                $cnt            = 1;

                foreach( $rows as $row ) {
                    
                    $speaker_id = $row[ 'session_speaker' ];                    
                    
                    if ( ! empty( $speaker_id ) ) {
                        
                        $speaker_ids[]                  = $speaker_id;
                        $speaker_labels[ $speaker_id ]  = $row[ 'speaker_label' ];                        
                        
                        if ( $cnt >= $item_limit ) {
                            break;
                        }
                        
                        $cnt++;
                    }                    
                }
                
                if ( count( $speaker_ids ) > 0 ) {
                    
                    $query_args = array(
                        'post_type'     => 'speakers',
                        'post_per_page' => count( $speaker_ids ),
                        'post__in'      => $speaker_ids,
                        'meta_key'      => '_lastname',
                        'orderby'       => 'meta_value',
                        'order'         => 'ASC'
                    );

                    $query = new WP_Query( $query_args );

                    if ( $query->have_posts() ) {

                        while ( $query->have_posts() ) {
                            
                            $query->the_post();

                            $speaker_id         = get_the_ID();
                            $thumbnail_url      = has_post_thumbnail() ? get_the_post_thumbnail_url() : $this->mysgb_get_speaker_thumbnail_url();
                            $speaker_title      = get_field( 'title',  $speaker_id );
                            $speaker_company    = get_the_terms( $speaker_id, 'speaker-companies' );
                            $speaker_company    = $this->mysgb_get_pipe_separated_term_list( $speaker_company );
                            $speaker_label      = $speaker_labels[ $speaker_id ];
                            ?>
                            <div class="speaker-box-outer">
                                <div class="speaker-box-inner">
                                    <a href="#" class="speaker-detail-list-modal" data-postid="<?php echo esc_attr( $speaker_id ); ?>">
                                        <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="speaker-logo" class="circle-img">
                                    </a>
                                    <div class="speaker-info">
                                        <h6>
                                            <a href="#" class="speaker-detail-list-modal" data-postid="<?php echo esc_attr( $speaker_id ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                                        </h6>
                                        <p class="speaker-desc"><?php echo esc_html( $speaker_title ); ?></p>
                                        <span class="company"><?php echo esc_attr( $speaker_company ); ?></span>
                                        <span class="speaker-label"><?php echo esc_html( $speaker_label ); ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        wp_reset_postdata();
                        ?>
                        <p class="coming-soon">Coming soon.</p>
                        <?php
                    }
                }
            } else {
                ?>
                <p class="coming-soon">Coming soon.</p>
                <?php
            }
        }       
        ?>        
    </div>
</div>