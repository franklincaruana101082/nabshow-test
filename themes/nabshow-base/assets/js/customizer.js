/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
 
( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'primary_color', function( value ) {
		console.log('primary color changed');
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( ':root' ).css( {
					'--primary-color': '#2a173c',
					'--primary-slate': '#817a89',
					'--primary-slate-dark': '#2d2930',
					'--primary-lighter': '#cd8ec4',
					'--primary-light': '#9e4593',
					'--primary-lightish': '#6b3b99',
					'--primary-dark': '#030621',
				} );
			} else {
				var primaryHSV       = hex2hsv(to);
				var primarySlate     = hsv2rgb(primaryHSV[0]-2.8,primaryHSV[1]*0.176661264,primaryHSV[2]*2.2851);
				var primarySlateDark = hsv2rgb(primaryHSV[0]+3.5,primaryHSV[1]*0.236628849,primaryHSV[2]*0.8);
				var primaryLighter   = hsv2rgb(primaryHSV[0]+37.8,primaryHSV[1]*0.497568882,primaryHSV[2]*3.421276596);
				var primaryLight     = hsv2rgb(primaryHSV[0]+36.6,primaryHSV[1]*0.912479741,primaryHSV[2]*2.638297872);
				var primaryLightish  = hsv2rgb(primaryHSV[0]-0.2,primaryHSV[1]*0.995137763,primaryHSV[2]*2.553191489);
				var primaryDark      = hsv2rgb(primaryHSV[0]-36.8,primaryHSV[1]*1.473257699,primaryHSV[2]*0.54893617);
				$( ':root' ).css( {
					'--primary-color': to,
					'--primary-slate': primarySlate,
					'--primary-slate-dark': primarySlateDark,
					'--primary-lighter': primaryLighter,
					'--primary-light': primaryLight,
					'--primary-lightish': primaryLightish,
					'--primary-dark': primaryDark,
				} );
				
			}
		} );
	} );
	wp.customize( 'secondary_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( ':root' ).css( {
					'--secondary-color': '#2f5dab'
				} );
			} else {
				$( ':root' ).css( {
					'--secondary-color': to
				} );
				
			}
		} );
	} );
	wp.customize( 'tertiary_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( ':root' ).css( {
					'--tertiary-color': '#f4b2ec'
				} );
			} else {
				$( ':root' ).css( {
					'--tertiary-color': to
				} );
				
			}
		} );
	} );
} )( jQuery );


function hex2hsv(hex) {
	var r = parseInt(hex.substr(1,2), 16); // Grab the hex representation of red (chars 1-2) and convert to decimal (base 10).
	var g = parseInt(hex.substr(3,2), 16);
	var b = parseInt(hex.substr(5,2), 16);

    r /= 255, g /= 255, b /= 255;
    var max = Math.max(r, g, b), min = Math.min(r, g, b);
	var h, s, v = max;

	var d = max - min;
	s = max == 0 ? 0 : d / max;

	if (max == min) {
	h = 0; // achromatic
	} else {
	switch (max) {
	  case r: h = (g - b) / d + (g < b ? 6 : 0); break;
	  case g: h = (b - r) / d + 2; break;
	  case b: h = (r - g) / d + 4; break;
	}

	h /= 6;
	}

	return [ h, s, v ];
    
}

function hsv2rgb(h, s, v) {
  var r, g, b;

  var i = Math.floor(h * 6);
  var f = h * 6 - i;
  var p = v * (1 - s);
  var q = v * (1 - f * s);
  var t = v * (1 - (1 - f) * s);

  switch (i % 6) {
    case 0: r = v, g = t, b = p; break;
    case 1: r = q, g = v, b = p; break;
    case 2: r = p, g = v, b = t; break;
    case 3: r = p, g = q, b = v; break;
    case 4: r = t, g = p, b = v; break;
    case 5: r = v, g = p, b = q; break;
  }

  return 'rgb('+r * 255+', '+g * 255+', '+b * 255+')';
}