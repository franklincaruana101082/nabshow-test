<?php
    $post_id = get_the_id();
    $post_type = get_post_type( $post_id );
    $app_name = "amplify";
    $segment_write_key = vip_get_env_var( 'SEGMENT_AMPLIFY_WRITE_KEY' );
    if ( is_user_logged_in()) {
        $traits = nab_get_traits();
    }
    $is_login = false;
    $login_check = filter_input( INPUT_GET, 'login', FILTER_SANITIZE_STRING );
    if(!empty($login_check)) {
        $is_login = true;
    }
?>
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
    <?php 
    // If the user is logged in, we call analytics.identify with
    // the $user_id and $traits we prepared above. Note that we're
    // dumping our $trait to a JSON string and then JSON.parse'ing
    // it in JavaScript to pass the correct object to the JS function.
    if ( is_user_logged_in() ): 
    ?>
    analytics.identify("<?php echo $user_id; ?>", JSON.parse('<?php echo addslashes( wp_json_encode( $traits ) ); ?>'));
    <?php if($is_login): ?>
    analytics.track("Logged In", { email: "<?php echo $traits['email']; ?>" });
    <?php endif; endif; ?>

    // Call analytics.page with two custom properties prepared above.
    analytics.page({ content_id: "<?php echo $post_id; ?>", content_type: "<?php echo $post_type; ?>" });
    }}();
  </script>