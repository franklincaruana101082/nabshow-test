<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids && $product->get_image_id() ) {
	foreach ( $attachment_ids as $attachment_id ) {
		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id ), $attachment_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
	}

	$video_url                   = get_post_meta( $product->get_id(), '_product_video_url', true );
	$product_video_image_id      = get_post_meta( $product->get_id(), '_product_video_thumb', true );
	$gallery_thumbnail           = wc_get_image_size( 'gallery_thumbnail' );
	$thumbnail_size              = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
	$product_video_thumb_100x100 = wp_get_attachment_image_src( $product_video_image_id, $thumbnail_size )[0];
	$full_size                   = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
	$product_video_thumb         = wp_get_attachment_image_src( $product_video_image_id, $full_size )[0];

	$html = '<div data-thumb="' . $product_video_thumb_100x100 . '" data-thumb-alt="alt text" class="woocommerce-product-gallery__image video_added custom_thumb"><a data-fancybox data-type="iframe" class="" href="javascript:void(0)" data-src="' . $video_url . '" ><img src="' . $product_video_thumb . '" /></a></div>';
	echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, 52 ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
}
