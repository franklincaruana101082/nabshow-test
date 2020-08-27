<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Amplify
 */

$user_id     = get_current_user_id();
$user_fields = array(
	'banner_image',
	'professional_title',
	'professional_company',
	'social_twitter',
	'social_linkedin',
	'social_facebook',
	'social_instagram',
	'social_website',
	'about_me_interest_1',
	'about_me_interest_2',
	'about_me_interest_3',
	'about_me_excited_1',
	'about_me_excited_2',
	'about_me_excited_3',
	'about_me_knowledge',
);

$professional_title = filter_input( INPUT_POST, "professional_title", FILTER_SANITIZE_STRING );
if ( $professional_title ) {

	/*echo '<pre>';
	print_r($_FILES);
	print_r($_POST);
	die('<br><---died here');*/

	// These files need to be included as dependencies when on the front end.
	/*require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );

	// Let WordPress handle the upload.
	// Remember, 'my_image_upload' is the name of our file input in our form above.
	$attachment_id = media_handle_upload( 'profile_picture_file', 0 );

	if ( is_wp_error( $attachment_id ) ) {
		// There was an error uploading the image.
	} else {
		// The image was uploaded successfully!
	}*/

	$user_data = array();
	foreach ( $user_fields as $ufield ) {

		// submitted value
		$ufield_val = $_POST[ $ufield ];

		// prepare var to display
		$user_data[ $ufield ][0] = $ufield_val;

		// update in meta
		update_user_meta( $user_id, $ufield, $ufield_val );
	}
} else {
	$user_data = get_user_meta( $user_id );
}
$user_images = nab_amplify_get_user_images();
?>

