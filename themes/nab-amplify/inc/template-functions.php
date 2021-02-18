<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Amplify
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function nab_amplify_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_filter('body_class', 'nab_amplify_body_classes');

/**
 * Retrieves the user images.
 *
 * @return array list of user images
 */
function nab_amplify_get_user_images($user_id = 0)
{

	$user_id           = 0 !== $user_id && null !== $user_id ? $user_id : get_current_user_id();
	$user_images_names = array(
		array(
			'name'    => 'profile_picture',
			'default' => 'avtar.jpg'
		),
		array(
			'name'    => 'banner_image',
			'default' => 'search-box-cover.png'
		)
	);

	$user_images = array();
	foreach ($user_images_names as $user_image) {

		$user_image_id = get_user_meta($user_id, $user_image['name'], true);

		// If the meta value contains "assets", it has Bynder URL.
		if ( strpos( $user_image_id, 'assets') !== false ) {
			$user_images[$user_image['name']] = $user_image_id;

        // Else try to find from attachments.
		} else {
			if ( 'removed' === $user_image_id ) {
				// Show default avatar if deleted from edit profile section.
				$user_images[ $user_image['name'] ] = get_template_directory_uri() . '/assets/images/' . $user_image['default'];
			} else if ( 'profile_picture' === $user_image['name'] && empty( $user_image_id ) ) {
				// Show WordPress avatar for fresh users, who haven't uploaded their profile pic yet.
				$user_images[ $user_image['name'] ] = bp_core_fetch_avatar( array( 'item_id' => $user_id, 'type' => 'full', 'class' => 'friend-avatar', 'html' => false ) );
			} else {
				// Show uploaded images or the default ones.
				$user_images[ $user_image['name'] ] = ! empty( $user_image_id )
					? wp_get_attachment_image_src( $user_image_id, 'full' )[0]
					: get_template_directory_uri() . '/assets/images/' . $user_image['default'];
			}
		}
	}

	return $user_images;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function nab_amplify_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}

add_action('wp_head', 'nab_amplify_pingback_header');

/**
 * Checks whether the current cart has bulk purchase or not
 *
 * @return bool
 */
function nab_is_bulk_order()
{
	foreach (WC()->cart->get_cart() as $cart_val) {
		if (isset($cart_val['nab_bulk_order']) && 'yes' === $cart_val['nab_bulk_order'] && isset($cart_val['nab_qty']) && !empty($cart_val['nab_qty'])) {
			return true;
		}
	}

	return false;
}

/**
 * Gets the Quantity in bulk order
 *
 * @return false|mixed
 */
function nab_bulk_order_quantity()
{
	if (!nab_is_bulk_order()) {
		return false;
	}

	foreach (WC()->cart->get_cart() as $cart_val) {
		if (isset($cart_val['nab_qty']) && !empty($cart_val['nab_qty'])) {
			return $cart_val['nab_qty'];
		}
	}

	return false;
}

/**
 * Get Attendee count
 *
 * @param $order_id
 *
 * @return int|mixed
 */
function nab_get_attendee_count($order_id)
{
	global $wpdb;

	if (empty($order_id)) {
		return 0;
	}

	$get_attendees_query = $wpdb->prepare("SELECT COUNT(*) AS attendee_count FROM {$wpdb->prefix}nab_attendee WHERE `order_id` = %d AND `status` = 1", $order_id);
	$get_attendees_count = $wpdb->get_results($get_attendees_query, ARRAY_A);

	if (!empty($get_attendees_count)) {
		$attendee_count = $get_attendees_count[0]['attendee_count'];
	} else {
		$attendee_count = 0;
	}

	return $attendee_count;
}

/**
 * Checks whether all attendees are added or not
 *
 * @param $order_id
 *
 * @return bool
 */
