<?php
/**
 * Template Name: Test
 */

get_header();
$c_u = wp_get_current_user();
?>

<form method="post" action="">
	<div>
		<img src="https://nabshow-com-develop.go-vip.net/amplify/wp-content/plugins/woocommerce/assets/images/placeholder.png">
		<input type="button" data-pid="176" class="testCartSubmit" value="Add to Cart">
	</div>
	<div>
		<img src="https://nabshow-com-develop.go-vip.net/amplify/wp-content/plugins/woocommerce/assets/images/placeholder.png">
		<input type="button" data-pid="118" class="testCartSubmit" value="Add to Cart">
	</div>
	<br><br>
	<input type="button" class="proceedToCheckout" value="Checkout">
	<!--	<div>-->
	<!--		<input type="button" class="testUserSubmit" value="Add to Cart for Logged in users">-->
	<!--	</div>-->

</form>
<br><br>
<?php if ( is_user_logged_in() ) {
	//	$p_id = 19;
	//	$u_p  = wp_remote_get( 'http://site3.wpmulti.test/wp-json/md/request/md-has-purchased?uid=' . $c_u->ID . '&pid=' . $p_id );
	?>
	<!--	<div>-->
	<!--		<h4>User purchased product with id --><?php //echo $p_id; ?><!-- : --><?php //echo ( "true" === $u_p['body'] ) ? 'true' : 'false' ?><!--</h4>-->
	<!--	</div>-->
<?php } ?>

<?php
get_footer();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	jQuery( document ).ready( function() {

		jQuery( document ).on( 'click', '.testCartSubmit', function() {
			var pID = $( this ).data( 'pid' );
			if ( mdObj.isUserLoggedIn ) {
				// var ajURl = 'https://vipnabshow.md-develop.com/ny2020/wp-admin/admin-ajax.php';
				var ajURl = 'https://sandbox.md-develop.com/wp-json/cocart/v1/add-item?return_cart=true';
				jQuery.ajax( {
					url: ajURl,
					type: 'POST',
					headers: {
						'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvc2FuZGJveC5tZC1kZXZlbG9wLmNvbSIsImlhdCI6MTU5ODM2MTcwNSwibmJmIjoxNTk4MzYxNzA1LCJleHAiOjE1OTg5NjY1MDUsImRhdGEiOnsidXNlciI6eyJpZCI6IjMifX19.WVx0nRGYU4EjtAdEvca7hWguH6gnWBE9D_P3xDeOTa4'
					},
					data: {
						'product_id': pID,
						'uid': mdObj.mdLoggedUserId,
						'action': 'md_login_add_cart'
					},
					beforeSend: function( request ) {
						// request.setRequestHeader( 'X-WP-Nonce', uNonce );
					},
					success: function( data ) {
						console.log( data );
						alert( 'added' );
					}
				} );
			} else {
				var ajURl = 'https://sandbox.md-develop.com/wp-json/cocart/v1/add-item?return_cart=true';
				var cartKeyCookie = getCookie( 'mdcartkey' );
				if ( cartKeyCookie ) {
					var cartKey = cartKeyCookie;
				} else {
					var cartKey = (Date.now().toString( 36 ) + Math.random().toString( 36 ).substr( 2, 5 ));
					setCookie( 'mdcartkey', cartKey, 1 );
				}

				jQuery.ajax( {
					url: ajURl,
					type: 'POST',
					data: {
						'product_id': pID,
						'cart_key': cartKey
					},
					beforeSend: function( request ) {
						// request.setRequestHeader( 'X-WP-Nonce', uNonce );
					},
					success: function( data ) {
						console.log( data );
						alert( 'added' );
					}
				} );
			}

		} );

		jQuery( document ).on( 'click', '.testUserSubmit', function() {
			var settings = {
				'url': ajURl,
				'method': 'POST',
				'headers': {
					'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9zaXRlMy53cG11bHRpLnRlc3QiLCJpYXQiOjE1OTc3MzM3MzcsIm5iZiI6MTU5NzczMzczNywiZXhwIjoxNTk4MzM4NTM3LCJkYXRhIjp7InVzZXIiOnsiaWQiOiIzIn19fQ.7uIi9Y_19RNmZnjjzAlpod_hPE00mvep2Fqa0DspkMQ'
				},
				'data': {
					'product_id': 19
				},
			};
			jQuery.ajax( settings ).done( function( response ) {
				console.log( response );
			} );
		} );

		$( document ).on( 'click', '.proceedToCheckout', function() {
			var cartKeyCookie = getCookie( 'mdcartkey' );
			if ( cartKeyCookie ) {
				var checkoutUrl = 'https://sandbox.md-develop.com/cart?cocart-load-cart=' + cartKeyCookie;
				location.href = checkoutUrl;
			} else {
				var checkoutUrl = 'https://sandbox.md-develop.com/cart';
				location.href = checkoutUrl;
			}
		} );

	} );

	function setCookie( name, value, days ) {
		var expires = '';
		if ( days ) {
			var date = new Date();
			date.setTime( date.getTime() + (days * 24 * 60 * 60 * 1000) );
			expires = '; expires=' + date.toUTCString();
		}
		document.cookie = name + '=' + (value || '') + expires + ';path=/';
	}

	function getCookie( name ) {
		var nameEQ = name + '=';
		var ca = document.cookie.split( ';' );
		for ( var i = 0; i < ca.length; i ++ ) {
			var c = ca[ i ];
			while ( c.charAt( 0 ) == ' ' ) c = c.substring( 1, c.length );
			if ( c.indexOf( nameEQ ) == 0 ) return c.substring( nameEQ.length, c.length );
		}
		return null;
	}

	function eraseCookie( name ) {
		document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	}
</script>
