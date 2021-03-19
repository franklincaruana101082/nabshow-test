<?php

/**
 * Sprout_PDFs_Settings Controller
 *
 * @package Sprout_Invoice
 * @subpackage Sprout_PDFs_Settings
 */
class SI_Sprout_PDFs_Views extends SI_Sprout_PDFs_Controller {

	public static function init() {

		add_action( 'si_head', array( __CLASS__, 'si_add_styles_and_scripts' ), PHP_INT_MAX );

		// Invoices
		add_action( 'pre_si_invoice_view', array( __CLASS__, 'maybe_download_pdf' ) );

		// Estimates
		add_action( 'pre_si_estimate_view', array( __CLASS__, 'maybe_download_pdf' ) );

		add_action( 'si_doc_actions_pre', array( __CLASS__, 'print_to_pdf_button' ) );
		add_action( 'si_pdf_button', array( __CLASS__, 'print_to_pdf_button' ) );

		// templates
		add_action( 'sprout_invoice_template_possibilities', array( __CLASS__, 'maybe_override_template' ), 0 );
	}

	public static function maybe_override_template( $templates = array() ) {
		if ( ! isset( $_GET[ self::PDC_VIEW_QUERY_ARG ] ) || ! $_GET[ self::PDC_VIEW_QUERY_ARG ] ) {
			return $templates;
		}

		$new_templates = array();

		if ( in_array( 'invoice.php', $templates ) ) {
			$new_templates[] = 'invoice-pdf.php';
			$new_templates[] = 'invoice/invoice-pdf.php';
		}

		if ( in_array( 'estimate.php', $templates ) ) {
			// Estimates
			$new_templates[] = 'estimate-pdf.php';
			$new_templates[] = 'estimate/estimate-pdf.php';
		}

		if ( in_array( 'invoices.css', $templates ) ) {
			$new_templates[] = 'invoices-pdf.css';
			$new_templates[] = 'invoice/invoices-pdf.css';
		}

		if ( in_array( 'estimates.css', $templates ) ) {
			$new_templates[] = 'estimates-pdf.css';
			$new_templates[] = 'estimate/estimates-pdf.css';
		}
		return array_merge( $new_templates, $templates );
	}

	public static function si_add_styles_and_scripts() {
		if ( ! isset( $_GET[ self::PDC_VIEW_QUERY_ARG ] ) || ! $_GET[ self::PDC_VIEW_QUERY_ARG ] ) {
			return;
		}
		ob_start();
		?>
			<style type="text/css">
				body {
					background-color: transparent;
				}
				img,
				p,
				li,
				.line_item,
				.si_default_theme .item,
				#line_items_footer,
				#footer_wrap,
				#totals { 
					page-break-inside:avoid
				}
				#paybar {
					position: static !important;
				}
				#outer_doc_wrap {
					margin: 0 10px 10px 10px;
				}
				#doc_header_wrap.sticky_header,
				.stuck #doc_header_wrap.sticky_header {
					position: static !important;
					border: none;

				}
				#print_to_pdf_button,
				#doc_history,
				.purchase_button:after,
				.si_default_theme .row.history_message,
				.li_comments_toggle  {
					display: none;
				}
				#document_wrap {
					border: none;
				}

				.newcf {
					overflow: auto;
				}

				body.si_default_theme #header .messages {
					min-height: 10px;
				}
				body.si_default_theme #header .inner {
					padding: 10px 0px !important;
				}
				body.si_default_theme,
				body#estimate.sa_estimate-template-default {
				    background-color: #fff;
				    color: #333;
				}

				body.si_default_theme .title,
				body.si_default_theme #intro .inner .column span,
				body.si_default_theme #notes .item .header h3 {
				    color: #afafaf
				}
				body.si_default_theme .title:after,
				body.si_default_theme #items .items .item .column h3,
				body.si_default_theme #notes .item .header h3 {
				    border-color: #eee;
				}
				body.si_default_theme .title h2 {
				    background-color: #eee;
				}
				body.si_default_theme header#header {
				    background-color: #f7f7f7;
				}
				body.si_default_theme section#paybar {
				    background-color: #f7f7f7;
				}
				.si_basic_theme .history_message,
				#payment .inner {
					display: none;
				}				
			</style>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('#invoice.sa_invoice-template-default').find('.clearfix').removeClass( 'clearfix' ).addClass( 'newcf' );
					jQuery('#estimate.sa_estimate-template-default').find('.clearfix').removeClass( 'clearfix' ).addClass( 'newcf' );
					jQuery("a[href='#payment']").attr("href", "<?php echo get_permalink() ?>");
					jQuery(".button.primary_button.purchase_button").attr("href", "<?php echo get_permalink() ?>");
					jQuery(".button.primary_button.payment_option").attr("href", "<?php echo get_permalink() ?>");
					jQuery("#change_payment_amount").attr("href", "<?php echo get_permalink() ?>");
				});
			</script>
		<?php
		$scripts = ob_get_clean();
		echo apply_filters( 'si_pdf_service_scripts', $scripts );
	}

	public static function maybe_download_pdf() {
		if ( ! isset( $_GET[ self::QUERY_ARG ] ) || ! $_GET[ self::QUERY_ARG ] ) {
			return;
		}

		$file_path = SI_Sprout_PDFs_API::get_pdf();
		$file_name = self::get_file_name();

		if ( ! $file_path ) { // error was provided via the api
			wp_redirect( remove_query_arg( self::QUERY_ARG ) );
			exit();
		}

		if ( filesize( $file_path ) < 0.01 ) { // no file exists
			if ( $_SERVER['SERVER_ADDR'] === $_SERVER['REMOTE_ADDR'] ) {
				self::set_message( __( '<b>PDF Generation Error:</b> PDF Service will not work locally.', 'sprout-invoices' ), self::MESSAGE_STATUS_ERROR );
			} else {
				self::set_message( __( '<b>PDF Generation Error:</b> please try again later.', 'sprout-invoices' ), self::MESSAGE_STATUS_ERROR );
			}
			wp_redirect( remove_query_arg( self::QUERY_ARG ) );
			exit();
		}

		header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
		header( 'Content-Type: application/pdf' );
		header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s', filemtime( $file_path ) ) . ' GMT' );
		if ( apply_filters( 'si_pdf_view_download', false ) ) {
			header( 'Content-disposition: attachment; filename="' . $file_name . '"' );
		} else {
			header( 'Content-disposition: inline; filename="' . $file_name . '"' );
			header( 'Connection: close' );
		}
		header( 'Content-Transfer-Encoding:  binary' );
		header( 'Content-Length: ' . filesize( $file_path ) ); // provide file size
		readfile( $file_path );
		exit();
	}

	public static function modify_print_to_pdf_url() {
		return self::get_doc_pdf_url( get_the_ID() );
	}

	public static function print_to_pdf_button() {
		$button = sprintf( '<a href="%s" id="print_to_pdf_button" class="button print_button pdf_button" rel="nofollow">%s</a>', self::get_doc_pdf_url( get_the_ID() ), __( 'Print to PDF', 'sprout-invoices' ) );
		print apply_filters( 'si_print_to_pdf_button', $button );
	}
}
