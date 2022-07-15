<?php

// mdg GTM - HEAD // NAB LV site // Production Server

add_action('wp_head', 'gtm_header_lv_inclusion');

function gtm_header_lv_inclusion(){ 
    $post_id = get_the_id();
    $post_type = get_post_type( $post_id );
    $app_name = "NAB221";
    $segment_write_key = vip_get_env_var( 'SEGMENT_NABSHOW_WRITE_KEY' );
    ?>
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
        !function(){var analytics=window.analytics=window.analytics||[];if(!analytics.initialize)if(analytics.invoked)window.console&&console.error&&console.error("Segment snippet included twice.");else{analytics.invoked=!0;analytics.methods=["trackSubmit","trackClick","trackLink","trackForm","pageview","identify","reset","group","track","ready","alias","debug","page","once","off","on","addSourceMiddleware","addIntegrationMiddleware","setAnonymousId","addDestinationMiddleware"];analytics.factory=function(e){return function(){var t=Array.prototype.slice.call(arguments);t.unshift(e);analytics.push(t);return analytics}};for(var e=0;e<analytics.methods.length;e++){var key=analytics.methods[e];analytics[key]=analytics.factory(key)}analytics.load=function(key,e){var t=document.createElement("script");t.type="text/javascript";t.async=!0;t.src="https://cdn.segment.com/analytics.js/v1/" + key + "/analytics.min.js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(t,n);analytics._loadOptions=e};analytics._writeKey="YOUR_WRITE_KEY";analytics.SNIPPET_VERSION="4.15.2";
        /*
            appNameMiddleware adds an app.name to the context object
            of our analytics payloads. This is helpful when we need to
            filter analytics data in a table that is from multiple sites.
        */
        var appNameMiddleware = function({ payload, next, integrations }) {
            console.log(payload);
            if (!payload.obj.context.app) {
                payload.obj.context.app = {};
            }
            payload.obj.context.app.name = "<?php echo $app_name; ?>";
            next(payload);
        };
        analytics.addSourceMiddleware(appNameMiddleware);

        /*
            emailMiddleware normalizes the value of the email property
            in both properties and traits objects so it is always lowercase.
        */
        var emailMiddleware = function({ payload, next, integrations }) {
            if (payload.obj.properties && payload.obj.properties.email) {
                payload.obj.properties.email = payload.obj.properties.email.toLowerCase();
            }

            if (payload.obj.traits && payload.obj.traits.email) {
                payload.obj.traits.email = payload.obj.traits.email.toLowerCase();
            }

            next(payload);
        };
        analytics.addSourceMiddleware(emailMiddleware);
        analytics.load("<?php echo $segment_write_key; ?>");

        // Call analytics.page with two custom properties prepared above.
        analytics.page({ content_id: "<?php echo $post_id; ?>", content_type: "<?php echo $post_type; ?>" });
        }}();
    </script>

    <?php
}

// mdg GTM - BODY // NAB LV site // Production Server

add_action('wp_body_open', 'gtm_body_lv_inclusion');

function gtm_body_lv_inclusion(){ ?>
		<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MQKPWN" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) --> <?php
}