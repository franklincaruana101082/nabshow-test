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
?>

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
								$post_types_list    = nabshow_lv_get_search_result_post_types();
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

                                        /**
                                         * Run the loop for the search to output the results.
                                         * If you want to overload this in a child theme then include a file
                                         * called content-search.php and that will be used instead.
                                         */
                                        get_template_part( 'template-parts/content', 'search' );

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

			</div>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
