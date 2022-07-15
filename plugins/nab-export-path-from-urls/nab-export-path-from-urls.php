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

require_once (plugin_dir_path(__FILE__) . 'functions.php');

// This loads the plugin. Main function for this plugin are in this script file
function nabshow_export_all_urls_activation(){
	require_once( WP_PLUGIN_DIR . '/nab-export-path-from-urls/export-path-from-urls.php' );
}
add_filter('init','nabshow_export_all_urls_activation');

add_filter( 'plugin_action_links', 'disable_export_paths_plugin_deactivation', 10, 2  );

// Hide Activate/Deactivate Plugin Link
function disable_export_paths_plugin_deactivation( $actions, $plugin_file ) {
 
    if ( plugin_basename( __FILE__ ) === $plugin_file ) {
		unset( $actions['deactivate'], $actions['activate'] );
	}

	return $actions;
}

// This function attached on the_content hook is intended to display the CSV Content.
// Can be In Admin or anywhere from site.. That includes Nabshow Amplify
function content_after_body($content){
	
	$result = $content;
    try
    {
		$html = "";
		$uploadfolder = wp_get_upload_dir();

		if(empty($uploadfolder['path'])) return $result;

		$path = !empty($uploadfolder['path']) ? $uploadfolder['path'] : "";
		$files = scandir($path);
		$csv_file = "/wp";
		foreach($files as $ifile){
			$csv_file = "{$path}/".$ifile;
			if(is_file($csv_file)) break; 
		}
		
		if(file_exists($csv_file) && is_file($csv_file)){
			$row = 0;
			
			$list_item = "";
			if (($handle = fopen($csv_file, "r")) !== FALSE) {
				while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {					
					if($row > 0){
						$list_item .= "<tr><td>" . $row . "</td>";
						$list_item .= "<td>". (isset($data[0]) ? $data[0] : ""). "</td>";
						$list_item .= "<td>". (isset($data[1]) ? $data[1] : ""). "</td>";
						$list_item .= "<td>". (isset($data[2]) ? $data[2] : ""). "</td>";

						$list_item .= "</tr>";
					}else{					
						$list_item .= "<tr><th>#</th>";
						$list_item .= "<th id='postID'>Post ID</th>";
						$list_item .= "<th id='postID'>Post Type</th>";
						$list_item .= "<th id='postPath'>Paths</th></tr>";
					}

					$row++;
				}
				fclose($handle);
			}

			$html .= "<div class='container'>";
			$html .= "<div class='content'>";
			$html .= "<h1 align='center' style='padding: 10px 0;'><strong>Total number of paths exported: <strong>$row</strong>.</strong></h1>";
			$html .= "<table style='width: 100%; background-color: white;'>";
			$html .= $list_item;
			$html .= "</table>";
			$html .= "</div>";
			$html .= "</div>";
		}else{
			return $result;
		}

		$result = $html . $result;
		return ($result);
    }catch(\Exception $e){
		return ($result);
    }
}

add_filter('the_content','content_after_body');
