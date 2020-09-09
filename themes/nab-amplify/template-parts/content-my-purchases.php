<?php

/**
 * Template part for displaying page content for my purchases page.
 *
 * @package Amplify
 */
?>
<div class="purchased-content-wrapper">
	<?php
	$current_user = wp_get_current_user();
	$product_ids  = array();
	if ('' !== $current_user->user_email) {
		$customer_order_ids = get_posts(array(
			'numberposts' => -1,
			'fields'      => 'ids',
			'meta_key'    => '_billing_email',
			'meta_value'  => $current_user->user_email,
			'post_type'   => wc_get_order_types(),
			'post_status' => 'wc-completed',
		));
		if (is_array($customer_order_ids) && count($customer_order_ids) > 0) {
			foreach ($customer_order_ids as $customer_order_id) {
				$order = wc_get_order($customer_order_id);
				$items = $order->get_items();
				foreach ($items as $item) {
					$product_id = $item->get_product_id();
					if ($product_id) {
						$product_ids[] = $product_id;
					}
				}
			}
			$product_ids = array_unique($product_ids);
		}
	}

	if (is_array($product_ids) && count($product_ids) > 0) {

		$product_ids_regex = '"' . implode('"|"', $product_ids) . '"';
		$current_site_url  = get_site_url(); ?>

		<section class="wp-listing-block wp-listing-search my-purchased-content">
			<div class="all-sessions">
				<h3>MY CONTENT</h3>
				<form method="POST" action="" class="wcbd-zip-form">
					<div class="session-product-list">
						<div class="wp-info">
							<?php
							$sites = get_sites();
							foreach ($sites as $site) :
								// Connect to new multisite
								switch_to_blog($site->blog_id);
								$query_args        = array(
									'post_type'      => array('sessions'),
									'posts_per_page' => 8,
									'post_status'    => 'publish',
									'meta_key'       => 'wc_pay_per_post_product_ids',
									'meta_value'     => $product_ids_regex,
									'meta_compare'   => 'REGEXP',
								);
								$purchased_post    = new WP_Query($query_args);

								if ($purchased_post->have_posts()) {
									while ($purchased_post->have_posts()) {
										$purchased_post->the_post();
										$current_post_id        = get_the_ID();
										$current_post_title     = get_the_title();
										$current_post_link      = get_the_permalink();
										$current_post_image     = get_the_post_thumbnail_url();
										$current_post_image     = $current_post_image ? $current_post_image : get_template_directory_uri() . '/assets/images/avtar.jpg';
										$current_post_image_css = "background-image: url('$current_post_image');"; ?>
										<div class="wp-summary content_card">
											<a href="<?php echo esc_url($current_post_link); ?>">
												<div class="header_content_card" style="<?php echo esc_attr($current_post_image_css); ?>">
													<span class="category_content_card button">CATEGORY</span>
												</div>
											</a>
											<div class="title_content_card">
												<h4>
													<a href="<?php echo esc_url($current_post_link); ?>"><?php echo esc_html($current_post_title); ?></a>
												</h4>
											</div>
										</div>
							<?php }
								}
								wp_reset_query();
								// Quit multisite connection
								restore_current_blog();
							endforeach;
							?>
						</div>
					</div>
				</form>
			</div>
			<?php
			if ($purchased_post->max_num_pages > 1) {
			?>
				<button class="wp-btns fusion-button fusion-button-small fusion-button-purple load-more" data-page-number="2">Load More</button>
			<?php
			}
			?>
		</section>
	<?php
	} else {
	?>
		<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
			<a class="woocommerce-Button button" href="<?php echo esc_url(get_site_url() . '/sessions/'); ?>"> Browse content</a>
			No purchased content found.
		</div>
	<?php
	}
	?>
</div>

<?php
