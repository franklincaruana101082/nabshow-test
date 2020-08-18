<?php
/**
 * Template Name: Test
 */

get_header();
?>

<form method="post" action="">
	<input type="button" class="testSubmit" value="Add to Cart">
</form>

<?php
get_footer();
?>

<script>
	jQuery( document ).ready( function() {
		jQuery( document ).on( 'click', '.testSubmit', function() {
			
			// var ajURl = 'http://site2.test/wp-admin/admin-ajax.php';
			// var ajURl = 'http://site4.wpmulti.test/wp-admin/admin-ajax.php';
			var ajURl = 'https://nabshow-com-develop.go-vip.net/365/wp-json/cocart/v1/add-item?return_cart=true';
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
	} );
</script>
