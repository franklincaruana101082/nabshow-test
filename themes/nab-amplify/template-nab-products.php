<?php
/**
 * Template Name: Content Products
 *
 * @package Amplify
 */

get_header();

?>
    <main id="primary" class="site-main php_template_nab_products">
        <div class="nab-search-result-wrapper">
			<?php
			$product_args = array(
				'post_type'      => 'nab-products',
				'post_status'    => 'publish',
				'posts_per_page' => 12,
				'order'          => 'DESC'
			);

			$product_query = new WP_Query( $product_args );

			if ( $product_query->have_posts() ) {

				$total_products = $product_query->found_posts;

				?>
                <div class="search-view-top-head">
                    <h2><span class="product-search-count"><?php echo esc_html( $total_products ); ?> Results for </span><strong>PRODUCTS</strong></h2>
                    <p class="view-top-other-info">Are you looking for something on the NAB Show? <a href="#">Click Here</a></p>
                </div>
                <div class="search-section search-product-section">
                    <div class="search-section-details" id="search-product-list">
						<?php

						$cnt = 1;

						while ( $product_query->have_posts() ) {

							$product_query->the_post();

							$thumbnail_url = has_post_thumbnail() ? get_the_post_thumbnail_url() : nab_placeholder_img();
							$product_link  = get_the_permalink();
							?>
                            <div class="search-item">
                                <div class="search-item-inner">
                                    <div class="search-item-cover">
                                        <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="product thumbnail"/>
										<?php nab_get_product_bookmark_html( get_the_ID(), 'user-bookmark-action' ); ?>
                                    </div>
                                    <div class="search-item-info">
                                        <div class="search-item-content">
                                            <h4><a href="<?php echo esc_url( $product_link ); ?>"><?php echo esc_html( get_the_title() ); ?></a></h4>
                                            <div class="search-actions">
                                                <a href="<?php echo esc_url( $product_link ); ?>" class="button">View Product</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<?php

							if ( 8 === $cnt ) {
								echo wp_kses_post( nab_get_search_result_ad() );
							}

							$cnt ++;
						}
						if ( $cnt < 8 ) {
							echo wp_kses_post( nab_get_search_result_ad() );
						}
						?>
                    </div>
                </div>
				<?php
			}
			?>
            <p class="no-search-data" style="display: none;">Result not found.</p>
			<?php
			if ( $product_query->max_num_pages > 1 ) {
				?>
                <div class="load-more text-center" id="load-more-product">
                    <a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="12" data-total-page="<?php echo absint( $product_query->max_num_pages ); ?>">Load More</a>
                </div>
				<?php
			}

			wp_reset_postdata();
			?>
        </div>
    </main>
<?php
get_footer();
