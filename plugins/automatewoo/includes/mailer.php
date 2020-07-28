<?php
// phpcs:ignoreFile

namespace AutomateWoo;

defined( 'ABSPATH' ) || exit;

use Pelago\Emogrifier;

/**
 * Mailer class for HTML emails that use a template.
 */
class Mailer extends Mailer_Abstract {

	/** @var string */
	public $template = 'default';

	/** @var string */
	public $heading;

	/** @var string */
	public $preheader;

	/** @var string */
	public $extra_footer_text;

	/** @var string */
	public $tracking_pixel_url;

	/** @var callable - use to replace URLs in content e.g. for click tracking */
	public $replace_content_urls_callback;

	/** @var bool */
	public $include_automatewoo_styles = true;


	/**
	 * Mailer constructor.
	 *
	 * All params are deprecated, use setter methods instead.
	 *
	 * @todo remove params, no longer in use after Refer A Friend 2.3
	 *
	 * @param $subject
	 * @param $email
	 * @param $content
	 * @param string $template
	 */
	function __construct( $subject = false, $email = false, $content = false, $template = 'default' ) {

		// deprecated
		$this->email = $email;
		$this->subject = $subject;
		$this->content = $content;
		$this->template = $template;

		do_action( 'automatewoo/mailer/init' );
	}


	/**
	 * @param $heading
	 */
	function set_heading( $heading ) {
		$this->heading = $heading;
	}


	/**
	 * @param string $preheader
	 */
	function set_preheader( $preheader ) {
		$this->preheader = $preheader;
	}


	/**
	 * @param string $template
	 */
	function set_template( $template ) {
		$this->template = $template;

		// Must reset from props after template is changed.
		$this->from_email = null;
		$this->from_name = null;
	}


	/**
	 * @param bool $include
	 */
	function set_include_automatewoo_styles( $include ) {
		$this->include_automatewoo_styles = $include;
	}


	/**
	 * Get email sender email address.
	 *
	 * @return string
	 */
	function get_from_email() {
		if ( ! isset( $this->from_email ) ) {
			$this->from_email = Emails::get_from_address( $this->template );
		}
		return $this->from_email;
	}


	/**
	 * Get email sender name.
	 *
	 * @return string
	 */
	function get_from_name() {
		if ( ! isset( $this->from_name ) ) {
			$this->from_name = Emails::get_from_name( $this->template );
		}
		return $this->from_name;
	}


	/**
	 * Returns email body, can be HTML or plain text.
	 *
	 * @since 4.4.0
	 *
	 * @return string
	 */
	function get_email_body() {
		$html = $this->get_content_wrapped_in_template();
		return apply_filters( 'woocommerce_mail_content', $this->prepare_html( $html ) );
	}


	/**
	 * @return string
	 */
	function get_content_wrapped_in_template() {
		$content = $this->content;

		add_filter( 'woocommerce_email_footer_text', [ $this, 'add_extra_footer_text' ] );

		/**
		 * @hooked wpautop()
		 */
		$content = apply_filters( 'automatewoo_email_content', $content );

		// Buffer
		ob_start();

		$this->get_template_part( 'email-header.php', [
			'email_heading' => $this->heading
		] );

		echo $content;

		$this->get_template_part( 'email-footer.php' );

		$html = ob_get_clean();

		remove_filter( 'woocommerce_email_footer_text', [ $this, 'add_extra_footer_text' ] );

		return $html;
	}


	/**
	 * Prepare HTML before it's sent.
	 * Should be run after dynamic content like variables have been inserted.
	 *
	 * - Maybe injects preheader
	 * - Processes email variables like {{ unsubscribe_url }}
	 * - Fixes links with double http
	 * - Maybe convert URLs to trackable URLs
	 * - Replaces unsupported HTML tags
	 * - Runs wptexturize() to convert quotes
	 * - HTML encodes emojis
	 * - Injects tracking pixel
	 * - Inlines CSS
	 *
	 * @since 4.3.0
	 *
	 * @param string $html
	 * @return string
	 */
	function prepare_html( $html ) {
		if ( $this->preheader ) {
			$html = $this->inject_preheader( $html );
		}

		$html = $this->process_email_variables( $html );
		$html = $this->fix_links_with_double_http( $html );
		$html = $this->replace_urls_in_content( $html );
		$html= $this->replace_unsupported_html_tags( $html );
		$html = wptexturize( $html );

		$html = $this->style_inline( $html );
		$html = Clean::encode_emoji( $html ); // encoding emojis before CSS inline seems to decode them again

		if ( $this->tracking_pixel_url ) {
			$html = $this->inject_tracking_pixel( $html ); // add tracking pixel after CSS inline
		}

		return $html;
	}


