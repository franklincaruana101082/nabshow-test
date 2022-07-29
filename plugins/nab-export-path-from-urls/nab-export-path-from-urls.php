<?php
/*
Plugin Name: Export Paths from URLs
Description: Export a CSV file that contains the following columns: - Path (the path, not the URL - e.g. /company/cognizant-technology-solutions-u-s-corporation/ not https://amplify.nabshow.com/company/cognizant-technology-solutions-u-s-corporation/, - Post ID - the Post ID of the content on that page, - Post Type - e.g. Page, Company, Session, Article, etc. The CSV  content will show up before or on top of footer section in page once exported CSV file  exists. This plugin  creates a user request upon  export/navigating to export path amdin tool page. It utilize WP core Export Personal Data feature so can always navigate to Export Personal Data page under tool menu in  dmin Menu/Nav bar and can download the exported  csv file if user request is created. This is a workaround if WP file permission is a bit too strick
Version: 1.0.1
Author: Crush & Lovely
Contributor:Nab
*/
namespace Plugins\NabExportPathFromUrls;

require_once (WP_PLUGIN_DIR . '/nab-export-path-from-urls/cls-export-all-paths.php');

// add_action( 'admin_init', [new NabExportPathFromUrls, 'init_privacy_compat']);
class NabExportPathFromUrls extends \Plugins\NabExportPathFromUrls\ExportAllPaths
{
	public function __construct()
	{
		// register_activation_hook( __FILE__, array( 'ExportAllPaths', 'plugin_activation' ) );
		// register_deactivation_hook( __FILE__, array( 'ExportAllPaths', 'plugin_deactivation' ) );

		if (is_admin()) {

			// Display a link to the VIP/Automattic Privacy Policy if the site doesn't already define one.
			add_action( 'the_privacy_policy_link', __NAMESPACE__ . '\the_vip_privacy_policy_link', PHP_INT_MAX ); // Hook in later so we don't override existing filters

			add_filter('admin_menu', [ $this, 'export_paths_from_urls_nav']);

			add_action( 'admin_init', [ $this, 'export_paths_from_urls_activation'] );

			add_action( 'admin_init', [$this, 'init_privacy_compat']);

		}else{
			add_filter('the_content',[$this, 'nabshow_content_after_body']);
		}

		add_action( 'init', [$this, 'init_privacy_compat_cleanup']);

	}

	public function init_privacy_compat() {
		// Replace core's privacy data export handler with a custom one.
		// remove_action( 'wp_privacy_personal_data_export_file', 'wp_privacy_generate_personal_data_export_file', 10 );
		remove_action( 'wp_privacy_personal_data_export_file', 'wp_privacy_generate_personal_data_export_file', 10 );
		add_action( 'wp_privacy_personal_data_export_file', [$this, 'nab_generate_personal_data_export_file'] );

	}

	public function init_privacy_compat_cleanup() {
		// Replace core's privacy data delete handler with a custom one.
		remove_action( 'wp_privacy_delete_old_export_files', 'wp_privacy_delete_old_export_files' );
		add_action( 'wp_privacy_delete_old_export_files', [$this, 'delete_old_export_files']  );
	}

	public function export_paths_from_urls_nav(){

		add_management_page( 'Export Paths from URLs', 'Export Paths from URLs', 'manage_options', 'extract-paths-from-urls-settings', [$this, 'export_path_from_urls_settings_page'], null);

	}
	public function export_path_from_urls_settings_page(){

		require WP_PLUGIN_DIR . '/nab-export-path-from-urls/cls-export-all-path-from-urls-settings.php';
	}

	public function export_paths_from_urls_activation() {
		if ( ! get_transient( 'eau_export_all_urls_activation_redirect' ) ) {
			return;
		}

		delete_transient( 'eau_export_all_urls_activation_redirect' );

		wp_safe_redirect( add_query_arg( array( 'page' => 'extract-all-urls-settings' ), admin_url( 'tools.php' )) );
		exit;

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

new NabExportPathFromUrls();
