<?php
function nab_amplify_plugin_block_categories($categories)
{
    return array_merge(
        array(
            array(
                'slug'  => 'nab_amplify',
                'title' => __('Nab Amplify'),
            ),
        ),
        $categories
    );
}
/**
 * enqueue Block Files
 */
function amplify_block_editor_assets()
{
    wp_register_script(
        'amplify_theme_block',
        get_template_directory_uri() . '/blocks/block.build.js',
        array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components')
    );
    // editor css
    wp_enqueue_style('amplify-jquery-ui-css', get_template_directory_uri() . '/assets/css/jquery-ui.css');
    wp_register_style(
        'amplify_theme_block',
        get_template_directory_uri() . '/assets/css/block.css'
    );
    wp_enqueue_style('amplify-font-css', get_template_directory_uri() . '/assets/fonts/fonts.css');
    wp_enqueue_script('amplify-tab-front-tab-js', get_template_directory_uri() . '/blocks/block/tabs/assets/js/tab.js', array('jquery'), null, true);
    wp_register_script(
        'amplify_tab_block',
        get_template_directory_uri() . '/assets/js/jquery-ui.js',
        array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components')
    );
    wp_enqueue_script('amplify-tab-jquery-js', get_template_directory_uri() . '/assets/js/jquery-ui.js', array('jquery'), null, true);
    register_block_type('rg/blocks', array(
        'editor_script' => 'amplify_theme_block',
        'editor_style'  => 'amplify_theme_block',
    ));
    wp_enqueue_style('amplify-trending-activity-css', get_template_directory_uri() . '/blocks/block/trending-activity/assets/css/trending-activity.css');
}
/**
 * enqueue Block Front Files
 */
function amplify_block_front_assets()
{
    // Front css
    wp_enqueue_style('amplify-jquery-ui-front-css', get_template_directory_uri() . '/assets/css/jquery-ui.css');
    wp_enqueue_style('amplify-block-front-style', get_template_directory_uri() . '/assets/css/block-front.css');
    wp_enqueue_script('amplify-tab-front-jquery-js', get_template_directory_uri() . '/assets/js/jquery-ui.js', array('jquery'), null, true);
    wp_enqueue_script('amplify-block-front-js', get_template_directory_uri() . '/blocks/custom.js', array('jquery'), null, true);
    wp_enqueue_script('amplify-tab-front-tab-js', get_template_directory_uri() . '/blocks/block/tabs/assets/js/tab.js', array('jquery'), null, true);
    wp_enqueue_style('amplify-trending-activity-css', get_template_directory_uri() . '/blocks/block/trending-activity/assets/css/trending-activity.css');
}

/**
 * Register dynamic trending activity block
 */

register_block_type(
    'amplify/trendingactivity',
    array(
        'editor_script'   => 'md_case_study_block_js',
        'editor_style'    => 'md_case_study_editor_css',
        'style'           => 'md_case_study_frontend_css',
        'attributes'      => ['checkedItems' => [
            'type'  => 'array',
            'items' => ['type' => ''],
        ]],
        'render_callback' => 'trendingactivity_render',

    )
);

/**
 * Callback function for the trending activity block
 *
 * @since 1.0.0
 */
