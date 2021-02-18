<?php

/**
 * Checks if password matches confirm password
 *
 * @param $posted
 *
 * @return \WP_Error
 */
function nab_confirm_password_matches_checkout($errors, $username, $email)
{

    extract($_POST);

    if (isset($first_name) && empty($first_name)) {
        return new WP_Error('registration-error', __('Please enter First Name.', 'woocommerce'));
    }

    if (isset($last_name) && empty($last_name)) {
        return new WP_Error('registration-error', __('Please enter Last Name.', 'woocommerce'));
    }

    if (isset($password2) && empty($password2)) {
        return new WP_Error('registration-error', __('Please enter confirm password.', 'woocommerce'));
    }

    if (!empty($password) && 8 > strlen($password)) {
        return new WP_Error('registration-error', __('Password must be 8 characters long.', 'woocommerce'));
    }

    if (!is_user_logged_in() && 0 !== strcmp($password, $password2)) {
        return new WP_Error('registration-error', __('Passwords do not match.', 'woocommerce'));
    }
    if ( ! isset( $privacy_policy ) || empty( $privacy_policy ) ) {
        return new WP_Error('registration-error', __('Term of Service must be accepted', 'woocommerce'));
    }

    return $errors;
}

/**
 * Sync users across multisite
 *
 * @param $username
 * @param $user
 */
function nab_sync_login($username, $user)
{

    $sites = [3, 4, 5, 13, 14]; // for NY site @todo Make it dynamic later

    foreach ($sites as $site) {
        if (isset($user->ID) && !empty($user->ID) && false === is_user_member_of_blog($user->ID, $site)) {
            add_user_to_blog($site, $user->ID, 'subscriber');
        }
    }
}

/**
 *  Add Custom Meta Boxes.
 */
function amplify_custom_meta_boxes()
{
    $screens = ['product'];
    foreach ($screens as $screen) {
        add_meta_box(
            'product_video_meta', // Unique ID
            'Product Video',
            'product_video_text_box_html',
            $screen
        );

        add_meta_box(
            'product_publisher_content', // Unique ID
            'Publisher Content',
            'product_publisher_content_html',
            $screen
        );
        add_meta_box(
            'product_long_content', // Unique ID
            'Long Content',
            'product_long_content_html',
            $screen
        );
        add_meta_box(
            'product_join_today_content', // Unique ID
            'Join Today Content',
            'product_join_today_content_html',
            $screen
        );
    }
}

/**
 * Callback for Publisher Content
 *
 * @param object /array $post Post data.
 */
function product_publisher_content_html($post)
{
    $product_publisher_content_html = get_post_meta($post->ID, '_product_publisher_content_html', true);
    $editor_id                      = 'product_publisher_content_html'; // Unique ID
    wp_editor($product_publisher_content_html, $editor_id);
}

/**
 * Callback for Long Content
 *
 * @param object /array $post Post data.
 */
function product_long_content_html($post)
{
    $product_long_content_html = get_post_meta($post->ID, '_product_long_content_html', true);
    $editor_id                 = 'product_long_content_html'; // Unique ID
    wp_editor($product_long_content_html, $editor_id);
}

/**
 * Callback for Join Today Content
 *
 * @param object /array $post Post data.
 */
function product_join_today_content_html($post)
{
    $product_join_today_content = get_post_meta($post->ID, '_product_join_today_content_html', true);
    $editor_id                  = 'product_join_today_content_html'; // Unique ID
    wp_editor($product_join_today_content, $editor_id);
}

/**
 * Callback for Product Video
 *
 * @param object /array $post Post data.
 */
function product_video_text_box_html($post)
{

    $product_video_url   = get_post_meta($post->ID, '_product_video_url', true);
    $product_video_id    = get_post_meta($post->ID, '_product_video_thumb', true);
    $product_video_thumb = wp_get_attachment_image_src($product_video_id, 'full')[0];

?>
    <p>Type the URL of your BrightCov Video.</p>
    <input style="width: 100%" type="text" name="product_video_url" value="<?php echo $product_video_url ?>" />

    <p>Choose or Upload an Image</p>
    <p style="<?php if (!$product_video_thumb) {
                    echo 'dispaly: none';
                } ?>"><img src="<?php echo esc_url($product_video_thumb); ?>" id="product_video_thumb_img" style="max-width: 250px; cursor: pointer" /></p>
    <input type="hidden" id="product_video_thumb" name="product_video_thumb" value="<?php echo esc_attr($product_video_id); ?>" />
    <input type="button" id="product_video_thumb_button" class="button" value="Choose or Upload an Image" />

    <script>
        jQuery('#product_video_thumb_button, #product_video_thumb_img').click(function() {

            var send_attachment_bkp = wp.media.editor.send.attachment;

            wp.media.editor.send.attachment = function(props, attachment) {
                jQuery('#product_video_thumb_img').attr('src', attachment.url).show();
                jQuery('#product_video_thumb').val(attachment.id);
                wp.media.editor.send.attachment = send_attachment_bkp;
            };

            wp.media.editor.open();

            return false;
        });
    </script>
<?php
}

/**
 * Ajax to upload user images.
 */
function nab_amplify_upload_images()
{

    $user_id = get_current_user_id();
    $company_id = filter_input(INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT);

    // Upload images.
    $images_names         = array('profile_picture', 'banner_image', 'company_profile_picture', 'company_banner_image');
    $dependencies_loaded = 0;

    foreach ($_FILES as $file_key => $file_details) {

        if (in_array($file_key, $images_names, true)) {

            if (0 === $dependencies_loaded) {
                // These files need to be included as dependencies when on the front end.
                require_once ABSPATH . 'wp-admin/includes/image.php';
                require_once ABSPATH . 'wp-admin/includes/file.php';
                require_once ABSPATH . 'wp-admin/includes/media.php';
                $dependencies_loaded = 1;
            }

            // Let WordPress handle the upload.
            $attachment_id = media_handle_upload($file_key, 0);

            if (!is_wp_error($attachment_id)) {
                // update in meta
                if ($file_key === 'company_profile_picture') {
                    set_post_thumbnail($company_id, $attachment_id);
                } else if ($file_key === 'company_banner_image') {
                    update_field('field_5fb60d61ce131', $attachment_id, $company_id);
                } else {
                    update_user_meta($user_id, $file_key, $attachment_id);
                    update_user_meta($user_id, 'profile_update_two', '1');
                }
            }
        }
    }
    wp_die();
}

/**
 * Ajax to show edit product.
 */
function nab_amplify_edit_product()
{

    $post_id      = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);
    $post_data    = get_post($post_id);


    $taxonomies    = get_object_taxonomies('nab-product');
    $taxonomy_data = wp_get_object_terms($post_id, 'company-product-category', array('fields' => 'slugs'));
    $tag_data      = wp_get_object_terms($post_id, 'company-product-tag', array('fields' => 'slugs'));
    $product_media = get_field('product_media', $post_id);

    $post_data->product_copy               = get_field('product_copy', $post_id);
    $post_data->product_specs              = get_field('product_specs', $post_id);
    $post_data->product_point_of_contact   = get_field('product_point_of_contact', $post_id);
    $post_data->is_feature_product         = get_field('is_feature_product', $post_id);
    $post_data->is_product_b_stock         = get_field('is_product_b-stock', $post_id);
    $post_data->is_product_sales_item      = get_field('is_product_sales_item', $post_id);
    $post_data->categories                 = $taxonomy_data;
    $post_data->tags                       = $tag_data;
    $post_data->product_media              = $product_media;
    $post_data->product_thumbnail          = get_the_post_thumbnail_url($post_id, 'full');
    $post_data->product_thumbnail_id       = get_post_thumbnail_id($post_id);
    $post_data->product_copy_html          = nab_get_wp_editor($post_data->product_copy, 'nab_product_copyx', array('media_buttons' => false, 'quicktags' => false, 'tinymce' => array('toolbar1' => 'bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink', 'toolbar2' => '', 'content_css' => get_template_directory_uri() . '/assets/css/nab-front-tinymce.css')));
    $post_data->product_specs_html         = nab_get_wp_editor($post_data->product_specs, 'nab_product_specsx', array('media_buttons' => false, 'quicktags' => false, 'tinymce' => array('toolbar1' => 'bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink', 'toolbar2' => '', 'content_css' => get_template_directory_uri() . '/assets/css/nab-front-tinymce.css')));
    $post_data->nab_product_learn_more_url = get_field('product_learn_more_url', $post_id);

    $terms = get_terms('company-product-category', array(
        'hide_empty' => false,
    ));
    require_once get_template_directory() . '/inc/nab-edit-product.php';

    wp_die();
}

/**
 * Ajax to remove user images.
 */
function nab_amplify_remove_images()
{

    $name    = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $name    = str_replace('_remove', '', $name);
    $user_id = get_current_user_id();

    // update in meta
    update_user_meta($user_id, $name, 'removed');

    wp_die();
}

/**
 * Save Product Video meta values
 *
 * @param int $post_id
 */
function save_product_video_text($post_id)
{

    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);

    // Exits script depending on save status
    if ($is_autosave || $is_revision) {
        return;
    }

    if (array_key_exists('product_publisher_content_html', $_POST)) {
        update_post_meta(
            $post_id,
            '_product_publisher_content_html',
            $_POST['product_publisher_content_html']
        );
    }
    if (array_key_exists('product_long_content_html', $_POST)) {
        update_post_meta(
            $post_id,
            '_product_long_content_html',
            $_POST['product_long_content_html']
        );
    }
    if (array_key_exists('product_join_today_content_html', $_POST)) {
        update_post_meta(
            $post_id,
            '_product_join_today_content_html',
            $_POST['product_join_today_content_html']
        );
    }
    if (array_key_exists('product_video_url', $_POST)) {
        update_post_meta(
            $post_id,
            '_product_video_url',
            $_POST['product_video_url']
        );
    }
    if (array_key_exists('product_video_thumb', $_POST)) {
        update_post_meta(
            $post_id,
            '_product_video_thumb',
            $_POST['product_video_thumb']
        );
    }
}

/**
 * Registration Success Message
 */
function nab_reg_message()
{
    if (!is_user_logged_in() && is_account_page() && isset($_GET['nab_registration_complete']) && 'true' === $_GET['nab_registration_complete']) {
        wc_add_notice('You have successfully created your account . Please login to continue.');
    }
}

/**
 * Remove woocommerce password strength js
 */
function nab_remove_password_strength()
{
    wp_dequeue_script('wc-password-strength-meter');
}

/**
 * Custom Validations for Reset password
 *
 * @param $errors
 * @param $user
 */
function nab_reset_password_validation($errors, $user)
{
    if (!empty($_POST['password_1']) && 8 > strlen($_POST['password_1'])) {
        wc_add_notice(__('Password must be 8 characters long.', 'woocommerce'), 'error');
    }
}

/**
 * Register endpoints to use for My Account page.
 */
function nab_amplify_add_custom_endpoints()
{
    add_rewrite_endpoint('edit-my-profile', EP_ROOT | EP_PAGES);
    add_rewrite_endpoint('my-purchases', EP_ROOT | EP_PAGES);
    add_rewrite_endpoint('my-connections', EP_ROOT | EP_PAGES);
    add_rewrite_endpoint('my-events', EP_ROOT | EP_PAGES);
    add_rewrite_endpoint('my-bookmarks', EP_ROOT | EP_PAGES);
}

/**
 * My Purchases content.
 */
function nab_amplify_my_purchases_content_callback()
{
    get_template_part('template-parts/content', 'my-purchases');
}

/**
 * My Connections content.
 */
function nab_amplify_my_connections_content_callback()
{
    get_template_part('template-parts/content', 'my-connections');
}

/**
 * My Events content.
 */
function nab_amplify_my_events_content_callback()
{
    get_template_part('template-parts/content', 'my-events');
}

/**
 * My Bookmark content.
 */
function nab_amplify_my_bookmarks_content_callback()
{
    get_template_part('template-parts/content', 'my-bookmarks');
}

/**
 * Register my purchases endpoint to use for My Account page.
 */
function nab_amplify_my_purchases_endpoint()
{
    add_rewrite_endpoint('my-purchases', EP_ROOT | EP_PAGES);
}

/**
 * Register my connections endpoint to use for My Account page.
 */
function nab_amplify_my_connections_endpoint()
{
    add_rewrite_endpoint('my-connections', EP_ROOT | EP_PAGES);
}

/**
 * Register Custom Post Type.
 */
function nab_amplify_register_post_types() {

    $labels = array(
        'name'               => _x('Company Products', 'Post Type General Name', 'nab-amplify'),
        'singular_name'      => _x('Company Product', 'Post Type Singular Name', 'nab-amplify'),
        'menu_name'          => __('Company Products', 'nab-amplify'),
        'parent_item_colon'  => __('Parent Company Products', 'nab-amplify'),
        'all_items'          => __('All Company Products', 'nab-amplify'),
        'view_item'          => __('View Company Product', 'nab-amplify'),
        'add_new_item'       => __('Add New Company Product', 'nab-amplify'),
        'add_new'            => __('Add New', 'nab-amplify'),
        'edit_item'          => __('Edit Company Products', 'nab-amplify'),
        'update_item'        => __('Update Company Products', 'nab-amplify'),
        'search_items'       => __('Search Company Products', 'nab-amplify'),
        'not_found'          => __('Not Found', 'nab-amplify'),
        'not_found_in_trash' => __('Not found in Trash', 'nab-amplify'),
    );

    $args = array(
        'label'               => __('Company Products', 'nab-amplify'),
        'labels'              => $labels,
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'supports'            => array('title', 'editor', 'thumbnail', 'author', 'excerpt', 'comments', 'trackbacks', 'revisions', 'custom-fields'),

    );

    // Registering your Custom Post Type
    register_post_type('company-products', $args);

    $labels = array(
        'name'               => _x('Sessions', 'Post Type General Name', 'nab-amplify'),
        'singular_name'      => _x('Session', 'Post Type Singular Name', 'nab-amplify'),
        'menu_name'          => __('Sessions', 'nab-amplify'),
        'parent_item_colon'  => __('Parent Session', 'nab-amplify'),
        'all_items'          => __('All Sessions', 'nab-amplify'),
        'view_item'          => __('View Session', 'nab-amplify'),
        'add_new_item'       => __('Add New Session', 'nab-amplify'),
        'add_new'            => __('Add New', 'nab-amplify'),
        'edit_item'          => __('Edit Session', 'nab-amplify'),
        'update_item'        => __('Update Session', 'nab-amplify'),
        'search_items'       => __('Search Session', 'nab-amplify'),
        'not_found'          => __('Not Found', 'nab-amplify'),
        'not_found_in_trash' => __('Not found in Trash', 'nab-amplify'),
    );

    $args = array(
        'label'               => __('sessions', 'nab-amplify'),
        'description'         => __('Session posts', 'nab-amplify'),
        'labels'              => $labels,
        'taxonomies'          => array('session_categories'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'supports'            => array('title', 'editor', 'thumbnail'),

    );

    // Registering your Custom Post Type
    register_post_type('sessions', $args);

    $labels = array(
        'name'               => _x('Downloadable PDFs', 'Post Type General Name', 'nab-amplify'),
        'singular_name'      => _x('Downloadable PDF', 'Post Type Singular Name', 'nab-amplify'),
        'menu_name'          => __('Downloadable PDFs', 'nab-amplify'),
        'parent_item_colon'  => __('Parent Downloadable PDFs', 'nab-amplify'),
        'all_items'          => __('All Downloadable PDFs', 'nab-amplify'),
        'view_item'          => __('View Downloadable PDF', 'nab-amplify'),
        'add_new_item'       => __('Add New Downloadable PDF', 'nab-amplify'),
        'add_new'            => __('Add New', 'nab-amplify'),
        'edit_item'          => __('Edit Downloadable PDFs', 'nab-amplify'),
        'update_item'        => __('Update Downloadable PDFs', 'nab-amplify'),
        'search_items'       => __('Search Downloadable PDFs', 'nab-amplify'),
        'not_found'          => __('Not Found', 'nab-amplify'),
        'not_found_in_trash' => __('Not found in Trash', 'nab-amplify'),
    );

    $args = array(
        'label'               => __('Downloadable PDFs', 'nab-amplify'),
        'labels'              => $labels,
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'menu_icon'           => 'dashicons-pdf',
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'supports'            => array('title', 'editor', 'thumbnail', 'author', 'excerpt', 'comments', 'trackbacks', 'revisions', 'custom-fields'),

    );

    // Registering your Custom Post Type
    register_post_type('downloadable-pdfs', $args);
}

// Hooking up our function to theme setup
add_action('init', 'nab_amplify_register_post_types');

/**
 * Register Arabic category
 */
function nab_amplify_session_categories()
{

    $labels = array(
        'name'              => _x('Session Categories', 'events-master-plugin'),
        'singular_name'     => _x('Session Category', 'events-master-plugin'),
        'search_items'      => __('Search Session Category'),
        'all_items'         => __('All Session Categories'),
        'parent_item'       => __('Parent Session Category'),
        'parent_item_colon' => __('Parent Topic:'),
        'edit_item'         => __('Edit Session Category'),
        'update_item'       => __('Update Session Category'),
        'add_new_item'      => __('Add New Session Category'),
        'new_item_name'     => __('New Session Category'),
        'menu_name'         => __('Session Categories'),
    );

    register_taxonomy(
        'session_categories',
        array('sessions'),
        array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_in_rest'      => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'session_categories'),
        )
    );
}

