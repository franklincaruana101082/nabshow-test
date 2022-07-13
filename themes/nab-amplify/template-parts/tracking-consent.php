<?php
    $segment_write_key    = vip_get_env_var( 'SEGMENT_AMPLIFY_WRITE_KEY' );
    $post_id = get_the_id();
    $post_type = get_post_type( $post_id );
    $app_name = "amplify";
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
  window.consentManagerConfig = function(exports) {
    var writeKey = '<?php echo $segment_write_key; ?>';
    var React = exports.React
    var inEU = exports.inEU

    var bannerContent = React.createElement(
      'span',
      null,
      'We use cookies (and other similar technologies) to collect data to improve your experience on our site. By using our website, you՚re agreeing to the collection of data as described in our',
      ' ',
      React.createElement(
        'a',
        { href: '/privacy-policy/', target: '_blank' },
        'Website Data Collection Policy'
      ),
      '.'
    )
    var bannerSubContent = 'You can change your preferences at any time.'
    var preferencesDialogTitle = 'Website Data Collection Preferences'
    var preferencesDialogContent =
      'We use data collected by cookies and JavaScript libraries to improve your browsing experience, analyze site traffic, deliver personalized advertisements, and increase the overall performance of our site.'
    var cancelDialogTitle = 'Are you sure you want to cancel?'
    var cancelDialogContent =
      'Your preferences have not been saved. By continuing to use our website, you՚re agreeing to our Website Data Collection Policy.'

    return {
      container: '#target-container',
      writeKey: writeKey,   
      shouldRequireConsent: inEU,
      bannerContent: bannerContent,
      bannerSubContent: bannerSubContent,
      preferencesDialogTitle: preferencesDialogTitle,
      preferencesDialogContent: preferencesDialogContent,
      cancelDialogTitle: cancelDialogTitle,
      cancelDialogContent: cancelDialogContent
    }
  }
</script>

<script src="/wp-content/themes/nab-amplify/js/consent-manager.js"></script>

<style>
    #target-container {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 9999999;
    }
</style>

<script type="text/javascript">
(function(){
  // Create a queue, but don't obliterate an existing one!
  var analytics = window.analytics = window.analytics || [];
  // If the real analytics.js is already on the page return.
  if (analytics.initialize) return;
  // If the snippet was invoked already show an error.
  if (analytics.invoked) {
    if (window.console && console.error) {
      console.error('Segment snippet included twice.');
    }
    return;
  }
  // Invoked flag, to make sure the snippet
  // is never invoked twice.
  analytics.invoked = true;
  // A list of the methods in Analytics.js to stub.
  analytics.methods = [
    'trackSubmit',
    'trackClick',
    'trackLink',
    'trackForm',
    'pageview',
    'identify',
    'reset',
    'group',
    'track',
    'ready',
    'alias',
    'debug',
    'page',
    'once',
    'off',
    'on',
    'addSourceMiddleware',
    'addIntegrationMiddleware',
    'setAnonymousId',
    'addDestinationMiddleware'
  ];
  // Define a factory to create stubs. These are placeholders
  // for methods in Analytics.js so that you never have to wait
  // for it to load to actually record data. The `method` is
  // stored as the first argument, so we can replay the data.
  analytics.factory = function(method){
    return function(){
      var args = Array.prototype.slice.call(arguments);
      args.unshift(method);
      analytics.push(args);
      return analytics;
    };
  };
  // For each of our methods, generate a queueing stub.
  for (var i = 0; i < analytics.methods.length; i++) {
    var key = analytics.methods[i];
    analytics[key] = analytics.factory(key);
  }
  // Define a method to load Analytics.js from our CDN,
  // and that will be sure to only ever load it once.
  analytics.load = function(key, options){
    // Create an async script element based on your key.
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.async = true;
    script.src = 'https://cdn.segment.com/analytics.js/v1/'
        + key + '/analytics.min.js';
    // Insert our script next to the first script element.
    var first = document.getElementsByTagName('script')[0];
    first.parentNode.insertBefore(script, first);
    analytics._loadOptions = options;
  };
  // Add a version to keep track of what's in the wild.
  analytics.SNIPPET_VERSION = '4.15.2';

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
    // analytics.load('<?php echo $segment_write_key; ?>', {
    //   user: {
    //     persist: true,
    //     cookie: {
    //       key: 'nab_user_id',
    //       oldkey: 'ajs_user_id'
    //     },
    //     localStorage: {
    //       key: 'nab_user_traits'
    //     }
    //   },
    //   group: {
    //     persist: true,
    //     cookie: {
    //       key: 'nab_group_id'
    //     },
    //     localStorage: {
    //       key: 'nab_group_properties'
    //     }
    //   }
    // });
    <?php 
    // If the user is logged in, we call analytics.identify with
    // the $user_id and $traits we prepared above. Note that we're
    // dumping our $trait to a JSON string and then JSON.parse'ing
    // it in JavaScript to pass the correct object to the JS function.
    if ( is_user_logged_in() ): 
    ?>
    analytics.identify("<?php echo get_current_user_id(); ?>", JSON.parse('<?php echo addslashes( wp_json_encode( $traits ) ); ?>'));
    <?php if($is_login): ?>
    analytics.track("Logged In", { email: "<?php echo $traits['email']; ?>" });
    <?php endif; endif; ?>

    // Call analytics.page with two custom properties prepared above.
    analytics.page({ content_id: "<?php echo $post_id; ?>", content_type: "<?php echo $post_type; ?>" });
})();
</script>
