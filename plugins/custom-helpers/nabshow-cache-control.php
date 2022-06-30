<?php
namespace Plugins\CustomHelpers;
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
if (! defined('ABSPATH')) {
    exit;
    // Exit if accessed directly.
}


require WP_PLUGIN_DIR.'/custom-helpers/url-env-cache-control-helper/class-url-cache-control.php';

require_once WPMU_PLUGIN_DIR.'/misc.php';

use Plugins\CustomHelpers\UrlCacheControl;

class NabshowCacheControl
{


    public function __construct()
    {
        $this->init_enqueue_scripts();        

    }//end __construct()


    public function init_enqueue_scripts()
    {        
        add_filter( 'wp_headers', [ $this, 'set_nabshow_frame_options_header'], 999 );

    }//end init_enqueue_scripts()


    public function set_nabshow_frame_options_header( $headers ) {
        
        remove_action( 'wp_head', 'wp_generator' );

        $headers['X-hacker'] = 'modified by Frank';
        $headers['X-Powered-By'] = 'Crush & Lovely <https://crushlovely.com>';
        
        UrlCacheControl::wp_add_header_pragma_cache(86400);
        UrlCacheControl::set_cache_headers_with_etags(null);
        
        add_action( 'send_headers', 'send_frame_options_header', 10, 0 );

        return $headers;

    }//end set_nabshow_frame_options_header()
}//end class

new NabshowCacheControl();
