<?php

// Segment script for NAB NY site // Production Server

add_action('wp_head', 'segment_header_ny_inclusion');

function segment_header_ny_inclusion(){ ?>
	<script>
	  !function(){var analytics=window.analytics=window.analytics||[];if(!analytics.initialize)if(analytics.invoked)window.console&&console.error&&console.error("Segment snippet included twice.");else{analytics.invoked=!0;analytics.methods=["trackSubmit","trackClick","trackLink","trackForm","pageview","identify","reset","group","track","ready","alias","debug","page","once","off","on","addSourceMiddleware","addIntegrationMiddleware","setAnonymousId","addDestinationMiddleware"];analytics.factory=function(e){return function(){var t=Array.prototype.slice.call(arguments);t.unshift(e);analytics.push(t);return analytics}};for(var e=0;e<analytics.methods.length;e++){var key=analytics.methods[e];analytics[key]=analytics.factory(key)}analytics.load=function(key,e){var t=document.createElement("script");t.type="text/javascript";t.async=!0;t.src="https://evs.analytics.nabshow.com/analytics.js/v1/" + key + "/analytics.min.js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(t,n);analytics._loadOptions=e};analytics.SNIPPET_VERSION="4.13.1";
	//   analytics.load("qMxnEIUVRZKL6OV2TVBF6R3jNz80YiQC");
	  analytics.load("MLeyR4Jgtsp0ksdnFp3IIVZbTR8gx7YK");
	  analytics.page();
	  }}();
	</script> <?php

}

// mdg GTM - HEAD // NAB NY site // Production Server

add_action('wp_head', 'gtm_header_ny_inclusion');

function gtm_header_ny_inclusion(){ ?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];        
		w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-K2F9KBS');</script>
	<!-- End Google Tag Manager --> <?php
}

// mdg GTM - BODY // NAB NY site // Production Server

add_action('wp_body_open', 'gtm_body_ny_inclusion');

function gtm_body_ny_inclusion(){ ?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K2F9KBS"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) --> <?php
}

// mdg GTM - HEAD // NAB LV site // Production Server // REMOVAL

add_action( 'init', 'gtm_header_lv_inclusion_remove');
function gtm_header_lv_inclusion_remove() {
     remove_action('wp_head', 'gtm_header_lv_inclusion');
}

// mdg GTM - BODY // NAB LV site // Production Server // REMOVAL

add_action( 'init', 'gtm_body_lv_inclusion_remove');
function gtm_body_lv_inclusion_remove() {
     remove_action('wp_body_open', 'gtm_body_lv_inclusion');
}
