<?php
namespace Plugins\CustomHelpers\CacheControlUrlEnv;

require_once WP_PLUGIN_DIR . "/custom-helpers/cache-control-url-env/class-url-cache-control.php";

use Plugins\CustomHelpers\CacheControlUrlEnv\UrlCacheControl;
class NabshowCacheControl
{
    public function __construct()
    {
        $this->init_enqueue_scripts();

    }//end __construct()


    public function init_enqueue_scripts()
    {

        add_filter('wp_headers', [ $this, 'nabshow_send_headers' ],999);

    }//end init_enqueue_scripts()

    public function nabshow_send_headers($headers)
    {
        $headers = UrlCacheControl::wp_add_cache_param($headers); // handle caching strategy
        $headers = UrlCacheControl::set_etag_last_modified($headers);
        $headers = UrlCacheControl::remove_phpsessid_from_cookie_headers($headers,true);
        $headers = UrlCacheControl::sel_remove_headers($headers);

        return $headers;
    }

}//end class

new NabshowCacheControl();
