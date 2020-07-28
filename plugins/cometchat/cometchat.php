<?php

/**
* Plugin Name: CometChat
* Description: Voice, video & text chat for your WordPress site
* Version: 7.47.0
* Author: CometChat
* Author URI: https://www.cometchat.com/
*/

require 'plugin_update_check.php';

$KernlUpdater = new PluginUpdateChecker_2_0 (
    'https://kernl.us/api/v1/updates/5c46be053068390d7de8223d/',
    __FILE__,
    'cometchat',
    1
);

include_once(ABSPATH.'wp-admin'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'plugin.php');

global $cc_clientid,$cc_old_client;

$cc_license_key = get_option('cc_license_key');

if(!empty($cc_license_key)){
	$cc_clientid = getCcCloudClientId();
	$cc_old_clientid = $cc_clientid;
}

if($cc_clientid == 1 && !empty($cc_license_key)){
	$cc_clientid = substr($cc_license_key, -5, 5);
}

if(!empty($cc_clientid)){
	$dir = plugin_dir_path( __FILE__ ).'includes/cometchat_cloud.php';
}else{
	$dir = plugin_dir_path( __FILE__ ).'includes/cometchat_selfhosted.php';
}

include_once($dir);

/**
 * getCcCloudClientId
 * Return client id of cloud
 * @param (type) no param
 * @return (array) curl response
*/
function getCcCloudClientId(){
	global $cc_clientid;

	$cc_clientid_temp = get_option('cc_clientid');

	if (!empty($cc_clientid_temp)) {
		$cc_clientid = $cc_clientid_temp;
	} else {

		$accessKey = 'flGBNxeq8Mgu5bynUhS5w3S2CJ7dfo3latMTxDNa';
		$cc_license_key = get_option('cc_license_key');
		if(!empty($cc_license_key)){
			$url = "https://secure.cometchat.com/api-software/subscription?accessKey=".$accessKey;
			$url .= "&licenseKey=".$cc_license_key;
			$response = wp_remote_get( $url );
			$body = wp_remote_retrieve_body( $response );
		}
		$licenseinfo = !empty($body) ? json_decode($body): '';
		$cc_clientid = (!empty($licenseinfo) && is_object($licenseinfo) && property_exists($licenseinfo, 'success') && $licenseinfo->success == 1 && property_exists($licenseinfo, 'cloud') && $licenseinfo->cloud != 0) ? $licenseinfo->cloud : 0;

		add_option('cc_clientid',$cc_clientid,'','no');
	}

	return $cc_clientid;
}

/**
 * addCometChatToWordPressMenu
 * Return adding menu option to wordpress admin panel
 * @param (type) no param
*/
function addCometChatToWordPressMenu() {
	add_menu_page( 'CometChat', 'CometChat', 'manage_options', 'cometchat/cometchat-go.php', '', plugins_url( '/images/cometchat.png', __FILE__ ), '75' );
}

/**
 * deleteCometChatLicenseKey
 * delete cometchat license key from database table
 */
function deleteCometChatLicenseKey() {
	$cc_license_key = get_option('cc_license_key');

	if(!empty($cc_license_key)){
		delete_option('cc_license_key');
	}
	if(!empty($_COOKIE['cc_cloud']) || $_COOKIE['cc_cms_file'] || $_COOKIE['cc_license_key']){
		unset($_COOKIE['cc_cloud']);
		unset($_COOKIE['cc_license_key']);
		unset($_COOKIE['cc_cms_file']);
		setcookie('cc_cloud', null, -1, '/');
		setcookie('cc_license_key', null, -1, '/');
		setcookie('cc_cms_file', null, -1, '/');
	}
}

/**
 * getCometChatDirectoryName
 * @return cometchat directory name
 */
function getCometChatDirectoryName(){
	global $wpdb;
	$cc_dir_name = 'cometchat';

	$result = $wpdb->get_var("SELECT COUNT(1) FROM information_schema.tables WHERE table_schema='$wpdb->dbname' AND table_name='cometchat_settings'");

	if(!empty($result)){
		$sql = ("SELECT value from cometchat_settings where setting_key = 'BASE_URL'");
		$result = $wpdb->get_row($sql);

		if(!empty($result)){
			$basepath = $result->value;
		}
	}

	if(!empty($basepath)){
		$dir = explode('/', $basepath);
		$last = array_pop($dir);
		$cc_dir_name = array_pop($dir);
	}

	return $cc_dir_name;
}

/**
 * removeCometChatDatabase
 * @return removed database tables
 */
function removeCometChatDatabase() {
	global $wpdb;
	global $wp_roles;

	deleteCometChatLicenseKey();
	$roles = array_keys($wp_roles->get_names());
	foreach ($roles as $key => $value) {
		delete_option($value);
	}
	delete_option('inbox_sync');
	delete_option('hide_bar');
	delete_option('ccintialaccess');
	delete_option('cc_clientid');
	delete_option('bp_group_sync');
	delete_option('show_friends');
	delete_option('cc_auth_key');
	delete_option('cc_api_key');
}

/**
 * registerCometChatSettings
 * @return insert inbox_sync and hide_bar in wp_options table
 */
function registerCometChatSettings() {
	global $wp_roles;

	$roles = array_keys($wp_roles->get_names());
	foreach ($roles as $key => $value) {
		$role = get_role($value);
		$role->add_cap( 'enable_cometchat',true );
	}
	add_option('show_friends','false','','no');
	add_option('bp_group_sync','false','','no');
}


function cc_action() {
	global $wpdb;

	$requestHandler = plugin_dir_path( __FILE__ ).'includes/cometchat_requesthandler.php';
	include_once($requestHandler);

	wp_die(); // this is required to terminate immediately and return a proper response
}

/**
 * curlRequestToCometChatAPI
 * Return make cURL to CometChat API
 * @param $action = api action that needs to be called, $data = data to send to api
*/
function curlRequestToCometChatAPI($action,$data) {
	global $cc_clientid;

	$request_url = "https://".$cc_clientid.".cometondemand.net/cometchat_update.php?action=".$action;
	if(function_exists('curl_init')){
        $result = wp_remote_post($request_url, array(
                'method' 	=> 'POST',
                'body' 		=> http_build_query($data),
                'headers'	=> array(
                	'Content-Type'	=>	'application/x-www-form-urlencoded'
                )
            )
        );
	}
}

/**
 * customCometChatLogin: function will verify username and password
 * Return basedata
 * @param
*/
function customCometChatLogin() {
	include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'api'.DIRECTORY_SEPARATOR.'v1'.DIRECTORY_SEPARATOR.'login.php');
}

function deductMycredPointsCallback() {
	include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.'mycred'.DIRECTORY_SEPARATOR.'credits.php');
}

add_action( 'rest_api_init', function () {
	register_rest_route( 'api/v1', 'login', [
		'methods' => 'POST',
		'callback' => 'customCometChatLogin',
	]);
});


if(is_plugin_active('mycred/mycred.php')){
	add_action( 'rest_api_init', function() {
		register_rest_route( 'plugins/mycred', 'credits', [
			'methods' => 'POST',
			'callback' => 'deductMycredPointsCallback',
		]);
	});
}

add_filter('https_ssl_verify', '__return_false');
add_action( 'wp_ajax_cc_action', 'cc_action' );
add_action('admin_menu', 'addCometChatToWordPressMenu');
register_activation_hook( __FILE__, 'registerCometChatSettings');
register_uninstall_hook( __FILE__, 'removeCometChatDatabase' );

register_activation_hook( __FILE__, 'cc_activation');

?>
