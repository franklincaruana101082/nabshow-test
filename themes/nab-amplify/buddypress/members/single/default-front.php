<?php
/**
 * BP Nouveau Default user's front template.
 *
 * @since 3.0.0
 * @version 3.1.0
 */

global $bp;
$user_id           = $bp->displayed_user->id;
$current_user_id   = get_current_user_id();
$current_site_url  = get_site_url();
$all_members_url   = esc_url( wc_get_account_endpoint_url( 'my-connections' ) );
$my_friends_url    = add_query_arg( array( 'connections' => 'friends', 'user_id' => $user_id ), $all_members_url );
$friend_count      = friends_get_friend_count_for_user( $user_id );
$all_events_url    = add_query_arg( array( 'user_id' => $user_id ), wc_get_account_endpoint_url( 'my-events' ) );
$all_bookmarks_url = add_query_arg( array( 'user_id' => $user_id ), wc_get_account_endpoint_url( 'my-bookmarks' ) );

if ( 0 === $friend_count && $user_id === $current_user_id ) {
	$members_filter = bp_ajax_querystring( 'friendship_requests' ) . '&include=' . bp_get_friendship_requests( $user_id );
} else {
	$members_filter = array(
		'user_id'  => $user_id,
		'per_page' => 4
	);
}

?>

