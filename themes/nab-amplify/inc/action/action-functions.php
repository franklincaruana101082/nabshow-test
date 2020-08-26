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

	$sites = [ 5 ]; // for NY site @todo Make in dynamic later

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
	<?php if ( $product_video_thumb ) { ?>
		<p><img src="<?php echo esc_url( $product_video_thumb ); ?>" id="product_video_thumb_img" style="max-width: 250px; cursor: pointer"/></p>
	<?php } ?>
	<input type="hidden" id="product_video_thumb" name="product_video_thumb" value="<?php echo esc_attr( $product_video_id ); ?>"/>
	<input type="button" id="product_video_thumb_button" class="button" value="Choose or Upload an Image"/>

	<script>
			jQuery( '#product_video_thumb_button, #product_video_thumb_img' ).click( function() {

				var send_attachment_bkp = wp.media.editor.send.attachment;

				wp.media.editor.send.attachment = function( props, attachment ) {
					jQuery( '#product_video_thumb_img' ).attr( 'src', attachment.url );
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
		wc_add_notice( 'Registration has been completed successfully. Please login to continue!' );
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