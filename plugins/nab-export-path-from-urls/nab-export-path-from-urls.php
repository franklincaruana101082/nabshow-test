<?php

/*
Plugin Name: Export All URLs
Plugin URI: https://AtlasGondal.com/
Description: We need to be able to export a CSV that contains the following columns:
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

require_once (plugin_dir_path(__FILE__) . 'functions.php');

function eau_extract_all_urls_nav(){

    add_management_page( 'Export Paths from URLs', 'Export Paths from URLs', 'manage_options', 'extract-all-urls-settings', 'eau_include_settings_page' );

}

add_action( 'admin_menu', 'eau_extract_all_urls_nav' );

function eau_include_settings_page(){

    include(plugin_dir_path(__FILE__) . 'extract-all-urls-settings.php');

}

function eau_export_all_urls_on_activate() {
    if ( version_compare( PHP_VERSION, '5.4', '<' ) ) {
        deactivate_plugins( plugin_basename( __FILE__ ) );
        $plugin_data = get_plugin_data( __FILE__ );
        $plugin_version = $plugin_data['Version'];
        $plugin_name = $plugin_data['Name'];
        wp_die( '<h1>' . __('Could not activate plugin: PHP version error') . '</h1><h2>PLUGIN: <i>' . $plugin_name . ' ' . $plugin_version . '</i></h2><p><strong>' . __('You are using PHP version') . ' ' . PHP_VERSION . '</strong>. ' . __( 'This plugin has been tested with PHP versions 5.4 and greater.') . '</p><p>' . __('WordPress itself recommends using PHP version 7.3 or greater') . ': <a href="https://wordpress.org/about/requirements/" target="_blank">' . __('Official WordPress requirements') . '</a>' . '. ' . __('Please upgrade your PHP version or contact your Server administrator.') . '</p>', __('Could not activate plugin: PHP version error'), array( 'back_link' => true ) );

    }
    set_transient( 'eau_export_all_urls_activation_redirect', true, 30 );
}

register_activation_hook( __FILE__, 'eau_export_all_urls_on_activate' );

function eau_redirect_on_export_all_urls_activation() {

    if ( ! get_transient( 'eau_export_all_urls_activation_redirect' ) ) {
        return;
    }

    delete_transient( 'eau_export_all_urls_activation_redirect' );

    wp_safe_redirect( add_query_arg( array( 'page' => 'extract-all-urls-settings' ), admin_url( 'tools.php' ) ) );

}
add_action( 'admin_init', 'eau_redirect_on_export_all_urls_activation' );

add_filter( 'admin_footer_text', 'eau_admin_footer_text' );
function eau_admin_footer_text( $footer_text ) {

    $current_screen = get_current_screen();

    $is_export_all_urls_screen = ( $current_screen && false !== strpos( $current_screen->id, 'extract-all-urls-settings' ) );

    if ( $is_export_all_urls_screen ) {
        $footer_text = 'Enjoyed <strong>Export All URLs</strong>? Please leave us a <a href="https://wordpress.org/support/plugin/export-all-urls/reviews/?filter=5#new-post" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. We really appreciate your support! ';
    }

    return $footer_text;
}



// This function attached on the_content hook is intended to display the CSV Content.
// Can be In Admin or anywhere from site.. That includes Nabshow Amplify
function add_content_after($content){
    try
    {
		$html = "";
		$uploadfolder = wp_upload_dir();

		$path = !empty($uploadfolder['path']) ? $uploadfolder['path'] : ""; // tripslashes($uploadfolder['path']) : "";
		$csv_file = "{$path}/exported-paths-from-urls.csv";
		if(file_exists($csv_file)){
			$row = 1;
			if (($handle = fopen($csv_file, "r")) !== FALSE) {
				$html .= "<div class='col-md-12'>";

				// ====
				$html .= "<div class='col-md-2'>Seq.</div>";
				$html .= "<div class='col-md-3'>Post ID</div>";
				$html .= "<div class='col-md-3'>Post Type</div>";
				$html .= "<div class='col-md-4'>Path</div>";
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

					$num = count($data);
					$html .= "<div class='col-md-12'>";
					// echo "<p> $num fields in line $row: <br /></p>\n";

					$row++;

					// ====
					$html .= "<div class='col-md-2'>".$row."</div>";
					$html .= "<div class='col-md-3'>".$data[$row]['PostID']."</div>";
					$html .= "<div class='col-md-3'>".$data[$row]['Post_Type']."</div>";
					$html .= "<div class='col-md-4'>".$data[$row]['Path']."</div>";
					// ====
				}

				// ====
				$html .= "</div>";
				fclose($handle);
			}
		}
		return $content . $html;
    }catch(\Exception $e){

    }
}
//  work in progress
add_filter('wp_footer','add_content_after');
