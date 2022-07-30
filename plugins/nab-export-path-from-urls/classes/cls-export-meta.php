<?php
namespace Plugins\NabExportPathFromUrls\Classes;


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

	public function __construct()
	{
		$this->init_export_meta();
	}

	public function init_export_meta(){
		// Create the exports folder if needed.
		// $temp_dir = get_temp_dir();
		// $exports_dir = __DIR__ .'/wp-content/uploads';
		$exports_dir = wp_privacy_exports_dir();
		$exports_url = wp_privacy_exports_url();

		// So, let's force the path to use a local one in the export dir, which will work.
		// All other references (meta) will still use the correct stream URL.
		// $exports_dir = "vip://wp-content/uploads/wp-personal-data-exports";
		// if ( 0 === strpos( $exports_dir, 'vip://' ) ) {
		if ( 0 === strpos( $exports_dir, 'vip://' ) ) {
			$local_export_pathname = substr( $exports_dir, 6 );

			// Create the folder path.
			if(0 === strcmp($local_export_pathname,"wp-content/uploads"))
				$local_export_dirname     = "/wp/$local_export_pathname/wp-personal-data-exports";
			else if(0 === strcmp($local_export_pathname,"wp-content/uploads/wp-personal-data-exports"))
				$local_export_dirname     = "/wp/$local_export_pathname";
			else
				$local_export_dirname     = dirname( $local_export_pathname );

			$local_export_dir_created = wp_mkdir_p( $local_export_dirname );
			if ( is_wp_error( $local_export_dir_created ) ) {
				wp_send_json_error( $local_export_dir_created->get_error_message() );
			}
			$exports_dir = $local_export_dirname;
		}

		$filename = "export-path-from-urls";
		$csv_file = "$exports_dir/$filename.csv";
		$csv_url = "$exports_url/$filename.csv";
		$zip_file = "$exports_dir/$filename.zip";
		$zip_url = "$exports_url/$filename.zip";
		$html_file = "$exports_dir/$filename.html";
		$json_file = "$exports_dir/$filename.json";

		$export_meta = [
			'url' => $exports_url,
			'path' => $exports_dir,
			'filename' => $filename,
			'csv_url' => $csv_url,
			'csv_file' => $csv_file,
			'html_file' => $html_file,
			'json_file' => $json_file,
			'zip_file' => $zip_file,
			'zip_url' => $zip_url,
			'email' => '',
			'htmlUrls' => [],
			'count' => 0
		];

		$this->setExportMetaObj($export_meta);
		do_action('initSetGetEmail');
	}

	public function setExportMetaObj(array $exports_meta_obj){

		extract($exports_meta_obj ); // Extracting / Destructuring Array/Objects

		$this->setExportMeta($htmlUrls, $count, $url, $path, $filename, $csv_url, $csv_file, $html_file, $json_file, $zip_file, $zip_url, $email);

	}

	public function setExportMeta($htmlUrls, $count, $exports_url, $exports_dir, $filename, $csv_url, $csv_file, $html_file, $json_file, $zip_file, $zip_url, $email)
	{

		$this->setPathUrls($htmlUrls);
		$this->setPathCounts($count);
		$this->setPathUrl($csv_url);
		$this->setPath($exports_dir);
		$this->setFilename($filename);
		$this->setCsvUrl($exports_url);
		$this->setCsvFile($csv_file);
		$this->setHtmlFile($html_file);
		$this->setJsonFile($json_file);
		$this->setZipFile($zip_file);
		$this->setZipUrl($zip_url);
		do_action('initSetGetEmail');
	}

	// Setters
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
}

new ExportMeta;
