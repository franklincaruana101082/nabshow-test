<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php
		wp_body_open();
		?>
		
		<header class="mys-directory-header l-header" id="js-navigation">
			<div class="center  mw9">
				
					<a href="http://www.nabshow.com/express">
				
					<img class="db  center  tc  o-show_header" src="https://nab20.mysstaging.com/mys_shared/NAB20/showfiles/imgs/NAB20_IDS_header@2x.jpg?breakcache=8DA00760-BF91-5391-ED845B8E6C55F065" srcset="https://nab20.mysstaging.com/mys_shared/NAB20/showfiles/imgs/NAB20_IDS_header@2x.jpg?breakcache=8DA00760-BF91-5391-ED845B8E6C55F065 2x" alt="2020 NAB Show Express">
				
					</a>
				
			</div>
	    </header>
	    <nav id="nav" role="navigation" class="l-nav  theme_1  pa3  pr4  pl4  pa4-l  pr5-m  pl5-m  pr6-l  pl6-l"><div class="l-nav_content_wrapper flex items-center"><div class="l-nav_left_wrapper flex  items-center"><a href="http://www.nabshow.com/" class="bb-0"><img src="/mys_shared/NAB20/NAB20_Custom_logo.png" srcset="/mys_shared/NAB20/NAB20_Custom_logo@2x.png 2x" alt="2020 NAB Show logo" class="o-ShowLogo dn"></a> <div class="l-nav_show_info f6 flex-column ml4 justify-center dn"><p class="show-date">
							
							April 18 - 22, 2020 | Exhibits April 19 - 22, 2020
							
						</p> <p class="show-location">Las Vegas Convention Center</p></div></div> <ul class="list ma0 js-navlinks_container js-navlinks_desktop" style="visibility: visible;"><li id="link-dd17492a-c9e1-888b-43d493108356f2af" class="l-nav_link "><a href="https://www.nabshow.com/express" target="" class="bb-0  dib "><span class="dropdown_link_hover ">Home 
							</span></a></li> <li id="link-exhibitorsearch" class="l-nav_link "><a href="/8_0/index.cfm" target="" class="bb-0  dib "><span class="dropdown_link_hover ">Exhibitors 
							</span></a></li> <li id="link-8D941C4F-F6DA-9901-C25829C5DD7DE772" class="l-nav_link "><a href="https://nabshow.com/express/resources" target="" class="bb-0  dib "><span class="dropdown_link_hover ">Resources 
							</span></a></li> <li id="link-8D904DAE-E9BB-FE5F-55FF893E7E82B483" class="l-nav_link "><a href="https://nabshow.com/express/partners" target="" class="bb-0  dib "><span class="dropdown_link_hover ">Partners 
							</span></a></li> <li id="link-myshowlogin" class="l-nav_link relative"><a href="/8_0/myshow/index.cfm" target="" class="bb-0  dib is-myshow" style="padding-right: 43px;"><span class="dropdown_link_hover ">Planner 
							</span></a> <a href="#" class="icon-recommendation
