<?php

/**
 * All License facing functions
 */

namespace codexpert\Product;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * @package Plugin
 * @subpackage License
 * @author Nazmul Ahsan <n.mukto@gmail.com>
 */
class License {
	
	public $plugin;

	public function __construct( $plugin, $activator_path = '', $secret_key = '580cc082161006.41870101' ) {
		$this->plugin 	= $plugin;

		$this->license_server 	= $this->plugin['Server'];
		$this->secret_key 		= $secret_key;

		$this->slug 	= $this->plugin['TextDomain'];
		$this->basename = str_replace( array( '/', '.' ), array( '-', '-' ), plugin_basename( $this->plugin['File'] ) );
		
		$this->icon 	= isset( $this->plugin['icon'] ) ? $this->plugin['icon'] : '<span class="dashicons dashicons-admin-network"></span>';
		
		$this->activator_path = $activator_path == '' ? "admin.php?page={$this->slug}#{$this->slug}_license" : $activator_path;
		$this->activator_url = admin_url( "{$this->activator_path}" );

		$this->hooks();
	}

	public function hooks() {

		/**
		 * Don't hook twice
		 */
		if( did_action( "cx-license-loaded-{$this->slug}" ) ) return;
		do_action( "cx-license-loaded-{$this->slug}" );

		/**
		 * Initialize hooks
		 */
		register_activation_hook( $this->plugin['File'], array( $this, 'activation' ) );
		register_deactivation_hook( $this->plugin['File'], array( $this, 'deactivation' ) );
		add_filter( 'cron_schedules', array( $this, 'cron_schedules' ) );
		add_action( "cron_{$this->slug}", array( $this, 'check' ) );
		add_action( 'admin_head', array( $this, 'head' ) );
		add_action( "wp_ajax_license-activator-{$this->basename}", array( $this, 'verify' ) );
		add_action( 'admin_notices', array( $this, 'admin_notice' ) );
	}

	public function activation() {
	    if ( !wp_next_scheduled ( "cron_{$this->slug}" ) ) {
			$interval = apply_filters( "{$this->slug}_cron_interval", 'weekly' );
			wp_schedule_event( time(), $interval, "cron_{$this->slug}" );
	    }
	}

	public function deactivation() {
		wp_clear_scheduled_hook( "cron_{$this->slug}" );
	}

	public function cron_schedules( $schedules ) {
		$schedules['weekly'] = array(
			'interval'	=> WEEK_IN_SECONDS,
			'display'	=> __( 'weekly', 'codexpert' )
		);
		$schedules['biweekly'] = array(
			'interval'	=> 2 * WEEK_IN_SECONDS,
			'display'	=> __( 'biweekly', 'codexpert' )
		);
		$schedules['monthly'] = array(
			'interval'	=> MONTH_IN_SECONDS,
			'display'	=> __( 'monthly', 'codexpert' )
		);
		return $schedules;
	}

