<?php

/**
 * Checks if password matches confirm password
 *
 * @param $posted
 *
 * @return \WP_Error
 */
function nab_confirm_password_matches_checkout( $errors, $username, $email ) {

	extract( $_POST );

	if ( isset( $first_name ) && empty( $first_name ) ) {
		return new WP_Error( 'registration-error', __( 'Please enter First Name.', 'woocommerce' ) );
	}

	if ( isset( $last_name ) && empty( $last_name ) ) {
		return new WP_Error( 'registration-error', __( 'Please enter Last Name.', 'woocommerce' ) );
	}

	if ( isset( $password2 ) && empty( $password2 ) ) {
		return new WP_Error( 'registration-error', __( 'Please enter confirm password.', 'woocommerce' ) );
	}

	if ( ! empty( $password ) && 8 > strlen( $password ) ) {
		return new WP_Error( 'registration-error', __( 'Password must be 8 characters long.', 'woocommerce' ) );
	}

	if ( ! is_user_logged_in() && 0 !== strcmp( $password, $password2 ) ) {
		return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
	}

	return $errors;
}

/**
 * Sync users across multisite
 *
 * @param $username
 * @param $user
 */
function nab_sync_login( $username, $user ) {

	$sites = [ 3, 4, 5, 13, 14 ]; // for NY site @todo Make it dynamic later

	foreach ( $sites as $site ) {
		if ( isset( $user->ID ) && ! empty( $user->ID ) && false === is_user_member_of_blog( $user->ID, $site ) ) {
			add_user_to_blog( $site, $user->ID, 'subscriber' );
		}
	}
}

/**
 *  Add Custom Meta Boxes.
 */
function amplify_custom_meta_boxes() {
	$screens = [ 'product' ];
	foreach ( $screens as $screen ) {
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
function product_publisher_content_html( $post ) {
	$product_publisher_content_html = get_post_meta( $post->ID, '_product_publisher_content_html', true );
	$editor_id                      = 'product_publisher_content_html'; // Unique ID
	wp_editor( $product_publisher_content_html, $editor_id );
}

/**
 * Callback for Long Content
 *
 * @param object /array $post Post data.
 */
function product_long_content_html( $post ) {
	$product_long_content_html = get_post_meta( $post->ID, '_product_long_content_html', true );
	$editor_id                 = 'product_long_content_html'; // Unique ID
	wp_editor( $product_long_content_html, $editor_id );
}

/**
 * Callback for Join Today Content
 *
 * @param object /array $post Post data.
 */
function product_join_today_content_html( $post ) {
	$product_join_today_content = get_post_meta( $post->ID, '_product_join_today_content_html', true );
	$editor_id                  = 'product_join_today_content_html'; // Unique ID
	wp_editor( $product_join_today_content, $editor_id );
}

/**
 * Callback for Product Video
 *
 * @param object /array $post Post data.
 */
function product_video_text_box_html( $post ) {

	$product_video_url   = get_post_meta( $post->ID, '_product_video_url', true );
	$product_video_id    = get_post_meta( $post->ID, '_product_video_thumb', true );
	$product_video_thumb = wp_get_attachment_image_src( $product_video_id, 'full' )[0];

	?>
    <p>Type the URL of your BrightCov Video.</p>
    <input style="width: 100%" type="text" name="product_video_url" value="<?php echo $product_video_url ?>"/>

    <p>Choose or Upload an Image</p>
    <p style="<?php if ( ! $product_video_thumb ) {
		echo 'dispaly: none';
	} ?>"><img src="<?php echo esc_url( $product_video_thumb ); ?>" id="product_video_thumb_img" style="max-width: 250px; cursor: pointer"/></p>
    <input type="hidden" id="product_video_thumb" name="product_video_thumb" value="<?php echo esc_attr( $product_video_id ); ?>"/>
    <input type="button" id="product_video_thumb_button" class="button" value="Choose or Upload an Image"/>

    <script>
        jQuery('#product_video_thumb_button, #product_video_thumb_img').click(function () {

            var send_attachment_bkp = wp.media.editor.send.attachment;

            wp.media.editor.send.attachment = function (props, attachment) {
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
function nab_amplify_upload_images() {

	$user_id = get_current_user_id();

	// Upload images.
	$images_names        = array( 'profile_picture', 'banner_image' );
	$dependencies_loaded = 0;
	foreach ( $_FILES as $file_key => $file_details ) {

		if ( in_array( $file_key, $images_names, true ) ) {

			if ( 0 === $dependencies_loaded ) {
				// These files need to be included as dependencies when on the front end.
				require_once( ABSPATH . 'wp-admin/includes/image.php' );
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
				require_once( ABSPATH . 'wp-admin/includes/media.php' );
				$dependencies_loaded = 1;
			}

			// Let WordPress handle the upload.
			$attachment_id = media_handle_upload( $file_key, 0 );

			if ( ! is_wp_error( $attachment_id ) ) {
				// update in meta
				update_user_meta( $user_id, $file_key, $attachment_id );
			}
		}
	}
	wp_die();
}

/**
 * Ajax to remove user images.
 */
function nab_amplify_remove_images() {

	$name    = filter_input( INPUT_POST, "name", FILTER_SANITIZE_STRING );
	$name    = str_replace( '_remove', '', $name );
	$user_id = get_current_user_id();

	// update in meta
	update_user_meta( $user_id, $name, '' );

	wp_die();
}

/**
 * Save Product Video meta values
 *
 * @param int $post_id
 */
function save_product_video_text( $post_id ) {

	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );

	// Exits script depending on save status
	if ( $is_autosave || $is_revision ) {
		return;
	}

	if ( array_key_exists( 'product_publisher_content_html', $_POST ) ) {
		update_post_meta(
			$post_id,
			'_product_publisher_content_html',
			$_POST['product_publisher_content_html']
		);
	}
	if ( array_key_exists( 'product_long_content_html', $_POST ) ) {
		update_post_meta(
			$post_id,
			'_product_long_content_html',
			$_POST['product_long_content_html']
		);
	}
	if ( array_key_exists( 'product_join_today_content_html', $_POST ) ) {
		update_post_meta(
			$post_id,
			'_product_join_today_content_html',
			$_POST['product_join_today_content_html']
		);
	}
	if ( array_key_exists( 'product_video_url', $_POST ) ) {
		update_post_meta(
			$post_id,
			'_product_video_url',
			$_POST['product_video_url']
		);
	}
	if ( array_key_exists( 'product_video_thumb', $_POST ) ) {
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
function nab_reg_message() {
	if ( ! is_user_logged_in() && is_account_page() && isset( $_GET['nab_registration_complete'] ) && 'true' === $_GET['nab_registration_complete'] ) {
		wc_add_notice( 'You have successfully created your account . Please login to continue.' );
	}
}

/**
 * Remove woocommerce password strength js
 */
function nab_remove_password_strength() {
	wp_dequeue_script( 'wc-password-strength-meter' );
}

/**
 * Custom Validations for Reset password
 *
 * @param $errors
 * @param $user
 */
function nab_reset_password_validation( $errors, $user ) {
	if ( ! empty( $_POST['password_1'] ) && 8 > strlen( $_POST['password_1'] ) ) {
		wc_add_notice( __( 'Password must be 8 characters long.', 'woocommerce' ), 'error' );
	}

}

/**
 * Register endpoints to use for My Account page.
 */
function nab_amplify_add_custom_endpoints() {
	add_rewrite_endpoint( 'edit-my-profile', EP_ROOT | EP_PAGES );
	add_rewrite_endpoint( 'my-purchases', EP_ROOT | EP_PAGES );
	add_rewrite_endpoint( 'my-connections', EP_ROOT | EP_PAGES );
	add_rewrite_endpoint( 'my-events', EP_ROOT | EP_PAGES );
	add_rewrite_endpoint( 'my-bookmarks', EP_ROOT | EP_PAGES );
}

/**
 * My Purchases content.
 */
function nab_amplify_my_purchases_content_callback() {
	get_template_part( 'template-parts/content', 'my-purchases' );
}

/**
 * My Connections content.
 */
function nab_amplify_my_connections_content_callback() {
	get_template_part( 'template-parts/content', 'my-connections' );
}

/**
 * My Events content.
 */
function nab_amplify_my_events_content_callback() {
	get_template_part( 'template-parts/content', 'my-events' );
}

/**
 * My Bookmark content.
 */
function nab_amplify_my_bookmarks_content_callback() {
	get_template_part( 'template-parts/content', 'my-bookmarks' );
}

/**
 * Register my purchases endpoint to use for My Account page.
 */
function nab_amplify_my_purchases_endpoint() {
	add_rewrite_endpoint( 'my-purchases', EP_ROOT | EP_PAGES );
}

/**
 * Register my connections endpoint to use for My Account page.
 */
function nab_amplify_my_connections_endpoint() {
	add_rewrite_endpoint( 'my-connections', EP_ROOT | EP_PAGES );
}

// Our custom post type function
function nab_amplify_register_post_types() {

	$labels = array(
		'name'               => _x( 'Products-Content', 'Post Type General Name', 'nab-amplify' ),
		'singular_name'      => _x( 'Product Content', 'Post Type Singular Name', 'nab-amplify' ),
		'menu_name'          => __( 'Products Content', 'nab-amplify' ),
		'parent_item_colon'  => __( 'Parent Product', 'nab-amplify' ),
		'all_items'          => __( 'All Products Content', 'nab-amplify' ),
		'view_item'          => __( 'View Product Content', 'nab-amplify' ),
		'add_new_item'       => __( 'Add New Product Content', 'nab-amplify' ),
		'add_new'            => __( 'Add New', 'nab-amplify' ),
		'edit_item'          => __( 'Edit Product Content', 'nab-amplify' ),
		'update_item'        => __( 'Update Product Content', 'nab-amplify' ),
		'search_items'       => __( 'Search Product Content', 'nab-amplify' ),
		'not_found'          => __( 'Not Found', 'nab-amplify' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'nab-amplify' ),
	);

	$args = array(
		'label'               => __( 'nab-products', 'nab-amplify' ),
		'description'         => __( 'Product posts', 'nab-amplify' ),
		'labels'              => $labels,
		'taxonomies'          => array( 'nab_products_categories' ),
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
		'supports'            => array( 'title', 'editor', 'thumbnail' ),

	);

	// Registering your Custom Post Type
	register_post_type( 'nab-products', $args );

	$labels = array(
		'name'               => _x( 'Sessions', 'Post Type General Name', 'nab-amplify' ),
		'singular_name'      => _x( 'Session', 'Post Type Singular Name', 'nab-amplify' ),
		'menu_name'          => __( 'Sessions', 'nab-amplify' ),
		'parent_item_colon'  => __( 'Parent Session', 'nab-amplify' ),
		'all_items'          => __( 'All Sessions', 'nab-amplify' ),
		'view_item'          => __( 'View Session', 'nab-amplify' ),
		'add_new_item'       => __( 'Add New Session', 'nab-amplify' ),
		'add_new'            => __( 'Add New', 'nab-amplify' ),
		'edit_item'          => __( 'Edit Session', 'nab-amplify' ),
		'update_item'        => __( 'Update Session', 'nab-amplify' ),
		'search_items'       => __( 'Search Session', 'nab-amplify' ),
		'not_found'          => __( 'Not Found', 'nab-amplify' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'nab-amplify' ),
	);

	$args = array(
		'label'               => __( 'sessions', 'nab-amplify' ),
		'description'         => __( 'Session posts', 'nab-amplify' ),
		'labels'              => $labels,
		'taxonomies'          => array( 'session_categories' ),
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
		'supports'            => array( 'title', 'editor', 'thumbnail' ),

	);

	// Registering your Custom Post Type
	register_post_type( 'sessions', $args );
}

// Hooking up our function to theme setup
add_action( 'init', 'nab_amplify_register_post_types' );

/**
 * Register Arabic category
 */
function nab_amplify_session_categories() {

	$labels = array(
		'name'              => _x( 'Session Categories', 'events-master-plugin' ),
		'singular_name'     => _x( 'Session Category', 'events-master-plugin' ),
		'search_items'      => __( 'Search Session Category' ),
		'all_items'         => __( 'All Session Categories' ),
		'parent_item'       => __( 'Parent Session Category' ),
		'parent_item_colon' => __( 'Parent Topic:' ),
		'edit_item'         => __( 'Edit Session Category' ),
		'update_item'       => __( 'Update Session Category' ),
		'add_new_item'      => __( 'Add New Session Category' ),
		'new_item_name'     => __( 'New Session Category' ),
		'menu_name'         => __( 'Session Categories' ),
	);

	register_taxonomy(
		'session_categories', array( 'sessions' ),
		array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'session_categories' ),
		)
	);

}

add_action( 'init', 'nab_amplify_session_categories' );

/**
 * Save first and last name at Registration
 *
 * @param $customer_id
 */
function nab_save_name_fields( $customer_id ) {

	if ( isset( $_POST['first_name'] ) ) {
		update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['first_name'] ) );
		update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['first_name'] ) );
	}
	if ( isset( $_POST['last_name'] ) ) {
		update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['last_name'] ) );
		update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['last_name'] ) );
	}

}

