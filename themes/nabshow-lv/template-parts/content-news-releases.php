<?php
/**
 * Template part for displaying news releases post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NABShow_LV
 */

$post_featured_image = has_post_thumbnail() ? get_the_post_thumbnail_url() : nabshow_lv_get_empty_thumbnail_url();
?>
<div class="col-lg-4 col-md-6">
    <div class="related-content-box">
        <img class="logo" src="<?php echo esc_url( $post_featured_image ) ?>" alt="news-release-logo">
        <h2 class="title"><?php echo esc_html( get_the_title() ); ?></h2>
        <p><?php the_excerpt(); ?></p>
        <a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more btn-with-arrow">Read More</a>
    </div>
</div>