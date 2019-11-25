<?php
/**
 * HTML for Dashboard Widget.
 *
 * @package MYS Modules
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

//Prevent  unauthorized users
if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_html__( 'You do not have sufficient permissions to access this page.' ) );
}
?>
<div class="inside">
	<div class="main">
		<ul>
			<?php
			foreach ( $this->glance_data as $data_type => $pdata ) { ?>
				<li class="post-count"><a href="<?php echo esc_url( $pdata['link'] ); ?>"><?php esc_html_e( $pdata['count'] . ' ' . $data_type ); ?></a></li>
				<?php
				if ( isset( $pdata['terms'] ) ) {
					foreach ( $pdata['terms'] as $term_name => $tdata ) { ?>
						<li class="post-count"><a href="<?php echo esc_url( $tdata['tlink'] ); ?>"><?php esc_html_e( $tdata['tcount'] . ' ' . $term_name ); ?></a></li>
					<?php }
				}
			} ?>
		</ul>
		<p id="wp-version-message"><span id="wp-version">Custom MYS Plugin <b>v<?php esc_html_e( MYS_PLUGIN_VERSION ); ?></b> running</p>
	</div>
</div>
