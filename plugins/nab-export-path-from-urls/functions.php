<?php

function eau_get_selected_post_type($post_type, $custom_posts_names)
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



function eau_extract_relative_path ($url)
{
    $parseurl = wp_parse_url($url);

    return $parseurl['path'];
}

function eau_is_checked($name, $value)
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

function eau_generate_output($selected_post_type, $post_status, $post_author, $remove_woo_attributes, $exclude_domain, $post_per_page, $offset, $export_type, $additional_data, $csv_name, $posts_from, $posts_upto)
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

    if (eau_is_checked($additional_data, 'postIDs')) {

        while ($posts_query->have_posts()):

            $html['seq'][$counter] = $counter + 1;
            $html['post_id'][$counter] = (isset($html['post_id'][$counter]) ? "" : null);

            $posts_query->the_post();
            $html['post_id'][$counter] .= get_the_ID();
            $counter++;

        endwhile;

        $counter = 0;

    }

    if (eau_is_checked($additional_data, 'post_type')) {

        while ($posts_query->have_posts()):

            $html['post_type'][$counter] = (isset($html['post_type'][$counter]) ? "" : null);

            $posts_query->the_post();
            $html['post_type'][$counter] .= get_post_type( get_the_ID() );

			$counter++;

        endwhile;

        $counter = 0;

    }

    if (eau_is_checked($additional_data, 'path')) {

        while ($posts_query->have_posts()):

            $html['path'][$counter] = (isset($html['path'][$counter]) ? "" : null);

            $posts_query->the_post();

            $html['path'][$counter] .= eau_extract_relative_path(get_permalink());

			$counter++;

        endwhile;

        $counter = 0;

    }

    eau_export_data($html, $export_type, $csv_name);

    wp_reset_postdata();
}

