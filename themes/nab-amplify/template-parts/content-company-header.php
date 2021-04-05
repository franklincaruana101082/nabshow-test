<?php

/**
 * Template part for displaying company header banner in the header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Amplify
 */

$company_id    = get_the_ID();
$cover_image   = nab_amplify_get_comapny_banner( $company_id );
$industry       = get_field('company_industary');
$instagram_url    = get_field('instagram_url');
$linkedin_url     = get_field('linkedin_url');
$facebook_url     = get_field('facebook_url');
$twitter_url      = get_field('twitter_url');
$member_level     = get_field('member_level');

$cover_image      = ! empty( $cover_image ) ? $cover_image : get_template_directory_uri() . '/assets/images/banner-header-background.png';
$featured_image   = nab_amplify_get_featured_image( $company_id, false );
$profile_picture  = $featured_image;
$user_logged_in   = is_user_logged_in();
$company_admin_id = get_field('company_user_id', $company_id);
$youtube_url      = get_field('youtube_url');
$company_poc      = get_field('point_of_contact');

// Get username to add as an Tag in Bynder upload.
$user_id  = get_current_user_id();
$user_obj = get_user_by( 'id', $user_id );
$username = $user_obj->user_login;
?>
<div class="banner-header" style="background-image: url('<?php echo esc_url($cover_image); ?>')">
    <div class="banner-container">
        <div class="banner-inner">
            <div class="bannner-actions">

                <?php if ($user_logged_in) {
                    if (!empty($company_admin_id) && in_array($user_id, $company_admin_id)) {
                ?>

                        <div class="update-banner-image">
                            <label class="bm-select-media" bynder-for="banner_image">
                                <span class="edit-bg-pic" style="display:none;" id="profile_picture_update" data-bp-tooltip="Edit Background Image (1600x400)"><i class="fa fa-pencil"></i></span>
                            </label>
                            <span class="remove-bg-pic" style="display:none;" id="banner_image_remove" data-bp-tooltip="Remove Image"><i class="fa fa-times"></i></span>
                        </div>
                        <div id="edit-mode-buttons">
                            <a href="javascript:void(0);" class="btn edit-company-mode">Edit profile</a>
                        </div>
                <?php
                    }
                } ?>



            </div>

            <div class="amp-profile-main">
                <div class="amp-profile-inner">
                    <div class="amp-profile-content">
                        <div id="profile-avtar" class="amp-profile-image profile-avtar">
                            <label class="profile-avtar-inner" for="profile_picture_file" id="bm-profile-pic"> <!-- bm-select-media -->
                                <?php if ($profile_picture) { ?>
                                    <img src="<?php echo esc_url($profile_picture); ?>" alt="Company Profile Picture" />
                                <?php } else { ?>
                                    <div class="no-image-avtar"><?php echo mb_strimwidth(get_the_title(), 0, 30, '...'); ?></div>
                                <?php } ?>
                                <?php
                                if ($user_logged_in) {
                                    $user_id = get_current_user_id();
                                    if (!empty($company_admin_id) && in_array($user_id, $company_admin_id)) {
                                ?>
                                        <div class="profile-actions">
                                            <span class="edit-profile-pic bm-select-media" bynder-for="profile_picture" data-bp-tooltip="Edit Profile Image (400x400)"><i class="fa fa-pencil"></i></span>
                                        </div>
                                <?php
                                    }
                                    nab_get_unfollow_button($company_id, $user_id);
                                }
                                ?>
                            </label>
                            <?php
                            if (!empty($member_level) && 'select' !== $member_level) {
                            ?>
                                <div class="amp-member-level"><span><?php echo esc_html($member_level); ?></span></div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="amp-profile-info">
                            <h2 data-username="<?php echo get_the_title(); ?>" data-tags="<?php echo esc_attr( $username ) ?>"><?php echo esc_html( get_the_title() ); ?></h2>
                            <?php
                            if (!empty($industry)) {
                            ?>
                                <div class="amp-profile-disc">
                                    <span><?php echo esc_html($industry); ?></span>
                                    <?php if (!empty($company_admin_id) && in_array($user_id, $company_admin_id)) { ?>
                                        <span style="display:none" class="edit-company-about edit-company-industry edit-icon" data-action="company-info" id="edit-company-about" data-bp-tooltip="Edit Company Details"><i class="fa fa-pencil"></i></span>
                                    <?php } ?>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                        <div class="amp-profile-social">
                            <ul>
                                <?php
                                if (!empty($instagram_url)) {
                                ?>
                                    <li>
                                        <a href="<?php echo esc_url($instagram_url); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                                    </li>
                                <?php
                                }
                                if (!empty($linkedin_url)) {
                                ?>
                                    <li>
                                        <a href="<?php echo esc_url($linkedin_url); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                <?php
                                }
                                if (!empty($facebook_url)) {
                                ?>
                                    <li>
                                        <a href="<?php echo esc_url($facebook_url); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                    </li>
                                <?php
                                }
                                if (!empty($twitter_url)) {
                                ?>
                                    <li>
                                        <a href="<?php echo esc_url($twitter_url); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                                    </li>
                                <?php
                                }
                                if (!empty($youtube_url)) {
                                    ?>
                                        <li>
                                            <a href="<?php echo esc_url($youtube_url); ?>" target="_blank"><i class="fa fa-youtube"></i></a>
                                        </li>
                                    <?php
                                    }
                                if (!empty($company_admin_id) && in_array($user_id, $company_admin_id)) {
                                ?>
                                    <li><span class="edit-profile-pic" style="display:none" id="edit-social-profiles" data-bp-tooltip="Edit Social Profiles"><i class="fa fa-pencil"></i></span></li>
                                <?php
                                } ?>
                            </ul>
                        </div>
                        <?php
                        if ($company_poc !== '' && !empty($company_poc)) {
                            if ($user_logged_in) {
                                $user_id = get_current_user_id(); ?>
                                                   <div class="amp-actions">
                                                       <?php
                                                       nab_get_follow_button($company_id, $user_id); ?>
                                                       <div class="search-actions">
                                                           <div id="send-private-message" class="generic-button poc-msg-btn">
                                                               <a href="javascript:void(0);" class="btn add" data-comp-id="<?php echo $company_id; ?>">Message Company Rep</a>
                                                           </div>
                                                       </div>
                                                   </div>
                                               <?php
                            } else {
                                $current_url = home_url(add_query_arg(null, null));
                                $current_url = str_replace('amplify/amplify', 'amplify', $current_url); ?>
                                                   <div class="amp-actions">
                                                       <div class="search-actions">
                                                           <div class="generic-button">
                                                               <a href="<?php echo esc_url(add_query_arg(array( 'r' => $current_url ), wc_get_page_permalink('myaccount'))); ?>" class="btn">Follow</a>
                                                           </div>
                                                       </div>
                                                       <div class="search-actions">
                                                           <div class="generic-button">
                                                               <a href="<?php echo esc_url(add_query_arg(array( 'r' => $current_url ), wc_get_page_permalink('myaccount'))); ?>" class="btn">Message Company Rep</a>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
