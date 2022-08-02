<?php
/*
Plugin Name: Export Paths from URLs
Description: Export a CSV file that contains the following columns: - 1.) Path (the path, not the URL - e.g. /company/cognizant-technology-solutions-u-s-corporation/ not https://amplify.nabshow.com/company/cognizant-technology-solutions-u-s-corporation/, - 2.) Post ID - the Post ID of the content on that page, - 3.) Post Type - e.g. Page, Company, Session, Article, etc.
Version: 1.0.1
Author: Crush & Lovely
Contributor:Codev
*/
namespace Plugins\NabExportPathFromUrls;

require_once (WP_PLUGIN_DIR . '/nab-export-path-from-urls/classes/cls-export-to-zip.php');
require_once (WP_PLUGIN_DIR . '/nab-export-path-from-urls/classes/cls-export-all-path-func.php');

use Plugins\NabExportPathFromUrls\Classes\ExportAllPathsFunc;
use Plugins\NabExportPathFromUrls\Classes\ImportExportArchivedFiles;

class NabExportPathFromUrls extends ExportAllPathsFunc
{
	public function __construct()
	{
		parent::__construct();

		// // Unrestrict All Files Temporarily
		add_filter( 'pre_option_vip_files_acl_restrict_all_enabled', function( $value ) { return 0; } );
		add_filter( 'pre_option_uploads_use_yearmonth_folders', '__return_false' );
		add_filter( 'upload_dir', [$this, 'nab_upload_dir'], 100 );

		if (is_admin()) {

			// Display a link to the VIP/Automattic Privacy Policy if the site doesn't already define one.
			add_action( 'the_privacy_policy_link', __NAMESPACE__ . '\the_vip_privacy_policy_link', PHP_INT_MAX ); // Hook in later so we don't override existing filters

			add_filter('admin_menu', [ $this, 'export_paths_from_urls_nav']);

			add_action( 'admin_init', [ $this, 'export_paths_from_urls_activation'] );

			add_action( 'admin_init', [$this, 'init_privacy_compat']);

		}else{
			add_filter('the_content',[$this, 'nabshow_content_after_body'],999);
		}

	}

	function nab_upload_dir( $dir ) {
		$dir['subdir'] = '/';
		$dir['path'] = $dir['basedir'] . $dir['subdir'];
		$dir['url'] = $dir['baseurl'] . $dir['subdir'];

		return $dir;
	}

	public function init_privacy_compat() {
		// Replace core's privacy data export handler with a custom one.
		remove_action( 'wp_privacy_personal_data_export_file', 'wp_privacy_generate_personal_data_export_file', 10 );
		add_action( 'wp_privacy_personal_data_export_file', [$this, 'nab_generate_personal_data_export_file'] );

	}

	public function export_paths_from_urls_nav($nav){

		add_management_page( 'Export Paths from URLs', 'Export Paths from URLs', 'manage_options', 'extract-paths-from-urls-settings', [$this, 'export_path_from_urls_settings_page'], null);

		return $nav;
	}
	public function export_path_from_urls_settings_page(){

		require( WP_PLUGIN_DIR . '/nab-export-path-from-urls/includes/cls-export-all-path-from-urls-settings.php');
	}

	public function export_paths_from_urls_activation() {
		if ( ! get_transient( 'eau_export_all_urls_activation_redirect' ) ) {
			return;
		}

		delete_transient( 'eau_export_all_urls_activation_redirect' );

		wp_safe_redirect( add_query_arg( array( 'page' => 'extract-all-urls-settings' ), admin_url( 'tools.php' )) );
		exit;
	}

	public function nab_generate_personal_data_export_file($request_id){
		$request_generate_export_zip_file =  new ImportExportArchivedFiles;
		$request_generate_export_zip_file->generate_zip_personal_data_export_file($request_id);
	}
	// =================

	// This function attached on the_content hook is intended to display the CSV Content.
	// Can be In Admin or anywhere from site.. That includes Nabshow Amplify
	public function nabshow_content_after_body($content){

		$rowdata = $this->retrieve_exported_file_to_array();

		if(empty($rowdata)) return $content;

		$rowspagination = $this->get_rows_pagination($rowdata);

		$content = $rowspagination;

		$escjs =  "<script>
					jQuery(function(){
						var body = document.body,
						html = document.documentElement;

						var height = Math.max( body.scrollHeight, body.offsetHeight,
										html.clientHeight, html.scrollHeight, html.offsetHeight );
						var scroll_pos=(height);
						jQuery('html, body').animate({scrollTop:(scroll_pos)}, '2000');
					});
				</script>";

		$content .= $escjs;

		return $content;
	}


}

new NabExportPathFromUrls;
