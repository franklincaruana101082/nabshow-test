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
        add_action( 'template_redirect', [$this, 'set_etag_last_modified']);
    }//end init_enqueue_scripts()

    public function nabshow_send_headers()
    {        
        send_nosniff_header(); // prevent client from sniffing asset files and other resources

        if(!is_user_logged_in()){ UrlCacheControl::wp_add_cache_param(); // handle caching strategy
        }
    }
    public function remove_phpsessid_from_cookie_headers($headers)
    {
        send_origin_headers();

        $sendheaders = UrlCacheControl::get_HTTP_request_headers(); // Retrieve existing http request headers

        $headers = UrlCacheControl::update_header_sent_wo_phpsessid($sendheaders); // removing PHPSESSID from set-cookie header

        foreach ($headers as $key => $value) {
            $stripslashes_value = stripslashes($value); 
            // $set_cookie = $headers['Cookie'];
            error_log("$key => $stripslashes_value");
            if($key === "Cookie") {
                
                $stripslashes_value = preg_replace('/PHPSESSID=[0-9a-zA-Z0-9]*\;/', '', $stripslashes_value); // Remove PHPSESSID value from header set-cookie
                
                error_log($stripslashes_value);
                break;
            }
        }

        return $headers;
    }   

    // setting custom etag & last-modified headers
    public function set_etag_last_modified() {

        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

        if ( ! isset( $_GET['send_test_etag'] ) ) {
            return;
        }
        $etag = sanitize_key( wp_unslash( $_GET['send_test_etag'] ) );
        header( "ETag: $etag" );

        // Handle responses that are cached by the browser.
        if ( isset( $_SERVER['HTTP_IF_NONE_MATCH'] ) && $_SERVER['HTTP_IF_NONE_MATCH'] === $etag ) {
            status_header( 304 );
            return '';
        }

        printf( "<p>This PHP response includes a call to <code>header( 'ETag: %1\$s' )</code> and it should be sent to the browser; you should be able to make an HTTP request with a <code>If-None-Match:%1\$s</code> request header:</p>", esc_html( $etag ) );

        printf( '<p><code>curl -i -H "If-None-Match: %s" https://%s%s</code></p>', esc_html( $etag ), esc_html( $_SERVER['HTTP_HOST'] ), esc_html( wp_unslash( $_SERVER['REQUEST_URI'] ) ) );

        echo "<p>And the server should return with a <code>304 Not Modified</code> response.</p>\n";

        echo "<p>Seen HTTP request headers:</p>\n\n";

        echo "<dl>\n";
        foreach ( $_SERVER as $key => $value ) {
            if ( ! preg_match( '/^HTTP_/', $key ) ) {
                continue;
            }
            $header = substr( $key, 5 );
            $header = str_replace( '_', '-', $header );
            $header = strtolower( $header );
            $value  = wp_unslash( $value );
            printf( "<dt><strong><code>%s</code></strong></dt>\n", esc_html( $header ) );
            printf( "<dd><code>%s</code></dd>\n", esc_html( $value ) );
        }
        echo "</dl>\n";

        exit;
    }

}//end class

new NabshowCacheControl();
