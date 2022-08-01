<?php
namespace Plugins\NabExportPathFromUrls\Classes;

use function Automattic\VIP\Files\new_api_client;
use Plugins\NabExportPathFromUrls\Classes\ExportMeta;


require_once (WP_PLUGIN_DIR . '/nab-export-path-from-urls/classes/cls-export-meta.php');

use DirectoryIterator;

class ExportToZip extends ExportMeta
{
	public function __construct()
	{
		parent::__construct();
		$this->init_export_meta();
	}

	function _ziparchive_create_file( $archive_path, $html_report_path, $csv_pathname ) {
		$archive = new \ZipArchive();
		$this->init_export_meta();
		$file_basename = $this->getFilename();
		$jsonfile = $this->getJsonFile();

		$html_report_filename = "{$file_basename}.html";
		$json_report_filename =  "{$file_basename}.json";
		$json_report_pathname = $jsonfile;
		$csv_report_filename = "{$file_basename}.csv";

		$archive_created = $archive->open( $archive_path, \ZipArchive::CREATE );
		if ( true !== $archive_created ) {
			return new \WP_Error( 'ziparchive-open-failed', __( 'Failed to create a `zip` file using `ZipArchive`' ) );
		}

		$file_added = $archive->addFile( $html_report_path, $html_report_filename );
		if ( ! $file_added ) {
			$archive->close();

			return new \WP_Error( 'ziparchive-add-failed', __( 'Unable to add data to export file.' ) );
		}

		$file_added = $archive->addFile( $json_report_pathname, $json_report_filename);
		if ( ! $file_added ) {
			$archive->close();

			return new \WP_Error( 'ziparchive-add-failed', __( 'Unable to add data to export file.' ) );
		}

		$file_added = $archive->addFile( $csv_pathname, $csv_report_filename);
		if ( ! $file_added ) {
			$archive->close();

			return new \WP_Error( 'ziparchive-add-failed', __( 'Unable to add data to export file.' ) );
		}

		$archive->close();

		return true;
	}

	public function _upload_archive_file( $archive_path, $zip_remote_file ) {
		// For local usage, skip the remote upload.
		// The file is already in the uploads folder.
		if ( true !== WPCOM_IS_VIP_ENV ) {
			return true;
		}


		$upload_path       = $zip_remote_file;

		$api_client    = new_api_client();
		$upload_result = $api_client->upload_file( $archive_path, $upload_path );

		// Delete the local copy of the archive since it's been uploaded.
		unlink( $archive_path );

		return $upload_result;
	}

	public function _delete_archive_file( $archive_url ) {
		$archive_path = wp_parse_url( $archive_url, PHP_URL_PATH );

		// For local usage, just delete locally.
		if ( true !== WPCOM_IS_VIP_ENV ) {
			unlink( WP_CONTENT_DIR . $archive_path );
			return true;
		}

		$api_client = new_api_client();
		return $api_client->delete_file( $archive_path );
	}

	/**
	 * This is very different from the core implementation.
	 *
	 * Rather than filesystem time stamps, we store the time in meta, and query against that to find old, expired requests.
	 */
	public function delete_old_export_files() {
		global $wpdb;

		/** This filter is documented in wp-includes/functions.php */
		$expiration           = apply_filters( 'wp_privacy_export_expiration', 3 * DAY_IN_SECONDS );
		$expiration_timestamp = time() - $expiration;

		// phpcs:ignore WordPress.DB.DirectDatabaseQuery -- direct query to avoid the unnecessary overhead of WP_Query.
		$file_urls = $wpdb->get_col(
			$wpdb->prepare( "SELECT pm.meta_value FROM $wpdb->postmeta AS pm
				INNER JOIN $wpdb->postmeta AS expiry
					ON expiry.post_id = pm.post_id
					AND expiry.meta_key = '_vip_export_generated_time'
					AND expiry.meta_value <= %d
				WHERE pm.meta_key = '_export_file_url'
				LIMIT 100", $expiration_timestamp
			)
		);

		if ( empty( $file_urls ) ) {
			return;
		}

		foreach ( $file_urls as $file_url ) {
			$delete_result = $this->_delete_archive_file( $file_url );
			if ( is_wp_error( $delete_result ) ) {
				/* translators: 1: archive file URL 2: error message */
				$message = sprintf( __( 'Failed to delete expired personal data export (%1$s): %2$s' ), $file_url, $delete_result->get_error_message() );

				// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
				trigger_error( esc_html( $message ), E_USER_WARNING );
			}
		}
	}

	public function import_export_archived_file($fs_dir, $file_csv, $file_json, $file_html, $filename)
		{

			if ( isset( $_POST['export'] ) ) {
				$zip_filename = "{$filename}.zip";
				$json_filename = "{$filename}.json";
				$html_filename = "{$filename}.html";
				$csv_filename = "{$filename}.csv";
				$zip_file = "{$fs_dir}{$zip_filename}";
				$json_file = "{$fs_dir}{$zip_filename}";
				$html_file = "{$fs_dir}{$zip_filename}";
				$csv_file = "{$fs_dir}{$zip_filename}";

				// check_admin_referer( 'export_path_from_urls' );
				// Load Importer API.
				require_once wp_normalize_path( ABSPATH . 'wp-admin/includes/export.php' );

				$this->download_csv_archive_file($csv_file, $csv_filename);

				wp_mkdir_p( $fs_dir );

				$url   = wp_nonce_url( 'tools.php?page=extract-paths-from-urls-settings' );
				$creds = request_filesystem_credentials( $url, '', false, false, null );
				if ( false === $creds ) {
					return; // Stop processing here.
				}

				if ( WP_Filesystem( $creds ) ) {
					global $wp_filesystem;
					if ( ! $wp_filesystem->put_contents( $file_json, $json_file, FS_CHMOD_FILE ) ||
								! $wp_filesystem->put_contents( $file_html, $html_file, FS_CHMOD_FILE ) ||
								! $wp_filesystem->put_contents( $file_csv, $csv_file, FS_CHMOD_FILE )
								) {
						echo 'Couldn\'t export sliders, make sure wp-content/uploads is writeable.';
					}

					// Initialize archive object.
					$zip = new ZipArchive();
					$zip->open( $fs_dir . $zip_filename, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE );

					$files_iterator = new DirectoryIterator( $fs_dir );

					foreach ( $files_iterator as $file ) {
						if ( $file->isDot() ) {
							continue;
						}

						$zip->addFile( $fs_dir . $file->getFilename(), $file->getFilename() );
					}

					$zip_file = $zip->filename;

					// Zip archive will be created only after closing object.
					$zip->close();

					// Remove the JSON file.
					unlink( $json_file );

					// Remove the HTML file.
					unlink( $html_file );


				}
			}
		}

		public function download_csv_archive_file($csv_file,$filename){

			// Forces the download of the CSV instead of echoing
			header( 'Content-Disposition: attachment; filename=' . $filename );
			header( 'Pragma: no-cache' );
			header( 'Expires: 0' );
			header( 'Content-Type: text/csv; charset=utf-8');
			ob_clean();
			flush();
			readfile( $csv_file ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		}
		public function download_zip_archive_file($zip_file){
			header( 'X-Accel-Buffering: no' );
			header( 'Pragma: public' );
			header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
			header( 'Content-Length: ' . filesize( $zip_file ) );
			header( 'Content-Type: application/octet-stream' );
			header( 'Content-Disposition: attachment; filename="archive.zip"' );
			ob_clean();
			flush();
			readfile( $zip_file ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		}
}
