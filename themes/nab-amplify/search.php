<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Amplify
 */

get_header();

$search_term 		= get_search_query();
$current_site_url	= get_site_url();
$view_type			= filter_input( INPUT_GET, 'v', FILTER_SANITIZE_STRING );
$view_screen		= array( 'user', 'shop' );
?>
	<main id="primary" class="site-main">
		<div class="nab-search-result-wrapper">
			<div class="search-result-filter">
				<div class="search-box">
					<?php get_search_form(); ?>
				</div>
				<?php
				if ( isset( $view_type ) && ! empty( $view_type ) && in_array( $view_type, $view_screen, true ) ) {
					?>
					<div class="other-search-filter">
						<?php
						if ( 'shop' === $view_type ) {
							?>
							<div class="sort-product sort-order-btn">
								<a href="javascript:void(0);" class="sort-order button active" data-order='popularity'>Popularity</a>
								<a href="javascript:void(0);" class="sort-order button" data-order='relevance'>Relevancy</a>
								<a href="javascript:void(0);" class="sort-order button" data-order='title'>Alphabetical</a>
							</div>
							<div class="filter-select-boxes">
								<?php

								$product_categories = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => true ) );

								if ( is_array( $product_categories ) && ! is_wp_error( $product_categories ) && count( $product_categories ) > 0 ) {
									?>
									<div class="nab-custom-select">
										<select id="product-category" class="product-category">
											<option value="">Type</option>
											<?php
											foreach ( $product_categories as $current_cat ) {
												?>
												<option value="<?php echo esc_attr( $current_cat->slug ); ?>"><?php echo esc_html( $current_cat->name ); ?></option>
												<?php
											}
											?>
										</select>
									</div>
									<?php
								}
								?>
							</div>
							<?php
						} else if ( 'user' === $view_type ) {
							?>
							<div class="sort-user sort-order-btn">
								<a href="javascript:void(0);" class="sort-order button active" data-order='newest'>Newest</a>
								<a href="javascript:void(0);" class="sort-order button" data-order='alphabetical'>Alphabetical</a>
							</div>
							<div class="filter-select-boxes">
								<div class="company-search">
									<input type="text" class="input-company" placeholder="Company" />
								</div>
								<?php
								if ( is_user_logged_in() ) {
									?>
									<div class="nab-custom-select">
										<select id="people-connect" class="people-connect">
											<option value="">All People</option>
											<option value="yes">Connections</option>
											<option value="no">Available to Connect</option>
										</select>
									</div>
									<?php
								}
								?>
							</div>
							<?php
						}
						?>
						<div class="view-back-to-search">
							<?php
							$back_to_search_link = add_query_arg( array( 's' => $search_term ), $current_site_url );
							?>
							<a href="<?php echo esc_url( $back_to_search_link ); ?>">Back to All Results</a>
						</div>
					</div>
					<?php
				} else {
					echo wp_kses_post( nab_get_search_result_ad() );
				}
				?>
			</div>

			<?php
			if ( isset( $view_type ) && ! empty( $view_type ) && in_array( $view_type, $view_screen, true ) ) {

				if ( 'user' === $view_type ) {

					$members_filter = array(
						'page' 		=> 1,
						'per_page' 	=> 12,
						'type'		=> 'newest'
					);


					if ( bp_has_members( $members_filter ) ) {

						global $members_template;

						$total_users	= $members_template->total_member_count;
						$total_page		= ceil( $total_users / 12 );
						?>
						<div class="search-view-top-head">
							<h2><span class="user-search-count"><?php echo esc_html( $total_users ); ?> Results for </span><strong>PEOPLE</strong></h2>
							<p class="view-top-other-info">Are you looking for something on the NAB Show? <a href="#">Click Here</a></p>
						</div>

						<div class="search-section search-user-section">
							<div class="search-section-details" id="search-user-list">
								<?php
								$cnt 			= 1;
								while ( bp_members() ) {

									bp_the_member();

									$member_user_id = bp_get_member_user_id();

									$user_full_name = get_the_author_meta( 'first_name', $member_user_id ) . ' ' . get_the_author_meta( 'last_name', $member_user_id );

									if ( empty( trim( $user_full_name ) ) ) {

										$user_full_name = bp_get_member_name();
									}

									$company = get_user_meta( $member_user_id, 'attendee_company', true );
									$ctitle = get_user_meta( $member_user_id, 'attendee_title', true );
									$company = $ctitle ? $ctitle . ' | ' . $company : $company;

									$user_images = nab_amplify_get_user_images( $member_user_id );
									?>
									<div class="search-item">
										<div class="search-item-inner">
											<div class="search-item-cover">
												<img src="<?php echo esc_url( $user_images['banner_image'] ); ?>" alt="Cover Image">
											</div>
											<div class="search-item-info">
												<div class="search-item-avtar">
													<a href="<?php bp_member_permalink(); ?>">
                                                    	<img src="<?php echo esc_url( $user_images['profile_picture'] ); ?>">
													</a>
												</div>
												<div class="search-item-content">
													<h4>
														<a href="<?php bp_member_permalink(); ?>"><?php echo esc_html( $user_full_name ); ?></a>
													</h4>
													<span class="company-name"><?php echo esc_html( $company ); ?></span>
													<?php
													echo nab_amplify_bp_get_friendship_button( $member_user_id );
													?>
												</div>
											</div>
										</div>
									</div>
									<?php
									if ( 8 === $cnt ) {
										echo wp_kses_post( nab_get_search_result_ad() );
									}

									$cnt++;
								}
								if ( $cnt < 8 ) {
									echo wp_kses_post( nab_get_search_result_ad() );
								}
								?>
							</div>
						</div>
						<p class="no-search-data" style="display: none;">Result not found.</p>
						<?php
						if ( $total_page > 1 ) {
							?>
							<div class="load-more"  id="load-more-user">
								<a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="12" data-total-page="<?php echo absint( $total_page ); ?>">Load More</a>
							</div>
							<?php
						}
					}

				} else if ( 'shop' === $view_type ) {

					$product_args = array(
						'post_type' 		=> 'product',
						'post_status'		=> 'publish',
						'posts_per_page' 	=> 12,
						's'					=> $search_term,
						'meta_key'  		=> 'total_sales',
						'orderby'   		=> 'meta_value_num',
						'order' 			=> 'DESC'
					);

					$product_query = new WP_Query( $product_args );

					if ( $product_query->have_posts() ) {

						$total_products = $product_query->found_posts;

						?>
						<div class="search-view-top-head">
							<h2><span class="product-search-count"><?php echo esc_html( $total_products ); ?> Results for </span><strong>SHOP</strong></h2>
							<p class="view-top-other-info">Are you looking for something on the NAB Show? <a href="#">Click Here</a></p>
						</div>
						<div class="search-section search-product-section">
							<div class="search-section-details" id="search-product-list">
								<?php

								$cnt = 1;

								while ( $product_query->have_posts() ) {

									$product_query->the_post();

									$thumbnail_url 	= has_post_thumbnail() ? get_the_post_thumbnail_url() : nab_placeholder_img();
									$product_link	= get_the_permalink();
									?>
									<div class="search-item">
										<div class="search-item-inner">
											<div class="search-item-cover">
												<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="product thumbnail" />
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

									$cnt++;
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
						<div class="load-more text-center"  id="load-more-product">
							<a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="12" data-total-page="<?php echo absint( $product_query->max_num_pages ); ?>">Load More</a>
						</div>
						<?php
					}

					wp_reset_postdata();

				}

			} else {

				$search_found = false;

				$members_filter = array(
					'page' 		=> 1,
					'per_page' 	=> 4,
					'type'		=> 'newest'
				);

				if ( bp_has_members( $members_filter ) ) {

					global $members_template;

					$search_found	= true;
					$total_users	= $members_template->total_member_count;
					?>
					<div class="search-section search-user-section">
						<div class="search-section-heading">
							<h2><strong>PEOPLE</strong> <span>(<?php echo esc_html( $total_users . ' RESULTS' ); ?>)</span></h2>
							<?php
							if ( $total_users > 4 ) {

								$user_view_more_link = add_query_arg( array( 's' => $search_term, 'v' => 'user' ), $current_site_url );

								?>
								<div class="section-view-more">
									<a href="<?php echo esc_html( $user_view_more_link ); ?>" class="view-more-link">View All</a>
								</div>
								<?php
							}
							?>
						</div>
						<div class="search-section-details" id="search-user-list">
							<?php

							$default_cover = get_template_directory_uri() . '/assets/images/search-box-cover.png';

							while ( bp_members() ) {

								bp_the_member();

								$member_user_id = bp_get_member_user_id();

								$user_full_name = get_the_author_meta( 'first_name', $member_user_id ) . ' ' . get_the_author_meta( 'last_name', $member_user_id );

								if ( empty( trim( $user_full_name ) ) ) {

									$user_full_name = bp_get_member_name();
								}

								$company = get_user_meta( $member_user_id, 'attendee_company', true );
								$ctitle = get_user_meta( $member_user_id, 'attendee_title', true );
								$company = $ctitle ? $ctitle . ' | ' . $company : $company;

								$user_images 	= nab_amplify_get_user_images( $member_user_id );

								?>
								<div class="search-item">
									<div class="search-item-inner">
										<div class="search-item-cover">
											<img src="<?php echo esc_url( $user_images[ 'banner_image' ] ); ?>" alt="Cover Image">
										</div>
										<div class="search-item-info">
											<div class="search-item-avtar">
												<a href="<?php bp_member_permalink(); ?>">
													<img src="<?php echo esc_url( $user_images[ 'profile_picture' ] ); ?>">
												</a>
											</div>
											<div class="search-item-content">
												<h4>
													<a href="<?php bp_member_permalink(); ?>"><?php echo esc_html( $user_full_name ); ?></a>
												</h4>
												<span class="company-name"><?php echo esc_html( $company ); ?></span>
												<?php
												echo nab_amplify_bp_get_friendship_button( $member_user_id );
												?>
											</div>
										</div>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
					<?php
				}

				$product_args = array(
					'post_type' 		=> 'product',
					'posts_per_page' 	=> 4,
					's'					=> $search_term,
					'meta_key'  		=> 'total_sales',
					'orderby'   		=> 'meta_value_num',
					'order' 			=> 'DESC'
				);

				$product_query = new WP_Query( $product_args );

				if ( $product_query->have_posts() ) {

					$search_found	= true;
					$total_products = $product_query->found_posts;
					?>
					<div class="search-section search-product-section">
						<div class="search-section-heading">
							<h2><strong>SHOP</strong> <span>(<?php echo esc_html( $total_products . ' RESULTS' ); ?>)</span></h2>
							<?php
							if ( $total_products > 4 ) {

								$poroduct_view_more_link = add_query_arg( array( 's' => $search_term, 'v' => 'shop' ), $current_site_url );

								?>
								<div class="section-view-more">
									<a href="<?php echo esc_html( $poroduct_view_more_link ); ?>" class="view-more-link">View All</a>
								</div>
								<?php
							}
							?>
						</div>
						<div class="search-section-details" id="search-product-list">
							<?php
							while ( $product_query->have_posts() ) {

								$product_query->the_post();

								$thumbnail_url 	= has_post_thumbnail() ? get_the_post_thumbnail_url() : nab_placeholder_img();
								$product_link	= get_the_permalink();
								?>
								<div class="search-item">
									<div class="search-item-inner">
										<div class="search-item-cover">
											<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="product thumbnail" />
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
							}
							?>
						</div>
					</div>
					<?php
				}
				wp_reset_postdata();

				if ( ! $search_found ) {
					?>
					<div class="search-not-found">
						<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'nab-amplify' ); ?></p>
					</div>
					<?php
				}
			}
			?>
		</div>
	</main>
<?php
get_footer();
