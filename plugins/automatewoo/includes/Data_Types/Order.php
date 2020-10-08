<?php
// phpcs:ignoreFile

namespace AutomateWoo;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * @class Data_Type_Order
 */
class Data_Type_Order extends Data_Type {

	/**
	 * @param $item
	 * @return bool
	 */
	function validate( $item ) {
		return is_subclass_of( $item, 'WC_Abstract_Order' );
	}


	/**
	 * @param \WC_Order $item
	 * @return mixed
	 */
	function compress( $item ) {
		return $item->get_id();
	}


	/**
	 * @param $compressed_item
	 * @param $compressed_data_layer
	 * @return mixed
	 */
	function decompress( $compressed_item, $compressed_data_layer ) {
		$id = Clean::id( $compressed_item );

		if ( ! $id ) {
			return false;
		}

		$order = wc_get_order( $id );

		if ( ! $order || $order->get_status() === 'trash' ) {
			return false;
		}

		return $order;
	}

	/**
	 * Get singular name for data type.
	 *
	 * @since 5.0.0
	 *
	 * @return string
	 */
	public function get_singular_name() {
		return __( 'Order', 'automatewoo' );
	}

	/**
	 * Get plural name for data type.
	 *
	 * @since 5.0.0
	 *
	 * @return string
	 */
	public function get_plural_name() {
		return __( 'Orders', 'automatewoo' );
	}


}
