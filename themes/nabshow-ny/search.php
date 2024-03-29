<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package NABShow_LV
 */

get_header();

global $wp_query;
$total_posts = $wp_query->found_posts;
$total_paged = $wp_query->max_num_pages;
$post_types_list	= array(
	'all'           => 'All',
	'page'          => 'Page',									
	'sessions'      => 'Session',
	'speakers'      => 'Speaker',
	'channels'		=> 'Channel',
	'exhibitors'	=> 'Exhibitor',
	'news-releases'	=> 'News Release'
);

$nab_mys_urls = get_option( 'nab_mys_urls' );
$show_code    = isset( $nab_mys_urls[ 'show_code' ] ) ? $nab_mys_urls[ 'show_code' ] : 'NABNYDIG20';
?>

	<div id="internal-banner" class="wp-block-nab-multipurpose-gutenberg-block has-full is-block-center has-background-size has-background-opacity has-background-opacity-50" style="background-image:url(https://nabshow.com/ny2020/wp-content/uploads/sites/5/2020/05/homepage-hero.jpg);margin-top:-40px;margin-bottom:40px">
		<div class="wp-block-nab-multipurpose-gutenberg-block has-fixed is-block-center" style="padding-top:40px;padding-bottom:20px"></div>
	</div>
	
	<section id="primary" class="container">
		<main id="main" class="site-main">
			<div class="searchFilterPage">
				<div class="searchTitle">
					<div class="container">
						<div class="row">
							<div class="col-lg-7 col-sm-12">
								<h1 class="title nab-title">
									<?php
									/* translators: %s: search query. */
									printf( esc_html__( 'Search Results for %s', 'nabshow-lv' ), get_search_query() );
									?>
								</h1>
								<p class="sub-caption"><?php echo esc_html( $total_posts ); ?> results found.</p>
							</div>
							<div class="col-lg-5 col-sm-12 main-filter ">
								<div class="search-box">
									<div class="search-item icon-right">
										<?php get_search_form(); ?>
									</div>
								</div>
							</div>
                            <!-- Tab links -->
                            <div class="searchtab col-lg-12">
								<?php
								$site_url           = get_site_url() . '/?s=' . get_search_query();								
								$search_post_type   = filter_input( INPUT_GET, 'post_type', FILTER_SANITIZE_STRING );

								foreach ( $post_types_list as $key => $current_type ) {

									$final_url = 'all' !== $key ? $site_url . '&post_type=' . $key : $site_url;

									if ( ( ! empty( $search_post_type ) && $search_post_type === $key ) || ( empty( $search_post_type ) && 'all' === $key ) ) {
										$link_class = 'tablinks active';
									} else {
										$link_class = 'tablinks';
									}

									?>

                                    <a href="<?php echo esc_url( $final_url ); ?>" class="<?php echo esc_attr( $link_class ); ?>"><?php echo esc_html( $current_type ); ?></a>

									<?php
								}

								?>
                            </div>
						</div>
					</div>
				</div>

				<?php
                    if ( have_posts() ) :
                ?>

                    <div class="searchResult">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <?php
                                    /* Start the Loop */
                                    while ( have_posts() ) :
                                        the_post();

                                        $current_post_id        = get_the_ID();
										$current_post_type      = get_post_type( $current_post_id );
										$search_post_type_list  = $post_types_list;
										$content_type           = isset( $search_post_type_list[ $current_post_type ] ) ? $search_post_type_list[ $current_post_type ] : ucfirst( $current_post_type );

										$search_view_count      = get_post_meta( $current_post_id, 'search_view_count', true );
										$search_view_count      = empty( $search_view_count ) ? 1 : $search_view_count + 1;

										update_post_meta( $current_post_id, 'search_view_count', $search_view_count );

										?>
										<!-- Tab content -->
										<div class="tabcontent">
											<div class="featuredImg">

												<?php

												$logo_url = '';

												if ( has_post_thumbnail() ) {

													$logo_url = get_the_post_thumbnail_url();

												} else {

													switch ( $current_post_type ) {

														case 'page':
															$logo_url = nabshow_lv_get_empty_thumbnail_url();
															break;
														case 'sessions':
															$logo_url = nabshow_lv_get_session_thumbnail_url();
															break;
														case 'speakers':
															$logo_url = nabshow_lv_get_speaker_thumbnail_url();
															break;														
														default:
															$logo_url = nabshow_lv_get_empty_thumbnail_url();
													}
												}
												?>

												<img src="<?php echo esc_url( $logo_url ); ?>" alt="search-logo" />
											</div>
											<div class="tabInfo">
												<h3>
												<?php
													if ( 'speakers' === $current_post_type ) {
														?>
														<a href="#" class="speaker-detail-list-modal" data-postid="<?php echo esc_attr( $current_post_id ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
														<?php
													} else if ( 'exhibitors' === $current_post_type ) {
														
														$exh_id		= get_post_meta( $current_post_id, 'exhid', true );
														$exh_url	= 'https://' . $show_code . '.mapyourshow.com/8_0/exhibitor/exhibitor-details.cfm?exhid=' . $exh_id;
														
														?>
														<a href="<?php echo esc_url( $exh_url ); ?>" target="_blank"><?php echo esc_html( get_the_title() ); ?></a>
														<?php													
													} else {
														?>
														<a href="<?php echo esc_url( get_the_permalink( $current_post_id ) ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
														<?php
													}
												?>
												</h3>
												<h4><?php echo esc_html( $content_type ); ?></h4>
												<p><?php echo esc_html( nabshow_lv_excerpt() ); ?></p>
											</div>
										</div>
										<?php

                                    endwhile;
                                    ?>

                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                <?php
                                    if ( $total_paged > 1 )  {

                                        // get the current page
	                                    $current_page =  max( 1, get_query_var('paged') );

	                                    $allowed_tags = [
                                                'ul' => [
                                                    'class' => []
                                                ],
                                                'li' => [],
	                                            'span' => [
                                                    'class' => [],
                                                    'aria-current' => [],
                                                ],
                                                'a'    => [
                                                    'class' => [],
                                                    'href'  => [],
                                                ],
                                            ];

	                                    echo wp_kses( paginate_links( array(
                                                    'base'     => get_pagenum_link(1) . '%_%',
                                                    'format'   => '&paged=%#%',
                                                    'current'  => $current_page,
                                                    'total'    => $total_paged,
                                                    'add_args' => array( 'post_type' => $search_post_type ),
                                                    'mid_size' => 4,
                                                    'type'     => 'list'
                                                )
                                            ),
		                                    $allowed_tags
                                        );
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
				else :

					get_template_part( 'template-parts/content', 'search-none' );

				endif;
				?>
				<?php
				dynamic_sidebar( 'footer-advertisement-sidebar' );
				?>
			</div>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