function nab_is_all_attendee_added($order_id)
{
	// Get quantity for this order
	$order_qty = get_post_meta($order_id, '_nab_bulk_qty', true);

	if (!isset($order_qty) || empty($order_qty)) {
		return false;
	}

	$attendee_count = nab_get_attendee_count($order_id);

	if ($attendee_count >= $order_qty) {
		return true;
	} else {
		return false;
	}
}

function nab_cocart_get_cart($customer_id, $default = false)
{
	global $wpdb;

	$value = $wpdb->get_var($wpdb->prepare("SELECT cart_value FROM {$wpdb->prefix}cocart_carts WHERE cart_key = %s", $customer_id));

	if (is_null($value)) {
		$value = $default;
	}

	return maybe_unserialize($value);
}

/**
 * Generates JWT token
 *
 * @param string $username
 * @param string $password
 */
function nab_generate_jwt_token($username, $password)
{

	if (!empty($username) && !empty($password)) {
		$url  = home_url() . '/wp-json/jwt-auth/v1/token';
		$data = array(
			'username' => $username,
			'password' => $password,
		);

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL            => $url,
			CURLOPT_CUSTOMREQUEST  => "POST",
			CURLOPT_POSTFIELDS     => $data,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_TIMEOUT        => 30,
		));

		$response = curl_exec($curl);

		$response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		curl_close($curl);

		if (200 === $response_code && !empty($response)) {
			$response_body = json_decode($response, true);

			if (isset($response_body['token']) && isset($response_body['user_id'])) {
				update_user_meta($response_body['user_id'], 'nab_jwt_token', $response_body['token']);
			}
		}
	}
}

/**
 * Get attendee details based on given id.
 *
 * @param int $primary_id
 *
 * @return array
 */
function nab_get_order_attendee_details($primary_id)
{

	global $wpdb;

	$attendee_details = array();

	// Return blank array if primary id is empty
	if (empty($primary_id)) {
		return $attendee_details;
	}

	// Get attendee details from the custom DB table
	$attendees_query = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}nab_attendee WHERE `id` = %d LIMIT 1", $primary_id);
	$attendees       = $wpdb->get_results($attendees_query, ARRAY_A);

	// Set attendee details array from the DB result if not empty array
	if (is_array($attendees) && count($attendees) > 0) {

		$attendee_details = $attendees[0];
	}

	return $attendee_details;
}

function nab_amplify_bp_get_cancel_friendship_button($member_id, $loop = true)
{

	$cancel_friendship_button = '';

	if (is_user_logged_in()) {

		$current_user_id = get_current_user_id();
		$is_friend       = friends_check_friendship_status($current_user_id, $member_id);

		if ($is_friend && 'is_friend' === $is_friend) {
			ob_start();

			if ($loop) {
				bp_nouveau_members_loop_buttons(
					array(
						'container'      => 'div',
						'button_element' => 'a'

					)
				);
			} else {
				bp_add_friend_button($member_id);
			}

			$cancel_friendship_button = ob_get_clean();
		}
	}

	return $cancel_friendship_button;
}

