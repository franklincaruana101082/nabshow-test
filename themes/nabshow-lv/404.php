<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package NABShow_LV
 */

get_header();
?>

	<div class="wp-block-nab-multipurpose-gutenberg-block has-full is-block-center wrapper-404">
		<main class="site-main wp-block-nab-multipurpose-gutenberg-block has-semi is-block-center">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title">Please Stand by</h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p>It seems you’ve flipped to a channel that does not exist.</p>
					<p>Never-fear. Our site search is extra awesome. Find what you were looking for:</p>

					<?php
					get_search_form();
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
