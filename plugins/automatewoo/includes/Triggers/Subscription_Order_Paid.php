<?php

namespace AutomateWoo\Triggers;

use AutomateWoo\Subscription_Workflow_Helper;
use AutomateWoo\Trigger_Order_Paid;
use AutomateWoo\Workflow;

defined( 'ABSPATH' ) || exit;

/**
 * Class Subscription_Order_Paid.
 *
 * @since 4.8.0
 * @package AutomateWoo
 */
class Subscription_Order_Paid extends Trigger_Order_Paid {

	/**
	 * Subscription_Order_Paid constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->supplied_data_items[] = 'subscription';
	}

	/**
	 * Load admin props.
	 */
	public function load_admin_details() {
		$this->title        = __( 'Subscription Order Paid', 'automatewoo' );
		$this->description  = __( 'This trigger fires after any type of subscription order is paid for. This will run after the order status has been changed and stock has been reduced.', 'automatewoo' );
		$this->description .= ' ' . Subscription_Workflow_Helper::get_subscription_order_trigger_description();
		$this->group        = Subscription_Workflow_Helper::get_group_name();
	}

	/**
	 * Load fields.
	 */
	public function load_fields() {
		$this->add_field( Subscription_Workflow_Helper::get_subscription_order_types_field() );
	}

	/**
	 * Trigger for subscription order.
	 *
	 * @param \WC_Order|int $order
	 */
	public function trigger_for_order( $order ) {
		Subscription_Workflow_Helper::trigger_for_subscription_order( $this, $order );
	}

	/**
	 * Validate workflow.
	 *
	 * @param Workflow $workflow
	 *
	 * @return bool
	 */
	public function validate_workflow( $workflow ) {
		if ( ! Subscription_Workflow_Helper::validate_subscription_order_types_field( $workflow ) ) {
			return false;
		}

		return parent::validate_workflow( $workflow );
	}

}
