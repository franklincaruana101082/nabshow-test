<?php

namespace AutomateWoo\Usage_Tracking;

use AutomateWoo\Workflow;
use AutomateWoo\Workflow_Factory;

defined( 'ABSPATH' ) || exit;

/**
 * This class adds actions to track the usage of Workflows.
 *
 * @package AutomateWoo\Usage_Tracking
 * @since   4.9.0
 */
class Workflows implements Event_Tracker_Interface {

	use Event_Helper;

	/**
	 * Initialize the tracking class with various hooks.
	 */
	public function init() {
		add_action( 'automatewoo/workflow/before_run', [ $this, 'before_run' ] );
		add_action( 'automatewoo/workflow/created', [ $this, 'created' ] );
	}

	/**
	 * Record workflow data before a workflow runs.
	 *
	 * @param Workflow $workflow The workflow that is running.
	 */
	public function before_run( Workflow $workflow ) {
		$this->record_event( 'workflow_before_run', $this->get_workflow_data( $workflow ) );
	}

	/**
	 * Record workflow data when a workflow is created.
	 *
	 * @param int $workflow_id The workflow ID.
	 */
	public function created( $workflow_id ) {
		$workflow = Workflow_Factory::get( $workflow_id );
		if ( ! $workflow instanceof Workflow ) {
			return;
		}

		$this->record_event( 'workflow_created', $this->get_workflow_data( $workflow ) );
	}

	/**
	 * Get an array of data from the given workflow.
	 *
	 * @param Workflow $workflow The workflow that is running.
	 *
	 * @return array
	 */
	private function get_workflow_data( Workflow $workflow ) {
		$data = [
			'conversion_tracking_enabled' => $workflow->is_conversion_tracking_enabled(),
			'date_created'                => $workflow->get_date_created(),
			'ga_tracking_enabled'         => $workflow->is_ga_tracking_enabled(),
			'status'                      => $workflow->get_status(),
			'title'                       => $workflow->get_title(),
			'tracking_enabled'            => $workflow->is_tracking_enabled(),
			'unsubscribe_exempt'          => $workflow->is_exempt_from_unsubscribing(),
		];

		foreach ( $workflow->get_actions() as $key => $action ) {
			$this->recursively_add_items( $data, $key, $action->get_name(), 'action_' );
		}

		$data['trigger_name'] = $workflow->get_trigger_name();
		foreach ( $workflow->get_trigger_options() as $var => $value ) {
			$this->recursively_add_items( $data, $var, $value, 'trigger_' );
		}

		foreach ( $workflow->get_rule_data() as $key => $value ) {
			$this->recursively_add_items( $data, $key, $value );
		}

		return (array) apply_filters( 'automatewoo/usage_tracking/workflow_data', $data, $workflow );
	}

	/**
	 * Recursively add items to an array.
	 *
	 * @param array               $data   The array of data to add to.
	 * @param string              $key    The key to use.
	 * @param string|array|object $value  The value to add. Can be an array.
	 * @param string              $prefix A prefix to use for the data.
	 */
	private function recursively_add_items( &$data, $key, $value, $prefix = '' ) {
		if ( is_array( $value ) ) {
			foreach ( $value as $index => $item ) {
				$this->recursively_add_items( $data, $index, $item, "{$prefix}{$key}_" );
			}
		} elseif ( is_object( $value ) ) {
			foreach ( get_object_vars( $value ) as $index => $item ) {
				$this->recursively_add_items( $data, $index, $item, "{$prefix}{$key}_" );
			}
		} elseif ( is_string( $value ) ) {
			$data[ "{$prefix}{$key}" ] = $value;
		}
	}
}
