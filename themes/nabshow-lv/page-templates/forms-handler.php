<?php
/**
 * Template Name: Forms
 * @package  NABShow_LV
 *
 */

get_header();
?>

	<div id="primary" class="container">
		<main id="main" class="site-main">
			<?php
			$form_nonce = filter_input( INPUT_POST, 'form_details_nonce', FILTER_SANITIZE_STRING );

			if ( ! empty( $form_nonce ) && wp_verify_nonce( $form_nonce, 'nabshow_forms' ) ) {

				$form_type  = filter_input( INPUT_POST, 'form_type', FILTER_SANITIZE_STRING );
				$to_email   = filter_input( INPUT_POST, 'to_email', FILTER_SANITIZE_STRING );

				if ( 'startup-loft' === $form_type ) {

					$first_name = filter_input( INPUT_POST, 'first_name', FILTER_SANITIZE_STRING );
					$last_name  = filter_input( INPUT_POST, 'last_name', FILTER_SANITIZE_STRING );
					$post_title = trim( $first_name ) . '_' . trim( $last_name );

					$startup_form_fields = array( 'title', 'email', 'phone', 'company', 'company_desc', 'company_website', 'date_founded', 'number_of_employees', 'companys_gross_annual_revenue', 'what_challenge_is_your_company_solving', 'companys_competitors', 'companys_current_customers', 'additional_information' );

					$inserted_post_id   = wp_insert_post(
						array(
							'post_title'   => $post_title,
							'post_type'    => 'forms-data',
							'post_status'  => 'publish',
						)
					);

					if ( ! is_wp_error( $inserted_post_id ) ) {

						add_post_meta( $inserted_post_id, 'first_name', $first_name );
						add_post_meta( $inserted_post_id, 'last_name', $last_name );

						$message = '<html><body>';
						$message .= '<table border="1" cellpadding="10"><tr><th>Fields</th><th>Details</th></tr>';
						$message .= '<tr><td>first_name</td><td>' . $first_name . '</td></tr>';
						$message .= '<tr><td>last_name</td><td>' . $last_name . '</td></tr>';

						foreach ( $startup_form_fields as $form_field ) {

							$field_value = filter_input( INPUT_POST, $form_field, FILTER_SANITIZE_STRING );

							if ( ! empty( $field_value ) ) {

								add_post_meta( $inserted_post_id, $form_field, $field_value );
								$message .= '<tr><td>' . $form_field . '</td><td>' . $field_value . '</td></tr>';
							}
						}

						$message .= '</table></body></html>';

						wp_set_object_terms( $inserted_post_id, $form_type, 'forms-category' );

						$headers = "From: NABShow <noreply@nabshow.com>\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

						$subject = 'StartUp Loft Form Details';

						wp_mail( $to_email, $subject, $message, $headers );

						?>
						<div class="form-confirmation">
							<p>Thank you for your submission. A representative from the Exhibit Sales team will contact you if there are additional questions or items to follow up on.</p>
							<a class="gobackbtn btn-primary" href="<?php echo esc_url( get_the_permalink() ); ?>">Go back to the form</a>
						</div>
						<?php
					}
				} elseif ( 'contact-us' === $form_type ) {

					$full_name      = filter_input( INPUT_POST, 'full_name', FILTER_SANITIZE_STRING );
					$inquiry_type   = filter_input( INPUT_POST, 'inquiry_type', FILTER_SANITIZE_STRING );
					$send_copy      = filter_input( INPUT_POST, 'send_copy', FILTER_SANITIZE_STRING );
					$post_title     = trim( $full_name );

					$contact_form_fields = array( 'email', 'phone_number', 'company', 'inquiry_type', 'what_can_we_help_you_with' );

					$inserted_post_id   = wp_insert_post(
						array(
							'post_title'   => $post_title,
							'post_type'    => 'forms-data',
							'post_status'  => 'publish',
						)
					);

					if ( ! is_wp_error( $inserted_post_id ) ) {

						add_post_meta( $inserted_post_id, 'full_name', $full_name );

						$message = '<html><body>';
						$message .= '<table border="1" cellpadding="10"><tr><th>Fields</th><th>Details</th></tr>';
						$message .= '<tr><td>full_name</td><td>' . $full_name . '</td></tr>';

						foreach ( $contact_form_fields as $form_field ) {

							$field_value = filter_input( INPUT_POST, $form_field, FILTER_SANITIZE_STRING );

							if ( ! empty( $field_value ) ) {

								add_post_meta( $inserted_post_id, $form_field, $field_value );
								$message .= '<tr><td>' . $form_field . '</td><td>' . $field_value . '</td></tr>';
							}
						}

						$message .= '</table></body></html>';

						wp_set_object_terms( $inserted_post_id, $form_type, 'forms-category' );

						$headers = "From: NABShow <noreply@nabshow.com>\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

						$subject = 'Contact Us Form Details';

						$inquiry_emails = array( 'registration' => 'register@nab.org', 'housing' => 'register@nab.org', 'exhibit' => 'exhibitservices@nab.org', 'conference' => 'register@nab.org', 'speaker' => 'conventioneducation@nab.org', 'sales' => 'exhibit@nab.org', 'services' => 'exhibitservices@nab.org', 'sponsor' => 'exhibit@nab.org' );

						if ( isset( $inquiry_emails[ $inquiry_type ] ) ) {
							$to_email .= ',' . $inquiry_emails[ $inquiry_type ];
						}


						wp_mail( $to_email, $subject, $message, $headers );

						if ( ! empty( $send_copy ) && 'yes' === $send_copy ) {

							$user_email = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING );
							wp_mail( $user_email, $subject, $message, $headers );
						}
						?>
						<div class="form-confirmation">
							<p>Thank you for contact us! A member of our team will be in touch to answer your question.</p>
							<a class="gobackbtn btn-primary" href="<?php echo esc_url( get_the_permalink() ); ?>">Go back to the form</a>
						</div>
						<?php
					}

				}

			} else {

				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<div class="entry-content">
								<?php
								the_content();
								?>
							</div><!-- .entry-content -->

						</article><!-- #post-<?php the_ID(); ?> -->
					<?php
					endwhile; // End of the loop.
				endif;
			}

			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
