<?php
/*
 * Template Name: Email Verification
 */

get_header('nabshow');

?>

<style>
.email-verify-logos {
    display: flex;
    flex-flow: row wrap;
    justify-content: space-between;
    align-items: center;
    margin: 3rem 0;
}
.email-verify-logos > div {
    display: block;
    margin-top: 1.25rem;
    flex: 0 1 calc(50% - 15px);
}
.email-verify-logos > div:nth-child(odd) {
    margin-right: 0.9375rem;
}
.email-verify-logos > div:nth-child(2n + 2) {
    margin-left: 0.9375rem;
}
@media (min-width: 37.75em) {
    .email-verify-logos > div {
        flex: 0 1 calc(25% - 20px);
        margin: 0 0.625rem;
    }
    .email-verify-logos > div:nth-child(2n + 2),
    .email-verify-logos > div:nth-child(odd) {
        margin-right: 0.625rem;
        margin-left: 0.625rem;
    }
}
.email-verify-logos > div > div {
    height: 0;
}
.email-verify-logos > div.email-verify-logo-amplify img {
    max-width: 17.3125rem;
}
.email-verify-logos > div.email-verify-logo-show img {
    max-width: 17.3125rem;
}
.email-verify-logos > div.email-verify-logo-nyshow img {
    max-width: 17.3125rem;
}
.email-verify-logos > div img {
    display: block;
    margin: 0 auto;
}
</style>
<!-- START legacy-template: sign-up-template -->
<main id="primary" class="site-main nabshow_signup">

<?php
while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="signup-wrapper">
			<div class="container">
				<div class="email-verify-logos">
					<div class="email-verify-logo-amplify">
						<img src="/wp-content/themes/nab-amplify/assets/images/email-verify-logo-amplify.png" alt="NAB Amplify Logo">
					</div>
					<div class="email-verify-logo-show">
						<img src="/wp-content/themes/nab-amplify/assets/images/email-verify-logo-show.png" alt="NAB Show Logo">
					</div>
					<div class="email-verify-logo-nyshow">
						<img src="/wp-content/themes/nab-amplify/assets/images/email-verify-logo-nyshow.png" alt="NAB Show NY Logo">
					</div>
				</div>
                <div class="signup__titles">
                    <h2><?php the_title(); ?></h2>
                </div>
                <div class="signup__text">
                    <div class="introtext"><?php the_content(); ?></div>
                </div>
		    </div><!-- .container -->
	    </div><!-- .signup-wrapper -->
	</article><!-- #post-<?php the_ID(); ?> -->
<?php
endwhile; // End of the loop.
?>


</main><!-- #main -->
<!-- END legacy-template -->
<?php

get_footer('nabshow');