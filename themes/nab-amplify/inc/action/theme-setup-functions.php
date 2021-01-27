<?php

/**
 * All theme setup functions located in this file
 *
 * @package amplify
 */

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
require get_stylesheet_directory() . '/vendor/autoload.php';
function amplify_front_scripts()
{
	//Scripts enqueue.
	global $post;
	wp_enqueue_script('nab-bx-slider-js', get_template_directory_uri() . '/assets/js/jquery.bxslider.min.js', ['jquery'], null, true);
	wp_enqueue_script('amplify-chosen-js', get_template_directory_uri() . '/assets/js/chosen.jquery.min.js', ['jquery'], true);
	wp_enqueue_script('amplify-select2-js', get_template_directory_uri() . '/assets/js/select2.min.js', ['jquery'], '1.0.1', true);
	wp_enqueue_script('amplify-custom-js', get_template_directory_uri() . '/assets/js/nab-amplify.js', ['jquery'], '1.0.1', true);
	wp_localize_script('amplify-custom-js', 'amplifyJS', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'nabNonce' => wp_create_nonce('nab-ajax-nonce'),
		'postID' => $post->ID,
		'postType' => is_search() ? '' : $post->post_type,
		'CompanyAdminId' => get_field('company_user_id'),
		'CurrentLoggedUser' => intval(get_current_user_id()),
		'ThemeUri' => get_template_directory_uri()
	));
	wp_enqueue_script('amplify-tag-js', get_template_directory_uri() . '/js/jquery.tagsinput.js', ['jquery'], null, true);
	wp_enqueue_media();

	wp_enqueue_style('wp-color-picker');
	wp_enqueue_script(
		'iris',
		admin_url('js/iris.min.js'),
		array('jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch'),
		false,
		1
	);
	wp_enqueue_script(
		'wp-color-picker',
		admin_url('js/color-picker.min.js'),
		array('iris'),
		false,
		1
	);
	$colorpicker_l10n = array(
		'clear' => __('Clear'),
		'defaultString' => __('Default'),
		'pick' => __('Select Color'),
		'current' => __('Current Color'),
	);
	wp_localize_script('wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n);

	//Styles enqueue.
	wp_enqueue_style('amplify-style', get_stylesheet_uri());
	wp_enqueue_style('amplify-font-css', get_template_directory_uri() . '/assets/fonts/fonts.css');
	wp_enqueue_style('amplify-font-awesome-css', get_template_directory_uri() . '/assets/fonts/font-awesome.min.css');
	wp_enqueue_style('amplify-chosen-css', get_template_directory_uri() . '/assets/css/chosen.min.css');
	wp_enqueue_style('amplify-front-css', get_template_directory_uri() . '/assets/css/custom.css', '', '1.0.0');
	wp_enqueue_style('amplify-media-css', get_template_directory_uri() . '/assets/css/media.css');
	wp_enqueue_style('amplify-media-tag-css', get_template_directory_uri() . '/assets/css/jquery.tagsinput.css');
	wp_enqueue_style('amplify-select2-css', get_template_directory_uri() . '/assets/css/select2.min.css');
}


function amplify_admin_scripts()
{
	wp_enqueue_style('amplify-admin-style', get_template_directory_uri() . '/assets/css/admin.css');
}

if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' => 'Theme Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false,
	));
}

define('WP_BP_PATH', __DIR__);
define('WP_BP_URL', get_template_directory_uri() . '/inc/action/batch/');

/*Initalize company bulk import files */

require_once 'batch/class-bp-helper.php';
require_once 'batch/class-bp-singleton.php';

require_once 'batch/class-batch-item.php';
require_once 'batch/class-batch.php';
require_once 'batch/class-batch-processor.php';
require_once 'batch/class-batch-ajax-handler.php';
require_once 'batch/class-batch-list-table.php';
require_once 'batch/class-batch-processor-admin.php';

/* Setup company bulk import batch process */

