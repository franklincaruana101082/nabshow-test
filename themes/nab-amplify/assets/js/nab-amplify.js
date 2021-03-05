/**
 * Amplify Public front side javascripts codes are written in this file.
 *
 *  @package Nab
 */
;(function ($) {
  var importErrs = []
  var skippedErrs = []
  var addedAttendee = 0

  // Ready.
  $(document).ready(function () {
    $('.section-professional-details .user-job-role-select').select2({
      width: '100%'
    })
    $('.section-professional-details .user-industry-select').select2({
      width: '100%'
    })

    $('.section-professional-details .user-country-select').select2({
      placeholder: 'Select a country',
      width: '100%'
    })

    $('.section-professional-details .user-state-select').select2({
      placeholder: 'Select a state',
      width: '100%'
    })

    $('.nab-custom-select select').select2({ width: '100%' })

    $(document).on('change', '.signup-privacy-policy', function () {
      if (this.checked) {
        $(this)
          .parents('.nab-normal-signup')
          .find('.woocommerce-form-register__submit')
          .removeAttr('disabled')
      } else {
        $(this)
          .parents('.nab-normal-signup')
          .find('.woocommerce-form-register__submit')
          .attr('disabled', 'disabled')
      }
    })

    if (0 < $('#user-country-select').length) {
      var wc_states_json = wc_country_select_params.countries.replace(
        /&quot;/g,
        '"'
      )
      var wc_states = $.parseJSON(wc_states_json)
      $(document).on('change', '#user-country-select', function () {
        console.log(wc_states[$(this).val()])

        var state = wc_states[$(this).val()]
        $('.section-professional-details .user-state-select').empty()

        $.each(state, function (index) {
          var $option = $('<option></option>')
            .prop('value', index)
            .text(state[index])
          $('.section-professional-details .user-state-select').append($option)
        })

        $('.section-professional-details .user-state-select')
          .val('')
          .change()
      })
    }

    $(document).on('click', '.notification-wrapper', function () {
      $(this).toggleClass('hover')
    })

    $(document).on('click', '.amp-item-col *, .search-item *', function (e) {
      e.stopPropagation()

      const _card = $(this).parents('.amp-item-col').length
        ? $(this).parents('.amp-item-col')
        : $(this).parents('.search-item')
      if (
        0 === $(this).closest('a').length &&
        0 === $(this).closest('.fa').length
      ) {
        var profileURL = ''
        if (_card.find('h4 a').length) {
          profileURL = _card.find('h4 a').attr('href')
        } else {
          profileURL = _card.find('.amp-item-avtar a').attr('href')
        }
        if (
          undefined !== profileURL &&
          -1 < profileURL.indexOf('members') &&
          -1 === profileURL.indexOf('wpnonce')
        ) {
          window.location.href = profileURL
        }
      }
    })

    if (
      typeof amplifyJS !== 'undefined' &&
      amplifyJS.postType === 'company' &&
      jQuery.inArray(
        parseInt(amplifyJS.CurrentLoggedUser),
        amplifyJS.CompanyAdminId
      ) !== -1
    ) {
      jQuery('.edit-feature-block').show()
    } else {
      jQuery('.edit-feature-block').hide()
    }

    HeaderResponsive()

    $(window).on('resize', function () {
      HeaderResponsive()
    })

    // Remove Billing form if no payment method available/required in checkout.
    $(document.body).on('updated_checkout', function () {
      if (0 === $('ul.wc_payment_methods').length) {
        $(
          '.woocommerce-billing-fields__field-wrapper p:not(.bill-mandatory)'
        ).remove()
      } else if (0 === $('#billing_country_field').length) {
        /**
         * If bill is not 0.00 and the billing_country_field is missing,
         * reload the page to get all other fields.
         */
        $('#place_order').attr('disabled')
        location.reload()
      }
    })

    // If remove connection icon found on the page,
    // add a popup in the body in advance.
    if (0 < $('.is_friend .remove').length) {
      // Add a default popup.
      nabAddPopup('unfriend-confirmation')

      // Get added popup's inner div to add extra content.
      let nabModalContentWrap = $('#unfriend-confirmation .modal-content-wrap')

      let confimPopupPara = document.createElement('p')
      confimPopupPara.innerHTML = 'Do you really want to remove connection?'
      nabModalContentWrap.append(confimPopupPara)

      let confimPopupYes = document.createElement('a')
      confimPopupYes.setAttribute('href', 'javascript:void(0);')
      confimPopupYes.setAttribute('id', 'confirmed-yes')
      confimPopupYes.setAttribute('class', 'confirmed-answer button')
      confimPopupYes.innerHTML = 'Yes'
      nabModalContentWrap.append(confimPopupYes)

      let confimPopupNo = document.createElement('a')
      confimPopupNo.setAttribute('href', 'javascript:void(0);')
      confimPopupNo.setAttribute('id', 'confirmed-no')
      confimPopupNo.setAttribute('class', 'confirmed-answer button')
      confimPopupNo.innerHTML = 'No'
      nabModalContentWrap.append(confimPopupNo)
    }

    jQuery('.comments-order').on('change', function () {
      var url = window.location.href
      var orderby = jQuery(this).val()
      var currentUrl = jQuery(this).attr('data-url')
      window.location.href = currentUrl + '/?orderby=' + orderby
    })

    /* close popup */
    jQuery(document).on(
      'click',
      '.nab-modal-close, .nab-modal-remove',
      function () {
        if (
          $(this)
            .parents('.nab-modal')
            .hasClass('nab-modal-active')
        ) {
          $(this)
            .parents('.nab-modal')
            .removeClass('nab-modal-active')
        } else {
          $(this)
            .parents('.nab-modal')
            .hide()
        }

        // Remove class added when connection request popup dispalyed.
        $('body').removeClass('connection-popup-added')
      }
    )

    jQuery(document).on('click touchstart', function (e) {
      if ($(e.target).is('.nab-modal-inner')) {
        var checkPopup = $(e.target).parents('.nab-modal')
        if (checkPopup.hasClass('nab-modal-active')) {
          checkPopup.removeClass('nab-modal-active')
        } else {
          checkPopup.hide()
        }
      }
    })

    /* Reaction Hide/Show */
    $(document).on(
      'click',
      '.reaction-list-type .reaction-main-like',
      function () {
        $(this)
          .next('.reaction-icon-modal')
          .toggleClass('show-icon-modal')
      }
    )

    $('.reaction-list-type')
      .mouseenter(function () {
        $(this)
          .find('.reaction-icon-modal')
          .toggleClass('show-icon-modal')
      })
      .mouseleave(function () {
        $(this)
          .find('.reaction-icon-modal')
          .removeClass('show-icon-modal')
      })

    $(document).on(
      'click',
      '.reaction-list-type .nab-reaction-type',
      function () {
        $(this)
          .parents('.reaction-icon-modal')
          .removeClass('show-icon-modal')
      }
    )

    jQuery('.nab-preview-item img').click(function () {
      var currentThumb = jQuery(this)
      $('.nab-preview-main img')
        .fadeOut(200, function () {
          jQuery('.nab-preview-main img').attr(
            'src',
            currentThumb.attr('src').replace('thumb', 'large')
          )
        })
        .fadeIn(200)
    })
    jQuery('#product_categories').select2()
    jQuery('#company_point_of_contact').select2({
      ajax: {
        url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
        dataType: 'json',
        delay: 250, // delay in ms while typing when to perform a AJAX search
        data: function (params) {
          return {
            q: params.term, // search query
            action: 'nab_product_point_of_contact' // AJAX action for admin-ajax.php
          }
        },
        processResults: function (data) {
          var options = []
          if (data) {
            // data is the array of arrays, and each of them contains ID and the Label of the option
            $.each(data, function (index, text) {
              // do not forget that "index" is just auto incremented value
              options.push({ id: text[0], text: text[1] })
            })
          }
          return {
            results: options
          }
        },
        cache: true
      },
      minimumInputLength: 3,
      placeholder: 'Select Point of contact',
      allowClear: true
    })

    if (typeof jQuery.cookie('new_company_admin_popup') != 'undefined') {
      jQuery.ajax({
        url: amplifyJS.ajaxurl,
        type: 'POST',
        data: {
          action: 'nab_add_company_admin_popup',
          company_id: amplifyJS.postID
        },
        success: function (data) {
          if (0 === $('#addAdminModal').length) {
            $('body').append(data)
            $('#addAdminModal').show()
            $('body').addClass('connection-popup-added')
          } else {
            $('body').addClass('connection-popup-added')
            $('#addAdminModal').remove()
            $('body').append(data)
            $('#addAdminModal').show()
          }
          jQuery.removeCookie('new_company_admin_popup', { path: '/' })
        }
      })
    }

    $(document).on('click', '.action-add-address ', function () {
      const address_id =
        undefined !== $(this).data('id') ? $(this).data('id') : ''
      const company_id = amplifyJS.postID
      const _this = $(this)
      _this.addClass('loading')
      jQuery.ajax({
        type: 'POST',
        url: amplifyJS.ajaxurl,
        data: {
          action: 'nab_amplify_add_address',
          address_id: address_id,
          company_id: company_id
        },
        success: function (data) {
          _this.removeClass('loading')
          if (jQuery('#addProductModal').length === 0) {
            jQuery('body').append(data)
            jQuery('#addProductModal')
              .show()
              .addClass('nab-modal-active')
            $('#country').select2({
              placeholder: 'Select Country',
              allowClear: true
            })
            if ($('#country').val()) {
              filter_states($('#country').find(':selected').data('country-code'))
            }
          } else {
            jQuery('#addProductModal').remove()
            jQuery('body').append(data)
            jQuery('#addProductModal')
              .show()
              .addClass('nab-modal-active')
            if (jQuery('#nab_company_id').length > 0) {
              jQuery('#nab_company_id').val(company_id)
            }
            $('#country').select2({
              placeholder: 'Select Country',
              allowClear: true
            })
            if ($('#country').val()) {
              filter_states($('#country').find(':selected').data('country-code'))
            }
          }
        }
      })
    })

    function filter_states (country_code) {
      jQuery.ajax({
        type: 'POST',
        url: amplifyJS.ajaxurl,
        data: {
          action: 'nab_amplify_state_filter',
          country_code: country_code
        },
        beforeSend: function () {
          $('body').addClass('is-loading')
        },
        success: function (data) {
          $('body').removeClass('is-loading')
          jQuery('#state_select_wrapper').show()
          var pre_state = jQuery('#country').attr('data-state')
          if (data.length) {
            jQuery('#state_select_wrapper .input-text').remove()
            if (jQuery('#state').length === 0) {
              jQuery('#state_select_wrapper').append(
                '<div class="select-dark-simple"><select name="state" id="state"></select></div>'
              )
            }

            jQuery('#state').empty()
            jQuery('#state').append('<option value="" selected> </option>' )
            data.forEach(function (item) {
              if (pre_state !== '' && typeof pre_state !== 'undefined') {
                if (item.Display == pre_state) {
                  if (jQuery('#state').is('select')) {
                    jQuery('#state').append(
                      '<option value="' +
                        item.Display +
                        '" selected>' +
                        item.Display +
                        '</option>'
                    )
                  } else {
                    jQuery('#state').val(pre_state)
                  }
                } else {
                  if (jQuery('#state').is('select')) {
                    jQuery('#state').append(
                      '<option value="' +
                        item.Display +
                        '" >' +
                        item.Display +
                        '</option>'
                    )
                  }
                }
              } else {
                if (jQuery('#state').is('select')) {
                  jQuery('#state').append(
                    '<option value="' +
                      item.Display +
                      '" >' +
                      item.Display +
                      '</option>'
                  )
                }
              }
            })

            jQuery('#state').select2({
              placeholder: 'Select State',
              allowClear: true
            })
          } else {
            jQuery('#state_select_wrapper .select-dark-simple').remove()
            if (jQuery('#state_select_wrapper .input-text').length === 0) {
              jQuery('#state_select_wrapper').append(
                '<input type="text" class="input-text nab-featured-block-button-link" name="state" id="state" value=""></input>'
              )
            }

            if (pre_state !== '') {
              jQuery('#state').val(pre_state)
            }
          }
        }
      })
    }

    $(document).on('change', '#country ', function () {
      const address_id =
        undefined !== $(this).data('address-id')
          ? $(this).data('address-id')
          : ''
      const company_id = amplifyJS.postID
      const _this = $(this)
      _this.addClass('loading')
      const country_code = $(this).find(':selected').data('country-code')
      $(this).attr('data-state', '')
      if (jQuery('#state').length && jQuery('#state').is('input')) {
        jQuery('#state').val('')
      } else if (jQuery('#state').length && jQuery('#state').is('select')) {
        jQuery('#state').empty()
      }

      filter_states(country_code)
    })
  })
  function validateURL (urltext) {
    if (urltext !== '') {
      var rg = /^(https?|ftp):\/\/([a-zA-Z0-9.-]+(:[a-zA-Z0-9.&%$-]+)*@)*((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]?)(\.(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}|([a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(:[0-9]+)*(\/($|[a-zA-Z0-9.,?'\\+&%$#=~_-]+))*$/
      return rg.test(urltext)
    } else {
      return true
    }
  }

  $(document).on('click', '.action-remove-address ', function () {
    const address_id =
      undefined !== $(this).data('id') ? $(this).data('id') : ''
    const company_id = amplifyJS.postID
    const _this = $(this)
    _this.addClass('loading')
    get_address_remove_popup('Are you sure want to remove?',address_id)


  })

  $(document).on('click', '.remove-employee ', function (e) {
    e.preventDefault();
    const empolyee_id =
      undefined !== $(this).data('id') ? $(this).data('id') : ''
    const company_id = amplifyJS.postID
    const _this = $(this)
    _this.addClass('loading')
    get_employee_remove_popup('Are you sure want to remove?',empolyee_id)


  })

  $(document).on('click', '#nab-add-address-submit', function () {
    var company_id = jQuery('#nab_company_id').val()
    var address_id = jQuery(this).data('id')
    var street_line_1 = jQuery('#street_line_1').val()
    var street_line_2 = jQuery('#street_line_2').val()
    var city = jQuery('#city').val()
    var state = jQuery('#state').val()
    var country = jQuery('#country').val()
    var zip = jQuery('#zip').val()
    var form_data = new FormData()

    form_data.append('street_line_1', street_line_1)
    form_data.append('street_line_2', street_line_2)
    form_data.append('city', city)
    form_data.append('state', state)
    form_data.append('country', country)
    form_data.append('zip', zip)
    form_data.append('action', 'nab_amplify_submit_address')
    form_data.append('company_id', company_id)
    form_data.append('address_id', address_id)

    jQuery.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: form_data,
      contentType: false,
      processData: false,
      beforeSend: function () {
        $('body').addClass('is-loading')
      },
      success: function (data) {
        $('body').removeClass('is-loading')
        if (undefined !== data.success && !data.success) {
          addSuccessMsg('.add-product-content-popup', data.data)
        } else {
          addSuccessMsg(
            '.add-product-content-popup',
            'Address Updated Successfully!'
          )
        }
      }
    })
  })

  $(document).on('click', '.action-add-employee', function () {

    const company_id = amplifyJS.postID
    const _this = $(this)
    _this.addClass('loading')
    jQuery.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: {
        action: 'nab_amplify_add_employee',
        company_id: company_id
      },
      success: function (data) {
        _this.removeClass('loading')
        if (jQuery('#addProductModal').length === 0) {
          jQuery('body').append(data)
          jQuery('#addProductModal')
            .show()
            .addClass('nab-modal-active')
            jQuery('#company_employees').select2({
              ajax: {
                url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
                dataType: 'json',
                delay: 250, // delay in ms while typing when to perform a AJAX search
                data: function (params) {
                  return {
                    q: params.term, // search query
                    action: 'nab_product_point_of_contact' // AJAX action for admin-ajax.php
                  }
                },
                processResults: function (data) {
                  var options = []
                  if (data) {
                    // data is the array of arrays, and each of them contains ID and the Label of the option
                    $.each(data, function (index, text) {
                      // do not forget that "index" is just auto incremented value
                      options.push({ id: text[0], text: text[1] })
                    })
                  }
                  return {
                    results: options
                  }
                },
                cache: true
              },
              minimumInputLength: 3,
              placeholder: 'Select Employee',
              allowClear: true
            })
        } else {
          jQuery('#addProductModal').remove()
          jQuery('body').append(data)
          jQuery('#addProductModal')
            .show()
            .addClass('nab-modal-active')
          if (jQuery('#nab_company_id').length > 0) {
            jQuery('#nab_company_id').val(company_id)
          }
          jQuery('#company_employees').select2({
            ajax: {
              url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
              dataType: 'json',
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {
                return {
                  q: params.term, // search query
                  action: 'nab_product_point_of_contact' // AJAX action for admin-ajax.php
                }
              },
              processResults: function (data) {
                var options = []
                if (data) {
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                  $.each(data, function (index, text) {
                    // do not forget that "index" is just auto incremented value
                    options.push({ id: text[0], text: text[1] })
                  })
                }
                return {
                  results: options
                }
              },
              cache: true
            },
            minimumInputLength: 3,
            placeholder: 'Select Employee',
            allowClear: true
          })
        }
      }
    })
  })


  $(document).on('click', '#nab-add-employee-submit', function () {
    var company_id = jQuery('#nab_company_id').val()
    var company_employees = jQuery('#company_employees').val()
    var form_data = new FormData()


    form_data.append('company_id', company_id)
    form_data.append('company_employees', company_employees)
    form_data.append('action', 'nab_amplify_submit_employee')

    jQuery.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: form_data,
      contentType: false,
      processData: false,
      beforeSend: function () {
        $('body').addClass('is-loading')
      },
      success: function (data) {
        $('body').removeClass('is-loading')
        if (undefined !== data.success && !data.success) {
          addSuccessMsg('.add-product-content-popup', data.content)
        } else {
          addSuccessMsg(
            '.add-product-content-popup',
            'Employees Updated Successfully!'
          )
        }
      }
    })
  })

  charcount('keyup', '#company_about', '#character-count-comp-about', 2000)
  charcount(
    'keyup',
    '#nab_featured_block_headline',
    '#character-count-featured-headline',
    200
  )
  charcount(
    'keyup',
    '#nab_featured_block_posted_by',
    '#character-count-featured-posyby',
    60
  )
  charcount(
    'keyup',
    '#nab_featured_block_description',
    '#character-count-featured-desc',
    200
  )
  charcount(
    'keyup',
    '#nab_featured_block_button_label',
    '#character-count-featured-btnlabel',
    60
  )

  // Add a popup function if not exists.
  if ('function' !== typeof nabAddPopup) {
    /**
     * Add a blank popup.
     *
     * @param ID Main modal ID.
     */
    function nabAddPopup (ID) {
      let nabModal = document.createElement('div')
      nabModal.setAttribute('class', 'nab-modal')
      nabModal.setAttribute('id', ID)

      let nabModalInner = document.createElement('div')
      nabModalInner.setAttribute('class', 'nab-modal-inner')
      nabModal.appendChild(nabModalInner)

      let nabModalContent = document.createElement('div')
      nabModalContent.setAttribute('class', 'modal-content')
      nabModalInner.appendChild(nabModalContent)

      let nabModalClose = document.createElement('span')
      nabModalClose.setAttribute(
        'class',
        'nab-modal-close fa fa-times confirmed-answer'
      )
      nabModalClose.setAttribute('id', 'confirmed-no')
      nabModalContent.appendChild(nabModalClose)

      let nabModalContentWrap = document.createElement('div')
      nabModalContentWrap.setAttribute('class', 'modal-content-wrap')
      nabModalContent.appendChild(nabModalContentWrap)

      jQuery('body').append(nabModal)
    }
  }

  function charcount (event, tag, counttag, limit) {
    jQuery(document).on(event, tag, function (e) {
      var len = jQuery(this).val().length
      var cval = jQuery(this).val()
      var diff = limit - len
      if (len >= limit) {
        cval = jQuery(this)
          .text()
          .substring(0, 250)
        jQuery(counttag).html('Maximum Characters Limit exeeds!')
      } else {
        jQuery(counttag).html('' + diff + ' characters remianing')
      }
    })
  }

  function load_tinyMCE_withPlugins (tag, countTag, limit = 2000) {
    var d = new Date()
    var time = d.getTime()
    tinymce.init({
      selector: tag,
      plugins: ['link', 'image', 'lists'],
      menubar: false,
      statusbar: false,
      toolbar:
        'bold italic alignleft aligncenter alignright alignjustify bullist numlist outdent indent link unlink image',
      setup: function (editor) {
        editor.on('change keyup', function (e) {
          editor.save() // updates this instance's textarea
          $(editor.getElement()).trigger('change') // for garlic to detect change
          if (countTag) {
            var len = editor
              .getContent()
              .replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/gi, '').length
            var cval = jQuery(tag).val()
            var diff = limit - len
            if (len >= limit) {
              cval = jQuery(tag)
                .text()
                .substring(0, 250)
              jQuery(countTag).html('Maximum Characters Limit exeeds!')
            } else {
              jQuery(countTag).html('' + diff + ' characters remianing')
            }
          }
        })

      },
      content_css:
        amplifyJS.ThemeUri + '/assets/css/nab-front-tinymce.css?ver=' + time,
        valid_elements : ""
          +"a[href|target|class],"
          +"b,"
          +"br,"
          +"font[color|face|size],"
          +"img[src|id|width|height|align|hspace|vspace|class|align],"
          +"em,"
          +"strong,"
          +"li[class],"
          +"p[align|class],"
          +"h1[class],"
          +"h2[class],"
          +"h3[class],"
          +"h4[class],"
          +"h5[class],"
          +"h6[class],"
          +"span[class],"
          +"textformat[blockindent|indent|leading|leftmargin|rightmargin|tabstops],"
          +"u"

    })
  }

  function addSuccessMsg (tag, message) {
    if (jQuery(tag).length) {
      if (tag === '.modal-content-wrap') {
        if (
          jQuery('.modal-content-wrap').find('.woocommerce-notices-wrapper')
            .length
        ) {
          jQuery('.modal-content-wrap')
            .find('.woocommerce-notices-wrapper')
            .remove()
          jQuery(tag).prepend(
            '<div class="woocommerce-notices-wrapper"><div class="woocommerce-message">' +
              message +
              '<span class="close-message fa fa-close"></span></div></div>'
          )
        } else {
          jQuery(tag).prepend(
            '<div class="woocommerce-notices-wrapper"><div class="woocommerce-message">' +
              message +
              '<span class="close-message fa fa-close"></span></div></div>'
          )
        }
      } else {
        if (
          jQuery('.modal-content-wrap').find('.woocommerce-notices-wrapper')
            .length
        ) {
          jQuery('.modal-content-wrap')
            .find('.woocommerce-notices-wrapper')
            .remove()
          jQuery(tag).after(
            '<div class="woocommerce-notices-wrapper"><div class="woocommerce-message">' +
              message +
              '<span class="close-message fa fa-close"></span></div></div>'
          )
        } else {
          jQuery(tag).after(
            '<div class="woocommerce-notices-wrapper"><div class="woocommerce-message">' +
              message +
              '<span class="close-message fa fa-close"></span></div></div>'
          )
        }
      }
    }
  }

  function defaultCharCount (tag, charTag, limit) {
    if (jQuery(tag).length > 0) {
      var prod_copy_content_length = jQuery(tag)
        .val()
        .replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/gi, '').length
      var diff = limit - prod_copy_content_length
      if (diff < 0) {
        jQuery(charTag).html('Maximum Characters Limit exeeds!')
      } else {
        jQuery(charTag).html('' + diff + ' characters remianing')
      }
    }
  }

  function checkContentlength (tag, tagLabel, limit) {
    var tag_length = jQuery(tag)
      .val()
      .replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/gi, '').length

    if (tag_length > limit) {
      alert(
        'The length of ' +
          tagLabel +
          ' is ' +
          tag_length +
          ' the max num of characters allowed for this content is ' +
          limit +
          ''
      )
      $('body').removeClass('is-loading')
      return false
    } else {
      return true
    }
  }

  $(document).on('click', '.close-message', function () {
    jQuery(this)
      .parents('.woocommerce-notices-wrapper')
      .remove()
    jQuery('body').addClass('nab-close-reload')
  })

  function get_error_popup(message){
    $.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: {
        action: 'nab_get_error_popup',
        message: message,
      },
      success: function (data) {
        if (0 === $('#connection-message-popup').length) {
          $('body').append(data)
          $('#connection-message-popup').show()
          $('body').addClass('connection-popup-added')
        } else {
          $('body').addClass('connection-popup-added')
          $('#connection-message-popup').remove()
          $('body').append(data)
          $('#connection-message-popup').show()
        }
      }
    })
  }

  function get_address_remove_popup(message,address_id){
    $.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: {
        action: 'nab_get_error_popup',
        message: message,
        confirm:'1',
        address_id:address_id
      },
      success: function (data) {
        if (0 === $('#connection-message-popup').length) {
          $('body').append(data)
          $('#connection-message-popup').show()
          $('body').addClass('connection-popup-added')
        } else {
          $('body').addClass('connection-popup-added')
          $('#connection-message-popup').remove()
          $('body').append(data)
          $('#connection-message-popup').show()
        }
      }
    })
  }

  function get_employee_remove_popup(message,employee_id){
    $.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: {
        action: 'nab_get_error_popup',
        message: message,
        employee_remove:'1',
        employee_id:employee_id
      },
      success: function (data) {
        if (0 === $('#connection-message-popup').length) {
          $('body').append(data)
          $('#connection-message-popup').show()
          $('body').addClass('connection-popup-added')
        } else {
          $('body').addClass('connection-popup-added')
          $('#connection-message-popup').remove()
          $('body').append(data)
          $('#connection-message-popup').show()
        }
      }
    })
  }

  $(document).on('click', '.confirm_address_remove_yes', function () {
    const address_id =
        undefined !== $(this).data('id') ? $(this).data('id') : ''
      const company_id = amplifyJS.postID
      const _this = $(this)
    jQuery.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: {
        action: 'nab_amplify_remove_address',
        address_id: address_id,
        company_id: company_id
      },
      beforeSend:function(){
        $('body').addClass('is-loading');
      },
      success: function (data) {
        if (data.success) {
          location.reload()
        }
      }
    })
  })
  $(document).on('click', '.confirm_address_remove_no', function () {
    $(this)
    .parents('.nab-modal')
    .hide()
  })

  $(document).on('click', '.confirm_employee_remove_yes', function () {
    const employee_id =
        undefined !== $(this).data('id') ? $(this).data('id') : ''
      const company_id = amplifyJS.postID
      const _this = $(this)
    jQuery.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: {
        action: 'nab_amplify_remove_employee',
        employee_id: employee_id,
        company_id: company_id
      },
      beforeSend:function(){
        $('body').addClass('is-loading');
      },
      success: function (data) {
        if (data.success) {
          location.reload()
        }
      }
    })
  })
  $(document).on('click', '.confirm_employee_remove_no', function () {
    $(this)
    .parents('.nab-modal')
    .hide()
  })

  $(document).on('click', '.action-edit ', function () {
    const prod_id = undefined !== $(this).data('id') ? $(this).data('id') : ''
    const company_id = amplifyJS.postID
    const _this = $(this)
    _this.addClass('loading')
    jQuery.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: {
        action: 'nab_amplify_edit_product',
        product_id: prod_id
      },
      success: function (data) {
        _this.removeClass('loading')
        if (jQuery('#addProductModal').length === 0) {
          jQuery('body').append(data)
          jQuery('#addProductModal')
            .show()
            .addClass('nab-modal-active')
          if (jQuery('#nab_company_id').length > 0) {
            jQuery('#nab_company_id').val(company_id)
          }
          jQuery('#product_categories').select2()
          jQuery('#company_point_of_contact').select2({
            ajax: {
              url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
              dataType: 'json',
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {
                return {
                  q: params.term, // search query
                  action: 'nab_product_point_of_contact' // AJAX action for admin-ajax.php
                }
              },
              processResults: function (data) {
                var options = []
                if (data) {
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                  $.each(data, function (index, text) {
                    // do not forget that "index" is just auto incremented value
                    options.push({ id: text[0], text: text[1] })
                  })
                }
                return {
                  results: options
                }
              },
              cache: true
            },
            minimumInputLength: 3,
            placeholder: 'Select Point of contact',
            allowClear: true
          })
          load_tinyMCE_withPlugins('#nab_product_copy')
          load_tinyMCE_withPlugins(
            '#nab_product_specs',
            '#character-count-specs'
          )

          setTimeout(function () {
            /*if (jQuery('#nab_product_copy').length > 0) {
              var prod_copy_content_length = tinyMCE
                .get('nab_product_copy')
                .getContent()
                .replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/gi, '').length
              var diff = 2000 - prod_copy_content_length
              if (diff < 0) {
                jQuery('#character-count-copy').html(
                  'Maximum Characters Limit exeeds!'
                )
              } else {
                jQuery('#character-count-copy').html(
                  '' + diff + ' characters remianing'
                )
              }
            }*/
            if (jQuery('#nab_product_specs').length > 0) {
              var prod_specs_content_length = tinyMCE
                .get('nab_product_specs')
                .getContent()
                .replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/gi, '').length
              var diff = 2000 - prod_specs_content_length
              if (diff < 0) {
                jQuery('#character-count-specs').html(
                  'Maximum Characters Limit exeeds!'
                )
              } else {
                jQuery('#character-count-specs').html(
                  '' + diff + ' characters remianing'
                )
              }
            }
            charcount(
              'keyup',
              '#nab_product_specs',
              '#character-count-specs',
              2000
            )
          }, 1000)
        } else {
          jQuery('#addProductModal').remove()
          jQuery('body').append(data)
          jQuery('#addProductModal')
            .show()
            .addClass('nab-modal-active')
          if (jQuery('#nab_company_id').length > 0) {
            jQuery('#nab_company_id').val(company_id)
          }
          jQuery('#product_categories').select2()
          jQuery('#company_point_of_contact').select2({
            ajax: {
              url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
              dataType: 'json',
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {
                return {
                  q: params.term, // search query
                  action: 'nab_product_point_of_contact' // AJAX action for admin-ajax.php
                }
              },
              processResults: function (data) {
                var options = []
                if (data) {
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                  $.each(data, function (index, text) {
                    // do not forget that "index" is just auto incremented value
                    options.push({ id: text[0], text: text[1] })
                  })
                }
                return {
                  results: options
                }
              },
              cache: true
            },
            minimumInputLength: 3,
            placeholder: 'Select Point of contact',
            allowClear: true
          })
          load_tinyMCE_withPlugins('#nab_product_copy')
          load_tinyMCE_withPlugins(
            '#nab_product_specs',
            '#character-count-specs'
          )
          setTimeout(function () {
            if (jQuery('#nab_product_specs').length > 0) {
              var prod_specs_content_length = tinyMCE
                .get('nab_product_specs')
                .getContent()
                .replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/gi, '').length
              var diff = 2000 - prod_specs_content_length
              if (diff < 0) {
                jQuery('#character-count-specs').html(
                  'Maximum Characters Limit exeeds!'
                )
              } else {
                jQuery('#character-count-specs').html(
                  '' + diff + ' characters remianing'
                )
              }
            }
            charcount(
              'keyup',
              '#nab_product_specs',
              '#character-count-specs',
              2000
            )
          }, 1000)
        }
        $('.poduct-point-of-contact').select2({
          placeholder: 'Select point of contact',
          allowClear: true
        })
        $('.poduct-point-of-contact').select2({
          ajax: {
            url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
            dataType: 'json',
            delay: 250, // delay in ms while typing when to perform a AJAX search
            data: function (params) {
              return {
                q: params.term, // search query
                action: 'nab_product_point_of_contact' // AJAX action for admin-ajax.php
              }
            },
            processResults: function (data) {
              var options = []
              if (data) {
                // data is the array of arrays, and each of them contains ID and the Label of the option
                $.each(data, function (index, text) {
                  // do not forget that "index" is just auto incremented value
                  options.push({ id: text[0], text: text[1] })
                })
              }
              return {
                results: options
              }
            },
            cache: true
          },
          minimumInputLength: 3,
          placeholder: 'Select point of contact',
          allowClear: true
        })
      }
    })
  })



  /* Add nab product ajax call */
  var remove_attachment_arr = []
  $(document).on('click', '.nab-remove-attachment', function (e) {
    if (confirm('Are you sure want to remove?')) {
      remove_attachment_arr.push($(this).data('attach-id'))
      $(this)
        .parent()
        .remove()
    }
  })
  var remove_featured_attachment_arr = []
  $(document).on('click', '.nab-remove-featured-attachment', function (e) {
    if (confirm('Are you sure want to remove?')) {
      remove_featured_attachment_arr.push($(this).data('action'))
      $(this)
        .parent()
        .remove()
    }
  })

  $(document).on('change', '#product_featured_image', function () {
    if (
      $('#product_featured_image_wrapper .nab-product-media-item').length >= 1
    ) {
      $('#product_featured_image_wrapper .nab-product-media-item').remove()
      $('#product_featured_image_wrapper').append(
        '<div class="nab-product-media-item" ><button type="button" class="nab-remove-attachment" data-attach-id="0"><i class="fa fa-times" aria-hidden="true"></i></button><img id="product_featured_preview" src="#" alt="your image" style="display:none;"/></div>'
      )
    } else {
      $('#product_featured_image_wrapper').append(
        '<div class="nab-product-media-item" ><button type="button" class="nab-remove-attachment" data-attach-id="0"><i class="fa fa-times" aria-hidden="true"></i></button><img id="product_featured_preview" src="#" alt="your image" style="display:none;"/></div>'
      )
    }
    if ($(this)[0].files && $(this)[0].files[0]) {
      var reader = new FileReader()
      reader.onload = function (e) {
        $('#product_featured_preview').attr('src', e.target.result)
      }
      reader.readAsDataURL($(this)[0].files[0])
      $('.preview_product_featured_image').show()
      $('#product_featured_preview').show()
    }
  })
  $(document).on('change', '#nab_product_play_image', function () {
    if ($('.preview_product_play_image .nab-product-media-item').length >= 1) {
      $('.preview_product_play_image .nab-product-media-item').remove()
      $('.preview_product_play_image').append(
        '<div class="nab-product-media-item" ><button type="button" class="nab-remove-featured-attachment" data-action="play_image"><i class="fa fa-times" aria-hidden="true"></i></button><img id="preview_product_play_image" src="#" alt="your image" style="display:none;"/></div>'
      )
    } else {
      $('.preview_product_play_image').append(
        '<div class="nab-product-media-item" ><button type="button" class="nab-remove-featured-attachment" data-action="play_image"><i class="fa fa-times" aria-hidden="true"></i></button><img id="preview_product_play_image" src="#" alt="your image" style="display:none;"/></div>'
      )
    }
    if ($(this)[0].files && $(this)[0].files[0]) {
      var reader = new FileReader()
      reader.onload = function (e) {
        $('#preview_product_play_image').attr('src', e.target.result)
      }
      reader.readAsDataURL($(this)[0].files[0])
      $('.preview_product_play_image').show()
      $('#preview_product_play_image').show()
    }
  })

  function removeFileFromFileList (index) {
    const dt = new DataTransfer()
    const input = document.getElementById('product_medias')
    const { files } = input
    for (let i = 0; i < files.length; i++) {
      const file = files[i]
      if (index !== i) dt.items.add(file) // here you exclude the file. thus removing it.
      input.files = dt.files
    }
  }

  $(document).on('change', '#product_medias', function (e) {

    var fileExtension = ['png','jpg','jpeg','gif'];


    var global_media_count = jQuery('.nab-product-media-item').length
    if (global_media_count < 5) {
      $.each($('#product_medias')[0].files, function (key, file) {
        if ($.inArray( file.name.split('.').pop().toLowerCase(), fileExtension) == -1) {
          get_error_popup('This file type is not supported here. Acceptable File Types: .jpeg, .jpg, .png.')
          return false
      }
        var timestamp = Date.now()
        var unique_key = file.lastModified + '_' + timestamp

        nabAddProdBlankImage(unique_key);

        var reader = new FileReader()
        reader.onload = function (e) {

          $('#product_media_preview_' + unique_key + '').attr(
            'src',
            e.target.result
          )
        }
        var media_count = jQuery('.nab-product-media-item').length
        if (media_count < 5) {
          reader.readAsDataURL(file)
          $('.preview_product_featured_image').show()
          $('#product_media_preview_' + unique_key + '').show()
        } else {
          $('#product_media_preview_' + unique_key + '')
            .parent()
            .remove()
        }
      })
    }
  })

  $(document).on('click', '#nab-edit-product-draft', function () {
    nabProductAddUpdateAjax('draft')
  })

  $(document).on('click', '#nab-edit-product-delete', function () {
    nabProductAddUpdateAjax('trash')
  })

  $(document).on('click', '#nab-edit-product-submit', function () {
    nabProductAddUpdateAjax($(this).attr('data-status'))
  })

  function nabProductAddUpdateAjax (postStatus) {
    tinyMCE.triggerSave()

    var product_title = jQuery('#nab-edit-product-form #product_title').val()
    var product_categories = jQuery(
      '#nab-edit-product-form #product_categories'
    ).val()
    var nab_product_copy = jQuery(
      '#nab-edit-product-form #nab_product_copy'
    ).val()
    var nab_product_specs = jQuery(
      '#nab-edit-product-form #nab_product_specs'
    ).val()
    var nab_product_contact = jQuery(
      '#nab-edit-product-form #nab_product_contact'
    ).val()
    var nab_feature_product = jQuery(
      '#nab-edit-product-form #nab_feature_product'
    ).prop('checked')
      ? 1
      : 0
    var nab_product_b_stock = jQuery(
      '#nab-edit-product-form #nab_product_b_stock'
    ).prop('checked')
      ? 1
      : 0
    var nab_product_sales_item = jQuery(
      '#nab-edit-product-form #nab_product_sales_item'
    ).prop('checked')
      ? 1
      : 0
    var nab_product_tags = jQuery(
      '#nab-edit-product-form #nab_product_tags'
    ).val()
    var nab_product_discussion = jQuery(
      '#nab-edit-product-form #nab_product_discussion'
    ).prop('checked')
      ? 1
      : 0
    var nab_product_learn_more_url = jQuery(
      '#nab-edit-product-form #nab_product_learn_more_url'
    ).val()

    var nab_product_id = jQuery('#nab-edit-product-form #nab_product_id').val()
    var nab_company_id = jQuery('#nab-edit-product-form #nab_company_id').val()

    var nab_product_specsLength = tinyMCE
      .get('nab_product_specs')
      .getContent()
      .replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/gi, '').length
    if (nab_product_specsLength > 2000) {
      alert(
        'The length of product specs content is ' +
          nab_product_specsLength +
          ' the max num of characters allowed for this content is 2000'
      )
      return false
    }

    var form_data = new FormData()

    // If bynder images selected.
    if( 'function' === typeof addBMpopup ) {
        let product_media_bm_src = [];
        $('.nab-product-media-item img').each(function () {
            product_media_bm_src.push($(this).attr('src'));
        });
        product_media_bm_src = product_media_bm_src.join(',');
        form_data.append('product_media_bm', product_media_bm_src)
    } else {
      $.each($('#product_medias')[0].files, function (key, file) {
        form_data.append(key, file)
      }).length
    }

    if (product_title == '') {
      alert('Product title can not be empty!')
      return false
    }
    form_data.append('action', 'nab_add_product')
    form_data.append('product_title', product_title)
    if (product_categories == null) {
      form_data.append('product_categories', [])
    } else {
      form_data.append('product_categories', product_categories)
    }

    form_data.append('nabNonce', amplifyJS.nabNonce)
    form_data.append('nab_product_copy', nab_product_copy)
    form_data.append('nab_product_specs', nab_product_specs)
    form_data.append('nab_product_contact', nab_product_contact)
    form_data.append('nab_feature_product', nab_feature_product)
    form_data.append('nab_product_b_stock', nab_product_b_stock)
    form_data.append('nab_product_sales_item', nab_product_sales_item)
    form_data.append('nab_product_tags', nab_product_tags)
    form_data.append('nab_product_discussion', nab_product_discussion)
    form_data.append('nab_product_id', nab_product_id)

    if (!validateURL(nab_product_learn_more_url)) {
      addSuccessMsg(
        '.add-product-content-popup',
        'Please Enter Correct URL For Product Learn More!'
      )
      return false
    } else {
      form_data.append('nab_product_learn_more_url', nab_product_learn_more_url)
    }

    form_data.append('product_status', postStatus)

    form_data.append('remove_attachments', remove_attachment_arr)
    form_data.append('nab_company_id', nab_company_id)

    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      processData: false,
      contentType: false,
      type: 'POST',
      data: form_data,
      beforeSend: function () {
        $('body').addClass('is-loading')
      },
      success: function (response) {
        var json = $.parseJSON(response)
        if (json.success === true) {
          $('body').removeClass('is-loading')
          if ('trash' === postStatus) {
            $('#nab-edit-product-form .btn-submit').attr('disabled', 'disabled')
          }
          if (json.publish_text) {
            $('#nab-edit-product-form #nab-edit-product-submit').val(
              json.publish_text
            )
            $('#nab-edit-product-form #nab-edit-product-submit').attr(
              'data-status',
              json.publish_text.toLowerCase()
            )
          }
          if (json.draft_text) {
            $('#nab-edit-product-form #nab-edit-product-draft').val(
              json.draft_text
            )
          }
          if (nab_product_id !== '0') {
            addSuccessMsg('.add-product-content-popup', json.content)
          } else {
            addSuccessMsg('.add-product-content-popup', json.content)
          }
          if (json.post_id) {
            $('#nab-edit-product-form #nab_product_id').val(json.post_id)
          }
        }
      }
    })
  }

  // Upload user images using ajax.
  $('#edit-social-profiles').on('click', function (e) {
    e.preventDefault()
    $(this)
      .parent()
      .addClass('loading')

    var fd = new FormData()
    var company_id = amplifyJS.postID
    fd.append('action', 'nab_edit_company_social_profiles')
    fd.append('company_id', amplifyJS.postID)

    jQuery.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: fd,
      contentType: false,
      processData: false,
      success: function (data) {
        if (jQuery('#addProductModal').length === 0) {
          jQuery('body').append(data)
          jQuery('#addProductModal')
            .show()
            .addClass('nab-modal-active')
          if (jQuery('#nab_company_id').length > 0) {
            jQuery('#nab_company_id').val(company_id)
          }
          jQuery('#product_categories').select2()
          jQuery('#company_point_of_contact').select2({
            ajax: {
              url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
              dataType: 'json',
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {
                return {
                  q: params.term, // search query
                  action: 'nab_product_point_of_contact' // AJAX action for admin-ajax.php
                }
              },
              processResults: function (data) {
                var options = []
                if (data) {
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                  $.each(data, function (index, text) {
                    // do not forget that "index" is just auto incremented value
                    options.push({ id: text[0], text: text[1] })
                  })
                }
                return {
                  results: options
                }
              },
              cache: true
            },
            minimumInputLength: 3,
            placeholder: 'Select Point of contact',
            allowClear: true
          })
          $('.company-admins').select2({
            ajax: {
              url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
              dataType: 'json',
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {
                return {
                  q: params.term, // search query
                  action: 'nab_product_point_of_contact' // AJAX action for admin-ajax.php
                }
              },
              processResults: function (data) {
                var options = []
                if (data) {
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                  $.each(data, function (index, text) {
                    // do not forget that "index" is just auto incremented value
                    options.push({ id: text[0], text: text[1] })
                  })
                }
                return {
                  results: options
                }
              },
              cache: true
            },
            minimumInputLength: 3
          })
        } else {
          jQuery('#addProductModal').remove()
          jQuery('body').append(data)
          jQuery('#addProductModal')
            .show()
            .addClass('nab-modal-active')
          if (jQuery('#nab_company_id').length > 0) {
            jQuery('#nab_company_id').val(company_id)
          }
          jQuery('#product_categories').select2()
          jQuery('#company_point_of_contact').select2({
            ajax: {
              url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
              dataType: 'json',
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {
                return {
                  q: params.term, // search query
                  action: 'nab_product_point_of_contact' // AJAX action for admin-ajax.php
                }
              },
              processResults: function (data) {
                var options = []
                if (data) {
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                  $.each(data, function (index, text) {
                    // do not forget that "index" is just auto incremented value
                    options.push({ id: text[0], text: text[1] })
                  })
                }
                return {
                  results: options
                }
              },
              cache: true
            },
            minimumInputLength: 3,
            placeholder: 'Select Point of contact',
            allowClear: true
          })
          $('.company-admins').select2({
            ajax: {
              url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
              dataType: 'json',
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {
                return {
                  q: params.term, // search query
                  action: 'nab_product_point_of_contact' // AJAX action for admin-ajax.php
                }
              },
              processResults: function (data) {
                var options = []
                if (data) {
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                  $.each(data, function (index, text) {
                    // do not forget that "index" is just auto incremented value
                    options.push({ id: text[0], text: text[1] })
                  })
                }
                return {
                  results: options
                }
              },
              cache: true
            },
            minimumInputLength: 3
          })
        }
      }
    })
  })

  function nabMembershipCategoryNotice (selector, message) {
    if (
      0 ===
      selector.parents('.form-row').find('.company-member-level-notice').length
    ) {
      selector
        .parents('.form-row')
        .append('<p class="company-member-level-notice">' + message + '</p>')
    } else {
      selector
        .parents('.form-row')
        .find('.company-member-level-notice')
        .text(message)
      selector
        .parents('.form-row')
        .find('.company-member-level-notice')
        .show()
    }
  }

  $(document).on('click', '#nab-edit-company-profile-submit', function () {
    var featuredSelector = $(this)
      .parents('form#nab-edit-company-profile-form')
      .find('#product_categories')
    var searchSelector = $(this)
      .parents('form#nab-edit-company-profile-form')
      .find('#search_product_categories')
    var featuredMax = parseInt(featuredSelector.attr('data-limit'))
    var searchMax = parseInt(searchSelector.attr('data-limit'))

    $(this)
      .parents('form#nab-edit-company-profile-form')
      .find('.company-member-level-notice')
      .hide()

    if (0 < featuredSelector.length && null !== featuredSelector.val()) {
      if (0 === featuredMax && 0 < featuredSelector.val().length) {
        nabMembershipCategoryNotice(
          featuredSelector,
          "You can't add featured product categories without membership."
        )
        return false
      } else if (
        2 === featuredMax &&
        featuredSelector.val().length > featuredMax
      ) {
        nabMembershipCategoryNotice(
          featuredSelector,
          'You can add maximum ' +
            featuredMax +
            ' featured product categories with your current membership.'
        )
        return false
      } else if (featuredSelector.val().length > featuredMax) {
        nabMembershipCategoryNotice(
          featuredSelector,
          'You can add maximum ' + featuredMax + ' featured product categories.'
        )
        return false
      }
    }

    if (0 < searchSelector.length && null !== searchSelector.val()) {
      if (0 === searchMax && 0 < searchSelector.val().length) {
        nabMembershipCategoryNotice(
          searchSelector,
          "You can't add search categories with your current membership."
        )
        return false
      } else if (searchSelector.val().length > searchMax) {
        nabMembershipCategoryNotice(
          searchSelector,
          'You can add maximum ' +
            searchMax +
            ' search categories with your current membership.'
        )
        return false
      }
    }

    var fd = new FormData()
    fd.append('action', 'nab_update_company_profile')
    fd.append('company_id', amplifyJS.postID)
    if (jQuery('#instagram_profile').length) {
      if (!validateURL(jQuery('#instagram_profile').val())) {
        addSuccessMsg(
          '.add-product-content-popup',
          'Please Enter Correct URL for Instagram Profile!'
        )
        return false
      } else {
        fd.append('instagram_profile', jQuery('#instagram_profile').val())
      }
    }
    if (jQuery('#linkedin_profile').length) {
      if (!validateURL(jQuery('#linkedin_profile').val())) {
        addSuccessMsg(
          '.add-product-content-popup',
          'Please Enter Correct URL for Linkedin Profile!'
        )
        return false
      } else {
        fd.append('linkedin_profile', jQuery('#linkedin_profile').val())
      }
    }
    if (jQuery('#facebook_profile').length) {
      if (!validateURL(jQuery('#facebook_profile').val())) {
        addSuccessMsg(
          '.add-product-content-popup',
          'Please Enter Correct URL for Facebook Profile!'
        )
        return false
      } else {
        fd.append('facebook_profile', jQuery('#facebook_profile').val())
      }
    }
    if (jQuery('#twitter_profile').length) {
      if (!validateURL(jQuery('#twitter_profile').val())) {
        addSuccessMsg(
          '.add-product-content-popup',
          'Please Enter Correct URL for Twitter Profile!'
        )
        return false
      } else {
        fd.append('twitter_profile', jQuery('#twitter_profile').val())
      }
    }
    if (jQuery('#company_about').length) {
      if (jQuery('#company_about').val().length > 2000) {
        alert(
          'The length of Company about content is ' +
            jQuery('#company_about').val().length +
            ' the max num of characters allowed for this content is 2000'
        )
        return false
      }
      fd.append('company_about', jQuery('#company_about').val())
    }
    if (jQuery('#company_industry').length) {
      fd.append('company_industry', jQuery('#company_industry').val())
    }
    if (jQuery('#company_location').length) {
      fd.append('company_location', jQuery('#company_location').val())
    }
    if (jQuery('#company_website').length) {
      if (!validateURL(jQuery('#company_website').val())) {
        addSuccessMsg(
          '.add-product-content-popup',
          'Please Enter Correct URL for Company Website!'
        )
        return false
      } else {
        fd.append('company_website', jQuery('#company_website').val())
      }
    }
    if (jQuery('#company_point_of_contact').length) {
      fd.append(
        'company_point_of_contact',
        jQuery('#company_point_of_contact').val()
      )
    }
    if (jQuery('#company_location_street_one').length) {
      fd.append(
        'company_location_street_one',
        jQuery('#company_location_street_one').val()
      )
    }
    if (jQuery('#company_location_street_two').length) {
      fd.append(
        'company_location_street_two',
        jQuery('#company_location_street_two').val()
      )
    }
    if (jQuery('#company_location_street_three').length) {
      fd.append(
        'company_location_street_three',
        jQuery('#company_location_street_three').val()
      )
    }
    if (jQuery('#company_location_city').length) {
      fd.append('company_location_city', jQuery('#company_location_city').val())
    }
    if (jQuery('#company_location_state').length) {
      fd.append(
        'company_location_state',
        jQuery('#company_location_state').val()
      )
    }
    if (jQuery('#company_location_zip').length) {
      fd.append('company_location_zip', jQuery('#company_location_zip').val())
    }
    if (jQuery('#company_location_country').length) {
      fd.append(
        'company_location_country',
        jQuery('#company_location_country').val()
      )
    }

    if (jQuery('#product_categories').length) {
      fd.append(
        'company_product_categories',
        jQuery('#product_categories').val()
      )
    }

    if (0 < searchSelector.length) {
      fd.append('company_search_categories', searchSelector.val())
    }

    if (jQuery('#company_youtube').length) {
      if (!validateURL(jQuery('#company_youtube').val())) {
        addSuccessMsg(
          '.add-product-content-popup',
          'Please Enter Correct URL for Youtube Profile!'
        )
        return false
      } else {
        fd.append('company_youtube', jQuery('#company_youtube').val())
      }
    }

    if (jQuery('#company_admins').length) {
      fd.append('company_admins', jQuery('#company_admins').val())
    }

    jQuery.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: fd,
      contentType: false,
      processData: false,
      beforeSend: function () {
        $('body').addClass('is-loading')
      },
      success: function (data) {
        $('body').removeClass('is-loading')
        if (undefined !== data.success && !data.success) {
          addSuccessMsg('.add-product-content-popup', data.data)
        } else {
          addSuccessMsg(
            '.add-product-content-popup',
            'Profile Updated Successfully!'
          )
        }
      }
    })
  })

  $('.edit-company-about').on('click', function (e) {
    e.preventDefault()
    $(this)
      .parent()
      .addClass('loading')

    var fd = new FormData()
    var company_id = amplifyJS.postID
    fd.append('action', 'nab_edit_company_about')
    fd.append('company_id', amplifyJS.postID)

    jQuery.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: fd,
      contentType: false,
      processData: false,
      beforeSend: function () {
        $('body').addClass('is-loading')
      },
      success: function (data) {
        $('body').removeClass('is-loading')
        if (jQuery('#addProductModal').length === 0) {
          jQuery('body').append(data)
          jQuery('#addProductModal')
            .show()
            .addClass('nab-modal-active')
          if (jQuery('#nab_company_id').length > 0) {
            jQuery('#nab_company_id').val(company_id)
          }
          jQuery('#product_categories').select2()
          jQuery('#search_product_categories').select2()
          jQuery('#company_point_of_contact').select2({
            ajax: {
              url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
              dataType: 'json',
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {
                return {
                  q: params.term, // search query
                  action: 'nab_product_point_of_contact' // AJAX action for admin-ajax.php
                }
              },
              processResults: function (data) {
                var options = []
                if (data) {
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                  $.each(data, function (index, text) {
                    // do not forget that "index" is just auto incremented value
                    options.push({ id: text[0], text: text[1] })
                  })
                }
                return {
                  results: options
                }
              },
              cache: true
            },
            minimumInputLength: 3,
            placeholder: 'Select Point of contact',
            allowClear: true
          })
          $('.company-admins').select2({
            ajax: {
              url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
              dataType: 'json',
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {
                return {
                  q: params.term, // search query
                  action: 'nab_product_point_of_contact' // AJAX action for admin-ajax.php
                }
              },
              processResults: function (data) {
                var options = []
                if (data) {
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                  $.each(data, function (index, text) {
                    // do not forget that "index" is just auto incremented value
                    options.push({ id: text[0], text: text[1] })
                  })
                }
                return {
                  results: options
                }
              },
              cache: true
            },
            minimumInputLength: 3
          })
          load_tinyMCE_withPlugins(
            '#company_about',
            '#character-count-comp-about'
          )
        } else {
          jQuery('#addProductModal').remove()
          jQuery('body').append(data)
          jQuery('#addProductModal')
            .show()
            .addClass('nab-modal-active')
          if (jQuery('#nab_company_id').length > 0) {
            jQuery('#nab_company_id').val(company_id)
          }
          jQuery('#product_categories').select2()
          jQuery('#search_product_categories').select2()
          jQuery('#company_point_of_contact').select2({
            ajax: {
              url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
              dataType: 'json',
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {
                return {
                  q: params.term, // search query
                  action: 'nab_product_point_of_contact' // AJAX action for admin-ajax.php
                }
              },
              processResults: function (data) {
                var options = []
                if (data) {
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                  $.each(data, function (index, text) {
                    // do not forget that "index" is just auto incremented value
                    options.push({ id: text[0], text: text[1] })
                  })
                }
                return {
                  results: options
                }
              },
              cache: true
            },
            minimumInputLength: 3,
            placeholder: 'Select Point of contact',
            allowClear: true
          })
          $('.company-admins').select2({
            ajax: {
              url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
              dataType: 'json',
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {
                return {
                  q: params.term, // search query
                  action: 'nab_product_point_of_contact' // AJAX action for admin-ajax.php
                }
              },
              processResults: function (data) {
                var options = []
                if (data) {
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                  $.each(data, function (index, text) {
                    // do not forget that "index" is just auto incremented value
                    options.push({ id: text[0], text: text[1] })
                  })
                }
                return {
                  results: options
                }
              },
              cache: true
            },
            minimumInputLength: 3
          })
          load_tinyMCE_withPlugins(
            '#company_about',
            '#character-count-comp-about'
          )
        }

        setTimeout(() => {
          if (jQuery(this).data('action') == 'company-about') {
            jQuery('.company-about-row').css('display', 'block')
            jQuery('.company-info-row').css('display', 'none')
          }
          if (jQuery(this).data('action') == 'company-info') {
            jQuery('.company-about-row').css('display', 'none')
            jQuery('.company-info-row').css('display', 'block')
          }
          if (jQuery('#company_about').length) {
            var len = jQuery('#company_about').val().length
            var diff = 2000 - len
            if (len > 2000) {
              jQuery('#character-count-comp-about').html(
                'Maximum Characters limit exceeds'
              )
            } else {
              jQuery('#character-count-comp-about').html(
                diff + ' characters remaining'
              )
            }
          }
        }, 500)
      }
    })
  })
  $(document).on('click', '.edit-company-mode', function () {
    jQuery('.edit-profile-pic').show()
    jQuery(this).addClass('cancel-edit-company-mode')
    jQuery(this).removeClass('edit-company-mode')
    jQuery(this).text('Cancel Edit')
    jQuery('.banner-header').addClass('edit_mode_on')
    jQuery('.edit-bg-pic').show()
    jQuery('.remove-bg-pic').show()
    jQuery('.edit-company-industry').show()
  })
  $(document).on('click', '.cancel-edit-company-mode', function () {
    jQuery('.edit-profile-pic').hide()
    jQuery('.edit-bg-pic').hide()
    jQuery('.remove-bg-pic').hide()
    jQuery('.edit-company-industry').hide()
    jQuery(this).removeClass('cancel-edit-company-mode')
    jQuery(this).addClass('edit-company-mode ')
    jQuery('.banner-header').removeClass('edit_mode_on')
    jQuery(this).text('Edit Profile')
  })
  // Add smooth scrolling to all links
  jQuery('.navigate-reply').on('click', function (event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== '' && typeof jQuery(this.hash).offset() == 'object') {
      // Prevent default anchor click behavior
      event.preventDefault()

      // Store hash
      var hash = this.hash

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      jQuery('html, body').animate(
        {
          scrollTop: jQuery(hash).offset().top
        },
        1200,
        function () {}
      )
    } // End if
  })

  jQuery(window).load(function () {
    if (window.location.hash) {
      jQuery('html, body').animate(
        {
          scrollTop: jQuery(window.location.hash).offset().top
        },
        1200,
        function () {
          // Add hash (#) to URL when done scrolling (default click behavior)
          window.location.hash = window.location.hash
        }
      )
    }
  })

  // My Purchase Content Pagination
  $(document).on('click', '.navigate-purchased', function () {
    var new_current_page = ''
    const current_page = parseInt(
      $('#purchased-pagination #current-page').text()
    )
    const page_total = parseInt($('#purchased-pagination #page-total').text())
    if ($(this).hasClass('next-purchased')) {
      if (current_page < page_total) {
        new_current_page = current_page + 1
      }
    } else {
      if (current_page > 1) {
        new_current_page = current_page - 1
      }
    }
    if ('' !== new_current_page) {
      $('#purchased-pagination #current-page').text(new_current_page)
      $('.content_card').hide()
      $('.content_card[data-item="' + new_current_page + '"]').show()
    }
  })

  // on load
  $(window).load(function () {
    $('.video_added').removeClass('woocommerce-product-gallery__image')

    $('.custom_thumb.video_added a').fancybox({
      width: 800,
      height: 450,
      transitionIn: 'elastic',
      transitionOut: 'elastic',
      type: 'iframe',
      closeBtn: true,
      smallBtn: true
    })
  })

  $(document).on('click', '.product-head .product-layout span', function () {
    $('.product-head .product-layout span').removeClass('active')
    $(this).addClass('active')

    if ($(this).hasClass('grid')) {
      $('.product-list').removeClass('layout-list')
      $('.product-list').addClass('layout-grid')
    } else {
      $('.product-list').addClass('layout-list')
      $('.product-list').removeClass('layout-grid')
    }
  })

  // Remove user images using ajax.
  $('#profile_picture_remove').on('click', function (e) {
    e.preventDefault()

    $('body').addClass('is-loading')

    jQuery.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: {
        action: 'nab_amplify_remove_images',
        name: $(this).attr('name')
      },
      success: function (data) {
        location.reload()
      }
    })
  })

  // Remove user company bg image.
  $('#banner_image_remove').on('click', function (e) {
    e.preventDefault()

    $('body').addClass('is-loading')

    jQuery.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: {
        action: 'nab_amplify_banner_image_remove',
        company_id:amplifyJS.postID
      },
      success: function (data) {
        location.reload()
      }
    })
  })


  $(window).on('resize', function () {})

  // Related products
  if (4 < $('.related.products .product-list .product-item').length) {
    buildSliderConfiguration()

    $(window).on('resize', function () {
      buildSliderConfiguration()
    })
  }

  function buildSliderConfiguration () {
    $('.related.products .product-list').each(function () {
      var windowWidth = $(window).width()
      var numberOfVisibleSlides
      if (windowWidth < 567) {
        numberOfVisibleSlides = 1
      } else if (windowWidth < 768) {
        numberOfVisibleSlides = 2
      } else if (windowWidth < 1200) {
        numberOfVisibleSlides = 3
      } else {
        numberOfVisibleSlides = 4
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
      })
    })
  }

  function HeaderResponsive () {
    if (1024 >= $(window).width()) {
      $(document).on('click', '.nab-profile > a', function (e) {
        e.preventDefault()
        $(this)
          .next('.nab-profile-dropdown')
          .toggle()
      })
    }
  }

  if ($('#attendee_country').length > 0) {
    var states_json = wc_country_select_params.countries.replace(
        /&quot;/g,
        '"'
      ),
      states = $.parseJSON(states_json),
      wrapper_selectors = '.nab-event-reg-wrap'

    $(document.body).on('change refresh', '#attendee_country', function () {
      // Grab wrapping element to target only stateboxes in same 'group'
      var $wrapper = $(this).closest(wrapper_selectors)

      if (!$wrapper.length) {
        $wrapper = $(this)
          .closest('.form-row')
          .parent()
      }

      var country = $(this).val(),
        $statebox = $wrapper.find('#attendee_state'),
        $parent = $statebox.closest('.form-row'),
        input_name = $statebox.attr('name'),
        input_id = $statebox.attr('id'),
        input_classes = $statebox.attr('data-input-classes'),
        value = $statebox.val(),
        placeholder =
          $statebox.attr('placeholder') ||
          $statebox.attr('data-placeholder') ||
          '',
        $newstate

      if (states[country]) {
        if ($.isEmptyObject(states[country])) {
          $newstate = $('<input type="hidden" />')
            .prop('id', input_id)
            .prop('name', input_name)
            .prop('placeholder', placeholder)
            .attr('data-input-classes', input_classes)
            .addClass('hidden ' + input_classes)
          $parent
            .hide()
            .find('.select2-container')
            .remove()
          $statebox.replaceWith($newstate)
          $(document.body).trigger('country_to_state_changed', [
            country,
            $wrapper
          ])
        } else {
          var state = states[country],
            $defaultOption = $('<option value=""></option>').text(
              wc_country_select_params.i18n_select_state_text
            )

          if (!placeholder) {
            placeholder = wc_country_select_params.i18n_select_state_text
          }

          $parent.show()

          if ($statebox.is('input')) {
            $newstate = $('<select></select>')
              .prop('id', input_id)
              .prop('name', input_name)
              .data('placeholder', placeholder)
              .attr('data-input-classes', input_classes)
              .addClass('state_select ' + input_classes)
            $statebox.replaceWith($newstate)
            $statebox = $wrapper.find('#attendee_state')
          }

          $statebox.empty().append($defaultOption)

          $.each(state, function (index) {
            var $option = $('<option></option>')
              .prop('value', index)
              .text(state[index])
            $statebox.append($option)
          })

          $statebox.val(value).change()

          $(document.body).trigger('country_to_state_changed', [
            country,
            $wrapper
          ])
        }
      } else {
        if ($statebox.is('select, input[type="hidden"]')) {
          $newstate = $('<input type="text" />')
            .prop('id', input_id)
            .prop('name', input_name)
            .prop('placeholder', placeholder)
            .attr('data-input-classes', input_classes)
            .addClass('input-text  ' + input_classes)
          $parent
            .show()
            .find('.select2-container')
            .remove()
          $statebox.replaceWith($newstate)
          $(document.body).trigger('country_to_state_changed', [
            country,
            $wrapper
          ])
        }
      }

      $(document.body).trigger('country_to_state_changing', [country, $wrapper])
    })
  }

  if ($('#nab_billing_same_as_attendee').length > 0) {
    $(document).on('change', '#nab_billing_same_as_attendee', function () {
      if (this.checked) {
        let updateFields = {
          attendee_first_name: 'billing_first_name',
          attendee_last_name: 'billing_last_name',
          attendee_company: 'billing_company',
          attendee_email: 'billing_email',
          attendee_city: 'billing_city',
          attendee_zip: 'billing_postcode'
        }
        $.each(updateFields, function (k, v) {
          $('#' + v).val($('#' + k).val())
        })

        $('#billing_country')
          .val($('#attendee_country').val())
          .trigger('change')
        $('#billing_state')
          .val($('#attendee_state').val())
          .trigger('change')
      }
    })
  }

  if ($('#nab_bulk_quantity').length > 0) {
    $(document).on('change', '#nab_is_bulk', function () {
      var isBulkOrder = $(this).val()
      if (isBulkOrder && 'yes' === isBulkOrder) {
        $('.nab-quantity-selector').show()
        $('#nab_bulk_order_field').val('yes')
      } else {
        $('#nab_bulk_order_field').val('no')
        $('.nab-qty').val('1')
        $('.nab-quantity-selector').hide()
        $('#nab_bulk_quantity, #nab_bulk_order_qty_field').val('')
        nabRefreshCart()
      }
    })

    $(document).on('change', '#nab_bulk_quantity', function () {
      let selectedQty = $(this).val()
      if (selectedQty) {
        $('.nab-qty, #nab_bulk_order_qty_field').val(selectedQty)
      } else {
        $('.nab-qty').val('1')
        $('#nab_bulk_quantity, #nab_bulk_order_qty_field').val('')
      }
      nabRefreshCart()
    })
  }

  function nabRefreshCart () {
    block($('.woocommerce-cart-form'))
    block($('div.cart_totals'))

    let nabCartData = {
      action: 'nab_custom_update_cart',
      qty: $('#nab_bulk_quantity').val(),
      is_bulk: $('#nab_is_bulk').val()
    }

    $.ajax({
      url: amplifyJS.ajaxurl,
      type: 'POST',
      data: nabCartData,
      success: function (data) {
        if (0 === data.err) {
          $('.woocommerce').replaceWith(data.cart_content)
          $("[name='update_cart']")
            .prop('disabled', true)
            .attr('aria-disabled', 'true')
          unblock($('.woocommerce-cart-form'))
          unblock($('div.cart_totals'))
          $.scroll_to_notices($('[role="alert"]'))
          $(document.body).trigger('updated_wc_div')
        } else {
          $("[name='update_cart']").prop('disabled', false)
          $("[name='update_cart']").trigger('click')
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        unblock($('.woocommerce-cart-form'))
        unblock($('div.cart_totals'))
        console.log(thrownError)
      }
    })
  }

  var block = function ($node) {
    if (!is_blocked($node)) {
      $node.addClass('processing').block({
        message: null,
        overlayCSS: {
          background: '#fff',
          opacity: 0.6
        }
      })
    }
  }

  var is_blocked = function ($node) {
    return $node.is('.processing') || $node.parents('.processing').length
  }

  var unblock = function ($node) {
    $node.removeClass('processing').unblock()
  }

  var showLoader = function () {
    $('body').addClass('is-loading')
  }

  var hideLoader = function () {
    $('body').removeClass('is-loading')
  }

  if ($('#nabAddAttendeeModal').length > 0) {
    $(document).on('click', '.nab-add-attendee', function () {
      $('#attendeeOrderID').val($(this).data('orderid'))
      $('#attendeeOrderQty').val($(this).data('qty'))
      $('#nabAddAttendeeModal').show()
    })

    $(document).on('click', '.nab-modal-close', function () {
      if ($(this).hasClass('nab-reload-on-close')) {
        location.reload()
      } else {
        $('#bulk_upload_file').val('')
        $('.attendee-bulk-upload-form .input-placeholder').val('Upload File...')
        $(this)
          .parents('.nab-modal')
          .hide()
      }
    })

    $(document).on('change', '#bulk_upload_file', function (e) {
      if (e.target.files[0]) {
        $('.attendee-bulk-upload-form .input-placeholder').text(
          e.target.files[0].name
        )
      }
    })

    $(document).on('click', '#bulk_upload', function () {
      $('.attendee-upload-message')
        .removeClass('error success')
        .hide()
      var file_data = $('#bulk_upload_file').prop('files')[0]

      if (0 === $('#bulk_upload_file')[0].files.length) {
        $('.attendee-upload-message')
          .addClass('error')
          .text('Please select a file!')
          .show()
      } else {
        $('body').addClass('is-loading') // loader
        var attendeeOrderID = $('#attendeeOrderID').val()
        var attendeeOrderQty = $('#attendeeOrderQty').val()
        var form_data = new FormData()
        form_data.append('file', file_data)
        form_data.append('action', 'nab_db_add_attendee')
        form_data.append('attendeeOrderID', attendeeOrderID)
        form_data.append('nabNonce', amplifyJS.nabNonce)

        $.ajax({
          url: amplifyJS.ajaxurl,
          type: 'POST',
          contentType: false,
          processData: false,
          data: form_data,
          success: function (response) {
            console.log(response)
            if (0 === response.err) {
              var totalRecords = response.total_records
              var loopCount = Math.ceil(totalRecords / 10)
              var attendeeData = {
                attendeeOrderID: attendeeOrderID,
                totalRecords: totalRecords,
                loopCount: loopCount,
                attendeeOrderQty: attendeeOrderQty,
                action: 'insert_new_attendee'
              }

              processAttendeeData(attendeeData)
            } else {
              $('.attendee-upload-message')
                .addClass('error')
                .text(response.message)
                .show()
              $('body').removeClass('is-loading') // loader
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $('body').removeClass('is-loading') // loader
            console.log(thrownError)
          }
        })
      }
    })

    async function processAttendeeData (attendeeData) {
      for (i = 0; i < attendeeData.loopCount; i++) {
        attendeeData.currentIndex = i
        if (attendeeData.loopCount === attendeeData.currentIndex + 1) {
          attendeeData.isLast = 'yes'
        }
        var uploadedAttendeeResp = await uploadedAttendee(attendeeData)
      }
    }

    function uploadedAttendee (attendeeData) {
      return new Promise(function (resolve, reject) {
        $.ajax({
          url: amplifyJS.ajaxurl,
          type: 'POST',
          data: attendeeData,
          success: function (data) {
            console.log(data)
            if (1 === data.err) {
              importErrs.push(data.msg)
            }
            if (1 === data.skipped) {
              skippedErrs.push(data.skipped_msg)
            }
            addedAttendee =
              parseInt(addedAttendee) + parseInt(data.added_attendee)
            if (attendeeData.loopCount === attendeeData.currentIndex + 1) {
              $('#bulk_upload_file').val('')
              $('.attendee-bulk-upload-form .input-placeholder').text(
                'Upload file...'
              )
              if (importErrs.length > 0) {
                var importErrMsg =
                  'Attendee import process is completed. ' +
                  addedAttendee +
                  ' Attendees imported successfully. There were some errors while importing data.<br><br>'
                $.each(importErrs, function (k, v) {
                  $.each(v, function (j, val) {
                    importErrMsg += val + '<br>'
                  })
                })

                $('.attendee-upload-message')
                  .addClass('error')
                  .html(importErrMsg)
                  .show()
              } else {
                if (skippedErrs.length > 0) {
                  var skippedErrsMsg =
                    'Attendee import process is completed. ' +
                    addedAttendee +
                    ' Attendees imported successfully. Some records were skipped due to below reasons:<br><br>'
                  //skippedErrsMsg += skippedErrs;
                  $.each(skippedErrs, function (k, v) {
                    $.each(v, function (j, val) {
                      skippedErrsMsg += val + '<br>'
                    })
                  })
                  $('.attendee-upload-message')
                    .addClass('error')
                    .html(skippedErrsMsg)
                    .show()
                } else {
                  $('.attendee-upload-message')
                    .addClass('success')
                    .text(
                      'Attendee import process is completed. ' +
                        addedAttendee +
                        ' Attendees imported successfully.'
                    )
                    .show()
                }
              }
              if (
                undefined !== typeof data.totalAddedAttendees &&
                attendeeData.attendeeOrderQty === data.totalAddedAttendees
              ) {
                $(
                  '.nab-add-attendee[data-orderid=' +
                    attendeeData.attendeeOrderID +
                    ']'
                ).hide()
              }
              addedAttendee = 0
              $('.nab-modal-close').addClass('nab-reload-on-close')
              $('body').removeClass('is-loading') // loader
            }
            resolve(data)
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $('body').removeClass('is-loading') // loader
            console.log(thrownError)
          }
        })
      })
    }
  }

  $(document).on('click', '.nab-view-attendee', function () {
    var orderId = $(this).data('orderid')
    $('body').addClass('is-loading') // loader
    $.ajax({
      url: amplifyJS.ajaxurl,
      type: 'GET',
      data: {
        orderId: orderId,
        action: 'get_order_attendees',
        nabNonce: amplifyJS.nabNonce
      },
      success: function (response) {
        $('.attendee-view-table-wrp').empty()
        let attendeeTableWrap = $('.attendee-view-table-wrp')[0]

        if (1 === response.err) {
          let errMessageElem = document.createElement('p')
          errMessageElem.innerHTML = response.message
          attendeeTableWrap.appendChild(errMessageElem)
        } else if (0 === response.attendees.length) {
          let errMessageElem = document.createElement('p')
          errMessageElem.innerHTML = 'No Attendees found.'
          attendeeTableWrap.appendChild(errMessageElem)
        } else {
          let attendeeTable = document.createElement('table')

          let titleWrapper = document.createElement('div')
          titleWrapper.setAttribute('class', 'attendee-title-wrapper')

          let attendeeTableTitle = document.createElement('h3')
          attendeeTableTitle.innerText = 'Attendee Details'

          titleWrapper.appendChild(attendeeTableTitle)

          let addAttendeeLink = document.createElement('a')
          addAttendeeLink.setAttribute('href', 'javascript:void(0);')
          addAttendeeLink.setAttribute(
            'class',
            'nab-view-add-attendee woocommerce-button button'
          )
          addAttendeeLink.setAttribute('data-orderid', orderId)
          addAttendeeLink.innerText = 'Add Attendee'

          if (response.is_attendee) {
            addAttendeeLink.setAttribute('style', 'display: none;')
          }

          titleWrapper.appendChild(addAttendeeLink)

          let attendeeTableCopy = document.createElement('span')
          attendeeTableCopy.className = 'nab-attendee-detail-copy'
          attendeeTableCopy.innerText =
            'The following attendees have been registered and should have received an email with a temporary password. They can each use their personal log ins to access the Show(s).'

          let attendeeActionMsg = document.createElement('div')
          attendeeActionMsg.setAttribute('class', 'attendee-details-message')
          attendeeActionMsg.setAttribute('style', 'display: none;')

          let attendeeTableFooter = document.createElement('span')
          attendeeTableFooter.className = 'nab-attendee-detail-footer'
          attendeeTableFooter.innerHTML =
            'If you need to make changes to your list of attendees after uploading, please contact <a href="mailto:register@nab.org">register@nab.org</a>.'

          let attendeeThead = document.createElement('thead')
          let attendeeTbody = document.createElement('tbody')
          attendeeTbody.setAttribute('id', 'attendee-list-table-body')

          let attendeeTheadTr = document.createElement('tr')

          let attendeeTheadFirstName = document.createElement('th')
          attendeeTheadFirstName.innerText = 'First Name'
          let attendeeTheadLastName = document.createElement('th')
          attendeeTheadLastName.innerText = 'Last Name'
          let attendeeTheadEmail = document.createElement('th')
          attendeeTheadEmail.innerText = 'Email'
          let attendeeTheadAction = document.createElement('th')

          attendeeTheadTr.appendChild(attendeeTheadFirstName)
          attendeeTheadTr.appendChild(attendeeTheadLastName)
          attendeeTheadTr.appendChild(attendeeTheadEmail)
          attendeeTheadTr.appendChild(attendeeTheadAction)

          attendeeThead.appendChild(attendeeTheadTr)

          attendeeTable.appendChild(attendeeThead)

          let dataTitles = {
            first_name: 'First Name',
            last_name: 'Last Name',
            email: 'Email'
          }

          for (let a = 0; a < response.attendees.length; a++) {
            let attendeeDataTr = document.createElement('tr')

            $.each(dataTitles, function (key, value) {
              let attendeeDataTd = document.createElement('td')
              let attendeeDataTdText = document.createTextNode(
                response.attendees[a][key]
              )
              attendeeDataTd.appendChild(attendeeDataTdText)
              attendeeDataTd.setAttribute('data-title', value)
              attendeeDataTr.appendChild(attendeeDataTd)
            })

            let attendeeDataAction = document.createElement('td')
            attendeeDataAction.setAttribute('data-title', 'Actions')
            attendeeDataAction.setAttribute(
              'data-oid',
              response.attendees[a]['order_id']
            )
            attendeeDataAction.setAttribute(
              'data-pid',
              response.attendees[a]['id']
            )

            let attendeeDataDefaultActions = document.createElement('div')
            attendeeDataDefaultActions.className = 'att-actions'

            let attendeeEditAction = document.createElement('a')
            attendeeEditAction.className = 'fa fa-edit'
            attendeeEditAction.href = 'javascript:void(0)'

            let attendeeDeleteAction = document.createElement('a')
            attendeeDeleteAction.className = 'fa fa-trash nab-remove-attendee'
            attendeeDeleteAction.href = 'javascript:void(0)'

            attendeeDataDefaultActions.appendChild(attendeeEditAction)
            attendeeDataDefaultActions.appendChild(attendeeDeleteAction)

            attendeeDataAction.appendChild(attendeeDataDefaultActions)

            let attendeeDataAdvActions = document.createElement('div')
            attendeeDataAdvActions.className = 'att-save'
            attendeeDataAdvActions.style.display = 'none'

            let attendeeSaveAction = document.createElement('a')
            attendeeSaveAction.className = 'nab-update-attendee'
            attendeeSaveAction.href = 'javascript:void(0)'

            attendeeDataAdvActions.appendChild(attendeeSaveAction)

            attendeeDataAction.appendChild(attendeeDataDefaultActions)
            attendeeDataAction.appendChild(attendeeDataAdvActions)

            attendeeDataTr.appendChild(attendeeDataAction)
            attendeeTbody.appendChild(attendeeDataTr)
          }
          attendeeTable.appendChild(attendeeTbody)

          attendeeTableWrap.appendChild(titleWrapper)
          attendeeTableWrap.appendChild(attendeeTableCopy)
          attendeeTableWrap.appendChild(attendeeActionMsg)
          attendeeTableWrap.appendChild(attendeeTable)
          attendeeTableWrap.appendChild(attendeeTableFooter)
        }

        $('#nabViewAttendeeModal').show()
        $('body').removeClass('is-loading') // loader
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $('body').removeClass('is-loading') // loader
        console.log(thrownError)
      }
    })
  })

  $(document).on('click', '.nab-remove-attendee', function () {
    let currentAttendee = $(this)
    let primaryID = currentAttendee.parents('td').attr('data-pid')
    let orderID = currentAttendee.parents('td').attr('data-oid')
    let parentOrderId = currentAttendee
      .parents('.attendee-view-wrap')
      .find('.nab-view-add-attendee')
      .attr('data-orderid')

    $('.attendee-details-message')
      .hide()
      .text('')
      .removeClass('success failed')

    if (primaryID && orderID) {
      let removeConfirmation = confirm(
        'Are you sure you want to remove this attendee?'
      )
      if (removeConfirmation) {
        showLoader()
        $.ajax({
          url: amplifyJS.ajaxurl,
          type: 'POST',
          data: {
            pID: primaryID,
            oID: orderID,
            parentOrderId: parentOrderId,
            action: 'remove_attendee',
            nabNonce: amplifyJS.nabNonce
          },
          success: function (response) {
            if (1 === response.err) {
              $('.attendee-details-message')
                .text(response.message)
                .addClass('failed')
                .show()
            } else {
              $('.attendee-details-message')
                .text(response.message)
                .addClass('success')
                .show()
              currentAttendee.parents('tr').remove()

              if (response.is_attendee) {
                $('.attendee-view-table-wrp .nab-view-add-attendee').hide()
              } else {
                $('.attendee-view-table-wrp .nab-view-add-attendee').show()
              }
            }
            hideLoader()
          },
          error: function (xhr, ajaxOptions, thrownError) {
            hideLoader()
            console.log(thrownError)
          }
        })
      }
    }
  })

  let attendeeFirstName = ''
  let attendeeLastName = ''
  let attendeeEmail = ''

  $(document).on(
    'click',
    '.attendee-view-table-wrp .att-actions a.fa-edit',
    function () {
      let currentAttendee = $(this)
      let primaryID = currentAttendee.parents('td').attr('data-pid')
      let orderID = currentAttendee.parents('td').attr('data-oid')

      $('.attendee-details-message')
        .hide()
        .text('')
        .removeClass('success failed')

      if (primaryID && orderID) {
        showLoader()

        $.ajax({
          url: amplifyJS.ajaxurl,
          type: 'POST',
          data: {
            pID: primaryID,
            action: 'get_edit_attendee',
            nabNonce: amplifyJS.nabNonce
          },
          success: function (response) {
            if (1 === response.err) {
              $('.attendee-details-message')
                .text(response.message)
                .addClass('failed')
                .show()
            } else {
              attendeeFirstName = response.first_name
              attendeeLastName = response.last_name
              attendeeEmail = response.email
              $('#nabeditAttendeeModal .attendee_first_name').val(
                attendeeFirstName
              )
              $('#nabeditAttendeeModal .attendee_last_name').val(
                attendeeLastName
              )
              $('#nabeditAttendeeModal .attendee_email').val(attendeeEmail)
              $('#nabeditAttendeeModal .attendee-edit-wrap').attr({
                'data-oid': orderID,
                'data-pid': primaryID,
                'data-uid': response.uid
              })
              $('#nabeditAttendeeModal .attendee-edit-wrap h3').text(
                'Edit Attendee Details'
              )
              $('#nabeditAttendeeModal').show()
            }
            hideLoader()
          },
          error: function (xhr, ajaxOptions, thrownError) {
            hideLoader()
            console.log(thrownError)
          }
        })
      }
    }
  )

  $(document).on(
    'click',
    '.attendee-view-table-wrp .nab-view-add-attendee',
    function () {
      $('#nabeditAttendeeModal .attendee-edit-wrap').attr({
        'data-orderid': $(this).attr('data-orderid'),
        'data-action': 'add'
      })
      $('#nabeditAttendeeModal .attendee-edit-wrap h3').text(
        'Add Attendee Details'
      )
      $('#nabeditAttendeeModal .attendee-edit-wrap .attendee_first_name').val(
        ''
      )
      $('#nabeditAttendeeModal .attendee-edit-wrap .attendee_last_name').val('')
      $('#nabeditAttendeeModal .attendee-edit-wrap .attendee_email').val('')
      $('#nabeditAttendeeModal').show()
    }
  )

  $(document).on(
    'click',
    '#nabeditAttendeeModal .edit-att-buttons .btn-save',
    function () {
      let currentElement = $(this)
      let editFirstName = currentElement
        .parents('table')
        .find('.attendee_first_name')
        .val()
      let editLastName = currentElement
        .parents('table')
        .find('.attendee_last_name')
        .val()
      let editEmail = currentElement
        .parents('table')
        .find('.attendee_email')
        .val()
      let action = currentElement
        .parents('.attendee-edit-wrap')
        .attr('data-action')

      $('.attendee-details-message')
        .hide()
        .text('')
        .removeClass('success failed')

      if (!editFirstName.match('[a-zA-Z0-9]')) {
        alert('Enter a valid first name')
        return
      }
      if (!editLastName.match('[a-zA-Z0-9]')) {
        alert('Enter a valid last name')
        return
      }

      let emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/
      if (!emailRegex.test(editEmail)) {
        alert('Enter a valid email address')
        return
      }

      if ('add' === action) {
        let orderID = currentElement
          .parents('.attendee-edit-wrap')
          .attr('data-orderid')

        if (orderID) {
          showLoader()

          $.ajax({
            url: amplifyJS.ajaxurl,
            type: 'POST',
            data: {
              orderId: orderID,
              fname: editFirstName,
              lname: editLastName,
              email: editEmail,
              action: 'add_attendee_order_details',
              nabNonce: amplifyJS.nabNonce
            },
            success: function (response) {
              if (1 === response.err) {
                $('.attendee-details-message')
                  .text(response.message)
                  .addClass('failed')
                  .show()
                currentElement.parents('#nabeditAttendeeModal').hide()
              } else {
                $('.attendee-details-message')
                  .text(response.message)
                  .addClass('success')
                  .show()

                let tableTr = document.createElement('tr')

                let firstNameTd = document.createElement('td')
                firstNameTd.setAttribute('data-title', 'First Name')
                firstNameTd.innerText = editFirstName

                let lastNameTd = document.createElement('td')
                lastNameTd.setAttribute('data-title', 'Last Name')
                lastNameTd.innerText = editLastName

                let emailTd = document.createElement('td')
                emailTd.setAttribute('data-title', 'Email')
                emailTd.innerText = editEmail

                let actionTd = document.createElement('td')
                actionTd.setAttribute('data-title', 'Actions')
                actionTd.setAttribute('data-oid', response.oid)
                actionTd.setAttribute('data-pid', response.pid)

                let actionDiv = document.createElement('div')
                actionDiv.setAttribute('class', 'att-actions')

                let editLink = document.createElement('a')
                editLink.setAttribute('class', 'fa fa-edit')
                editLink.setAttribute('href', 'javascript:void(0);')

                let removeLink = document.createElement('a')
                removeLink.setAttribute(
                  'class',
                  'fa fa-trash nab-remove-attendee'
                )
                removeLink.setAttribute('href', 'javascript:void(0);')

                actionDiv.appendChild(editLink)
                actionDiv.appendChild(removeLink)
                actionTd.appendChild(actionDiv)
                tableTr.appendChild(firstNameTd)
                tableTr.appendChild(lastNameTd)
                tableTr.appendChild(emailTd)
                tableTr.appendChild(actionTd)

                let tableBody = document.getElementById(
                  'attendee-list-table-body'
                )

                tableBody.appendChild(tableTr)

                if (response.is_attendee) {
                  $('.attendee-view-table-wrp .nab-view-add-attendee').hide()
                }
                currentElement.parents('#nabeditAttendeeModal').hide()
              }
              hideLoader()
            },
            error: function (xhr, ajaxOptions, thrownError) {
              hideLoader()
              console.log(thrownError)
            }
          })
        }
      } else {
        let primaryID = currentElement
          .parents('.attendee-edit-wrap')
          .attr('data-pid')
        let orderID = currentElement
          .parents('.attendee-edit-wrap')
          .attr('data-oid')

        if (attendeeEmail !== editEmail) {
          if (primaryID && orderID) {
            showLoader()

            $.ajax({
              url: amplifyJS.ajaxurl,
              type: 'POST',
              data: {
                pID: primaryID,
                oID: orderID,
                fname: editFirstName,
                lname: editLastName,
                email: editEmail,
                action: 'change_attendee_order_details',
                nabNonce: amplifyJS.nabNonce
              },
              success: function (response) {
                console.log(response)
                if (1 === response.err) {
                  $('.attendee-details-message')
                    .text(response.message)
                    .addClass('failed')
                    .show()
                  currentElement.parents('#nabeditAttendeeModal').hide()
                } else {
                  $('.attendee-details-message')
                    .text(response.message)
                    .addClass('success')
                    .show()

                  $(
                    '#nabViewAttendeeModal table td[data-pid="' +
                      primaryID +
                      '"]'
                  )
                    .parents('tr')
                    .find('td:eq(0)')
                    .text(editFirstName)
                  $(
                    '#nabViewAttendeeModal table td[data-pid="' +
                      primaryID +
                      '"]'
                  )
                    .parents('tr')
                    .find('td:eq(1)')
                    .text(editLastName)
                  $(
                    '#nabViewAttendeeModal table td[data-pid="' +
                      primaryID +
                      '"]'
                  )
                    .parents('tr')
                    .find('td:eq(2)')
                    .text(editEmail)
                  $(
                    '#nabViewAttendeeModal table td[data-pid="' +
                      primaryID +
                      '"]'
                  ).attr({ 'data-oid': response.oid, 'data-pid': response.pid })

                  if (response.is_attendee) {
                    $('.attendee-view-table-wrp .nab-view-add-attendee').hide()
                  } else {
                    $('.attendee-view-table-wrp .nab-view-add-attendee').show()
                  }

                  currentElement.parents('#nabeditAttendeeModal').hide()
                }
                hideLoader()
              },
              error: function (xhr, ajaxOptions, thrownError) {
                hideLoader()
                console.log(thrownError)
              }
            })
          }
        } else if (
          attendeeFirstName !== editFirstName ||
          attendeeLastName !== editLastName
        ) {
          let currentUserId = currentElement
            .parents('.attendee-edit-wrap')
            .data('uid')

          if (primaryID && currentUserId) {
            showLoader()

            $.ajax({
              url: amplifyJS.ajaxurl,
              type: 'POST',
              data: {
                pID: primaryID,
                uID: currentUserId,
                fname: editFirstName,
                lname: editLastName,
                action: 'update_attendee_details',
                nabNonce: amplifyJS.nabNonce
              },
              success: function (response) {
                if (1 === response.err) {
                  $('.attendee-details-message')
                    .text(response.message)
                    .addClass('failed')
                    .show()
                  currentElement.parents('#nabeditAttendeeModal').hide()
                } else {
                  $('.attendee-details-message')
                    .text(response.message)
                    .addClass('success')
                    .show()
                  $(
                    '#nabViewAttendeeModal table td[data-pid="' +
                      primaryID +
                      '"]'
                  )
                    .parents('tr')
                    .find('td:eq(0)')
                    .text(editFirstName)
                  $(
                    '#nabViewAttendeeModal table td[data-pid="' +
                      primaryID +
                      '"]'
                  )
                    .parents('tr')
                    .find('td:eq(1)')
                    .text(editLastName)
                  currentElement.parents('#nabeditAttendeeModal').hide()
                }
                hideLoader()
              },
              error: function (xhr, ajaxOptions, thrownError) {
                hideLoader()
                console.log(thrownError)
              }
            })
          }
        } else {
          currentElement.parents('#nabeditAttendeeModal').hide()
        }
      }

      attendeeFirstName = ''
      attendeeLastName = ''
      attendeeEmail = ''
      currentElement
        .parents('.attendee-edit-wrap')
        .removeAttr('data-pid data-oid data-uid data-orderid data-action')
    }
  )

  $(document).on(
    'click',
    '#nabeditAttendeeModal .edit-att-buttons .btn-cancle',
    function () {
      $(this)
        .parents('#nabeditAttendeeModal')
        .hide()
      $(this)
        .parents('.attendee-edit-wrap')
        .removeAttr('data-pid data-oid data-uid data-orderid data-action')
    }
  )

  /* User Search Filters*/
  $(document).on('click', '#load-more-user a', function () {
    let userPageNumber = parseInt($(this).attr('data-page-number'))
    nabSearchUserAjax(true, userPageNumber)
  })

  $(document).on('change', '.other-search-filter #people-connect', function () {
    nabSearchUserAjax(false, 1)
  })

  $(document).on(
    'change',
    '.other-search-filter #search-country-select',
    function () {
      $(this)
        .parents('.other-search-filter')
        .find('#search-state-select')
        .empty()
      $(this)
        .parents('.other-search-filter')
        .find('#search-city-select')
        .empty()

      let default_option_state = $('<option></option>')
        .prop('value', '')
        .text('Select a state')
      $('.other-search-filter .search-state-select').append(
        default_option_state
      )

      let default_option_city = $('<option></option>')
        .prop('value', '')
        .text('Select a city')
      $('.other-search-filter .search-city-select').append(default_option_city)

      let country = 0 === $(this)[0].selectedIndex ? '' : $(this).val()

      jQuery.ajax({
        url: amplifyJS.ajaxurl,
        type: 'POST',
        data: {
          action: 'nab_get_search_filter_state',
          nabNonce: amplifyJS.nabNonce,
          country: country
        },
        success: function (response) {
          let stateObj = jQuery.parseJSON(response)
          if (stateObj.states) {
            $.each(stateObj.states, function (index) {
              let $option = $('<option></option>')
                .prop('value', index)
                .text(stateObj.states[index])
              $('.other-search-filter .search-state-select').append($option)
            })
            //$('.other-search-filter .search-state-select').val('').change();
          }
        }
      })
      nabSearchUserAjax(false, 1)
    }
  )

  $(document).on(
    'change',
    '.other-search-filter #search-state-select',
    function () {
      $(this)
        .parents('.other-search-filter')
        .find('#search-city-select')
        .empty()
      let default_option_city = $('<option></option>')
        .prop('value', '')
        .text('Select a city')
      $('.other-search-filter .search-city-select').append(default_option_city)

      nabSearchUserAjax(false, 1)
    }
  )

  $(document).on(
    'change',
    '.other-search-filter #search-city-select',
    function () {
      nabSearchUserAjax(false, 1)
    }
  )

  $(document).ready(function () {
    $('.search-city-select').select2()
    $('.search-city-select').select2({
      ajax: {
        url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
        dataType: 'json',
        delay: 250, // delay in ms while typing when to perform a AJAX search
        data: function (params) {
          return {
            q: params.term, // search query
            action: 'nab_get_search_city', // AJAX action for admin-ajax.php
            country:
              0 ===
              $('.other-search-filter #search-country-select')[0].selectedIndex
                ? ''
                : $('.other-search-filter #search-country-select').val(),
            state:
              0 ===
              $('.other-search-filter #search-state-select')[0].selectedIndex
                ? ''
                : $('.other-search-filter #search-state-select').val()
          }
        },
        processResults: function (data) {
          var options = []
          if (data) {
            // data is the array of arrays, and each of them contains ID and the Label of the option
            $.each(data, function (index, text) {
              // do not forget that "index" is just auto incremented value
              options.push({ id: text, text: text })
            })
          }
          return {
            results: options
          }
        },
        cache: true
      },
      minimumInputLength: 2
    })
  })

  $(document).on(
    'keypress',
    '.other-search-filter .company-search .input-company',
    function (e) {
      if (13 === e.which) {
        nabSearchUserAjax(false, 1)
      }
    }
  )

  $(document).on(
    'keypress',
    '.other-search-filter .job-title-search .input-job-title',
    function (e) {
      if (13 === e.which) {
        nabSearchUserAjax(false, 1)
      }
    }
  )

  $(document).on(
    'click',
    '.other-search-filter .sort-user a.sort-order',
    function () {
      if (!$(this).hasClass('active')) {
        $(this)
          .addClass('active')
          .siblings()
          .removeClass('active')
        nabSearchUserAjax(false, 1)
      }
    }
  )

  /* Product Search Filters*/
  $(document).on('click', '#load-more-product a', function () {
    let productPageNumber = parseInt($(this).attr('data-page-number'))
    nabSearchProductAjax(true, productPageNumber)
  })

  $(document).on(
    'change',
    '.other-search-filter #product-category',
    function () {
      nabSearchProductAjax(false, 1)
    }
  )

  $(document).on(
    'click',
    '.other-search-filter .sort-product a.sort-order',
    function () {
      if (!$(this).hasClass('active')) {
        $(this)
          .addClass('active')
          .siblings()
          .removeClass('active')
        nabSearchProductAjax(false, 1)
      }
    }
  )

  /* Company Product Search Filters*/
  $(document).on('click', '#load-more-company-product a', function () {
    let productPageNumber = parseInt($(this).attr('data-page-number'))
    nabSearchCompanyProductAjax(true, productPageNumber)
  })

  $(document).on(
    'click',
    '.other-search-filter .sort-company-product a.sort-order',
    function () {
      if (!$(this).hasClass('active')) {
        $(this)
          .addClass('active')
          .siblings()
          .removeClass('active')
        nabSearchCompanyProductAjax(false, 1)
      }
    }
  )

  $(document).on(
    'change',
    '.other-search-filter .nab-custom-select #company-product-category',
    function () {
      nabSearchCompanyProductAjax(false, 1)
    }
  )

  /* Company Search Filters*/
  $(document).on('click', '#load-more-company a', function () {
    let companyPageNumber = parseInt($(this).attr('data-page-number'))
    nabSearchCompanyAjax(true, companyPageNumber)
  })

  $(document).on(
    'click',
    '.other-search-filter .sort-company a.sort-order',
    function () {
      if (!$(this).hasClass('active')) {
        $(this)
          .addClass('active')
          .siblings()
          .removeClass('active')
        nabSearchCompanyAjax(false, 1)
      }
    }
  )

  $(document).on(
    'change',
    '.other-search-filter .nab-custom-select #company-category-filter',
    function () {
      nabSearchCompanyAjax(false, 1)
    }
  )

  /* Content Search Filters*/
  $(document).on('click', '#load-more-content a', function () {
    let contentPageNumber = parseInt($(this).attr('data-page-number'))
    nabSearchContentAjax(true, contentPageNumber)
  })

  $(document).on(
    'click',
    '.other-search-filter .sort-content a.sort-order',
    function () {
      if (!$(this).hasClass('active')) {
        $(this)
          .addClass('active')
          .siblings()
          .removeClass('active')
        nabSearchContentAjax(false, 1)
      }
    }
  )

  $(document).on(
    'change',
    '.other-search-filter .nab-custom-select #content-community',
    function () {
      nabSearchContentAjax(false, 1)
    }
  )

  $(document).on(
    'change',
    '.other-search-filter .nab-custom-select #content-subject',
    function () {
      nabSearchContentAjax(false, 1)
    }
  )

  $(document).on(
    'change',
    '.other-search-filter .nab-custom-select #content-type',
    function () {
      nabSearchContentAjax(false, 1)
    }
  )

  /* Event Search Filters*/
  $(document).on('click', '#load-more-event a', function () {
    let eventPageNumber = parseInt($(this).attr('data-page-number'))
    nabSearchEventAjax(true, eventPageNumber)
  })

  $(document).on(
    'click',
    '.other-search-filter .event-type a.sort-order',
    function () {
      if (!$(this).hasClass('active')) {
        $(this)
          .addClass('active')
          .siblings()
          .removeClass('active')
        nabSearchEventAjax(false, 1)
      }
    }
  )

  // Handle Connection Request Form Submission.
  $(document).on('click', '#submit-connection-request', function () {
    const connectionMsg = $('#connection-message').val()
    if ('' === connectionMsg) {
      $('#connection-message-popup').hide()
      $('.popup-opened').addClass('message-sent')
      $('.popup-opened').trigger('click')
      $('.popup-opened').removeClass('popup-opened')
    } else {
      $('#connection-message').removeClass('error')
      $('#connection-message-form .error').hide()

      // Get member ID from card
      var memberID = $('.popup-opened').attr('id')
      memberID = memberID.split('-')
      memberID = memberID[1]

      jQuery.ajax({
        url: amplifyJS.ajaxurl,
        type: 'POST',
        data: {
          action: 'nab_bp_send_connection_message',
          message: connectionMsg,
          memberID: memberID
        },
        success: function (data) {
          // Trigger the request again.
          $('#connection-message-popup').hide()
          $('.popup-opened').addClass('message-sent')
          $('.popup-opened').trigger('click')
          $('.popup-opened').removeClass('popup-opened')
        }
      })
    }
  })

  $(document).on(
    'click',
    '.search-actions a.not_friends, .search-actions a.pending_friend, .friend-request-action a.accept, .friend-request-action a.reject',
    function (e) {
      if (
        $(this)
          .attr('href')
          .match(/_wpnonce=/)
      ) {
        e.preventDefault()

        if ('add' === $(this).attr('rel')) {
          if (!$(this).hasClass('message-sent')) {
            if (!$('body').hasClass('connection-popup-added')) {
              $('.popup-opened').removeClass('popup-opened')
              $(this).addClass('popup-opened')

              jQuery.ajax({
                url: amplifyJS.ajaxurl,
                type: 'POST',
                data: {
                  action: 'nab_bp_connecton_request_popup'
                },
                success: function (data) {
                  if (0 === $('#connection-message-popup').length) {
                    $('body').append(data)
                    $('#connection-message-popup').show()
                    $('body').addClass('connection-popup-added')
                  } else {
                    $('body').addClass('connection-popup-added')
                    $('#connection-message-popup').remove()
                    $('body').append(data)
                    $('#connection-message-popup').show()
                  }
                }
              })
            }
            // Prevent request unless the message is sent.
            return false
          } else {
            $(this).removeClass('message-sent')
            $('body').removeClass('connection-popup-added')
          }
        }

        let _this = $(this)
        let wpnonce = _this.attr('href').split('_wpnonce=')[1]
        let itemId, ajaxAction

        if (_this.parent().hasClass('friend-request-action')) {
          let requestItem = _this.attr('href').split('/?_wpnonce')[0]
          itemId = requestItem.substring(requestItem.lastIndexOf('/') + 1)
          ajaxAction = 'friends_' + _this.attr('data-bp-btn-action')
        } else {
          itemId = _this.attr('id').split('-')[1]
          ajaxAction = _this.hasClass('not_friends')
            ? 'friends_add_friend'
            : 'friends_withdraw_friendship'
        }

        jQuery.ajax({
          url: amplifyJS.ajaxurl,
          type: 'POST',
          data: {
            action: ajaxAction,
            nonce: BP_Nouveau.nonces.friends,
            item_id: itemId,
            _wpnonce: wpnonce
          },
          success: function (response) {
            if (response.success) {
              if (_this.parent().hasClass('friend-request-action')) {
                nab_get_friend_button(_this)
              } else {
                _this.parent().replaceWith(response.data.contents)
              }
            }
          }
        })
        return false
      }
    }
  )

  $(document).on(
    'click',
    '#unfriend-confirmation .confirmed-answer',
    function () {
      if ('confirmed-yes' === $(this).attr('id')) {
        window.location.href = $('.popup-shown').attr('href')
      } else {
        $('.popup-shown').removeClass('popup-shown')
        $('#unfriend-confirmation')
          .hide()
          .removeClass('nab-modal-active')
      }
    }
  )

  // Unfriend confirmation.
  $(document).on('click', '.is_friend .remove', function (e) {
    e.preventDefault()
    $(this).addClass('popup-shown')
    $('#unfriend-confirmation')
      .show()
      .addClass('nab-modal-active')
  })

  // Product bookmark Ajax
  $(document).on('click', 'span.user-bookmark-action', function (e) {
    let _this = $(this)
    let bm_action = _this.hasClass('bookmark-fill') ? 'remove' : 'add'
    let item_id = _this.attr('data-product')
    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      type: 'POST',
      data: {
        action: 'nab_update_member_bookmark',
        nabNonce: amplifyJS.nabNonce,
        item_id: item_id,
        bm_action: bm_action
      },
      success: function (response) {
        let final_res = jQuery.parseJSON(response)

        if (final_res.success) {
          if (_this.hasClass('bookmark-fill')) {
            _this
              .removeClass('bookmark-fill')
              .attr('data-bp-tooltip', final_res.tooltip)
          } else {
            _this
              .addClass('bookmark-fill')
              .attr('data-bp-tooltip', final_res.tooltip)
          }
        }
      }
    })
  })

  // User bookmark list
  $(document).on('click', '#load-more-bookmark a', function (e) {
    let postPerPage = $(this).attr('data-post-limit')
      ? parseInt($(this).attr('data-post-limit'))
      : 12
    let pageNumber = $(this).attr('data-page-number')
      ? parseInt($(this).attr('data-page-number'))
      : 12
    let item_id = $(this).attr('data-user')
      ? parseInt($(this).attr('data-user'))
      : 0

    $('body').addClass('is-loading')

    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      type: 'POST',
      data: {
        action: 'nab_member_bookmark_list',
        nabNonce: amplifyJS.nabNonce,
        item_id: item_id,
        page_number: pageNumber,
        post_limit: postPerPage
      },
      success: function (response) {
        let bookmarkObj = jQuery.parseJSON(response)

        if (bookmarkObj.result_post && 0 < bookmarkObj.result_post.length) {
          let bookmarkListDiv = document.getElementById('bookmark-list')

          jQuery.each(bookmarkObj.result_post, function (key, value) {
            let searchItemDiv = document.createElement('div')
            searchItemDiv.setAttribute('class', 'amp-item-col')

            let searchItemInner = document.createElement('div')
            searchItemInner.setAttribute('class', 'amp-item-inner')

            let searchItemCover = document.createElement('div')
            searchItemCover.setAttribute('class', 'amp-item-cover')

            let coverImg = document.createElement('img')
            coverImg.setAttribute('src', value.thumbnail)
            coverImg.setAttribute('alt', 'Bookmark Image')

            searchItemCover.appendChild(coverImg)

            let bookmarkSpan = document.createElement('span')
            bookmarkSpan.setAttribute(
              'class',
              'fa fa-bookmark-o amp-bookmark bookmark-fill'
            )

            searchItemCover.appendChild(bookmarkSpan)
            searchItemInner.appendChild(searchItemCover)

            let searchItemInfo = document.createElement('div')
            searchItemInfo.setAttribute('class', 'amp-item-info')

            let searchContent = document.createElement('div')
            searchContent.setAttribute('class', 'amp-item-content')

            let bookmarkTitle = document.createElement('h4')

            let bookmarkTitleLink = document.createElement('a')
            bookmarkTitleLink.setAttribute('href', value.link)
            bookmarkTitleLink.innerText = value.title

            bookmarkTitle.appendChild(bookmarkTitleLink)

            searchContent.appendChild(bookmarkTitle)

            let ampAction = document.createElement('div')
            ampAction.setAttribute('class', 'amp-actions')

            let searchAction = document.createElement('div')
            searchAction.setAttribute('class', 'search-actions')

            let viewBookmarkLink = document.createElement('a')
            viewBookmarkLink.setAttribute('href', value.link)
            viewBookmarkLink.setAttribute('class', 'button')
            viewBookmarkLink.innerText = 'Read More'

            searchAction.appendChild(viewBookmarkLink)
            ampAction.appendChild(searchAction)
            searchContent.appendChild(ampAction)

            searchItemInfo.appendChild(searchContent)
            searchItemInner.appendChild(searchItemInfo)
            searchItemDiv.appendChild(searchItemInner)

            bookmarkListDiv.appendChild(searchItemDiv)

            if (value.banner) {
              $('#bookmark-list').append(value.banner)
            }
          })
        }
        $('#load-more-bookmark a').attr(
          'data-page-number',
          bookmarkObj.next_page_number
        )

        if (bookmarkObj.next_page_number > bookmarkObj.total_page) {
          $('#load-more-bookmark').hide()
        } else {
          $('#load-more-bookmark').show()
        }

        $('body').removeClass('is-loading')
      }
    })
  })

  // User event list
  $(document).on('click', '#load-more-events a', function (e) {
    let postPerPage = $(this).attr('data-post-limit')
      ? parseInt($(this).attr('data-post-limit'))
      : 12
    let pageNumber = $(this).attr('data-page-number')
      ? parseInt($(this).attr('data-page-number'))
      : 2
    let item_id = $(this).attr('data-user')
      ? parseInt($(this).attr('data-user'))
      : 0

    $('body').addClass('is-loading')

    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      type: 'POST',
      data: {
        action: 'nab_member_event_list',
        nabNonce: amplifyJS.nabNonce,
        item_id: item_id,
        page_number: pageNumber,
        post_limit: postPerPage
      },
      success: function (response) {
        let eventObj = jQuery.parseJSON(response)

        if (eventObj.result_post && 0 < eventObj.result_post.length) {
          let eventListDiv = document.getElementById('previous-event-list')

          jQuery.each(eventObj.result_post, function (key, value) {
            let searchItemDiv = document.createElement('div')
            searchItemDiv.setAttribute('class', 'amp-item-col')

            let searchItemInner = document.createElement('div')
            searchItemInner.setAttribute('class', 'amp-item-inner')

            let searchItemCover = document.createElement('div')
            searchItemCover.setAttribute('class', 'amp-item-cover')

            let coverImg = document.createElement('img')
            coverImg.setAttribute('src', value.thumbnail)
            coverImg.setAttribute('alt', 'Event Image')

            searchItemCover.appendChild(coverImg)
            searchItemInner.appendChild(searchItemCover)

            let searchItemInfo = document.createElement('div')
            searchItemInfo.setAttribute('class', 'amp-item-info')

            let searchContent = document.createElement('div')
            searchContent.setAttribute('class', 'amp-item-content')

            let eventTitle = document.createElement('h4')
            eventTitle.innerText = value.title

            searchContent.appendChild(eventTitle)

            let eventDate = document.createElement('span')
            eventDate.setAttribute('class', 'company-name')
            eventDate.innerText = value.date

            searchContent.appendChild(eventDate)

            let ampAction = document.createElement('div')
            ampAction.setAttribute('class', 'amp-actions')

            let searchAction = document.createElement('div')
            searchAction.setAttribute('class', 'search-actions')

            let viewEventLink = document.createElement('a')
            viewEventLink.setAttribute('href', value.link)
            viewEventLink.setAttribute('class', 'button')
            viewEventLink.innerText = 'View Event'

            searchAction.appendChild(viewEventLink)
            ampAction.appendChild(searchAction)
            searchContent.appendChild(ampAction)

            searchItemInfo.appendChild(searchContent)
            searchItemInner.appendChild(searchItemInfo)
            searchItemDiv.appendChild(searchItemInner)

            eventListDiv.appendChild(searchItemDiv)

            if (value.banner) {
              $('#previous-event-list').append(value.banner)
            }
          })
        }
        $('#load-more-events a').attr(
          'data-page-number',
          eventObj.next_page_number
        )

        if (eventObj.next_page_number > eventObj.total_page) {
          $('#load-more-events').hide()
        } else {
          $('#load-more-events').show()
        }

        $('body').removeClass('is-loading')
      }
    })
  })

  $(document).on('click', '.generic-button .follow-btn', function () {
    let _this = $(this)
    let search_page =
      0 < $('.nab-search-result-wrapper #search-company-list').length
        ? 'yes'
        : 'no'

    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      type: 'POST',
      data: {
        action: 'nab_company_follow_action',
        nabNonce: amplifyJS.nabNonce,
        item_id: _this.attr('data-item'),
        item_action: _this.attr('data-action'),
        search_page: search_page
      },
      success: function (response) {
        let followObj = jQuery.parseJSON(response)

        if (followObj.success) {
          if ('follow' === _this.attr('data-action')) {
            if ('yes' !== search_page) {
              _this
                .parents('.amp-profile-content')
                .find('.amp-profile-image label')
                .append(followObj.unfollow_btn)
            }
            _this.parents('.search-actions').replaceWith(followObj.message_btn)
          } else if ('unfollow' === _this.attr('data-action')) {
            _this
              .parents('.amp-profile-content')
              .find('.amp-actions')
              .prepend(followObj.follow_btn)
            _this.parents('.unfollow-btn').remove()
          }
        }
      }
    })
  })

  $(document).on('click', '.company-claim-box .claim-link', function () {
    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      type: 'POST',
      data: {
        action: 'nab_user_claim_company',
        nabNonce: amplifyJS.nabNonce,
        item_id: $(this)
          .parents('.company-message-inner')
          .attr('data-item')
      },
      success: function (response) {
        jQuery('body').append(
          '<div id="connection-message-popup" class="nab-modal" style="display: block;"><div class="nab-modal-inner"><div class="modal-content"><span class="nab-modal-close fa fa-times"></span><div class="modal-content-wrap nab-company-claim-popup"><p>Request sent successfully!</p></div></div></div></div>'
        )
      }
    })
  })

  $(document).on('click', '.nab-reaction-type', function () {
    let _this = $(this)

    if (
      0 <
        _this.parents('.reaction-item-list').find('.nab-reaction-type.reacted')
          .length &&
      !_this.parents('.reaction-item-list').attr('data-log')
    ) {
      return false
    }
    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      type: 'POST',
      data: {
        action: 'nab_update_post_reaction',
        nabNonce: amplifyJS.nabNonce,
        item_id: _this.parents('.reaction-item-list').attr('data-item'),
        item_action: _this.attr('data-action'),
        rid: _this.attr('data-reaction'),
        item_type: _this.parents('.reaction-item-list').attr('data-item-type')
      },
      success: function (response) {
        let reactObj = jQuery.parseJSON(response)

        if (reactObj.success) {
          if ('add' === reactObj.action.toLowerCase()) {
            _this
              .removeClass('reacted')
              .attr('data-action', reactObj.action.toLowerCase())
            _this
              .parents('.reaction-list-type')
              .find('.reaction-main-like')
              .removeClass('reacted')
          } else {
            _this
              .parents('.reaction-list-type')
              .find('.reaction-main-like')
              .addClass('reacted')
            _this
              .parents('.reaction-item-list')
              .find('.nab-reaction-type')
              .removeClass('reacted')
            _this.addClass('reacted')
            _this
              .parents('.reaction-item-list')
              .find('.nab-reaction-type')
              .attr('data-action', 'add')
            _this.attr('data-action', reactObj.action.toLowerCase())
          }

          let total =
            reactObj.total && 0 < parseInt(reactObj.total) ? reactObj.total : ''
          _this
            .parents('.reaction-inner')
            .find('.user-reacted-item .react-count')
            .text(total)

          _this
            .parents('.reaction-inner')
            .find('.user-reacted-item .reacted-list')
            .html(reactObj.reacted_list)
        }
      }
    })
  })

  $(document).on('click', '.reaction-main-like', function () {
    $(this)
      .next('.reaction-icon-modal')
      .toggleClass('show-icon-modal')
  })

  $(document).on(
    'click',
    '#send-private-message.poc-msg-btn a, .generic-button .nab-conn-msg',
    function (e) {
      e.preventDefault()

      var member_id = $(this)
        .parent()
        .attr('id')
        .split('_')
      member_id = member_id[2]

      var company_id = $(this).data('comp-id')

      jQuery.ajax({
        url: amplifyJS.ajaxurl,
        type: 'POST',
        data: {
          action: 'nab_bp_message_request_popup',
          company_id: company_id,
          post_type: amplifyJS.postType,
          post_id: amplifyJS.postID,
          member_id: member_id
        },
        success: function (data) {
          if ($('#connection-message-popup').length > 0) {
            $('#connection-message-popup').remove()
            $('body').append(data)
            $('#connection-message-popup').show()
            $('body').addClass('message-popup-added')
            $('.popup-opened').removeClass('popup-opened')
            $(this).addClass('popup-opened')
            load_tinyMCE_withPlugins('#nab-connection-message')
          } else {
            $('body').append(data)
            $('#connection-message-popup').show()
            $('body').addClass('message-popup-added')
            $('.popup-opened').removeClass('popup-opened')
            $(this).addClass('popup-opened')
            load_tinyMCE_withPlugins('#nab-connection-message')
          }
        }
      })
    }
  )

  $(document).on('click', '#submit-message-request', function (e) {
    e.stopPropagation()
    var connectionMsg = ''
    if (tinyMCE.get('nab-connection-message')) {
      $('#connection-message').val(
        tinyMCE.get('nab-connection-message').getContent()
      )
      connectionMsg = $('#nab-connection-message').val()
    } else {
      connectionMsg = $('#connection-message').val()
    }

    if ('' === connectionMsg) {
      if (!$('#connection-message').hasClass('wp-editor-area')) {
        $('#connection-message').addClass('error')
      }

      $('#connection-message-form .error').show()
    } else {
      if (!$('#connection-message').hasClass('wp-editor-area')) {
        $('#connection-message').removeClass('error')
      }
      $('#connection-message-form .error').hide()

      // Get member ID from card
      var memberID = $('#connection-message-popup').data('comp-admin-id')
      jQuery.ajax({
        url: amplifyJS.ajaxurl,
        type: 'POST',
        data: {
          action: 'nab_bp_send_message',
          nabNonce: amplifyJS.nabNonce,
          message: connectionMsg,
          send_to: memberID,
          post_id: undefined !== amplifyJS.postID ? amplifyJS.postID : ''
        },
        beforeSend: function () {
          $('body').addClass('is-loading')
        },
        success: function (data) {
          $('body').removeClass('is-loading')
          addSuccessMsg('.modal-content-wrap', data.data.feedback)
          jQuery('#connection-message-form').trigger('reset')
        }
      })
    }
  })

  $(document).on('click', '.edit-feature-block', function (e) {
    e.preventDefault()

    var company_id = amplifyJS.postID

    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      type: 'POST',
      data: {
        action: 'nab_edit_feature_block_popup',
        company_id: company_id
      },
      success: function (data) {
        if ($('#addProductModal').length > 0) {
          $('#addProductModal').remove()
          $('body').append(data)
          $('#addProductModal').show()
          $('body').addClass('feature-block-popup-added')
          $('.popup-opened').removeClass('popup-opened')
          $(this).addClass('popup-opened')

          defaultCharCount(
            '#nab_featured_block_posted_by',
            '#character-count-featured-posyby',
            60
          )
          defaultCharCount(
            '#nab_featured_block_description',
            '#character-count-featured-desc',
            200
          )
          defaultCharCount(
            '#nab_featured_block_button_label',
            '#character-count-featured-btnlabel',
            60
          )
        } else {
          $('body').append(data)
          $('#addProductModal').show()
          $('body').addClass('feature-block-popup-added')
          $('.popup-opened').removeClass('popup-opened')
          $(this).addClass('popup-opened')
          defaultCharCount(
            '#nab_featured_block_headline',
            '#character-count-featured-headline',
            200
          )
          defaultCharCount(
            '#nab_featured_block_posted_by',
            '#character-count-featured-posyby',
            60
          )
          defaultCharCount(
            '#nab_featured_block_description',
            '#character-count-featured-desc',
            200
          )
          defaultCharCount(
            '#nab_featured_block_button_label',
            '#character-count-featured-btnlabel',
            60
          )
        }
      }
    })
  })

  $(document).on('click', '#nab-edit-featured-block-submit', function (e) {
    e.preventDefault()

    var form_data = new FormData()
    var nab_featured_block_headline = $('#nab_featured_block_headline').val()
    var nab_featured_block_title = $('#nab_featured_block_title').val()
    var nab_featured_block_posted_by = $('#nab_featured_block_posted_by').val()
    var nab_featured_block_description = $(
      '#nab_featured_block_description'
    ).val()
    var nab_featured_block_button_label = $(
      '#nab_featured_block_button_label'
    ).val()
    var nab_featured_block_button_link = $(
      '#nab_featured_block_button_link'
    ).val()

    if (!checkContentlength('#nab_featured_block_posted_by', 'Posted By', 60)) {
      return false
    }
    if (
      !checkContentlength('#nab_featured_block_description', 'Description', 200)
    ) {
      return false
    }
    if (
      !checkContentlength(
        '#nab_featured_block_button_label',
        'Button label',
        60
      )
    ) {
      return false
    }

    form_data.append('action', 'nab_edit_feature_block')
    form_data.append('company_id', amplifyJS.postID)
    form_data.append('nab_featured_block_headline', nab_featured_block_headline)
    form_data.append('nab_featured_block_title', nab_featured_block_title)
    form_data.append(
      'nab_featured_block_posted_by',
      nab_featured_block_posted_by
    )
    form_data.append(
      'nab_featured_block_description',
      nab_featured_block_description
    )
    form_data.append(
      'nab_featured_block_button_label',
      nab_featured_block_button_label
    )
    form_data.append(
      'nab_featured_block_button_link',
      nab_featured_block_button_link
    )

    if (jQuery('#product_featured_image')[0].files.length > 0) {
      $.each($('#product_featured_image')[0].files, function (key, file) {
        form_data.append('nab_feature_block_bg_image', file)
      })
    }
    form_data.append(
      'nab_featured_block_remove_attachment',
      remove_featured_attachment_arr
    )
    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      processData: false,
      contentType: false,
      type: 'POST',
      data: form_data,
      beforeSend: function () {
        $('body').addClass('is-loading')
      },
      success: function (data) {
        if (data.data.type == 'success') {
          $('body').removeClass('is-loading')
          addSuccessMsg(
            '.add-product-content-popup',
            'Featured Block Updated Sucessfully!'
          )
        } else {
          $('body').removeClass('is-loading')
        }
      }
    })
  })
  $(document).on('click', '#addProductModal .nab-modal-close', function (e) {
    if (
      ($('body').hasClass('single-company') &&
        $('body').hasClass('nab-close-reload')) ||
      $('#addProductModal .woocommerce-notices-wrapper').length > 0
    ) {
      location.reload()
    }
  })
  /**
   * Downloadable PDF
   */
  $(document).on(
    'click',
    '.company-pdfs #downloadable-pdfs-list .pdf-add-edit-action',
    function () {
      $('body').addClass('is-loading');
      $.ajax({
        type: 'POST',
        url: amplifyJS.ajaxurl,
        data: {
          action: 'nab_edit_downloadable_company_pdf',
          pdf_id: undefined !== $(this).data('id') ? $(this).data('id') : '',
          company_id: undefined !== $(this).data('company-id') ? $(this).data('company-id') : '',
          nabNonce: amplifyJS.nabNonce
        },
        success: function (response) {
          $('body').removeClass('is-loading');
          $('body').append(response);
          $('#addProductModal').show().addClass('nab-modal-active');
        }
      })
    }
  )

  $(document).on( 'change', '#pdf-featured-image', function() {
    renderUploadedFeaturedImg(this);
  });

  $(document).on('click', '#pdf_media_wrapper .remove-featred-img', function(){
    if ( confirm( 'Are you sure want to remove?' ) ) {
      $(this).parents('.nab-pdf-media-item').remove();
    }
  });

  $(document).on( 'keyup', '#nab-add-edit-pdf-form #pdf-description', function(){
    var maxLimit  = 200;
    var currentCount = $(this).val().length;
    var remaining = currentCount > 200 ? 0 : maxLimit - currentCount;
    $(this).parents('.form-row').find('.info-msg #pdf-desc-count').text( remaining + ' Characters Remaining');
  });

  function renderUploadedFeaturedImg(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        var fileExt = input.value.split('.').pop().toLowerCase();
        if ( $.inArray( fileExt, ['png','jpg','jpeg'] ) === -1 ) {
            $('#pdf-featured-image').parents('.form-row').append('<p class="form-field-error">Invalid file type. Acceptable File Types: .jpeg. .jpg, .png.</p>');
            input.value = '';
            return false;
        } else {
          $('#pdf-featured-image').parents('.form-row').find('.form-field-error').remove();
        }
        if ( 0 < $('#pdf_media_wrapper .preview-pdf-featured-img').length ) {
          $('#pdf_media_wrapper .preview-pdf-featured-img').attr('src', e.target.result);
        } else {
          var previewImg = '<div class="nab-pdf-media-item"><i class="fa fa-times remove-featred-img" aria-hidden="true"></i><img src="' + e.target.result + '" class="preview-pdf-featured-img" /></div>';
          $('#pdf_media_wrapper').append(previewImg);
        }
      }
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

})(jQuery)

