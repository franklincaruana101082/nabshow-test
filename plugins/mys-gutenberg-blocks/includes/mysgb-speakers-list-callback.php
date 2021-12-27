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
$order_by           = isset( $attributes['orderBy'] ) && ! empty( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'name';
$block_title        = isset( $attributes['blockTitle'] ) && ! empty( $attributes['blockTitle'] ) ? $attributes['blockTitle'] : '';
$class_name         = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';

$query_args = array(
    'post_type'      => 'speakers',
    'posts_per_page' => $posts_per_page    
);


if ( ! empty( $include_speaker ) ) {
    
    $final_speakers = explode( ',' , str_replace( ' ', '', $include_speaker ) );
    
    if ( is_array( $final_speakers ) && count( $final_speakers ) > 0 ) {
        $query_args[ 'post__in' ] = $final_speakers;
    }    
}

if ( 'rand' === $order_by ) {
    $query_args[ 'posts_per_page' ]       = 200;
    $query_args[ 'fields' ]               = 'ids';
    $query_args[ 'no_found_rows' ]        = true;
    $query_args[ 'ignore_sticky_posts' ]  = true;
} else  {
    $query_args[ 'meta_key' ] = '_lastname';
    $query_args[ 'orderby' ] = 'meta_value';
    $query_args[ 'order' ] = 'ASC';
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
    
    $channel_meta_arr = array( 'relation' => 'OR' );

    foreach( $channels as $ch ) {
        
        $channel_meta_arr[] = array(
            'key'     => 'session_channel',
            'value'   => '"' . $ch . '"',
            'compare' => 'LIKE'
        );
    }

    if ( count( $channel_meta_arr ) > 1 ) {

        $query_args[ 'meta_query' ] = $channel_meta_arr;
    }        
}

$query = new WP_Query( $query_args );

if ( 'rand' === $order_by && $query->have_posts() ) {

	$post_ids = $query->posts;
	shuffle( $post_ids );
	$post_ids = array_splice( $post_ids, 0, $posts_per_page );
	$query    = new WP_Query( array( 'post_type' => 'speakers', 'post__in' => $post_ids, 'posts_per_page' =>  count( $post_ids ), 'orderby' => 'post__in' ) );
}

if ( $query->have_posts() ) {
    ?>
    <div class="speaker-list-outer <?php echo esc_attr( $class_name ); ?>">
        <h2><?php echo esc_html( $block_title ); ?></h2>
        <div class="nabny-speaker-list">
            <?php            
            while ( $query->have_posts() ) {

                $query->the_post();

                $speaker_id         = get_the_ID();
                $thumbnail_url      = has_post_thumbnail() ? get_the_post_thumbnail_url() : $this->mysgb_get_speaker_thumbnail_url();
                $speaker_title      = get_field( 'title',  $speaker_id );
                $speaker_company    = get_the_terms( $speaker_id, 'speaker-companies' );
                $speaker_company    = $this->mysgb_get_pipe_separated_term_list( $speaker_company );
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
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
   <?php 
}
wp_reset_postdata();