<div class="woocommerce-MyAccount-content edit-my-profile-form">
    <form class="woocommerce-EditProfileForm edit-my-profile" action="" enctype="multipart/form-data" method="post">
        <div class="nab-profile">
            <h2 class="entry-title"><?php the_title(); ?></h2>
            <div class="nab-section section-nab-profile">
                <div class="nab-profile-head">
                    <h3>PROFILE PICTURES</h3>
                    <a href="javascript:void(0)" class="button">view profile</a>
                </div>
                <div class="nab-profile-body flex-row">
                    <div class="flex-column">
                        <div class="flex-box">
                            <div class="nab-profile-image">
                                <label for="profile_picture_file"><img class="profile-images" src="<?php echo esc_url( $user_images['profile_picture'] ); ?>"/></label>
                                <input id="profile_picture_file" type="file" name="profile_picture_file"/>
                            </div>
                            <div class="nab-profile-button">
                                <button type="submit" class="button" id="profile-picture-change">Change</button>
                                <button type="submit" class="button" id="profile-picture-update">Update</button>
                                <button type="submit" class="button" id="profile-picture-remove">Remove</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex-column">
                        <div class="flex-box">
                            <div class="nab-avtar-image">
                                <label for="profile_picture_file"><img class="profile-images" src="<?php echo esc_url( $user_images['banner_image'] ); ?>"/></label>
                                <input id="banner_picture_file" type="file" name="banner_picture_file"/>
                            </div>
                            <div class="nab-profile-button">
                                <button type="submit" class="button" id="banner-picture-change">Change</button>
                                <button type="submit" class="button" id="banner-picture-update">Update</button>
                                <button type="submit" class="button" id="banner-picture-remove">Remove</button>
                            </div>
                        </div>
                    </div>
                    <div class="nab-section section-professional-details">
                        <h3>PROFESSIONAL DETAILS</h3>
                        <div class="professional-details-form">
                            <div class="nab-form-row">
                                <input type="text" name="professional_title" class="input-text" placeholder="Title" value="<?php echo esc_attr( $user_data['professional_title'][0] ); ?>"/>
                            </div>
                            <div class="nab-form-row">
                                <input type="text" name="professional_company" class="input-text" placeholder="Company" value="<?php echo esc_attr( $user_data['professional_company'][0] ); ?>"/>
                            </div>
                            <div class="nab-form-submit">
                                <button type="submit" class="button" name="save_professional_details">update</button>
                            </div>
                        </div>
                    </div>
                    <div class="nab-section section-social-links">
                        <h3>SOCIAL LINKS</h3>
                        <div class="social-links-form">
                            <div class="nab-form-row">
                                <div class="social-icon">
                                    <i class="fa fa-twitter"></i>
                                </div>
                                <div class="social-input">
                                    <input type="text" class="input-text" name="social_twitter" placeholder="Twitter" value="<?php echo esc_attr( $user_data['social_twitter'][0] ); ?>">
                                </div>
                            </div>
                            <div class="nab-form-row">
                                <div class="social-icon">
                                    <i class="fa fa-linkedin"></i>
                                </div>
                                <div class="social-input">
                                    <input type="text" class="input-text" name="social_linkedin" placeholder="LinkedIn" value="<?php echo esc_attr( $user_data['social_linkedin'][0] ); ?>">
                                </div>
                            </div>
                            <div class="nab-form-row">
                                <div class="social-icon">
                                    <i class="fa fa-facebook-square"></i>
                                </div>
                                <div class="social-input">
                                    <input type="text" class="input-text" name="social_facebook" placeholder="Facebook" value="<?php echo esc_attr( $user_data['social_facebook'][0] ); ?>">
                                </div>
                            </div>
                            <div class="nab-form-row">
                                <div class="social-icon">
                                    <i class="fa fa-instagram"></i>
                                </div>
                                <div class="social-input">
                                    <input type="text" class="input-text" name="social_instagram" placeholder="Instagram" value="<?php echo esc_attr( $user_data['social_instagram'][0] ); ?>">
                                </div>
                            </div>
                            <div class="nab-form-row">
                                <div class="social-icon">
                                    <i class="fa fa-link"></i>
                                </div>
                                <div class="social-input">
                                    <input type="text" class="input-text" name="social_website" placeholder="Website" value="<?php echo esc_attr( $user_data['social_website'][0] ); ?>">
                                </div>
                            </div>
                            <div class="nab-form-submit">
                                <button type="submit" class="button" name="save_professional_details">update</button>
                            </div>
                        </div>
                    </div>
                    <div class="nab-section section-about-me">
                        <h3>ABOUT ME</h3>
                        <div class="about-me-form">
                            <div class="nab-form-row">
                                <div class="row-label">
                                    <label>I’m interested in…</label>
                                </div>
                                <div class="row-input-wrp">
                                    <div class="row-input">
                                        <input type="text" class="input-text" name="about_me_interest_1" placeholder="Interest 1" value="<?php echo esc_attr( $user_data['about_me_interest_1'][0] ); ?>">
                                    </div>
                                    <div class="row-input">
                                        <input type="text" class="input-text" name="about_me_interest_2" placeholder="Interest 2" value="<?php echo esc_attr( $user_data['about_me_interest_2'][0] ); ?>">
                                    </div>
                                    <div class="row-input">
                                        <input type="text" class="input-text" name="about_me_interest_3" placeholder="Interest 3" value="<?php echo esc_attr( $user_data['about_me_interest_3'][0] ); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="nab-form-row">
                                <div class="row-label">
                                    <label>I’m excited about…</label>
                                </div>
                                <div class="row-input-wrp">
                                    <div class="row-input">
                                        <input type="text" class="input-text" name="about_me_excited_1" placeholder="Interest 1" value="<?php echo esc_attr( $user_data['about_me_excited_1'][0] ); ?>">
                                    </div>
                                    <div class="row-input">
                                        <input type="text" class="input-text" name="about_me_excited_2" placeholder="Interest 2" value="<?php echo esc_attr( $user_data['about_me_excited_2'][0] ); ?>">
                                    </div>
                                    <div class="row-input">
                                        <input type="text" class="input-text" name="about_me_excited_3" placeholder="Interest 3" value="<?php echo esc_attr( $user_data['about_me_excited_3'][0] ); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="nab-form-row">
                                <div class="row-label">
                                    <label>I’m knowledgeable about…</label>
                                </div>
                                <div class="row-input-wrp">
                                    <textarea name="about_me_knowledge" placeholder="max 200 characters"><?php echo esc_html( $user_data['about_me_knowledge'][0] ); ?></textarea>
                                </div>
                            </div>
                            <div class="nab-form-submit">
                                <button type="submit" class="button" name="save_professional_details">update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
