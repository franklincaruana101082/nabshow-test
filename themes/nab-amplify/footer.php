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
<footer id="colophon" class="footer">
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
  </footer>

</div><!-- #page -->

<?php wp_footer(); ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-600ec7b9fa93e668"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="/wp-content/themes/nab-amplify/js/app.min.js"></script>
<script type="application/javascript">
      window.consentManagerConfig = function(exports) {
        return {
          container: '#consent-manager',
          writeKey: '<?php echo esc_attr( $write_key ); ?>',
          bannerContent:
            'We use cookies (and other similar technologies) to collect data to improve your experience on our site.',
          bannerSubContent: 'You can change your preferences at any time.',
          preferencesDialogTitle: 'Website Data Collection Preferences',
          preferencesDialogContent:
            'We use data collected by cookies and JavaScript libraries to improve your browsing experience, analyze site traffic, deliver personalized advertisements, and increase the overall performance of our site.',
          cancelDialogTitle: 'Are you sure you want to cancel?',
          cancelDialogContent:
            "Your preferences have not been saved. By continuing to use our website, you're agreeing to our Website Data Collection Policy",
          closeBehavior: 'accept'
        }
      }
    </script>

    <!-- Setup the Segment Consent Manager tag -->
    <script src="https://unpkg.com/@segment/consent-manager@5.0.0/standalone/consent-manager.js" defer></script>

    <!-- Load analytics.js -->
    <script type="text/javascript">
      !function(){var analytics=window.analytics=window.analytics||[];if(!analytics.initialize)if(analytics.invoked)window.console&&console.error&&console.error("Segment snippet included twice.");else{analytics.invoked=!0;analytics.methods=["trackSubmit","trackClick","trackLink","trackForm","pageview","identify","reset","group","track","ready","alias","debug","page","once","off","on","addSourceMiddleware","addIntegrationMiddleware","setAnonymousId","addDestinationMiddleware"];analytics.factory=function(t){return function(){var e=Array.prototype.slice.call(arguments);e.unshift(t);analytics.push(e);return analytics}};for(var t=0;t<analytics.methods.length;t++){var e=analytics.methods[t];analytics[e]=analytics.factory(e)}analytics.load=function(t,e){var n=document.createElement("script");n.type="text/javascript";n.async=!0;n.src="https://cdn.segment.com/analytics.js/v1/"+t+"/analytics.min.js";var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(n,a);analytics._loadOptions=e};analytics.SNIPPET_VERSION="4.1.0";
      }}();
    </script>
</body>

</html>