<?php
/**
 * URL Coupons for WooCommerce - Pro Class
 *
 * @version 1.2.0
 * @since   1.2.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_URL_Coupons_Pro' ) ) :

class Alg_WC_URL_Coupons_Pro {

	/**
	 * Constructor.
	 *
	 * @version 1.2.0
	 * @since   1.2.0
	 */
	function __construct() {
		add_filter( 'alg_wc_url_coupons_settings',                            array( $this, 'settings' ), 10, 3 );
		add_filter( 'alg_wc_url_coupons_redirect',                            array( $this, 'redirect' ) );
		add_filter( 'alg_wc_url_coupons_redirect_custom_url',                 array( $this, 'redirect_custom_url' ) );
		add_filter( 'alg_wc_url_coupons_fixed_product_discount_add_products', array( $this, 'fixed_product_discount_add_products' ) );
	}

	/**
	 * fixed_product_discount_add_products.
	 *
	 * @version 1.2.0
	 * @since   1.2.0
	 */
	function fixed_product_discount_add_products( $value ) {
		return get_option( 'alg_wc_url_coupons_fixed_product_discount_add_products', 'no' );
	}

	/**
	 * redirect_custom_url.
	 *
	 * @version 1.2.0
	 * @since   1.2.0
	 */
	function redirect_custom_url( $value ) {
		return get_option( 'alg_wc_url_coupons_redirect_custom_url', '' );
	}

	/**
	 * redirect.
	 *
	 * @version 1.2.0
	 * @since   1.2.0
	 */
	function redirect( $value ) {
		return get_option( 'alg_wc_url_coupons_redirect', 'no' );
	}

	/**
	 * settings.
	 *
	 * @version 1.2.0
	 * @since   1.2.0
	 */
	function settings( $value, $type = '', $args = array() ) {
		return '';
	}

}

endif;

return new Alg_WC_URL_Coupons_Pro();
