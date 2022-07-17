<?php
    $segment_write_key = vip_get_env_var( 'SEGMENT_AMPLIFY_WRITE_KEY' );
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


    exports.preferences.onPreferencesSaved(function(prefs) {  });

      var myEl = document.getElementById('target-container'); // Get DOM nap-amp-cookie-consent container
      // Capture nab-amp-cookie-consent button click
      myEl.addEventListener('click', function(e) {
        e.preventDefault(); // Prevent a link from opening the URL:
        // Check if event triggered or event source is from button close on notif dialog
        if(e.target.tagName.toLowerCase() === 'button' && e.target?.getAttributeNode('aria-label')?.value?.toLowerCase() === 'close'){

          // define default Destination and Custom Preferences
          const defaultDesPref =  {"Amazon Kinesis":true,"Amazon S3":true,"Data Lakes":true,"Facebook Pixel":false,"Google Analytics":true,"Hotjar":true,"LinkedIn Insight Tag":false,"Marketo V2":true,"Parsely":true,"Salesforce Marketing Cloud":true,"Visual Tagger":true};
          const defaultCusPref =  {marketingAndAnalytics:true, advertising:false, functional:true};

          // save default preferences
          exports.preferences.savePreferences({ destinationPreferences: defaultDesPref, customPreferences: defaultCusPref });
        }
      })
      //===


    return {
      container: '#target-container',
      writeKey: writeKey,
      bannerContent: bannerContent,
      bannerSubContent: bannerSubContent,
      preferencesDialogTitle: preferencesDialogTitle,
      preferencesDialogContent: preferencesDialogContent,
      cancelDialogTitle: cancelDialogTitle,
      cancelDialogContent: cancelDialogContent,
      defaultDestinationBehavior: 'enabled',
      closeBehavior: 'accept'
    }
  }
</script>

<script src="https://unpkg.com/@segment/consent-manager@5.6.0/standalone/consent-manager.js" defer></script>

<style>
    #target-container {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        box-shadow: 0 0 5px 0 rgb(0 0 0 / 30%);
        z-index: 9999999;
    }

    #target-container {
      position: fixed;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 9999999;
    }

    /* Probably remove? */
    #target-container > div[class] {
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

