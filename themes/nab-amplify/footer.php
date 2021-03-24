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

<?php wp_footer(); ?>
<?php
$privacy_url 	= rtrim( get_site_url(), '/' ) . '/privacy-policy/';
$write_key		= get_option( 'segment_tracking_api_key' );
?>
<script>
  window.consentManagerConfig = function(exports) {
    var React = exports.React
    var inEU = exports.inEU

    var bannerContent = React.createElement(
      'span',
      null,
      'We use cookies (and other similar technologies) to collect data to improve your experience on our site. By using our website, you՚re agreeing to the collection of data as described in our',
      ' ',
      React.createElement(
        'a',
        { href: '<?php echo esc_url( $privacy_url ); ?>', target: '_blank' },
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
      container: '#nab-amp-cookie-consent',
      writeKey: 'cu0VWCbc0WL9SNlftQ9MZyowEso2rG7u',
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
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-600ec7b9fa93e668"></script>
</body>

</html>
