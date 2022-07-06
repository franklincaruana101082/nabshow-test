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
					$security_check = filter_input( INPUT_POST, 'security_check', FILTER_SANITIZE_STRING );


					// Check Spam.
					$content['comment_author']       = $full_name;
					$content['comment_author_email'] = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING );
					$content['comment_content']      = filter_input( INPUT_POST, 'what_can_we_help_you_with', FILTER_SANITIZE_STRING );
					$content['comment_phone']        = filter_input( INPUT_POST, 'phone_number', FILTER_SANITIZE_STRING );
					$content['comment_company']      = filter_input( INPUT_POST, 'company', FILTER_SANITIZE_STRING );
					$spam_detected                   = nabshow_lv_contact_form_spam_check( $content );

					$contact_form_fields = array( 'email', 'phone_number', 'company', 'inquiry_type', 'what_can_we_help_you_with', 'security_check' );

					$inserted_post_id   = wp_insert_post(
						array(
							'post_title'   => $post_title,
							'post_type'    => 'forms-data',
							'post_status'  => 'publish',
						)
					);

					if ( ! is_wp_error( $inserted_post_id ) ) {

						add_post_meta( $inserted_post_id, 'full_name', $full_name );

						$message_head   = '<html><body>';
						$message_body   = '<table border="1" cellpadding="10"><tr><th>Fields</th><th>Details</th></tr>';
						$message_body   .= '<tr><td>full_name</td><td>' . $full_name . '</td></tr>';

						foreach ( $contact_form_fields as $form_field ) {

							$field_value = filter_input( INPUT_POST, $form_field, FILTER_SANITIZE_STRING );

							if ( ! empty( $field_value ) ) {

								add_post_meta( $inserted_post_id, $form_field, $field_value );
								$message_body .= '<tr><td>' . $form_field . '</td><td>' . $field_value . '</td></tr>';
							}
						}

						$message_body           .= '</table>';
						$inquiry_email_template = $message_head . $message_body . '</body></html>';


						wp_set_object_terms( $inserted_post_id, $form_type, 'forms-category' );

						$headers = "From: NABShow <noreply@nabshow.com>\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

						$subject = 'Contact Us Form Details';

						$inquiry_emails = array( 'registration' => 'register@nab.org', 'housing' => 'register@nab.org', 'exhibit' => 'exhibit@nab.org', 'conference' => 'register@nab.org', 'speaker' => 'conventioneducation@nab.org', 'sales' => 'exhibit@nab.org', 'services' => 'exhibitservices@nab.org', 'sponsor' => 'exhibit@nab.org' );

						$to_inquiry_email = isset( $inquiry_emails[ $inquiry_type ] ) ? $inquiry_emails[ $inquiry_type ] : '';
						$to_email         = ! empty( $to_email ) ? $to_email . ',' . $to_inquiry_email : $to_inquiry_email;

						if ( empty( $security_check ) && false === $spam_detected ) {
							wp_mail( $to_email, $subject, $inquiry_email_template, $headers );
						}

						if ( ! empty( $send_copy ) && 'yes' === $send_copy ) {

							$message_head           .= '<p>Thank you. Someone will be in touch with you within 24 hours.</p>';
							$user_email_template    = $message_head . $message_body . '</body></html>';

							$form_user_email = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING );
							wp_mail( $form_user_email, $subject, $user_email_template, $headers );
						}
						?>
						<div class="form-confirmation">
							<p>Thank you for contacting NAB Show. Someone will be in touch with you within 24 hours.</p>
							<a class="gobackbtn btn-primary" href="<?php echo esc_url( get_the_permalink() ); ?>">Go Back to Contact Form</a>
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
				} elseif ( 'download-the-prospectus' === $form_type ) {

					$uname    = filter_input( INPUT_POST, 'uname', FILTER_SANITIZE_STRING );
					$utitle   = filter_input( INPUT_POST, 'utitle', FILTER_SANITIZE_STRING );
					$ucompany = filter_input( INPUT_POST, 'ucompany', FILTER_SANITIZE_STRING );
					$uemail   = filter_input( INPUT_POST, 'uemail', FILTER_SANITIZE_STRING );
					$uphone   = filter_input( INPUT_POST, 'uphone', FILTER_SANITIZE_STRING );

					$inserted_post_id = wp_insert_post(
						array(
							'post_title'  => $uname,
							'post_type'   => 'forms-data',
							'post_status' => 'publish',
						)
					);

					if ( ! is_wp_error( $inserted_post_id ) ) {

						add_post_meta( $inserted_post_id, 'uname', $uname );
						add_post_meta( $inserted_post_id, 'utitle', $utitle );
						add_post_meta( $inserted_post_id, 'ucompany', $ucompany );
						add_post_meta( $inserted_post_id, 'uemail', $uemail );
						add_post_meta( $inserted_post_id, 'uphone', $uphone );

						wp_set_object_terms( $inserted_post_id, $form_type, 'forms-category' );

						$message = '<html><body>';
						$message .= '<table border="1" cellpadding="10"><tr><th>Fields</th><th>Details</th></tr>';
						$message .= '<tr><th colspan="2">Prospectus Downloaded</th></tr>';
						$message .= '<tr><td>Name</td><td>' . $uname . '</td></tr>';
						$message .= '<tr><td>Title</td><td>' . $utitle . '</td></tr>';
						$message .= '<tr><td>Company</td><td>' . $ucompany . '</td></tr>';
						$message .= '<tr><td>Email</td><td>' . $uemail . '</td></tr>';
						$message .= '<tr><td>Phone</td><td>' . $uphone . '</td></tr>';
						$message .= '</table></body></html>';

						$headers = "From: NABShow <noreply@nabshow.com>\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

						$subject = 'Prospectus Downloaded';

						if ( ! empty( $to_email ) ) {
							wp_mail( $to_email, $subject, $message, $headers );
						}

						$form_page_url = get_the_permalink();
						?>
                        <div class="form-confirmation">
                            <!--<p><a href="<?php echo esc_url( get_template_directory_uri() . '/assets/docs/NAB_ExhibitorProspectus.pdf' ); ?>" target="_blank" class="btn-primary publication-btn">Download Now</a></p>-->
							<h2 style="color:white">Thank you for your interest. We'll connect with you soon.</h2>
                            <p>Click on the images below to download the 2021 media kit and/or show prospectus:</p>
							<div>
								<div style="width:30%; float:left;">
									<div data-bynder-widget="media-item" data-media-id="BF324043-A0B1-4C43-B8D730ECCEA95F93" data-title="false" data-lightbox="false" data-download="true"><script id="bynder-widgets-js" data-account-url="assets.nabshow.com" data-language="en" src="https://d8ejoa1fys2rk.cloudfront.net/bynder-embed/latest/bynder-embed.js"></script></div>
								</div>
								<div style="width:30%; float:left;">
                           			<div data-bynder-widget="media-item" data-media-id="0324E68A-D2E0-4BA0-82F49FC44CE3DAB9" data-title="false" data-lightbox="true" data-download="true"><script id="bynder-widgets-js" data-account-url="assets.nabshow.com" data-language="en" src="https://d8ejoa1fys2rk.cloudfront.net/bynder-embed/latest/bynder-embed.js"></script></div>
                            	</div>
                            </div>
                            <div style="clear:both"></div>
                            <p><a href="<?php echo esc_url( $form_page_url ); ?>">Return to the Form</a></p>
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
							<p><a href="<?php echo esc_url( get_template_directory_uri() . '/assets/docs/NS18-ShippingLabels-PubBins-Warehouse.pdf'); ?>" target="_blank" class="btn-primary btn-blue-outline publication-btn">Advance to Warehouse Shipping Label</a></p>
							<p><a href="<?php echo esc_url( get_template_directory_uri() . '/assets/docs/NS18-ShippingLabels-PubBins-ShowSite.pdf'); ?>" target="_blank" class="btn-primary btn-blue-outline publication-btn">Direct to Show Site Shipping Label</a></p>
							<p>To submit the form for another publication, <a href="<?php echo esc_url( $form_page_url ); ?>">click here</a>.</p>
							<p><a href="<?php echo esc_url( $form_page_url ); ?>">Go back to the form</a></p>
						</div>
						<?php
					}

				} elseif ( 'special-event-order' === $form_type ) {

					$company_name   = filter_input( INPUT_POST, 'company_name', FILTER_SANITIZE_STRING );
					$booth_number   = filter_input( INPUT_POST, 'booth_number', FILTER_SANITIZE_STRING );
					$post_title     = trim( $company_name ) . '_' . trim( $booth_number );

					$event_form_fields = array( 'booth_square_feet', 'special_event_contact_information_name', 'special_event_contact_information_phone_number', 'special_event_contact_information_email_address', 'event_date_1', 'event_date_2', 'event_date_3', 'event_date_4', 'event_hours_start_hour', 'event_hours_start_minute', 'event_hours_start_ampm', 'event_hours_end_hour', 'event_hours_end_minute', 'event_hours_end_ampm', 'nature_of_event_select', 'number_of_attendees' );

					$inserted_post_id   = wp_insert_post(
						array(
							'post_title'   => $post_title,
							'post_type'    => 'forms-data',
							'post_status'  => 'publish',
						)
					);

					if ( ! is_wp_error( $inserted_post_id ) ) {

						add_post_meta( $inserted_post_id, 'company_name', $company_name );
						add_post_meta( $inserted_post_id, 'booth_number', $booth_number );

						$message = '<html><body>';
						$message .= '<table border="1" cellpadding="10"><tr><th>Fields</th><th>Details</th></tr>';
						$message .= '<tr><td>company_name</td><td>' . $company_name . '</td></tr>';
						$message .= '<tr><td>booth_number</td><td>' . $booth_number . '</td></tr>';

						foreach ( $event_form_fields as $form_field ) {

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

						$subject = 'Special Event Order Form Details';

						if ( ! empty( $to_email ) ) {
							wp_mail( $to_email, $subject, $message, $headers );
						}

						?>
						<div class="form-confirmation">
							<p>Thank you for submitting the Special Events Request form.  A member of our <a href="<?php echo esc_url( site_url() . '/partner/exhibitors/exhibitor-services/key-contacts/meet-the-team/' ); ?>">Exhibit Services team</a> will get back to you if we have any questions or items to follow up on.</p>
							<a href="<?php echo esc_url( get_the_permalink() ); ?>">Go back to the form</a>
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