/**
 * Event for validations
 */
function nab_attendee_field_process() {

	// Return if user is not logged in or is bulk purchase
	if ( ! is_user_logged_in() ) {
		return;
	}

	if ( false === nab_is_bulk_order() ) {

		if ( ! isset( $_POST['attendee_first_name'] ) || empty( $_POST['attendee_first_name'] ) ) {
			wc_add_notice( __( 'Please enter Attendee First Name.' ), 'error' );
		}

		if ( ! isset( $_POST['attendee_last_name'] ) || empty( $_POST['attendee_last_name'] ) ) {
			wc_add_notice( __( 'Please enter Attendee Last Name.' ), 'error' );
		}

		if ( ! isset( $_POST['attendee_email'] ) || empty( $_POST['attendee_email'] ) ) {
			wc_add_notice( __( 'Please enter Attendee Email.' ), 'error' );
		}

		if ( ! isset( $_POST['attendee_company'] ) || empty( $_POST['attendee_company'] ) ) {
			wc_add_notice( __( 'Please enter Attendee Company.' ), 'error' );
		}

		if ( ! isset( $_POST['attendee_title'] ) || empty( $_POST['attendee_title'] ) ) {
			wc_add_notice( __( 'Please enter Attendee Title.' ), 'error' );
		}

		if ( ! isset( $_POST['attendee_country'] ) || empty( $_POST['attendee_country'] ) ) {
			wc_add_notice( __( 'Please enter Attendee Country.' ), 'error' );
		}

	}

	if ( ! isset( $_POST['attendee_partner_opt_in'] ) || empty( $_POST['attendee_partner_opt_in'] ) ) {
		wc_add_notice( __( 'Please choose your preference for Partner Communications opt in.' ), 'error' );
	}

	if ( ! isset( $_POST['attendee_exhibition_sponsors_opt_in'] ) || empty( $_POST['attendee_exhibition_sponsors_opt_in'] ) ) {
		wc_add_notice( __( 'Please choose your preference for Exhibitor/Sponsor Communications opt in.' ), 'error' );
	}

	if ( ! isset( $_POST['attendee_tos_agree'] ) || 'yes' !== $_POST['attendee_tos_agree'] ) {
		wc_add_notice( __( 'You must agree with Terms and Privacy Policy.' ), 'error' );
	}
}

/**
 * Event form save fields
 *
 * @param $order_id
 */
