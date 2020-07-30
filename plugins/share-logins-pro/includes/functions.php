<?php
if( ! function_exists( 'pri' ) ) :
function pri( $data ) {
    echo '<pre>';
    if( is_object( $data ) || is_array( $data ) ) {
        print_r( $data );
    }
    else {
        var_dump( $data );
    }
    echo '</pre>';
}
endif;

if( ! function_exists( 'cx_get_option' ) ) :
function cx_get_option( $key, $section, $default = '' ) {

    $options = get_option( $key );

    if ( isset( $options[ $section ] ) ) {
        return $options[ $section ];
    }

    return $default;
}
endif;

if( !function_exists( 'cxslpro_get_template' ) ) :
/**
 * Includes a template file resides in /templates diretory
 *
 * It'll look into /share-logins directory of your active theme
 * first. if not found, default template will be used.
 * can be overriden with share-logins_template_override_dir hook
 *
 * @param string $slug slug of template. Ex: template-slug.php
 * @param string $sub_dir sub-directory under base directory
 * @param array $fields fields of the form
 */
function cxslpro_get_template( $slug, $sub_dir = null, $fields = null ) {

    // templates can be placed in this directory
    $override_template_dir = apply_filters( 'share-logins-pro_template_override_dir', get_stylesheet_directory() . '/share-logins/', $slug, $sub_dir, $fields );
    // if it's under a sub-directory
    $override_template_dir .= ( ! is_null( $sub_dir ) ) ? trailingslashit( $sub_dir ) : '';

    // default template directory
    $plugin_template_dir = dirname( CXSL_PRO ) . '/templates/';
    // if it's under a sub-directory
    $plugin_template_dir .= ( ! is_null( $sub_dir ) ) ? trailingslashit( $sub_dir ) : '';

    // full path of a template file in plugin directory
    $plugin_template_path =  $plugin_template_dir . $slug . '.php';
    // full path of a template file in override directory
    $override_template_path =  $override_template_dir . $slug . '.php';

    // if template is found in override directory
    if( file_exists( $override_template_path ) ) {
        ob_start();
        require_once $override_template_path;
        return ob_get_clean();
    }
    // otherwise use default one
    elseif ( file_exists( $plugin_template_path ) ) {
        ob_start();
        require_once $plugin_template_path;
        return ob_get_clean();
    }
    else {
        return __( 'Template not found!', 'share-logins' );
    }

}
endif;

if( ! function_exists( 'ncrypt' ) ) :
function ncrypt() {
    $ncrypt     = new \mukto90\Ncrypt;

    $options    = get_option( 'share-logins_security', array() );
    $secret_key = isset( $options['secret_key'] ) ? $options['secret_key'] : 'rd4jd874hey64t';
    $secret_iv  = isset( $options['secret_iv'] ) ? $options['secret_iv'] : '8su309fr7uj34';
    $ncrypt->set_secret_key( $secret_key );
    $ncrypt->set_secret_iv( $secret_iv );
    $ncrypt->set_cipher( 'AES-256-CBC' );

    return $ncrypt;
}
endif;

if( ! function_exists( 'cx_auto_login' ) ) :
function cx_auto_login( $username, $remember = 1 ) {
    if( is_user_logged_in() ) return;
    
    $user = get_user_by( 'login', $username );
    $user_id = $user->ID;

    wp_set_current_user( $user_id, $username );
    wp_set_auth_cookie( $user_id, ( $remember == 1 ) );
    do_action( 'wp_login', $username, $user );
}
endif;

if( ! function_exists( 'cx_get_remote_sites' ) ) :
function cx_get_remote_sites() {
    $remote_sites = array();
    $sites = get_option( 'share-logins_remote_sites' ) ? : array();
    foreach ( $sites as $site ) {
        if( $site != '' && trailingslashit( $site ) != trailingslashit( get_bloginfo( 'url' ) ) ) {
            $remote_sites[] = untrailingslashit( $site );
        }
    }

    return $remote_sites;
}
endif;

if( ! function_exists( 'cx_get_access_token' ) ) :
function cx_get_access_token() {
    $access_token = cx_get_option( 'share-logins_security', 'access_token' );
    if( $access_token == '' ) $access_token = 'gTEt35Ugy2igtyu8H99oOherhRJUR684H78yy';

    return $access_token;
}
endif;

if( ! function_exists( 'cx_within_route' ) ) :
function cx_within_route() {
    return strpos( $_SERVER['REQUEST_URI'], CXSL_API_NAMESPACE ) !== false;
}
endif;

if( ! function_exists( 'cx_within_ajax_import' ) ) :
function cx_within_ajax_import() {
    return apply_filters( 'cx_within_ajax_import', false );
}
endif;

