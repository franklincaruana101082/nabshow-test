<?php
/**
 * Template Name: Test
 */

get_header();
?>

<form method="post" action="">
	<div>
		<input type="button" class="testSubmit" value="Add to Cart">
	</div>
	<br>
	<div>
		<input type="button" class="testUserSubmit" value="Add to Cart for Logged in users">
	</div>

</form>

<?php
get_footer();
?>

<script>
	jQuery( document ).ready( function() {

		// var ajURl = 'http://site2.test/wp-admin/admin-ajax.php';
		// var ajURl = 'http://site4.wpmulti.test/wp-admin/admin-ajax.php';
		var ajURl = 'https://nabshow-com-develop.go-vip.net/365/wp-json/cocart/v1/add-item?return_cart=true';

		jQuery( document ).on( 'click', '.testSubmit', function() {
			
			jQuery.ajax( {
				url: ajURl,
				type: 'POST',
				data: {
					// 'action': 'custom_add_cart'
					'product_id': 118,
					'cart_key': 'b6d767d2f8ed5d21a44b0e5886680cb9'
				},
				beforeSend: function( request ) {
					// request.setRequestHeader( 'X-WP-Nonce', uNonce );
				},
				success: function( data ) {
					console.log( data );
					var settings = {
						'url': 'https://nabshow-com-develop.go-vip.net/365/wp-json/cocart/v1/get-cart/b6d767d2f8ed5d21a44b0e5886680cb9',
						'method': 'GET'
					};

					jQuery.ajax( settings ).done( function( response ) {
						console.log( response );
					} );
				}
			} );
		} );


		jQuery( document ).on( 'click', '.testUserSubmit', function() {
			var settings = {
				'url': ajURl,
				'method': 'POST',
				'headers': {
					'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvbmFic2hvdy1jb20tZGV2ZWxvcC5nby12aXAubmV0XC8zNjUiLCJpYXQiOjE1OTc3NDk1MTgsIm5iZiI6MTU5Nzc0OTUxOCwiZXhwIjoxNTk4MzU0MzE4LCJkYXRhIjp7InVzZXIiOnsiaWQiOiIyMTAifX19.9Ffc9d_KR468CFZ4OwQsMUGgv9-zkClQ3TMqBRynZi4'
				},
				'data': {
					'product_id': 118
				},
			};
			jQuery.ajax( settings ).done( function( response ) {
				console.log( response );
			} );
		} );


	} );
</script>
