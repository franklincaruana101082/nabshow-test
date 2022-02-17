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

$total_posts    = wp_count_posts( 'news-releases' )->publish;
$posts_per_page = get_option( 'posts_per_page' );

?>
	<div class="news-release-head">		
		<div class="custom-rainbow-banner-main has-full">
			<div class="wp-block-nab-multipurpose-gutenberg-block has-fixed">
				<h1>News Releases</h1>
			</div>
		</div>
		<div id="primary" class="container page-main">
	        <div class="breadcrumbs-nospace">
	            <?php
	                echo do_shortcode('[nab_yoast_breadcumb]');
	            ?>
	        </div>
	        <div class="news-releases-main">	           
	            <div class="row related-content-rowbox" id="news-release-archive">
	                <div class='container loader-container' id="loader_container" style="display: none">
	                    <div class="loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
	                </div>
	                <?php
	                if ( have_posts() ) {

	                    while ( have_posts() ) {

	                        the_post();
	                        get_template_part( 'template-parts/content', 'news-releases' );
	                    }
	                }

	                if ( $total_posts > $posts_per_page ) {
	                    ?>

	                    <div class="loadMoreArticles text-center" id="load-more-news">
	                        <a href="javascript:void(0);" class="btn-default" data-page-number="2" data-total-page="<?php echo absint( $wp_query->max_num_pages ); ?>">Load More</a>
	                    </div>
	                    <?php
	                }
	                ?>
	            </div>
	        </div>
		</div><!-- #primary -->
	</div>
<?php
get_footer();
