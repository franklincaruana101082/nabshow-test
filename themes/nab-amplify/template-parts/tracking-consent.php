<?php
    $segment_write_key = vip_get_env_var( 'SEGMENT_AMPLIFY_WRITE_KEY' );
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
      cancelDialogContent: cancelDialogContent,
      defaultDestinationBehavior: 'enabled'
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

