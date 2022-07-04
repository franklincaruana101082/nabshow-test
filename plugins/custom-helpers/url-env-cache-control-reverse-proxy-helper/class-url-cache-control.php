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

        if($urlverify['isReachable'] && $isItInArr) return true;

        
        return false;
    }

    public static function loadReachableWPEnqueueStyles($url_array = [])
    {
        $i = 0;
        foreach($url_array as $key => $url)
        {
            if(self::IsReachable($url[0], $i)) {
                if(isset($url[1]) && isset($url[2])) {
                    wp_enqueue_style($key, self::AppendTimeToUrl($url[0], $i++), $url[1], $url[2]);
                }else{
                    wp_enqueue_style($key, self::AppendTimeToUrl($url[0], $i++));
                }
            } 
        }
    }

    public static function loadReachableWPEnqueueScripts( $url_array = [] )
    {
        $i = 0;
        foreach ( $url_array as $key => $url ) {
            if (self::IsReachable($url[0], $i) ) {
                if (isset($url[1]) && isset($url[2]) && isset($url[3]) ) {
                    wp_enqueue_script($key, self::AppendTimeToUrl($url[0], $i++), $url[1], $url[2], $url[3]);
                } else {
                    wp_enqueue_script($key, self::AppendTimeToUrl($url[0], $i++));
                }
            } 
        }
    }

    public static function wp_add_header_max_age($mins=5 )
    {
        // Set the max age 5 minutes.
        header('Cache-Control: max-age='.($mins * MINUTE_IN_SECONDS));
    }
    public static function wp_add_cache_param($mins=5)
    {   
        // Set the max age 5 minutes.
        header('Cache-Control: max-age='.($mins * MINUTE_IN_SECONDS));
        header('Pragma: public');
    }

    public static function update_header_sent_wo_phpsessid()
    {       
        $set_cookie = null;
        $headers = self::get_HTTP_request_headers();
        foreach ($headers as $key => $value) {
            if(!empty($value) && !is_array($value)) {  $headers[$key] = "" . stripslashes($value);
            }
            
            if($key === "Cookie") {
                
                $set_cookie = preg_replace('/(PHPSESSID=[0-9a-zA-Z0-9]*\;)/', '', $value); // Remove PHPSESSID value from header
                break;
            }
        }

        if(!empty($set_cookie)){ $headers['Cookie'] = stripslashes(json_encode($set_cookie));
        }else{ 
            header("Set-Cookie: Hello there. PHP Session Id (PHPSESSID) is not included here for security reason. Thanks!");
        }
        return $headers;
    }
    public static function register_nabshow_session()
    {
        if (session_status() == PHP_SESSION_NONE) {
            // session_start(['use_only_cookies' => 1]);
            @session_start();
        }
    }

    public static function set_cache_headers_with_etags($mins=3600,$content_last_mod_time = 1520949851)
    {        
        // Get last modification time of the current PHP file
        $file_last_mod_time = filemtime(__FILE__);

        // Get last modification time of the main content (that user sees)
        // Hardcoded just as an example
        $content_last_mod_time = $content_last_mod_time;

        // Combine both to generate a unique ETag for a unique content
        // Specification says ETag should be specified within double quotes
        $etag = '"' . $file_last_mod_time . '.' . $content_last_mod_time . '"';

        // Set ETag header
        header('ETag: ' . $etag);

        // Check whether browser had sent a HTTP_IF_NONE_MATCH request header
        if(isset($_SERVER['HTTP_IF_NONE_MATCH'])) {
            // If HTTP_IF_NONE_MATCH is same as the generated ETag => content is the same as browser cache
            // So send a 304 Not Modified response header and exit
            if($_SERVER['HTTP_IF_NONE_MATCH'] == $etag) {
                header('HTTP/1.1 304 Not Modified', true, 304);
                exit();
            }
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

