<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! class_exists('RGBlocks_REST_API') ) {

	class RGBlocks_REST_API {

		/**
		 * Register the REST API route
		 */
		public function rgblocks_init_rest_route() {

			register_rest_route( 'rg_blocks', '/request/reusable-blocks', array(
					'methods'  => WP_REST_Server::READABLE,
					'callback' => array(
						$this,
						'rgblocks_fetch_reusable_blocks_list',
					),
					'args' => array(

					)
				)
			);

			register_rest_route( 'rg_blocks', '/request/get-blocks-terms', array(
					'methods'  => WP_REST_Server::READABLE,
					'callback' => array(
						$this,
						'rgblocks_fetch_reusable_blocks_terms',
					),
				)
			);
		}

		/**
		 * Fetch reusable blocks
		 * @param WP_REST_Request $request
		 *
		 * @return WP_REST_Response
		 */
		public function rgblocks_fetch_reusable_blocks_list(  WP_REST_Request $request ) {

			$result        = array();
			$parameters    = $request->get_params();

			$search        = ( ! empty( $parameters['search'] ) ) ? trim( $parameters['search'], ' ') : '';
			$category      = ( ! empty( $parameters['category'] ) ) ? $parameters['category'] : 'all';
			$page_number   = ( ! empty( $parameters['page'] ) ) ? $parameters['page'] : 1;
			$post_limit    = ( ! empty( $parameters['per_page'] ) ) ? $parameters['per_page'] : 10;

			$query_arg  = array(
				'post_type'      => 'wp_block',
				'posts_per_page' => $post_limit,
				'paged'          => $page_number,
			);

			if ( ! empty( $search ) ) {
				$query_arg[ 'search_rgb_title' ] = $search;
			}

			if ( ! empty( $category ) && 'all' !== $category ) {

				$query_arg[ 'tax_query' ] = array(
					array (
						'taxonomy' => 'block-category',
						'field'    => 'slug',
						'terms'    => $category,
					),
				);
			}

			$blocks_query = new WP_Query( $query_arg );

			if ( $blocks_query->have_posts() ) {

				$i = 0;

				while ( $blocks_query->have_posts() ) {

					$blocks_query->the_post();

					$block_post_id      = get_the_ID();
					$block_preview_img  = has_post_thumbnail() ? get_the_post_thumbnail_url() : false;
					$block_title        = get_the_title();
					$block_content      = get_the_content();

					$result[ $i ]['content']       = array( 'raw' => $block_content );
					$result[ $i ]['id']            = $block_post_id;
					$result[ $i ]['title']         = array( 'raw' => $block_title );
					$result[ $i ]['custom_fields'] = array( 'preview_image' => $block_preview_img );

					$i++;
				}
			} else {
				$result['status']  = false;
			}


			wp_reset_postdata();

			return new WP_REST_Response( $result, 200);

		}

		/**
		 * Fetch block category terms
		 * @return WP_REST_Response
		 */
		public function rgblocks_fetch_reusable_blocks_terms() {

			$block_terms = get_terms( array(
						'taxonomy' => 'block-category',
					)
				);

			return new WP_REST_Response( $block_terms, 200);
		}

	}

}