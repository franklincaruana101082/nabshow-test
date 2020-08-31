<?php

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Custom_Related_Products
 * @subpackage Custom_Related_Products/includes
 * @author     markhf
 */
class Custom_Related_Products {

    protected $loader;

    protected $plugin_name;

    protected $version;

    const VERSION = '1.1.7';

    public function __construct() {

        $this->plugin_name = 'wt-woocommerce-related-products';
        $this->VERSION = '1.1.7';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Custom_Related_Products_Loader. Orchestrates the hooks of the plugin.
     * - Custom_Related_Products_i18n. Defines internationalization functionality.
     * - Custom_Related_Products_Admin. Defines all hooks for the admin area.
     * - Custom_Related_Products_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-custom-related-products-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-custom-related-products-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-custom-related-products-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-custom-related-products-public.php';

        $this->loader = new Custom_Related_Products_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Custom_Related_Products_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale() {

        $plugin_i18n = new Custom_Related_Products_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {

        $plugin_admin = new Custom_Related_Products_Admin($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

        $this->loader->add_action('woocommerce_process_product_meta', $plugin_admin, 'crp_save_related_products', 10, 2);
        $this->loader->add_action('woocommerce_product_options_related', $plugin_admin, 'crp_select_related_products');

        $this->loader->add_action('admin_menu', $plugin_admin, 'add_options_page');
        $this->loader->add_action( 'admin_init', $plugin_admin, 'register_setting' );

        
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {
        $wcversion = get_option('woocommerce_version', true);
        $plugin_public = new Custom_Related_Products_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');



        if (isset($wcversion) && !empty($wcversion)) {
            if ($wcversion >= '2.3' && $wcversion < '3.0') {
                $this->loader->add_filter('woocommerce_related_products_args', $plugin_public, 'crp_filter_related_products');
            } else if ($wcversion >= '3.0') {
                $this->loader->add_filter('woocommerce_locate_template', $plugin_public, 'crp_woocommerce_locate_template', 10, 3);
                
                $this->loader->add_filter( 'woocommerce_product_related_posts_force_display', $plugin_public,'crp_display_ids', 10, 2 );
                $this->loader->add_filter( 'woocommerce_product_related_posts_relate_by_category', $plugin_public, 'crp_remove_taxonomy', 10, 2 );
                $this->loader->add_filter( 'woocommerce_product_related_posts_relate_by_tag', $plugin_public,'crp_remove_taxonomy', 10, 2 );
                $this->loader->add_filter( 'woocommerce_product_related_posts_query', $plugin_public, 'crp_related_products_query', 20, 2 );
                
            } else {
                $this->loader->add_filter('woocommerce_related_products_args', $plugin_public, 'crp_filter_related_products');

            }
        }

       
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return   Custom_Related_Products_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    public function get_version() {
        return $this->version;
    }

}