function nab_save_event_fields( $order_id ) {

	// Return if user is not logged in or is bulk purchase
	if ( ! is_user_logged_in() ) {
		return;
	}

	if ( nab_is_bulk_order() ) {
		// save bulk order details
		update_post_meta( $order_id, '_nab_bulk_order', 'yes' );
		$nab_bulk_qty = nab_bulk_order_quantity();
		if ( isset( $nab_bulk_qty ) && ! empty( $nab_bulk_qty ) ) {
			update_post_meta( $order_id, '_nab_bulk_qty', $nab_bulk_qty );
		}
	} else {
		$user_id = get_current_user_id();

		$event_data = array(
			'attendee_first_name'                 => ( isset( $_POST['attendee_first_name'] ) && ! empty( $_POST['attendee_first_name'] ) ) ? sanitize_text_field( $_POST['attendee_first_name'] ) : '',
			'attendee_last_name'                  => ( isset( $_POST['attendee_last_name'] ) && ! empty( $_POST['attendee_last_name'] ) ) ? sanitize_text_field( $_POST['attendee_last_name'] ) : '',
			'attendee_email'                      => ( isset( $_POST['attendee_email'] ) && ! empty( $_POST['attendee_email'] ) ) ? sanitize_email( $_POST['attendee_email'] ) : '',
			'attendee_company'                    => ( isset( $_POST['attendee_company'] ) && ! empty( $_POST['attendee_company'] ) ) ? sanitize_text_field( $_POST['attendee_company'] ) : '',
			'attendee_title'                      => ( isset( $_POST['attendee_title'] ) && ! empty( $_POST['attendee_title'] ) ) ? sanitize_text_field( $_POST['attendee_title'] ) : '',
			'attendee_country'                    => ( isset( $_POST['attendee_country'] ) && ! empty( $_POST['attendee_country'] ) ) ? sanitize_text_field( $_POST['attendee_country'] ) : '',
			'attendee_city'                       => ( isset( $_POST['attendee_city'] ) && ! empty( $_POST['attendee_city'] ) ) ? sanitize_text_field( $_POST['attendee_city'] ) : '',
			'attendee_state'                      => ( isset( $_POST['attendee_state'] ) && ! empty( $_POST['attendee_state'] ) ) ? sanitize_text_field( $_POST['attendee_state'] ) : '',
			'attendee_zip'                        => ( isset( $_POST['attendee_zip'] ) && ! empty( $_POST['attendee_zip'] ) ) ? sanitize_text_field( $_POST['attendee_zip'] ) : '',
			'attendee_affiliation'                => ( isset( $_POST['attendee_affiliation'] ) && ! empty( $_POST['attendee_affiliation'] ) ) ? sanitize_text_field( $_POST['attendee_affiliation'] ) : '',
			'attendee_partner_opt_in'             => ( isset( $_POST['attendee_partner_opt_in'] ) && ! empty( $_POST['attendee_partner_opt_in'] ) ) ? sanitize_text_field( $_POST['attendee_partner_opt_in'] ) : '',
			'attendee_exhibition_sponsors_opt_in' => ( isset( $_POST['attendee_exhibition_sponsors_opt_in'] ) && ! empty( $_POST['attendee_exhibition_sponsors_opt_in'] ) ) ? sanitize_text_field( $_POST['attendee_exhibition_sponsors_opt_in'] ) : '',
			'attendee_discover'                   => ( isset( $_POST['attendee_discover'] ) && ! empty( $_POST['attendee_discover'] ) ) ? wp_unslash( $_POST['attendee_discover'] ) : [],
			'attendee_meet'                       => ( isset( $_POST['attendee_meet'] ) && ! empty( $_POST['attendee_meet'] ) ) ? wp_unslash( $_POST['attendee_meet'] ) : [],
			'other_interest'                      => ( isset( $_POST['other_interest'] ) && ! empty( $_POST['other_interest'] ) ) ? $_POST['other_interest'] : '',
			'billing_phone'                       => ( isset( $_POST['billing_phone'] ) && ! empty( $_POST['billing_phone'] ) ) ? sanitize_text_field( $_POST['billing_phone'] ) : '',
		);

		$event_data['attendee_interest'] = isset( $_POST['attendee_interest'] ) ? $_POST['attendee_interest'] : [];
		if ( isset( $_POST['other_interest'] ) && isset( $_POST['attendee_other_interest'] ) && ! empty( $_POST['attendee_other_interest'] ) ) {
			$event_data['attendee_other_interest'] = sanitize_text_field( $_POST['attendee_other_interest'] );
		}

		// Save details to user meta
		foreach ( $event_data as $key => $val ) {
			update_user_meta( $user_id, $key, $val );
		}

	}

	if ( isset( $_POST['nab_additional_email'] ) && ! empty( $_POST['nab_additional_email'] ) ) {
		update_post_meta( $order_id, 'nab_additional_email', filter_input( INPUT_POST, 'nab_additional_email' ) );
	}

}

/**
 * Redirecting templates.
 */
function nab_amplify_template_redirect() {

	global $wp;
	$current_user_id 	= get_current_user_id();
	$user_logged_in		= is_user_logged_in();

	// Get buddypress member ID.
	$member_id = 0;
	if ( bp_current_component() ) {
		global $bp;
		$member_id = isset( $bp->displayed_user->id ) ? $bp->displayed_user->id : 0;
	}
	if ( is_singular( 'tribe_events' ) ) {
		wp_redirect( home_url(), 301 );
		exit;
	}

	// Redirect Buddypress pages.
	$request               = explode( '/', $wp->request );
	$current_url           = home_url( $wp->request );
	$redirect_url          = '';
	$bp_current_component  = bp_current_component();
	$allowed_bp_components = array( 'front', 'messages' );
	$my_profile_url        = bp_core_get_user_domain( get_current_user_id() );
	$is_friend             = friends_check_friendship_status( $current_user_id, $member_id );

	if ( ! $user_logged_in && $bp_current_component ) {
		/* If user is NOT logged in and try to access Buddypress page. */
		$redirect_url = add_query_arg( array( 'r' => $current_url ), wc_get_page_permalink( 'myaccount' ) );

	} else if ( $user_logged_in && $bp_current_component && ! in_array( $bp_current_component, $allowed_bp_components, true ) ) {
		/* If user is logged in and try to access Buddypress page but the component is NOT allowed. */
		$redirect_url = $my_profile_url;

	} else if ( $user_logged_in && $bp_current_component
	            && 0 !== $member_id
	            && $current_user_id !== $member_id
	            && ( ! nab_member_can_visible_to_anyone( $member_id ) && 'is_friend' !== $is_friend )
	) {
		/* If user is logged in and try to access another Buddypress Member's profile who has security enabled. */
		$redirect_url = $my_profile_url;

	} else if ( $user_logged_in && is_account_page() && in_array( end( $request ), array( 'my-connections', 'my-events', 'my-bookmarks' ) ) ) {

		$member_id	= filter_input( INPUT_GET, 'user_id', FILTER_SANITIZE_NUMBER_INT );

		if ( isset( $member_id ) && ! empty( $member_id ) ) {

			$is_friend	= friends_check_friendship_status( $current_user_id, $member_id );

			if ( $current_user_id !== (int) $member_id && ( ! nab_member_can_visible_to_anyone( $member_id ) && 'is_friend' !== $is_friend ) ) {

				/* If user is logged in and try to access another Member's profile connections, events and bookmarks who has security enabled. */
				$redirect_url = $my_profile_url;
			}
		}

	} else if ( ( is_account_page() && 'edit-address' === end( $request ) ) || ( is_account_page() && 'edit-my-profile' === end( $request ) ) ) {

		$redirect_url = wc_get_account_endpoint_url( 'edit-account' );
	}

	if ( ! empty( $redirect_url ) ) {
		wp_redirect( $redirect_url );
		exit;
	}
}

/**
 * Update order status processing to completed.
 *
 * @param $order_id
 */
function nab_amplify_completed_order_after_payment_complete( $order_id ) {
	$order          = wc_get_order( $order_id );
	$order_status   = $order->get_status();
	$transaction_id = $order->get_transaction_id();
	if ( ! empty( $transaction_id ) && 'processing' === strtolower( $order_status ) ) {
		$order->update_status( 'completed' );
		$order->save();
	}
}

/**
 * Auto Completed order if total amount is zero and order status is processing.
 */
function nab_amplify_completed_zero_order( $order_id ) {
	if ( ! $order_id ) {
		return;
	}
	$order = wc_get_order( $order_id );

	if ( '0.00' == $order->get_total() && 'processing' === $order->get_status() ) {
		$order->update_status( 'completed' );
	}
}

/**
 * @param array $file_types Add file types support in file uploads.
 *
 * @return array
 */
function nab_amplify_add_file_types_to_uploads( $file_types ) {
	if ( is_user_logged_in() && current_user_can( 'administrator' ) ) {
		$new_filetypes        = array();
		$new_filetypes['csv'] = 'text/csv';
		$file_types           = array_merge( $file_types, $new_filetypes );
	}

	return $file_types;
}

/**
 * Header Scripts
 */
function nab_header_scripts() {
	?>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-K2F9KBS');</script>
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
function nab_user_registration_sync( $customer_id, $new_customer_data, $password_generated ) {

	$current_user = get_userdata( $customer_id );
	if ( isset( $current_user ) && ! empty( $current_user ) ) {
		do_action( 'wp_login', $current_user->user_login, $current_user );
	}

	$sites = [ 3, 4, 5, 13, 14 ]; // for NY site @todo Make it dynamic later

	foreach ( $sites as $site ) {
		if ( isset( $customer_id ) && ! empty( $customer_id ) && false === is_user_member_of_blog( $customer_id, $site ) ) {
			add_user_to_blog( $site, $customer_id, 'subscriber' );
		}
	}

	// Generate JWT Token
	if ( isset( $new_customer_data['user_login'] ) && ! empty( $new_customer_data['user_login'] ) && isset( $new_customer_data['user_pass'] ) && ! empty( $new_customer_data['user_pass'] ) ) {
		nab_generate_jwt_token( $new_customer_data['user_login'], $new_customer_data['user_pass'] );
	}
}

/**
 * Includes bulk purchase template
 */
function nab_bulk_purchase_cart() {
	require_once get_template_directory() . '/inc/nab-bulk-purchase.php';
}

/**
 * Create Attendee Import table
 */
function nab_create_attendee_table() {
	global $wpdb;

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
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

	dbDelta( $sql );

	$nab_cocart = $wpdb->prefix . 'cocart_carts';
	$tables     = "CREATE TABLE `$nab_cocart` (
					cart_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
					cart_key char(42) NOT NULL,
					cart_value longtext NOT NULL,
					cart_expiry BIGINT UNSIGNED NOT NULL,
					PRIMARY KEY (cart_id),
					UNIQUE KEY cart_key (cart_key)
				) {$charset_collate};";

	dbDelta( $tables );
}

