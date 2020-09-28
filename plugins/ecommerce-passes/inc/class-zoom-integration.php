<?php
/**
 * Class for Zoom.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! class_exists('Zoom_Integration') ) {

    class Zoom_Integration {


        public function __construct() {

            // Add registrant on order completed.
            add_shortcode('zoom_link', array($this, 'ep_zoom_shortcode'), 10, 3);

        }

        // function that runs when shortcode is called
        function ep_zoom_shortcode() {

            ob_start();

            $shop_blog_id = Ecommerce_Passes::ep_get_shop_blog();
            $user_id = get_current_user_id();
            $current_blog_id = get_current_blog_id();
            $post_id = get_the_ID();
            $zoom_id_from_content_meta = get_post_meta( $post_id, 'zoom_id', true );

            switch_to_blog($shop_blog_id);

            $zoom_links = get_user_meta( $user_id, "zoom_$current_blog_id", true );

            $zoom_unique_url = isset( $zoom_links[$post_id][$zoom_id_from_content_meta]['url'] ) ? $zoom_links[$post_id][$zoom_id_from_content_meta]['url'] : '';

            if( ! empty( $zoom_unique_url ) ) {
                echo  "<a href='$zoom_unique_url' class='button' id='join-zooom-button' target='_blank'>Join Meeting</a>";
            } else {
                echo "<p class='error'>The meeting link is not available, please purchases the content or contact administrator.</p>";
            }

            $message = ob_get_clean();

            wp_reset_query();
            // Quit multisite connection
            restore_current_blog();

            return $message;
        }

    } new Zoom_Integration();
}
