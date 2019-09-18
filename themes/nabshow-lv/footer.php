<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NABShow_LV
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer">
    <div class="stay-in-loop-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
					<?php
					dynamic_sidebar( 'footer-top-left-sidebar' );
					?>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1"></div>
                <div class="col-lg-5 col-md-5 col-sm-5">
					<?php
					dynamic_sidebar( 'footer-top-right-sidebar' );
					?>
                </div>
            </div>
        </div>
    </div>
	<?php
	$middle_bg = get_theme_mod( 'footer_middle_bg', '' );
	?>
    <div class="resources" style="background-image:url('<?php echo esc_url( $middle_bg ); ?>')">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="resource-list">
                        <h3>Resources for:</h3>
                        <ul>
                            <li><a href="#" class="btn-default">Attendees</a></li>
                            <li><a href="#" class="btn-default">Exhbitiors</a></li>
                            <li><a href="#" class="btn-default">Sponsors</a></li>
                            <li><a href="#" class="btn-default">Partners</a></li>
                            <li><a href="#" class="btn-default">Speakers</a></li>
                            <li><a href="#" class="btn-default">Press</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-footer">
        <div class="container ">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="footer-left">
						<?php
						$middle_bg = get_theme_mod( 'footer_logo', '' );
						?>
                        <img src="<?php echo esc_url( $middle_bg ); ?>" alt="Footer Logo">
						<?php
						dynamic_sidebar( 'footer-bottom-left-sidebar' );
						?>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <div class="footer-right">
						<?php
						dynamic_sidebar( 'footer-bottom-right-sidebar' );
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- <div class="site-info">
        <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'nabshow-lv' ) ); ?>">
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf( esc_html__( 'Proudly powered by %s', 'nabshow-lv' ), 'WordPress' );
			?>
        </a>
        <span class="sep"> | </span>
		<?php
		/* translators: 1: Theme name, 2: Theme author. */
		printf( esc_html__( 'Theme: %1$s by %2$s.', 'nabshow-lv' ), 'nabshow-lv', '<a href="http://underscores.me/">Underscores.me</a>' );
		?>
    </div> -->
    <!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->
<!-- Popup HTML -->
<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<!-- Popup HTML -->
<?php wp_footer(); ?>
</body>
</html>
