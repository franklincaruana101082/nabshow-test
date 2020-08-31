<?php
/**
 * Plugin Name:       Related Products for WooCommerce     
 * Plugin URI:        https://wordpress.org/plugins/wt-woocommerce-related-products/ 
 * Description:       Custom Related Products for WooCommerce allows you to choose related products for the particular product.
 * Version:           1.1.7
 * Author:            WebToffee  
 * Author URI:        https://www.webtoffee.com/        
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       wt-woocommerce-related-products
 * WC tested upto :   4.3.3
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!defined('CRP_PLUGIN_URL'))
    define('CRP_PLUGIN_URL', plugin_dir_url(__FILE__));

if (!defined('CRP_PLUGIN_DIR')) {
    define('CRP_PLUGIN_DIR', dirname(__FILE__));
}
if (!defined('CRP_PLUGIN_DIR_PATH')) {
    define('CRP_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
}


/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('WT_RELATED_PRODUCTS_VERSION', '1.1.7');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-custom-related-products-activator.php
 */
function activate_custom_related_products() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-custom-related-products-activator.php';
    Custom_Related_Products_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-custom-related-products-deactivator.php
 */
function deactivate_custom_related_products() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-custom-related-products-deactivator.php';
    Custom_Related_Products_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_custom_related_products');
register_deactivation_hook(__FILE__, 'deactivate_custom_related_products');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-custom-related-products.php';
require plugin_dir_path(__FILE__) . 'includes/class-wt-relatedproducts-uninstall-feedback.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_custom_related_products() {

    $plugin = new Custom_Related_Products();
    $plugin->run();
}

run_custom_related_products();

add_action('plugin_action_links_' . plugin_basename(__FILE__), 'crp_action_links');

function crp_action_links($links) {

    $plugin_links = array(
        '<a href="' . esc_url(admin_url('/edit.php?post_type=product&page=wt-woocommerce-related-products')) . '">' . __('Settings', 'wt-woocommerce-related-products') . '</a>',
        '<a target="_blank" href="https://wordpress.org/support/plugin/wt-woocommerce-related-products/">' . __('Support', 'wt-woocommerce-related-products') . '</a>',
        '<a target="_blank" href="https://wordpress.org/support/plugin/wt-woocommerce-related-products/reviews?rate=5#new-post">' . __('Review', 'wt-woocommerce-related-products') . '</a>',
    );
    if (array_key_exists('deactivate', $links)) {
        $links['deactivate'] = str_replace('<a', '<a class="relatedproducts-deactivate-link"', $links['deactivate']);
    }
    return array_merge($plugin_links, $links);
}