function nab_amplify_bp_get_friendship_button($member_id, $loop = true)
{

	$user_button = '';

	if (is_user_logged_in()) {

		$current_user    = wp_get_current_user();
		$current_user_id = $current_user->ID;
		$member_profile  = bbp_get_user_profile_url($member_id);


		if ($current_user_id === $member_id) {
			return;
		}

		$is_friend = friends_check_friendship_status($current_user_id, $member_id);

		if ($is_friend && 'is_friend' === $is_friend) {

			if ($member_id !== $current_user_id) {
				ob_start();
?>
				<div class="search-actions">
					<?php
					$private_massage_link = wp_nonce_url(bp_loggedin_user_domain() . bp_get_messages_slug() . '/compose/?r=' . bp_core_get_username($member_id));
					bp_send_message_button(array(
						'id'         => 'private_message_' . $member_id,
						'link_class' => 'button nab-conn-msg member-'.$member_id,
						'link_text'  => 'Message',
						'link_href'  => '#',
						'wrapper_id' => 'private_message_' . $member_id
					));
					?>
				</div>
			<?php
				$user_button = ob_get_clean();
			}
		} else if ($is_friend && 'awaiting_response' === $is_friend) {

			add_filter('bp_nouveau_get_members_buttons', 'nab_change_friendship_request_button_in_loop', 10, 3);

			ob_start();
			?>
			<div class="search-actions">
				<?php

				$buttons = bp_nouveau_get_members_buttons(
					array(
						'container'      => 'div',
						'button_element' => 'a',
						'type'           => 'friendship_request'
					)
				);

				if (is_array($buttons) && count($buttons) > 0) {

					foreach ($buttons as $btn) {

						$link_text = 'reject' === strtolower($btn['link_text']) ? 'Ignore' : $btn['link_text'];
				?>
						<div class="generic-button friend-request-action" data-item="<?php echo esc_attr($member_id); ?>">
							<a href="<?php echo esc_url($btn['button_attr']['href']); ?>" class="<?php echo esc_attr($btn['button_attr']['class']); ?>" data-bp-btn-action="<?php echo esc_attr($btn['id']); ?>"><?php echo esc_html($link_text); ?></a>
						</div>
				<?php
					}
				}
				?>
			</div>
			<div class="generic-button friend-view-profile">
				<a class="button" href="<?php echo esc_url($member_profile); ?>">View Profile</a>
			</div>
		<?php
			$user_button = ob_get_clean();
			remove_filter('bp_nouveau_get_members_buttons', 'nab_change_friendship_request_button_in_loop');
		} else {
			ob_start();
		?>
			<div class="search-actions">
				<?php

				if (nab_member_can_connect_to_anyone($member_id)) {
					if ($loop) {
						bp_nouveau_members_loop_buttons(
							array(
								'container'      => 'div',
								'button_element' => 'a',
							)
						);
					} else {
						bp_add_friend_button($member_id);
					}
				}
				?>
			</div>
		<?php
			$user_button = ob_get_clean();
		}
	} else {

		$current_url = home_url(add_query_arg(NULL, NULL));
		$current_url = str_replace('amplify/amplify', 'amplify', $current_url);

		ob_start();
		?>
		<div class="search-actions">
			<a href="<?php echo esc_url(add_query_arg(array('r' => $current_url), wc_get_page_permalink('myaccount'))); ?>" class="friendship-button">Connect</a>
		</div>
	<?php
		$user_button = ob_get_clean();
	}

	return $user_button;
}


/**
 * Get attendee table primary id according to give child order id.
 *
 * @param mixed $child_order_id
 *
 * @return int
 */
function nab_get_attendee_primary_id_by_order_id($child_order_id)
{

	global $wpdb;

	$attendeeId = 0;

	// Return default id if child oreder id is empty
	if (empty($child_order_id)) {
		return $attendeeId;
	}

	// Get attendee primary id
	$attendees_query = $wpdb->prepare("SELECT `id` FROM {$wpdb->prefix}nab_attendee WHERE `child_order_id` = %d LIMIT 1", $child_order_id);
	$attendees       = $wpdb->get_results($attendees_query, ARRAY_A);

	// Set attendee primary id from the DB result if not empty array
	if (is_array($attendees) && count($attendees) > 0) {

		$attendeeId = $attendees[0]['id'];
	}

	return $attendeeId;
}


/**
 * Get order attendees email list.
 *
 * @param int $order_id
 *
 * @return array
 */
function nab_get_order_attendees_email_list($order_id)
{

	global $wpdb;

	$attendee_email = array();

	// Return empty email array if order id empty
	if (empty($order_id)) {
		return $attendee_email;
	}

	// Get attendees email throught the order id
	$attendees_query = $wpdb->prepare("SELECT `email` FROM {$wpdb->prefix}nab_attendee WHERE `order_id` = %d", $order_id);
	$order_attendees = $wpdb->get_results($attendees_query, ARRAY_A);

	// Get each attendee emails
	if (is_array($order_attendees) && count($order_attendees) > 0) {

		foreach ($order_attendees as $attendee) {

			$attendee_email[] = $attendee['email'];
		}
	}

	return $attendee_email;
}

