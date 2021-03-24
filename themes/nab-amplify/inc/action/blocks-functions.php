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
                        $thumbnail_url      = nab_amplify_get_featured_image($post_data->ID);

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
                'default' => 100,
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
    register_block_type('nab/company-feature', array(
        'render_callback' => 'nab_company_feature_render_callback',
    ));

    register_block_type('nab/downloadable-pdfs', array(
        'attributes'      => array(
            'itemToFetch' => array(
                'type'    => 'number',
                'default' => 10,
            ),
            'displayOrder' => array(
                'type'    => 'string',
                'default' => 'DESC',
            )
        ),
        'render_callback' => 'nab_company_downlodable_pdfs_callback',
    ));

    register_block_type('nab/regional-addressess', array(
        'render_callback' => 'nab_regional_addressess_render_callback',
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
    $member_level       = get_field( 'member_level', $company_id );


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
                        <?php if ($about_company) {
                        ?>
                            <p><?php echo $about_company ? clean_post_content($about_company) : ''; ?></p>
                        <?php
                        } else {
                        ?>
                            <p>Details coming soon.</p>
                        <?php
                        } ?>

                    </div>
                </div>
                <div class="company-contact-outer">
                    <h2>Contact Info</h2>
                    <?php if (!empty($admin_id) && in_array($user_id, $admin_id)) { ?>
                        <div class="edit-company-about-control">
                            <span class="edit-company-about edit-icon" data-action="company-info" id="edit-company-about" data-bp-tooltip="Edit Company Details">
                                <i class="fa fa-pencil"></i>
                            </span>
                        </div>
                    <?php } ?>
                    <div class="company-contact-inner">

                        <div class="company-contact-inner-box">
                            <ul>
                                <?php
                                if (!empty($company_location)) {
                                ?>
                                    <li><span class="company-location-label">Location:</span>
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
                                if (!empty($point_of_contact) && ( 'plus' === strtolower( $member_level ) || 'premium' === strtolower( $member_level ) ) ) {
                                ?>
                                    <li>
                                        <span>Point of contact:</span>
                                        <div class="author-details-box">
                                            <div class="author-info">
                                                <div class="author-image">
                                                    <a href="<?php echo bp_core_get_user_domain($point_of_contact); ?>"><img src="<?php echo esc_url($user_images['profile_picture']) ?>" /></a>
                                                </div>
                                                <div class="author-details">
                                                    <h3 class="author-title"><a href="<?php echo bp_core_get_user_domain($point_of_contact); ?>"><?php echo nab_get_author_fullname($point_of_contact); ?></a></h3>
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
                                                $home_url = rtrim(get_site_url(), '/') . '/';
                                                foreach ($company_product_categories as $comp_prod_cat) {

                                                    $terms          = get_term_by('id', $comp_prod_cat, 'company-product-category');
                                                    $tag_search_url = add_query_arg(array('s' => $terms->name), $home_url);
                                                ?>
                                                    <li>
                                                        <a href="<?php echo esc_url($tag_search_url); ?>" class="btn"><?php echo $terms->name; ?></a>
                                                    </li>
                                                <?php
                                                }
                                                ?>
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

    $posts_per_page     = isset($attributes['itemToFetch']) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 100;
    $display_order      = isset($attributes['displayOrder']) && !empty($attributes['displayOrder']) ? $attributes['displayOrder'] : 'DESC';
    $class_name         = isset($attributes['className']) && !empty($attributes['className']) ? $attributes['className'] : '';
    $is_company_admin   = false;
    $company_id         = $post->ID;
    $member_level = get_field('member_level', $company_id);
    $post_status        = array('publish');
    if (is_user_logged_in()) {

        $company_id         = get_the_ID();
        $user_id            = get_current_user_id();
        $admin_id           = get_field('company_user_id', $company_id);        

        if (!empty($admin_id) && in_array($user_id, $admin_id) ) {

            $is_company_admin   = true;
            $posts_per_page     = $posts_per_page - 1;
            $post_status[]      = 'draft';
        }
    }

    $query_args = array(
        'post_type'         => 'company-products',
        'post_status'       => $post_status,
        'posts_per_page'    => $posts_per_page,
    );
    $meta_query_args    = array('relation' => 'AND');
    $meta_query_args['nab_is_product_featured'] = array(
        'key'       => 'is_feature_product',
        'compare'   => 'EXISTS',
    );
    $meta_query_args[] = array(
        'key' => 'nab_selected_company_id',
        'value' => $company_id,
        'compare' => '='
    );
    $query_args['meta_query'] = $meta_query_args;
    $query_args['orderby'] = array(
        'nab_is_product_featured'   => 'DESC',
        'date'     => $display_order,
    );
    $product_query = new WP_Query($query_args);

    $html       = '';
    $total_post = $product_query->found_posts;

    if ($product_query->have_posts() || $is_company_admin) {
        if ('Standard' !== $member_level && 'select' !== $member_level && null !== $member_level && '' !== $member_level) {
            ob_start(); ?>
            <div class="company-products <?php echo esc_attr($class_name); ?>">
                <div class="amp-item-main">
                    <div class="amp-item-heading">
                        <h3>Products <span>(<?php echo esc_html($total_post); ?> RESULTS)</span></h3>
                        <?php
                        if ($total_post > $posts_per_page) {
                            $current_site_url   = rtrim(get_site_url(), '/');
                            $view_all_link      = add_query_arg(array('s' => '', 'v' => 'product'), $current_site_url); ?>
                            <div class="amp-view-more">
                                <a href="<?php echo esc_url($view_all_link); ?>" class="view-more-arrow">View All</a>
                            </div>
                        <?php
                        } ?>
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


                            $product_link       = get_the_permalink();
                            $product_category   = get_the_terms(get_the_ID(), 'company-product-category');
                            $product_medias     = nab_amplify_get_bynder_products(get_the_ID()); ?>
                            <div class="amp-item-col">
                                <div class="amp-item-inner">
                                    <div class="amp-item-cover">
                                        <?php
                                        if ($is_company_admin && 'draft' === get_post_status(get_the_ID())) {
                                        ?>
                                            <div class="amp-draft-wrapper">
                                                <span class="company-product-draft">Draft</span>
                                            </div>
                                        <?php
                                        }
                                        $thumbnail_url = '';

                                        if (!empty($product_medias[0]['product_media_file'])) {
                                            $thumbnail_url = $product_medias[0]['product_media_file']['url'];
                                        } else {
                                            $thumbnail_url =  !empty($thumbnail_url) ?  $thumbnail_url : nab_product_company_placeholder_img();
                                        } ?>
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
                                            } ?>
                                            <div class="amp-actions">
                                                <div class="search-actions nab-action">
                                                    <a href="<?php echo esc_url($product_link); ?>" class="button">View Product</a>
                                                    <?php
                                                    if ($is_company_admin) {
                                                    ?>
                                                        <div class="nab-action-row">
                                                            <i class="action-edit fa fa-pencil" data-id="<?php echo get_the_ID(); ?>"></i>
                                                        </div>
                                                    <?php
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } ?>
                    </div>
                </div>
            </div>
        <?php

            $html = ob_get_clean();
        }
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
    $member_level       = strtolower( get_field( 'member_level', $company_id ) );
    $html               = '';
    $add_event          = false;

    if ( 'plus' === $member_level || 'premium' === $member_level ) {

        if ( is_user_logged_in() ) {

            $user_id    = get_current_user_id();
            $admin_id   = get_field( 'company_user_id', $company_id );
    
            if ( ! empty( $admin_id ) && in_array( $user_id, (array) $admin_id, true ) ) {            
    
                if ( 'plus' === $member_level || 'premium' === $member_level ) {
                    $add_event  = true;
                    $class_name .= 'company-admin';
                }
            }
        }

        $current_timestamp = current_time( 'Y-m-d H:i:s' );

        $upcoming_event_args = array(
            'post_type'         => 'tribe_events',
            'post_status'       => 'publish',
            'posts_per_page'    => $posts_per_page,
            'meta_key'			=> '_EventEndDate',
            'meta_value'        => $current_timestamp,
            'meta_compare'      => '>=',
            'orderby'			=> 'meta_value',
            'order'				=> 'ASC',
            'fields'            => 'ids',
            'meta_query'        => array(
                array(
                    'key'   => 'nab_selected_company_id',
                    'value' => $company_id
                )
            )
        );

        $upcoming_event_query   = new WP_Query( $upcoming_event_args );
        $upcoming_post_ids      = $upcoming_event_query->posts;
        wp_reset_postdata();

        $past_event_args = array(
            'post_type'         => 'tribe_events',
            'post_status'       => 'publish',
            'posts_per_page'    => $posts_per_page,
            'meta_key'			=> '_EventEndDate',
            'meta_value'        => $current_timestamp,
            'meta_compare'      => '<',
            'orderby'			=> 'meta_value',
            'order'				=> 'DESC',
            'fields'            => 'ids',
            'meta_query'        => array(
                array(
                    'key'   => 'nab_selected_company_id',
                    'value' => $company_id
                )
            )
        );

        $past_event_query   = new WP_Query( $past_event_args );
        $past_post_ids      = $past_event_query->posts;        
        wp_reset_postdata();

        $final_post_id = array_unique( array_merge( $upcoming_post_ids, $past_post_ids ) );
        
        $query_args = array(
            'post_type'         => 'tribe_events',
            'post_status'       => 'publish',
            'posts_per_page'    => $posts_per_page,
            'meta_key'			=> 'nab_selected_company_id',
            'meta_value'        => $company_id,
            'post__in'          => $final_post_id,
            'orderby'           => 'post__in',
        );

        $event_query    = new WP_Query( $query_args );        
        $total_post     = $event_query->found_posts;
    
        if ( $event_query->have_posts() || $add_event ) {
    
            ob_start();
            
            $result_text = $total_post . ' RESULTS';
    
            if ( $add_event ) {
                
                $limit          = 'plus' === $member_level ? '3 TOTAL' : 'Unlimited';
                $result_text    .= ' / ' . $limit;
            }
            ?>
            <div class="company-events <?php echo esc_attr( $class_name ); ?>">
                <div class="amp-item-main">
                    <div class="amp-item-heading">
                        <h3>Events <span>(<?php echo esc_html( $result_text ); ?>)</span></h3>                        
                    </div>
                    <div class="amp-item-wrap" id="company-events-list">
                        <?php
                        if ( $add_event ) {
                            ?>
                            <div class="amp-item-col add-new-item">
                                <div class="amp-item-inner">
                                    <div class="add-item-wrap">
                                        <i class="event-add-edit-action add-item-icon fa fa-pencil" data-company-id="<?php echo esc_attr( $company_id ); ?>"></i>
                                        <span class="add-item-label">Add Event</span>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        $current_site_url = get_site_url();
    
                        while ($event_query->have_posts()) {
    
                            $event_query->the_post();
    
                            $event_post_id      = get_the_ID();
                            $thumbnail_url      = nab_amplify_get_featured_image($event_post_id, true, nab_product_company_placeholder_img());
                            $event_start_date   = get_post_meta($event_post_id, '_EventStartDate', true);
                            $event_end_date     = get_post_meta($event_post_id, '_EventEndDate', true);
                            $event_link         = get_post_meta($event_post_id, '_EventURL', true);
                            $event_link         = !empty($event_link) ? trim($event_link) : get_the_permalink();
                            $target             = 0 === strpos($event_link, $current_site_url) ? '_self' : '_blank';
                            $event_date         = date_format(date_create($event_start_date), 'l, F j');
                            $final_date         = $event_start_date;
                            $start_time         = '';
                            $end_time           = '';
                            $event_content      = wp_strip_all_tags( get_the_content() );
    
                            if (!empty($event_start_date) && !empty($event_end_date)) {
    
                                if (date_format(date_create($event_start_date), 'Ymd') !== date_format(date_create($event_end_date), 'Ymd')) {
    
                                    $event_date .= ' - ' . date_format(date_create($event_end_date), 'l, F j');
                                    $final_date = $event_end_date;
                                }
                            }

                            if ( ! empty( $event_start_date ) ) {

                                $start_time = str_replace( array( 'am','pm' ), array( 'a.m.','p.m.' ), date_format( date_create( $event_start_date ), 'g:i a' ) );
                                $start_time = str_replace(':00', '', $start_time );
            
                            }
                            if ( ! empty( $event_end_date ) ) {
            
                                $end_time   = str_replace( array( 'am','pm' ), array( 'a.m.','p.m.' ), date_format( date_create( $event_end_date ), 'g:i a' ) );
                                $end_time   = str_replace(':00', '', $end_time );
            
                            }
                            
                            if ( ! empty( $start_time ) && ! empty( $end_time ) ) {
                                
                                if ( false !== strpos( $start_time, 'a.m.' ) && false !== strpos( $end_time, 'a.m.' ) ) {
                                    $start_time = str_replace(' a.m.', '', $start_time );
                                }
                
                                if ( false !== strpos( $start_time, 'p.m.' ) && false !== strpos( $end_time, 'p.m.' ) ) {
                                    $start_time = str_replace(' p.m.', '', $start_time );
                                }
                            }
    
                            $final_date     = date_format(date_create($final_date), 'Ymd');
                            $current_date   = current_time('Ymd');
                            $opening_date   = new DateTime($final_date);
                            $current_date   = new DateTime($current_date);
                            ?>
                            <div class="amp-item-col">
                                <div class="amp-item-inner">
                                    <?php
                                    if ( $add_event ) {
                                        ?>
                                        <div class="amp-action-remove">
                                            <a href="javascript:void(0);" class="remove-event" data-id="<?php echo esc_attr( $event_post_id ); ?>" title="Remove">Remove Event</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="amp-item-cover">
                                        <?php
                                        if ($opening_date < $current_date) {
                                            ?>
                                            <div class="amp-draft-wrapper">
                                                <span class="company-product-draft">Past Event</span>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <img src="<?php echo esc_url($thumbnail_url); ?>" alt="Event Image">
                                    </div>
                                    <div class="amp-item-info">
                                        <div class="amp-item-content">
                                            <h4>
                                                <a href="<?php echo esc_url($event_link); ?>" target="<?php echo esc_attr($target); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                            </h4>
                                            <?php
                                            if ( ! empty( $event_date ) ) {
                                                ?>
                                                <span class="event-date"><?php echo esc_html( $event_date ); ?></span>
                                                <?php
                                            }
                                            if ( ! empty( $start_time ) && ! empty( $end_time ) ) {
                                                ?>
                                                <span class="event-time"><?php echo esc_html( $start_time . ' - ' . $end_time . ' ET' ); ?></span>
                                                <?php
                                            }
                                            ?>
                                            <div class="amp-actions">
                                                <div class="search-actions">
                                                    <div class="event-disc_btn">
                                                        <a href="<?php echo esc_url($event_link); ?>" class="button" target="<?php echo esc_attr($target); ?>">View Event</a>
                                                        <?php
                                                        if ( ! empty( $event_content ) ) {
                                                            ?>
                                                            <i class="fa fa-info-circle tooltip-wrap" aria-hidden="true">
                                                                <span class="tooltip"><?php echo esc_html( $event_content ); ?></span>
                                                            </i>
                                                            <?php
                                                        }
                                                        ?>                                                        
                                                    </div>
                                                    <?php
                                                    if ( $add_event ) {
                                                        ?>
                                                        <div class="nab-action-row">
                                                            <i class="event-add-edit-action edit-block-icon fa fa-pencil" data-id="<?php echo esc_attr( $event_post_id ); ?>" data-company-id="<?php echo esc_attr( $company_id ); ?>"></i>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
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
    }

    return $html;
}

function nab_company_content_render_callback($attributes)
{

    global $post;

    $posts_per_page     = isset($attributes['itemToFetch']) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 4;
    $display_order      = isset($attributes['displayOrder']) && !empty($attributes['displayOrder']) ? $attributes['displayOrder'] : 'DESC';
    $class_name         = isset($attributes['className']) && !empty($attributes['className']) ? $attributes['className'] : '';
    $is_company_admin   = false;
    $html               = '';
    $company_id         = get_the_ID();    
    $member_level       = get_field( 'member_level', $company_id );

    if ( 'premium' === strtolower( $member_level ) ) {

        ob_start();

        $display_main_heading = true;

        $article_args = array(
            'post_type'         => 'articles',
            'post_status'       => 'publish',
            'posts_per_page'    => $posts_per_page,
            'orderby'           => 'date',
            'order'             => $display_order,
            'meta_key'          => 'nab_selected_company_id',
            'meta_value'        => $company_id
        );
        $article_query  = new WP_Query( $article_args );

        if ( $article_query->have_posts() ) {
            
            $display_main_heading = false;
            ?>
            <div class="company-content <?php echo esc_attr( $class_name ); ?>">
                <div class="amp-item-main">
                    <div class="amp-item-heading">
                        <h3>Content</h3>                        
                    </div>
                    <div class="amp-item-wrap" id="company-article-list">
                        <?php                        

                        while ( $article_query->have_posts() ) {

                            $article_query->the_post();

                            $thumbnail_url  = nab_amplify_get_featured_image( get_the_ID() );
                            $article_link   = get_the_permalink();
                            $post_date      = get_the_date('M. j, Y');
                            ?>
                            <div class="amp-item-col">
                                <div class="amp-item-inner">
                                    <div class="amp-item-cover">
                                        <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="Content Image">
                                    </div>
                                    <div class="amp-item-info">
                                        <div class="amp-item-content">
                                            <h4><?php echo esc_html( get_the_title() ); ?></h4>
                                            <span class="event-date">Date Published: <?php echo esc_html( $post_date ); ?></span>
                                            <div class="amp-actions">
                                                <div class="search-actions">
                                                    <a href="<?php echo esc_url( $article_link ); ?>" class="btn">Read More</a>
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
        }
        wp_reset_postdata();
        
        if ( is_user_logged_in() ) {

            $user_id    = get_current_user_id();
            $admin_id   = get_field( 'company_user_id', $company_id );
    
            if ( ! empty( $admin_id ) && in_array( $user_id, (array) $admin_id, true ) ) {
                $is_company_admin   = true;
            }
        }
        
        $query_args = array(
            'post_type'         => 'content-submission',
            'post_status'       => 'publish',
            'posts_per_page'    => $posts_per_page,
            'orderby'           => 'date',
            'order'             => $display_order,
            'meta_key'          => 'nab_selected_company_id',
            'meta_value'        => $company_id
        );
    
    
        $content_query  = new WP_Query( $query_args );
        $total_post     = $content_query->found_posts;
    
        if ( $content_query->have_posts() || $is_company_admin ) {
            
            $remaining_count = $total_post > 3 ? 0 : 3 - $total_post;            
            ?>
            <div class="company-content <?php echo esc_attr( $class_name ); ?>">
                <div class="amp-item-main">
                    <div class="amp-item-heading">
                        <?php
                        if ( $display_main_heading ) {
                            ?>
                            <h3 class="content-main-heading">Content</h3>
                            <?php
                        }
                        ?>
                        <h4>Content Submissions</h4>
                        <p class="content-msg">As a premium member, you can submit up to 3 total pieces of editorial content for editorial consideration each year. You have <?php echo esc_html( $remaining_count ); ?> submissions remaining.</p>
                    </div>
                    <div class="amp-item-wrap" id="company-content-list">
                        <?php
                        if ( $is_company_admin && $remaining_count > 0 ) {
                            ?>
                            <div class="amp-item-col add-new-item">
                                <div class="amp-item-inner">
                                    <div class="add-item-wrap">
                                        <i class="content-add-action add-item-icon fa fa-pencil" data-company-id="<?php echo esc_attr( $company_id ); ?>"></i>
                                        <span class="add-item-label">Submit Content</span>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }

                        while ( $content_query->have_posts() ) {
    
                            $content_query->the_post();
    
                            $content_id         = get_the_ID();
                            $thumbnail_url      = nab_amplify_get_featured_image( $content_id );                            
                            $post_date          = get_the_date('M. j, Y');
                            $author_id          = get_post_field( 'post_author', $content_id );
                            $author_name        = get_user_meta( $author_id, 'first_name', true ) . ' ' . get_user_meta( $author_id, 'last_name', true );
                            $author_profile_url = bp_core_get_user_domain( $author_id );

                            if ( empty( trim( $author_name ) ) ) {
                                $author_name = get_the_author();
                            }
                            ?>
                            <div class="amp-item-col">
                                <div class="amp-item-inner">
                                    <div class="amp-item-cover">
                                        <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="Content Image">
                                    </div>
                                    <div class="amp-item-info">
                                        <div class="amp-item-content">
                                            <h4><?php echo esc_html( get_the_title() ); ?></h4>
                                            <span class="event-date">Submitted Date: <?php echo esc_html( $post_date ); ?></span>
                                            <span class="submitted-by">Submitted By: <a href="<?php echo esc_url( $author_profile_url ); ?>"><?php echo esc_html( $author_name ); ?></a></span>
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
        }

        $html = ob_get_clean();
    
        wp_reset_postdata();
    }

    return $html;
}

function nab_company_employees_render_callback($attributes)
{

    $posts_per_page     = isset($attributes['itemToFetch']) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 3;
    $class_name         = isset($attributes['className']) && !empty($attributes['className']) ? $attributes['className'] : '';
    $company_id         = get_the_ID();
    $employees_id       = get_field('company_employees', $company_id);
    $html               = '';
    $is_company_admin   =  false;
    $member_level       = get_field('member_level', $company_id);

    if ( 'Plus' === $member_level || 'Premium' === $member_level ) {
        
        $limit_employees_str = '';    

        if (is_user_logged_in()) {

            $user_id        = get_current_user_id();
            $admin_id       = get_field('company_user_id', $company_id);

            if (!empty($admin_id) && in_array($user_id, (array) $admin_id, true)) {

                $is_company_admin   = true;

                if ( 'Plus' === $member_level ) {
                    $limit_employees_str = '4 TOTAL';
                } elseif ( 'Premium' === $member_level ) {
                    $limit_employees_str = 'Unlimited';
                }
            }
        }

        $members_query = array(
            'page'      => 1,
            'per_page'  => $posts_per_page,
            'include'   => $employees_id
        );

        $total_employees = is_array($employees_id) ? count($employees_id) : 0;
        
        if ( ( bp_has_members($members_query) && $total_employees > 0 ) || ( $is_company_admin && ( 'Plus' === $member_level || 'Premium' === $member_level ) ) ) {

            global $members_template;        

            ob_start();
            ?>
            <div class="amp-item-main">
                <div class="amp-item-heading">

                    <h3>Employees <span>(<?php echo esc_html( $total_employees ); ?> RESULTS <?php echo esc_html( ! empty( $limit_employees_str ) ? ' / ' . $limit_employees_str : '' ); ?>)</span></h3>
                    <?php
                    if ($total_employees > $posts_per_page ) {
                        $current_site_url   = rtrim(get_site_url(), '/');
                        $view_all_link      = add_query_arg(array('s' => '', 'v' => 'user'), $current_site_url); ?>
                
                        <div class="amp-view-more">
                            <a href="<?php echo esc_url($view_all_link);?>" class="view-more-arrow">View All</a>
                        </div>
                    <?php
                    } ?>
                </div>
                <div class="amp-item-wrap" id="compnay-employees-list">
                    <?php
                    
                    if ( ! defined('REST_REQUEST') && $is_company_admin && ( 'Plus' === $member_level || 'Premium' === $member_level ) ) {
                        ?>
                        <div class="amp-item-col add-new-item">
                            <div class="amp-item-inner">
                                <div class="add-item-wrap">
                                    <i class="action-add-employee add-item-icon fa fa-pencil"></i>
                                    <span class="add-item-label">Add Employee</span>
                                </div>
                            </div>
                        </div>
                        <?php
                    } 

                    if (is_array($employees_id)) {
                        while (bp_members()) {
                            bp_the_member();

                            $member_user_id = bp_get_member_user_id();

                            $user_full_name = get_the_author_meta('first_name', $member_user_id) . ' ' . get_the_author_meta('last_name', $member_user_id);

                            if (empty(trim($user_full_name))) {
                                $user_full_name = bp_get_member_name();
                            }

                            $company    = get_user_meta($member_user_id, 'attendee_company', true);
                            $ctitle     = get_user_meta($member_user_id, 'attendee_title', true);
                            $company    = $ctitle ? $ctitle . ' | ' . $company : $company;

                            $user_images     = nab_amplify_get_user_images($member_user_id);
                            ?>
                            <div class="amp-item-col">
                                <div class="amp-item-inner">
                                    <?php
                                    if ( $is_company_admin && ( 'Plus' === $member_level || 'Premium' === $member_level ) ) {
                                        ?>
                                        <div class="amp-action-remove">
                                            <a href="javascript:void(0)" data-id="<?php echo $member_user_id; ?>" class="remove-employee">
                                                <i class="fa fa-minus"></i>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                    ?>
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

function nab_company_feature_render_callback($attributes)
{
    $feature_status = get_field('feature_status');
    $feature_title = get_field('feature_title');
    $feature_author = get_field('feature_author');
    $feature_desc = get_field('feature_desc');
    $feature_button_text = get_field('feature_button_text');
    $feature_button_url = get_field('feature_button_url');
    $feature_background_image = get_field('feature_background_image');
    $feature_bg_color = get_field('feature_bg_color');
    $feature_icon_image = get_field('feature_icon_image');
    $feature_status_color = get_field('feature_status_color');
    $feature_title_color = get_field('feature_title_color');
    $feature_author_color = get_field('feature_author_color');
    $feature_desc_color = get_field('feature_description_color');
    $feature_play_link = get_field('feature_play_link');
    $feature_enable_reaction = get_field('feature_enable_reaction');
    $feature_enable_button = get_field('feature_enable_button');
    $feature_button_target = get_field('feature_button_target');
    $user_id            = get_current_user_id();
    $admin_id           = get_field('company_user_id', get_the_ID());
    $member_level = get_field('member_level');

    if (is_array($feature_enable_reaction)) {
        $feature_enable_reaction = $feature_enable_reaction[0];
    }
    if (is_array($feature_enable_button)) {
        $feature_enable_button = $feature_enable_button[0];
    }
    if (is_array($feature_button_target)) {
        $feature_button_target = $feature_button_target[0];
    }

    ob_start();
    ?>

    <?php
    if (!empty($feature_title)) {
    ?>
        <div class="amp-item-wrap featured-block-wraper">
            <div class='amp-feature-block' style="<?php if ($feature_background_image) {
                                                        echo 'background-image: url(' . $feature_background_image . '); background-size: cover;';
                                                    } else {
                                                        echo  'background-color:' . $feature_bg_color . ';background-size: cover;';
                                                    } ?>">
                <div class='amp-feature-block-inner'>
                    <?php if (!empty($admin_id) && in_array($user_id, $admin_id)) { ?>
                        <span class='edit-feature-block edit-block-icon'>
                            <i class='fa fa-pencil'></i>
                        </span>
                    <?php } ?>
                    <?php if ($feature_icon_image) { ?>
                        <div class='feature-icon'>
                            <a href="<?php echo $feature_play_link; ?>" target="_self" rel="noopener noreferrer"> <img src="<?php echo $feature_icon_image; ?>" /></a>
                        </div>
                    <?php } ?>
                    <div class='amp-feature-content'>
                        <h3 class='feature-status' placeholder='Live' style="<?php echo isset($feature_status_color) ? 'color:' . $feature_status_color . ';' : ''; ?>"><?php echo isset($feature_status) ? $feature_status : 'Status'; ?></h3>
                        <h2 class='feature-title' placeholder='Creating the World' style="<?php echo isset($feature_title_color) ? 'color:' . $feature_title_color . ';' : ''; ?>"><?php echo isset($feature_title) ? $feature_title : 'Title'; ?></h2>
                        <h4 class='feature-author' placeholder='Author' style="<?php echo isset($feature_author_color) ? 'color:' . $feature_author_color . ';' : ''; ?>"><?php echo isset($feature_author) ? $feature_author : 'Author'; ?></h4>
                        <p class='feature-disc' style="<?php echo isset($feature_desc_color) ? 'color:' . $feature_desc_color . ';' : ''; ?>"><?php echo isset($feature_desc) ? $feature_desc : 'Description'; ?></p>
                        <?php if ($feature_enable_reaction === '1') { ?>
                            <div class='shortcode-wrap'>
                                <?php echo do_shortcode('[reaction_button]'); ?>
                            </div>
                        <?php }
                        if ($feature_enable_button === '1') {
                        ?>
                            <div class="button-wrap btn-link">
                                <a href="<?php echo isset($feature_button_url) ? $feature_button_url : '#'; ?>" target="<?php echo ($feature_button_target === '1') ? '_blank' : ''; ?>" rel="">
                                    <?php echo isset($feature_button_text) ? $feature_button_text : 'Button'; ?>
                                </a>
                            </div>
                        <?php
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {

        if (!empty($admin_id) && in_array($user_id, $admin_id) && !defined('REST_REQUEST')) {
            if ('Premium' === $member_level) {
        ?>
                <div class="amp-item-wrap featured-block-wraper">
                    <div class="amp-item-col add-new-item">
                        <div class="amp-item-inner">
                            <div class="add-item-wrap">
                                <i class="edit-feature-block add-item-icon fa fa-pencil"></i>
                                <span class="add-item-label">Add Featured Content</span>
                            </div>
                        </div>
                    </div>
                </div>
    <?php
            }
        } else {
            if (defined('REST_REQUEST')) {
                echo '<p class="empty-featured-block">Featured data not available!</p>';
            }
        }
    }
    ?>
    <?php
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

function nab_company_downlodable_pdfs_callback($attributes)
{

    $posts_per_page     = isset($attributes['itemToFetch']) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
    $display_order      = isset($attributes['displayOrder']) && !empty($attributes['displayOrder']) ? $attributes['displayOrder'] : 'DESC';
    $class_name         = isset($attributes['className']) && !empty($attributes['className']) ? 'company-pdfs ' . $attributes['className'] : 'company-pdfs';
    $is_company_admin   = false;
    $add_pdf            = false;
    $company_id         = get_the_ID();
    $html               = '';
    $member_level       = get_field('member_level', $company_id);

    if ('plus' === strtolower($member_level) || 'premium' === strtolower($member_level)) {
        
        if (is_user_logged_in()) {

            $user_id        = get_current_user_id();
            $admin_id       = get_field('company_user_id', $company_id);
    
            if (!empty($admin_id) && in_array($user_id, (array) $admin_id, true)) {            
    
                if ('plus' === strtolower($member_level) || 'premium' === strtolower($member_level)) {
                    $add_pdf    = true;
                    $class_name .= ' company-admin';
                }
    
                $is_company_admin   = true;
            }
        }
    
        $query_args = array(
            'post_type'         => 'downloadable-pdfs',
            'post_status'       => 'publish',
            'posts_per_page'    => $posts_per_page,
            'meta_key'          => 'nab_selected_company_id',
            'meta_value'        => $company_id,
            'order'             => $display_order,
        );
    
        $pdf_query  = new WP_Query($query_args);
        $total_post = $pdf_query->found_posts;
    
        if ($pdf_query->have_posts() || ($is_company_admin && $add_pdf)) {
    
            ob_start();
            ?>
            <div class="<?php echo esc_attr($class_name); ?>">
                <div class="amp-item-main">
                    <div class="amp-item-heading">
                        <?php
    
                        $result_text = $total_post . ' RESULTS';
    
                        if ($is_company_admin && $add_pdf) {
                            $result_text .= ' / ' . nab_get_pdf_limit_by_member_level($member_level) . ' TOTAL';
                        }
                        ?>
                        <h3>Downloadable PDFS <span>(<?php echo esc_html($result_text); ?>)</span></h3>
                    </div>
                    <div class="amp-item-wrap" id="downloadable-pdfs-list">
                        <?php
                        if ($is_company_admin && $add_pdf) {
                        ?>
                            <div class="amp-item-col add-new-item">
                                <div class="amp-item-inner">
                                    <div class="add-item-wrap">
                                        <i class="pdf-add-edit-action add-item-icon fa fa-pencil" data-company-id="<?php echo esc_attr( $company_id ); ?>"></i>
                                        <span class="add-item-label">Add PDF</span>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
    
                        while ($pdf_query->have_posts()) {
    
                            $pdf_query->the_post();
    
                            $pdf_id             = get_the_ID();
                            $thumbnail_url      = nab_amplify_get_featured_image($pdf_id);
                            $attached_pdf_id    = get_field( 'pdf_file', $pdf_id );
                            $pdf_url            = ! empty( $attached_pdf_id ) ? wp_get_attachment_url( $attached_pdf_id ) : '';
                            ?>
                            <div class="amp-item-col">
                                <div class="amp-item-inner">
                                    <?php
                                    if ($is_company_admin && $add_pdf) {
                                    ?>
                                        <div class="amp-action-remove">
                                            <a href="javascript:void(0);" class="remove-pdf" data-id="<?php echo esc_attr($pdf_id); ?>" title="Remove">Remove PDF</a>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="amp-item-cover">
                                        <img src="<?php echo esc_url($thumbnail_url); ?>" alt="PDF Thumbnail">
                                    </div>
                                    <div class="amp-item-info">
                                        <div class="amp-item-content">
                                            <h4><?php echo esc_html(get_the_title()); ?></h4>
                                            <?php
                                            if ( is_user_logged_in() ) {
                                                ?>
                                                <div class="download-pdf-input">
                                                    <div class="amp-check-container">
                                                        <div class="amp-check-wrp">
                                                            <input type="checkbox" class="dowload-checkbox" id="<?php echo esc_attr('download-checkbox-' . $pdf_id); ?>" />
                                                            <span class="amp-check"></span>
                                                        </div>
                                                        <label for="<?php echo esc_attr('download-checkbox-' . $pdf_id); ?>">I agree to receive additional information and communications from <?php echo esc_html(get_the_title($company_id)); ?></label>
                                                    </div>
                                                </div>
                                                <div class="amp-actions">
                                                    <div class="search-actions nab-action">
                                                        <a href="javascript:void(0);" data-pdf="<?php echo esc_url( $pdf_url ); ?>" class="button" disabled download>Download</a>
                                                        <?php
                                                        if ($is_company_admin && $add_pdf) {
                                                        ?>
                                                            <div class="nab-action-row">
                                                                <i class="pdf-add-edit-action edit-block-icon fa fa-pencil" data-id="<?php echo esc_attr($pdf_id); ?>" data-company-id="<?php echo esc_attr( $company_id ); ?>"></i>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php
                                            } else {
                                                $current_url = home_url(add_query_arg(NULL, NULL));
		                                        $current_url = str_replace('amplify/amplify', 'amplify', $current_url);
                                                $current_url = add_query_arg( array( 'r' => $current_url ), wc_get_page_permalink( 'myaccount' ) );
                                                ?>
                                                <div class="amp-pdf-login-msg">
                                                    <p>You must be signed in to download this content. <a href="<?php echo esc_url( $current_url ); ?>">Sign in now</a>.</p>
                                                </div>
                                                <?php
                                            }
                                            ?>
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
    }

    return $html;
}

function nab_regional_addressess_render_callback($attributes)
{
    ob_start();
    $class_name     = isset($attributes['className']) && !empty($attributes['className']) ? $attributes['className'] : '';
    $member_level   = get_field('member_level');

    if ($member_level !== '' && $member_level !== 'select' && $member_level !== 'Standard') {
    ?>
        <div class="company-products <?php echo esc_attr($class_name); ?>">
            <div class="amp-item-main">
                <div class="amp-item-heading">
                    <h3>Regional Addresses</h3>
                </div>
                <div class="amp-item-wrap" id="company-address-list">

                    <?php for ($i = 1; $i < 5; $i++) {
                        nab_get_religion_address($i, get_the_ID());
                    } ?>


                </div>
            </div>
        </div>
        <?php
    }
    $html = ob_get_clean();
    return $html;
}

function nab_get_religion_address($address_id, $company_id)
{
    $html = '';

    $user_id            = get_current_user_id();
    $admin_id           = get_field('company_user_id', $company_id);

    if ($address_id !== '0' && !empty($address_id)) {
        $address_number = array(
            '1' => 'one',
            '2' => 'two',
            '3' => 'three',
            '4' => 'four'
        );
        $address_data = get_field('regional_address_' . $address_number[$address_id], $company_id);
        if (!empty($address_data) && $address_data['street_line_1'] !== '') {

        ?>
            <div class="amp-item-col add-new-item">
                <div class="amp-item-inner">
                    <div class="add-item-wrap">
                        <?php echo isset($address_data['street_line_1']) && $address_data['street_line_1'] != '' ? $address_data['street_line_1'] . '<br>' : ''; ?>
                        <?php echo isset($address_data['street_line_2_']) && $address_data['street_line_2_'] != '' ? $address_data['street_line_2_'] . '<br>' : ''; ?>
                        <?php echo isset($address_data['city']) && $address_data['city'] != '' ? $address_data['city'] . ',' : ''; ?>
                        <?php echo isset($address_data['state_province']) && $address_data['state_province'] != '' ? nab_amplify_get_country_state($address_data['state_province'], 'state') . ',' : ''; ?>
                        <?php echo isset($address_data['zip_postal']) && $address_data['zip_postal'] != '' ? $address_data['zip_postal'] . '<br>' : ''; ?>
                        <?php echo isset($address_data['country']) && $address_data['country'] != '' ? nab_amplify_get_country_state($address_data['country'], 'country') : ''; ?>
                        <?php if (!empty($admin_id) && in_array($user_id, $admin_id)) { ?>
                            <div class="amp-actions">
                                <div class="search-actions nab-action">
                                    <div class="nab-action-row">
                                        <i class="action-remove-address edit-block-icon fa fa-times" data-id="<?php echo $address_id; ?>"></i>
                                        <i class="action-add-address edit-block-icon fa fa-pencil" data-id="<?php echo $address_id; ?>"></i>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        } else {

            if (!empty($admin_id) && in_array($user_id, $admin_id)) {
            ?>
                <div class="amp-item-col add-new-item">
                    <div class="amp-item-inner">
                        <div class="add-item-wrap">
                            <i class="action-add-address add-item-icon fa fa-pencil" data-id="<?php echo $address_id; ?>"></i>
                            <span class="add-item-label">Add Address</span>
                        </div>
                    </div>
                </div>
<?php
            }
        }
    }
}
