<?php
/**
 * Template part for displaying thought gallery single post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NABShow_LV
 */

$tax_thought_galleries  = get_the_terms( get_the_ID(), 'thought-gallery-category' );
$tags_thought_galleries = get_the_terms( get_the_ID(), 'thought-gallery-tags' );
?>
<article class="post-wrap post-details post-list">
	<?php
	if ( $tax_thought_galleries && ! is_wp_error( $tax_thought_galleries ) ) {
		$i = 0;
		foreach ( $tax_thought_galleries as $tax_thought_gallery ) {
			$i ++;
			$cat_link = get_term_link( $tax_thought_gallery->slug, 'thought-gallery-category' );
			if ( $cat_link && ! is_wp_error( $cat_link ) ) {
				?>
                <a href="<?php echo esc_url( $cat_link ); ?>"
                   title="<?php echo esc_attr( $tax_thought_gallery->name ); ?>" rel="tag"
                   class="cat-info <?php echo esc_attr( $tax_thought_gallery->slug ); ?>"><?php echo esc_html( $tax_thought_gallery->name ); ?></a>
				<?php
				if ( sizeof( $tax_thought_galleries ) > $i ) {
					?>
                    ,
					<?php
				}
			}
		}
	}
	?>
    <h3 class="post-title is-medium-title">
        <a href="<?php echo esc_url( get_the_permalink() ); ?>"
           rel="bookmark"><?php echo esc_html( get_the_title() ); ?></a>
    </h3>
    <div class="post-meta-info">
        <span class="meta-info-decs">by</span>
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"> <?php echo esc_html( get_the_author() ); ?> </a>
    </div>
    <img width="350" height="350"
         src="<?php echo has_post_thumbnail() ? esc_url( get_the_post_thumbnail_url() ) : esc_url( nabshow_lv_get_empty_thumbnail_url() ); ?>"
         alt="<?php echo esc_attr( get_the_title() ); ?>"/>
    <p class="post-excerpt"><?php the_content(); ?></p>
    <div class="tag-icon-list">
        <ul class="detailstag">
			<?php
			if ( $tags_thought_galleries && ! is_wp_error( $tags_thought_galleries ) ) {
				foreach ( $tags_thought_galleries as $tags_thought_gallery ) {
					$tag_link = get_term_link( $tags_thought_gallery->slug, 'thought-gallery-tags' );
					if ( $tag_link && ! is_wp_error( $tag_link ) ) {
						?>
                        <li>
                            <a href="<?php echo esc_url( $tag_link ); ?>"><?php echo esc_html( $tags_thought_gallery->name ); ?></a>
                        </li>
						<?php
					}
				}
			}
			?>
        </ul>
        <ul class="icontag">
            <li><a href="#"> Icons </a></li>
            <li><a href="#"> Icons </a></li>
            <li><a href="#"> Icons </a></li>
            <li><a href="#"> Icons </a></li>
        </ul>
    </div>
    <div class="author-section">
        <div class="author-info">
            <div class="author-avatar">
                <img alt="" src="http://nabshow.md-staging.com/wp-content/uploads/2019/07/related-content-logo.jpg"
                     class="avatar photo" width="160">
            </div>
            <div class="author-user">
                <h3 class="author-heading">Written by Contributor</h3>
                <p class="author-description"> Nisl pretium fusce id velit ut tortor pretium. Egestas purus viverra
                    accumsan in nisl nisi. Tristique senectus et netus et malesuada fames ac turpis. Metus aliquam
                    eleifend mi in nulla posuere. Sit amet mauris commodo quis imperdiet massa.<a class="author-link"
                                                                                                  href="#" rel="author">
                        Read More </a>
                </p>
            </div>
        </div>
    </div>
    <div class="single-post-navigation">
		<?php
		$prev_post = wpcom_vip_get_adjacent_post( false, '', true );
		if ( $prev_post ) {
			$prev_title = wp_strip_all_tags( str_replace( '"', '', $prev_post->post_title ) );
			?><a rel="prev" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>"
                 title=" <?php echo esc_attr( $prev_title ); ?>" class="prev"><i
                    class="post-nav-icon fa fa-3x fa-angle-left"></i><span
                    class="post-nav-title-label"> Previous post</span> <span
                    class="post-nav-title"><?php echo esc_html( $prev_title ); ?></span></a>
			<?php
		}
		?>
		<?php
		$next_post = wpcom_vip_get_adjacent_post( false, '', false );
		if ( $next_post ) {
			$next_title = wp_strip_all_tags( str_replace( '"', '', $next_post->post_title ) );
			?>
            <a rel="next" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>"
               title="<?php echo esc_attr( $next_title ); ?>" class="next"><span
                        class="post-nav-title-label">Next Post</span><span
                        class="post-nav-title"><?php echo esc_html( $next_title ); ?></span><i
                        class="post-nav-icon fa fa-3x fa-angle-right"></i></a>
			<?php
		}
		?>
    </div>
</article>