add_action('init', 'nab_amplify_session_categories');

/**
 * Save first and last name at Registration
 *
 * @param $customer_id
 */
function nab_save_name_fields($customer_id)
{

    if (isset($_POST['first_name'])) {
        update_user_meta($customer_id, 'billing_first_name', sanitize_text_field($_POST['first_name']));
        update_user_meta($customer_id, 'first_name', sanitize_text_field($_POST['first_name']));
    }
    if (isset($_POST['last_name'])) {
        update_user_meta($customer_id, 'billing_last_name', sanitize_text_field($_POST['last_name']));
        update_user_meta($customer_id, 'last_name', sanitize_text_field($_POST['last_name']));
    }
    if (isset($_POST['user_interest']) && !empty($_POST['user_interest'])) {
        update_user_meta($customer_id, 'user_interest', $_POST['user_interest']);
    }
    if ( isset( $_POST[ 'press_member' ] ) && ! empty( $_POST[ 'press_member' ] ) ) {
        update_user_meta( $customer_id, 'press_member_user', $_POST[ 'press_member' ] );
    }
}

/**
 * Event for validations
 */
function nab_attendee_field_process()
{

    // Return if user is not logged in or is bulk purchase
    if (!is_user_logged_in()) {
        return;
    }

    if (false === nab_is_bulk_order()) {

        if (!isset($_POST['attendee_first_name']) || empty($_POST['attendee_first_name'])) {
            wc_add_notice(__('Please enter Attendee First Name.'), 'error');
        }

        if (!isset($_POST['attendee_last_name']) || empty($_POST['attendee_last_name'])) {
            wc_add_notice(__('Please enter Attendee Last Name.'), 'error');
        }

        if (!isset($_POST['attendee_email']) || empty($_POST['attendee_email'])) {
            wc_add_notice(__('Please enter Attendee Email.'), 'error');
        }

        if (!isset($_POST['attendee_company']) || empty($_POST['attendee_company'])) {
            wc_add_notice(__('Please enter Attendee Company.'), 'error');
        }

        if (!isset($_POST['attendee_title']) || empty($_POST['attendee_title'])) {
            wc_add_notice(__('Please enter Attendee Title.'), 'error');
        }

        if (!isset($_POST['attendee_country']) || empty($_POST['attendee_country'])) {
            wc_add_notice(__('Please enter Attendee Country.'), 'error');
        }
    }

    if (!isset($_POST['attendee_partner_opt_in']) || empty($_POST['attendee_partner_opt_in'])) {
        wc_add_notice(__('Please choose your preference for Partner Communications opt in.'), 'error');
    }

    if (!isset($_POST['attendee_exhibition_sponsors_opt_in']) || empty($_POST['attendee_exhibition_sponsors_opt_in'])) {
        wc_add_notice(__('Please choose your preference for Exhibitor/Sponsor Communications opt in.'), 'error');
    }

    if (!isset($_POST['attendee_tos_agree']) || 'yes' !== $_POST['attendee_tos_agree']) {
        wc_add_notice(__('You must agree with Terms and Privacy Policy.'), 'error');
    }
}

/**
 * Event form save fields
 *
 * @param $order_id
 */
function nab_save_event_fields($order_id)
{

    // Return if user is not logged in or is bulk purchase
    if (!is_user_logged_in()) {
        return;
    }

    if (nab_is_bulk_order()) {
        // save bulk order details
        update_post_meta($order_id, '_nab_bulk_order', 'yes');
        $nab_bulk_qty = nab_bulk_order_quantity();
        if (isset($nab_bulk_qty) && !empty($nab_bulk_qty)) {
            update_post_meta($order_id, '_nab_bulk_qty', $nab_bulk_qty);
        }
    } else {
        $user_id = get_current_user_id();

        $event_data = array(
            'attendee_first_name'                 => (isset($_POST['attendee_first_name']) && !empty($_POST['attendee_first_name'])) ? sanitize_text_field($_POST['attendee_first_name']) : '',
            'attendee_last_name'                  => (isset($_POST['attendee_last_name']) && !empty($_POST['attendee_last_name'])) ? sanitize_text_field($_POST['attendee_last_name']) : '',
            'attendee_email'                      => (isset($_POST['attendee_email']) && !empty($_POST['attendee_email'])) ? sanitize_email($_POST['attendee_email']) : '',
            'attendee_company'                    => (isset($_POST['attendee_company']) && !empty($_POST['attendee_company'])) ? sanitize_text_field($_POST['attendee_company']) : '',
            'attendee_title'                      => (isset($_POST['attendee_title']) && !empty($_POST['attendee_title'])) ? sanitize_text_field($_POST['attendee_title']) : '',
            'attendee_country'                    => (isset($_POST['attendee_country']) && !empty($_POST['attendee_country'])) ? sanitize_text_field($_POST['attendee_country']) : '',
            'attendee_city'                       => (isset($_POST['attendee_city']) && !empty($_POST['attendee_city'])) ? sanitize_text_field($_POST['attendee_city']) : '',
            'attendee_state'                      => (isset($_POST['attendee_state']) && !empty($_POST['attendee_state'])) ? sanitize_text_field($_POST['attendee_state']) : '',
            'attendee_zip'                        => (isset($_POST['attendee_zip']) && !empty($_POST['attendee_zip'])) ? sanitize_text_field($_POST['attendee_zip']) : '',
            'attendee_affiliation'                => (isset($_POST['attendee_affiliation']) && !empty($_POST['attendee_affiliation'])) ? sanitize_text_field($_POST['attendee_affiliation']) : '',
            'attendee_partner_opt_in'             => (isset($_POST['attendee_partner_opt_in']) && !empty($_POST['attendee_partner_opt_in'])) ? sanitize_text_field($_POST['attendee_partner_opt_in']) : '',
            'attendee_exhibition_sponsors_opt_in' => (isset($_POST['attendee_exhibition_sponsors_opt_in']) && !empty($_POST['attendee_exhibition_sponsors_opt_in'])) ? sanitize_text_field($_POST['attendee_exhibition_sponsors_opt_in']) : '',
            'attendee_discover'                   => (isset($_POST['attendee_discover']) && !empty($_POST['attendee_discover'])) ? wp_unslash($_POST['attendee_discover']) : [],
            'attendee_meet'                       => (isset($_POST['attendee_meet']) && !empty($_POST['attendee_meet'])) ? wp_unslash($_POST['attendee_meet']) : [],
            'other_interest'                      => (isset($_POST['other_interest']) && !empty($_POST['other_interest'])) ? $_POST['other_interest'] : '',
            'billing_phone'                       => (isset($_POST['billing_phone']) && !empty($_POST['billing_phone'])) ? sanitize_text_field($_POST['billing_phone']) : '',
        );

        $event_data['attendee_interest'] = isset($_POST['attendee_interest']) ? $_POST['attendee_interest'] : [];
        if (isset($_POST['other_interest']) && isset($_POST['attendee_other_interest']) && !empty($_POST['attendee_other_interest'])) {
            $event_data['attendee_other_interest'] = sanitize_text_field($_POST['attendee_other_interest']);
        }

        // Save details to user meta
        foreach ($event_data as $key => $val) {
            update_user_meta($user_id, $key, $val);
        }
    }

    if (isset($_POST['nab_additional_email']) && !empty($_POST['nab_additional_email'])) {
        update_post_meta($order_id, 'nab_additional_email', filter_input(INPUT_POST, 'nab_additional_email'));
    }
}

/**
 * Redirecting templates.
 */
function nab_amplify_template_redirect()
{

    // Redirect on first sight!
    if (is_singular('tribe_events')) {
        wp_redirect(home_url(), 301);
        exit;
    }

    global $wp;
    $current_user_id     = get_current_user_id();
    $user_logged_in        = is_user_logged_in();

    // Get buddypress member ID.
    $member_id = 0;
    if (bp_current_component()) {
        global $bp;
        $member_id = isset($bp->displayed_user->id) ? $bp->displayed_user->id : 0;
    }

    // Redirect Buddypress pages.
    $request               = explode('/', $wp->request);
    $current_url           = home_url($wp->request);
    $redirect_url          = '';
    $bp_current_component  = bp_current_component();
    $allowed_bp_components = array('front', 'messages');
    $my_profile_url        = bp_core_get_user_domain($current_user_id);
    $is_friend             = friends_check_friendship_status($current_user_id, $member_id);

    if (!$user_logged_in && $bp_current_component) {
        /* If user is NOT logged in and try to access Buddypress page. */
        $redirect_url = add_query_arg(array('r' => $current_url), wc_get_page_permalink('myaccount'));
    } else if ($user_logged_in && $bp_current_component && !in_array($bp_current_component, $allowed_bp_components, true)) {
        /* If user is logged in and try to access Buddypress page but the component is NOT allowed. */
        $redirect_url = $my_profile_url;
    } else if (
        $user_logged_in && $bp_current_component
        && 0 !== $member_id
        && $current_user_id !== $member_id
        && 'messages' === $bp_current_component
    ) {
        /* If user is logged in and try to access another Buddypress Member's messages section. */
        $redirect_url = $my_profile_url;
    } else if ($user_logged_in && is_account_page() && in_array(end($request), array('my-connections', 'my-events', 'my-bookmarks'))) {

        $member_id = filter_input(INPUT_GET, 'user_id', FILTER_SANITIZE_NUMBER_INT);

        if (isset($member_id) && !empty($member_id)) {

            $is_friend = friends_check_friendship_status($current_user_id, $member_id);

            if ($current_user_id !== (int) $member_id && (!nab_member_can_visible_to_anyone($member_id) && 'is_friend' !== $is_friend)) {

                /* If user is logged in and try to access another Member's profile connections, events and bookmarks who has security enabled. */
                $redirect_url = $my_profile_url;
            }
        }
    } else if ((is_account_page() && 'edit-address' === end($request)) || (is_account_page() && 'edit-my-profile' === end($request))) {

        $redirect_url = wc_get_account_endpoint_url('edit-account');
    }

    if (!empty($redirect_url)) {
        wp_redirect($redirect_url);
        exit;
    }
}

/**
 * Update order status processing to completed.
 *
 * @param $order_id
 */
function nab_amplify_completed_order_after_payment_complete($order_id)
{
    $order          = wc_get_order($order_id);
    $order_status   = $order->get_status();
    $transaction_id = $order->get_transaction_id();
    if (!empty($transaction_id) && 'processing' === strtolower($order_status)) {
        $order->update_status('completed');
        $order->save();
    }
}

/**
 * Auto Completed order if total amount is zero and order status is processing.
 */
function nab_amplify_completed_zero_order($order_id)
{
    if (!$order_id) {
        return;
    }
    $order = wc_get_order($order_id);

    if ('0.00' == $order->get_total() && 'processing' === $order->get_status()) {
        $order->update_status('completed');
    }
}

/**
 * @param array $file_types Add file types support in file uploads.
 *
 * @return array
 */
function nab_amplify_add_file_types_to_uploads($file_types)
{
    if (is_user_logged_in() && current_user_can('administrator')) {
        $new_filetypes        = array();
        $new_filetypes['csv'] = 'text/csv';
        $file_types           = array_merge($file_types, $new_filetypes);
    }

    return $file_types;
}

/**
 * Header Scripts
 */
function nab_header_scripts()
{
?>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-K2F9KBS');
    </script>
    <!-- End Google Tag Manager -->
<?php
}

/**
 * User sync on WooCommerce Registration
 *
 * @param $customer_id
 * @param $new_customer_data
 * @param $password_generated
 */
function nab_user_registration_sync($customer_id, $new_customer_data, $password_generated)
{

    $current_user = get_userdata($customer_id);
    if (isset($current_user) && !empty($current_user)) {
        do_action('wp_login', $current_user->user_login, $current_user);
    }

    $sites = [3, 4, 5, 13, 14]; // for NY site @todo Make it dynamic later

    foreach ($sites as $site) {
        if (isset($customer_id) && !empty($customer_id) && false === is_user_member_of_blog($customer_id, $site)) {
            add_user_to_blog($site, $customer_id, 'subscriber');
        }
    }

    // Generate JWT Token
    if (isset($new_customer_data['user_login']) && !empty($new_customer_data['user_login']) && isset($new_customer_data['user_pass']) && !empty($new_customer_data['user_pass'])) {
        nab_generate_jwt_token($new_customer_data['user_login'], $new_customer_data['user_pass']);
    }
}

/**
 * Includes bulk purchase template
 */
function nab_bulk_purchase_cart()
{
    require_once get_template_directory() . '/inc/nab-bulk-purchase.php';
}

/**
 * Create Attendee Import table
 */
function nab_create_attendee_table()
{
    global $wpdb;

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    $charset_collate = $wpdb->get_charset_collate();

    $nab_attendee = $wpdb->prefix . 'nab_attendee';
    $sql          = "CREATE TABLE `$nab_attendee` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`parent_user_id` bigint(20) NOT NULL,
			`order_id` int(10) NOT NULL,
			`status` int(10) NOT NULL,
			`first_name` varchar(255) NOT NULL,
			`last_name` varchar(255) NOT NULL,
			`email` varchar(255) NOT NULL,
			`wp_user_id` int(10) NOT NULL,
			`child_order_id` int(10) NOT NULL,
			`created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  			`modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY  (id)
			) {$charset_collate};";

    dbDelta($sql);

    $nab_cocart = $wpdb->prefix . 'cocart_carts';
    $tables     = "CREATE TABLE `$nab_cocart` (
					cart_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
					cart_key char(42) NOT NULL,
					cart_value longtext NOT NULL,
					cart_expiry BIGINT UNSIGNED NOT NULL,
					PRIMARY KEY (cart_id),
					UNIQUE KEY cart_key (cart_key)
				) {$charset_collate};";

    dbDelta($tables);
}

/**
 * Register custom api endpoints.
 *
 * @since 1.0.0
 */
function amplify_register_api_endpoints()
{

    register_rest_route('nab', '/request/get-product-categories', array(
        'methods'             => 'GET',
        'callback'            => 'amplify_get_product_categories',
        'permission_callback' => '__return_true',
    ));

    register_rest_route('nab', '/request/get-product-list', array(
        'methods'             => 'GET',
        'callback'            => 'amplify_get_product_list',
        'permission_callback' => '__return_true',
        'args'                => array(
            'term_id' => array(
                'validate_callback' => function ($param) {
                    return is_numeric($param);
                },
            ),
        ),
    ));

    register_rest_route('nab', '/request/customer-bought-product', array(
        'methods'             => 'POST',
        'callback'            => 'amplify_check_user_bought_product',
        'permission_callback' => '__return_true',
        'args'                => array(
            'user_email'  => array(
                'validate_callback' => function ($param) {
                    return is_email($param);
                },
            ),
            'user_id'     => array(
                'validate_callback' => function ($param) {
                    return is_numeric($param);
                },
            ),
            'product_ids' => array(
                'validate_callback' => function ($param) {
                    return is_array($param);
                },
            ),
        ),
    ));

    register_rest_route('nab', '/request/customer-get-bought-products', array(
        'methods'             => 'GET',
        'callback'            => 'amplify_get_user_bought_product',
        'permission_callback' => '__return_true',
        'args'                => array(
            'user_email'  => array(
                'validate_callback' => function ($param) {
                    return is_email($param);
                },
            ),
            'user_id'     => array(
                'validate_callback' => function ($param) {
                    return is_numeric($param);
                },
            ),
            'product_ids' => array(
                'validate_callback' => function ($param) {
                    return is_array($param);
                },
            ),
        ),
    ));

    register_rest_route(
        'nab',
        '/unlink-products',
        array(
            'methods'  => 'POST',
            'callback' => 'nab_amplify_unlink_products',
        )
    );

    register_rest_route('nab', '/request/get-product-info', array(
        'methods'             => 'POST',
        'callback'            => 'amplify_get_product_info',
        'permission_callback' => '__return_true',
        'args'                => array(
            'product_id' => array(
                'validate_callback' => function ($param) {
                    return is_numeric($param);
                },
            ),
        ),
    ));

    register_rest_route('nab', '/request/get-header-logos', array(
        'methods'             => 'GET',
        'callback'            => 'amplify_get_header_logos',
        'permission_callback' => '__return_true',
    ));

    register_rest_route('nab', '/request/get-company-category', array(
        'methods'             => 'GET',
        'callback'            => 'nab_amplify_get_company_category',
        'permission_callback' => '__return_true',
    ));
}

