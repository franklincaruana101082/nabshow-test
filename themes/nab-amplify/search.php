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
$view_type			= filter_input(INPUT_GET, 'v', FILTER_SANITIZE_STRING);
$view_screen		= array('user', 'shop', 'content', 'product', 'company');
$allowed_tags 		= wp_kses_allowed_html('post');

$allowed_tags['broadstreet-zone'] = array('zone-id' => 1);
?>
<main id="primary" class="site-main">
	<div class="nab-search-result-wrapper">
		<div class="search-result-filter">
			<div class="search-box">
				<?php get_search_form(); ?>
			</div>
			<?php
			if (isset($view_type) && !empty($view_type) && in_array($view_type, $view_screen, true)) {
			?>
				<div class="other-search-filter">
					<?php
					if ('shop' === $view_type) {
					?>
						<div class="sort-product sort-order-btn">
							<a href="javascript:void(0);" class="sort-order button active" data-order='popularity'>Popularity</a>
							<a href="javascript:void(0);" class="sort-order button" data-order='relevance'>Relevancy</a>
							<a href="javascript:void(0);" class="sort-order button" data-order='title'>Alphabetical</a>
						</div>
						<div class="filter-select-boxes">
							<?php

							$product_categories = get_terms(array('taxonomy' => 'product_cat', 'hide_empty' => true));

							if (is_array($product_categories) && !is_wp_error($product_categories) && count($product_categories) > 0) {
							?>
								<div class="nab-custom-select">
									<select id="product-category" class="product-category">
										<option value="">Type</option>
										<?php
										foreach ($product_categories as $current_cat) {
										?>
											<option value="<?php echo esc_attr($current_cat->slug); ?>"><?php echo esc_html($current_cat->name); ?></option>
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
					} else if ('company' === $view_type) {
					?>
						<div class="sort-company sort-order-btn">
							<a href="javascript:void(0);" class="sort-order button active" data-order='date'>Newest</a>
							<a href="javascript:void(0);" class="sort-order button" data-order='title'>Alphabetical</a>
						</div>
					<?php
					} else if ('product' === $view_type) {
					?>
						<div class="sort-company-product sort-order-btn">
							<a href="javascript:void(0);" class="sort-order button active" data-order='date'>Newest</a>
							<a href="javascript:void(0);" class="sort-order button" data-order='title'>Alphabetical</a>
						</div>
					<?php
					} else if ('user' === $view_type) {
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
							if (is_user_logged_in()) {
							?>
								<div class="nab-custom-select">
									<select id="people-connect" class="people-connect">
										<option value="">All People</option>
										<option value="yes">My Connections</option>
										<option value="no">Available to Connect</option>
									</select>
								</div>
							<?php
							}
							?>
						</div>
					<?php
					} else if ('content' === $view_type) {
					?>
						<div class="sort-content sort-order-btn">
							<a href="javascript:void(0);" class="sort-order button active" data-order='date'>Latest</a>
							<a href="javascript:void(0);" class="sort-order button" data-order='relevance'>Relevancy</a>
							<a href="javascript:void(0);" class="sort-order button" data-order='title'>Alphabetical</a>
						</div>
					<?php
					}
					?>
					<div class="view-back-to-search">
						<?php
						$back_to_search_link = add_query_arg(array('s' => $search_term), $current_site_url);
						?>
						<a href="<?php echo esc_url($back_to_search_link); ?>">Back to All Results</a>
					</div>
				</div>
			<?php
			} else {
				echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
			}
			?>
		</div>

		<?php
		if (isset($view_type) && !empty($view_type) && in_array($view_type, $view_screen, true)) {

			if ('user' === $view_type) {

				$members_filter = array(
					'page' 		=> 1,
					'per_page' 	=> 12,
					'type'		=> 'newest'
				);


				if (bp_has_members($members_filter)) {

					global $members_template;

					$total_users	= $members_template->total_member_count;
					$total_page		= ceil($total_users / 12);
		?>
					<div class="search-view-top-head">
						<h2><span class="user-search-count"><?php echo esc_html($total_users); ?> Results for </span><strong>PEOPLE</strong></h2>
						<p class="view-top-other-info">Are you looking for something on the NAB Show? <a href="https://nabshow.com/2021/">Click Here</a></p>
					</div>

					<div class="search-section search-user-section">
						<div class="search-section-details" id="search-user-list">
							<?php
							$cnt 			= 1;
							while (bp_members()) {

								bp_the_member();

								$member_user_id = bp_get_member_user_id();
								$user_full_name = bp_get_member_name();
								if (empty(trim($user_full_name))) {
									$user_full_name = get_the_author_meta('first_name', $member_user_id) . ' ' . get_the_author_meta('last_name', $member_user_id);
								}

								$company = get_user_meta($member_user_id, 'attendee_company', true);
								$ctitle = get_user_meta($member_user_id, 'attendee_title', true);
								$company = $ctitle ? $ctitle . ' | ' . $company : $company;

								$user_images		= nab_amplify_get_user_images($member_user_id);
								$member_profile_url	= bp_get_member_permalink();
							?>
								<div class="search-item">
									<div class="search-item-inner">
										<div class="search-item-cover">
											<img src="<?php echo esc_url($user_images['banner_image']); ?>" alt="Cover Image">
										</div>
										<div class="search-item-info">
											<div class="search-item-avtar">
												<a href="<?php echo esc_url($member_profile_url); ?>">
													<img src="<?php echo esc_url($user_images['profile_picture']); ?>">
												</a>
											</div>
											<div class="search-item-content">
												<h4>
													<a href="<?php echo esc_url($member_profile_url); ?>"><?php echo esc_html($user_full_name); ?></a>
												</h4>
												<span class="company-name"><?php echo esc_html($company); ?></span>
												<div class="search-actions">
													<a href="<?php echo esc_url($member_profile_url); ?>" class="button">View</a>
												</div>
												<?php
												echo nab_amplify_bp_get_friendship_button($member_user_id);
												?>
											</div>
										</div>
									</div>
								</div>
							<?php
								if (8 === $cnt) {
									echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
								}

								$cnt++;
							}
							if ($cnt < 8) {
								echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
							}
							?>
						</div>
					</div>
					<p class="no-search-data" style="display: none;">Result not found.</p>
					<?php
					if ($total_page > 1) {
					?>
						<div class="load-more" id="load-more-user">
							<a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="12" data-total-page="<?php echo absint($total_page); ?>">Load More</a>
						</div>
					<?php
					}
				}
			} else if ('product' === $view_type) {

				$company_prod_args = array(
					'post_type'			=> 'company-products',
					'post_status'		=> 'publish',
					'posts_per_page'	=> 12,
					's'					=> $search_term
				);

				$company_prod_query = new WP_Query($company_prod_args);

				if ($company_prod_query->have_posts()) {

					$total_products = $company_prod_query->found_posts;

					?>
					<div class="search-view-top-head">
						<h2><span class="company-product-search-count"><?php echo esc_html($total_products); ?> Results for </span><strong>PRODUCTS</strong></h2>
						<p class="view-top-other-info">Are you looking for something on the NAB Show? <a href="https://nabshow.com/2021/">Click Here</a></p>
					</div>
					<div class="search-section amp-item-main company-products">
						<div class="amp-item-wrap" id="company-products-list">
							<?php

							$cnt = 1;

							while ($company_prod_query->have_posts()) {

								$company_prod_query->the_post();

								$thumbnail_url 	    = has_post_thumbnail() ? get_the_post_thumbnail_url() : nab_placeholder_img();
								$product_link	    = get_the_permalink();
								$company_id			= get_field('nab_selected_company_id', get_the_ID());
								$product_company	= !empty($company_id) ? get_the_title($company_id) : '';
								$product_medias     = get_field('product_media');
							?>
								<div class="amp-item-col">
									<div class="amp-item-inner">
										<div class="amp-item-cover">
											<?php $thumbnail_url = '';

											if (!empty($product_medias[0]['product_media_file'])) {
												$thumbnail_url = $product_medias[0]['product_media_file']['url'];
											} else {
												$thumbnail_url =  !empty($thumbnail_url) ?  $thumbnail_url : nab_placeholder_img();
											} ?>
											<img src="<?php echo esc_url($thumbnail_url); ?>" alt="Product Image">
											<?php nab_get_product_bookmark_html(get_the_ID(), 'user-bookmark-action'); ?>
										</div>
										<div class="amp-item-info">
											<div class="amp-item-content">
												<h4>
													<a href="<?php echo esc_url($product_link); ?>"><?php echo esc_html(get_the_title()); ?></a>
												</h4>
												<span class="product-company"><?php echo esc_html($product_company); ?></span>
												<div class="amp-actions nab-action">
													<div class="search-actions">
														<a href="<?php echo esc_url($product_link); ?>" class="button">View</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php

								if (8 === $cnt) {
									echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
								}

								$cnt++;
							}
							if ($cnt < 8) {
								echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
							}
							?>
						</div>
					</div>
				<?php
				}
				?>
				<p class="no-search-data" style="display: none;">Result not found.</p>
				<?php
				if ($company_prod_query->max_num_pages > 1) {
				?>
					<div class="load-more text-center" id="load-more-company-product">
						<a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="12" data-total-page="<?php echo absint($company_prod_query->max_num_pages); ?>">Load More</a>
					</div>
				<?php
				}

				wp_reset_postdata();
			} else if ('company' === $view_type) {

				$company_args = array(
					'post_type'			=> 'company',
					'post_status'		=> 'publish',
					'posts_per_page'	=> 12,
					's'					=> $search_term
				);

				$company_query = new WP_Query($company_args);

				if ($company_query->have_posts()) {

					$total_company	= $company_query->found_posts;
				?>
					<div class="search-view-top-head">
						<h2><span class="company-search-count"><?php echo esc_html($total_company); ?> Results for </span><strong>COMPANIES</strong></h2>
						<p class="view-top-other-info">Are you looking for something on the NAB Show? <a href="https://nabshow.com/2021/">Click Here</a></p>
					</div>
					<div class="search-section search-company-section">
						<div class="search-section-details" id="search-company-list">
							<?php

							$default_company_cover 	= get_template_directory_uri() . '/assets/images/search-box-cover.png';
							$user_logged_in			= is_user_logged_in();
							$current_user_id		= $user_logged_in ? get_current_user_id() : '';
							$default_company_pic	= get_template_directory_uri() . '/assets/images/amplify-featured.png';
							$cnt					= 1;

							while ($company_query->have_posts()) {

								$company_query->the_post();

								$cover_image        = get_field('cover_image');
								$profile_picture    = get_field('profile_picture');
								$cover_image        = !empty($cover_image) ? $cover_image['url'] : $default_company_cover;
								$featured_image  	= get_the_post_thumbnail_url();
								$profile_picture    = $featured_image;
								$company_url		= get_the_permalink();
							?>
								<div class="search-item">
									<div class="search-item-inner">
										<div class="search-item-cover">
											<img src="<?php echo esc_url($cover_image); ?>" alt="Cover Image">
										</div>
										<div class="search-item-info">
											<div class="search-item-avtar">
												<a href="<?php echo esc_url($company_url); ?>">
													<?php if ($profile_picture) { ?>
					                                    <img src="<?php echo esc_url($profile_picture); ?>" alt="Compnay Profile Picture" />
					                                <?php } else { ?>
					                                    <div class="no-image-avtar"><?php echo mb_strimwidth(get_the_title(), 0, 20, '...'); ?></div>
					                                <?php } ?>
												</a>
											</div>
											<div class="search-item-content">
												<h4>
													<a href="<?php echo esc_url($company_url); ?>"><?php echo esc_html(get_the_title()); ?></a>
												</h4>
												<div class="amp-actions">
													<div class="search-actions">
														<a href="<?php echo esc_url($company_url); ?>" class="button">View</a>
													</div>
													<?php
													if ($user_logged_in) {

													?>
														<div id="send-private-message" class="generic-button">
															<a href="" class="button add" data-feathr-click-track="true" data-comp-id="<?php echo get_field('nab_selected_company_id'); ?>">Message Company Rep</a></div>
													<?php
														nab_get_company_message_button(get_the_ID(), 'Message Rep');
													}
													?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php
								if (8 === $cnt) {
									echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
								}

								$cnt++;
							}
							if ($cnt < 8) {
								echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
							}
							?>
						</div>
					</div>
				<?php
				}
				?>
				<p class="no-search-data" style="display: none;">Result not found.</p>
				<?php
				if ($company_query->max_num_pages > 1) {
				?>
					<div class="load-more text-center" id="load-more-company">
						<a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="12" data-total-page="<?php echo absint($company_query->max_num_pages); ?>">Load More</a>
					</div>
				<?php
				}
				wp_reset_postdata();
			} else if ('shop' === $view_type) {

				$product_args = array(
					'post_type' 		=> 'product',
					'post_status'		=> 'publish',
					'posts_per_page' 	=> 12,
					's'					=> $search_term,
					'meta_key'  		=> 'total_sales',
					'orderby'   		=> 'meta_value_num',
					'order' 			=> 'DESC'
				);

				$product_query = new WP_Query($product_args);

				if ($product_query->have_posts()) {

					$total_products = $product_query->found_posts;

				?>
					<div class="search-view-top-head">
						<h2><span class="product-search-count"><?php echo esc_html($total_products); ?> Results for </span><strong>SHOP</strong></h2>
						<p class="view-top-other-info">Are you looking for something on the NAB Show? <a href="https://nabshow.com/2021/">Click Here</a></p>
					</div>
					<div class="search-section search-product-section">
						<div class="search-section-details" id="search-product-list">
							<?php

							$cnt = 1;

							while ($product_query->have_posts()) {

								$product_query->the_post();

								$thumbnail_url 	= has_post_thumbnail() ? get_the_post_thumbnail_url() : nab_placeholder_img();
								$product_link	= get_the_permalink();
								$product_medias = get_field('product_media');
							?>
								<div class="search-item">
									<div class="search-item-inner">
										<div class="search-item-cover">
											<?php $thumbnail_url = '';

											if (!empty($product_medias[0]['product_media_file'])) {
												$thumbnail_url = $product_medias[0]['product_media_file']['url'];
											} else {
												$thumbnail_url =  !empty($thumbnail_url) ?  $thumbnail_url : nab_placeholder_img();
											} ?>
											<img src="<?php echo esc_url($thumbnail_url); ?>" alt="product thumbnail" />
											<?php nab_get_product_bookmark_html(get_the_ID(), 'user-bookmark-action'); ?>
										</div>
										<div class="search-item-info">
											<div class="search-item-content">
												<h4><a href="<?php echo esc_url($product_link); ?>"><?php echo esc_html(get_the_title()); ?></a></h4>
												<div class="search-actions">
													<a href="<?php echo esc_url($product_link); ?>" class="button">View Product</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php

								if (8 === $cnt) {
									echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
								}

								$cnt++;
							}
							if ($cnt < 8) {
								echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
							}
							?>
						</div>
					</div>
				<?php
				}
				?>
				<p class="no-search-data" style="display: none;">Result not found.</p>
				<?php
				if ($product_query->max_num_pages > 1) {
				?>
					<div class="load-more text-center" id="load-more-product">
						<a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="12" data-total-page="<?php echo absint($product_query->max_num_pages); ?>">Load More</a>
					</div>
				<?php
				}

				wp_reset_postdata();
			} else if ('content' === $view_type) {

				$all_post_types = nab_get_search_post_types();

				$content_args = array(
					'post_type' 		=> $all_post_types,
					'post_status'		=> 'publish',
					'posts_per_page' 	=> 12,
					's'					=> $search_term
				);

				if ( ! empty( $search_term ) ) {				
					$content_args[ '_meta_search' ] = true;
				}

				$content_query = new WP_Query( $content_args );

				if ( $content_query->have_posts() ) {

					$total_content	= $content_query->found_posts;

				?>
					<div class="search-view-top-head">
						<h2><span class="content-search-count"><?php echo esc_html($total_content); ?> Results for </span><strong>CONTENT</strong></h2>
						<p class="view-top-other-info">Are you looking for something on the NAB Show? <a href="https://nabshow.com/2021/">Click Here</a></p>
					</div>
					<div class="search-section search-content-section">
						<div class="search-section-details" id="search-content-list">
							<?php

							$cnt = 1;

							while ($content_query->have_posts()) {

								$content_query->the_post();

								$thumbnail_url 	= has_post_thumbnail() ? get_the_post_thumbnail_url() : nab_placeholder_img();
								$post_link		= get_the_permalink();
							?>
								<div class="search-item">
									<div class="search-item-inner">
										<div class="search-item-cover">
											<img src="<?php echo esc_url($thumbnail_url); ?>" alt="content thumbnail" />
										</div>
										<div class="search-item-info">
											<div class="search-item-content">
												<h4><a href="<?php echo esc_url($post_link); ?>"><?php echo esc_html(get_the_title()); ?></a></h4>
												<div class="search-actions">
													<a href="<?php echo esc_url($post_link); ?>" class="button">View</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php

								if (8 === $cnt) {
									echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
								}
								$cnt++;
							}
							if ($cnt < 8) {
								echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
							}
							?>
						</div>
					</div>
				<?php
				}
				?>
				<p class="no-search-data" style="display: none;">Result not found.</p>
				<?php
				if ($content_query->max_num_pages > 1) {
				?>
					<div class="load-more text-center" id="load-more-content">
						<a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="12" data-total-page="<?php echo absint($content_query->max_num_pages); ?>">Load More</a>
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

			if (bp_has_members($members_filter)) {

				global $members_template;

				$search_found	= true;
				$total_users	= $members_template->total_member_count;
				?>
				<div class="search-section search-user-section">
					<div class="search-section-heading">
						<h2><strong>PEOPLE</strong> <span>(<?php echo esc_html($total_users . ' RESULTS'); ?>)</span></h2>
						<?php
						if ($total_users > 4) {

							$user_view_more_link = add_query_arg(array('s' => $search_term, 'v' => 'user'), $current_site_url);

						?>
							<div class="section-view-more">
								<a href="<?php echo esc_html($user_view_more_link); ?>" class="view-more-link">View All</a>
							</div>
						<?php
						}
						?>
					</div>
					<div class="search-section-details" id="search-user-list">
						<?php

						$default_cover = get_template_directory_uri() . '/assets/images/search-box-cover.png';

						while (bp_members()) {

							bp_the_member();

							$member_user_id = bp_get_member_user_id();

							$user_full_name = bp_get_member_name();

							if (empty(trim($user_full_name))) {
								$user_full_name = get_the_author_meta('first_name', $member_user_id) . ' ' . get_the_author_meta('last_name', $member_user_id);
							}

							$company = get_user_meta($member_user_id, 'attendee_company', true);
							$ctitle = get_user_meta($member_user_id, 'attendee_title', true);
							$company = $ctitle ? $ctitle . ' | ' . $company : $company;

							$user_images 		= nab_amplify_get_user_images($member_user_id);
							$member_profile_url = bp_get_member_permalink();
						?>
							<div class="search-item">
								<div class="search-item-inner">
									<div class="search-item-cover">
										<img src="<?php echo esc_url($user_images['banner_image']); ?>" alt="Cover Image">
									</div>
									<div class="search-item-info">
										<div class="search-item-avtar">
											<a href="<?php echo esc_url($member_profile_url); ?>">
												<img src="<?php echo esc_url($user_images['profile_picture']); ?>">
											</a>
										</div>
										<div class="search-item-content">
											<h4>
												<a href="<?php echo esc_url($member_profile_url); ?>"><?php echo esc_html($user_full_name); ?></a>
											</h4>
											<span class="company-name"><?php echo esc_html($company); ?></span>
											<div class="search-actions">
												<a href="<?php echo esc_url($member_profile_url); ?>" class="button">View</a>
											</div>
											<?php
											echo nab_amplify_bp_get_friendship_button($member_user_id);
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

			$company_prod_args = array(
				'post_type'			=> 'company-products',
				'post_status'		=> 'publish',
				'posts_per_page'	=> 4,
				's'					=> $search_term
			);

			$company_prod_query = new WP_Query($company_prod_args);

			if ($company_prod_query->have_posts()) {

				$search_found		= true;
				$total_company_prod = $company_prod_query->found_posts;
			?>
				<div class="search-section amp-item-main company-products">
					<div class="search-section-heading">
						<h2><strong>PRODUCTS</strong> <span>(<?php echo esc_html($total_company_prod . ' RESULTS'); ?>)</span></h2>
						<?php
						if ($total_company_prod > 4) {

							$view_more_link = add_query_arg(array('s' => $search_term, 'v' => 'product'), $current_site_url);

						?>
							<div class="section-view-more">
								<a href="<?php echo esc_html($view_more_link); ?>" class="view-more-link">View All</a>
							</div>
						<?php
						}
						?>
					</div>
					<div class="amp-item-wrap" id="company-products-list">
						<?php
						while ($company_prod_query->have_posts()) {

							$company_prod_query->the_post();

							$thumbnail_url 	    = has_post_thumbnail() ? get_the_post_thumbnail_url() : nab_placeholder_img();
							$product_link	    = get_the_permalink();
							$company_id			= get_field('nab_selected_company_id', get_the_ID());
							$product_company	= !empty($company_id) ? get_the_title($company_id) : '';
							$product_medias     = get_field('product_media');
						?>
							<div class="amp-item-col">
								<div class="amp-item-inner">
									<div class="amp-item-cover">
										<?php $thumbnail_url = '';

										if (!empty($product_medias[0]['product_media_file'])) {
											$thumbnail_url = $product_medias[0]['product_media_file']['url'];
										} else {
											$thumbnail_url =  !empty($thumbnail_url) ?  $thumbnail_url : nab_placeholder_img();
										} ?>
										<img src="<?php echo esc_url($thumbnail_url); ?>" alt="Product Image">
										<?php nab_get_product_bookmark_html(get_the_ID(), 'user-bookmark-action'); ?>
									</div>
									<div class="amp-item-info">
										<div class="amp-item-content">
											<h4>
												<a href="<?php echo esc_url($product_link); ?>"><?php echo esc_html(get_the_title()); ?></a>
											</h4>
											<span class="product-company"><?php echo esc_html($product_company); ?></span>
											<div class="amp-actions nab-action">
												<div class="search-actions">
													<a href="<?php echo esc_url($product_link); ?>" class="button">View</a>
												</div>
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

			$company_args = array(
				'post_type'			=> 'company',
				'post_status'		=> 'publish',
				'posts_per_page'	=> 4,
				's'					=> $search_term
			);

			$company_query = new WP_Query($company_args);

			if ($company_query->have_posts()) {

				$search_found	= true;
				$total_company	= $company_query->found_posts;
			?>
				<div class="search-section search-company-section">
					<div class="search-section-heading">
						<h2><strong>COMPANIES</strong> <span>(<?php echo esc_html($total_company . ' RESULTS'); ?>)</span></h2>
						<?php
						if ($total_company > 4) {

							$company_view_more_link = add_query_arg(array('s' => $search_term, 'v' => 'company'), $current_site_url);

						?>
							<div class="section-view-more">
								<a href="<?php echo esc_html($company_view_more_link); ?>" class="view-more-link">View All</a>
							</div>
						<?php
						}
						?>
					</div>
					<div class="search-section-details" id="search-company-list">
						<?php

						$default_company_cover 	= get_template_directory_uri() . '/assets/images/search-box-cover.png';
						$user_logged_in			= is_user_logged_in();
						$current_user_id		= $user_logged_in ? get_current_user_id() : '';
						$default_company_pic	= get_template_directory_uri() . '/assets/images/amplify-featured.png';
						while ($company_query->have_posts()) {

							$company_query->the_post();

							$cover_image        = get_field('cover_image');
							$profile_picture    = get_field('profile_picture');
							$cover_image        = !empty($cover_image) ? $cover_image['url'] : $default_company_cover;
							$featured_image   	= get_the_post_thumbnail_url();
							$profile_picture  	= $featured_image;
							$company_url		= get_the_permalink();
						?>
							<div class="search-item">
								<div class="search-item-inner">
									<div class="search-item-cover">
										<img src="<?php echo esc_url($cover_image); ?>" alt="Cover Image">
									</div>
									<div class="search-item-info">
										<div class="search-item-avtar">
											<a href="<?php echo esc_url($company_url); ?>">
												<?php if ($profile_picture) { ?>
				                                    <img src="<?php echo esc_url($profile_picture); ?>" alt="Compnay Profile Picture" />
				                                <?php } else { ?>
				                                    <div class="no-image-avtar"><?php echo mb_strimwidth(get_the_title(), 0, 20, '...'); ?></div>
				                                <?php } ?>
											</a>
										</div>
										<div class="search-item-content">
											<h4>
												<a href="<?php echo esc_url($company_url); ?>"><?php echo esc_html(get_the_title()); ?></a>
											</h4>
											<div class="amp-actions">
												<div class="search-actions">
													<a href="<?php echo esc_url($company_url); ?>" class="button">View</a>
												</div>

												<?php

												if ($user_logged_in) { ?>

													<div id="send-private-message" class="generic-button">
														<a href="javascript:void(0);" class="button add" data-feathr-click-track="true" data-comp-id="<?php echo get_the_ID(); ?>">Message Rep</a></div>
												<?php }
												?>
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

			$product_args = array(
				'post_type' 		=> 'product',
				'post_status'		=> 'publish',
				'posts_per_page' 	=> 4,
				's'					=> $search_term,
				'meta_key'  		=> 'total_sales',
				'orderby'   		=> 'meta_value_num',
				'order' 			=> 'DESC'
			);

			$product_query = new WP_Query($product_args);

			if ($product_query->have_posts()) {

				$search_found	= true;
				$total_products = $product_query->found_posts;
			?>
				<div class="search-section search-product-section">
					<div class="search-section-heading">
						<h2><strong>SHOP</strong> <span>(<?php echo esc_html($total_products . ' RESULTS'); ?>)</span></h2>
						<?php
						if ($total_products > 4) {

							$poroduct_view_more_link = add_query_arg(array('s' => $search_term, 'v' => 'shop'), $current_site_url);

						?>
							<div class="section-view-more">
								<a href="<?php echo esc_html($poroduct_view_more_link); ?>" class="view-more-link">View All</a>
							</div>
						<?php
						}
						?>
					</div>
					<div class="search-section-details" id="search-product-list">
						<?php
						while ($product_query->have_posts()) {

							$product_query->the_post();
							$product_link	= get_the_permalink();
							$product_medias = get_field('product_media');
						?>
							<div class="search-item">
								<div class="search-item-inner">
									<div class="search-item-cover">
										<?php $thumbnail_url = '';

										if (!empty($product_medias[0]['product_media_file'])) {
											$thumbnail_url = $product_medias[0]['product_media_file']['url'];
										} else {
											$thumbnail_url =  !empty($thumbnail_url) ?  $thumbnail_url : nab_placeholder_img();
										} ?>
										<img src="<?php echo esc_url($thumbnail_url); ?>" alt="product thumbnail" />

										<?php nab_get_product_bookmark_html(get_the_ID(), 'user-bookmark-action'); ?>
									</div>
									<div class="search-item-info">
										<div class="search-item-content">
											<h4><a href="<?php echo esc_url($product_link); ?>"><?php echo esc_html(get_the_title()); ?></a></h4>
											<div class="search-actions">
												<a href="<?php echo esc_url($product_link); ?>" class="button">View Product</a>
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

			$all_post_types = nab_get_search_post_types();

			$content_args = array(
				'post_type' 		=> $all_post_types,
				'posts_per_page' 	=> 4,
				'post_status'		=> 'publish',
				's'					=> $search_term						
			);

			if ( ! empty( $search_term ) ) {
				$content_args[ '_meta_search' ] = true;
			}

			$content_query = new WP_Query( $content_args );			
			
			if ( $content_query->have_posts() ) {

				$search_found	= true;
				$total_content	= $content_query->found_posts;
			?>
				<div class="search-section search-content-section">
					<div class="search-section-heading">
						<h2><strong>CONTENT</strong> <span>(<?php echo esc_html($total_content . ' RESULTS'); ?>)</span></h2>
						<?php
						if ($total_content > 4) {

							$content_view_more_link = add_query_arg(array('s' => $search_term, 'v' => 'content'), $current_site_url);
						?>
							<div class="section-view-more">
								<a href="<?php echo esc_html($content_view_more_link); ?>" class="view-more-link">View All</a>
							</div>
						<?php
						}
						?>
					</div>
					<div class="search-section-details" id="search-content-list">
						<?php
						while ($content_query->have_posts()) {

							$content_query->the_post();

							$thumbnail_url 	= has_post_thumbnail() ? get_the_post_thumbnail_url() : nab_placeholder_img();
							$post_link		= get_the_permalink();
						?>
							<div class="search-item">
								<div class="search-item-inner">
									<div class="search-item-cover">
										<img src="<?php echo esc_url($thumbnail_url); ?>" alt="content thumbnail" />
									</div>
									<div class="search-item-info">
										<div class="search-item-content">
											<h4><a href="<?php echo esc_url($post_link); ?>"><?php echo esc_html(get_the_title()); ?></a></h4>
											<div class="search-actions">
												<a href="<?php echo esc_url($post_link); ?>" class="button">View</a>
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

			if (!$search_found) {
			?>
				<div class="search-not-found">
					<p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'nab-amplify'); ?></p>
				</div>
		<?php
			}
		}
		?>
	</div>
</main>
<?php
get_footer();
