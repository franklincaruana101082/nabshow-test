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
			<?php
			if ( is_user_logged_in() ) {
				?>
				<a href="#respond" class="navigate-reply btn">Add Comment</a>
				<?php
			}
			?>
		</div>
		<div class="comment-header">
			<h3 class="comments-title">
				<?php
				printf(
					/* translators: 1: title. */
					esc_html__( 'Responses', 'nab-amplify')
				);
				printf(' <span class="text-gradient">('.get_comments_number( get_the_ID() ).')</span>');
				?>
			</h3><!-- .comments-title -->
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
			</div>
		</div>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			$order_by = isset($_GET['orderby']) ? $_GET['orderby'] : 'DESC';
			$comments = get_comments( array( 'order' => $order_by, 'post_id' => get_the_ID() ) );
			wp_list_comments(
				array(
					'walker'	 => new Custom_Walker_Comment(),
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

	if ( is_user_logged_in() ) {
		comment_form();
	}
	?>

</div><!-- #comments -->
