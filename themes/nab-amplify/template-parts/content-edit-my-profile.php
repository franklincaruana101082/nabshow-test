<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Amplify
 */

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
                                <img class="profile-images" src="<?php esc_url( $profile_picture ) ?>"/>
                            </div>
                            <div class="nab-profile-button">
                                <input type="file" name="profile_picture_file"/>
                                <button type="submit" class="button" id="profile-picture-update">Update</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex-column">
                        <div class="flex-box">
                            <div class="nab-avtar-image">
                                <img class="profile-images" src="<?php esc_url( $banner_picture ) ?>"/>
                            </div>
                            <div class="nab-profile-button">
                                <input type="file" name="banner_picture_file"/>
                                <button type="submit" class="button" id="banner-picture-update">Update</button>
                                <button type="submit" class="button" id="banner-picture-remove">Remove</button>
                            </div>
                        </div>
                    </div>
                    <div class="nab-section section-professional-details">
                        <h3>PROFESSIONAL DETAILS</h3>
                        <div class="professional-details-form">
                            <div class="nab-form-row">
                                <input type="text" name="professional_title" class="input-text" value="Title"/>
                            </div>
                            <div class="nab-form-row">
                                <input type="text" name="professional_company" class="input-text" value="Company"/>
                            </div>
                            <div class="nab-form-submit">
                                <button type="submit" class="button" name="save_professional_details" value="update">update</button>
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
                                    <input type="text" class="input-text" name="social_twitter" placeholder="Twitter">
                                </div>
                            </div>
                            <div class="nab-form-row">
                                <div class="social-icon">
                                    <i class="fa fa-linkedin"></i>
                                </div>
                                <div class="social-input">
                                    <input type="text" class="input-text" name="social_linkedin" placeholder="LinkedIn">
                                </div>
                            </div>
                            <div class="nab-form-row">
                                <div class="social-icon">
                                    <i class="fa fa-facebook-square"></i>
                                </div>
                                <div class="social-input">
                                    <input type="text" class="input-text" name="social_facebook" placeholder="Facebook">
                                </div>
                            </div>
                            <div class="nab-form-row">
                                <div class="social-icon">
                                    <i class="fa fa-instagram"></i>
                                </div>
                                <div class="social-input">
                                    <input type="text" class="input-text" name="social_instagram" placeholder="Instagram">
                                </div>
                            </div>
                            <div class="nab-form-row">
                                <div class="social-icon">
                                    <i class="fa fa-link"></i>
                                </div>
                                <div class="social-input">
                                    <input type="text" class="input-text" name="social_website" placeholder="Website">
                                </div>
                            </div>
                            <div class="nab-form-submit">
                                <button type="submit" class="button" name="save_professional_details" value="update">update</button>
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
                                        <input type="text" class="input-text" name="about-me-interest-1" placeholder="Interest 1">
                                    </div>
                                    <div class="row-input">
                                        <input type="text" class="input-text" name="about-me-interest-2" placeholder="Interest 2">
                                    </div>
                                    <div class="row-input">
                                        <input type="text" class="input-text" name="about-me-interest-3" placeholder="Interest 3">
                                    </div>
                                </div>
                            </div>
                            <div class="nab-form-row">
                                <div class="row-label">
                                    <label>I’m excited about…</label>
                                </div>
                                <div class="row-input-wrp">
                                    <div class="row-input">
                                        <input type="text" class="input-text" name="about-me-excited-1" placeholder="Interest 1">
                                    </div>
                                    <div class="row-input">
                                        <input type="text" class="input-text" name="about-me-excited-2" placeholder="Interest 2">
                                    </div>
                                    <div class="row-input">
                                        <input type="text" class="input-text" name="about-me-excited-3" placeholder="Interest 3">
                                    </div>
                                </div>
                            </div>
                            <div class="nab-form-row">
                                <div class="row-label">
                                    <label>I’m knowledgeable about…</label>
                                </div>
                                <div class="row-input-wrp">
                                    <textarea name="about-me-knowledge" placeholder="max 200 characters"></textarea>
                                </div>
                            </div>
                            <div class="nab-form-submit">
                                <button type="submit" class="button" name="save_professional_details" value="update">update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
