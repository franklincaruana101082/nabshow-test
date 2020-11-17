<?php
/**
 * BuddyPress - Members Home
 *
 * @since   1.0.0
 * @version 3.0.0
 */

$test = filter_input( INPUT_GET, "test", FILTER_SANITIZE_STRING );
?>

<?php bp_nouveau_member_hook( 'before', 'home_content' ); ?>

<div class="bp-wrap">
		<?php if ( ! bp_nouveau_is_object_nav_in_sidebar() && 'yes' === $test ) : ?>

			<?php bp_get_template_part( 'members/single/parts/item-nav' ); ?>

		<?php endif; ?>

	<div id="item-body" class="item-body">

		<?php bp_nouveau_member_template_part(); ?>

	</div><!-- #item-body -->
</div><!-- // .bp-wrap -->

<?php bp_nouveau_member_hook( 'after', 'home_content' ); ?>
