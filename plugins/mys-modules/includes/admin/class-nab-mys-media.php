<?php
/**
 * Uploading Third Party Images to WP Media.
 *
 * @package MYS Modules
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'NAB_MYS_MEDIA' ) ) {

	class NAB_MYS_MEDIA {

		/**
		 * Class Constructor
		 */
		public function __construct() {

			$image_url    = 'https://thumbs.dreamstime.com/z/tragic-actor-theater-stage-man-medieval-suit-retro-cartoon-character-design-vector-illustration-77130060.jpg';

			//$this->nab_mys_upload_media( 15, $image_url);

		}

		/**
		 * Create Custom DB Tables if not alread created
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_upload_media( $post_id, $imageurl ) {

			if ( $imageurl ) {
				$imageurl    = stripslashes( $imageurl );
				$uploads     = wp_upload_dir();
				$post_id     = isset( $post_id ) ? (int) $post_id : 0;
				$newfilename = basename( $imageurl );

				require_once( ABSPATH . '/wp-includes/pluggable.php' );

				$filename    = wp_unique_filename( $uploads['path'], $newfilename, $unique_filename_callback = null );
				$wp_filetype = wp_check_filetype( $filename, null );

				$fullpathfilename = $uploads['path'] . "/" . $filename;

				try {
					if ( ! substr_count( $wp_filetype['type'], "image" ) ) {
						throw new Exception( basename( $imageurl ) . ' is not a valid image. ' . $wp_filetype['type'] . '' );
					}


					$image_string = $this->nab_mys_fetch_image( $imageurl );

					$fileSaved = file_put_contents( $uploads['path'] . "/" . $filename, $image_string );
					if ( ! $fileSaved ) {
						throw new Exception( "The file cannot be saved." );
					}

					$attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
						'post_content'   => '',
						'post_status'    => 'inherit',
						'guid'           => $uploads['url'] . "/" . $filename
					);

					$attach_id  = wp_insert_attachment( $attachment, $fullpathfilename, $post_id );
					if ( ! $attach_id ) {
						throw new Exception( "Failed to save record into database." );
					}

					require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
					$attach_data = wp_generate_attachment_metadata( $attach_id, $fullpathfilename );
					wp_update_attachment_metadata( $attach_id, $attach_data );


					//ne_coded
					set_post_thumbnail( $post_id, $attach_id );



				} catch ( Exception $e ) {
					$error = '<div id="message" class="error"><p>' . $e->getMessage() . '</p></div>';
				}

				return true;

					echo '<pre>';
					print_r(get_defined_vars());
					die('<br><---died here');

			}

		}

		public function nab_mys_fetch_image( $url ) {
			if ( function_exists( "curl_init" ) ) {
				return $this->nab_mys_curl_fetch_image( $url );
			} elseif ( ini_get( "allow_url_fopen" ) ) {
				return $this->nab_mys_fopen_fetch_image( $url );
			}
		}

		public function nab_mys_curl_fetch_image( $url ) {

			//ne_info
			// please use `wpcom_vip_file_get_contents()` or `vip_safe_wp_remote_get()` instead
			$ch = curl_init();
			curl_setopt( $ch, CURLOPT_URL, $url );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
			$image = curl_exec( $ch );
			curl_close( $ch );

			return $image;
		}

		public function nab_mys_fopen_fetch_image( $url ) {
			$image = file_get_contents( $url, false, $context );

			return $image;
		}



	}
}
