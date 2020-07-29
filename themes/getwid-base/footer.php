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
<!--			<?php
			$dateObj           = new DateTime;
			$current_year      = $dateObj->format( "Y" );
			$site_info_default = apply_filters( 'getwid_base_site_info',
				/* translators: %1$s: current year. */
				esc_html_x( 'Copyright &copy; %1$s.  All Rights Reserved.', 'Default footer text. %1$s - current year.', 'getwid-base' )
			);
			$site_info         = get_theme_mod( 'getwid_base_footer_text', false ) ? get_theme_mod( 'getwid_base_footer_text' ) : $site_info_default;

			echo wp_kses_post(
				sprintf(
					$site_info,
					$current_year
				)
			);
			?> -->



			<p class="footer-copyright">
				<span class="footer-related">Related Shows: <a style="color: #ffffff;" href="https://nabshow.com" target="_blank" rel="noopener noreferrer">NAB Show</a> | <a style="color: #ffffff;" href="https://nabshowny.com" target="_blank" rel="noopener noreferrer">NAB Show New York</a> | <a style="color: #ffffff;" href="https://cineemerge.nabshow.com/" target="_blank" rel="noopener noreferrer">CineEmerge</a><br /><br />
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
				</span>

		</p><!-- .footer-copyright -->

		</div>
	<?php
	endif;
	?>
</footer><!-- #colophon --></div><!-- #page -->

<?php wp_footer(); ?>

</body></html>
