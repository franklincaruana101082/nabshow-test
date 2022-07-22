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

class VIP_nabshow_custom_helpers extends WPCOM_VIP_CLI_Command
{
    public function report($args, $assoc_args)
    {
        if (! apply_filters('wpcom_vip_nabshow_custom_helpers', true)) {
            WP_CLI::error('This site has disabled Two Factor.');
        }
    }
}

WP_CLI::add_command( 'vip nabshow-custom-helpers', 'VIP_nabshow_custom_helpers' );

function wpcom_vip_nabshow_custom_helpers() {
    if ( version_compare( PHP_VERSION, '5.4', '<' ) ) {
        deactivate_plugins( plugin_basename( __FILE__ ) );
        $plugin_data = get_plugin_data( __FILE__ );
        $plugin_version = $plugin_data['Version'];
        $plugin_name = $plugin_data['Name'];
        wp_die( '<h1>' . __('Could not activate plugin: PHP version error') . '</h1><h2>PLUGIN: <i>' . $plugin_name . ' ' . $plugin_version . '</i></h2><p><strong>' . __('You are using PHP version') . ' ' . PHP_VERSION . '</strong>. ' . __( 'This plugin has been tested with PHP versions 5.4 and greater.') . '</p><p>' . __('WordPress itself recommends using PHP version 7.3 or greater') . ': <a href="https://wordpress.org/about/requirements/" target="_blank">' . __('Official WordPress requirements') . '</a>' . '. ' . __('Please upgrade your PHP version or contact your Server administrator.') . '</p>', __('Could not activate plugin: PHP version error'), array( 'back_link' => true ) );

    }

	// Don't force Custom Helper by default in local environments
	if ( ! WPCOM_IS_VIP_ENV && ! apply_filters( 'wpcom_vip_nabshow_custom_helpers_local_testing', false ) ) {
		return false;
	}

	require_once(WP_PLUGIN_DIR.'/custom-helpers/cache-control-url-env/nabshow-cache-control.php');

}

register_activation_hook( __FILE__, 'wpcom_vip_nabshow_custom_helpers' );
