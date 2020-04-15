<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>
			<footer id="site-footer" role="contentinfo" class="header-footer-group">

				<div class="section-inner">

					<div class="footer-credits">
					
					
						
					
						<p class="footer-copyright">
							<span class="footer-related">Related Shows: <a style="color: #ffffff;" href="https://nabshow.com" target="_blank" rel="noopener noreferrer">NAB Show</a> | <a style="color: #ffffff;" href="https://nabshowny.com" target="_blank" rel="noopener noreferrer">NAB Show New York</a> | <a style="color: #ffffff;" href="https://cineemerge.nabshow.com/" target="_blank" rel="noopener noreferrer">CineEmerge</a><br /><br />
							</span>

						&copy;
							<?php
							echo date_i18n(
								/* translators: Copyright date format, see https://secure.php.net/date */
								_x( 'Y', 'copyright date format', 'twentytwenty' )
							);
							?>
							<a href="https://nab.org/" target="_blank">National Association of Broadcasters</a>. All Rights Reserved.<br />
							<span class="footer-related">
							<a href="/express/privacy-policy/">Privacy Policy</a> | <a href="/express/terms-of-use/">Terms of Use</a> | <a href="/express/contact/" target="_blank">Contact Us</a>
							</span>
					
					</p><!-- .footer-copyright -->
						

					</div><!-- .footer-credits -->

					<a class="to-the-top" href="#site-header">
						<span class="to-the-top-long">
							<?php
							/* translators: %s: HTML character for up arrow */
							printf( __( 'To the top %s', 'twentytwenty' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
							?>
						</span><!-- .to-the-top-long -->
						<span class="to-the-top-short">
							<?php
							/* translators: %s: HTML character for up arrow */
							printf( __( 'Up %s', 'twentytwenty' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
							?>
						</span><!-- .to-the-top-short -->
					</a><!-- .to-the-top -->

				</div><!-- .section-inner -->

			</footer><!-- #site-footer -->

		<?php wp_footer(); ?>

	</body>
</html>