function nabAddProdBlankImage(unique_key) {
  $('#product_media_wrapper').append(
      '<div class="nab-product-media-item" ><button type="button" class="nab-remove-attachment" data-attach-id="0"><i class="fa fa-times" aria-hidden="true"></i></button><img id="product_media_preview_' +
      unique_key +
      '" src="#" alt="your image" style="display:none;"/></div>'
  );
}

// Get friend button
function nab_get_friend_button (_this) {
  let itemId = _this.parent().attr('data-item')

  jQuery.ajax({
    url: amplifyJS.ajaxurl,
    type: 'POST',
    data: {
      action: 'nab_get_friend_button',
      nabNonce: amplifyJS.nabNonce,
      item_id: itemId
    },
    success: function (response) {
      let buttonObj = jQuery.parseJSON(response)

      if (buttonObj.success) {
        _this.parents('.search-actions').replaceWith(buttonObj.content)
      }
    }
  })
}

/** User Search Ajax */
function nabSearchUserAjax (loadMore, pageNumber) {
  let connected = ''
  let country = ''
  let state = ''
  let city = ''
  let pageType = jQuery('#load-more-user a').attr('data-page-type')
  let postPerPage = jQuery('#load-more-user a').attr('data-post-limit')
    ? parseInt(jQuery('#load-more-user a').attr('data-post-limit'))
    : 12
  let searchTerm =
    0 < jQuery('.search-result-filter .search-form input[name="s"]').length
      ? jQuery('.search-result-filter .search-form input[name="s"]').val()
      : ''
  let company =
    0 < jQuery('.other-search-filter .company-search .input-company').length
      ? jQuery('.other-search-filter .company-search .input-company').val()
      : ''
  let orderBy =
    0 < jQuery('.other-search-filter .sort-user a.active').length
      ? jQuery('.other-search-filter .sort-user a.active').attr('data-order')
      : 'newest'

  let jobTitle =
    0 < jQuery('.other-search-filter .job-title-search .input-job-title').length
      ? jQuery('.other-search-filter .job-title-search .input-job-title').val()
      : ''

  if (0 < jQuery('.other-search-filter #people-connect').length) {
    connected =
      0 === jQuery('.other-search-filter #people-connect')[0].selectedIndex
        ? ''
        : jQuery('.other-search-filter #people-connect').val()
  }

  if (0 < jQuery('.other-search-filter #search-country-select').length) {
    country =
      0 ===
      jQuery('.other-search-filter #search-country-select')[0].selectedIndex
        ? ''
        : jQuery('.other-search-filter #search-country-select').val()
  }
  if (0 < jQuery('.other-search-filter #search-state-select').length) {
    state =
      0 === jQuery('.other-search-filter #search-state-select')[0].selectedIndex
        ? ''
        : jQuery('.other-search-filter #search-state-select').val()
  }

  if (0 < jQuery('.other-search-filter #search-city-select').length) {
    city =
      0 === jQuery('.other-search-filter #search-city-select')[0].selectedIndex
        ? ''
        : jQuery('.other-search-filter #search-city-select').val()
  }

  jQuery('body').addClass('is-loading')

  jQuery.ajax({
    url: amplifyJS.ajaxurl,
    type: 'POST',
    data: {
      action: 'nab_member_search_filter',
      nabNonce: amplifyJS.nabNonce,
      page_number: pageNumber,
      post_limit: postPerPage,
      connected: connected,
      search_term: searchTerm,
      company: company,
      job_title: jobTitle,
      country: country,
      state: state,
      city: city,
      orderby: orderBy
    },
    success: function (response) {
      if (!loadMore) {
        jQuery('#search-user-list').empty()
      }
      let userObj = jQuery.parseJSON(response)

      if ('' !== userObj.result_user && 0 < userObj.result_user.length) {
        if ('connections' === pageType) {
          var userListDiv = '#connections-user-list'
          var userCardDiv = 'amp-item-col'
          var userCardInnerDiv = 'amp-item-inner'
          var userCardCoverDiv = 'amp-item-cover'
          var userRemoveIconDiv = 'amp-action-remove'
          var userCardInfoDiv = 'amp-item-info'
          var userCardAvtarDiv = 'amp-item-avtar'
          var userCardContentDiv = 'amp-item-content'
        } else {
          var userListDiv = '#search-user-list'
          var userCardDiv = 'search-item'
          var userCardInnerDiv = 'search-item-inner'
          var userCardCoverDiv = 'search-item-cover'
          var userRemoveIconDiv = ''
          var userCardInfoDiv = 'search-item-info'
          var userCardAvtarDiv = 'search-item-avtar'
          var userCardContentDiv = 'search-item-content'
        }

        jQuery.each(userObj.result_user, function (key, value) {
          let searchItemDiv = document.createElement('div')
          searchItemDiv.setAttribute('class', userCardDiv)

          let searchItemInner = document.createElement('div')
          searchItemInner.setAttribute('class', userCardInnerDiv)

          if (
            'connections' === pageType &&
            undefined !== value.cancel_friendship_button &&
            '' !== value.cancel_friendship_button
          ) {
            let cancelFriendshipButton = document.createElement('div')
            cancelFriendshipButton.setAttribute('class', userRemoveIconDiv)
            cancelFriendshipButton.innerHTML = value.cancel_friendship_button
            searchItemInner.appendChild(cancelFriendshipButton)
          }

          let searchItemCover = document.createElement('div')
          searchItemCover.setAttribute('class', userCardCoverDiv)

          let coverImg = document.createElement('img')
          coverImg.setAttribute('src', value.cover_img)
          coverImg.setAttribute('alt', 'Cover Image')

          searchItemCover.appendChild(coverImg)
          searchItemInner.appendChild(searchItemCover)

          let searchItemInfo = document.createElement('div')
          searchItemInfo.setAttribute('class', userCardInfoDiv)

          let avatarDiv = document.createElement('div')
          avatarDiv.setAttribute('class', userCardAvtarDiv)

          avatarImgLink = document.createElement('a')
          avatarImgLink.setAttribute('href', value.link)
          avatarImgLink.innerHTML = value.avatar

          avatarDiv.appendChild(avatarImgLink)
          searchItemInfo.appendChild(avatarDiv)

          let searchContent = document.createElement('div')
          searchContent.setAttribute('class', userCardContentDiv)

          let userName = document.createElement('h4')

          nameLink = document.createElement('a')
          nameLink.setAttribute('href', value.link)
          nameLink.innerText = value.name

          userName.appendChild(nameLink)
          searchContent.appendChild(userName)

          let userCompany = document.createElement('span')
          userCompany.setAttribute('class', 'company-name')
          userCompany.innerText =
            '' !== value.title
              ? value.title + ' | ' + value.company
              : value.company

          searchContent.appendChild(userCompany)

          if (
            0 <
            jQuery('.search-result-filter .search-form input[name="s"]').length
          ) {
            let viewSearchAction = document.createElement('div')
            viewSearchAction.setAttribute('class', 'search-actions')

            let viewButton = document.createElement('a')
            viewButton.setAttribute('href', value.link)
            viewButton.setAttribute('class', 'button')
            viewButton.innerText = 'View'

            viewSearchAction.appendChild(viewButton)
            searchContent.appendChild(viewSearchAction)
          }

          if (undefined !== value.action_button && '' !== value.action_button) {
            let searchAction = document.createElement('div')
            searchAction.setAttribute('class', 'search-actions')
            searchAction.innerHTML = value.action_button

            searchContent.appendChild(searchAction)
          }

          searchItemInfo.appendChild(searchContent)
          searchItemInner.appendChild(searchItemInfo)
          searchItemDiv.appendChild(searchItemInner)

          jQuery(userListDiv).append(searchItemDiv)

          if (value.banner) {
            jQuery(userListDiv).append(value.banner)
          }
        })
      }
      jQuery('#load-more-user a').attr(
        'data-page-number',
        userObj.next_page_number
      )

      if (userObj.next_page_number > userObj.total_page) {
        jQuery('#load-more-user').hide()
      } else {
        jQuery('#load-more-user').show()
      }

      if (0 === userObj.total_page) {
        jQuery(userListDiv)
          .empty()
          .parents('.nab-search-result-wrapper')
          .find('p.no-search-data')
          .show()
      } else {
        jQuery(userListDiv)
          .parents('.nab-search-result-wrapper')
          .find('p.no-search-data')
          .hide()
      }

      if (0 !== jQuery('.search-view-top-head .user-search-count').length) {
        jQuery('.search-view-top-head .user-search-count').text(
          userObj.total_user + ' Results for '
        )
      }

      jQuery('body').removeClass('is-loading')
    }
  })
}

