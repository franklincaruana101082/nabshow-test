<?php

/**
 * Template part for displaying page content for my purchases page.
 *
 * @package Amplify
 */

$current_user = wp_get_current_user();
$user_id      = filter_input( INPUT_GET, "user_id", FILTER_SANITIZE_STRING );
$user_id      = $user_id ? $user_id : $current_user->ID;
$connections  = filter_input( INPUT_GET, "connections", FILTER_SANITIZE_STRING );

$all_members_url     = add_query_arg( array( 'user_id' => $user_id ), esc_url( wc_get_account_endpoint_url( 'my-connections' ) ) );
$my_friends_url      = add_query_arg( array( 'connections' => 'friends' ) );
$pending_friends_url = add_query_arg( 'connections', 'pending' );

$members_filter = array();
$active_page = '';
switch ( $connections ) {
	case 'friends':
		$members_filter = array(
			'user_id' 		=> $user_id
		);
		$active_page = 'friends';
		break;
	case 'pending':
		$members_filter = bp_ajax_querystring( 'friendship_requests' ) . '&include=' . bp_get_friendship_requests( $user_id );
		$active_page = 'pending';
		break;
}

$post_per_page = 12;
if( is_array( $members_filter )) {
    $members_filter['page'] = 1;
    $members_filter['per_page'] = $post_per_page;
    $members_filter['type'] = 'newest';
}

$profile_url     = bp_core_get_user_domain( $user_id );
$friend_count    = friends_get_friend_count_for_user( $user_id );
$current_user_id = get_current_user_id();
?>

    <section class="wp-listing-block wp-listing-search my-connections-content shows-list" data-bp-list="">
        <div class="connections-tabs">
            <span id="my-connections-tab"><a href="<?php echo esc_attr( $my_friends_url ); ?>" class="<?php echo 'friends' === $active_page ? 'blue-bg' : '' ?>">My Connections</a></span>
            <span id="pending-connections-tab"><a href="<?php echo esc_attr( $pending_friends_url ); ?>" class="<?php echo 'pending' === $active_page ? 'blue-bg' : '' ?>">Pending Requests</a></span>
        </div>

        <div class="all-members" data-id="all-members-tab">

			<?php if ( bp_has_members( $members_filter ) ) :

				global $members_template;

				$total_users = $members_template->total_member_count;
				$total_page  = ceil( $total_users / $post_per_page );
				?>

                <div class="back-to-profile">
                    <a href="<?php echo esc_url( $profile_url ) ?>" class="get-back-arrow">Back to Profile</a>
                </div>

                <div id="members-list" class="member-item-list amp-item-main" role="main">
                    <div class="amp-item-heading">
                        <h3>
                            <strong>Connections</strong>
                            <span>(<?php echo esc_html( $total_users ); ?> RESULTS)</span>
                        </h3>
                    </div>
                    <div class="amp-item-wrap" id="connections-user-list">
						<?php
						$cnt = 1;
						while ( bp_members() ) : bp_the_member();
							$member_id          = bp_get_member_user_id();
							$attendee_company   = get_user_meta( $member_id, 'attendee_company', true );
                            $user_images        = nab_amplify_get_user_images( $member_id );
                            $user_full_name     = get_the_author_meta( 'first_name', $member_id ) . ' ' . get_the_author_meta( 'last_name', $member_id );

                            if ( empty( trim( $user_full_name ) ) ) {

                                $user_full_name = bp_get_member_name();
                            }
							?>
                            <div class="amp-item-col">
                                <div class="amp-item-inner">
                                    <div class="amp-action-remove">
										<?php echo nab_amplify_bp_get_cancel_friendship_button( $member_id ); ?>
                                    </div>
                                    <div class="amp-item-cover">
                                        <img src="<?php echo esc_url( $user_images['banner_image'] ); ?>" alt="Cover Image">
                                    </div>
                                    <div class="amp-item-info">
                                        <div class="amp-item-avtar">
                                            <a href="<?php bp_member_permalink(); ?>"><img src="<?php echo esc_url( $user_images['profile_picture'] ); ?>"></a>
                                        </div>
                                        <div class="amp-item-content">
                                            <h4>
                                                <a href="<?php bp_member_permalink(); ?>"><?php echo esc_html( $user_full_name ); ?></a>
                                            </h4>
                                            <span class="company-name"><?php echo esc_html( $attendee_company ); ?></span>
                                            <div class="amp-actions">
												<?php
												echo nab_amplify_bp_get_friendship_button( $member_id ); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

							<?php
							if ( 8 === $cnt ) {
								echo wp_kses_post( nab_get_search_result_ad() );
							}
							$cnt ++;
						endwhile;
						if ( $cnt < 8 ) {
							echo wp_kses_post( nab_get_search_result_ad() );
						}
						?>
                    </div>
                </div>
				<?php
				if ( $total_page > 1 ) :
					?>
                    <div class="load-more" id="load-more-user">
                        <a href="javascript:void(0);" class="btn-default" data-page-type="connections" data-page-number="2" data-post-limit="<?php echo esc_attr( $post_per_page ) ?>" data-total-page="<?php echo absint( $total_page ); ?>">Load More</a>
                    </div>
				<?php
				endif;

			else: ?>
                <div class="amp-item-heading">
                    <h3>
                        <strong>Connections</strong>
                        <span>(0 RESULTS)</span>
                    </h3>
                </div>
                <div id="message" class="info">
                    <p><?php _e( "Sorry, no members were found.", 'buddypress' ); ?></p>
                </div>

			<?php endif; ?>
        </div>

    </section>
    </div>
<?php
