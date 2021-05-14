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
          <?php /*<ul class="social-list">
            <li>
              <a href="https://www.facebook.com/pages/NAB-Show/195269533220" class="social-fb" target="_blank" rel="noopener" data-feathr-click-track="true">
                <i class="fa fa-facebook"></i>
              </a>
            </li>
            <li>
              <a href="https://twitter.com/nabshow" class="social-twitter" target="_blank" rel="noopener" data-feathr-click-track="true">
                <i class="fa fa-twitter"></i>
              </a>
            </li>
            <li>
              <a href="https://www.youtube.com/user/TheNABShow" class="social-youtube" target="_blank" rel="noopener" data-feathr-click-track="true">
                <i class="fa fa-youtube"></i>
              </a>
            </li>
            <li>
              <a href="https://www.linkedin.com/company/10428507/" class="social-linkedin" target="_blank" rel="noopener" data-feathr-click-track="true">
                <i class="fa fa-linkedin"></i>
              </a>
            </li>
            <li>
              <a href="http://instagram.com/nabshow?ref=badge" class="social-insta" target="_blank" rel="noopener" data-feathr-click-track="true">
                <i class="fa fa-instagram"></i>
              </a>
            </li>
          </ul>*/ ?>
          <span class="footer__social-hashtag">#NABSHOW</span>
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
<?php wp_footer(); ?>
</body>
</html>
