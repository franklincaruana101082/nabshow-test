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
	wp_enqueue_style( 'nabshow-styles', '/wp-content/themes/nabshow-ny-2022/assets/css/styles.min.css', array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'nabshow_styles', 100 );

function remove_amplify_css() {
    wp_dequeue_style( 'amplify-style' );
    wp_deregister_style( 'amplify-style' );
}
add_action( 'wp_enqueue_scripts', 'remove_amplify_css', 99 );


?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
<?php get_template_part('template-parts/tracking', 'segment'); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

		
