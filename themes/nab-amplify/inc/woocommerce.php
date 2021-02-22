<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Amplify
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function nab_amplify_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'nab_amplify_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function nab_amplify_woocommerce_scripts() {
	wp_enqueue_style( 'nab-amplify-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'nab-amplify-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'nab_amplify_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function nab_amplify_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	if( ! is_user_logged_in() && ( is_account_page() || is_page( NAB_SIGNUP_PAGE )  ) ) {
		$classes[] = 'nab-without-login-account';
	}

	return $classes;
}
add_filter( 'body_class', 'nab_amplify_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function nab_amplify_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 10,
		'columns'        => 4,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'nab_amplify_woocommerce_related_products_args' );


/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'nab_amplify_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function nab_amplify_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main woo_shop_page">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'nab_amplify_woocommerce_wrapper_before' );

/**
 * Replace WooCommerce Product image with the Bynder image.
 *
 * @param $image
 * @param $product
 * @param $size
 * @param $attr
 * @param $placeholder
 *
 * @return string
 */
function nab_amplify_woo_product_get_image( $image, $product, $size, $attr, $placeholder ){
	$featured_image = nab_amplify_get_featured_image( $product->get_id() );

	return  '<img src="'. $featured_image .'" class="attachment-full size-full" alt="" loading="lazy"/>';
}
add_filter( 'woocommerce_product_get_image', 'nab_amplify_woo_product_get_image', 10, 5 );

/**
 * Replace WooCommerce Product image with the Bynder image.
 *
 * @param $sprintf
 * @param $post_id
 *
 * @return string
 */
function nab_amplify_single_product_image_thumbnail_html($sprintf, $post_id ) {

	$featured_image = nab_amplify_get_featured_image( $post_id );

	return  '<div class="woocommerce-product-gallery__image--placeholder"><img src="'. $featured_image .'" class="wp-post-image" /></div>';

	return $sprintf;
}
add_action( 'woocommerce_single_product_image_thumbnail_html', 'nab_amplify_single_product_image_thumbnail_html', 10, 2 );

if ( ! function_exists( 'nab_amplify_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function nab_amplify_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'nab_amplify_woocommerce_wrapper_after' );

if ( ! function_exists( 'nab_amplify_woocommerce_template_loop_product_title' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	function nab_amplify_woocommerce_template_loop_product_title() {
		global $product;
		$product_desc = $product->get_description();

		echo '<div class="top">';
			echo '<h3 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title title' ) ) . '"><a href="'. esc_url(get_the_permalink()).'">' . get_the_title() . '</a></h3>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<strong class="product_desc"><p>' . $product_desc . '</p></strong>';
		echo '</div>';
	}
}
add_action( 'woocommerce_shop_loop_item_title', 'nab_amplify_woocommerce_template_loop_product_title' );

if ( ! function_exists( 'nab_amplify_woocommerce_catalog_ordering' ) ) {

	/**
	 * Output the product sorting options.
	 */
	function nab_amplify_woocommerce_catalog_ordering() {
		if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
			return;
		}
		$show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'menu_order' ) );
		$catalog_orderby_options = apply_filters(
			'woocommerce_catalog_orderby',
			array(
				'menu_order' => __( 'Default sorting', 'woocommerce' ),
				'popularity' => __( 'Sort by popularity', 'woocommerce' ),
				'rating'     => __( 'Sort by average rating', 'woocommerce' ),
				'date'       => __( 'Sort by latest', 'woocommerce' ),
				'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
				'price-desc' => __( 'Sort by price: high to low', 'woocommerce' ),
			)
		);

		$default_orderby = wc_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', '' ) );
		$orderby         = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : $default_orderby; // WPCS: sanitization ok, input var ok, CSRF ok.

		if ( wc_get_loop_prop( 'is_search' ) ) {
			$catalog_orderby_options = array_merge( array( 'relevance' => __( 'Relevance', 'woocommerce' ) ), $catalog_orderby_options );

			unset( $catalog_orderby_options['menu_order'] );
		}

		if ( ! $show_default_orderby ) {
			unset( $catalog_orderby_options['menu_order'] );
		}

		if ( ! wc_review_ratings_enabled() ) {
			unset( $catalog_orderby_options['rating'] );
		}

		if ( ! array_key_exists( $orderby, $catalog_orderby_options ) ) {
			$orderby = current( array_keys( $catalog_orderby_options ) );
		}

		wc_get_template(
			'loop/orderby.php',
			array(
				'catalog_orderby_options' => $catalog_orderby_options,
				'orderby'                 => $orderby,
				'show_default_orderby'    => $show_default_orderby,
			)
		);
	}
}
add_action( 'nab_amplify_woocommerce_before_shop_loop', 'nab_amplify_woocommerce_catalog_ordering', 30 );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'nab_amplify_woocommerce_header_cart' ) ) {
			nab_amplify_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'nab_amplify_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function nab_amplify_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		nab_amplify_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'nab_amplify_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'nab_amplify_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function nab_amplify_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'nab-amplify' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'nab-amplify' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'nab_amplify_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function nab_amplify_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php nab_amplify_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}
