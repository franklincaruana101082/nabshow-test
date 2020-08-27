<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$regular_price = (float) $product->get_regular_price(); // Regular price
$sale_price = (float) $product->get_price(); // Active price (the "Sale price" when on-sale)

// "Saving Percentage" calculation and formatting
if( $regular_price !== $sale_price && 0 !== (int) $regular_price && 0 !== (int) $sale_price ) {
	$saving_percentage = round( 100 - ( $sale_price / $regular_price * 100 ), 1 );	
}

?>
<?php if ( $price_html = $product->get_price_html() ) : ?>
	<span class="price"><?php echo $price_html; ?></span>
	<div class="buttoms">
		<?php if( $saving_percentage ) { ?>
			<a href="javascript:void(0)"><?php echo $saving_percentage; ?>% off</a>
		<?php } ?>
	</div>
<?php endif; ?>
