<?php

/**
 * Template Name: Products
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package oneBlog
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="breadcrumbs">
		<ul>
			<li><a href="/">home</a></li>
			<li>products</li>
		</ul>
	</div>
	<div class="element-with-sidebar">
		<div class="left-side">
			<div class="product-head">
				<h2>Whitepapers</h2>
				<div class="product-layout">
					<span class="grid"></span>
					<span class="list"></span>
				</div>
			</div>
			<div class="product-list">
				<div class="product-item">
					<div class="item-inner">
						<div class="thumbnail">
							<img src="<?php echo wp_kses(get_template_directory_uri() . '/assets/images/product.png', '') ?>"  alt="products"/>
							<span class="category">Category</span>
						</div>
						<div class="details">
							<div class="top">
								<h3 class="title">Product title</h3>
								<strong class="brand">Brand</strong>
							</div>
							<div class="buttom">
								<span class="price before">$32.00</span>
								<span class="price">$25.60</span>
								<div class="buttoms">
									<a href="#">30% Off</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="product-item">
					<div class="item-inner">
						<div class="thumbnail">
							<img src="<?php echo wp_kses(get_template_directory_uri() . '/assets/images/product.png', '') ?>"  alt="products"/>
							<span class="category">Category</span>
						</div>
						<div class="details">
							<div class="top">
								<h3 class="title">Product title</h3>
								<strong class="brand">Brand</strong>
							</div>
							<div class="buttom">
								<span class="price before">$32.00</span>
								<span class="price">$25.60</span>
								<div class="buttoms">
									<a href="#">30% Off</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="product-item">
					<div class="item-inner">
						<div class="thumbnail">
							<img src="<?php echo wp_kses(get_template_directory_uri() . '/assets/images/product.png', '') ?>"  alt="products"/>
							<span class="category">Category</span>
						</div>
						<div class="details">
							<div class="top">
								<h3 class="title">Product title</h3>
								<strong class="brand">Brand</strong>
							</div>
							<div class="buttom">
								<span class="price before">$32.00</span>
								<span class="price">$25.60</span>
								<div class="buttoms">
									<a href="#">30% Off</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="product-item">
					<div class="item-inner">
						<div class="thumbnail">
							<img src="<?php echo wp_kses(get_template_directory_uri() . '/assets/images/product.png', '') ?>"  alt="products"/>
							<span class="category">Category</span>
						</div>
						<div class="details">
							<div class="top">
								<h3 class="title">Product title</h3>
								<strong class="brand">Brand</strong>
							</div>
							<div class="buttom">
								<span class="price before">$32.00</span>
								<span class="price">$25.60</span>
								<div class="buttoms">
									<a href="#">30% Off</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="product-item">
					<div class="item-inner">
						<div class="thumbnail">
							<img src="<?php echo wp_kses(get_template_directory_uri() . '/assets/images/product.png', '') ?>"  alt="products"/>
							<span class="category">Category</span>
						</div>
						<div class="details">
							<div class="top">
								<h3 class="title">Product title</h3>
								<strong class="brand">Brand</strong>
							</div>
							<div class="buttom">
								<span class="price before">$32.00</span>
								<span class="price">$25.60</span>
								<div class="buttoms">
									<a href="#">30% Off</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="product-item">
					<div class="item-inner">
						<div class="thumbnail">
							<img src="<?php echo wp_kses(get_template_directory_uri() . '/assets/images/product.png', '') ?>"  alt="products"/>
							<span class="category">Category</span>
						</div>
						<div class="details">
							<div class="top">
								<h3 class="title">Product title</h3>
								<strong class="brand">Brand</strong>
							</div>
							<div class="buttom">
								<span class="price before">$32.00</span>
								<span class="price">$25.60</span>
								<div class="buttoms">
									<a href="#">30% Off</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="right-side">
			<h3>Product Filter</h3>
		</div>
	</div>

</main>

<?php
get_footer();