	public function head() {
		?>
		<style>
			.notice.cx-notice{border:none;padding:20px}.notice.cx-notice .cx-notice-inner{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}.notice.cx-notice .cx-notice-icon{font-size:20px}.notice.cx-notice .cx-notice-content{padding:0 20px}.notice.cx-notice p{padding:0;margin:0}.notice.cx-notice .cx-notice-action{text-align:center;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;margin-left:auto}.notice.cx-notice .cx-notice-action .cx-button{background-color:#d30c5c;color:#fff;border-color:#7c1337;-webkit-box-shadow:0 1px 0 #7c1337;box-shadow:0 1px 0 #7c1337;padding:5px 30px;height:auto;line-height:20px;text-transform:capitalize;font-size:13px;text-decoration:none;transition-duration:.3s;border-radius:3px;border:none;outline:none}.notice.cx-notice .cx-notice-action .cx-button:hover{background-color:#a0124a}.cx-logo-wrapper{display:inline-block;padding:.75em;background-image:-webkit-linear-gradient(225deg,#ef295a,#434363);background-image:-o-linear-gradient(225deg,#ef295a,#434363);background-image:linear-gradient(-135deg,#ef295a,#434363);-webkit-border-radius:7.5%;border-radius:7.5%;line-height:1}.cx-logo-wrapper span.dashicons{color:#fff;font-size:1em}@media only screen and (min-width :320px){.notice.cx-notice .cx-notice-inner{display:block;text-align:center}.notice.cx-notice .cx-notice-content{padding:0;margin-top:10px}.notice.cx-notice .cx-notice-action{display:block;margin-top:10px}}@media only screen and (min-width :768px){.notice.cx-notice .cx-notice-inner{display:flex;text-align:left}.notice.cx-notice .cx-notice-content{padding:0 20px;margin-top:0}.notice.cx-notice .cx-notice-action{display:flex;margin-top:0}}
		</style>
		<script>
			jQuery(function($){
				$('.<?php echo $this->basename; ?>-btn').click(function(e){
				    e.preventDefault()
				    var dis = $(this)
				    var btn = dis.val()
				    $(this).val('Please wait..')
				    var par = $(this).parent()
				    var key = $('input.key-field', par).val()
				    var plugin = $('input[name="plugin_key"]', par).val()
				    var operation = dis.attr('name')
				    $.ajax({
				        url: ajaxurl,
				        type: 'POST',
				        dataType: 'JSON',
				        data: { 'action' : 'license-activator-<?php echo $this->basename; ?>', 'operation' : operation, 'plugin' : plugin, 'key' : key, 'product_ref' : '<?php echo $this->plugin['Name'];?>' },
				        success:function(ret){
				        	console.log(ret)
				            dis.val(btn)
				            if(ret.status == 1) {
				            	$('#license-notice-<?php echo $this->slug; ?>').hide()
					            setTimeout(function(e){
					            	location.reload()
					            },2000)
				            }
				            $(".<?php echo $this->slug; ?>-message", par).html(ret.message)
				        }
				    })
				})
			})
		</script>
		<?php
	}

	public function activator_form() {
		$key = $this->basename;
		$value = get_option( $key );

		$_disabled = $this->_is_active() ? 'disabled' : '';
		$_type = $this->_is_active() ? 'password' : 'text';

		$html = "
		<div id='div_{$key}' class='{$this->slug}-activation-div'>
		    <input type='{$_type}' id='{$key}' name='{$key}' value='{$value}' class='key-field' placeholder='" . __( 'Input your license key', 'codexpert' ) . "' {$_disabled} >
	        <input type='hidden' name='plugin_key' value='{$key}' />
	        <input type='button' name='activate_license' value='" . __( 'Activate', 'codexpert' ) . "' class='{$key}-btn button-primary' />
	        <input type='button' name='deactivate_license' value='" . __( 'Deactivate', 'codexpert' ) . "' class='{$key}-btn button' />
	        <span class='{$this->slug}-message'></span>
		</div>
		";

		return $html;
	}

	public function verify() {
		$license_key = $_POST['key'];
        if ( isset( $_REQUEST['operation'] ) ) {
            $api_params = array(
                'slm_action'		=> ( $_REQUEST['operation'] != 'deactivate_license' ) ? 'slm_activate' : 'slm_deactivate',
                'secret_key'		=> $this->secret_key,
                'license_key'		=> $license_key,
                'registered_domain'	=> get_bloginfo( 'url' ),
                'item_reference'	=> urlencode( $this->plugin['Name'] ),
            );

            $query = esc_url_raw( add_query_arg( $api_params, $this->license_server ) );
            $response = wp_remote_get( $query, array( 'timeout' => 20, 'sslverify' => false ) );

            $data = array();

            if ( is_wp_error( $response ) ){
            	$data['status'] = 0;
                $data['message'] = __( 'Unexpected Error! Please try again or contact us.', 'codexpert' );
            }

            $license_data = json_decode( wp_remote_retrieve_body( $response ) );
            if( $license_data->result == 'success' ) {
            	$data['status'] = 1;
                $data['message'] = '<strong style="color:#07811a">' . $license_data->message . '</strong>';
                update_option( $this->basename, ( $_REQUEST['operation'] == 'deactivate_license' ) ? '' : $license_key );
				update_option( "{$this->basename}-status", 'active' );

				if( isset( $license_data->expiry ) ) {
					update_option( "{$this->basename}-expiry", strtotime( $license_data->expiry ) );
				}
            }
            else{
            	$data['status'] = 0;
                $data['message'] = '<strong style="color:#C8080E">' . $license_data->message . '</strong>';
            }

            wp_send_json( $data );
        }
	}

	public function check() {
		if( ( $lic_key = get_option( $this->basename ) ) == '' ) return;
		
		$args = array(
			'slm_action'	=> 'slm_check',
			'secret_key'	=> $this->secret_key,
			'license_key'	=> $lic_key
		);

		$api = add_query_arg( $args, 'https://codexpert.io' );
		$response = wp_remote_get( $api, array( 'timeout' => 20, 'sslverify' => false ) );
		$data = json_decode( wp_remote_retrieve_body( $response ) );

		if( $data->result == 'error' ) {
			delete_option( $this->basename );
		}
		elseif( isset( $data->status ) && in_array( $data->status,  array( 'expired', 'blocked' ) ) ) {
			delete_option( $this->basename );
			update_option( "{$this->basename}-status", $data->status );
		}
		elseif( isset( $data->date_expiry ) && strtotime( $data->date_expiry ) < time() ) {
			delete_option( $this->basename );
			update_option( "{$this->basename}-status", 'expired' );
		}
		elseif( isset( $data->date_expiry ) && strtotime( $data->date_expiry ) > time() ) {
			update_option( "{$this->basename}-expiry", strtotime( $data->date_expiry ) );
		}
	}

    public function license_tab( $form ) {
        echo $this->activator_form();
    }

	public function admin_notice() {
		if( !current_user_can( 'manage_options' ) ) return;

		// not activated
		if( get_option( $this->basename ) == '' ) {
		    ?>
		    <div class="notice cx-notice">
		    	<div class="cx-notice-inner">
					<div class="cx-notice-icon">
						<div class="cx-logo-wrapper">
							<?php echo $this->icon; ?>
						</div>
					</div>
					<div class="cx-notice-content">
						<strong><?php printf( __( 'Welcome to %s', 'codexpert' ), $this->plugin['Name']); ?></strong>
						<?php 
							printf( __( '<p>Please activate your license for <strong>%s</strong>! Sorry, but the plugin won\'t work without activation!</p>', 'codexpert' ), $this->plugin['Name'] );
						?>
					</div>
					<div class="cx-notice-action">
						<?php echo "<a href='{$this->activator_url}' class='cx-button'>" . __( 'Activate Now', 'codexpert' ) . '</a>'; ?>
					</div>
				</div>
		    </div>
		    <?php
		}

		// about to expire?
		$expiry = (int)get_option( "{$this->basename}-expiry" );
		$day_left = round( ( $expiry - time() ) / DAY_IN_SECONDS );
		if( $expiry != '' && $day_left <= 30 ) :

		    ?>
		    <div class="notice cx-notice">
		    	<div class="cx-notice-inner">
					<div class="cx-notice-icon">
						<div class="cx-logo-wrapper">
							<?php echo $this->icon; ?>
						</div>
					</div>
					<div class="cx-notice-content">
						<strong><?php printf( __( 'Welcome to %s', 'codexpert' ), $this->plugin['Name'] ); ?></strong>
						<?php 
							printf( __( '<p>The license for <strong>%1$s</strong> is about to expire in %2$d days! Please renew to get uninterrupted service!</p>', 'codexpert' ), $this->plugin['Name'], $day_left );
						?>
					</div>
					<div class="cx-notice-action">
						<?php echo "<a href='{$this->license_server}' class='cx-button' target='_blank'>" . __( 'Renew Now', 'codexpert' ) . '</a>'; ?>
					</div>
				</div>
		    </div>
		    <?php

		endif;

		// expired or blocked?
		$status = get_option( "{$this->basename}-status" );
		if( in_array( $status, array( 'expired', 'blocked' ) ) ) :

		    ?>
		    <div class="notice cx-notice">
		    	<div class="cx-notice-inner">
					<div class="cx-notice-icon">
						<div class="cx-logo-wrapper">
							<?php echo $this->icon; ?>
						</div>
					</div>
					<div class="cx-notice-content">
						<strong><?php printf( __( 'Welcome to %s!', 'codexpert' ), $this->plugin['Name'] ); ?></strong>
						<?php 
							printf( __( '<p><strong>%s</strong> was %s!</p>', 'codexpert' ), $this->plugin['Name'], $status );
						?>
					</div>
					<div class="cx-notice-action">
						<?php echo "<a href='{$this->license_server}' class='cx-button' target='_blank'>" . __( 'Renew Now', 'codexpert' ) . '</a>'; ?>
					</div>
				</div>
		    </div>
		    <?php

		endif;
	}

	public function _is_active() {
		return get_option( $this->basename ) != '';
	}

}
