<?php
namespace Plugins\NabExportPathFromUrls\Classes;


use function Automattic\VIP\Files\new_api_client;

use Automattic\VIP\Files\API_Cache;
use Automattic\VIP\Files\API_Client;
class ExportMeta
{

	private ExportMeta $export_meta;
	private ?int $request_id;
	private array $path_urls = [];
	private int $path_counts = 0;
	private ?String $path;
	private ?String $filename;
	private ?String $csv_url;
	private ?String $csv_file;
	private ?String $html_file;
	private ?String $json_file;
	private ?String $zip_url;
	private ?String $zip_file;
	private ?String $email;
	private ?String $exports_url;
	private ?String $exports_dir;

	private ?API_Client $api_client;

	public function __construct()
	{
		$this->api_client    = new_api_client('https://nabshow.vipdev.lndo.site/wp-admin/tools.php?page=extract-paths-from-urls-settings',
			constant( 'FILES_CLIENT_SITE_ID' ),
			constant( 'FILES_ACCESS_TOKEN' ),
			API_Cache::get_instance()
		);

		add_action('admin_id',[$this, 'init_export_meta'],1);
	}

	public function init_export_meta(){
		// Load Importer API.
		require_once wp_normalize_path( ABSPATH . 'wp-admin/includes/export.php' );

		ob_start();
		export_wp(
			[
				'content' => 'slide',
			]
		);
		$export = ob_get_contents();
		ob_get_clean();

		$upload_res = wp_upload_dir();
		$base_dir   = trailingslashit( $upload_res['basedir'] );

		$exports_dir = $base_dir."wp-personal-data-exports";
		$exports_url = $upload_res['url']."wp-personal-data-exports";

		$tmp_path = get_temp_dir();

		$path = $exports_dir;

		if ( 0 === strpos( $exports_dir, 'vip://' ) ) {
			$local_export_pathname = "/wp/".substr( $exports_dir, 6 );

			// Create the folder path.
			$local_export_dir_created = wp_mkdir_p( $local_export_pathname );
			if ( is_wp_error( $local_export_dir_created ) ) {
				wp_send_json_error( $local_export_dir_created->get_error_message() );
			}
			$path = $local_export_pathname;
		}

		if(!file_exists( $path)) wp_mkdir_p( $path );

		$filename = "export-path-from-urls";
		$csv_file = "{$path}/{$filename}.csv";
		$csv_url = "{$exports_url}/{$filename}.csv";
		$zip_file = "{$path}/{$filename}.zip";
		$zip_url = "{$exports_url}/{$filename}.zip";
		$html_file = "{$path}/{$filename}.html";
		$json_file = "{$path}/{$filename}.json";

		$export_meta = [
			'tmp_dir' => $tmp_path,
			'url' => $exports_url,
			'exports_dir' => $exports_dir,
			'path' => $path,
			'filename' => $filename,
			'csv_url' => $csv_url,
			'csv_file' => $csv_file,
			'html_file' => $html_file,
			'json_file' => $json_file,
			'zip_file' => $zip_file,
			'zip_url' => $zip_url,
			'exports_url' => $exports_url,
			'email' => '',
			'htmlUrls' => [],
			'count' => 0
		];

		$this->setExportMetaObj($export_meta);
		do_action('initSetGetEmail');
	}

	public function setExportMetaObj(array $exports_meta_obj){

		extract($exports_meta_obj ); // Extracting / Destructuring Array/Objects

		$this->setExportMeta($htmlUrls, $count, $url, $path, $filename, $csv_url, $csv_file, $html_file, $json_file, $zip_file, $zip_url, $email, $exports_dir);

	}

	public function setExportMeta($htmlUrls, $count, $exports_url, $path, $filename, $csv_url, $csv_file, $html_file, $json_file, $zip_file, $zip_url, $email,$exports_dir)
	{
		$this->setPathUrls($htmlUrls);
		$this->setPathCounts($count);
		$this->setExportsUrl($exports_url);
		$this->setPath($path);
		$this->setExportDir($exports_dir);
		$this->setFilename($filename);
		$this->setCsvUrl($csv_url);
		$this->setCsvFile($csv_file);
		$this->setHtmlFile($html_file);
		$this->setJsonFile($json_file);
		$this->setZipFile($zip_file);
		$this->setZipUrl($zip_url);
		$this->setEmail($email);
		do_action('initSetGetEmail');
	}

