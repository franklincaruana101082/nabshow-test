<?php
namespace Plugins\CustomHelpers\UrlEnvCacheControlReverseProxyHelper;

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

class UrlCacheControl
{
    private static function UrlOrigin($s, $useFhost=false)
    {
        $ssl = ( ! empty($s['HTTPS']) && $s['HTTPS'] === 'on' );
        $sp = strtolower($s['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')) . ( ( $ssl ) ? 's' : '');
        $port = $s['SERVER_PORT'];
        $criport = (! $ssl && $port==='80') || ($ssl && $port==='443');
        $port = $criport ? '' : ':'.$port;
        $crihostA = isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null;
        $crihostB = isset($s['HTTP_X_FORWARDED_HOST']);
        $host = ($useFhost && $crihostB) ? $s['HTTP_X_FORWARDED_HOST']:$crihostA;
        $host         = isset($host) ? $host : $s['SERVER_NAME'] . $port;
        return $protocol . '://' . $host;
    }    
    public static function FullUrl($uri, $useFhost=false, $directUC=false)
    {
        $s = $_SERVER;

        $hasNoProtocol = false;
        $isReachable   = true;
        $code          = 100;
        $url_tested    = $uri;
        if($directUC) {
            if(!wp_http_validate_url($url_tested)) {
                $isReachable = false;
            }
            return [
            'url'           => $uri,
            'url_tested'    => $url_tested,
            'code'          => (int) $code,
            'isReachable'   => (int) $isReachable,
            'hasNoProtocol' => (int) $hasNoProtocol,
            ];
        }
        if(! preg_match('/^(https?\:\/\/)/', $uri, $uri_matches) ) {
            $url_origin = self::UrlOrigin($s, $useFhost);
            $removeAllSlashes = preg_replace('/^(?!https?\.:)\/+(-\.)?/', $url_origin, $uri);
            $url_tested = $url_origin . $removeAllSlashes;
            $hasNoProtocol = true;
        }
        if(! wp_http_validate_url($url_tested)) {
            if($hasNoProtocol) {
                if($useFhost) {
                    $url_tested = self::UrlOrigin($s, !($useFhost)).$url_tested;
                }
            }
            $isReachable = false;
            $code        = 0;
        }
        if (! $isReachable ) {
            $code        = 200;
            $isReachable = true;
            if (! wp_http_validate_url($url_tested) ) {
                $url_tested  = preg_replace('/^(?!https?\.:)\/+(-\.)?/', 'http://', $uri);
                $isReachable = false;
                $code        = 0;
            }
        }
        if (! $isReachable ) {
            $code        = 200;
            $isReachable = true;
            if (! wp_http_validate_url($url_tested) ) {
                $url_tested  = preg_replace('/^(?!http\.:)\/+(-\.)?/', 'https://', $uri);
                $isReachable = false;
                $code        = 0;
            }
        }
        if (! $isReachable ) {
            $code        = 200;
            $isReachable = true;
            if (! wp_http_validate_url($url_tested) ) {
                $url_tested  = $uri;
                $isReachable = false;
                $code        = 0;
            }
        }

        return [
        'url'           => $uri,
        'url_tested'    => $url_tested,
        'code'          => (int) $code,
        'isReachable'   => (int) $isReachable,
        'hasNoProtocol' => (int) $hasNoProtocol,
        ];
    }

    public static function appendTimeToUrl( $uri, $index = 0 )
    {
        $tmc = 'aptC-' . time() . '-' . $index . '-' . wp_rand(0, 1000);

        return "{$uri}?tmc={$tmc}";
    }

    public static function isReachable($uri, $index=0, $useFhost=false, $directUC=true)
    {
        $urlwtmc   = self::AppendTimeToUrl($uri, $index);
        $urlverify = self::FullUrl($urlwtmc, $useFhost, $directUC);

        $isItInArr = in_array($urlverify['code'], [0,200,302]);

        if($urlverify['isReachable'] && $isItInArr) { return true;
        }

        
        return false;
    }

    public static function wp_add_cache_param($maxage=86400)
    {   
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header("Access-Control-Allow-Origin: *");
        header("Cross-Origin-Resource-Policy: cross-origin");
        header("Content-Security-Policy: base-uri https://nabshow.vipdev.lndo.site/");

        // Set the max age 5 minutes.
        // $maxage = ($mins * MINUTE_IN_SECONDS);
        // header('Cache-Control: public, max-age='.$maxage.', s-maxage='.$maxage.', immutable', true); // immutable cache-control to speed up web (Facebook is using this cache strategy)
        header('Cache-Control: max-age=1, stale-while-revalidate=59', true); // immutable cache-control to speed up web (Facebook is using this cache strategy)
        header('Pragma: public'); // For Legacy Browsers
        header("Expires: " . gmdate("D, d M Y H:i:s", time() + 5) . " GMT"); // expires for Pragma and max-age for cache-control                
        header('Vary: Accept-Encoding'); // stating importance of caching
        // header('X-Frame-Options: SAMEORIGIN'); // for security reason. 
    }

    
    // setting custom etag & last-modified headers
    public function set_etag_last_modified()
    {

        

        if (!empty($_GET['send_test_etag']) ) {
            $etag = sanitize_key(wp_unslash($_GET['send_test_etag']));
        }else{
            // Get last modification time of the current PHP file
            $file_last_mod_time = filemtime(__FILE__);

            // Get last modification time of the main content (that user sees)
            // Hardcoded just as an example
            $content_last_mod_time = 1520949851;

            // Combine both to generate a unique ETag for a unique content
            // Specification says ETag should be specified within double quotes
            $etag = '"' . $file_last_mod_time . '.' . $content_last_mod_time . '"';
        }
        
        header("ETag: $etag");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        
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
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        exit;
    }

    public static function register_nabshow_session()
    {
        if (session_status() == PHP_SESSION_NONE) {
            // session_start(['use_only_cookies' => 1]);
            session_start();
        }
    }

    public static function get_HTTP_request_headers()
    {
        $HTTP_headers = array();
        foreach($_SERVER as $key => $value) {
            if (substr($key, 0, 5) <> 'HTTP_') {
                continue;
            }
            $single_header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
            $HTTP_headers[$single_header] = $value;
        }
        return $HTTP_headers;
    }
}

