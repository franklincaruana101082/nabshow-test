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
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
require_once WPMU_PLUGIN_DIR . '/misc.php';
class UrlCacheControl {

	private static function UrlOrigin( $s, $use_forwarded_host = false ) {
		$ssl      = ( ! empty( $s['HTTPS'] ) === true && $s['HTTPS'] === 'on' );
		$sp       = strtolower( $s['SERVER_PROTOCOL'] );
		$protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
		$port     = $s['SERVER_PORT'];
		$port     = ( ( ! $ssl && $port === '80' ) === true || ( $ssl && $port === '443' ) === true ) ? '' : ':' . $port;
		$host     = ( $use_forwarded_host === true && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) === true ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) === true ? $s['HTTP_HOST'] : null );
		$host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
		return $protocol . '://' . $host;
	}

	public static function FullUrl( $uri, $use_forwarded_host = false, $directUrlCheck = false ) {
		$s = $_SERVER;

		$hasNoProtocol = false;
		$isReachable   = true;
		$code          = 100;
		$url_tested    = $uri;
		if ( $directUrlCheck === true ) {
			if ( ! wp_http_validate_url( $url_tested ) === true ) {
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
		if ( ! preg_match( '/^(https?\:\/\/)/', $uri, $uri_matches ) === true ) {
			$url_origin       = self::UrlOrigin( $s, $use_forwarded_host );
			$removeAllSlashes = preg_replace( '/^(?!https?\.:)\/+(-\.)?/', $url_origin, $uri );
			$url_tested       = $url_origin . $removeAllSlashes;
			$hasNoProtocol    = true;
		}
		if ( ! wp_http_validate_url( $url_tested ) === true ) {
			if ( $hasNoProtocol === true ) {
				if ( $use_forwarded_host === true ) {
					$url_tested = self::UrlOrigin( $s, ! ( $use_forwarded_host ) ) . $url_tested;
				}
			}
			$isReachable = false;
			$code        = 0;
		}
		if ( ! $isReachable === true ) {
			$code        = 200;
			$isReachable = true;
			if ( ! wp_http_validate_url( $url_tested ) === true ) {
				$url_tested  = preg_replace( '/^(?!https?\.:)\/+(-\.)?/', 'http://', $uri );
				$isReachable = false;
				$code        = 0;
			}
		}
		if ( ! $isReachable === true ) {
			$code        = 200;
			$isReachable = true;
			if ( ! wp_http_validate_url( $url_tested ) === true ) {
				$url_tested  = preg_replace( '/^(?!http\.:)\/+(-\.)?/', 'https://', $uri );
				$isReachable = false;
				$code        = 0;
			}
		}
		if ( ! $isReachable === true ) {
			$code        = 200;
			$isReachable = true;
			if ( ! wp_http_validate_url( $url_tested ) === true ) {
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

	public static function AppendTimeToUrl( $uri, $index = 0 ) {
		$tmc = 'aptC-' . time() . '-' . $index . '-' . wp_rand( 0, 1000 );

		return "{$uri}?tmc={$tmc}";
	}

	public static function IsReachable( $uri, $index = 0, $use_forwarded_host = false, $directUrlCheck = true ) {
		$urlwtmc   = self::AppendTimeToUrl( $uri, $index );
		$urlverify = self::FullUrl( $urlwtmc, $use_forwarded_host, $directUrlCheck );

		if ( $urlverify['isReachable'] === true && in_array( $urlverify['code'], [ 0, 200, 302 ] ) === true ) {
			return true;
		}

		return false;
	}

	public static function LoadReachableWPEnqueueStyles( $url_array = [] ) {
		$i = 0;
		foreach ( $url_array as $key => $url ) {
			if ( self::IsReachable( $url[0], $i ) === true ) {
				if ( isset( $url[1] ) === true && isset( $url[2] ) === true ) {
					wp_enqueue_style( $key, self::AppendTimeToUrl( $url[0], $i++ ), $url[1], $url[2] );
				} else {
					wp_enqueue_style( $key, self::AppendTimeToUrl( $url[0], $i++ ) );
				}
			} else {
				self::remove_cache_headers_for_404();
			}
		}
	}

	public static function LoadReachableWPEnqueueScripts( $url_array = [] ) {
		$i = 0;
		foreach ( $url_array as $key => $url ) {
			if ( self::IsReachable( $url[0], $i ) === true ) {
				if ( isset( $url[1] ) === true && isset( $url[2] ) === true && isset( $url[3] ) === true ) {
					wp_enqueue_script( $key, self::AppendTimeToUrl( $url[0], $i++ ), $url[1], $url[2], $url[3] );
				} else {
					wp_enqueue_script( $key, self::AppendTimeToUrl( $url[0], $i++ ) );
				}
			} else {
				self::remove_cache_headers_for_404();
			}
		}
	}

	function wp_add_header_max_age( $mins = 5 ) {
		// Set the max age 5 minutes.
		header( 'Cache-Control: public max-age=' . ( $mins * MINUTE_IN_SECONDS ) );
	}
	function wp_add_header_no_cache() {
		header( 'Cache-Control: no-cache, must-revalidate, max-age=0' );
	}

	public static function remove_cache_headers_for_404() {
		// Cleaner permalink options
		add_filter( 'got_url_rewrite', '__return_true' );
		nocache_headers();
	}

	public static function RetreiveSetCurrentUser() {
		$user = wp_get_current_user();
		if ( empty( $user->ID ) === true ) {
			$ajsUserId = sanitize_key( $_COOKIE['ajs_user_id'] );
			if ( isset( $ajsUserId ) === true ) {
				$user_id = ( is_numeric( $ajsUserId ) === true ? (int) $ajsUserId : 0 );
				$user    = get_user_by( 'id', $user_id );

				wp_set_current_user( $user->ID );
			}
		}

		return ( isset( $user ) ? $user : null );
	}
}


?>