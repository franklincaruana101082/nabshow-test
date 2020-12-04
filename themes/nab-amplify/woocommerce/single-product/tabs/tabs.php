<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */

global $product;
$product_id                 = $product->get_id();
$product_publisher_content  = get_post_meta( $product_id, '_product_publisher_content_html', true );
$product_long_content       = get_post_meta( $product_id, '_product_long_content_html', true );
$product_join_today_content = get_post_meta( $product_id, '_product_join_today_content_html', true );
?>
<div class="product-middle-section <?php if( $product_long_content ) echo esc_attr( 'with_long_desc' ); ?>">
    <div class="has-full">
        <div class="has-fixed">
            <div id="middle-left">
                <div id="prod-content">
        			<?php the_content(); ?>
                </div>
        		<?php if ( $product_publisher_content ) { ?>
                    <div id="prod-publisher">
                        <h4>Publisher info: </h4><?php echo $product_publisher_content; ?>
                    </div>
        		<?php } ?>
            </div>
        	<?php if ( $product_long_content ) { ?>
                <div id="middle-right">
                    <div id="prod-long-content">
        				<?php echo $product_long_content; ?>
                    </div>
                </div>
        	<?php } ?>
        </div>
    </div>
</div>
<?php if ( $product_join_today_content ) { ?>
    <div class="join-today-section">
        <div class="has-full">
            <div class="has-fixed">
        		<?php echo $product_join_today_content; ?>
            </div>
        </div>
    </div>
<?php } ?>
