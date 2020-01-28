<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$posts_per_page = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
$layout_type    = isset( $attributes['layoutType'] ) && ! empty( $attributes['layoutType'] ) ? $attributes['layoutType'] : 'listing';
$show_filter    = isset( $attributes['showFilter'] ) ? $attributes['showFilter'] : false;
$class_name     = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';

$parent_terms = get_terms( array(
	'taxonomy' => 'exhibitor-categories',
	'parent'   => 0,
	'hide_empty' => false
) );


if ( is_array( $parent_terms ) && ! is_wp_error( $parent_terms ) && count( $parent_terms ) > 0 ) {

    $term_counter   = 1;
	$site_url       = get_site_url();

	if ( $show_filter ) {
		include( plugin_dir_path( __FILE__ ) . 'filters/html-mysgb-product-categories-filter.php' );
    }
    ?>
	<div class="category-listing-main <?php echo esc_attr( $class_name ); ?>">
		<?php
		if ( 'parent-img-list' === $layout_type ) {
		?>
		<ul class="parent-category-listing">
			<?php
			}

			foreach ( $parent_terms as $parent_term ) {

				$child_terms = get_terms( array(
					'taxonomy' => 'exhibitor-categories',
					'parent'   => $parent_term->term_id,
					'hide_empty' => false
				) );

				if ( is_array( $child_terms ) && ! is_wp_error( $child_terms ) && count( $child_terms ) > 0 ) {

					if ( 'parent-img-list' === $layout_type ) {

						$mys_cat_link   = $site_url . '/explore/exhibits/browse-exhibitors/?exhibitor-cat='. $parent_term->slug;
						$image_id       = get_term_meta( $parent_term->term_id, 'tax-image-id', true );
						$image_url      = ! empty( $image_id ) ? wp_get_attachment_url( $image_id ) : nabshow_lv_get_empty_thumbnail_url();
						?>
						<li>
							<a href="<?php echo esc_url( $mys_cat_link ); ?>"><img src="<?php echo esc_url( $image_url ); ?>" alt="category-logo" /></a>
						</li>
						<?php
					} else {

						$listing_class = $layout_type;

						if ( 'accordion-list' === $layout_type ) {
							$listing_class .= 1 === $term_counter ? ' open' : ' close';
						}
						?>
						<div class="category-listing <?php echo esc_attr( $listing_class ); ?>">
							<div class="category-head">
								<h2 class="category-title"><?php echo esc_html( $parent_term->name ); ?></h2>
							</div>
							<div class="category-body">
								<ul>
									<?php
									foreach ( $child_terms as $child_term ) {

										$mys_cat_link   = $site_url . '/explore/exhibits/browse-exhibitors/?exhibitor-cat='. $child_term->slug;
										?>
										<li>
											<a href="<?php echo esc_url( $mys_cat_link ); ?>">
												<?php
												if ( 'accordion-list' === $layout_type ) {
													echo esc_html( $child_term->name );
												} else {
													$image_id = get_term_meta( $child_term->term_id, 'tax-image-id', true );
													if ( ! empty( $image_id ) ) {
														$image_url = wp_get_attachment_url( $image_id );
													} else {
														$image_url = nabshow_lv_get_empty_thumbnail_url();
													}
													?>
													<img src="<?php echo esc_url( $image_url ); ?>" alt="category-logo" data-title="<?php echo esc_attr( strtolower( $child_term->name ) ); ?>">
													<?php
												}
												?>
											</a>
										</li>
										<?php
									}
									?>
								</ul>
							</div>
						</div>
						<?php
					}
					if ( $posts_per_page <= $term_counter ) {
						break;
					}
					$term_counter++;
				}
			}

			if ( 'listing' === $layout_type ) {
				?>
				<p class="no-data display-none">Result not found.</p>
				<?php
			} elseif ( 'parent-img-list' === $layout_type ) {
			?>
		</ul>
	<?php
	}
	?>
	</div>
	<?php
} else {
	?>
	<p class="coming-soon">Coming soon.</p>
	<?php
}
