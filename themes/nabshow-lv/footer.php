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
                <div class="col-lg-7 col-md-7 col-sm-12">
					<?php
					dynamic_sidebar( 'footer-top-left-sidebar' );
					?>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-12"></div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="resource-list">
                        <h3>Resources</h3>
	                    <?php
                            wp_nav_menu( array(
                                'theme_location' => 'footer-menu',
                                'depth'          => '1',
                                'menu_class'     => 'bottom-nav-menu',
                            ));
	                    ?>
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
<!-- Back To Top -->
<div class="back-to-top"><i class="fa fa-sort-asc" aria-hidden="true"></i></div>
<!-- Back To Top -->
<?php wp_footer(); ?>
</body>
</html>