	/**
	 * Fix any duplicate http in links, can happen due to variables
	 *
	 * @param string $content
	 * @return string
	 */
	function fix_links_with_double_http( $content ) {
		$content = str_replace( '"http://http://', '"http://', $content );
		$content = str_replace( '"https://https://', '"https://', $content );
		$content = str_replace( '"http://https://', '"https://', $content );
		$content = str_replace( '"https://http://', '"http://', $content );
		return $content;
	}


	/**
	 * Replace any HTML tags that aren't supported in email clients.
	 *
	 * @since 4.3.0
	 *
	 * @param string $html
	 * @return string
	 */
	function replace_unsupported_html_tags( $html ) {
		// replace <del> and <ins> tags for outlook
		$html = str_replace( '<del>', '<span style="text-decoration: line-through;">', $html );
		$html = str_replace( '<ins>', '<span style="text-decoration: underline;">', $html );
		$html = str_replace( [ '</del>', '</ins>' ], '</span>', $html );

		return $html;
	}


	/**
	 * Apply inline styles to dynamic content.
	 *
	 * @param string|null $content
	 * @return string
	 */
	function style_inline( $content ) {
		ob_start();

		if ( $this->include_automatewoo_styles ) {
			aw_get_template( 'email/styles.php' );
		}

		$this->get_template_part( 'email-styles.php' );
		$css = apply_filters( 'woocommerce_email_styles', ob_get_clean() );
		$css = apply_filters( 'automatewoo/mailer/styles', $css, $this );

		return $this->emogrify( $content, $css );
	}


	/**
	 * @param $text
	 * @return string
	 */
	function add_extra_footer_text( $text ) {

		if ( ! $this->extra_footer_text )
			return $text;

		// add separator if there is footer text
		if ( trim( $text ) ) {
			$text .= apply_filters( 'automatewoo_email_footer_separator',  ' - ' );
		}

		$text .= $this->extra_footer_text;

		return $text;
	}


	/**
	 * Get a template part.
	 *
	 * @param string $file_name The name of the template file.
	 * @param array  $variables Array of variables for use in the template file.
	 */
	public function get_template_part( $file_name, $variables = [] ) {
		switch( $this->template ) {

			// default is the woocommerce template
			case 'default':
				$template_name = 'emails/' . $file_name;
				$template_path = '';
				break;

			// 'plain' doesn't mean the email is plain text
			case 'plain':
				aw_get_template( 'email/plain/' . $file_name, $variables );
				return;

			// Custom template
			default:
				$template_data = Emails::get_template( $this->template );
				$template_name = $file_name;

				// Check if this template has a custom path
				if ( is_array( $template_data ) && isset( $template_data['path'] ) ) {
					$template_path = untrailingslashit( $template_data['path'] );
				} else {
					$template_path = 'automatewoo/custom-email-templates/'. $this->template;
				}
				break;
		}

		if ( aw_str_starts_with( $template_path, '/' ) ) {
			// Path is absolute
			$located = $template_path . '/' . $template_name;
		} else {
			// Locate the relative path template
			$located = wc_locate_template( $template_name, $template_path );
		}

		// If using the woo default template, apply filters to support email customizer plugins
		if ( 'default' === $this->template ) {
			$located = apply_filters( 'wc_get_template', $located, $template_name, $variables, $template_path, '' );
			do_action( 'woocommerce_before_template_part', $template_name, $template_path, $located, $variables );
		}

		$this->load_template_part( $located, $variables );

		if ( 'default' === $this->template ) {
			do_action( 'woocommerce_after_template_part', $template_name, $template_path, $located, $variables );
		}
	}

	/**
	 * Load a template part if it's found.
	 *
	 * Prefix params with '_' to prevent clashes when using extract on $_variables.
	 *
	 * @since 4.8.0
	 *
	 * @param string $_template_file
	 * @param array  $_variables
	 */
	public function load_template_part( $_template_file, $_variables ) {
		if ( is_array( $_variables ) ) {
			extract( $_variables, EXTR_SKIP );
		}

		if ( $_template_file && file_exists( $_template_file ) ) {
			include $_template_file;
		}
	}

