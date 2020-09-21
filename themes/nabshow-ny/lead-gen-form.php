<?php
/**
 * Template Name: Lead Gen Form
 * @package  NABShow_NY
 *
 */

get_header();
?>

	<div id="primary" class="container">
		<main id="main" class="site-main">
			<?php
			$form_nonce = filter_input( INPUT_POST, 'lead_details_nonce', FILTER_SANITIZE_STRING );

			if ( ! empty( $form_nonce ) && wp_verify_nonce( $form_nonce, 'lead_gen_form' ) ) {
				
				$to_email       = filter_input( INPUT_POST, 'to_email', FILTER_SANITIZE_STRING );
				$full_name      = filter_input( INPUT_POST, 'full_name', FILTER_SANITIZE_STRING );                               
                $post_title     = trim( $full_name );
                $security_check = filter_input( INPUT_POST, 'security_check', FILTER_SANITIZE_STRING );
                $email          = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING );
                $title          = filter_input( INPUT_POST, 'title', FILTER_SANITIZE_STRING );
                $phone_number   = filter_input( INPUT_POST, 'phone_number', FILTER_SANITIZE_STRING );
                $company        = filter_input( INPUT_POST, 'company', FILTER_SANITIZE_STRING );

                // Check Spam.
                $content['comment_author']       = $full_name;
                $content['comment_author_email'] = $email;
                $content['comment_content']      = $title;
                $content['comment_phone']        = $phone_number;
                $content['comment_company']      = $company;
                $spam_detected                   = nabny_form_input_spam_check( $content );                

                $inserted_post_id   = wp_insert_post(
                    array(
                        'post_title'   => $post_title,
                        'post_type'    => 'forms-data',
                        'post_status'  => 'publish',
                    )
                );

                if ( ! is_wp_error( $inserted_post_id ) ) {

                    add_post_meta( $inserted_post_id, 'full_name', $full_name );
                    add_post_meta( $inserted_post_id, 'title', $title );
                    add_post_meta( $inserted_post_id, 'company', $company );
                    add_post_meta( $inserted_post_id, 'email', $email );
                    add_post_meta( $inserted_post_id, 'phone_number', $phone_number );

                    wp_set_object_terms( $inserted_post_id, 'lead-generation', 'forms-category' );

                    $message_body   = '<html><body>';
                    $message_body   = '<table border="1" cellpadding="10"><tr><th>Fields</th><th>Details</th></tr>';
                    $message_body   .= '<tr><td>Full Name</td><td>' . $full_name . '</td></tr>';
                    $message_body   .= '<tr><td>Title</td><td>' . $title . '</td></tr>';
                    $message_body   .= '<tr><td>Email</td><td>' . $email . '</td></tr>';
                    $message_body   .= '<tr><td>Phone Number</td><td>' . $phone_number . '</td></tr>';
                    $message_body   .= '</table>';
                    $message_body   .= '</body></html>';                    

                    $headers = "From: NABShow <noreply@nabshow.com>\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                    $subject = 'Lead Generation Details';                    

                    if ( empty( $security_check ) && false === $spam_detected ) {
                        wp_mail( $to_email, $subject, $message_body, $headers );
                    }
                    ?>
                    <div class="lead-form-confirmation">
                        <p>Thank you for your submission. We'll be in touch shortly to schedule a conversation.</p>
                        <a class="gobackbtn btn-primary" href="<?php echo esc_url( get_the_permalink() ); ?>">Go Back to Form</a>
                    </div>
                    <?php
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
