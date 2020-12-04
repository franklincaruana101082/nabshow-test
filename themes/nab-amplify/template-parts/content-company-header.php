<?php
/**
 * Template part for displaying compnay header banner in the header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Amplify
 */

$cover_image        = get_field( 'cover_image' );
$profile_picture    = get_field( 'profile_picture' );
$technology         = get_field( 'technology' );
$instagram_url      = get_field( 'instagram_url' );
$linkedin_url       = get_field( 'linkedin_url' );
$facebook_url       = get_field( 'facebook_url' );
$twitter_url        = get_field( 'twitter_url' );
$member_level       = get_field( 'member_level' );
$cover_image        = ! empty( $cover_image ) ? $cover_image[ 'url' ] : get_template_directory_uri() . '/assets/images/banner-header-background.png';
$profile_picture    = ! empty( $profile_picture ) ? $profile_picture[ 'url' ] : get_template_directory_uri() . '/assets/images/default-company.png';;
$user_logged_in     = is_user_logged_in();
$company_id         = get_the_ID();
?>
<div class="banner-header" style="background-image: url('<?php echo esc_url( $cover_image ); ?>')">
    <div class="banner-container">
        <div class="banner-inner">
            <div class="amp-profile-main">
                <div class="amp-profile-inner">
                    <div class="amp-profile-content">
                        <div id="profile-avtar" class="amp-profile-image">
                            <label for="profile_picture_file">
                                <img src="<?php echo esc_url( $profile_picture ); ?>" alt="Compnay Profile Picture" />
                                <?php
                                if ( $user_logged_in ) {

                                    $user_id    = get_current_user_id();
                                    nab_get_unfollow_button( $company_id, $user_id );
                                }
                                ?>									
                            </label>
                            <?php
                            if ( ! empty( $member_level ) && 'select' !== $member_level ) {
                                ?>
                                <div class="amp-member-level"><span><?php echo esc_html( $member_level ); ?></span></div>
                                <?php
                            }
                            ?>                            
                        </div>
                        <div class="amp-profile-info">
                            <h2><?php echo esc_html( get_the_title() ); ?></h2>
                            <?php
                            if ( ! empty( $technology ) ) {
                                ?>
                                <div class="amp-profile-disc">				                            
                                    <span><?php echo esc_html( $technology ); ?></span>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="amp-profile-social">
                            <ul>
                                <?php
                                if ( ! empty( $instagram_url ) ) {
                                    ?>
                                    <li>
                                        <a href="<?php echo esc_url( $instagram_url ); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                                    </li>
                                    <?php
                                }
                                if ( ! empty( $linkedin_url ) ) {
                                    ?>
                                    <li>
                                        <a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                    <?php
                                }
                                if ( ! empty( $facebook_url ) ) {
                                    ?>
                                    <li>
                                        <a href="<?php echo esc_url( $facebook_url ); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <?php
                                }
                                if ( ! empty( $twitter_url ) ) {
                                    ?>
                                    <li>
                                        <a href="<?php echo esc_url( $twitter_url ); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <?php
                                }
                                ?>	                                    
                            </ul>
                        </div>
                        <?php
                        if ( $user_logged_in ) {
                                                        
                            $user_id    = get_current_user_id();
                            ?>
                            <div class="amp-actions">
                                <?php nab_get_follow_button( $company_id, $user_id ); ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if ( $user_logged_in ) {

    $company_admin_id = get_field( 'company_user_id', $company_id );
    
    if ( $company_admin_id !== get_current_user_id() ) {
        ?>
        <div class="company-message-box company-claim-box">
            <div class="company-message-inner" data-item="<?php echo esc_attr( $company_id ); ?>">
                <h3 class="company-message-title">Do you work for <?php echo esc_html( get_the_title() ); ?>? <a href="javascript:void(0)" class="company-message-link claim-link">Claim this page</a>.</h3>
            </div>
        </div>
        <?php
    }    
}
?>