/** company search ajax */
function nabSearchCompanyAjax (loadMore, pageNumber) {
  let category
  let postPerPage = jQuery('#load-more-company a').attr('data-post-limit')
    ? parseInt(jQuery('#load-more-company a').attr('data-post-limit'))
    : 12
  let searchTerm =
    0 < jQuery('.search-result-filter .search-form input[name="s"]').length
      ? jQuery('.search-result-filter .search-form input[name="s"]').val()
      : ''
  let orderBy =
    0 < jQuery('.other-search-filter .sort-company a.active').length
      ? jQuery('.other-search-filter .sort-company a.active').attr('data-order')
      : 'meta'

  if (0 < jQuery('.other-search-filter #company-category-filter').length) {
    category =
      0 ===
      jQuery('.other-search-filter #company-category-filter')[0].selectedIndex
        ? ''
        : jQuery('.other-search-filter #company-category-filter').val()
  }

  jQuery('body').addClass('is-loading')

  jQuery.ajax({
    url: amplifyJS.ajaxurl,
    type: 'POST',
    data: {
      action: 'nab_company_search_filter',
      nabNonce: amplifyJS.nabNonce,
      page_number: pageNumber,
      post_limit: postPerPage,
      search_term: searchTerm,
      product_category: category,
      orderby: orderBy
    },
    success: function (response) {
      if (!loadMore) {
        jQuery('#search-company-list').empty()
      }
      let companyObj = jQuery.parseJSON(response)

      if ('' !== companyObj.result_post && 0 < companyObj.result_post.length) {
        let companyListDiv = document.getElementById('search-company-list')

        jQuery.each(companyObj.result_post, function (key, value) {
          let searchItemDiv = document.createElement('div')
          searchItemDiv.setAttribute('class', 'search-item')

          let searchItemInner = document.createElement('div')
          searchItemInner.setAttribute('class', 'search-item-inner')

          let searchItemCover = document.createElement('div')
          searchItemCover.setAttribute('class', 'search-item-cover')

          let coverImg = document.createElement('img')
          coverImg.setAttribute('src', value.cover_img)
          coverImg.setAttribute('alt', 'Cover Image')

          searchItemCover.appendChild(coverImg)

          searchItemInner.appendChild(searchItemCover)

          let searchItemInfo = document.createElement('div')
          searchItemInfo.setAttribute('class', 'search-item-info')

          let searchItemProfile = document.createElement('div')
          searchItemProfile.setAttribute('class', 'search-item-avtar')

          let avatarLink = document.createElement('a')
          avatarLink.setAttribute('href', value.link)

          let companyProfile

          if (undefined !== value.profile) {
            companyProfile = document.createElement('img')
            companyProfile.setAttribute('src', value.profile)
          } else {
            companyProfile = document.createElement('div')
            companyProfile.setAttribute('class', 'no-image-avtar')
            companyProfile.innerText = value.no_pic
          }

          avatarLink.appendChild(companyProfile)
          searchItemProfile.appendChild(avatarLink)
          searchItemInfo.appendChild(searchItemProfile)

          let searchContent = document.createElement('div')
          searchContent.setAttribute('class', 'search-item-content')

          let companyTitle = document.createElement('h4')

          let companyTitleLink = document.createElement('a')
          companyTitleLink.setAttribute('href', value.link)
          companyTitleLink.innerText = value.title

          companyTitle.appendChild(companyTitleLink)
          searchContent.appendChild(companyTitle)

          let searchAction = document.createElement('div')
          searchAction.setAttribute('class', 'amp-actions')
          searchAction.innerHTML = value.button

          searchContent.appendChild(searchAction)

          searchItemInfo.appendChild(searchContent)
          searchItemInner.appendChild(searchItemInfo)
          searchItemDiv.appendChild(searchItemInner)

          companyListDiv.appendChild(searchItemDiv)

          if (value.banner) {
            jQuery('#search-company-list').append(value.banner)
          }
        })
      }
      jQuery('#load-more-company a').attr(
        'data-page-number',
        companyObj.next_page_number
      )

      if (companyObj.next_page_number > companyObj.total_page) {
        jQuery('#load-more-company').hide()
      } else {
        jQuery('#load-more-company').show()
      }

      if (0 === companyObj.total_page) {
        jQuery('#search-company-list')
          .empty()
          .parents('.nab-search-result-wrapper')
          .find('p.no-search-data')
          .show()
      } else {
        jQuery('#search-company-list')
          .parents('.nab-search-result-wrapper')
          .find('p.no-search-data')
          .hide()
      }

      jQuery('.search-view-top-head .company-search-count').text(
        companyObj.total_company + ' Results for '
      )

      jQuery('body').removeClass('is-loading')
    }
  })
}

