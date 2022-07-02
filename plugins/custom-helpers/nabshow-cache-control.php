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

if (! defined('ABSPATH')) {
    exit;
    // Exit if accessed directly.
}

// Load the VIP Vary_Cache class
require_once( WPMU_PLUGIN_DIR . '/cache/class-vary-cache.php' );

require WP_PLUGIN_DIR.'/custom-helpers/url-env-cache-control-helper/class-url-cache-control.php';

require WP_PLUGIN_DIR.'/custom-helpers/url-env-cache-control-helper/reverse-proxy/config-reverse-proxy.php';

use Plugins\CustomHelpers\UrlEnvCacheControlHelper\UrlCacheControl;
use Automattic\VIP\Cache\Vary_Cache;
class NabshowCacheControl extends Vary_Cache
{


    public function __construct()
    {
        $this->init_enqueue_scripts();     
        self::register_group( 'nabshow' );   

    }//end __construct()


    public function init_enqueue_scripts()
    {        
        add_filter('wp_headers', [ $this, 'set_cache_headers_for_404']);
        add_action( 'init', [ $this, 'set_vary_cache_init' ] );
        add_action( 'init', [ $this, 'set_nabshow_options_header' ], 999 );
        add_filter('wp_headers', [ $this, 'prevent_broken_link_load'], 999);
        add_filter('wp_headers', [ $this, 'set_verify_url_exist_js'], 999);
    }//end init_enqueue_scripts()

    public function set_vary_cache_init() {
        $is_user_in_nabshow = Vary_Cache::is_user_in_group_segment( 'nabshow', 'yes' );
        if ( !$is_user_in_nabshow ) {
            self::set_group_for_user( 'nabshow', 'yes' );

            // Redirect back to the same page (per the POST-REDIRECT-GET pattern).
            // Please note the use of the `vip_vary_cache_did_send_headers` action.
            add_action( 'vip_vary_cache_did_send_headers', function() {
                wp_safe_redirect( add_query_arg( '' ) );
                exit;
            } );
        }
    }

	public function set_cache_headers_for_404(){
		UrlCacheControl::remove_cache_headers_for_404();
	}

	public function set_verify_url_exist_js(){
        wp_enqueue_script('verify-url-exist-js', plugin_dir_url(__DIR__).'custom-helpers/url-env-cache-control-helper/js/verify-url-exist.js');
        wp_localize_script('verify-url-exist-js', 'verifyUrlExistJS', array( ));
	}

    public function prevent_broken_link_load( ){
        ob_start();
        add_action('shutdown', function() {
            if ( is_admin() ) {
                return;
            }
            $final = '';
            $levels = ob_get_level();
            for ($i = 0; $i < $levels; $i++){
                $final .= ob_get_clean();
            }
            echo apply_filters('final_output', $final);
        }, 0);

        add_filter('final_output', function($output) {  
            if ( is_admin() ) {
                return;
            }       
            $after_body = apply_filters('after_body','');
            $output = preg_replace("/(\<body.*\>)/", "$1".$after_body, $output);
            return $output;
        });

        add_filter('after_body',function($after_body){
            $after_body.='<div class="content">My Content</div>';
            return $after_body;
        });
    }

    public function set_nabshow_options_header( $headers )
    {  
        remove_action('wp_head', 'wp_generator');
        
        UrlCacheControl::wp_add_cache_param();
        UrlCacheControl::set_cache_headers_with_etags();
        UrlCacheControl::remove_session_from_curl();        

        $headers['X-hacker'] = 'modified by Frank';
        $headers['X-Powered-By'] = 'Crush & Lovely <https://crushlovely.com>';

        return $headers;

    }//end set_nabshow_frame_options_header()
}//end class

new NabshowCacheControl();
