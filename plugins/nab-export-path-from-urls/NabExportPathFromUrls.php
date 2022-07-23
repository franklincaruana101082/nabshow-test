<?php

/*
Plugin Name: Export Paths from URLs
Plugin URI: https://AtlasGondal.com/
Description: Export a CSV file that contains the following columns:
Path (the path, not the URL - e.g. /company/cognizant-technology-solutions-u-s-corporation/ not https://amplify.nabshow.com/company/cognizant-technology-solutions-u-s-corporation/
Post ID - the Post ID of the content on that page
Post Type - e.g. Page, Company, Session, Article, etc.
The CSV should contain a row for every page on Amplify.
Version: 1.0.1
Original Author: Atlas Gondal
Modified By: Crush & Lovely
Author URI: https://AtlasGondal.com/
License: GPL v2 or higher
License URI: License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
namespace Plugins\NabExportPathFromUrls;

require_once (plugin_dir_path(__FILE__) . 'ExportAllPathFromUrlsSettings.php');

class NabExportPathFromUrls extends ExportAllPaths
{
	public function __construct()
	{
		// Replace core's privacy data export handler with a custom one.
		// remove_action( 'wp_privacy_personal_data_export_file', 'wp_privacy_generate_personal_data_export_file', 10 );
		// add_action( 'wp_privacy_personal_data_export_file', __NAMESPACE__ . '\generate_personal_data_export_file' );

		add_filter( 'after_setup_theme', [ $this, 'setup_custom_plugins'] );
		add_filter( 'plugins_loaded', [ $this, 'nab_export_path_from_urls_plugin_override'] );

		add_filter( 'admin_menu', [ $this, 'eau_extract_all_urls_nav'] );

		add_action( 'admin_init', [ $this, 'export_paths_from_urls_activation'] );
		add_action( 'init', [ $this, 'export_paths_from_urls_list' ]);
	}


	public function setup_custom_plugins() {

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-header' );

	}

	// Hide Activate/Deactivate Plugin Link
	public function disable_export_paths_plugin_deactivation( $actions, $plugin_file ) {
		if ( plugin_basename( __FILE__ ) === $plugin_file ) {
			unset( $actions['deactivate'], $actions['activate'] );
		}

		return $actions;
	}

	public function nab_export_path_from_urls_plugin_override() {
		add_filter( 'plugin_action_links', [$this,'disable_export_paths_plugin_deactivation'], 10, 2  );
	}

	public function eau_extract_all_urls_nav(){

		$hook = add_management_page( 'Export Paths from URLs', 'Export Paths from URLs', 'manage_options', 'extract-all-urls-settings', [ $this, 'eau_include_settings_page'], '' );
        add_action( "load-$hook", array( $this, 'eau_include_settings_page' ) );
	}

	function eau_include_settings_page(){

		include(plugin_dir_path(__FILE__) . 'extract-all-urls-settings.php');
	}

	public function export_paths_from_urls_activation() {

		if ( ! get_transient( 'eau_export_all_urls_activation_redirect' ) ) {
			return;
		}

		delete_transient( 'eau_export_all_urls_activation_redirect' );

		wp_safe_redirect( add_query_arg( array( 'page' => 'extract-all-urls-settings' ), admin_url( 'tools.php' ) ) );
		exit;

	}

	// =================

	public function export_paths_from_urls_list()
	{
		add_filter('the_content',[$this, 'nabshow_content_after_body']);

	}

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
