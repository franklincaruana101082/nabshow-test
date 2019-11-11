<?php
/**
 * Template part for displaying news releases post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NABShow_LV
 */

?>
<div class="col-lg-4 col-md-6">
    <div class="related-content-box">
        <h2 class="title"><?php echo esc_html( get_the_title() ); ?></h2>
        <p><?php echo esc_html( nabshow_lv_excerpt() ); ?></p>
        <a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more btn-with-arrow">Read More</a>
    </div>
</div>