<div class="member-front-page">
    <div class="member-connections">

		<?php if ( bp_has_members( $members_filter ) ) :

			global $members_template;

			$total_users = $members_template->total_member_count;
			?>

            <div id="members-list" class="member-item-list amp-item-main" role="main">
                <div class="amp-item-heading">
                    <h3>
                        <strong>Connections</strong>
                        <span>(<?php echo esc_html( $total_users ); ?> RESULTS)</span>
                    </h3>
					<?php if ( $total_users > 4 ) { ?>
                        <div class="amp-view-more">
                            <a href="<?php echo esc_url( $my_friends_url ) ?>" class="view-more-arrow">View all</a>
                        </div>
					<?php } ?>
                </div>
				<?php
				global $members_template;
				$total_users = $members_template->total_member_count;
				if ( 0 === $total_users && 0 < $total_users ) { ?>
                    <h4>Pending Requests:</h4>
				<?php } ?>
                <div class="amp-item-wrap">
                	<div class="amp-item-col add-new-item">
                		<div class="amp-item-inner">
                			<div class="add-item-wrap">
                				<i class="add-item-icon fa fa-pencil"></i>
                				<span class="add-item-label">Add Events</span>
                			</div>
                		</div>
                	</div>
					<?php while ( bp_members() ) : bp_the_member();

						$member_id            = bp_get_member_user_id();
						$attendee_company = get_user_meta( $member_id, 'attendee_company', true );
						$attendee_title = get_user_meta( $member_id, 'attendee_title', true );
						$attendee_title_company = $attendee_title ? $attendee_title . ' | ' . $attendee_company : $attendee_company;

						$member_images        = nab_amplify_get_user_images( $member_id );

						$member_full_name = get_the_author_meta( 'first_name', $member_id ) . ' ' . get_the_author_meta( 'last_name', $member_id );

						if ( empty( trim( $member_full_name ) ) ) {

							$member_full_name = bp_get_member_name();
						}

						?>
                        <div class="amp-item-col">
                            <div class="amp-item-inner">
                                <div class="amp-action-remove">
									<?php echo nab_amplify_bp_get_cancel_friendship_button( $member_id ); ?>
                                </div>
                                <div class="amp-item-cover">
                                    <img src="<?php echo esc_url( $member_images['banner_image'] ); ?>" alt="Cover Image">
                                </div>
                                <div class="amp-item-info">
                                    <div class="amp-item-avtar">
                                        <a href="<?php bp_member_permalink(); ?>"><img src="<?php echo esc_url( $member_images['profile_picture'] ); ?>"></a>
                                    </div>
                                    <div class="amp-item-content">
                                        <h4><?php echo esc_html( $member_full_name ); ?></h4>
                                        <span class="company-name"><?php echo esc_html( $attendee_title_company ); ?></span>
                                        <div class="amp-actions popup-hidden">
											<?php
											echo nab_amplify_bp_get_friendship_button( $member_id );
											?>
											<?php do_action( 'bp_directory_members_item' ); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					<?php endwhile; ?>
                </div>
            </div>
		<?php else: ?>
            <div id="members-list" class="member-item-list amp-item-main" role="main">
                <div class="amp-item-heading">
                    <h3>
                        <strong>Connections</strong>
                        <span>0 RESULTS</span>
                    </h3>
                </div>
                <div id="message" class="info">
                    <p><?php _e( "No connections yet.", 'buddypress' ); ?></p>
                </div>
            </div>
		<?php endif; ?>
    </div>
	<?php
	$product_args = array(
		'post_type'      => 'nab-products',
		'post_status'    => 'publish',
		'posts_per_page' => 4,
		'order'          => 'DESC'
	);

	$product_query = new WP_Query( $product_args );

	if ( $product_query->have_posts() ) {

		$search_found   = true;
		$total_products = $product_query->found_posts;
		?>
        <div class="search-section search-product-section">
            <div class="search-section-heading">
                <h2><strong>PRODUCTS</strong> <span>(<?php echo esc_html( $total_products . ' RESULTS' ); ?>)</span></h2>
				<?php
				if ( $total_products > 4 ) {

					$poroduct_view_more_link = add_query_arg( array( 's' => $search_term, 'v' => 'product' ), $current_site_url );

					?>
                    <div class="section-view-more">
                        <a href="<?php echo esc_html( $poroduct_view_more_link ); ?>" class="view-more-link">View All</a>
                    </div>
					<?php
				}
				?>
            </div>
            <div class="search-section-details" id="search-product-list">
                <div class="search-item edit-mode">
                    <div class="search-item-inner">
                        <i class="fa fa-edit"></i>
                        <div class="search-item-add-text">Add Products</div>
                    </div>
                </div>
				<?php
				while ( $product_query->have_posts() ) {

					$product_query->the_post();

					$thumbnail_url = has_post_thumbnail() ? get_the_post_thumbnail_url() : nab_placeholder_img();
					$product_link  = get_the_permalink();
					?>
                    <div class="search-item">
                        <div class="search-item-inner">
                            <div class="search-item-cover">
                                <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="product thumbnail"/>
								<?php nab_get_product_bookmark_html( get_the_ID(), 'user-bookmark-action' ); ?>
                            </div>
                            <div class="search-item-info">
                                <div class="search-item-content">
                                    <h4><a href="<?php echo esc_url( $product_link ); ?>"><?php echo esc_html( get_the_title() ); ?></a></h4>
                                    <div class="search-actions">
                                        <a href="<?php echo esc_url( $product_link ); ?>" class="button">View Product</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php
				}
				?>
            </div>
        </div>
		<?php
	}
	wp_reset_postdata();

	if ( ! empty( $user_id ) && 0 !== $user_id ) {

		$customer_products = nab_get_customer_purchased_product( $user_id );

		if ( is_array( $customer_products ) && count( $customer_products ) > 0 ) {

			$product_ids_regex = '"' . implode( '"|"', $customer_products ) . '"';

			$query_args = array(
				'post_type'      => 'event-shows',
				'posts_per_page' => 4,
				'post_status'    => 'publish',
				'meta_key'       => 'wc_pay_per_post_product_ids',
				'meta_value'     => $product_ids_regex,
				'meta_compare'   => 'REGEXP',
			);

			$purchased_events = new WP_Query( $query_args );

			if ( $purchased_events->have_posts() ) {

				$total_events = $purchased_events->found_posts;
				?>
                <div class="member-events">
                    <div class="amp-item-main">
                        <div class="amp-item-heading">
                            <h3>Events <span>(<?php echo esc_html( $total_events ); ?> RESULTS)</span></h3>
							<?php
							if ( $total_events > 4 ) {
								?>
                                <div class="amp-view-more">
                                    <a href="<?php echo esc_url( $all_events_url ); ?>" class="view-more-arrow">View All</a>
                                </div>
								<?php
							}
							?>
                        </div>
                        <div class="amp-item-wrap" id="event-list">
                        	<div class="amp-item-col add-new-item">
		                		<div class="amp-item-inner">
		                			<div class="add-item-wrap">
		                				<i class="add-item-icon fa fa-pencil"></i>
		                				<span class="add-item-label">Add Events</span>
		                			</div>
		                		</div>
		                	</div>
							<?php
							$event_default_img = nab_placeholder_img();
							
							while ( $purchased_events->have_posts() ) {

								$purchased_events->the_post();

								$event_id   = get_the_ID();
								$event_img  = has_post_thumbnail() ? get_the_post_thumbnail_url() : $event_default_img;
								$event_date = get_field( 'show_date', $event_id );
								$event_url  = get_field( 'show_url', $event_id );

								?>
                                <div class="amp-item-col">
                                    <div class="amp-item-inner">
                                        <div class="amp-item-cover">
                                            <img src="<?php echo esc_url( $event_img ); ?>" alt="Cover Image">
                                        </div>
                                        <div class="amp-item-info">
                                            <div class="amp-item-content">
                                                <h4><?php echo esc_html( get_the_title() ); ?></h4>
                                                <span class="company-name"><?php echo esc_html( $event_date ); ?></span>
                                                <div class="amp-actions">
                                                    <div class="search-actions">
                                                        <a href="<?php echo esc_url( $event_url ); ?>" class="button">View Event</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<?php
							}
							?>
                        </div>
                    </div>
                </div>
				<?php
			}
			wp_reset_postdata();
		}

		$member_bookmarks = get_user_meta( $user_id, 'nab_customer_product_bookmark', true );

		if ( ! empty( $member_bookmarks ) && is_array( $member_bookmarks ) && count( $member_bookmarks ) > 0 ) {

			$bookmark_query_args = array(
				'post_type'      => 'product',
				'posts_per_page' => 4,
				'post_status'    => 'publish',
				'post__in'       => $member_bookmarks
			);

			$bookmark_query = new WP_Query( $bookmark_query_args );

			if ( $bookmark_query->have_posts() ) {

				$total_bookmarks = $bookmark_query->found_posts;
				?>
                <div class="member-bookmark">
                    <div class="amp-item-main">
                        <div class="amp-item-heading">
                            <h3>BOOKMARKS <span>(<?php echo esc_html( $total_bookmarks ); ?> RESULTS)</span></h3>
							<?php
							if ( $total_bookmarks > 4 ) {
								?>
                                <div class="amp-view-more">
                                    <a href="<?php echo esc_url( $all_bookmarks_url ); ?>" class="view-more-arrow">View All</a>
                                </div>
								<?php
							}
							?>
                        </div>
                        <div class="amp-item-wrap" id="bookmark-list">
							<?php
							$bookmark_img = nab_placeholder_img();

							while ( $bookmark_query->have_posts() ) {

								$bookmark_query->the_post();

								$bookmark_id        = get_the_ID();
								$bookmark_thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url() : $bookmark_img;
								$bookmark_link      = get_the_permalink();

								?>
                                <div class="amp-item-col">
                                    <div class="amp-item-inner">
                                        <div class="amp-item-cover">
                                            <img src="<?php echo esc_url( $bookmark_thumbnail ); ?>" alt="Bookmark Image">
                                            <span class="fa fa-bookmark-o amp-bookmark bookmark-fill"></span>
                                        </div>
                                        <div class="amp-item-info">
                                            <div class="amp-item-content">
                                                <h4>
                                                    <a href="<?php echo esc_url( $bookmark_link ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                                                </h4>
                                                <div class="amp-actions">
                                                    <div class="search-actions">
                                                        <a href="<?php echo esc_url( $bookmark_link ); ?>" class="button">Read More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<?php
							}
							?>
                        </div>
                    </div>
                </div>
				<?php
			}
			wp_reset_postdata();
		}
	}
	?>
</div>
