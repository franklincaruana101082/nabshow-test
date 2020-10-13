<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Amplify
 */

get_header();

$site_list = get_sites( array( 'site__in' => array(3, 5, 12 ) ) );
//echo '<pre>';
//print_r($all_sites);
//exit;
//$site_list = [3, 5, 12];

//global $wpdb;

$base_prefix = $wpdb->get_blog_prefix(0);
$base_prefix = str_replace( '1_', '’' , $base_prefix );

$limit = absint(10);
$query = '';

// Merge the wp_posts results from all Multisite websites into a single result with MySQL "UNION"
foreach ( $site_list as $site ) {
	
	$posts_table = $base_prefix . $site->blog_id . "_posts";	

	$posts_table = esc_sql( $posts_table );
	$blogs_table = esc_sql( $base_prefix . 'blogs' );

	$query .= "(SELECT $posts_table.ID, $posts_table.post_title COLLATE utf8mb4_unicode_ci as post_title, $posts_table.post_date, $blogs_table.blog_id FROM $posts_table, $blogs_table";
	$query .= " WHERE $posts_table.post_type = 'page'";
	$query .= " AND $posts_table.post_status = 'publish'";
	$query .= " AND $blogs_table.blog_id = {$site->blog_id})";

	if ( $site !== end( $site_list ) ) {
		$query .= " UNION ";
	} else {
		$query .= " ORDER BY post_date DESC LIMIT 0, $limit";
	}
	
}

$network_search_result = $wpdb->get_results( $query );
echo '<pre>';
print_r($network_search_result);
exit;
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'nab-amplify' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

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

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
