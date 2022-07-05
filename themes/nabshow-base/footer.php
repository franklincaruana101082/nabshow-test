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
        <small class="footer__copyright">&copy;2021 <strong>National Association of Broadcasters.</strong> All Rights Reserved.</small>
      </div>
    </div>
  </footer>
</div><!-- #page -->
<?php /*
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
*/ ?>

<?php if(get_field('swiftype_key', 'option')) { ?>
<script type="text/javascript">
  (function(w,d,t,u,n,s,e){w['SwiftypeObject']=n;w[n]=w[n]||function(){
  (w[n].q=w[n].q||[]).push(arguments);};s=d.createElement(t);
  e=d.getElementsByTagName(t)[0];s.async=1;s.src=u;e.parentNode.insertBefore(s,e);
  })(window,document,'script','//s.swiftypecdn.com/install/v2/st.js','_st');
  
  _st('install','<?php the_field('swiftype_key', 'option'); ?>','2.0.0');
</script>
<?php
}

wp_footer();
?>
<script type="text/javascript">
    adroll_adv_id = "UC5OXKKMZZFJPPWYMPOPH3";
    adroll_pix_id = "QL6SBKZ4ZRGVVKIWIL3RCY";
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
