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
	<script>
	!function(){var analytics=window.analytics=window.analytics||[];if(!analytics.initialize)if(analytics.invoked)window.console&&console.error&&console.error("Segment snippet included twice.");else{analytics.invoked=!0;analytics.methods=["trackSubmit","trackClick","trackLink","trackForm","pageview","identify","reset","group","track","ready","alias","debug","page","once","off","on","addSourceMiddleware","addIntegrationMiddleware","setAnonymousId","addDestinationMiddleware"];analytics.factory=function(e){return function(){var t=Array.prototype.slice.call(arguments);t.unshift(e);analytics.push(t);return analytics}};for(var e=0;e<analytics.methods.length;e++){var key=analytics.methods[e];analytics[key]=analytics.factory(key)}analytics.load=function(key,e){var t=document.createElement("script");t.type="text/javascript";t.async=!0;t.src="https://cdn.segment.com/analytics.js/v1/" + key + "/analytics.min.js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(t,n);analytics._loadOptions=e};analytics.SNIPPET_VERSION="4.13.1";
	analytics.load("Dm2tDeNs4wHRhA1D0dDSuO82R8hGvCM6");
	analytics.page();
	}}();
	</script>
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
						<a href="<?php echo esc_url( $cart_page_url ); ?>"><i class="fa fa-shopping-cart"></i><?php esc_html_e( 'Cart', 'nab-amplify' ); ?></a>
						<?php $header_cart_class = WC()->cart->get_cart_contents_count() > 0 ? '' : 'has-no-product'; ?>
						<span class="nab-cart-count <?php echo esc_attr( $header_cart_class ) ?>"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
					</div>
					<div class="nab-profile-menu">
						<?php
						if ( is_user_logged_in() ) {
							$current_user = wp_get_current_user();
							$user_thumb   = get_avatar_url( $current_user->ID );
							$my_profile_link = bp_core_get_user_domain( $current_user->ID );
							?>
							<div class="nab-profile">
                                <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-my-profile' ) ); ?>">
								    <div class="nab-avatar-wrp">
                                        <div class="nab-avatar"><img src="<?php echo esc_url( $user_thumb ); ?>"/></div>
                                        <span class="nab-profile-name"><?php echo $current_user->display_name; ?></span>
								    </div>
                                </a>
								<div class="nab-profile-dropdown">
									<ul>
										<li><a href="<?php echo esc_url( $my_profile_link ); ?>"><?php esc_html_e( 'My Profile', 'nab-amplify' ); ?></a>
										<li><a href="<?php echo esc_url( wc_get_account_endpoint_url( 'my-purchases' ) ); ?>"><?php esc_html_e( 'My Purchases', 'nab-amplify' ); ?></a>
										</li>
										<li><a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>"><?php esc_html_e( 'Edit My Account', 'nab-amplify' ); ?></a>
										</li>
										<li><a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>"><?php esc_html_e( 'My Orders', 'nab-amplify' ); ?></a>
										</li>
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
		if ( ( is_account_page() && is_user_logged_in() ) || bp_current_component() ) {

			get_template_part( 'template-parts/content', 'header' );

            if ( isset( $_COOKIE[ 'nab_amp_login_redirect' ] ) && ! empty( $_COOKIE[ 'nab_amp_login_redirect' ] ) ) {
                ?>
                <div style="margin: 0 auto;text-align: center;">
                    <a href="<?php echo esc_url( $_COOKIE[ 'nab_amp_login_redirect' ] ); ?>" class="woocommerce-button button return-btn">Click Here to Access Your Content</a>
                </div>
                <?php
            }
				?>
		<?php } else { ?>
			<div class="container">
				<?php
				if ( ! is_account_page() && ! is_page( NAB_SIGNUP_PAGE ) ) {
					// woocommerce_breadcrumb();
				}
				?>
			</div>
		<?php } ?>

		<div class="container">
