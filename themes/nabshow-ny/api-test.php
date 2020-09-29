<?php
/**
 * Template Name: API Test
 */

get_header();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://amplify.nabshow.com/wp-json/nab/request/get-product-categories/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
));

$response = curl_exec($curl);

curl_close($curl);

echo '<pre>';
print_r($response);
echo '</pre>';

get_footer();