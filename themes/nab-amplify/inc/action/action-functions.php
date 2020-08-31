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
	// $sites = get_sites(); // for all sites

	$sites = [ 5 ]; // for NY site @todo Make it dynamic later

	foreach ( $sites as $site ) {
		if ( isset( $user->ID ) && ! empty( $user->ID ) && false === is_user_member_of_blog( $user->ID, $site ) ) {
			add_user_to_blog( $site, $user->ID, 'customer' );
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
 * @param object/array $post Post data.
 */
function product_publisher_content_html( $post ) {
	$product_publisher_content_html = get_post_meta( $post->ID, '_product_publisher_content_html', true );
	$editor_id                      = 'product_publisher_content_html'; // Unique ID
	wp_editor( $product_publisher_content_html, $editor_id );
}

/**
 * Callback for Long Content
 *
 * @param object/array $post Post data.
 */
function product_long_content_html( $post ) {
	$product_long_content_html = get_post_meta( $post->ID, '_product_long_content_html', true );
	$editor_id                 = 'product_long_content_html'; // Unique ID
	wp_editor( $product_long_content_html, $editor_id );
}

/**
 * Callback for Join Today Content
 *
 * @param object/array $post Post data.
 */
function product_join_today_content_html( $post ) {
	$product_join_today_content = get_post_meta( $post->ID, '_product_join_today_content_html', true );
	$editor_id                  = 'product_join_today_content_html'; // Unique ID
	wp_editor( $product_join_today_content, $editor_id );
}

/**
 * Callback for Product Video
 *
 * @param object/array $post Post data.
 */
function product_video_text_box_html( $post ) {

	$product_video_url   = get_post_meta( $post->ID, '_product_video_url', true );
	$product_video_id    = get_post_meta( $post->ID, '_product_video_thumb', true );
	$product_video_thumb = wp_get_attachment_image_src( $product_video_id, 'full' )[0];

	?>
	<p>Type the URL of your BrightCov Video.</p>
	<input style="width: 100%" type="text" name="product_video_url" value="<?php echo $product_video_url ?>"/>

	<p>Choose or Upload an Image</p>
    <p style="<?php if ( ! $product_video_thumb ) { echo 'dispaly: none'; } ?>"><img src="<?php echo esc_url( $product_video_thumb ); ?>" id="product_video_thumb_img" style="max-width: 250px; cursor: pointer"/></p>
	<input type="hidden" id="product_video_thumb" name="product_video_thumb" value="<?php echo esc_attr( $product_video_id ); ?>"/>
	<input type="button" id="product_video_thumb_button" class="button" value="Choose or Upload an Image"/>

	<script>
			jQuery( '#product_video_thumb_button, #product_video_thumb_img' ).click( function() {

				var send_attachment_bkp = wp.media.editor.send.attachment;

				wp.media.editor.send.attachment = function( props, attachment ) {
					jQuery( '#product_video_thumb_img' ).attr( 'src', attachment.url ).show();
					jQuery( '#product_video_thumb' ).val( attachment.id );
					wp.media.editor.send.attachment = send_attachment_bkp;
				};

				wp.media.editor.open();

				return false;
			} );
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
 * Edit My Profile content.
 */
function nab_amplify_edit_my_profile_content_callback() {
	get_template_part( 'template-parts/content', 'edit-my-profile' );
}

/**
 * Register endpoints to use for My Account page.
 */
function nab_amplify_add_custom_endpoints() {
	add_rewrite_endpoint( 'edit-my-profile', EP_ROOT | EP_PAGES );
	add_rewrite_endpoint( 'my-purchases', EP_ROOT | EP_PAGES );
}

/**
 * My Purchases content.
 */
function nab_amplify_my_purchases_content_callback() {
	get_template_part( 'template-parts/content', 'my-purchases' );
}

/**
 * Register edit my profile endpoint to use for My Account page.
 */
function nab_amplify_my_purchases_endpoint() {
	add_rewrite_endpoint( 'my-purchases', EP_ROOT | EP_PAGES );
}

// Our custom post type function
function nab_amplify_register_post_types() {

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

	// Return if user is not logged in
	if ( ! is_user_logged_in() ) {
		return;
	}

	$user_id = get_current_user_id();

	$event_data = array(
		'attendee_first_name'     => ( isset( $_POST['attendee_first_name'] ) && ! empty( $_POST['attendee_first_name'] ) ) ? sanitize_text_field( $_POST['attendee_first_name'] ) : '',
		'attendee_last_name'      => ( isset( $_POST['attendee_last_name'] ) && ! empty( $_POST['attendee_last_name'] ) ) ? sanitize_text_field( $_POST['attendee_last_name'] ) : '',
		'attendee_email'          => ( isset( $_POST['attendee_email'] ) && ! empty( $_POST['attendee_email'] ) ) ? sanitize_email( $_POST['attendee_email'] ) : '',
		'attendee_company'        => ( isset( $_POST['attendee_company'] ) && ! empty( $_POST['attendee_company'] ) ) ? sanitize_text_field( $_POST['attendee_company'] ) : '',
		'attendee_title'          => ( isset( $_POST['attendee_title'] ) && ! empty( $_POST['attendee_title'] ) ) ? sanitize_text_field( $_POST['attendee_title'] ) : '',
		'attendee_country'        => ( isset( $_POST['attendee_country'] ) && ! empty( $_POST['attendee_country'] ) ) ? sanitize_text_field( $_POST['attendee_country'] ) : '',
		'attendee_city'           => ( isset( $_POST['attendee_city'] ) && ! empty( $_POST['attendee_city'] ) ) ? sanitize_text_field( $_POST['attendee_city'] ) : '',
		'attendee_state'          => ( isset( $_POST['attendee_state'] ) && ! empty( $_POST['attendee_state'] ) ) ? sanitize_text_field( $_POST['attendee_state'] ) : '',
		'attendee_zip'            => ( isset( $_POST['attendee_zip'] ) && ! empty( $_POST['attendee_zip'] ) ) ? sanitize_text_field( $_POST['attendee_zip'] ) : '',
		'attendee_affiliation'    => ( isset( $_POST['attendee_affiliation'] ) && ! empty( $_POST['attendee_affiliation'] ) ) ? sanitize_text_field( $_POST['attendee_affiliation'] ) : '',
		'attendee_partner_opt_in' => ( isset( $_POST['attendee_partner_opt_in'] ) && ! empty( $_POST['attendee_partner_opt_in'] ) ) ? sanitize_text_field( $_POST['attendee_partner_opt_in'] ) : '',
		'attendee_exhibition_sponsors_opt_in' => ( isset( $_POST['attendee_exhibition_sponsors_opt_in'] ) && ! empty( $_POST['attendee_exhibition_sponsors_opt_in'] ) ) ? sanitize_text_field( $_POST['attendee_exhibition_sponsors_opt_in'] ) : '',
	);

	$event_data['attendee_interest'] = isset( $_POST['attendee_interest'] ) ? $_POST['attendee_interest'] : [];
	if ( isset( $_POST['other_interest'] ) && isset( $_POST['attendee_other_interest'] ) && ! empty( $_POST['attendee_other_interest'] ) ) {
		array_push( $event_data['attendee_interest'], $_POST['attendee_other_interest'] );
	}

	// Save details to user meta as well as order meta
	foreach ( $event_data as $key => $val ) {
		update_user_meta( $user_id, $key, $val );
	}
}

/**
 * Header Scripts
 */
function nab_header_scripts() {
	?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
					new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-K2F9KBS');</script>
	<!-- End Google Tag Manager -->
<?php
}
