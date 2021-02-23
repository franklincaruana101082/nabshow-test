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
$view_screen		= array('user', 'shop', 'content', 'product', 'company', 'event');
$allowed_tags 		= wp_kses_allowed_html('post');

$allowed_tags['broadstreet-zone'] = array('zone-id' => 1);
?>
<!-- START legacy-template: search -->
<div class="container">
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
							<a href="javascript:void(0);" class="sort-order active" data-order='popularity'>Popularity</a>
							<a href="javascript:void(0);" class="sort-order" data-order='relevance'>Relevancy</a>
							<a href="javascript:void(0);" class="sort-order" data-order='title'>Alphabetical</a>
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
					} else if ('company' === $view_type) {
					?>
						<div class="sort-company sort-order-btn">
							<a href="javascript:void(0);" class="sort-order active" data-order='date'>Newest</a>
							<a href="javascript:void(0);" class="sort-order" data-order='title'>Alphabetical</a>
							<?php

							$product_categories = get_terms( array( 'taxonomy' => 'company-product-category', 'hide_empty' => false ) );

							if ( is_array( $product_categories ) && ! is_wp_error( $product_categories ) && count( $product_categories ) > 0 ) {
								?>
								<div class="inline-filter-select-boxes">
									<div class="nab-custom-select">
										<select id="company-category-filter" class="company-category-filter">
											<option value="">Product Category</option>
											<?php
											foreach ( $product_categories as $current_cat ) {
												?>
												<option value="<?php echo esc_attr( $current_cat->term_id ); ?>"><?php echo esc_html( $current_cat->name ); ?></option>
												<?php
											}
											?>
										</select>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					<?php
					} else if ( 'event' === $view_type ) {
						?>
						<div class="event-type sort-order-btn">
							<a href="javascript:void(0);" class="sort-order active" data-event='all'>All</a>
							<a href="javascript:void(0);" class="sort-order" data-event='previous'>Previous</a>
							<a href="javascript:void(0);" class="sort-order" data-event='upcoming'>Upcoming</a>
						</div>
						<?php
					} else if ('product' === $view_type) {
					?>
						<div class="sort-company-product sort-order-btn">
							<a href="javascript:void(0);" class="sort-order active" data-order='date'>Newest</a>
							<a href="javascript:void(0);" class="sort-order" data-order='title'>Alphabetical</a>
							<?php

							$product_categories = get_terms( array( 'taxonomy' => 'company-product-category', 'hide_empty' => true ) );

							if ( is_array( $product_categories ) && ! is_wp_error( $product_categories ) && count( $product_categories ) > 0 ) {
								?>
								<div class="inline-filter-select-boxes">
									<div class="nab-custom-select">
										<select id="company-product-category" class="company-product-category">
											<option value="">Product Category</option>
											<?php
											foreach ( $product_categories as $current_cat ) {
												?>
												<option value="<?php echo esc_attr( $current_cat->slug ); ?>"><?php echo esc_html( $current_cat->name ); ?></option>
												<?php
											}
											?>
										</select>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					<?php
					} else if ('user' === $view_type) {
					?>
						<div class="sort-user sort-order-btn">
							<a href="javascript:void(0);" class="sort-order active" data-order='newest'>Newest</a>
							<a href="javascript:void(0);" class="sort-order" data-order='alphabetical'>Alphabetical</a>
						</div>
						<div class="filter-select-boxes _multirows">
							<div class="filter_box_row">
								<div class="company-search">
									<input type="text" class="input-company" placeholder="Company" />
								</div>
								<div class="job-title-search">
									<input type="text" class="input-job-title" placeholder="Job Title" />
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
								} ?>
							</div>
							<div class="filter_box_row">
								<?php
								$countries_obj  		= new WC_Countries();
								$countries      		= $countries_obj->__get( 'countries' );
								$default_country        = $countries_obj->get_base_country();
	                            $default_county_states  = $countries_obj->get_states( $default_country );
								?>
								<div class="nab-custom-select">
									<select class="search-country-select" id="search-country-select">
										<option value="">Select a country</option>
										<?php
										foreach ( $countries as $abbr => $country ) {
											?>
											<option value="<?php echo esc_attr( $abbr ); ?>"><?php echo esc_html( $country ); ?></option>
											<?php
										}
										?>
									</select>
								</div>
								<div class="nab-custom-select">
									<select class="search-state-select" id="search-state-select">
										<option value="">Select a state</option>
										<?php
										foreach ( $default_county_states as $abbr => $state ) {
											?>
											<option value="<?php echo esc_attr( $abbr ); ?>"><?php echo esc_html( $state ); ?></option>
											<?php
										}
										?>
									</select>
								</div>
								<div class="nab-custom-select">
									<select class="search-city-select" id="search-city-select">
										<option value="">Select a city</option>
									</select>
								</div>
							</div>
						</div>
					<?php
					} else if ('content' === $view_type) {
					?>
						<div class="sort-content sort-order-btn">
							<a href="javascript:void(0);" class="sort-order active" data-order='date'>Latest</a>
							<a href="javascript:void(0);" class="sort-order" data-order='relevance'>Relevancy</a>
							<a href="javascript:void(0);" class="sort-order" data-order='title'>Alphabetical</a>
						</div>
						<div class="filter-select-boxes">
							<?php
							$community_field = get_field_object( 'field_5fb3f25f9ab77' );

							if ( isset( $community_field[ 'choices' ] ) && is_array( $community_field[ 'choices' ] ) ) {
								?>
								<div class="nab-custom-select">
									<select id="content-community" class="content-community">
										<option value="">Community</option>
										<?php
										foreach ( $community_field[ 'choices' ] as $value => $label ) {
											?>
											<option value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></option>
											<?php
										}
										?>
									</select>
								</div>
								<?php
							}

							$subject_field = get_field_object( 'field_5fb3f41b02c43' );

							if ( isset( $subject_field[ 'choices' ] ) && is_array( $subject_field[ 'choices' ] ) ) {
								?>
								<div class="nab-custom-select">
									<select id="content-subject" class="content-subject">
										<option value="">Subject</option>
										<?php
										foreach ( $subject_field[ 'choices' ] as $value => $label ) {
											?>
											<option value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></option>
											<?php
										}
										?>
									</select>
								</div>
								<?php
							}
							?>
							<div class="nab-custom-select">
								<select id="content-type" class="content-type">
									<option value="">Content Type</option>
									<option value="articles">Articles</option>
									<option value="other">NAB Amplify Pages</option>
								</select>
							</div>
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
					'per_page' 	=> 15,
					'type'		=> 'newest'
				);


				if (bp_has_members($members_filter)) {

					global $members_template;

					$total_users	= $members_template->total_member_count;
					$total_page		= ceil($total_users / 15);
					?>
					<div class="search-view-top-head">
						<h2><span class="user-search-count"><?php echo esc_html($total_users); ?> Results for </span>&ldquo;<strong>People</strong>&rdquo;</h2>
						<p class="view-top-other-info">Are you looking for something on NAB Show? <a href="https://nabshow.com/2021/">Click Here</a></p>
					</div>

					<div class="search-section search-user-section">
						<ul class="colgrid _5up" id="search-user-list">
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
								<li>
									<div class="result _person">
										<a href="<?php echo esc_url($member_profile_url); ?>">
											<img class="result__image" src="<?php echo esc_url($user_images['profile_picture']); ?>">
										</a>
										<h4 class="result__title"><a href="<?php echo esc_url($member_profile_url); ?>"><?php echo esc_html($user_full_name); ?></a></h4>
										<a href="<?php echo esc_url($member_profile_url); ?>" class="button result__button">View Now</a>
										<?php echo nab_amplify_bp_get_friendship_button($member_user_id); ?>
										<!-- <a href="#" class="link _plus result__message">Message Rep</a> -->
										<?php /* <img src="<?php echo esc_url($user_images['banner_image']); ?>" alt="Cover Image"> */ ?>
									</div>
								</li>
							<?php
								if (10 === $cnt) {
									echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
								}

								$cnt++;
							}
							if ($cnt < 10) {
								echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
							}
							?>
						</ul>
					</div>
					<p class="no-search-data" style="display: none;">Result not found.</p>
					<?php
					if ($total_page > 1) {
					?>
						<div class="load-more" id="load-more-user">
							<a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="15" data-total-page="<?php echo absint($total_page); ?>">Load More</a>
						</div>
					<?php
					}
				}
			} else if ('product' === $view_type) {

				$company_prod_args = array(
					'post_type'			=> 'company-products',
					'post_status'		=> 'publish',
					'posts_per_page'	=> 15,
					's'					=> $search_term,
				);

				if ( ! empty( $search_term ) ) {

					$category_search_array = array();

					$get_search_term_id = get_term_by( 'name', $search_term, 'company-product-category' );

					if ( $get_search_term_id ) {

						$category_search_array[]	= $get_search_term_id->term_id;
					}

					$get_search_product_tag	= get_term_by( 'name', $search_term, 'company-product-tag' );

					if ( $get_search_product_tag ) {

						$category_search_array[]	= $get_search_product_tag->term_id;
					}

					if ( count( $category_search_array ) > 0 ) {

						$company_prod_args[ '_tax_search' ] = $category_search_array;
					}

				}

				$company_prod_query = new WP_Query($company_prod_args);

				if ($company_prod_query->have_posts()) {

					$total_products = $company_prod_query->found_posts;

					?>
					<div class="search-view-top-head">
						<h2><span class="company-product-search-count"><?php echo esc_html($total_products); ?> Results for </span>&ldquo;<strong>Products</strong>&rdquo;</h2>
						<p class="view-top-other-info">Are you looking for something on NAB Show? <a href="https://nabshow.com/2021/">Click Here</a></p>
					</div>
					<div class="search-section amp-item-main company-products">
						<ul class="colgrid _5up" id="company-products-list">
							<?php

							$cnt = 1;

							while ($company_prod_query->have_posts()) {

								$company_prod_query->the_post();

								$thumbnail_url      = nab_amplify_get_featured_image( get_the_ID(), true, nab_product_company_placeholder_img() );
								$product_link	    = get_the_permalink();
								$company_id			= get_field('nab_selected_company_id', get_the_ID());
								$product_company	= !empty($company_id) ? get_the_title($company_id) : '';
								$product_medias     = get_field('product_media');
							?>
								<li>
									<div class="result _content">
										<?php $thumbnail_url = '';
											if (!empty($product_medias[0]['product_media_file'])) {
												$thumbnail_url = $product_medias[0]['product_media_file']['url'];
											} else {
												$thumbnail_url =  !empty($thumbnail_url) ?  $thumbnail_url : nab_product_company_placeholder_img();
											} 
										?>
										<a href="<?php echo esc_url($product_link); ?>">
											<img src="<?php echo esc_url($thumbnail_url); ?>" class="result__image" alt="Product Image">	
										</a>
										<?php nab_get_product_bookmark_html(get_the_ID(), 'user-bookmark-action'); ?>
										<h4 class="result__title"><a href="<?php echo esc_url($product_link); ?>"><?php echo esc_html(get_the_title()); ?></a></h4>
										<h5 class="result__lede"><?php echo esc_html($product_company); ?></h5>
										<a href="<?php echo esc_url($product_link); ?>" class="button result__button">View Now</a>
									</div>
								</li>
							<?php

								if (10 === $cnt) {
									echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
								}

								$cnt++;
							}
							if ($cnt < 10) {
								echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
							}
							?>
						</ul>
					</div>
				<?php
				}
				?>
				<p class="no-search-data" style="display: none;">Result not found.</p>
				<?php
				if ($company_prod_query->max_num_pages > 1) {
				?>
					<div class="load-more text-center" id="load-more-company-product">
						<a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="1" data-total-page="<?php echo absint($company_prod_query->max_num_pages); ?>">Load More</a>
					</div>
				<?php
				}

				wp_reset_postdata();
			} else if ('company' === $view_type) {

				$company_args = array(
					'post_type'			=> 'company',
					'post_status'		=> 'publish',
					'posts_per_page'	=> 15,
					's'					=> $search_term
				);

				if ( ! empty( $search_term ) ) {

					$get_search_term_id = get_term_by( 'name', $search_term, 'company-product-category' );

					if ( $get_search_term_id ) {

						$company_args[ '_meta_company_term' ] = $get_search_term_id->term_id;
					}
				}

				$company_query = new WP_Query($company_args);

				if ($company_query->have_posts()) {

					$total_company	= $company_query->found_posts;
				?>
					<div class="search-view-top-head">
						<h2><span class="company-search-count"><?php echo esc_html($total_company); ?> Results for </span>&ldquo;<strong>Companies</strong>&rdquo;</h2>
						<p class="view-top-other-info">Are you looking for something on NAB Show? <a href="https://nabshow.com/2021/">Click Here</a></p>
					</div>
					<div class="search-section search-company-section">
						<ul class="colgrid _5up" id="search-company-list">
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
								$featured_image     = nab_amplify_get_featured_image( get_the_ID(), false );
								$profile_picture    = $featured_image;
								$company_url		= get_the_permalink();
								$company_poc        = get_field('point_of_contact');
							?>
								<li>
									<div class="result">
										<?php if ($profile_picture) { ?>
											<img class="result__image" src="<?php echo esc_url($profile_picture); ?>" alt="<?php echo esc_html(get_the_title()); ?> Profile Picture" />
										<?php } else { ?>
											<div class="result__image no-image-avtar"><?php echo mb_strimwidth(get_the_title(), 0, 20, '...'); ?></div>
										<?php } ?>
										<h4 class="result__title"><?php echo esc_html(get_the_title()); ?></h4>
										<a href="<?php echo esc_url($company_url); ?>" class="button result__button">View Now</a>
										<?php
											if ($company_poc !== '' && !empty($company_poc)) {
												if ($user_logged_in) {
													?>
												   <a href="javascript:void(0);" class="link _plus result__message" data-comp-id="<?php echo esc_attr(get_the_ID()); ?>">Message Rep</a>
											   <?php
												} else {
													$current_url = home_url(add_query_arg(null, null));
													$current_url = str_replace('amplify/amplify', 'amplify', $current_url); ?>
												   <a href="<?php echo esc_url(add_query_arg(array( 'r' => $current_url ), wc_get_page_permalink('myaccount'))); ?>" class="link _plus result__message">Message Rep</a>
											   <?php
												}
											}
										?>
										<?php /* <img src="<?php echo esc_url($cover_image); ?>" alt="Cover Image"> */?>
									</div>
								</li>
							<?php
								if (10 === $cnt) {
									echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
								}

								$cnt++;
							}
							if ($cnt < 10) {
								echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
							}
							?>
						</ul>
					</div>
				<?php
				}
				?>
				<p class="no-search-data" style="display: none;">Result not found.</p>
				<?php
				if ($company_query->max_num_pages > 1) {
				?>
					<div class="load-more text-center" id="load-more-company">
						<a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="15" data-total-page="<?php echo absint($company_query->max_num_pages); ?>">Load More</a>
					</div>
				<?php
				}
				wp_reset_postdata();
			} else if ('shop' === $view_type) {

				$product_args = array(
					'post_type' 		=> 'product',
					'post_status'		=> 'publish',
					'posts_per_page' 	=> 15,
					's'					=> $search_term,
					'meta_key'  		=> 'total_sales',
					'orderby'   		=> 'meta_value_num',
					'order' 			=> 'DESC'
				);

				$product_args['tax_query'] = array(
					array(
						'taxonomy' => 'product_visibility',
						'field'    => 'slug',
						'terms'    => array( 'exclude-from-search' ),
						'operator' => 'NOT IN',
					)
				);

				$product_query = new WP_Query($product_args);

				if ($product_query->have_posts()) {

					$total_products = $product_query->found_posts;

				?>
					<div class="search-view-top-head">
						<h2><span class="product-search-count"><?php echo esc_html($total_products); ?> Results for </span>&ldquo;<strong>Shop</strong>&rdquo;</h2>
						<p class="view-top-other-info">Are you looking for something on NAB Show? <a href="https://nabshow.com/2021/">Click Here</a></p>
					</div>
					<div class="search-section search-product-section">
						<ul class="colgrid _5up" id="search-product-list">
							<?php

							$cnt = 1;

							while ($product_query->have_posts()) {

								$product_query->the_post();

								$thumbnail_url  = nab_amplify_get_featured_image( get_the_ID() );
								$product_link	= get_the_permalink();

							?>
								<li>
									<div class="result _content">
										<?php
											$thumbnail_url = nab_amplify_get_featured_image( get_the_ID(), true, nab_product_company_placeholder_img() );
										?>
										<a href="<?php echo esc_url($product_link); ?>">
											<img src="<?php echo esc_url($thumbnail_url); ?>" class="result__image" alt="Product Image">	
										</a>
										<?php nab_get_product_bookmark_html(get_the_ID(), 'user-bookmark-action'); ?>
										<h4 class="result__title"><a href="<?php echo esc_url($product_link); ?>"><?php echo esc_html(get_the_title()); ?></a></h4>
										<a href="<?php echo esc_url($product_link); ?>" class="button result__button">View Now</a>
									</div>
								</li>
							<?php

								if (10 === $cnt) {
									echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
								}

								$cnt++;
							}
							if ($cnt < 10) {
								echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
							}
							?>
						</ul>
					</div>
				<?php
				}
				?>
				<p class="no-search-data" style="display: none;">Result not found.</p>
				<?php
				if ($product_query->max_num_pages > 1) {
				?>
					<div class="load-more text-center" id="load-more-product">
						<a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="15" data-total-page="<?php echo absint($product_query->max_num_pages); ?>">Load More</a>
					</div>
				<?php
				}

				wp_reset_postdata();
			} else if ( 'event' === $view_type ) {

				$event_args		= array(
					'post_type'			=> 'tribe_events',
					'posts_per_page'	=> 15,
					'post_status'		=> 'publish',
					's'					=> $search_term,
					'meta_key'			=> '_EventStartDate',
					'orderby'			=> 'meta_value',
					'order'				=> 'ASC'
				);

				$event_query = new WP_Query( $event_args );

				if ( $event_query->have_posts() ) {

					$search_found	= true;
					$total_event	= $event_query->found_posts;
					?>
					<div class="search-view-top-head">
						<h2><span class="event-search-count"><?php echo esc_html($total_event); ?> Results for </span>&ldquo;<strong>Events</strong>&rdquo;</h2>
						<p class="view-top-other-info">Are you looking for something on NAB Show? <a href="https://nabshow.com/2021/">Click Here</a></p>
					</div>
					<div class="search-section search-content-section">
						<ul class="colgrid _5up" id="search-event-list">
							<?php
							$cnt = 1;
							while ( $event_query->have_posts() ) {

								$event_query->the_post();

								$event_post_id		= get_the_ID();
								$thumbnail_url      = nab_amplify_get_featured_image( get_the_ID(), true, nab_product_company_placeholder_img() );
								$event_start_date   = get_post_meta( $event_post_id, '_EventStartDate', true) ;
								$event_end_date     = get_post_meta( $event_post_id, '_EventEndDate', true) ;
								$website_link 		= get_post_meta( $event_post_id, '_EventURL', true );
								$website_link		= ! empty( $website_link ) ? trim( $website_link ) : get_the_permalink();
								$target				= 0 === strpos( $website_link, $current_site_url ) ? '_self' : '_blank';
								$event_date			= date_format( date_create( $event_start_date ), 'l, F j' );
								$event_month        = date_format( date_create( $event_start_date ), 'F' );
								$event_day          = date_format( date_create( $event_start_date ), 'j' );

								if ( ! empty( $event_start_date ) && ! empty( $event_end_date ) ) {

									if ( date_format( date_create( $event_start_date ), 'Ymd' ) !== date_format( date_create( $event_end_date ), 'Ymd' ) ) {

										$event_date .= ' - ' . date_format( date_create( $event_end_date ), 'l, F j' );
									}
								}

								?>
								<li>
									<a class="event" href="<?php echo esc_url( $website_link ); ?>" target="<?php echo esc_attr( $target ); ?>">
									    <div class="event__date">
									        <div class="event__month">
									            <?php echo esc_html( $event_month ); ?>
									        </div>
									        <div class="event__day text-gradient _blue">
									            <?php echo esc_html( $event_day ); ?>
									        </div>
									    </div>
									    <div class="event__photo">
									        <img class="event__image" src="<?php echo esc_url( $thumbnail_url ); ?>" alt="event thumbnail" />
									    </div>
									    <div class="event__info">
									        <h4 class="event__title">
									            <?php echo esc_html( get_the_title() ); ?>
									        </h4>
									        <div class="event__link link _plus">
									            Learn More
									        </div>
									    </div>
									</a>
								</li>
								<?php

								if ( 10 === $cnt ) {
									echo wp_kses( nab_get_search_result_ad(), $allowed_tags );
								}
								$cnt++;
							}
							if ( $cnt < 10 ) {
								echo wp_kses( nab_get_search_result_ad(), $allowed_tags );
							}
							?>
						</ul>
					</div>
					<?php
				}
				?>
				<p class="no-search-data" style="display: none;">Result not found.</p>
				<?php
				if ( $event_query->max_num_pages > 1 ) {
					?>
					<div class="load-more text-center" id="load-more-event">
						<a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="15" data-total-page="<?php echo absint( $event_query->max_num_pages ); ?>">Load More</a>
					</div>
					<?php
				}
				wp_reset_postdata();

			} else if ('content' === $view_type) {

				$all_post_types = nab_get_search_post_types();

				$content_args = array(
					'post_type' 		=> $all_post_types,
					'post_status'		=> 'publish',
					'posts_per_page' 	=> 15,
					's'					=> $search_term,
					'meta_query'		=> array(
						'relation'	=> 'OR',
						array(
							'key'		=> '_yoast_wpseo_meta-robots-noindex',
							'value'		=> 'completely',
							'compare'	=> 'NOT EXISTS'
						),
						array(
							'key'		=> '_yoast_wpseo_meta-robots-noindex',
							'value'		=> '1',
							'compare'	=> '!='
						)
					),
				);

				if ( ! empty( $search_term ) ) {
					$content_args[ '_meta_search' ] = true;
				}

				$content_query = new WP_Query( $content_args );

				if ( $content_query->have_posts() ) {

					$total_content	= $content_query->found_posts;

					?>
					<div class="search-view-top-head">
						<h2><span class="content-search-count"><?php echo esc_html($total_content); ?> Results for </span>&ldquo;<strong>Content</strong>&rdquo;</h2>
						<p class="view-top-other-info">Are you looking for something on NAB Show? <a href="https://nabshow.com/2021/">Click Here</a></p>
					</div>
					<div class="search-section search-content-section">
						<ul class="colgrid _5up" id="search-content-list">
							<?php

							$cnt = 1;

							while ($content_query->have_posts()) {

								$content_query->the_post();

								$thumbnail_url = nab_amplify_get_featured_image( get_the_ID() );
								$post_link		= get_the_permalink();
								?>
								<li>
									<a href="<?php echo esc_url($post_link); ?>" class="result _content">
										<img class="result__image" src="<?php echo esc_url($thumbnail_url); ?>" alt="content thumbnail" />
										<h4 class="result__title"><?php echo esc_html(get_the_title()); ?></h4>
									</a>
								</li>
							<?php

								if (10 === $cnt) {
									echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
								}
								$cnt++;
							}
							if ($cnt < 10) {
								echo wp_kses(nab_get_search_result_ad(), $allowed_tags);
							}
							?>
						</ul>
					</div>
					<?php
				}
				?>
				<p class="no-search-data" style="display: none;">Result not found.</p>
				<?php
				if ($content_query->max_num_pages > 1) {
				?>
					<div class="load-more text-center" id="load-more-content">
						<a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="15" data-total-page="<?php echo absint($content_query->max_num_pages); ?>">Load More</a>
					</div>
				<?php
				}

				wp_reset_postdata();
			}
		} else {

			$search_found 	= false;

			$members_filter = array(
				'page' 		=> 1,
				'per_page' 	=> 5,
				'type'		=> 'newest',
			);

			if (bp_has_members($members_filter)) {

				global $members_template;

				$search_found	= true;
				$total_users	= $members_template->total_member_count;
				?>
				<div class="search-section search-user-section">
					<div class="search-section-heading">
						<h2><strong>People</strong> <span>(<?php echo esc_html($total_users . ' Results'); ?>)</span></h2>
						<?php
						if ($total_users > 5) {

							$user_view_more_link = add_query_arg(array('s' => $search_term, 'v' => 'user'), $current_site_url);

						?>
							<div class="section-view-more">
								<a href="<?php echo esc_html($user_view_more_link); ?>" class="view-more-link">View All</a>
							</div>
						<?php
						}
						?>
					</div>
					<ul class="colgrid _5up" id="search-user-list">
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
							<li>
								<div class="result _person">
									<a href="<?php echo esc_url($member_profile_url); ?>">
										<img class="result__image" src="<?php echo esc_url($user_images['profile_picture']); ?>">
									</a>
									<h4 class="result__title"><a href="<?php echo esc_url($member_profile_url); ?>"><?php echo esc_html($user_full_name); ?></a></h4>
									<a href="<?php echo esc_url($member_profile_url); ?>" class="button result__button">View Now</a>
									<?php echo nab_amplify_bp_get_friendship_button($member_user_id); ?>
									<!-- <a href="#" class="link _plus result__message">Message Rep</a> -->
									<?php /* <img src="<?php echo esc_url($user_images['banner_image']); ?>" alt="Cover Image"> */ ?>
								</div>
							</li>
						<?php
						}
						?>
					</ul>
				</div>
			<?php
			}

			$get_search_term_id = '';

			$company_prod_args = array(
				'post_type'			=> 'company-products',
				'post_status'		=> 'publish',
				'posts_per_page'	=> 5,
				's'					=> $search_term,
			);

			if ( ! empty( $search_term ) ) {

				$category_search_array = array();

				$get_search_term_id = get_term_by( 'name', $search_term, 'company-product-category' );

				if ( $get_search_term_id ) {

					$category_search_array[]	= $get_search_term_id->term_id;
				}

				$get_search_product_tag	= get_term_by( 'name', $search_term, 'company-product-tag' );

				if ( $get_search_product_tag ) {

					$category_search_array[]	= $get_search_product_tag->term_id;
				}

				if ( count( $category_search_array ) > 0 ) {

					$company_prod_args[ '_tax_search' ] = $category_search_array;
				}

			}

			$company_prod_query = new WP_Query($company_prod_args);

			if ($company_prod_query->have_posts()) {

				$search_found		= true;
				$total_company_prod = $company_prod_query->found_posts;
			?>
				<div class="search-section amp-item-main company-products">
					<div class="search-section-heading">
						<h2><strong>Products</strong> <span>(<?php echo esc_html($total_company_prod . ' Results'); ?>)</span></h2>
						<?php
						if ($total_company_prod > 5) {

							$view_more_link = add_query_arg(array('s' => $search_term, 'v' => 'product'), $current_site_url);

						?>
							<div class="section-view-more">
								<a href="<?php echo esc_html($view_more_link); ?>" class="view-more-link">View All</a>
							</div>
						<?php
						}
						?>
					</div>
					<ul class="colgrid _5up" id="company-products-list">
						<?php
						while ($company_prod_query->have_posts()) {

							$company_prod_query->the_post();

							$thumbnail_url      = nab_amplify_get_featured_image( get_the_ID(), true, nab_product_company_placeholder_img() );
							$product_link	    = get_the_permalink();
							$company_id			= get_field('nab_selected_company_id', get_the_ID());
							$product_company	= !empty($company_id) ? get_the_title($company_id) : '';
							$product_medias     = get_field('product_media');
						?>
							<li>
								<div class="result _content">
									<?php $thumbnail_url = '';
										if (!empty($product_medias[0]['product_media_file'])) {
											$thumbnail_url = $product_medias[0]['product_media_file']['url'];
										} else {
											$thumbnail_url =  !empty($thumbnail_url) ?  $thumbnail_url : nab_product_company_placeholder_img();
										} 
									?>
									<a href="<?php echo esc_url($product_link); ?>">
										<img src="<?php echo esc_url($thumbnail_url); ?>" class="result__image" alt="Product Image">	
									</a>
									<?php nab_get_product_bookmark_html(get_the_ID(), 'user-bookmark-action'); ?>
									<h4 class="result__title"><a href="<?php echo esc_url($product_link); ?>"><?php echo esc_html(get_the_title()); ?></a></h4>
									<h5 class="result__lede"><?php echo esc_html($product_company); ?></h5>
									<a href="<?php echo esc_url($product_link); ?>" class="button result__button">View Now</a>
								</div>
							</li>
						<?php
						}
						?>
					</ul>
				</div>
			<?php
			}
			wp_reset_postdata();

			$company_args = array(
				'post_type'			=> 'company',
				'post_status'		=> 'publish',
				'posts_per_page'	=> 5,
				's'					=> $search_term
			);

			if ( ! empty( $search_term ) ) {

				if ( $get_search_term_id ) {

					$company_args[ '_meta_company_term' ] = $get_search_term_id->term_id;
				}
			}

			$company_query = new WP_Query($company_args);

			if ($company_query->have_posts()) {

				$search_found	= true;
				$total_company	= $company_query->found_posts;
			?>
				<div class="search-section search-company-section">
					<div class="search-section-heading">
						<h2><strong>Companies</strong> <span>(<?php echo esc_html($total_company . ' Results'); ?>)</span></h2>
						<?php
						if ($total_company > 5) {

							$company_view_more_link = add_query_arg(array('s' => $search_term, 'v' => 'company'), $current_site_url);

						?>
							<div class="section-view-more">
								<a href="<?php echo esc_html($company_view_more_link); ?>" class="view-more-link">View All</a>
							</div>
						<?php
						}
						?>
					</div>
					<ul class="colgrid _5up" id="search-company-list">
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
							$featured_image     = nab_amplify_get_featured_image( get_the_ID(), false );
							$profile_picture  	= $featured_image;
							$company_url		= get_the_permalink();
						?>
							<li>
								<div class="result">
									<?php if ($profile_picture) { ?>
										<img class="result__image" src="<?php echo esc_url($profile_picture); ?>" alt="<?php echo esc_html(get_the_title()); ?> Profile Picture" />
									<?php } else { ?>
										<div class="result__image no-image-avtar"><?php echo mb_strimwidth(get_the_title(), 0, 20, '...'); ?></div>
									<?php } ?>
									<h4 class="result__title"><?php echo esc_html(get_the_title()); ?></h4>
									<a href="<?php echo esc_url($company_url); ?>" class="button result__button">View Now</a>
									<?php
										if ($company_poc !== '' && !empty($company_poc)) {
											if ($user_logged_in) { ?>
											   <a href="javascript:void(0);" class="link _plus result__message" data-comp-id="<?php echo esc_attr(get_the_ID()); ?>">Message Rep</a>
										   <?php
											} else {
												$current_url = home_url(add_query_arg(null, null));
												$current_url = str_replace('amplify/amplify', 'amplify', $current_url); ?>
											   <a href="<?php echo esc_url(add_query_arg(array( 'r' => $current_url ), wc_get_page_permalink('myaccount'))); ?>" class="link _plus result__message">Message Rep</a>
										   <?php
											}
										}
									?>
									<?php /* <img src="<?php echo esc_url($cover_image); ?>" alt="Cover Image"> */?>
								</div>
							</li>
						<?php
						}
						?>
					</ul>
				</div>
			<?php
			}
			wp_reset_postdata();

			$product_args = array(
				'post_type' 		=> 'product',
				'post_status'		=> 'publish',
				'posts_per_page' 	=> 5,
				's'					=> $search_term,
				'meta_key'  		=> 'total_sales',
				'orderby'   		=> 'meta_value_num',
				'order' 			=> 'DESC'
			);

			$product_args['tax_query'] = array(
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'slug',
					'terms'    => array( 'exclude-from-search' ),
					'operator' => 'NOT IN',
				)
			);

			$product_query = new WP_Query($product_args);

			if ($product_query->have_posts()) {

				$search_found	= true;
				$total_products = $product_query->found_posts;
			?>
				<div class="search-section search-product-section">
					<div class="search-section-heading">
						<h2><strong>Shop</strong> <span>(<?php echo esc_html($total_products . ' Results'); ?>)</span></h2>
						<?php
						if ($total_products > 5) {

							$poroduct_view_more_link = add_query_arg(array('s' => $search_term, 'v' => 'shop'), $current_site_url);

						?>
							<div class="section-view-more">
								<a href="<?php echo esc_html($poroduct_view_more_link); ?>" class="view-more-link">View All</a>
							</div>
						<?php
						}
						?>
					</div>
					<ul class="colgrid _5" id="search-product-list">
						<?php
						while ($product_query->have_posts()) {

							$product_query->the_post();
							$product_link	= get_the_permalink();

						?>
							<li>
								<div class="result _content">
									<?php
										$thumbnail_url = nab_amplify_get_featured_image( get_the_ID(), true, nab_product_company_placeholder_img() );
									?>
									<a href="<?php echo esc_url($product_link); ?>">
										<img src="<?php echo esc_url($thumbnail_url); ?>" class="result__image" alt="Product Image">	
									</a>
									<?php nab_get_product_bookmark_html(get_the_ID(), 'user-bookmark-action'); ?>
									<h4 class="result__title"><a href="<?php echo esc_url($product_link); ?>"><?php echo esc_html(get_the_title()); ?></a></h4>
									<a href="<?php echo esc_url($product_link); ?>" class="button result__button">View Now</a>
								</div>
							</li>
						<?php
						}
						?>
					</ul>
				</div>
			<?php
			}
			wp_reset_postdata();

			$event_args		= array(
				'post_type'			=> 'tribe_events',
				'posts_per_page'	=> 5,
				'post_status'		=> 'publish',
				's'					=> $search_term,
				'meta_key'			=> '_EventStartDate',
				'orderby'			=> 'meta_value',
				'order'				=> 'ASC'
			);

			$event_query = new WP_Query( $event_args );

			if ( $event_query->have_posts() ) {

				$search_found	= true;
				$total_event	= $event_query->found_posts;
				?>
				<div class="search-section search-content-section">
					<div class="search-section-heading">
						<h2><strong>Events</strong> <span>(<?php echo esc_html( $total_event . ' Results' ); ?>)</span></h2>
						<?php
						if ( $total_event > 5 ) {

							$event_view_more_link = add_query_arg( array('s' => $search_term, 'v' => 'event'), $current_site_url );
							?>
							<div class="section-view-more">
								<a href="<?php echo esc_html($event_view_more_link); ?>" class="view-more-link">View All</a>
							</div>
							<?php
						}
						?>
					</div>
					<ul class="colgrid _5up" id="search-event-list">
						<?php
						while ( $event_query->have_posts() ) {

							$event_query->the_post();

							$event_post_id		= get_the_ID();
							$thumbnail_url      = nab_amplify_get_featured_image( get_the_ID(), true, nab_product_company_placeholder_img() );
							$event_start_date   = get_post_meta( $event_post_id, '_EventStartDate', true);
							$event_end_date     = get_post_meta( $event_post_id, '_EventEndDate', true);
							$website_link 		= get_post_meta( $event_post_id, '_EventURL', true );
							$website_link		= ! empty( $website_link ) ? trim( $website_link ) : get_the_permalink();
							$target				= 0 === strpos( $website_link, $current_site_url ) ? '_self' : '_blank';
							$event_date			= date_format( date_create( $event_start_date ), 'l, F j' );
							$event_month        = date_format( date_create( $event_start_date ), 'F' );
							$event_day          = date_format( date_create( $event_start_date ), 'j' );

							if ( ! empty( $event_start_date ) && ! empty( $event_end_date ) ) {

								if ( date_format( date_create( $event_start_date ), 'Ymd' ) !== date_format( date_create( $event_end_date ), 'Ymd' ) ) {

									$event_date .= ' - ' . date_format( date_create( $event_end_date ), 'l, F j' );
								}
							}

							?>
							<li>
								<a class="event" href="<?php echo esc_url( $website_link ); ?>" target="<?php echo esc_attr( $target ); ?>">
									<div class="event__date">
									    <div class="event__month">
									        <?php echo esc_html( $event_month ); ?>
									    </div>
									    <div class="event__day text-gradient _blue">
									        <?php echo esc_html( $event_day ); ?>
									    </div>
									</div>
									<div class="event__photo">
									    <img class="event__image" src="<?php echo esc_url( $thumbnail_url ); ?>" alt="event thumbnail" />
									</div>
									<div class="event__info">
									    <h4 class="event__title">
									        <?php echo esc_html( get_the_title() ); ?>
									    </h4>
									    <div class="event__link link _plus">
									        Learn More
									    </div>
									</div>
								</a>
							</li>
						<?php
						}
						?>
					</ul>
				</div>
				<?php
			}
			wp_reset_postdata();

			$all_post_types = nab_get_search_post_types();

			$content_args = array(
				'post_type' 		=> $all_post_types,
				'posts_per_page' 	=> 5,
				'post_status'		=> 'publish',
				's'					=> $search_term,
				'meta_query'		=> array(
					'relation'	=> 'OR',
					array(
						'key'		=> '_yoast_wpseo_meta-robots-noindex',
						'value'		=> 'completely',
						'compare'	=> 'NOT EXISTS'
					),
					array(
						'key'		=> '_yoast_wpseo_meta-robots-noindex',
						'value'		=> '1',
						'compare'	=> '!='
					)
				),
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
						<h2><strong>Content</strong> <span>(<?php echo esc_html($total_content . ' Results'); ?>)</span></h2>
						<?php
						if ($total_content > 5) {

							$content_view_more_link = add_query_arg(array('s' => $search_term, 'v' => 'content'), $current_site_url);
						?>
							<div class="section-view-more">
								<a href="<?php echo esc_html($content_view_more_link); ?>" class="view-more-link">View All</a>
							</div>
						<?php
						}
						?>
					</div>
					<ul class="colgrid _5up" id="search-content-list">
						<?php
						while ($content_query->have_posts()) {

							$content_query->the_post();

							$thumbnail_url = nab_amplify_get_featured_image( get_the_ID() );
							$post_link		= get_the_permalink();
							?>
							<li>
								<a href="<?php echo esc_url($post_link); ?>" class="result _content">
									<img class="result__image" src="<?php echo esc_url($thumbnail_url); ?>" alt="content thumbnail" />
									<h4 class="result__title"><?php echo esc_html(get_the_title()); ?></h4>
								</a>
							</li>
						<?php
						}
						?>
					</ul>
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
</div><!-- .container -->
<!-- END legacy-template -->
<?php
get_footer();
