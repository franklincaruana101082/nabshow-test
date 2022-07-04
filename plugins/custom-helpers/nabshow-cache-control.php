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

require_once( WPMU_PLUGIN_DIR . '/misc.php' );

// Load the VIP Vary_Cache class
require_once( WPMU_PLUGIN_DIR . '/cache/class-vary-cache.php' );

require_once( WP_PLUGIN_DIR . '/custom-helpers/url-env-cache-control-reverse-proxy-helper/vary-cache/config-vary-cache.php' );
require_once( WP_PLUGIN_DIR . '/custom-helpers/url-env-cache-control-reverse-proxy-helper/reverse-proxy/config-reverse-proxy.php' );

require_once( WP_PLUGIN_DIR . '/custom-helpers/url-env-cache-control-reverse-proxy-helper/class-url-cache-control.php' );

use Plugins\CustomHelpers\UrlEnvCacheControlReverseProxyHelper\UrlCacheControl;
use Automattic\VIP\Cache\Vary_Cache;
class NabshowCacheControl
{


    public function __construct()
    {
        Vary_Cache::register_group('nabshow');   
        $this->init_enqueue_scripts();     

    }//end __construct()


    public function init_enqueue_scripts()
    {        
        add_action('wp_headers', [ $this, 'nabshow_send_headers'], 999); 
        add_action('init', [ $this, 'set_vary_cache_init' ]);    
        add_action('init', [ $this, 'prevent_broken_link_load' ]);
        add_action('init', [ $this, 'set_extra_js_scripts' ]);   
    }//end init_enqueue_scripts()

    public function set_vary_cache_init()
    {

        $is_user_in_nabshow = Vary_Cache::is_user_in_group_segment('nabshow', 'yes');
        if (!$is_user_in_nabshow ) {
            Vary_Cache::set_group_for_user('nabshow', 'yes');

            // Redirect back to the same page (per the POST-REDIRECT-GET pattern).
            // Please note the use of the `vip_vary_cache_did_send_headers` action.
            add_action(
                'vip_vary_cache_did_send_headers', function () {
                    wp_safe_redirect(add_query_arg(''));
                    exit;
                } 
            );
        }
    }

    public function prevent_broken_link_load( )
    {
        ob_start();
        add_action(
            'shutdown', function () {
                if (is_admin() ) {
                    return;
                }
                $final = '';
                $levels = ob_get_level();
                for ($i = 0; $i < $levels; $i++){
                    $final .= ob_get_clean();
                }
                echo apply_filters('final_output', $final);
            }, 0
        );

        add_filter(
            'final_output', function ($output) {  
                if (is_admin() ) {
                    return;
                }       
                $after_body = apply_filters('after_body', '');
                $output = preg_replace("/(\<body.*\>)/", "$1".$after_body, $output);
                return $output;
            }
        );

        add_filter(
            'after_body', function ($after_body) {
                $after_body.='<div class="content"></div>';
                return $after_body;
            }
        );
    }

    public function nabshow_send_headers($headers)
    {        
        send_origin_headers();
        UrlCacheControl::remove_session_from_curl();
        UrlCacheControl::wp_add_cache_param();        
        send_nosniff_header();
        nocache_headers();
        status_header(200);

        return $headers;
    }
    public function set_extra_js_scripts()
    {
        wp_enqueue_script('verify-url-exist', plugin_dir_url(__DIR__).'custom-helpers/url-env-cache-control-reverse-proxy-helper/js/verify-url-exist.js');
        wp_localize_script('verify-url-exist', 'verifyUrlExistJS', array( ));        
    }
}//end class

new NabshowCacheControl();
