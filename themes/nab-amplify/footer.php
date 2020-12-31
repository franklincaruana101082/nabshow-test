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
</div> <!-- end container -->
</div> <!-- end site-content -->
<footer id="colophon" class="site-footer">
	<div class="container">
		<div class="footer-inner">
			<div class="col-1">
				<!--				<img class="logo" src="--><?php //echo wp_kses(get_template_directory_uri() . '/assets/images/nab-logo-white.png', '') 
																?>
				<!--" />-->
				<!--				<ul class="socials">-->
				<!--					<li>-->
				<!--						<a href="#" class="social-facebook" target="_blank">-->
				<!--							<i class="fa fa-facebook"></i>-->
				<!--						</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#" class="social-linkedin" target="_blank">-->
				<!--							<i class="fa fa-linkedin"></i>-->
				<!--						</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#" class="social-twitter" target="_blank">-->
				<!--							<i class="fa fa-twitter"></i>-->
				<!--						</a>-->
				<!--					</li>-->
				<!--				</ul>-->
				<?php dynamic_sidebar('footer-1'); ?>
			</div>
			<div class="col-2">
				<!--				<h4>Main Pages</h4>-->
				<!--				<ul class="footer-menu">-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 1</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 2</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 3</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 4</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 5</a>-->
				<!--					</li>-->
				<!--				</ul>-->
				<?php dynamic_sidebar('footer-2'); ?>
			</div>
			<div class="col-3">
				<!--				<h4>Policy</h4>-->
				<!--				<ul class="footer-menu">-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 1</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 2</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 3</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 4</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 5</a>-->
				<!--					</li>-->
				<!--				</ul>-->
				<?php dynamic_sidebar('footer-3'); ?>
			</div>
			<div class="col-4">
				<!--				<h4>Categories</h4>-->
				<!--				<ul class="footer-menu">-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 1</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 2</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 3</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 4</a>-->
				<!--					</li>-->
				<!--					<li>-->
				<!--						<a href="#">Menu Item 5</a>-->
				<!--					</li>-->
				<!--				</ul>-->
				<?php dynamic_sidebar('footer-4'); ?>
			</div>
			<div class="col-5 subs-main">
			<?php if (is_user_logged_in()) { ?>
				<h4>Beta Feedback</h4>
				<p>We’re very proud to show our "work in progress." Have suggestions for improvements? We'd love to hear them!</p>
				<a class="btn" href="https://nab-amplify-c076.nolt.io/top" target="_blank">Suggest an Idea</a>
			<?php } else { ?>
				
					<!--				<h3>Subscribe</h3>-->
					<!--				<p>Subscribe to our newsletter, so that you can be the first to know about new offers and promotions.</p>-->
					<!--				<form class="subscribe-form">-->
					<!--					<input type="text" class="email" placeholder="Email Address"/>-->
					<!--					<input type="submit" class="search-submit" value="Submit">-->
					<!--				</form>-->
					<?php dynamic_sidebar('footer-5'); ?>
				<?php } ?>
				</div>
		</div><!-- .site-info -->

		<div class="nab-amplify-copyright">
			<?php dynamic_sidebar('footer-6'); ?>
		</div>

	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>