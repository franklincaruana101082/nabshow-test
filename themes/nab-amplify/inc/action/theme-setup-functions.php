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

function amplify_front_scripts()
{
	//Scripts enqueue.
	global $post;
	wp_enqueue_script('nab-bx-slider-js', get_template_directory_uri() . '/assets/js/jquery.bxslider.min.js', ['jquery'], null, true);
	wp_enqueue_script('amplify-chosen-js', get_template_directory_uri() . '/assets/js/chosen.jquery.min.js', ['jquery'], true);
	wp_enqueue_script('amplify-custom-js', get_template_directory_uri() . '/assets/js/nab-amplify.js', ['jquery'], '1.0.3', true);
	wp_enqueue_script('amplify-select2-js', get_template_directory_uri() . '/assets/js/select2.min.js', ['jquery'], '1.0.1', true);
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

			 $csv_name = get_option( 'nab_import_csv');


			$csv_name = $csv_name ? $csv_name : 'nab_import_company.csv';

			// Define the CSV Path
			$csv_path = $temp . '/'.$csv_name;

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
							'featured_cat' => $row[3],
							'street_line_1' => $row[4],
							'street_line_2' => $row[5],
							'street_line_3' => $row[6],
							'city' => $row[7],
							'state' => $row[8],
							'zip' => $row[9],
							'country' => $row[10],
							'website' => $row[14],
							'member_level' => $row[11],
							'tagline' => $row[12],
							'salesforce' => $row[13],
							'website' => $row[14],
							'instagram' => $row[15],
							'linkedin' => $row[16],
							'facebook' => $row[17],
							'twitter' => $row[18],
							'youtube' => $row[19],


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
			$featured_cat = explode(',', $item->get_value('featured_cat'));
			$street_line_1 = $item->get_value('street_line_1');
			$street_line_2 = $item->get_value('street_line_2');
			$street_line_3 = $item->get_value('street_line_3');
			$city = $item->get_value('city');
			$state_province = $item->get_value('state');
			$zip_Postal = $item->get_value('zip');
			$country = $item->get_value('country');
			$website = $item->get_value('website');
			$member_level_check = strtolower( $item->get_value('member_level') );
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
							'company-product-category' // the taxonomy
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

				$num_member_level   = isset( $num_member_level_array[$member_level_check] ) ? $num_member_level_array[$member_level_check] : 0;
				update_post_meta( $import_post_id, 'member_level_num', $num_member_level );

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

function nab_get_countries(){
	$nab_countries = '[
		{
		  "CNCode": "AFGHA",
		  "Display": "Afghanistan",
		  "abbreviation": "AFG",
		  "ISOCode": "AF"
		},
		{
		  "CNCode": "ALBAN",
		  "Display": "Albania",
		  "abbreviation": "ALB",
		  "ISOCode": "AL"
		},
		{
		  "CNCode": "ALGER",
		  "Display": "Algeria",
		  "abbreviation": "DZA",
		  "ISOCode": "DZ"
		},
		{
		  "CNCode": "ANDOR",
		  "Display": "Andorra",
		  "abbreviation": "AND",
		  "ISOCode": "AD"
		},
		{
		  "CNCode": "ANGOL",
		  "Display": "Angola",
		  "abbreviation": "AGO",
		  "ISOCode": "AO"
		},
		{
		  "CNCode": "ANGUI",
		  "Display": "Anguilla",
		  "abbreviation": "AIA",
		  "ISOCode": "AI"
		},
		{
		  "CNCode": "ANTAR",
		  "Display": "Antarctica",
		  "abbreviation": "ATA",
		  "ISOCode": "AQ"
		},
		{
		  "CNCode": "ANTIG",
		  "Display": "Antigua",
		  "abbreviation": "ATG",
		  "ISOCode": "AG"
		},
		{
		  "CNCode": "ARGEN",
		  "Display": "Argentina",
		  "abbreviation": "ARG",
		  "ISOCode": "AR"
		},
		{
		  "CNCode": "ARMEN",
		  "Display": "Armenia",
		  "abbreviation": "ARM",
		  "ISOCode": "AM"
		},
		{
		  "CNCode": "ARUBA",
		  "Display": "Aruba",
		  "abbreviation": "ABW",
		  "ISOCode": "AW"
		},
		{
		  "CNCode": "AUSTA",
		  "Display": "Australia",
		  "abbreviation": "AUS",
		  "ISOCode": "AU"
		},
		{
		  "CNCode": "AUSTI",
		  "Display": "Austria",
		  "abbreviation": "AUT",
		  "ISOCode": "AT"
		},
		{
		  "CNCode": "AZERB",
		  "Display": "Azerbaijan",
		  "abbreviation": "AZE",
		  "ISOCode": "AZ"
		},
		{
		  "CNCode": "BAHAM",
		  "Display": "Bahamas",
		  "abbreviation": "BHS",
		  "ISOCode": "BS"
		},
		{
		  "CNCode": "BAHRA",
		  "Display": "Bahrain",
		  "abbreviation": "BHR",
		  "ISOCode": "BH"
		},
		{
		  "CNCode": "BANGL",
		  "Display": "Bangladesh",
		  "abbreviation": "BGD",
		  "ISOCode": "BD"
		},
		{
		  "CNCode": "BARBA",
		  "Display": "Barbados",
		  "abbreviation": "BRB",
		  "ISOCode": "BB"
		},
		{
		  "CNCode": "BELAR",
		  "Display": "Belarus",
		  "abbreviation": "BLR",
		  "ISOCode": "BY"
		},
		{
		  "CNCode": "BELGI",
		  "Display": "Belgium",
		  "abbreviation": "BEL",
		  "ISOCode": "BE"
		},
		{
		  "CNCode": "BELIZ",
		  "Display": "Belize",
		  "abbreviation": "BLZ",
		  "ISOCode": "BZ"
		},
		{
		  "CNCode": "BENIN",
		  "Display": "Benin",
		  "abbreviation": "BEN",
		  "ISOCode": "BJ"
		},
		{
		  "CNCode": "BERMU",
		  "Display": "Bermuda",
		  "abbreviation": "BMU",
		  "ISOCode": "BM"
		},
		{
		  "CNCode": "BHUT",
		  "Display": "Bhutan",
		  "abbreviation": "BTN",
		  "ISOCode": "BT"
		},
		{
		  "CNCode": "BISS",
		  "Display": "Guinea-Bissau",
		  "abbreviation": "GNB",
		  "ISOCode": "GW"
		},
		{
		  "CNCode": "BOLIV",
		  "Display": "Bolivia",
		  "abbreviation": "BOL",
		  "ISOCode": "BO"
		},
		{
		  "CNCode": "BONAI",
		  "Display": "Bonaire",
		  "abbreviation": "BES",
		  "ISOCode": "BQ"
		},
		{
		  "CNCode": "BOTSW",
		  "Display": "Botswana",
		  "abbreviation": "BWA",
		  "ISOCode": "BW"
		},
		{
		  "CNCode": "BRAZI",
		  "Display": "Brazil",
		  "abbreviation": "BRA",
		  "ISOCode": "BR"
		},
		{
		  "CNCode": "BRVRI",
		  "Display": "British Virgin Islands",
		  "abbreviation": "VGB",
		  "ISOCode": "VG"
		},
		{
		  "CNCode": "BULGA",
		  "Display": "Bulgaria",
		  "abbreviation": "BGR",
		  "ISOCode": "BG"
		},
		{
		  "CNCode": "BURK",
		  "Display": "Burkina Faso",
		  "abbreviation": "BFA",
		  "ISOCode": "BF"
		},
		{
		  "CNCode": "BURMA",
		  "Display": "Burma",
		  "abbreviation": "MMR",
		  "ISOCode": "MM"
		},
		{
		  "CNCode": "BURUN",
		  "Display": "Burundi",
		  "abbreviation": "BDI",
		  "ISOCode": "BI"
		},
		{
		  "CNCode": "CAMB",
		  "Display": "Cambodia",
		  "abbreviation": "KHM",
		  "ISOCode": "KH"
		},
		{
		  "CNCode": "CAMER",
		  "Display": "Cameroon",
		  "abbreviation": "CMR",
		  "ISOCode": "CM"
		},
		{
		  "CNCode": "CANAD",
		  "Display": "Canada",
		  "abbreviation": "CAN",
		  "ISOCode": "CA"
		},
		{
		  "CNCode": "CAYMA",
		  "Display": "Cayman Islands",
		  "abbreviation": "CYM",
		  "ISOCode": "KY"
		},
		{
		  "CNCode": "CEAFR",
		  "Display": "Central African Republic",
		  "abbreviation": "CAF",
		  "ISOCode": "CF"
		},
		{
		  "CNCode": "CHAD ",
		  "Display": "Chad",
		  "abbreviation": "TCD",
		  "ISOCode": "TD"
		},
		{
		  "CNCode": "CHILE",
		  "Display": "Chile",
		  "abbreviation": "CHL",
		  "ISOCode": "CL"
		},
		{
		  "CNCode": "CHINA",
		  "Display": "China",
		  "abbreviation": "CHN",
		  "ISOCode": "CN"
		},
		{
		  "CNCode": "COLOM",
		  "Display": "Colombia",
		  "abbreviation": "COL",
		  "ISOCode": "CO"
		},
		{
		  "CNCode": "COMOR",
		  "Display": "Comoros",
		  "abbreviation": "COM",
		  "ISOCode": "KM"
		},
		{
		  "CNCode": "CONGO",
		  "Display": "Congo",
		  "abbreviation": "COG",
		  "ISOCode": "CG"
		},
		{
		  "CNCode": "COOK",
		  "Display": "Cook Islands",
		  "abbreviation": "COK",
		  "ISOCode": "CK"
		},
		{
		  "CNCode": "COSTA",
		  "Display": "Costa Rica",
		  "abbreviation": "CRI",
		  "ISOCode": "CR"
		},
		{
		  "CNCode": "CROAT",
		  "Display": "Croatia",
		  "abbreviation": "HRV",
		  "ISOCode": "HR"
		},
		{
		  "CNCode": "CUBA ",
		  "Display": "Cuba",
		  "abbreviation": "CUB",
		  "ISOCode": "CU"
		},
		{
		  "CNCode": "CURAC",
		  "Display": "Curacao",
		  "abbreviation": "CUW",
		  "ISOCode": "CW"
		},
		{
		  "CNCode": "CYPRU",
		  "Display": "Cyprus",
		  "abbreviation": "CYP",
		  "ISOCode": "CY"
		},
		{
		  "CNCode": "CZECR",
		  "Display": "Czech Republic",
		  "abbreviation": "CZE",
		  "ISOCode": "CZ"
		},
		{
		  "CNCode": "DARUS",
		  "Display": "Brunei Darussalam",
		  "abbreviation": "BRN",
		  "ISOCode": "BN"
		},
		{
		  "CNCode": "DENMA",
		  "Display": "Denmark",
		  "abbreviation": "DNK",
		  "ISOCode": "DK"
		},
		{
		  "CNCode": "DJIB",
		  "Display": "Djibouti",
		  "abbreviation": "DJI",
		  "ISOCode": "DJ"
		},
		{
		  "CNCode": "DOMCA",
		  "Display": "Dominica",
		  "abbreviation": "DMA",
		  "ISOCode": "DM"
		},
		{
		  "CNCode": "DOMIN",
		  "Display": "Dominican Republic",
		  "abbreviation": "DOM",
		  "ISOCode": "DO"
		},
		{
		  "CNCode": "ECUAD",
		  "Display": "Ecuador",
		  "abbreviation": "ECU",
		  "ISOCode": "EC"
		},
		{
		  "CNCode": "EGYPT",
		  "Display": "Egypt",
		  "abbreviation": "EGY",
		  "ISOCode": "EG"
		},
		{
		  "CNCode": "ELSAL",
		  "Display": "El Salvador",
		  "abbreviation": "SLV",
		  "ISOCode": "SV"
		},
		{
		  "CNCode": "ENG",
		  "Display": "England",
		  "abbreviation": "ENG",
		  "ISOCode": "EN"
		},
		{
		  "CNCode": "EQUAT",
		  "Display": "Equatorial Guinea",
		  "abbreviation": "GNQ",
		  "ISOCode": "GQ"
		},
		{
		  "CNCode": "ERIT",
		  "Display": "Eritrea",
		  "abbreviation": "ERI",
		  "ISOCode": "ER"
		},
		{
		  "CNCode": "ESTON",
		  "Display": "Estonia",
		  "abbreviation": "EST",
		  "ISOCode": "EE"
		},
		{
		  "CNCode": "ETHIO",
		  "Display": "Ethiopia",
		  "abbreviation": "ETH",
		  "ISOCode": "ET"
		},
		{
		  "CNCode": "FAROE",
		  "Display": "Faroe Islands",
		  "abbreviation": "FRO",
		  "ISOCode": "FO"
		},
		{
		  "CNCode": "FIJII",
		  "Display": "Fiji",
		  "abbreviation": "FJI",
		  "ISOCode": "FJ"
		},
		{
		  "CNCode": "FINLA",
		  "Display": "Finland",
		  "abbreviation": "FIN",
		  "ISOCode": "FI"
		},
		{
		  "CNCode": "FRANC",
		  "Display": "France",
		  "abbreviation": "FRA",
		  "ISOCode": "FR"
		},
		{
		  "CNCode": "GABON",
		  "Display": "Gabon",
		  "abbreviation": "GAB",
		  "ISOCode": "GA"
		},
		{
		  "CNCode": "GAMBI",
		  "Display": "Gambia",
		  "abbreviation": "GMB",
		  "ISOCode": "GM"
		},
		{
		  "CNCode": "GEORG",
		  "Display": "Georgia",
		  "abbreviation": "GEO",
		  "ISOCode": "GE"
		},
		{
		  "CNCode": "GERMA",
		  "Display": "Germany",
		  "abbreviation": "DEU",
		  "ISOCode": "DE"
		},
		{
		  "CNCode": "GHANA",
		  "Display": "Ghana",
		  "abbreviation": "GHA",
		  "ISOCode": "GH"
		},
		{
		  "CNCode": "GREEC",
		  "Display": "Greece",
		  "abbreviation": "GRC",
		  "ISOCode": "GR"
		},
		{
		  "CNCode": "GREEN",
		  "Display": "Greenland",
		  "abbreviation": "GRL",
		  "ISOCode": "GL"
		},
		{
		  "CNCode": "GREN",
		  "Display": "Grenada",
		  "abbreviation": "GRD",
		  "ISOCode": "GD"
		},
		{
		  "CNCode": "GUADE",
		  "Display": "Guadeloupe",
		  "abbreviation": "GLP",
		  "ISOCode": "GP"
		},
		{
		  "CNCode": "GUATE",
		  "Display": "Guatemala",
		  "abbreviation": "GTM",
		  "ISOCode": "GT"
		},
		{
		  "CNCode": "GUF",
		  "Display": "French Guiana",
		  "abbreviation": "GUF",
		  "ISOCode": "GF"
		},
		{
		  "CNCode": "GUINE",
		  "Display": "Guinea",
		  "abbreviation": "GIN",
		  "ISOCode": "GN"
		},
		{
		  "CNCode": "GUYAN",
		  "Display": "Guyana",
		  "abbreviation": "GUY",
		  "ISOCode": "GY"
		},
		{
		  "CNCode": "HAITI",
		  "Display": "Haiti",
		  "abbreviation": "HTI",
		  "ISOCode": "HT"
		},
		{
		  "CNCode": "HERZE",
		  "Display": "Bosnia And Herzegovina",
		  "abbreviation": "BIH",
		  "ISOCode": "BA"
		},
		{
		  "CNCode": "HONDU",
		  "Display": "Honduras",
		  "abbreviation": "HND",
		  "ISOCode": "HN"
		},
		{
		  "CNCode": "HONG ",
		  "Display": "Hong Kong (China)",
		  "abbreviation": "HKG",
		  "ISOCode": "HK"
		},
		{
		  "CNCode": "HUNGA",
		  "Display": "Hungary",
		  "abbreviation": "HUN",
		  "ISOCode": "HU"
		},
		{
		  "CNCode": "ICELA",
		  "Display": "Iceland",
		  "abbreviation": "ISL",
		  "ISOCode": "IS"
		},
		{
		  "CNCode": "INDIA",
		  "Display": "India",
		  "abbreviation": "IND",
		  "ISOCode": "IN"
		},
		{
		  "CNCode": "INDON",
		  "Display": "Indonesia",
		  "abbreviation": "IDN",
		  "ISOCode": "ID"
		},
		{
		  "CNCode": "IRAN ",
		  "Display": "Iran",
		  "abbreviation": "IRN",
		  "ISOCode": "IR"
		},
		{
		  "CNCode": "IRAQ ",
		  "Display": "Iraq",
		  "abbreviation": "IRQ",
		  "ISOCode": "IQ"
		},
		{
		  "CNCode": "IRELA",
		  "Display": "Ireland",
		  "abbreviation": "IRL",
		  "ISOCode": "IE"
		},
		{
		  "CNCode": "ISRAE",
		  "Display": "Israel",
		  "abbreviation": "ISR",
		  "ISOCode": "IL"
		},
		{
		  "CNCode": "ITALY",
		  "Display": "Italy",
		  "abbreviation": "ITA",
		  "ISOCode": "IT"
		},
		{
		  "CNCode": "IVORY",
		  "Display": "Ivory Coast",
		  "abbreviation": "CIV",
		  "ISOCode": "CI"
		},
		{
		  "CNCode": "JAMAI",
		  "Display": "Jamaica",
		  "abbreviation": "JAM",
		  "ISOCode": "JM"
		},
		{
		  "CNCode": "JAPAN",
		  "Display": "Japan",
		  "abbreviation": "JPN",
		  "ISOCode": "JP"
		},
		{
		  "CNCode": "JORDA",
		  "Display": "Jordan",
		  "abbreviation": "JOR",
		  "ISOCode": "JO"
		},
		{
		  "CNCode": "KAZAK",
		  "Display": "Kazakhstan",
		  "abbreviation": "KAZ",
		  "ISOCode": "KZ"
		},
		{
		  "CNCode": "KENYA",
		  "Display": "Kenya",
		  "abbreviation": "KEN",
		  "ISOCode": "KE"
		},
		{
		  "CNCode": "KIRIB",
		  "Display": "Kiribati",
		  "abbreviation": "KIR",
		  "ISOCode": "KI"
		},
		{
		  "CNCode": "KUWAI",
		  "Display": "Kuwait",
		  "abbreviation": "KWT",
		  "ISOCode": "KW"
		},
		{
		  "CNCode": "KYRGY",
		  "Display": "Kyrgyzstan",
		  "abbreviation": "KGZ",
		  "ISOCode": "KG"
		},
		{
		  "CNCode": "LATVI",
		  "Display": "Latvia",
		  "abbreviation": "LVA",
		  "ISOCode": "LV"
		},
		{
		  "CNCode": "LEBAN",
		  "Display": "Lebanon",
		  "abbreviation": "LBN",
		  "ISOCode": "LB"
		},
		{
		  "CNCode": "LESOT",
		  "Display": "Lesotho",
		  "abbreviation": "LSO",
		  "ISOCode": "LS"
		},
		{
		  "CNCode": "LIBER",
		  "Display": "Liberia",
		  "abbreviation": "LBR",
		  "ISOCode": "LR"
		},
		{
		  "CNCode": "LIBYA",
		  "Display": "Libya",
		  "abbreviation": "LBY",
		  "ISOCode": "LY"
		},
		{
		  "CNCode": "LIECH",
		  "Display": "Liechtenstein",
		  "abbreviation": "LIE",
		  "ISOCode": "LI"
		},
		{
		  "CNCode": "LITHA",
		  "Display": "Lithuania",
		  "abbreviation": "LTU",
		  "ISOCode": "LT"
		},
		{
		  "CNCode": "LPDR",
		  "Display": "Lao People Demo Republic",
		  "abbreviation": "LAO",
		  "ISOCode": "LA"
		},
		{
		  "CNCode": "LUXEM",
		  "Display": "Luxembourg",
		  "abbreviation": "LUX",
		  "ISOCode": "LU"
		},
		{
		  "CNCode": "MACAU",
		  "Display": "Macau (China)",
		  "abbreviation": "MAC",
		  "ISOCode": "MO"
		},
		{
		  "CNCode": "MACED",
		  "Display": "Republic of North Macedonia",
		  "abbreviation": "MKD",
		  "ISOCode": "MK"
		},
		{
		  "CNCode": "MADAG",
		  "Display": "Madagascar",
		  "abbreviation": "MDG",
		  "ISOCode": "MG"
		},
		{
		  "CNCode": "MALAW",
		  "Display": "Malawi",
		  "abbreviation": "MWI",
		  "ISOCode": "MW"
		},
		{
		  "CNCode": "MALAY",
		  "Display": "Malaysia",
		  "abbreviation": "MYS",
		  "ISOCode": "MY"
		},
		{
		  "CNCode": "MALD",
		  "Display": "Maldives",
		  "abbreviation": "MDV",
		  "ISOCode": "MV"
		},
		{
		  "CNCode": "MALI",
		  "Display": "Mali",
		  "abbreviation": "MAL",
		  "ISOCode": "ML"
		},
		{
		  "CNCode": "MALTA",
		  "Display": "Malta",
		  "abbreviation": "MLT",
		  "ISOCode": "MT"
		},
		{
		  "CNCode": "MANN",
		  "Display": "Isle of Man",
		  "abbreviation": "IMN",
		  "ISOCode": "IM"
		},
		{
		  "CNCode": "MARIN",
		  "Display": "San Marino",
		  "abbreviation": "SMR",
		  "ISOCode": "SM"
		},
		{
		  "CNCode": "MARSH",
		  "Display": "Marshall Islands",
		  "abbreviation": "MHL",
		  "ISOCode": "MH"
		},
		{
		  "CNCode": "MARTI",
		  "Display": "Martinique",
		  "abbreviation": "MTQ",
		  "ISOCode": "MQ"
		},
		{
		  "CNCode": "MAUIS",
		  "Display": "Mauritius",
		  "abbreviation": "MUS",
		  "ISOCode": "MU"
		},
		{
		  "CNCode": "MAURI",
		  "Display": "Mauritania",
		  "abbreviation": "MRT",
		  "ISOCode": "MR"
		},
		{
		  "CNCode": "MEXIC",
		  "Display": "Mexico",
		  "abbreviation": "MEX",
		  "ISOCode": "MX"
		},
		{
		  "CNCode": "MICRO",
		  "Display": "Micronesia-Federated Stat",
		  "abbreviation": "FSM",
		  "ISOCode": "FM"
		},
		{
		  "CNCode": "MOLDO",
		  "Display": "Moldova",
		  "abbreviation": "MDA",
		  "ISOCode": "MD"
		},
		{
		  "CNCode": "MONAC",
		  "Display": "Monaco",
		  "abbreviation": "MCO",
		  "ISOCode": "MC"
		},
		{
		  "CNCode": "MONGO",
		  "Display": "Mongolia",
		  "abbreviation": "MNG",
		  "ISOCode": "MN"
		},
		{
		  "CNCode": "MONT",
		  "Display": "Montenegro",
		  "abbreviation": "MNE",
		  "ISOCode": "ME"
		},
		{
		  "CNCode": "MONTS",
		  "Display": "Montserrat",
		  "abbreviation": "MSR",
		  "ISOCode": "MS"
		},
		{
		  "CNCode": "MOROC",
		  "Display": "Morocco",
		  "abbreviation": "MAR",
		  "ISOCode": "MA"
		},
		{
		  "CNCode": "MOZAM",
		  "Display": "Mozambique",
		  "abbreviation": "MOZ",
		  "ISOCode": "MZ"
		},
		{
		  "CNCode": "MYAN",
		  "Display": "Myanmar",
		  "abbreviation": "MMR",
		  "ISOCode": "MM"
		},
		{
		  "CNCode": "MYT",
		  "Display": "Mayotte",
		  "abbreviation": "MYT",
		  "ISOCode": "YT"
		},
		{
		  "CNCode": "NAMBI",
		  "Display": "Namibia",
		  "abbreviation": "NAM",
		  "ISOCode": "NA"
		},
		{
		  "CNCode": "NAURU",
		  "Display": "Nauru",
		  "abbreviation": "NRU",
		  "ISOCode": "NR"
		},
		{
		  "CNCode": "NCL",
		  "Display": "New Caledonia",
		  "abbreviation": "NCL",
		  "ISOCode": "NC"
		},
		{
		  "CNCode": "NEPAL",
		  "Display": "Nepal",
		  "abbreviation": "NPL",
		  "ISOCode": "NP"
		},
		{
		  "CNCode": "NETHE",
		  "Display": "Netherlands",
		  "abbreviation": "NLD",
		  "ISOCode": "NL"
		},
		{
		  "CNCode": "NETHN",
		  "Display": "Netherlands Antilles",
		  "abbreviation": "ANT",
		  "ISOCode": "AN"
		},
		{
		  "CNCode": "NEVIS",
		  "Display": "St. Kitts and Nevis",
		  "abbreviation": "KNA",
		  "ISOCode": "KN"
		},
		{
		  "CNCode": "NEWGU",
		  "Display": "Papua New Guinea",
		  "abbreviation": "PNG",
		  "ISOCode": "PG"
		},
		{
		  "CNCode": "NEWZE",
		  "Display": "New Zealand",
		  "abbreviation": "NZL",
		  "ISOCode": "NZ"
		},
		{
		  "CNCode": "NICAR",
		  "Display": "Nicaragua",
		  "abbreviation": "NIC",
		  "ISOCode": "NI"
		},
		{
		  "CNCode": "NIGER",
		  "Display": "Niger",
		  "abbreviation": "NER",
		  "ISOCode": "NE"
		},
		{
		  "CNCode": "NIGRA",
		  "Display": "Nigeria",
		  "abbreviation": "NGA",
		  "ISOCode": "NG"
		},
		{
		  "CNCode": "NIUE",
		  "Display": "Niue",
		  "abbreviation": "NIU",
		  "ISOCode": "NU"
		},
		{
		  "CNCode": "NKORE",
		  "Display": "North Korea",
		  "abbreviation": "PRK",
		  "ISOCode": "KP"
		},
		{
		  "CNCode": "NORWA",
		  "Display": "Norway",
		  "abbreviation": "NOR",
		  "ISOCode": "NO"
		},
		{
		  "CNCode": "OMAN ",
		  "Display": "Oman",
		  "abbreviation": "OMN",
		  "ISOCode": "OM"
		},
		{
		  "CNCode": "PAKIS",
		  "Display": "Pakistan",
		  "abbreviation": "PAK",
		  "ISOCode": "PK"
		},
		{
		  "CNCode": "PALAU",
		  "Display": "Palau",
		  "abbreviation": "PLW",
		  "ISOCode": "PW"
		},
		{
		  "CNCode": "PALT",
		  "Display": "Palestinian Territory Occupied",
		  "abbreviation": "PAL",
		  "ISOCode": "PS"
		},
		{
		  "CNCode": "PANAM",
		  "Display": "Panama",
		  "abbreviation": "PAN",
		  "ISOCode": "PA"
		},
		{
		  "CNCode": "PARAG",
		  "Display": "Paraguay",
		  "abbreviation": "PRY",
		  "ISOCode": "PY"
		},
		{
		  "CNCode": "PERU ",
		  "Display": "Peru",
		  "abbreviation": "PER",
		  "ISOCode": "PE"
		},
		{
		  "CNCode": "PHILI",
		  "Display": "Philippines",
		  "abbreviation": "PHL",
		  "ISOCode": "PH"
		},
		{
		  "CNCode": "POLAN",
		  "Display": "Poland",
		  "abbreviation": "POL",
		  "ISOCode": "PL"
		},
		{
		  "CNCode": "POLYN",
		  "Display": "French Polynesia",
		  "abbreviation": "PYF",
		  "ISOCode": "PF"
		},
		{
		  "CNCode": "PORTU",
		  "Display": "Portugal",
		  "abbreviation": "PRT",
		  "ISOCode": "PT"
		},
		{
		  "CNCode": "PRINC",
		  "Display": "Sao Tome And Principe",
		  "abbreviation": "STP",
		  "ISOCode": "ST"
		},
		{
		  "CNCode": "QATAR",
		  "Display": "Qatar",
		  "abbreviation": "QAT",
		  "ISOCode": "QA"
		},
		{
		  "CNCode": "REUN",
		  "Display": "Reunion",
		  "abbreviation": "REU",
		  "ISOCode": "RE"
		},
		{
		  "CNCode": "ROMAN",
		  "Display": "Romania",
		  "abbreviation": "ROU",
		  "ISOCode": "RO"
		},
		{
		  "CNCode": "RUSSI",
		  "Display": "Russian Federation",
		  "abbreviation": "RUS",
		  "ISOCode": "RU"
		},
		{
		  "CNCode": "RWAND",
		  "Display": "Rwanda",
		  "abbreviation": "RWA",
		  "ISOCode": "RW"
		},
		{
		  "CNCode": "SAHAR",
		  "Display": "Western Sahara",
		  "abbreviation": "ESH",
		  "ISOCode": "EH"
		},
		{
		  "CNCode": "SAHEL",
		  "Display": "St. Helena",
		  "abbreviation": "SHN",
		  "ISOCode": "SH"
		},
		{
		  "CNCode": "SALUC",
		  "Display": "St. Lucia",
		  "abbreviation": "LCA",
		  "ISOCode": "LC"
		},
		{
		  "CNCode": "SAMOA",
		  "Display": "Samoa",
		  "abbreviation": "WSM",
		  "ISOCode": "WS"
		},
		{
		  "CNCode": "SAVIN",
		  "Display": "St. Vincent",
		  "abbreviation": "VCT",
		  "ISOCode": "VC"
		},
		{
		  "CNCode": "SAZDI",
		  "Display": "Saudi Arabia",
		  "abbreviation": "SAU",
		  "ISOCode": "SA"
		},
		{
		  "CNCode": "SCT",
		  "Display": "Scotland",
		  "abbreviation": "SCT",
		  "ISOCode": "SF"
		},
		{
		  "CNCode": "SENEG",
		  "Display": "Senegal",
		  "abbreviation": "SEN",
		  "ISOCode": "SN"
		},
		{
		  "CNCode": "SERB",
		  "Display": "Serbia",
		  "abbreviation": "SRB",
		  "ISOCode": "RS"
		},
		{
		  "CNCode": "SEYCH",
		  "Display": "Seychelles",
		  "abbreviation": "SYC",
		  "ISOCode": "SC"
		},
		{
		  "CNCode": "SIERL",
		  "Display": "Sierra Leone",
		  "abbreviation": "SLE",
		  "ISOCode": "SL"
		},
		{
		  "CNCode": "SINGA",
		  "Display": "Singapore",
		  "abbreviation": "SGP",
		  "ISOCode": "SG"
		},
		{
		  "CNCode": "SKORE",
		  "Display": "Korea, Republic of",
		  "abbreviation": "KOR",
		  "ISOCode": "KR"
		},
		{
		  "CNCode": "SLOVE",
		  "Display": "Slovenia",
		  "abbreviation": "SVN",
		  "ISOCode": "SI"
		},
		{
		  "CNCode": "SLOVK",
		  "Display": "Slovak Republic",
		  "abbreviation": "SVK",
		  "ISOCode": "SK"
		},
		{
		  "CNCode": "SOAFR",
		  "Display": "South Africa",
		  "abbreviation": "ZAF",
		  "ISOCode": "ZA"
		},
		{
		  "CNCode": "SOLOM",
		  "Display": "Solomon Islands",
		  "abbreviation": "SLB",
		  "ISOCode": "SB"
		},
		{
		  "CNCode": "SOMAL",
		  "Display": "Somalia",
		  "abbreviation": "SOM",
		  "ISOCode": "SO"
		},
		{
		  "CNCode": "SPAIN",
		  "Display": "Spain",
		  "abbreviation": "ESP",
		  "ISOCode": "ES"
		},
		{
		  "CNCode": "SPM",
		  "Display": "Saint Pierre and Miquelon",
		  "abbreviation": "SPM",
		  "ISOCode": "PM"
		},
		{
		  "CNCode": "SRILA",
		  "Display": "Sri Lanka",
		  "abbreviation": "LKA",
		  "ISOCode": "LK"
		},
		{
		  "CNCode": "SUDAN",
		  "Display": "Sudan",
		  "abbreviation": "SDN",
		  "ISOCode": "SD"
		},
		{
		  "CNCode": "SURNA",
		  "Display": "Suriname",
		  "abbreviation": "SUR",
		  "ISOCode": "SR"
		},
		{
		  "CNCode": "SWAZI",
		  "Display": "Swaziland",
		  "abbreviation": "SWZ",
		  "ISOCode": "SZ"
		},
		{
		  "CNCode": "SWEDE",
		  "Display": "Sweden",
		  "abbreviation": "SWE",
		  "ISOCode": "SE"
		},
		{
		  "CNCode": "SWITZ",
		  "Display": "Switzerland",
		  "abbreviation": "CHE",
		  "ISOCode": "CH"
		},
		{
		  "CNCode": "SYRIA",
		  "Display": "Syria",
		  "abbreviation": "SYR",
		  "ISOCode": "SY"
		},
		{
		  "CNCode": "TAIWC",
		  "Display": "Taiwan R.O.C.",
		  "abbreviation": "TWN",
		  "ISOCode": "TW"
		},
		{
		  "CNCode": "TAJIK",
		  "Display": "Tajikistan",
		  "abbreviation": "TJK",
		  "ISOCode": "TJ"
		},
		{
		  "CNCode": "TANZA",
		  "Display": "Tanzania",
		  "abbreviation": "TZA",
		  "ISOCode": "TZ"
		},
		{
		  "CNCode": "THAIL",
		  "Display": "Thailand",
		  "abbreviation": "THA",
		  "ISOCode": "TH"
		},
		{
		  "CNCode": "TIMOR",
		  "Display": "East Timor",
		  "abbreviation": "TLS",
		  "ISOCode": "TL"
		},
		{
		  "CNCode": "TOGO",
		  "Display": "Togo",
		  "abbreviation": "TGO",
		  "ISOCode": "TG"
		},
		{
		  "CNCode": "TONGA",
		  "Display": "Tonga",
		  "abbreviation": "TON",
		  "ISOCode": "TO"
		},
		{
		  "CNCode": "TRINT",
		  "Display": "Trinidad and Tobago",
		  "abbreviation": "TTO",
		  "ISOCode": "TT"
		},
		{
		  "CNCode": "TUNIS",
		  "Display": "Tunisia",
		  "abbreviation": "TUN",
		  "ISOCode": "TN"
		},
		{
		  "CNCode": "TURKE",
		  "Display": "Turkey",
		  "abbreviation": "TUR",
		  "ISOCode": "TR"
		},
		{
		  "CNCode": "TURKI",
		  "Display": "Turks and Caicos Islands",
		  "abbreviation": "TCA",
		  "ISOCode": "TC"
		},
		{
		  "CNCode": "TURKM",
		  "Display": "Turkmenistan",
		  "abbreviation": "TKM",
		  "ISOCode": "TM"
		},
		{
		  "CNCode": "TUVAL",
		  "Display": "Tuvalu",
		  "abbreviation": "TUV",
		  "ISOCode": "TV"
		},
		{
		  "CNCode": "UAE  ",
		  "Display": "United Arab Emirates",
		  "abbreviation": "ARE",
		  "ISOCode": "AE"
		},
		{
		  "CNCode": "UGAND",
		  "Display": "Uganda",
		  "abbreviation": "UGA",
		  "ISOCode": "UG"
		},
		{
		  "CNCode": "UKRAI",
		  "Display": "Ukraine",
		  "abbreviation": "UKR",
		  "ISOCode": "UA"
		},
		{
		  "CNCode": "UNTKI",
		  "Display": "United Kingdom",
		  "abbreviation": "GBR",
		  "ISOCode": "GB"
		},
		{
		  "CNCode": "URUGU",
		  "Display": "Uruguay",
		  "abbreviation": "URY",
		  "ISOCode": "UY"
		},
		{
		  "CNCode": "USA",
		  "Display": "United States of America",
		  "abbreviation": "USA",
		  "ISOCode": "US"
		},
		{
		  "CNCode": "UZBEK",
		  "Display": "Uzbekistan",
		  "abbreviation": "UZB",
		  "ISOCode": "UZ"
		},
		{
		  "CNCode": "VATCS",
		  "Display": "Vatican City",
		  "abbreviation": "VAT",
		  "ISOCode": "VA"
		},
		{
		  "CNCode": "VENEZ",
		  "Display": "Venezuela",
		  "abbreviation": "VEN",
		  "ISOCode": "VE"
		},
		{
		  "CNCode": "VERD",
		  "Display": "Cape Verde",
		  "abbreviation": "CPV",
		  "ISOCode": "CV"
		},
		{
		  "CNCode": "VIETN",
		  "Display": "Vietnam",
		  "abbreviation": "VNM",
		  "ISOCode": "VN"
		},
		{
		  "CNCode": "VUTU",
		  "Display": "Vanuatu",
		  "abbreviation": "VUV",
		  "ISOCode": "VU"
		},
		{
		  "CNCode": "WALE",
		  "Display": "Wales",
		  "abbreviation": "WLS",
		  "ISOCode": "WL"
		},
		{
		  "CNCode": "YEMEN",
		  "Display": "Yemen",
		  "abbreviation": "YEM",
		  "ISOCode": "YE"
		},
		{
		  "CNCode": "ZAMBI",
		  "Display": "Zambia",
		  "abbreviation": "ZMB",
		  "ISOCode": "ZM"
		},
		{
		  "CNCode": "ZIMBA",
		  "Display": "Zimbabwe",
		  "abbreviation": "ZWE",
		  "ISOCode": "ZW"
		}
	]';

	$json = json_decode($nab_countries, true);
	return $json;

}

