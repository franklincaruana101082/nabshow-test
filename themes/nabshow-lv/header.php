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
	<!-- Google Tag Manager -->
	<script>
		(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-MQKPWN');
	</script>
	<!-- End Google Tag Manager -->
	<script>
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
	</script>
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MQKPWN" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content">
		<?php
		esc_html_e( 'Skip to content', 'nabshow-lv' );
		?>
    </a>
    
    <?php do_action( 'nab_global_header' ); ?>

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
                <div class="header-nav headnav col-md-9">
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