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
	
	<!-- Hotjar Tracking Code for https://nabshow.com/ny2020/ -->
<script>
    (function(h,o,t,j,a,r){​​​​​​​
        h.hj=h.hj||function(){​​​​​​​(h.hj.q=h.hj.q||[]).push(arguments)}​​​​​​​;
        h._hjSettings={​​​​​​​hjid:2045073,hjsv:6}​​​​​​​;
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    }​​​​​​​)(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
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

    <?php echo do_shortcode( '[nab-global-header]' ); ?>

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