/**
 * Get order attendees email list.
 *
 * @param string $email
 * @param int $order_id
 *
 * @return boolean
 */
function nab_is_order_attendee_exist($email, $order_id)
{

	global $wpdb;

	$is_email_exist = false;

	// Return false if order id or email empty
	if (empty($order_id) || empty($email)) {
		return $is_email_exist;
	}

	// Get attendees email throught the order id
	$attendees_query = $wpdb->prepare("SELECT `email` FROM {$wpdb->prefix}nab_attendee WHERE `order_id` = %d AND `email` = %s AND `status` = 1", $order_id, $email);
	$order_attendees = $wpdb->get_results($attendees_query, ARRAY_A);

	// check attendee exist or not
	if (is_array($order_attendees) && count($order_attendees) > 0) {

		$is_email_exist = true;
	}

	return $is_email_exist;
}

/**
 * Update cocart session cart if main cart is updated
 *
 * @param string $cart_item_key
 * @param int $quantity
 *
 * @return void
 */
function nab_update_cocart_item($cart_item_key, $quantity)
{

	if (isset($_COOKIE['nabCartKey']) && !empty($_COOKIE['nabCartKey']) && !is_user_logged_in()) {
		$cart_key = $_COOKIE['nabCartKey'];

		$api_url = add_query_arg('cart_key', $cart_key, home_url() . '/wp-json/cocart/v1/item/');

		$headers = array(
			'Accept: application/json',
			'Content-Type: application/json',
		);

		$args = json_encode(array(
			'cart_item_key' => $cart_item_key,
			'quantity'      => $quantity,
		));

		$api_url = add_query_arg('cart_key', $cart_key, home_url() . '/wp-json/cocart/v1/item');

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL            => $api_url,
			CURLOPT_CUSTOMREQUEST  => "POST",
			CURLOPT_POSTFIELDS     => $args,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_TIMEOUT        => 30,
			CURLOPT_HTTPHEADER     => $headers
		));

		$response = curl_exec($curl);
	}
}

// phase 4 search
/**
 * Default placeholder img
 *
 * @return string
 */
function nab_placeholder_img()
{

	return get_template_directory_uri() . '/assets/images/amplify-featured.png';
}

/**
 * Fetch searchable post types from the site.
 *
 * @return array
 */
function nab_get_search_post_types()
{

	$all_post_types = get_post_types(array('exclude_from_search' => false));

	unset($all_post_types['attachment']);
	unset($all_post_types['product']);
	unset($all_post_types['company']);
	unset($all_post_types['company-products']);
	unset($all_post_types['tribe_events']);
	unset($all_post_types['landing-page']);

	$all_post_types = array_keys($all_post_types);

	return $all_post_types;
}


/**
 * Global advertisement for search result
 *
 * @return string
 */
function nab_get_search_result_ad()
{

	ob_start();
	?>
	<div class="nab-ad-wrap">
		<div class="nab-ad-inner">
			<div class="nab-ad-block body_ad">
				<broadstreet-zone zone-id="82836"></broadstreet-zone>
			</div>
		</div>
	</div>
	<?php

	$html = ob_get_clean();

	return $html;
}

// Bookmark shortcode
add_shortcode('bookmark', 'nab_get_bookmark_item_callback');

/**
 * Display Bookmark icon.
 *
 * @param  array $atts
 *
 * @return string
 */
function nab_get_bookmark_item_callback($atts)
{

	$atts = shortcode_atts(array(
		'item_id'   => get_the_ID(),
	), $atts);

	ob_start();

	nab_get_product_bookmark_html($atts['item_id'], 'user-bookmark-action');

	return ob_get_clean();
}

