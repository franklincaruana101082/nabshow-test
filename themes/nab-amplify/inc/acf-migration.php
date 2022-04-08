<?php
/**
 * ACF field migration file.
 *
 * @package amplify
 */

add_action( 'admin_menu', 'nab_acf_field_migration_page' );

/**
 * ACF field migration menu
 */
function nab_acf_field_migration_page() {

	add_submenu_page(
		'options-general.php',
		__( 'ACF Field Migration', 'amplify' ),
		__( 'ACF Field Migration', 'amplify' ),
		'manage_options',
		'acf_field_migration',
		'nab_acf_field_migration_page_callback'
	);
}

/**
 * ACF field migration page
 */
function nab_acf_field_migration_page_callback() {
	?>
	<div class="search-settings">
		<h2>ACF Field Migration</h2>
		<form class="acf-field-migration-form" method="post">
			<table class="form-table" role="presentation">
				<tr>
					<th><label for="post_type">Post Type</label></th>
					<td>                        
						<select id="post_type">
							<option value="select">Select Post Type</option>
							<option value="articles">Articles</option>
							<option value="company-products">Company Product</option>
							<option value="content-submission">Content Submission</option>  
							<option value="downloadable-pdfs">Downloadable PDF</option>                            
							<option value="tribe_events">Event</option>
							<option value="sessions">Session</option>
						</select>
					</td>
				</tr>                        
			</table>
			<p class="migration-msg"></p>
			<p class="submit">
				<input type="submit" name="submit" id="migrate-btn" class="button button-primary" value="Migrate Field">
			</p>
		</form>       
	</div>
	<?php
}

add_action( 'admin_enqueue_scripts', 'nab_enqueue_acf_field_migration_script', 10, 1 );

/**
 * Enqueue script file for ajax
 *
 * @param string $hook_suffix current admin page.
 */
function nab_enqueue_acf_field_migration_script( $hook_suffix ) {

	if ( 'settings_page_acf_field_migration' === $hook_suffix ) {
		wp_enqueue_script( 'acf-field-migration', get_template_directory_uri() . '/assets/js/acf-field-migration.js', array( 'jquery' ), '1.0', true );
		wp_localize_script(
			'acf-field-migration',
			'amplifyObj',
			array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
		);
	}

}

/**
 * Ajax ACF field migration by post type
 */
function nab_acf_field_migration_callback() {

	$select_post_type = filter_input( INPUT_GET, 'post_type', FILTER_SANITIZE_FULL_SPECIAL_CHARS );

	if ( empty( $select_post_type ) ) {
		wp_send_json_error();
	}

	$field_type = 'sessions' === $select_post_type ? 'company' : 'nab_selected_company_id';

	$query_args = array(
		'posts_per_page' => 100,
		'post_type'      => $select_post_type,
		'fields'         => 'ids',
		'meta_query'     => array(
			'relation' => 'AND',
			array(
				'key'     => $field_type,
				'value'   => '',
				'compare' => '!=',
			),
			array(
				'relation' => 'OR',
				array(
					'key'     => 'companies',
					'value'   => '',
					'compare' => '=',
				),
				array(
					'key'     => 'companies',
					'compare' => 'NOT EXISTS',
				),
			),
		),
	);

	$query_result = new WP_Query( $query_args );

	$post_ids = $query_result->posts;

	if ( is_array( $post_ids ) && count( $post_ids ) > 0 ) {

		foreach ( $post_ids as $current_id ) {

			$old_field_company_id = get_field( $field_type, $current_id );
			$updated_old_id       = array( $old_field_company_id );
			update_field( 'companies', $updated_old_id, $current_id );
		}

		wp_send_json_success( array( 'remaining' => true ) );
	}

	wp_send_json_success( array( 'remaining' => false ) );
}
add_action( 'wp_ajax_nab_acf_field_migration', 'nab_acf_field_migration_callback' );
add_action( 'wp_ajax_nopriv_nab_acf_field_migration', 'nab_acf_field_migration_callback' );
