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

$privacy_url 	= rtrim( get_site_url(), '/' ) . '/privacy-policy/';
$write_key		= get_option( 'segment_tracking_api_key' );
?>

</div> <!-- end site-content -->
<footer id="colophon" class="footer" data-swiftype-index="false">
    <div class="container">
    
      <div class="footer__logo">      
        <a href="<?php echo esc_url( get_site_url() ); ?>" class="footer__logolink">
          <?php
          // check if show global menu option is selected
          $nab_header_logo_code = get_theme_mod( 'nab_header_logo_code' );
          if ( ! empty( $nab_header_logo_code ) ) {
            echo $nab_header_logo_code; // ignored use of wp_kses beacuse the code may vary and accept new tags/attributes in the future.
          } else {
            echo("<img src='/wp-content/themes/nab-amplify/assets/images/nab-amplify.png' alt='NAB Amplify Logo' />");
          }
          ?>
          
        </a>
        <?php wp_nav_menu( array( 'theme_location' => 'social-1', 'menu_class' => 'footer__menu _social', 'container' => '' ) ); ?>
        <?php wp_nav_menu( array( 'theme_location' => 'footer-4', 'menu_class' => 'footer__menu _brand', 'container' => '' ) ); ?>
      </div>

      <nav class="footer__nav">
        <?php wp_nav_menu( array( 'theme_location' => 'footer-1', 'menu_class' => 'footer__menu', 'container' => '' ) ); ?>
        <?php wp_nav_menu( array( 'theme_location' => 'footer-2', 'menu_class' => 'footer__menu', 'container' => '' ) ); ?>
        <?php wp_nav_menu( array( 'theme_location' => 'footer-3', 'menu_class' => 'footer__menu', 'container' => '' ) ); ?>

        <div class="footer__signup">
          <?php dynamic_sidebar('footer-5'); ?>
        </div>
      </nav>
    </div>
    
    <div class="footer__end">
      <div class="container">
        <div class="footer__copyright">
          <?php dynamic_sidebar('footer-6'); ?>
        </div>
      </div>
    </div>
    <div id="nab-amp-cookie-consent"></div>
  </footer>
  <?php dynamic_sidebar('broadstreet-footer'); ?>
</div><!-- #page -->

<script type="application/javascript">
    window.consentManagerConfig = function(exports){
      //=== Script Updates
      var bannerContent = exports.React.createElement('span', null, 'We use cookies (and other similar technologies) to collect data to improve your experience on our site. By using our website, you՚re agreeing to the collection of data as described in our Website Data Collection Policy.',)
      
      exports.preferences.onPreferencesSaved(function(prefs) {  });      

      var myEl = document.getElementById('nab-amp-cookie-consent'); // Get DOM nap-amp-cookie-consent container
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
            container: '#nab-amp-cookie-consent',
            writeKey: '<?php echo $write_key; ?>',   
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
<script src="https://unpkg.com/@segment/consent-manager@5.0.0/standalone/consent-manager.js" defer></script>
<?php wp_footer(); ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-600ec7b9fa93e668"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="/wp-content/themes/nab-amplify/js/app.min.js"></script>
<script type="text/javascript">
  adroll_adv_id = "SSH5IDWJB5GCXDVUNY5AIZ";
  adroll_pix_id = "NJDQ2IYGJFGXDCSYUXCS3O";
  adroll_version = "2.0";

  (function(w, d, e, o, a) {
    w.__adroll_loaded = true;
    w.adroll = w.adroll || [];
    w.adroll.f = [ 'setProperties', 'identify', 'track' ];
    var roundtripUrl = "https://s.adroll.com/j/" + adroll_adv_id
        + "/roundtrip.js";
    for (a = 0; a < w.adroll.f.length; a++) {
      w.adroll[w.adroll.f[a]] = w.adroll[w.adroll.f[a]] || (function(n) {
        return function() {
          w.adroll.push([ n, arguments ])
        }
      })(w.adroll.f[a])
    }

    e = d.createElement('script');
    o = d.getElementsByTagName('script')[0];
    e.async = 1;
    e.src = roundtripUrl;
    o.parentNode.insertBefore(e, o);
  })(window, document);
  adroll.track("pageView");
</script>

<script type="text/javascript">
  (function(w,d,t,u,n,s,e){w['SwiftypeObject']=n;w[n]=w[n]||function(){
  (w[n].q=w[n].q||[]).push(arguments);};s=d.createElement(t);
  e=d.getElementsByTagName(t)[0];s.async=1;s.src=u;e.parentNode.insertBefore(s,e);
  })(window,document,'script','//s.swiftypecdn.com/install/v2/st.js','_st');

  _st('install','EXqWbg3Gg4icxjFkYUK3','2.0.0');
</script>

</body>

</html>