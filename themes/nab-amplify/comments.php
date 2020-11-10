<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Amplify
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<div class="comment-section-title">
			<h2>Discussion</h2>
		</div>
		<div class="comment-header">
			<h3 class="comments-title">
				<?php
				$nab_amplify_comment_count = get_comments_number();
				if ( '1' === $nab_amplify_comment_count ) {
					printf(
						/* translators: 1: title. */
						esc_html__( 'Responses (%1$s)', 'nab-amplify' ),
						'<span>' . wp_kses_post( get_the_title() ) . '</span>'
					);
				} else {
					printf('Responses <span class="comment-count">('._nx( '%1$s', $nab_amplify_comment_count, 'comments title', 'nab-amplify' ).')</span>',
						number_format_i18n( $nab_amplify_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'<span>' . wp_kses_post( get_the_title() ) . '</span>'
					);
				}
				?>
			</h2><!-- .comments-title -->
			<div class="comment-filter">
				<?php
				global $wp;
				?>
				<div class="nab-custom-select">
					<select class="comments-order" data-url="<?php echo home_url( $wp->request ); ?>">
						<option value="">Sort By</option>
						<option value="DESC" <?php if($_GET['orderby'] === 'DESC'){ echo "Selected"; }?>>Latest</option>
						<option value="ASC" <?php if($_GET['orderby'] === 'ASC'){ echo "Selected"; }?>>Oldest</option>
					</select>
				</div>
				<a href="#respond" class="navigate-reply btn">Reply</a>
			</div>
		</div>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			$order_by = isset($_GET['orderby']) ? $_GET['orderby'] : 'DESC';
			$comments = get_comments( array( 'order' => $order_by ) );
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				),$comments
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'nab-amplify' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form();
	?>

</div><!-- #comments -->