/**
 * Register custom api endpoints.
 *
 * @since 1.0.0
 */
function amplify_register_api_endpoints() {

	register_rest_route( 'nab', '/request/get-product-categories', array(
		'methods'             => 'POST',
		'callback'            => 'amplify_get_product_categories',
		'permission_callback' => '__return_true',
	) );

	register_rest_route( 'nab', '/request/get-product-list', array(
		'methods'             => 'POST',
		'callback'            => 'amplify_get_product_list',
		'permission_callback' => '__return_true',
		'args'                => array(
			'term_id' => array(
				'validate_callback' => function ( $param ) {
					return is_numeric( $param );
				},
			),
		),
	) );

	register_rest_route( 'nab', '/request/customer-bought-product', array(
		'methods'             => 'POST',
		'callback'            => 'amplify_check_user_bought_product',
		'permission_callback' => '__return_true',
		'args'                => array(
			'user_email'  => array(
				'validate_callback' => function ( $param ) {
					return is_email( $param );
				},
			),
			'user_id'     => array(
				'validate_callback' => function ( $param ) {
					return is_numeric( $param );
				},
			),
			'product_ids' => array(
				'validate_callback' => function ( $param ) {
					return is_array( $param );
				},
			),
		),
	) );

	register_rest_route( 'nab', '/request/customer-get-bought-products', array(
		'methods'             => 'POST',
		'callback'            => 'amplify_get_user_bought_product',
		'permission_callback' => '__return_true',
		'args'                => array(
			'user_email'  => array(
				'validate_callback' => function ( $param ) {
					return is_email( $param );
				},
			),
			'user_id'     => array(
				'validate_callback' => function ( $param ) {
					return is_numeric( $param );
				},
			),
			'product_ids' => array(
				'validate_callback' => function ( $param ) {
					return is_array( $param );
				},
			),
		),
	) );

	register_rest_route(
		'nab', '/unlink-products', array(
			'methods'  => 'POST',
			'callback' => 'nab_amplify_unlink_products',
		)
	);

	register_rest_route( 'nab', '/request/get-product-info', array(
		'methods'             => 'POST',
		'callback'            => 'amplify_get_product_info',
		'permission_callback' => '__return_true',
		'args'                => array(
			'product_id' => array(
				'validate_callback' => function ( $param ) {
					return is_numeric( $param );
				},
			),
		),
	) );

	register_rest_route( 'nab', '/request/get-header-logos', array(
		'methods'             => 'GET',
		'callback'            => 'amplify_get_header_logos',
		'permission_callback' => '__return_true',
	) );

}

/**
 * Call back for Flush Custom Data.
 *
 * @param WP_REST_Request $request
 *
 * @return bool Verified or not.
 */
