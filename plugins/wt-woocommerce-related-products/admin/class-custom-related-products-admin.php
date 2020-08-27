<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Custom_Related_Products
 * @subpackage Custom_Related_Products/admin
 * @author     markhf
 */
class Custom_Related_Products_Admin {

    private $plugin_name;
    private $version;
    private $option_name = 'custom_related_products';

    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/custom-related-products-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/custom-related-products-admin.js', array('jquery'), $this->version, false);
    }

    /**
     * Add related products selector to edit product section
     */
    function crp_select_related_products() {

        global $post, $woocommerce;

        $product_ids = array_filter(array_map('absint', (array) get_post_meta($post->ID, '_crp_related_ids', true)));
        ?>
        <div class="options_group">
            <?php if ($woocommerce->version >= '2.3' && $woocommerce->version < '3.0') : ?>
                <p class="form-field"><label for="related_ids"><?php _e('Related Products', 'wt-woocommerce-related-products'); ?></label>
                    <input type="hidden" class="wc-product-search" style="width: 50%;" id="crp_related_ids" name="crp_related_ids" data-placeholder="<?php _e('Search for a product&hellip;', 'woocommerce'); ?>" data-action="woocommerce_json_search_products" data-multiple="true" data-selected="<?php
                    $json_ids = array();
                    foreach ($product_ids as $product_id) {
                        $product = wc_get_product($product_id);

                        if (is_object($product) && is_callable(array($product, 'get_formatted_name'))) {
                            $json_ids[$product_id] = wp_kses_post($product->get_formatted_name());
                        }
                    }
                    echo esc_attr(json_encode($json_ids));
                    ?>" value="<?php echo implode(',', array_keys($json_ids)); ?>" /> <img class="help_tip" data-tip='<?php _e('Related products are displayed on the product detail page.', 'wt-woocommerce-related-products') ?>' src="<?php echo WC()->plugin_url(); ?>/assets/images/help.png" height="16" width="16" />
                </p>
            <?php else: ?>
                <p class="form-field"><label for="related_ids"><?php _e('Related Products', 'wt-woocommerce-related-products'); ?></label>
                    <select id="crp_related_ids" 
                            class="wc-product-search" 
                            name="crp_related_ids[]" 
                            multiple="multiple" 
                            style="width: 400px;" 
                            data-placeholder="<?php _e('Search for a product&hellip;', 'wt-woocommerce-related-products'); ?>" 
                            data-action="woocommerce_json_search_products">
                                <?php
                                foreach ($product_ids as $product_id) {

                                    $product = get_product($product_id);

                                    if ($product)
                                        echo '<option value="' . esc_attr($product_id) . '" selected="selected">' . esc_html($product->get_formatted_name()) . '</option>';
                                }
                                ?>
                    </select> <img class="help_tip" data-tip='<?php _e('Related products are displayed on the product detail page.', 'wt-woocommerce-related-products') ?>' src="<?php echo WC()->plugin_url(); ?>/assets/images/help.png" height="16" width="16" />
                </p>
            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Save related products on product edit screen
     */
    function crp_save_related_products($post_id, $post) {

        global $woocommerce;

        if (isset($_POST['crp_related_ids']) && current_user_can( 'manage_woocommerce' )) {

	    $custom_related_ids = isset($_POST['crp_related_ids']) ? array_map('intval', $_POST['crp_related_ids']) : array();
	    
            if ($woocommerce->version >= '2.3' && $woocommerce->version < '3.0') {
                $related = $custom_related_ids;
            } else {
                $related = array();
                $ids = $custom_related_ids;
                foreach ($ids as $id) {
                    if ($id && $id > 0) {
                        $related[] = $id;
                    }
                }
            }

            update_post_meta($post_id, '_crp_related_ids', $related);
        } else {
            delete_post_meta($post_id, '_crp_related_ids');
        }
    }

    public function add_options_page() {



        $plugin_screen_hook_suffix = add_submenu_page('edit.php?post_type=product', __('Custom Related Products Settings', 'wt-woocommerce-related-products'), __('Related Products', 'wt-woocommerce-related-products'), apply_filters('woocommerce_custom_related_products_role', 'manage_woocommerce'), $this->plugin_name, array($this, 'display_options_page')
        );

        $this->plugin_screen_hook_suffix = add_submenu_page('woocommerce', __('Custom Related Products Settings', 'wt-woocommerce-related-products'), __('Related Products', 'wt-woocommerce-related-products'), apply_filters('woocommerce_custom_related_products_role', 'manage_woocommerce'), $this->plugin_name, array($this, 'display_options_page')
        );
    }

    public function display_options_page() {

        include_once 'partials/custom-related-products-admin-display.php';
    }

    public function register_setting() {

        add_settings_section(
                $this->option_name . '_general', __('General', 'wt-woocommerce-related-products'), array($this, $this->option_name . '_general_cb'), $this->plugin_name
        );
        add_settings_field(
                $this->option_name . '_disable', __('Disable Woocommerce Default Related Products', 'wt-woocommerce-related-products'), array($this, $this->option_name . '_disable_cb'), $this->plugin_name, $this->option_name . '_general', array('label_for' => $this->option_name . '_disable')
        );
        add_settings_field(
                $this->option_name . '_disable_custom', __('Disable Custom Related Products', 'wt-woocommerce-related-products'), array($this, $this->option_name . '_disable_custom_cb'), $this->plugin_name, $this->option_name . '_general', array('label_for' => $this->option_name . '_disable_custom')
        );
        register_setting(
                $this->plugin_name, $this->option_name . '_disable'
        );
        register_setting(
                $this->plugin_name, $this->option_name . '_disable_custom'
        );
    }

    public function custom_related_products_disable_cb() {


        $disable = get_option($this->option_name . '_disable');
        ?>
        <fieldset>
            <label>
                <input type="checkbox" name="<?php echo $this->option_name . '_disable'; ?>" id="<?php echo $this->option_name . '_disable'; ?>" value="disable" <?php checked($disable, 'disable'); ?>>
                <?php _e('Disable', 'wt-woocommerce-related-products'); ?>
            </label>
        </fieldset>         
        <?php
    }

    public function custom_related_products_disable_custom_cb() {


        $cdisable = get_option($this->option_name . '_disable_custom');
        ?>
        <fieldset>
            <label>
                <input type="checkbox" name="<?php echo $this->option_name . '_disable_custom'; ?>" id="<?php echo $this->option_name . '_disable_custom'; ?>" value="cdisable" <?php checked($cdisable, 'cdisable'); ?>>
                <?php _e('Disable', 'wt-woocommerce-related-products'); ?>
            </label>
        </fieldset>         
        <?php
    }

    public function custom_related_products_general_cb() {

        echo '<p>' . __('Please change the settings as needed', 'wt-woocommerce-related-products') . '</p>';
    }

}