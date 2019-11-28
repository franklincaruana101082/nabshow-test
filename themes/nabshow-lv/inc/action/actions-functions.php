<?php
/**
 * This file contains all action functions.
 * @package NABShow_LV
 */

/**
 * Enqueue gutenberg custom block script.
 *
 * @since 1.0.0
 */
function nabshow_lv_add_block_editor_assets() {

	wp_register_script( 'nab-gutenberg-block',
		get_template_directory_uri() . '/blocks/js/block.build.js',
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components', 'wp-dom-ready' ),
		'1.0'
	);

	wp_enqueue_script( 'nab-custom-gutenberg-block',
		get_template_directory_uri() . '/blocks/js/nabshow-block.build.js',
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components' ),
		'1.0'
	);

	wp_register_style(
		'nab-gutenberg-block',
		get_template_directory_uri() . '/blocks/css/block.css'
	);

	wp_enqueue_style( 'nabshow-lv-fonts', get_template_directory_uri() . '/assets/fonts/fonts.css' );
	wp_enqueue_style( 'nabshow-lv-font-awesome', get_template_directory_uri() . '/assets/fonts/font-awesome.min.css' );

	register_block_type( 'nab/multipurpose-gutenberg-block', array(
		'editor_script' => 'nab-gutenberg-block',
		'editor_style'  => 'nab-gutenberg-block',
	) );

	//bx-slider script and style
	wp_enqueue_script( 'nabshow-lv-bx-slider', get_template_directory_uri() . '/assets/js/jquery.bxslider.min.js', array( 'jquery' ), null, true );
	wp_enqueue_style( 'nabshow-lv-bxslider-style', get_template_directory_uri() . '/assets/css/jquery.bxslider.css' );

}

/**
 * Custom dropdown filter for post listing.
 *
 * @since 1.0.0
 */
function nabshow_lv_admin_posts_filter_restrict_manage_posts() {

	$values = array(
		'Post Title'           => 'post_title',
		'Blank Featured Image' => 'blank_featured_image',
	);
	?>
    <select name="additional_filter">
        <option value=""><?php esc_html_e( 'Additional Filter', 'nabshow-lv' ); ?></option>
		<?php
		$additional_filter = filter_input( INPUT_GET, 'additional_filter', FILTER_SANITIZE_STRING );
		$current_v         = isset( $additional_filter ) ? $additional_filter : '';
		foreach ( $values as $label => $value ) { ?>

            <option value="<?php echo esc_attr( $value ) ?>" <?php selected( $current_v, $value ); ?>><?php echo esc_html( $label ); ?></option>

		<?php }
		?>
    </select>
	<?php

	$edit_post_type = filter_input( INPUT_GET, 'post_type', FILTER_SANITIZE_STRING );

	if ( 'page' === $edit_post_type ) {

		$compact_view = filter_input( INPUT_GET, 'compact_view', FILTER_SANITIZE_STRING );
		$link_text    = 'on' === $compact_view ? 'Default View' : 'Compact View';
		$param_val    = 'on' === $compact_view ? 'off' : 'on';


		$admin_url_path = 'edit.php?post_type=' . $edit_post_type . '&compact_view=' . $param_val;
		$final_url      = admin_url( $admin_url_path );
		?>
        <a class="compactBtn button" href="<?php echo esc_url( $final_url ); ?>"><?php echo esc_html( $link_text ); ?></a>
        <input type="hidden" value="<?php echo esc_attr( $compact_view ); ?>" name="compact_view" />
		<?php
	}

}

/**
 * Show the post thumbnail in the featured image column.
 *
 * @param $column
 * @param $post_id
 *
 * @since 1.0.0
 */
function nabshow_lv_custom_columns_data( $column, $post_id ) {

	switch ( $column ) {
		case 'featured_image':
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('thumbnail');
			} else {
				?>
                <span aria-hidden="true">—</span>
				<?php
			}
			break;
		case 'featured_term':

			$taxonomies  = get_taxonomies('','names');
			$all_terms   = wp_get_post_terms($post_id, $taxonomies);
			$final_terms = wp_list_pluck($all_terms, 'slug');

			if ( in_array('featured', $final_terms, true ) ){ ?>
                <img height="25px" width="25px" alt="featured" src="<?php echo esc_url( get_template_directory_uri().'/assets/images/check.svg' )?>">
			<?php } else { ?>
                <span aria-hidden="true">—</span>
			<?php }
			break;

	}
}

/**
 * Remove Emoji from the page.
 *
 * @since 1.0.0
 */
function nabshow_lv_remove_wp_emoji() {

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
}

/**
 * Move render blocking JS to the footer.
 *
 * @since 1.0.0
 */
function nabshow_lv_move_scripts_to_footer() {

    // Remove default jQuery registration through WordPress.
	wp_dequeue_script( 'jquery' );
	wp_dequeue_script( 'jquery-migrate' );
	wp_dequeue_script( 'wp-embed' );
	wp_deregister_script( 'jquery' );
	wp_deregister_script( 'jquery-migrate' );
	wp_deregister_script( 'wp-embed' );

	wp_enqueue_script( 'jquery', '/wp-includes/js/jquery/jquery.js', '', '', true );
}

/**
 * Add/update post meta to thoughts gallery post for most popular posts.
 *
 * @param $postID
 *
 * @since 1.0.0
 */
function nabshow_lv_set_thought_gallery_views( $postID ) {

	$count_key = 'nab_thought_gallery_views_count';
	$count     = get_post_meta( $postID, $count_key, true );

	$count     = empty( $count ) ? 1 : $count + 1;

	update_post_meta( $postID, $count_key, $count );
}

