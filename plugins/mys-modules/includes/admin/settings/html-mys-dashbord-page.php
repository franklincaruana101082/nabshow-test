<?php
/**
 * HTML for About Page.
 *
 * @package MYS Modules
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$setup_success = filter_input( INPUT_GET, 'setup-success', FILTER_SANITIZE_STRING );

if ( isset( $setup_success ) && 'true' === $setup_success ) {
	$pagetitle = "Your Wizard Setup Completed Successfully! Welcome to Dashboard.";
	update_option( 'nab_mys_show_wizard', 0 );
}

$this->glance_data = $this->nab_mys_db_history_object->nab_mys_dashboard_glance();
$recent_history    = $this->nab_mys_db_history_object->nab_mys_dashboard_activity();
$history_url       = admin_url( 'admin.php?page=mys-history' );
$allowed_tags      = array(
	'a' => array( 'href' => array() ),
	'i' => array( 'class' => array(), 'style' => array() ),
);

//Prevent  unauthorized users
if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_html__( 'You do not have sufficient permissions to access this page.' ) );
}
require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-header-page.php' );
?>
<div class="mys-section-left dashboard-page">
	<div class="mys-main-table res-cl">
		<?php if ( isset( $pagetitle ) ) { ?>
			<h1 style='margin-bottom:30px'><?php esc_html_e( $pagetitle ); ?></h1>
		<?php } ?>
		<div class="dashboard-main">
			<div class="dashboard-box">
				<div class="title">
					<h2>At a Glance</h2>
				</div>
				<?php
				require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-dashbord-widget.php' );
				?>
			</div>
			<div class="dashboard-box">
				<div class="title">
					<h2>Activity</h2>
				</div>
				<div class="inside">
					<div id="activity-widget">
						<div id="published-posts" class="activity-block">
							<ul>
								<?php
								foreach ( $recent_history as $h ) {
									$pdata_type = strpos( $h->HistoryDataType, 'session' ) !== false ? 'Sessions' : 'Exhibitors';
									$h_status   = $h->HistoryStatus;
									switch ( $h_status ) {

										case 5:
											$h_status = "<i class='fas fa-check-double' style='color:#008000'></i> Sync Successful";
											break;

										case 1:
											$h_status = "<i class='fas fa-check' style='color:#008000'></i> Pull Successful <i class='fas fa-sync fa-spin'></i> Sync In Progress";
											break;

										case 0:
											$h_status = "<i class='fas fa-sync fa-spin'></i> Pull In Progress";
											break;

										case 4:
											$h_status = "<i class='fas fa-times' style='color:#ff0000'></i> Sync Stopped";
											break;

										case 3:
											$h_status = "<i class='fas fa-times' style='color:#ff0000'></i> Pull Stopped";
											break;

										case 2:
											$h_status = "<i class='fas fa-times' style='color:#ff0000'></i> Pull Failed";
											break;

									}
									$pdata_with_counts  = $h->HistoryItemsAffected . ' ' . $pdata_type;
									$history_detail_url = $history_url . '&groupid=' . $h->HistoryGroupID . '&timeorder=asc';
									?>
									<li>
										<span><?php esc_html_e( $h->HistoryEndTime ) ?></span>
										<a href="<?php echo esc_url( $history_detail_url ) ?>">
											<?php echo wp_kses( $pdata_with_counts, $allowed_tags ) ?>
										</a> <?php echo wp_kses( "( $h_status )", $allowed_tags ) ?>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