bb-0
dib" style="position: absolute; right: 0px; top: 12px;"><svg width="21" height="24" xmlns="http://www.w3.org/2000/svg" class="dib
moon-gray"><path d="M10.88 0C10 0 9.28.6 8.8 1.52c-3.88.92-5.48 4.4-5.48 8.56v3.8c0 1.72-1.68 3.8-2.52 3.8v1.28H21v-1.28c-.84 0-2.52-2.08-2.52-3.8v-3.8c0-4.16-1.6-7.64-5.48-8.56C12.48.6 11.76 0 10.88 0zm-3.8 20.2c0 2.08 1.68 3.8 3.8 3.8s3.8-1.68 3.8-3.8h-7.6z" fill-rule="nonzero"></path></svg> <div class="token-recommendation absolute bg-accent ba b--white dib"></div></a></li></ul> <div class="l-hamburger-menu_container relative dn"><div class="flex  items-center"><span class="l-mobile-menu_btn">Menu</span> <span class="l-hamburger_wrapper dn"><span class="hamburger_bar  top_bar"></span> <span class="hamburger_bar  middle_bar"></span> <span class="hamburger_bar  bottom_bar"></span></span></div> <span class="o-recommendations_widget_menubutton_wrapper"><!----></span></div></div> <div id="rec-modal" rectype="exhibitor"><!----> <!----></div> <div class="js-navlinks_mobile_wrapper dn" style="top: 52px;"><ul class="list ml0 js-navlinks_container js-navlinks_mobile dn"><li id="link-dd17492a-c9e1-888b-43d493108356f2af" class="l-nav_link db ma0 "><a href="https://www.nabshow.com/express" target="" class="bb-0  mb-0   "><span>Home 
							</span></a></li> <li id="link-exhibitorsearch" class="l-nav_link db ma0 "><a href="/8_0/index.cfm" target="" class="bb-0  mb-0   "><span>Exhibitors 
							</span></a></li> <li id="link-8D941C4F-F6DA-9901-C25829C5DD7DE772" class="l-nav_link db ma0 "><a href="https://nabshow.com/express/resources" target="" class="bb-0  mb-0   "><span>Resources 
							</span></a></li> <li id="link-8D904DAE-E9BB-FE5F-55FF893E7E82B483" class="l-nav_link db ma0 "><a href="https://nabshow.com/express/partners" target="" class="bb-0  mb-0   "><span>Partners 
							</span></a></li> <li id="link-myshowlogin" class="l-nav_link db ma0 "><a href="/8_0/myshow/index.cfm" target="" class="bb-0  mb-0   is-myshow" style="display: inline-block;"><span>Planner 
							</span></a> <span class="dib  pl0  o-recommendations_widget_mobile"><!----></span></li></ul></div></nav>

		<!--<header id="site-header" class="header-footer-group" role="banner">

			<div class="header-inner section-inner">

				<div class="header-titles-wrapper">

					<?php

					// Check whether the header search is activated in the customizer.
					$enable_header_search = get_theme_mod( 'enable_header_search', true );

					if ( true === $enable_header_search ) {

						?>

						<button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
							<span class="toggle-inner">
								<span class="toggle-icon">
									<?php twentytwenty_the_theme_svg( 'search' ); ?>
								</span>
								<span class="toggle-text"><?php _e( 'Search', 'twentytwenty' ); ?></span>
							</span>
						</button><!-- .search-toggle -->

					<?php } ?>

					<div class="header-titles">

						<?php
							// Site title or logo.
							twentytwenty_site_logo();

							// Site description.
							twentytwenty_site_description();
						?>

					</div><!-- .header-titles -->

					<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
						<span class="toggle-inner">
							<span class="toggle-icon">
								<?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
							</span>
							<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
						</span>
					</button><!-- .nav-toggle -->

				</div><!-- .header-titles-wrapper -->

				<div class="header-navigation-wrapper">

					<?php
					if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) {
						?>

							<nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e( 'Horizontal', 'twentytwenty' ); ?>" role="navigation">

								<ul class="primary-menu reset-list-style">

								<?php
								if ( has_nav_menu( 'primary' ) ) {

									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'primary',
										)
									);

								} elseif ( ! has_nav_menu( 'expanded' ) ) {

									wp_list_pages(
										array(
											'match_menu_classes' => true,
											'show_sub_menu_icons' => true,
											'title_li' => false,
											'walker'   => new TwentyTwenty_Walker_Page(),
										)
									);

								}
								?>

								</ul>

							</nav><!-- .primary-menu-wrapper -->

						<?php
					}

					if ( true === $enable_header_search || has_nav_menu( 'expanded' ) ) {
						?>

						<div class="header-toggles hide-no-js">

						<?php
						if ( has_nav_menu( 'expanded' ) ) {
							?>

							<div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu">

								<button class="toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
									<span class="toggle-inner">
										<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
										<span class="toggle-icon">
											<?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
										</span>
									</span>
								</button><!-- .nav-toggle -->

							</div><!-- .nav-toggle-wrapper -->

							<?php
						}

						if ( true === $enable_header_search ) {
							?>

							<div class="toggle-wrapper search-toggle-wrapper">

								<button class="toggle search-toggle desktop-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
									<span class="toggle-inner">
										<?php twentytwenty_the_theme_svg( 'search' ); ?>
										<span class="toggle-text"><?php _e( 'Search', 'twentytwenty' ); ?></span>
									</span>
								</button><!-- .search-toggle -->

							</div>

							<?php
						}
						?>

						</div><!-- .header-toggles -->
						<?php
					}
					?>

				</div><!-- .header-navigation-wrapper -->

			</div><!-- .header-inner -->

			<?php
			// Output the search modal (if it is activated in the customizer).
			if ( true === $enable_header_search ) {
				get_template_part( 'template-parts/modal-search' );
			}
			?>

		</header><!-- #site-header -->
		-->

		<?php
		// Output the menu modal.
		get_template_part( 'template-parts/modal-menu' );
