<?php
$post_id           	= get_the_ID();
$author_id         	= get_the_author_meta( 'ID' );
$user_images       	= nab_amplify_get_user_images( $author_id );
$author_avatar_url 	= $user_images['profile_picture'];
$author_company    	= get_the_author_meta( 'attendee_company', $author_id );
$author_full_name 	= get_the_author_meta( 'first_name', $author_id ) . ' ' . get_the_author_meta( 'last_name', $author_id );
$author_link		= ! empty( $author_id ) ? bp_core_get_user_domain( $author_id ) : '#';

if ( empty( trim( $author_full_name ) ) )  {
        
	$author_full_name = get_the_author();
}
?>
<div class="author-info">
	<div class="author-image">
		<a href="<?php echo esc_url( $author_link ); ?>"><img src="<?php echo esc_url( $author_avatar_url ) ?>" alt="author"></a>
	</div>
	<div class="author-details">
		<span class="author-label">Posted by</span>
		<h3 class="author-title"><a href="<?php echo esc_url( $author_link ); ?>"><?php echo esc_html( $author_full_name ) ?></a></h3>
		<span class="author-subtitle"><?php echo esc_html( $author_company ) ?></span>
	</div>
</div>
