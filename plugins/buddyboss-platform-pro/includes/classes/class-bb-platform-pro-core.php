<?php
/**
 * BuddyBoss Platform Pro Core Loader.
 *
 * @since 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Creates the Platform Core.
 *
 * @since 1.0.0
 */
class BB_Platform_Pro_Core {

	/**
	 * Construct.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->bootstrap();
	}

	/**
	 * Populate the global data needed before BuddyPress can continue.
	 *
	 * This involves figuring out the currently required, activated, deactivated,
	 * and optional components.
	 *
	 * @since 1.0.0
	 */
	private function bootstrap() {


		$this->load_integrations();

		// if in admin, include buddyboss updater.
		if ( is_admin() ) {
			$this->buddyboss_updater();
		}

		/**
		 * Fires before the loading of individual integrations and after BuddyBoss Platform Pro Core.
		 *
		 * @since 1.0.0
		 */
		do_action( 'bb_platform_pro_core_loaded' );
	}

	/**
	 * Load integrations files
	 *
	 * @since 1.0.0
	 */
	private function load_integrations() {
		$bb_platform_pro = bb_platform_pro();

		$integration_dirs = glob( $bb_platform_pro->integration_dir . '/*', GLOB_ONLYDIR );

		$integrations = array();
		if ( ! empty( $integration_dirs ) ) {
			foreach ( $integration_dirs as $integration_dir ) {
				$integrations[] = basename( $integration_dir );
			}
		}

		/**
		 * Filters the included and optional integrations.
		 *
		 * @since 1.0.0
		 *
		 * @param array $value Array of included and optional integrations.
		 */
		$bb_platform_pro->integrations = apply_filters(
			'bb_platform_pro_integrations',
			$integrations
		);

		foreach ( $bb_platform_pro->integrations as $integration ) {
			$file = "{$bb_platform_pro->integration_dir}/{$integration}/bp-{$integration}-loader.php";
			if ( file_exists( $file ) ) {
				require $file;
			}
		}

		/**
		 * Fires after the loading of individual integrations.
		 *
		 * @since 1.0.0
		 */
		do_action( 'bb_platform_pro_core_integrations_included' );
	}

	/**
	 * Include BuddyBoss Updater
	 * @since 1.0.0
	 */
	private function buddyboss_updater() {
		global $pagenow;

		if ( ! function_exists( 'buddyboss_updater_init' ) && ! ( 'plugins.php' == $pagenow && ( isset( $_GET['action'] ) && 'activate' == $_GET['action'] ) ) ) {
			require_once( bb_platform_pro()->plugin_dir . '/includes/lib/buddyboss-updater/buddyboss-updater.php' );
		}
	}
}