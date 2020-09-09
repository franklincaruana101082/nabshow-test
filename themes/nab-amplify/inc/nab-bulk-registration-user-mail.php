<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * A custom Expedited Order WooCommerce Email class
 *
 * @since 0.1
 * @extends \WC_Email
 */
class WC_Bulk_Registration_User_Email extends WC_Email {


	/**
	 * @var User Id
	 */
	public $user_id;

	/**
	 * @var User Password
	 */
	public $user_pass;

	public function __construct() {
		$this->id             = 'nab_bulk_registration_user_email';
		$this->customer_email = true;
		$this->title          = __( 'NAB Bulk Registration User Email', 'woocommerce' );
		$this->description    = __( 'When attendees are imported through bulk order', 'woocommerce' );
		$this->template_html  = 'emails/bulk-registration-user-email.php';
		$this->template_plain = 'emails/bulk-registration-user-email.php';
		$this->placeholders   = array();

		// Triggers for this email.
		add_action( 'nab_bulk_user_registration', array( $this, 'trigger' ), 10, 3 );

		// Call parent constructor.
		parent::__construct();
	}

	/**
	 * Trigger the sending of this email.
	 *
	 * @param $order_id
	 * @param $user_id
	 * @param $user_pass
	 */
	public function trigger( $order_id, $user_id, $user_pass ) {

		$this->setup_locale();

		if ( $order_id ) {
			$order = wc_get_order( $order_id );

			if ( is_a( $order, 'WC_Order' ) ) {
				$this->object    = $order;
				$this->recipient = $this->object->get_billing_email();
				$this->user_id   = $user_id;
				$this->user_pass = $user_pass;
			}
		}

		if ( $this->is_enabled() && $this->get_recipient() ) {
			$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
		}

		$this->restore_locale();
	}

	/**
	 * Get email subject.
	 *
	 * @return string
	 * @since  3.1.0
	 */
	public function get_default_subject() {
		return __( 'You Are Registered!', 'woocommerce' );
	}

	/**
	 * Get email heading.
	 *
	 * @return string
	 * @since  3.1.0
	 */
	public function get_default_heading() {
		return __( '', 'woocommerce' );
	}

	/**
	 * Get content html.
	 *
	 * @return string
	 */
	public function get_content_html() {
		return wc_get_template_html(
			$this->template_html,
			array(
				'order'              => $this->object,
				'email_heading'      => $this->get_heading(),
				'additional_content' => $this->get_additional_content(),
				'sent_to_admin'      => false,
				'plain_text'         => false,
				'email'              => $this,
				'user_id'            => $this->user_id,
				'user_pass'          => $this->user_pass,
			)
		);
	}

	/**
	 * Get content plain.
	 *
	 * @return string
	 */
	public function get_content_plain() {
		return wc_get_template_html(
			$this->template_plain,
			array(
				'order'              => $this->object,
				'email_heading'      => $this->get_heading(),
				'additional_content' => $this->get_additional_content(),
				'sent_to_admin'      => false,
				'plain_text'         => true,
				'email'              => $this,
			)
		);
	}

	/**
	 * Default content to show below main email content.
	 *
	 * @return string
	 * @since 3.7.0
	 */
	public function get_default_additional_content() {
		return '';
	}


}