/** company product search ajax */
function nabSearchCompanyProductAjax (loadMore, pageNumber) {
  let category
  let postPerPage = jQuery('#load-more-company-product a').attr(
    'data-post-limit'
  )
    ? parseInt(jQuery('#load-more-company-product a').attr('data-post-limit'))
    : 12
  let searchTerm =
    0 < jQuery('.search-result-filter .search-form input[name="s"]').length
      ? jQuery('.search-result-filter .search-form input[name="s"]').val()
      : ''
  let orderBy =
    0 < jQuery('.other-search-filter .sort-company-product a.active').length
      ? jQuery('.other-search-filter .sort-company-product a.active').attr(
          'data-order'
        )
      : 'date'

  if (0 < jQuery('.other-search-filter #company-product-category').length) {
    category =
      0 ===
      jQuery('.other-search-filter #company-product-category')[0].selectedIndex
        ? ''
        : jQuery('.other-search-filter #company-product-category').val()
  }

  jQuery('body').addClass('is-loading')

  jQuery.ajax({
    url: amplifyJS.ajaxurl,
    type: 'POST',
    data: {
      action: 'nab_company_product_search_filter',
      nabNonce: amplifyJS.nabNonce,
      page_number: pageNumber,
      post_limit: postPerPage,
      search_term: searchTerm,
      product_category: category,
      orderby: orderBy
    },
    success: function (response) {
      if (!loadMore) {
        jQuery('#company-products-list').empty()
      }
      let productObj = jQuery.parseJSON(response)

      if ('' !== productObj.result_post && 0 < productObj.result_post.length) {
        let productListDiv = document.getElementById('company-products-list')

        jQuery.each(productObj.result_post, function (key, value) {
          let searchItemDiv = document.createElement('div')
          searchItemDiv.setAttribute('class', 'amp-item-col')

          let searchItemInner = document.createElement('div')
          searchItemInner.setAttribute('class', 'amp-item-inner')

          let searchItemCover = document.createElement('div')
          searchItemCover.setAttribute('class', 'amp-item-cover')

          let coverImg = document.createElement('img')
          coverImg.setAttribute('src', value.thumbnail)
          coverImg.setAttribute('alt', 'Product Image')

          searchItemCover.appendChild(coverImg)

          if (value.bookmark_class) {
            let bookmarkSpan = document.createElement('span')

            bookmarkSpan.setAttribute('class', value.bookmark_class)
            bookmarkSpan.setAttribute('data-bp-tooltip', value.bookmark_tooltip)
            bookmarkSpan.setAttribute('data-product', value.bookmark_id)

            searchItemCover.appendChild(bookmarkSpan)
          }

          searchItemInner.appendChild(searchItemCover)

          let searchItemInfo = document.createElement('div')
          searchItemInfo.setAttribute('class', 'amp-item-info')

          let searchContent = document.createElement('div')
          searchContent.setAttribute('class', 'amp-item-content')

          let porductTitle = document.createElement('h4')

          let productTitleLink = document.createElement('a')
          productTitleLink.setAttribute('href', value.link)
          productTitleLink.innerText = value.title

          porductTitle.appendChild(productTitleLink)

          let productCompany = document.createElement('span')
          productCompany.setAttribute('class', 'product-company')
          productCompany.innerText = value.company

          searchContent.appendChild(porductTitle)
          searchContent.appendChild(productCompany)

          let searchActionWrap = document.createElement('div')
          searchActionWrap.setAttribute('class', 'amp-actions nab-action')

          let searchAction = document.createElement('div')
          searchAction.setAttribute('class', 'search-actions')

          let viewProdutLink = document.createElement('a')
          viewProdutLink.setAttribute('href', value.link)
          viewProdutLink.setAttribute('class', 'button')
          viewProdutLink.innerText = 'View'

          searchAction.appendChild(viewProdutLink)
          searchActionWrap.appendChild(searchAction)
          searchContent.appendChild(searchActionWrap)

          searchItemInfo.appendChild(searchContent)
          searchItemInner.appendChild(searchItemInfo)
          searchItemDiv.appendChild(searchItemInner)

          productListDiv.appendChild(searchItemDiv)

          if (value.banner) {
            jQuery('#company-products-list').append(value.banner)
          }
        })
      }
      jQuery('#load-more-company-product a').attr(
        'data-page-number',
        productObj.next_page_number
      )

      if (productObj.next_page_number > productObj.total_page) {
        jQuery('#load-more-company-product').hide()
      } else {
        jQuery('#load-more-company-product').show()
      }

      if (0 === productObj.total_page) {
        jQuery('#company-products-list')
          .empty()
          .parents('.nab-search-result-wrapper')
          .find('p.no-search-data')
          .show()
      } else {
        jQuery('#company-products-list')
          .parents('.nab-search-result-wrapper')
          .find('p.no-search-data')
          .hide()
      }

      jQuery('.search-view-top-head .company-product-search-count').text(
        productObj.total_product + ' Results for '
      )

      jQuery('body').removeClass('is-loading')
    }
  })
}

