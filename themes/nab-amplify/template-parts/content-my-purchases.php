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
		//print_r($customer_order_ids);die();
		if (is_array($customer_order_ids) && count($customer_order_ids) > 0) {
			foreach ($customer_order_ids as $customer_order_id) {
				$order = wc_get_order($customer_order_id);
				$items = $order->get_items();
				foreach ($items as $item) {

					$product_id = $item->get_product_id();
					if ( $product_id && ! in_array( $product_id, $product_ids ) ) {
						$product_ids[] = $product_id;
					}
				}
			}
		}
	}

	$content_not_found = 1;
	if (is_array($product_ids) && count($product_ids) > 0) {
		$default_image     = get_template_directory_uri() . '/assets/images/avtar.jpg';
		?>
		<section class="wp-listing-block wp-listing-search my-purchased-content">
			<div class="all-sessions">
				<h3>MY CONTENT</h3>
				<form method="POST" action="" class="wcbd-zip-form">
					<div class="session-product-list">
						<div class="wp-info">
							<?php
							$shown_content = array();
							foreach ($product_ids as $product_id) {

								$associated_content = maybe_unserialize( get_post_meta( $product_id, '_associated_content', true ) );

								if( $associated_content ) {

									foreach( $associated_content as $blog_id => $ac ) {

										// Connect to new multisite
										switch_to_blog($blog_id);

										foreach( $ac as $current_post_id => $val ) {
											if( 0 === $val || in_array( $current_post_id, $shown_content ) ) {
												continue;
											}
											$shown_content[] = $current_post_id;
											$content_not_found = 0;
											$current_post_title     = get_the_title($current_post_id);
											$current_post_link      = get_the_permalink($current_post_id);
											$current_post_image     = get_the_post_thumbnail_url($current_post_id);
											$current_post_image     = $current_post_image ? $current_post_image : $default_image;
											$current_post_image_css = "background-image: url('$current_post_image');";
											$template_name = get_post_type( $current_post_id );
											?>
											<div class="wp-summary content_card">
												<div class="item-inner">
													<div class="thumbnail">
														<a href="<?php echo esc_url($current_post_link); ?>">
															<div class="header_content_card" style="<?php echo esc_attr($current_post_image_css); ?>">
																<span class="category_content_card button"><?php echo esc_html( $template_name ); ?></span>
															</div>
														</a>
														<div class="title_content_card">
															<h4>
																<a href="<?php echo esc_url($current_post_link); ?>"><?php echo esc_html($current_post_title); ?></a>
															</h4>
														</div>
													</div>
												</div>
											</div>
											<?php
										}

										wp_reset_query();
									}
								}
								// Quit multisite connection
								restore_current_blog();
							}
							?>
						</div>
					</div>
				</form>
			</div>
		</section>
	<?php
	}
	
	if( 1 === $content_not_found ) {
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
