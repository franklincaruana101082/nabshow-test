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
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
    <link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon.ico' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content">
		<?php
		esc_html_e( 'Skip to content', 'nabshow-lv' );
		?>
    </a>

    <header id="masthead" class="site-header">
        <div class="container">
            <div class="row">
                <div class="col-md-4 header-left">
					<?php
					dynamic_sidebar( 'header-top-left-sidebar' );
					?>
                </div>
                <div class="col-md-4 header-center">
                    <div id="logo" class="text-center">
						<?php
						the_custom_logo();
						?>                        
                    </div>
                </div>
                <div class="col-md-4 header-right text-right">
					<?php
						get_search_form();
					?>
					<?php
					dynamic_sidebar( 'header-top-right-sidebar' );
					?>
                </div>
                <div class="col-md-12 header-nav">
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