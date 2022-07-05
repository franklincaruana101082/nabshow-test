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

    public static function wp_add_cache_param($mins=5)
    {   
        // Set the max age 5 minutes.
        $maxage = ($mins * MINUTE_IN_SECONDS);
        header('Cache-Control: public, max-age='.$maxage.', s-maxage='.$maxage.', immutable', true); // immutable cache-control to speed up web (Facebook is using this cache strategy)
        header('Pragma: public'); // For Legacy Browsers
        header("Expires: " . gmdate("D, d M Y H:i:s", time() + 5) . " GMT"); // expires for Pragma and max-age for cache-control
        header('Vary: Accept-Encoding'); // stating importance of caching
        header('X-Frame-Options: SAMEORIGIN'); // for security reason. 
    }

    public static function update_header_sent_wo_phpsessid($headers, $remove_cookie_header = false)
    {   
        $set_cookie = null;
        
        foreach ($headers as $key => $value) {
            $stripslashes_value = $value;

            if(!empty($value) && !is_array($value)) { $stripslashes_value = "" . stripslashes($value);
            }
            if($key === "Cookie") { $set_cookie = preg_replace('/PHPSESSID=[0-9a-zA-Z0-9]*\;/', '', $stripslashes_value); // Remove PHPSESSID value from header set-cookie                
            }
        }

        if($remove_cookie_header) { unset($headers['Cookie']);
        }else{
            if(!empty($set_cookie)) { $headers['Cookie'] = stripslashes(json_encode($set_cookie));
            }
            else{ header("Set-Cookie: PHP Session Id (PHPSESSID) is not included here for preventing sudden cache invalidation");
            }
        }
        
        unset(
            $headers['X-hacker'],
            $headers['X-Forwarded-For'],
            $headers['X-Country-Code'],
            $headers['X-Forwarded-Port'],
            $headers['X-Original-Forwarded-For'],
            $headers['X-Mobile-Class'],
            $headers['X-Query-Args'],
            $headers['X-Real-Ip'],
            $headers['Sec-Ch-Ua-Mobile'],
            $headers['Sec-Ch-Ua-Platform'],
            $headers['Sec-Ch-Ua'],
            $headers['X-Powered-by']
        );
        
        return $headers;
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

