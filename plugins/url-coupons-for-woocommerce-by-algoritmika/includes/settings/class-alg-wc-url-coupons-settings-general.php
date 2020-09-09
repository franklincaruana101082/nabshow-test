<?php
/**
 * URL Coupons for WooCommerce - General Section Settings
 *
 * @version 1.2.7
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_URL_Coupons_Settings_General' ) ) :

class Alg_WC_URL_Coupons_Settings_General extends Alg_WC_URL_Coupons_Settings_Section {

	/**
	 * Constructor.
	 *
	 * @version 1.1.0
	 * @since   1.0.0
	 */
	function __construct() {
		$this->id   = '';
		$this->desc = __( 'General', 'url-coupons-for-woocommerce-by-algoritmika' );
		parent::__construct();
	}

	/**
	 * get_settings.
	 *
	 * @version 1.2.7
	 * @since   1.0.0
	 */
	function get_settings() {
		$main_settings = array(
			array(
				'title'    => __( 'URL Coupons Options', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'type'     => 'title',
				'id'       => 'alg_wc_url_coupons_options',
			),
			array(
				'title'    => __( 'URL Coupons', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'desc'     => '<strong>' . __( 'Enable plugin', 'url-coupons-for-woocommerce-by-algoritmika' ) . '</strong>',
				'id'       => 'alg_wc_url_coupons_enabled',
				'default'  => 'yes',
				'type'     => 'checkbox',
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_url_coupons_options',
			),
		);
		$general_settings = array(
			array(
				'title'    => __( 'Options', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'type'     => 'title',
				'id'       => 'alg_wc_url_coupons_general_options',
			),
			array(
				'title'    => __( 'URL coupons key', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'desc_tip' => __( 'URL key. If you change this, make sure it\'s unique and is not used anywhere on your site (e.g. by another plugin).', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'desc'     => '<p>' . sprintf( __( 'Your customers can apply shop\'s standard coupons by visiting URL. E.g.: %s.', 'url-coupons-for-woocommerce-by-algoritmika' ),
					'<code>' . site_url() . '/?' . '<strong>' . get_option( 'alg_wc_url_coupons_key', 'alg_apply_coupon' ) . '</strong>' . '=couponcode' . '</code>' ) . '</p>',
				'id'       => 'alg_wc_url_coupons_key',
				'default'  => 'alg_apply_coupon',
				'type'     => 'text',
			),
			array(
				'title'    => __( 'Force session start', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'desc'     => __( 'Enable', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'desc_tip' => __( 'Enable this if URL coupons are not being applied to the guests (i.e. not logged users).', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'id'       => 'alg_wc_url_coupons_force_start_session',
				'default'  => 'no',
				'type'     => 'checkbox',
			),
			array(
				'title'    => __( 'Delay notice', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'desc'     => __( 'Delay', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'desc_tip' => __( 'Delay the "Coupon code applied successfully" notice if the cart is empty when applying a URL coupon.', 'url-coupons-for-woocommerce-by-algoritmika' ) . ' ' .
					__( 'Notice will be delayed until there is at least one product in the cart.', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'id'       => 'alg_wc_url_coupons_delay_notice',
				'default'  => 'no',
				'type'     => 'checkbox',
			),
			array(
				'title'    => __( 'Hide coupon on cart page', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'desc'     => __( 'Hide', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'desc_tip' => __( 'Enable this if you want to hide standard coupon input field on the cart page.', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'id'       => 'alg_wc_url_coupons_cart_hide_coupon',
				'default'  => 'no',
				'type'     => 'checkbox',
			),
			array(
				'title'    => __( 'Hide coupon on checkout page', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'desc'     => __( 'Hide', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'desc_tip' => __( 'Enable this if you want to hide standard coupon input field on the checkout page.', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'id'       => 'alg_wc_url_coupons_checkout_hide_coupon',
				'default'  => 'no',
				'type'     => 'checkbox',
			),
			array(
				'title'    => __( 'Add products to cart', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'desc'     => __( 'Enable', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'desc_tip' => __( 'Automatically adds coupon\'s products to the cart for "Fixed product discount" type coupons.', 'url-coupons-for-woocommerce-by-algoritmika' ) .
					apply_filters( 'alg_wc_url_coupons_settings', '<br>' .
						sprintf( 'This option is available in <a href="%s" target="_blank">URL Coupons for WooCommerce Pro</a> plugin version only.',
							'https://wpfactory.com/item/url-coupons-woocommerce/' ) ),
				'id'       => 'alg_wc_url_coupons_fixed_product_discount_add_products',
				'default'  => 'no',
				'type'     => 'checkbox',
				'custom_attributes' => apply_filters( 'alg_wc_url_coupons_settings', array( 'disabled' => 'disabled' ) ),
			),
			array(
				'title'    => __( 'Redirect URL', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'desc_tip' => __( 'Possible values: No redirect; redirect to cart; redirect to checkout; redirect to custom local URL.', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'id'       => 'alg_wc_url_coupons_redirect',
				'default'  => 'no',
				'type'     => 'select',
				'options'  => array(
					'no'       => __( 'No redirect', 'url-coupons-for-woocommerce-by-algoritmika' ),
					'cart'     => __( 'Redirect to cart', 'url-coupons-for-woocommerce-by-algoritmika' ),
					'checkout' => __( 'Redirect to checkout', 'url-coupons-for-woocommerce-by-algoritmika' ),
					'custom'   => __( 'Redirect to custom local URL', 'url-coupons-for-woocommerce-by-algoritmika' ),
				),
				'desc'     => apply_filters( 'alg_wc_url_coupons_settings', '<p>' .
					sprintf( 'This option is available in <a href="%s" target="_blank">URL Coupons for WooCommerce Pro</a> plugin version only.',
						'https://wpfactory.com/item/url-coupons-woocommerce/' ) . '</p>' ),
				'custom_attributes' => apply_filters( 'alg_wc_url_coupons_settings', array( 'disabled' => 'disabled' ) ),
			),
			array(
				'desc'     => __( 'Custom local URL', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'id'       => 'alg_wc_url_coupons_redirect_custom_url',
				'default'  => '',
				'type'     => 'text',
				'css'      => 'width:100%;',
				'custom_attributes' => apply_filters( 'alg_wc_url_coupons_settings', array( 'disabled' => 'disabled' ) ),
			),
			array(
				'title'    => __( 'Advanced', 'url-coupons-for-woocommerce-by-algoritmika' ) . ': ' . __( 'Extra cookie', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'desc'     => __( 'Enable', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'desc_tip' => __( 'Enable this if you want to set cookie when URL coupon has been applied.', 'url-coupons-for-woocommerce-by-algoritmika' ) . ' ' .
					sprintf( __( 'Cookie name will be %s.', 'url-coupons-for-woocommerce-by-algoritmika' ), '<code>alg_wc_url_coupons</code>' ),
				'id'       => 'alg_wc_url_coupons_cookie_enabled',
				'default'  => 'no',
				'type'     => 'checkbox',
			),
			array(
				'desc'     => __( 'The time the cookie expires.', 'url-coupons-for-woocommerce-by-algoritmika' ) . ' ' .
					__( 'In seconds.', 'url-coupons-for-woocommerce-by-algoritmika' ),
				'id'       => 'alg_wc_url_coupons_cookie_sec',
				'default'  => 1209600,
				'type'     => 'number',
				'custom_attributes' => array( 'min' => 1 ),
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_url_coupons_general_options',
			),
		);
		return array_merge( $main_settings, $general_settings );
	}

}

endif;

return new Alg_WC_URL_Coupons_Settings_General();
