<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$posts_per_page     = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
$channels           = isset( $attributes['channels'] ) && ! empty( $attributes['channels'] ) ? $attributes['channels'] : array();
$featured_speaker   = isset( $attributes['featuredSpeaker'] ) ? $attributes['featuredSpeaker'] : false;
$include_speaker    = isset( $attributes['includeSpeakers'] ) && ! empty( $attributes['includeSpeakers'] ) ? $attributes['includeSpeakers'] : '';
$block_title        = isset( $attributes['blockTitle'] ) && ! empty( $attributes['blockTitle'] ) ? $attributes['blockTitle'] : '';
$class_name         = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';

$query_args = array(
    'post_type'      => 'speakers',
    'posts_per_page' => $posts_per_page,    
);

if ( ! empty( $include_speaker ) ) {
    
    $final_speakers = explode( ',' , str_replace( ' ', '', $include_speaker ) );
    
    if ( is_array( $final_speakers ) && count( $final_speakers ) > 0 ) {
        $query_args[ 'post__in' ] = $final_speakers;
    }    
}

if ( $featured_speaker ) {
    $query_args[ 'tax_query' ] = array(
        array(
            'taxonomy' => 'speaker-categories',
            'field'    => 'slug',
            'terms'    => 'featured',
        )
    );
}

if ( is_array( $channels ) && count( $channels ) > 0 ) {
    $query_args[ 'meta_query' ] = array(
        array(
            'key'     => 'session_channel',
            'value'   => $channels,
            'compare' => 'IN'
        )
    );
}
$query = new WP_Query( $query_args );
?>
<div class="speaker-list-outer <?php echo esc_attr( $class_name ); ?>">
    <h2><?php echo esc_html( $block_title ); ?></h2>
    <div class="nabny-speaker-list">
        <?php
        if ( $query->have_posts() ) {
            
            while ( $query->have_posts() ) {

                $query->the_post();

                $speaker_id     = get_the_ID();
                $thumbnail_url  = has_post_thumbnail() ? get_the_post_thumbnail_url() : $this->mysgb_get_speaker_thumbnail_url();
                $speaker_title  = get_field( 'title',  $speaker_id );
                
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
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
            <p class="coming-soon">Coming soon.</p>
            <?php
        }
        wp_reset_postdata();
        ?>        
    </div>
</div>