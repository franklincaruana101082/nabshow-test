<?php
/**
 * The sidebar template for thought gallery.
 * @package NABShow_LV
 */

$thoughts_gallery_categories = get_terms( 'thought-gallery-category' );
$thoughts_gallery_tags       = get_terms( 'thought-gallery-tags' );

$popularposts = get_transient( 'nab-thought-gallery-most-popular-post' );

if ( false === $popularposts ) {
	$popularposts = new WP_Query(
		array(
			'post_type'      => 'thought-gallery',
			'posts_per_page' => 5,
			'meta_key'       => 'nab_thought_gallery_views_count',
			'orderby'        => 'meta_value_num',
			'order'          => 'DESC'
		)
	);

	set_transient( 'nab-thought-gallery-most-popular-post', $popularposts, 5 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
}
?>
<div class="sidebar-inner">
    <aside class="widget widget_search">
        <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="search" placeholder="Search Though Gallery"
                   value="<?php echo esc_attr( get_search_query() ); ?>" name="s"/>
            <input type="hidden" value="<?php echo esc_attr( 'thought-gallery' ); ?>" name="post_type"/>
            <button>Search</button>
        </form>
    </aside>
    <aside class="widget widget_popular">
        <div class="widget-title">
            <h2>Most Popular</h2>
        </div>
        <ul>
			<?php
			if ( $popularposts->have_posts() ) {
				while ( $popularposts->have_posts() ) {
					$popularposts->the_post();
					?>
                    <li>
                        <a href="<?php echo esc_url( get_the_permalink() ); ?>"> <?php echo esc_html( get_the_title() ); ?> </a>
                    </li>
					<?php
				}
			}
			?>
        </ul>
    </aside>
    <aside class="widget widget_categories">
        <div class="widget-title">
            <h2>Categories</h2>
        </div>
		<?php
		if ( ! empty( $thoughts_gallery_categories ) && ! is_wp_error( $thoughts_gallery_categories ) ) {
			?>
            <ul>
				<?php
				foreach ( $thoughts_gallery_categories as $thoughts_gallery_category ) {
					$cat_link = get_term_link( $thoughts_gallery_category->slug, 'thought-gallery-category' );
					if ( ! is_wp_error( $cat_link ) ) {
						?>
                        <li>
                            <a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $thoughts_gallery_category->name ); ?></a>
                        </li>
						<?php
					}
				}
				?>
            </ul>
			<?php
		}
		?>
    </aside>
    <aside class="widget widget_tags">
        <div class="widget-title">
            <h2>Tags</h2>
        </div>
		<?php
		if ( ! empty( $thoughts_gallery_tags ) && ! is_wp_error( $thoughts_gallery_tags ) ) {
			?>
            <ul>
				<?php
				foreach ( $thoughts_gallery_tags as $thoughts_gallery_tag ) {
					$term_link = get_term_link( $thoughts_gallery_tag->slug, 'thought-gallery-tags' );

					if ( ! is_wp_error( $term_link ) ) {
						?>
                        <li>
                            <a href="<?php echo esc_url( $term_link ); ?>"><?php echo esc_html( $thoughts_gallery_tag->name ); ?></a>
                        </li>
						<?php
					}

				}
				?>
            </ul>
			<?php
		}
		?>
    </aside>
    <aside class="widget widget_contributors">
        <div class="widget-title">
            <h2>Contributors</h2>
        </div>
        <ul>
            <li><a href="#"> Headshots </a></li>
            <li><a href="#"> Headshots </a></li>
            <li><a href="#"> Headshots </a></li>
            <li><a href="#"> Headshots </a></li>
            <li><a href="#"> Headshots </a></li>
            <li><a href="#"> Headshots </a></li>
            <li><a href="#"> Headshots </a></li>
        </ul>
        <a href="#" class="btn-default">View all</a>
    </aside>
</div>