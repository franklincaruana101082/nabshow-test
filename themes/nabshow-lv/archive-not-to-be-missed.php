<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NABShow_LV
 */

get_header();
global $wp_query;
?>

    <div id="primary" class="container">
        <div class="page-main not-to-be-missed">
            <div class="breadcrumbs-nospace">
				<?php
				echo do_shortcode('[nab_yoast_breadcumb]');
				?>
            </div>
            <h1>Not-to-Be-Missed</h1>

            <div class="card-layout">
                <div class="card-filter">
                    <ul class="filter-list" id="filter_list">
                        <li data-term-slug="">All</li>
						<?php
						$featured_category = get_terms( 'featured-category' );

						if ( ! empty( $featured_category ) && ! is_wp_error( $featured_category ) ) {

							foreach ( $featured_category as $category ) {
								?>
                                <li data-term-slug="<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></li>

							<?php }
						}
						?>
                    </ul>
                </div>
                <div class='container loader-container' id="loader_container" style="display: none">
                    <div class="loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                </div>
                <div class="card-columns-box row" id="card_section">
                <?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							get_template_part( 'template-parts/content', 'not-to-be-missed' );
						}
						wp_reset_postdata();
					}
				?>
                </div>
                <div class="loadmore" id="load_more">
                    <a href="javascript:void(0);"
                       data-term-slug=""
                       data-page-number="2"
                       data-total-page="<?php echo absint( $wp_query->max_num_pages ); ?>"
                    >Load More</a>
                </div>
            </div>
        </div>
    </div><!-- #primary -->

<?php
get_footer();
