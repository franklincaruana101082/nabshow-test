<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Amplify
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function nab_amplify_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_filter( 'body_class', 'nab_amplify_body_classes' );

/**
 * Retrieves the user images.
 *
 * @return array list of user images
 */
function nab_amplify_get_user_images() {

	$user_id           = get_current_user_id();
	$user_images_names = array( 'profile_picture', 'banner_image' );

	$user_images = array();
	foreach ( $user_images_names as $user_image ) {
		$user_image_id = get_user_meta( $user_id, $user_image, true );

		$user_images[ $user_image ] = $user_image_id
			? wp_get_attachment_image_src( $user_image_id )[0]
			: get_template_directory_uri() . '/assets/images/avtar.jpg';
	}

	return $user_images;
}

add_action( 'rest_api_init', 'nab_amplify_rest_points');
function nab_amplify_rest_points() {
	register_rest_route(
		'import', '/coupons', array(
			'methods' => 'GET',
			'callback' => 'nab_amplify_import_coupons',
		)
	);
}

function nab_amplify_import_coupons( WP_REST_Request $request ) {

	$parameters    = $request->get_params();
	$attachment_id = isset( $parameters['attachment_id'] ) ? $parameters['attachment_id'] : '';
	$filepath      = get_attached_file( $attachment_id );
	$post_type     = 'shop_coupon';

	if ( filter_input( INPUT_GET, "delete", FILTER_SANITIZE_STRING ) ) {
		global $wpdb;

		$wipe_query = $wpdb->query(
			$wpdb->prepare( "DELETE a,b,c
			    FROM {$wpdb->prefix}posts a
			    LEFT JOIN {$wpdb->prefix}term_relationships b
			        ON (a.ID = b.object_id)
			    LEFT JOIN {$wpdb->prefix}postmeta c
			        ON (a.ID = c.post_id)
			    WHERE a.post_type = %s", $post_type ) );

		die( 'deleted' );

	} else if ( filter_input( INPUT_GET, "add", FILTER_SANITIZE_STRING ) ) {

		$file         = fopen( $filepath, 'r' );
		$import_count = 0;
		while ( ( $line = fgetcsv( $file ) ) !== false ) {


			if ( ! get_page_by_title( $line[0], OBJECT, $post_type ) ) {
				$inserted_id = wp_insert_post( array(
					'post_title'   => $line[0],
					'post_type'    => $post_type,
					'post_content' => $line[1],
					'post_status'  => 'publish',
					'meta_input'   => array(
						'discount_type' => $line[2],
						'coupon_amount' => $line[3],
						'product_ids'   => $line[4],
						'usage_limit'   => $line[5]
					)
				) );
				$import_count ++;
				echo "'$line[0]' coupon added successfully [$inserted_id].\n";
			} else {
				echo "'$line[0]' coupon already exist.\n";
			}
		}

		echo "\n\nTotal $import_count coupons imported successfully!";

		return;

	} else {

		global $wpdb;

		$posts = get_posts([
			'post_type' => $post_type,
			'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'),
			'numberposts' => -1
			// 'order'    => 'ASC'
		]);

		$data = $status_count = array();
		foreach ( $posts as $post ) {
			$metas = get_post_meta( $post->ID, '', true );
			$data[$post->ID]['title'] = $post->post_title;
			$data[$post->ID]['status'] = $post->post_status;
			$status_count[$post->post_status] = 1;
			foreach ( $metas as $key => $value ) {
				$data[$post->ID][$key] = $value[0];
			}

		}
		echo 'Total '. count($data) . ' coupons found';
		echo '<pre>';
		print_r($data);
		die('<br><---died here');



	}
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function nab_amplify_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'nab_amplify_pingback_header' );
