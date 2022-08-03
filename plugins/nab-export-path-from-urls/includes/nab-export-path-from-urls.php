<?php

namespace Plugins\NabExportPathFromUrls\Includes;

use Plugins\NabExportPathFromUrls\Classes\ExportAllPathsFunc;
use Plugins\NabExportPathFromUrls\Classes\ExportToZip;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'NabExportPathFromUrls' ) ){

	require_once (WP_PLUGIN_DIR . '/nab-export-path-from-urls/classes/cls-export-to-zip.php');
	require_once (WP_PLUGIN_DIR . '/nab-export-path-from-urls/classes/cls-export-all-path-func.php');
	require_once (WP_PLUGIN_DIR . '/nab-export-path-from-urls/includes/cls-export-all-path-from-urls-settings.php');

	class NabExportPathFromUrls extends ExportAllPathsFunc
	{
		public function __construct()
		{
			parent::__construct();

			// Replace core's privacy data export handler with a custom one.
			remove_action('wp_privacy_personal_data_export_file', 'wp_privacy_generate_personal_data_export_file', 10);
			add_action('wp_privacy_personal_data_export_file',  [$this,'nab_generate_personal_data_export_file'],1);

			// Unrestrict All Files Temporarily
			add_filter('pre_option_vip_files_acl_restrict_all_enabled', function ($value) {
				return 0;
			});
			add_filter('pre_option_uploads_use_yearmonth_folders', '__return_false');

			// Display a link to the VIP/Automattic Privacy Policy if the site doesn't already define one.
			add_action('the_privacy_policy_link', __NAMESPACE__ . '\the_vip_privacy_policy_link', PHP_INT_MAX); // Hook in later so we don't override existing filters


			$this->init_nabexport_path_from_urls();
		}

		public function init_nabexport_path_from_urls(){
			add_filter('admin_menu', [$this, 'export_paths_from_urls_nav'],99);
			add_filter('upload_dir', [$this, 'nab_upload_dir'], 100);

			add_action('admin_init', [ $this, 'export_paths_from_urls_activation']);

			add_action('admin_init', [$this, 'init_privacy_compat']);

			if (is_admin()) add_filter('the_content', [$this, 'nabshow_content_after_body'], 99);

		}

		public function nab_upload_dir($dir)
		{
			$dir['subdir'] = '/';
			$dir['path'] = $dir['basedir'] . $dir['subdir'];
			$dir['url'] = $dir['baseurl'] . $dir['subdir'];

			return $dir;
		}

		public function init_privacy_compat()
		{

		}

		public function export_paths_from_urls_nav($nav)
		{
			$admin_page = is_multisite() ? 'settings.php' : 'options-general.php';
			$submenu = $admin_page;
			if (is_multisite()) {
				$export_path_tools_admin_page = add_submenu_page(
					'tools.php',
					__(
						'Export Paths from URLs',
						'export-path-from-urls'
					),
					__('Export Paths from URLs', 'export-path-from-urls'),
					'manage_options',
					'export-path-from-urls',
					[$this,'export_path_from_urls_settings_page'],
					null
				);
			}else{
							$export_path_tools_admin_page = add_management_page(__('Export Paths from URLs', 'export-path-from-urls'), __('Foursquare logs', 'bp-checkins'), 'manage_options', 'export-path-from-urls-admin', [$this,'export_path_from_urls_settings_page'], null);
						}

			/* Using registered $page handle to hook script load */
			add_filter("load-{$export_path_tools_admin_page}", [$this,'export_path_from_urls_settings']);
			return $nav;
		}
		public function export_path_from_urls_settings($nav)
		{
			return $nav;
		}

		public function export_path_from_urls_settings_page(){
			$export_path_urls_setting_page = new ExportAllPathFromUrlsSettings;
			$export_path_urls_setting_page->init_export_all_path_from_urls_settings();
		}

		public function export_paths_from_urls_activation()
		{
			if (! get_transient('eau_export_all_urls_activation_redirect')) {
				return;
			}

			delete_transient('eau_export_all_urls_activation_redirect');

			wp_safe_redirect(add_query_arg(array( 'page' => admin_url('tools.php'))));
			exit;
		}

		public function nab_generate_personal_data_export_file($request_id)
		{
			(new ExportToZip)->generate_personal_data_export_file($request_id);
		}


		// =================

		// This function attached on the_content hook is intended to display the CSV Content.
		// Can be In Admin or anywhere from site.. That includes Nabshow Amplify
		public function nabshow_content_after_body($content)
		{
			$rowdata = $this->retrieve_exported_file_to_array();

			if (empty($rowdata)) {
				return $content;
			}

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
}



// // Replace core's privacy data export handler with a custom one.
// remove_action('wp_privacy_personal_data_export_file', 'wp_privacy_generate_personal_data_export_file', 10);
// add_action('wp_privacy_personal_data_export_file', 'nab_generate_personal_data_export_file',1);

// function nab_generate_personal_data_export_file($request_id)
// {
// 	(new ExportToZip)->generate_personal_data_export_file($request_id);
// }
