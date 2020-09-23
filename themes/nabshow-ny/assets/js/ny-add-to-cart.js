(function( $ ) {
    $( document ).ready( function() {

        var nabParentAPIUrl = ( undefined !== typeof mdObj.nabParentAPIUrl && '' !== mdObj.nabParentAPIUrl ) ? mdObj.nabParentAPIUrl : '';
        
		$( document ).on( 'click', '.nabCustomAddCart', function(e) {

			e.preventDefault();

			var currentCartBtn = $( this );

			if( currentCartBtn.hasClass('nabAddedToCart') && nabParentAPIUrl ) {
				location.href = nabParentAPIUrl + 'cart/';
			} else {
				var pID = currentCartBtn.data( 'pid' );

				var cartKey = '';

				if ( ! mdObj.isUserLoggedIn ) {
					var cartKeyCookie = getCookie( 'nabCartKey' );
					if ( cartKeyCookie ) {
						cartKey = cartKeyCookie;
					} else {
						cartKey = (mdObj.nabCartKey + Date.now().toString( 36 ) + Math.random().toString( 36 ).substr( 2, 5 ));
						setCookie( 'nabCartKey', cartKey, 1 );
					}
				}
					
				$.ajax( {
					url: mdObj.ajaxUrl,
					type: 'POST',
					data: {
						'product_id': pID,
						'cart_key': cartKey,
						'action': 'nab_login_add_cart'
					},
					success: function( data ) {
						if( 0 === data.err ) {
							if( data.body.items ) {
								let addedItem = data.body.items[data.body.items.length - 1];
								let productTitle = addedItem.product_title;
								let cartMessage = productTitle ? productTitle + ' has been added to your cart.' : 'Pass has been added to your cart.';
								$('.nab-cart-message').text(cartMessage);
							} else {
								let cartMessage = 'Pass has been added to your cart.';
								$('.nab-cart-message').text(cartMessage);
							}
							
							currentCartBtn.text('View Cart').addClass('nabAddedToCart');
							updateCart();
						} else if( 1 === data.err ) {
							alert( data.message );
						} else {
							alert('Something went wrong!');
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						console.log( thrownError );
					}
				} );
			}

		} );


		$( document ).on( 'click', '.proceedToCheckout', function() {
            if( nabParentAPIUrl ) {
                var checkoutUrl = nabParentAPIUrl + 'cart/';
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
		document.cookie = name + '=' + (value || '') + expires + ';path=/;domain=' + mdObj.nabCookieBaseDomain + ';';
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

	function updateCart() {
		var currCart = $('.nab-cart-count').first().text();
		if( currCart ) {
			currCart = parseInt(currCart);
		} else {
			currCart = 0;
		}
		currCart++;
		$('.nab-cart-count ').text(currCart);
	}

})( jQuery );