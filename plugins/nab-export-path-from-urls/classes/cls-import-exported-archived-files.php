<?php

namespace Plugins\NabExportPathFromUrls\Classes;

require_once(WPMU_PLUGIN_DIR . '/a8c-files.php');
require_once(WPMU_PLUGIN_DIR . '/files/class-curl-streamer.php');
require_once(WPMU_PLUGIN_DIR . '/files/class-api-cache.php');
require_once(WPMU_PLUGIN_DIR . '/files/class-path-utils.php');
require_once(WPMU_PLUGIN_DIR . '/files/class-api-client.php');

use DirectoryIterator;

class ImportExportArchivedFiles
{

		public function generate_zip_personal_data_export_file( $request_id ) {

			$html = "";

			// Get the request.
			$request = wp_get_user_request( $request_id );
			$email_address = $request->email;

			$path = $this->getPath();
			$csv_file =  $this->getCsvFile(); // getCsvFile already includes path
			$csv_url =  $this->getCsvUrl();
			$file_basename = $this->getFilename();
			$htmlfile = $this->getHtmlFile();
			$jsonfile = $this->getJsonFile();
			$zipfile = $this->getZipFile();

			$html_report_pathname = $htmlfile;
			$zip_report_filename =  "{$file_basename}.zip";
			$json_report_pathname = $jsonfile;

			/*
			* Gather general data needed.
			*/

			// Title.
			$title = sprintf(
				/* translators: %s: User's email address. */
				__( 'Personal Data Export for %s' ),
				$email_address
			);

			// And now, all the Groups.
			$groups = get_post_meta( $request_id, '_export_data_grouped', true );

			// First, build an "About" group on the fly for this report.
			$about_group = array(
				/* translators: Header for the About section in a personal data export. */
				'group_label'       => _x( 'About', 'personal data group label' ),
				/* translators: Description for the About section in a personal data export. */
				'group_description' => _x( 'Overview of export report.', 'personal data group description' ),
				'items'             => array(
					'about-1' => array(
						array(
							'name'  => _x( 'Report generated for', 'email address' ),
							'value' => $email_address
						),
						array(
							'name'  => _x( 'For site', 'website name' ),
							'value' => get_bloginfo( 'name' ),
						),
						array(
							'name'  => _x( 'At URL', 'website URL' ),
							'value' => get_bloginfo( 'url' ),
						),
						array(
							'name'  => _x( 'On', 'date/time' ),
							'value' => current_time( 'mysql' ),
						),
					),
				),
			);

			$groups = !empty($groups) ? $groups : [];
			// Merge in the special about group.
			$groups = array_merge( array( 'about' => $about_group ), $groups );

			$groups_count = count( $groups );

			// Convert the groups to JSON format.
			$groups_json = wp_json_encode( $groups );


			$json_res = $this->create_save_json_file($title, $groups_json);
			$html .= $json_res['html'];
			$json_file = $json_res['file_json'];

			$html_res = $this->create_save_html_file($title, $groups, $groups_count);
			$html .= $html_res['html'];
			$html_file = $html_res['file_html'];
			/*
			* Now, generate the ZIP.
			*
			* If an archive has already been generated, then remove it and reuse the filename,
			* to avoid breaking any URLs that may have been previously sent via email.
			*/
			$error = false;

			// This meta value is used from version 5.5.
			$archive_filename = get_post_meta( $request_id, '_export_file_name', true );

			// This one stored an absolute path and is used for backward compatibility.
			$archive_pathname = get_post_meta( $request_id, '_export_file_path', true );

			// If a filename meta exists, use it.
			if ( ! empty( $archive_filename ) ) {
				$archive_pathname = "{$path}/{$archive_filename}";
			} elseif ( ! empty( $archive_pathname ) && is_file( $archive_pathname ) ) {
				// If a full path meta exists, use it and create the new meta value.
				$archive_filename = basename( $archive_pathname );

				update_post_meta( $request_id, '_export_file_name', $archive_filename );

				// Remove the back-compat meta values.
				delete_post_meta( $request_id, '_export_file_url' );
				delete_post_meta( $request_id, '_export_file_path' );
			} else {
				// If there's no filename or full path stored, create a new file.
				$archive_filename = $zip_report_filename;
				$archive_pathname = $zipfile;

				update_post_meta( $request_id, '_export_file_name', $archive_filename );
			}

			$archive_url = "{$csv_url}/{$zip_report_filename}";

			if ( ! empty( $archive_pathname ) && is_file( $archive_pathname ) ) {
				wp_delete_file( $archive_pathname );
			}

			// Track generated time to simplify deletions.
			// We can't currently iterate through files in the Files Service so we need a way to query exports by date.
			update_post_meta( $request_id, '_vip_export_generated_time', time() );

			// Hack: ZipArchive and PclZip don't support streams.
			// So, let's force the path to use a local one in the temp dir, which will work.
			// All other references (meta) will still use the correct stream URL.
			$local_archive_pathname = $archive_pathname;

			if ( $error ) {
				$html .= "<li>- $error</li>" ;
			} else {

				/** This filter is documented in wp-admin/includes/file.php */
				do_action( 'wp_privacy_personal_data_export_file_created', $local_archive_pathname, $archive_url, $html_report_pathname, $request_id, $json_report_pathname,  $csv_file);

				$html .= $this->import_export_archived_file($path, $json_file, $html_file, $file_basename);

			}

			return $html;
		}

