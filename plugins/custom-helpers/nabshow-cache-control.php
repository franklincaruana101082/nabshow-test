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
    /**
     * The page identifier used in WordPress to register the MyYoast proxy page.
     *
     * @var string
     */
    const PAGE_IDENTIFIER = 'nabshow_page_proxy';

    /**
     * The cache control's max age. Used in the header of a successful proxy response.
     *
     * @var int
     */
    const CACHE_CONTROL_MAX_AGE = DAY_IN_SECONDS;   


    public function __construct()
    {   
           
        $this->init_enqueue_scripts();  

    }//end __construct()


    public function init_enqueue_scripts()
    {        
         
        add_action('init', [ $this, 'set_extra_js_scripts' ]);   
        add_action('send_headers', [ $this, 'nabshow_send_headers' ]);  
        add_filter('wp_headers', [ $this, 'remove_some_x_headers' ]);  
    }//end init_enqueue_scripts()

    public function nabshow_send_headers()
    {        
        remove_action('wp_head', 'wp_generator');

        send_origin_headers();
        send_nosniff_header();

        // UrlCacheControl::update_header_sent_wo_phpsessid(); // remove PHPSESSID from header and its value

        if(!is_user_logged_in()) { UrlCacheControl::wp_add_cache_param();
        }
    }
    public function set_extra_js_scripts()
    {  
        wp_enqueue_script('verify-url-exist', plugin_dir_url(__DIR__).'custom-helpers/url-env-cache-control-reverse-proxy-helper/js/verify-url-exist.js');
        wp_localize_script('verify-url-exist', 'verifyUrlExistJS', array( ));      
    }
    public function remove_some_x_headers($headers)
    {

        unset($headers['X-hacker']);

        $headers = UrlCacheControl::update_header_sent_wo_phpsessid();

        // unset($headers['Set-Cookie']); // Another alternative for php session id issue on cache invalidation. Removes the header set-cookie

        return $headers;
    }
}//end class

new NabshowCacheControl();
