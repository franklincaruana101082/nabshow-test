<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$show_filter        = isset( $attributes['showFilter'] ) ? $attributes['showFilter'] : false;
$block_post_type    = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'not-to-be-missed';
$taxonomies         = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array('featured-category');
$terms              = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'], true ): array();
$posts_per_page     = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
$order_by           = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
$product_order      = 'date' === $order_by ? 'DESC' : 'ASC';
$class_name         = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';

if ( $show_filter ) {

	require_once( plugin_dir_path( __FILE__ ) . 'filters/html-mysgb-product-winner-filter.php' );
}

foreach ( $taxonomies as $current_taxonomy ) {

	if ( count( array_filter( ( array_values( $terms ) ) ) ) > 0 && count( $terms[ $current_taxonomy ] ) > 0 ) {

		$final_terms = array();
		$cnt         = 0;

		foreach ( $terms[ $current_taxonomy ] as $current_term ) {

			$final_terms[ $cnt ]       = new stdClass();
			$final_terms[ $cnt ]->slug = $current_term[ 'value' ];
			$final_terms[ $cnt ]->name = $current_term[ 'label' ];

			$cnt++;
		}

	} else {
		$final_terms = get_terms( $current_taxonomy, array( 'hide_empty' => 0 ) );
	}

	foreach ( $final_terms as $current_term ) {

		$args = array( 'post_type' => $block_post_type, $current_taxonomy => $current_term->slug, 'posts_per_page' => $posts_per_page, 'orderby' => $order_by, 'order' => $product_order );
		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			?>
			<div class="products-winners <?php echo esc_attr( $class_name ); ?>">
				<h2 class="product-title"><?php echo esc_html( $current_term->name ); ?></h2>
				<div class="product-main">
					<?php
					while ( $query->have_posts() ) {
						$query->the_post();
						?>
						<div class="product-item">
							<div class="product-inner">
								<?php
								if ( has_post_thumbnail() ) {
									?>
									<div class="media-img">
										<img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" class="img" alt="<?php echo esc_attr( get_the_title() ); ?>">
									</div>
									<?php
								}
								?>
								<h3 class="title">
									<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
								</h3>
								<span class="subtitle">Company Name</span>
								<p class="content"><?php echo esc_html( get_the_excerpt() ); ?></p>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<?php
		}
		wp_reset_postdata();
	}
}