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

    public static function wp_add_cache_param($headers,$maxage=631138519,$mins=360)
    {   
        $headers["Access-Control-Allow-Headers"] = "Origin, X-Requested-With, Content-Type, Accept";
        $headers["Access-Control-Allow-Origin"] = "*";
        $headers["Cross-Origin-Resource-Policy"] = "cross-origin";
        // $headers['Content-Security-Policy'] = "default-src 'self'"; // CSP only works in modern browsers Chrome 25+, Firefox 23+, Safari 7+

        // Set the max age 5 minutes.
        $smaxage = ($mins * MINUTE_IN_SECONDS);
        if(!is_user_logged_in()){ 
            // $headers["Cache-Control"] = "max-age=1, stale-while-revalidate=59"; // maintain the freshness of data
            header('Cache-Control: public, max-age='.$smaxage.', s-maxage='.$smaxage.', immutable', true); // immutable cache-control to speed up web (Facebook is using this cache strategy)
        }
        // else{ 
            // header('Cache-Control: public, max-age='.$smaxage.', s-maxage='.$smaxage.', immutable', true); // immutable cache-control to speed up web (Facebook is using this cache strategy)
        // }
        $headers["Pragma"] = "public"; // For Legacy Browsers
        $headers["Expires"] = gmdate("D, d M Y H:i:s", time() + 5) . " GMT"; // expires for Pragma and max-age for cache-control                
        $headers["Vary"] = "Accept-Encoding"; // stating importance of caching        

        // $headers["X-Frame-Options"] = "SAMEORIGIN";
        // $headers['X-XSS-Protection'] = '1; mode=block';
        // $headers['X-Content-Type-Options'] = 'nosniff';

        $headers['Strict-Transport-Security'] = "max-age=$maxage; includeSubDomains";

        return $headers;           
    }
    
    // setting custom etag & last-modified headers
    public static function set_etag_last_modified($headers)
    {        
        $file = (__FILE__);
        // Get last modification time of the current PHP file
        $last_modified_time = filemtime($file);
        $etag = md5_file($file); 
        
        $headers["Last-Modified"] = gmdate("D, d M Y H:i:s", $last_modified_time)." GMT"; 
        $headers["Etag"] = $etag; 

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

        return $headers;
        
    }
    
    public static function remove_phpsessid_from_cookie_headers($headers, $retain_others = false)
    {          
        $message = "PHP Session Id (PHPSESSID) is not included here to prevent sudden cache invalidation";
        $request_http = self::get_HTTP_request_headers();
        if($retain_others){
            $set_cookie = $request_http['Cookie'];
            
            $cookie = preg_replace('/(PHPSESSID=[0-9a-zA-Z0-9]*\;)/', '', $set_cookie); // Remove PHPSESSID value from header set-cookie       
            error_log($set_cookie);
            header("Set-Cookie: $cookie");
            unset( $headers['Cookie'] );
        }


        return $headers;
    }   

    public static function sel_remove_headers($headers)
    {
        unset(
            $headers['X-hacker'],
            $headers['x-powered-by'],
            $headers['X-Country-Code'],
            $headers['X-Mobile-Class'],
            $headers['X-Query-Args'],
            $headers['X-Robots-Tag'],
            $headers['Sec-Fetch-User'],
            $headers['Sec-Ch-Ua-Mobile'],
            $headers['Sec-Ch-Ua-Platform'],
            $headers['Sec-Fetch-Dest'],
            $headers['Sec-Fetch-Mode'],
            $headers['Sec-Ch-Ua'],
            $headers['Sec-Fetch-Site']
        );

        return $headers;
    }

    public static function register_nabshow_session()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start(['use_only_cookies' => 1]);
        }
    }

    public static function get_HTTP_headers(){
        $HTTP_headers = array();
        foreach($_SERVER as $key => $value) {
            $HTTP_headers[$key] = $value;
            
        }
        

        return $HTTP_headers;
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
            error_log("$key => $value");
        }
        return $HTTP_headers;
    }
}