function eau_export_data($urls, $export_type, $csv_name)
{

    $html = "";

    $count = 0;
    foreach ($urls as $item) {
        $count = count($item);
    }

    $dir_obj = get_nab_path_and_file();
	$files_dir = $dir_obj['dir'];
    $csv_file = $files_dir.$csv_name."csv";

    switch ($export_type) {
        case "text":

            $data = '';
            $headers = array();
            $myfile = fopen($csv_file, "w") or wp_die("<div class='error' style='width: 95.3%; margin-left: 2px;'>Unable to create a file on your server! (either invalid name supplied or permission issue)</div>"); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_read_fopen
            fprintf($myfile, "\xEF\xBB\xBF");

            $headers[] = '#';
            $headers[] = 'Post ID';
            $headers[] = 'Post Type';
            $headers[] = 'Paths';
            fputcsv($myfile, $headers); // phpcs:ignore WordPressVIPMinimum.Functions.RestrictedFunctions.file_ops_fputcsv
            for ($i = 0; $i < $count; $i++) {
                $data = array(
                    $urls['seq'][$i] ,
                    isset($urls['post_id']) ? $urls['post_id'][$i] : "",
                    isset($urls['post_type']) ? $urls['post_type'][$i] : "",
                    isset($urls['path']) ? $urls['path'][$i] : ""
                );

                fputcsv($myfile, $data); // phpcs:ignore WordPressVIPMinimum.Functions.RestrictedFunctions.file_ops_fputcsv
            }

            fclose($myfile);
            // Set perms with chmod()
            // chmod($csv_file, 0777); //phpcs:ignore WordPressVIPMinimum.Functions.RestrictedFunctions.chmod_chmod

            $html .= "<div class='updated' style='width: 97%'>Data exported successfully! <a href='$csv_file' target='_blank'><strong>Click here</strong></a> to Download.</div>";
            $html .= "<div class='notice notice-warning' style='width: 97%'>Once you have downloaded the file, it is recommended to delete file from the server, for security reasons. <a href='".wp_nonce_url(admin_url('tools.php?page=extract-all-urls-settings&del=y&f=').base64_encode($csv_file))."' ><strong>Click Here</strong></a> to delete the file. And don't worry, you can always regenerate anytime. :)</div>";
            $html .= "<div class='notice notice-info' style='width: 97%'><strong>Total</strong> number of paths exported: <strong>".esc_html($count)."</strong>.</div>";

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

function content_after_body_full_list($content, $csv_name = "exported-paths-from-urls.CSV"){

	$result = $content;
    try
    {
		$html = "";

		$dir_obj = get_nab_path_and_file();
		$files_dir = $dir_obj['dir'];

        if(!file_exists($files_dir)) return $result;

        $csv_file = $files_dir.$csv_name;

		if(!file_exists($csv_file) || !is_file($csv_file)) return $result;

        $row = 0;

        $list_item = "";
        if (($handle = fopen($csv_file, "r")) !== FALSE) {  // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_read_fopen
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // phpcs:ignore WordPress.CodeAnalysis.AssignmentInCondition.FoundInWhileCondition
                if($row > 0){
                    $list_item .= "<td>". (isset($data[0]) ? $data[0] : ""). "</td>";
                    $list_item .= "<td>". (isset($data[1]) ? $data[1] : ""). "</td>";
                    $list_item .= "<td>". (isset($data[2]) ? $data[2] : ""). "</td>";
                    $list_item .= "<tr>". (isset($data[3]) ? $data[3] : ""). "</td>";

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

		$result = $html . $result;

		return $result;

    }catch(\Exception $e){

		return $result;

    }
}

function csvToArray($csvFile){

    $file_to_read = fopen($csvFile, 'r'); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_read_fopen
    $i = 0;
    while (!feof($file_to_read) ) {
        $lines[$i++] = fgetcsv($file_to_read, 1000, ',');

    }

    fclose($file_to_read);
    return $lines;
}

function retrieve_exported_file_to_array($csv_name = "exported-paths-from-urls.CSV"){
    $rowdata = [];

	$path = get_nab_path_trimmed();
    $csv_file = "$path/$csv_name";

    if (!file_exists($csv_file) || !is_file($csv_file)) return $rowdata;

    $rowdata = csvToArray($csv_file);

    return $rowdata;
}

function get_range_exported_file_to_array($data = [], $offset_pos, $range_length){
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

function get_rows_pagination($data = [], $rowsperpage = 20, $currentpage = 0){
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

        $rowdata = get_range_exported_file_to_array($data, $offset, $rowsperpage);

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
            if ($row > 0) {
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


function handle_nab_export_path_csv_file($request_id){
	// Get the request.
	$request = wp_get_user_request( $request_id );

	if ( ! $request || 'export_personal_data' !== $request->action_name ) {
		wp_send_json_error( __( 'Invalid request ID when generating export file.' ) );
	}

	/*
	 * Handle the CSV export.
	 */
	// phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_read_fopen
	$file = fopen( $report_pathname, 'w' );

	if ( false === $file ) {
		wp_send_json_error( __( 'Unable to open export file (JSON report) for writing.' ) );
	}

	fwrite( $file, '{' );
	fwrite( $file, '"' . $title . '":' );
	fwrite( $file, $groups_json );
	fwrite( $file, '}' );
	fclose( $file );

	/*
	 * Handle the HTML export.
	 */
	// phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_read_fopen
	$file = fopen( $html_report_pathname, 'w' );

	if ( false === $file ) {
		wp_send_json_error( __( 'Unable to open export file (HTML report) for writing.' ) );
	}

}


function get_nab_path_and_file(){
	// Create the user request.
	$request_id = wp_create_user_request( get_current_user_id(), 'export_urls' );

	$archive = [];

	// Create the exports folder if needed.
	$archive['dir'] = $exports_dir = wp_privacy_exports_dir();
	$archive['url'] = $exports_url = wp_privacy_exports_url();
	$archive['temp_dir'] = $temp_dir = get_temp_dir();

	if ( ! wp_mkdir_p( $exports_dir ) ) {
		wp_send_json_error( __( 'Unable to create export folder.' ) );
	}
	// This meta value is used from version 5.5.
	$export_file_name = get_post_meta( $request_id, '_export_file_name', true );

	// This one stored an absolute path and is used for backward compatibility.
	$export_file_path = get_post_meta( $request_id, '_export_file_path', true );

	$file_basename        = 'exported-paths-from-urls';
	$archive['filename'] = wp_unique_filename( $temp_dir, $file_basename . '.csv' );
	$archive['path'] = wp_normalize_path( $temp_dir . $export_file_path );
	$csv_filename = $file_basename . '.csv';
	$csv_filename = wp_normalize_path( $temp_dir . $csv_filename ); // Use temp_dir because we don't want the file generated remotely yet.

	return $archive;
}

/**
 * This is largely a copy of core's `wp_privacy_generate_personal_data_export_file`
 *
 * And has been adapted to work with on Go:
 *  - It falls back to PclZip if ZipArchive is not available.
 *  - It tracks the generated date for an export in meta (which is then used for removal).
 *  - It uploads the generated zip to the Go Files Service.
 */
function generate_personal_data_export_file( $request_id ) {
	// Get the request.
	$request = wp_get_user_request( $request_id );

	if ( ! $request || 'export_personal_data' !== $request->action_name ) {
		wp_send_json_error( __( 'Invalid request ID when generating export file.' ) );
	}

	$email_address = $request->email;

	if ( ! is_email( $email_address ) ) {
		wp_send_json_error( __( 'Invalid email address when generating export file.' ) );
	}

	// Create the exports folder if needed.
	$exports_dir = wp_privacy_exports_dir();
	$exports_url = wp_privacy_exports_url();
	$temp_dir    = get_temp_dir();

	if ( ! wp_mkdir_p( $exports_dir ) ) {
		wp_send_json_error( __( 'Unable to create export folder.' ) );
	}

	// We don't care about the extrenuous index.html file.

	$stripped_email       = str_replace( '@', '-at-', $email_address );
	$stripped_email       = sanitize_title( $stripped_email ); // slugify the email address
	$obscura              = wp_generate_password( 32, false, false );
	$file_basename        = 'wp-personal-data-file-' . $stripped_email . '-' . $obscura;
	$html_report_filename = wp_unique_filename( $temp_dir, $file_basename . '.html' );
	$html_report_pathname = wp_normalize_path( $temp_dir . $html_report_filename );
	$json_report_filename = $file_basename . '.json';
	$json_report_pathname = wp_normalize_path( $temp_dir . $json_report_filename ); // Use temp_dir because we don't want the file generated remotely yet.

	/*
	 * Gather general data needed.
	 */

	// Title.
	$title = sprintf(
		/* translators: %s: User's email address. */
		__( 'Personal Data Export for %s' ),
		$email_address
	);

	// And now, all the Groups.
	$groups = get_post_meta( $request_id, '_export_data_grouped', true );

	// First, build an "About" group on the fly for this report.
	$about_group = array(
		/* translators: Header for the About section in a personal data export. */
		'group_label'       => _x( 'About', 'personal data group label' ),
		/* translators: Description for the About section in a personal data export. */
		'group_description' => _x( 'Overview of export report.', 'personal data group description' ),
		'items'             => array(
			'about-1' => array(
				array(
					'name'  => _x( 'Report generated for', 'email address' ),
					'value' => $email_address,
				),
				array(
					'name'  => _x( 'For site', 'website name' ),
					'value' => get_bloginfo( 'name' ),
				),
				array(
					'name'  => _x( 'At URL', 'website URL' ),
					'value' => get_bloginfo( 'url' ),
				),
				array(
					'name'  => _x( 'On', 'date/time' ),
					'value' => current_time( 'mysql' ),
				),
			),
		),
	);

	// Merge in the special about group.
	$groups = array_merge( array( 'about' => $about_group ), $groups );

	$groups_count = count( $groups );

	// Convert the groups to JSON format.
	$groups_json = wp_json_encode( $groups );

	/*
	 * Handle the JSON export.
	 */
	// phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_read_fopen
	$file = fopen( $json_report_pathname, 'w' );

	if ( false === $file ) {
		wp_send_json_error( __( 'Unable to open export file (JSON report) for writing.' ) );
	}

	fwrite( $file, '{' );
	fwrite( $file, '"' . $title . '":' );
	fwrite( $file, $groups_json );
	fwrite( $file, '}' );
	fclose( $file );

	/*
	 * Handle the HTML export.
	 */
	// phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_read_fopen
	$file = fopen( $html_report_pathname, 'w' );

	if ( false === $file ) {
		wp_send_json_error( __( 'Unable to open export file (HTML report) for writing.' ) );
	}

	fwrite( $file, "<!DOCTYPE html>\n" );
	fwrite( $file, "<html>\n" );
	fwrite( $file, "<head>\n" );
	fwrite( $file, "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />\n" );
	fwrite( $file, "<style type='text/css'>" );
	fwrite( $file, 'body { color: black; font-family: Arial, sans-serif; font-size: 11pt; margin: 15px auto; width: 860px; }' );
	fwrite( $file, 'table { background: #f0f0f0; border: 1px solid #ddd; margin-bottom: 20px; width: 100%; }' );
	fwrite( $file, 'th { padding: 5px; text-align: left; width: 20%; }' );
	fwrite( $file, 'td { padding: 5px; }' );
	fwrite( $file, 'tr:nth-child(odd) { background-color: #fafafa; }' );
	fwrite( $file, '.return-to-top { text-align: right; }' );
	fwrite( $file, '</style>' );
	fwrite( $file, '<title>' );
	fwrite( $file, esc_html( $title ) );
	fwrite( $file, '</title>' );
	fwrite( $file, "</head>\n" );
	fwrite( $file, "<body>\n" );
	fwrite( $file, '<h1 id="top">' . esc_html__( 'Personal Data Export' ) . '</h1>' );

	// Create TOC.
	if ( $groups_count > 1 ) {
		fwrite( $file, '<div id="table_of_contents">' );
		fwrite( $file, '<h2>' . esc_html__( 'Table of Contents' ) . '</h2>' );
		fwrite( $file, '<ul>' );
		foreach ( (array) $groups as $group_id => $group_data ) {
			$group_label       = esc_html( $group_data['group_label'] );
			$group_id_attr     = sanitize_title_with_dashes( $group_data['group_label'] . '-' . $group_id );
			$group_items_count = count( (array) $group_data['items'] );
			if ( $group_items_count > 1 ) {
				$group_label .= sprintf( ' <span class="count">(%d)</span>', $group_items_count );
			}
			fwrite( $file, '<li>' );
			fwrite( $file, '<a href="#' . esc_attr( $group_id_attr ) . '">' . $group_label . '</a>' );
			fwrite( $file, '</li>' );
		}
		fwrite( $file, '</ul>' );
		fwrite( $file, '</div>' );
	}

	// Now, iterate over every group in $groups and have the formatter render it in HTML.
	foreach ( (array) $groups as $group_id => $group_data ) {
		fwrite( $file, wp_privacy_generate_personal_data_export_group_html( $group_data, $group_id, $groups_count ) );
	}

	fwrite( $file, "</body>\n" );
	fwrite( $file, "</html>\n" );
	fclose( $file );

	/*
	 * Now, generate the ZIP.
	 *
	 * If an archive has already been generated, then remove it and reuse the filename,
	 * to avoid breaking any URLs that may have been previously sent via email.
	 */
	$error = false;

	// This meta value is used from version 5.5.
	$archive_filename = get_post_meta( $request_id, '_export_file_name', true );

	// This one stored an absolute path and is used for backward compatibility.
	$archive_pathname = get_post_meta( $request_id, '_export_file_path', true );

	// If a filename meta exists, use it.
	if ( ! empty( $archive_filename ) ) {
		$archive_pathname = $exports_dir . $archive_filename;
	} elseif ( ! empty( $archive_pathname ) && is_file( $archive_pathname ) ) {
		// If a full path meta exists, use it and create the new meta value.
		$archive_filename = basename( $archive_pathname );

		update_post_meta( $request_id, '_export_file_name', $archive_filename );

		// Remove the back-compat meta values.
		delete_post_meta( $request_id, '_export_file_url' );
		delete_post_meta( $request_id, '_export_file_path' );
	} else {
		// If there's no filename or full path stored, create a new file.
		$archive_filename = $file_basename . '.zip';
		$archive_pathname = $exports_dir . $archive_filename;

		update_post_meta( $request_id, '_export_file_name', $archive_filename );
	}

	$archive_url = $exports_url . $archive_filename;

	if ( ! empty( $archive_pathname ) && is_file( $archive_pathname ) ) {
		wp_delete_file( $archive_pathname );
	}

	// Track generated time to simplify deletions.
	// We can't currently iterate through files in the Files Service so we need a way to query exports by date.
	update_post_meta( $request_id, '_vip_export_generated_time', time() );

	// Hack: ZipArchive and PclZip don't support streams.
	// So, let's force the path to use a local one in the temp dir, which will work.
	// All other references (meta) will still use the correct stream URL.
	$local_archive_pathname = $archive_pathname;

	if ( 0 === strpos( $local_archive_pathname, 'vip://' ) ) {
		$local_archive_pathname = get_temp_dir() . substr( $archive_pathname, 6 );

		// Create the folder path.
		$local_archive_dirname     = dirname( $local_archive_pathname );
		$local_archive_dir_created = wp_mkdir_p( $local_archive_dirname );
		if ( is_wp_error( $local_archive_dir_created ) ) {
			/** @var WP_Error $local_archive_dir_created */
			wp_send_json_error( $local_archive_dir_created->get_error_message() );
		}
	}

	// Note: core deletes the file if it exists, but we can just overwrite it when we upload.

	// ZipArchive may not be available across all applications.
	// Use it if it exists, otherwise fallback to PclZip.
	if ( class_exists( '\ZipArchive' ) ) {
		$zip = new \ZipArchive; // phpcs:ignore WordPress.Classes.ClassInstantiation.MissingParenthesis
		if ( true === $zip->open( $local_archive_pathname, \ZipArchive::CREATE ) ) {
			if ( ! $zip->addFile( $json_report_pathname, 'export.json' ) ) {
				$error = __( 'Unable to add data to JSON file.' );
			}

			if ( ! $zip->addFile( $html_report_pathname, 'index.html' ) ) {
				$error = __( 'Unable to add data to HTML file.' );
			}

			$zip->close();
		} else {
			$error = __( 'Unable to open export file (archive) for writing.' );
		}
	} else {
		$zip = _pclzip_create_file( $local_archive_pathname, $html_report_pathname );

		if ( is_wp_error( $zip ) ) {
			$error = __( 'Unable to open export file (archive) for writing.' );
		}
	}

	// Remove the JSON file.
	unlink( $json_report_pathname );

	// Remove the HTML file.
	unlink( $html_report_pathname );

	if ( $error ) {
		wp_send_json_error( $error );
	} else {
		/** This filter is documented in wp-admin/includes/file.php */
		do_action( 'wp_privacy_personal_data_export_file_created', $local_archive_pathname, $archive_url, $html_report_pathname, $request_id, $json_report_pathname );

		_upload_archive_file( $local_archive_pathname );
	}
}

function _upload_archive_file( $archive_path ) {
	// For local usage, skip the remote upload.
	// The file is already in the uploads folder.
	if ( true !== WPCOM_IS_VIP_ENV ) {
		return true;
	}

	if ( ! class_exists( 'Automattic\VIP\Files\Api_Client' ) ) {
		require WPMU_PLUGIN_DIR . '/files/class-api-client.php';
	}

	// Build the `/wp-content/` version of the exports path since `LOCAL_UPLOADS` gives us a `/tmp` path.
	// Hard-coded and full of assumptions for now.
	// TODO: need a cleaner approach for this. Can probably borrow `WP_Filesystem_VIP_Uploads::sanitize_uploads_path()`.
	$archive_file      = basename( $archive_path );
	$exports_url       = wp_privacy_exports_url();
	$wp_content_strpos = strpos( $exports_url, '/wp-content/uploads/' );
	$upload_path       = trailingslashit( substr( $exports_url, $wp_content_strpos ) ) . $archive_file;

	$api_client    = \Automattic\VIP\Files\new_api_client();
	$upload_result = $api_client->upload_file( $archive_path, $upload_path );

	// Delete the local copy of the archive since it's been uploaded.
	unlink( $archive_path );

	return $upload_result;
}

function _delete_archive_file( $archive_url ) {
	$archive_path = wp_parse_url( $archive_url, PHP_URL_PATH );

	// For local usage, just delete locally.
	if ( true !== WPCOM_IS_VIP_ENV ) {
		unlink( WP_CONTENT_DIR . $archive_path );
		return true;
	}

	if ( ! class_exists( 'Automattic\VIP\Files\Api_Client' ) ) {
		require WPMU_PLUGIN_DIR . '/files/class-api-client.php';
	}

	$api_client = \Automattic\VIP\Files\new_api_client();
	return $api_client->delete_file( $archive_path );
}

/**
 * This is very different from the core implementation.
 *
 * Rather than filesystem time stamps, we store the time in meta, and query against that to find old, expired requests.
 */
function delete_old_export_files() {
	global $wpdb;

	/** This filter is documented in wp-includes/functions.php */
	$expiration           = apply_filters( 'wp_privacy_export_expiration', 3 * DAY_IN_SECONDS );
	$expiration_timestamp = time() - $expiration;

	// phpcs:ignore WordPress.DB.DirectDatabaseQuery -- direct query to avoid the unnecessary overhead of WP_Query.
	$file_urls = $wpdb->get_col(
		$wpdb->prepare( "SELECT pm.meta_value FROM $wpdb->postmeta AS pm
			INNER JOIN $wpdb->postmeta AS expiry
				ON expiry.post_id = pm.post_id
				AND expiry.meta_key = '_vip_export_generated_time'
				AND expiry.meta_value <= %d
			WHERE pm.meta_key = '_export_file_url'
			LIMIT 100", $expiration_timestamp
		)
	);

	if ( empty( $file_urls ) ) {
		return;
	}

	foreach ( $file_urls as $file_url ) {
		$delete_result = _delete_archive_file( $file_url );
		if ( is_wp_error( $delete_result ) ) {
			/* translators: 1: archive file URL 2: error message */
			$message = sprintf( __( 'Failed to delete expired personal data export (%1$s): %2$s' ), $file_url, $delete_result->get_error_message() );

			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
			trigger_error( esc_html( $message ), E_USER_WARNING );
		}
	}
}
