<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NABShow_LV
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, shrink-to-fit=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon.ico' ); ?>">
	<meta name="google-site-verification" content="bxlFmG3yrAwWFAwi0WI6Bd_V5Ab78-ldZTGAGrgilTQ" />
	<?php wp_head(); ?>

	<!-- Dynamic Schema -->
	<?php $dymanic_schema = get_option( 'dymanic_schema' );
	if ( ! empty( $dymanic_schema ) ) {
		echo $dymanic_schema;
	} ?>
	<!-- End Dynamic Schema -->
	<!--<script>
		"use strict";

		!function() {
			var t = window.driftt = window.drift = window.driftt || [];
			if (!t.init) {
				if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
				t.invoked = !0, t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ],
					t.factory = function(e) {
						return function()

						{ var n = Array.prototype.slice.call(arguments); return n.unshift(e), t.push(n), t; }
							;
					}, t.methods.forEach(function(e)

					{ t[e] = t.factory(e); }
				), t.load = function(t)

				{ var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script"); o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js"; var i = document.getElementsByTagName("script")[0]; i.parentNode.insertBefore(o, i); }
				;
			}
		}();
		drift.SNIPPET_VERSION = '0.3.1';
		drift.load('t9bym32zb3py');
	</script>-->
	<script data-ad-client="ca-pub-5149137553460967" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content">
		<?php
		esc_html_e( 'Skip to content', 'nabshow-lv' );
		?>
    </a>

    <div class="nab-header-secondary">
        <div class="container">
            <div class="header-inner">
                <div class="nab-logos">
                    <?php 
                    $header_logos = nabny_get_header_logos();
                    if( ! empty( $header_logos ) ) { ?>
                        <ul>
                        <?php foreach( $header_logos as $logo ) { ?>
                            <li><a href="<?php echo esc_url( $logo['url'] ); ?>"><img src="<?php echo esc_url( $logo['image'] ); ?>" alt="nab-logo"></a></li>
                        <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
                <?php 
                $parent_url = get_option( 'ep_parent_site_url' );
                $cart_url   = ( ! empty( $parent_url ) ) ? trailingslashit( $parent_url ) . 'cart/' : '#';
                ?>
                <nav class="nab-sec-navigation">
                    <div class="nab-header-cart">
                        <a href="<?php echo esc_url( $cart_url ); ?>"><i class="fa fa-shopping-cart"></i>Cart</a>
                        <span class="nab-cart-count ">0</span>
                    </div>
                    <div class="nab-profile-menu">
                    <?php
						if ( is_user_logged_in() ) {
							$current_user    = wp_get_current_user();
                            $user_thumb      = get_avatar_url( $current_user->ID );
                            $edit_my_profile = ( ! empty( $parent_url ) ) ? trailingslashit( $parent_url ) . 'my-account/edit-my-profile/' : '#';
                            $edit_account    = ( ! empty( $parent_url ) ) ? trailingslashit( $parent_url ) . 'my-account/edit-account/' : '#';
                            $orders          = ( ! empty( $parent_url ) ) ? trailingslashit( $parent_url ) . 'my-account/orders/' : '#';
                            $my_account      = ( ! empty( $parent_url ) ) ? trailingslashit( $parent_url ) . 'my-account/' : '#';
                            $logout          = ( ! empty( $parent_url ) ) ? wp_logout_url( $my_account ) : '#';
							?>
                        <div class="nab-profile">
                            <a href="<?php echo esc_url( $edit_my_profile ); ?>">
                                <div class="nab-avatar-wrp">
                                    <div class="nab-avatar"><img src="<?php echo esc_url( $user_thumb ); ?>"></div>
                                    <span class="nab-profile-name"><?php echo $current_user->display_name; ?></span>
                                </div>
                            </a>
                            <div class="nab-profile-dropdown">
                                <ul>
                                    <li>
                                        <a href="<?php echo esc_url( $edit_my_profile ); ?>">Edit My Profile</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo esc_url( $edit_account ); ?>">Edit My Account</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo esc_url( $orders ); ?>">Order History</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo esc_url( $logout ); ?>">Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php } else { ?>
							<div class="nab-profile">
								<a href="<?php echo esc_url( $my_account ); ?>"><?php esc_html_e( 'Sign In', 'nab-amplify' ); ?></a>
							</div>
						<?php } ?>
                    </div>
                </nav><!-- #site-navigation -->
            </div>
        </div>
    </div>

    <header id="masthead" class="site-header dark-header">
        <div class="container">
            <div class="row">
                <div class="col-md-4 header-left col-md-8">
					<?php
					dynamic_sidebar( 'header-top-left-sidebar' );
					?>
                </div>
                <div class="col-md-4 header-right text-right">
					<?php
						get_search_form();
					?>
					<?php
					dynamic_sidebar( 'header-top-right-sidebar' );
					?>
                </div>
                <div class="col-md-3 header-center head-logo">
                    <div id="logo">
                        <?php
                        the_custom_logo();
                        ?>
                        <div class="header-sticky-menu-logo">
                            <?php
                            $sticky_logo = get_theme_mod( 'menu_sticky_logo', '' );
                            ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                <img src="<?php echo esc_url( $sticky_logo ); ?>" alt="nabshow-lv-logo">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header-nav headnav col-md-12 col-lg-9">
                    <div id="menuToggle">
                        <input type="checkbox" class="menu-hamburger show-sm" />
                        <div class="hamburger show-sm">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <nav id="site-navigation" class="main-navigation">
                            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                                <?php
                                esc_html_e( 'Primary Menu', 'nabshow-lv' );
                                ?>
                            </button>
                            <?php
                            wp_nav_menu( array(
                                'theme_location' => 'menu-1',
                                'menu_id'        => 'primary-menu',
                            ) );
                            ?>
                            <div class="mobile-bottom-nav header-right show-sm">
                                <?php
                                get_search_form();
                                ?>
                                <?php
                                dynamic_sidebar( 'header-top-right-sidebar' );
                                ?>
                            </div>
                        </nav><!-- #site-navigation -->
                    </div>
                </div>
            </div>
        </div>
        <div class="site-branding">
			<?php
			if ( is_front_page() && is_home() ) :
				?>
                <h1 class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php
						bloginfo( 'name' );
						?>
                    </a>
                </h1>
			<?php
			else :
				?>
                <p class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php
						bloginfo( 'name' );
						?>
                    </a>
                </p>
			<?php
			endif;

			$nabshow_lv_description = get_bloginfo( 'description', 'display' );

			if ( $nabshow_lv_description || is_customize_preview() ) :
				?>
                <p class="site-description">
					<?php
					echo esc_html($nabshow_lv_description);
					?>
                </p>
			<?php
			endif;
			?>
        </div><!-- .site-branding -->
    </header><!-- #masthead -->
    <div id="content" class="site-content">
    <?php nabshow_lv_add_corona_virus_update_content(); ?>
