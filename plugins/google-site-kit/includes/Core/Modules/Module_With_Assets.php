<?php
/**
 * Interface Google\Site_Kit\Core\Modules\Module_With_Assets
 *
 * @package   Google\Site_Kit
 * @copyright 2020 Google LLC
 * @license   https://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 * @link      https://sitekit.withgoogle.com
 */

namespace Google\Site_Kit\Core\Modules;

use Google\Site_Kit\Core\Assets\Asset;

/**
 * Interface for a module that includes assets.
 *
 * @since 1.7.0
 * @access private
 * @ignore
 */
interface Module_With_Assets {

	/**
	 * Gets the assets to register for the module.
	 *
	 * @since 1.7.0
	 *
	 * @return Asset[] List of Asset objects.
	 */
	public function get_assets();

	/**
	 * Enqueues all assets necessary for the module.
	 *
	 * @since 1.7.0
	 */
	public function enqueue_assets();
}
