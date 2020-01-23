<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$listing_page       = isset( $attributes['listingPage'] ) ? $attributes['listingPage'] : false;
$layout             = isset( $attributes['layout'] ) && ! empty( $attributes['layout'] ) ? $attributes['layout'] : 'without-title';
$block_post_type    = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'sponsors';
$destination_type   = isset( $attributes['destinationType'] ) && 'select type' !== $attributes['destinationType'] ? $attributes['destinationType'] : '';
$taxonomies         = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array();
$terms              = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'] ): array();
$posts_per_page     = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
$slider_active      = isset( $attributes['sliderActive'] ) ? $attributes['sliderActive'] : true;
$min_slides         = isset( $attributes['minSlides'] ) ? $attributes['minSlides'] : 4;
$slide_width        = isset( $attributes['slideWidth'] ) ? $attributes['slideWidth'] : 400;
$autoplay           = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
$infinite_loop      = isset( $attributes['infiniteLoop'] ) ? $attributes['infiniteLoop'] : true;
$pager              = isset( $attributes['pager'] ) ? $attributes['pager'] : false;
$controls           = isset( $attributes['controls'] ) ? $attributes['controls'] : false;
$slider_speed       = isset( $attributes['sliderSpeed'] ) ? $attributes['sliderSpeed'] : 500;
$slider_margin      = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
$arrow_icons        = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';
$order_by           = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
$custom_order       = isset( $attributes['customOrder'] ) ? $attributes['customOrder'] : false;
$custom_order_ids   = isset( $attributes['customOrderIds'] ) && ! empty( $attributes['customOrderIds'] ) ? explode( ',', str_replace( ' ', '', $attributes['customOrderIds'] ) ) : array();
$sponsor_order      = 'date' === $order_by ? 'DESC' : 'ASC';
$class_name         = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';

$query_args = array(
	'post_type'      => $block_post_type,
	'meta_key'       => '_thumbnail_id',
);

if ( $custom_order && is_array( $custom_order_ids ) && count( $custom_order_ids ) > 0 ) {

	$query_args['posts_per_page']       = $posts_per_page;
	$query_args['post__in']             = $custom_order_ids;
	$query_args['ignore_sticky_posts']  = true;
	$query_args['orderby']              = 'post__in';

} elseif ( 'rand' === $order_by ) {

	$query_args['posts_per_page']       = 100;
	$query_args['fields']               = 'ids';
	$query_args['no_found_rows']        = true;
	$query_args['ignore_sticky_posts']  = true;

} else {

	$query_args['posts_per_page']       = $posts_per_page;
	$query_args['orderby']              = $order_by;
	$query_args['order']                = $sponsor_order;
}

$tax_query_args = $this->mysgb_get_tax_query_argument( $taxonomies, $terms );

if ( count( $tax_query_args ) > 1 ) {
	$query_args[ 'tax_query' ] = $tax_query_args;
}

if ( ! empty( $destination_type ) ) {
	$query_args[ 'meta_query' ] = array(
		array(
			'key'		=> 'destination_type_$_destination',
			'compare'	=> '=',
			'value'		=> $destination_type,
		)
	);
}

$query = new WP_Query($query_args);

if ( ! $custom_order ) {

	if ( 'rand' === $order_by && $query->have_posts() ) {
		$post_ids = $query->posts;
		shuffle( $post_ids );
		$post_ids = array_splice( $post_ids, 0, $posts_per_page );
		$query    = new WP_Query( array( 'post_type' => $block_post_type, 'post__in' => $post_ids, 'posts_per_page' =>  count( $post_ids ), 'orderby' => 'post__in' ) );
	}
}


