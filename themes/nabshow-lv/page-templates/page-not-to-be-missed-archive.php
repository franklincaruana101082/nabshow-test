<?php
/**
 * Template Name: Not to be missed archive
 *
 * @package  NABShow_LV
 * */
get_header();

$post_type_args  = array(
	'post_type' => 'ntb-missed',
);
$post_type_query = new WP_Query( $post_type_args );

?>
    <div id="primary" class="container">
        <div class="page-main not-to-be-missed">
            <h1><?php wp_title( '' ); ?></h1>

            <div class="card-layout">
                <div class="card-filter">
                    <ul class="filter-list" id="filter_list">
                        <li data-term-slug="">All</li>
						<?php
						$portfolio_category = get_terms( 'portfolio-category' );

						if ( ! empty( $portfolio_category ) && ! is_wp_error( $portfolio_category ) ) {

							foreach ( $portfolio_category as $category ) {
								?>
                                <li data-term-slug="<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></li>

							<?php }
						}
						?>
                    </ul>
                </div>
                <div class='container loader-container' id="loader_container" style="display: none">
                    <div class='loader'>
                        <div class='loader--dot'></div>
                        <div class='loader--dot'></div>
                        <div class='loader--dot'></div>
                        <div class='loader--dot'></div>
                        <div class='loader--dot'></div>
                        <div class='loader--dot'></div>
                        <div class='loader--text'></div>
                    </div>
                </div>
                <div class="card-columns-box row" id="card_section">
					<?php
					if ( $post_type_query->have_posts() ) {
						while ( $post_type_query->have_posts() ) {
							$post_type_query->the_post();

							$all_categories_name = array();
							$categories          = get_the_terms( get_the_ID(), 'portfolio-category' );

							if ( is_array( $categories ) ) {
								foreach ( $categories as $category ) {
									$all_categories_name[] = $category->name;
								}
							}

							$categories_string = implode( ', ', $all_categories_name );
							?>
                            <div class="cards item">
                                <a href="<?php echo esc_url( get_the_permalink() ); ?>">
									<?php the_post_thumbnail(); ?>
                                    <div class="card-details">
                                        <h2 class="title"><?php the_title(); ?></h2>
                                        <span class="sub-category">- <?php echo esc_html( $categories_string ) ?></span>
                                    </div>
                                </a>
                            </div>
							<?php
						}
					}
					?>
                </div>
                <div class="loadmore" id="load_more">
                    <a href="javascript:void(0);"
                       data-term-slug=""
                       data-page-number="2"
                       data-total-page="<?php echo absint( $post_type_query->max_num_pages ); ?>"
                    >Load More</a>
                </div>
            </div>
        </div>
    </div><!-- #primary -->
<?php
get_footer();
