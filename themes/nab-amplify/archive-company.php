<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Amplify
 */

get_header();
?>

<main id="primary" class="site-main">
		<div class="nab-search-result-wrapper">
			<div class="search-result-filter">
<?php			
$company_args = array(
	'post_type'			=> 'company',
	'post_status'		=> 'publish',
	'posts_per_page'	=> 12,
);

$company_query = new WP_Query( $company_args );

if ( $company_query->have_posts() ) {

	$total_company	= $company_query->found_posts;
	?>
	<div class="search-view-top-head">
		<h2>COMPANIES</h2>
		
	</div>
	<div class="search-section search-company-section">
		<div class="search-section-details" id="search-company-list">
			<?php

			$default_company_cover 	= get_template_directory_uri() . '/assets/images/search-box-cover.png';
			$user_logged_in			= is_user_logged_in();
			$current_user_id		= $user_logged_in ? get_current_user_id() : '';
			$default_company_pic	= get_template_directory_uri() . '/assets/images/amplify-featured.png';
			$cnt					= 1;

			while ( $company_query->have_posts() ) {

				$company_query->the_post();

				$cover_image        = get_field( 'cover_image' );
				$profile_picture    = get_field( 'profile_picture' );
				$cover_image        = ! empty( $cover_image ) ? $cover_image[ 'url' ] : $default_company_cover;
				$featured_image   	= get_the_post_thumbnail_url();  
				$profile_picture  	= $featured_image;
				$company_url		= get_the_permalink();
				?>
				<div class="search-item">
					<div class="search-item-inner">
						<div class="search-item-cover">
							<img src="<?php echo esc_url( $cover_image ); ?>" alt="Cover Image">
						</div>
						<div class="search-item-info">
							<div class="search-item-avtar">
								<a href="<?php echo esc_url( $company_url ); ?>">
									<?php if ($profile_picture) { ?>
	                                    <img src="<?php echo esc_url($profile_picture); ?>" alt="Compnay Profile Picture" />
	                                <?php } else { ?>
	                                    <div class="no-image-avtar"><?php echo mb_strimwidth(get_the_title(), 0, 20, '...'); ?></div>
	                                <?php } ?>
								</a>
							</div>
							<div class="search-item-content">
								<h4>
									<a href="<?php echo esc_url( $company_url ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
								</h4>
								<div class="amp-actions">
									<?php
									if ( $user_logged_in ) {
										nab_get_follow_button( get_the_ID(), $current_user_id );
									} else {
										?>
										<div class="search-actions">
											<a href="<?php echo esc_url( $company_url ); ?>" class="button">View</a>
										</div>
										<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				if ( 8 === $cnt ) {
					echo wp_kses( nab_get_search_result_ad(), $allowed_tags );
				}

				$cnt++;
			}
			if ( $cnt < 8 ) {
				echo wp_kses( nab_get_search_result_ad(), $allowed_tags );
			}
			?>
		</div>
	</div>
	<?php
}
?>
<p class="no-search-data" style="display: none;">Result not found.</p>
<?php
if ( $company_query->max_num_pages > 1 ) {
	?>
	<div class="load-more text-center"  id="load-more-company">
		<a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="12" data-total-page="<?php echo absint( $company_query->max_num_pages ); ?>">Load More</a>
	</div>
	<?php
}
wp_reset_postdata();
?>
			</div>
</div>
</main>
<?php
get_footer();