function nab_get_states(){
	$nab_states = '[
		{
		  "State": "AA",
		  "Display": "Armed Forces Americas",
		  "Country": "USA"
		},
		{
		  "State": "AB",
		  "Display": "Alberta",
		  "Country": "CANAD"
		},
		{
		  "State": "AE",
		  "Display": "Armed Forces Canada, Europe, Middle East, Africa",
		  "Country": "USA"
		},
		{
		  "State": "AK",
		  "Display": "Alaska",
		  "Country": "USA"
		},
		{
		  "State": "AL",
		  "Display": "Alabama",
		  "Country": "USA"
		},
		{
		  "State": "AP",
		  "Display": "Armed Forces Pacific",
		  "Country": "USA"
		},
		{
		  "State": "AR",
		  "Display": "Arkansas",
		  "Country": "USA"
		},
		{
		  "State": "AS",
		  "Display": "American Samoa",
		  "Country": "USA"
		},
		{
		  "State": "AZ",
		  "Display": "Arizona",
		  "Country": "USA"
		},
		{
		  "State": "BC",
		  "Display": "British Columbia",
		  "Country": "CANAD"
		},
		{
		  "State": "CA",
		  "Display": "California",
		  "Country": "USA"
		},
		{
		  "State": "CO",
		  "Display": "Colorado",
		  "Country": "USA"
		},
		{
		  "State": "CT",
		  "Display": "Connecticut",
		  "Country": "USA"
		},
		{
		  "State": "DC",
		  "Display": "District of Columbia",
		  "Country": "USA"
		},
		{
		  "State": "DE",
		  "Display": "Delaware",
		  "Country": "USA"
		},
		{
		  "State": "FL",
		  "Display": "Florida",
		  "Country": "USA"
		},
		{
		  "State": "FM",
		  "Display": "Federated States of Micronesia",
		  "Country": "USA"
		},
		{
		  "State": "GA",
		  "Display": "Georgia",
		  "Country": "USA"
		},
		{
		  "State": "GU",
		  "Display": "Guam",
		  "Country": "USA"
		},
		{
		  "State": "HI",
		  "Display": "Hawaii",
		  "Country": "USA"
		},
		{
		  "State": "IA",
		  "Display": "Iowa",
		  "Country": "USA"
		},
		{
		  "State": "ID",
		  "Display": "Idaho",
		  "Country": "USA"
		},
		{
		  "State": "IL",
		  "Display": "Illinois",
		  "Country": "USA"
		},
		{
		  "State": "IN",
		  "Display": "Indiana",
		  "Country": "USA"
		},
		{
		  "State": "KS",
		  "Display": "Kansas",
		  "Country": "USA"
		},
		{
		  "State": "KY",
		  "Display": "Kentucky",
		  "Country": "USA"
		},
		{
		  "State": "LA",
		  "Display": "Louisiana",
		  "Country": "USA"
		},
		{
		  "State": "MA",
		  "Display": "Massachusetts",
		  "Country": "USA"
		},
		{
		  "State": "MB",
		  "Display": "Manitoba",
		  "Country": "CANAD"
		},
		{
		  "State": "MD",
		  "Display": "Maryland",
		  "Country": "USA"
		},
		{
		  "State": "ME",
		  "Display": "Maine",
		  "Country": "USA"
		},
		{
		  "State": "MH",
		  "Display": "Marshall Islands",
		  "Country": "USA"
		},
		{
		  "State": "MI",
		  "Display": "Michigan",
		  "Country": "USA"
		},
		{
		  "State": "MN",
		  "Display": "Minnesota",
		  "Country": "USA"
		},
		{
		  "State": "MO",
		  "Display": "Missouri",
		  "Country": "USA"
		},
		{
		  "State": "MP",
		  "Display": "Northern Mariana Islands",
		  "Country": "USA"
		},
		{
		  "State": "MS",
		  "Display": "Mississippi",
		  "Country": "USA"
		},
		{
		  "State": "MT",
		  "Display": "Montana",
		  "Country": "USA"
		},
		{
		  "State": "NB",
		  "Display": "New Brunswick",
		  "Country": "CANAD"
		},
		{
		  "State": "NC",
		  "Display": "North Carolina",
		  "Country": "USA"
		},
		{
		  "State": "ND",
		  "Display": "North Dakota",
		  "Country": "USA"
		},
		{
		  "State": "NE",
		  "Display": "Nebraska",
		  "Country": "USA"
		},
		{
		  "State": "NF",
		  "Display": "Newfoundland",
		  "Country": "CANAD"
		},
		{
		  "State": "NH",
		  "Display": "New Hampshire",
		  "Country": "USA"
		},
		{
		  "State": "NJ",
		  "Display": "New Jersey",
		  "Country": "USA"
		},
		{
		  "State": "NM",
		  "Display": "New Mexico",
		  "Country": "USA"
		},
		{
		  "State": "NS",
		  "Display": "Nova Scotia",
		  "Country": "CANAD"
		},
		{
		  "State": "NT",
		  "Display": "Northwest Territories",
		  "Country": "CANAD"
		},
		{
		  "State": "NU",
		  "Display": "Nunavut",
		  "Country": "CANAD"
		},
		{
		  "State": "NV",
		  "Display": "Nevada",
		  "Country": "USA"
		},
		{
		  "State": "NY",
		  "Display": "New York",
		  "Country": "USA"
		},
		{
		  "State": "OH",
		  "Display": "Ohio",
		  "Country": "USA"
		},
		{
		  "State": "OK",
		  "Display": "Oklahoma",
		  "Country": "USA"
		},
		{
		  "State": "ON",
		  "Display": "Ontario",
		  "Country": "CANAD"
		},
		{
		  "State": "OR",
		  "Display": "Oregon",
		  "Country": "USA"
		},
		{
		  "State": "PA",
		  "Display": "Pennsylvania",
		  "Country": "USA"
		},
		{
		  "State": "PE",
		  "Display": "Prince Edward Island",
		  "Country": "CANAD"
		},
		{
		  "State": "PI",
		  "Display": "Pacific Islands",
		  "Country": "USA"
		},
		{
		  "State": "PR",
		  "Display": "Puerto Rico",
		  "Country": "USA"
		},
		{
		  "State": "PW",
		  "Display": "Palau",
		  "Country": "USA"
		},
		{
		  "State": "QC",
		  "Display": "Quebec",
		  "Country": "CANAD"
		},
		{
		  "State": "RI",
		  "Display": "Rhode Island",
		  "Country": "USA"
		},
		{
		  "State": "SC",
		  "Display": "South Carolina",
		  "Country": "USA"
		},
		{
		  "State": "SD",
		  "Display": "South Dakota",
		  "Country": "USA"
		},
		{
		  "State": "SK",
		  "Display": "Saskatchewan",
		  "Country": "CANAD"
		},
		{
		  "State": "TN",
		  "Display": "Tennessee",
		  "Country": "USA"
		},
		{
		  "State": "TX",
		  "Display": "Texas",
		  "Country": "USA"
		},
		{
		  "State": "UT",
		  "Display": "Utah",
		  "Country": "USA"
		},
		{
		  "State": "VA",
		  "Display": "Virginia",
		  "Country": "USA"
		},
		{
		  "State": "VI",
		  "Display": "Virgin Islands",
		  "Country": "USA"
		},
		{
		  "State": "VT",
		  "Display": "Vermont",
		  "Country": "USA"
		},
		{
		  "State": "WA",
		  "Display": "Washington",
		  "Country": "USA"
		},
		{
		  "State": "WI",
		  "Display": "Wisconsin",
		  "Country": "USA"
		},
		{
		  "State": "WV",
		  "Display": "West Virginia",
		  "Country": "USA"
		},
		{
		  "State": "WY",
		  "Display": "Wyoming",
		  "Country": "USA"
		},
		{
		  "State": "YT",
		  "Display": "Yukon",
		  "Country": "CANAD"
		}
	   ]';
	$json = json_decode($nab_states, true);
	return $json;
}

function nab_amplify_get_country_state($code,$type){

	if($type === 'country'){
		$nab_get_countries  = nab_get_countries();
		
		foreach($nab_get_countries as $country){
			
			if( $country['Display'] === $code ){
				
				return $country['CNCode'];
			}else{
				return $code;
			}
		}
	}else{
		$nab_get_states  = nab_get_states();
	
		foreach($nab_get_states as $state){
			if( $state['Display'] == $code ){
				return $state['State'];
			}else{
				return $code;
			}
		}
	}
	
}