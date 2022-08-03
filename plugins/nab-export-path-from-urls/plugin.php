<?php
/**
 * Plugin Name:Export Paths from URLs
 * Plugin URI: https://nabshow.com/
 * Description: Export a CSV file that contains the following columns: (Path, Post ID, Type) - 1.) Path (the path, not the URL  - 2.) Post ID - the Post ID of the content on that page, - 3.) Post Type - e.g. Page, Company, Session, Article, etc.
 * Version: 1.0.1
 * Author: NAB
 * Author URI: https://nabshow.com/
 * Developer: Codev-NAB
 * Developer URI: https://nabshow.com/
 * Text Domain: export-path-from-urls
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package export-path-from-urls
 */

use Plugins\NabExportPathFromUrls\Includes\NabExportPathFromUrls;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define constants.
define( 'EXPORT_PATHS_URL', plugin_dir_url( __FILE__ ) );
define( 'EXPORT_PATHS_DIR', plugin_dir_path( __FILE__ ) );

require_once(EXPORT_PATHS_DIR . 'includes/nab-export-path-from-urls.php');

new NabExportPathFromUrls;
