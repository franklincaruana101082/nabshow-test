(function( $ ) {
    $( document ).ready( function() {

        var nabParentAPIUrl = ( undefined !== typeof epObj.nabParentAPIUrl && '' !== epObj.nabParentAPIUrl ) ? epObj.nabParentAPIUrl : '';
        
		$( document ).on( 'click', '.nabCustomAddCart', function(e) {

			e.preventDefault();

			var currentCartBtn = $( this );

			if( currentCartBtn.hasClass('nabAddedToCart') && nabParentAPIUrl ) {
				location.href = nabParentAPIUrl + 'cart/';
			} else {
				var pID = currentCartBtn.data( 'pid' );

				var cartKey = '';

				if ( ! epObj.isUserLoggedIn ) {
					var cartKeyCookie = getCookie( 'nabCartKey' );
					if ( cartKeyCookie ) {
						cartKey = cartKeyCookie;
					} else {
						cartKey = (epObj.nabCartKey + Date.now().toString( 36 ) + Math.random().toString( 36 ).substr( 2, 5 ));
						setCookie( 'nabCartKey', cartKey, 1 );
					}
				}
					
				$.ajax( {
					url: epObj.ajaxUrl,
					type: 'POST',
					data: {
						'product_id': pID,
						'cart_key': cartKey,
						'action': 'ep_add_cart',
						'nabNonce': epObj.nabNonce
					},
					success: function( data ) {
						let isAdded = 0;
						if( 0 === data.err ) {
							$('.nab-cart-message').text('Pass has been added to your cart.');
							isAdded = 1;
							updateCart();
						} else if( 1 === data.err ) {
							$('.nab-cart-message').text(data.message);
						} else {
							$('.nab-cart-message').text('Something went wrong!');
						}
						$('.nab-cart-message-popup').addClass('nab-cart-message-popup-active');
						setTimeout(function() {
							$('.nab-cart-message-popup').removeClass('nab-cart-message-popup-active');
							if( 1 === isAdded ) {
								currentCartBtn.text('View Cart').addClass('nabAddedToCart');
							}
						}, 3000);
					},
					error: function(xhr, ajaxOptions, thrownError) {
						console.log( thrownError );
					}
				} );
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
		document.cookie = name + '=' + (value || '') + expires + ';path=/;domain=' + epObj.nabCookieBaseDomain + ';';
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