		public function create_save_json_file($title, $groups_json){
			$html = "";
			/*
			* Handle the JSON export.
			*/
			// phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_read_fopen
			// $file = fopen( $json_report_pathname, 'w' );
			$file_json = fopen( 'php://output', 'w' );

			if ( false === $file_json ) {
				$html .= "<li>Unable to open export file (JSON report) for writing.</li>";
			}

			fwrite( $file_json, '{' );
			fwrite( $file_json, '"' . $title . '":' );
			fwrite( $file_json, $groups_json );
			fwrite( $file_json, '}' );
			fclose( $file_json );

			return  ['file_json' => $file_json, 'html' => $html];
		}

		public function create_save_html_file($title, $groups, $groups_count){
			$html = "";
			/*
			* Handle the HTML export.
			*/
			// phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_read_fopen
			// $file = fopen( $html_report_pathname, 'w' );
			$file_html = fopen( 'php://output', 'w' );

			if ( false === $file_html ) {
				$html .= "<li>- Unable to open export file (HTML report) for writing.</li>";
			}

			fwrite( $file_html, "<!DOCTYPE html>\n" );
			fwrite( $file_html, "<html>\n" );
			fwrite( $file_html, "<head>\n" );
			fwrite( $file_html, "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />\n" );
			fwrite( $file_html, "<style type='text/css'>" );
			fwrite( $file_html, 'body { color: black; font-family: Arial, sans-serif; font-size: 11pt; margin: 15px auto; width: 860px; }' );
			fwrite( $file_html, 'table { background: #f0f0f0; border: 1px solid #ddd; margin-bottom: 20px; width: 100%; }' );
			fwrite( $file_html, 'th { padding: 5px; text-align: left; width: 20%; }' );
			fwrite( $file_html, 'td { padding: 5px; }' );
			fwrite( $file_html, 'tr:nth-child(odd) { background-color: #fafafa; }' );
			fwrite( $file_html, '.return-to-top { text-align: right; }' );
			fwrite( $file_html, '</style>' );
			fwrite( $file_html, '<title>' );
			fwrite( $file_html, esc_html( $title ) );
			fwrite( $file_html, '</title>' );
			fwrite( $file_html, "</head>\n" );
			fwrite( $file_html, "<body>\n" );
			fwrite( $file_html, '<h1 id="top">' . esc_html__( 'Personal Data Export' ) . '</h1>' );

			// Create TOC.
			if ( $groups_count > 1 ) {
				fwrite( $file_html, '<div id="table_of_contents">' );
				fwrite( $file_html, '<h2>' . esc_html__( 'Table of Contents' ) . '</h2>' );
				fwrite( $file_html, '<ul>' );
				foreach ( (array) $groups as $group_id => $group_data ) {
					$group_label       = esc_html( $group_data['group_label'] );
					$group_id_attr     = sanitize_title_with_dashes( $group_data['group_label'] . '-' . $group_id );
					$group_items_count = count( (array) $group_data['items'] );
					if ( $group_items_count > 1 ) {
						$group_label .= sprintf( ' <span class="count">(%d)</span>', $group_items_count );
					}
					fwrite( $file_html, '<li>' );
					fwrite( $file_html, '<a href="#' . esc_attr( $group_id_attr ) . '">' . $group_label . '</a>' );
					fwrite( $file_html, '</li>' );
				}
				fwrite( $file_html, '</ul>' );
				fwrite( $file_html, '</div>' );
			}

			// Now, iterate over every group in $groups and have the formatter render it in HTML.
			foreach ( (array) $groups as $group_id => $group_data ) {
				fwrite( $file_html, wp_privacy_generate_personal_data_export_group_html( $group_data, $group_id, $groups_count ) );
			}

			fwrite( $file_html, "</body>\n" );
			fwrite( $file_html, "</html>\n" );
			fclose( $file_html );


			return  ['file_html' => $file_html, 'html' => $html];
		}
		public function create_csv_file($urls, $count,$error_msg ="",$haserror=false){
			// phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_read_fopen
			// $file_csv = fopen( $csv_file, 'w+');
			$file_csv = fopen( 'php://output', 'w' );
			fputs($file_csv, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

			// if ( false === $file_csv ) {
			// 	$haserror = true;
			// 	$error_msg .= "<li>- Unable to open CSV export file.</li>";
			// }

			// if($haserror ){
			// 	$haserror = true;
			// 	$error_msg .= "<li>- Invalid request ID when generating export file.</li>";
			// }

			/*
			* Create the Exported Path from Urls CSV file.
			*/

			$headers[] = '#';
			$headers[] = 'Post ID';
			$headers[] = 'Post Type';
			$headers[] = 'Paths';

			fputcsv($file_csv, $headers); // phpcs:ignore WordPressVIPMinimum.Functions.RestrictedFunctions.file_ops_fputcsv

			for ($i = 0; $i < $count; $i++) {
				$data = array(
					$urls['seq'][$i] ,
					isset($urls['post_id']) ? $urls['post_id'][$i] : "",
					isset($urls['post_type']) ? $urls['post_type'][$i] : "",
					isset($urls['path']) ? $urls['path'][$i] : ""
				);

				fputcsv($file_csv, $data); // phpcs:ignore WordPressVIPMinimum.Functions.RestrictedFunctions.file_ops_fputcsv
			}

			fclose($file_csv);

			return [
				'haserror' => $haserror,
				'error_msg' => $error_msg,
				'file_csv' => $file_csv
			];
		}

		public function import_export_archived_file($fs_dir, $file_json, $file_html,$file_csv, $filename)
		{
			$html = "";
			if ( isset( $_POST['export'] ) ) {

				// check_admin_referer( 'export_path_from_urls' );

				// Load Importer API.
				require_once wp_normalize_path( ABSPATH . 'wp-admin/includes/export.php' );

				$this->download_csv_archive_file($filename);

				if(!file_exists($fs_dir)) wp_mkdir_p( $fs_dir );

				$url   = wp_nonce_url( 'tools.php?page=extract-paths-from-urls-settings' );
				$creds = request_filesystem_credentials( $url, '', false, false, null );
				if ( false === $creds ) {
					return; // Stop processing here.
				}

				if ( WP_Filesystem( $creds ) ) {
					global $wp_filesystem;
					$zip_filename = "{$filename}.zip";
					$json_filename = "{$filename}.json";
					$html_filename = "{$filename}.html";
					$csv_filename = "{$filename}.csv";
					if ( ! $wp_filesystem->put_contents( $zip_file, $fs_dir . $zip_filename, FS_CHMOD_FILE ) ||
								! $wp_filesystem->put_contents( $file_json, $fs_dir . $json_filename, FS_CHMOD_FILE ) ||
								! $wp_filesystem->put_contents( $file_html, $fs_dir . $html_filename, FS_CHMOD_FILE ) ||
								! $wp_filesystem->put_contents( $file_csv, $fs_dir . $csv_filename, FS_CHMOD_FILE )
								) {
						$html .= "<li>- Couldn\'t export sliders, make sure wp-content/uploads is writeable.";
					} else {
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

						header( 'X-Accel-Buffering: no' );
						header( 'Pragma: public' );
						header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
						header( 'Content-Length: ' . filesize( $zip_file ) );
						header( 'Content-Type: application/octet-stream' );
						header( 'Content-Disposition: attachment; filename="archive.zip"' );
						ob_clean();
						flush();
						readfile( $zip_file ); // phpcs:ignore WordPress.WP.AlternativeFunctions

						$files_iterator = new DirectoryIterator( $fs_dir );
						foreach ( $files_iterator as $file ) {
							if ( $file->isDot() ) {
								continue;
							}

							$this->filesystem()->delete( $fs_dir . $file->getFilename() );
						}
					}
				}
			}
			return $html;
		}

		public function download_csv_archive_file($filename){
			ob_start();

			// Forces the download of the CSV instead of echoing
			header( 'Content-Disposition: attachment; filename=' . $filename );
			header( 'Pragma: no-cache' );
			header( 'Expires: 0' );
			header( 'Content-Type: text/csv; charset=utf-8');


			ob_get_clean();
			exit;
		}
}
