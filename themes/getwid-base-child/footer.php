<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package getwid_base
 */

?>

</div><!-- #content -->

<?php
get_sidebar();
?>
<footer id="colophon" class="site-footer">
	<?php

	$show_site_info = (bool) get_theme_mod( 'getwid_base_show_footer_text', true );
	if ( $show_site_info ):
		?>
		<div class="site-info">
			<p>
				<ul class="social-list">
				<li>
				<a href="https://www.facebook.com/pages/NAB-Show/195269533220" class="social-fb" target="_blank" rel="noopener noreferrer">
				<i class="fa fa-facebook"></i>
				</a>
				</li>
				<li>
				<a href="https://twitter.com/nabshow" class="social-twitter" target="_blank" rel="noopener noreferrer">
				<i class="fa fa-twitter"></i>
				</a>
				</li>
				<li>
				<a href="https://www.youtube.com/user/TheNABShow" class="social-youtube" target="_blank" rel="noopener noreferrer">
				<i class="fa fa-youtube"></i>
				</a>
				</li>
				<li>
				<a href="https://www.linkedin.com/company/10428507/" class="social-linkedin" target="_blank" rel="noopener noreferrer">
				<i class="fa fa-linkedin"></i>
				</a>
				</li>
				<li>
				<a href="http://instagram.com/nabshow?ref=badge" class="social-insta" target="_blank" rel="noopener noreferrer">
				<i class="fa fa-instagram"></i>
				</a>
				</li>
				</ul>
			</p>
			<p class="footer-copyright">
				<span class="footer-related">Related Shows: <a href="https://nabshow.com" target="_blank" rel="noopener noreferrer">NAB Show</a> | <a href="https://nabshowny.com" target="_blank" rel="noopener noreferrer">NAB Show New York</a> | <a href="https://nabshow.com/express/" target="_blank" rel="noopener noreferrer">NAB Show Express</a><br /><br />

				<br />
						&copy;
							<?php
							echo date_i18n(
								/* translators: Copyright date format, see https://secure.php.net/date */
								_x( 'Y', 'copyright date format', 'getwid-base' )
							);
							?>
								<a href="https://nab.org/" target="_blank">National Association of Broadcasters</a> All Rights Reserved.<br /><br />
								<span class="footer-related">
								<a href="/privacy-policy/" target="_blank">Privacy Policy</a> | <a href="/terms-of-use/">Terms of Use</a> |   <a href="/contact/">Contact Us</a>
					</span>
				</p>
		</div>
	<?php
	endif;
	?>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body></html>
