<?php
/**
 * All public facing functions
 */

namespace codexpert\Share_Logins_Pro;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage Request
 * @author Nazmul Ahsan <n.mukto@gmail.com>
 */
class Request extends Hooks {

	/**
	 * Constructor function
	 */
	public function __construct( $plugin ) {
		$this->name         = $plugin['Name'];
		$this->site_url     = untrailingslashit( get_bloginfo( 'url' ) );
		$this->namespace    = CXSL_API_NAMESPACE;
		$this->ncrypt       = ncrypt();
		$this->access_token = cx_get_access_token();
		$this->remote_sites = cx_get_remote_sites();
	}

	public function create_user( $user_id ) {
		if( !cx_is_active() ) return;
		if( cx_within_route() ) return;
		if( cx_within_ajax_import() ) return;

		$user	= get_userdata( $user_id );
        if( !cx_is_role_allowed( $user ) ) return;

		$remote_sites = $this->remote_sites;
		foreach ( $remote_sites as $site ) {

			if( cx_config_is_enabled( 'outgoing', $site, 'create-user' ) ) :
			
			$url = "{$site}/?rest_route=/{$this->namespace}/create-user";

			$name = cx_pass_field_name();
			$args = array(
				'access_token'  => $this->access_token,
				'site_url'      => $this->site_url,
				'user_login'    => $this->ncrypt->encrypt( $user->user_login ),
				'user_email'    => $user->user_email,
				'user_pass'     => isset( $_POST[ $name ] ) ? str_replace( '=', '-', $this->ncrypt->encrypt( $_POST[ $name ] ) ) : '', // '-' is replaced in the remote site
				'user_nicename' => $user->user_nicename,
				'user_url'      => $user->user_url,
				'first_name'    => $user->first_name,
				'last_name'     => $user->last_name,
				// 'display_name'  => "{$user->first_name} {$user->last_name}",
				'roles'         => $user->roles,
				'meta'       	=> array()
			);

			foreach ( cx_get_option( 'share-logins_basics', 'share-meta_keys', array() ) as $key ){
		   		$args['meta'][ $key ] = get_user_meta( $user_id, $key, true );
		   	}

		   	$request_url = add_query_arg( 'token', $this->ncrypt->encrypt( json_encode( $args ) ), $url );
			wp_remote_request( $request_url, array( 'method' => 'POST' ) );

			cx_add_log( 'create', 'outgoing', $user->user_login, cx_get_route_home( $url ) );

			endif;

		}
	}

	public function update_user( $user_id ) {
		if( !cx_is_active() ) return;
		if( cx_within_route() ) return;
		if( cx_within_ajax_import() ) return;

		$user = get_userdata( $user_id );
        if( !cx_is_role_allowed( $user ) ) return;
		
		$remote_sites = $this->remote_sites;
		foreach ( $remote_sites as $site ) {

			if( cx_config_is_enabled( 'outgoing', $site, 'update-user' ) ) :
			
			$url = "{$site}/?rest_route=/{$this->namespace}/update-user";

			$name = cx_pass_field_name();
			$args = array(
				'access_token'  => $this->access_token,
				'site_url'      => $this->site_url,
				'user_login'    => $this->ncrypt->encrypt( $user->user_login ),
				'user_email'    => $user->user_email,
				'user_pass'     => isset( $_POST[ $name ] ) ? str_replace( '=', '-', $this->ncrypt->encrypt( $_POST[ $name ] ) ) : '', // '-' is replaced in the remote site
				'user_nicename' => $user->user_nicename,
				'user_url'      => $user->user_url,
				'first_name'    => $user->first_name,
				'last_name'     => $user->last_name,
				'display_name'  => $user->display_name,
				'description'   => $user->description,
				'roles'         => $user->roles,
			);

			foreach ( cx_get_option( 'share-logins_basics', 'share-meta_keys', array() ) as $key ){
		   		$args['meta'][ $key ] = get_user_meta( $user_id, $key, true );
		   	}

			$request_url = add_query_arg( 'token', $this->ncrypt->encrypt( json_encode( $args ) ), $url );
			wp_remote_request( $request_url, array( 'method' => 'POST' ) );

			cx_add_log( 'update', 'outgoing', $user->user_login, cx_get_route_home( $url ) );

			endif;

		}
	}

	public function password_reset( $user, $new_pass ) {
		if( !cx_is_active() ) return;
		if( cx_within_route() ) return;
        if( !cx_is_role_allowed( $user ) ) return;
		
		$remote_sites = $this->remote_sites;
		foreach ( $remote_sites as $site ) {

			if( cx_config_is_enabled( 'outgoing', $site, 'reset-password' ) ) :
			
			$url = "{$site}/?rest_route=/{$this->namespace}/reset-password";

			$args = array(
				'access_token'  => $this->access_token,
				'site_url'      => $this->site_url,
				'user_login'    => $this->ncrypt->encrypt( $user->user_login ),
				'user_pass'     => str_replace( '=', '-', $this->ncrypt->encrypt( $new_pass ) ),
			);

			$request_url = add_query_arg( 'token', $this->ncrypt->encrypt( json_encode( $args ) ), $url );
			wp_remote_request( $request_url, array( 'method' => 'POST' ) );

			cx_add_log( 'reset', 'outgoing', $user->user_login, cx_get_route_home( $url ) );

			endif;

		}
	}

	public function delete_user( $user_id ) {
		if( !cx_is_active() ) return;
		if( cx_within_route() ) return;

		$user = get_userdata( $user_id );
        if( !cx_is_role_allowed( $user ) ) return;
		
		$remote_sites = $this->remote_sites;
		foreach ( $remote_sites as $site ) {

			if( cx_config_is_enabled( 'outgoing', $site, 'delete-user' ) ) :
			
			$url = "{$site}/?rest_route=/{$this->namespace}/delete-user";

			$args = array(
				'access_token'  => $this->access_token,
				'site_url'      => $this->site_url,
				'user_login'    => $this->ncrypt->encrypt( $user->user_login ),
			);

			$request_url = add_query_arg( 'token', $this->ncrypt->encrypt( json_encode( $args ) ), $url );
			wp_remote_request( $request_url, array( 'method' => 'DELETE' ) );

			cx_add_log( 'delete', 'outgoing', $user->user_login, cx_get_route_home( $url ) );

			endif;

		}
	}

	/**
	 * For multisite
	 *
	 * @since 2.1
	 */
	public function remove_user( $user_id, $blog_id ) {
		$this->delete_user( $user_id );
	}
}