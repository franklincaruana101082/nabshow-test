<?php

class UrlVerifier
{
    private static function UrlOrigin( $s, $use_forwarded_host = false )
    {
        $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] === 'on' );
        $sp       = strtolower( $s['SERVER_PROTOCOL'] );
        $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
        $port     = $s['SERVER_PORT'];
        $port     = ( ( ! $ssl && $port==='80' ) || ( $ssl && $port==='443' ) ) ? '' : ':'.$port;
        $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
        $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
        return $protocol . '://' . $host;
    }

    public static function FullUrl( $uri, $use_forwarded_host = false, $directUrlCheck = false )
    {
        $s = $_SERVER;
        
        $hasNoProtocol = false;
        $isReachable = true;
        $code = 100;
        $url_tested = $uri;
        if($directUrlCheck)
        {
            if (!wp_http_validate_url($url_tested)){
                $isReachable = false;
            }     
            return [ 
                'url' => $uri, 
                'url_tested' => $url_tested, 
                'code' => (int)$code,
                'isReachable' => (int)$isReachable,
                'hasNoProtocol' => (int)$hasNoProtocol
            ];
        }
        if(!preg_match('/^(https?\:\/\/)/', $uri, $uri_matches)){       
            $url_origin = self::UrlOrigin( $s, $use_forwarded_host );
            $removeAllSlashes = preg_replace('/^(?!https?\.:)\/+(-\.)?/',$url_origin,$uri);
            $url_tested = $url_origin . $removeAllSlashes;
            $hasNoProtocol = true;
        }
        if (!wp_http_validate_url($url_tested))
        {
            if($hasNoProtocol){
                if($use_forwarded_host){
                    $url_tested = self::UrlOrigin( $s, !($use_forwarded_host) ) . $url_tested;
                }
            }        
            $isReachable = false;
            $code = 0;  
        }
        if(!$isReachable){
            $code = 200;    
            $isReachable = true;  
            if (!wp_http_validate_url($url_tested)){
                $url_tested = preg_replace('/^(?!https?\.:)\/+(-\.)?/','http://',$uri);       
                $isReachable = false;  
                $code = 0;       
            }            
        }
        if(!$isReachable){
            $code = 200;  
            $isReachable = true; 
            if (!wp_http_validate_url($url_tested)){
                $url_tested = preg_replace('/^(?!http\.:)\/+(-\.)?/','https://',$uri);
                $isReachable = false;                 
                $code = 0;  
            }         
        }
        if(!$isReachable){
            $code = 200;    
            $isReachable = true;  
            if (!wp_http_validate_url($url_tested)){
                $url_tested = $uri;
                $isReachable = false;
                $code = 0;  
            }
        }        

        return [ 
            'url' => $uri, 
            'url_tested' => $url_tested, 
            'code' => (int)$code,
            'isReachable' => (int)$isReachable,
            'hasNoProtocol' => (int)$hasNoProtocol
        ];
    }
    
    public static function AppendTimeToUrl( $uri, $index = 0 ){

        $tmc = "aptC-".time()."-".$index."-".wp_rand(0,1000);

        return "{$uri}?tmc={$tmc}";
    }
    
    public static function IsReachable( $uri, $index = 0, $use_forwarded_host = false, $directUrlCheck = true ){
        $urlwtmc = self::AppendTimeToUrl($uri,$index);
        $urlverify = self::FullUrl($urlwtmc,$use_forwarded_host,$directUrlCheck);
        do_action('qm/debug',$urlverify);
        if($urlverify['isReachable'] && in_array($urlverify['code'],[0,200,302])) return true;

        return false;
    }
    
    public static function LoadReachableWPEnqueueStyles( $url_array = [] ){
        $i = 0;
        foreach($url_array as $key => $url){
            if(UrlVerifier::IsReachable($url[0], $i)){
                if(!empty($url[1]) && !empty($url[2]))
                    wp_enqueue_style( $key, UrlVerifier::AppendTimeToUrl($url[0],$i++), $url[1], $url[2]);
                else
                    wp_enqueue_style( $key, UrlVerifier::AppendTimeToUrl($url[0],$i++) );
            }
        }
    }
    
    public static function LoadReachableWPEnqueueScripts( $url_array = [] ){
        $i = 0;
        foreach($url_array as $key => $url){
            if(UrlVerifier::IsReachable($url[0], $i)){
                if(!empty($url[1]) && !empty($url[2]) && !empty($url[3]))
                    wp_enqueue_script( $key, UrlVerifier::AppendTimeToUrl($url[0],$i++), $url[1], $url[2], $url[3]);
                else
                    wp_enqueue_script( $key, UrlVerifier::AppendTimeToUrl($url[0],$i++) );
            }
        }
    }
}
