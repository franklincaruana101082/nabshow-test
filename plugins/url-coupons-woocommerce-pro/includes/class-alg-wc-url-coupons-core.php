<?php
/**
 * URL Coupons for WooCommerce - Core Class
 *
 * @version 1.2.8
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_URL_Coupons_Core' ) ) :

class Alg_WC_URL_Coupons_Core {

	/**
	 * Constructor.
	 *
	 * @version 1.2.8
	 * @since   1.0.0
	 * @todo    [maybe] hide coupons: maybe it's safer to hide coupons with CSS instead of using filter
	 */
	function __construct() {
		if ( 'yes' === get_option( 'alg_wc_url_coupons_enabled', 'yes' ) ) {
			// Apply URL coupon
			add_action( 'wp_loaded', array( $this, 'maybe_apply_url_coupon' ), PHP_INT_MAX );
			// Hide coupons
			if ( 'yes' === get_option( 'alg_wc_url_coupons_cart_hide_coupon', 'no' ) ) {
				add_filter( 'woocommerce_coupons_enabled', array( $this, 'hide_coupon_field_on_cart' ), PHP_INT_MAX );
			}
			if ( 'yes' === get_option( 'alg_wc_url_coupons_checkout_hide_coupon', 'no' ) ) {
				add_filter( 'woocommerce_coupons_enabled', array( $this, 'hide_coupon_field_on_checkout' ), PHP_INT_MAX );
			}
			// Delay notice
			if ( 'yes' === get_option( 'alg_wc_url_coupons_delay_notice', 'no' ) ) {
				add_action( 'wp_head', array( $this, 'delay_notice_display' ) );
			}
			// WP Rocket: Disable empty cart caching
			if ( 'yes' === get_option( 'alg_wc_url_coupons_wp_rocket_disable_cache_wc_empty_cart', 'no' ) ) {
				add_filter( 'rocket_cache_wc_empty_cart', '__return_false', PHP_INT_MAX );
			}
		}
	}

	/**
	 * delay_notice_display.
	 *
	 * @version 1.2.5
	 * @since   1.2.5
	 */
	function delay_notice_display() {
		if ( function_exists( 'WC' ) && ! WC()->cart->is_empty() && ( $notices = WC()->session->get( 'alg_wc_url_coupons_notices', array() ) ) && ! empty( $notices ) ) {
			WC()->session->set( 'alg_wc_url_coupons_notices', null );
			WC()->session->set( 'wc_notices', $notices );
		}
	}

	/**
	 * hide_coupon_field_on_checkout.
	 *
	 * @version 1.2.1
	 * @since   1.2.1
	 */
	function hide_coupon_field_on_checkout( $enabled ) {
		return ( is_checkout() ) ? false : $enabled;
	}

	/**
	 * hide_coupon_field_on_cart.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function hide_coupon_field_on_cart( $enabled ) {
		return ( is_cart() ) ? false : $enabled;
	}

	/**
	 * is_product_in_cart.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function is_product_in_cart( $product_id ) {
		if ( 0 != $product_id ) {
			if ( isset( WC()->cart->cart_contents ) && is_array( WC()->cart->cart_contents ) ) {
				foreach ( WC()->cart->cart_contents as $cart_item_key => $cart_item_data ) {
					if (
						( isset( $cart_item_data['product_id'] )   && $product_id == $cart_item_data['product_id'] ) ||
						( isset( $cart_item_data['variation_id'] ) && $product_id == $cart_item_data['variation_id'] )
					) {
						return true;
					}
				}
			}
		}
		return false;
	}

	/**
	 * get_redirect_url.
	 *
	 * @version 1.2.4
	 * @since   1.0.0
	 */
	function get_redirect_url( $key ) {
		switch ( apply_filters( 'alg_wc_url_coupons_redirect', 'no' ) ) {
			case 'cart':
				return wc_get_cart_url();
			case 'checkout':
				return wc_get_checkout_url();
			case 'custom':
				return apply_filters( 'alg_wc_url_coupons_redirect_custom_url', '' );
			default: // 'no'
				return remove_query_arg( array( $key, 'add-to-cart' ) );
		}
	}

	/**
	 * maybe_add_products_to_cart.
	 *
	 * @version 1.2.0
	 * @since   1.0.0
	 * @todo    [maybe] check if coupon is valid
	 */
	function maybe_add_products_to_cart( $coupon_code ) {
		if ( 'no' === apply_filters( 'alg_wc_url_coupons_fixed_product_discount_add_products', 'no' ) ) {
			return false;
		}
		// Coupons are globally disabled
		if ( ! wc_coupons_enabled() ) {
			return false;
		}
		// Sanitize coupon code
		$coupon_code = wc_format_coupon_code( $coupon_code );
		// Get the coupon
		$the_coupon = new WC_Coupon( $coupon_code );
		if ( 'fixed_product' === $the_coupon->get_discount_type() ) {
			$product_ids = $the_coupon->get_product_ids();
			if ( ! empty( $product_ids ) ) {
				foreach ( $product_ids as $product_id ) {
					if ( ! $this->is_product_in_cart( $product_id ) ) {
						WC()->cart->add_to_cart( $product_id );
					}
				}
			}
		}
	}

	/**
	 * maybe_apply_url_coupon.
	 *
	 * @version 1.2.7
	 * @since   1.0.0
	 * @todo    [next] use `WC()->cart->apply_coupon()` instead of `WC()->cart->add_discount()`
	 * @todo    [maybe] options to add products to cart with query arg
	 * @todo    [maybe] `if ( ! WC()->cart->has_discount( $coupon_code ) ) {}`
	 */
	function maybe_apply_url_coupon() {
		$key = get_option( 'alg_wc_url_coupons_key', 'alg_apply_coupon' );
		if ( isset( $_GET[ $key ] ) && '' !== $_GET[ $key ] && function_exists( 'WC' ) ) {
			$coupon_code = sanitize_text_field( $_GET[ $key ] );
			// Action: before
			do_action( 'alg_wc_url_coupons_before_coupon_applied', $coupon_code );
			// Force session start
			if ( 'yes' === get_option( 'alg_wc_url_coupons_force_start_session', 'no' ) && WC()->session && ! WC()->session->has_session() ) {
				WC()->session->set_customer_session_cookie( true );
			}
			// Additional cookie
			if ( 'yes' === get_option( 'alg_wc_url_coupons_cookie_enabled', 'no' ) ) {
				setcookie( 'alg_wc_url_coupons',
					$coupon_code, ( time() + get_option( 'alg_wc_url_coupons_cookie_sec', 1209600 ) ), '/', $_SERVER['SERVER_NAME'], false );
			}
			// Add products
			$this->maybe_add_products_to_cart( $coupon_code );
			// Apply coupon
			WC()->cart->add_discount( $coupon_code );
			// Delay notice
			if ( 'yes' === get_option( 'alg_wc_url_coupons_delay_notice', 'no' ) && WC()->cart->is_empty() ) {
				$all_notices = WC()->session->get( 'wc_notices', array() );
				wc_clear_notices();
				WC()->session->set( 'alg_wc_url_coupons_notices', $all_notices );
			}
			// Action: after
			do_action( 'alg_wc_url_coupons_after_coupon_applied', $coupon_code );
			// Redirect
			wp_safe_redirect( $this->get_redirect_url( $key ) );
			exit;
		}
	}

}

endif;

return new Alg_WC_URL_Coupons_Core();
