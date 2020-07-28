<?php

namespace AutomateWoo\Rest_Api\Controllers;

use AutomateWoo\Permissions;
use AutomateWoo\Rest_Api\Schema\Workflow_Schema;
use AutomateWoo\Rest_Api\Utilities\Controller_Namespace;
use AutomateWoo\Rest_Api\Utilities\Pagination;
use AutomateWoo\Workflow_Query;
use WP_Error;
use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;

defined( 'ABSPATH' ) || exit;

/**
 * Workflows Rest API controller.
 *
 * @since 4.9.0
 */
class Workflows extends AbstractController {

	use Workflow_Schema;

	/**
	 * Route base.
	 *
	 * @var string
	 */
	protected $rest_base = 'workflows';

	/**
	 * Register the routes.
	 */
	public function register_routes() {
		register_rest_route(
			$this->namespace,
			"/{$this->rest_base}",
			[
				[
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => [ $this, 'get_items' ],
					'permission_callback' => [ Permissions::class, 'can_manage' ],
					'args'                => $this->get_collection_params(),
				],
				'schema' => [ $this, 'get_public_item_schema' ],
			]
		);
	}

	/**
	 * Retrieves a collection workflows.
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function get_items( $request ) {
		$query = new Workflow_Query();
		$query->set_no_found_rows( false );
		$query->set_limit( $request->get_param( 'per_page' ) );
		$query->set_page( $request->get_param( 'page' ) );
		$query->set_status( $request->get_param( 'status' ) ?: 'any' );
		$query->set_trigger( $request->get_param( 'trigger' ) );

		if ( $this->request_has_param( $request, 'search' ) ) {
			$query->set_search( $request->get_param( 'search' ) );
		}

		$items = $query->get_results();
		$data  = [];

		foreach ( $items as $item ) {
			$item_data = $this->prepare_item_for_response( $item, $request );
			$data[]    = $this->prepare_response_for_collection( $item_data );
		}

		$response = new WP_REST_Response( $data );
		$response = ( new Pagination( $request, $response, $query->get_found_rows() ) )->add_headers();

		return $response;
	}

	/**
	 * Retrieves the query params for the collections.
	 *
	 * @return array
	 */
	public function get_collection_params() {
		$params = parent::get_collection_params();

		$params['context']['default'] = 'view';

		$params['status'] = [
			'description'       => __( 'Limit results by status.', 'automatewoo' ),
			'type'              => 'string',
			'validate_callback' => 'rest_validate_request_arg',
			'enum'              => [ 'active', 'disabled' ],
		];

		$params['trigger'] = [
			'description'       => __( 'Limit results by one or more triggers.', 'automatewoo' ),
			'type'              => 'array',
			'items'             => [
				'type' => 'string',
			],
			'default'           => [],
			'sanitize_callback' => 'wp_parse_slug_list',
		];

		return $params;
	}
}
