/**
 * Wonderwall Public front side javascripts codes are written in this file.
 *
 *  @package Nab
 */
(function( $ ) {
  var importErrs = [];
  var skippedErrs = [];
  var addedAttendee = 0;

  $( document ).ready( function() {
    HeaderResponsive();

    $( window ).on( 'resize', function() {
      HeaderResponsive();
    } );

    // Remove Billing form if no payment method available/required in checkout.
    $( document.body ).on( 'updated_checkout', function() {
      if ( 0 === $( 'ul.wc_payment_methods' ).length ) {
        $('.woocommerce-billing-fields__field-wrapper p:not(.bill-mandatory)').remove();

          // Hide firstname and/or lastname if anyone is empty.
          const hideFields = ['billing_first_name', 'billing_last_name'];
          $(hideFields).each(function( $index, $field) {
              if( 0 !== $('#' + $field ).length && '' !== $('#' + $field ).val() ) {
                  $('#' + $field + '_field' ).hide();
              }
          });
      }
      /**
       * If bill is not 0.00 and the billing_country_field is missing,
       * reload the page to get all other fields.
       */
      else if ( 0 === $('#billing_country_field').length ) {
        $( '#place_order' ).attr( 'disabled' );
        location.reload();
      }
    } );

  } );

  // My Purchase Content Pagination
  $( document ).on( 'click', '.navigate-purchased', function() {
    var new_current_page = '';
    const current_page = parseInt( $('#purchased-pagination #current-page').text() );
    const page_total = parseInt( $('#purchased-pagination #page-total').text() );
    if( $(this).hasClass('next-purchased') ) {
      if( current_page < page_total ) {
                new_current_page = current_page + 1;

      }
    } else {
            if( current_page > 1 ) {
                new_current_page = current_page - 1;
            }
    }
    if( '' !== new_current_page) {
      $('#purchased-pagination #current-page').text(new_current_page)
      $('.content_card').hide();
      $('.content_card[data-item="'+ new_current_page +'"]').show();
    }
  });
  
  // on load
  $( window ).load( function() {

    $( '.video_added' ).removeClass( 'woocommerce-product-gallery__image' );

    $( '.custom_thumb.video_added a' ).fancybox( {
      'width': 800,
      'height': 450,
      'transitionIn': 'elastic',
      'transitionOut': 'elastic',
      'type': 'iframe',
      'closeBtn': true,
      'smallBtn': true
    } );
  } );

  $( document ).on( 'click', '.product-head .product-layout span', function() {

    $( '.product-head .product-layout span' ).removeClass( 'active' );
    $( this ).addClass( 'active' );

    if ( $( this ).hasClass( 'grid' ) ) {
      $( '.product-list' ).removeClass( 'layout-list' );
      $( '.product-list' ).addClass( 'layout-grid' );
    } else {
      $( '.product-list' ).addClass( 'layout-list' );
      $( '.product-list' ).removeClass( 'layout-grid' );
    }

  } );

  // Upload user images using ajax.
  $( '#profile_picture_file, #banner_image_file' ).on( 'change', function( e ) {

    e.preventDefault();
    $( this ).parent().addClass( 'loading' );

    var fd = new FormData();
    var file = $( this );
    var file_name = $( this ).attr( 'name' );
    var individual_file = file[ 0 ].files[ 0 ];
    fd.append( file_name, individual_file );
    fd.append( 'action', 'nab_amplify_upload_images' );

    jQuery.ajax( {
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: fd,
      contentType: false,
      processData: false,
      success: function() {
        location.reload();
      }
    } );
  } );

  // Remove user images using ajax.
  $( '#profile_picture_remove, #banner_image_remove' ).on( 'change', function( e ) {

    e.preventDefault();
    $( this ).parents( '.flex-box' ).find( '.user-image-box' ).addClass( 'loading' );

    jQuery.ajax( {
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: {
        action: 'nab_amplify_remove_images',
        name: $( this ).attr( 'name' )
      },
      success: function( data ) {
        location.reload();
      }
    } );
  } );

  $( window ).on( 'resize', function() {

  } );

  // Related products
  if ( 4 < $( '.related.products .product-list .product-item' ).length ) {
    buildSliderConfiguration();

    $( window ).on( 'resize', function() {
      buildSliderConfiguration();
    } );
  }

  function buildSliderConfiguration() {
    $( '.related.products .product-list' ).each( function() {
      var windowWidth = $( window ).width();
      var numberOfVisibleSlides;
      if ( windowWidth < 567 ) {
        numberOfVisibleSlides = 1;
      } else if ( windowWidth < 768 ) {
        numberOfVisibleSlides = 2;
      } else if ( windowWidth < 1200 ) {
        numberOfVisibleSlides = 3;
      } else {
        numberOfVisibleSlides = 4;
      }
      $( this ).bxSlider( {
        mode: 'horizontal',
        auto: false,
        speed: 500,
        controls: true,
        responsive: true,
        pager: false,
        infiniteLoop: false,
        stopAutoOnClick: true,
        autoHover: true,
        slideWidth: 500,
        moveSlides: 1,
        minSlides: numberOfVisibleSlides,
        maxSlides: numberOfVisibleSlides
      } );
    } );
  }

  function HeaderResponsive() {
    if ( 1024 >= $( window ).width() ) {
      $( document ).on( 'click', '.nab-avatar-wrp', function() {
        $( this ).next( '.nab-profile-dropdown' ).slideToggle();
      } );
    }
  }

  if ( $( '#attendee_country' ).length > 0 ) {
    var states_json = wc_country_select_params.countries.replace( /&quot;/g, '"' ),
      states = $.parseJSON( states_json ),
      wrapper_selectors = '.nab-event-reg-wrap';

    $( document.body ).on( 'change refresh', '#attendee_country', function() {
      // Grab wrapping element to target only stateboxes in same 'group'
      var $wrapper = $( this ).closest( wrapper_selectors );

      if ( !$wrapper.length ) {
        $wrapper = $( this ).closest( '.form-row' ).parent();
      }

      var country = $( this ).val(),
        $statebox = $wrapper.find( '#attendee_state' ),
        $parent = $statebox.closest( '.form-row' ),
        input_name = $statebox.attr( 'name' ),
        input_id = $statebox.attr( 'id' ),
        input_classes = $statebox.attr( 'data-input-classes' ),
        value = $statebox.val(),
        placeholder = $statebox.attr( 'placeholder' ) || $statebox.attr( 'data-placeholder' ) || '',
        $newstate;

      if ( states[ country ] ) {
        if ( $.isEmptyObject( states[ country ] ) ) {
          $newstate = $( '<input type="hidden" />' )
            .prop( 'id', input_id )
            .prop( 'name', input_name )
            .prop( 'placeholder', placeholder )
            .attr( 'data-input-classes', input_classes )
            .addClass( 'hidden ' + input_classes );
          $parent.hide().find( '.select2-container' ).remove();
          $statebox.replaceWith( $newstate );
          $( document.body ).trigger( 'country_to_state_changed', [country, $wrapper] );
        } else {
          var state = states[ country ],
            $defaultOption = $( '<option value=""></option>' ).text( wc_country_select_params.i18n_select_state_text );

          if ( !placeholder ) {
            placeholder = wc_country_select_params.i18n_select_state_text;
          }

          $parent.show();

          if ( $statebox.is( 'input' ) ) {
            $newstate = $( '<select></select>' )
              .prop( 'id', input_id )
              .prop( 'name', input_name )
              .data( 'placeholder', placeholder )
              .attr( 'data-input-classes', input_classes )
              .addClass( 'state_select ' + input_classes );
            $statebox.replaceWith( $newstate );
            $statebox = $wrapper.find( '#attendee_state' );
          }

          $statebox.empty().append( $defaultOption );

          $.each( state, function( index ) {
            var $option = $( '<option></option>' )
              .prop( 'value', index )
              .text( state[ index ] );
            $statebox.append( $option );
          } );

          $statebox.val( value ).change();

          $( document.body ).trigger( 'country_to_state_changed', [country, $wrapper] );
        }
      } else {
        if ( $statebox.is( 'select, input[type="hidden"]' ) ) {
          $newstate = $( '<input type="text" />' )
            .prop( 'id', input_id )
            .prop( 'name', input_name )
            .prop( 'placeholder', placeholder )
            .attr( 'data-input-classes', input_classes )
            .addClass( 'input-text  ' + input_classes );
          $parent.show().find( '.select2-container' ).remove();
          $statebox.replaceWith( $newstate );
          $( document.body ).trigger( 'country_to_state_changed', [country, $wrapper] );
        }
      }

      $( document.body ).trigger( 'country_to_state_changing', [country, $wrapper] );
    } );
  }

  if ( $( '#nab_billing_same_as_attendee' ).length > 0 ) {
    $( document ).on( 'change', '#nab_billing_same_as_attendee', function() {
      if ( this.checked ) {
        let updateFields = {
          'attendee_first_name': 'billing_first_name',
          'attendee_last_name': 'billing_last_name',
          'attendee_company': 'billing_company',
          'attendee_email': 'billing_email',
          'attendee_city': 'billing_city',
          'attendee_zip': 'billing_postcode',
        };
        $.each( updateFields, function( k, v ) {
          $( '#' + v ).val( $( '#' + k ).val() );
        } );

        $( '#billing_country' ).val( $( '#attendee_country' ).val() ).trigger( 'change' );
        $( '#billing_state' ).val( $( '#attendee_state' ).val() ).trigger( 'change' );
      }
    } );
  }

  if ( $( '#nab_bulk_quantity' ).length > 0 ) {

    $( document ).on( 'change', '#nab_is_bulk', function() {
      var isBulkOrder = $( this ).val();
      if ( isBulkOrder && 'yes' === isBulkOrder ) {
        $( '.nab-quantity-selector' ).show();
        $( '#nab_bulk_order_field' ).val( 'yes' );
      } else {
        $( '#nab_bulk_order_field' ).val( 'no' );
        $( '.nab-qty' ).val( '1' );
        $( '.nab-quantity-selector' ).hide();
        $( '#nab_bulk_quantity, #nab_bulk_order_qty_field' ).val( '' );
        nabRefreshCart();
      }
    } );

    $( document ).on( 'change', '#nab_bulk_quantity', function() {
      let selectedQty = $( this ).val();
      if ( selectedQty ) {
        $( '.nab-qty, #nab_bulk_order_qty_field' ).val( selectedQty );
      } else {
        $( '.nab-qty' ).val( '1' );
        $( '#nab_bulk_quantity, #nab_bulk_order_qty_field' ).val( '' );
      }
      nabRefreshCart();
    } );
  }

  function nabRefreshCart() {

    block( $('.woocommerce-cart-form') );
    block( $( 'div.cart_totals' ) );
   
    let nabCartData = {
      'action' : 'nab_custom_update_cart',
      'qty' : $('#nab_bulk_quantity').val(),
      'is_bulk' : $('#nab_is_bulk').val(),
    }

    $.ajax( {
        url: amplifyJS.ajaxurl,
        type: 'POST',
        data: nabCartData,
        success: function( data ) {

          if( 0 === data.err ) {
            $('.woocommerce').replaceWith(data.cart_content);
            $( '[name=\'update_cart\']' ).prop( 'disabled', true ).attr('aria-disabled', 'true');
            unblock( $('.woocommerce-cart-form') );
            unblock( $( 'div.cart_totals' ) );
            $.scroll_to_notices( $( '[role="alert"]' ) );
            $( document.body ).trigger( 'updated_wc_div' );
          } else {
            $( '[name=\'update_cart\']' ).prop( 'disabled', false );
            $( '[name=\'update_cart\']' ).trigger( 'click' );
          }
        }, error: function( xhr, ajaxOptions, thrownError ) {
          unblock( $('.woocommerce-cart-form') );
          unblock( $( 'div.cart_totals' ) );
          console.log( thrownError );
        }
    } );
  }

  var block = function( $node ) {
    if ( ! is_blocked( $node ) ) {
      $node.addClass( 'processing' ).block( {
        message: null,
        overlayCSS: {
          background: '#fff',
          opacity: 0.6
        }
      } );
    }
  };

  var is_blocked = function( $node ) {
    return $node.is( '.processing' ) || $node.parents( '.processing' ).length;
  };

  var unblock = function( $node ) {
    $node.removeClass( 'processing' ).unblock();
  };

  if ( $( '#nabAddAttendeeModal' ).length > 0 ) {
    $( document ).on( 'click', '.nab-add-attendee', function() {
      $( '#attendeeOrderID' ).val( $( this ).data( 'orderid' ) );
      $( '#attendeeOrderQty' ).val( $( this ).data( 'qty' ) );
      $( '#nabAddAttendeeModal' ).show();
    } );

    $( document ).on( 'click', '.nab-modal-close', function() {
      if ( $( this ).hasClass( 'nab-reload-on-close' ) ) {
        location.reload();
      } else {
        $( '#bulk_upload_file' ).val( '' );
        $( '.attendee-bulk-upload-form .input-placeholder' ).val( 'Upload File...' );
        $( '#nabAddAttendeeModal, #nabViewAttendeeModal' ).hide();
      }

    } );

    $( document ).on( 'change', '#bulk_upload_file', function( e ) {
      if ( e.target.files[ 0 ] ) {
        $( '.attendee-bulk-upload-form .input-placeholder' ).text( e.target.files[ 0 ].name );
      }
    } );

    $( document ).on( 'click', '#bulk_upload', function() {
      $( '.attendee-upload-message' ).removeClass( 'error success' ).hide();
      var file_data = $( '#bulk_upload_file' ).prop( 'files' )[ 0 ];

      if ( 0 === $( '#bulk_upload_file' )[ 0 ].files.length ) {
        $( '.attendee-upload-message' ).addClass( 'error' ).text( 'Please select a file!' ).show();
      } else {
        $( 'body' ).addClass( 'is-loading' ); // loader
        var attendeeOrderID = $( '#attendeeOrderID' ).val();
        var attendeeOrderQty = $( '#attendeeOrderQty' ).val();
        var form_data = new FormData();
        form_data.append( 'file', file_data );
        form_data.append( 'action', 'nab_db_add_attendee' );
        form_data.append( 'attendeeOrderID', attendeeOrderID );
        form_data.append( 'nabNonce', amplifyJS.nabNonce );

        $.ajax( {
          url: amplifyJS.ajaxurl,
          type: 'POST',
          contentType: false,
          processData: false,
          data: form_data,
          success: function( response ) {
            console.log( response );
            if ( 0 === response.err ) {
              var totalRecords = response.total_records;
              var loopCount = Math.ceil( totalRecords / 10 );
              var attendeeData = {
                'attendeeOrderID': attendeeOrderID,
                'totalRecords': totalRecords,
                'loopCount': loopCount,
                'attendeeOrderQty': attendeeOrderQty,
                'action': 'insert_new_attendee'
              };

              processAttendeeData( attendeeData );

            } else {
              $( '.attendee-upload-message' ).addClass( 'error' ).text( response.message ).show();
              $( 'body' ).removeClass( 'is-loading' ); // loader
            }
          },
          error: function( xhr, ajaxOptions, thrownError ) {
            $( 'body' ).removeClass( 'is-loading' ); // loader
            console.log( thrownError );
          }
        } );
      }
    } );

    async function processAttendeeData( attendeeData ) {
      for ( i = 0; i < attendeeData.loopCount; i ++ ) {
        attendeeData.currentIndex = i;
        if ( attendeeData.loopCount === (attendeeData.currentIndex + 1) ) {
          attendeeData.isLast = 'yes';
        }
        var uploadedAttendeeResp = await uploadedAttendee( attendeeData );
      }
    }

    function uploadedAttendee( attendeeData ) {
      return new Promise( function( resolve, reject ) {
        $.ajax( {
          url: amplifyJS.ajaxurl,
          type: 'POST',
          data: attendeeData,
          success: function( data ) {
            console.log( data );
            if ( 1 === data.err ) {
              importErrs.push( data.msg );
            }
            if ( 1 === data.skipped ) {
              skippedErrs.push( data.skipped_msg );
            }
            addedAttendee = parseInt( addedAttendee ) + parseInt( data.added_attendee );
            if ( attendeeData.loopCount === (attendeeData.currentIndex + 1) ) {
              $( '#bulk_upload_file' ).val( '' );
              $( '.attendee-bulk-upload-form .input-placeholder' ).text( 'Upload file...' );
              if ( importErrs.length > 0 ) {
                var importErrMsg = 'Attendee import process is completed. ' + addedAttendee + ' Attendees imported successfully. There were some errors while importing data.<br><br>';
                $.each( importErrs, function( k, v ) {
                  $.each( v, function( j, val ) {
                    importErrMsg += val + '<br>';
                  } );
                } );

                $( '.attendee-upload-message' ).addClass( 'error' ).html( importErrMsg ).show();
              } else {
                if ( skippedErrs.length > 0 ) {
                  var skippedErrsMsg = 'Attendee import process is completed. ' + addedAttendee + ' Attendees imported successfully. Some records were skipped due to below reasons:<br><br>';
                  //skippedErrsMsg += skippedErrs;
                  $.each( skippedErrs, function( k, v ) {
                    $.each( v, function( j, val ) {
                      skippedErrsMsg += val + '<br>';
                    } );
                  } );
                  $( '.attendee-upload-message' ).addClass( 'error' ).html( skippedErrsMsg ).show();
                } else {
                  $( '.attendee-upload-message' ).addClass( 'success' ).text( 'Attendee import process is completed. ' + addedAttendee + ' Attendees imported successfully.' ).show();
                }
              }
              if ( undefined !== typeof data.totalAddedAttendees && attendeeData.attendeeOrderQty === data.totalAddedAttendees ) {
                $( '.nab-add-attendee[data-orderid=' + attendeeData.attendeeOrderID + ']' ).hide();
              }
              addedAttendee = 0;
              $( '.nab-modal-close' ).addClass( 'nab-reload-on-close' );
              $( 'body' ).removeClass( 'is-loading' ); // loader
            }
            resolve( data );
          }, error: function( xhr, ajaxOptions, thrownError ) {
            $( 'body' ).removeClass( 'is-loading' ); // loader
            console.log( thrownError );
          }
        } );
      } );
    }
  }

  $( document ).on( 'click', '.nab-view-attendee', function() {
    var orderId = $( this ).data( 'orderid' );
    $( 'body' ).addClass( 'is-loading' ); // loader
    $.ajax( {
      url: amplifyJS.ajaxurl,
      type: 'GET',
      data: {
        'orderId': orderId,
        'action': 'get_order_attendees',
        'nabNonce': amplifyJS.nabNonce
      },
      success: function( response ) {
        $( '.attendee-view-table-wrp' ).empty();
        let attendeeTableWrap = $( '.attendee-view-table-wrp' )[ 0 ];

        if ( 1 === response.err ) {
          let errMessageElem = document.createElement( 'p' );
          errMessageElem.innerHTML = response.message;
          attendeeTableWrap.appendChild( errMessageElem );
        } else if ( 0 === response.attendees.length ) {
          let errMessageElem = document.createElement( 'p' );
          errMessageElem.innerHTML = 'No Attendees found.';
          attendeeTableWrap.appendChild( errMessageElem );
        } else {
          let attendeeTable = document.createElement( 'table' );
          let attendeeTableTitle = document.createElement( 'h3' );
          attendeeTableTitle.innerText = 'Attendee Details';

          let attendeeTableCopy = document.createElement( 'span' );
          attendeeTableCopy.className = 'nab-attendee-detail-copy';
          attendeeTableCopy.innerText = 'The following attendees have been registered and should have received an email with a temporary password. They can each use their personal log ins to access the Show(s).';

          let attendeeTableFooter = document.createElement( 'span' );
          attendeeTableFooter.className = 'nab-attendee-detail-footer';
          attendeeTableFooter.innerHTML = 'If you need to make changes to your list of attendees after uploading, please contact <a href="mailto:register@nab.org">register@nab.org</a>.';

          let attendeeThead = document.createElement( 'thead' );
          let attendeeTbody = document.createElement( 'tbody' );
          let attendeeTheadTr = document.createElement( 'tr' );

          let attendeeTheadFirstName = document.createElement( 'th' );
          attendeeTheadFirstName.innerText = 'First Name';
          let attendeeTheadLastName = document.createElement( 'th' );
          attendeeTheadLastName.innerText = 'Last Name';
          let attendeeTheadEmail = document.createElement( 'th' );
          attendeeTheadEmail.innerText = 'Email';

          attendeeTheadTr.appendChild( attendeeTheadFirstName );
          attendeeTheadTr.appendChild( attendeeTheadLastName );
          attendeeTheadTr.appendChild( attendeeTheadEmail );

          attendeeThead.appendChild( attendeeTheadTr );

          attendeeTable.appendChild( attendeeThead );

          let dataTitles = {
            'first_name': 'First Name',
            'last_name': 'Last Name',
            'email': 'Email'
          };

          for ( let a = 0; a < response.attendees.length; a ++ ) {
            let attendeeDataTr = document.createElement( 'tr' );
            $.each( response.attendees[ a ], function( key, value ) {
              let attendeeDataTd = document.createElement( 'td' );
              let attendeeDataTdText = document.createTextNode( value );
              attendeeDataTd.appendChild( attendeeDataTdText );
              attendeeDataTd.setAttribute( 'data-title', dataTitles[ key ] );
              attendeeDataTr.appendChild( attendeeDataTd );
            } );
            attendeeTbody.appendChild( attendeeDataTr );
          }
          attendeeTable.appendChild( attendeeTbody );

          attendeeTableWrap.appendChild( attendeeTableTitle );
          attendeeTableWrap.appendChild( attendeeTableCopy );
          attendeeTableWrap.appendChild( attendeeTable );
          attendeeTableWrap.appendChild( attendeeTableFooter );
        }

        $( '#nabViewAttendeeModal' ).show();
        $( 'body' ).removeClass( 'is-loading' ); // loader
      },
      error: function( xhr, ajaxOptions, thrownError ) {
        $( 'body' ).removeClass( 'is-loading' ); // loader
        console.log( thrownError );
      }
    } );
  } );

})( jQuery );
