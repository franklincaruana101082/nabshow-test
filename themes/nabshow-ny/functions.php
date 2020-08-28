<?php

// WAYPOINTS

add_action('wp_enqueue_scripts', 'waypoint_enqueue_script');

function waypoint_enqueue_script() {

  wp_enqueue_script('jquery-3', '//code.jquery.com/jquery-1.12.4.min.js', array(), '1.0.0', true);
  
  wp_enqueue_script('way-points', '//cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js', array(), '1.0.0', true);

}

// NY SCRIPT

add_action( 'wp_enqueue_scripts', 'ny_enqueue_styles', PHP_INT_MAX);

function ny_enqueue_styles() {

    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );

    wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array(), '2.0.0', true );

    wp_localize_script( 'scripts', 'nabshowNy', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		) );

}

/**
 * Include files for theme customize hooks.
 */
require_once get_stylesheet_directory() . '/inc/actions.php';
require_once get_stylesheet_directory() . '/inc/actions-functions.php';

// Segment script for NAB NY site // Production Server

add_action('wp_head', 'segment_header_inclusion');

function segment_header_inclusion(){ ?>
	<script>
	  !function(){var analytics=window.analytics=window.analytics||[];if(!analytics.initialize)if(analytics.invoked)window.console&&console.error&&console.error("Segment snippet included twice.");else{analytics.invoked=!0;analytics.methods=["trackSubmit","trackClick","trackLink","trackForm","pageview","identify","reset","group","track","ready","alias","debug","page","once","off","on","addSourceMiddleware","addIntegrationMiddleware","setAnonymousId","addDestinationMiddleware"];analytics.factory=function(e){return function(){var t=Array.prototype.slice.call(arguments);t.unshift(e);analytics.push(t);return analytics}};for(var e=0;e<analytics.methods.length;e++){var key=analytics.methods[e];analytics[key]=analytics.factory(key)}analytics.load=function(key,e){var t=document.createElement("script");t.type="text/javascript";t.async=!0;t.src="https://cdn.segment.com/analytics.js/v1/" + key + "/analytics.min.js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(t,n);analytics._loadOptions=e};analytics.SNIPPET_VERSION="4.13.1";
	  analytics.load("qMxnEIUVRZKL6OV2TVBF6R3jNz80YiQC");
	  analytics.page();
	  }}();
	</script> <?php

}

?>

