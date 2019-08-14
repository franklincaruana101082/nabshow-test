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
                            <li><a href="#">Attendees</a></li>
                            <li><a href="#">Exhbitiors</a></li>
                            <li><a href="#">Sponsors</a></li>
                            <li><a href="#">Partners</a></li>
                            <li><a href="#">Speakers</a></li>
                            <li><a href="#">Press</a></li>
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

<?php wp_footer(); ?>
<script>
    !function(t){"use strict";t.loadCSS||(t.loadCSS=function(){});var e=loadCSS.relpreload={};if(e.support=function(){var e;try{e=t.document.createElement("link").relList.supports("preload")}catch(t){e=!1}return function(){return e}}(),e.bindMediaToggle=function(t){function e(){t.media=a}var a=t.media||"all";t.addEventListener?t.addEventListener("load",e):t.attachEvent&&t.attachEvent("onload",e),setTimeout(function(){t.rel="stylesheet",t.media="only x"}),setTimeout(e,3e3)},e.poly=function(){if(!e.support())for(var a=t.document.getElementsByTagName("link"),n=0;n<a.length;n++){var o=a[n];"preload"!==o.rel||"style"!==o.getAttribute("as")||o.getAttribute("data-loadcss")||(o.setAttribute("data-loadcss",!0),e.bindMediaToggle(o))}},!e.support()){e.poly();var a=t.setInterval(e.poly,500);t.addEventListener?t.addEventListener("load",function(){e.poly(),t.clearInterval(a)}):t.attachEvent&&t.attachEvent("onload",function(){e.poly(),t.clearInterval(a)})}"undefined"!=typeof exports?exports.loadCSS=loadCSS:t.loadCSS=loadCSS}("undefined"!=typeof global?global:this);
</script>
</body>
</html>
