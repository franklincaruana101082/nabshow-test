<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Amplify
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'nab-amplify' ); ?></a>

    <header id="masthead" class="site-header">
        <div class="container">
            <div class="header-inner">
                <div class="nab-logos">
					<?php if ( have_rows( 'nab_logos', 'option' ) ): ?>
                        <ul>
							<?php while ( have_rows( 'nab_logos', 'option' ) ): the_row();
								$nab_logo_id   = get_sub_field( 'logos' );
								$nab_logo_img  = wp_get_attachment_image_src( $nab_logo_id, 'medium' );
								$nab_logo_url  = get_sub_field( 'logo_url' );
								$nab_logo_link = ( isset( $nab_logo_url ) && ! empty( $nab_logo_url ) ) ? $nab_logo_url : '#';
								if ( isset( $nab_logo_img ) && ! empty( $nab_logo_img ) ) { ?>
                                    <li><a href="<?php echo esc_url( $nab_logo_link ); ?>"><img src="<?php echo esc_url( $nab_logo_img[0] ); ?>" alt="nab-logo"></a></li>
								<?php }
							endwhile; ?>
                        </ul>
					<?php endif; ?>

                </div>

                <nav id="site-navigation" class="main-navigation">
					<?php $cart_page_url = wc_get_cart_url(); ?>
                    <div class="nab-header-cart">
                        <i class="fa fa-shopping-cart"></i>
                        <a href="<?php echo esc_url( $cart_page_url ); ?>"><?php esc_html_e( 'Cart', 'nab-amplify' ); ?></a>
                        <span class="nab-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                    </div>
                    <div class="nab-profile-menu">
						<?php
						if ( is_user_logged_in() ) {
							$current_user = wp_get_current_user();
							$user_thumb   = get_avatar_url( $current_user->ID );
							?>
                            <div class="nab-profile">
                                <div class="nab-avatar-wrp">
                                    <div class="nab-avatar"><img src="<?php echo esc_url( $user_thumb ); ?>"/></div>
                                    <span class="nab-profile-name"><?php echo $current_user->display_name; ?></span>
                                </div>
                                <div class="nab-profile-dropdown">
                                    <ul>
                                        <li>
                                            <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>"><?php esc_html_e( 'Edit My Profile', 'nab-amplify' ); ?></a>
                                        </li>
                                        <li><a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>"><?php esc_html_e( 'My Purchases', 'nab-amplify' ); ?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>"><?php esc_html_e( 'Edit My Account', 'nab-amplify' ); ?></a>
                                        </li>
                                        <!--										<li><a href="#">--><?php //esc_html_e( 'Manage Connections', 'nab-amplify' ); ?><!--</a></li>-->
                                        <li><a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>"><?php esc_html_e( 'Order History', 'nab-amplify' ); ?></a>
                                        </li>
                                        <!--										<li><a href="#">--><?php //esc_html_e( 'View Inbox', 'nab-amplify' ); ?><!--</a></li>-->
                                        <li><a href="<?php echo esc_url( wc_logout_url() ); ?>"><?php esc_html_e( 'Logout', 'nab-amplify' ); ?></a></li>
                                    </ul>
                                </div>
                            </div>
						<?php } else { ?>
                            <div class="nab-profile">
                                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"><?php esc_html_e( 'Sign In', 'nab-amplify' ); ?></a>
                            </div>
						<?php } ?>
                    </div>
                </nav><!-- #site-navigation -->

            </div>
        </div>

        <div class="header-bottom">
            <div class="container">
                <ul>
<!--                    <li><a href="#">Learn</a></li>-->
<!--                    <li><a href="#">Exhibit/Sponsor</a></li>-->
                </ul>
            </div>
        </div>
    </header><!-- #masthead -->
    <div class="site-content">
		<?php
		// If NOT in My account dashboard pages
		if ( is_account_page() && is_user_logged_in() ) {

			$user_images = nab_amplify_get_user_images();
			?>
            <div class="banner-header" style="background-image: url('<?php echo esc_url( $user_images['banner_image'] ); ?>')">
                <div class="container">
					<?php woocommerce_breadcrumb(); ?>
                    <div id="profile-avtar">
                        <img src="<?php echo esc_url( $user_images['profile_picture'] ) ?>"/>
                    </div>
                </div>
            </div>
		<?php } else { ?>
            <div class="container">
				<?php
				if( ! is_account_page() && ! is_page( NAB_SIGNUP_PAGE ) ) {
					woocommerce_breadcrumb();
				}
				 ?>
            </div>
		<?php } ?>

        <div class="container">