/**
 * Thoughts gallery post views count for popular posts.
 *
 * @param $post_id
 *
 * @since 1.0.0
 */
function nabshow_lv_track_thought_gallery_views( $post_id ) {
	if ( ! is_singular( 'thought-gallery' ) ) {
		return;
	}

	if ( empty ( $post_id ) ) {
		global $post;
		$post_id = $post->ID;
	}
	nabshow_lv_set_thought_gallery_views( $post_id );
}

/**
 * Add custom post types on authors page.
 *
 * @since 1.0.0
 */
function nabshow_lv_custom_type_to_author() {

    if ( ! is_admin() ) {

	    global $wp_query;

	    if ( is_author() || is_home() ) {
			$wp_query->set( 'post_type', array( 'post', 'thought-gallery', 'not-to-be-missed' ) );
		}
	}
}

/**
 * Made default post post type hierarchical.
 *
 * @param $post_type
 *
 * @since 1.0.0
 */
function nabshow_lv_make_posts_hierarchical( $post_type ) {
	// Return, if not post type posts
	if ($post_type !== 'post') return;

	// access $wp_post_types global variable
	global $wp_post_types;

	// Set post type "post" to be hierarchical
	$wp_post_types['post']->hierarchical = 1;

	// Add page attributes to post backend
	// This adds the box to set up parent and menu order on edit posts.
	add_post_type_support( 'post', 'page-attributes' );
}

/**
 * Enable excerpt in the page post type
 *
 * @param $post_type
 *
 * @since 1.0.0
 */
function nabshow_lv_enable_page_excerpt( $post_type ) {
	// Return, if post type not page
	if ( 'page' !== $post_type ) return;

	// Adding excerpt for page
	add_post_type_support( 'page', 'excerpt' );
}

/**
 * Register custom api endpoints.
 *
 * @since 1.0.0
 */
function nabshow_lv_register_api_endpoints() {

	register_rest_route( 'nab_api', '/request/page-parents', array(
		'methods'  => 'GET',
		'callback' => 'nabshow_lv_get_page_parents_callback',
	) );
}

/**
 * Change WP login logo.
 *
 * @since 1.0.0
 */
function nabshow_lv_set_custom_login_logo() {

	$login_logo = get_stylesheet_directory_uri() . '/assets/images/login-logo.png';
	?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo esc_url( $login_logo ); ?>);
            height:65px;
            width:320px;
            background-size: 320px 65px;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }
    </style>
	<?php
}

/**
 * Add Help and support widget in the dashboard.
 *
 * @since 1.0.0
 */
function nabshow_lv_add_help_support_dashboard_widget() {

    wp_add_dashboard_widget(
		'nab_dashboard_help_support', // widget ID
		'Help & Support', // widget title
		'nabshow_lv_help_support_widget_configure' // callback #1 to display it
	);
}

/**
 * Help and support widget callback.
 *
 * @since 1.0.0
 */
function nabshow_lv_help_support_widget_configure() {
	?>
    <div class="inside">
        <div id="help-support" class="help-support">
            <p class="display-msg"></p>
            <div class="input-text-wrap">
                <label for="support-subject">Subject</label>
                <input type="text" name="mail_subject" id="support-subject" autocomplete="off" required>
            </div>
            <div class="textarea-wrap">
                <label for="support-content">Message</label>
                <textarea name="mail_content" id="support-content" placeholder="Message" class="mceEditor" rows="3" cols="15" autocomplete="off" required></textarea>
            </div>
            <p class="submit">
                <button id="send-mail" class="button button-primary">Send</button>
            </p>
        </div>
    </div>
	<?php
}

/**
 * Enqueue admin script & style according to admin page.
 *
 * @since 1.0.0
 */
function nabhsow_lv_enqueue_admin_script() {

	global $pagenow;

	if( 'index.php' === $pagenow ) {

		wp_enqueue_script( 'nabshow-lv-admin', get_template_directory_uri() . '/assets/js/nabshow-lv-admin.js', array( 'jquery' ) );

		wp_localize_script( 'nabshow-lv-admin', 'nabshowLvAdmin', array(
			'ajax_url'               => admin_url( 'admin-ajax.php' ),
			'nabshow_lv_admin_nonce' => wp_create_nonce( 'help_support_nonce' ),
		) );

	}

	if ( 'index.php' === $pagenow || 'edit.php' === $pagenow || 'edit-tags.php' === $pagenow ) {

		if ( 'index.php' !== $pagenow ) {

			$taxonomy = filter_input( INPUT_GET, 'taxonomy', FILTER_SANITIZE_STRING );

			wp_enqueue_script( 'nabshow-lv-compact-view', get_template_directory_uri() . '/assets/js/nabshow-lv-admin-compact-view.js', array( 'jquery' ) );

			$taxonomy = is_taxonomy_hierarchical( $taxonomy ) ? $taxonomy : '';

			wp_localize_script( 'nabshow-lv-compact-view', 'nabshowCompactView', array(
				'expandText'   => __( 'Expand All', 'nabshow-lv' ),
				'collapseText' => __( 'Collapse All', 'nabshow-lv' ),
				'nabTaxonomy' => $taxonomy,
			) );

		}

		wp_enqueue_style( 'nabshow-lv-print-style', get_template_directory_uri() . '/assets/css/nabshow-lv-admin.css' );
	}
}