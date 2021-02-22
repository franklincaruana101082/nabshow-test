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

	if ( 0 !== $current_user->ID ) {

		$customer_order_ids = get_posts(array(
			'numberposts' => -1,
			'fields'      => 'ids',
			'meta_key'    => '_customer_user',
			'meta_value'  => $current_user->ID,
			'post_type'   => wc_get_order_types(),
			'post_status' => 'wc-completed',
		));

		if ( is_array( $customer_order_ids ) && count( $customer_order_ids ) > 0) {

			foreach ( $customer_order_ids as $customer_order_id ) {

				$order = wc_get_order( $customer_order_id );
				$items = $order->get_items();

				foreach ( $items as $item ) {

					$product_id = $item->get_product_id();

					if ( $product_id && ! in_array( $product_id, $product_ids ) ) {
						$product_ids[] = $product_id;
					}
				}
			}
		}
	}

	if ( is_array( $product_ids ) && count( $product_ids ) > 0 ) {

		$default_image = get_template_directory_uri() . '/assets/images/amplify-featured.png';

		$product_ids_regex  = '"' . implode('"|"', $product_ids ) . '"';

		$query_args = array(
			'post_type'         => 'event-shows',
			'posts_per_page'    => -1,
			'post_status'       => 'publish',
			'meta_key'          => 'wc_pay_per_post_product_ids',
			'meta_value'        => $product_ids_regex,
			'meta_compare'      => 'REGEXP',
			'order_by'			=> 'title',
			'order'				=> 'ASC'
		);

		$purchased_events = new WP_Query( $query_args );

		if ( $purchased_events->have_posts() ) {

			?>
			<section class="wp-listing-block wp-listing-search my-purchased-content shows-list">
				<div class="all-sessions">
					<h3>EVENTS</h3>
					<div class="session-product-list">
						<div class="wp-info">
							<?php
							while ( $purchased_events->have_posts() ) {

								$purchased_events->the_post();

								$event_id	= get_the_ID();
								$event_img  = nab_amplify_get_featured_image( $event_id );
								$event_date	= get_field( 'show_date', $event_id );
								$event_url	= get_field( 'show_url', $event_id );
								$body_copy	= get_field( 'body_copy', $event_id );

								?>
								<div class="wp-summary content_card">
									<div class="item-inner">
										<div class="thumbnail">
											<a href="<?php echo esc_url( $event_url ); ?>" target="_blank">
												<img src="<?php echo esc_url( $event_img ); ?>" class="purchased-img" alt="event-logo" />
											</a>
										</div>
										<div class="title_content_card">
											<h4>
												<a href="<?php echo esc_url( $event_url ); ?>" target="_blank"><?php echo esc_html( get_the_title() ); ?></a>
											</h4>
											<span class="event-date"><?php echo esc_html( $event_date ); ?></span>
										</div>
										<?php if ( ! empty( $body_copy ) ) { ?>
                                            <div class="events_body_copy">
                                                <p><?php echo esc_html( $body_copy ); ?></p>
                                            </div>
										<?php } ?>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</div>
			</section>
			<?php
		}
		wp_reset_postdata();

		$query_args = array(
			'post_type'         => 'product',
			'posts_per_page'    => -1,
			'post_status'       => 'publish',
			'post__in'			=> $product_ids,
			'order_by'			=> 'title',
			'order'				=> 'ASC'
		);

		$purchased_passes = new WP_Query( $query_args );

		if ( $purchased_passes->have_posts() ) {

			?>
			<section class="wp-listing-block wp-listing-search my-purchased-content pass-list">
				<div class="all-sessions">
					<h3>Passes</h3>
					<div class="session-product-list">
						<div class="wp-info">
							<?php
							while ( $purchased_passes->have_posts() ) {

								$purchased_passes->the_post();

								$product_img    = nab_amplify_get_featured_image( get_the_ID() );
								$product_link	= get_the_permalink();

								?>
								<div class="wp-summary content_card">
									<div class="item-inner">
										<div class="thumbnail">
											<a href="<?php echo esc_url( $product_link ); ?>">
												<img src="<?php echo esc_url( $product_img ); ?>" class="purchased-img" alt="pass-logo" />
											</a>
										</div>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</div>
			</section>
			<?php
		}
		wp_reset_postdata();

	} else {
	?>
		<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
			<a class="woocommerce-Button button" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"> Browse content</a>
			No purchased content found.
		</div>
	<?php
	}
	?>
</div>

<?php
/*$follower_ids = bp_follow_get_followers( array( 'user_id' => $current_user->ID ) );

if ( is_array( $follower_ids ) && count( $follower_ids ) > 0 ) {
	?>
	<h3>Followers</h3>
	<?php
	foreach( $follower_ids as $fl_user_id ) {

		$first_name = get_user_meta( $fl_user_id, 'first_name', true );
		$last_name 	= get_user_meta( $fl_user_id, 'last_name', true );

		echo bp_core_fetch_avatar( array( 'item_id' => $fl_user_id ) );
		?>
			<p><?php echo esc_html( $first_name . ' ' . $last_name ); ?></p>
		<?php
	}
}

$following_ids = bp_follow_get_following( array( 'user_id' => $current_user->ID ) );

if ( is_array( $following_ids ) && count( $following_ids ) > 0 ) {
	?>
	<h3>Followings</h3>
	<?php
	foreach( $following_ids as $fl_user_id ) {

		$first_name = get_user_meta( $fl_user_id, 'first_name', true );
		$last_name 	= get_user_meta( $fl_user_id, 'last_name', true );

		echo bp_core_fetch_avatar( array( 'item_id' => $fl_user_id ) );
		?>
			<p><?php echo esc_html( $first_name . ' ' . $last_name ); ?></p>
		<?php
	}
}*/
