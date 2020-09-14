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

                $cnt = 1;

                foreach( $rows as $row ) {
                    
                    $speaker_id = $row[ 'session_speaker' ];                    
                    
                    if ( ! empty( $speaker_id ) ) {
                                                
                        $thumbnail_url  = has_post_thumbnail( $speaker_id ) ? get_the_post_thumbnail_url( $speaker_id ) : $this->mysgb_get_speaker_thumbnail_url();
                        $speaker_title  = $row[ 'speaker_label' ];
                        ?>
                        <div class="speaker-box-outer">
                            <div class="speaker-box-inner">
                                <a href="#" class="speaker-detail-list-modal" data-postid="<?php echo esc_attr( $speaker_id ); ?>">
                                    <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="speaker-logo" class="circle-img">
                                </a>
                                <div class="speaker-info">
                                    <h6>
                                        <a href="#" class="speaker-detail-list-modal" data-postid="<?php echo esc_attr( $speaker_id ); ?>"><?php echo esc_html( get_the_title( $speaker_id ) ); ?></a>
                                    </h6>
                                    <p class="speaker-desc"><?php echo esc_html( $speaker_title ); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                        
                        if ( $cnt >= $item_limit ) {
                            break;
                        }
                        
                        $cnt++;
                    }                    
                }
            } else {
                ?>
                <p class="coming-soon">Coming soon.</p>
                <?php
            }
        } else {
            ?>
            <p class="coming-soon">Coming soon.</p>
            <?php
        }        
        ?>        
    </div>
</div>