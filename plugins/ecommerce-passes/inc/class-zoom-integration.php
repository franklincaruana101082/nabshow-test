<?php
/**
 * Class for Zoom.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Zoom_Integration' ) ) {

	class Zoom_Integration {


		public function __construct() {

			// Add registrant on order completed.
			add_shortcode( 'zoom_link', array( $this, 'ep_zoom_shortcode' ), 10, 3 );

			// Check purchases and create zoom link.
			add_action( "wp_ajax_ep_zoom_link_creator", array( $this, "ep_ajax_zoom_link_creator" ) );
			add_action( "wp_ajax_nopriv_ep_zoom_link_creator", array( $this, "ep_ajax_zoom_link_creator" ) );
		}

		public function ep_ajax_zoom_link_creator() {

			$post_id                   = filter_input( INPUT_POST, "postid", FILTER_SANITIZE_STRING );
			$zoom_id_from_content_meta = get_post_meta( $post_id, 'zoom_id', true );
			$zoom_type                 = get_post_meta( $post_id, 'zoom_type', true );
			$zoom_type                 = ! empty( $zoom_type ) && isset( $zoom_type[0] ) ? $zoom_type[0] : '';
			$associate_products        = get_post_meta( $post_id, '_associate_product', true );
			$message = '';
			$code = 401;

			if ( empty( $zoom_id_from_content_meta ) || empty( $zoom_id_from_content_meta[0] ) ) {
				if ( current_user_can( 'administrator' ) ) {
					$message = "Hi Admin, please add zoom id in the edit screen of this page.";
					$code = 402;
				} // else keep the return blank.

			} else if ( empty( $associate_products ) ) {
				if ( current_user_can( 'administrator' ) ) {
					$message = "Hi Admin, please assign associated products to the content.";
					$code = 402;
				} // else keep the return blank.

			} else {
				// Zoom id and products are added in meta.

				if ( ! is_user_logged_in() ) {
					$message = "Please log in to see your purchased zoom link.";
					$code = 403;
				} else {
					// User logged in.

					$shop_blog_id    = Ecommerce_Passes::ep_get_shop_blog();
					$logged_user     = wp_get_current_user();
					$current_blog_id = get_current_blog_id();
					$shop_blog_url   = get_site_url( $shop_blog_id );

					// Rest Call: Check if user has purchased any of the assoicated produts.
					$end_point_url = $shop_blog_url . '/wp-json/nab/request/customer-get-bought-products/';

					$query_params = array(
						'user_email'  => $logged_user->user_email,
						'user_id'     => $logged_user->ID,
						'product_ids' => $associate_products
					);

					$final_params = http_build_query( $query_params );

					$curl = curl_init();

					curl_setopt_array( $curl, array(
						CURLOPT_URL            => $end_point_url,
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING       => "",
						CURLOPT_MAXREDIRS      => 10,
						CURLOPT_TIMEOUT        => 0,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST  => "POST",
						CURLOPT_POSTFIELDS     => $final_params
					) );

					$response = curl_exec( $curl );

					curl_close( $curl );

					$actually_bought = json_decode( $response );

					$zoom_unique_url = '';

					if ( 0 !== count( $actually_bought ) ) {

						// Parent Coding:
						// Create zoom link by passing required parameters!


						$end_point_url = $shop_blog_url . '/wp-json/zoom/add-registrant/';

						$query_params = array(
							'user_id'     => $logged_user->ID,
							'product_ids' => $actually_bought,
							'zoom_id'     => $zoom_id_from_content_meta,
							'zoom_type'   => $zoom_type,
							'blog_id'     => $current_blog_id,
							'post_id'     => $post_id
						);

						$final_params = http_build_query( $query_params );

						$curl = curl_init();

						curl_setopt_array( $curl, array(
							CURLOPT_URL            => $end_point_url,
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING       => "",
							CURLOPT_MAXREDIRS      => 10,
							CURLOPT_TIMEOUT        => 0,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST  => "POST",
							CURLOPT_POSTFIELDS     => $final_params
						) );

						$response = curl_exec( $curl );

						curl_close( $curl );

						$zoom_unique_url = json_decode( $response );

						// Response: a link!
						// Send back created link to ajax.

					} else {
						// No Product purchased.
						$code = 405;
					}

					if ( ! empty( $zoom_unique_url ) ) {
						$message = "<a href='$zoom_unique_url' class='button btn-primary' id='join-zooom-button' target='_blank'>Join Meeting</a>";
						$code = 200;
					} else {

						// Send email if $response has error and can not be decoded!
						//wp_mail( 'faisal.alvi@multidots.com', 'Zoom link generation failed.', $response . ' ||| ' . $final_params . '|||' . implode( '///', $actually_bought ) );

						// Wrap whole thing if user logged in to run ajax only when user is logged in.

						// Child Coding:
						// In this condition, the confirmed points are:
						// User has NO zoom link.

						// Condition to proceed:
						// Proceed only if content has zoom link and associated products in meta.
						// Check if usermeta has zoom link for the given zoom id, procced only if not available.

						// Parent coding:
						// Rest Call: Check if user has purchased any of the assoicated produts.
						// If yes, prepare array of purchased products, to assign it in user meta.


						$message = 'This meeting link is not available. Please be sure you\'ve purchased the correct pass to access this content. For additional assistance, click the "Help" button below.';
					}
				}

			}

			echo json_encode( array( 'code' => $code, 'message' => $message ) );
			wp_die();
		}

		// function that runs when shortcode is called
		public function ep_zoom_shortcode() {

			ob_start();

			$shop_blog_id = Ecommerce_Passes::ep_get_shop_blog();
			$user_id = get_current_user_id();
			$current_blog_id = get_current_blog_id();
			$post_id = get_the_ID();
			$zoom_id_from_content_meta = get_post_meta( $post_id, 'zoom_id', true );

			if ( ! is_user_logged_in() ) {
				echo "<p class='error zoom_text'>Please log in to see your purchased zoom link.</p>";

			} else if ( isset( $zoom_id_from_content_meta[0] ) && ! empty( $zoom_id_from_content_meta[0] ) ) {
				switch_to_blog($shop_blog_id);

				$zoom_links = get_user_meta( $user_id, "zoom_$current_blog_id", true );

				$zoom_unique_url = isset( $zoom_links[$post_id][$zoom_id_from_content_meta]['url'] ) ? $zoom_links[$post_id][$zoom_id_from_content_meta]['url'] : '';

				if( ! empty( $zoom_unique_url ) ) {
					echo  "<a href='$zoom_unique_url' class='button btn-primary' id='join-zooom-button' target='_blank'>Join Meeting</a>";
				} else {
					echo '<p class="error check-in-deep zoom_text">This meeting link is not available. Please be sure you\'ve purchased the correct pass to access this content. For additional assistance, click the "Help" button below.</p>';
				}

				wp_reset_query();
				// Quit multisite connection
				restore_current_blog();
			}

			$message = ob_get_clean();

			return $message;
		}

	}

	new Zoom_Integration();
}
