<?php
$post_id           	= get_the_ID();
$post_type			= get_post_type();
$company_id         = get_field('nab_selected_company_id');
$author_id         	= get_the_author_meta('ID');
$user_images       	= nab_amplify_get_user_images($author_id);
$author_avatar_url 	= $user_images['profile_picture'];
$author_company    	= get_the_author_meta('attendee_company', $author_id);
$author_full_name 	= get_the_author_meta('first_name', $author_id) . ' ' . get_the_author_meta('last_name', $author_id);
$author_link		= !empty($author_id) ? bp_core_get_user_domain($author_id) : '#';
if ($post_type === 'company-products') {
	$author_link		= !empty(get_the_permalink($company_id)) ? get_the_permalink($company_id) : '#';
	$author_avatar_url  = nab_amplify_get_featured_image( $company_id, false );
	$author_full_name   = get_the_title($company_id);
}
if (empty(trim($author_full_name))) {

	$author_full_name = get_the_author();
}
?>
<div class="author">
	<div class="author__photo">
		<a href="<?php echo esc_url($author_link); ?>">
			<?php if($author_avatar_url){ ?>
			<img class="author__img" src="<?php echo esc_url($author_avatar_url) ?>" alt="author" />
			<?php }else{ ?>
				<div class="author__noimg no-image-avtar"><?php echo mb_strimwidth($author_full_name, 0, 20, '...'); ?></div>
			<?php } ?>
		</a>
	</div>
	<div class="author__info">
		<!-- <span class="author-label">Posted by</span> -->
		<div class="author__name"><a href="<?php echo esc_url($author_link); ?>"><?php echo esc_html($author_full_name) ?></a></div>
		<?php if ($post_type !== 'company-products') { ?>
			<div class="author__company"><?php echo esc_html($author_company) ?></div>
		<?php } ?>
	</div>
</div>
