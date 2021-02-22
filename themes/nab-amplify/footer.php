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
      <div class="footer__logo"><img src="/wp-content/themes/nab-amplify/assets/images/nab-amplify.png" alt="NAB Amplify Logo"></div>
      <nav class="footer__nav">
		  <?php wp_nav_menu( array( 'theme_location' => 'footer-1', 'menu_class' => 'footer__menu', 'container' => '' ) ); ?>
		  <?php wp_nav_menu( array( 'theme_location' => 'footer-2', 'menu_class' => 'footer__menu', 'container' => '' ) ); ?>
		  <?php wp_nav_menu( array( 'theme_location' => 'footer-3', 'menu_class' => 'footer__menu', 'container' => '' ) ); ?>

        <form class="footer__signup">
          <h5 class="menu__title">Learn More</h5>
          <p>Get on the list to be the first to know more about NAB Amplify.</p>
          <input type="text" placeholder="First Name" /><br/>
          <input type="text" placeholder="Last Name" /><br/>
          <input type="text" placeholder="Email" /><br/>
          <input type="submit" class="button" value="Submit" />
        </form>
      </nav>
    </div>
    
    <div class="footer__end">
      <div class="container">
        <div class="footer__copyright">&copy; National Association of Broadcasters. All Rights Reserved.</div>
        <div class="footer__help"><a href="#" class="button _gradientpink _chat">Help</a></div>
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