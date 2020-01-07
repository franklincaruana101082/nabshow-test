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

						if ( ! empty( $to_email ) ) {
							wp_mail( $to_email, $subject, $message, $headers );
						}

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

						$to_inquiry_email = isset( $inquiry_emails[ $inquiry_type ] ) ? $inquiry_emails[ $inquiry_type ] : '';
						$to_email         = ! empty( $to_email ) ? $to_email . ',' . $to_inquiry_email : $to_inquiry_email;

						wp_mail( $to_email, $subject, $message, $headers );

						if ( ! empty( $send_copy ) && 'yes' === $send_copy ) {

							$form_user_email = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING );
							wp_mail( $form_user_email, $subject, $message, $headers );
						}
						?>
						<div class="form-confirmation">
							<p>Thank you for contact us! A member of our team will be in touch to answer your question.</p>
							<a class="gobackbtn btn-primary" href="<?php echo esc_url( get_the_permalink() ); ?>">Go back to the form</a>
						</div>
						<?php
					}

				} elseif ( 'delegation-leader-enrollment' === $form_type ) {

					$first_name = filter_input( INPUT_POST, 'first_name', FILTER_SANITIZE_STRING );
					$last_name  = filter_input( INPUT_POST, 'last_name', FILTER_SANITIZE_STRING );
					$post_title = trim( $first_name ) . '_' . trim( $last_name );

					$delegation_form_fields = array( 'company', 'address', 'city', 'state_province', 'zip_postal_code', 'country', 'phone', 'email', 'country_represented', 'associated_with_the_us_department', 'estimated_number_of_delegates', 'registration_information_attending_nabshow_as_well', 'registration_information_proxy_name', 'registration_information_proxy_email', 'registration_information_registering_all_delegates_yourself' );

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

						foreach ( $delegation_form_fields as $form_field ) {

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

						$subject = 'Delegation Leader Enrollment Form Details';

						if ( ! empty( $to_email ) ) {
							wp_mail( $to_email, $subject, $message, $headers );
						}

						?>
						<div class="form-confirmation">
							<p>Thank you, your submission has been received.</p>
							<a class="gobackbtn btn-primary" href="<?php echo esc_url( get_the_permalink() ); ?>">Go back to the form</a>
						</div>
						<?php
					}
				} elseif ( 'publication-shipping-information' === $form_type ) {

					$publication_name = filter_input( INPUT_POST, 'publication_information_name_of_publication_appears_on_cover', FILTER_SANITIZE_STRING );

					$publication_form_fields = array( 'publication_information_issue_date_number', 'publication_information_country_of_origin', 'publication_information_total_number_of_copies', 'publisher_information_publishing_company_name', 'publisher_information_name_of_contact', 'publisher_information_preshow_contact_number', 'publisher_information_onsite_contact_number', 'publisher_information_email_address', 'distribution_type_regular_publication_bin', 'distribution_type_upgraded_publication_bin', 'shipping_logistics_warehouse', 'shipping_logistics_direct', 'shipping_logistics_hand_carry', 'publication_distribution_policies' );

					$inserted_post_id   = wp_insert_post(
						array(
							'post_title'   => $publication_name,
							'post_type'    => 'forms-data',
							'post_status'  => 'publish',
						)
					);

					if ( ! is_wp_error( $inserted_post_id ) ) {

						add_post_meta( $inserted_post_id, 'publication_information_name_of_publication_appears_on_cover', $publication_name );

						$message = '<html><body>';
						$message .= '<table border="1" cellpadding="10"><tr><th>Fields</th><th>Details</th></tr>';
						$message .= '<tr><td>publication_information_name_of_publication_appears_on_cover</td><td>' . $publication_name . '</td></tr>';

						foreach ( $publication_form_fields as $form_field ) {

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

						$subject = 'Publication Shipping Information Form Details';

						if ( ! empty( $to_email ) ) {
							wp_mail( $to_email, $subject, $message, $headers );
						}

						$form_page_url = get_the_permalink();
						?>
						<div class="form-confirmation">
							<p>Thank you for submitting the Publication Shipping Information form! Download the shipping labels below based on the shipping method you selected in the form.</p>
							<p>To submit the form for another publication, <a href="<?php echo esc_url( $form_page_url ); ?>">click here</a>.</p>
							<p><a href="<?php echo esc_url( $form_page_url ); ?>">Go back to the form</a></p>
						</div>
						<?php
					}

				}

				dynamic_sidebar( 'footer-advertisement-sidebar' );

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
