<?php

// mdg GTM - HEAD // NAB LV site // Production Server

add_action('wp_head', 'gtm_header_lv_inclusion');

function gtm_header_lv_inclusion(){ ?>
	<!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-T3KVDLL');
    </script>
    <!-- End Google Tag Manager --> <?php
}

// mdg GTM - BODY // NAB LV site // Production Server

add_action('wp_body_open', 'gtm_body_lv_inclusion');

function gtm_body_lv_inclusion(){ ?>
		<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T3KVDLL" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) --> <?php
}