/**
 * Get all company category
 *
 * @return WP_REST_Response
 */
function nab_amplify_get_company_category()
{

    $return = array();

    $terms = get_terms(array(
        'taxonomy'   => 'company-category',
        'hide_empty' => true,
    ));

    foreach ($terms as $term) {

        $return[] = array('slug' => $term->slug, 'name' => $term->name);
    }

    return new WP_REST_Response($return, 200);
}

/**
 * Call back for Flush Custom Data.
 *
 * @param WP_REST_Request $request
 *
 * @return bool Verified or not.
 */
function nab_amplify_unlink_products(WP_REST_Request $request)
{

    $parameters = $request->get_params();

    $current_post_id   = isset($parameters['current_post_id']) ? $parameters['current_post_id'] : '';
    $unlinked_products = isset($parameters['unlinked_products']) ? explode(',', $parameters['unlinked_products']) : '';
    $shop_blog_id      = isset($parameters['shop_blog_id']) ? (int) $parameters['shop_blog_id'] : '';
    $current_blog_id   = isset($parameters['current_blog_id']) ? (int) $parameters['current_blog_id'] : '';

    if (empty($current_post_id) || empty($unlinked_products) || empty($shop_blog_id) || empty($current_blog_id)) {
        return "Please pass necessary parameters.";
    }

    switch_to_blog($shop_blog_id);

    foreach ($unlinked_products as $product_id) {
        $associated_content = maybe_unserialize(get_post_meta($product_id, '_associated_content', true));
        if (isset($associated_content[$current_blog_id][$current_post_id])) {
            unset($associated_content[$current_blog_id][$current_post_id]);
        }

        update_post_meta($product_id, '_associated_content', $associated_content);
    }

    wp_reset_query();
    // Quit multisite connection
    restore_current_blog();

    return "unlinked successfully!";
}

/**
 * Get product category terms.
 *
 * @return WP_REST_Response
 *
 * @since 1.0.0
 */
function amplify_get_product_categories()
{

    $return = array();

    $terms = get_terms(array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
    ));

    foreach ($terms as $term) {

        $return[] = array('term_id' => $term->term_id, 'name' => $term->name);
    }

    return new WP_REST_Response($return, 200);
}

/**
 * Get all Product list.
 *
 * @param WP_REST_Request $request
 *
 * @return WP_REST_Response
 *
 * @since 1.0.0
 */
function amplify_get_product_list(WP_REST_Request $request)
{

    $term_id = $request->get_param('term_id');
    $return  = array();

    $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'product',
        'orderby'        => 'title',
        'fields'         => 'ids',
        'order'          => 'ASC',
    );

    if (!empty($term_id)) {

        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $term_id,
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {

        while ($query->have_posts()) {

            $query->the_post();

            $product_id   = get_the_ID();
            $product_name = html_entity_decode(get_the_title());

            $return[] = array('product_id' => $product_id, 'product_name' => $product_name);
        }
    }

    wp_reset_postdata();

    return new WP_REST_Response($return, 200);
}

/**
 * Check user bought product.
 *
 * @param WP_REST_Request $request
 *
 * @return WP_REST_Response
 *
 * @since 1.0.0
 */
function amplify_check_user_bought_product(WP_REST_Request $request)
{

    $user_email  = $request->get_param('user_email');
    $user_id     = $request->get_param('user_id');
    $product_ids = $request->get_param('product_ids');
    $return      = array('success' => false);

    if (is_array($product_ids) && !empty($user_email) && !empty($user_id)) {

        foreach ($product_ids as $product_id) {

            if (wc_customer_bought_product($user_email, $user_id, $product_id)) {

                $return['success'] = true;

                $purchased_product = get_user_meta($user_id, 'nab_purchased_product_2020', true);

                if (!empty($purchased_product) && is_array($purchased_product)) {

                    if (!in_array($product_id, $purchased_product)) {

                        $purchased_product[] = $product_id;

                        update_user_meta($user_id, 'nab_purchased_product_2020', $purchased_product);
                    }
                } else {

                    $purchased_product = array($product_id);

                    update_user_meta($user_id, 'nab_purchased_product_2020', $purchased_product);
                }

                break;
            }
        }

        if (!$return['success']) {
            $return['url']   = get_the_permalink($product_ids[0]);
            $return['title'] = get_the_title($product_ids[0]);
        }
    }

    return new WP_REST_Response($return, 200);
}

/**
 * Get IDs of bought products.
 *
 * @param WP_REST_Request $request
 *
 * @return WP_REST_Response
 *
 * @since 1.0.0
 */
function amplify_get_user_bought_product(WP_REST_Request $request)
{

    $user_email  = $request->get_param('user_email');
    $user_id     = $request->get_param('user_id');
    $product_ids = $request->get_param('product_ids');

    $actually_bought = array();

    if (is_array($product_ids) && !empty($user_email) && !empty($user_id)) {

        foreach ($product_ids as $product_id) {

            if (wc_customer_bought_product($user_email, $user_id, $product_id)) {
                $actually_bought[] = $product_id;
            }
        }
    }

    return new WP_REST_Response($actually_bought, 200);
}

/**
 * Creates JWT Token
 *
 * @param string $username
 * @param string $password
 *
 * @return void
 */
function nab_create_jwt_token($username, $password)
{
    nab_generate_jwt_token($username, $password);
}

/**
 * Get product info by product id.
 *
 * @param WP_REST_Request $request
 *
 * @return WP_REST_Response
 *
 * @since 1.0.0
 */
function amplify_get_product_info(WP_REST_Request $request)
{

    $product_id = $request->get_param('product_id');
    $return     = array();

    if (!empty($product_id)) {
        $return['url']   = get_the_permalink($product_id);
        $return['title'] = get_the_title($product_id);
    }

    return new WP_REST_Response($return, 200);
}

/**
 * Get coupon code form the url.
 */
function amplify_apply_coupon_code_from_url()
{

    if (is_admin()) {
        return;
    }

    $coupon_code = filter_input(INPUT_GET, 'promocode', FILTER_SANITIZE_STRING);

    // Exit if no code in URL or if the coupon code is already set cart session
    if (empty($coupon_code)) {
        return;
    }

    // Start WC session if not started
    if (isset(WC()->session) && !WC()->session->has_session()) {
        WC()->session->set_customer_session_cookie(true);
        amplify_add_coupon_product_to_cart($coupon_code, true);
    } else {
        amplify_add_coupon_product_to_cart($coupon_code, false);
    }
}

/**
 * Add coupon products to the cart and apply coupon. If coupon product not exist then set a cookie for coupon.
 *
 * @param string $coupon_code
 * @param boolean $force_start
 */
function amplify_add_coupon_product_to_cart($coupon_code, $force_start)
{

    if (!empty($coupon_code)) {

        // Sanitize coupon code
        $format_coupon_code = wc_format_coupon_code($coupon_code);

        // Get the coupon
        $the_coupon = new WC_Coupon($format_coupon_code);

        // Get coupon products
        $product_ids = $the_coupon->get_product_ids();

        if (!empty($product_ids)) {

            foreach ($product_ids as $product_id) {

                if (!amplify_is_product_in_cart($product_id)) {
                    WC()->cart->add_to_cart($product_id);
                }
            }
        }

        if (empty($product_ids) && WC()->cart->is_empty()) {
            setcookie('amp_wc_coupon', $coupon_code, (time() + 1209600), '/');
        } else {
            WC()->cart->add_discount($coupon_code);
        }
    }
}

/**
 * Check product is already in the cart.
 *
 * @param int $product_id
 *
 * @return boolean
 */
function amplify_is_product_in_cart($product_id)
{
    if (0 !== $product_id) {
        if (isset(WC()->cart->cart_contents) && is_array(WC()->cart->cart_contents)) {
            foreach (WC()->cart->cart_contents as $cart_item_key => $cart_item_data) {
                if (
                    (isset($cart_item_data['product_id']) && $product_id == $cart_item_data['product_id']) ||
                    (isset($cart_item_data['variation_id']) && $product_id == $cart_item_data['variation_id'])
                ) {
                    return true;
                }
            }
        }
    }

    return false;
}

/**
 * Apply coupon when add to cart if coupon cookie exist.
 */
function amplify_add_coupon_code_to_cart()
{

    $coupon_code = isset($_COOKIE['amp_wc_coupon']) && !empty($_COOKIE['amp_wc_coupon']) ? $_COOKIE['amp_wc_coupon'] : '';

    if (empty($coupon_code)) {
        return;
    }

    WC()->cart->add_discount($coupon_code);

    unset($_COOKIE['amp_wc_coupon']);
    setcookie('amp_wc_coupon', null, -1, '/');
}

/**
 * Remove product from cocart session cart if removed from main cart
 *
 * @param string $cart_item_key
 * @param object $instance
 *
 * @return void
 */
function nab_remove_cocart_item($cart_item_key, $instance)
{

    if (isset($_COOKIE['nabCartKey']) && !empty($_COOKIE['nabCartKey']) && !is_user_logged_in()) {
        $cart_key = $_COOKIE['nabCartKey'];

        $args = array(
            'headers' => array(
                'Content-Type' => 'application/json; charset=utf-8',
            ),
            'body'    => wp_json_encode([
                'cart_item_key' => $cart_item_key,
            ]),
            'method'  => 'DELETE',
        );

        $api_url  = add_query_arg('cart_key', $cart_key, home_url() . '/wp-json/cocart/v1/item/');
        $response = wp_remote_request($api_url, $args);
    }
}

/**
 * Load cart from cocart session cart
 *
 * @return void
 */
function nab_load_cart_action_cookie()
{

    // If cookie is not present then just return
    if (!isset($_COOKIE['nabCartKey']) || is_user_logged_in()) {
        return;
    }

    $cart_key      = trim(wp_unslash($_COOKIE['nabCartKey']));
    $override_cart = false; // Override the cart by default.

    // wc_nocache_headers();

    // Get the cart in the database.
    $stored_cart = nab_cocart_get_cart($cart_key);

    if (empty($stored_cart)) {
        return;
    }

    // Get the cart currently in session if any.
    $cart_in_session = WC()->session->get('cart', null);

    if (empty($cart_in_session)) {
        $cart_in_session = [];
    }

    $new_cart = array();

    $new_cart['cart']                       = maybe_unserialize($stored_cart['cart']);
    $new_cart['applied_coupons']            = maybe_unserialize($stored_cart['applied_coupons']);
    $new_cart['coupon_discount_totals']     = maybe_unserialize($stored_cart['coupon_discount_totals']);
    $new_cart['coupon_discount_tax_totals'] = maybe_unserialize($stored_cart['coupon_discount_tax_totals']);
    $new_cart['removed_cart_contents']      = maybe_unserialize($stored_cart['removed_cart_contents']);

    // Check if we are overriding the cart currently in session via the web.
    if ($override_cart) {
        // Only clear the cart if it's not already empty.
        if (!WC()->cart->is_empty()) {
            WC()->cart->empty_cart(false);

            do_action('cocart_load_cart_override', $new_cart, $stored_cart);
        }
    } else {
        $new_cart_content = array_merge($new_cart['cart'], $cart_in_session);
        $new_cart['cart'] = apply_filters('cocart_merge_cart_content', $new_cart_content, $new_cart['cart'], $cart_in_session);

        $new_cart['applied_coupons']            = array_merge($new_cart['applied_coupons'], WC()->cart->get_applied_coupons());
        $new_cart['coupon_discount_totals']     = array_merge($new_cart['coupon_discount_totals'], WC()->cart->get_coupon_discount_totals());
        $new_cart['coupon_discount_tax_totals'] = array_merge($new_cart['coupon_discount_tax_totals'], WC()->cart->get_coupon_discount_tax_totals());
        $new_cart['removed_cart_contents']      = array_merge($new_cart['removed_cart_contents'], WC()->cart->get_removed_cart_contents());

        do_action('cocart_load_cart', $new_cart, $stored_cart, $cart_in_session);
    }

    // Sets the php session data for the loaded cart.
    WC()->session->set('cart', $new_cart['cart']);
    WC()->session->set('applied_coupons', $new_cart['applied_coupons']);
    WC()->session->set('coupon_discount_totals', $new_cart['coupon_discount_totals']);
    WC()->session->set('coupon_discount_tax_totals', $new_cart['coupon_discount_tax_totals']);
    WC()->session->set('removed_cart_contents', $new_cart['removed_cart_contents']);
}

/**
 * NAB Remove custom cocart cookie
 *
 * @return void
 */
function nab_maybe_clear_cart_cookie()
{

    if (isset($_COOKIE['nabCartKey']) && !empty($_COOKIE['nabCartKey'])) {
        unset($_COOKIE['nabCartKey']);
        setcookie('nabCartKey', '', time() - 3600, '/', NAB_AMPLIFY_COOKIE_BASE_DOMAIN);
    }
}

/**
 * Get All orders IDs for a given product ID.
 *
 * @param int $product_id
 * @param string $product_year
 *
 * @return array
 */