function nab_amplify_unlink_products( WP_REST_Request $request ) {

	$parameters = $request->get_params();

	$current_post_id   = isset( $parameters['current_post_id'] ) ? $parameters['current_post_id'] : '';
	$unlinked_products = isset( $parameters['unlinked_products'] ) ? explode( ',', $parameters['unlinked_products'] ) : '';
	$shop_blog_id      = isset( $parameters['shop_blog_id'] ) ? (int) $parameters['shop_blog_id'] : '';
	$current_blog_id   = isset( $parameters['current_blog_id'] ) ? (int) $parameters['current_blog_id'] : '';

	if ( empty( $current_post_id ) || empty( $unlinked_products ) || empty( $shop_blog_id ) || empty( $current_blog_id ) ) {
		return "Please pass necessary parameters.";
	}

	switch_to_blog( $shop_blog_id );

	foreach ( $unlinked_products as $product_id ) {
		$associated_content = maybe_unserialize( get_post_meta( $product_id, '_associated_content', true ) );
		if ( isset( $associated_content[ $current_blog_id ][ $current_post_id ] ) ) {
			unset( $associated_content[ $current_blog_id ][ $current_post_id ] );
		}

		update_post_meta( $product_id, '_associated_content', $associated_content );
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
function amplify_get_product_categories() {

	$return = array();

	$terms = get_terms( array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
	) );

	foreach ( $terms as $term ) {

		$return[] = array( 'term_id' => $term->term_id, 'name' => $term->name );
	}

	return new WP_REST_Response( $return, 200 );
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
function amplify_get_product_list( WP_REST_Request $request ) {

	$term_id = $request->get_param( 'term_id' );
	$return  = array();

	$args = array(
		'posts_per_page' => - 1,
		'post_type'      => 'product',
		'orderby'        => 'title',
		'fields'         => 'ids',
		'order'          => 'ASC',
	);

	if ( ! empty( $term_id ) ) {

		$args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $term_id,
			),
		);
	}

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {

		while ( $query->have_posts() ) {

			$query->the_post();

			$product_id   = get_the_ID();
			$product_name = html_entity_decode( get_the_title() );

			$return[] = array( 'product_id' => $product_id, 'product_name' => $product_name );
		}
	}

	wp_reset_postdata();

	return new WP_REST_Response( $return, 200 );
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
function amplify_check_user_bought_product( WP_REST_Request $request ) {

	$user_email  = $request->get_param( 'user_email' );
	$user_id     = $request->get_param( 'user_id' );
	$product_ids = $request->get_param( 'product_ids' );
	$return      = array( 'success' => false );

	if ( is_array( $product_ids ) && ! empty( $user_email ) && ! empty( $user_id ) ) {

		foreach ( $product_ids as $product_id ) {

			if ( wc_customer_bought_product( $user_email, $user_id, $product_id ) ) {

				$return['success'] = true;

				$purchased_product = get_user_meta( $user_id, 'nab_purchased_product_2020', true );

				if ( ! empty( $purchased_product ) && is_array( $purchased_product ) ) {

					if ( ! in_array( $product_id, $purchased_product ) ) {

						$purchased_product[] = $product_id;

						update_user_meta( $user_id, 'nab_purchased_product_2020', $purchased_product );
					}

				} else {

					$purchased_product = array( $product_id );

					update_user_meta( $user_id, 'nab_purchased_product_2020', $purchased_product );
				}

				break;
			}
		}

		if ( ! $return['success'] ) {
			$return['url']   = get_the_permalink( $product_ids[0] );
			$return['title'] = get_the_title( $product_ids[0] );
		}
	}

	return new WP_REST_Response( $return, 200 );
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
function amplify_get_user_bought_product( WP_REST_Request $request ) {

	$user_email  = $request->get_param( 'user_email' );
	$user_id     = $request->get_param( 'user_id' );
	$product_ids = $request->get_param( 'product_ids' );

	$actually_bought = array();

	if ( is_array( $product_ids ) && ! empty( $user_email ) && ! empty( $user_id ) ) {

		foreach ( $product_ids as $product_id ) {

			if ( wc_customer_bought_product( $user_email, $user_id, $product_id ) ) {
				$actually_bought[] = $product_id;
			}
		}
	}

	return new WP_REST_Response( $actually_bought, 200 );
}

/**
 * Creates JWT Token
 *
 * @param string $username
 * @param string $password
 *
 * @return void
 */
function nab_create_jwt_token( $username, $password ) {
	nab_generate_jwt_token( $username, $password );
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
function amplify_get_product_info( WP_REST_Request $request ) {

	$product_id = $request->get_param( 'product_id' );
	$return     = array();

	if ( ! empty( $product_id ) ) {
		$return['url']   = get_the_permalink( $product_id );
		$return['title'] = get_the_title( $product_id );
	}

	return new WP_REST_Response( $return, 200 );
}

/**
 * Get coupon code form the url.
 */
function amplify_apply_coupon_code_from_url() {

	if ( is_admin() ) {
		return;
	}

	$coupon_code = filter_input( INPUT_GET, 'promocode', FILTER_SANITIZE_STRING );

	// Exit if no code in URL or if the coupon code is already set cart session
	if ( empty( $coupon_code ) ) {
		return;
	}

	// Start WC session if not started
	if ( isset( WC()->session ) && ! WC()->session->has_session() ) {
		WC()->session->set_customer_session_cookie( true );
		amplify_add_coupon_product_to_cart( $coupon_code, true );
	} else {
		amplify_add_coupon_product_to_cart( $coupon_code, false );
	}

}

/**
 * Add coupon products to the cart and apply coupon. If coupon product not exist then set a cookie for coupon.
 *
 * @param string $coupon_code
 * @param boolean $force_start
 */
function amplify_add_coupon_product_to_cart( $coupon_code, $force_start ) {

	if ( ! empty( $coupon_code ) ) {

		// Sanitize coupon code
		$format_coupon_code = wc_format_coupon_code( $coupon_code );

		// Get the coupon
		$the_coupon = new WC_Coupon( $format_coupon_code );

		// Get coupon products
		$product_ids = $the_coupon->get_product_ids();

		if ( ! empty( $product_ids ) ) {

			foreach ( $product_ids as $product_id ) {

				if ( ! amplify_is_product_in_cart( $product_id ) ) {
					WC()->cart->add_to_cart( $product_id );
				}
			}
		}

		if ( empty( $product_ids ) && WC()->cart->is_empty() ) {
			setcookie( 'amp_wc_coupon', $coupon_code, ( time() + 1209600 ), '/' );
		} else {
			WC()->cart->add_discount( $coupon_code );
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
function amplify_is_product_in_cart( $product_id ) {
	if ( 0 !== $product_id ) {
		if ( isset( WC()->cart->cart_contents ) && is_array( WC()->cart->cart_contents ) ) {
			foreach ( WC()->cart->cart_contents as $cart_item_key => $cart_item_data ) {
				if (
					( isset( $cart_item_data['product_id'] ) && $product_id == $cart_item_data['product_id'] ) ||
					( isset( $cart_item_data['variation_id'] ) && $product_id == $cart_item_data['variation_id'] )
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
function amplify_add_coupon_code_to_cart() {

	$coupon_code = isset( $_COOKIE['amp_wc_coupon'] ) && ! empty( $_COOKIE['amp_wc_coupon'] ) ? $_COOKIE['amp_wc_coupon'] : '';

	if ( empty( $coupon_code ) ) {
		return;
	}

	WC()->cart->add_discount( $coupon_code );

	unset( $_COOKIE['amp_wc_coupon'] );
	setcookie( 'amp_wc_coupon', null, - 1, '/' );
}


/**
 * Remove product from cocart session cart if removed from main cart
 *
 * @param string $cart_item_key
 * @param object $instance
 *
 * @return void
 */
function nab_remove_cocart_item( $cart_item_key, $instance ) {

	if ( isset( $_COOKIE['nabCartKey'] ) && ! empty( $_COOKIE['nabCartKey'] ) && ! is_user_logged_in() ) {
		$cart_key = $_COOKIE['nabCartKey'];

		$args = array(
			'headers' => array(
				'Content-Type' => 'application/json; charset=utf-8',
			),
			'body'    => wp_json_encode( [
				'cart_item_key' => $cart_item_key,
			] ),
			'method'  => 'DELETE',
		);

		$api_url  = add_query_arg( 'cart_key', $cart_key, home_url() . '/wp-json/cocart/v1/item/' );
		$response = wp_remote_request( $api_url, $args );
	}

}

/**
 * Load cart from cocart session cart
 *
 * @return void
 */
function nab_load_cart_action_cookie() {

	// If cookie is not present then just return
	if ( ! isset( $_COOKIE['nabCartKey'] ) || is_user_logged_in() ) {
		return;
	}

	$cart_key      = trim( wp_unslash( $_COOKIE['nabCartKey'] ) );
	$override_cart = false;  // Override the cart by default.

	// wc_nocache_headers();

	// Get the cart in the database.
	$stored_cart = nab_cocart_get_cart( $cart_key );

	if ( empty( $stored_cart ) ) {
		return;
	}

	// Get the cart currently in session if any.
	$cart_in_session = WC()->session->get( 'cart', null );

	if ( empty( $cart_in_session ) ) {
		$cart_in_session = [];
	}

	$new_cart = array();

	$new_cart['cart']                       = maybe_unserialize( $stored_cart['cart'] );
	$new_cart['applied_coupons']            = maybe_unserialize( $stored_cart['applied_coupons'] );
	$new_cart['coupon_discount_totals']     = maybe_unserialize( $stored_cart['coupon_discount_totals'] );
	$new_cart['coupon_discount_tax_totals'] = maybe_unserialize( $stored_cart['coupon_discount_tax_totals'] );
	$new_cart['removed_cart_contents']      = maybe_unserialize( $stored_cart['removed_cart_contents'] );

	// Check if we are overriding the cart currently in session via the web.
	if ( $override_cart ) {
		// Only clear the cart if it's not already empty.
		if ( ! WC()->cart->is_empty() ) {
			WC()->cart->empty_cart( false );

			do_action( 'cocart_load_cart_override', $new_cart, $stored_cart );
		}
	} else {
		$new_cart_content = array_merge( $new_cart['cart'], $cart_in_session );
		$new_cart['cart'] = apply_filters( 'cocart_merge_cart_content', $new_cart_content, $new_cart['cart'], $cart_in_session );

		$new_cart['applied_coupons']            = array_merge( $new_cart['applied_coupons'], WC()->cart->get_applied_coupons() );
		$new_cart['coupon_discount_totals']     = array_merge( $new_cart['coupon_discount_totals'], WC()->cart->get_coupon_discount_totals() );
		$new_cart['coupon_discount_tax_totals'] = array_merge( $new_cart['coupon_discount_tax_totals'], WC()->cart->get_coupon_discount_tax_totals() );
		$new_cart['removed_cart_contents']      = array_merge( $new_cart['removed_cart_contents'], WC()->cart->get_removed_cart_contents() );

		do_action( 'cocart_load_cart', $new_cart, $stored_cart, $cart_in_session );
	}

	// Sets the php session data for the loaded cart.
	WC()->session->set( 'cart', $new_cart['cart'] );
	WC()->session->set( 'applied_coupons', $new_cart['applied_coupons'] );
	WC()->session->set( 'coupon_discount_totals', $new_cart['coupon_discount_totals'] );
	WC()->session->set( 'coupon_discount_tax_totals', $new_cart['coupon_discount_tax_totals'] );
	WC()->session->set( 'removed_cart_contents', $new_cart['removed_cart_contents'] );

}

/**
 * NAB Remove custom cocart cookie
 *
 * @return void
 */
function nab_maybe_clear_cart_cookie() {

	if ( isset( $_COOKIE['nabCartKey'] ) && ! empty( $_COOKIE['nabCartKey'] ) ) {
		unset( $_COOKIE['nabCartKey'] );
		setcookie( 'nabCartKey', '', time() - 3600, '/', NAB_AMPLIFY_COOKIE_BASE_DOMAIN );
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
function nab_get_orders_ids_by_product_id( $product_id, $product_year ) {

	global $wpdb;

	$results = $wpdb->get_col( "
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
    " );

	return $results;
}

/**
 * Add export custom list CSV metabox in the product post type.
 */
function nab_add_custom_metabox_in_product() {

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
function nab_product_customer_metabox_callback( $post ) {

	$current_year  = date( 'Y' );
	$starting_year = 2019;

	?>
    <div class="export-list-wrapper">
        <form method="POST" name="product_customer">
            <div class="year-box">
                <label for="product-year" style="padding-right: 10px;">Select Year</label>
                <select id="product-year" name="product_year" class="product-year" style="padding-left: 16px;padding-right: 30px;">
					<?php
					for ( $i = $starting_year; $i <= $current_year; $i ++ ) {
						?>
                        <option value="<?php echo esc_attr( $i ); ?>" <?php selected( $current_year, $i ); ?>><?php echo esc_html( $i ); ?></option>
						<?php
					}
					?>
                </select>
            </div>
            <input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>"/>
            <div class="submit-btn" style="text-align: center;margin-top: 10px;width: 92%;">
                <input type="submit" name="export_csv" value="Export CSV" class="button"/>
            </div>
        </form>
    </div>
	<?php
}

/**
 * Generate CSV file.
 */
add_action( 'admin_init', function () {

	$export_csv = filter_input( INPUT_POST, 'export_csv', FILTER_SANITIZE_STRING );

	// Checking user clicked on export csv button
	if ( isset( $export_csv ) && ! empty( $export_csv ) ) {

		$product_year = filter_input( INPUT_POST, 'product_year', FILTER_SANITIZE_STRING );
		$product_id   = filter_input( INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT );

		if ( ! empty( $product_id ) ) {

			$product_year = empty( $product_year ) ? date( 'Y' ) : $product_year;

			// Get all order id for current product from the database
			$all_order_ids = nab_get_orders_ids_by_product_id( $product_id, $product_year );


			if ( is_array( $all_order_ids ) && count( $all_order_ids ) > 0 ) {

				// Unique id array
				$all_order_ids = array_unique( $all_order_ids );

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
				$output_handle   = fopen( 'php://output', 'w' );

				header( 'Content-type: application/csv' );
				header( 'Content-Disposition: attachment; filename=' . $output_filename );

				// Insert header row
				fputcsv( $output_handle, $csv_fields );

				// Loop through all the order
				foreach ( $all_order_ids as $order_id ) {

					$dynamic_fields = array();

					// Get WC order
					$order = wc_get_order( $order_id );

					// Customer info
					$order_user_details = $order->get_user();

					$customer_id        = $order_user_details->data->ID;
					$customer_email     = $order_user_details->data->user_email;
					$customer_company   = get_user_meta( $customer_id, 'attendee_company', true );
					$customer_title     = get_user_meta( $customer_id, 'attendee_title', true );
					$customer_interest  = get_user_meta( $customer_id, 'attendee_interest', true );
					$customer_interest1 = get_user_meta( $customer_id, 'attendee_other_interest', true );
					$opt_partner        = get_user_meta( $customer_id, 'attendee_partner_opt_in', true );
					$opt_exhibitor      = get_user_meta( $customer_id, 'attendee_exhibition_sponsors_opt_in', true );
					$customer_meet      = get_user_meta( $customer_id, 'attendee_meet', true );
					$customer_discover  = get_user_meta( $customer_id, 'attendee_discover', true );
					$first_name         = get_user_meta( $customer_id, 'first_name', true );
					$last_name          = get_user_meta( $customer_id, 'last_name', true );

					if ( empty( $first_name ) && empty( $last_name ) ) {
						$first_name = $order_user_details->data->display_name;
					}

					$final_interest = '';

					if ( is_array( $customer_interest ) && count( $customer_interest ) > 0 ) {
						$final_interest = implode( ', ', $customer_interest );
					}

					if ( ! empty( $customer_interest1 ) ) {
						$final_interest .= $customer_interest1;
					}

					$customer_meet     = is_array( $customer_meet ) && count( $customer_meet ) > 0 ? implode( ', ', $customer_meet ) : '-';
					$customer_discover = is_array( $customer_discover ) && count( $customer_discover ) > 0 ? implode( ', ', $customer_discover ) : '-';

					// Order info
					$order_date = $order->get_date_created()->date( 'Y-m-d' );
					$coupons    = $order->get_coupon_codes();
					$total      = $order->get_total();
					$qty        = 0;

					foreach ( $order->get_items() as $item ) {

						if ( $item->get_product_id() == $product_id ) {
							$qty = $item->get_quantity();
						}
					}

					if ( is_array( $coupons ) && count( $coupons ) > 0 ) {
						$coupons = implode( ',', $coupons );
					} else {
						$coupons = '-';
					}

					//Add csv fields row
					$dynamic_fields[] = $order_id;
					$dynamic_fields[] = $order_date;
					$dynamic_fields[] = $first_name;
					$dynamic_fields[] = ! empty( $last_name ) ? $last_name : '-';
					$dynamic_fields[] = $customer_email;
					$dynamic_fields[] = ! empty( $customer_company ) ? $customer_company : '-';
					$dynamic_fields[] = ! empty( $customer_title ) ? $customer_title : '-';
					$dynamic_fields[] = $total;
					$dynamic_fields[] = $qty;
					$dynamic_fields[] = $coupons;
					$dynamic_fields[] = ! empty( $final_interest ) ? $final_interest : '-';
					$dynamic_fields[] = ! empty( $opt_partner ) ? $opt_partner : '-';
					$dynamic_fields[] = ! empty( $opt_exhibitor ) ? $opt_exhibitor : '-';
					$dynamic_fields[] = $customer_meet;
					$dynamic_fields[] = $customer_discover;

					fputcsv( $output_handle, $dynamic_fields );
				}

				exit;
			}

		}

	}
} );

/**
 * Get All header logos
 *
 * @param WP_REST_Request $request
 *
 * @return array
 */
function amplify_get_header_logos( WP_REST_Request $request ) {

	$response = [];

	if ( have_rows( 'nab_logos', 'option' ) ):
		while ( have_rows( 'nab_logos', 'option' ) ): the_row();
			$logos          = [];
			$nab_logo_id    = get_sub_field( 'logos' );
			$nab_logo_img   = wp_get_attachment_image_src( $nab_logo_id, 'medium' );
			$nab_logo_url   = get_sub_field( 'logo_url' );
			$logos['url']   = ( isset( $nab_logo_url ) && ! empty( $nab_logo_url ) ) ? $nab_logo_url : '#';
			$logos['image'] = ( isset( $nab_logo_img ) && ! empty( $nab_logo_img ) ) ? $nab_logo_img[0] : '';
			array_push( $response, $logos );
		endwhile;
	endif;

	return new WP_REST_Response( $response, 200 );
}

/**
 * Show the customer display name in the customer column.
 *
 * @param $column
 * @param $post_id
 */
function nab_customer_column_data( $column, $post_id ) {

	switch ( $column ) {
		case 'customer':

			// Get WC order
			$order = wc_get_order( $post_id );

			if ( ! empty( $order ) ) {

				$order_user_details = $order->get_user();

				$customer_id   = $order_user_details->data->ID;
				$customer_name = $order_user_details->data->display_name;

				$profile_url = get_edit_user_link( $customer_id );
				?>
                <a href="<?php echo esc_url( $profile_url ); ?>"><?php echo esc_html( $customer_name ); ?></a>
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
function nab_add_user_company_column( $columns ) {

	$manage_columns = array();

	foreach ( $columns as $key => $value ) {

		if ( 'email' === $key ) {

			$manage_columns[ $key ]    = $value;
			$manage_columns['company'] = 'Company';
		}

		$manage_columns[ $key ] = $value;
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
function nab_user_company_column_data( $value, $column_name, $user_id ) {


	if ( 'company' === $column_name ) {

		$company = get_user_meta( $user_id, 'attendee_company', true );

		if ( ! empty( $company ) ) {
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
function nab_add_additional_filter_for_user_list( $which ) {

	if ( 'top' === $which ) {

		$option_items = array(
			'company' => 'Company',
			'name'    => 'Name'
		);
		?>
        <select name="user_filter">
            <option value="">Additional Filter</option>
			<?php

			$user_filter = filter_input( INPUT_GET, 'user_filter', FILTER_SANITIZE_STRING );
			$current_v   = isset( $user_filter ) ? $user_filter : '';

			foreach ( $option_items as $key => $value ) {
				?>
                <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $current_v, $key ); ?>><?php echo esc_html( $value ); ?></option>
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
function nab_modify_user_search_query( $query ) {

	global $pagenow;

	if ( is_admin() && 'users.php' === $pagenow ) {

		$user_filter = filter_input( INPUT_GET, 'user_filter', FILTER_SANITIZE_STRING );
		$search_item = filter_input( INPUT_GET, 's', FILTER_SANITIZE_STRING );

		if ( ( isset( $user_filter ) && ! empty( $user_filter ) ) && ( isset( $search_item ) && ! empty( $search_item ) ) ) {

			global $wpdb;

			if ( 'company' === $user_filter || 'name' === $user_filter ) {

				$field = '';

				if ( 'name' === $user_filter ) {

					$field       = 'first_name';
					$search_item = trim( $search_item, ' ' );

					$search_item_array = explode( ' ', $search_item );

					if ( is_array( $search_item_array ) && count( $search_item_array ) > 0 ) {

						$search_item = $search_item_array[0];
					}

				} else {

					$field = 'attendee_company';
				}

				// let's search by users company
				$query->query_from .= " AND wp_usermeta.meta_key = '{$field}'";

				// what fields to include in the search
				$search_by = array( 'wp_usermeta.meta_value' );

				// apply to the query
				$query->query_where = 'WHERE 1=1' . $query->get_search_sql( $search_item, $search_by, 'both' );
			}
		}
	}
}

/**
 * Added inline style to fixed ACF media upload modal text overlapping issue.
 */
function nab_add_inline_style_for_acf_upload_popup() {

	wp_add_inline_style( 'acf-input', '.acf-media-modal .media-modal-content .media-frame .media-toolbar-secondary select.attachment-filters{margin-top:32px;}' );
}

/**
 * Register event shows post type
 */
function nab_register_event_shows_post_type() {

	$labels = array(
		'name'               => _x( 'Shows', 'post type general name', 'nab-amplify' ),
		'singular_name'      => _x( 'Shows', 'post type singular name', 'nab-amplify' ),
		'add_new_item'       => __( 'Add New', 'nab-amplify' ),
		'edit_item'          => __( 'Edit', 'nab-amplify' ),
		'new_item'           => __( 'New', 'nab-amplify' ),
		'view_item'          => __( 'View', 'nab-amplify' ),
		'search_items'       => __( 'Search', 'nab-amplify' ),
		'not_found'          => __( 'No show found.', 'nab-amplify' ),
		'not_found_in_trash' => __( 'No show found in Trash.', 'nab-amplify' )
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
			'custom-fields'
		),
	);

	register_post_type( 'event-shows', $args );
}

function nab_set_user_login_cookie_for_other_site( $user_login, $user ) {

	$user_token = nab_encrypt_user_token( $user->ID );

	if ( ! empty( $user_token ) ) {

		setcookie( 'nab_share_login', $user_token, time() + 3600, '/', '.nabshow.com' );
	}
}

function nab_encrypt_user_token( $user_id ) {

	$iv = substr( hash( 'sha256', 'nab309fr7uj34' ), 0, 16 );

	$k = hash( 'sha256', 'nabjd874hey64t' );

	return base64_encode( openssl_encrypt( $user_id, 'AES-256-CBC', $k, 0, $iv ) );
}

function nab_clear_share_login_cookie() {

	unset( $_COOKIE['nab_share_login'] );
	setcookie( 'nab_share_login', null, - 1, '/', '.nabshow.com' );
}


/**
 * Update purchased product in the user meta when order status change.
 *
 * @param int $order_id
 * @param string $old_status
 * @param string $new_status
 */
function nab_update_product_in_user_meta( $order_id, $old_status, $new_status ) {

	$order = wc_get_order( $order_id );

	$order_user_details = $order->get_user();
	$customer_id        = $order_user_details->data->ID;

	if ( ! empty ( $customer_id ) ) {

		$order_products = array();

		$purchased_product = get_user_meta( $customer_id, 'nab_purchased_product_2020', true );

		// Get order products
		foreach ( $order->get_items() as $item_id => $product_item ) {

			$order_products[] = $product_item->get_product_id();
		}

		// Add product id to user meta when order completed
		if ( 'completed' === $new_status ) {

			// Add or merge user purchased product ids
			if ( ! empty( $purchased_product ) && is_array( $purchased_product ) ) {

				$purchased_product = array_unique( array_merge( $purchased_product, $order_products ) );

			} else {

				$purchased_product = $order_products;
			}

			update_user_meta( $customer_id, 'nab_purchased_product_2020', $purchased_product );
		}

		// Remove product id from user meta if order status changed from completed to any other status.
		if ( 'completed' === $old_status ) {

			if ( ! empty( $purchased_product ) && is_array( $purchased_product ) ) {

				foreach ( $order_products as $product_id ) {

					if ( ( $key = array_search( $product_id, $purchased_product ) ) !== false ) {
						unset( $purchased_product[ $key ] );
					}
				}

				update_user_meta( $customer_id, 'nab_purchased_product_2020', $purchased_product );
			}
		}
	}

}


/**
 * WC edit account additional security form field for BP member.
 */
function nab_edit_acount_additional_form_fields() {

	$current_user_id    = get_current_user_id();
	$member_visibility  = get_user_meta( $current_user_id, 'nab_member_visibility', true );
	$member_restriction = get_user_meta( $current_user_id, 'nab_member_restrict_connection', true );
	$attendee_title		= get_user_meta( $current_user_id, 'attendee_title', true );
	$attendee_company	= get_user_meta( $current_user_id, 'attendee_company', true );
	$social_twitter		= get_user_meta( $current_user_id, 'social_twitter', true );
	$social_linkedin	= get_user_meta( $current_user_id, 'social_linkedin', true );
	$social_facebook	= get_user_meta( $current_user_id, 'social_facebook', true );
	$social_instagram	= get_user_meta( $current_user_id, 'social_instagram', true );
	$social_website		= get_user_meta( $current_user_id, 'social_website', true );

	$member_visibility  = ! empty( $member_visibility ) ? $member_visibility : 'yes';
	$member_restriction = ! empty( $member_restriction ) ? $member_restriction : 'yes';

	?>
    <fieldset>
        <legend>Security Settings</legend>
        <div class="amp-member-security">
            <div class="amp-security-row security-column-first">
                <h3>VISIBILITY PREFERENCES</h3>
                <div class="amp-radio-container">
                	<div class="amp-radio-wrp">
                		<input type="radio" name="member_visibility" value="yes" id="member_visible_anyone" <?php checked( $member_visibility, 'yes' ); ?> />
                		<span class="amp-radio"></span>
                	</div>
                	<label for="member_visible_anyone">Visible to anyone</label>
                </div>
                <div class="amp-radio-container">
                	<div class="amp-radio-wrp">
                		<input type="radio" name="member_visibility" value="no" id="member_visible_friend" <?php checked( $member_visibility, 'no' ); ?> />
                		<span class="amp-radio"></span>
                	</div>
                	<label for="member_visible_friend">Visible to approved connections only</label>
                </div>
            </div>
            <div class="amp-security-row security-column-last">
                <h3>CONNECTION PREFERENCES</h3>
                <div class="amp-radio-container">
                	<div class="amp-radio-wrp">
                		<input type="radio" name="member_restrict_connection" value="yes" id="member_anyone_request" <?php checked( $member_restriction, 'yes' ); ?> />
                		<span class="amp-radio"></span>
                	</div>
                	<label for="member_anyone_request">Anyone can request to connect</label>
                </div>
                <div class="amp-radio-container">
                	<div class="amp-radio-wrp">
                		<input type="radio" name="member_restrict_connection" value="no" id="member_not_available" <?php checked( $member_restriction, 'no' ); ?> />
                		<span class="amp-radio"></span>
                	</div>
                	<label for="member_not_available">I am not available to connect with other users</label>
                </div>
            </div>
        </div>
    </fieldset>
	<div class="nab-profile">
		<div class="nab-section section-nab-profile">
			<div class="nab-profile-body flex-row">
				<div class="nab-section section-professional-details">
					<h3>PROFESSIONAL DETAILS</h3>
					<div class="professional-details-form">
						<div class="nab-form-row">
							<label for="attendee_title">Title</label>
							<input type="text" name="attendee_title" class="input-text" placeholder="Title" value="<?php echo esc_attr( $attendee_title ); ?>"/>
						</div>
						<div class="nab-form-row">
							<label for="attendee_company">Company</label>
							<input type="text" name="attendee_company" class="input-text" placeholder="Company" value="<?php echo esc_attr( $attendee_company ); ?>"/>
						</div>
					</div>
				</div>
				<div class="nab-section section-social-links">
					<h3>SOCIAL LINKS</h3>
					<div class="social-links-form">
						<div class="nab-form-row">
							<div class="social-icon">
								<i class="fa fa-twitter"></i>
							</div>
							<div class="social-input">
								<input type="text" class="input-text" name="social_twitter" placeholder="Twitter" value="<?php echo esc_attr( $social_twitter ); ?>">
							</div>
						</div>
						<div class="nab-form-row">
							<div class="social-icon">
								<i class="fa fa-linkedin"></i>
							</div>
							<div class="social-input">
								<input type="text" class="input-text" name="social_linkedin" placeholder="LinkedIn" value="<?php echo esc_attr( $social_linkedin ); ?>">
							</div>
						</div>
						<div class="nab-form-row">
							<div class="social-icon">
								<i class="fa fa-facebook-square"></i>
							</div>
							<div class="social-input">
								<input type="text" class="input-text" name="social_facebook" placeholder="Facebook" value="<?php echo esc_attr( $social_facebook ); ?>">
							</div>
						</div>
						<div class="nab-form-row">
							<div class="social-icon">
								<i class="fa fa-instagram"></i>
							</div>
							<div class="social-input">
								<input type="text" class="input-text" name="social_instagram" placeholder="Instagram" value="<?php echo esc_attr( $social_instagram ); ?>">
							</div>
						</div>
						<div class="nab-form-row">
							<div class="social-icon">
								<i class="fa fa-link"></i>
							</div>
							<div class="social-input">
								<input type="text" class="input-text" name="social_website" placeholder="Website" value="<?php echo esc_attr( $social_website ); ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Save edit account additional security form field for BP member.
 *
 * @param int $user_id
 */
function nab_save_edit_account_additional_form_fields( $user_id ) {


	$member_visibility  = filter_input( INPUT_POST, 'member_visibility', FILTER_SANITIZE_STRING );
	$member_restriction = filter_input( INPUT_POST, 'member_restrict_connection', FILTER_SANITIZE_STRING );

	if ( isset( $member_visibility ) && ! empty( $member_visibility ) ) {
		update_user_meta( $user_id, 'nab_member_visibility', $member_visibility );
	}

	if ( isset( $member_restriction ) && ! empty( $member_restriction ) ) {
		update_user_meta( $user_id, 'nab_member_restrict_connection', $member_restriction );
	}

	$user_fields = array(
		'attendee_title',
		'attendee_company',
		'social_twitter',
		'social_linkedin',
		'social_facebook',
		'social_instagram',
		'social_website',
	);

	foreach( $user_fields as $field ) {

		$field_val = filter_input( INPUT_POST, $field, FILTER_SANITIZE_STRING );

		if ( isset( $field_val ) ) {

			update_user_meta( $user_id, $field, $field_val );
		}
	}
}

/**
 * Redirect user to edit account page after save the address or account.
 */
function nab_woocommerce_customer_save_changes_redirect() {

	wp_safe_redirect( wc_get_account_endpoint_url( 'edit-account' ) );

	exit;
}

/**
 * Added search settings submenu page.
 */
function nab_amplify_search_settings() {

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
function nab_search_settings_callback() {


	$display_horizontal_banner  = filter_input( INPUT_POST, 'display_horizontal_banner', FILTER_SANITIZE_STRING );
	$display_vertical_banner	= filter_input( INPUT_POST, 'display_vertical_banner', FILTER_SANITIZE_STRING );

	if ( isset( $display_horizontal_banner ) && ! empty( $display_horizontal_banner ) ) {

		update_option( 'search_display_horizontal_banner', $display_horizontal_banner );

	} else {

		$display_horizontal_banner = get_option( 'search_display_horizontal_banner', 'no' );
	}

	if ( isset( $display_vertical_banner ) && ! empty( $display_vertical_banner ) ) {

		update_option( 'search_display_vertical_banner', $display_vertical_banner );

	} else {

		$display_vertical_banner = get_option( 'search_display_vertical_banner', 'no' );
	}

	if ( isset( $_POST[ 'search_horizontal_banner'] ) ) {

		$search_horizontal_banner	= wp_kses_post( $_POST[ 'search_horizontal_banner'] );
		$search_vertical_banner		= wp_kses_post( $_POST[ 'search_vertical_banner'] );

		update_option( 'search_horizontal_banner', $search_horizontal_banner );
		update_option( 'search_vertical_banner', $search_vertical_banner );
	}
	?>
	<div class="search-settings">
		<h2>Search Settings</h2>
		<form class="search-settings-form" method="post">
			<table class="form-table" role="presentation">
				<tr>
					<th>Display Horizontal Ad:</th>
					<td>
						<input id="display_horizontal_banner_yes" type="radio" value="yes" name="display_horizontal_banner" <?php checked( $display_horizontal_banner, 'yes' ); ?> />
						<label for="display_horizontal_banner_yes">Yes</label>
						<input id="display_horizontal_banner_no" type="radio" value="no" name="display_horizontal_banner" <?php checked( $display_horizontal_banner, 'no' ); ?> />
						<label for="display_horizontal_banner_no">No</label>
					</td>
				</tr>
				<tr>
					<th>
						<label>Horizontal Ad:</label>
					</th>
					<td>
						<?php
						$search_horizontal_banner = get_option( 'search_horizontal_banner' );
						wp_editor( $search_horizontal_banner, 'search_horizontal_banner', array('tinymce' => false));
						?>
					</td>
				</tr>
				<tr>
					<th>Display vertical Ad:</th>
					<td>
						<input id="display_vertical_banner_yes" type="radio" value="yes" name="display_vertical_banner" <?php checked( $display_vertical_banner, 'yes' ); ?> />
						<label for="display_vertical_banner_yes">Yes</label>
						<input id="display_vertical_banner_no" type="radio" value="no" name="display_vertical_banner" <?php checked( $display_vertical_banner, 'no' ); ?> />
						<label for="display_vertical_banner_no">No</label>
					</td>
				</tr>
				<tr>
					<th>
						<label>Vertical Ad:</label>
					</th>
					<td>
						<?php
						$search_vertical_banner = get_option( 'search_vertical_banner' );
						wp_editor( $search_vertical_banner, 'search_vertical_banner', array('tinymce' => false));
						?>
					</td>
				</tr>
			</table>
			<?php submit_button("Save Changes"); ?>
		</form>
	</div>
	<?php
}

function nab_register_company_post_type() {

	$labels = array(
		'name'               => _x( 'Companies', 'post type general name', 'nab-amplify' ),
		'singular_name'      => _x( 'Companies', 'post type singular name', 'nab-amplify' ),
		'add_new_item'       => __( 'Add New', 'nab-amplify' ),
		'edit_item'          => __( 'Edit', 'nab-amplify' ),
		'new_item'           => __( 'New', 'nab-amplify' ),
		'view_item'          => __( 'View', 'nab-amplify' ),
		'search_items'       => __( 'Search', 'nab-amplify' ),
		'not_found'          => __( 'No company found.', 'nab-amplify' ),
		'not_found_in_trash' => __( 'No company found in Trash.', 'nab-amplify' )
	);

	$args = array(
		'labels'              => $labels,
		'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
		'supports'            => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'custom-fields'
		),
	);

	register_post_type( 'company', $args );
}

/**
 * Create Compnay user base on Compnay post.
 *
 * @param  int $post_id
 */
function nab_create_compnay_user( $post_id ) {

    $current_post   = get_post( $post_id );

    if ( 'publish' === $current_post->post_status && 'company' === $current_post->post_type ) {

        $company_email = get_field( 'company_email', $post_id );

        if ( ! empty( $company_email ) && is_email( $company_email ) ) {

            $user_id = email_exists( $company_email );

            if ( ! $user_id ) {

                // Create new company user
                $user_details       = array( 'user_email' => $company_email );

				$user_details[ 'user_pass' ]    = wp_generate_password();
				$user_details[ 'user_login' ]   = wc_create_new_customer_username( $user_details[ 'user_email' ], array( 'first_name' => $current_post->post_title ) );
                $user_details[ 'role' ]         = 'customer';

				$new_user = wp_insert_user( $user_details );

                if ( ! is_wp_error( $new_user ) ) {

                    $user_id = $new_user;

                    update_post_meta( $post_id, 'company_user_id', $user_id );
                    update_user_meta( $user_id, 'comapny_post_id', $post_id );

                    do_action( 'nab_sent_user_registration_email', $user_id, $user_details[ 'user_pass' ], $user_details[ 'user_email' ] );
                }

            } else {

                update_user_meta( $user_id, 'first_name', $current_post->post_title );
            }
        }
    }
}

/**
 * Register Articles post type
 */
function nab_register_article_post_type() {

	$labels = array(
		'name'                  => _x( 'Articles', 'Post Type General Name', 'nab-amplify' ),
		'singular_name'         => _x( 'Articles', 'Post Type Singular Name', 'nab-amplify' ),
		'menu_name'             => __( 'Articles', 'nab-amplify' ),
		'name_admin_bar'        => __( 'Articles', 'nab-amplify' ),
		'archives'              => __( 'Articles Archives', 'nab-amplify' ),
		'attributes'            => __( 'Articles Attributes', 'nab-amplify' ),
		'parent_item_colon'     => __( 'Parent Article:', 'nab-amplify' ),
		'all_items'             => __( 'All Articles', 'nab-amplify' ),
		'add_new_item'          => __( 'Add New Article', 'nab-amplify' ),
		'add_new'               => __( 'Add New', 'nab-amplify' ),
		'new_item'              => __( 'New Article', 'nab-amplify' ),
		'edit_item'             => __( 'Edit Article', 'nab-amplify' ),
		'update_item'           => __( 'Update Article', 'nab-amplify' ),
		'view_item'             => __( 'View Article', 'nab-amplify' ),
		'view_items'            => __( 'View Articles', 'nab-amplify' ),
		'search_items'          => __( 'Search Articles', 'nab-amplify' ),
		'not_found'             => __( 'Not found', 'nab-amplify' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'nab-amplify' ),
		'featured_image'        => __( 'Featured Image', 'nab-amplify' ),
		'set_featured_image'    => __( 'Set featured image', 'nab-amplify' ),
		'remove_featured_image' => __( 'Remove featured image', 'nab-amplify' ),
		'use_featured_image'    => __( 'Use as featured image', 'nab-amplify' ),
		'insert_into_item'      => __( 'Insert into Article', 'nab-amplify' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'nab-amplify' ),
		'items_list'            => __( 'Items list', 'nab-amplify' ),
		'items_list_navigation' => __( 'Items list navigation', 'nab-amplify' ),
		'filter_items_list'     => __( 'Filter items list', 'nab-amplify' ),
	);
	$args = array(
		'label'                 => __( 'Articles', 'nab-amplify' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats' ),
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
	register_post_type( 'articles', $args );
}

// Register discover content Taxonomy
function nab_register_discovery_content_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Category', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'discovery-content-tax', array( 'articles' ), $args );

}