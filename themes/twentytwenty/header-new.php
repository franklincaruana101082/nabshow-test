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
		<div class="l-wrapper">
		<header class="mys-directory-header l-header" id="js-navigation">
			<div class="center  mw9">
				
					<a href="http://www.nabshow.com/express">
				
					<img class="db  center  tc  o-show_header" src="https://nabshow.com/express/wp-content/uploads/sites/6/2020/04/MYS_Express_3200x300.jpg" alt="NAB Show Express">
				
					</a>
				
			</div>
	    </header>
	    <nav id="nav" role="navigation" class="l-nav  theme_1  pa3  pr4  pl4  pa4-l  pr5-m  pl5-m  pr6-l  pl6-l"><div class="l-nav_content_wrapper flex items-center"><div class="l-nav_left_wrapper flex  items-center"><a href="http://www.nabshow.com/" class="bb-0"><img src="https://nabshow.com/express/wp-content/uploads/sites/6/2020/04/NAB20-0144_CN_Express_Show_Logo_Rev_F.png" alt="NAB Show Express" class="o-ShowLogo dn"></a> <div class="l-nav_show_info f6 flex-column ml4 justify-center dn"><p class="show-date">
														
						</p> </div></div> <ul class="list ma0 js-navlinks_container js-navlinks_desktop" style="visibility: visible;"><li id="link-dd17492a-c9e1-888b-43d493108356f2af" class="l-nav_link "><a href="https://www.nabshow.com/express" target="" class="bb-0  dib "><span class="dropdown_link_hover ">Home 
							</span></a></li> <li id="link-exhibitorsearch" class="l-nav_link "><a href="http://nab20.mapyourshow.com/8_0/" target="" class="bb-0  dib "><span class="dropdown_link_hover ">Exhibitors 
							</span></a></li> <li id="link-8D941C4F-F6DA-9901-C25829C5DD7DE772" class="l-nav_link "><a href="https://nabshow.com/express/resources" target="" class="bb-0  dib "><span class="dropdown_link_hover ">Resources 
							</span></a></li> <li id="link-8D904DAE-E9BB-FE5F-55FF893E7E82B483" class="l-nav_link "><a href="https://nabshow.com/express/partners" target="" class="bb-0  dib "><span class="dropdown_link_hover ">Partners 
							</span></a></li> <li id="link-myshowlogin" class="l-nav_link relative"><a href="http://nab20.mapyourshow.com/8_0//myshow/index.cfm" target="" class="bb-0  dib is-myshow" style="padding-right: 43px;"><span class="dropdown_link_hover ">Planner 
							</span></a> <a href="#" class="icon-recommendation
bb-0
dib" style="position: absolute; right: 0px; top: 12px;"><svg width="21" height="24" xmlns="http://www.w3.org/2000/svg" class="dib
moon-gray"><path d="M10.88 0C10 0 9.28.6 8.8 1.52c-3.88.92-5.48 4.4-5.48 8.56v3.8c0 1.72-1.68 3.8-2.52 3.8v1.28H21v-1.28c-.84 0-2.52-2.08-2.52-3.8v-3.8c0-4.16-1.6-7.64-5.48-8.56C12.48.6 11.76 0 10.88 0zm-3.8 20.2c0 2.08 1.68 3.8 3.8 3.8s3.8-1.68 3.8-3.8h-7.6z" fill-rule="nonzero"></path></svg> <div class="token-recommendation absolute bg-accent ba b--white dib"></div></a></li></ul> <div class="l-hamburger-menu_container relative dn"><div class="flex  items-center"><span class="l-mobile-menu_btn">Menu</span> <span class="l-hamburger_wrapper dn"><span class="hamburger_bar  top_bar"></span> <span class="hamburger_bar  middle_bar"></span> <span class="hamburger_bar  bottom_bar"></span></span></div> <span class="o-recommendations_widget_menubutton_wrapper"><!----></span></div></div> <div id="rec-modal" rectype="exhibitor"><!----> <!----></div> <div class="js-navlinks_mobile_wrapper dn" style="top: 52px;"><ul class="list ml0 js-navlinks_container js-navlinks_mobile dn"><li id="link-dd17492a-c9e1-888b-43d493108356f2af" class="l-nav_link db ma0 "><a href="https://www.nabshow.com/express" target="" class="bb-0  mb-0   "><span>Home 
							</span></a></li> <li id="link-exhibitorsearch" class="l-nav_link db ma0 "><a href="http://nab20.mapyourshow.com/8_0//index.cfm" target="" class="bb-0  mb-0   "><span>Exhibitors 
							</span></a></li> <li id="link-8D941C4F-F6DA-9901-C25829C5DD7DE772" class="l-nav_link db ma0 "><a href="https://nabshow.com/express/resources" target="" class="bb-0  mb-0   "><span>Resources 
							</span></a></li> <li id="link-8D904DAE-E9BB-FE5F-55FF893E7E82B483" class="l-nav_link db ma0 "><a href="https://nabshow.com/express/partners" target="" class="bb-0  mb-0   "><span>Partners 
							</span></a></li> <li id="link-myshowlogin" class="l-nav_link db ma0 "><a href="http://nab20.mapyourshow.com/8_0//myshow/index.cfm" target="" class="bb-0  mb-0   is-myshow" style="display: inline-block;"><span>Planner 
							</span></a> <span class="dib  pl0  o-recommendations_widget_mobile"><!----></span></li></ul></div></nav>

</div>

		<?php
		// Output the menu modal.
		get_template_part( 'template-parts/modal-menu' );
