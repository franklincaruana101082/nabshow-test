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
</div> <!-- end container -->
</div> <!-- end site-content -->
<footer id="colophon" class="site-footer">
	<div class="container">
		<div class="footer-inner">
			<div class="col-1">
				<!--				<img class="logo" src="--><?php //echo wp_kses(get_template_directory_uri() . '/assets/images/nab-logo-white.png', '')
																?>
				<!--" />-->
				<!--				<ul class="socials">-->
				<!--					<li>-->
				<!--						<a href="#" class="social-facebook" target="_blank">-->
				<!--							<i class="fa fa-facebook"></i>-->
				<!--						</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#" class="social-linkedin" target="_blank">-->
				<!--							<i class="fa fa-linkedin"></i>-->
				<!--						</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#" class="social-twitter" target="_blank">-->
				<!--							<i class="fa fa-twitter"></i>-->
				<!--						</a>-->
				<!--					</li>-->
				<!--				</ul>-->
				<?php dynamic_sidebar('footer-1'); ?>
			</div>
			<div class="col-2">
				<!--				<h4>Main Pages</h4>-->
				<!--				<ul class="footer-menu">-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 1</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 2</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 3</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 4</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 5</a>-->
				<!--					</li>-->
				<!--				</ul>-->
				<?php dynamic_sidebar('footer-2'); ?>
			</div>
			<div class="col-3">
				<!--				<h4>Policy</h4>-->
				<!--				<ul class="footer-menu">-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 1</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 2</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 3</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 4</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 5</a>-->
				<!--					</li>-->
				<!--				</ul>-->
				<?php dynamic_sidebar('footer-3'); ?>
			</div>
			<div class="col-4">
				<!--				<h4>Categories</h4>-->
				<!--				<ul class="footer-menu">-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 1</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 2</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 3</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 4</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 5</a>-->
				<!--					</li>-->
				<!--				</ul>-->
				<?php dynamic_sidebar('footer-4'); ?>
			</div>
			<div class="col-5 subs-main">
				<?php if (is_user_logged_in()) {
					dynamic_sidebar('footer-loggedin');
				} else { ?>

					<!--				<h3>Subscribe</h3>-->
					<!--				<p>Subscribe to our newsletter, so that you can be the first to know about new offers and promotions.</p>-->
					<!--				<form class="subscribe-form">-->
					<!--					<input type="text" class="email" placeholder="Email Address"/>-->
					<!--					<input type="submit" class="search-submit" value="Submit">-->
					<!--				</form>-->
					<?php dynamic_sidebar('footer-5'); ?>
				<?php } ?>
			</div>
		</div><!-- .site-info -->

		<div class="nab-amplify-copyright">
			<?php dynamic_sidebar('footer-6'); ?>
		</div>

	</div>
	<div id="nab-amp-cookie-consent"></div>
</footer><!-- #colophon -->
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
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-600ec7b9fa93e668"></script>
</body>

</html>