/** Product Search Ajax */
function nabSearchProductAjax (loadMore, pageNumber) {
  let category = ''
  let postPerPage = jQuery('#load-more-product a').attr('data-post-limit')
    ? parseInt(jQuery('#load-more-product a').attr('data-post-limit'))
    : 12
  let searchTerm =
    0 < jQuery('.search-result-filter .search-form input[name="s"]').length
      ? jQuery('.search-result-filter .search-form input[name="s"]').val()
      : ''
  let orderBy =
    0 < jQuery('.other-search-filter .sort-product a.active').length
      ? jQuery('.other-search-filter .sort-product a.active').attr('data-order')
      : 'popularity'
  if (0 < jQuery('.other-search-filter #product-category').length) {
    category =
      0 === jQuery('.other-search-filter #product-category')[0].selectedIndex
        ? ''
        : jQuery('.other-search-filter #product-category').val()
  }

  jQuery('body').addClass('is-loading')

  jQuery.ajax({
    url: amplifyJS.ajaxurl,
    type: 'POST',
    data: {
      action: 'nab_product_search_filter',
      nabNonce: amplifyJS.nabNonce,
      page_number: pageNumber,
      post_limit: postPerPage,
      search_term: searchTerm,
      category: category,
      orderby: orderBy
    },
    success: function (response) {
      if (!loadMore) {
        jQuery('#search-product-list').empty()
      }
      let productObj = jQuery.parseJSON(response)

      if ('' !== productObj.result_post && 0 < productObj.result_post.length) {
        let productListDiv = document.getElementById('search-product-list')

        jQuery.each(productObj.result_post, function (key, value) {
          let searchItemDiv = document.createElement('div')
          searchItemDiv.setAttribute('class', 'search-item')

          let searchItemInner = document.createElement('div')
          searchItemInner.setAttribute('class', 'search-item-inner')

          let searchItemCover = document.createElement('div')
          searchItemCover.setAttribute('class', 'search-item-cover')

          let coverImg = document.createElement('img')
          coverImg.setAttribute('src', value.thumbnail)
          coverImg.setAttribute('alt', 'product thumbnail')

          searchItemCover.appendChild(coverImg)

          if (value.bookmark_class) {
            let bookmarkSpan = document.createElement('span')

            bookmarkSpan.setAttribute('class', value.bookmark_class)
            bookmarkSpan.setAttribute('data-bp-tooltip', value.bookmark_tooltip)
            bookmarkSpan.setAttribute('data-product', value.bookmark_id)

            searchItemCover.appendChild(bookmarkSpan)
          }

          searchItemInner.appendChild(searchItemCover)

          let searchItemInfo = document.createElement('div')
          searchItemInfo.setAttribute('class', 'search-item-info')

          let searchContent = document.createElement('div')
          searchContent.setAttribute('class', 'search-item-content')

          let porductTitle = document.createElement('h4')

          let productTitleLink = document.createElement('a')
          productTitleLink.setAttribute('href', value.link)
          productTitleLink.innerText = value.title

          porductTitle.appendChild(productTitleLink)

          searchContent.appendChild(porductTitle)

          let searchAction = document.createElement('div')
          searchAction.setAttribute('class', 'search-actions')

          let viewProdutLink = document.createElement('a')
          viewProdutLink.setAttribute('href', value.link)
          viewProdutLink.setAttribute('class', 'button')
          viewProdutLink.innerText = 'View Product'

          searchAction.appendChild(viewProdutLink)
          searchContent.appendChild(searchAction)

          searchItemInfo.appendChild(searchContent)
          searchItemInner.appendChild(searchItemInfo)
          searchItemDiv.appendChild(searchItemInner)

          productListDiv.appendChild(searchItemDiv)

          if (value.banner) {
            jQuery('#search-product-list').append(value.banner)
          }
        })
      }
      jQuery('#load-more-product a').attr(
        'data-page-number',
        productObj.next_page_number
      )

      if (productObj.next_page_number > productObj.total_page) {
        jQuery('#load-more-product').hide()
      } else {
        jQuery('#load-more-product').show()
      }

      if (0 === productObj.total_page) {
        jQuery('#search-product-list')
          .empty()
          .parents('.nab-search-result-wrapper')
          .find('p.no-search-data')
          .show()
      } else {
        jQuery('#search-product-list')
          .parents('.nab-search-result-wrapper')
          .find('p.no-search-data')
          .hide()
      }

      jQuery('.search-view-top-head .product-search-count').text(
        productObj.total_product + ' Results for '
      )

      jQuery('body').removeClass('is-loading')
    }
  })
}

