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
    $parse_url = wp_parse_url($url);
    return $parse_url['path'];
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

            $html['post_id'][$counter] = (isset($html['post_id'][$counter]) ? "" : null);

            $posts_query->the_post();
            $html['post_id'][$counter] .= get_the_ID() . $line_break;
            $counter++;

        endwhile;

        $counter = 0;

    }

    if (eau_is_checked($additional_data, 'post_type')) {

        while ($posts_query->have_posts()):

            $html['post_type'][$counter] = (isset($html['post_type'][$counter]) ? "" : null);

            $posts_query->the_post();
            $html['post_type'][$counter] .= get_post_type( get_the_ID() ) . $line_break;

			$counter++;

        endwhile;

        $counter = 0;

    }

    if (eau_is_checked($additional_data, 'path')) {

        while ($posts_query->have_posts()):

            $html['path'][$counter] = (isset($html['path'][$counter]) ? "" : null);

            $posts_query->the_post();
            $parse_url = wp_parse_url(get_permalink());
            $html['path'][$counter] .= $parse_url['path'] . $line_break;

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

    $file_path = wp_get_upload_dir();

    $count = 0;
    foreach ($urls as $item) {
        $count = count($item);
    }


    switch ($export_type) {

        case "text":

            $data = '';
            $headers = array();

            $file = $file_path['path'] . "/exported-paths-from-urls.CSV";
            $myfile = @fopen($file, "w") or wp_die("<div class='error' style='width: 95.3%; margin-left: 2px;'>Unable to create a file on your server! (either invalid name supplied or permission issue)</div>");
            fprintf($myfile, "\xEF\xBB\xBF");

            $csv_url = esc_url($file_path['url'] . "/" . $csv_name . ".CSV");

            $headers[] = 'Post ID';
            $headers[] = 'Post Type';
            $headers[] = 'Paths';

            fputcsv($myfile, $headers);

            for ($i = 0; $i < $count; $i++) {
                $data = array(
                    isset($urls['post_id']) ? $urls['post_id'][$i] : "",
                    isset($urls['post_type']) ? $urls['post_type'][$i] : "",
                    isset($urls['path']) ? $urls['path'][$i] : ""
                );

                fputcsv($myfile, $data);
            }

            fclose($myfile);

            $html .= "<div class='updated' style='width: 97%'>Data exported successfully! <a href='" . $csv_url . "' target='_blank'><strong>Click here</strong></a> to Download.</div>";
            $html .= "<div class='notice notice-warning' style='width: 97%'>Once you have downloaded the file, it is recommended to delete file from the server, for security reasons. <a href='".wp_nonce_url(admin_url('tools.php?page=extract-all-urls-settings&del=y&f=').base64_encode($file))."' ><strong>Click Here</strong></a> to delete the file. And don't worry, you can always regenerate anytime. :)</div>";
            $html .= "<div class='notice notice-info' style='width: 97%'><strong>Total</strong> number of paths exported: <strong>".$count."</strong>.</div>";

            break;

        case "here":

            $html .= "<h1 align='center' style='padding: 10px 0;'><strong>Below is a list of Exported Data:</strong></h1>";
            $html .= "<h2 align='center' style='font-weight: normal;'>Total number of links: <strong>$count</strong>.</h2>";
            $html .= "<table class='form-table' id='outputData'>";
            $html .= "<tr><th>#</th>";
            $html .= isset($urls['post_id']) ? "<th id='postID'>Post ID</th>" : null;
            $html .= isset($urls['post_type']) ? "<th id='postID'>Post Type</th>" : null;
            $html .= isset($urls['path']) ? "<th id='postPath'>Paths</th>" : null;

            $html .= "</tr>";

            for ($i = 0; $i < $count; $i++) {

                $id = $i + 1;
                $html .= "<tr><td>$id</td>";
                $html .= isset($urls['post_id']) ? "<td>".$urls['post_id'][$i]."</td>" : null;
                $html .= isset($urls['post_type']) ? "<td>" . $urls['post_type'][$i] . "</td>" : null;
                $html .= isset($urls['path']) ? "<td>" . $urls['path'][$i] . "</td>" : null;

                $html .= "</tr>";
            }

            $html .= "</table>";



            break;

        default:

            echo "Sorry, you missed export type, Please <strong>Select Export Type</strong> and try again! :)";
            break;


    }

    esc_html($html);


}
