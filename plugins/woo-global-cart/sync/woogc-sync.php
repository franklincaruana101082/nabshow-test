<?php
        
        class WooGC_Sync 
            {
                
                private $query          =   '';
                private $environment    =   array();
                
                private $query_wp_data  =   array();
                private $user_id        =   '';
                private $user_data      =   '';
                
                private $query_wc_data  =   array();
                
                private $session_data   =   array();
                
                function __construct()
                    {
                                                
                        $this->query_wp             =   isset($_GET['wp'])      ?  $_GET['wp']    :   FALSE;
                        $this->query_wc             =   isset($_GET['wc'])      ?  $_GET['wc']    :   FALSE;
                        
                        include_once ( realpath(dirname(__FILE__) . '/..')  . '/include/static-functions.php' );
                        
                        $this->load_environment();
                        $this->set_other_constants();
      
                        $this->run();
                        
                    }
                    
                
                function __destruct()
                    {
                        
                        $this->_output_pixel();   
                        
                    }
                    
                
                /**
                * Load environment data
                * 
                */
                private function load_environment()
                    {
                        require_once('environment.php');
                        $this->environment  =   json_decode($WooGC_environment);

                        $this->define_environment_constants();
                    }
                    
                
                private function define_environment_constants()
                    {
                        
                        foreach($this->environment  as  $constant_name  =>  $value)
                            {
                                if(!defined($constant_name))
                                    define($constant_name, $value);
                            }   
                        
                    }
                
                
                
                private function set_other_constants()
                    {
                        
                        $this->environment->COOKIE_DOMAIN    =   $this->environment->USE_SUBDOMAIN_INSTALL  === TRUE    ?   "." . WooGC_get_domain($_SERVER['SERVER_NAME'])  :   $_SERVER['SERVER_NAME'];
                        
                        $this->define_environment_constants();
                    }
                    
                
                
                
                
                
                /**
                * Run the setup
                *     
                */
                private function run()
                    {

                        if( $this->query_wp ===  '')
                            {
                                $this->delete_wp_cookies();
                            }
                        
                        if( ! $this->query_wc )
                            {
                                $this->delete_wc_cookies();
                            }
                        
                        if(empty( $this->query_wp ) &&  ! $this->query_wc)
                            return;
                        
                        if( $this->query_wc !== FALSE )
                            $this->set_wc_cookies();
                        
                        if( ! empty($this->query_wp) )
                            $this->set_wp_cookies();
                    
                    }
                    
                    
                private function delete_wp_cookies()
                    {
                        
                        //clear cookies                       
                        $this->set_cookie( AUTH_COOKIE,         '', -1,   ADMIN_COOKIE_PATH,      COOKIE_DOMAIN, TRUE );
                        $this->set_cookie( SECURE_AUTH_COOKIE,  '', -1,   ADMIN_COOKIE_PATH,      COOKIE_DOMAIN, TRUE );
                        $this->set_cookie( AUTH_COOKIE,         '', -1,   PLUGINS_COOKIE_PATH,    COOKIE_DOMAIN, TRUE );
                        $this->set_cookie( SECURE_AUTH_COOKIE,  '', -1,   PLUGINS_COOKIE_PATH,    COOKIE_DOMAIN, TRUE );
                        $this->set_cookie( LOGGED_IN_COOKIE,    '', -1,   COOKIEPATH,             COOKIE_DOMAIN, TRUE );
                        $this->set_cookie( LOGGED_IN_COOKIE,    '', -1,   SITECOOKIEPATH,         COOKIE_DOMAIN, TRUE );
                                        
                    }
                    
                    
                private function delete_wc_cookies()
                    {
                                                
                        //clear woocommerce cookies
                        $this->set_cookie( 'wp_woocommerce_session_' . COOKIEHASH,  '', -1,   '/',   COOKIE_DOMAIN, TRUE );
                        $this->set_cookie( 'woocommerce_cart_hash',                 '', -1,   '/',   COOKIE_DOMAIN, TRUE );
                        $this->set_cookie( 'woocommerce_items_in_cart',             '', -1,   '/',   COOKIE_DOMAIN, TRUE );
          
                    }
                
                    
                private function set_wp_cookies()
                    {
                        
                        define( 'SHORTINIT', true );
                        require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
                        
                        $woogc_sso_data =   $this->check_wp_login_hash( $this->query_wp );
                        if( $woogc_sso_data === FALSE )
                            return;
                        
                        $this->session_data =   unserialize($woogc_sso_data->meta_value);
                        $this->user_id      =   $woogc_sso_data->user_id;
                        
                        //clean the hash from db as bein used already
                        $this->clear_wp_login_hash( $this->query_wp );
                        
                        //check if user should be loged in only if belong to specific role
                        if( ! $this->use_sso_for_specific_roles( $this->user_id ) )
                            return;                        
                            
                        if( ! $this->validate_sso_data($woogc_sso_data))
                            return;
               
                        add_filter('session_token_manager',             array( $this, 'session_token_manager' ), 999 );
                        
                        $this->wp_set_domain_cookies();
                           
                    }
                    
                    
                private function set_wc_cookies()
                    {
                        
                        $this->parse_wc_query();
                        
                        if( ! $this->check_cookie_expire( $this->query_wc_data['cookie_expiration'] ) )
                            return;
                            
                        $this->wc_set_domain_cookies();
                        
                    }
                    
                          
                private function parse_wc_query()
                    {
                        
                        $data                   =   explode("||", $this->query_wc);
                        
                        $this->query_wc_data       =   array(
                                                        'customer_id'           =>   $data[0],
                                                        'cookie_expiration'     =>   $data[1],
                                                        'cookie_hmac'           =>   $data[3],
                                                        );
                    
                        
                    }
                
                
                private function check_cookie_expire( $expire )
                    {
                        
                        if( $expire < time() )
                            return FALSE;
                            
                        return TRUE;    
                        
                    }
                
                
                
                private function check_wp_login_hash( $hash )
                    {
                        
                        global $wpdb;
                        
                        //check any entry to match
                        $query              =   $wpdb->prepare("SELECT user_id, meta_value FROM "  .   $wpdb->usermeta . "
                                                                WHERE   `meta_key`  =   %s", 'woogc_sso_data_' . $hash);
                        $woogc_sso_data    =   $wpdb->get_row( $query );
                        
                        if ( ! is_object( $woogc_sso_data ) )
                            return FALSE;
  
                        return $woogc_sso_data;
                        
                    }
                
                
                private function clear_wp_login_hash( $hash )
                    {
                        
                        global $wpdb;
                        
                        $mysql_query    =   $wpdb->prepare("DELETE FROM "  .   $wpdb->usermeta . "  WHERE `meta_key`  =   %s", 'woogc_sso_data_' . $hash);   
                        $wpdb->get_results( $mysql_query );
                    
                    }        
                
                
                
                private function use_sso_for_specific_roles( $user_id )
                    {
                        
                        global $wpdb;
                        
                        $woogc_options  =   $this->get_options();
                        
                        //if feature turned off return TRUE
                        if( ! isset($woogc_options['login_only_specific_roles_status'])    ||  $woogc_options['login_only_specific_roles_status']  !=  'yes')
                            return TRUE;
                        
                        if( ! isset($woogc_options['login_only_specific_roles']) ||  !is_array($woogc_options['login_only_specific_roles']) ||  count($woogc_options['login_only_specific_roles']) < 1 )
                            return TRUE;
                        
                        //check if this functionality is turned on
                        $query              =   $wpdb->prepare("SELECT meta_value FROM "  .   $wpdb->usermeta . "
                                                                WHERE   `user_id`    =   %d AND `meta_key`  LIKE '%%_capabilities'", $this->user_id);
                        $user_blogs_roles    =   $wpdb->get_results( $query );
                        
                        if(count( $user_blogs_roles )   <   1)  
                            return TRUE;
                        
                        $user_roles  =   array();
                        foreach( $user_blogs_roles as $user_blogs_role)
                            {
                                $meta_value =   maybe_unserialize( $user_blogs_role->meta_value );
                                
                                if ( ! is_array($meta_value)    ||  count($meta_value) < 1)
                                    continue;
                                
                                foreach($meta_value as  $role   =>  $value)
                                    {
                                        $user_roles[ $role ]   =    TRUE;
                                    }
                            }
                            
                        if ( count ($user_roles) < 1)
                            return TRUE;
                        
                        $user_roles =   array_keys($user_roles);
                        
                        //compare the roles
                        if ( count( array_intersect( $user_roles, $woogc_options['login_only_specific_roles'] ) ) < 1 )
                            return FALSE;
                            
                        return TRUE;
                        
                    }
                    
                
                private function get_options()
                    {
                        
                        global $wpdb;
                        
                        //check if this functionality is turned on
                        $query              =   "SELECT meta_value FROM "  .   $wpdb->sitemeta . " WHERE   `meta_key`  =   'woogc_options'";
                        $woogc_options      =   $wpdb->get_var( $query );
                        
                        $woogc_options      =   maybe_unserialize( $woogc_options );
                    
                        return $woogc_options;
                    
                    }    
                
                private function validate_sso_data($woogc_sso_data)
                    {
                            
                        //check expiration    
                        if( time() > $this->session_data['time'] + WOOGC_SSO_EXPIRE )
                            return FALSE;
                        
                        global $blog_id;
                            
                        //check if correct site    
                        if( $blog_id    !=  $this->session_data['site'])
                            return FALSE;
                        
                        //check ip
                        if( $_SERVER['REMOTE_ADDR']    !=  $this->session_data['ip'])
                            return FALSE;
                        
                        //check ua
                        if( $_SERVER['HTTP_USER_AGENT']    !=  $this->session_data['ua'])
                            return FALSE;
                            
                        return TRUE;   
                        
                    }
                
                
                
                private function verify_cookie_session()
                    {
                        
                        require( ABSPATH . WPINC . '/class-wp-session-tokens.php' );
                        require( ABSPATH . WPINC . '/formatting.php' );
                        require( ABSPATH . WPINC . '/user.php' );
                        require( ABSPATH . WPINC . '/meta.php' );
                        
                        $manager        = WP_Session_Tokens::get_instance( $this->user_data->ID );
                        $this->session_data   =   $manager->get( $this->query_wp_data['cookie_token'] );
                        
                        if(empty($this->session_data))
                            return FALSE;
                            
                        return TRUE;
                        
                    }
                
                
                private function filter_IP()
                    {
                        
                        if ( empty( $_SERVER['REMOTE_ADDR'] ) )
                            return FALSE;
                        
                        
                        $session['ip'] = $_SERVER['REMOTE_ADDR'];
                                
                        if( $session['ip'] !=   $this->session_data['ip'])
                            return FALSE;
                            
                        return TRUE;   

                    }
                
                private function wp_set_domain_cookies()
                    {
                        include_once (ABSPATH . 'wp-includes/pluggable.php');
                        require_once( ABSPATH . WPINC . '/class-wp-session-tokens.php' );
                        require_once( ABSPATH . WPINC . '/formatting.php' );
                        require_once( ABSPATH . WPINC . '/user.php' );
                        require_once( ABSPATH . WPINC . '/meta.php' );
                        require_once( ABSPATH . WPINC . '/class-wp-user.php' );
                        require_once( ABSPATH . WPINC . '/capabilities.php' );
                        require_once( ABSPATH . WPINC . '/class-wp-roles.php' );
                        require_once( ABSPATH . WPINC . '/class-wp-role.php' );
                        
                        $woogc_sso_last_login   =   get_user_meta($this->user_id, 'woogc_sso_last_login', TRUE);
                                                                                             
                        $manager = WP_Session_Tokens::get_instance( $this->user_id );
                        $token   = $manager->create( $woogc_sso_last_login['expiration'] );
                        
                        $scheme = 'auth';
                        $auth_cookie = wp_generate_auth_cookie( $this->user_id, $woogc_sso_last_login['expiration'], $scheme, $token );
                        
                        //set cookies non-ssl
                        //??  SameSite => Secure !!
                        $this->set_cookie( AUTH_COOKIE, $auth_cookie, $woogc_sso_last_login['expire'], ADMIN_COOKIE_PATH, COOKIE_DOMAIN, TRUE, TRUE);
                        
                        $scheme = 'secure_auth';
                        $secure_auth_cookie = wp_generate_auth_cookie( $this->user_id, $woogc_sso_last_login['expiration'], $scheme, $token );
                        
                        //set cookies ssl
                        $this->set_cookie( SECURE_AUTH_COOKIE, $secure_auth_cookie, $woogc_sso_last_login['expire'], ADMIN_COOKIE_PATH, COOKIE_DOMAIN, TRUE, TRUE);
                        
                        $secure_logged_in_cookie    =   FALSE;
                        
                        $logged_in_cookie = wp_generate_auth_cookie( $this->user_id, $woogc_sso_last_login['expiration'], 'logged_in', $token );
                        
                        $this->set_cookie( LOGGED_IN_COOKIE, $logged_in_cookie, $woogc_sso_last_login['expire'], COOKIEPATH, COOKIE_DOMAIN, TRUE, TRUE);
                        if ( COOKIEPATH != SITECOOKIEPATH )
                            {
                                $this->set_cookie( LOGGED_IN_COOKIE, $logged_in_cookie, $woogc_sso_last_login['expire'], SITECOOKIEPATH, COOKIE_DOMAIN, TRUE, TRUE);
                            }
                     
                        
                    }
                    
                private function wc_set_domain_cookies()
                    {
                        $this->set_cookie( 'wp_woocommerce_session_' . COOKIEHASH, $this->query_wc, $this->query_wc_data['cookie_expiration'], COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN, TRUE, FALSE);                 
                    }
                    
  
                private function set_cookie(    $CookieName, $CookieValue = '', $CookieMaxAge = 0, $CookiePath = '', $CookieDomain = '', $CookieSecure = false, $CookieHTTPOnly = false, $CookieSameSite = 'none') 
                    {
                        header( 'Set-Cookie: ' . rawurlencode( $CookieName ) . '=' . rawurlencode( $CookieValue )
                                            . ( empty($CookieMaxAge )   ? '' : '; Max-Age=' . $CookieMaxAge)
                                            . ( empty($CookiePath )     ? '' : '; path=' . $CookiePath)
                                            . ( empty($CookieDomain )   ? '' : '; domain=' . $CookieDomain)
                                            . ( !$CookieSecure          ? '' : '; secure')
                                            . ( !$CookieHTTPOnly        ? '' : '; HttpOnly')
                                            . ( empty($CookieSameSite)  ? '' : '; SameSite=' . $CookieSameSite )
                                            
                                            ,false);
                    }
                
                
                public function session_token_manager()
                    {
                        include_once('../include/class.woogc.wp-user-meta-session-tokens.php');
                        
                        return 'WooGC_WP_User_Meta_Session_Tokens';   
                        
                    }
                
                    
                public function _output_pixel()
                    {
                        
                        header('Content-Type: image/png');
                        
                        echo base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=');
                    
                    }
                
                    
                public function get_domain( $domain )
                    {
                        
                        $original = $domain = strtolower($domain);
                        if (filter_var($domain, FILTER_VALIDATE_IP)) 
                            { 
                                return $domain; 
                            }

                        $arr = array_slice(array_filter(explode('.', $domain, 4), function($value){
                            return $value !== 'www';
                        }), 0); //rebuild array indexes
                        
                        if (count($arr) > 2)
                            {
                                $count = count($arr);
                                $_sub = explode('.', $count === 4 ? $arr[3] : $arr[2]);

                                if (count($_sub) === 2) // two level TLD
                                {
                                    $removed = array_shift($arr);
                                    if ($count === 4) // got a subdomain acting as a domain
                                    {
                                        $removed = array_shift($arr);
                                    }
                                }
                                elseif (count($_sub) === 1) // one level TLD
                                {
                                    $removed = array_shift($arr); //remove the subdomain
                                    if (strlen($_sub[0]) === 2 && $count === 3) // TLD domain must be 2 letters
                                    {
                                        array_unshift($arr, $removed);
                                    }
                                    else
                                    {
                                        // non country TLD according to IANA
                                        $tlds = array(
                                            'aero',
                                            'arpa',
                                            'asia',
                                            'biz',
                                            'cat',
                                            'com',
                                            'coop',
                                            'edu',
                                            'gov',
                                            'info',
                                            'jobs',
                                            'mil',
                                            'mobi',
                                            'museum',
                                            'name',
                                            'net',
                                            'org',
                                            'post',
                                            'pro',
                                            'tel',
                                            'travel',
                                            'xxx',
                                        );
                                        if (count($arr) > 2 && in_array($_sub[0], $tlds) !== false) //special TLD don't have a country
                                        {
                                            array_shift($arr);
                                        }
                                    }
                                }
                                else // more than 3 levels, something is wrong
                                {
                                    for ($i = count($_sub); $i > 1; $i--)
                                    {
                                        $removed = array_shift($arr);
                                    }
                                }
                            }
                        elseif (count($arr) === 2)
                            {
                                $arr0 = array_shift($arr);
                                if (strpos(join('.', $arr), '.') === false
                                    && in_array($arr[0], array('localhost','test','invalid')) === false) // not a reserved domain
                                {
                                    // seems invalid domain, restore it
                                    array_unshift($arr, $arr0);
                                }
                            }
                            
                        return join('.', $arr);
                        
                    }    
                
            }
            
        new WooGC_Sync();

     
?>