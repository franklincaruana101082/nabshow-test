<?php
  /*
  $segment_write_key = vip_get_env_var( 'SEGMENT_AMPLIFY_WRITE_KEY' );
?>

<script type="application/javascript">
    window.consentManagerConfig = function(exports){
      //=== Script Updates
      var writeKey = '<?php echo $segment_write_key; ?>';
      var inEU = exports.inEU;

      var bannerContent = exports.React.createElement('span', null, 'We use cookies (and other similar technologies) to collect data to improve your experience on our site. By using our website, you՚re agreeing to the collection of data as described in our Website Data Collection Policy.',);
      
      exports.preferences.onPreferencesSaved(function(prefs) {  });      

      var myEl = document.getElementById('nab-amp-cookie-consent'); // Get DOM nap-amp-cookie-consent container
      // Capture nab-amp-cookie-consent button click
      myEl.addEventListener('click', function(e) {
        e.preventDefault(); // Prevent a link from opening the URL:
        // Check if event triggered or event source is from button close on notif dialog
        if(e.target.tagName.toLowerCase() === 'button' && e.target?.getAttributeNode('aria-label')?.value?.toLowerCase() === 'close'){

          // define default Destination and Custom Preferences
          var defaultDesPref =  {"Amazon Kinesis":true,"Amazon S3":true,"Data Lakes":true,"Facebook Pixel":false,"Google Analytics":true,"Hotjar":true,"LinkedIn Insight Tag":false,"Marketo V2":true,"Parsely":true,"Salesforce Marketing Cloud":true,"Visual Tagger":true};
          var defaultCusPref =  {marketingAndAnalytics:true, advertising:true, functional:true};

          // save default preferences
          exports.preferences.savePreferences({ destinationPreferences: defaultDesPref, customPreferences: defaultCusPref });
        }
      })
      //===

      return {   
            container: '#nab-amp-cookie-consent',
            writeKey: writeKey,   
            shouldRequireConsent: inEU,
            bannerContent: bannerContent,          
            bannerSubContent: 'Change your preferences',
            preferencesDialogTitle: 'Website Data Collection',
            preferencesDialogContent: 'We use data collected by cookies and JavaScript libraries.',
            cancelDialogTitle: 'Are you sure you want to cancel?',
            cancelDialogContent: 'Your preferences have not been saved.',
            closeBehavior: 'accept'
        };
    }
</script>

<!-- Setup the Segment Consent Manager tag -->
<script
  src="https://unpkg.com/@segment/consent-manager@5.0.0/standalone/consent-manager.js"
  defer
></script>
<?php */ ?>