if ( $query->have_posts() ) {

	if ( $listing_page ) {
		include( plugin_dir_path( __FILE__ ) . 'filters/html-mysgb-sponsor-filter.php' );
	}
	?>
	<div class="slider-arrow-main <?php echo esc_attr( $arrow_icons ); ?> <?php echo esc_attr( $class_name ); ?>">
		<?php
		if ( $slider_active ) {
			?>
			<div class="nab-dynamic-slider items-md nab-box-slider sponsors" data-minslides="<?php echo esc_attr( $min_slides );?>" data-slidewidth="<?php echo esc_attr( $slide_width );?>" data-auto="<?php echo esc_attr( $autoplay );?>" data-infinite="<?php echo esc_attr( $infinite_loop );?>" data-pager="<?php echo esc_attr( $pager );?>" data-controls="<?php echo esc_attr( $controls );?>" data-speed="<?php echo esc_attr( $slider_speed );?>" data-slidemargin="<?php echo esc_attr( $slider_margin );?>">
			<?php
		} else {
			?>
			<ul class="partner-listing <?php echo esc_attr( $layout ); ?>" id="sponsors-partners-list">
				<?php
				}
				while ( $query->have_posts() ) {

					$query->the_post();

					$thumbnail_url          = get_the_post_thumbnail_url();
					$partners_sponsors_link = get_field( 'partners_sponsors_link',  get_the_ID() );

					if ( $slider_active ) {
						?>
						<div class="item">
							<?php
							if ( ! empty( $partners_sponsors_link ) ) {
								?>
								<a href="<?php echo esc_url( $partners_sponsors_link ); ?>" target="_blank">
								<?php
							}
							?>

							<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="sponsor-logo" />

							<?php
							if ( ! empty( $partners_sponsors_link ) ) {
								?>
								</a>
								<?php
							}

							if ( 'with-title' === $layout ) {

								$sponsor_type = $this->mysgb_get_sponsor_type( $destination_type, get_the_ID() );

								?>
								<div class="sponsor-info-box">
									<span class="title-type"><?php echo esc_html( $sponsor_type ); ?></span>
								</div>
								<?php
							}
							?>
						</div>
						<?php
					} else {
						if ( $listing_page ) {
							$featured_post  = has_term( 'featured', 'sponsor-categories' ) ? 'featured' : '';
							?>
							<li class="<?php echo esc_attr( $featured_post ); ?>" data-title="<?php echo esc_attr( strtolower( get_the_title() ) ); ?>" data-featured="<?php echo esc_attr( $featured_post ); ?>">
							<?php
						} else {
							?>
							<li>
							<?php
						}
					if ( 'with-info' === $layout ) {
						?>
						<div class="partner-inner">
						<?php
					}
						?>
						<figure class="partner-img-box">
							<?php
							if ( ! empty( $partners_sponsors_link ) ) {
							?>
							<a href="<?php echo esc_url( $partners_sponsors_link ); ?>" target="_blank">
								<?php
								}
								?>
								<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="sponsor-logo">
								<?php
								if ( ! empty( $partners_sponsors_link ) ) {
								?>
							</a>
						<?php
						}
						?>
						</figure>

						<?php
						if ( 'with-title' === $layout || 'with-info' === $layout ) {

							$sponsor_type = $this->mysgb_get_sponsor_type( $destination_type, get_the_ID() );

							?>
							<span><?php echo esc_html( $sponsor_type ); ?></span>
							<?php
						}

					if ( 'with-info' === $layout ) {
						?>
						<p><?php echo esc_html( get_the_excerpt() ); ?></p>
						<a href="<?php echo esc_url( $partners_sponsors_link ); ?>" target="_blank">Learn More</a>
						</div>
						<?php
					}
						?>
						</li>
						<?php
					}
				}
				if ( $slider_active ) {
				?>
		</div>
	<?php
	} else {
		?>
		</ul>
		<?php
	}
	if ( $listing_page ) {
		?>
		<p class="no-data display-none">Result not found.</p>
		<?php
	}
	?>
	</div>
	<?php
} else {
	?>
	<p>No posts found.</p>
	<?php
}

wp_reset_postdata();
