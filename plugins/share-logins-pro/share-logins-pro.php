<?php
/*
Plugin Name: Share Logins Pro
Description: Pro features unlocker of Share Logins
Plugin URI: https://codexpert.io
Author: codexpert
Author URI: https://codexpert.io
Version: 3.0.2
Text Domain: share-logins-pro
Domain Path: /languages
*/

namespace codexpert\Share_Logins_Pro;
use codexpert\Product\License;
use codexpert\Product\Survey;
use codexpert\Product\Update;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CXSL_PRO', __FILE__ );
define( 'CXSL_PRO_DEBUG', false );

/**
 * Main class for the plugin
 * @package Plugin
 * @author Nazmul Ahsan <n.mukto@gmail.com>
 */
class Plugin {
	
	public static $_instance;
	public $slug;
	public $name;
	public $version;
	public $server;
	public $required_php = '5.6';
	public $required_wp = '4.0';

	public function __construct() {
		self::define();
		
		if( !$this->_ready() ) return;

		self::includes();
		self::hooks();
	}

	/**
	 * Define constants
	 */
	public function define(){
		if( !function_exists( 'get_plugin_data' ) ) {
		    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		$this->plugin = get_plugin_data( CXSL_PRO );

		$this->server = 'https://my.codexpert.io';

		$this->plugin['File'] = CXSL_PRO;
		$this->plugin['Server'] = $this->server;

		if ( !defined( 'CXSL_API_NAMESPACE' ) ) {
			define( 'CXSL_API_NAMESPACE', 'share-logins/v3' );
		}
	}

	/**
	 * Dependency and Version compatibility
	 */
	public function _ready() {
		$_ready = true;

		if( version_compare( get_bloginfo( 'version' ), $this->required_wp, '<' ) ) {
			add_action( 'admin_notices', function() {
				echo "
					<div class='notice notice-error'>
						<p>" . sprintf( __( '<strong>%s</strong> requires <i>WordPress version %s</i> or higher. You have <i>version %s</i> installed.', 'share-logins-pro' ), $this->name, $this->required_wp, get_bloginfo( 'version' ) ) . "</p>
					</div>
				";
			} );

			$_ready = false;
		}

		if( version_compare( PHP_VERSION, $this->required_php, '<' ) ) {
			add_action( 'admin_notices', function() {
				echo "
					<div class='notice notice-error'>
						<p>" . sprintf( __( '<strong>%s</strong> requires <i>PHP version %s</i> or higher. You have <i>version %s</i> installed.', 'share-logins-pro' ), $this->name, $this->required_php, PHP_VERSION ) . "</p>
					</div>
				";
			} );

			$_ready = false;
		}

		return $_ready;
	}

	/**
	 * Includes files
	 */
	public function includes(){
		require_once dirname( CXSL_PRO ) . '/vendor/autoload.php';
		require_once dirname( CXSL_PRO ) . '/includes/functions.php';
	}

	/**
	 * Hooks
	 */
	public function hooks(){
		// i18n
		add_action( 'plugins_loaded', array( $this, 'i18n' ) );

		/**
		 * Admin facing hooks
		 *
		 * To add an action, use $admin->action()
		 * To apply a filter, use $admin->filter()
		 */
		$admin = new Admin( $this->plugin );
		$admin->action( 'admin_head', 'head' );
		$admin->action( 'admin_enqueue_scripts', 'enqueue_scripts' );
		$admin->action( 'admin_notices', 'admin_notices' );
		$admin->filter( 'cx_is_pro', 'cx_is_pro' );

		/**
		 * Settings related hooks
		 *
		 * To add an action, use $settings->action()
		 * To apply a filter, use $settings->filter()
		 */
		$settings = new Settings( $this->plugin );
		$settings->filter( 'cx-settings-sections', 'add_settings_section' );
		$settings->filter( 'cx-settings-before-form', 'license_form' );
		$settings->filter( 'cx-settings-fields', 'basics_section_fields', 2 );



		/**
		 * Request facing hooks
		 *
		 * To add an action, use $admin->action()
		 * To apply a filter, use $admin->filter()
		 */
		$request = new Request( $this->plugin );
		$request->action( 'user_register', 'create_user' );
		$request->action( 'profile_update', 'update_user' );
		$request->action( 'password_reset', 'password_reset', 2, 10 );
		$request->action( 'delete_user', 'delete_user' );
		$request->action( 'remove_user_from_blog', 'delete_user', 2 );

		/**
		 * AJAX facing hooks
		 *
		 * To add a hook for logged in users, use $ajax->priv()
		 * To add a hook for non-logged in users, use $ajax->nopriv()
		 */
		$ajax = new AJAX( $this->plugin );
		$ajax->priv( 'export-users', 'export_users' );
		$ajax->priv( 'import-users', 'import_users' );

		/**
		 * API hooks
		 *
		 * Custom REST API
		 */
		$api = new API( $this->plugin, $request );
		$api->action( 'rest_api_init', 'register_endpoints' );

		// Product related classes
		$survey 	= new Survey( $this->plugin );
		$license 	= new License( $this->plugin, 'admin.php?page=share-logins#share-logins_license' );
		if( cx_is_active() ) {
			$update = new Update( $this->plugin );
		}
	}

	/**
	 * Internationalization
	 */
	public function i18n() {
		load_plugin_textdomain( 'share-logins-pro', false, dirname( plugin_basename( CXSL_PRO ) ) . '/languages/' );
	}

	/**
	 * Cloning is forbidden.
	 */
	private function __clone() { }

	/**
	 * Unserializing instances of this class is forbidden.
	 */
	private function __wakeup() { }

	/**
	 * Instantiate the plugin
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}

Plugin::instance();