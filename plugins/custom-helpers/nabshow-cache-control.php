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

require_once WPMU_PLUGIN_DIR . "/misc.php";

require_once WP_PLUGIN_DIR . "/custom-helpers/url-env-cache-control-reverse-proxy-helper/reverse-proxy/config-reverse-proxy.php";

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
        add_action('send_headers', [ $this, 'nabshow_send_headers' ]);  
        add_filter('wp_headers', [ $this, 'remove_phpsessid_from_cookie_headers' ]);  
        add_action('template_redirect', [$this, 'set_etag_last_modified']);
    }//end init_enqueue_scripts()

    public function nabshow_send_headers()
    {        
        send_nosniff_header(); // prevent client from sniffing asset files and other resources

        if(!is_user_logged_in()) { UrlCacheControl::wp_add_cache_param(); // handle caching strategy
        }
    }
    public function remove_phpsessid_from_cookie_headers($headers)
    {
        send_origin_headers(); // Retrieve origin http headers
        
        $headers = UrlCacheControl::get_HTTP_request_headers(); // Retrieve existing http request headers
        
        $set_cookie = !empty($headers['Cookie']) ? $headers['Cookie'] : null;
        
        if(!empty($headers['Cookie'])){
            $cookie = preg_replace('/(PHPSESSID=[0-9a-zA-Z0-9]*\;)/', '', $set_cookie); // Remove PHPSESSID value from header set-cookie       
            $headers['Cookie'] = stripslashes($cookie);
        }else{
            header("Set-Cookie: PHP Session Id (PHPSESSID) is not included here to prevent sudden cache invalidation");
        }
        
        unset(
            $headers['X-Country-Code'],
            $headers['X-Mobile-Class'],
            $headers['x-Query-Args'],
            $headers['X-Hacker'],
            $headers['X-Powered-By'],
            $headers['Sec-Fetch-User'],
            $headers['Sec-Ch-Ua-Mobile'],
            $headers['Sec-Ch-Ua-Platform'],
            $headers['Sec-Ch-Ua']
        );

        return $headers;
    }   

    // setting custom etag & last-modified headers
    public function set_etag_last_modified()
    {

        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

        if (! isset($_GET['send_test_etag']) ) { return;
        }

        $etag = sanitize_key(wp_unslash($_GET['send_test_etag']));
        header("ETag: $etag");

        // Handle responses that are cached by the browser.
        if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && $_SERVER['HTTP_IF_NONE_MATCH'] === $etag ) {
            status_header(304);
            return '';
        }

        foreach ( $_SERVER as $key => $value ) {
            if (! preg_match('/^HTTP_/', $key) ) { continue;
            }
            $header = substr($key, 5);
            $header = str_replace('_', '-', $header);
            $header = strtolower($header);
            $value  = wp_unslash($value);
        }

        exit;
    }

}//end class

new NabshowCacheControl();
