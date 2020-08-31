<?php
/**
 * Template part for displaying page content for my purchases page.
 *
 * @package Amplify
 */
?>
    <p>Under development, coming soon.</p>

    <!--<div class="purchased-content-wrapper">
		<?php
/*		if ( isset( $_GET['valid'] ) && ! empty( $_GET['valid'] ) && 't' === strtolower( $_GET['valid'] ) ) {
			*/?>
            <p class="coupon-valid">Promo code applied successfully. Attached product is accessible and has been added to your purchase content.</p>
			<?php
/*		}
		$current_user = wp_get_current_user();
		$product_ids  = array();
		if ( '' !== $current_user->user_email ) {
			$customer_order_ids = get_posts( array(
				'numberposts' => - 1,
				'fields'      => 'ids',
				'meta_key'    => '_billing_email',
				'meta_value'  => $current_user->user_email,
				'post_type'   => wc_get_order_types(),
				'post_status' => 'wc-completed',
			) );
			if ( is_array( $customer_order_ids ) && count( $customer_order_ids ) > 0 ) {
				foreach ( $customer_order_ids as $customer_order_id ) {
					$order = wc_get_order( $customer_order_id );
					$items = $order->get_items();
					foreach ( $items as $item ) {
						$product_id = $item->get_product_id();
						if ( $product_id ) {
							$product_ids[] = $product_id;
						}
					}
				}
				$product_ids = array_unique( $product_ids );
			}
		}
		if ( is_array( $product_ids ) && count( $product_ids ) > 0 ) {
			$product_ids_regex = '"' . implode( '"|"', $product_ids ) . '"';
			$my_favourite      = get_user_meta( $current_user->ID, 'favourite_white_paper', true );
			$current_site_url  = get_site_url();
			$query_args        = array(
				'post_type'      => 'beitc-proceedings',
				'posts_per_page' => 10,
				'post_status'    => 'publish',
				'meta_key'       => 'wc_pay_per_post_product_ids',
				'meta_value'     => $product_ids_regex,
				'meta_compare'   => 'REGEXP',
			);
			if ( 'yes' === strtolower( '$filter_fav' ) ) {
				$query_args['post__in'] = $my_favourite;
			}
			$purchased_post = new WP_Query( $query_args );
			*/?>
            <div class="purchased-content-head">
                <h2>My Purchased Content</h2>
                <a href="javascript:void(0);" class="my-fav fusion-button fusion-button-purple fusion-button-small">My Favorites</a>
            </div>
            <section class="wp-listing-block wp-listing-search my-purchased-content">
                <div class="loader-bx">Loading content – Please wait...</div>
                <section id="content" class="bundle-wp-lists">
                    <div class="all-white-papers">
                        <form method="POST" action="" class="wcbd-zip-form">
                            <div class="download-all">
                                <input type="submit" name="submit" value="DOWNLOAD ALL SELECTED FILES (.ZIP)" id="wcbd_zip_button" disabled="disabled"/>
                                <input type="hidden" name="create-zip" value="1"/>
                                <input type="checkbox" id="wcbd_select_all" class="wcbd_checkbox"/>
                                <label for="wcbd_select_all">Select All</label>
                            </div>
							<?php
/*							$bundle_args    = array(
								'post_type'      => 'product',
								'posts_per_page' => 1,
								'fields'         => 'ids',
								'tax_query'      => array(
									'relation' => 'AND',
									array(
										'taxonomy' => 'product_type',
										'field'    => 'slug',
										'terms'    => array( 'woosb' ),
									),
									array(
										'taxonomy' => 'product_cat',
										'field'    => 'slug',
										'terms'    => date( 'Y' ),
									),
								),
							);
							$bundle_product = new WP_Query( $bundle_args );
							if ( $bundle_product->have_posts() ) {
								$bundle_product_id = $bundle_product->posts;
								if ( is_array( $bundle_product_id ) && count( $bundle_product_id ) > 0 ) {
									if ( wc_customer_bought_product( $current_user->user_email, $current_user->ID, $bundle_product_id[0] ) ) {
										$bundle_inc_product_ids = get_post_meta( $bundle_product_id[0], 'woosb_ids', true );
										if ( ! empty( $bundle_inc_product_ids ) ) {
											$bundle_inc_product_ids = $bundle_product_id[0] . ',' . str_replace( '/1', '', $bundle_inc_product_ids );
											global $wpdb;
											$table_name             = $wpdb->prefix . 'woocommerce_downloadable_product_permissions';
											$get_product_permission = $wpdb->prepare( "SELECT product_id, download_id FROM $table_name WHERE user_id = %d AND downloads_remaining != '' AND downloads_remaining != '0'  AND product_id IN ($bundle_inc_product_ids) ORDER BY permission_id DESC", $current_user->ID );
											$all_downloads          = $wpdb->get_results( $get_product_permission );
											if ( $all_downloads ) {
												*/?>
                                                <div class="zip-bundle-download">
                                                    <input type="submit" class="zip-bundle-download-btn" name="submit" value="DOWNLOAD ALL <?php /*echo date( 'Y' ); */?> BEIT Conference PROCEEDINGS FILES (.ZIP)" id="bundle_zip_button"/>
													<?php
