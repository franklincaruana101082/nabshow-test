<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Amplify
 */

$privacy_url  = rtrim( get_site_url(), '/' ) . '/privacy-policy/';
$write_key    = get_option( 'segment_tracking_api_key' );

?>

</div> <!-- end site-content -->
</div><!-- #page -->
<div id="nab-amp-cookie-consent"></div>

<script type="application/javascript">
  window.consentManagerConfig = function(exports) {
    var React = exports.React
    var bannerContent = React.createElement('span', null, 'We use cookies (and other similar technologies) to collect data to improve your experience on our site. By using our website, you՚re agreeing to the collection of data as described in our Website Data Collection Policy.',)
    
    //=== Script Updates
    var defaultPref = { marketingAndAnalytics: false, functional: true, advertising: false };
    var initPref = loadPref = { marketingAndAnalytics: false, functional: true };
    
    if(localStorage.getItem("hasPrefStored") && typeof localStorage.getItem("hasPrefStored") !== "undefined") loadPref = defaultPref;   

    var myEl = document.getElementById('nab-amp-cookie-consent'); // Get DOM nap-amp-cookie-consent container

    // Capture cookie consent set preference close button
    myEl.addEventListener('click', function(e) {
      e.preventDefault(); // Prevent a link from opening the URL:
      // Check if event triggered or event source is from button close on notif dialog
      if(e.target.getAttribute('aria-label').toLowerCase() === "close"){
        // Extra flag hasPrefStored for determining default preference whether to use the value from Initial Preferences 
        // or the full set which include key adverstising and value false
        if(!localStorage.getItem("hasPrefStored") || typeof localStorage.getItem("hasPrefStored") === "undefined"){          
          exports.preferences.savePreferences(defaultPref);    
          localStorage.setItem("hasPrefStored",1);

          loadPref = defaultPref; // Swap previous preference with a new/default preference, includes one preference, adverstising: false
        }     
      }
    })
    //===

    return {
      container: '#nab-amp-cookie-consent',
      writeKey: '<?php echo $write_key; ?>',          
      initialPreferences: loadPref,
      bannerContent: bannerContent,
      bannerSubContent: 'Change your preferences',
      preferencesDialogTitle: 'Website Data Collection',
      preferencesDialogContent: 'We use data collected by cookies and JavaScript libraries.',
      cancelDialogTitle: 'Are you sure you want to cancel?',
      cancelDialogContent: 'Your preferences have not been saved.'
    }
  }

  // window.consentManagerConfig = function(exports) {
  //   exports.preferences.onPreferencesSaved(function(prefs) {      
  //   })

  //   return {
  //     container: '#nab-amp-cookie-consent',
  //     writeKey: '<?php echo $write_key; ?>',          
  //     initialPreferences: {
  //       marketingAndAnalytics: false,            
  //       functional: true
  //     },
  //     bannerContent: exports.React.createElement('span', null, 'We use cookies (and other similar technologies) to collect data to improve your experience on our site. By using our website, you՚re agreeing to the collection of data as described in our Website Data Collection Policy.',),
  //     bannerSubContent: 'Change your preferences',
  //     preferencesDialogTitle: 'Website Data Collection',
  //     preferencesDialogContent: 'We use data collected by cookies and JavaScript libraries.',
  //     cancelDialogTitle: 'Are you sure you want to cancel?',
  //     cancelDialogContent: 'Your preferences have not been saved.'
  //   }
  // }
</script>

<!-- Setup the Segment Consent Manager tag -->
<script src="https://unpkg.com/@segment/consent-manager@5.0.0/standalone/consent-manager.js" defer></script>
<?php wp_footer(); ?>
<script src="/wp-content/themes/nab-amplify/js/app.min.js"></script>
</body>

</html>