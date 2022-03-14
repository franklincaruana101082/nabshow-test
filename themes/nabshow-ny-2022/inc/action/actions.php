<?php
/**
 * This file contains all action hooks.
 *
 *
 * @package NABShow_LV
 */

// Sets up theme defaults and registers support for various WordPress features.
add_action( 'after_setup_theme', 'nabshow_lv_setup' );

// Set the content width in pixels, based on the theme's design and stylesheet.
add_action( 'after_setup_theme', 'nabshow_lv_content_width', 0 );

// Register sidebar for theme.
add_action( 'widgets_init', 'nabshow_lv_widgets_init' );

// Enqueue required scripts and styles for theme.
add_action( 'wp_enqueue_scripts', 'nabshow_lv_scripts' );

// Action for add gutenberg custom block
add_action( 'enqueue_block_editor_assets', 'nabshow_lv_add_block_editor_assets' );

// action to add the not-to-be-missed-archive post type.
add_action( 'init', 'nabshow_lv_not_to_be_missed_archive', 1 );

// create featured category taxonomy.
add_action( 'init', 'nabshow_lv_featured_category_taxonomies' );

// Action to register dynamic slider block
add_action( 'init', 'nabshow_lv_register_dynamic_blocks' );

// Additional filter on listing page dropdown.
add_action( 'restrict_manage_posts', 'nabshow_lv_admin_posts_filter_restrict_manage_posts' );

// Action to call after init to get all the post type and register another action for all post type.
add_action( 'admin_init', function () {

	$post_types = get_post_types( array( 'public' => true ), 'names' );

	foreach ( $post_types as $post_type ) {

		if ( "wp_block" !== $post_type || "post" !== $post_type ) {

			nabshow_lv_register_action( $post_type );
		}
	}

} );

// function to register an action for individual post type.
function nabshow_lv_register_action( $post_type ) {

	add_action( 'manage_' . $post_type . '_posts_custom_column', 'nabshow_lv_custom_columns_data', 10, 2 );
}

// Action for Remove emoji
add_action( 'get_header', 'nabshow_lv_remove_wp_emoji' );

// Action for Load JS in footer
add_action( 'get_header', 'nabshow_lv_move_scripts_to_footer' );

// Action to add tag taxonomy in ntb-missed post type.
add_action( 'init', 'nabshow_lv_create_featured_tag_taxonomies' );

// Action to add the thought-gallery-archive post type.
add_action( 'init', 'nabshow_lv_thought_gallery_archive' );

// Create thought gallery category taxonomy.
add_action( 'init', 'nabshow_lv_thought_gallery_category_taxonomies' );

// Create thought gallery tags taxonomy.
add_action( 'init', 'nabshow_lv_thought_gallery_tags_taxonomies' );

// Action to count post views of thought gallery for most popular posts.
add_action( 'wp_head', 'nabshow_lv_track_thought_gallery_views' );

// Action to get custom post types values in author template.
add_action( 'pre_get_posts', 'nabshow_lv_custom_type_to_author');

// Action to make posts hierarchical
add_action( 'registered_post_type', 'nabshow_lv_make_posts_hierarchical', 10, 2 );

// Action to enable excerpt in page
add_action( 'registered_post_type', 'nabshow_lv_enable_page_excerpt', 10, 2);

// Action to add taxonomy to page post type
add_action( 'init', 'nabshow_lv_page_category_taxonomy' );

// Action to add the news releases post type
add_action( 'init', 'nabshow_lv_register_news_releases_post_type' );

// Action to add taxonomy to the news releases post type
add_action( 'init', 'nabshow_lv_register_news_releases_taxonomy' );

//Action for register custom endpoints
add_action( 'rest_api_init', 'nabshow_lv_register_api_endpoints');

// Send email to Admins when any Author publishes any page/post.
add_action( 'publish_page', 'send_mails_on_publish', 10, 3 );
add_action( 'publish_post', 'send_mails_on_publish', 10, 3 );

// Action for set custom login logo
add_action( 'login_enqueue_scripts', 'nabshow_lv_set_custom_login_logo' );

// Action for add custom dashboard widget
add_action( 'wp_dashboard_setup', 'nabshow_lv_add_help_support_dashboard_widget' );

// Action for enqueue script on admin side
add_action( 'admin_enqueue_scripts', 'nabhsow_lv_enqueue_admin_script' );

// Action for set thought-gallery post type in author.php
add_action( 'pre_get_posts', 'nabshow_lv_set_author_list_post_type' );

// Action for change user role capability
add_action( 'admin_init', 'nabshow_lv_change_user_role_cap' );

// Action to Register Settings.
add_action( 'admin_init', 'nabshow_lv_register_settings' );

// Action for allowed Administrator, editor, author and contributor user to enter unfiltered html.
add_filter( 'map_meta_cap', 'nabshow_lv_add_unfiltered_html_capability_to_users', 1, 3 );

// action to add the Mega Menu post type.
add_action( 'init', 'nabshow_lv_register_mega_menu_post_type' );

// action to add the Mega Menu post type.
add_action( 'init', 'nabshow_lv_register_forms_data_post_type' );

// Action to enable robots.txt in multisite.
add_action( 'init', function() {
	add_rewrite_rule( '^robots\.txt$', 'index.php?robots=1', 'top' );
} );

// Action to register landing page custom post type
add_action( 'init', 'nabshow_lv_register_landing_page_post_type' );

// Action to set preloaded bock in the landing page post type 
add_action( 'admin_init', 'nabshow_lv_set_preloaded_block_in_new_landing_page' );

// Action to add the resources post type.
add_action( 'init', 'nabshow_lv_resource_page' );

// Action to add the schedule post type.
add_action( 'init', 'nabshow_lv_schedule_page' );

// Action to add the schedule item post type.
add_action( 'init', 'nabshow_lv_schedule_item' );

// Action to add the schedule table post type.
add_action( 'init', 'nabshow_lv_schedule_table' );