	/**
	 * Maybe replace URLs with trackable URLs
	 *
	 * @param $content string
	 * @return string
	 */
	function replace_urls_in_content( $content ) {
		if ( ! $this->replace_content_urls_callback ) {
			return $content;
		}

		$replacer = new Replace_Helper( $content, $this->replace_content_urls_callback, 'href_urls' );
		return $replacer->process();
	}


	/**
	 * Injects preheader HTML after opening <body> tag
	 *
	 * @param $html
	 * @return string
	 */
	function inject_preheader( $html ) {
		return preg_replace_callback( "/<body[^>]*>/", function( $matches ) {
			$preheader = '<div class="automatewoo-email-preheader" style="display: none !important; font-size: 1px;">' . $this->preheader . '</div>';
			return $matches[0] . $preheader;
		}, $html, 1 );
	}


	/**
	 * Injects tracking pixel before closing </body> tag
	 *
	 * @param $html
	 * @return string
	 */
	function inject_tracking_pixel( $html ) {
		return preg_replace_callback( "/<\/body[^>]*>/", function( $matches ) {
			return $this->get_tracking_pixel_img() . $matches[0] ;
		}, $html, 1 );
	}


	/**
	 * @return string
	 */
	function get_tracking_pixel_img() {
		return '<img src="' . esc_url( $this->tracking_pixel_url ) . '" height="1" width="1" alt="" style="display:inline">';
	}


	/**
	 * Returns the emogrifier library.
	 *
	 * Emogrifier 2.0+ should be returned but it's possible that another plugin could have loaded the
	 * library earlier and thefore loaded an older version of the library.
	 *
	 * Returns false if emogrifier is not supported.
	 *
	 * @since 4.4.2
	 *
	 * @param string $html The HTML.
	 * @param string $css  The CSS to be inlined.
	 *
	 * @return \Emogrifier|\AW_Emogrifier|false|Emogrifier
	 */
	public function get_emogrifier( $html, $css ) {
		if ( ! class_exists( 'DOMDocument' ) ) {
			return false;
		}

		// Emogrifier is loaded by Composer as of WC 4.0
		if ( version_compare( WC()->version, '4.0', '>=' ) ) {
			if ( class_exists( Emogrifier::class ) ) {
				return new Emogrifier( $html, $css );
			}

			return false;
		}

		// WC added a namespace to Emogrifier in 3.6
		if ( version_compare( WC()->version, '3.6', '>=' ) ) {
			if ( ! class_exists( Emogrifier::class ) ) {
				require_once WC()->plugin_path() . '/includes/libraries/class-emogrifier.php';
			}

			return new Emogrifier( $html, $css );
		}

		// Always include the emogrifier included in WC as other plugins might be looking for this
		if ( ! class_exists( 'Emogrifier' ) ) {
			require_once WC()->plugin_path() . '/includes/libraries/class-emogrifier.php';
		}

		// WC 3.5 updated Emogrifier to v2, which we need
		if ( version_compare( WC()->version, '3.5', '>=' ) ) {
			return new \Emogrifier( $html, $css );
		}

		if ( ! class_exists( 'AW_Emogrifier' ) ) {
			require_once AW()->lib_path( '/emogrifier/emogrifier.php' );
		}

		return new \AW_Emogrifier( $html, $css );
	}


	/**
	 * Add inline CSS to HTML with the Emogrifier library.
	 *
	 * If Emogrifier can't be used the unmodified HTML will be returned.
	 *
	 * @since 4.4.2
	 *
	 * @param string $html                    The HTML.
	 * @param string $css                     The CSS to be inlined.
	 * @param bool   $parse_html_style_blocks Should CSS in HTML style blocks also be inlined?
	 *
	 * @return string
	 */
	public function emogrify( $html, $css, $parse_html_style_blocks = false ) {
		$emogrifier = $this->get_emogrifier( $html, $css );

		if ( ! $emogrifier ) {
			return $html;
		}

		try {
			if ( ! $parse_html_style_blocks ) {
				$emogrifier->disableStyleBlocksParsing();
			}

			/*
			 * The disableInvisibleNodeRemoval() method was removed with version 3+ of Emogrifier,
			 * which was included in WC 4.0+. Disabling the removal of invisible nodes is now
			 * default behavior, so we don't need to do anything differently if the method
			 * cannot be found.
			 */
			if ( method_exists( $emogrifier, 'disableInvisibleNodeRemoval' ) ) {
				$emogrifier->disableInvisibleNodeRemoval();
			}

			$html = $emogrifier->emogrify();
		} catch ( \Exception $e ) {
			Logger::error( 'emogrifier', $e->getMessage() );
		}

		return $html;
	}

}
