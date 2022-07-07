<?php
/*
 * Plugin Name: Custom Cache Control, Environment Manage, Url Verify Helpers
 * Plugin URI: https://plugin-site.example.com
 * Description: Custom Cache Control, Environment Manage, Url Verify Helpers
 * Version:     1.0.0
 * Author: Frank-Codev
 * Author URI:  codev.com
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Plugins\CustomHelpers;

require_once WP_PLUGIN_DIR . "/custom-helpers/url-env-cache-control-reverse-proxy-helper/config-cache-control.php";

require_once WP_PLUGIN_DIR . "/custom-helpers/url-env-cache-control-reverse-proxy-helper/class-url-cache-control.php";

use Plugins\CustomHelpers\UrlEnvCacheControlReverseProxyHelper\UrlCacheControl;
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
        $headers = UrlCacheControl::remove_phpsessid_from_cookie_headers($headers);
        $headers = UrlCacheControl::sel_remove_headers($headers);

        return $headers;
    }

}//end class

new NabshowCacheControl();