/** Event Search Ajax */
function nabSearchEventAjax (loadMore, pageNumber) {
  let postPerPage = jQuery('#load-more-event a').attr('data-post-limit')
    ? parseInt(jQuery('#load-more-event a').attr('data-post-limit'))
    : 12
  let searchTerm =
    0 < jQuery('.search-result-filter .search-form input[name="s"]').length
      ? jQuery('.search-result-filter .search-form input[name="s"]').val()
      : ''
  let eventType =
    0 < jQuery('.other-search-filter .event-type a.active').length
      ? jQuery('.other-search-filter .event-type a.active').attr('data-event')
      : 'upcoming'

  jQuery('body').addClass('is-loading')

  jQuery.ajax({
    url: amplifyJS.ajaxurl,
    type: 'POST',
    data: {
      action: 'nab_event_search_filter',
      nabNonce: amplifyJS.nabNonce,
      page_number: pageNumber,
      post_limit: postPerPage,
      search_term: searchTerm,
      event_type: eventType
    },
    success: function (response) {
      if (!loadMore) {
        jQuery('#search-event-list').empty()
      }
      let eventObj = jQuery.parseJSON(response)

      if ('' !== eventObj.result_post && 0 < eventObj.result_post.length) {
        let contentListDiv = document.getElementById('search-event-list')

        jQuery.each(eventObj.result_post, function (key, value) {
          let searchItemDiv = document.createElement('div')
          searchItemDiv.setAttribute('class', 'search-item')

          let searchItemInner = document.createElement('div')
          searchItemInner.setAttribute('class', 'search-item-inner')

          let searchItemCover = document.createElement('div')
          searchItemCover.setAttribute('class', 'search-item-cover')

          if ( undefined !== value.past_event && value.past_event ) {
            let labelWrapper = document.createElement('div');
            labelWrapper.setAttribute('class', 'amp-draft-wrapper');

            let lableSpan = document.createElement('span');
            lableSpan.setAttribute('class', 'company-product-draft');
            lableSpan.innerText = 'Past Event';

            labelWrapper.appendChild(lableSpan);
            searchItemCover.appendChild(labelWrapper);
          }

          let coverImg = document.createElement('img')
          coverImg.setAttribute('src', value.thumbnail)
          coverImg.setAttribute('alt', 'event thumbnail')

          searchItemCover.appendChild(coverImg)
          searchItemInner.appendChild(searchItemCover)

          let searchItemInfo = document.createElement('div')
          searchItemInfo.setAttribute('class', 'search-item-info')

          let searchContent = document.createElement('div')
          searchContent.setAttribute('class', 'search-item-content')

          let postTitle = document.createElement('h4')

          let postTitleLink = document.createElement('a')
          postTitleLink.setAttribute('href', value.link)
          postTitleLink.innerText = value.title

          if (value.target) {
            postTitleLink.setAttribute('target', value.target)
          }

          postTitle.appendChild(postTitleLink)

          searchContent.appendChild(postTitle)

          postSubTitle = document.createElement('span')
          postSubTitle.setAttribute('class', 'company-name')
          postSubTitle.innerText = value.event_date

          searchContent.appendChild(postSubTitle)

          let searchAction = document.createElement('div')
          searchAction.setAttribute('class', 'search-actions')

          let viewPostLink = document.createElement('a')
          viewPostLink.setAttribute('href', value.link)
          viewPostLink.setAttribute('class', 'button')
          viewPostLink.innerText = 'View'

          if (value.target) {
            viewPostLink.setAttribute('target', value.target)
          }

          searchAction.appendChild(viewPostLink)
          searchContent.appendChild(searchAction)

          searchItemInfo.appendChild(searchContent)
          searchItemInner.appendChild(searchItemInfo)
          searchItemDiv.appendChild(searchItemInner)

          contentListDiv.appendChild(searchItemDiv)

          if (value.banner) {
            jQuery('#search-event-list').append(value.banner)
          }
        })
      }
      jQuery('#load-more-event a').attr(
        'data-page-number',
        eventObj.next_page_number
      )

      if (eventObj.next_page_number > eventObj.total_page) {
        jQuery('#load-more-event').hide()
      } else {
        jQuery('#load-more-event').show()
      }

      if (0 === eventObj.total_page) {
        jQuery('#search-event-list')
          .empty()
          .parents('.nab-search-result-wrapper')
          .find('p.no-search-data')
          .show()
      } else {
        jQuery('#search-event-list')
          .parents('.nab-search-result-wrapper')
          .find('p.no-search-data')
          .hide()
      }

      jQuery('.search-view-top-head .event-search-count').text(
        eventObj.total_event + ' Results for '
      )

      jQuery('body').removeClass('is-loading')
    }
  })
}

