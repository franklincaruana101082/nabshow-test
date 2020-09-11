<?php
/**
 * Template Name: Test
 */

get_header();

if( is_user_logged_in() ) {

	$c_u = get_current_user_id();

	$jwt_token = get_user_meta( $c_u, 'nab_jwt_token', true );
}


?>

<div class="temp-cart">
	<h3>Cart - <span class="temp-cart-qty">0</span><h3>
</div>

<form method="post" action="">
	<div>
		<img src="https://nabshow-com-develop.go-vip.net/amplify/wp-content/uploads/sites/9/2020/08/belt-2.jpg?resize=150,150">
		<input type="button" data-pid="197" class="testCartSubmit" value="Add to Cart">
	</div>
	<br><br>
	<div>
		<img src="https://nabshow-com-develop.go-vip.net/amplify/wp-content/uploads/sites/9/2020/08/cap-2.jpg?resize=150,150">
		<input type="button" data-pid="198" class="testCartSubmit" value="Add to Cart">
	</div>
	<br><br>
	<input type="button" class="proceedToCheckout" value="Checkout">
	
</form>
<br><br>

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
				var ajURl = 'https://nabshow-com-develop.go-vip.net/amplify/wp-json/cocart/v1/add-item?return_cart=true';
				jQuery.ajax( {
					url: mdObj.ajaxUrl,
					type: 'POST',
					data: {
						'product_id': pID,
						'uid': mdObj.mdLoggedUserId,
						'action': 'nab_login_add_cart'
					},
					success: function( data ) {
						console.log( data );
						updateCart();
					}
				} );
			} else {
				var ajURl = 'https://nabshow-com-develop.go-vip.net/amplify/wp-json/cocart/v1/add-item?return_cart=true';
				var cartKeyCookie = getCookie( 'mdcartkey' );
				if ( cartKeyCookie ) {
					var cartKey = cartKeyCookie;
				} else {
					var cartKey = (mdObj.nabCartKey + Date.now().toString( 36 ) + Math.random().toString( 36 ).substr( 2, 5 ));
					setCookie( 'mdcartkey', cartKey, 1 );
				}

				jQuery.ajax( {
					url: ajURl,
					type: 'POST',
					data: {
						'product_id': pID,
						'cart_key': cartKey
					},
					success: function( data ) {
						console.log( data );
						updateCart();
					}
				} );
			}

		} );


		$( document ).on( 'click', '.proceedToCheckout', function() {
			var cartKeyCookie = getCookie( 'mdcartkey' );
			if ( cartKeyCookie ) {
				var checkoutUrl = 'https://nabshow-com-develop.go-vip.net/amplify/cart/?cocart-load-cart=' + cartKeyCookie + '&keep-cart=false';
				location.href = checkoutUrl;
			} else {
				var checkoutUrl = 'https://nabshow-com-develop.go-vip.net/amplify/cart/';
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

	function updateCart() {
		var currCart = $('.temp-cart-qty').text();
		if( currCart ) {
			currCart = parseInt(currCart);
		} else {
			currCart = 0;
		}
		currCart++;
		$('.temp-cart-qty').text(currCart);
	}
</script>
