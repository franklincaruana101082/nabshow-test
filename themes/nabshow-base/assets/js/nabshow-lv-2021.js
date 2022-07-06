(function ($) {

    $(document).ready( function() {

        $('.filter-settings-wrap .filter-item-dropdowns select').each(function(){
            if ( 0 < $(this)[0].selectedIndex ) {
                $(this).addClass('active');
            }
        });
        
        $(document).on('click', '.filter-settings-wrap .filter-item-dates .filter-date', function(){
            
            if ( $(this).hasClass('active') ) {
                $(this).removeClass('active');
            } else {
                $(this).addClass('active').siblings().removeClass('active');
            }
            nabSessionListPageAjax( $(this), 1 );
        });

        $(document).on('change', '.filter-settings-wrap .filter-item-dropdowns .filter-program, .filter-settings-wrap .filter-item-dropdowns .filter-registration-pass, .filter-settings-wrap .filter-item-dropdowns .filter-topic, .filter-settings-wrap .filter-item-dropdowns .filter-education-partner', function(){
            
           if ( 0 === $(this)[0].selectedIndex ) {
               $(this).removeClass('active');
           } else {
               $(this).addClass('active');
           }
           nabSessionListPageAjax( $(this), 1 );
        });

        $(document).on('change', '.filter-settings-wrap .filter-item-dropdowns .filter-session-type, .filter-settings-wrap .filter-item-dropdowns .filter-experience-level, .filter-settings-wrap .filter-item-dropdowns .filter-speaker-name, .filter-settings-wrap .filter-item-dropdowns .filter-location', function(){
            
            if ( 0 === $(this)[0].selectedIndex ) {
                $(this).removeClass('active');
            } else {
                $(this).addClass('active');
            }
            nabSessionListPageAjax( $(this), 1 );
         });
        
        $(document).on('click', '.filter-row #mys-session-list .filter-pagination a', function () {
            let pageNumber = $(this).attr('href').split('#')[1].replace('#', '');
            nabSessionListPageAjax( $(this), pageNumber );
            return false;
        });
    });

    function nabSessionListPageAjax( _this, pageNumber ) {
        let parentElement = _this.parents('.filter-row');
        let sessionDate = 0 < parentElement.find('.filter-date.active').length ? parentElement.find('.filter-date.active').attr('data-date') : '';
        let page = 1,
        program = '',
        registrationPass = '',
        topic = '',
        educationPartner = '',
        sessionType = '',
        experienceLevel = '',
        speaker = '',
        location = '';

        if ( 0 < parentElement.find('.filter-item-dropdowns .filter-program').length ) {
            program = 0 === parentElement.find('.filter-item-dropdowns .filter-program')[0].selectedIndex ? '' : parentElement.find('.filter-item-dropdowns .filter-program').val();
        }

        if ( 0 < parentElement.find('.filter-item-dropdowns .filter-registration-pass').length ) {
            registrationPass = 0 === parentElement.find('.filter-item-dropdowns .filter-registration-pass')[0].selectedIndex ? '' : parentElement.find('.filter-item-dropdowns .filter-registration-pass').val();
        }

        if ( 0 < parentElement.find('.filter-item-dropdowns .filter-topic').length ) {
            topic = 0 === parentElement.find('.filter-item-dropdowns .filter-topic')[0].selectedIndex ? '' : parentElement.find('.filter-item-dropdowns .filter-topic').val();
        }

        if ( 0 < parentElement.find('.filter-item-dropdowns .filter-education-partner').length ) {
            educationPartner = 0 === parentElement.find('.filter-item-dropdowns .filter-education-partner')[0].selectedIndex ? '' : parentElement.find('.filter-item-dropdowns .filter-education-partner').val();
        }

        if ( 0 < parentElement.find('.filter-item-dropdowns .filter-session-type').length ) {
            sessionType = 0 === parentElement.find('.filter-item-dropdowns .filter-session-type')[0].selectedIndex ? '' : parentElement.find('.filter-item-dropdowns .filter-session-type').val();
        }

        if ( 0 < parentElement.find('.filter-item-dropdowns .filter-experience-level').length ) {
            experienceLevel = 0 === parentElement.find('.filter-item-dropdowns .filter-experience-level')[0].selectedIndex ? '' : parentElement.find('.filter-item-dropdowns .filter-experience-level').val();
        }

        if ( 0 < parentElement.find('.filter-item-dropdowns .filter-speaker-name').length ) {
            speaker = 0 === parentElement.find('.filter-item-dropdowns .filter-speaker-name')[0].selectedIndex ? '' : parentElement.find('.filter-item-dropdowns .filter-speaker-name').val();
        }

        if ( 0 < parentElement.find('.filter-item-dropdowns .filter-location').length ) {
            location = 0 === parentElement.find('.filter-item-dropdowns .filter-location')[0].selectedIndex ? '' : parentElement.find('.filter-item-dropdowns .filter-location').val();
        }

        if ( pageNumber && '' !== pageNumber ) {
            page = pageNumber
        } else {
            page = 0 < parentElement.find('#mys-session-list .filter-pagination span.current').length ? parentElement.find('#mys-session-list .filter-pagination span.current').text() : 1;
        }

        // added query param merter based on search filter.
        let currentUrl = new URL( window.location );
        if ( parseInt( page ) > 1 ) {
            currentUrl.searchParams.set('page', page );
        } else {
            currentUrl.searchParams.delete('page');
        }
        if ( '' !== program ) {
            currentUrl.searchParams.set('program', program );
        } else {
            currentUrl.searchParams.delete('program');
        }
        if ( '' !== registrationPass ) {
            currentUrl.searchParams.set('registration_pass', registrationPass );
        } else {
            currentUrl.searchParams.delete('registration_pass');
        }
        if ( '' !== topic ) {
            currentUrl.searchParams.set('topic', topic );
        } else {
            currentUrl.searchParams.delete('topic');
        }
        if ( '' !== educationPartner ) {
            currentUrl.searchParams.set('education_partner', educationPartner );
        } else {
            currentUrl.searchParams.delete('education_partner');
        }
        if ( '' !== sessionType ) {
            currentUrl.searchParams.set('session_type', sessionType );
        } else {
            currentUrl.searchParams.delete('session_type');
        }
        if ( '' !== experienceLevel ) {
            currentUrl.searchParams.set('experience_level', experienceLevel );
        } else {
            currentUrl.searchParams.delete('experience_level');
        }
        if ( '' !== speaker ) {
            currentUrl.searchParams.set('speaker', speaker );
        } else {
            currentUrl.searchParams.delete('speaker');
        }
        if ( '' !== location ) {
            currentUrl.searchParams.set('location', location );
        } else {
            currentUrl.searchParams.delete('location');
        }
        if ( '' !== sessionDate ) {
            currentUrl.searchParams.set('date', sessionDate );
        } else {
            currentUrl.searchParams.delete('date');
        }

        window.history.pushState({}, '', currentUrl);

        $('body').addClass('is-loading');

        $.ajax({
            url: nabObject.ajax_url,
            type: 'GET',
            data: {
                action: 'nab_2021_session_filter',
                nabNonce: nabObject.ajax_filter_nonce,
                date: sessionDate,
                page: page,
                program: program,
                registration_pass: registrationPass,
                topic: topic,
                education_partner: educationPartner,
                session_type: sessionType,
                experience_level: experienceLevel,
                speaker: speaker,
                location: location,
            },
            success: function ( response ) {

                if ( response.success ) {
                    
                    $('#mys-session-list .filter-result-wrap').html( response.data.session_html );
                    $('#mys-session-list .filter-pagination').html( response.data.pagination );
                }

                $('body').removeClass('is-loading');
            }
        });
    }

    nabSessionListPageAjax( $(this), 1 );
})(jQuery);