function nab_get_orders_ids_by_product_id($product_id, $product_year)
{

    global $wpdb;

    $results = $wpdb->get_col("
        SELECT order_items.order_id
        FROM {$wpdb->prefix}woocommerce_order_items as order_items
        LEFT JOIN {$wpdb->prefix}woocommerce_order_itemmeta as order_item_meta ON order_items.order_item_id = order_item_meta.order_item_id
        LEFT JOIN {$wpdb->posts} AS posts ON order_items.order_id = posts.ID
        WHERE posts.post_type = 'shop_order'
		AND posts.post_status = 'wc-completed'
		AND DATE_FORMAT(posts.post_date_gmt, '%Y') = '$product_year'
        AND order_items.order_item_type = 'line_item'
        AND order_item_meta.meta_key = '_product_id'
		AND order_item_meta.meta_value = '$product_id'
		ORDER BY posts.post_date_gmt DESC
    ");

    return $results;
}

/**
 * Add export custom list CSV metabox in the product post type.
 */
function nab_add_custom_metabox_in_product()
{

    add_meta_box(
        'product_customer_export',
        'Customer who bought this product',
        'nab_product_customer_metabox_callback',
        'product',
        'side'
    );
}

/**
 * Display export current product custom metabox.
 *
 * @param mixed $post
 *
 */
function nab_product_customer_metabox_callback($post)
{

    $current_year  = date('Y');
    $starting_year = 2019;

?>
    <div class="export-list-wrapper">
        <form method="POST" name="product_customer">
            <div class="year-box">
                <label for="product-year" style="padding-right: 10px;">Select Year</label>
                <select id="product-year" name="product_year" class="product-year" style="padding-left: 16px;padding-right: 30px;">
                    <?php
                    for ($i = $starting_year; $i <= $current_year; $i++) {
                    ?>
                        <option value="<?php echo esc_attr($i); ?>" <?php selected($current_year, $i); ?>><?php echo esc_html($i); ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <input type="hidden" name="product_id" value="<?php echo esc_attr($post->ID); ?>" />
            <div class="submit-btn" style="text-align: center;margin-top: 10px;width: 92%;">
                <input type="submit" name="export_csv" value="Export CSV" class="button" />
            </div>
        </form>
    </div>
    <?php
}

/**
 * Generate CSV file.
 */
add_action('admin_init', function () {

    $export_csv = filter_input(INPUT_POST, 'export_csv', FILTER_SANITIZE_STRING);

    // Checking user clicked on export csv button
    if (isset($export_csv) && !empty($export_csv)) {

        $product_year = filter_input(INPUT_POST, 'product_year', FILTER_SANITIZE_STRING);
        $product_id   = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);

        if (!empty($product_id)) {

            $product_year = empty($product_year) ? date('Y') : $product_year;

            // Get all order id for current product from the database
            $all_order_ids = nab_get_orders_ids_by_product_id($product_id, $product_year);

            if (is_array($all_order_ids) && count($all_order_ids) > 0) {

                // Unique id array
                $all_order_ids = array_unique($all_order_ids);

                // CSV header row fields titles
                $csv_fields   = array();
                $csv_fields[] = 'Order ID';
                $csv_fields[] = 'Date';
                $csv_fields[] = 'First Name';
                $csv_fields[] = 'Last Name';
                $csv_fields[] = 'Email Address';
                $csv_fields[] = 'Company';
                $csv_fields[] = 'Title';
                $csv_fields[] = 'Total';
                $csv_fields[] = 'Quantity';
                $csv_fields[] = 'Coupon';
                $csv_fields[] = 'Community';
                $csv_fields[] = 'Opt in for Partner';
                $csv_fields[] = 'Opt in for Exhibitor/Sponsor';
                $csv_fields[] = 'Networking';
                $csv_fields[] = 'Discover';

                // Generate csv file as a direct download
                $output_filename = $product_year . '-customer-list-for-product-' . $product_id . '.csv';
                $output_handle   = fopen('php://output', 'w');

                header('Content-type: application/csv');
                header('Content-Disposition: attachment; filename=' . $output_filename);

                // Insert header row
                fputcsv($output_handle, $csv_fields);

                // Loop through all the order
                foreach ($all_order_ids as $order_id) {

                    $dynamic_fields = array();

                    // Get WC order
                    $order = wc_get_order($order_id);

                    // Customer info
                    $order_user_details = $order->get_user();

                    $customer_id        = $order_user_details->data->ID;
                    $customer_email     = $order_user_details->data->user_email;
                    $customer_company   = get_user_meta($customer_id, 'attendee_company', true);
                    $customer_title     = get_user_meta($customer_id, 'attendee_title', true);
                    $customer_interest  = get_user_meta($customer_id, 'attendee_interest', true);
                    $customer_interest1 = get_user_meta($customer_id, 'attendee_other_interest', true);
                    $opt_partner        = get_user_meta($customer_id, 'attendee_partner_opt_in', true);
                    $opt_exhibitor      = get_user_meta($customer_id, 'attendee_exhibition_sponsors_opt_in', true);
                    $customer_meet      = get_user_meta($customer_id, 'attendee_meet', true);
                    $customer_discover  = get_user_meta($customer_id, 'attendee_discover', true);
                    $first_name         = get_user_meta($customer_id, 'first_name', true);
                    $last_name          = get_user_meta($customer_id, 'last_name', true);

                    if (empty($first_name) && empty($last_name)) {
                        $first_name = $order_user_details->data->display_name;
                    }

                    $final_interest = '';

                    if (is_array($customer_interest) && count($customer_interest) > 0) {
                        $final_interest = implode(', ', $customer_interest);
                    }

                    if (!empty($customer_interest1)) {
                        $final_interest .= $customer_interest1;
                    }

                    $customer_meet     = is_array($customer_meet) && count($customer_meet) > 0 ? implode(', ', $customer_meet) : '-';
                    $customer_discover = is_array($customer_discover) && count($customer_discover) > 0 ? implode(', ', $customer_discover) : '-';

                    // Order info
                    $order_date = $order->get_date_created()->date('Y-m-d');
                    $coupons    = $order->get_coupon_codes();
                    $total      = $order->get_total();
                    $qty        = 0;

                    foreach ($order->get_items() as $item) {

                        if ($item->get_product_id() == $product_id) {
                            $qty = $item->get_quantity();
                        }
                    }

                    if (is_array($coupons) && count($coupons) > 0) {
                        $coupons = implode(',', $coupons);
                    } else {
                        $coupons = '-';
                    }

                    //Add csv fields row
                    $dynamic_fields[] = $order_id;
                    $dynamic_fields[] = $order_date;
                    $dynamic_fields[] = $first_name;
                    $dynamic_fields[] = !empty($last_name) ? $last_name : '-';
                    $dynamic_fields[] = $customer_email;
                    $dynamic_fields[] = !empty($customer_company) ? $customer_company : '-';
                    $dynamic_fields[] = !empty($customer_title) ? $customer_title : '-';
                    $dynamic_fields[] = $total;
                    $dynamic_fields[] = $qty;
                    $dynamic_fields[] = $coupons;
                    $dynamic_fields[] = !empty($final_interest) ? $final_interest : '-';
                    $dynamic_fields[] = !empty($opt_partner) ? $opt_partner : '-';
                    $dynamic_fields[] = !empty($opt_exhibitor) ? $opt_exhibitor : '-';
                    $dynamic_fields[] = $customer_meet;
                    $dynamic_fields[] = $customer_discover;

                    fputcsv($output_handle, $dynamic_fields);
                }

                exit;
            }
        }
    }
});

/**
 * Get All header logos
 *
 * @param WP_REST_Request $request
 *
 * @return array
 */
function amplify_get_header_logos(WP_REST_Request $request)
{

    $response = [];

    if (have_rows('nab_logos', 'option')) :
        while (have_rows('nab_logos', 'option')) : the_row();
            $logos          = [];
            $nab_logo_id    = get_sub_field('logos');
            $nab_logo_img   = wp_get_attachment_image_src($nab_logo_id, 'medium');
            $nab_logo_url   = get_sub_field('logo_url');
            $logos['url']   = (isset($nab_logo_url) && !empty($nab_logo_url)) ? $nab_logo_url : '#';
            $logos['image'] = (isset($nab_logo_img) && !empty($nab_logo_img)) ? $nab_logo_img[0] : '';
            array_push($response, $logos);
        endwhile;
    endif;

    return new WP_REST_Response($response, 200);
}

/**
 * Show the customer display name in the customer column.
 *
 * @param $column
 * @param $post_id
 */
function nab_customer_column_data($column, $post_id)
{

    switch ($column) {
        case 'customer':

            // Get WC order
            $order = wc_get_order($post_id);

            if (!empty($order)) {

                $order_user_details = $order->get_user();

                $customer_id   = $order_user_details->data->ID;
                $customer_name = $order_user_details->data->display_name;

                $profile_url = get_edit_user_link($customer_id);
    ?>
                <a href="<?php echo esc_url($profile_url); ?>"><?php echo esc_html($customer_name); ?></a>
            <?php
            } else {
            ?>
                <span aria-hidden="true">—</span>
        <?php
            }
            break;
    }
}

/**
 * Add new column company in the user list table.
 *
 * @param $columns
 *
 * @return array
 *
 */
function nab_add_user_company_column($columns)
{

    $manage_columns = array();

    foreach ($columns as $key => $value) {

        if ('email' === $key) {

            $manage_columns[$key]      = $value;
            $manage_columns['company'] = 'Company';
        }

        $manage_columns[$key] = $value;
    }

    return $manage_columns;
}

/**
 * Display user company name in the custom column.
 *
 * @param string $value
 * @param string $column_name
 * @param int $user_id
 *
 * @return string
 */
function nab_user_company_column_data($value, $column_name, $user_id)
{

    if ('company' === $column_name) {

        $company = get_user_meta($user_id, 'attendee_company', true);

        if (!empty($company)) {
            return $company;
        } else {
            return '-';
        }
    }

    return $value;
}

/**
 * Added addition user filter in the user table list.
 *
 * @param string $which
 */
function nab_add_additional_filter_for_user_list($which)
{

    if ('top' === $which) {

        $option_items = array(
            'company' => 'Company',
            'name'    => 'Name',
        );
        ?>
        <select name="user_filter">
            <option value="">Additional Filter</option>
            <?php

            $user_filter = filter_input(INPUT_GET, 'user_filter', FILTER_SANITIZE_STRING);
            $current_v   = isset($user_filter) ? $user_filter : '';

            foreach ($option_items as $key => $value) {
            ?>
                <option value="<?php echo esc_attr($key); ?>" <?php selected($current_v, $key); ?>><?php echo esc_html($value); ?></option>
            <?php
            }
            ?>
        </select>
    <?php
    }
}

/**
 * Modify user search query based on user filter selected
 *
 * @param mixed $query
 */
function nab_modify_user_search_query($query)
{

    global $pagenow;

    if (is_admin() && 'users.php' === $pagenow) {

        $user_filter = filter_input(INPUT_GET, 'user_filter', FILTER_SANITIZE_STRING);
        $search_item = filter_input(INPUT_GET, 's', FILTER_SANITIZE_STRING);

        if ((isset($user_filter) && !empty($user_filter)) && (isset($search_item) && !empty($search_item))) {

            global $wpdb;

            if ('company' === $user_filter || 'name' === $user_filter) {

                $field = '';

                if ('name' === $user_filter) {

                    $field       = 'first_name';
                    $search_item = trim($search_item, ' ');

                    $search_item_array = explode(' ', $search_item);

                    if (is_array($search_item_array) && count($search_item_array) > 0) {

                        $search_item = $search_item_array[0];
                    }
                } else {

                    $field = 'attendee_company';
                }

                // let's search by users company
                $query->query_from .= " AND wp_usermeta.meta_key = '{$field}'";

                // what fields to include in the search
                $search_by = array('wp_usermeta.meta_value');

                // apply to the query
                $query->query_where = 'WHERE 1=1' . $query->get_search_sql($search_item, $search_by, 'both');
            }
        }
    }
}

/**
 * Added inline style to fixed ACF media upload modal text overlapping issue.
 */
function nab_add_inline_style_for_acf_upload_popup()
{

    wp_add_inline_style('acf-input', '.acf-media-modal .media-modal-content .media-frame .media-toolbar-secondary select.attachment-filters{margin-top:32px;}');
}

/**
 * Register event shows post type
 */
function nab_register_event_shows_post_type()
{

    $labels = array(
        'name'               => _x('Shows', 'post type general name', 'nab-amplify'),
        'singular_name'      => _x('Shows', 'post type singular name', 'nab-amplify'),
        'add_new_item'       => __('Add New', 'nab-amplify'),
        'edit_item'          => __('Edit', 'nab-amplify'),
        'new_item'           => __('New', 'nab-amplify'),
        'view_item'          => __('View', 'nab-amplify'),
        'search_items'       => __('Search', 'nab-amplify'),
        'not_found'          => __('No show found.', 'nab-amplify'),
        'not_found_in_trash' => __('No show found in Trash.', 'nab-amplify'),
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => false,
        'exclude_from_search' => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => false,
        'query_var'           => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => null,
        'supports'            => array(
            'title',
            'author',
            'thumbnail',
            'custom-fields',
        ),
    );

    register_post_type('event-shows', $args);
}

/**
 * Setting User Login cookie for other sites.
 *
 * @param $user_login
 * @param object $user User data.
 */
function nab_set_user_login_cookie_for_other_site($user_login, $user)
{

    $user_token = nab_encrypt_user_token($user->ID);

    if (!empty($user_token)) {

        setcookie('nab_share_login', $user_token, time() + 3600, '/', '.nabshow.com');
    }
}

/**
 * Encrypt user token.
 *
 * @param int $user_id User ID.
 *
 * @return string
 */
function nab_encrypt_user_token($user_id)
{

    $iv = substr(hash('sha256', 'nab309fr7uj34'), 0, 16);

    $k = hash('sha256', 'nabjd874hey64t');

    return base64_encode(openssl_encrypt($user_id, 'AES-256-CBC', $k, 0, $iv));
}

/**
 * Clear User Login cookie.
 */
function nab_clear_share_login_cookie()
{

    unset($_COOKIE['nab_share_login']);
    setcookie('nab_share_login', null, -1, '/', '.nabshow.com');
}

/**
 * Update purchased product in the user meta when order status change.
 *
 * @param int $order_id
 * @param string $old_status
 * @param string $new_status
 */
function nab_update_product_in_user_meta($order_id, $old_status, $new_status)
{

    $order = wc_get_order($order_id);

    $order_user_details = $order->get_user();
    $customer_id        = $order_user_details->data->ID;

    if (!empty($customer_id)) {

        $order_products = array();

        $purchased_product = get_user_meta($customer_id, 'nab_purchased_product_2020', true);

        // Get order products
        foreach ($order->get_items() as $item_id => $product_item) {

            $order_products[] = $product_item->get_product_id();
        }

        // Add product id to user meta when order completed
        if ('completed' === $new_status) {

            // Add or merge user purchased product ids
            if (!empty($purchased_product) && is_array($purchased_product)) {

                $purchased_product = array_unique(array_merge($purchased_product, $order_products));
            } else {

                $purchased_product = $order_products;
            }

            update_user_meta($customer_id, 'nab_purchased_product_2020', $purchased_product);
        }

        // Remove product id from user meta if order status changed from completed to any other status.
        if ('completed' === $old_status) {

            if (!empty($purchased_product) && is_array($purchased_product)) {

                $customer_orders = wc_get_orders(array(
                    'customer_id' => $customer_id,
                    'status'      => 'completed',
                    'limit'       => -1,
                ));

                $customer_products = [];
                if (!empty($customer_orders)) {
                    foreach ($customer_orders as $customer_order) {
                        foreach ($customer_order->get_items() as $product_item) {
                            $customer_products[] = $product_item->get_product_id();
                        }
                    }
                }

                foreach ($order_products as $product_id) {

                    if (($key = array_search($product_id, $purchased_product)) !== false) {

                        // Before removing check if user has purchased this product in any other order
                        if (!in_array($product_id, $customer_products)) {
                            unset($purchased_product[$key]);
                        }
                    }
                }

                update_user_meta($customer_id, 'nab_purchased_product_2020', $purchased_product);
            }
        }
    }
}

/**
 * WC edit account additional security form field for BP member.
 */
function nab_edit_acount_additional_form_fields()
{

    $current_user           = wp_get_current_user();
    $current_user_id        = $current_user->ID;
    $member_visibility      = get_user_meta($current_user_id, 'nab_member_visibility', true);
    $member_restriction     = get_user_meta($current_user_id, 'nab_member_restrict_connection', true);
    $attendee_title         = get_user_meta($current_user_id, 'attendee_title', true);
    $attendee_company       = get_user_meta($current_user_id, 'attendee_company', true);
    $social_twitter         = get_user_meta($current_user_id, 'social_twitter', true);
    $social_linkedin        = get_user_meta($current_user_id, 'social_linkedin', true);
    $social_facebook        = get_user_meta($current_user_id, 'social_facebook', true);
    $social_instagram       = get_user_meta($current_user_id, 'social_instagram', true);
    $social_website         = get_user_meta($current_user_id, 'social_website', true);
    $social_youtube         = get_user_meta($current_user_id, 'social_youtube', true);
    $user_interest          = get_user_meta($current_user_id, 'user_interest', true);
    $user_job_role          = get_user_meta($current_user_id, 'user_job_role', true);
    $user_industry          = get_user_meta($current_user_id, 'user_industry', true);
    $user_country           = get_user_meta($current_user_id, 'user_country', true);
    $user_state             = get_user_meta($current_user_id, 'user_state', true);
    $user_city              = get_user_meta($current_user_id, 'user_city', true);

    $member_visibility  = !empty($member_visibility) ? $member_visibility : 'yes';
    $member_restriction = !empty($member_restriction) ? $member_restriction : 'yes';
    $user_interest      = !empty($user_interest) ? $user_interest : array();
    $interest_items        = array('Content Creation', 'Live Event Production', 'Broadcast', 'Streaming');
    $job_roles            = array('Executive', 'Management', 'Creative', 'Technical', 'Student');
    $user_job_role      = !empty($user_job_role) ? $user_job_role : array();
    $user_industry      = !empty($user_industry) ? $user_industry : array();
    $industries         = array(
        'Advertising/Marketing/PR',
        'Analytics & Research',
        'Cable/MSO',
        'Consulting',
        'Education/Training',
        'Enterprise',
        'Faith-Based Organization',
        'Film/TV Studio',
        'Finance (Banking, Service, Insurance)',
        'Government',
        'Healthcare/Medical',
        'IT Services',
        'Legal',
        'Manufacturer/Supplier',
        'Non-Profit/Union/Guild',
        'Performing Arts/Music/Live Entertainment',
        'Podcasting (new: will need a new pick code assigned)',
        'Production Services/Facilities (Audio & Video)',
        'Post-Production Services/Facilities (Audio & Video)',
        'Programming Network',
        'Radio (Broadcast)',
        'Rental Equipment/Rental House',
        'Research & Development',
        'Software Development',
        'Sports & Fitness',
        'Streaming Video/OTT',
        'Systems Integrator/Installation/VAR',
        'Telecom/Satellite/Utilities',
        'Television (Broadcast)',
        'Travel & Hospitality',
        'Venture Capitalist/Private Equity/Investment',
        'Venues (Entertainment/Arenas/Stadiums)',
        'Other'
    );

    ?>
    <div class="nab-profile">
        <div class="nab-section section-nab-profile">
            <div class="nab-profile-body flex-row">
                <div class="nab-section section-user-interest">
                    <h3>I'm Interested In...</h3>
                    <div class="user-interest-details-form">
                        <div class="checkbox-item-list">
                            <?php
                            foreach ($interest_items as $item) {

                                $current_item = '';

                                if (is_array($user_interest) && in_array($item, $user_interest, true)) {
                                    $current_item = $item;
                                }
                            ?>
                                <div class="checkbox-item amp-check-container">
                                    <div class="amp-check-wrp">
                                        <input type="checkbox" name="user_interest[]" value="<?php echo esc_attr($item); ?>" id="<?php echo esc_attr($item); ?>" <?php checked($current_item, $item); ?> />
                                        <span class="amp-check"></span>
                                    </div>
                                    <label for="<?php echo esc_attr($item); ?>"><?php echo esc_html($item); ?></label>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="nab-section section-professional-details">
                    <h3>Professional Details</h3>
                    <div class="professional-details-form">
                        <div class="nab-form-row">
                            <label for="attendee_title">Title</label>
                            <input type="text" name="attendee_title" class="input-text" placeholder="Title" value="<?php echo esc_attr($attendee_title); ?>" />
                        </div>
                        <div class="nab-form-row">
                            <label for="attendee_company">Company</label>
                            <input type="text" name="attendee_company" class="input-text" placeholder="Company" value="<?php echo esc_attr($attendee_company); ?>" />
                        </div>
                        <?php
                        $countries_obj  = new WC_Countries();
                        $countries      = $countries_obj->__get('countries');
                        ?>
                        <div class="nab-form-row user-country">
                            <label for="user-country-select">Country</label>
                            <?php
                            if (is_array($countries)) {
                            ?>
                                <div class="select-dark-simple">
                                    <select name="user_country" class="user-country-select" id="user-country-select">
                                        <option value="">Select a country</option>
                                        <?php
                                        foreach ($countries as $abbr => $country) {
                                        ?>
                                            <option value="<?php echo esc_attr($abbr); ?>" <?php selected($abbr, $user_country); ?>><?php echo esc_html($country); ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="nab-form-row user-state">
                            <label for="user-state-select">State</label>
                            <?php
                            $default_country        = !empty($user_country) ? $user_country : $countries_obj->get_base_country();
                            $default_county_states  = $countries_obj->get_states($default_country);

                            if (is_array($default_county_states)) {
                            ?>
                                <div class="select-dark-simple">
                                    <select name="user_state" class="user-state-select" id="user-state-select">
                                        <option value="">Select a state</option>
                                        <?php
                                        foreach ($default_county_states as $abbr => $state) {
                                        ?>
                                            <option value="<?php echo esc_attr($abbr); ?>" <?php selected($abbr, $user_state); ?>><?php echo esc_html($state); ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="nab-form-row">
                            <label for="user-city">City</label>
                            <input type="text" name="user_city" class="input-text" value="<?php echo esc_attr($user_city); ?>" />
                        </div>
                        <div class="nab-form-row user-job-role">
                            <label for="user-job-role-select">Job Role</label>
                            <div class="select-dark-simple">
                                <select name="user_job_role[]" class="user-job-role-select" id="user-job-role-select" multiple>
                                    <?php
                                    foreach ($job_roles as $role) {

                                        $current_item = '';

                                        if (is_array($user_job_role) && in_array($role, $user_job_role, true)) {
                                            $current_item = $role;
                                        }
                                    ?>
                                        <option value="<?php echo esc_attr($role); ?>" <?php selected($current_item, $role); ?>><?php echo esc_html($role); ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="nab-form-row user-industry">
                            <label for="user-industry-select">Industry</label>
                            <div class="select-dark-simple">
                                <select name="user_industry[]" class="user-industry-select" id="user-industry-select" multiple>
                                    <?php
                                    foreach ($industries as $industry) {

                                        $current_item = '';

                                        if (is_array($user_industry) && in_array($industry, $user_industry, true)) {
                                            $current_item = $industry;
                                        }
                                    ?>
                                        <option value="<?php echo esc_attr($industry); ?>" <?php selected($current_item, $industry); ?>><?php echo esc_html($industry); ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nab-section section-social-links">
                    <h3>Social Links</h3>
                    <div class="social-links-form">
                        <div class="nab-form-row">
                            <div class="social-icon">
                                <i class="fa fa-twitter"></i>
                            </div>
                            <div class="social-input">
                                <input type="text" class="input-text" name="social_twitter" placeholder="Twitter" value="<?php echo esc_attr($social_twitter); ?>">
                            </div>
                        </div>
                        <div class="nab-form-row">
                            <div class="social-icon">
                                <i class="fa fa-linkedin"></i>
                            </div>
                            <div class="social-input">
                                <input type="text" class="input-text" name="social_linkedin" placeholder="LinkedIn" value="<?php echo esc_attr($social_linkedin); ?>">
                            </div>
                        </div>
                        <div class="nab-form-row">
                            <div class="social-icon">
                                <i class="fa fa-facebook-square"></i>
                            </div>
                            <div class="social-input">
                                <input type="text" class="input-text" name="social_facebook" placeholder="Facebook" value="<?php echo esc_attr($social_facebook); ?>">
                            </div>
                        </div>
                        <div class="nab-form-row">
                            <div class="social-icon">
                                <i class="fa fa-instagram"></i>
                            </div>
                            <div class="social-input">
                                <input type="text" class="input-text" name="social_instagram" placeholder="Instagram" value="<?php echo esc_attr($social_instagram); ?>">
                            </div>
                        </div>
                        <div class="nab-form-row">
                            <div class="social-icon">
                                <i class="fa fa-link"></i>
                            </div>
                            <div class="social-input">
                                <input type="text" class="input-text" name="social_website" placeholder="Website" value="<?php echo esc_attr($social_website); ?>">
                            </div>
                        </div>
                        <div class="nab-form-row">
                            <div class="social-icon">
                                <i class="fa fa-youtube"></i>
                            </div>
                            <div class="social-input">
                                <input type="text" class="input-text" name="social_youtube" placeholder="Youtube" value="<?php echo esc_attr($social_youtube); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <fieldset>
        <legend>Security Settings</legend>
        <div class="amp-member-security">
            <div class="amp-security-row security-column-first">
                <h3>Profile Visibility Preferences</h3>
                <div class="amp-radio-container">
                    <div class="amp-radio-wrp">
                        <input type="radio" name="member_visibility" value="yes" id="member_visible_anyone" <?php checked($member_visibility, 'yes'); ?> />
                        <span class="amp-radio"></span>
                    </div>
                    <label for="member_visible_anyone">Visible to anyone</label>
                </div>
                <div class="amp-radio-container">
                    <div class="amp-radio-wrp">
                        <input type="radio" name="member_visibility" value="no" id="member_visible_friend" <?php checked($member_visibility, 'no'); ?> />
                        <span class="amp-radio"></span>
                    </div>
                    <label for="member_visible_friend">Visible to approved connections only</label>
                </div>
            </div>
            <div class="amp-security-row security-column-last">
                <h3>Connection Preferences</h3>
                <div class="amp-radio-container">
                    <div class="amp-radio-wrp">
                        <input type="radio" name="member_restrict_connection" value="yes" id="member_anyone_request" <?php checked($member_restriction, 'yes'); ?> />
                        <span class="amp-radio"></span>
                    </div>
                    <label for="member_anyone_request">Anyone can request to connect</label>
                </div>
                <div class="amp-radio-container">
                    <div class="amp-radio-wrp">
                        <input type="radio" name="member_restrict_connection" value="no" id="member_not_available" <?php checked($member_restriction, 'no'); ?> />
                        <span class="amp-radio"></span>
                    </div>
                    <label for="member_not_available">I am not available to connect with other users</label>
                </div>
            </div>
        </div>
    </fieldset>
<?php
}

/**
 * Save edit account additional security form field for BP member.
 *
 * @param int $user_id
 */
function nab_save_edit_account_additional_form_fields($user_id)
{

    $member_visibility  = filter_input(INPUT_POST, 'member_visibility', FILTER_SANITIZE_STRING);
    $member_restriction = filter_input(INPUT_POST, 'member_restrict_connection', FILTER_SANITIZE_STRING);
    $user_interest      = filter_input(INPUT_POST, 'user_interest', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
    $user_job_role      = filter_input(INPUT_POST, 'user_job_role', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
    $user_industry      = filter_input(INPUT_POST, 'user_industry', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);

    if (isset($member_visibility) && !empty($member_visibility)) {
        update_user_meta($user_id, 'nab_member_visibility', $member_visibility);
    }

    if (isset($member_restriction) && !empty($member_restriction)) {
        update_user_meta($user_id, 'nab_member_restrict_connection', $member_restriction);
    }

    if (isset($user_interest) && !empty($user_interest)) {
        update_user_meta($user_id, 'user_interest', $user_interest);
    } else {
        delete_user_meta($user_id, 'user_interest');
    }

    if (isset($user_job_role) && !empty($user_job_role)) {
        update_user_meta($user_id, 'user_job_role', $user_job_role);
    } else {
        delete_user_meta($user_id, 'user_job_role');
    }

    if (isset($user_industry) && !empty($user_industry)) {
        update_user_meta($user_id, 'user_industry', $user_industry);
    } else {
        delete_user_meta($user_id, 'user_industry');
    }

    $user_fields = array(
        'attendee_title',
        'attendee_company',
        'social_twitter',
        'social_linkedin',
        'social_facebook',
        'social_instagram',
        'social_website',
        'social_youtube',
        'user_country',
        'user_state',
        'user_city'
    );

    foreach ($user_fields as $field) {

        $field_val = filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING);

        if (isset($field_val)) {

            update_user_meta($user_id, $field, $field_val);
        }
    }

    update_user_meta($user_id, 'profile_update_two', '1');
}

/**
 * Redirect user to edit account page after save the address or account.
 */
function nab_woocommerce_customer_save_changes_redirect()
{

    wp_safe_redirect(wc_get_account_endpoint_url('edit-account'));

    exit;
}

/**
 * Added search settings submenu page.
 */
function nab_amplify_search_settings()
{

    add_submenu_page(
        'options-general.php',
        __('Search Settings', 'nab-amplify'),
        __('Search Settings', 'nab-amplify'),
        'manage_options',
        'amplify_search_settings',
        'nab_search_settings_callback'
    );
}

/**
 * Search setting page fields.
 */
function nab_search_settings_callback()
{

    $display_horizontal_banner = filter_input(INPUT_POST, 'display_horizontal_banner', FILTER_SANITIZE_STRING);

    if (isset($display_horizontal_banner) && !empty($display_horizontal_banner)) {

        update_option('search_display_horizontal_banner', $display_horizontal_banner);
    } else {

        $display_horizontal_banner = get_option('search_display_horizontal_banner', 'yes');
    }



    if (isset($_POST['search_horizontal_banner'])) {

        $search_horizontal_banner = wp_kses_post($_POST['search_horizontal_banner']);

        update_option('search_horizontal_banner', $search_horizontal_banner);
    }
?>
    <div class="search-settings">
        <h2>Search Settings</h2>
        <form class="search-settings-form" method="post">
            <table class="form-table" role="presentation">
                <tr>
                    <th>Display Ad:</th>
                    <td>
                        <input id="display_horizontal_banner_yes" type="radio" value="yes" name="display_horizontal_banner" <?php checked($display_horizontal_banner, 'yes'); ?> />
                        <label for="display_horizontal_banner_yes">Yes</label>
                        <input id="display_horizontal_banner_no" type="radio" value="no" name="display_horizontal_banner" <?php checked($display_horizontal_banner, 'no'); ?> />
                        <label for="display_horizontal_banner_no">No</label>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label>Ad html:</label>
                    </th>
                    <td>
                        <?php
                        $search_horizontal_banner = get_option('search_horizontal_banner');
                        wp_editor($search_horizontal_banner, 'search_horizontal_banner', array('tinymce' => false));
                        ?>
                    </td>
                </tr>
            </table>
            <?php submit_button("Save Changes"); ?>
        </form>
    </div>
    <?php
}

/**
 * Register Company Custom Post Type.
 */
function nab_register_company_post_type()
{

    $labels = array(
        'name'               => _x('Companies', 'post type general name', 'nab-amplify'),
        'singular_name'      => _x('Companies', 'post type singular name', 'nab-amplify'),
        'add_new_item'       => __('Add New', 'nab-amplify'),
        'edit_item'          => __('Edit', 'nab-amplify'),
        'new_item'           => __('New', 'nab-amplify'),
        'view_item'          => __('View', 'nab-amplify'),
        'search_items'       => __('Search', 'nab-amplify'),
        'not_found'          => __('No company found.', 'nab-amplify'),
        'not_found_in_trash' => __('No company found in Trash.', 'nab-amplify'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'custom-fields',
        ),
    );

    register_post_type('company', $args);
}

/**
 * Register landing page post type.
 */
function nab_register_landing_page_post_type()
{

    $labels = array(
        'name'                  => _x('Landing Pages', 'Post Type General Name', 'nab-amplify'),
        'singular_name'         => _x('Landing page', 'Post Type Singular Name', 'nab-amplify'),
        'menu_name'             => __('Landing Pages', 'nab-amplify'),
        'name_admin_bar'        => __('Landing Pages', 'nab-amplify'),
        'parent_item_colon'     => __('Parent Landing Page:', 'nab-amplify'),
        'all_items'             => __('All Landing Pages', 'nab-amplify'),
        'add_new_item'          => __('Add New Landing Page', 'nab-amplify'),
        'add_new'               => __('Add New', 'nab-amplify'),
        'new_item'              => __('New Landing Page', 'nab-amplify'),
        'edit_item'             => __('Edit Landing Page', 'nab-amplify'),
        'update_item'           => __('Update Landing Page', 'nab-amplify'),
        'view_item'             => __('View Landing Page', 'nab-amplify'),
        'view_items'            => __('View Landing Pages', 'nab-amplify'),
        'search_items'          => __('Search Landing Pages', 'nab-amplify'),
        'not_found'             => __('Not found', 'nab-amplify'),
        'not_found_in_trash'    => __('Not found in Trash', 'nab-amplify'),
        'featured_image'        => __('Featured Image', 'nab-amplify'),
        'set_featured_image'    => __('Set featured image', 'nab-amplify'),
        'remove_featured_image' => __('Remove featured image', 'nab-amplify'),
        'use_featured_image'    => __('Use as featured image', 'nab-amplify'),
        'insert_into_item'      => __('Insert into Landing Page', 'nab-amplify'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'nab-amplify'),
        'items_list'            => __('Items list', 'nab-amplify'),
        'items_list_navigation' => __('Items list navigation', 'nab-amplify'),
        'filter_items_list'     => __('Filter items list', 'nab-amplify'),
    );
    $args = array(
        'label'                 => __('Landing Pages', 'nab-amplify'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'author', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'post-formats', 'excerpt'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'menu_icon'             => 'dashicons-text-page',
        'show_in_rest'          => true,
    );
    register_post_type('landing-page', $args);
}

/**
 * Set preloaded resusable block in the landing page when create new page from the backend.
 */
function nab_set_preloaded_block_in_new_landing_page()
{

    global $pagenow;

    $current_post_type = filter_input(INPUT_GET, 'post_type', FILTER_SANITIZE_STRING);

    if ('post-new.php' === $pagenow && 'landing-page' === $current_post_type) {

        $block_ids = array(17727);

        $query_args = array(
            'post_type' => 'wp_block',
            'fields'    => 'ids',
            'post__in'  => $block_ids,
            'orderby'   => 'post__in'
        );

        $block_query = new WP_Query($query_args);

        if ($block_query->have_posts()) {

            $block_ids = $block_query->posts;

            if (is_array($block_ids) && count($block_ids) > 0) {

                $block_template = array();

                foreach ($block_ids as $block_id) {
                    $block_template[] = ['core/block', ['ref' => $block_id]];
                }

                $article_object                = get_post_type_object('landing-page');
                $article_object->template    = $block_template;
            }
        }
    }
}

/**
 * Remove user meta on save the company post type.
 *
 * @param  int $post_id
 */
function nab_remove_company_user_meta($post_id)
{

    $company_user_id = get_field('company_user_id', $post_id);

    delete_user_meta($company_user_id, 'company_post_id');
    delete_user_meta($company_user_id, 'admin_can_add_product');
}

/**
 * Update user meta for comapny profile.
 *
 * @param  int $post_id
 */
function nab_update_compnay_user($post_id)
{

    $company_user_id = get_field('company_user_id', $post_id);

    if (!empty($company_user_id)) {

        $current_post = get_post($post_id);

        if ('publish' === $current_post->post_status && 'company' === $current_post->post_type) {

            $admin_can_add = get_field('admin_can_add_product', $post_id);

            update_user_meta($company_user_id, 'company_post_id', $post_id);
            update_user_meta($company_user_id, 'admin_can_add_product', $admin_can_add);
        }
    }
}

/**
 * Register Articles post type
 */
function nab_register_article_post_type()
{

    $labels = array(
        'name'                  => _x('Articles', 'Post Type General Name', 'nab-amplify'),
        'singular_name'         => _x('Articles', 'Post Type Singular Name', 'nab-amplify'),
        'menu_name'             => __('Articles', 'nab-amplify'),
        'name_admin_bar'        => __('Articles', 'nab-amplify'),
        'archives'              => __('Articles Archives', 'nab-amplify'),
        'attributes'            => __('Articles Attributes', 'nab-amplify'),
        'parent_item_colon'     => __('Parent Article:', 'nab-amplify'),
        'all_items'             => __('All Articles', 'nab-amplify'),
        'add_new_item'          => __('Add New Article', 'nab-amplify'),
        'add_new'               => __('Add New', 'nab-amplify'),
        'new_item'              => __('New Article', 'nab-amplify'),
        'edit_item'             => __('Edit Article', 'nab-amplify'),
        'update_item'           => __('Update Article', 'nab-amplify'),
        'view_item'             => __('View Article', 'nab-amplify'),
        'view_items'            => __('View Articles', 'nab-amplify'),
        'search_items'          => __('Search Articles', 'nab-amplify'),
        'not_found'             => __('Not found', 'nab-amplify'),
        'not_found_in_trash'    => __('Not found in Trash', 'nab-amplify'),
        'featured_image'        => __('Featured Image', 'nab-amplify'),
        'set_featured_image'    => __('Set featured image', 'nab-amplify'),
        'remove_featured_image' => __('Remove featured image', 'nab-amplify'),
        'use_featured_image'    => __('Use as featured image', 'nab-amplify'),
        'insert_into_item'      => __('Insert into Article', 'nab-amplify'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'nab-amplify'),
        'items_list'            => __('Items list', 'nab-amplify'),
        'items_list_navigation' => __('Items list navigation', 'nab-amplify'),
        'filter_items_list'     => __('Filter items list', 'nab-amplify'),
    );
    $args = array(
        'label'                 => __('Articles', 'nab-amplify'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'author', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', 'excerpt'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );
    register_post_type('articles', $args);
}

/**
 * Register article taxonomy
 */
function nab_register_article_content_taxonomy()
{

    $labels = array(
        'name'                       => _x('Categories', 'Taxonomy General Name', 'nab-amplify'),
        'singular_name'              => _x('Category', 'Taxonomy Singular Name', 'nab-amplify'),
        'menu_name'                  => __('Category', 'nab-amplify'),
        'all_items'                  => __('All Items', 'nab-amplify'),
        'parent_item'                => __('Parent Item', 'nab-amplify'),
        'parent_item_colon'          => __('Parent Item:', 'nab-amplify'),
        'new_item_name'              => __('New Item Name', 'nab-amplify'),
        'add_new_item'               => __('Add New Item', 'nab-amplify'),
        'edit_item'                  => __('Edit Item', 'nab-amplify'),
        'update_item'                => __('Update Item', 'nab-amplify'),
        'view_item'                  => __('View Item', 'nab-amplify'),
        'separate_items_with_commas' => __('Separate items with commas', 'nab-amplify'),
        'add_or_remove_items'        => __('Add or remove items', 'nab-amplify'),
        'choose_from_most_used'      => __('Choose from the most used', 'nab-amplify'),
        'popular_items'              => __('Popular Items', 'nab-amplify'),
        'search_items'               => __('Search Items', 'nab-amplify'),
        'not_found'                  => __('Not Found', 'nab-amplify'),
        'no_terms'                   => __('No items', 'nab-amplify'),
        'items_list'                 => __('Items list', 'nab-amplify'),
        'items_list_navigation'      => __('Items list navigation', 'nab-amplify'),
    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => false,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true,
    );
    register_taxonomy('content-category', array('company-products', 'articles'), $args);
}

/**
 * Allowed Administrator, editor, author and contributor user to enter unfiltered html.
 *
 * @param $caps
 * @param $cap
 * @param $user_id
 *
 * @return array
 *
 * @since 1.0.0
 */
function nab_add_unfiltered_html_capability_to_users($caps, $cap, $user_id)
{

    if ('unfiltered_html' === $cap && (user_can($user_id, 'administrator') || user_can($user_id, 'editor') || user_can($user_id, 'author') || user_can($user_id, 'contributor'))) {
        $caps = array('unfiltered_html');
    }

    return $caps;
}

/**
 * Display Author HTML on content page.
 *
 * @return string HTML for author section.
 */
function nab_amplify_display_author()
{

    ob_start();

    require_once get_template_directory() . '/inc/nab-display-author.php';

    return ob_get_clean();
}

/**
 * Add products into nab-product content type
 */
function nab_add_product()
{

    $final_result               = array();
    $uploaded_attachments       = array();
    $post_title                 = filter_input(INPUT_POST, 'product_title', FILTER_SANITIZE_STRING);
    $post_categories            = explode(',', filter_input(INPUT_POST, 'product_categories', FILTER_SANITIZE_STRING));
    $product_copy               = filter_input(INPUT_POST, 'nab_product_copy', FILTER_UNSAFE_RAW);
    $product_specs              = filter_input(INPUT_POST, 'nab_product_specs', FILTER_UNSAFE_RAW);
    $product_contact            = filter_input(INPUT_POST, 'nab_product_contact', FILTER_SANITIZE_NUMBER_INT);
    $is_feature_product         = filter_input(INPUT_POST, 'nab_feature_product', FILTER_SANITIZE_STRING);
    $is_product_b_stock         = filter_input(INPUT_POST, 'nab_product_b_stock', FILTER_SANITIZE_STRING);
    $is_product_sales_item      = filter_input(INPUT_POST, 'nab_product_sales_item', FILTER_SANITIZE_STRING);
    $product_discussion         = filter_input(INPUT_POST, 'nab_product_discussion', FILTER_SANITIZE_NUMBER_INT);
    $product_tags               = filter_input(INPUT_POST, 'nab_product_tags', FILTER_SANITIZE_STRING);
    $product_id                 = filter_input(INPUT_POST, 'nab_product_id', FILTER_SANITIZE_NUMBER_INT);
    $product_status             = filter_input(INPUT_POST, 'product_status', FILTER_SANITIZE_STRING);
    $remove_attachments         = explode(',', filter_input(INPUT_POST, 'remove_attachments', FILTER_SANITIZE_STRING));
    $nab_company_id             = filter_input(INPUT_POST, 'nab_company_id', FILTER_SANITIZE_NUMBER_INT);
    $nab_product_learn_more_url = filter_input(INPUT_POST, 'nab_product_learn_more_url', FILTER_SANITIZE_STRING);
    $product_media              = get_field('product_media', $product_id);
    $response_msg               = '';
    $product_contact            = $product_contact ? $product_contact : 0;

    //set product excerpt trim to first 200 characters
    $product_excerpt = wp_trim_words($product_copy, 200, '...');
    $updated_desc = update_post_meta($product_id, '_yoast_wpseo_metadesc', $product_excerpt);
    if (is_wp_error($updated_desc)) {
        $errors = $company_post->get_error_messages();
        foreach ($errors as $error) {
            $response['content'] = $error;
            wp_send_json_error($response);
        }
    }

    $product_status = 'update' === strtolower($product_status) ? 'publish' : $product_status;
    // Create post object
    $product_post_data = array(
        'post_title'   => wp_strip_all_tags($post_title),
        'post_status'  => $product_status,
        'post_type'    => 'company-products',
        'post_excerpt' => $product_excerpt
    );

    // set comment status
    if ($product_discussion == 1) {
        $product_post_data['comment_status'] = 'open';
    } else {
        $product_post_data['comment_status'] = 'closed';
    }

    if ($product_id !== '0') {

        $current_status = get_post_status($product_id);

        // Update the post into the database
        $product_post_data['ID'] = $product_id;

        $post_id                 = wp_update_post($product_post_data);

        /*Add existing media to loop */
        $product_media = get_field('product_media', $post_id);
        foreach ($product_media as $media) {
            if (!empty($media['product_media_file'])) {
                $uploaded_attachments[] = $media['product_media_file']['ID'];
            }
        }

        if (!empty($remove_attachments)) {
            foreach ($remove_attachments as $remove_attach) {
                wp_delete_attachment($remove_attach);
                if (($key = array_search($remove_attach, $uploaded_attachments)) !== false) {
                    unset($uploaded_attachments[$key]);
                }
            }
        }

        $response_msg = 'trash' === strtolower($product_status) ? "Product Deleted Successfully!" : "Product Updated Successfully!";

        if ('draft' === $current_status && 'publish' === strtolower($product_status)) {
            $final_result['publish_text']   = "Update";
            $final_result['draft_text']     = "Revert to Draft";
            $response_msg                   = "Product Published Successfully!";
        } elseif ('publish' === $current_status && 'draft' === strtolower($product_status)) {
            $final_result['publish_text']   = "Publish";
            $final_result['draft_text']     = "Save as Draft";
            $response_msg                   = "Product Reverted Publish to Draft Successfully!";
        }
    } else {
        // Insert the post into the database
        $post_id = wp_insert_post($product_post_data);

        if ('draft' === strtolower($product_status)) {
            $response_msg = "Product Save as Draft Successfully!";
        } else {
            $response_msg = "Product Added Successfully!";
            $final_result['publish_text']   = "Update";
            $final_result['draft_text']     = "Revert to Draft";
        }
    }

    // assign categories and tags to post
    if (empty($post_categories)) {
        wp_set_object_terms($post_id, NULL, 'company-product-category', false);
    } else {
        wp_set_object_terms($post_id, $post_categories, 'company-product-category', false);
    }

    wp_set_post_terms($post_id, $product_tags, 'company-product-tag', true);



    apply_filters('comments_open', $product_discussion, $post_id);


    $dependencies_loaded = 0;

    $existing_product_media = count($uploaded_attachments);

    $diff = 4 - $existing_product_media;

    foreach ($_FILES as $file_key => $file_details) {
        if ($file_key < $diff) {
            if (0 === $dependencies_loaded) {
                // These files need to be included as dependencies when on the front end.
                require_once ABSPATH . 'wp-admin/includes/image.php';
                require_once ABSPATH . 'wp-admin/includes/file.php';
                require_once ABSPATH . 'wp-admin/includes/media.php';
                $dependencies_loaded = 1;
            }

            // Let WordPress handle the upload.
            $attachment_id = media_handle_upload($file_key, 0);

            if (!is_wp_error($attachment_id)) {
                // update in meta
                if ($file_key === 'product_featured_image') {
                    set_post_thumbnail($post_id, $attachment_id);
                } else {
                    $uploaded_attachments[] = $attachment_id;
                }
            }
        }
    }
    // Add product media
    $value = array();
    foreach ($uploaded_attachments as $item) {
        $field_key = "field_5fb687d9c964e";
        $value[]   = array(
            "product_media_file" => $item,
        );
    }
    update_field($field_key, $value, $post_id);

    // Add product copy
    update_field('field_5fb73eedf021b', $product_copy, $post_id);

    // Add product specs
    update_field('field_5fb73efcf021c', $product_specs, $post_id);

    // Add product contact
    update_field('field_5fb73f16f021d', $product_contact, $post_id);

    // Add product featured
    update_field('field_5fbbdb62392cd', $is_feature_product, $post_id);

    // Add product B-stock
    update_field('field_5fbbdb7e392ce', $is_product_b_stock, $post_id);

    // Add product sales item
    update_field('field_5fbbdbb2392d0', $is_product_sales_item, $post_id);

    // Add product company
    update_field('field_5fc881bd20fa0', $nab_company_id, $post_id);

    //add product read more URL
    update_field('product_learn_more_url', $nab_product_learn_more_url, $post_id);


    if (is_wp_error($post_id)) {
        $final_result['success'] = false;
        $final_result['content'] = '';
    } else {
        $final_result['success'] = true;
        $final_result['content'] = $response_msg;
        $final_result['post_id'] = $post_id;
    }

    echo wp_json_encode($final_result);
    wp_die();
}

/**
 * Register Company Category Taxonomy.
 */
function nab_register_company_category_taxonomy()
{

    $labels = array(
        'name'              => _x('Company Category', 'Taxonomy General Name', 'nab-amplify'),
        'singular_name'     => _x('Company Category', 'Taxonomy Singular Name', 'nab-amplify'),
        'menu_name'         => __('Company Category', 'nab-amplify'),
        'all_items'         => __('All Items', 'nab-amplify'),
        'parent_item'       => __('Parent Item', 'nab-amplify'),
        'parent_item_colon' => __('Parent Item:', 'nab-amplify'),
        'new_item_name'     => __('New Item Name', 'nab-amplify'),
        'add_new_item'      => __('Add New Item', 'nab-amplify'),
        'edit_item'         => __('Edit Item', 'nab-amplify'),
        'update_item'       => __('Update Item', 'nab-amplify'),
    );
    $args = array(
        'public'            => false,
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'company-category'),
    );
    register_taxonomy('company-category', array('company', 'tribe_events' ), $args);
}

/**
 * Register Company Tags Taxonomy.
 */
function nab_register_company_tags_taxonomy()
{

    $labels = array(
        'name'              => _x('Product Tags', 'Taxonomy General Name', 'nab-amplify'),
        'singular_name'     => _x('Product Tag', 'Taxonomy Singular Name', 'nab-amplify'),
        'menu_name'         => __('Product Tag', 'nab-amplify'),
        'all_items'         => __('All Items', 'nab-amplify'),
        'parent_item'       => __('Parent Item', 'nab-amplify'),
        'parent_item_colon' => __('Parent Item:', 'nab-amplify'),
        'new_item_name'     => __('New Item Name', 'nab-amplify'),
        'add_new_item'      => __('Add New Item', 'nab-amplify'),
        'edit_item'         => __('Edit Item', 'nab-amplify'),
        'update_item'       => __('Update Item', 'nab-amplify'),
    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => false,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'company-product-tag'),
    );
    register_taxonomy('company-product-tag', array('company-products'), $args);
}

/**
 * Display article tags.
 *
 * @param  array $atts
 * 
 * @return string
 */
function nab_article_tags_shortcode_callback($atts)
{

    $atts = shortcode_atts(array(
        'item_id'   => get_the_ID(),
    ), $atts);

    $article_id = $atts['item_id'];
    $tags_html  = '';

    if (!empty($article_id)) {

        //$article_type_tag       = get_field('article_type', $article_id);
        $community_tags         = get_field('community', $article_id);
        //$personas_tags          = get_field('personas', $article_id);
        $content_format_tags    = get_field('content_format', $article_id);
        //$content_scope_tag      = get_field('content_scope', $article_id);
        $content_subject_tags   = get_field('content_subject', $article_id);
        $acquisition_sub_tags   = get_field('acquisition_sub', $article_id);
        $distribution_sub_tags  = get_field('distribution_sub', $article_id);
        $management_sub_tags    = get_field('management_sub', $article_id);
        $radio_sub_tags         = get_field('radio_sub', $article_id);
        $display_sub_tags       = get_field('display_sub', $article_id);
        $industry_sub_tags      = get_field('industry_sub', $article_id);
        $content_sub_tags       = get_field('content_sub', $article_id);
        $production_sub_tags    = get_field('production_sub', $article_id);
        $final_tags             = array();

        /*if (!empty($article_type_tag)) {
            $final_tags[] = $article_type_tag;
        }*/

        if (!empty($community_tags)) {
            $final_tags = array_merge($final_tags, $community_tags);
        }

        /*if (!empty($content_scope_tag)) {
            $final_tags[] = $content_scope_tag;
        }*/

        if (!empty($content_format_tags)) {
            $final_tags = array_merge($final_tags, $content_format_tags);
        }

        if (!empty($content_subject_tags)) {
            $final_tags = array_merge($final_tags, $content_subject_tags);
        }

        if (!empty($acquisition_sub_tags) && in_array('Acquisition and Production', (array) $content_subject_tags, true)) {
            $final_tags = array_merge($final_tags, $acquisition_sub_tags);
        }

        if (!empty($distribution_sub_tags) && in_array('Distribution and Delivery', (array) $content_subject_tags, true)) {
            $final_tags = array_merge($final_tags, $distribution_sub_tags);
        }

        if (!empty($management_sub_tags) && in_array('Management and Systems', (array) $content_subject_tags, true)) {
            $final_tags = array_merge($final_tags, $management_sub_tags);
        }

        if (!empty($radio_sub_tags) && in_array('Radio', (array) $content_subject_tags, true)) {
            $final_tags = array_merge($final_tags, $radio_sub_tags);
        }

        if (!empty($display_sub_tags) && in_array('Display Systems', (array) $content_subject_tags, true)) {
            $final_tags = array_merge($final_tags, $display_sub_tags);
        }

        if (!empty($industry_sub_tags) && in_array('Industry Resources', (array) $content_subject_tags, true)) {
            $final_tags = array_merge($final_tags, $industry_sub_tags);
        }

        if (!empty($content_sub_tags) && in_array('Media Content', (array) $content_subject_tags, true)) {
            $final_tags = array_merge($final_tags, $content_sub_tags);
        }

        if (!empty($production_sub_tags) && in_array('Post Production', (array) $content_subject_tags, true)) {
            $final_tags = array_merge($final_tags, $production_sub_tags);
        }

        /*if (!empty($personas_tags)) {
            $final_tags = array_merge($final_tags, $personas_tags);
        }*/

        if (is_array($final_tags) && count($final_tags) > 0) {

            ob_start();
    ?>
            <div class="amp-tag-main">
                <ul class="amp-tag-list">
                    <?php

                    $home_url = rtrim(get_site_url(), '/') . '/';

                    foreach ($final_tags as $current_tag) {

                        $tag_search_url = add_query_arg(array('s' => $current_tag), $home_url);
                    ?>
                        <li><a href="<?php echo esc_url($tag_search_url); ?>" class="btn"><?php echo esc_html($current_tag); ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
    <?php
            $tags_html = ob_get_clean();
        }
    }

    return $tags_html;
}

/**
 * Custom Customizer options.
 *
 * @param object $wp_customize
 */
function nab_customize_register($wp_customize)
{

    // Add section to customizer.
    $wp_customize->add_section('custom_header_settings', array(
        'title'    => __('Custom Header Settings', 'nabshow-ny'),
        'priority' => 999,
    ));

    // Add header logo code.
    $wp_customize->add_setting('nab_header_logo_code');

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'nab_header_logo_code',
            array(
                'label'     => 'Header Logo Code',
                'section'   => 'custom_header_settings',
                'settings'  => 'nab_header_logo_code',
                'type'      => 'textarea'
            )
        )
    );
}

/**
 * Set default blocks in the new article create.
 */
function nab_set_default_block_in_new_article()
{

    global $pagenow;

    $current_post_type = filter_input(INPUT_GET, 'post_type', FILTER_SANITIZE_STRING);

    if ('post-new.php' === $pagenow && 'articles' === $current_post_type) {

        $block_ids = array(15781);

        $query_args = array(
            'post_type' => 'wp_block',
            'fields'    => 'ids',
            'post__in'  => $block_ids,
            'orderby'   => 'post__in'
        );

        $block_query = new WP_Query($query_args);

        if ($block_query->have_posts()) {

            $block_ids = $block_query->posts;

            if (is_array($block_ids) && count($block_ids) > 0) {

                $block_template = array();

                foreach ($block_ids as $block_id) {
                    $block_template[] = ['core/block', ['ref' => $block_id]];
                }

                $article_object                = get_post_type_object('articles');
                $article_object->template    = $block_template;
            }
        }
    }
}


/**
 * Register company product taxonomy
 */
function nab_register_company_product_taxonomy()
{

    $labels = array(
        'name'                       => _x('Product Categories', 'Taxonomy General Name', 'nab-amplify'),
        'singular_name'              => _x('Product Category', 'Taxonomy Singular Name', 'nab-amplify'),
        'menu_name'                  => __('Product Category', 'nab-amplify'),
        'all_items'                  => __('All Items', 'nab-amplify'),
        'parent_item'                => __('Parent Item', 'nab-amplify'),
        'parent_item_colon'          => __('Parent Item:', 'nab-amplify'),
        'new_item_name'              => __('New Item Name', 'nab-amplify'),
        'add_new_item'               => __('Add New Item', 'nab-amplify'),
        'edit_item'                  => __('Edit Item', 'nab-amplify'),
        'update_item'                => __('Update Item', 'nab-amplify'),
        'view_item'                  => __('View Item', 'nab-amplify'),
        'separate_items_with_commas' => __('Separate items with commas', 'nab-amplify'),
        'add_or_remove_items'        => __('Add or remove items', 'nab-amplify'),
        'choose_from_most_used'      => __('Choose from the most used', 'nab-amplify'),
        'popular_items'              => __('Popular Items', 'nab-amplify'),
        'search_items'               => __('Search Items', 'nab-amplify'),
        'not_found'                  => __('Not Found', 'nab-amplify'),
        'no_terms'                   => __('No items', 'nab-amplify'),
        'items_list'                 => __('Items list', 'nab-amplify'),
        'items_list_navigation'      => __('Items list navigation', 'nab-amplify'),
    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true,
    );
    register_taxonomy('company-product-category', array('company-products'), $args);
}

function nab_edit_company_social_profiles_callback()
{

    $company_id      = filter_input(INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT);
    $company_data    = array();
    $company_data['ID'] = $company_id;
    $company_data['instagram_profile'] = get_field('instagram_url', $company_id);
    $company_data['linkedin_profile'] = get_field('linkedin_url', $company_id);
    $company_data['facebook_profile'] = get_field('facebook_url', $company_id);
    $company_data['twitter_profile'] = get_field('twitter_url', $company_id);
    $company_data['company_youtube'] = get_field('youtube_url', $company_id);

    require_once get_template_directory() . '/inc/nab-edit-company-social-profiles.php';

    wp_die();
}

function nab_update_company_profile_callback()
{

    $final_result = array();

    $instagram_profile              = filter_input(INPUT_POST, 'instagram_profile', FILTER_SANITIZE_STRING);
    $linkedin_profile               = filter_input(INPUT_POST, 'linkedin_profile', FILTER_SANITIZE_STRING);
    $facebook_profile               = filter_input(INPUT_POST, 'facebook_profile', FILTER_SANITIZE_STRING);
    $twitter_profile                = filter_input(INPUT_POST, 'twitter_profile', FILTER_SANITIZE_STRING);
    $company_about                  = filter_input(INPUT_POST, 'company_about', FILTER_SANITIZE_STRING);
    $company_industry               = filter_input(INPUT_POST, 'company_industry', FILTER_SANITIZE_STRING);
    $company_website                = filter_input(INPUT_POST, 'company_website', FILTER_SANITIZE_STRING);
    $company_point_of_contact       = filter_input(INPUT_POST, 'company_point_of_contact', FILTER_SANITIZE_STRING);
    $company_id                     = filter_input(INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT);
    $company_location_street_one    = filter_input(INPUT_POST, 'company_location_street_one', FILTER_SANITIZE_STRING);
    $company_location_street_two    = filter_input(INPUT_POST, 'company_location_street_two', FILTER_SANITIZE_STRING);
    $company_location_street_three  = filter_input(INPUT_POST, 'company_location_street_three', FILTER_SANITIZE_STRING);
    $company_location_city          = filter_input(INPUT_POST, 'company_location_city', FILTER_SANITIZE_STRING);
    $company_location_state         = filter_input(INPUT_POST, 'company_location_state', FILTER_SANITIZE_STRING);
    $company_location_zipcode       = filter_input(INPUT_POST, 'company_location_zip', FILTER_SANITIZE_STRING);
    $company_location_country       = filter_input(INPUT_POST, 'company_location_country', FILTER_SANITIZE_STRING);
    $company_product_categories     = filter_input(INPUT_POST, 'company_product_categories', FILTER_SANITIZE_STRING);
    $company_search_categories      = filter_input(INPUT_POST, 'company_search_categories', FILTER_SANITIZE_STRING);
    $company_youtube                = filter_input(INPUT_POST, 'company_youtube', FILTER_SANITIZE_STRING);
    $company_admins                = filter_input(INPUT_POST, 'company_admins', FILTER_SANITIZE_STRING);



    $category_limit = nab_get_company_member_category_limit($company_id);

    if (!empty($company_product_categories) && 'null' !== $company_product_categories) {

        $company_product_categories = explode(',', $company_product_categories);

        if (0 === (int) $category_limit['featured'] && count($company_product_categories) > 0) {
            wp_send_json_error('Update Failed. You can\'t add featured product categories without membership.');
        } else if (2 === (int) $category_limit['featured'] && count($company_product_categories) > (int) $category_limit['featured']) {
            wp_send_json_error('Update Failed. You can add maximum ' . $category_limit['featured'] . ' featured product categories with your current membership.');
        } else if (count($company_product_categories) > (int) $category_limit['featured']) {
            wp_send_json_error('Update Failed. You can\'t add more than ' . $category_limit['featured'] . ' featured product categories.');
        }
    }

    if (!empty($company_search_categories) && 'null' !== $company_search_categories) {
        
        $company_search_categories = explode(',', $company_search_categories);

        if (0 === (int) $category_limit['search'] && count($company_search_categories) > 0) {
            wp_send_json_error('Update Failed. You can\'t add search categories with your current membership.');
        } else if (count($company_search_categories) > (int) $category_limit['search']) {
            wp_send_json_error('Update Failed. You can\'t add more than ' . $category_limit['search'] . ' search categories with your current membership.');
        }
    }

    //set company excerpt trim to first 200 characters
    $company_excerpt = wp_trim_words($company_about, 200, '...');
    $company_post_array     = array(

        'ID'            => $company_id,
        'post_excerpt'  => $company_excerpt

    );
    $company_post = wp_update_post($company_post_array);
    $updated_desc = update_post_meta($company_id, '_yoast_wpseo_metadesc', $company_excerpt);
    if (is_wp_error($company_post) || is_wp_error($updated_desc)) {
        $errors = $company_post->get_error_messages();
        foreach ($errors as $error) {
            $response['content'] = $error;
            wp_send_json_error($response);
        }
    }

    // Update instagram profile
    if (isset($instagram_profile)) {
        update_field('field_5fb60dc5ce133', $instagram_profile, $company_id);
    }

    // Update linkedin profile
    if (isset($linkedin_profile)) {
        update_field('field_5fb60e12ce134', $linkedin_profile, $company_id);
    }
    // Update linkedin profile
    if (isset($facebook_profile)) {
        update_field('field_5fb60e4bce135', $facebook_profile, $company_id);
    }

    // Update linkedin 
    if (isset($twitter_profile)) {
        update_field('field_5fb60e59ce136', $twitter_profile, $company_id);
    }
    

    // Update Company 
    if ($company_about) {
        update_field('field_5fb63813b099e', $company_about, $company_id);
    }

    // Update linkedin profile
    if ($company_industry) {
        update_field('field_5fa3e81e3fa45', $company_industry, $company_id);
    }

    // Update location 
    $field_key = 'field_5fa3e84f3fa46';
    $values = array(
        '_street_line_1'    =>   $company_location_street_one, //THE 1st PART MATCHES YOUR FIELD NAMES, THE 2nd IS THE VALUE YOU WANT
        'street_line_2' =>   $company_location_street_two,
        'street_line_3' =>   $company_location_street_three,
        'city' =>   $company_location_city,
        'state' =>   $company_location_state,
        'zipcode' =>   $company_location_zipcode,
        'country' =>   $company_location_country,
    );
    update_field($field_key, $values, $company_id);

    // Update website
    if (isset($company_website)) {
        update_field('field_5fa3e87a3fa47', $company_website, $company_id);
    }
    

    // Update point of contact
    if ( isset( $company_point_of_contact ) ) {
        
        if ( $company_point_of_contact !== '') {
            update_field('field_5fb4f4bcbe04a', $company_point_of_contact, $company_id);
        } else {
            update_field('field_5fb4f4bcbe04a', 0, $company_id);
        }
    }


    // Update company product categories.
    if (!empty($company_product_categories) && 'null' !== $company_product_categories) {
        update_field('product_categories', $company_product_categories, $company_id);
    }

    // Update company search product categories.
    if (!empty($company_search_categories) && 'null' !== $company_search_categories) {
        update_field('search_product_categories', $company_search_categories, $company_id);
    }

    // Update company youtube
    if (isset($company_youtube)) {
        update_field('youtube_url', $company_youtube, $company_id);
    }
    

    if ( isset( $company_admins ) && 'null' !== $company_admins ) {

        $company_admins = explode(',', $company_admins);
        $get_member_level = get_field('member_level', $company_id);
        $exisitng_admins = [];
        $exisitng_admins = get_field('company_user_id', $company_id);
        if ($get_member_level === 'select' || $get_member_level === 'Standard') {
            foreach ($company_admins as $comp_admin) {
               if(!in_array($comp_admin,$exisitng_admins)){
                wp_send_json_error('Update Failed. With the Standard Package you are limited to one company admin at a time. Contact your sales rep to upgrade to the Plus or Premium Package for unlimited admin accounts.');
               }
            }
            
        } else {
            
            update_field('company_user_id', $company_admins, $company_id);
        }

    }


    $final_result['success'] = true;
    $final_result['content'] = '';

    echo wp_json_encode($final_result);
    wp_die();
}

function nab_edit_company_about_callback()
{

    $company_id                                 = filter_input(INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT);
    $company_data                               = array();
    $company_data['ID']                         = $company_id;
    $company_data['company_about']              = get_field('about_company', $company_id);
    $company_data['company_industry']           = get_field('company_industary', $company_id);
    $company_data['company_location']           = get_field('company_location', $company_id);
    $company_data['company_website']            = get_field('company_website', $company_id);
    $company_data['company_point_of_contact']   = get_field('point_of_contact', $company_id);
    $company_data['product_categories']         = get_field('product_categories', $company_id);
    $company_data['search_product_categories']  = get_field('search_product_categories', $company_id);
    $company_data['company_youtube']            = get_field('company_youtube', $company_id);
    $company_data['company_admins']            = get_field('company_user_id', $company_id);
    $terms = get_terms('company-product-category', array(
        'hide_empty' => false,
    ));
    
    require_once get_template_directory() . '/inc/nab-edit-company-about.php';


    wp_die();
}

/**
 * Set default blocks in the new article create.
 */
function nab_set_default_block_in_new_company()
{

    global $pagenow;

    $current_post_type = filter_input(INPUT_GET, 'post_type', FILTER_SANITIZE_STRING);

    if ('post-new.php' === $pagenow && 'company' === $current_post_type) {

        $block_ids = array(1305);

        $query_args = array(
            'post_type' => 'wp_block',
            'fields'    => 'ids',
            'post__in'  => $block_ids,
            'orderby'   => 'post__in'
        );

        $block_query = new WP_Query($query_args);

        if ($block_query->have_posts()) {

            $block_ids = $block_query->posts;

            if (is_array($block_ids) && count($block_ids) > 0) {

                $block_template = array();

                foreach ($block_ids as $block_id) {
                    $block_template[] = ['core/block', ['ref' => $block_id]];
                }

                $article_object                = get_post_type_object('company');
                $article_object->template    = $block_template;
            }
        }
    }
}
function nab_get_wp_editor($content = '', $editor_id, $options)
{
    ob_start();

    wp_editor($content, $editor_id, $options);

    $temp = ob_get_clean();


    $temp .= \_WP_Editors::enqueue_scripts();
    $temp .= wp_enqueue_script('amplify-select2-js', get_template_directory_uri() . '/assets/js/select2.min.js', ['jquery'], '1.0.1', true);
    $temp .= \_WP_Editors::editor_js();
    $temp .= print_footer_scripts();
    $temp = str_replace('Array', '', $temp);
    return $temp;
}

function nab_comment_form($atts = array(), $content = '')
{
    if (is_singular() && post_type_supports(get_post_type(), 'comments')) {
        ob_start();
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
            print('<style>.no-comments { display: none; }</style>');
        endif;

        return ob_get_clean();
    }
    return '';
}

/**
 * Added comments export submenu page.
 */
function nab_add_export_comments_menu()
{

    add_submenu_page(
        'edit-comments.php',
        __('Export Comments', 'nab-amplify'),
        __('Export Comments', 'nab-amplify'),
        'manage_options',
        'amplify_comment_export',
        'nab_export_comments_callback'
    );
}

/**
 * Export commnets setting page.
 */
function nab_export_comments_callback()
{
    ?>
    <div class="search-settings">
        <h2>Export Comments</h2>
        <form class="comments-export-form" method="post">
            <table class="form-table" role="presentation">
                <tr>
                    <th>Select Year</th>
                    <td>
                        <select name="comment_year">
                            <?php
                            $start          = 2020;
                            $current_year   = date('Y');
                            for ($i = $start; $i <= $current_year; $i++) {
                            ?>
                                <option value="<?php echo esc_attr($i); ?>" <?php selected($current_year, $i); ?>><?php echo esc_html($i); ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
            <?php submit_button("Export CSV"); ?>
        </form>
    </div>
<?php
}


/**
 * Added user export submenu page.
 */
function nab_add_export_user_menu()
{

    add_submenu_page(
        'users.php',
        __('Export Users', 'nab-amplify'),
        __('Export Users', 'nab-amplify'),
        'manage_options',
        'amplify_user_export',
        'nab_export_users_callback'
    );
}

/**
 * Export user setting page.
 */
function nab_export_users_callback() {
    ?>
    <div class="search-settings">
        <h2>Export Users</h2>
        <form class="users-export-form" method="post">
            <table class="form-table" role="presentation">
                <tr>
                    <th>User Role</th>
                    <td>
                        <select name="user_role">
                            <option value="all">All</option>
                            <?php wp_dropdown_roles(); ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Qualified Member Press Users</th>
                    <td>
                        <input type="checkbox" name="press_member_user" value="yes">
                    </td>
                </tr>
            </table>
            <?php submit_button("Export CSV"); ?>
        </form>
    </div>
<?php
}

/**
 * Generate comments CSV file.
 */
function nab_generate_comments_export_csv_file()
{

    global $wpdb, $pagenow;

    $comment_year   = filter_input(INPUT_POST, 'comment_year', FILTER_SANITIZE_STRING);
    $comment_page   = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);

    if ('edit-comments.php' === $pagenow && 'amplify_comment_export' === $comment_page && !empty($comment_year)) {

        $prepare_sql        = $wpdb->prepare("SELECT * FROM {$wpdb->comments} WHERE YEAR(comment_date) = %s AND comment_type = %s AND comment_approved = %s", $comment_year, 'comment', '1');
        $comment_results    = $wpdb->get_results($prepare_sql);

        if (!empty($comment_results)) {

            // CSV header row fields titles
            $csv_fields   = array();
            $csv_fields[] = 'First Name';
            $csv_fields[] = 'Last Name';
            $csv_fields[] = 'Email';
            $csv_fields[] = 'Date Time';
            $csv_fields[] = 'Page';
            $csv_fields[] = 'Comment Content';

            // Generate csv file as a direct download
            $output_filename = 'amplify-comment-list-' . $comment_year . '.csv';
            $output_handle   = fopen('php://output', 'w');

            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename=' . $output_filename);

            // Insert header row
            fputcsv($output_handle, $csv_fields);

            foreach ($comment_results as $commnet) {

                $dynamic_fields = array();
                $first_name     = '';
                $last_name      = '';

                if (!empty($commnet->user_id) && 0 !== (int) $commnet->user_id) {

                    $first_name = get_user_meta($commnet->user_id, 'first_name', true);
                    $last_name  = get_user_meta($commnet->user_id, 'last_name', true);
                }

                if (empty($first_name) && empty($last_name)) {

                    $first_name = $commnet->comment_author;
                }

                $comment_date = date_format(date_create($commnet->comment_date), 'm-d-Y H:i:s');

                $dynamic_fields[] = $first_name;
                $dynamic_fields[] = $last_name;
                $dynamic_fields[] = $commnet->comment_author_email;
                $dynamic_fields[] = $comment_date;
                $dynamic_fields[] = get_the_title($commnet->comment_post_ID);
                $dynamic_fields[] = $commnet->comment_content;

                fputcsv($output_handle, $dynamic_fields);
            }
            exit;
        }
    }
}

/**
 * Generate Users CSV file.
 */
function nab_generate_users_export_csv_file()
{

    global $pagenow;

    $user_role          = filter_input( INPUT_POST, 'user_role', FILTER_SANITIZE_STRING );
    $user_page          = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );
    $press_member_user  = filter_input( INPUT_POST, 'press_member_user', FILTER_SANITIZE_STRING );

    if ('users.php' === $pagenow && 'amplify_user_export' === $user_page && !empty($user_role)) {

        $args = array('orderby' => 'login');

        if ('all' !== $user_role) {

            $args['role'] = $user_role;
        }

        if ( isset( $press_member_user ) && ! empty( $press_member_user ) ) {
            $args[ 'meta_key' ]     = 'press_member_user';
            $args[ 'meta_value' ]   = '1';
        }

        $user_query = new WP_User_Query( $args );

        $user_results = $user_query->get_results();

         // CSV header row fields titles
         $csv_fields   = array();
         $csv_fields[] = 'First Name';
         $csv_fields[] = 'Last Name';
         $csv_fields[] = 'Email';
         $csv_fields[] = 'Title';
         $csv_fields[] = 'Company';
         $csv_fields[] = 'Registered Date';
     
         // Generate csv file as a direct download
         $output_filename = 'amplify-user-list-' . date('m-d-Y') . '.csv';
         $output_handle   = fopen('php://output', 'w');

         header('Content-type: application/csv');
         header('Content-Disposition: attachment; filename=' . $output_filename);

         fputcsv($output_handle, $csv_fields);

        if ( ! empty( $user_results ) ) {            

            foreach ($user_results as $current_user) {

                $dynamic_fields = array();

                $company    = get_user_meta( $current_user->ID, 'attendee_company', true );
                $title      = get_user_meta( $current_user->ID, 'attendee_title', true );
                $first_name = get_user_meta( $current_user->ID, 'first_name', true );
                $last_name  = get_user_meta( $current_user->ID, 'last_name', true );

                if (empty($first_name) && empty($last_name)) {
                    $first_name = $current_user->display_name;
                }

                $registered_date = date_format(date_create($current_user->user_registered), 'm-d-Y H:i:s');

                $dynamic_fields[] = $first_name;
                $dynamic_fields[] = $last_name;
                $dynamic_fields[] = $current_user->user_email;
                $dynamic_fields[] = $title;
                $dynamic_fields[] = $company;
                $dynamic_fields[] = $registered_date;

                fputcsv($output_handle, $dynamic_fields);
            }           
        }
        exit;
    }
}

/**
 * 
 * Add company admin by URL
 */

function nab_add_comapny_admin()
{
    global $wp_query;

    $post_type = get_post_type();
    if ($post_type === 'company') {

        $current_post_id = $wp_query->posts[0]->ID;
        $post_random_string = get_field('admin_add_string', $current_post_id);
        $query_var = $wp_query->query_vars['addadmin'];


        if ($query_var && ($post_random_string == $query_var)) {
            if (!is_user_logged_in()) {
                $current_url = home_url(add_query_arg(NULL, NULL));
                $current_url = str_replace('amplify/amplify', 'amplify', $current_url);
                $url =  esc_url(add_query_arg(array('r' => $current_url), wc_get_page_permalink('myaccount')));
                wp_redirect($url, 302);
            } else {
                $current_user_id = get_current_user_id();

                $current_admins = get_field('company_user_id', $current_post_id);
                if (empty($current_admins)) {
                    $current_admins = [];
                }
                if (!in_array($current_user_id, $current_admins)) {
                    $current_admins[] = $current_user_id;
                    update_field('company_user_id', $current_admins, $current_post_id);
                    setcookie('new_company_admin_popup', '1', time() + (86400 * 30), "/");
                }
            }
        }
    }
}
/*
 * Added page filter in the admin comments table.
 */
function nab_add_page_by_comment_filter()
{

    global $wpdb;

    $post_filter    = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_NUMBER_INT);
    $prepare_sql    = $wpdb->prepare("SELECT DISTINCT comment_post_ID FROM {$wpdb->comments} WHERE comment_type = %s", "comment");
    $post_results   = $wpdb->get_col($prepare_sql);
?>
    <select name="p" class="filter-by-page">
        <option value="">Select a Page</option>
        <?php
        if (is_array($post_results)) {

            foreach ($post_results as $comment_post_id) {
        ?>
                <option value="<?php esc_attr_e($comment_post_id); ?>" <?php selected($post_filter, $comment_post_id); ?>><?php esc_html_e(get_the_title($comment_post_id)); ?></option>
        <?php
            }
        }
        ?>
    </select>
<?php
}

/**
 * Added company export submenu page.
 */
function nab_add_export_company_menu()
{

    add_submenu_page(
        'edit.php?post_type=company',
        __('Export Companies', 'nab-amplify'),
        __('Export Companies', 'nab-amplify'),
        'manage_options',
        'amplify_company_export',
        'nab_export_compnies_callback'
    );
}

/**
 * Export company setting page.
 */
function nab_export_compnies_callback()
{
?>
    <div class="search-settings">
        <h2>Export Companies</h2>
        <form class="companies-export-form" method="post">
            <input type="hidden" name="generate_company_csv" value="generate_company_csv" />
            <?php submit_button("Export CSV"); ?>
        </form>
    </div>
    <?php
}


/**
 * Generate comments CSV file.
 */
function nab_generate_company_export_csv_file()
{

    global $wpdb, $pagenow;

    $submit   = filter_input(INPUT_POST, 'generate_company_csv', FILTER_SANITIZE_STRING);
    $comment_page   = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);

    if ('edit.php' === $pagenow && 'amplify_company_export' === $comment_page  && !empty($submit)) {
        // CSV header row fields titles
        $csv_fields   = array();
        $csv_fields[] = 'Company Name';
        $csv_fields[] = 'Claimed Status';
        $csv_fields[] = 'Admin URL';
        $csv_fields[] = 'Salesforce ID';

        // Generate csv file as a direct download
        $output_filename = 'amplify-company-list-' . date('m-d-Y') . '.csv';
        $output_handle   = fopen('php://output', 'w');

        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $output_filename);

        $args = array(
            'numberposts'        => -1, // -1 is for all
            'post_type'        => 'company', // or 'post', 'page'
            'orderby'         => 'title', // or 'date', 'rand'
            'order'         => 'ASC', // or 'DESC'
            'post_status'   => 'publish'
        );

        $company_result = get_posts($args);

        // Insert header row
        fputcsv($output_handle, $csv_fields);

        foreach ($company_result as $company) {

            $company_admins = get_field('company_user_id', $company->ID);
            $admin_add_string = get_field('admin_add_string', $company->ID);

            if (!empty($company_admins)) {
                $claim_status = 'Claimed';
            } else {
                $claim_status = 'Unclaimed';
            }

            if ($admin_add_string != '') {
                $admin_url = get_permalink($company->ID) . '?addadmin=' . $admin_add_string;
            } else {
                $random_string = generate_add_admin_string();
                update_field('admin_add_string', $random_string, $company->ID);
                $admin_url = get_permalink($company->ID) . '?addadmin=' . $random_string;
            }

            $salesforce_id = get_field('salesforce_id', $company->ID);

            if ($company->post_title != '') {
                $dynamic_fields = array();
                $dynamic_fields[] = $company->post_title;
                $dynamic_fields[] = $claim_status;
                $dynamic_fields[] = $admin_url;
                $dynamic_fields[] = $salesforce_id;
                fputcsv($output_handle, $dynamic_fields);
            }
        }
        exit;
    }
}

/** 
 * Copyright Year shortcode use in the footer to display dynamic year.
 */
function nab_copyright_year_shortcode()
{

    return date('Y');
}
/**
 * Initialize the company bulk import batch.
 */
function wp_batch_processing_init()
{
    $batch = new NAB_Company_Import_Batch();
    WP_Batch_Processor::get_instance()->register($batch);
}

/*Generate default alphanumeric random string for company add admin URL */

function generate_add_admin_string()
{
    // String of all alphanumeric character 
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    // Shufle the $str_result and returns substring 
    // of specified length 
    return substr(
        str_shuffle($str_result),
        0,
        10
    );
}
/**
 * Update numeric member level base on acf member level field.
 *
 * @param  int $post_id 
 */
function nab_update_company_member_level_meta_num($post_id)
{

    if ('company' === get_post_type($post_id)) {

        $num_member_level_array = array(
            'standard'  => 1,
            'plus'      => 2,
            'premium'   => 3,
        );

        $member_level       = strtolower(get_field('member_level', $post_id));
        $num_member_level   = isset($num_member_level_array[$member_level]) ? $num_member_level_array[$member_level] : 0;

        update_post_meta($post_id, 'member_level_num', $num_member_level);
    }
}

function nab_sync_user_to_live()
{

    global $wpdb;

    $user_id = filter_input(INPUT_GET, 'u', FILTER_SANITIZE_NUMBER_INT);

    if (isset($user_id) && !empty($user_id)) {

        $final_results  = array();

        $user_query             = $wpdb->prepare("SELECT * FROM {$wpdb->users} WHERE ID = %d", $user_id);
        $user_result            = $wpdb->get_row($user_query, ARRAY_A);
        $final_results['user']  = $user_result;
        $final_results['meta']  = get_user_meta($user_id);

        $fields_string = http_build_query(array('user_data' => $final_results['user'], 'meta_data' => $final_results['meta']));

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://nabshow-qa.go-vip.net/amplify/wp-json/nab/request/sync-user-to-live',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $fields_string,
            CURLOPT_HTTPHEADER => array(
                'Cookie: PHPSESSID=hj847uemchb3njj9ritacchpdn'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response);
        $msg    = isset($result->success) && $result->success ? "User " . $user_id . " sync successfully" : "Error while sync user " . $user_id;
    ?>
        <div class="updated notice">
            <p><?php echo esc_html($msg); ?></p>
        </div>
<?php
    }
}

function nab_register_user_api_endpoints()
{

    register_rest_route('nab', '/request/sync-user-to-live', array(
        'methods'             => 'POST',
        'callback'            => 'nab_sync_beta_user_to_live',
        'permission_callback' => '__return_true',
        'args'                => array(
            'user_data'  => array(
                'validate_callback' => function ($param) {
                    return is_array($param);
                },
            ),
            'meta_data' => array(
                'validate_callback' => function ($param) {
                    return is_array($param);
                },
            ),
        ),
    ));
}

function nab_sync_beta_user_to_live(WP_REST_Request $request)
{

    $user_data      = $request->get_param('user_data');
    $meta_data      = $request->get_param('meta_data');
    $final_result   = array('success' => false);

    if (is_array($user_data) && is_array($meta_data)) {

        global $wpdb;

        if ((isset($user_data['user_email']) && !empty($user_data['user_email'])) && (isset($user_data['ID']) && !empty($user_data['ID']))) {

            $user_exist = email_exists($user_data['user_email']);

            if (!$user_exist) {

                $is_username_exist = username_exists( $user_data['user_login'] );
                
                if ( $is_username_exist ) {
                    $user_data['user_login'] = wc_create_new_customer_username($user_data['user_email']);
                }

                $table_name = $wpdb->users;

                $user_id = $wpdb->insert(
                    $table_name,
                    array(
                        'user_login'            => $user_data['user_login'],
                        'user_pass'             => $user_data['user_pass'],
                        'user_nicename'         => $user_data['user_nicename'],
                        'user_email'            => $user_data['user_email'],
                        'user_url'              => $user_data['user_url'],
                        'user_registered'       => $user_data['user_registered'],
                        'user_activation_key'   => $user_data['user_activation_key'],
                        'user_status'           => $user_data['user_status'],
                        'display_name'          => $user_data['display_name'],
                        'spam'                  => $user_data['spam'],
                        'deleted'               => $user_data['deleted']
                    ),
                    array(
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%d',
                        '%s',
                        '%d',
                        '%d'
                    )
                );

                if ( $user_id ) {

                    $user_id = $wpdb->insert_id;
                }
            } else {
                $user_id = $user_exist;

                $table_name = $wpdb->users;

                $wpdb->update(
                    $table_name,
                    array(
                        'user_nicename' =>  $user_data['user_nicename'],
                        'display_name'  =>  $user_data['display_name']
                    ),
                    array(
                        'ID'   => $user_id
                    ),
                    array(
                        '%s',
                        '%s'
                    ),
                    array(
                        '%d'
                    )
                );
            }

            if ($user_id) {

                $exclude_metas = array(
                    'profile_picture',
                    'banner_image',
                    'nab_purchased_product_2020',
                    'nab_customer_product_bookmark',
                );

                foreach ($meta_data as $key => $value) {

                    if (!empty($value[0]) && !in_array($key, $exclude_metas, true)) {

                        if (is_serialized($value[0])) {
                            $value[0] = maybe_unserialize($value[0]);
                        }
                        update_user_meta($user_id, $key, $value[0]);
                    }
                }

                $final_result['success']  = true;
            }
        }
    }

    return new WP_REST_Response($final_result, 200);
}

/**
 * Redirect user to login page when access protected pages.
 */
function nab_redirect_user_to_login_page() {

    global $post;

    if ( isset( $post->ID ) && ! empty( $post->ID ) && ! is_user_logged_in() ) {

        $content_accessible = get_post_meta( $post->ID, 'content_accessible', true);

        if ( $content_accessible ) {
            $redirect_url =  add_query_arg( array( 'r' => get_the_permalink() ), wc_get_page_permalink( 'myaccount' ) );
            wp_redirect( $redirect_url );
            exit();
        }
    }
}