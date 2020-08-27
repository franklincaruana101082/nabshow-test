<?php
/**
 * Template Name: Edit My Profile
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$user_id   = get_current_user_id();
$user_data = get_user_meta( $user_id );

$profile_picture    = $user_data['profile_picture'][0];
$banner_picture     = $user_data['banner_picture'][0];
$professional_title = $user_data['professional_title'][0];

do_action( 'woocommerce_before_account_navigation' );
?>
    <main id="primary" class="site-main">

        <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <div class="woocommerce">

                <nav class="woocommerce-MyAccount-navigation">
                    <ul>
						<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                            <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                                <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                            </li>
						<?php endforeach; ?>
                    </ul>
                </nav>

                <div class="woocommerce-MyAccount-content">
                    <div class="woocommerce-notices-wrapper"></div>
                    <div class="section-emp-profile-pictures">
                        <h3>Profile Pictures</h3>
                        <div class="emp-profile-banner-images">
                            <div class="emp-profile-image">
                                <img class="profile-images" src="<?php esc_url( $profile_picture ) ?>"/>
                                <input type="file" name="profile_picture_file"/>
                                <input type="button" class="button" id="profile-picture-update" value="Update"/>
                            </div>
                            <div class="emp-banner-image">
                                <img class="profile-images" src="<?php esc_url( $banner_picture ) ?>"/>
                                <input type="file" name="banner_picture_file"/>
                                <input type="button" class="button" id="banner-picture-update" value="Update"/>
                                <input type="button" class="button" id="banner-picture-remove" value="Remove"/>
                            </div>
                        </div>
                    </div>
                    <div class="section-emp-professional-details">
                        <h3>Professional Details</h3>
                        <input type="text" name="professional_title" value="Title"/>
                        <input type="text" name="professional_company" value="Company"/>
                        <input type="button" class="button" id="professional-details-update" value="Update"/>
                    </div>
                    <div class="section-emp-social-links">
                        <h3>Social Links</h3>
                        <div id="social-twitter">
                            <input type="text" name="social_twitter" value="Twitter"/>
                        </div>
                        <div id="social-linkedin">
                            <input type="text" name="social_linkedin" value="Linkedin"/>
                        </div>
                        <div id="social-facebook">
                            <input type="text" name="social_facebook" value="Facebook"/>
                        </div>
                        <div id="social-instagram">
                            <input type="text" name="social_instagram" value="Instagram"/>
                        </div>
                        <div id="social-website">
                            <input type="text" name="social_website" value="Website"/>
                        </div>
                        <input type="button" class="button" id="social-links-update" value="Update"/>
                    </div>
                    <div class="section-emp-about-me">
                        <h3>About Me</h3>
                        <div class="about-me-interest">
                            <span>I'm interested in...</span>
                            <input type="text" name="about-me-interest-1" value="Interest 1">
                            <input type="text" name="about-me-interest-2" value="Interest 2">
                            <input type="text" name="about-me-interest-3" value="Interest 3">
                        </div>
                        <div class="about-me-excited">
                            <span>I'm excited about...</span>
                            <input type="text" name="about-me-excited-1" value="Interest 1">
                            <input type="text" name="about-me-excited-2" value="Interest 2">
                            <input type="text" name="about-me-excited-3" value="Interest 3">
                        </div>
                        <div class="about-me-knowledge">
                            <span>I'm knowledgeable about...</span>
                            <textarea name="about-me-knowledge" placeholder="max 200 characters"></textarea>
                        </div>
                        <input type="button" class="button" id="about-me-update" value="Update"/>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php do_action( 'woocommerce_after_account_navigation' );

get_footer();
