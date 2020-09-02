<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.7.1
 */
if (!defined('ABSPATH')) {
    exit;
}

if ($related_products) :

	global $post;

	$related = get_post_meta($post->ID, '_crp_related_ids', true);
	$var = get_option('custom_related_products_disable');
	$cvar = get_option('custom_related_products_disable_custom');
    ?>
    <div class="related-products-section">
        <?php echo apply_filters('wt_related_products_heading',"<h2>". esc_html__('Related products', 'wt-woocommerce-related-products')." </h2>"); ?>

        <section class="related products">

            <?php woocommerce_product_loop_start(); ?>

            <?php

            if (!empty($var)) {

                $reselected = get_post_meta($post->ID, 'selected_ids', true);

                if (!empty($reselected)) {
                    add_post_meta($post->ID, '_crp_related_ids', $reselected);
                }

                delete_post_meta($post->ID, 'selected_ids');

                if (isset($related) && !empty($related) && empty($cvar)) {

                    $related_products = array();
                    $copy = array();
                    $related = array_diff($related, array($post->ID));
                    $related_products = $related;
                    while (count($related_products)) {
                        // takes a rand array elements by its key
                        $element = array_rand($related_products);
                        // assign the array and its value to an another array
                        $copy[$element] = $related_products[$element];
                        //delete the element from source array
                        unset($related_products[$element]);
                    }

                    $number_of_products = apply_filters('wt_related_products_number', 3);
                    $odrerby = apply_filters('wt_related_products_odrerby', 'title');
                    $order = apply_filters('wt_related_products_odrer', 'ASC');

                    $i = 1;

                    // Setup your custom query
                    $args = array('post_type' => 'product', 'posts_per_page' => $number_of_products, 'orderby' => 'title', 'order' => $order, 'post__in' => $copy);
                    $loop = new WP_Query($args);
                    while ($loop->have_posts()) : $loop->the_post();
                        ?>
                        <?php wc_get_template_part('content', 'product'); ?>
                    <?php
                    endwhile; // end of the loop.
                } else {
                    ?>

                    <section class="related_products" style="display: none;"></section>
                        <?php
                    }
                } else {
                    ?>

                    <?php
                    $crelated = get_post_meta($post->ID, '_crp_related_ids', true);

                    if (!empty($crelated))
                        update_post_meta($post->ID, 'selected_ids', $crelated);

                    // delete_post_meta($post->ID, '_crp_related_ids');


                    foreach ($related_products as $related_product) :
                        $post_object = get_post($related_product->get_id());
                        setup_postdata($GLOBALS['post'] = & $post_object);
                        wc_get_template_part('content', 'product');
                        ?>
                        <?php
                    endforeach;
                }
                ?>
                <?php woocommerce_product_loop_end(); ?>
        </section>
    </div>
    <?php
endif;
wp_reset_postdata();
