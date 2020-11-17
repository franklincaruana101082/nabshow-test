<?php
/**
 * User Header for Banner and Avatar.
 */

// GET Parameters
$view    = filter_input( INPUT_GET, "view", FILTER_SANITIZE_STRING );
$user_id = filter_input( INPUT_GET, "user_id", FILTER_SANITIZE_NUMBER_INT );

// Get member/user id.
$member_id = $user_id ? (int) $user_id : 0;
if ( 0 === $member_id && bp_current_component() ) {
	global $bp;
	$member_id = isset( $bp->displayed_user->id ) ? $bp->displayed_user->id : 0;
}

// Show Edit Mode
$current_user_id = get_current_user_id();
$edit_mode       = 0;
$edit_mode_url   = $private_massage_link = '';
$is_friend       = false;
if ( ( 0 !== $current_user_id && $current_user_id === $member_id ) /* on buddypress pages */
     || 0 !== $current_user_id && 0 === $member_id ) /* on woo's my-account pages */ {
	$is_friend = 'myself';
	if ( 'edit' === $view ) {
		$edit_mode      = 2;
		$edit_mode_url  = remove_query_arg( array( 'view' ) );
		$edit_mode_text = 'Exit Edit Profile';
	} else {
		$edit_mode      = 1;
		$edit_mode_url  = add_query_arg( array( 'view' => 'edit' ) );
		$edit_mode_text = 'Edit Profile';
	}
} else if ( 0 !== $current_user_id && 0 !== $member_id ) {
	$is_friend            = friends_check_friendship_status( $current_user_id, $member_id );
	$private_massage_link = wp_nonce_url( bp_loggedin_user_domain() . bp_get_messages_slug() . '/compose/?r=' . bp_core_get_username( $member_id ) );
}

// Set user id.
$member_id = 0 === $member_id ? $current_user_id : $member_id;

// Get user meta.
$user_data   = get_user_meta( $member_id );
$member_name = $user_data[ 'first_name' ][0] . ' ' . $user_data[ 'last_name' ][0];

if ( empty( trim( $member_name ) ) ) {

    $member_name = bp_get_member_name();
}

// Get images.
$user_images = nab_amplify_get_user_images( $member_id );
?>
    <div class="banner-header" style="background-image: url('<?php echo esc_url( $user_images['banner_image'] ); ?>')">
        <div class="banner-container">
            <div class="banner-inner">
                <div class="bannner-actions">

					<?php if ( 2 === $edit_mode ) { ?>
                        <div class="update-banner-image">
                            <label for="banner_image_file">
                                <span class="edit-bg-pic" id="profile_picture_update" data-bp-tooltip="Edit Background Image"><i class="fa fa-pencil"></i></span>
                            </label>
                            <input id="banner_image_file" type="file" name="banner_image" style="display: none;"/>
                        </div>
					<?php } ?>

					<?php if ( 0 !== $edit_mode ) { ?>
                        <div id="edit-mode-buttons">
                            <a href="<?php echo esc_url( $edit_mode_url ) ?>" class="button"><?php echo esc_html( $edit_mode_text ) ?></a>
                        </div>
					<?php } ?>

                </div>
                <div class="amp-profile-main">
                    <div class="amp-profile-inner">
                        <div class="amp-profile-content">
                            <div id="profile-avtar" class="amp-profile-image">
                                <label for="profile_picture_file">
                                    <img src="<?php echo esc_url( $user_images['profile_picture'] ) ?>"/>
                                <?php if ( 2 === $edit_mode ) { ?>
                                    <span class="edit-profile-pic" data-bp-tooltip="Edit Profile Image"><i class="fa fa-pencil"></i></span>
                                    <input id="profile_picture_file" type="file" name="profile_picture" style="display: none;"/>
								<?php } else {
									echo nab_amplify_bp_get_cancel_friendship_button( $member_id, false );
								} ?>
                                </label>
                                <!--<div class="amp-member-level">
                                    <a href="#" class="button">member level</a>
                                </div>-->
                            </div>
                            <div class="amp-profile-info">
                                <h2><?php echo esc_html( $member_name ); ?></h2>
								<?php if ( ! empty( $user_data['attendee_company'][0] ) || ! empty( $user_data['attendee_title'][0] ) ) { ?>
                                    <div class="amp-profile-disc">
                                        <span><?php echo esc_html( $user_data['attendee_company'][0] ); ?></span>
										<?php if ( ! empty( $user_data['attendee_title'][0] ) ) { ?>
                                            <span><?php echo esc_html( $user_data['attendee_title'][0] ); ?></span>
										<?php } ?>
                                    </div>
								<?php } ?>
                            </div>
                            <div class="amp-profile-social">
                                <ul>
									<?php if ( $user_data['social_twitter'] ) { ?>
                                        <li>
                                            <a href="<?php echo esc_attr( $user_data['social_twitter'][0] ); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                                        </li>
									<?php }
									if ( $user_data['social_twitter'] ) { ?>
                                        <li>
                                            <a href="<?php echo esc_attr( $user_data['social_linkedin'][0] ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                                        </li>
									<?php }
									if ( $user_data['social_twitter'] ) { ?>
                                        <li>
                                            <a href="<?php echo esc_attr( $user_data['social_facebook'][0] ); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                        </li>
									<?php }
									if ( $user_data['social_twitter'] ) { ?>
                                        <li>
                                            <a href="<?php echo esc_attr( $user_data['social_instagram'][0] ); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                                        </li>
									<?php }
									if ( $user_data['social_twitter'] ) { ?>
                                        <li>
                                            <a href="<?php echo esc_attr( $user_data['social_website'][0] ); ?>" target="_blank"><i class="fa fa-link"></i></a>
                                        </li>
									<?php } ?>
									<?php if ( 2 === $edit_mode ) { ?>
                                        <li>
                                            <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>"><i class="fa fa-pencil"></i></a>
                                        </li>
									<?php } ?>
                                </ul>
                            </div>
                            <div class="amp-profile-message">
								<?php echo nab_amplify_bp_get_friendship_button( $member_id, false ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
