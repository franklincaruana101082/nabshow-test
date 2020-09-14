(function( $ ) {
    $( document ).ready( function() {

        var nabParentAPIUrl = ( undefined !== typeof mdObj.nabParentAPIUrl && '' !== mdObj.nabParentAPIUrl ) ? mdObj.nabParentAPIUrl : '';
        
		$( document ).on( 'click', '.testCartSubmit', function() {

            if( nabParentAPIUrl ) {

                var pID = $( this ).data( 'pid' );

                var ajURl = nabParentAPIUrl + 'wp-json/cocart/v1/add-item?return_cart=true';

                var cartKeyCookie = getCookie( 'nabCartKey' );
                if ( cartKeyCookie ) {
                    var cartKey = cartKeyCookie;
                } else {
                    var cartKey = (mdObj.nabCartKey + Date.now().toString( 36 ) + Math.random().toString( 36 ).substr( 2, 5 ));
                    setCookie( 'nabCartKey', cartKey, 1 );
                }

                $.ajax( {
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
		var currCart = $('.temp-cart-qty').text();
		if( currCart ) {
			currCart = parseInt(currCart);
		} else {
			currCart = 0;
		}
		currCart++;
		$('.temp-cart-qty').text(currCart);
	}
})( jQuery );