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

	if( false === nab_is_bulk_order() ) {

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

}

/**
 * Redirecting templates.
 */
function nab_amplify_template_redirect() {
	if ( is_singular( 'tribe_events' ) ) {
		wp_redirect( home_url(), 301 );
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
	<script>(function( w, d, s, l, i ) {
			w[ l ] = w[ l ] || [];
			w[ l ].push( {
				'gtm.start':
					new Date().getTime(), event: 'gtm.js'
			} );
			var f = d.getElementsByTagName( s )[ 0 ],
				j = d.createElement( s ), dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore( j, f );
		})( window, document, 'script', 'dataLayer', 'GTM-K2F9KBS' );</script>
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

	$sites = [ 5 ]; // for NY site @todo Make it dynamic later

	foreach ( $sites as $site ) {
		if ( isset( $customer_id ) && ! empty( $customer_id ) && false === is_user_member_of_blog( $customer_id, $site ) ) {
			add_user_to_blog( $site, $customer_id, 'subscriber' );
		}
	}
}

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
			`created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  			`modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY  (id)
			) {$charset_collate};";

	dbDelta( $sql );
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

	register_rest_route(
		'nab', '/unlink-products', array(
			'methods'  => 'POST',
			'callback' => 'nab_amplify_unlink_products',
		)
	);

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

	$current_post_id       = isset( $parameters['current_post_id'] ) ? $parameters['current_post_id'] : '';
	$unlinked_products = isset( $parameters['unlinked_products'] ) ? explode( ',', $parameters['unlinked_products'] ) : '';
	$shop_blog_id = isset( $parameters['shop_blog_id'] ) ? (int) $parameters['shop_blog_id'] : '';
	$current_blog_id = isset( $parameters['current_blog_id'] ) ? (int) $parameters['current_blog_id'] : '';

	if ( empty( $current_post_id ) || empty( $unlinked_products ) || empty( $shop_blog_id ) || empty( $current_blog_id ) ) {
		return "Please pass necessary paramters.";
	}
	
	switch_to_blog($shop_blog_id);
	
	foreach( $unlinked_products as $product_id ) {
		$associated_content = maybe_unserialize( get_post_meta( $product_id, '_associated_content', true ) );
		if( isset( $associated_content[ $current_blog_id ][ $current_post_id ] ) ) {
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
		'post_per_page' => - 1,
		'post_type'     => 'product',
		'orderby'       => 'title',
		'fields'        => 'ids',
		'order'         => 'ASC',
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
			$product_name = get_the_title();

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

function nab_create_jwt_token( $username, $password ) {
	
	if( ! empty( $username ) && ! empty( $password ) ) {
		$url = home_url() . '/wp-json/jwt-auth/v1/token';
		$data = array(
			'username' => $username,
			'password'=> $password,
		);

		$response = wp_remote_post( $url, array(
			'body'    => $data,
		) );

		$response_code = wp_remote_retrieve_response_code( $response );

		if( 200 === $response_code && ! empty( $response['body'] ) ) {
			$response_body = json_decode( $response['body'], true );
			
			if( isset( $response_body['token'] ) && isset( $response_body['user_id'] ) ) {
				update_user_meta( $response_body['user_id'], 'nab_jwt_token', $response_body['token'] );
			}
		}
	}

}

/**
 * Get coupon code form the url.
 */
function amplify_apply_coupon_code_from_url() {
	
	if ( is_admin() ) {
		return;
	}
	
	$coupon_code = filter_input( INPUT_GET, 'amp_apply_coupon', FILTER_SANITIZE_STRING );

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
 * @param  string  $coupon_code
 * @param  boolean $force_start 
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
 * @param  int $product_id
 * 
 * @return boolean
 */
function amplify_is_product_in_cart( $product_id ) {
	if ( 0 !== $product_id ) {
		if ( isset( WC()->cart->cart_contents ) && is_array( WC()->cart->cart_contents ) ) {
			foreach ( WC()->cart->cart_contents as $cart_item_key => $cart_item_data ) {
				if (
					( isset( $cart_item_data['product_id'] )   && $product_id == $cart_item_data['product_id'] ) ||
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
	
	$coupon_code		= isset( $_COOKIE[ 'amp_wc_coupon' ] ) && ! empty( $_COOKIE[ 'amp_wc_coupon' ] ) ? $_COOKIE[ 'amp_wc_coupon' ] : '';	

    if ( empty( $coupon_code ) ) {
		return;
	}

	WC()->cart->add_discount( $coupon_code );	

	unset( $_COOKIE[ 'amp_wc_coupon' ] );
	setcookie( 'amp_wc_coupon', null, -1, '/');
}

/**
 * Remove product from cocart session cart if removed from main cart
 *
 * @param string $cart_item_key
 * @param object $instance
 * @return void
 */
function nab_remove_cocart_item( $cart_item_key, $instance ) {

	if ( isset( $_COOKIE['nabCartKey'] ) && ! empty( $_COOKIE['nabCartKey'] ) ) {
		$cart_key = $_COOKIE['nabCartKey'];

		$args = array(
			'headers' => array(
				'Content-Type' => 'application/json; charset=utf-8',
			),
			'body'    => wp_json_encode( [
				'cart_item_key' => $cart_item_key,
				'cart_key'      => $cart_key
			] ),
			'method'  => 'DELETE',
		);

		$api_url  =  home_url() . '/wp-json/cocart/v1/item';
		$response = wp_remote_request( $api_url, $args );

		$a = [];
		$a['api_url'] = $api_url;
		$a['res'] = $response['body'];
		wp_mail('hardik.thakkar@multidots.com', 'rm-cart', print_r( $a, true ));
	}

}
/**
 * Load cart from cocart session cart
 *
 * @return void
 */
function nab_load_cart_action_cookie() {

	wp_mail('hardik.thakkar@multidots.com', 'co-cart start', print_r( $_COOKIE, true ) );

	// If cookie is not present then just return
	if ( ! isset( $_COOKIE['nabCartKey'] ) ) {
		return;
	}

	$cart_key      = trim( wp_unslash( $_COOKIE['nabCartKey'] ) );
	$override_cart = false;  // Override the cart by default.

	// wc_nocache_headers();

	// Get the cart in the database.
	$stored_cart = nab_cocart_get_cart( $cart_key );

	wp_mail('hardik.thakkar@multidots.com', 'stored-cart', print_r( $stored_cart, true ));

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

	wp_mail('hardik.thakkar@multidots.com', 'up-cart', print_r( 'loaded from cocart', true ));

}

/**
 * Update cocart session cart if main cart is updated
 *
 * @param string $cart_item_key
 * @param int $quantity
 * @param int $old_quantity
 * @return void
 */
function nab_update_cocart_item( $cart_item_key, $quantity, $old_quantity ) {

	if ( isset( $_COOKIE['nabCartKey'] ) && ! empty( $_COOKIE['nabCartKey'] ) ) {
		$cart_key = $_COOKIE['nabCartKey'];

		$args = array(
			'headers' => array(
				'Content-Type' => 'application/json; charset=utf-8',
			),
			'body'    => wp_json_encode( [
				'cart_item_key' => $cart_item_key,
				'quantity'      => $quantity,
			] ),
		);

		$api_url  = add_query_arg( 'cart_key', $cart_key, home_url() . '/wp-json/cocart/v1/item' );
		$response = wp_remote_post( $api_url, $args );
	}
}

/**
 * NAB Remove custom cocart cookie
 *
 * @return void
 */
function nab_maybe_clear_cart_cookie() {

	if ( isset( $_COOKIE['nabCartKey'] ) && ! empty( $_COOKIE['nabCartKey'] ) ) {
		unset($_COOKIE['nabCartKey']); 
		setcookie( 'nabCartKey', '', time() - 3600, '/', NAB_AMPLIFY_COOKIE_BASE_DOMAIN );
	}

}