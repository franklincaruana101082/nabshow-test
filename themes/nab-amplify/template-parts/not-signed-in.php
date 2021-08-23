<div class="container">
	<div class="notsignedin nabblock">

		<?php dynamic_sidebar('session-not-logged-in'); ?>
		
		<div class="intro__cta">
			<?php
			$referring_url = get_permalink( get_queried_object_id() );
			$sign_up_page = get_page_by_path( NAB_SIGNUP_PAGE ); // @todo later replace this with VIP function
			if ( isset( $sign_up_page ) && ! empty( $sign_up_page ) ) {
				$sign_up_page_url = get_permalink( $sign_up_page->ID );
			?>
			<a href="<?php echo esc_url( $sign_up_page_url  . '?r=' . $referring_url ); ?>" class="button _gradientpink"><?php esc_html_e( 'Sign Me Up', 'nab-amplify' ); ?></a>
			<?php } ?>

			
			<a class="" href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' )  . '?r=' . $referring_url ); ?>"><?php esc_html_e( 'Already on NAB Amplify? Sign In', 'nab-amplify' ); ?></a>
		</div> 
	</div>
</div>


<?php
get_footer();