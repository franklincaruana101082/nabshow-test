<?php
$post_id           = get_the_ID();
$author_id         = get_the_author_meta( 'ID' );
$user_images       = nab_amplify_get_user_images( $author_id );
$author_avatar_url = $user_images['profile_picture'];
$author_name    = get_the_author_meta( 'display_name', $author_id );
$author_company    = get_the_author_meta( 'attendee_company', $author_id );
?>
<div class="author-info">
	<div class="author-image">
		<img src="<?php echo esc_url( $author_avatar_url ) ?>" alt="author">
	</div>
	<div class="author-details">
		<h3 class="author-title"><?php echo esc_html( $author_name ) ?></h3>
			<span class="author-subtitle"><?php echo esc_html( $author_company ) ?></span>
	</div>
</div>
