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

// Load the VIP Vary_Cache class
require_once WPMU_PLUGIN_DIR.'/cache/class-vary-cache.php';

require WP_PLUGIN_DIR.'/custom-helpers/url-env-cache-control-helper/class-url-cache-control.php';

require_once WPMU_PLUGIN_DIR.'/misc.php';

use Automattic\VIP\Cache\Vary_Cache;
use Plugins\CustomHelpers\UrlCacheControl\UrlCacheControl;

class NabshowCacheControl extends Vary_Cache
{


    public function __construct()
    {
        // Register the `nabshow` group
        self::register_group('nabshow');
        $this->init_enqueue_scripts();        

    }//end __construct()


    public function init_enqueue_scripts()
    {        
        add_filter( 'wp_headers', [ $this, 'set_nabshow_frame_options_header'], 999 );

        add_action('init', [ $this, 'nabshow_init_func' ]);

        add_action('wp_logout', [ $this, 'nabshow_logout_user_func' ]);
        add_action('wp_login', [ $this, 'nabshow_login_user_func' ]);
        
        add_action('the_content', [ $this, 'nabshow_the_content_func' ]);
        add_action('wp_footer', [ $this, 'nabshow_wp_footer_func' ]);
    }//end init_enqueue_scripts()


    public function nabshow_wp_footer_func($user)
    {
        $is_user_in_nabshow = self::is_user_in_group_segment('nabshow', 'yes');
        if ($is_user_in_nabshow) {
        }

    }//end nabshow_wp_footer_func()


    public function nabshow_the_content_func($content)
    {
        $is_user_in_nabshow = self::is_user_in_group_segment('nabshow', 'yes');
        if ($is_user_in_nabshow) {
        }

        return $content;

    }//end nabshow_the_content_func()


    public function nabshow_login_user_func($user)
    {
        $is_user_in_nabshow = self::is_user_in_group_segment('nabshow', 'yes');
        if ($is_user_in_nabshow) {
        }

    }//end nabshow_login_user_func()


    public function nabshow_logout_user_func($user)
    {
        $is_user_in_nabshow = self::is_user_in_group_segment('nabshow', 'yes');
        if ($is_user_in_nabshow) {
        }

    }//end nabshow_logout_user_func()


    public function nabshow_init_func()
    {            
        // phpcs:ignore WordPress.Security.NonceVerification.Missing
        $is_user_in_nabshow = self::is_user_in_group_segment('nabshow', 'yes');
        if (empty($is_user_in_nabshow)) {

            self::set_group_for_user('nabshow', 'yes');
        }

    }//end set_nabshow_frame_options_header()

    public function set_nabshow_frame_options_header( $headers ) {
        
        remove_action( 'wp_head', 'wp_generator' );

        $headers['X-hacker'] = 'modified by Frank';
        $headers['X-Powered-By'] = 'Crush & Lovely <https://crushlovely.com>';
        
        UrlCacheControl::wp_add_header_pragma_revalidate_cache();
        UrlCacheControl::set_cache_headers_with_etags(null);
        
        add_action( 'send_headers', 'send_frame_options_header', 10, 0 );

        return $headers;

    }//end set_nabshow_frame_options_header()
}//end class

new NabshowCacheControl();