	// Setters
	public function setExportsUrl($exports_url){
		$this->exports_url = $exports_url;
	}
	public function setRequestId($request_id){
		$this->request_id = $request_id;
	}
	public function setPathUrls($urls){
		$this->path_urls = $urls;
	}
	public function setPathCounts($count){
		$this->path_counts = $count;
	}
	public function setPathUrl($url){
		$this->url = $url;
	}
	public function setPath($path){
		$this->path = $path;
	}
	public function setExportDir($exports_dir){
		$this->exports_dir = $exports_dir;
	}
	public function setFilename($filename){
		$this->filename = $filename;
	}
	public function setCsvUrl($csv_url){
		$this->csv_url = $csv_url;
	}
	public function setCsvFile($csv_file){
		$this->csv_file = $csv_file;
	}
	public function setHtmlFile($html_file){
		$this->html_file = $html_file;
	}
	public function setJsonFile($json_file){
		$this->json_file = $json_file;
	}
	public function setZipFile($zip_file){
		$this->zip_file = $zip_file;
	}
	public function setZipUrl($zip_url){
		$this->zip_url = $zip_url;
	}
	public function initSetGetEmail(){
		// Create the user request.
		if(wp_get_current_user()) $user = wp_get_current_user();

		$email  = !empty($user) ? $user->user_email : ( !empty($email) ? $email : "vipgo@go-vip.net");

		$this->setEmail($email);
	}
	public function setEmail($email){

		$this->email = $email;
	}

	// Getters
	public function getExportDir(){
		return $this->exports_dir;
	}
	public function getPathUrls(){
		return $this->path_urls;
	}
	public function getPathCounts(){
		return $this->path_counts;
	}
	public function getRequestId(){
		return $this->request_id;
	}
	public function getPath(){
		return $this->path ;
	}
	public function getFilename(){
		return $this->filename;
	}
	public function getCsvUrl(){
		return $this->csv_url;
	}
	public function getCsvFile(){
		return $this->csv_file;
	}
	public function getHtmlFile(){
		return $this->html_file;
	}
	public function getJsonFile(){
		return $this->json_file;
	}
	public function getZipFile(){
		return $this->zip_file;
	}
	public function getZipUrl(){
		return $this->zip_url;
	}
	public function getEmail(){
		return $this->email;
	}

	public function getExportMeta(){
		return $this->export_meta;
	}

	public function save_eau_export_data($urls, $export_type, $csv_name, $count, $request_id){

		$_export_urls = get_post_meta( $request_id, '_export_urls', true );
		$_export_type = get_post_meta( $request_id, '_export_type', true );
		$_export_csv_name = get_post_meta( $request_id, '_export_csv_name', true );
		$_export_count = get_post_meta( $request_id, '_export_count', true );

		if($_export_urls) update_post_meta( $request_id, '_export_urls', $urls );
		if($_export_type) update_post_meta( $request_id, '_export_type', $export_type );
		if($_export_csv_name) update_post_meta( $request_id, '_export_csv_name', $csv_name );
		if($_export_count) update_post_meta( $request_id, '_export_count', $count );

		$_export_urls =  $urls;
		$_export_count =  $count;

		$this->setPathUrls($_export_urls);
		$this->setPathCounts($_export_count);
	}

	public function _upload_exported_csv_file( $csv_file ) {
		// For local usage, skip the remote upload.
		// The file is already in the uploads folder.
		if ( true !== WPCOM_IS_VIP_ENV ) {
			return true;
		}

		$upload_path       = $csv_file;

		$upload_result = $this->api_client->upload_file( $csv_file, $upload_path );

		// Delete the local copy of the archive since it's been uploaded.
		unlink( $csv_file );

		return $upload_result;
	}

}

new ExportMeta;
