<?php
namespace Plugins\NabExportPathFromUrls\Classes;

require_once (WP_PLUGIN_DIR . '/nab-export-path-from-urls/classes/cls-export-meta.php');
require_once (WP_PLUGIN_DIR . '/nab-export-path-from-urls/classes/cls-export-to-zip.php');

use WP_Query;

class ExportAllPathsFunc extends ExportMeta
{
	private ExportMeta $export_meta;
	private ExportToZip $export_zip;
	public function __construct()
	{
		parent::__construct();
		$this->init_export_meta();
		$this->export_zip = new ExportToZip;
	}
	public function eau_get_selected_post_type($post_type, $custom_posts_names)
	{

		switch ($post_type) {

			case "any":

				$type = "any";
				break;

			case "page":

				$type = "page";
				break;

			case "post":

				$type = "post";
				break;

			default:

				for ($i = 0; $i < count($custom_posts_names); $i++) {

					if ($post_type == $custom_posts_names[$i]) {

						$type = $custom_posts_names[$i];

					}

				}

		}

		return $type;


	}

	public function eau_extract_relative_path ($url)
	{
		$parseurl = wp_parse_url($url);

		return $parseurl['path'];
	}

	public function eau_is_checked($name, $value)
	{
		foreach ($name as $data) {
			if ($data == $value) {
				return true;
			}
		}

		return false;
	}


	/**
	 * @param $selected_post_type
	 * @param $post_status
	 * @param $post_author
	 * @param $post_per_page
	 * @param $offset
	 * @param $export_type
	 * @param $additional_data
	 * @param $csv_name
	 * @param $posts_from
	 * @param $posts_upto
	 */

	public function eau_generate_output($selected_post_type, $post_status, $post_author, $remove_woo_attributes, $exclude_domain, $post_per_page, $offset, $export_type, $additional_data, $csv_name, $posts_from, $posts_upto)
	{

		$html = array();
		$counter = 0;

		if ($export_type == "here") {
			$line_break = "<br/>";
		} else {
			$line_break = "";
		}

		if ($post_author == "all") {
			$post_author = "";
		}

		if ($post_per_page == "all" && $offset == "all") {
			$post_per_page = -1;
			$offset = "";
		}

		switch ($post_status) {
			case "all":
				$post_status = array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'trash');
				break;
			case 'publish':
				$post_status = 'publish';
				break;
			case 'pending':
				$post_status = 'pending';
				break;
			case 'draft':
				$post_status = 'draft';
				break;
			case 'future':
				$post_status = 'future';
				break;
			case 'private':
				$post_status = 'private';
				break;
			case 'trash':
				$post_status = 'trash';
				break;
			default:
				$post_status = 'publish';
				break;
		}

		$posts_query = new WP_Query(array(
			'post_type' => $selected_post_type,
			'post_status' => $post_status,
			'author' => $post_author,
			'posts_per_page' => $post_per_page,
			'offset' => $offset,
			'orderby' => 'title',
			'order' => 'ASC',
			'date_query' => array(
				array(
					'after' => $posts_from,
					'before' => $posts_upto,
					'inclusive' => true,
				),
			)
		));

		if (!$posts_query->have_posts()) {
			echo "no result found in that range, please <strong>reselect and try again</strong>!";
			return;
		}

		if ($this->eau_is_checked($additional_data, 'postIDs')) {

			while ($posts_query->have_posts()):

				$html['seq'][$counter] = $counter + 1;
				$html['post_id'][$counter] = (isset($html['post_id'][$counter]) ? "" : null);

				$posts_query->the_post();
				$html['post_id'][$counter] .= get_the_ID();
				$counter++;

			endwhile;

			$counter = 0;

		}

		if ($this->eau_is_checked($additional_data, 'post_type')) {

			while ($posts_query->have_posts()):

				$html['post_type'][$counter] = (isset($html['post_type'][$counter]) ? "" : null);

				$posts_query->the_post();
				$html['post_type'][$counter] .= get_post_type( get_the_ID() );

				$counter++;

			endwhile;

			$counter = 0;

		}