/**
 * Display product bookmark.
 *
 * @param mixed $product_id
 * @param mixed $action_class
 */
function nab_get_product_bookmark_html($product_id, $action_class = '')
{

	if (empty($product_id)) {
		return;
	}

	// bookmark product
	if (is_user_logged_in()) {

		$current_user_id   = get_current_user_id();
		$bookmark_products = get_user_meta($current_user_id, 'nab_customer_product_bookmark', true);
		$bookmark_tooltip  = 'Add to Bookmarks';

		if (!empty($bookmark_products) && is_array($bookmark_products) && in_array((string) $product_id, $bookmark_products, true)) {

			$action_class     .= ' bookmark-fill';
			$bookmark_tooltip = 'Remove from Bookmarks';
		}

	?>
		<span class="fa fa-bookmark-o amp-bookmark <?php echo esc_attr($action_class); ?>" data-bp-tooltip="<?php echo esc_attr($bookmark_tooltip); ?>" data-product="<?php echo esc_attr($product_id); ?>"></span>
	<?php
	}
}

/**
 * Get customer purchased products
 *
 * @param int $user_id
 *
 * @return array
 */
function nab_get_customer_purchased_product($user_id)
{

	$product_ids = array();

	if (empty($user_id) || 0 === $user_id) {

		return $product_ids;
	}

	$customer_order_ids = get_posts(array(
		'numberposts' => -1,
		'fields'      => 'ids',
		'meta_key'    => '_customer_user',
		'meta_value'  => $user_id,
		'post_type'   => wc_get_order_types(),
		'post_status' => 'wc-completed',
	));

	if (is_array($customer_order_ids) && count($customer_order_ids) > 0) {

		foreach ($customer_order_ids as $customer_order_id) {

			$order = wc_get_order($customer_order_id);
			$items = $order->get_items();

			foreach ($items as $item) {

				$product_id = $item->get_product_id();

				if ($product_id && !in_array($product_id, $product_ids, true)) {
					$product_ids[] = $product_id;
				}
			}
		}
	}

	return $product_ids;
}

/**
 * List member events
 *
 * @param string $product_ids_regex
 * @param int $user_id
 * @param boolean $previous_events
 */
function nab_get_member_event_list($product_ids_regex, $user_id, $previous_events = true)
{

	$current_date = current_time('Ymd');
	$compare      = '<';
	$post_limit   = 12;
	$block_title  = 'PREVIOUS EVENTS';
	$block_id     = 'previous-event-list';

	if (!$previous_events) {

		$compare     = '>=';
		$post_limit  = -1;
		$block_title = 'UPCOMING EVENTS';
		$block_id    = 'upcoming-event-list';
	}

	$query_args = array(
		'post_type'      => 'event-shows',
		'posts_per_page' => $post_limit,
		'post_status'    => 'publish',
		'meta_key'       => 'wc_pay_per_post_product_ids',
		'meta_value'     => $product_ids_regex,
		'meta_compare'   => 'REGEXP',
		'meta_query'     => array(
			array(
				'key'     => 'show_end_date',
				'value'   => $current_date,
				'compare' => $compare,
				'type'    => 'DATE'
			)
		)
	);

	$purchased_events = new WP_Query($query_args);

	if ($purchased_events->have_posts()) {

		$total_events = $purchased_events->found_posts;
	?>
		<div class="member-events">
			<div class="amp-item-main">
				<div class="amp-item-heading">
					<h3><?php echo esc_html($block_title); ?></h3>
				</div>
				<div class="amp-item-wrap" id="<?php echo esc_attr($block_id); ?>">

					<?php

					$event_default_img = nab_placeholder_img();
					$cnt               = 0;

					while ($purchased_events->have_posts()) {

						$purchased_events->the_post();

						$event_id   = get_the_ID();
						$event_img  = nab_amplify_get_featured_image( $event_id, true, $event_default_img );
						$event_date = get_field('show_date', $event_id);
						$event_url  = get_field('show_url', $event_id);

					?>
						<div class="amp-item-col">
							<div class="amp-item-inner">
								<div class="amp-item-cover">
									<img src="<?php echo esc_url($event_img); ?>" alt="Event Image">
								</div>
								<div class="amp-item-info">
									<div class="amp-item-content">
										<h4><?php echo esc_html(get_the_title()); ?></h4>
										<span class="company-name"><?php echo esc_html($event_date); ?></span>
										<div class="amp-actions">
											<div class="search-actions">
												<a href="<?php echo esc_url($event_url); ?>" class="button">View Event</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php

						$cnt++;

						if (8 === $cnt && $previous_events) {
							echo wp_kses_post(nab_get_search_result_ad());
						}
					}

					if ($cnt < 8 && $previous_events) {
						echo wp_kses_post(nab_get_search_result_ad());
					}
					?>
				</div>
			</div>
		</div>
	<?php
	}

	if ($previous_events && $purchased_events->max_num_pages > 1) {
	?>
		<div class="load-more text-center" id="load-more-events">
			<a href="javascript:void(0);" class="btn-default" data-user="<?php echo esc_attr($user_id); ?>" data-page-number="2" data-post-limit="12" data-total-page="<?php echo absint($purchased_events->max_num_pages); ?>">Load More</a>
		</div>
	<?php
	}

	wp_reset_postdata();
}