/*													$temp_product_array = array();
													foreach ( $all_downloads as $download ) {
														if ( ! in_array( $download->product_id, $temp_product_array ) ) {
															$temp_product_array[] = $download->product_id;
															*/?>
                                                            <input style="display:none;" type="checkbox" name="dwn-<?php /*echo esc_attr( $download->download_id ); */?>" value="yes" class="bundle_checkbox">
															<?php
/*														}
													}
													*/?>
                                                </div>
												<?php
/*											}
										}
									}
								}
							}
							*/?>
                            <div class="white-paper-product-list">
                                <div class="wp-info">
									<?php
/*									if ( $purchased_post->have_posts() ) {
										while ( $purchased_post->have_posts() ) {
											$purchased_post->the_post();
											$current_post_id      = get_the_ID();
											$current_post_title   = get_the_title();
											$current_post_link    = get_the_permalink();
											$current_post_product = get_post_meta( $current_post_id, 'wc_pay_per_post_product_ids', true );
											$download_link        = 'javascript:void(0);';
											$download_remaining   = '';
											if ( ! empty( $current_post_product ) && is_array( $current_post_product ) ) {
												$file_info               = nabpilot_get_product_download_link( $current_post_product[0], $current_user->ID, $current_site_url );
												$download_link           = $file_info['link'];
												$download_key_components = parse_url( $download_link );
												if ( isset( $download_key_components['query'] ) ) {
													parse_str( $download_key_components['query'], $download_key );
												}
												$download_remaining = '(' . $file_info['download_remaining'] . ' Remaining )';
											}
											$full_abstract      = get_the_excerpt();
											$small_abstract     = substr( $full_abstract, 0, 250 );
											$remaining_abstract = str_replace( $small_abstract, '', $full_abstract );
											$star_class         = is_array( $my_favourite ) && in_array( $current_post_id, $my_favourite ) ? 'fa fa-star' : 'far fa-star';
											*/?>
                                            <div class="wp-summary">
                                                <h4>
                                                    <a href="<?php /*echo esc_url( $current_post_link ); */?>"><?php /*echo esc_html( $current_post_title ); */?></a>
                                                    <span class="starred" data-post="<?php /*echo esc_attr( $current_post_id ); */?>"><i class="<?php /*echo esc_attr( $star_class ); */?>"></i></span>
                                                </h4>
                                                <div class="wp-info-date">Date: <span><?php /*echo esc_html( get_the_date() ); */?></span></div>
                                                <div class="author-name">
													<?php
/*													if ( nabpilot_get_white_paper_author_count() > 1 ) {
														*/?>
                                                        <span>Author Names: </span>
														<?php
/*													} else {
														*/?>
                                                        <span>Author Name: </span>
														<?php
/*													}
													*/?>
                                                    <ul class="author-list">
														<?php /*nabpilot_get_white_paper_author( get_the_date( "Y" ) ); */?>
                                                    </ul>
                                                </div>
                                                <p><b>Abstract:</b>
													<?php
/*													echo esc_html( $small_abstract );
													if ( strlen( $full_abstract ) > 250 ) {
														*/?>
                                                        <i class="more-three-dots">...</i>
                                                        <span class="more-text" style="display:none;"><?php /*echo esc_html( $remaining_abstract ); */?></span>
                                                        <span class="expand-arrow"><i class="fa fa-caret-down"></i></span>
														<?php
/*													}
													*/?>
                                                </p>
                                                <div class="wp-last">
                                                    <div class="wp-out">
                                                        <ul>
                                                            <li><a href="<?php /*echo esc_url( $current_post_link ); */?>">View Online<i class="fa fa-newspaper"></i></a></li>
                                                            <input type="checkbox" name="dwn-<?php /*echo esc_attr( $download_key['key'] ? $download_key['key'] : '' ); */?>" value="yes" class="wcbd_checkbox">
                                                            <li><a href="<?php /*echo esc_attr( $download_link ); */?>">Download PDF <label class="remain-class"><?php /*echo esc_html( $download_remaining ); */?></label><span class="rounded"><i class="fa fa-arrow-down"></i></span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
											<?php
/*										}
									}
									*/?>
                                </div>
                            </div>
                        </form>
                    </div>
                    <span class="load-more-wps">
						<div class="loader">
							<svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
								<path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
									s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
									c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"></path>
								<path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
									C22.32,8.481,24.301,9.057,26.013,10.047z" transform="rotate(259.758 20 20)">
								<animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="0.5s" repeatCount="indefinite"></animateTransform>
								</path>
							</svg>
						</div>
						<input type="hidden" name="total_page" class="total-pages" value="<?php /*echo esc_attr( $purchased_post->max_num_pages ); */?>">
						<input type="hidden" name="purchased_posts" class="purchased-posts" value="<?php /*echo esc_attr( $product_ids_regex ); */?>">
						<?php
/*						if ( $purchased_post->max_num_pages > 1 ) {
							*/?>
                            <button class="wp-btns fusion-button fusion-button-small fusion-button-purple load-more" data-page-number="2">Load More</button>
							<?php
/*						}
						*/?>
				</span>
                </section>
            </section>
			<?php
/*		} else {
			*/?>
            <div class="purchased-content-head">
                <h2>My Purchased Content</h2>
            </div>
            <div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
                <a class="woocommerce-Button button" href="<?php /*echo esc_url( get_site_url() . '/beitc-proceedings/' ); */?>"> Browse content</a>
                Purchased content not found.
            </div>
			<?php
/*		}
		*/?>
    </div>-->

<?php