		if ($this->eau_is_checked($additional_data, 'path')) {

			while ($posts_query->have_posts()):

				$html['path'][$counter] = (isset($html['path'][$counter]) ? "" : null);

				$posts_query->the_post();

				$html['path'][$counter] .= $this->eau_extract_relative_path(get_permalink());

				$counter++;

			endwhile;

			$counter = 0;

		}

		$this->eau_export_data($html, $export_type, $csv_name);

		wp_reset_postdata();
	}

	public function eau_export_data($urls, $export_type)
	{

		$html = "";

		$count = 0;
		foreach ($urls as $item) {
			$count = count($item);
		}
		switch ($export_type) {
			case "text":

				// Create request
				$request_details = $this->nab_create_user_request();
				$request_id = $request_details['request_id'];

				$this->init_export_meta();

				$html .= $this->initiate_csv_data_export_file( $urls, $request_id, $count, $this->getCsvFile(), $this->getFilename() );

				$this->setPathUrls($urls);
				$this->setPathCounts($count);

				break;

			case "here":

				$html .= "<h1 align='center' style='padding: 10px 0;'><strong>Below is a list of Exported Data:</strong></h1>";
				$html .= "<h2 align='center' style='font-weight: normal;'>Total number of links: <strong>".esc_html($count)."</strong>.</h2>";
				$html .= "<table class='form-table' id='outputData'>";
				$html .= isset($urls['seq']) ? "<th id='postID'>#</th>" : null;
				$html .= isset($urls['post_id']) ? "<th id='postID'>Post ID</th>" : null;
				$html .= isset($urls['post_type']) ? "<th id='postID'>Post Type</th>" : null;
				$html .= isset($urls['path']) ? "<th id='postPath'>Paths</th>" : null;

				$html .= "</tr>";

				for ($i = 0; $i < $count; $i++) {

					$id = $i + 1;
					$html .= "<tr><td>".esc_html($urls['seq'][$i])."</td>";
					$html .= isset($urls['post_id']) ? "<td>".esc_html($urls['post_id'][$i])."</td>" : "";
					$html .= isset($urls['post_type']) ? "<td>" . esc_html($urls['post_type'][$i]) . "</td>" : "";
					$html .= isset($urls['path']) ? "<td>" . esc_html($urls['path'][$i]) . "</td>" : "";

					$html .= "</tr>";
				}

				$html .= "</table>";

				break;

			default:

				echo "Sorry, you missed export type, Please <strong>Select Export Type</strong> and try again! :)";
				break;
		}
		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	public function csvToArray($csvFile){

		$file_to_read = fopen($csvFile, 'r'); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_read_fopen
		$i = 0;
		while (!feof($file_to_read) ) {
			$lines[$i++] = fgetcsv($file_to_read, 1000, ',');

		}

		fclose($file_to_read);
		return $lines;
	}

	public function retrieve_exported_file_to_array(){
		$rowdata = [];
		if (!file_exists($this->getCsvFile()) || !is_file($this->getCsvFile())) return $rowdata;

		$rowdata = $this->csvToArray($this->getCsvFile());

		return $rowdata;
	}

	public function get_range_exported_file_to_array($data = [], $offset_pos, $range_length){
		$total_data = count($data) - 2;
		$offsetrange = $range_length + $offset_pos;
		$limit = $offsetrange > $total_data ?  $total_data :$offsetrange;

		$range_data = [];
		$cnt = 0;
		$range_ind = range($offset_pos,$limit);

		foreach($range_ind as $rInd){
			$range_data[$cnt++] = $data[$rInd];
		}

		return $range_data;
	}

	public function get_rows_pagination($data = [], $rowsperpage = 20, $currentpage = 0){
		$html = "";
		$pagination = "";
		try {

			$numrows = count($data);

			// number of rows to show per page
			$rowsperpage = 20;

			if($numrows == 0) return $data;

			// find out total pages
			$totalpages = ceil($numrows / $rowsperpage);

			// get the current page or set a default
			if (isset($_GET['currentpage']) && !wp_verify_nonce(sanitize_text_field($_GET['currentpage'])) && is_numeric(sanitize_text_field($_GET['currentpage']))) {
				// cast var as int
				$currentpage = (int) $_GET['currentpage'];
			} else {
				// default page num
				$currentpage = 1;
			} // end if

			// if current page is greater than total pages...
			if ($currentpage > $totalpages) {
				// set current page to last page
				$currentpage = $totalpages;
			} // end if

			// if current page is less than first page...
			if ($currentpage < 1) {
				// set current page to first page
				$currentpage = 1;
			} // end if

			// the offset of the list, based on current page
			$offset = ($currentpage - 1) * $rowsperpage;

			$rowdata = $this->get_range_exported_file_to_array($data, $offset, $rowsperpage);

			/******  build the pagination links ******/
			// range of num links to show
			$range = 3;

			$phpself = site_url();
			// if not on page 1, don't show back links
			if ($currentpage > 1) {
				// show << link to go back to page 1
				$pagination .= " <a href='".esc_url($phpself)."?currentpage=1'><<</a> ";
				// get previous page num
				$prevpage = $currentpage - 1;
				// show < link to go back to 1 page
				$pagination .= " <a href='".esc_url($phpself)."?currentpage={$prevpage}'><</a> ";
			} // end if

			// loop to show links to range of pages around current page
			for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
				// if it's a valid page number...
				if (($x > 0) && ($x <= $totalpages)) {
					// if we're on current page...
					if ($x == $currentpage) {
						// 'highlight' it but don't make a link
						$pagination .= " [<b>$x</b>] ";
					// if not current page...
					} else {
						// make it a link
						$pagination .= " <a href='".esc_url($phpself)."?currentpage=$x'>$x</a> ";
					} // end else
				} // end if
			} // end for
			// if not on last page, show forward and last page links
			if ($currentpage != $totalpages) {
				// get next page
				$nextpage = $currentpage + 1;
					// echo forward link for next page
				$pagination .= " <a href='".esc_url($phpself)."?currentpage={$nextpage}'>></a> ";
				// echo forward link for lastpage
				$pagination .= " <a href='".esc_url($phpself)."?currentpage={$totalpages}'>>></a> ";
			} // end if
			/****** end build pagination links ******/
			// Prepare the paged query

			$row = 0;
			$cnt = 0;

			$list_item = "";

			foreach ($rowdata as $rdata) {
				if (!empty($rdata[0]) && $row > 0) {
					$list_item .= "<tr><td>". $rdata[0] . "</td>";
					$list_item .= "<td>". $rdata[1] . "</td>";
					$list_item .= "<td>". $rdata[2] . "</td>";
					$list_item .= "<td>" .$rdata[3]. "</td></tr>";
					$cnt++;
				}else if ($row == 0) {
					$list_item .= "<tr><th>#</th>";
					$list_item .= "<th id='postID'>Post ID</th>";
					$list_item .= "<th id='postID'>Post Type</th>";
					$list_item .= "<th id='postPath'>Paths</th></tr>";
				}
				$row++;
			}
			// -2  on  display count
			// -1 is for  the  row display starts at 1 where index always starts with 0 and -1 for headers on table (#, Post ID, Post Type, Paths)
			$page_nav_control = "$cnt  Displayed";
			$html .= "<div class='container'>";
			$html .= "<div class='content'>";
			$html .= "<h1 align='center' style='padding: 10px 0;'><strong>Total number of paths exported : ".($numrows-2)." <strong>| $page_nav_control</strong></strong></h1>";
			$html .= "<table style='width: 100%; background-color: white;'>";
			$html .= $list_item;
			$html .= "</table>";
			$html .= "</div>";
			$html .= "<div class='content' style='text-align: center; padding: 25px;'>{$pagination}</div>";
			$html .= "</div>";

			return $html;
		}catch(\Exception $e){
			return $html.$e->getMessage;
		}
	}

	public function nab_create_user_request(){
		// Create the user request.
		$user = wp_get_current_user();

		$email_address  = $user->user_email;

		if ( ! is_email( $email_address ) ) {
			wp_send_json_error( __( 'Invalid email address when generating export file.' ) );
		}
		$request_id = wp_create_user_request( $email_address, 'export_personal_data' );
		$message = "No errors were caught!";
		$success = true;
		if ( is_wp_error( $request_id ) ) {
			$success = false;
			$message = $request_id->get_error_message();
		} else if ( ! $request_id ) {
			$success = false;
			$message = 'We were unable to generate the data export request.';
		}

		/*
		* Auto-confirm the user request since the user already consented by
		* submitting our form.
		*/
		if ( $success ) {
			/** This hook is documented in /wp-login.php */
			do_action( 'user_request_action_confirmed', $request_id );

			$message = 'Data export request successfully created';

		}

		return [
			'request_id' => $request_id,
			'message' => $message,
			'user' => $user
		];
	}

	public function initiate_csv_data_export_file( $urls, $request_id, $count, $csv_file ) {
		// Get the request.
		$request = wp_get_user_request($request_id);
		$html = "";

		$haserror = false;

		if (! $request || 'export_personal_data' !== $request->action_name) {

			$haserror = true;
		}
		$exports_dir = $this->getPath();

		if (!file_exists($csv_file)) {
			// Create the exports folder if needed.
			if (! wp_mkdir_p($exports_dir)) {
				$html .= "Unable to create export folder.";
			}
		}

		return ($html . $this->validate_create_export_csv_file($urls, $count, $request_id, $haserror));

	}

	public function validate_create_export_csv_file($urls, $count, $request_id, $haserror = false)
	{
		$html = "";
		$error_msg ="";
		$export_dir = $this->getPath();
		$csv_file = $this->getCsvFile();
		$csv_name = $this->getFilename();

		$error = !file_exists($csv_file) || $haserror;

		$this->init_export_meta();
		$cls_export_zip = new ExportToZip;
		$result_csv_file = $cls_export_zip->create_csv_file($urls, $csv_name, $count,$export_dir, $request_id,$error_msg ,$haserror);
		$error_msg .= $result_csv_file['error_msg'];
		$error = $result_csv_file['haserror'];

		if(!$error){
			$csv_url = $this->getCsvUrl();
			$html .= "<div class='updated '><strong>Data exported successfully!</strong></div>";
			$html .= "<div class='updated '><a href='$csv_url' target='_blank'  class='button button-primary md-12'><strong>Download CSV File</strong></a></div></div>";
			$html .= "<div class='notice notice-info' style='width: 97%'><strong>Total</strong> number of paths exported: <strong>".esc_html($count)."</strong>.</div>";

			$this->save_eau_export_data($urls, 'text', $csv_name, $count, $request_id);
		}else{

			$html .= "<div class='notice notice-info' style='width: 97%'><H1>Sorry! but as of the moment exporting data is not yet allowed for now in this page. </H1>
								<H3><ul>
								<li>- Can you verify and navigate Export Personal Data Page if indeed you have already an existing export data user request.</li>
								<li>- Or you may not have the correct rights and privelege to access Export Data function. You may need to upgrade your capabilities! Please contact Admin about this. Thanks!</li>
								$error_msg
								</ul></H3></div>";
		}


		return $html;
	}

	public function sent_header_download_csv()
	{
		$this->init_export_meta();
		$file_basename = $this->getFilename();
		$filesize   = filesize($this->getCsvFile());
		$mimetype = mime_content_type($this->getCsvFile());

		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename='.$file_basename);
		header('Content-Type:'. $mimetype);
		header('Content-Transfer-Encoding: '. $mimetype);
		header('Content-Length:' . $filesize);

		ob_clean();
		flush();
		readfile($this->getCsvFile());

	}

	public function arrayToCSV($inputArray)
	{
		$csvFieldRow = array();
		foreach ($inputArray as $CSBRow) {
			$csvFieldRow[] = $this->str_putcsv($CSBRow);
		}
		$csvData = implode("\n", $csvFieldRow);
		return $csvData;
	}
	public function str_putcsv($input, $delimiter = ',', $enclosure = '"')
	{
		// Open a memory "file" for read/write
		$fp = fopen('php://temp', 'r+');
		// Write the array to the target file using fputcsv()
		fputcsv($fp, $input, $delimiter, $enclosure);
		// Rewind the file
		rewind($fp);
		// File Read
		$data = fread($fp, 1048576);
		fclose($fp);
		// Ad line break and return the data
		return rtrim($data, "\n");
	}
}

new ExportAllPathsFunc;
