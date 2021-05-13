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
    <div class="container footer__container">
      <nav class="footer__nav">
        <?php wp_nav_menu( array( 'theme_location' => 'menu-footer', 'container' => false, 'menu_class' => 'footer__menu' ) ); ?>
      </nav>
      <small class="footer__copyright">&copy;2021 <strong>National Association of Broadcasters.</strong> All Rights Reserved.</small>
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
