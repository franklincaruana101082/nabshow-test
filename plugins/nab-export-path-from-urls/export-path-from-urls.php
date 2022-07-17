<?php


function eau_extract_all_urls_nav(){

    add_management_page( 'Export Paths from URLs', 'Export Paths from URLs', 'manage_options', 'extract-all-urls-settings', 'eau_include_settings_page' );

}

add_action( 'admin_menu', 'eau_extract_all_urls_nav' );

function eau_include_settings_page(){

    require_once(plugin_dir_path(__FILE__) . 'extract-all-urls-settings.php');

}


function eau_redirect_on_export_all_urls_activation() {

    if ( ! get_transient( 'eau_export_all_urls_activation_redirect' ) ) {
        return;
    }

    delete_transient( 'eau_export_all_urls_activation_redirect' );

    wp_safe_redirect( add_query_arg( array( 'page' => 'extract-all-urls-settings' ), admin_url( 'tools.php' ) ) );
	exit;

}
add_action( 'admin_init', 'eau_redirect_on_export_all_urls_activation' );

