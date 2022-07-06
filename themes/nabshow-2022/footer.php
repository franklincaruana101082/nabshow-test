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
</div><?php //close <div data-swiftype-name="body" data-swiftype-type="text"> ?>
  <footer class="footer">
    <div class="footer__container">
      <div class="footer__main">
        <div class="footer__logo">
          <a href="<?php echo esc_url( get_site_url() ); ?>" class="footer__logo-link">
            <?php
            // check if show global menu option is selected
            $footer_logo_code = get_theme_mod( 'nab_footer_logo_code' );
            if ( ! empty( $footer_logo_code ) ) {
                echo $footer_logo_code; // ignored use of wp_kses beacuse the code may vary and accept new tags/attributes in the future.
            } else {
                echo("<img src='/wp-content/themes/nabshow-lv-child-2021/assets/images/NAB_Show_Logo_White.png' alt='NAB Show'/>");
            }
            ?>
          </a>
        </div>
        <div class="footer__social">
          <?php wp_nav_menu( array( 'theme_location' => 'menu-social', 'container' => false, 'menu_class' => 'social-list' ) ); ?>
        </div>
      </div>
      <div class="footer__secondary">
        <nav class="footer__nav">
          <?php wp_nav_menu( array( 'theme_location' => 'menu-footer', 'container' => false, 'menu_class' => 'footer__menu' ) ); ?>
        </nav>
        <small class="footer__copyright">&copy;<?php echo date("Y"); ?> <strong>National Association of Broadcasters.</strong> All Rights Reserved.</small>
      </div>
    </div>
  </footer>
</div><!-- #page -->


<?php wp_footer(); ?>
<script type="text/javascript">
    adroll_adv_id = "HSSD2EG325CKLLDB3VDRRK";
    adroll_pix_id = "7BVYCL35SVEODLE54PZAIU";
    adroll_version = "2.0";

    (function(w, d, e, o, a) {
        w.__adroll_loaded = true;
        w.adroll = w.adroll || [];
        w.adroll.f = [ 'setProperties', 'identify', 'track' ];
        var roundtripUrl = "https://s.adroll.com/j/" + adroll_adv_id
                + "/roundtrip.js";
        for (a = 0; a < w.adroll.f.length; a++) {
            w.adroll[w.adroll.f[a]] = w.adroll[w.adroll.f[a]] || (function(n) {
                return function() {
                    w.adroll.push([ n, arguments ])
                }
            })(w.adroll.f[a])
        }

        e = d.createElement('script');
        o = d.getElementsByTagName('script')[0];
        e.async = 1;
        e.src = roundtripUrl;
        o.parentNode.insertBefore(e, o);
    })(window, document);
    adroll.track("pageView");
</script>
</body>
</html>