/**
 * This function check member can connect to anyone based on member security settings.
 *
 * @param int $member_id
 *
 * @return bool
 */
function nab_member_can_connect_to_anyone($member_id)
{

	if (empty($member_id) || 0 === $member_id) {

		return false;
	}

	$member_restriction = get_user_meta($member_id, 'nab_member_restrict_connection', true);

	if (!empty($member_restriction) && 'no' === strtolower($member_restriction)) {

		return false;
	}

	return true;
}

/**
 * This function check member can connect to anyone based on member security settings.
 *
 * @param int $member_id
 *
 * @return bool
 */
function nab_member_can_visible_to_anyone($member_id)
{

	if (empty($member_id) || 0 === $member_id) {

		return false;
	}

	$member_visibility = get_user_meta($member_id, 'nab_member_visibility', true);

	if (!empty($member_visibility) && 'no' === strtolower($member_visibility)) {

		return false;
	}

	return true;
}

/**
 * BP top notificaton menu.
 */

function nab_get_bp_notification_menu()
{

	if (is_user_logged_in()) {

		$logged_user_id = bp_loggedin_user_id();
		?>
		<div class="nab-header-notification">
			<?php
			$notifications	= bp_notifications_get_notifications_for_user( $logged_user_id, 'object');
			$count			= !empty($notifications) ? count($notifications) : 0;
			$alert_class	= (int) $count > 0 ? 'nab-pending-notifications pending-count alert' : 'nab-pending-notifications count no-alert';
			$menu_link		= trailingslashit(bp_loggedin_user_domain() . bp_get_notifications_slug());
			?>
			<div class="notification-wrapper">
				<div class="notification-icons-wrap">
					<i class="fa fa-bell" aria-hidden="true"></i>
					<span id="nab-pending-notifications" class="<?php echo esc_attr($alert_class); ?>"><?php echo esc_html(number_format_i18n($count)); ?></span>
				</div>
				<div class="notification-sub-wrapper">
					<ul class="notification-submenu">
						<?php
						if (!empty($notifications)) {

							foreach ((array) $notifications as $notification) {
						?>
								<li class="<?php echo esc_attr('notification-' . $notification->id); ?>">
									<a href="<?php echo esc_url($notification->href); ?>" class="ntf-item"><?php echo esc_html($notification->content); ?></a>
								</li>
							<?php
							}
						} else {
							?>
							<li class="nab-no-notification">
								<a href="<?php echo esc_url($menu_link); ?>" class="ntf-item">No new notifications</a>
							</li>
						<?php
						}
						?>
					</ul>
				</div>
			</div>
		</div>
		<div class="nab-header-message">
			<div class="message-wrapper">
				<div class="message-icons-wrap">
					<a href="<?php echo esc_url( bp_loggedin_user_domain() . 'messages/' ); ?>">
						<i class="fa fa-envelope" aria-hidden="true"></i>
						<span id="nab-pending-messages" class="nab-pending-messages count"><?php echo esc_html( messages_get_unread_count( $logged_user_id ) ); ?></span>
					</a>
				</div>
			</div>
		</div>
	<?php
	}
}

