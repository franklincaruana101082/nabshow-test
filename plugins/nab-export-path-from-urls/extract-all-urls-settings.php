<?php


function eau_generate_html()
{

    if (!current_user_can('manage_options'))
    {
        wp_die('You do not have sufficient permissions to access this page.');
    }



    $custom_posts_names = array();
    $custom_posts_labels = array();
    $user_ids = array();
    $user_names = array();

    $args = array(
        'public' => true,
        '_builtin' => false
    );

    $output = 'objects';

    $operator = 'and';

    $post_types = get_post_types($args, $output, $operator);

    foreach ($post_types as $post_type)
    {

        $custom_posts_names[] = $post_type->name;
        $custom_posts_labels[] = $post_type
            ->labels->singular_name;

    }

    $users = get_users();

    foreach ($users as $user)
    {
        $user_ids[] = $user
            ->data->ID;
        $user_names[] = $user
            ->data->user_login;
    }

    $upload_dir = wp_get_upload_dir();
    $file_path = preg_replace('/vip:\/\/','',$upload_dir['path']);
    $file_name = 'exported-paths-from-urls';
?>

    <div class="wrap">

        <h2 align="center">Export Data from your Site</h2>

        <div class="eauWrapper">
            <div id="eauMainContainer" class="postbox eaucolumns">

                <div class="inside">

                    <form id="infoForm" method="post">

                        <?php wp_nonce_field('export_urls'); ?>

                        <table class="form-table">

                            <tr style="display: none;">

                                <th>Select a Post Type to Extract Data: </th>

                                <td>

                                    <label><input type="radio" name="post-type" value="any" required="required" checked /> All
                                        Types (pages, posts, and custom post types)</label><br/>
                                    <label><input type="radio" name="post-type" value="page" required="required"/> Pages</label><br/>
                                    <label><input type="radio" name="post-type" value="post" required="required"/> Posts</label><br/>

                                    <?php
    if (!empty($custom_posts_names) && !empty($custom_posts_labels))
    {
        for ($i = 0;$i < count($custom_posts_names);$i++)
        {
            echo '<label><input type="radio" name="post-type" value="' . esc_attr($custom_posts_names[$i]) . '" required="required" /> ' . esc_html($custom_posts_labels[$i]) . ' Posts</label><br>';
        }
    }



?>

                                </td>

                            </tr>

                            <tr style="display: none;">

                                <th>Export Fields:</th>

                                <td>

                                    <label><input type="checkbox" name="additional-data[]" checked value="postIDs"/>
                                        Post IDs</label><br/>
                                    <label><input type="checkbox" name="additional-data[]" checked value="post_type"/>
                                        post Type</label><br/>
									<label><input type="checkbox" name="additional-data[]" checked value="path"/>
										Paths</label><br/>

                                </td>

                            </tr>

                            <tr style="display: none;">

                                <th>Post Status:</th>

                                <td>

                                    <label><input type="radio" name="post-status" value="publish"/>
                                        Published</label><br/>
                                    <label><input type="radio" name="post-status" value="pending"/> Pending</label><br/>
                                    <label><input type="radio" name="post-status" value="draft"/> Draft & Auto
                                        Draft</label><br/>
                                    <label><input type="radio" name="post-status" value="future"/> Future
                                        Scheduled</label><br/>
                                    <label><input type="radio" name="post-status" value="private"/> Private</label><br/>
                                    <label><input type="radio" name="post-status" value="trash"/> Trashed</label><br/>
                                    <label><input type="radio" name="post-status" checked value="all"/> All (Published, Pending,
                                        Draft, Future Scheduled, Private & Trash)</label><br/>

                                </td>

                            </tr>

                            <tr style="display: none">
                                <th></th>
                                <td><a href="#" id="moreFilterOptionsLabel"
                                       onclick="lessFilterOptions(); return false;">Hide Filter Options</a></td>
                            </tr>

                            <tr>

                                <th>Date Range:</th>

                                <td>
							<?php
							$posts_from = "2000-01-01";
							$posts_upto = "2022-01-01";
                            if (isset($_REQUEST['_wpnonce'])){
                                if(!empty($_POST['posts-from'])) $posts_from = sanitize_file_name($_POST['posts-from']);
                                if(!empty($_POST['posts-upto'])) $posts_upto = sanitize_file_name($_POST['posts-upto']);
                            }
							?>
                                    <label>From:<input type="date" id="posts-from" name="posts-from" value="<?php echo esc_attr($posts_from); ?>"
                                                       onmouseleave="setMinValueForPostsUptoField()"
                                                       onfocusout="setMinValueForPostsUptoField()"/></label>
                                    <label>To:<input type="date" id="posts-upto" name="posts-upto" value="<?php echo esc_attr($posts_upto); ?>"/></label><br/>


                                </td>

                            </tr>

                            <tr style="display: none">

                                <th>By Author:</th>

                                <td>

                                    <label><input type="radio" name="post-author" checked value="all"
                                                  required="required"/> All</label><br/>
                                    <?php
    if (!empty($user_ids) && !empty($user_names))
    {
        for ($i = 0;$i < count($user_ids);$i++)
        {
            echo '<label><input type="radio" name="post-author" value="' . esc_attr($user_ids[$i]) . '" required="required" /> ' . esc_html($user_names[$i]) . '</label><br>';
        }
    }
?>

                                </td>

                            </tr>

                            <tr style="display: none">
                                <th></th>
                                <td><a href="#" id="advanceOptionsLabel" onclick="showAdvanceOptions(); return false;">Show Advanced Options</a></td>
                            </tr>

                            <tr class="advance-options" style="display: none">

                                <th>Remove WooCommerce Extra Attributes: </th>

                                <td>

                                    <label><input type="checkbox" name="remove-woo-attributes" value="yes"/> Yes &nbsp;&nbsp;<code>WooCommerce stores product attributes along with product categories, by default plugin may extract those attributes and show as categories. That can be fixed by enabling this option.</code>

                                </td>

                            </tr>

                            <tr class="advance-options" style="display: none">

                                <th>Exclude Domain URL: </th>

                                <td>

                                    <label><input type="checkbox" name="exclude-domain" value="yes"/> Yes &nbsp;&nbsp;<code>Enabling this option will use relative URLs, by removing domain url (e.g. example.com/sample-post/ will become /sample-post/)</code>

                                </td>

                            </tr>

                            <tr>

                                <th>Number of Posts: <a href="#"
                                                        title="Specify Post Range to Extract, It is very useful in case of Memory Out Error!"
                                                        onclick="return false">?</a></th>

                                <td>

                                    <label><input type="radio" name="number-of-posts" checked value="all"
                                                  required="required" onclick="hideRangeFields()"/> All</label><br/>
                                    <label><input type="radio" name="number-of-posts" value="range" required="required"
                                                  onclick="showRangeFields()"/> Specify Range</label><br/>

                                    <div id="postRange" style="display: table-row">
                                        From: <input type="number" name="starting-point" placeholder="0">
                                        To: <input type="number" name="ending-point" placeholder="500">
                                    </div>

                                </td>

                            </tr>

                            <tr  style="display: none">
                                <td>
                                <input
                                                    type="text" name="csv-file-name" placeholder="An Error Occured"
                                                    value="<?php echo esc_attr($file_name); ?>"
                                                    size="30%"/>
                                </td>
                            </tr>
                            <tr >

                                <th>CSV File Name: </th>

                                <td>



                                    <label><input
                                                type="text" value="<?php echo esc_attr($file_name); ?>"
                                                disabled size="30%"/></label>
                                                <br/>
                                                <code><?php echo esc_html($file_path); ?></code>


                                </td>


                            </tr>

                            <tr>

                                <th>Export Type:</th>

                                <td>

                                    <label><input type="radio" name="export-type" value="text" required="required" checked/> CSV File</label><br/>
                                    <label><input type="radio" name="export-type" value="here" required="required" />
                                        Output here</label><br/>

                                </td>

                            </tr>

                            <tr>

                                <td></td>

                                <td>
                                    <input type="submit" name="export" class="button button-primary"
                                           value="Export Now"/>
                                </td>

                            </tr>

                        </table>
                    </form>


                </div>

            </div>
            <div id="eauSideContainer" class="eaucolumns">
                <div class="postbox">
                    <h3>Want to Support?</h3>
                    <div class="inside">
                        <p>If you enjoyed the plugin, and want to support:</p>
                        <ul>
                            <li>
                                <a href="https://AtlasGondal.com/contact-me/?utm_source=self&utm_medium=wp&utm_campaign=export-all-urls&utm_term=hire-me"
                                   target="_blank">Hire me</a> on a project
                            </li>
                            <li>Buy me a Coffee
                                <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=YWT3BFURG6SGS&source=url" target="_blank"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif"/> </a>

                            </li>
                        </ul>
                        <hr>
                        <h3>Wanna say Thanks?</h3>
                        <ul>
                            <li>Leave <a
                                        href="https://wordpress.org/support/plugin/export-all-urls/reviews/?filter=5#new-post"
                                        target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating
                            </li>
                            <li>Tweet me: <a href="https://twitter.com/atlas_gondal" target="_blank">@Atlas_Gondal</a>
                            </li>
                        </ul>
                        <hr>
                        <h3>Got a Problem?</h3>
                        <p>If you want to report a bug or suggest new feature. You can:</p>
                        <ul>
                            <li>Create <a href="https://wordpress.org/support/plugin/export-all-urls/" target="_blank">Support
                                    Ticket</a></li>

                            <li>Write me an <a
                                        href="https://AtlasGondal.com/contact-me/?utm_source=self&utm_medium=wp&utm_campaign=export-all-urls&utm_term=write-an-email"
                                        target="_blank">Email</a></li>
                        </ul>
                        <strong>Reporting</strong> an issue is way better than leaving <strong>1 star</strong> feedback, which does not help you, me, or the community. So, please consider giving me a chance to help before leaving any negative feedback.
                        <hr>
                        <h4 id="eauDevelopedBy">Developed by: <a
                                    href="https://AtlasGondal.com/?utm_source=self&utm_medium=wp&utm_campaign=export-all-urls&utm_term=developed-by"
                                    target="_blank">Atlas Gondal</a></h4>
                    </div>
                </div>
            </div>
        </div>

        <style>.eauWrapper{display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;overflow:hidden}#eauMainContainer{width:75%;margin-bottom:0}#eauSideContainer{width:24%}#eauSideContainer .postbox:first-child{margin-left:20px;padding-top:15px}.eaucolumns{float:left;display:-webkit-flex;display:-ms-flexbox;display:flex;margin-top:5px}#eauSideContainer .postbox{margin-bottom:0;float:none}#eauSideContainer .inside{margin-bottom:0}#eauSideContainer hr{width:70%;margin:30px auto}#eauSideContainer h3{cursor:default;text-align:center;font-size:16px}#eauSideContainer li{list-style:disclosure-closed;margin-left:25px}#eauSideContainer li a img{display:inline-block;vertical-align:middle}#eauDevelopedBy{text-align:center}#outputData{border-collapse:collapse;width:98%}#outputData tr:nth-child(even){background-color:#fff}#outputData tr:hover{background-color:#ddd}#outputData th{background-color:#000;color:#fff}#outputData td,#outputData th{text-align:left;padding:8px}#outputData th:first-child{width:4%}#outputData #postID{width:10%}#outputData #postType{width:10%}#outputData #postPath{width:30%}#outputData #eauMainContainer code {font-size: 11px;background-color: #eee;padding-left: 5px;padding-right: 5px;}</style>

        <script type="text/javascript">
            function showRangeFields() {
                document.getElementById('postRange').style.display = 'block';
            }

            function hideRangeFields() {
                document.getElementById('postRange').style.display = 'none';
            }

            function showAdvanceOptions() {

                var rows = document.getElementsByClassName('advance-options');

                for (var i = 0; i < rows.length; i++) {
                    rows[i].style.display = 'table-row';
                }

                document.getElementById('advanceOptionsLabel').innerHTML = "Hide Advanced Options";
                document.getElementById('advanceOptionsLabel').setAttribute("onclick", "javascript: hideAdvanceOptions(); return false;");

            }

            function hideAdvanceOptions() {

                var rows = document.getElementsByClassName('advance-options');

                for (var i = 0; i < rows.length; i++) {
                    rows[i].style.display = 'none';
                }

                document.getElementById('advanceOptionsLabel').innerHTML = "Show Advanced Options";
                document.getElementById('advanceOptionsLabel').setAttribute("onclick", "javascript: showAdvanceOptions(); return false;");

            }

            function moreFilterOptions() {
                var rows = document.getElementsByClassName('filter-options');

                for (var i = 0; i < rows.length; i++) {
                    rows[i].style.display = 'table-row';
                }

                document.getElementById('moreFilterOptionsLabel').innerHTML = "Hide Filter Options";
                document.getElementById('moreFilterOptionsLabel').setAttribute("onclick", "javascript: lessFilterOptions(); return false;");

            }

            function lessFilterOptions() {
                var rows = document.getElementsByClassName('filter-options');

                for (var i = 0; i < rows.length; i++) {
                    rows[i].style.display = 'none';
                }

                document.getElementById('moreFilterOptionsLabel').innerHTML = "Show Filter Options";
                document.getElementById('moreFilterOptionsLabel').setAttribute("onclick", "javascript: moreFilterOptions(); return false;");

            }

            function setMinValueForPostsUptoField() {
                console.log(document.getElementById('posts-from').value);
                if (document.getElementById('posts-from').value != "") {
                    document.getElementById('posts-upto').setAttribute('min', document.getElementById('posts-from').value);
                }

            }
        </script>


    </div>


    <?php
    if (isset($_POST['export']))
    {

        if (isset($_REQUEST['_wpnonce']))
        {
            if (!wp_verify_nonce(sanitize_text_field($_REQUEST['_wpnonce']), 'export_urls'))
            {
                echo "<div class='notice notice-error' style='width: 93%'>Security token validation failed!</div>";
                exit;
            }

            if (!empty($_POST['post-type']) && !empty($_POST['export-type']) && !empty($_POST['additional-data']) && !empty($_POST['post-status']) && !empty($_POST['post-author']) && !empty($_POST['number-of-posts']))
            {

                $post_type = sanitize_text_field($_POST['post-type']);
                $export_type = sanitize_text_field($_POST['export-type']);
                $additional_data = map_deep($_POST['additional-data'], 'sanitize_text_field');
                $post_status = sanitize_text_field($_POST['post-status']);
                $post_author = sanitize_text_field($_POST['post-author']);
                $remove_woo_attributes = isset($_POST['remove-woo-attributes']) ? sanitize_text_field($_POST['remove-woo-attributes']) : null;
                $exclude_domain = isset($_POST['exclude-domain']) ? sanitize_text_field($_POST['exclude-domain']) : null;
                $number_of_posts = sanitize_text_field($_POST['number-of-posts']);
                $csv_name = !empty($_POST['csv-file-name']) ? sanitize_file_name($_POST['csv-file-name']) : "";

                if ($number_of_posts == "range")
                {
                    $offset = !empty($_POST['starting-point']) ? absint(sanitize_text_field($_POST['starting-point'])) : "all";
                    $post_per_page = !empty($_POST['ending-point']) ? absint(sanitize_text_field($_POST['ending-point'])) : "all";

                    if (!isset($offset) || !isset($post_per_page))
                    {
                        echo "Sorry, you didn't specify starting and ending post range. Please <strong>Set Post Range</strong> OR <strong>Select All</strong> and try again! :)";
                        exit;
                    }

                    $post_per_page = $post_per_page - $offset;

                }
                else
                {
                    $offset = 'all';
                    $post_per_page = 'all';
                }

                if ($export_type == 'text')
                {
                    if (empty($csv_name))
                    {
                        echo "Invalid/Missing CSV File Name!";
                        exit;
                    }
                }



                if (!empty($posts_from) && !empty($posts_upto))
                {

                    if ($posts_from > $posts_upto)
                    {
                        echo "Sorry, invalid post date range. :)";
                        exit;
                    }

                }
                else
                {
                    $posts_from = '';
                    $posts_upto = '';
                }

                $selected_post_type = eau_get_selected_post_type($post_type, $custom_posts_names);

                eau_generate_output($selected_post_type, $post_status, $post_author, $remove_woo_attributes, $exclude_domain, $post_per_page, $offset, $export_type, $additional_data, $csv_name, $posts_from, $posts_upto);

            }
            else
            {
                echo "<div class='notice notice-error' style='width: 93%'>Sorry, you missed something, Please recheck above options, especially <strong>Export Fields</strong> and try again! :)</div>";
                exit;
            }
        }
        else
        {
            echo "<div class='notice notice-error' style='width: 93%'>Verification token is missing!</div>";
            exit;
        }

    }
    else if ((isset($_REQUEST['del']) && $_REQUEST['del'] == 'y'))
    {
        if (!isset($_REQUEST['_wpnonce']) || (!empty(sanitize_text_field($_GET['_wpnonce'])) && !wp_verify_nonce(sanitize_text_field($_GET['_wpnonce']))))
        {
            echo "You are not authorized to perform this action!";
            exit();
        }
        else if(isset($_REQUEST['del']) && $_REQUEST['del'] == 'y')
        {
            $file_dir = wp_get_upload_dir();
            $checkfile = !empty($_REQUEST['f']) ? base64_decode(sanitize_text_field($_REQUEST['f'])) : null;
            $file = $file_dir['path']."/".$checkfile;
            echo (!empty($file) ? (file_exists($file) ? (!unlink($file) ? "<div class='notice notice-error' style='width: 97%'></div>Unable to delete file, please delete it manually!" : "<div class='updated' style='width: 97%'>You did great, the file was <strong>Deleted Successfully</strong>!</div>") : null) : "<div class='notice notice-error'>Missing file path.</div>"); // phpcs:ignore WordPressVIPMinimum.Functions.RestrictedFunctions.file_ops_unlink
        }
    }
}

eau_generate_html();
