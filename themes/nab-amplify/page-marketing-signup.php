<?php
/**
* Template Name: Marketing Sign Up
 */

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();
?>
	<div class="intro">
		<div class="container">
			<div class="intro__image-and-copy">
				<div class="intro__image">
					<?php echo get_the_post_thumbnail(); ?>
				</div>
				<div class="intro__copy">
					<?php the_title( '<h1 class="intro__title">', '</h1>' ); ?>
					<div class="introtext">
						<?php the_content(); ?>
					</div>
					<div class="intro__cta">
						<a href="<?php the_field( 'login_button_url' ); ?>" class="button _gradientpink"><?php the_field( 'login_button_text' ); ?></a>
						<?php if ( isset( $redirect_url ) && ! empty( $redirect_url ) ) {
   							$my_account_url = add_query_arg( 'r', $redirect_url, wc_get_page_permalink( 'myaccount' ) );
  						} else {
 							$my_account_url = wc_get_page_permalink( 'myaccount' );
  						} ?>
						<a href="<?php echo esc_url( $my_account_url ); ?>"><b><?php esc_html_e( 'Already on NAB Amplify?' ); ?> <?php esc_html_e( 'Sign In', 'woocommerce' ); ?></b></a>
					</div> 
				</div>
			</div>
		</div>
	</div> 
	<?php if (get_field( 'extra_info' )): ?>
	<div class="container">
		<div class="nabblock">
			<?php the_field( 'extra_info' ); ?>
		</div>
	</div>
<?php
	endif;
	
endwhile; // End of the loop.

get_footer();
