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
    <div id="nab-amp-cookie-consent"></div>
  </footer>

</div><!-- #page -->
<?php
$privacy_url 	= rtrim( get_site_url(), '/' ) . '/privacy-policy/';
$write_key		= get_option( 'segment_tracking_api_key' );
?>
<script type="application/javascript">
      window.consentManagerConfig = function(exports) {
        exports.preferences.onPreferencesSaved(function(prefs) {
          // could be used to store consent server side, or send it into an API
        })

        return {
          container: '#nab-amp-cookie-consent',
          writeKey: '<?php echo $write_key; ?>',
          /* initialPreferences allows for customizing which categories already pre-loaded */
          initialPreferences: {
            marketingAndAnalytics: false,
            // functional: true will automatically record consent for functional cookies
            functional: true
          },
          /*
      The consent manager ships with a lightweight version of 
      React (preact) that you can use to customize the consent manager further
    */
          bannerContent: exports.React.createElement('span', null, 'We use cookies (and other similar technologies) to collect data to improve your experience on our site. By using our website, you՚re agreeing to the collection of data as described in our Website Data Collection Policy.',),
          bannerSubContent: 'Change your preferences',
          preferencesDialogTitle: 'Website Data Collection',
          preferencesDialogContent: 'We use data collected by cookies and JavaScript libraries.',
          cancelDialogTitle: 'Are you sure you want to cancel?',
          cancelDialogContent: 'Your preferences have not been saved.'
        }
      }
    </script>

<script src="https://unpkg.com/@segment/consent-manager@5.0.0/standalone/consent-manager.js" defer></script>

<?php wp_footer(); ?>
</body>

</html>