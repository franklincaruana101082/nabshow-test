<?php
/**
 * Block: RSVP
 * ARI
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/tickets/v2/rsvp/ari.php
 *
 * See more documentation about our Blocks Editor templating system.
 *
 * @link {INSERT_ARTICLE_LINK_HERE}
 *
 * @since 4.12.3
 *
 * @version 4.12.3
 */

?>
<div class="tribe-tickets__rsvp-ar tribe-common-g-row tribe-common-g-row--gutters">

	<div class="tribe-tickets__rsvp-ar-sidebar-wrapper tribe-common-g-col">
		<?php $this->template( 'v2/rsvp/ari/sidebar', [ 'rsvp' => $rsvp ] ); ?>
	</div>

	<div class="tribe-tickets__rsvp-ar-form-wrapper tribe-common-g-col">
		<?php $this->template( 'v2/rsvp/ari/form', [ 'rsvp' => $rsvp ] ); ?>
	</div>

</div>
