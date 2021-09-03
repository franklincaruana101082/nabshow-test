<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Amplify
 */

$articleTypeClass = '';
if(has_category('video')) {
	$articleTypeClass = '_video';
}

$using_optin = (int)get_field('show_opt_inout_modal');
if($using_optin) {
	$optin_complete = '0';
} else {
	//set as complete if we're not using an opt in
	//for setting up functionality in registration below
	$optin_complete = '1';
}

$company = get_field('nab_selected_company_id');

$show_content = true;

$content_protected = (int)get_field('make_opt_in_required');

$cookieName = 'nab_optin';
if(isset($_COOKIE[$cookieName])) {
	if(stripos($_COOKIE[$cookieName], $company.':') !== false) { //check if opted in OR out
		$using_optin = '0';
		$optin_complete = '1';
	}
	if($content_protected) {
		$show_content = false;
		$optin_complete = '0';
		$using_optin = '1';
		if(stripos($_COOKIE[$cookieName], $company.':1') !== false) { //check if already opted IN
			$show_content = true;
			$optin_complete = '1';
			$using_optin = '0';
		}
	}
} elseif ($content_protected) {
	$show_content = false;
}


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
	    <header class="intro">

			<?php
			the_title( '<h1 class="intro__title entry-title">', '</h1>' );
			echo do_shortcode( '[bookmark]' );
			?>


			<div class="intro__reactions post-action-wrap">
				<div class="post-action-reaction">
					<?php echo do_shortcode( '[reaction_button]' ); ?>
				</div>
			</div>
	    </header><!-- .entry-header -->


	</div>

	<div class="main _contentborder <?=$articleTypeClass;?>">
		<div class="container">
			<div class="post-action-author">
				<?php echo do_shortcode( '[nab_display_author]' ); ?>
			</div>
			<?php
			$content_accessible = get_post_meta( $post->ID, 'content_accessible', true);
			if (!$content_accessible) {
				$content_accessible = get_post_meta( $post->ID, 'make_opt_in_required', true);
			}
			if ( ! is_user_logged_in() && $content_accessible ) {

				get_template_part( 'template-parts/not-signed-in' );

			} else {
			?>
			<div class="content">

				<?php
				if($show_content) {
				?>
				<div style="display: none;">
					<div class="optout__info js-optin_content nabblock"></div>
				</div>
				<?php
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'nab-amplify' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);
				} else {
					the_excerpt();
					?>
					<div style="display: none;">
						<div class="optout__info js-optin_content nabblock"></div>
					</div>
					<?php
				}

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nab-amplify' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>
		<?php } ?>
		</div>
	</div><!-- .entry-content -->
	<?php
	if(is_user_logged_in()) {
		//opt in modal
		if (get_field('show_opt_inout_modal') && get_field('nab_selected_company_id')) {
			//we need these defined here because they may change depending on the template we're adding this to
			$company_id = get_field('nab_selected_company_id');
			$company_name = get_the_title( $company_id );
			$opt_in_required = (int)get_field('make_opt_in_required');
			$occurred_at_type = 'article';
			$displayInline = true;
			$registration_required = false;
			$registered = true;
			$user_id				= get_current_user_id();
			$user					= get_user_by( 'id', $user_id );
			$user_email				= $user->user_email;
			$user_firstname			= get_user_meta( $user_id, "first_name", true);
			$user_lastname			= get_user_meta( $user_id, "last_name", true);
			$user_city 		        = get_user_meta( $user_id, "user_city", true);
			$user_state 		    = get_user_meta( $user_id, "user_state", true);
			$user_country_code		= get_user_meta( $user_id, "user_country", true);
			$user_company			= get_user_meta( $user_id, "attendee_company", true);
			$user_title				= get_user_meta( $user_id, "attendee_title", true);
			$user_ip 				= $_SERVER['REMOTE_ADDR'];
			//use this instead of get_template_part so the partial can access the above php vars from here
			include ( locate_template( 'template-parts/modal-opt-in.php', false, false ) );
		}
	}
	?>
	<footer class="entry-footer">
		<?php nab_amplify_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
