<?php
    $segment_write_key = vip_get_env_var( 'SEGMENT_AMPLIFY_WRITE_KEY' );
    if(empty($segment_write_key)) {
      $segment_write_key = "zl4qcufyCX88jq6nc4tQPO1XTZX8XAAO";
    }
?>

<div id="target-container"></div>

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
        box-shadow: 0 0 5px 0 rgb(0 0 0 / 30%);
        z-index: 9999999;
    }

    .css-ueuzok {
      z-index: 99999991 !important;
    }

    #target-container {
      position: fixed;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 9999999;
    }

    /* Probably remove? */
    #target-container .css-17ss3j2 {
      background-color: #fff;
      color: #000;
      min-height: 30px;
      padding: 15px 80px 15px 30px;
      text-align: left;
    }

    #target-container p button {
      margin: 5px 0;
      color: #e10189;
    }
    #target-container button[aria-label="Close"] {
      background-color: #e10189;
      color: #fff;
      display: inline-block;
      padding: 0;
      right: 20px;
      border-radius: 50%;
      width: 30px;
      height: 30px;
    }
    #target-container p {
      display: inline;
      vertical-align: middle;
      margin: 0 5px 0 0;
    }
    #target-container p,
    #target-container span {
      color: #000;
      font-size: 16px;
    }
</style>

