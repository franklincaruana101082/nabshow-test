<?php


/**
 * The header for our theme
 *
 * This
 * is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Amplify
 */


function nabshow_styles() {
  //wp_enqueue_style( 'proxima-nova', 'https://use.typekit.net/qbe2mua.css', array(), '1.0');
  wp_enqueue_style( 'nabshow-lv-child-2021', '/wp-content/themes/nabshow-lv-child-2021/assets/css/styles.min.css', array(), wp_get_theme()->get( 'Version' ) );
  wp_enqueue_style( 'slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.0');

  wp_enqueue_script( 'nabshow-2021-slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), '1.8.1', true);
  wp_enqueue_script( 'nabshow-2021-main', '/wp-content/themes/nabshow-lv-child-2021/assets/js/app.min.js', array(), '1.0', true );
  
  wp_enqueue_script( 'nabshow-2021-gleanin-plugin', 'https://app.webreg.me/communities/076497845fd7/engagements.js', array(), '1.0', true );
}

add_action( 'wp_enqueue_scripts', 'nabshow_styles', 100 );

function remove_amplify_css() {
    wp_dequeue_style( 'amplify-style' );
    wp_deregister_style( 'amplify-style' );
    
    wp_dequeue_style( 'nab-amplify-style' );
    wp_deregister_style( 'nab-amplify-style' );

    wp_dequeue_script( 'nab-amplify-navigation' );
    wp_deregister_script( 'nab-amplify-navigation' );

    //wp_dequeue_script();
    //wp_deregister_script();

}
add_action( 'wp_enqueue_scripts', 'remove_amplify_css', 99 );

switch_to_blog('4');

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, shrink-to-fit=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="icon" href="<?php echo esc_url( '/wp-content/themes/nabshow-lv-child-2021/assets/images/favicon.ico' ); ?>">
	<meta name="facebook-domain-verification" content="0w5cbue76vinu1cmjikcyz6tpbzbql" />

	<?php wp_head(); ?>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<!-- Hotjar Tracking Code for https://nabshow.com -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:2192660,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    <script data-ad-client="ca-pub-5149137553460967" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- adding typekit link here since wordpress isn't doing it -->
    <link rel="stylesheet" href="https://use.typekit.net/qbe2mua.css" />
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site nabshow_2021 nab_hybrid">

    <a class="skip-link screen-reader-text" href="#content">
        <?php
        esc_html_e( 'Skip to content', 'nabshow-lv' );
        ?>
    </a>
    

  <header class="header">

    <nav class="header__mobile">
      <button class="header__mobile-toggle js-mobile-toggle">
        <div class="header__mobile-toggle-icon"></div>
        <span class="header__mobile-toggle-text">Menu</span>
      </button>
      <a href="<?php echo esc_url( get_site_url() ); ?>" class="header__mobile-logo-link">
        <?php
        // check if show global menu option is selected
        $header_logo_id = get_theme_mod( 'custom_logo' );
        $header_logo_img = wp_get_attachment_image_src( $header_logo_id, 'full');
        $header_logo_url = $header_logo_img[0];
        if ( $header_logo_url ) {
            echo("<img class='header__mainnav-logo' src='".$header_logo_url."'>");
        } else {
            echo("<img class='header__mobile-logo' src='/wp-content/themes/nabshow-lv-child-2021/assets/images/NAB_Show_Logo.png'>");
        }
        ?>
      </a>
    </nav>

    <div class="header__navwrapper">
      
      <nav class="header__mainnav">
        
        <a href="<?php echo esc_url( get_site_url() ); ?>" class="header__mainnav-logo-link">
            <?php
            // check if show global menu option is selected
            $header_logo_id = get_theme_mod( 'custom_logo' );
            $header_logo_img = wp_get_attachment_image_src( $header_logo_id, 'full');
            $header_logo_url = $header_logo_img[0];
            if ( $header_logo_url ) {
                echo("<img class='header__mainnav-logo' src='".$header_logo_url."'>");
            } else {
                echo("<img class='header__mainnav-logo' src='/wp-content/themes/nabshow-lv-child-2021/assets/images/NAB_Show_Logo.png'>");
            }
            ?>
        </a>
        <?php wp_nav_menu( array( 'theme_location' => 'menu-main', 'container' => false, 'menu_class' => 'header__mainnav-menu menu' ) ); ?>
      </nav>
      <?php do_action( 'nab_global_header' ); ?>

    </div>
  </header>  
  <?php restore_current_blog(); ?>
<div data-swiftype-name="body" data-swiftype-type="text">