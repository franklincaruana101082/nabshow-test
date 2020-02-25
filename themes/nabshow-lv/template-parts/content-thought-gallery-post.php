<?php
/**
 * Template part for displaying thought gallery single post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NABShow_LV
 */

$current_post_id        = get_the_ID();
$current_post_title     = get_the_title();
$current_post_link      = get_the_permalink();
$tax_thought_galleries  = get_the_terms( $current_post_id, 'thought-gallery-category' );
$tags_thought_galleries = get_the_terms( $current_post_id, 'thought-gallery-tags' );
?>
<article class="post-wrap post-details post-list">
    <div class="feature-image">
        <img width="350" height="350" src="<?php echo has_post_thumbnail() ? esc_url( get_the_post_thumbnail_url() ) : esc_url( nabshow_lv_get_empty_thumbnail_url() ); ?>" alt="<?php echo esc_attr( $current_post_title ); ?>"/>
    </div>

	<?php the_content(); ?>

	<?php
	if ( $tax_thought_galleries && ! is_wp_error( $tax_thought_galleries ) ) {
		$i = 0;
		?>
        <div class="cat-list-main">
            <span>Category:</span>
			<?php
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
			?>
        </div>
		<?php
	}
	?>

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
		<?php
		$facebook_link  = "https://www.facebook.com/sharer.php?u=" . $current_post_link;
		$twitter_link   = "https://twitter.com/intent/tweet?url=" . $current_post_link . "&text=" . $current_post_title;
		$mailto_link    = "mailto:?subject=" . $current_post_title . "&body=Check out this link: " . $current_post_link;
		$linkedin_link  = "https://www.linkedin.com/shareArticle?url=" . $current_post_link . "&title=" . $current_post_title;
		?>
        <ul class="social-share">
            <li class="shareText">Share:&nbsp;</li>
            <li><a href="<?php echo esc_url( $facebook_link ); ?>" class="facebook" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=1080');return false;"><i class="fa fa-facebook-f"></i></a></li>
            <li><a href="<?php echo esc_url( $twitter_link ); ?>" class="twitter" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=1080');return false;"><i class="fa fa-twitter"></i></a></li>
            <li><a href="<?php echo esc_url( $mailto_link ); ?>" class="envelope"><i class="fa fa-envelope"></i></a></li>
            <li><a href="<?php echo esc_url( $linkedin_link ); ?>" class="linkedin" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=1080');return false;"><i class="fa fa-linkedin"></i></a></li>
        </ul>
    </div>

	<?php
	$current_author_id  = get_the_author_meta('ID');
	$author_image       = nabshow_lv_get_author_avatar_url( $current_author_id );
	$contributor_info   = wp_strip_all_tags( get_field( 'bio',  'user_' . $current_author_id ) );
	?>

    <div class="author-section">
        <div class="author-info">
            <div class="author-avatar">
                <img alt="author-img" src="<?php echo esc_url( $author_image ); ?>" class="avatar photo" width="160">
            </div>

            <div class="author-user">
                <h3 class="author-heading"><?php echo esc_html( nabhsow_lv_current_author_name() ); ?></h3>
                <p class="author-description"><?php echo esc_html( mb_strimwidth( $contributor_info, 0, 253, '...' ) ); ?> <a class="author-link detail-list-modal-popup" data-posttype="thought-gallery" data-userid="<?php echo esc_attr( $current_author_id ); ?>" href="#" rel="author">Read More</a></p>
            </div>
        </div>
    </div>

    <div class="single-post-navigation">
		<?php

		$prev_post = wpcom_vip_get_adjacent_post( false, '', true );

		if ( $prev_post ) {

			$prev_title = wp_strip_all_tags( str_replace( '"', '', $prev_post->post_title ) );
			?>
            <a rel="prev" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" title=" <?php echo esc_attr( $prev_title ); ?>" class="prev">
                <i class="post-nav-icon fa fa-3x fa-angle-left"></i>
                <span class="post-nav-title-label"> Previous post</span>
                <span class="post-nav-title"><?php echo esc_html( $prev_title ); ?></span>
            </a>
			<?php
		}
		?>
		<?php

		$next_post = wpcom_vip_get_adjacent_post( false, '', false );

		if ( $next_post ) {

			$next_title = wp_strip_all_tags( str_replace( '"', '', $next_post->post_title ) );
			?>
            <a rel="next" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" title="<?php echo esc_attr( $next_title ); ?>" class="next">
                <span class="post-nav-title-label">Next Post</span>
                <span class="post-nav-title"><?php echo esc_html( $next_title ); ?></span>
                <i class="post-nav-icon fa fa-3x fa-angle-right"></i>
            </a>
			<?php
		}
		?>
    </div>
</article>