/**
 * Default placeholder img
 *
 * @return string
 */
function nab_product_company_placeholder_img()
{

	return get_template_directory_uri() . '/assets/images/search-box-cover.png';
}

/* Get author full name */
function nab_get_author_fullname($author_id)
{
	$fname = get_the_author_meta('first_name', $author_id);
	$lname = get_the_author_meta('last_name', $author_id);
	$username = get_the_author_meta('user_nicename', $author_id);
	$full_name = '';

	if (empty($fname) && $fname !== '') {
		$full_name = $lname;
	} elseif (empty($lname) && $lname !== '') {
		$full_name = $fname;
	} elseif ($fname == '' && $lname == '') {
		$full_name = $username;
	} else {
		//both first name and last name are present
		$full_name = "{$fname} {$lname}";
	}

	return $full_name;
}

/**
 * Get featured and search category limit based on company membership level.
 *
 * @param  int $company_id
 *
 * @return array $category_limit
 */
function nab_get_company_member_category_limit( $company_id ) {

	$category_limit = array(
		'featured' 	=> 0,
		'search'	=> 0,
	);

	if ( empty( $company_id ) || 0 === (int) $company_id ) {
		return $category_limit;
	}

	$member_level	= get_field( 'member_level', $company_id );

	if ( 'standard' === strtolower( $member_level ) ) {
		$category_limit[ 'featured' ]	= 2;
	} else if ( 'plus' === strtolower( $member_level ) ) {
		$category_limit[ 'featured' ] 	= 5;
		$category_limit[ 'search' ]		= 5;
	} else if ( 'premium' === strtolower( $member_level ) ) {
		$category_limit[ 'featured' ] 	= 5;
		$category_limit[ 'search' ]		= 10000;
	}

	return $category_limit;
}

/**
 * @param int $post_ID Post ID.
 * @param bool $default Whether to send a default image back or not.
 *
 * @return string Image URL.
 */
function nab_amplify_get_featured_image( $post_ID, $default = true, $default_url = '', $size = 'post-thumbnail' ) {

	$bynder_image = get_post_meta( $post_ID, 'profile_picture', true );
	if ( null !== $bynder_image && ! empty( $bynder_image )
	     && strpos( $bynder_image, 'assets') !== false) {
		$featured_image = $bynder_image;
	} else {
		$featured_image = get_the_post_thumbnail_url( $post_ID, $size );

		// Send back default if not found?
		if ( $default ) {
			$default_url = ! empty( $default_url ) ? $default_url : nab_placeholder_img();
			$featured_image = $featured_image ? $featured_image : $default_url;
		}
	}

	return $featured_image;
}

/**
 * Get add pdf limit base on company member level.
 *
 * @param  string $member_level
 *
 * @return int
 */
function nab_get_pdf_limit_by_member_level( $member_level ) {

	if ( empty( $member_level ) ) {
		return 0;
	}

	$member_level = strtolower( $member_level );

	$member_level_pdf_limit = array(
		'plus'		=> 3,
		'premium'	=> 6,
	);

	return isset( $member_level_pdf_limit[$member_level] ) ? $member_level_pdf_limit[$member_level] : 0;
}
