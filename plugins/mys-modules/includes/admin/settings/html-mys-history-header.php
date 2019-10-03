<?php
/**
 * Admin Class
 *
 * @package MYS Modules
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

//Prevent  unauthorized users
if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_html_e( 'You do not have sufficient permissions to access this page.' ) );
}

$page_groupid               = $this->page_groupid;
$allowed_tags               = $this->allowed_tags;
$request_data               = $this->request_data;
$history_search             = isset( $request_data['s'] ) ? $request_data['s'] : '';
$filtered_user              = isset( $request_data['user'] ) ? $request_data['user'] : '';
$users                      = isset ( $request_data['all_users'] ) ? $request_data['all_users'] : '';
$history_total              = (int) $this->history_total;
$history_listing_url        = $request_data['history_listing_url'];
$page_for                   = isset( $request_data['page_for'] ) ? $request_data['page_for'] : '';
$last_page_no               = $request_data['last_page_no'];
$html_link_first_page       = $request_data['html_link_first_page'];
$html_link_prev_page        = $request_data['html_link_prev_page'];
$html_link_next_page        = $request_data['html_link_next_page'];
$html_link_last_page        = $request_data['html_link_last_page'];
$current_url_without_pageno = $request_data['current_url_without_pageno'];
$clear_url                  = 'listing' === $this->page_template ? $history_listing_url : $history_listing_url . "&groupid=" . $page_groupid . '&order=asc';
$clear_url                  = ! empty( $history_search ) ? $clear_url . "&s=" . $history_search : $clear_url;
$back_url                   = "<a class='back-url' href='" . $history_listing_url . "'>Back to Listing</a>";
?>
<div class="mys-section-left history-page wp-core-ui">
	<div class="mys-main-table res-cl ">
		<div class="mys-history-title">
			<h2>History <?php echo esc_html( $page_for ); ?></h2>
			<?php echo ! empty( $page_for ) ? wp_kses( $back_url, $allowed_tags ) : ''; ?>
			<form method="get" name="history-search" class="history-search-form">
				<input type="hidden" name="page" value="mys-history"/>
				<input type="hidden" name="groupid" value="<?php echo esc_attr__( $page_groupid ); ?>"/>
				<select name="data_type">
					<option value="all">Search in</option>
					<option value="all" <?php echo 'all' === $request_data['data_type'] ? 'selected' : ''; ?>>Everywhere</option>
					<option value="exhibitors" <?php echo 'exhibitors' === $request_data['data_type'] ? 'selected' : ''; ?>>Exhibitors</option>
					<option value="sessions" <?php echo 'sessions' === $request_data['data_type'] ? 'selected' : ''; ?>>Sessions</option>
					<option value="speakers" <?php echo 'speakers' === $request_data['data_type'] ? 'selected' : ''; ?>>Speakers</option>
					<option value="sponsors" <?php echo 'sponsors' === $request_data['data_type'] ? 'selected' : ''; ?>>Sponsors</option>
					<option value="tracks" <?php echo 'tracks' === $request_data['data_type'] ? 'selected' : ''; ?>>Tracks</option>
				</select>
				<p class="search-box">
					<input type="search" name="s" value="<?php echo esc_attr__( $history_search ); ?>" placeholder="Exhibitors, Sessions, Speakers, etc."/>
					<input type="submit" value="Search" class="button"/>
				</p>
			</form>
		</div>
		<form method="get" name="history-update" class="history-form">
			<div class="tablenav top history-tablenav">
				<!--<form method="get" name="history-update" class="history-form">-->
				<input type="hidden" name="page" value="mys-history"/>

				<?php if ( 'detail' === $this->page_template ) { ?>
					<input type="hidden" name="groupid" value="<?php echo esc_attr__( $page_groupid ); ?>"/>
					<input type="hidden" name="s" value="<?php echo esc_attr__( $history_search ); ?>"/>
				<?php } ?>

				<div class="alignleft actions">
					<?php if ( 'listing' === $this->page_template ) { ?>
						<label for="from_date">From: </label><input name="from_date" type="text" class="enable_date" placeholder="YYYY-MM-DD" value="<?php echo esc_attr( $request_data['from_date'] ); ?>">
						<label for="to_date">To: </label><input name="to_date" type="text" class="enable_date" placeholder="YYYY-MM-DD" value="<?php echo esc_attr( $request_data['to_date'] ); ?>">
					<?php } ?>
					<select name="data_type">
						<option value="all">Data Type</option>
						<option value="all">All</option>
						<?php if ( 'detail' === $this->page_template ) { ?>
							<option value="exhibitors" <?php echo 'exhibitors' === $request_data['data_type'] ? 'selected' : ''; ?>>Exhibitors</option>
							<option value="sessions" <?php echo 'sessions' === $request_data['data_type'] ? 'selected' : ''; ?>>Sessions</option>
							<option value="speakers" <?php echo 'speakers' === $request_data['data_type'] ? 'selected' : ''; ?>>Speakers</option>
							<option value="sponsors" <?php echo 'sponsors' === $request_data['data_type'] ? 'selected' : ''; ?>>Sponsors</option>
							<option value="tracks" <?php echo 'tracks' === $request_data['data_type'] ? 'selected' : ''; ?>>Tracks</option>
						<?php } else { ?>
							<option value="modified-exhibitors" <?php echo 'modified-exhibitors' === $request_data['data_type'] ? 'selected' : ''; ?>>Exhibitors</option>
							<option value="modified-sessions" <?php echo 'modified-sessions' === $request_data['data_type'] ? 'selected' : ''; ?>>Sessions</option>
						<?php } ?>
					</select>
					<?php if ( 'listing' === $this->page_template ) { ?>
						<select name="user">
							<option value="all">User</option>
							<?php foreach ( $users as $u ) { ?>
								<option value="<?php echo esc_attr__( $u->ID ); ?>" <?php echo $u->ID === (int) $filtered_user ? 'selected' : ''; ?>><?php echo esc_html( $u->display_name ); ?></option>
							<?php } ?>
							<option value="0" <?php echo '0' === $filtered_user ? 'selected' : ''; ?>>CRON</option>
						</select>
					<?php } ?>
					<select name="status">
						<option value="all">Status</option>

						<?php if ( 'detail' === $this->page_template ) { ?>
							<option value="1" <?php echo '5' === $request_data['status'] ? 'selected' : '' ?>>Sync Success</option>
							<option value="0" <?php echo '1' === $request_data['status'] ? 'selected' : '' ?>>Sync In Progress</option>
						<?php } else { ?>
							<option value="1" <?php echo '1' === $request_data['status'] ? 'selected' : '' ?>>Pull Success & Sync In Progress</option>
							<option value="5" <?php echo '5' === $request_data['status'] ? 'selected' : '' ?>>Sync Success</option>
							<option value="0" <?php echo '0' === $request_data['status'] ? 'selected' : '' ?>>Pull In Progress</option>
							<option value="2" <?php echo '2' === $request_data['status'] ? 'selected' : '' ?>>Pull Failed</option>
							<option value="3" <?php echo '3' === $request_data['status'] ? 'selected' : '' ?>>Pull Force Stopped</option>
						<?php } ?>
						<option value="4" <?php echo '4' === $request_data['status'] ? 'selected' : '' ?>>Sync Force Stopped</option>
					</select>
					<input type="submit" class="button history-filter-button" value="Filter">
					<a href='<?php echo esc_url( $clear_url ); ?>'><input type="button" class="button" value="Clear"></a>
					<label for="limit">Limit: </label><input type="text" id="limit" class="short_text" name="limit" value="<?php echo esc_attr__( $request_data['limit'] ); ?>">
					<?php if ( 'detail' === $this->page_template ) { ?>
						<span class="toggle-response"><i class="fa fa-toggle-off"></i> Toggle Responses</span>
					<?php } ?>
				</div>
				<input type="hidden" name="orderby" value="<?php echo esc_attr__( $request_data['orderby'] ) ?>"/>
				<input type="hidden" name="order" value="<?php echo esc_attr__( $request_data['order'] ) ?>"/>
				<input type="hidden" name="paged" value="1"/>
				<?php if ( 1 !== $last_page_no ) { ?>
					<div class="tablenav-pages">
						<span class="displaying-num"><?php echo esc_html( $history_total ); ?> items</span>

						<span class="pagination-links">
										<?php echo wp_kses( $html_link_first_page, $allowed_tags ) ?>
							<?php echo wp_kses( $html_link_prev_page, $allowed_tags ) ?>

                            <span class="paging-input">
											<label for="current-page-selector" class="screen-reader-text">Current Page</label><input class="current-page short_text" id="current-page-selector" type="text" name="paged" value="<?php echo esc_attr( $request_data['paged'] ); ?>" aria-describedby="table-paging">
											<span class="tablenav-paging-text"> of <span class="total-pages"><?php echo esc_html( $last_page_no ); ?></span></span>
										</span>

							<?php echo wp_kses( $html_link_next_page, $allowed_tags ) ?>
							<?php echo wp_kses( $html_link_last_page, $allowed_tags ) ?>
									</span>
					</div>
				<?php } ?>
		</form>
		<br class="clear">
	</div>