function trendingactivity_render($attributes)
{

    global $wpdb;
    $post_type_count    = count($attributes['checkedItems']);
    $html               = '';

    if (!empty($attributes['checkedItems'])) {

        $post_arr = [];

        foreach ($attributes['checkedItems'] as $key => $post_type) {

            $table_name         = $wpdb->prefix . 'nab_user_reations';
            $prepare_sql        = $wpdb->prepare("SELECT COUNT(*) as total_reaction,post_id,post_type FROM `$table_name` WHERE post_type= '$post_type' group by post_id ORDER BY COUNT(*) DESC ");
            $total_reactions    = $wpdb->get_results($prepare_sql);

            $post_count = return_post_count($post_type_count);
            $post_arr[] = array_slice($total_reactions, 0, $post_count[$key]);
        }

        if (is_array($post_arr) && count($post_arr) > 0) {

            ob_start();
?>
            <div class="trending_activity_wrapper">
                <?php
                foreach ($post_arr as $key => $post_ids) {

                    $content_class = 'company-products' ===  $post_ids[$key]->post_type ? 'related-content' : 'related-content-2';

                    foreach ($post_ids as $post) {

                        $post_data          = get_post($post->post_id);
                        $author_id          = $post_data->post_author;
                        $total_reactions    = $post->total_reaction;
                        $thumbnail_url      = has_post_thumbnail() ? get_the_post_thumbnail_url($post_data->ID) : nab_placeholder_img();

                        if ($post->post_type === 'company-products') {

                ?>
                            <div class="<?php echo esc_attr($content_class); ?>">
                                <div class="item option-5">
                                    <div class="inner">
                                        <div class="image">
                                            <span class="fa fa-bookmark-o amp-bookmark "></span>
                                            <img src="<?php echo esc_url($thumbnail_url); ?>" alt="Item Thumbnail" />
                                        </div>
                                        <div class="related-content-wrap">
                                            <h2 class="title"><?php echo $post_data->post_title; ?></h2>
                                            <strong class="sub-title"></strong>
                                            <div class="button-wrap">
                                                <div class="user-reacted-item">
                                                    <ul class="reacted-list">
                                                        <?php nab_get_reacted_item_list($post_data->ID); ?>
                                                    </ul>
                                                    <span class="react-count"><?php echo esc_html(0 < (int) $total_reactions ? $total_reactions : ''); ?></span>
                                                </div>
                                                <a href="<?php echo esc_url(get_post_permalink($post->post_id)); ?>" class="btn">View Product</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="<?php echo esc_attr($content_class); ?>">
                                <div class="item">
                                    <div class="inner">
                                        <h3 class="title"><?php echo $post_data->post_title; ?></h3>
                                        <strong class="sub-title"><?php the_author_meta('user_nicename', $author_id); ?> </strong>
                                        <div class="button-wrap">
                                            <div class="user-reacted-item">
                                                <ul class="reacted-list">
                                                    <?php nab_get_reacted_item_list($post_data->ID); ?>
                                                </ul>
                                                <span class="react-count"><?php echo esc_html(0 < (int) $total_reactions ? $total_reactions : ''); ?></span>
                                            </div>
                                            <a href="<?php echo esc_url(get_post_permalink($post->post_id)); ?>" class="btn">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    }
                }
                ?>
            </div>
    <?php

            $html = ob_get_contents();
            ob_end_clean();
        }
    } else {
        $html = 'Please select content type!';
    }
    return $html;
}

function return_post_count($count)
{

    $arr = array();

    if ($count === 1) {
        $arr = array("0" => 4, "1" => 0, "2" => 0, "3" => 0);
    } else if ($count === 2) {
        $arr = array("0" => 2, "1" => 2, "2" => 0, "3" => 0);
    } else if ($count === 3) {
        $arr = array("0" => 2, "1" => 1, "2" => 1, "3" => 0);
    } else if ($count === 4) {
        $arr = array("0" => 1, "1" => 1, "2" => 1, "3" => 1);
    }

    return $arr;
}

function nab_register_amplify_dynamic_blocks()
{

    register_block_type('nab/company-details', array(
        'render_callback' => 'nab_company_details_render_callback',
    ));

    register_block_type('nab/company-products', array(
        'attributes'      => array(
            'itemToFetch' => array(
                'type'    => 'number',
                'default' => 4,
            ),
            'companyCategory'  => array(
                'type'    => 'array',
                'default' => [],
                'items'   => [
                    'type' => 'string'
                ]
            ),
            'displayOrder' => array(
                'type'    => 'string',
                'default' => 'DESC',
            )
        ),
        'render_callback' => 'nab_company_produts_render_callback',
    ));

    register_block_type('nab/company-events', array(
        'attributes'      => array(
            'itemToFetch' => array(
                'type'    => 'number',
                'default' => 4,
            ),
            'companyCategory'  => array(
                'type'    => 'array',
                'default' => [],
                'items'   => [
                    'type' => 'string'
                ]
            ),
            'displayOrder' => array(
                'type'    => 'string',
                'default' => 'DESC',
            )
        ),
        'render_callback' => 'nab_company_events_render_callback',
    ));

    register_block_type('nab/company-content', array(
        'attributes'      => array(
            'itemToFetch' => array(
                'type'    => 'number',
                'default' => 4,
            ),
            'companyCategory'  => array(
                'type'    => 'array',
                'default' => [],
                'items'   => [
                    'type' => 'string'
                ]
            ),
            'displayOrder' => array(
                'type'    => 'string',
                'default' => 'DESC',
            )
        ),
        'render_callback' => 'nab_company_content_render_callback',
    ));
    register_block_type('nab/company-employees', array(
        'attributes'      => array(
            'itemToFetch' => array(
                'type'    => 'number',
                'default' => 4,
            )
        ),
        'render_callback' => 'nab_company_employees_render_callback',
    ));
}

function nab_company_details_render_callback($attributes)
{

    $class_name         = isset($attributes['className']) && !empty($attributes['className']) ? $attributes['className'] : '';
    $company_id         = get_the_ID();
    $about_company      = get_field('about_company', $company_id);
    $company_location   = get_field('company_location', $company_id);
    $company_website    = get_field('company_website', $company_id);
    $point_of_contact   = get_field('point_of_contact', $company_id);
    $user_id            = get_current_user_id();
    $admin_id           = get_field('company_user_id', $company_id);
    $company_product_categories = get_field('product_categories', $company_id);

    // Get images.
    $user_images = nab_amplify_get_user_images($point_of_contact);

    ob_start();
    ?>
    <div class="company-details-wrapper <?php echo esc_attr($class_name); ?>">
        <div class="container">
            <div class="company-details-inner">
                <div class="company-about-outer">
                    <h2>About</h2>
                    <div class="company-about-inner">
                        <p><?php echo esc_html($about_company); ?></p>
                        <?php if (!empty($admin_id) && in_array($user_id, $admin_id)) { ?>
                            <div class="edit-company-about-control">
                                <span class="edit-company-about edit-icon" data-action="company-about" id="edit-company-about" data-bp-tooltip="Edit Company Details">
                                    <i class="fa fa-pencil"></i>
                                </span>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="company-contact-outer">
                    <h2>Contact Info</h2>
                    <div class="company-contact-inner">
                        <?php if (!empty($admin_id) && in_array($user_id, $admin_id)) { ?>
                            <div class="edit-company-about-control">
                                <span class="edit-company-about edit-icon" data-action="company-info" id="edit-company-about" data-bp-tooltip="Edit Company Details">
                                    <i class="fa fa-pencil"></i>
                                </span>
                            </div>
                        <?php } ?>
                        <div class="company-contact-inner-box">
                            <ul>
                                <?php
                                if (!empty($company_location)) {
                                ?>
                                    <li><span>Location:</span>
                                        <?php echo isset($company_location['_street_line_1']) && $company_location['_street_line_1'] != '' ? $company_location['_street_line_1'] . '<br>' : ''; ?>
                                        <?php echo isset($company_location['street_line_2']) && $company_location['street_line_2'] != '' ? $company_location['street_line_2'] . '<br>' : ''; ?>
                                        <?php echo isset($company_location['street_line_3']) && $company_location['street_line_3'] != '' ? $company_location['street_line_3'] . '<br>' : ''; ?>
                                        <?php echo isset($company_location['city']) && $company_location['city'] != '' ? $company_location['city'] . ',' : ''; ?>
                                        <?php echo isset($company_location['state']) && $company_location['state'] != '' ? $company_location['state'] . ',' : ''; ?>
                                        <?php echo isset($company_location['zipcode']) && $company_location['zipcode'] != '' ? $company_location['zipcode'] . '<br>' : ''; ?>
                                        <?php echo isset($company_location['country']) && $company_location['country'] != '' ? $company_location['country'] : ''; ?>
                                    </li>
                                <?php
                                }
                                if (!empty($company_website)) {
                                ?>
                                    <li>
                                        <span>Website:</span>
                                        <a href="<?php echo esc_html($company_website); ?>" target="_blank"><?php echo esc_html($company_website); ?></a>
                                    </li>
                                <?php
                                }
                                if (!empty($point_of_contact)) {
                                ?>
                                    <li>
                                        <span>Point of contact:</span>
                                        <div class="author-details-box">
                                            <div class="author-info">
                                                <div class="author-image">
                                                    <a href="<?php echo bp_core_get_user_domain($point_of_contact); ?>"><img src="<?php echo esc_url($user_images['profile_picture']) ?>" /></a>
                                                </div>
                                                <div class="author-details">
                                                    <h3 class="author-title"><a href="<?php echo bp_core_get_user_domain($point_of_contact); ?>"><?php echo get_the_author_meta('user_nicename', $point_of_contact); ?></a></h3>
                                                    <span class="author-subtitle"><?php echo get_user_meta($point_of_contact, 'attendee_title', true); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php
                                }
                                if (!empty($company_product_categories) && $company_product_categories[0] !== 0) {
                                ?>
                                    <li>
                                        <span>Product Categories:</span>
                                        <div class="amp-tag-main">
                                            <ul class="amp-tag-list">
                                                <?php
                                                foreach ($company_product_categories as $comp_prod_cat) {
                                                    $terms = get_term_by('id', $comp_prod_cat, 'company-product-category');
                                                ?>
                                                    <li>
                                                        <a href="<?php echo get_search_link() . '?s=' . $terms->slug; ?>" class="btn"><?php echo $terms->name; ?></a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $html = ob_get_clean();

    return $html;
}

function nab_company_produts_render_callback($attributes)
{

    global $post;

    $posts_per_page     = isset($attributes['itemToFetch']) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 4;
    $display_order      = isset($attributes['displayOrder']) && !empty($attributes['displayOrder']) ? $attributes['displayOrder'] : 'DESC';
    $class_name         = isset($attributes['className']) && !empty($attributes['className']) ? $attributes['className'] : '';
    $is_company_admin   = false;
    $company_id         = $post->ID;

    if (is_user_logged_in()) {

        $company_id         = get_the_ID();
        $user_id            = get_current_user_id();
        $admin_id           = get_field('company_user_id', $company_id);
        $can_add_product    = get_field('admin_can_add_product', $company_id);

        if (!empty($admin_id) && in_array($user_id, $admin_id) && $can_add_product) {

            $is_company_admin   = true;
            $posts_per_page     = $posts_per_page - 1;
        }
    }

    $query_args = array(
        'post_type'         => 'company-products',
        'post_status'       => 'publish',
        'posts_per_page'    => $posts_per_page,
        'orderby'           => 'date',
        'order'             => $display_order,
        'meta_key'        => 'nab_selected_company_id',
        'meta_value'    => $company_id
    );

    $product_query = new WP_Query($query_args);

    $html       = '';
    $total_post = $product_query->found_posts;

    if ($product_query->have_posts() || $is_company_admin) {

        ob_start();
    ?>
        <div class="company-products <?php echo esc_attr($class_name); ?>">
            <div class="amp-item-main">
                <div class="amp-item-heading">
                    <h3>Products <span>(<?php echo esc_html($total_post); ?> RESULTS)</span></h3>
                    <?php
                    if ($total_post > 4) {
                    ?>
                        <div class="amp-view-more">
                            <a href="#" class="view-more-arrow">View All</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="amp-item-wrap" id="company-products-list">
                    <?php
                    if ($is_company_admin) {
                    ?>
                        <div class="amp-item-col add-new-item">
                            <div class="amp-item-inner">
                                <div class="add-item-wrap">
                                    <i class="action-edit add-item-icon fa fa-pencil"></i>
                                    <span class="add-item-label">Add Product</span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }

                    while ($product_query->have_posts()) {

                        $product_query->the_post();


                        $product_link        = get_the_permalink();
                        $product_category   = get_the_terms(get_the_ID(), 'company-product-category');
                        $product_medias = get_field('product_media', get_the_ID());

                    ?>
                        <div class="amp-item-col">
                            <div class="amp-item-inner">
                                <div class="amp-item-cover">
                                    <?php

                                    $thumbnail_url = '';

                                    if (!empty($product_medias[0]['product_media_file'])) {
                                        $thumbnail_url = $product_medias[0]['product_media_file']['url'];
                                    } else {
                                        $thumbnail_url =  !empty($thumbnail_url) ?  $thumbnail_url : nab_placeholder_img();
                                    }

                                    ?>
                                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="Product Image">
                                </div>
                                <div class="amp-item-info">
                                    <div class="amp-item-content">
                                        <h4>
                                            <a href="<?php echo esc_url($product_link); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                        </h4>
                                        <?php
                                        if (!empty($product_category) && !is_wp_error($product_category)) {

                                        ?>
                                            <span class="product-company"><?php echo esc_html($product_category[0]->name); ?></span>
                                        <?php
                                        }
                                        ?>
                                        <div class="amp-actions">
                                            <div class="search-actions nab-action">
                                                <a href="<?php echo esc_url($product_link); ?>" class="button">View Product</a>
                                                <?php
                                                if ($is_company_admin) {
                                                ?>
                                                    <div class="nab-action-row">
                                                        <i class="action-edit fa fa-pencil" data-id="<?php echo get_the_ID(); ?>"></i>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php

        $html = ob_get_clean();
    }
    wp_reset_postdata();

    return $html;
}

function nab_company_events_render_callback($attributes)
{
    global $post;

    $posts_per_page     = isset($attributes['itemToFetch']) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 4;
    $display_order      = isset($attributes['displayOrder']) && !empty($attributes['displayOrder']) ? $attributes['displayOrder'] : 'DESC';
    $class_name         = isset($attributes['className']) && !empty($attributes['className']) ? $attributes['className'] : '';
    $company_id         = $post->ID;

    $query_args = array(
        'post_type'         => 'tribe_events',
        'post_status'       => 'publish',
        'posts_per_page'    => $posts_per_page,
        'orderby'           => 'date',
        'order'             => $display_order,
        'meta_key'        => 'nab_selected_company_id',
        'meta_value'    => $company_id
    );


    $event_query = new WP_Query($query_args);

    $html       = '';
    $total_post = $event_query->found_posts;

    if ($event_query->have_posts()) {

        ob_start();

    ?>
        <div class="company-events <?php echo esc_attr($class_name); ?>">
            <div class="amp-item-main">
                <div class="amp-item-heading">
                    <h3>Events <span>(<?php echo esc_html($total_post); ?> RESULTS)</span></h3>
                    <?php
                    if ($total_post > 4) {
                    ?>
                        <div class="amp-view-more">
                            <a href="#" class="view-more-arrow">View All</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="amp-item-wrap" id="company-events-list">
                    <?php
                    $current_site_url = get_site_url();

                    while ($event_query->have_posts()) {

                        $event_query->the_post();

                        $thumbnail_url  = has_post_thumbnail() ? get_the_post_thumbnail_url() : nab_placeholder_img();                        
                        $event_date     = get_post_meta(get_the_ID(), '_EventStartDate', true);
                        $event_link 	= get_post_meta( get_the_ID(), '_EventURL', true );
                        $event_link     = ! empty( $event_link ) ? trim( $event_link ) : '#';
                        $target			= 0 === strpos( $event_link, $current_site_url ) ? '_self' : '_blank';
                    ?>
                        <div class="amp-item-col">
                            <div class="amp-item-inner">
                                <div class="amp-item-cover">
                                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="Product Image">
                                </div>
                                <div class="amp-item-info">
                                    <div class="amp-item-content">
                                        <h4>
                                            <a href="<?php echo esc_url($event_link); ?>" target="<?php echo esc_attr( $target ); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                        </h4>
                                        <?php
                                        if (!empty($event_date)) {

                                        ?>
                                            <span class="event-date"><?php echo esc_html(date_format(date_create($event_date), 'l, F j')); ?></span>
                                        <?php
                                        }
                                        ?>
                                        <div class="amp-actions">
                                            <div class="search-actions">
                                                <a href="<?php echo esc_url($event_link); ?>" class="button" target="<?php echo esc_attr( $target ); ?>">View Event</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
        $html = ob_get_clean();
    }
    wp_reset_postdata();

    return $html;
}

function nab_company_content_render_callback($attributes)
{

    global $post;

    $posts_per_page     = isset($attributes['itemToFetch']) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 4;
    $display_order      = isset($attributes['displayOrder']) && !empty($attributes['displayOrder']) ? $attributes['displayOrder'] : 'DESC';
    $class_name         = isset($attributes['className']) && !empty($attributes['className']) ? $attributes['className'] : '';
    $company_id         = $post->ID;

    $query_args = array(
        'post_type'         => 'articles',
        'post_status'       => 'publish',
        'posts_per_page'    => $posts_per_page,
        'orderby'           => 'date',
        'order'             => $display_order,
        'meta_key'        => 'nab_selected_company_id',
        'meta_value'    => $company_id

    );


    $content_query = new WP_Query($query_args);

    $html       = '';
    $total_post = $content_query->found_posts;

    if ($content_query->have_posts()) {

        ob_start();
    ?>
        <div class="company-events <?php echo esc_attr($class_name); ?>">
            <div class="amp-item-main">
                <div class="amp-item-heading">
                    <h3>Content <span>(<?php echo esc_html($total_post); ?> RESULTS)</span></h3>
                    <?php
                    if ($total_post > 4) {
                    ?>
                        <div class="amp-view-more">
                            <a href="#" class="view-more-arrow">View All</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="amp-item-wrap" id="company-content-list">
                    <?php
                    while ($content_query->have_posts()) {

                        $content_query->the_post();

                        $thumbnail_url     = has_post_thumbnail() ? get_the_post_thumbnail_url() : nab_placeholder_img();
                        $event_link     = get_the_permalink();
                        $post_date      = get_the_date('M. j, Y');
                    ?>
                        <div class="amp-item-col">
                            <div class="amp-item-inner">
                                <div class="amp-item-cover">
                                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="Product Image">
                                </div>
                                <div class="amp-item-info">
                                    <div class="amp-item-content">
                                        <h4>
                                            <a href="<?php echo esc_url($event_link); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                        </h4>
                                        <?php
                                        if (!empty($post_date)) {

                                        ?>
                                            <span class="event-date">Date Published: <?php echo esc_html($post_date); ?></span>
                                        <?php
                                        }
                                        ?>
                                        <div class="amp-actions">
                                            <div class="search-actions">
                                                <a href="<?php echo esc_url($event_link); ?>" class="button">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php

        $html = ob_get_clean();
    }

    wp_reset_postdata();


    return $html;
}

function nab_company_employees_render_callback($attributes)
{

    $posts_per_page     = isset($attributes['itemToFetch']) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 4;
    $class_name         = isset($attributes['className']) && !empty($attributes['className']) ? $attributes['className'] : '';
    $company_id         = get_the_ID();
    $employees_id       = get_field('company_employees', $company_id);
    $html               = '';

    if (is_array($employees_id) && count($employees_id) > 0) {

        $members_query = array(
            'page'         => 1,
            'per_page'     => $posts_per_page,
            'include'   => $employees_id
        );

        if (bp_has_members($members_query)) {

            global $members_template;

            $total_employees = $members_template->total_member_count;

            ob_start();
        ?>
            <div class="amp-item-main">
                <div class="amp-item-heading">
                    <h3>Company Employees <span>(<?php echo esc_html($total_employees); ?> RESULTS)</span></h3>
                    <?php
                    if ($total_employees > 4) {
                    ?>
                        <div class="amp-view-more">
                            <a href="#" class="view-more-arrow">View All</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="amp-item-wrap" id="compnay-employees-list">
                    <?php
                    while (bp_members()) {

                        bp_the_member();

                        $member_user_id = bp_get_member_user_id();
                        $user_full_name = bp_get_member_name();

                        if (empty(trim($user_full_name))) {

                            $user_full_name = get_the_author_meta('first_name', $member_user_id) . ' ' . get_the_author_meta('last_name', $member_user_id);
                        }

                        $company    = get_user_meta($member_user_id, 'attendee_company', true);
                        $ctitle     = get_user_meta($member_user_id, 'attendee_title', true);
                        $company    = $ctitle ? $ctitle . ' | ' . $company : $company;

                        $user_images     = nab_amplify_get_user_images($member_user_id);
                    ?>
                        <div class="amp-item-col">
                            <div class="amp-item-inner">
                                <div class="amp-item-cover">
                                    <img src="<?php echo esc_url($user_images['banner_image']); ?>" alt="Cover Image">
                                </div>
                                <div class="amp-item-info">
                                    <div class="amp-item-avtar">
                                        <a href="<?php bp_member_permalink(); ?>">
                                            <img src="<?php echo esc_url($user_images['profile_picture']); ?>" alt="Profile Picture">
                                        </a>
                                    </div>
                                    <div class="amp-item-content">
                                        <h4><a href="<?php bp_member_permalink(); ?>"><?php echo esc_html($user_full_name); ?></a></h4>
                                        <span class="company-name"><?php echo esc_html($company); ?></span>
                                        <div class="amp-actions">
                                            <?php echo nab_amplify_bp_get_friendship_button($member_user_id); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
<?php
            $html = ob_get_clean();
        }
    }

    return $html;
}