if( ! function_exists( 'cx_config_is_enabled' ) ) :
/**
 * @var $type string possible values outgoing or incoming
 */
function cx_config_is_enabled( $type, $url, $action ) {
    $_config = get_option( "share-logins_config_{$type}" );
    return isset( $_config[ $url ][ $action ] ) && $_config[ $url ][ $action ] == 'on';
}
endif;

if( ! function_exists( 'cx_set_scheduled_urls' ) ) :
function cx_set_scheduled_urls( $urls ) {
    $_SESSION['_share-logins_scheduled_urls'] = base64_encode( serialize( $urls ) );

    /**
     * @since 2.1.3
     * @author developerwil
     * @link https://wordpress.org/support/topic/sessions-need-to-be-destroyed/
     */
    session_write_close();
}
endif;

if( ! function_exists( 'cx_is_active' ) ) :
function cx_is_active() {
    return get_option( 'share-logins-pro-share-logins-pro-php' ) != '';
}
endif;

if( ! function_exists( 'cx_get_scheduled_urls' ) ) :
function cx_get_scheduled_urls() {
    if( !isset( $_SESSION['_share-logins_scheduled_urls'] ) ) return array();
    $urls = unserialize( base64_decode( $_SESSION['_share-logins_scheduled_urls'] ) );
    return $urls;
}
endif;

if( ! function_exists( 'cx_remove_scheduled_url' ) ) :
function cx_remove_scheduled_url( $url ) {
    $urls = cx_get_scheduled_urls();
    
    if( isset( $urls[ $url ] ) ) {
        unset( $urls[ $url ] );
    }

    cx_set_scheduled_urls( $urls );
}
endif;

if( ! function_exists( 'cx_clean_scheduled_urls' ) ) :
function cx_clean_scheduled_urls() {
    if( !isset( $_SESSION['_share-logins_scheduled_urls'] ) ) return;
    
    unset( $_SESSION['_share-logins_scheduled_urls'] );
}
endif;

if( ! function_exists( 'cx_log_enabled' ) ) :
function cx_log_enabled() {
    return cx_get_option( 'share-logins_basics', 'enable_log' ) == 'on';
}
endif;

if( ! function_exists( 'cx_add_log' ) ) :
function cx_add_log( $activity, $direction, $user, $url ) {

    if( !cx_log_enabled() ) return;

    global $wpdb;

    $log_table = "{$wpdb->prefix}share_logins_log";

    if( is_multisite() ) {
        $blog_id = get_current_blog_id();
        $log_table = "{$wpdb->base_prefix}{$blog_id}_share_logins_log";
    }

    $wpdb->insert(
        $log_table,
        array(
            'time'          => time(),
            'activity'      => $activity,
            'direction'     => $direction,
            'url'           => $url,
            'user'          => $user
        ),
        array(
            '%d',
            '%s',
            '%s',
            '%s',
            '%s'
        )
    );
}
endif;

if( ! function_exists( 'cx_get_route_home' ) ) :
function cx_get_route_home( $url ) {
    $url_parts = explode( '/?', $url );
    return $url_parts[0];
}
endif;

if( ! function_exists( 'cx_is_lite_installed' ) ) :
function cx_is_lite_installed( $plugin = 'share-logins/share-logins.php' ) {
    $plugins = get_plugins();
    return isset( $plugins[ $plugin ] );
}
endif;

if( ! function_exists( 'cx_is_lite_active' ) ) :
function cx_is_lite_active( $plugin = 'share-logins/share-logins.php' ) {
    return is_plugin_active( $plugin );
}
endif;

if( ! function_exists( 'cx_pass_field_name' ) ) :
function cx_pass_field_name() {
    $name = 'pass1';
    
    if( cx_get_option( 'share-logins_basics', 'password_key' ) != '' ) {
        $name = cx_get_option( 'share-logins_basics', 'password_key' );
    }
    elseif( isset( $_POST['pass1'] ) && $_POST['pass1'] != '' ) {
        $name = 'pass1';
    }
    elseif( isset( $_POST['password'] ) && $_POST['password'] != '' ) {
        $name = 'password';
    }
    elseif( isset( $_POST['password1'] ) && $_POST['password1'] != '' ) {
        $name = 'password1';
    }
    elseif( function_exists( 'WC' ) && isset( $_POST['account_password'] ) ) {
        $name = 'account_password';
    }

    return $name;
}
endif;

if( ! function_exists( 'cx_is_role_allowed' ) ) :
/**
 * Defines if the user's role is allowed for sync
 */
function cx_is_role_allowed( $user ) {
    $roles = cx_get_option( 'share-logins_basics', 'user_roles', array() );

    if( !is_array( $roles ) || count( $roles ) <= 0 ) return true;
    
    return count( array_intersect( $roles, $user->roles ) ) > 0;
}
endif;