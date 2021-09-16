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
        </div>
      </div>
      <div class="footer__secondary">
        <small class="footer__copyright">&copy;2021 <strong>National Association of Broadcasters.</strong> All Rights Reserved.</small>
      </div>
    </div>
  </footer>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
