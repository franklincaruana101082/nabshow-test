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
			<p class="footer-copyright">
							<span class="footer-related">Related Shows: <a style="color: #000000;" href="https://nabshow.com" target="_blank" rel="noopener noreferrer">NAB Show April 10 - 14, 2021</a> | <a style="color: #000000;" href="https://nabshowny.com" target="_blank" rel="noopener noreferrer">NAB Show New York October 2020</a> | <a style="color: #000000;" href="https://nabshow.com/express/" target="_blank" rel="noopener noreferrer">NAB Show Express</a><br /><br />
							</span>

						&copy;
							<?php
							echo date_i18n(
								/* translators: Copyright date format, see https://secure.php.net/date */
								_x( 'Y', 'copyright date format', 'getwid-base' )
							);
							?>
							<a href="https://nab.org/" target="_blank">National Association of Broadcasters</a>. All Rights Reserved.<br />
							<span class="footer-related">
							<a href="/august/privacy-policy/">Privacy Policy</a> | <a href="/august/terms-of-use/">Terms of Use</a> |   <a href="/august/contact/">Contact Us</a>
		</div>
	<?php
	endif;
	?>
</footer><!-- #colophon --></div><!-- #page -->

<?php wp_footer(); ?>

</body></html>
