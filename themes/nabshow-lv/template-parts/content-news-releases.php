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
	    <span class="publish-date"><?php echo esc_html( get_the_date() ); ?></span>
	    <h2 class="title"><a href="<?php echo esc_url( get_the_permalink() ); ?>"> <?php echo esc_html( get_the_title() ); ?></a></h2>
        <p><?php echo esc_html( nabshow_lv_excerpt() ); ?></p>
        <a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more btn-with-arrow">Read More</a>
    </div>
</div>
