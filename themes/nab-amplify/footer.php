<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Amplify
 */

?>

</div> <!-- end site-content -->
<footer id="colophon" class="footer">
    <div class="container">
    
      <div class="footer__logo">      
        <a href="<?php echo esc_url( get_site_url() ); ?>" class="footer__logolink">
          <?php
          // check if show global menu option is selected
          $nab_header_logo_code = get_theme_mod( 'nab_header_logo_code' );
          if ( ! empty( $nab_header_logo_code ) ) {
            echo $nab_header_logo_code; // ignored use of wp_kses beacuse the code may vary and accept new tags/attributes in the future.
          } else {
            echo("<img src='/wp-content/themes/nab-amplify/assets/images/nab-amplify.png' alt='NAB Amplify Logo' />");
          }
          ?>
          
        </a>
        <?php wp_nav_menu( array( 'theme_location' => 'social-1', 'menu_class' => 'footer__menu _social', 'container' => '' ) ); ?>
        <?php wp_nav_menu( array( 'theme_location' => 'footer-4', 'menu_class' => 'footer__menu _brand', 'container' => '' ) ); ?>
      </div>

      <nav class="footer__nav">
        <?php wp_nav_menu( array( 'theme_location' => 'footer-1', 'menu_class' => 'footer__menu', 'container' => '' ) ); ?>
        <?php wp_nav_menu( array( 'theme_location' => 'footer-2', 'menu_class' => 'footer__menu', 'container' => '' ) ); ?>
        <?php wp_nav_menu( array( 'theme_location' => 'footer-3', 'menu_class' => 'footer__menu', 'container' => '' ) ); ?>

        <div class="footer__signup">
          <h5 class="menu__title">Learn More</h5>
				  <p>Get on the list to be the first to know more about NAB Amplify.</p>
          <script src="//app-ab34.marketo.com/js/forms2/js/forms2.min.js"></script>
          <form class="subscribe-form" id="mktoForm_1113"></form>
          <script>MktoForms2.loadForm("//app-ab34.marketo.com", "927-ARO-980", 1113);</script>
        </div>
      </nav>
    </div>
    
    <div class="footer__end">
      <div class="container">
        <div class="footer__copyright">
          © 2021 National Association of Broadcasters. All Rights Reserved.
        </div>
      </div>
    </div>
  </footer>

</div><!-- #page -->

<?php wp_footer(); ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-600ec7b9fa93e668"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="/wp-content/themes/nab-amplify/js/app.min.js"></script>
</body>

</html>