/** Content Search Ajax */
function nabSearchContentAjax (loadMore, pageNumber) {
  let community = '',
    subject = '',
    contentType = ''
  let postPerPage = jQuery('#load-more-content a').attr('data-post-limit')
    ? parseInt(jQuery('#load-more-content a').attr('data-post-limit'))
    : 12
  let searchTerm =
    0 < jQuery('.search-result-filter .search-form input[name="s"]').length
      ? jQuery('.search-result-filter .search-form input[name="s"]').val()
      : ''
  let orderBy =
    0 < jQuery('.other-search-filter .sort-content a.active').length
      ? jQuery('.other-search-filter .sort-content a.active').attr('data-order')
      : 'date'

  if (0 < jQuery('.other-search-filter #content-community').length) {
    community =
      0 === jQuery('.other-search-filter #content-community')[0].selectedIndex
        ? ''
        : jQuery('.other-search-filter #content-community').val()
  }
  if (0 < jQuery('.other-search-filter #content-subject').length) {
    subject =
      0 === jQuery('.other-search-filter #content-subject')[0].selectedIndex
        ? ''
        : jQuery('.other-search-filter #content-subject').val()
  }
  if (0 < jQuery('.other-search-filter #content-type').length) {
    contentType =
      0 === jQuery('.other-search-filter #content-type')[0].selectedIndex
        ? ''
        : jQuery('.other-search-filter #content-type').val()
  }

  jQuery('body').addClass('is-loading')

  jQuery.ajax({
    url: amplifyJS.ajaxurl,
    type: 'POST',
    data: {
      action: 'nab_content_search_filter',
      nabNonce: amplifyJS.nabNonce,
      page_number: pageNumber,
      post_limit: postPerPage,
      search_term: searchTerm,
      community: community,
      subject: subject,
      content_type: contentType,
      orderby: orderBy
    },
    success: function (response) {
      if (!loadMore) {
        jQuery('#search-content-list').empty()
      }
      let contentObj = jQuery.parseJSON(response)

      if ('' !== contentObj.result_post && 0 < contentObj.result_post.length) {
        let contentListDiv = document.getElementById('search-content-list')

        jQuery.each(contentObj.result_post, function (key, value) {
          let searchItemDiv = document.createElement('div')
          searchItemDiv.setAttribute('class', 'search-item')

          let searchItemInner = document.createElement('div')
          searchItemInner.setAttribute('class', 'search-item-inner')

          let searchItemCover = document.createElement('div')
          searchItemCover.setAttribute('class', 'search-item-cover')

          let coverImg = document.createElement('img')
          coverImg.setAttribute('src', value.thumbnail)
          coverImg.setAttribute('alt', 'content thumbnail')

          searchItemCover.appendChild(coverImg)
          searchItemInner.appendChild(searchItemCover)

          let searchItemInfo = document.createElement('div')
          searchItemInfo.setAttribute('class', 'search-item-info')

          let searchContent = document.createElement('div')
          searchContent.setAttribute('class', 'search-item-content')

          let postTitle = document.createElement('h4')

          let postTitleLink = document.createElement('a')
          postTitleLink.setAttribute('href', value.link)
          postTitleLink.innerText = value.title

          if (value.target) {
            postTitleLink.setAttribute('target', value.target)
          }

          postTitle.appendChild(postTitleLink)

          searchContent.appendChild(postTitle)

          let searchAction = document.createElement('div')
          searchAction.setAttribute('class', 'search-actions')

          let viewPostLink = document.createElement('a')
          viewPostLink.setAttribute('href', value.link)
          viewPostLink.setAttribute('class', 'button')
          viewPostLink.innerText = 'View'

          if (value.target) {
            viewPostLink.setAttribute('target', value.target)
          }

          searchAction.appendChild(viewPostLink)
          searchContent.appendChild(searchAction)

          searchItemInfo.appendChild(searchContent)
          searchItemInner.appendChild(searchItemInfo)
          searchItemDiv.appendChild(searchItemInner)

          contentListDiv.appendChild(searchItemDiv)

          if (value.banner) {
            jQuery('#search-content-list').append(value.banner)
          }
        })
      }
      jQuery('#load-more-content a').attr(
        'data-page-number',
        contentObj.next_page_number
      )

      if (contentObj.next_page_number > contentObj.total_page) {
        jQuery('#load-more-content').hide()
      } else {
        jQuery('#load-more-content').show()
      }

      if (0 === contentObj.total_page) {
        jQuery('#search-content-list')
          .empty()
          .parents('.nab-search-result-wrapper')
          .find('p.no-search-data')
          .show()
      } else {
        jQuery('#search-content-list')
          .parents('.nab-search-result-wrapper')
          .find('p.no-search-data')
          .hide()
      }

      jQuery('.search-view-top-head .content-search-count').text(
        contentObj.total_content + ' Results for '
      )

      jQuery('body').removeClass('is-loading')
    }
  })
}
