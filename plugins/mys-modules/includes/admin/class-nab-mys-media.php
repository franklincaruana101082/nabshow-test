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
		 * Create Custom DB Tables if not already created
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_upload_media( $post_id, $imageurl, $post_type ) {

			if ( $imageurl ) {
				$imageurl    = stripslashes( $imageurl );
				$uploads     = wp_upload_dir();
				$post_id     = isset( $post_id ) ? (int) $post_id : 0;
				$newfilename = basename( $imageurl );

				require_once( ABSPATH . '/wp-includes/pluggable.php' );

				$filename         = $post_type . '-' . $newfilename;
				$wp_filetype      = wp_check_filetype( $filename, null );
				$fullpathfilename = $uploads['path'] . "/" . $filename;

				try {
					if ( ! substr_count( $wp_filetype['type'], "image" ) ) {
						throw new Exception( basename( $imageurl ) . ' is not a valid image. ' . $wp_filetype['type'] . '' );
					}

					$media_title = preg_replace( '/\.[^.]+$/', '', $filename );

					$attachmend_data = wpcom_vip_get_page_by_title( $media_title, OBJECT, 'attachment' );

					if ( isset( $attachmend_data ) && isset( $attachmend_data->ID ) && "tracks" !== $post_type ) {

						set_post_thumbnail( $post_id, $attachmend_data->ID );

						return "old:$attachmend_data->ID";
					}

					$image_string = wpcom_vip_file_get_contents( $imageurl );

					//The below line is ignored on the basis of https://wpvip.com/documentation/vip-go/writing-files-on-vip-go/
					$fileSaved = file_put_contents( $uploads['path'] . "/" . $filename, $image_string ); //phpcs:ignore

					if ( ! $fileSaved ) {
						throw new Exception( "The file cannot be saved." );
					}

					$attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title'     => $media_title,
						'post_content'   => '',
						'post_status'    => 'inherit',
						'guid'           => $uploads['url'] . "/" . $filename
					);

					if ("tracks" !== $post_type) {
						$attach_id = wp_insert_attachment( $attachment, $fullpathfilename, $post_id );
					} else {
						$attach_id = wp_insert_attachment( $attachment, $fullpathfilename );
					}

					if ( ! $attach_id ) {
						throw new Exception( "Failed to save record into database." );
					}

					require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
					$attach_data = wp_generate_attachment_metadata( $attach_id, $fullpathfilename );
					wp_update_attachment_metadata( $attach_id, $attach_data );

					if ("tracks" !== $post_type) {
						//ne_coded
						set_post_thumbnail( $post_id, $attach_id );
					} else {
						update_term_meta( $post_id, 'tracks-image-id', $attach_id );
					}

					return "new:$attach_id";

				} catch ( Exception $e ) {
					echo '<div id="message" class="error"><p>' . esc_html( $e->getMessage() ) . '</p></div>';
				}

			}

		}

	}
}
