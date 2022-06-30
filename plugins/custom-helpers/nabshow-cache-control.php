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

require WP_PLUGIN_DIR.'/custom-helpers/url-env-cache-control-helper/class-url-cache-control.php';

use Plugins\CustomHelpers\UrlEnvCacheControlHelper\UrlCacheControl;

class NabshowCacheControl
{


    public function __construct()
    {
        $this->init_enqueue_scripts();        

    }//end __construct()


    public function init_enqueue_scripts()
    {        
        add_filter('wp_headers', [ $this, 'set_nabshow_frame_options_header'], 999);
        add_action( 'wp_enqueue_scripts', array( $this, 'set_clearing_session_js' ) );
        add_filter('set_clearing_session_js', [ $this, 'set_nabshow_frame_options_header'], 999);

    }//end init_enqueue_scripts()


    public function set_clearing_session_js( ){
        global $post;
            
            $current_page   = '';
            $search_terms   = '';
            $content_type   = '';
            $is_pageview    = true;

            if ( is_search() ) {            
                $current_page   = 'search';
                $search_terms   = get_search_query();
                $content_type   = filter_input( INPUT_GET, 'v', FILTER_SANITIZE_STRING );
                $content_type   = isset( $content_type ) ? $content_type : '';
            }
            
            if ( is_admin() || ! isset( $post->ID ) || empty( $post->ID ) || is_post_type_archive() || is_tax() || is_search() ) {
                $is_pageview = false;
            }

            if ( $is_pageview ) {
                                                
                if ( isset( $post->ID ) && ! empty( $post->ID ) ) {
                    
                    if ( is_front_page() ) {
                        $current_page = 'home';
                    } else {
                        $current_page = 'other';
                    }                
                }
            }

        wp_enqueue_script( 'invalidate-sessions-js', plugin_dir_url( __DIR__ ) . 'custom-helpers/url-env-cache-control-helper/invalidate-sessions.js' );
        wp_localize_script( 'invalidate-sessions-js', 'invalidate_sessions', array(
            'ajaxurl'       => admin_url('admin-ajax.php'),
            'nabNonce'      => wp_create_nonce('nab-ajax-nonce'),
            'postID'        => (!empty($post->ID) ? $post->ID : 0),
            'page'          => $current_page,
            'search_term'   => $search_terms,
            'is_pageview'   => $is_pageview,
            'content_type'  => $content_type,
        ));


        UrlCacheControl::invalidate_sessions();
    }

    public function set_nabshow_frame_options_header( $headers )
    {
        
        remove_action('wp_head', 'wp_generator');

        UrlCacheControl::remove_session_from_curl($headers);        
        UrlCacheControl::wp_add_header_pragma_cache(86400,$headers);
        UrlCacheControl::set_cache_headers_with_etags(null);

        $headers['X-hacker'] = 'modified by Frank';
        $headers['X-Powered-By'] = 'Crush & Lovely <https://crushlovely.com>';
        
        add_action('send_headers', 'send_frame_options_header', 10, 0);

        return $headers;

    }//end set_nabshow_frame_options_header()
}//end class

new NabshowCacheControl();
