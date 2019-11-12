<?php
/**
 * HTML for MYS Plugin Header.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

//Prevent  unauthorized users
if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_html__( 'You do not have sufficient permissions to access this page.' ) );
}

$pagename = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );
$test     = filter_input( INPUT_GET, 'test', FILTER_SANITIZE_STRING );

$admin_url = get_admin_url();

$logged_in              = true;
$mys_login_form_success = get_option( 'mys_login_form_success' );

if ( 'mys-login' !== $pagename && false === $mys_login_form_success ) {
	$logged_in = false;

}

?>
	<header class="mys-header">
		<div class="mys-logo-main">
			<img src="<?php echo esc_url( MYS_PLUGIN_URL ) . '/assets/images/logo.png'; ?>">
		</div>
		<div class="mys-header-right">
			<div class="logo-detail">
				<strong>Map Your Show Modules</strong>
				<span>Version 1.1.1</span>
			</div>
		</div>
		<div class="mys-menu-main">
			<nav>
				<ul>
					<?php

					if ( 1 === (int) get_option( 'nab_mys_show_wizard' ) ) {
						$step = true === $logged_in ? 'Step ' . get_option( 'nab_mys_wizard_step' ) : '';
						?>
						<li>
							<a class="mystore_plugin active" href="javascript:void(0)">Setup Wizard</a>
						</li>
						<li>
							<a class="mystore_plugin" href="javascript:void(0)"><?php esc_html_e( $step ); ?></a>
						</li>
						<?php
					} else {
						?>
						<li>
							<a class="mystore_plugin <?php echo ( "mys-about" === $pagename ) ? 'active' : ''; ?>" href="<?php echo esc_url( $admin_url ) ?>admin.php?page=mys-about">About Plugin</a>
						</li>
						<li>
							<a class="mystore_plugin <?php echo ( "mys-dashboard" === $pagename ) ? 'active' : ''; ?>" href="<?php echo esc_url( $admin_url ) ?>admin.php?page=mys-dashboard">Dashboard</a>
						</li>
						<li>

						</li>
						<li>
							<a class="mystore_plugin <?php echo ( "mys-sync" === $pagename ) ? 'active' : ''; ?>" href="<?php echo esc_url( $admin_url ) ?>admin.php?page=mys-sync">Sync</a>
						</li>
						<li>
							<a class="mystore_plugin <?php echo ( "mys-history" === $pagename ) ? 'active' : ''; ?>" href="<?php echo esc_url( $admin_url ) ?>admin.php?page=mys-history">History</a>
						</li>
						<li>
							<a class="mystore_plugin <?php echo ( "mys-setting" === $pagename || "mys-login" === $pagename ) ? 'active' : ''; ?>" href="<?php echo esc_url( $admin_url ) ?>admin.php?page=mys-setting">Settings</a>
							<ul class="sub-menu">
								<li>
									<a class="mystore_plugin <?php echo ( "mys-login" === $pagename ) ? 'active' : ''; ?>" href="<?php echo esc_url( $admin_url ) ?>admin.php?page=mys-login">Configuration</a>
								</li>
							</ul>
						</li>
					<?php } ?>
				</ul>
			</nav>
		</div>
	</header>
<?php

if ( false === $logged_in ) {

	if ( 'mys-setting' === $pagename ) { ?>
		<div class="notice notice-success is-dismissible"><p>Plugin resetted successfully.</p></div>
	<?php }
	?>

	<div class="dashboard-box">
		<div class="mys-head">
			<p class='green-notice mys-error-notice'>Please <a class="mystore_plugin" href="<?php echo esc_url( $admin_url ) ?>admin.php?page=mys-login">click here</a> to login.</p>
		</div>
	</div>
	<?php exit();
}

if ( isset( $test ) ) {

//testorary actions - ne_remove this before PR

	$test_form_nonce = filter_input( INPUT_POST, 'test_form_nonce', FILTER_SANITIZE_STRING );
	if ( isset( $test_form_nonce ) && wp_verify_nonce( $test_form_nonce, 'test_form_nonce' ) ) {

		$test_modified_sequence = filter_input( INPUT_POST, 'test_modified_sequence', FILTER_SANITIZE_STRING );
		update_option( 'test_modified_sequence', $test_modified_sequence );
	} else {
		$test_modified_sequence = get_option( 'test_modified_sequence' );
	}
	?>
	<style>.mys-test-inner input {
			float: right
		}

		.mys-test-inner div {
			overflow: hidden
		}

		form.test-form .dashboard-box {
			max-width: 550px;
			margin: auto
		}</style>
	<div id="mys-test" style="margin-bottom:20px">
		<form method="post" name="test-update" class="test-form">
			<input type="hidden" name="test_form_nonce" value="<?php esc_attr_e( wp_create_nonce( 'test_form_nonce' ) ) ?>"/>
			<div class="dashboard-box">
				<div class="mys-head">
					<h2>MYS TEST</h2>
				</div>
				<div class="inside">
					<div class="main">
						<div class="mys-test-inner">
							<div class="test_modified_sequence">
								<label for="test_modified_sequence">Use Modified Date in Sequence</label>
								<input type="text" name="test_modified_sequence" value="<?php esc_attr_e( $test_modified_sequence ); ?>">
							</div>
						</div>
					</div>
					<div class="next-bottom-btn">
						<input type="submit" class="test-mys-submit" value="Update"/>
						<input type="button" id="test-mys-close" value="Close"/>
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php
}
