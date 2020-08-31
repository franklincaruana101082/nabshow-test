/**
 * Wonderwall Public front side javascripts codes are written in this file.
 *
 *  @package Nab
 */
(function ($) {

    $(document).ready(function () {
        HeaderResponsive();

        $(window).on('resize', function () {
            HeaderResponsive();
        });
    });

    // on load
    $(window).load(function () {

        $('.video_added').removeClass('woocommerce-product-gallery__image');

        $('.custom_thumb.video_added a').fancybox({
            'width': 800,
            'height': 450,
            'transitionIn': 'elastic',
            'transitionOut': 'elastic',
            'type': 'iframe',
            'closeBtn': true,
            'smallBtn' : true
        });
    });


    $(document).on('click', '.product-head .product-layout span', function () {

        $('.product-head .product-layout span').removeClass('active');
        $(this).addClass('active');

        if ($(this).hasClass('grid')) {
            $('.product-list').removeClass('layout-list');
            $('.product-list').addClass('layout-grid');
        } else {
            $('.product-list').addClass('layout-list');
            $('.product-list').removeClass('layout-grid');
        }

    });

    // Upload user images using ajax.
    $('#profile_picture_file, #banner_image_file').on('change', function (e) {

        e.preventDefault();
        $(this).parent().addClass('loading');

        var fd = new FormData();
        var file = $(this);
        var file_name = $(this).attr('name');
        var individual_file = file[0].files[0];
        fd.append(file_name, individual_file);
        fd.append('action', 'nab_amplify_upload_images');

        jQuery.ajax({
            type: 'POST',
            url: amplifyJS.ajaxurl,
            data: fd,
            contentType: false,
            processData: false,
            success: function () {
                location.reload();
            }
        });
    });

    // Remove user images using ajax.
    $('#profile_picture_remove, #banner_image_remove').on('change', function (e) {

        e.preventDefault();
        $(this).parents('.flex-box').find('.user-image-box').addClass('loading');

        jQuery.ajax({
            type: 'POST',
            url: amplifyJS.ajaxurl,
            data: {
                action: 'nab_amplify_remove_images',
                name: $(this).attr('name')
            },
            success: function (data) {
                location.reload();
            }
        });
    });

    $(window).on('resize', function () {
		console.log( 'resize' );
    });

    // Related products
    if (4 < $('.related.products .product-list .product-item').length) {
        buildSliderConfiguration();

        $(window).on('resize', function () {
            buildSliderConfiguration();
        });
    }

    function buildSliderConfiguration() {
        $('.related.products .product-list').each(function () {
            var windowWidth = $(window).width();
            var numberOfVisibleSlides;
            if (windowWidth < 567) {
                numberOfVisibleSlides = 1;
            } else if (windowWidth < 768) {
                numberOfVisibleSlides = 2;
            } else if (windowWidth < 1200) {
                numberOfVisibleSlides = 3;
            } else {
                numberOfVisibleSlides = 4;
            }
            $(this).bxSlider({
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
            });
        });
    }

    function HeaderResponsive() {
        if (1024 >= $(window).width()) {
            $(document).on('click', '.nab-avatar-wrp', function () {
                $(this).next('.nab-profile-dropdown').slideToggle();
            });
        }
    }

	if ( $( '#attendee_country' ).length > 0 ) {
    var states_json       = wc_country_select_params.countries.replace( /&quot;/g, '"' ),
      states            = $.parseJSON( states_json ),
      wrapper_selectors = '.nab-event-reg-wrap';

    $( document.body ).on( 'change refresh', '#attendee_country', function() {
        // Grab wrapping element to target only stateboxes in same 'group'
        var $wrapper = $( this ).closest( wrapper_selectors );

        if ( ! $wrapper.length ) {
            $wrapper = $( this ).closest('.form-row').parent();
        }

        var country     = $( this ).val(),
          $statebox     = $wrapper.find( '#attendee_state' ),
          $parent       = $statebox.closest( '.form-row' ),
          input_name    = $statebox.attr( 'name' ),
          input_id      = $statebox.attr('id'),
          input_classes = $statebox.attr('data-input-classes'),
          value         = $statebox.val(),
          placeholder   = $statebox.attr( 'placeholder' ) || $statebox.attr( 'data-placeholder' ) || '',
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
                $( document.body ).trigger( 'country_to_state_changed', [ country, $wrapper ] );
            } else {
                var state          = states[ country ],
                  $defaultOption = $( '<option value=""></option>' ).text( wc_country_select_params.i18n_select_state_text );

                if ( ! placeholder ) {
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

                $( document.body ).trigger( 'country_to_state_changed', [country, $wrapper ] );
            }
        } else {
            if ( $statebox.is( 'select, input[type="hidden"]' ) ) {
                $newstate = $( '<input type="text" />' )
                  .prop( 'id', input_id )
                  .prop( 'name', input_name )
                  .prop('placeholder', placeholder)
                  .attr('data-input-classes', input_classes )
                  .addClass( 'input-text  ' + input_classes );
                $parent.show().find( '.select2-container' ).remove();
                $statebox.replaceWith( $newstate );
                $( document.body ).trigger( 'country_to_state_changed', [country, $wrapper ] );
            }
        }

        $( document.body ).trigger( 'country_to_state_changing', [country, $wrapper ] );
    });
	}

})(jQuery);
