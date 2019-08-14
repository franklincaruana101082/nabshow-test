<?php
/**
 * Template Name: Not to Be Missed Single
 *
 * @package  NABShow_LV
 * */
get_header();
?>
<div class="not-to-be-missed-single">
	<div class="header-banner">
		<?php the_post_thumbnail( 'single-post-thumbnail' ); ?>
		<div class="container">
			<div class="banner-details">
				<h1><?php wp_title(''); ?></h1>
				<span class="sub-category">- Category, Category</span>
			</div>
		</div>
	</div>
	<div id="primary" class="container">
		<div class="page-main">
			<div class="row mb40">
				<div class="col-lg-8">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur malesuada metus at metus
						venenatis, a rutrum mauris euismod. Fusce vulputate semper quam, ac condimentum dui efficitur
						quis. Vestibulum volutpat nisl id elit placerat maximus. Suspendisse mollis ac eros id faucibus.
						Vivamus nec dolor nec nulla dapibus luctus ac eget leo. Phasellus elementum faucibus risus, ac
						vulputate ante iaculis et. Donec dignissim, est nec eleifend laoreet, magna lacus eleifend dui,
						eget scelerisque ante est ut mauris. Praesent blandit diam eu enim varius, a volutpat nunc
						aliquet.</p>
					<p>Sed dolor erat, tincidunt sed tristique non, dictum eu ligula. Fusce ultrices sem sed lacus
						fermentum vulputate. Integer vehicula magna urna. Praesent congue ullamcorper nisi a vulputate.
						In viverra purus velit, id faucibus odio lacinia at. Nulla vulputate eu tellus et aliquet.
						Vestibulum et sem vitae ante laoreet interdum eu sit amet risus. Nunc finibus risus ut lorem
						tempor, a congue ex cursus. Proin posuere porta est feugiat luctus. Curabitur rutrum in mi non
						commodo. Vestibulum at pretium elit, et pretium ipsum. Quisque ultricies velit eu dui gravida,
						nec blandit nisi lobortis. In vitae auctor velit.</p>
					<p>Fusce efficitur vestibulum rhoncus. Vivamus eu justo in ligula aliquam placerat nec id odio.
						Pellentesque non efficitur lacus. Mauris at tellus facilisis, pellentesque nisi id, dictum
						ligula. Nunc dictum eros et mauris tincidunt, eget facilisis sem sagittis. Sed et arcu id neque
						feugiat eleifend. Vestibulum id eros sed metus ultricies maximus sit amet non risus.</p>
				</div>
				<div class="col-lg-4">
					<img class="full-width" src="http://nabshow.md-staging.com/wp-content/uploads/2019/07/banner-slider-1.png" />
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="cross-promo-box">
						<h2 class="title">Cross Promo Title</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
							labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo</p>
						<a href="#">Learn More</a>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="cross-promo-box">
						<h2 class="title">Cross Promo Title</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
							labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo</p>
						<a href="#">Learn More</a>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="cross-promo-box">
						<h2 class="title">Cross Promo Title</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
							labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo</p>
						<a href="#">Learn More</a>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="cross-promo-box">
						<h2 class="title">Cross Promo Title</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
							labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo</p>
						<a href="#">Learn More</a>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="cross-promo-box">
						<h2 class="title">Cross Promo Title</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
							labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo</p>
						<a href="#">Learn More</a>
					</div>
				</div>
			</div>
		</div>
	</div><!-- #primary -->
</div>
<?php
get_footer();