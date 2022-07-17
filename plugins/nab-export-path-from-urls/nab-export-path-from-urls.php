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

if (! defined('ABSPATH')) {
    exit;
    // Exit if accessed directly.
}

require_once (plugin_dir_path(__FILE__) . 'functions.php');
require_once( WP_PLUGIN_DIR . '/nab-export-path-from-urls/export-path-from-urls.php' );


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
function nabshow_content_after_body($content){
	$rowdata = retrieve_exported_file_to_array();
	
	if(empty($rowdata)) return $content;	

	$rowspagination = get_rows_pagination($rowdata);

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

add_filter('the_content','nabshow_content_after_body');

if(is_multisite()){
    add_filter('upload_dir', 'fix_upload_paths');
}