if (class_exists('WP_Batch')) {

	/**
	 * Class MY_Example_Batch
	 */
	class NAB_Company_Import_Batch extends WP_Batch
	{

		/**
		 * Unique identifier of each batch
		 * @var string
		 */
		public $id = 'nab_import_companies';


		/**
		 * Describe the batch
		 * @var string
		 */
		public $title = 'Import Companies';

		/**
		 * To setup the batch data use the push() method to add WP_Batch_Item instances to the queue.
		 *
		 * Note: If the operation of obtaining data is expensive, cache it to avoid slowdowns.
		 *
		 * @return void
		 */
		public function setup()
		{

			$temp = get_temp_dir();



			// Define the CSV Path
			$csv_path = $temp . '/nab_import_company.csv';

			if (file_exists($csv_path)) {


				// Add the CSV data in the processing queue
				$rows   = array_map('str_getcsv', file($csv_path));

				$input_file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($csv_path);

				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($input_file_type);

				/**  Advise the Reader that we only want to load cell data  **/
				$reader->setReadDataOnly(true);

				$reader->setReadEmptyCells(false);

				$spreadsheet = $reader->load($csv_path);

				$sheet_data    = $spreadsheet->getActiveSheet()->toArray();



				// Loop over the data and add every row to the queue
				foreach ($sheet_data as $key => $row) {
					if ($key !== 0) {
						$row_data = array(
							'item_no' => $key,
							'title' => $row[0],
							'content' => $row[1],
							'about' => $row[2],
							'location' => $row[3],
							'featured_cat' => $row[4],
							'street_line_1' => $row[5],
							'street_line_2' => $row[6],
							'street_line_3' => $row[7],
							'city' => $row[8],
							'state' => $row[9],
							'zip' => $row[10],
							'country' => $row[11],
							'website' => $row[12],
							'member_level' => $row[13],
							'tagline' => $row[14],
							'salesforce' => $row[15],
							'website' => $row[16],
							'instagram' => $row[17],
							'linkedin' => $row[18],
							'facebook' => $row[19],
							'twitter' => $row[20],
							'youtube' => $row[21],


						);
						$unique_id  = md5($row[0]);
						$this->push(new WP_Batch_Item($unique_id, $row_data));
					}
				}
			}
		}

		/**
		 * Handles processing of batch item. One at a time.
		 *
		 * In order to work it correctly you must return values as follows:
		 *
		 * - TRUE - If the item was processed successfully.
		 * - WP_Error instance - If there was an error. Add message to display it in the admin area.
		 *
		 * @param WP_Batch_Item $item
		 *
		 * @return bool|\WP_Error
		 */
		public function process($item)
		{

			// get post data
			$item_no = $item->get_value('item_no');
			$title = $item->get_value('title');
			$content = $item->get_value('content');
			$about = $item->get_value('about');
			$location = $item->get_value('location');
			$featured_cat = explode(',', $item->get_value('featured_cat'));
			$street_line_1 = $item->get_value('street_line_1');
			$street_line_2 = $item->get_value('street_line_2');
			$street_line_3 = $item->get_value('street_line_3');
			$city = $item->get_value('city');
			$state_province = $item->get_value('state');
			$zip_Postal = $item->get_value('zip');
			$country = $item->get_value('country');
			$website = $item->get_value('website');
			$member_level = $item->get_value('member_level');
			$company_Tagline = $item->get_value('tagline');
			$salesforce_ID = $item->get_value('salesforce');
			$website_URl = $item->get_value('website');
			$instagram_URl = $item->get_value('instagram');
			$linkedin_URl = $item->get_value('linkedin');
			$facebook_URl = $item->get_value('facebook');
			$twitter_URl = $item->get_value('twitter');
			$youtube_URl = $item->get_value('youtube');

			// Create post object
			$post_data = array(
				'post_title'    => $title,
				'post_content'  => $content,
				'post_status'   => 'publish',
				'post_type' => 'company'
			);

			$fount_post = post_exists($title, '', '', '');

			// Return WP_Error if the item processing failed (In our case we simply skip author with user id 5)
			if ($fount_post) {
				return new WP_Error(302, $title . " Post Exist!");
			}
			if (empty($title)) {
				return new WP_Error(302, "Title not provided for item number " . $item_no);
			}
			// Insert the post into the database
			$import_post_id = wp_insert_post($post_data);
			if (!is_wp_error($import_post_id)) {
				
				// Import the featured product categories
				
				$import_featured_cat = [];

				$num_member_level_array = array (
					'standard'  => 1,
					'plus'      => 2,
					'premium'   => 3,
				);

				foreach ($featured_cat as $cat) {

					$term = term_exists($cat, 'company-product-category');

					if ($term == 0 && $term == null) {
						$term = wp_insert_term(
							$cat,   // the term 
							'company-product-category', // the taxonomy
						);
						if (!is_wp_error($term)) {
							$import_featured_cat[] = $term['term_id'];
						}
					} else {
						$import_featured_cat[] = $term['term_id'];
					}
				}

				if (!empty($import_featured_cat)) {

					$this->import_meta('product_categories', $import_featured_cat, $import_post_id);
				}


				$this->import_meta('about_company', $about, $import_post_id);
				$this->import_meta('company_location', $location, $import_post_id);

				$field_key = 'field_5fa3e84f3fa46';
				$values = array(
					'_street_line_1'    =>   $street_line_1, 
					'street_line_2' =>   $street_line_2,
					'street_line_3' =>   $street_line_3,
					'city' =>   $city,
					'state' =>   $state_province,
					'zipcode' =>   $zip_Postal,
					'country' =>   $country,
				);
				$this->import_meta($field_key, $values, $import_post_id);
				$this->import_meta('company_website', $website, $import_post_id);

				if(in_array($member_level,$num_member_level_array)){
					update_post_meta( $import_post_id, 'member_level_num', $num_member_level_array[$member_level] );
				}

				$this->import_meta('member_level', $member_level, $import_post_id);
				$this->import_meta('company_industary', $company_Tagline, $import_post_id);
				$this->import_meta('salesforce_id', $salesforce_ID, $import_post_id);
				$this->import_meta('company_website', $website_URl, $import_post_id);
				$this->import_meta('instagram_url', $instagram_URl, $import_post_id);
				$this->import_meta('linkedin_url', $linkedin_URl, $import_post_id);
				$this->import_meta('facebook_url', $facebook_URl, $import_post_id);
				$this->import_meta('twitter_url', $twitter_URl, $import_post_id);
				$this->import_meta('youtube_url', $youtube_URl, $import_post_id);

				$random_string = generate_add_admin_string();
				$this->import_meta('admin_add_string', $random_string, $import_post_id);

			} else {
				$error_code = array_key_first($import_post_id->errors);
				$error_message = $import_post_id->errors[$error_code][0];
				return new WP_Error(302, $error_message);
			}
			
	// Return true if the item processing is successful.
			return true;
		}

		/**
		 * Called when specific process is finished (all items were processed).
		 * This method can be overriden in the process class.
		 * @return void
		 */
		public function finish()
		{
			// Do something after process is finished.
			// You have $this->items, etc.
		}

		/* Common function for update custom fields */

		private function import_meta($key, $value, $post_id)
		{
			if (!empty($value)) {
				if (update_field($key, $value, $post_id)) {
					return true;
				} else {
					return new WP_Error(302, 'Error Importing meta' . $key . ' for ' . $post_id);
				}
			} else {
				return new WP_Error(302, 'Meta' . $key . 'not provided for ' . $post_id);
			}
		}
	}
}
