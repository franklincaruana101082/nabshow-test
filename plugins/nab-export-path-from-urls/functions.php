<?php
/**
 * Created by PhpStorm.
 * User: Atlas_Gondal
 * Date: 4/9/2016
 * Time: 9:01 AM
 */

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

    $upload_dir = wp_upload_dir();
    $files_dir  = get_nab_path_trimmed();
    $csv_file = "$files_dir/$csv_name.CSV";

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
            chmod($csv_file, 0777); //phpcs:ignore WordPressVIPMinimum.Functions.RestrictedFunctions.chmod_chmod

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

        $files_dir =  get_nab_path_trimmed();

        if(!file_exists($files_dir)) return $result;

        $csv_file = "$files_dir/$csv_name";

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

// Workaround for  correcting upload directory / path. Usually for multisite issue
function fix_upload_paths($data)
{
    $data['basedir'] = $data['basedir'];
    $data['path'] = $data['basedir'].$data['subdir'];
    $data['baseurl'] = $data['baseurl'];
    $data['url'] = $data['baseurl'].$data['subdir'];
    return $data;
}

function get_nab_path_trimmed(){

	$upload_dir = wp_get_upload_dir();
	$filepath = $upload_dir['path'];
	return $filepath;
}
