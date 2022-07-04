<?php

// use Plugins\CustomHelpers\UrlEnvCacheControlReverseProxyHelper\UrlCacheControl;

function bs_setup()
{
    // UrlCacheControl::register_nabshow_session();
}//end bs_setup()


function bs_get_base_url($append=false)
{
    $pageURL = (@$_SERVER['HTTPS'] == 'on' || @$_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') ? 'https://' : 'http://';

    if ($_SERVER['SERVER_PORT'] != '80') {
        $pageURL .= $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
    } else {
        $pageURL .= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    }

    preg_match('#(.*)'.BROADSTREET_VENDOR_PATH.'#', $pageURL, $matches);
    return $matches[1].BROADSTREET_VENDOR_PATH.'/'.$append;

}//end bs_get_base_url()


function bs_check_perms()
{

}//end bs_check_perms()


function bs_get_email()
{
    return '';

}//end bs_get_email()


function bs_get_website()
{
    return 'http://broadstreetads.com';

}//end bs_get_website()


function bs_get_website_name()
{
    return 'New Publisher '.date('Y-m-d');

}//end bs_get_website_name()


function bs_get_platform_version()
{
    return 'NO PLATFORM';

}//end bs_get_platform_version()


function bs_handle_upload($uploadedfile, $upload_overrides=[])
{
    $uploaddir = realpath(dirname(__FILE__).'/../../tmp');

    $filename = uniqid('upload_', true);
    $filename = preg_replace('#.*\.#i', "$filename.", basename($uploadedfile['name']));

    $uploadfile = $uploaddir.'/'.$filename;

    if (move_uploaded_file($uploadedfile['tmp_name'], $uploadfile)) {
        return [
            'type' => mime_content_type($uploadfile),
            'url'  => bs_get_base_url('tmp/'.basename($uploadfile)),
            'file' => $uploadfile,
        ];
    } else {
        return ['error' => 'There was an error uploading the file!'];
    }

}//end bs_handle_upload()


function bs_get_sample()
{
    $file = 'sample-ad.png';
    $path = realpath(dirname(__FILE__).'/../../assets/img/'.$file);
    $url  = bs_get_base_url('assets/img/'.$file);

    return [
        'type' => mime_content_type($path),
        'url'  => $url,
        'file' => $path,
    ];

}//end bs_get_sample()


function bs_mail($to, $subject, $body)
{
    @wp_mail($to, $subject, $body);

}//end bs_mail()


function bs_get_option($name, $default=false)
{
    if (BROADSTREET_USE_DATABASE && !bs_is_session_data($name)) {
        return bs_db_get_option($name, $default);
    } else {
        $value = @$_SESSION[$name];
        if ($value !== null) {
            return $value;
        }

        return $default;
    }

}//end bs_get_option()


function bs_set_option($name, $value)
{
    if (bs_get_option($name) !== null) {
        bs_update_option($name, $value);
    } else {
        bs_add_option($name, $value);
    }

}//end bs_set_option()


function bs_update_option($name, $value)
{
    if (BROADSTREET_USE_DATABASE && !bs_is_session_data($name)) {
        bs_db_update_option($name, $value);
    } else {
        $_SESSION[$name] = $value;
    }

}//end bs_update_option()


function bs_is_session_data($name)
{
    return in_array($name, [Broadstreet_Mini::KEY_API_KEY, Broadstreet_Mini::KEY_NETWORK_ID]);

}//end bs_is_session_data()


function bs_add_option($name, $value)
{
    bs_update_option($name, $value);

}//end bs_add_option()


function bs_editable_js($selector=false, $key='solo')
{
    if (!$selector) {
        $selector = BROADSTREET_AD_TAG_SELECTOR;
    }

        echo <<<JS
<script language="javascript">
    function editable_$key()
    {
        window.send_to_editor = function(html) {
            if(html) jQuery('$selector').val(html);
            tb_remove();
        };
    }
</script>
JS;

}//end bs_editable_js()


function bs_get_db()
{
    $db = @$GLOBALS['bs_db'];

    if (!$db) {
        $db = mysqli_connect(BROADSTREET_DB_HOST, BROADSTREET_DB_USER, BROADSTREET_DB_PASS);
        mysqli_select_db(BROADSTREET_DB_NAME, $db);
        $GLOBALS['bs_db'] = $db;
    }

    return $db;

}//end bs_get_db()


function bs_db_update_option($name, $value)
{
    $db    = bs_get_db();
    $table = BROADSTREET_DB_TABLE;
    $name  = mysqli_real_escape_string($name);
    $value = mysqli_real_escape_string(serialize($value));

    $sql = "INSERT INTO $table (name, value) VALUES ('$name', '$value')
            ON DUPLICATE KEY UPDATE value = '$value'";

    mysqli_query($sql, $db);

}//end bs_db_update_option()


function bs_db_get_option($name, $default)
{
    $db    = bs_get_db();
    $table = BROADSTREET_DB_TABLE;
    $name  = mysqli_real_escape_string($name);

    $sql = "SELECT value FROM $table WHERE name = '$name' LIMIT 1";

    $qh  = mysqli_query($sql, $db);
    $row = mysqli_fetch_array($qh);

    if ($row) {
        return unserialize($row['value']);
    }

    return $default;

}//end bs_db_get_option()
