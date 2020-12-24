<?php

class Custom_Walker_Comment extends Walker_Comment {

	/**
	 * Outputs a comment in the HTML5 format.	 
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

		$commenter          = wp_get_current_commenter();
		$show_pending_links = ! empty( $commenter['comment_author'] );

		if ( $commenter['comment_author_email'] ) {
			$moderation_note = __( 'Your comment is awaiting moderation.' );
		} else {
			$moderation_note = __( 'Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.' );
		}
		?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<div class="comment-author vcard">
					<div class="comment-avtar">
						<?php
							if ( 0 != $args['avatar_size'] ) {
								echo get_avatar( $comment, 100 );
							}
						?>
					</div>
					<div class="comment-details">
						<div class="comment-meta">
							<?php
							$comment_author = get_comment_author_link( $comment );

							if ( '0' == $comment->comment_approved && ! $show_pending_links ) {
								$comment_author = get_comment_author( $comment );
							}

							printf(
								/* translators: %s: Comment author link. */
								__( '%s <span class="says">says:</span>' ),
								sprintf( '<b class="fn">%s</b>', $comment_author )
							);
							?>
							<div class="comment-like-btn">
								<?php
								nab_get_reaction_buttons( get_comment_ID(), 'comment' );
								?>
							</div>
						</div>
						<div class="comment-metadata">
							<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
								<time datetime="<?php comment_time( 'c' ); ?>">
									<?php
										/* translators: 1: Comment date, 2: Comment time. */
										printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ), get_comment_time() );
									?>
								</time>
							</a>
							<?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .comment-metadata -->

						<?php if ( '0' == $comment->comment_approved ) : ?>
						<em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
						<?php endif; ?>
						<div class="comment-content">
							<?php comment_text(); ?>
						</div><!-- .comment-content -->

						<?php
						if ( '1' == $comment->comment_approved || $show_pending_links ) {
							comment_reply_link(
								array_merge(
									$args,
									array(
										'add_below' => 'div-comment',
										'depth'     => $depth,
										'max_depth' => $args['max_depth'],
										'before'    => '<div class="reply">',
										'after'     => '</div>',
									)
								)
							);
						}
						?>
					</div>
				</div><!-- .comment-author -->
				
			</article><!-- .comment-body -->
		<?php
	}
}