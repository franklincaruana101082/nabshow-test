/**
 * Amplify Public front side javascripts codes are written in this file.
 *
 *  @package Nab
 */
(function ($) {
  var importErrs = [];
  var skippedErrs = [];
  var addedAttendee = 0;

  if (typeof jQuery.cookie("new_company_admin_popup") != "undefined") {
    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      type: "POST",
      data: {
        action: "nab_add_company_admin_popup",
        company_id: amplifyJS.postID,
      },
      success: function (data) {
        if (0 === $("#addAdminModal").length) {
          $("body").append(data);
          $("#addAdminModal").show();
          $("body").addClass("connection-popup-added");
        } else {
          $("body").addClass("connection-popup-added");
          $("#addAdminModal").remove();
          $("body").append(data);
          $("#addAdminModal").show();
        }
        jQuery.removeCookie("new_company_admin_popup", { path: "/" });
      },
    });
  }

  // Ready.
  $(document).ready(function () {
    $(".section-professional-details .user-job-role-select").select2({
      width: "100%",
    });
    $(".section-professional-details .user-industry-select").select2({
      width: "100%",
    });

    $(".section-professional-details .user-country-select").select2({
      placeholder: "Select a country",
      width: "100%",
    });

    $(".section-professional-details .user-state-select").select2({
      placeholder: "Select a state",
      width: "100%",
    });

    $(".nab-custom-select select").select2({ width: "100%" });

    $(document).on("change", ".signup-privacy-policy", function () {
      if (this.checked) {
        $(this)
          .parents(".nab-normal-signup")
          .find(".woocommerce-form-register__submit")
          .removeAttr("disabled");
      } else {
        $(this)
          .parents(".nab-normal-signup")
          .find(".woocommerce-form-register__submit")
          .attr("disabled", "disabled");
      }
    });

    if (0 < $("#user-country-select").length) {
      var wc_states_json = wc_country_select_params.countries.replace(
        /&quot;/g,
        '"'
      );
      var wc_states = $.parseJSON(wc_states_json);
      $(document).on("change", "#user-country-select", function () {
        console.log(wc_states[$(this).val()]);

        var state = wc_states[$(this).val()];
        $(".section-professional-details .user-state-select").empty();

        $.each(state, function (index) {
          var $option = $("<option></option>")
            .prop("value", index)
            .text(state[index]);
          $(".section-professional-details .user-state-select").append($option);
        });

        $(".section-professional-details .user-state-select").val("").change();
      });
    }

    $(document).on("click", ".notification-wrapper", function () {
      $(this).toggleClass("hover");
    });

    $(document).on("click", ".amp-item-col *, .search-item *", function (e) {
      e.stopPropagation();
      const _card = $(this).parents(".amp-item-col").length
        ? $(this).parents(".amp-item-col")
        : $(this).parents(".search-item");
      if (
        0 === $(this).closest("a").length &&
        0 === $(this).closest(".fa").length
      ) {
        var profileURL = "";
        if (_card.find("h4 a").length) {
          profileURL = _card.find("h4 a").attr("href");
        } else {
          profileURL = _card.find(".amp-item-avtar a").attr("href");
        }
        if (
          undefined !== profileURL &&
          -1 < profileURL.indexOf("members") &&
          -1 === profileURL.indexOf("wpnonce")
        ) {
          window.location.href = profileURL;
        }
      }
    });

    if (
      typeof amplifyJS !== "undefined" &&
      amplifyJS.postType === "company" &&
      jQuery.inArray(
        parseInt(amplifyJS.CurrentLoggedUser),
        amplifyJS.CompanyAdminId
      ) !== -1
    ) {
      jQuery(".edit-feature-block").show();
    } else {
      jQuery(".edit-feature-block").hide();
    }

    HeaderResponsive();

    $(window).on("resize", function () {
      HeaderResponsive();
    });

    // Remove Billing form if no payment method available/required in checkout.
    $(document.body).on("updated_checkout", function () {
      if (0 === $("ul.wc_payment_methods").length) {
        $(
          ".woocommerce-billing-fields__field-wrapper p:not(.bill-mandatory)"
        ).remove();
      } else if (0 === $("#billing_country_field").length) {
        /**
         * If bill is not 0.00 and the billing_country_field is missing,
         * reload the page to get all other fields.
         */
        $("#place_order").attr("disabled");
        location.reload();
      }
    });

    if (0 < $(".is_friend .remove").length) {
      let nabModal = document.createElement("div");
      nabModal.setAttribute("class", "nab-modal");
      nabModal.setAttribute("id", "unfriend-confirmation");

      let nabModalInner = document.createElement("div");
      nabModalInner.setAttribute("class", "nab-modal-inner");
      nabModal.appendChild(nabModalInner);

      let nabModalContent = document.createElement("div");
      nabModalContent.setAttribute("class", "modal-content");
      nabModalInner.appendChild(nabModalContent);

      let nabModalClose = document.createElement("span");
      nabModalClose.setAttribute(
        "class",
        "nab-modal-close fa fa-times confirmed-answer"
      );
      nabModalClose.setAttribute("id", "confirmed-no");
      nabModalContent.appendChild(nabModalClose);

      let nabModalContentWrap = document.createElement("div");
      nabModalContentWrap.setAttribute("class", "modal-content-wrap");
      nabModalContent.appendChild(nabModalContentWrap);

      let confimPopupPara = document.createElement("p");
      confimPopupPara.innerHTML = "Do you really want to remove connection?";
      nabModalContentWrap.appendChild(confimPopupPara);

      let confimPopupYes = document.createElement("a");
      confimPopupYes.setAttribute("href", "javascript:void(0);");
      confimPopupYes.setAttribute("id", "confirmed-yes");
      confimPopupYes.setAttribute("class", "confirmed-answer button");
      confimPopupYes.innerHTML = "Yes";
      nabModalContentWrap.appendChild(confimPopupYes);

      let confimPopupNo = document.createElement("a");
      confimPopupNo.setAttribute("href", "javascript:void(0);");
      confimPopupNo.setAttribute("id", "confirmed-no");
      confimPopupNo.setAttribute("class", "confirmed-answer button");
      confimPopupNo.innerHTML = "No";
      nabModalContentWrap.appendChild(confimPopupNo);

      $("body").append(nabModal);
    }

    jQuery(".comments-order").on("change", function () {
      var url = window.location.href;
      var orderby = jQuery(this).val();
      var currentUrl = jQuery(this).attr("data-url");
      window.location.href = currentUrl + "/?orderby=" + orderby;
    });

    /* close popup */
    jQuery(document).on(
      "click",
      ".nab-modal-close, .nab-modal-remove",
      function () {
        if ($(this).parents(".nab-modal").hasClass("nab-modal-active")) {
          $(this).parents(".nab-modal").removeClass("nab-modal-active");
        } else {
          $(this).parents(".nab-modal").hide();
        }

        // Remove class added when connection request popup dispalyed.
        $("body").removeClass("connection-popup-added");
      }
    );

    jQuery(document).on("click touchstart", function (e) {
      if ($(e.target).is(".nab-modal-inner")) {
        var checkPopup = $(e.target).parents(".nab-modal");
        if (checkPopup.hasClass("nab-modal-active")) {
          checkPopup.removeClass("nab-modal-active");
        } else {
          checkPopup.hide();
        }
      }
    });

    /* Reaction Hide/Show */
    $(document).on(
      "click",
      ".reaction-list-type .reaction-main-like",
      function () {
        $(this).next(".reaction-icon-modal").toggleClass("show-icon-modal");
      }
    );

    $(".reaction-list-type")
      .mouseenter(function () {
        $(this).find(".reaction-icon-modal").toggleClass("show-icon-modal");
      })
      .mouseleave(function () {
        $(this).find(".reaction-icon-modal").removeClass("show-icon-modal");
      });

    $(document).on(
      "click",
      ".reaction-list-type .nab-reaction-type",
      function () {
        $(this).parents(".reaction-icon-modal").removeClass("show-icon-modal");
      }
    );

    jQuery(".nab-preview-item img").click(function () {
      var currentThumb = jQuery(this);
      $(".nab-preview-main img")
        .fadeOut(200, function () {
          jQuery(".nab-preview-main img").attr(
            "src",
            currentThumb.attr("src").replace("thumb", "large")
          );
        })
        .fadeIn(200);
    });
    jQuery("#product_categories").select2();
    jQuery("#company_point_of_contact").select2({
      ajax: {
        url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
        dataType: "json",
        delay: 250, // delay in ms while typing when to perform a AJAX search
        data: function (params) {
          return {
            q: params.term, // search query
            action: "nab_product_point_of_contact", // AJAX action for admin-ajax.php
          };
        },
        processResults: function (data) {
          var options = [];
          if (data) {
            // data is the array of arrays, and each of them contains ID and the Label of the option
            $.each(data, function (index, text) {
              // do not forget that "index" is just auto incremented value
              options.push({ id: text[0], text: text[1] });
            });
          }
          return {
            results: options,
          };
        },
        cache: true,
      },
      minimumInputLength: 3,
      placeholder: "Select Point of contact",
      allowClear: true,
    });
  });
  charcount("keyup", "#company_about", "#character-count-comp-about", 2000);
  charcount(
    "keyup",
    "#nab_featured_block_headline",
    "#character-count-featured-headline",
    200
  );
  charcount(
    "keyup",
    "#nab_featured_block_posted_by",
    "#character-count-featured-posyby",
    60
  );
  charcount(
    "keyup",
    "#nab_featured_block_description",
    "#character-count-featured-desc",
    200
  );
  charcount(
    "keyup",
    "#nab_featured_block_button_label",
    "#character-count-featured-btnlabel",
    60
  );

  function charcount(event, tag, counttag, limit) {
    jQuery(document).on(event, tag, function (e) {
      var len = jQuery(this).val().length;
      var cval = jQuery(this).val();
      var diff = limit - len;
      if (len >= limit) {
        cval = jQuery(this).text().substring(0, 250);
        jQuery(counttag).html("Maximum Characters Limit exeeds!");
      } else {
        jQuery(counttag).html("" + diff + " characters remianing");
      }
    });
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

   // sign up template memberpress popup
    $(document).on('change', '#signup-press-member', function(){
      if (this.checked) {
        $('#modal-member-press').addClass('nab-modal-active');
      }
    });

  function validateURL(urltext) {
    if (urltext !== "") {
      var rg = /^(https?|ftp):\/\/([a-zA-Z0-9.-]+(:[a-zA-Z0-9.&%$-]+)*@)*((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]?)(\.(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}|([a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(:[0-9]+)*(\/($|[a-zA-Z0-9.,?'\\+&%$#=~_-]+))*$/;
      return rg.test(urltext);
    } else {
      return true;
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

  function load_tinyMCE_withPlugins(tag, countTag, limit = 2000) {
    var d = new Date();
    var time = d.getTime();
    tinymce.init({
      selector: tag,
      plugins: ["link", "image", "lists"],
      menubar: false,
      statusbar: false,
      toolbar:
        "bold italic alignleft aligncenter alignright alignjustify bullist numlist outdent indent link unlink image",
      setup: function (editor) {
        editor.on("change keyup", function (e) {
          editor.save(); // updates this instance's textarea
          $(editor.getElement()).trigger("change"); // for garlic to detect change
          if (countTag) {
            var len = editor
              .getContent()
              .replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/gi, "").length;
            var cval = jQuery(tag).val();
            var diff = limit - len;
            if (len >= limit) {
              cval = jQuery(tag).text().substring(0, 250);
              jQuery(countTag).html("Maximum Characters Limit exeeds!");
            } else {
              jQuery(countTag).html("" + diff + " characters remianing");
            }
          }
        });
      },
      content_css:
        amplifyJS.ThemeUri + "/assets/css/nab-front-tinymce.css?ver=" + time,
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
    });
  }

  function addSuccessMsg(tag, message) {
    if (jQuery(tag).length) {
      if (tag === ".modal-content-wrap") {
        if (
          jQuery(".modal-content-wrap").find(".woocommerce-notices-wrapper")
            .length
        ) {
          jQuery(".modal-content-wrap")
            .find(".woocommerce-notices-wrapper")
            .remove();
          jQuery(tag).prepend(
            '<div class="woocommerce-notices-wrapper"><div class="woocommerce-message">' +
              message +
              '<span class="close-message fa fa-close"></span></div></div>'
          );
        } else {
          jQuery(tag).prepend(
            '<div class="woocommerce-notices-wrapper"><div class="woocommerce-message">' +
              message +
              '<span class="close-message fa fa-close"></span></div></div>'
          );
        }
      } else {
        if (
          jQuery(".modal-content-wrap").find(".woocommerce-notices-wrapper")
            .length
        ) {
          jQuery(".modal-content-wrap")
            .find(".woocommerce-notices-wrapper")
            .remove();
          jQuery(tag).after(
            '<div class="woocommerce-notices-wrapper"><div class="woocommerce-message">' +
              message +
              '<span class="close-message fa fa-close"></span></div></div>'
          );
        } else {
          jQuery(tag).after(
            '<div class="woocommerce-notices-wrapper"><div class="woocommerce-message">' +
              message +
              '<span class="close-message fa fa-close"></span></div></div>'
          );
        }
      }
    }
  }

  function defaultCharCount(tag, charTag, limit) {
    if (jQuery(tag).length > 0) {
      var prod_copy_content_length = jQuery(tag)
        .val()
        .replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/gi, "").length;
      var diff = limit - prod_copy_content_length;
      if (diff < 0) {
        jQuery(charTag).html("Maximum Characters Limit exeeds!");
      } else {
        jQuery(charTag).html("" + diff + " characters remianing");
      }
    }
  }

  function checkContentlength(tag, tagLabel, limit) {
    var tag_length = jQuery(tag)
      .val()
      .replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/gi, "").length;

    if (tag_length > limit) {
      alert(
        "The length of " +
          tagLabel +
          " is " +
          tag_length +
          " the max num of characters allowed for this content is " +
          limit +
          ""
      );
      $("body").removeClass("is-loading");
      return false;
    } else {
      return true;
    }
  }

  $(document).on("click", ".close-message", function () {
    jQuery(this).parents(".woocommerce-notices-wrapper").remove();
    jQuery("body").addClass("nab-close-reload");
  });

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

  $(document).on("click", ".action-edit ", function () {
    const prod_id = undefined !== $(this).data("id") ? $(this).data("id") : "";
    const company_id = amplifyJS.postID;
    const _this = $(this);
    _this.addClass("loading");
    jQuery.ajax({
      type: "POST",
      url: amplifyJS.ajaxurl,
      data: {
        action: "nab_amplify_edit_product",
        product_id: prod_id,
        company_id: company_id,
      },
      success: function (data) {
        _this.removeClass("loading");
        if (jQuery("#addProductModal").length === 0) {
          jQuery("body").append(data);
          jQuery("#addProductModal").show().addClass("nab-modal-active");

          // Make image draggable.
          $('#product_media_wrapper').sortable(function (){
            connectWith: '#product_media_wrapper'
          }).disableSelection();

          if (jQuery("#nab_company_id").length > 0) {
            jQuery("#nab_company_id").val(company_id);
          }
          jQuery("#product_categories").select2();
          jQuery("#company_point_of_contact").select2({
            ajax: {
              url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
              dataType: "json",
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {
                return {
                  q: params.term, // search query
                  action: "nab_product_point_of_contact", // AJAX action for admin-ajax.php
                };
              },
              processResults: function (data) {
                var options = [];
                if (data) {
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                  $.each(data, function (index, text) {
                    // do not forget that "index" is just auto incremented value
                    options.push({ id: text[0], text: text[1] });
                  });
                }
                return {
                  results: options,
                };
              },
              cache: true,
            },
            minimumInputLength: 3,
            placeholder: "Select Point of contact",
            allowClear: true,
          });
          load_tinyMCE_withPlugins("#nab_product_copy");
          load_tinyMCE_withPlugins(
            "#nab_product_specs",
            "#character-count-specs"
          );

          setTimeout(function () {
            if (jQuery("#nab_product_specs").length > 0) {
              var prod_specs_content_length = tinyMCE
                .get("nab_product_specs")
                .getContent()
                .replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/gi, "")
                .length;
              var diff = 2000 - prod_specs_content_length;
              if (diff < 0) {
                jQuery("#character-count-specs").html(
                  "Maximum Characters Limit exeeds!"
                );
              } else {
                jQuery("#character-count-specs").html(
                  "" + diff + " characters remianing"
                );
              }
            }
            charcount(
              "keyup",
              "#nab_product_specs",
              "#character-count-specs",
              2000
            );
          }, 1000);
        } else {
          jQuery("#addProductModal").remove();
          jQuery("body").append(data);
          jQuery("#addProductModal").show().addClass("nab-modal-active");
          if (jQuery("#nab_company_id").length > 0) {
            jQuery("#nab_company_id").val(company_id);
          }

          // Make image draggable.
          $('#product_media_wrapper').sortable(function (){
            connectWith: '#product_media_wrapper'
          }).disableSelection();

          jQuery("#product_categories").select2();
          jQuery("#company_point_of_contact").select2({
            ajax: {
              url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
              dataType: "json",
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {
                return {
                  q: params.term, // search query
                  action: "nab_product_point_of_contact", // AJAX action for admin-ajax.php
                };
              },
              processResults: function (data) {
                var options = [];
                if (data) {
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                  $.each(data, function (index, text) {
                    // do not forget that "index" is just auto incremented value
                    options.push({ id: text[0], text: text[1] });
                  });
                }
                return {
                  results: options,
                };
              },
              cache: true,
            },
            minimumInputLength: 3,
            placeholder: "Select Point of contact",
            allowClear: true,
          });
          load_tinyMCE_withPlugins("#nab_product_copy");
          load_tinyMCE_withPlugins(
            "#nab_product_specs",
            "#character-count-specs"
          );
          setTimeout(function () {
            if (jQuery("#nab_product_specs").length > 0) {
              var prod_specs_content_length = tinyMCE
                .get("nab_product_specs")
                .getContent()
                .replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/gi, "")
                .length;
              var diff = 2000 - prod_specs_content_length;
              if (diff < 0) {
                jQuery("#character-count-specs").html(
                  "Maximum Characters Limit exeeds!"
                );
              } else {
                jQuery("#character-count-specs").html(
                  "" + diff + " characters remianing"
                );
              }
            }
            charcount(
              "keyup",
              "#nab_product_specs",
              "#character-count-specs",
              2000
            );
          }, 1000);
        }
        $(".poduct-point-of-contact").select2({
          placeholder: "Select point of contact",
          allowClear: true,
        });
        $(".poduct-point-of-contact").select2({
          ajax: {
            url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
            dataType: "json",
            delay: 250, // delay in ms while typing when to perform a AJAX search
            data: function (params) {
              return {
                q: params.term, // search query
                action: "nab_product_point_of_contact", // AJAX action for admin-ajax.php
              };
            },
            processResults: function (data) {
              var options = [];
              if (data) {
                // data is the array of arrays, and each of them contains ID and the Label of the option
                $.each(data, function (index, text) {
                  // do not forget that "index" is just auto incremented value
                  options.push({ id: text[0], text: text[1] });
                });
              }
              return {
                results: options,
              };
            },
            cache: true,
          },
          minimumInputLength: 3,
          placeholder: "Select point of contact",
          allowClear: true,
        });
      },
    });
  });

  /* Add nab product ajax call */
  var remove_attachment_arr = [];
  $(document).on("click", ".nab-remove-attachment", function (e) {
    if (confirm("Are you sure want to remove?")) {
      remove_attachment_arr.push($(this).data("attach-id"));
      $(this).parent().remove();
    }
  });

  var remove_featured_attachment_arr = [];
  $(document).on("click", ".nab-remove-featured-attachment", function (e) {
    if (confirm("Are you sure want to remove?")) {
      remove_featured_attachment_arr.push($(this).data("action"));
      $(this).parent().remove();
    }
  });

  $(document).on("change", "#product_featured_image", function () {
    if (
      $("#product_featured_image_wrapper .nab-product-media-item").length >= 1
    ) {
      $("#product_featured_image_wrapper .nab-product-media-item").remove();
      $("#product_featured_image_wrapper").append(
        '<div class="nab-product-media-item" ><button type="button" class="nab-remove-attachment" data-attach-id="0"><i class="fa fa-times" aria-hidden="true"></i></button><img id="product_featured_preview" src="#" alt="your image" style="display:none;"/></div>'
      );
    } else {
      $("#product_featured_image_wrapper").append(
        '<div class="nab-product-media-item" ><button type="button" class="nab-remove-attachment" data-attach-id="0"><i class="fa fa-times" aria-hidden="true"></i></button><img id="product_featured_preview" src="#" alt="your image" style="display:none;"/></div>'
      );
    }
    if ($(this)[0].files && $(this)[0].files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#product_featured_preview").attr("src", e.target.result);
      };
      reader.readAsDataURL($(this)[0].files[0]);
      $(".preview_product_featured_image").show();
      $("#product_featured_preview").show();
    }
  });
  $(document).on("change", "#nab_product_play_image", function () {
    if ($(".preview_product_play_image .nab-product-media-item").length >= 1) {
      $(".preview_product_play_image .nab-product-media-item").remove();
      $(".preview_product_play_image").append(
        '<div class="nab-product-media-item" ><button type="button" class="nab-remove-attachment" data-attach-id="0"><i class="fa fa-times" aria-hidden="true"></i></button><img id="preview_product_play_image" src="#" alt="your image" style="display:none;"/></div>'
      );
    } else {
      $(".preview_product_play_image").append(
        '<div class="nab-product-media-item" ><button type="button" class="nab-remove-attachment" data-attach-id="0"><i class="fa fa-times" aria-hidden="true"></i></button><img id="preview_product_play_image" src="#" alt="your image" style="display:none;"/></div>'
      );
    }
    if ($(this)[0].files && $(this)[0].files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#preview_product_play_image").attr("src", e.target.result);
      };
      reader.readAsDataURL($(this)[0].files[0]);
      $(".preview_product_play_image").show();
      $("#preview_product_play_image").show();
    }
  });

  function removeFileFromFileList(index) {
    const dt = new DataTransfer();
    const input = document.getElementById("product_medias");
    const { files } = input;
    for (let i = 0; i < files.length; i++) {
      const file = files[i];
      if (index !== i) dt.items.add(file); // here you exclude the file. thus removing it.
      input.files = dt.files;
    }
  }

  var productMedia = [];
  $(document).on("change", "#product_medias", function (e) {
    var fileExtension = ["png", "jpg", "jpeg", "gif"];

    var global_media_count = jQuery(".nab-product-media-item").length;
    if (global_media_count < 5) {
      $.each($("#product_medias")[0].files, function (key, file) {
        if (
          $.inArray(file.name.split(".").pop().toLowerCase(), fileExtension) ==
          -1
        ) {
          get_error_popup('This file type is not supported here. Acceptable File Types: .jpeg, .jpg, .png.');
          return false;
        }
        var timestamp = Date.now();
        var unique_key = file.lastModified + "_" + timestamp;
        $("#product_media_wrapper").append(
          '<div class="nab-product-media-item" ><button type="button" class="nab-remove-attachment" data-attach-id="0"><i class="fa fa-times" aria-hidden="true"></i></button><img id="product_media_preview_' +
            unique_key +
            '" src="#" alt="your image" style="display:none;"/></div>'
        );
        var reader = new FileReader();
        reader.onload = function (e) {
          $("#product_media_preview_" + unique_key + "").attr(
            "src",
            e.target.result
          );
        };
        productMedia.push($(this));
        var media_count = jQuery(".nab-product-media-item").length;
        if (media_count < 5) {
          reader.readAsDataURL(file);
          $(".preview_product_featured_image").show();
          $("#product_media_preview_" + unique_key + "").show();
        } else {
          $("#product_media_preview_" + unique_key + "")
            .parent()
            .remove();
        }
      });
    }
  });

  $(document).on("click", "#nab-edit-product-draft", function () {
    nabProductAddUpdateAjax("draft");
  });

  $(document).on("click", "#nab-edit-product-delete", function () {
    nabProductAddUpdateAjax("trash");
  });

  $(document).on("click", "#nab-edit-product-submit", function () {
    nabProductAddUpdateAjax($(this).attr("data-status"));
  });

  function nabProductAddUpdateAjax(postStatus) {
    tinyMCE.triggerSave();

    var product_title = jQuery("#nab-edit-product-form #product_title").val();
    var product_categories = jQuery(
      "#nab-edit-product-form #product_categories"
    ).val();
    var nab_product_copy = jQuery(
      "#nab-edit-product-form #nab_product_copy"
    ).val();
    var nab_product_specs = jQuery(
      "#nab-edit-product-form #nab_product_specs"
    ).val();
    var nab_product_contact = 0 < jQuery("#nab-edit-product-form #nab_product_contact").length ? jQuery("#nab-edit-product-form #nab_product_contact").val() : '';
    var nab_feature_product = jQuery(
      "#nab-edit-product-form #nab_feature_product"
    ).prop("checked")
      ? 1
      : 0;
    var nab_product_b_stock = jQuery(
      "#nab-edit-product-form #nab_product_b_stock"
    ).prop("checked")
      ? 1
      : 0;
    var nab_product_sales_item = jQuery(
      "#nab-edit-product-form #nab_product_sales_item"
    ).prop("checked")
      ? 1
      : 0;
    var nab_product_tags = jQuery(
      "#nab-edit-product-form #nab_product_tags"
    ).val();
    var nab_product_discussion = jQuery(
      "#nab-edit-product-form #nab_product_discussion"
    ).prop("checked")
      ? 1
      : 0;
    var nab_product_learn_more_url = jQuery(
      "#nab-edit-product-form #nab_product_learn_more_url"
    ).val();
    var nab_product_id = jQuery("#nab-edit-product-form #nab_product_id").val();
    var nab_company_id = jQuery("#nab-edit-product-form #nab_company_id").val();

    var nab_product_specsLength = tinyMCE
      .get("nab_product_specs")
      .getContent()
      .replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/gi, "").length;
    if (nab_product_specsLength > 2000) {
      alert(
        "The length of product specs content is " +
          nab_product_specsLength +
          " the max num of characters allowed for this content is 2000"
      );
      return false;
    }

    var form_data = new FormData();

    // If bynder images selected.
    if( 'function' === typeof addBMpopup ) {
      let product_media_bm_src = [];
      let countImgs = 1;
      $('.nab-product-media-item img').each(function () {
        if( countImgs < 5 ) {
          product_media_bm_src.push($(this).attr('src'));
        }
        countImgs++;
      });
      product_media_bm_src = product_media_bm_src.join(',');
      form_data.append('product_media_bm', product_media_bm_src)
    } else {
      $.each(productMedia, function (key, file) {
        form_data.append(key, file[0]);
      })
    }

    if (product_title == "") {
      alert("Product title can not be empty!");
      return false;
    }
    form_data.append("action", "nab_add_product");
    form_data.append("product_title", product_title);
    if (product_categories == null) {
      form_data.append("product_categories", []);
    } else {
      form_data.append("product_categories", product_categories);
    }

    form_data.append("nabNonce", amplifyJS.nabNonce);
    form_data.append("nab_product_copy", nab_product_copy);
    form_data.append("nab_product_specs", nab_product_specs);
    form_data.append("nab_product_contact", nab_product_contact);
    form_data.append("nab_feature_product", nab_feature_product);
    form_data.append("nab_product_b_stock", nab_product_b_stock);
    form_data.append("nab_product_sales_item", nab_product_sales_item);
    form_data.append("nab_product_tags", nab_product_tags);
    form_data.append("nab_product_discussion", nab_product_discussion);
    form_data.append("nab_product_id", nab_product_id);

    if (!validateURL(nab_product_learn_more_url)) {
      addSuccessMsg(
        '.add-product-content-popup',
        'Please Enter Correct URL For Product Learn More!'
      );
      return false;
    } else {
      form_data.append('nab_product_learn_more_url', nab_product_learn_more_url);
    }

    form_data.append("product_status", postStatus);

    form_data.append("remove_attachments", remove_attachment_arr);
    form_data.append("nab_company_id", nab_company_id);

    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      processData: false,
      contentType: false,
      type: "POST",
      data: form_data,
      beforeSend: function () {
        $("body").addClass("is-loading");
      },
      success: function (response) {
        var json = $.parseJSON(response);
        if (json.success === true) {
          $("body").removeClass("is-loading");
          if ("trash" === postStatus) {
            $("#nab-edit-product-form .btn-submit").attr(
              "disabled",
              "disabled"
            );
          }
          if (json.publish_text) {
            $("#nab-edit-product-form #nab-edit-product-submit").val(
              json.publish_text
            );
            $("#nab-edit-product-form #nab-edit-product-submit").attr(
              "data-status",
              json.publish_text.toLowerCase()
            );
          }
          if (json.draft_text) {
            $("#nab-edit-product-form #nab-edit-product-draft").val(
              json.draft_text
            );
          }
          if (nab_product_id !== "0") {
            addSuccessMsg(".add-product-content-popup", json.content);
          } else {
            addSuccessMsg(".add-product-content-popup", json.content);
          }
          if (json.post_id) {
            $("#nab-edit-product-form #nab_product_id").val(json.post_id);
          }
        }
      },
    });
  }

  // Upload user images using ajax.
  $("#edit-social-profiles").on("click", function (e) {
    e.preventDefault();
    $(this).parent().addClass("loading");

    var fd = new FormData();
    var company_id = amplifyJS.postID;
    fd.append("action", "nab_edit_company_social_profiles");
    fd.append("company_id", amplifyJS.postID);

    jQuery.ajax({
      type: "POST",
      url: amplifyJS.ajaxurl,
      data: fd,
      contentType: false,
      processData: false,
      success: function (data) {
        if (jQuery("#addProductModal").length === 0) {
          jQuery("body").append(data);
          jQuery("#addProductModal").show().addClass("nab-modal-active");
          if (jQuery("#nab_company_id").length > 0) {
            jQuery("#nab_company_id").val(company_id);
          }
          jQuery("#product_categories").select2();
          jQuery("#company_point_of_contact").select2({
            ajax: {
              url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
              dataType: "json",
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {
                return {
                  q: params.term, // search query
                  action: "nab_product_point_of_contact", // AJAX action for admin-ajax.php
                };
              },
              processResults: function (data) {
                var options = [];
                if (data) {
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                  $.each(data, function (index, text) {
                    // do not forget that "index" is just auto incremented value
                    options.push({ id: text[0], text: text[1] });
                  });
                }
                return {
                  results: options,
                };
              },
              cache: true,
            },
            minimumInputLength: 3,
            placeholder: "Select Point of contact",
            allowClear: true,
          });
        } else {
          jQuery("#addProductModal").remove();
          jQuery("body").append(data);
          jQuery("#addProductModal").show().addClass("nab-modal-active");
          if (jQuery("#nab_company_id").length > 0) {
            jQuery("#nab_company_id").val(company_id);
          }
          jQuery("#product_categories").select2();
          jQuery("#company_point_of_contact").select2({
            ajax: {
              url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
              dataType: "json",
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {
                return {
                  q: params.term, // search query
                  action: "nab_product_point_of_contact", // AJAX action for admin-ajax.php
                };
              },
              processResults: function (data) {
                var options = [];
                if (data) {
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                  $.each(data, function (index, text) {
                    // do not forget that "index" is just auto incremented value
                    options.push({ id: text[0], text: text[1] });
                  });
                }
                return {
                  results: options,
                };
              },
              cache: true,
            },
            minimumInputLength: 3,
            placeholder: "Select Point of contact",
            allowClear: true,
          });
        }
      },
    });
  });

  function nabMembershipCategoryNotice(selector, message) {
    if (
      0 ===
      selector.parents(".form-row").find(".company-member-level-notice").length
    ) {
      selector
        .parents(".form-row")
        .append('<p class="company-member-level-notice">' + message + "</p>");
    } else {
      selector
        .parents(".form-row")
        .find(".company-member-level-notice")
        .text(message);
      selector.parents(".form-row").find(".company-member-level-notice").show();
    }
  }

  $(document).on("click", "#nab-edit-company-profile-submit", function () {
    var featuredSelector = $(this)
      .parents("form#nab-edit-company-profile-form")
      .find("#product_categories");
    var searchSelector = $(this)
      .parents("form#nab-edit-company-profile-form")
      .find("#search_product_categories");
    var featuredMax = parseInt(featuredSelector.attr("data-limit"));
    var searchMax = parseInt(searchSelector.attr("data-limit"));

    $(this)
      .parents("form#nab-edit-company-profile-form")
      .find(".company-member-level-notice")
      .hide();

    if (0 < featuredSelector.length && null !== featuredSelector.val()) {
      if (0 === featuredMax && 0 < featuredSelector.val().length) {
        nabMembershipCategoryNotice(
          featuredSelector,
          "You can't add featured product categories without membership."
        );
        return false;
      } else if (
        2 === featuredMax &&
        featuredSelector.val().length > featuredMax
      ) {
        nabMembershipCategoryNotice(
          featuredSelector,
          "You can add maximum " +
            featuredMax +
            " featured product categories with your current membership."
        );
        return false;
      } else if (featuredSelector.val().length > featuredMax) {
        nabMembershipCategoryNotice(
          featuredSelector,
          "You can add maximum " + featuredMax + " featured product categories."
        );
        return false;
      }
    }

    if (0 < searchSelector.length && null !== searchSelector.val()) {
      if (0 === searchMax && 0 < searchSelector.val().length) {
        nabMembershipCategoryNotice(
          searchSelector,
          "You can't add search categories with your current membership."
        );
        return false;
      } else if (searchSelector.val().length > searchMax) {
        nabMembershipCategoryNotice(
          searchSelector,
          "You can add maximum " +
            searchMax +
            " search categories with your current membership."
        );
        return false;
      }
    }

    var fd = new FormData();
    fd.append("action", "nab_update_company_profile");
    fd.append("company_id", amplifyJS.postID);
    if (jQuery("#instagram_profile").length) {
      if (!validateURL(jQuery("#instagram_profile").val())) {
        addSuccessMsg(
          ".add-product-content-popup",
          "Please Enter Correct URL for Instagram Profile!"
        );
        return false;
      } else {
        fd.append("instagram_profile", jQuery("#instagram_profile").val());
      }
    }
    if (jQuery("#linkedin_profile").length) {
      if (!validateURL(jQuery("#linkedin_profile").val())) {
        addSuccessMsg(
          ".add-product-content-popup",
          "Please Enter Correct URL for Linkedin Profile!"
        );
        return false;
      } else {
        fd.append("linkedin_profile", jQuery("#linkedin_profile").val());
      }
    }
    if (jQuery("#facebook_profile").length) {
      if (!validateURL(jQuery("#facebook_profile").val())) {
        addSuccessMsg(
          ".add-product-content-popup",
          "Please Enter Correct URL for Facebook Profile!"
        );
        return false;
      } else {
        fd.append("facebook_profile", jQuery("#facebook_profile").val());
      }
    }
    if (jQuery("#twitter_profile").length) {
      if (!validateURL(jQuery("#twitter_profile").val())) {
        addSuccessMsg(
          ".add-product-content-popup",
          "Please Enter Correct URL for Twitter Profile!"
        );
        return false;
      } else {
        fd.append("twitter_profile", jQuery("#twitter_profile").val());
      }
    }
    if (jQuery("#company_about").length) {
      var aboutContent = jQuery('#company_about').val();
      aboutContent = aboutContent.replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/gi, '');
      if (aboutContent.length > 2000) {
        alert(
          "The length of Company about content is " +
            jQuery("#company_about").val().length +
            " the max num of characters allowed for this content is 2000"
        );
        return false;
      }
      fd.append("company_about", jQuery("#company_about").val());
    }
    if (jQuery("#company_industry").length) {
      fd.append("company_industry", jQuery("#company_industry").val());
    }
    if (jQuery("#company_location").length) {
      fd.append("company_location", jQuery("#company_location").val());
    }
    if (jQuery("#company_website").length) {
      if (!validateURL(jQuery("#company_website").val())) {
        addSuccessMsg(
          ".add-product-content-popup",
          "Please Enter Correct URL for Company Website!"
        );
        return false;
      } else {
        fd.append("company_website", jQuery("#company_website").val());
      }
    }
    if (jQuery("#company_point_of_contact").length) {
      fd.append(
        "company_point_of_contact",
        jQuery("#company_point_of_contact").val()
      );
    }
    if (jQuery("#company_location_street_one").length) {
      fd.append(
        "company_location_street_one",
        jQuery("#company_location_street_one").val()
      );
    }
    if (jQuery("#company_location_street_two").length) {
      fd.append(
        "company_location_street_two",
        jQuery("#company_location_street_two").val()
      );
    }
    if (jQuery("#company_location_street_three").length) {
      fd.append(
        "company_location_street_three",
        jQuery("#company_location_street_three").val()
      );
    }
    if (jQuery("#company_location_city").length) {
      fd.append(
        "company_location_city",
        jQuery("#company_location_city").val()
      );
    }
    if (jQuery("#company_location_state").length) {
      fd.append(
        "company_location_state",
        jQuery("#company_location_state").val()
      );
    }
    if (jQuery("#company_location_zip").length) {
      fd.append("company_location_zip", jQuery("#company_location_zip").val());
    }
    if (jQuery("#company_location_country").length) {
      fd.append(
        "company_location_country",
        jQuery("#company_location_country").val()
      );
    }

    if (jQuery("#product_categories").length) {
      fd.append(
        "company_product_categories",
        jQuery("#product_categories").val()
      );
    }

    if (0 < searchSelector.length) {
      fd.append("company_search_categories", searchSelector.val());
    }

    if (jQuery("#company_youtube").length) {
      if (!validateURL(jQuery("#company_youtube").val())) {
        addSuccessMsg(
          ".add-product-content-popup",
          "Please Enter Correct URL for Youtube Profile!"
        );
        return false;
      } else {
        fd.append("company_youtube", jQuery("#company_youtube").val());
      }
    }

    if (jQuery('#company_admins').length) {
      fd.append('company_admins', jQuery('#company_admins').val())
    }

    jQuery.ajax({
      type: "POST",
      url: amplifyJS.ajaxurl,
      data: fd,
      contentType: false,
      processData: false,
      beforeSend: function () {
        $("body").addClass("is-loading");
      },
      success: function (data) {
        $("body").removeClass("is-loading");
        if (undefined !== data.success && !data.success) {
          addSuccessMsg(".add-product-content-popup", data.data);
        } else {
          addSuccessMsg(
            ".add-product-content-popup",
            "Profile Updated Successfully!"
          );
        }
      },
    });
  });

  $(".edit-company-about").on("click", function (e) {
    e.preventDefault();
    $(this).parent().addClass("loading");

    var fd = new FormData();
    var company_id = amplifyJS.postID;
    fd.append("action", "nab_edit_company_about");
    fd.append("company_id", amplifyJS.postID);

    jQuery.ajax({
      type: "POST",
      url: amplifyJS.ajaxurl,
      data: fd,
      contentType: false,
      processData: false,
      beforeSend: function () {
        $("body").addClass("is-loading");
      },
      success: function (data) {
        $("body").removeClass("is-loading");
        if (jQuery("#addProductModal").length === 0) {
          jQuery("body").append(data);
          jQuery("#addProductModal").show().addClass("nab-modal-active");
          if (jQuery("#nab_company_id").length > 0) {
            jQuery("#nab_company_id").val(company_id);
          }
          jQuery("#product_categories").select2();
          jQuery("#search_product_categories").select2();
          jQuery("#company_point_of_contact").select2({
            ajax: {
              url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
              dataType: "json",
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {
                return {
                  q: params.term, // search query
                  action: "nab_product_point_of_contact", // AJAX action for admin-ajax.php
                };
              },
              processResults: function (data) {
                var options = [];
                if (data) {
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                  $.each(data, function (index, text) {
                    // do not forget that "index" is just auto incremented value
                    options.push({ id: text[0], text: text[1] });
                  });
                }
                return {
                  results: options,
                };
              },
              cache: true,
            },
            minimumInputLength: 3,
            placeholder: "Select Point of contact",
            allowClear: true,
          });
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
          });
          load_tinyMCE_withPlugins(
            '#company_about',
            '#character-count-comp-about'
          )
        } else {
          jQuery("#addProductModal").remove();
          jQuery("body").append(data);
          jQuery("#addProductModal").show().addClass("nab-modal-active");
          if (jQuery("#nab_company_id").length > 0) {
            jQuery("#nab_company_id").val(company_id);
          }
          jQuery("#product_categories").select2();
          jQuery("#search_product_categories").select2();
          jQuery("#company_point_of_contact").select2({
            ajax: {
              url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
              dataType: "json",
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {
                return {
                  q: params.term, // search query
                  action: "nab_product_point_of_contact", // AJAX action for admin-ajax.php
                };
              },
              processResults: function (data) {
                var options = [];
                if (data) {
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                  $.each(data, function (index, text) {
                    // do not forget that "index" is just auto incremented value
                    options.push({ id: text[0], text: text[1] });
                  });
                }
                return {
                  results: options,
                };
              },
              cache: true,
            },
            minimumInputLength: 3,
            placeholder: "Select Point of contact",
            allowClear: true,
          });
          load_tinyMCE_withPlugins(
            '#company_about',
            '#character-count-comp-about'
          )
        }

        setTimeout(() => {
          if (jQuery(this).data("action") == "company-about") {
            jQuery(".company-about-row").css("display", "block");
            jQuery(".company-info-row").css("display", "none");
          }
          if (jQuery(this).data("action") == "company-info") {
            jQuery(".company-about-row").css("display", "none");
            jQuery(".company-info-row").css("display", "block");
          }
          if (jQuery("#company_about").length) {
            var len = jQuery("#company_about").val().length;
            var diff = 2000 - len;
            if (len > 2000) {
              jQuery("#character-count-comp-about").html(
                "Maximum Characters limit exceeds"
              );
            } else {
              jQuery("#character-count-comp-about").html(
                diff + " characters remaining"
              );
            }
          }
        }, 500);
      },
    });
  });
  $(document).on("click", ".edit-company-mode", function () {
    jQuery(".edit-profile-pic").show();
    jQuery(this).addClass("cancel-edit-company-mode");
    jQuery(this).removeClass("edit-company-mode");
    jQuery(this).text("Cancel Edit");
    jQuery(".banner-header").addClass("edit_mode_on");
    jQuery(".edit-bg-pic").show();
    jQuery(".edit-company-industry").show();
  });
  $(document).on("click", ".cancel-edit-company-mode", function () {
    jQuery(".edit-profile-pic").hide();
    jQuery(".edit-bg-pic").hide();
    jQuery(".edit-company-industry").hide();
    jQuery(this).removeClass("cancel-edit-company-mode");
    jQuery(this).addClass("edit-company-mode ");
    jQuery(".banner-header").removeClass("edit_mode_on");
    jQuery(this).text("Edit Profile");
  });
  // Add smooth scrolling to all links
  jQuery(".navigate-reply").on("click", function (event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "" && typeof jQuery(this.hash).offset() == "object") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      jQuery("html, body").animate(
        {
          scrollTop: jQuery(hash).offset().top,
        },
        1200,
        function () {}
      );
    } // End if
  });

  jQuery(window).load(function () {
    if (window.location.hash) {
      jQuery("html, body").animate(
        {
          scrollTop: jQuery(window.location.hash).offset().top,
        },
        1200,
        function () {
          // Add hash (#) to URL when done scrolling (default click behavior)
          window.location.hash = window.location.hash;
        }
      );
    }
  });

  // My Purchase Content Pagination
  $(document).on("click", ".navigate-purchased", function () {
    var new_current_page = "";
    const current_page = parseInt(
      $("#purchased-pagination #current-page").text()
    );
    const page_total = parseInt($("#purchased-pagination #page-total").text());
    if ($(this).hasClass("next-purchased")) {
      if (current_page < page_total) {
        new_current_page = current_page + 1;
      }
    } else {
      if (current_page > 1) {
        new_current_page = current_page - 1;
      }
    }
    if ("" !== new_current_page) {
      $("#purchased-pagination #current-page").text(new_current_page);
      $(".content_card").hide();
      $('.content_card[data-item="' + new_current_page + '"]').show();
    }
  });

  // on load
  $(window).load(function () {
    $(".video_added").removeClass("woocommerce-product-gallery__image");

    $(".custom_thumb.video_added a").fancybox({
      width: 800,
      height: 450,
      transitionIn: "elastic",
      transitionOut: "elastic",
      type: "iframe",
      closeBtn: true,
      smallBtn: true,
    });
  });

  // Prevent Events link in Month view for multidays events.
  // Doing so because we do not have control
  // to change the event link to custom link.
  $(document).on("click", 'a.tribe-events-calendar-month__multiday-event-hidden-link', function (e) {
    e.preventDefault();
    $(this).attr('href', 'javascript:void(0)');
  });

  $(document).on("click", ".product-head .product-layout span", function () {
    $(".product-head .product-layout span").removeClass("active");
    $(this).addClass("active");

    if ($(this).hasClass("grid")) {
      $(".product-list").removeClass("layout-list");
      $(".product-list").addClass("layout-grid");
    } else {
      $(".product-list").addClass("layout-list");
      $(".product-list").removeClass("layout-grid");
    }
  });

  // Remove user images using ajax.
  $("#profile_picture_remove").on("click", function (e) {
    e.preventDefault();

    $("body").addClass("is-loading");

    $.ajax({
      type: "POST",
      url: amplifyJS.ajaxurl,
      data: {
        action: "nab_amplify_remove_images",
        name: $(this).attr("name"),
      },
      success: function (data) {
        location.reload();
      },
    });
  });

  // Remove user company bg image.
  $('#banner_image_remove').on('click', function (e) {
    e.preventDefault()

    $('body').addClass('is-loading')

    $.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: {
        action: 'nab_amplify_banner_image_remove',
        company_id:amplifyJS.postID
      },
      success: function (data) {
        location.reload()
      }
    });
  });

  $(window).on("resize", function () {});

  // Related products
  if (4 < $(".related.products .product-list .product-item").length) {
    buildSliderConfiguration();

    $(window).on("resize", function () {
      buildSliderConfiguration();
    });
  }

  function buildSliderConfiguration() {
    $(".related.products .product-list").each(function () {
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
        mode: "horizontal",
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
        maxSlides: numberOfVisibleSlides,
      });
    });
  }

  function HeaderResponsive() {
    if (1024 >= $(window).width()) {
      $(document).on("click", ".nab-profile > a", function (e) {
        e.preventDefault();
        $(this).next(".nab-profile-dropdown").toggle();
      });
    }
  }

  if ($("#attendee_country").length > 0) {
    var states_json = wc_country_select_params.countries.replace(
        /&quot;/g,
        '"'
      ),
      states = $.parseJSON(states_json),
      wrapper_selectors = ".nab-event-reg-wrap";

    $(document.body).on("change refresh", "#attendee_country", function () {
      // Grab wrapping element to target only stateboxes in same 'group'
      var $wrapper = $(this).closest(wrapper_selectors);

      if (!$wrapper.length) {
        $wrapper = $(this).closest(".form-row").parent();
      }

      var country = $(this).val(),
        $statebox = $wrapper.find("#attendee_state"),
        $parent = $statebox.closest(".form-row"),
        input_name = $statebox.attr("name"),
        input_id = $statebox.attr("id"),
        input_classes = $statebox.attr("data-input-classes"),
        value = $statebox.val(),
        placeholder =
          $statebox.attr("placeholder") ||
          $statebox.attr("data-placeholder") ||
          "",
        $newstate;

      if (states[country]) {
        if ($.isEmptyObject(states[country])) {
          $newstate = $('<input type="hidden" />')
            .prop("id", input_id)
            .prop("name", input_name)
            .prop("placeholder", placeholder)
            .attr("data-input-classes", input_classes)
            .addClass("hidden " + input_classes);
          $parent.hide().find(".select2-container").remove();
          $statebox.replaceWith($newstate);
          $(document.body).trigger("country_to_state_changed", [
            country,
            $wrapper,
          ]);
        } else {
          var state = states[country],
            $defaultOption = $('<option value=""></option>').text(
              wc_country_select_params.i18n_select_state_text
            );

          if (!placeholder) {
            placeholder = wc_country_select_params.i18n_select_state_text;
          }

          $parent.show();

          if ($statebox.is("input")) {
            $newstate = $("<select></select>")
              .prop("id", input_id)
              .prop("name", input_name)
              .data("placeholder", placeholder)
              .attr("data-input-classes", input_classes)
              .addClass("state_select " + input_classes);
            $statebox.replaceWith($newstate);
            $statebox = $wrapper.find("#attendee_state");
          }

          $statebox.empty().append($defaultOption);

          $.each(state, function (index) {
            var $option = $("<option></option>")
              .prop("value", index)
              .text(state[index]);
            $statebox.append($option);
          });

          $statebox.val(value).change();

          $(document.body).trigger("country_to_state_changed", [
            country,
            $wrapper,
          ]);
        }
      } else {
        if ($statebox.is('select, input[type="hidden"]')) {
          $newstate = $('<input type="text" />')
            .prop("id", input_id)
            .prop("name", input_name)
            .prop("placeholder", placeholder)
            .attr("data-input-classes", input_classes)
            .addClass("input-text  " + input_classes);
          $parent.show().find(".select2-container").remove();
          $statebox.replaceWith($newstate);
          $(document.body).trigger("country_to_state_changed", [
            country,
            $wrapper,
          ]);
        }
      }

      $(document.body).trigger("country_to_state_changing", [
        country,
        $wrapper,
      ]);
    });
  }

  if ($("#nab_billing_same_as_attendee").length > 0) {
    $(document).on("change", "#nab_billing_same_as_attendee", function () {
      if (this.checked) {
        let updateFields = {
          attendee_first_name: "billing_first_name",
          attendee_last_name: "billing_last_name",
          attendee_company: "billing_company",
          attendee_email: "billing_email",
          attendee_city: "billing_city",
          attendee_zip: "billing_postcode",
        };
        $.each(updateFields, function (k, v) {
          $("#" + v).val($("#" + k).val());
        });

        $("#billing_country")
          .val($("#attendee_country").val())
          .trigger("change");
        $("#billing_state").val($("#attendee_state").val()).trigger("change");
      }
    });
  }

  if ($("#nab_bulk_quantity").length > 0) {
    $(document).on("change", "#nab_is_bulk", function () {
      var isBulkOrder = $(this).val();
      if (isBulkOrder && "yes" === isBulkOrder) {
        $(".nab-quantity-selector").show();
        $("#nab_bulk_order_field").val("yes");
      } else {
        $("#nab_bulk_order_field").val("no");
        $(".nab-qty").val("1");
        $(".nab-quantity-selector").hide();
        $("#nab_bulk_quantity, #nab_bulk_order_qty_field").val("");
        nabRefreshCart();
      }
    });

    $(document).on("change", "#nab_bulk_quantity", function () {
      let selectedQty = $(this).val();
      if (selectedQty) {
        $(".nab-qty, #nab_bulk_order_qty_field").val(selectedQty);
      } else {
        $(".nab-qty").val("1");
        $("#nab_bulk_quantity, #nab_bulk_order_qty_field").val("");
      }
      nabRefreshCart();
    });
  }

  function nabRefreshCart() {
    block($(".woocommerce-cart-form"));
    block($("div.cart_totals"));

    let nabCartData = {
      action: "nab_custom_update_cart",
      qty: $("#nab_bulk_quantity").val(),
      is_bulk: $("#nab_is_bulk").val(),
    };

    $.ajax({
      url: amplifyJS.ajaxurl,
      type: "POST",
      data: nabCartData,
      success: function (data) {
        if (0 === data.err) {
          $(".woocommerce").replaceWith(data.cart_content);
          $("[name='update_cart']")
            .prop("disabled", true)
            .attr("aria-disabled", "true");
          unblock($(".woocommerce-cart-form"));
          unblock($("div.cart_totals"));
          $.scroll_to_notices($('[role="alert"]'));
          $(document.body).trigger("updated_wc_div");
        } else {
          $("[name='update_cart']").prop("disabled", false);
          $("[name='update_cart']").trigger("click");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        unblock($(".woocommerce-cart-form"));
        unblock($("div.cart_totals"));
        console.log(thrownError);
      },
    });
  }

  var block = function ($node) {
    if (!is_blocked($node)) {
      $node.addClass("processing").block({
        message: null,
        overlayCSS: {
          background: "#fff",
          opacity: 0.6,
        },
      });
    }
  };

  var is_blocked = function ($node) {
    return $node.is(".processing") || $node.parents(".processing").length;
  };

  var unblock = function ($node) {
    $node.removeClass("processing").unblock();
  };

  var showLoader = function () {
    $("body").addClass("is-loading");
  };

  var hideLoader = function () {
    $("body").removeClass("is-loading");
  };

  if ($("#nabAddAttendeeModal").length > 0) {
    $(document).on("click", ".nab-add-attendee", function () {
      $("#attendeeOrderID").val($(this).data("orderid"));
      $("#attendeeOrderQty").val($(this).data("qty"));
      $("#nabAddAttendeeModal").show();
    });

    $(document).on("click", ".nab-modal-close", function () {
      if ($(this).hasClass("nab-reload-on-close")) {
        location.reload();
      } else {
        $("#bulk_upload_file").val("");
        $(".attendee-bulk-upload-form .input-placeholder").val(
          "Upload File..."
        );
        $(this).parents(".nab-modal").hide();
      }
    });

    $(document).on("change", "#bulk_upload_file", function (e) {
      if (e.target.files[0]) {
        $(".attendee-bulk-upload-form .input-placeholder").text(
          e.target.files[0].name
        );
      }
    });

    $(document).on("click", "#bulk_upload", function () {
      $(".attendee-upload-message").removeClass("error success").hide();
      var file_data = $("#bulk_upload_file").prop("files")[0];

      if (0 === $("#bulk_upload_file")[0].files.length) {
        $(".attendee-upload-message")
          .addClass("error")
          .text("Please select a file!")
          .show();
      } else {
        $("body").addClass("is-loading"); // loader
        var attendeeOrderID = $("#attendeeOrderID").val();
        var attendeeOrderQty = $("#attendeeOrderQty").val();
        var form_data = new FormData();
        form_data.append("file", file_data);
        form_data.append("action", "nab_db_add_attendee");
        form_data.append("attendeeOrderID", attendeeOrderID);
        form_data.append("nabNonce", amplifyJS.nabNonce);

        $.ajax({
          url: amplifyJS.ajaxurl,
          type: "POST",
          contentType: false,
          processData: false,
          data: form_data,
          success: function (response) {
            console.log(response);
            if (0 === response.err) {
              var totalRecords = response.total_records;
              var loopCount = Math.ceil(totalRecords / 10);
              var attendeeData = {
                attendeeOrderID: attendeeOrderID,
                totalRecords: totalRecords,
                loopCount: loopCount,
                attendeeOrderQty: attendeeOrderQty,
                action: "insert_new_attendee",
              };

              processAttendeeData(attendeeData);
            } else {
              $(".attendee-upload-message")
                .addClass("error")
                .text(response.message)
                .show();
              $("body").removeClass("is-loading"); // loader
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $("body").removeClass("is-loading"); // loader
            console.log(thrownError);
          },
        });
      }
    });

    async function processAttendeeData(attendeeData) {
      for (i = 0; i < attendeeData.loopCount; i++) {
        attendeeData.currentIndex = i;
        if (attendeeData.loopCount === attendeeData.currentIndex + 1) {
          attendeeData.isLast = "yes";
        }
        var uploadedAttendeeResp = await uploadedAttendee(attendeeData);
      }
    }

    function uploadedAttendee(attendeeData) {
      return new Promise(function (resolve, reject) {
        $.ajax({
          url: amplifyJS.ajaxurl,
          type: "POST",
          data: attendeeData,
          success: function (data) {
            console.log(data);
            if (1 === data.err) {
              importErrs.push(data.msg);
            }
            if (1 === data.skipped) {
              skippedErrs.push(data.skipped_msg);
            }
            addedAttendee =
              parseInt(addedAttendee) + parseInt(data.added_attendee);
            if (attendeeData.loopCount === attendeeData.currentIndex + 1) {
              $("#bulk_upload_file").val("");
              $(".attendee-bulk-upload-form .input-placeholder").text(
                "Upload file..."
              );
              if (importErrs.length > 0) {
                var importErrMsg =
                  "Attendee import process is completed. " +
                  addedAttendee +
                  " Attendees imported successfully. There were some errors while importing data.<br><br>";
                $.each(importErrs, function (k, v) {
                  $.each(v, function (j, val) {
                    importErrMsg += val + "<br>";
                  });
                });

                $(".attendee-upload-message")
                  .addClass("error")
                  .html(importErrMsg)
                  .show();
              } else {
                if (skippedErrs.length > 0) {
                  var skippedErrsMsg =
                    "Attendee import process is completed. " +
                    addedAttendee +
                    " Attendees imported successfully. Some records were skipped due to below reasons:<br><br>";
                  //skippedErrsMsg += skippedErrs;
                  $.each(skippedErrs, function (k, v) {
                    $.each(v, function (j, val) {
                      skippedErrsMsg += val + "<br>";
                    });
                  });
                  $(".attendee-upload-message")
                    .addClass("error")
                    .html(skippedErrsMsg)
                    .show();
                } else {
                  $(".attendee-upload-message")
                    .addClass("success")
                    .text(
                      "Attendee import process is completed. " +
                        addedAttendee +
                        " Attendees imported successfully."
                    )
                    .show();
                }
              }
              if (
                undefined !== typeof data.totalAddedAttendees &&
                attendeeData.attendeeOrderQty === data.totalAddedAttendees
              ) {
                $(
                  ".nab-add-attendee[data-orderid=" +
                    attendeeData.attendeeOrderID +
                    "]"
                ).hide();
              }
              addedAttendee = 0;
              $(".nab-modal-close").addClass("nab-reload-on-close");
              $("body").removeClass("is-loading"); // loader
            }
            resolve(data);
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $("body").removeClass("is-loading"); // loader
            console.log(thrownError);
          },
        });
      });
    }
  }

  $(document).on("click", ".nab-view-attendee", function () {
    var orderId = $(this).data("orderid");
    $("body").addClass("is-loading"); // loader
    $.ajax({
      url: amplifyJS.ajaxurl,
      type: "GET",
      data: {
        orderId: orderId,
        action: "get_order_attendees",
        nabNonce: amplifyJS.nabNonce,
      },
      success: function (response) {
        $(".attendee-view-table-wrp").empty();
        let attendeeTableWrap = $(".attendee-view-table-wrp")[0];

        if (1 === response.err) {
          let errMessageElem = document.createElement("p");
          errMessageElem.innerHTML = response.message;
          attendeeTableWrap.appendChild(errMessageElem);
        } else if (0 === response.attendees.length) {
          let errMessageElem = document.createElement("p");
          errMessageElem.innerHTML = "No Attendees found.";
          attendeeTableWrap.appendChild(errMessageElem);
        } else {
          let attendeeTable = document.createElement("table");

          let titleWrapper = document.createElement("div");
          titleWrapper.setAttribute("class", "attendee-title-wrapper");

          let attendeeTableTitle = document.createElement("h3");
          attendeeTableTitle.innerText = "Attendee Details";

          titleWrapper.appendChild(attendeeTableTitle);

          let addAttendeeLink = document.createElement("a");
          addAttendeeLink.setAttribute("href", "javascript:void(0);");
          addAttendeeLink.setAttribute(
            "class",
            "nab-view-add-attendee woocommerce-button button"
          );
          addAttendeeLink.setAttribute("data-orderid", orderId);
          addAttendeeLink.innerText = "Add Attendee";

          if (response.is_attendee) {
            addAttendeeLink.setAttribute("style", "display: none;");
          }

          titleWrapper.appendChild(addAttendeeLink);

          let attendeeTableCopy = document.createElement("span");
          attendeeTableCopy.className = "nab-attendee-detail-copy";
          attendeeTableCopy.innerText =
            "The following attendees have been registered and should have received an email with a temporary password. They can each use their personal log ins to access the Show(s).";

          let attendeeActionMsg = document.createElement("div");
          attendeeActionMsg.setAttribute("class", "attendee-details-message");
          attendeeActionMsg.setAttribute("style", "display: none;");

          let attendeeTableFooter = document.createElement("span");
          attendeeTableFooter.className = "nab-attendee-detail-footer";
          attendeeTableFooter.innerHTML =
            'If you need to make changes to your list of attendees after uploading, please contact <a href="mailto:register@nab.org">register@nab.org</a>.';

          let attendeeThead = document.createElement("thead");
          let attendeeTbody = document.createElement("tbody");
          attendeeTbody.setAttribute("id", "attendee-list-table-body");

          let attendeeTheadTr = document.createElement("tr");

          let attendeeTheadFirstName = document.createElement("th");
          attendeeTheadFirstName.innerText = "First Name";
          let attendeeTheadLastName = document.createElement("th");
          attendeeTheadLastName.innerText = "Last Name";
          let attendeeTheadEmail = document.createElement("th");
          attendeeTheadEmail.innerText = "Email";
          let attendeeTheadAction = document.createElement("th");

          attendeeTheadTr.appendChild(attendeeTheadFirstName);
          attendeeTheadTr.appendChild(attendeeTheadLastName);
          attendeeTheadTr.appendChild(attendeeTheadEmail);
          attendeeTheadTr.appendChild(attendeeTheadAction);

          attendeeThead.appendChild(attendeeTheadTr);

          attendeeTable.appendChild(attendeeThead);

          let dataTitles = {
            first_name: "First Name",
            last_name: "Last Name",
            email: "Email",
          };

          for (let a = 0; a < response.attendees.length; a++) {
            let attendeeDataTr = document.createElement("tr");

            $.each(dataTitles, function (key, value) {
              let attendeeDataTd = document.createElement("td");
              let attendeeDataTdText = document.createTextNode(
                response.attendees[a][key]
              );
              attendeeDataTd.appendChild(attendeeDataTdText);
              attendeeDataTd.setAttribute("data-title", value);
              attendeeDataTr.appendChild(attendeeDataTd);
            });

            let attendeeDataAction = document.createElement("td");
            attendeeDataAction.setAttribute("data-title", "Actions");
            attendeeDataAction.setAttribute(
              "data-oid",
              response.attendees[a]["order_id"]
            );
            attendeeDataAction.setAttribute(
              "data-pid",
              response.attendees[a]["id"]
            );

            let attendeeDataDefaultActions = document.createElement("div");
            attendeeDataDefaultActions.className = "att-actions";

            let attendeeEditAction = document.createElement("a");
            attendeeEditAction.className = "fa fa-edit";
            attendeeEditAction.href = "javascript:void(0)";

            let attendeeDeleteAction = document.createElement("a");
            attendeeDeleteAction.className = "fa fa-trash nab-remove-attendee";
            attendeeDeleteAction.href = "javascript:void(0)";

            attendeeDataDefaultActions.appendChild(attendeeEditAction);
            attendeeDataDefaultActions.appendChild(attendeeDeleteAction);

            attendeeDataAction.appendChild(attendeeDataDefaultActions);

            let attendeeDataAdvActions = document.createElement("div");
            attendeeDataAdvActions.className = "att-save";
            attendeeDataAdvActions.style.display = "none";

            let attendeeSaveAction = document.createElement("a");
            attendeeSaveAction.className = "nab-update-attendee";
            attendeeSaveAction.href = "javascript:void(0)";

            attendeeDataAdvActions.appendChild(attendeeSaveAction);

            attendeeDataAction.appendChild(attendeeDataDefaultActions);
            attendeeDataAction.appendChild(attendeeDataAdvActions);

            attendeeDataTr.appendChild(attendeeDataAction);
            attendeeTbody.appendChild(attendeeDataTr);
          }
          attendeeTable.appendChild(attendeeTbody);

          attendeeTableWrap.appendChild(titleWrapper);
          attendeeTableWrap.appendChild(attendeeTableCopy);
          attendeeTableWrap.appendChild(attendeeActionMsg);
          attendeeTableWrap.appendChild(attendeeTable);
          attendeeTableWrap.appendChild(attendeeTableFooter);
        }

        $("#nabViewAttendeeModal").show();
        $("body").removeClass("is-loading"); // loader
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("body").removeClass("is-loading"); // loader
        console.log(thrownError);
      },
    });
  });

  $(document).on("click", ".nab-remove-attendee", function () {
    let currentAttendee = $(this);
    let primaryID = currentAttendee.parents("td").attr("data-pid");
    let orderID = currentAttendee.parents("td").attr("data-oid");
    let parentOrderId = currentAttendee
      .parents(".attendee-view-wrap")
      .find(".nab-view-add-attendee")
      .attr("data-orderid");

    $(".attendee-details-message")
      .hide()
      .text("")
      .removeClass("success failed");

    if (primaryID && orderID) {
      let removeConfirmation = confirm(
        "Are you sure you want to remove this attendee?"
      );
      if (removeConfirmation) {
        showLoader();
        $.ajax({
          url: amplifyJS.ajaxurl,
          type: "POST",
          data: {
            pID: primaryID,
            oID: orderID,
            parentOrderId: parentOrderId,
            action: "remove_attendee",
            nabNonce: amplifyJS.nabNonce,
          },
          success: function (response) {
            if (1 === response.err) {
              $(".attendee-details-message")
                .text(response.message)
                .addClass("failed")
                .show();
            } else {
              $(".attendee-details-message")
                .text(response.message)
                .addClass("success")
                .show();
              currentAttendee.parents("tr").remove();

              if (response.is_attendee) {
                $(".attendee-view-table-wrp .nab-view-add-attendee").hide();
              } else {
                $(".attendee-view-table-wrp .nab-view-add-attendee").show();
              }
            }
            hideLoader();
          },
          error: function (xhr, ajaxOptions, thrownError) {
            hideLoader();
            console.log(thrownError);
          },
        });
      }
    }
  });

  let attendeeFirstName = "";
  let attendeeLastName = "";
  let attendeeEmail = "";

  $(document).on(
    "click",
    ".attendee-view-table-wrp .att-actions a.fa-edit",
    function () {
      let currentAttendee = $(this);
      let primaryID = currentAttendee.parents("td").attr("data-pid");
      let orderID = currentAttendee.parents("td").attr("data-oid");

      $(".attendee-details-message")
        .hide()
        .text("")
        .removeClass("success failed");

      if (primaryID && orderID) {
        showLoader();

        $.ajax({
          url: amplifyJS.ajaxurl,
          type: "POST",
          data: {
            pID: primaryID,
            action: "get_edit_attendee",
            nabNonce: amplifyJS.nabNonce,
          },
          success: function (response) {
            if (1 === response.err) {
              $(".attendee-details-message")
                .text(response.message)
                .addClass("failed")
                .show();
            } else {
              attendeeFirstName = response.first_name;
              attendeeLastName = response.last_name;
              attendeeEmail = response.email;
              $("#nabeditAttendeeModal .attendee_first_name").val(
                attendeeFirstName
              );
              $("#nabeditAttendeeModal .attendee_last_name").val(
                attendeeLastName
              );
              $("#nabeditAttendeeModal .attendee_email").val(attendeeEmail);
              $("#nabeditAttendeeModal .attendee-edit-wrap").attr({
                "data-oid": orderID,
                "data-pid": primaryID,
                "data-uid": response.uid,
              });
              $("#nabeditAttendeeModal .attendee-edit-wrap h3").text(
                "Edit Attendee Details"
              );
              $("#nabeditAttendeeModal").show();
            }
            hideLoader();
          },
          error: function (xhr, ajaxOptions, thrownError) {
            hideLoader();
            console.log(thrownError);
          },
        });
      }
    }
  );

  $(document).on(
    "click",
    ".attendee-view-table-wrp .nab-view-add-attendee",
    function () {
      $("#nabeditAttendeeModal .attendee-edit-wrap").attr({
        "data-orderid": $(this).attr("data-orderid"),
        "data-action": "add",
      });
      $("#nabeditAttendeeModal .attendee-edit-wrap h3").text(
        "Add Attendee Details"
      );
      $("#nabeditAttendeeModal .attendee-edit-wrap .attendee_first_name").val(
        ""
      );
      $("#nabeditAttendeeModal .attendee-edit-wrap .attendee_last_name").val(
        ""
      );
      $("#nabeditAttendeeModal .attendee-edit-wrap .attendee_email").val("");
      $("#nabeditAttendeeModal").show();
    }
  );

  $(document).on(
    "click",
    "#nabeditAttendeeModal .edit-att-buttons .btn-save",
    function () {
      let currentElement = $(this);
      let editFirstName = currentElement
        .parents("table")
        .find(".attendee_first_name")
        .val();
      let editLastName = currentElement
        .parents("table")
        .find(".attendee_last_name")
        .val();
      let editEmail = currentElement
        .parents("table")
        .find(".attendee_email")
        .val();
      let action = currentElement
        .parents(".attendee-edit-wrap")
        .attr("data-action");

      $(".attendee-details-message")
        .hide()
        .text("")
        .removeClass("success failed");

      if (!editFirstName.match("[a-zA-Z0-9]")) {
        alert("Enter a valid first name");
        return;
      }
      if (!editLastName.match("[a-zA-Z0-9]")) {
        alert("Enter a valid last name");
        return;
      }

      let emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if (!emailRegex.test(editEmail)) {
        alert("Enter a valid email address");
        return;
      }

      if ("add" === action) {
        let orderID = currentElement
          .parents(".attendee-edit-wrap")
          .attr("data-orderid");

        if (orderID) {
          showLoader();

          $.ajax({
            url: amplifyJS.ajaxurl,
            type: "POST",
            data: {
              orderId: orderID,
              fname: editFirstName,
              lname: editLastName,
              email: editEmail,
              action: "add_attendee_order_details",
              nabNonce: amplifyJS.nabNonce,
            },
            success: function (response) {
              if (1 === response.err) {
                $(".attendee-details-message")
                  .text(response.message)
                  .addClass("failed")
                  .show();
                currentElement.parents("#nabeditAttendeeModal").hide();
              } else {
                $(".attendee-details-message")
                  .text(response.message)
                  .addClass("success")
                  .show();

                let tableTr = document.createElement("tr");

                let firstNameTd = document.createElement("td");
                firstNameTd.setAttribute("data-title", "First Name");
                firstNameTd.innerText = editFirstName;

                let lastNameTd = document.createElement("td");
                lastNameTd.setAttribute("data-title", "Last Name");
                lastNameTd.innerText = editLastName;

                let emailTd = document.createElement("td");
                emailTd.setAttribute("data-title", "Email");
                emailTd.innerText = editEmail;

                let actionTd = document.createElement("td");
                actionTd.setAttribute("data-title", "Actions");
                actionTd.setAttribute("data-oid", response.oid);
                actionTd.setAttribute("data-pid", response.pid);

                let actionDiv = document.createElement("div");
                actionDiv.setAttribute("class", "att-actions");

                let editLink = document.createElement("a");
                editLink.setAttribute("class", "fa fa-edit");
                editLink.setAttribute("href", "javascript:void(0);");

                let removeLink = document.createElement("a");
                removeLink.setAttribute(
                  "class",
                  "fa fa-trash nab-remove-attendee"
                );
                removeLink.setAttribute("href", "javascript:void(0);");

                actionDiv.appendChild(editLink);
                actionDiv.appendChild(removeLink);
                actionTd.appendChild(actionDiv);
                tableTr.appendChild(firstNameTd);
                tableTr.appendChild(lastNameTd);
                tableTr.appendChild(emailTd);
                tableTr.appendChild(actionTd);

                let tableBody = document.getElementById(
                  "attendee-list-table-body"
                );

                tableBody.appendChild(tableTr);

                if (response.is_attendee) {
                  $(".attendee-view-table-wrp .nab-view-add-attendee").hide();
                }
                currentElement.parents("#nabeditAttendeeModal").hide();
              }
              hideLoader();
            },
            error: function (xhr, ajaxOptions, thrownError) {
              hideLoader();
              console.log(thrownError);
            },
          });
        }
      } else {
        let primaryID = currentElement
          .parents(".attendee-edit-wrap")
          .attr("data-pid");
        let orderID = currentElement
          .parents(".attendee-edit-wrap")
          .attr("data-oid");

        if (attendeeEmail !== editEmail) {
          if (primaryID && orderID) {
            showLoader();

            $.ajax({
              url: amplifyJS.ajaxurl,
              type: "POST",
              data: {
                pID: primaryID,
                oID: orderID,
                fname: editFirstName,
                lname: editLastName,
                email: editEmail,
                action: "change_attendee_order_details",
                nabNonce: amplifyJS.nabNonce,
              },
              success: function (response) {
                console.log(response);
                if (1 === response.err) {
                  $(".attendee-details-message")
                    .text(response.message)
                    .addClass("failed")
                    .show();
                  currentElement.parents("#nabeditAttendeeModal").hide();
                } else {
                  $(".attendee-details-message")
                    .text(response.message)
                    .addClass("success")
                    .show();

                  $(
                    '#nabViewAttendeeModal table td[data-pid="' +
                      primaryID +
                      '"]'
                  )
                    .parents("tr")
                    .find("td:eq(0)")
                    .text(editFirstName);
                  $(
                    '#nabViewAttendeeModal table td[data-pid="' +
                      primaryID +
                      '"]'
                  )
                    .parents("tr")
                    .find("td:eq(1)")
                    .text(editLastName);
                  $(
                    '#nabViewAttendeeModal table td[data-pid="' +
                      primaryID +
                      '"]'
                  )
                    .parents("tr")
                    .find("td:eq(2)")
                    .text(editEmail);
                  $(
                    '#nabViewAttendeeModal table td[data-pid="' +
                      primaryID +
                      '"]'
                  ).attr({
                    "data-oid": response.oid,
                    "data-pid": response.pid,
                  });

                  if (response.is_attendee) {
                    $(".attendee-view-table-wrp .nab-view-add-attendee").hide();
                  } else {
                    $(".attendee-view-table-wrp .nab-view-add-attendee").show();
                  }

                  currentElement.parents("#nabeditAttendeeModal").hide();
                }
                hideLoader();
              },
              error: function (xhr, ajaxOptions, thrownError) {
                hideLoader();
                console.log(thrownError);
              },
            });
          }
        } else if (
          attendeeFirstName !== editFirstName ||
          attendeeLastName !== editLastName
        ) {
          let currentUserId = currentElement
            .parents(".attendee-edit-wrap")
            .data("uid");

          if (primaryID && currentUserId) {
            showLoader();

            $.ajax({
              url: amplifyJS.ajaxurl,
              type: "POST",
              data: {
                pID: primaryID,
                uID: currentUserId,
                fname: editFirstName,
                lname: editLastName,
                action: "update_attendee_details",
                nabNonce: amplifyJS.nabNonce,
              },
              success: function (response) {
                if (1 === response.err) {
                  $(".attendee-details-message")
                    .text(response.message)
                    .addClass("failed")
                    .show();
                  currentElement.parents("#nabeditAttendeeModal").hide();
                } else {
                  $(".attendee-details-message")
                    .text(response.message)
                    .addClass("success")
                    .show();
                  $(
                    '#nabViewAttendeeModal table td[data-pid="' +
                      primaryID +
                      '"]'
                  )
                    .parents("tr")
                    .find("td:eq(0)")
                    .text(editFirstName);
                  $(
                    '#nabViewAttendeeModal table td[data-pid="' +
                      primaryID +
                      '"]'
                  )
                    .parents("tr")
                    .find("td:eq(1)")
                    .text(editLastName);
                  currentElement.parents("#nabeditAttendeeModal").hide();
                }
                hideLoader();
              },
              error: function (xhr, ajaxOptions, thrownError) {
                hideLoader();
                console.log(thrownError);
              },
            });
          }
        } else {
          currentElement.parents("#nabeditAttendeeModal").hide();
        }
      }

      attendeeFirstName = "";
      attendeeLastName = "";
      attendeeEmail = "";
      currentElement
        .parents(".attendee-edit-wrap")
        .removeAttr("data-pid data-oid data-uid data-orderid data-action");
    }
  );

  $(document).on(
    "click",
    "#nabeditAttendeeModal .edit-att-buttons .btn-cancle",
    function () {
      $(this).parents("#nabeditAttendeeModal").hide();
      $(this)
        .parents(".attendee-edit-wrap")
        .removeAttr("data-pid data-oid data-uid data-orderid data-action");
    }
  );

  /* User Search Filters*/
  $(document).on("click", "#load-more-user a", function () {
    let userPageNumber = parseInt($(this).attr("data-page-number"));
    nabSearchUserAjax(true, userPageNumber);
  });

  $(document).on("change", ".other-search-filter #people-connect", function () {
    nabSearchUserAjax(false, 1);
  });

  $(document).on(
    "change",
    ".other-search-filter #search-country-select",
    function () {
      $(this)
        .parents(".other-search-filter")
        .find("#search-state-select")
        .empty();
      $(this)
        .parents(".other-search-filter")
        .find("#search-city-select")
        .empty();

      let default_option_state = $("<option></option>")
        .prop("value", "")
        .text("Select a state");
      $(".other-search-filter .search-state-select").append(
        default_option_state
      );

      let default_option_city = $("<option></option>")
        .prop("value", "")
        .text("Select a city");
      $(".other-search-filter .search-city-select").append(default_option_city);

      let country = 0 === $(this)[0].selectedIndex ? "" : $(this).val();

      jQuery.ajax({
        url: amplifyJS.ajaxurl,
        type: "POST",
        data: {
          action: "nab_get_search_filter_state",
          nabNonce: amplifyJS.nabNonce,
          country: country,
        },
        success: function (response) {
          let stateObj = jQuery.parseJSON(response);
          if (stateObj.states) {
            $.each(stateObj.states, function (index) {
              let $option = $("<option></option>")
                .prop("value", index)
                .text(stateObj.states[index]);
              $(".other-search-filter .search-state-select").append($option);
            });
            //$('.other-search-filter .search-state-select').val('').change();
          }
        },
      });
      nabSearchUserAjax(false, 1);
    }
  );

  $(document).on(
    "change",
    ".other-search-filter #search-state-select",
    function () {
      $(this)
        .parents(".other-search-filter")
        .find("#search-city-select")
        .empty();
      let default_option_city = $("<option></option>")
        .prop("value", "")
        .text("Select a city");
      $(".other-search-filter .search-city-select").append(default_option_city);

      nabSearchUserAjax(false, 1);
    }
  );

  $(document).on(
    "change",
    ".other-search-filter #search-city-select",
    function () {
      nabSearchUserAjax(false, 1);
    }
  );

  $(document).ready(function () {
    $(".search-city-select").select2();
    $(".search-city-select").select2({
      ajax: {
        url: amplifyJS.ajaxurl, // AJAX URL is predefined in WordPress admin
        dataType: "json",
        delay: 250, // delay in ms while typing when to perform a AJAX search
        data: function (params) {
          return {
            q: params.term, // search query
            action: "nab_get_search_city", // AJAX action for admin-ajax.php
            country:
              0 ===
              $(".other-search-filter #search-country-select")[0].selectedIndex
                ? ""
                : $(".other-search-filter #search-country-select").val(),
            state:
              0 ===
              $(".other-search-filter #search-state-select")[0].selectedIndex
                ? ""
                : $(".other-search-filter #search-state-select").val(),
          };
        },
        processResults: function (data) {
          var options = [];
          if (data) {
            // data is the array of arrays, and each of them contains ID and the Label of the option
            $.each(data, function (index, text) {
              // do not forget that "index" is just auto incremented value
              options.push({ id: text, text: text });
            });
          }
          return {
            results: options,
          };
        },
        cache: true,
      },
      minimumInputLength: 2,
    });
  });

  $(document).on(
    "keypress",
    ".other-search-filter .company-search .input-company",
    function (e) {
      if (13 === e.which) {
        nabSearchUserAjax(false, 1);
      }
    }
  );

  $(document).on(
    "keypress",
    ".other-search-filter .job-title-search .input-job-title",
    function (e) {
      if (13 === e.which) {
        nabSearchUserAjax(false, 1);
      }
    }
  );

  $(document).on(
    "click",
    ".other-search-filter .sort-user a.sort-order",
    function () {
      if (!$(this).hasClass("active")) {
        $(this).addClass("active").siblings().removeClass("active");
        nabSearchUserAjax(false, 1);
      }
    }
  );

  /* Product Search Filters*/
  $(document).on("click", "#load-more-product a", function () {
    let productPageNumber = parseInt($(this).attr("data-page-number"));
    nabSearchProductAjax(true, productPageNumber);
  });

  $(document).on(
    "change",
    ".other-search-filter #product-category",
    function () {
      nabSearchProductAjax(false, 1);
    }
  );

  $(document).on(
    "click",
    ".other-search-filter .sort-product a.sort-order",
    function () {
      if (!$(this).hasClass("active")) {
        $(this).addClass("active").siblings().removeClass("active");
        nabSearchProductAjax(false, 1);
      }
    }
  );

  /* Company Product Search Filters*/
  $(document).on("click", "#load-more-company-product a", function () {
    let productPageNumber = parseInt($(this).attr("data-page-number"));
    nabSearchCompanyProductAjax(true, productPageNumber);
  });

  $(document).on(
    "click",
    ".other-search-filter .sort-company-product a.sort-order",
    function () {
      if (!$(this).hasClass("active")) {
        $(this).addClass("active").siblings().removeClass("active");
        nabSearchCompanyProductAjax(false, 1);
      }
    }
  );

  $(document).on(
    "change",
    ".other-search-filter .nab-custom-select #company-product-category",
    function () {
      nabSearchCompanyProductAjax(false, 1);
    }
  );

  /* Company Search Filters*/
  $(document).on("click", "#load-more-company a", function () {
    let companyPageNumber = parseInt($(this).attr("data-page-number"));
    nabSearchCompanyAjax(true, companyPageNumber);
  });

  $(document).on(
    "click",
    ".other-search-filter .sort-company a.sort-order",
    function () {
      if (!$(this).hasClass("active")) {
        $(this).addClass("active").siblings().removeClass("active");
        nabSearchCompanyAjax(false, 1);
      }
    }
  );

  $(document).on(
    "change",
    ".other-search-filter .nab-custom-select #company-category-filter",
    function () {
      nabSearchCompanyAjax(false, 1);
    }
  );

  /* Content Search Filters*/
  $(document).on("click", "#load-more-content a", function () {
    let contentPageNumber = parseInt($(this).attr("data-page-number"));
    nabSearchContentAjax(true, contentPageNumber);
  });

  $(document).on(
    "click",
    ".other-search-filter .sort-content a.sort-order",
    function () {
      if (!$(this).hasClass("active")) {
        $(this).addClass("active").siblings().removeClass("active");
        nabSearchContentAjax(false, 1);
      }
    }
  );

  $(document).on(
    "change",
    ".other-search-filter .nab-custom-select #content-community",
    function () {
      nabSearchContentAjax(false, 1);
    }
  );

  $(document).on(
    "change",
    ".other-search-filter .nab-custom-select #content-subject",
    function () {
      nabSearchContentAjax(false, 1);
    }
  );

  $(document).on(
    "change",
    ".other-search-filter .nab-custom-select #content-type",
    function () {
      nabSearchContentAjax(false, 1);
    }
  );

  /* Event Search Filters*/
  $(document).on("click", "#load-more-event a", function () {
    let eventPageNumber = parseInt($(this).attr("data-page-number"));
    nabSearchEventAjax(true, eventPageNumber);
  });

  $(document).on(
    "click",
    ".other-search-filter .event-type a.sort-order",
    function () {
      if (!$(this).hasClass("active")) {
        $(this).addClass("active").siblings().removeClass("active");
        nabSearchEventAjax(false, 1);
      }
    }
  );

  // Handle Connection Request Form Submission.
  $(document).on("click", "#submit-connection-request", function () {
    const connectionMsg = $("#connection-message").val();
    if ("" === connectionMsg) {
      $("#connection-message-popup").hide();
      $(".popup-opened").addClass("message-sent");
      $(".popup-opened").trigger("click");
      $(".popup-opened").removeClass("popup-opened");
    } else {
      $("#connection-message").removeClass("error");
      $("#connection-message-form .error").hide();

      // Get member ID from card
      var memberID = $(".popup-opened").attr("id");
      memberID = memberID.split("-");
      memberID = memberID[1];

      jQuery.ajax({
        url: amplifyJS.ajaxurl,
        type: "POST",
        data: {
          action: "nab_bp_send_connection_message",
          message: connectionMsg,
          memberID: memberID,
        },
        success: function (data) {
          // Trigger the request again.
          $("#connection-message-popup").hide();
          $(".popup-opened").addClass("message-sent");
          $(".popup-opened").trigger("click");
          $(".popup-opened").removeClass("popup-opened");
        },
      });
    }
  });

  $(document).on(
    "click",
    ".search-actions a.not_friends, .search-actions a.pending_friend, .friend-request-action a.accept, .friend-request-action a.reject",
    function (e) {
      if (
        $(this)
          .attr("href")
          .match(/_wpnonce=/)
      ) {
        e.preventDefault();

        if ("add" === $(this).attr("rel")) {
          if (!$(this).hasClass("message-sent")) {
            if (!$("body").hasClass("connection-popup-added")) {
              $(".popup-opened").removeClass("popup-opened");
              $(this).addClass("popup-opened");

              jQuery.ajax({
                url: amplifyJS.ajaxurl,
                type: "POST",
                data: {
                  action: "nab_bp_connecton_request_popup",
                },
                success: function (data) {
                  if (0 === $("#connection-message-popup").length) {
                    $("body").append(data);
                    $("#connection-message-popup").show();
                    $("body").addClass("connection-popup-added");
                  } else {
                    $("body").addClass("connection-popup-added");
                    $("#connection-message-popup").remove();
                    $("body").append(data);
                    $("#connection-message-popup").show();
                  }
                },
              });
            }
            // Prevent request unless the message is sent.
            return false;
          } else {
            $(this).removeClass("message-sent");
            $("body").removeClass("connection-popup-added");
          }
        }

        let _this = $(this);
        let wpnonce = _this.attr("href").split("_wpnonce=")[1];
        let itemId, ajaxAction;

        if (_this.parent().hasClass("friend-request-action")) {
          let requestItem = _this.attr("href").split("/?_wpnonce")[0];
          itemId = requestItem.substring(requestItem.lastIndexOf("/") + 1);
          ajaxAction = "friends_" + _this.attr("data-bp-btn-action");
        } else {
          itemId = _this.attr("id").split("-")[1];
          ajaxAction = _this.hasClass("not_friends")
            ? "friends_add_friend"
            : "friends_withdraw_friendship";
        }

        jQuery.ajax({
          url: amplifyJS.ajaxurl,
          type: "POST",
          data: {
            action: ajaxAction,
            nonce: BP_Nouveau.nonces.friends,
            item_id: itemId,
            _wpnonce: wpnonce,
          },
          success: function (response) {
            if (response.success) {
              if (_this.parent().hasClass("friend-request-action")) {
                nab_get_friend_button(_this);
              } else {
                _this.parent().replaceWith(response.data.contents);
              }
            }
          },
        });
        return false;
      }
    }
  );

  $(document).on(
    "click",
    "#unfriend-confirmation .confirmed-answer",
    function () {
      if ("confirmed-yes" === $(this).attr("id")) {
        window.location.href = $(".popup-shown").attr("href");
      } else {
        $(".popup-shown").removeClass("popup-shown");
        $("#unfriend-confirmation").hide().removeClass("nab-modal-active");
      }
    }
  );

  // Unfriend confirmation.
  $(document).on("click", ".is_friend .remove", function (e) {
    e.preventDefault();
    $(this).addClass("popup-shown");
    $("#unfriend-confirmation").show().addClass("nab-modal-active");
  });

  // Product bookmark Ajax
  $(document).on("click", "span.user-bookmark-action", function (e) {
    let _this = $(this);
    let bm_action = _this.hasClass("bookmark-fill") ? "remove" : "add";
    let item_id = _this.attr("data-product");
    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      type: "POST",
      data: {
        action: "nab_update_member_bookmark",
        nabNonce: amplifyJS.nabNonce,
        item_id: item_id,
        bm_action: bm_action,
      },
      success: function (response) {
        let final_res = jQuery.parseJSON(response);

        if (final_res.success) {
          if (_this.hasClass("bookmark-fill")) {
            _this
              .removeClass("bookmark-fill")
              .attr("data-bp-tooltip", final_res.tooltip);
          } else {
            _this
              .addClass("bookmark-fill")
              .attr("data-bp-tooltip", final_res.tooltip);
          }
        }
      },
    });
  });

  // User bookmark list
  $(document).on("click", "#load-more-bookmark a", function (e) {
    let postPerPage = $(this).attr("data-post-limit")
      ? parseInt($(this).attr("data-post-limit"))
      : 15;
    let pageNumber = $(this).attr("data-page-number")
      ? parseInt($(this).attr("data-page-number"))
      : 15;
    let item_id = $(this).attr("data-user")
      ? parseInt($(this).attr("data-user"))
      : 0;

    $("body").addClass("is-loading");

    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      type: "POST",
      data: {
        action: "nab_member_bookmark_list",
        nabNonce: amplifyJS.nabNonce,
        item_id: item_id,
        page_number: pageNumber,
        post_limit: postPerPage,
      },
      success: function (response) {
        let bookmarkObj = jQuery.parseJSON(response);

        if (bookmarkObj.result_post && 0 < bookmarkObj.result_post.length) {
          let bookmarkListDiv = document.getElementById("bookmark-list");

          jQuery.each(bookmarkObj.result_post, function (key, value) {
            let searchItemDiv = document.createElement("div");
            searchItemDiv.setAttribute("class", "amp-item-col");

            let searchItemInner = document.createElement("div");
            searchItemInner.setAttribute("class", "amp-item-inner");

            let searchItemCover = document.createElement("div");
            searchItemCover.setAttribute("class", "amp-item-cover");

            let coverImg = document.createElement("img");
            coverImg.setAttribute("src", value.thumbnail);
            coverImg.setAttribute("alt", "Bookmark Image");

            searchItemCover.appendChild(coverImg);

            let bookmarkSpan = document.createElement("span");
            bookmarkSpan.setAttribute(
              "class",
              "fa fa-bookmark-o amp-bookmark bookmark-fill"
            );

            searchItemCover.appendChild(bookmarkSpan);
            searchItemInner.appendChild(searchItemCover);

            let searchItemInfo = document.createElement("div");
            searchItemInfo.setAttribute("class", "amp-item-info");

            let searchContent = document.createElement("div");
            searchContent.setAttribute("class", "amp-item-content");

            let bookmarkTitle = document.createElement("h4");

            let bookmarkTitleLink = document.createElement("a");
            bookmarkTitleLink.setAttribute("href", value.link);
            bookmarkTitleLink.innerText = value.title;

            bookmarkTitle.appendChild(bookmarkTitleLink);

            searchContent.appendChild(bookmarkTitle);

            let ampAction = document.createElement("div");
            ampAction.setAttribute("class", "amp-actions");

            let searchAction = document.createElement("div");
            searchAction.setAttribute("class", "search-actions");

            let viewBookmarkLink = document.createElement("a");
            viewBookmarkLink.setAttribute("href", value.link);
            viewBookmarkLink.setAttribute("class", "button");
            viewBookmarkLink.innerText = "Read More";

            searchAction.appendChild(viewBookmarkLink);
            ampAction.appendChild(searchAction);
            searchContent.appendChild(ampAction);

            searchItemInfo.appendChild(searchContent);
            searchItemInner.appendChild(searchItemInfo);
            searchItemDiv.appendChild(searchItemInner);

            bookmarkListDiv.appendChild(searchItemDiv);

            if (value.banner) {
              $("#bookmark-list").append(value.banner);
            }
          });
        }
        $("#load-more-bookmark a").attr(
          "data-page-number",
          bookmarkObj.next_page_number
        );

        if (bookmarkObj.next_page_number > bookmarkObj.total_page) {
          $("#load-more-bookmark").hide();
        } else {
          $("#load-more-bookmark").show();
        }

        $("body").removeClass("is-loading");
      },
    });
  });

  // User event list
  $(document).on("click", "#load-more-events a", function (e) {
    let postPerPage = $(this).attr("data-post-limit")
      ? parseInt($(this).attr("data-post-limit"))
      : 15;
    let pageNumber = $(this).attr("data-page-number")
      ? parseInt($(this).attr("data-page-number"))
      : 2;
    let item_id = $(this).attr("data-user")
      ? parseInt($(this).attr("data-user"))
      : 0;

    $("body").addClass("is-loading");

    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      type: "POST",
      data: {
        action: "nab_member_event_list",
        nabNonce: amplifyJS.nabNonce,
        item_id: item_id,
        page_number: pageNumber,
        post_limit: postPerPage,
      },
      success: function (response) {
        let eventObj = jQuery.parseJSON(response);

        if (eventObj.result_post && 0 < eventObj.result_post.length) {
          let eventListDiv = document.getElementById("previous-event-list");

          jQuery.each(eventObj.result_post, function (key, value) {
            let searchItemDiv = document.createElement("div");
            searchItemDiv.setAttribute("class", "amp-item-col");

            let searchItemInner = document.createElement("div");
            searchItemInner.setAttribute("class", "amp-item-inner");

            let searchItemCover = document.createElement("div");
            searchItemCover.setAttribute("class", "amp-item-cover");

            let coverImg = document.createElement("img");
            coverImg.setAttribute("src", value.thumbnail);
            coverImg.setAttribute("alt", "Event Image");

            searchItemCover.appendChild(coverImg);
            searchItemInner.appendChild(searchItemCover);

            let searchItemInfo = document.createElement("div");
            searchItemInfo.setAttribute("class", "amp-item-info");

            let searchContent = document.createElement("div");
            searchContent.setAttribute("class", "amp-item-content");

            let eventTitle = document.createElement("h4");
            eventTitle.innerText = value.title;

            searchContent.appendChild(eventTitle);

            let eventDate = document.createElement("span");
            eventDate.setAttribute("class", "company-name");
            eventDate.innerText = value.date;

            searchContent.appendChild(eventDate);

            let ampAction = document.createElement("div");
            ampAction.setAttribute("class", "amp-actions");

            let searchAction = document.createElement("div");
            searchAction.setAttribute("class", "search-actions");

            let viewEventLink = document.createElement("a");
            viewEventLink.setAttribute("href", value.link);
            viewEventLink.setAttribute("class", "button");
            viewEventLink.innerText = "View Event";

            searchAction.appendChild(viewEventLink);
            ampAction.appendChild(searchAction);
            searchContent.appendChild(ampAction);

            searchItemInfo.appendChild(searchContent);
            searchItemInner.appendChild(searchItemInfo);
            searchItemDiv.appendChild(searchItemInner);

            eventListDiv.appendChild(searchItemDiv);

            if (value.banner) {
              $("#previous-event-list").append(value.banner);
            }
          });
        }
        $("#load-more-events a").attr(
          "data-page-number",
          eventObj.next_page_number
        );

        if (eventObj.next_page_number > eventObj.total_page) {
          $("#load-more-events").hide();
        } else {
          $("#load-more-events").show();
        }

        $("body").removeClass("is-loading");
      },
    });
  });

  $(document).on("click", ".generic-button .follow-btn", function () {
    let _this = $(this);
    let search_page =
      0 < $(".nab-search-result-wrapper #search-company-list").length
        ? "yes"
        : "no";

    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      type: "POST",
      data: {
        action: "nab_company_follow_action",
        nabNonce: amplifyJS.nabNonce,
        item_id: _this.attr("data-item"),
        item_action: _this.attr("data-action"),
        search_page: search_page,
      },
      success: function (response) {
        let followObj = jQuery.parseJSON(response);

        if (followObj.success) {
          if ("follow" === _this.attr("data-action")) {
            if ("yes" !== search_page) {
              _this
                .parents(".amp-profile-content")
                .find(".amp-profile-image label")
                .append(followObj.unfollow_btn);
            }
            _this.parents(".search-actions").replaceWith(followObj.message_btn);
          } else if ("unfollow" === _this.attr("data-action")) {
            _this
              .parents(".amp-profile-content")
              .find(".amp-actions")
              .prepend(followObj.follow_btn);
            _this.parents(".unfollow-btn").remove();
          }
        }
      },
    });
  });

  $(document).on("click", ".company-claim-box .claim-link", function () {
    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      type: "POST",
      data: {
        action: "nab_user_claim_company",
        nabNonce: amplifyJS.nabNonce,
        item_id: $(this).parents(".company-message-inner").attr("data-item"),
      },
      success: function (response) {
        jQuery("body").append(
          '<div id="connection-message-popup" class="nab-modal" style="display: block;"><div class="nab-modal-inner"><div class="modal-content"><span class="nab-modal-close fa fa-times"></span><div class="modal-content-wrap nab-company-claim-popup"><p>Request sent successfully!</p></div></div></div></div>'
        );
      },
    });
  });

  $(document).on("click", ".nab-reaction-type", function () {
    let _this = $(this);

    if (
      0 <
        _this.parents(".reaction-item-list").find(".nab-reaction-type.reacted")
          .length &&
      !_this.parents(".reaction-item-list").attr("data-log")
    ) {
      return false;
    }
    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      type: "POST",
      data: {
        action: "nab_update_post_reaction",
        nabNonce: amplifyJS.nabNonce,
        item_id: _this.parents(".reaction-item-list").attr("data-item"),
        item_action: _this.attr("data-action"),
        rid: _this.attr("data-reaction"),
        item_type: _this.parents(".reaction-item-list").attr("data-item-type"),
      },
      success: function (response) {
        let reactObj = jQuery.parseJSON(response);

        if (reactObj.success) {
          if ("add" === reactObj.action.toLowerCase()) {
            _this
              .removeClass("reacted")
              .attr("data-action", reactObj.action.toLowerCase());
            _this
              .parents(".reaction-list-type")
              .find(".reaction-main-like")
              .removeClass("reacted");
          } else {
            _this
              .parents(".reaction-list-type")
              .find(".reaction-main-like")
              .addClass("reacted");
            _this
              .parents(".reaction-item-list")
              .find(".nab-reaction-type")
              .removeClass("reacted");
            _this.addClass("reacted");
            _this
              .parents(".reaction-item-list")
              .find(".nab-reaction-type")
              .attr("data-action", "add");
            _this.attr("data-action", reactObj.action.toLowerCase());
          }

          let total =
            reactObj.total && 0 < parseInt(reactObj.total)
              ? reactObj.total
              : "";
          _this
            .parents(".reaction-inner")
            .find(".user-reacted-item .react-count")
            .text(total);

          _this
            .parents(".reaction-inner")
            .find(".user-reacted-item .reacted-list")
            .html(reactObj.reacted_list);
        }
      },
    });
  });

  $(document).on("click", ".reaction-main-like", function () {
    $(this).next(".reaction-icon-modal").toggleClass("show-icon-modal");
  });

  $(document).on(
    "click",
    "#send-private-message.poc-msg-btn a, .generic-button .nab-conn-msg",
    function (e) {
      e.preventDefault();

      var member_id = $(this).parent().attr("id").split("_");
      member_id = member_id[2];

      var company_id = $(this).data("comp-id");

      jQuery.ajax({
        url: amplifyJS.ajaxurl,
        type: "POST",
        data: {
          action: "nab_bp_message_request_popup",
          company_id: company_id,
          post_type: amplifyJS.postType,
          post_id: amplifyJS.postID,
          member_id: member_id,
        },
        success: function (data) {
          if ($("#connection-message-popup").length > 0) {
            $("#connection-message-popup").remove();
            $("body").append(data);
            $("#connection-message-popup").show();
            $("body").addClass("message-popup-added");
            $(".popup-opened").removeClass("popup-opened");
            $(this).addClass("popup-opened");
            load_tinyMCE_withPlugins("#nab-connection-message");
          } else {
            $("body").append(data);
            $("#connection-message-popup").show();
            $("body").addClass("message-popup-added");
            $(".popup-opened").removeClass("popup-opened");
            $(this).addClass("popup-opened");
            load_tinyMCE_withPlugins("#nab-connection-message");
          }
        },
      });
    }
  );

  $(document).on("click", "#submit-message-request", function (e) {
    e.stopPropagation();
    var connectionMsg = "";
    if (tinyMCE.get("nab-connection-message")) {
      $("#connection-message").val(
        tinyMCE.get("nab-connection-message").getContent()
      );
      connectionMsg = $("#nab-connection-message").val();
    } else {
      connectionMsg = $("#connection-message").val();
    }

    if ("" === connectionMsg) {
      if (!$("#connection-message").hasClass("wp-editor-area")) {
        $("#connection-message").addClass("error");
      }

      $("#connection-message-form .error").show();
    } else {
      if (!$("#connection-message").hasClass("wp-editor-area")) {
        $("#connection-message").removeClass("error");
      }
      $("#connection-message-form .error").hide();

      // Get member ID from card
      var memberID = $("#connection-message-popup").data("comp-admin-id");
      jQuery.ajax({
        url: amplifyJS.ajaxurl,
        type: "POST",
        data: {
          action: "nab_bp_send_message",
          nabNonce: amplifyJS.nabNonce,
          message: connectionMsg,
          send_to: memberID,
          post_id: undefined !== amplifyJS.postID ? amplifyJS.postID : ''
        },
        beforeSend: function () {
          $("body").addClass("is-loading");
        },
        success: function (data) {
          $("body").removeClass("is-loading");
          addSuccessMsg(".modal-content-wrap", data.data.feedback);
          jQuery("#connection-message-form").trigger("reset");
        },
      });
    }
  });

  $(document).on("click", ".edit-feature-block", function (e) {
    e.preventDefault();

    var company_id = amplifyJS.postID;

    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      type: "POST",
      data: {
        action: "nab_edit_feature_block_popup",
        company_id: company_id,
      },
      success: function (data) {
        if ($("#addProductModal").length > 0) {
          $("#addProductModal").remove();
          $("body").append(data);
          $("#addProductModal").show();
          $("body").addClass("feature-block-popup-added");
          $(".popup-opened").removeClass("popup-opened");
          $(this).addClass("popup-opened");

          defaultCharCount(
            "#nab_featured_block_posted_by",
            "#character-count-featured-posyby",
            60
          );
          defaultCharCount(
            "#nab_featured_block_description",
            "#character-count-featured-desc",
            200
          );
          defaultCharCount(
            "#nab_featured_block_button_label",
            "#character-count-featured-btnlabel",
            60
          );
        } else {
          $("body").append(data);
          $("#addProductModal").show();
          $("body").addClass("feature-block-popup-added");
          $(".popup-opened").removeClass("popup-opened");
          $(this).addClass("popup-opened");
          defaultCharCount(
            "#nab_featured_block_headline",
            "#character-count-featured-headline",
            200
          );
          defaultCharCount(
            "#nab_featured_block_posted_by",
            "#character-count-featured-posyby",
            60
          );
          defaultCharCount(
            "#nab_featured_block_description",
            "#character-count-featured-desc",
            200
          );
          defaultCharCount(
            "#nab_featured_block_button_label",
            "#character-count-featured-btnlabel",
            60
          );
        }
      },
    });
  });

  $(document).on("click", "#nab-edit-featured-block-submit", function (e) {
    e.preventDefault();

    var form_data = new FormData();
    var nab_featured_block_headline = $("#nab_featured_block_headline").val();
    var nab_featured_block_title = $("#nab_featured_block_title").val();
    var nab_featured_block_posted_by = $("#nab_featured_block_posted_by").val();
    var nab_featured_block_description = $(
      "#nab_featured_block_description"
    ).val();
    var nab_featured_block_button_label = $(
      "#nab_featured_block_button_label"
    ).val();
    var nab_featured_block_button_link = $(
      "#nab_featured_block_button_link"
    ).val();

    if (!checkContentlength("#nab_featured_block_posted_by", "Posted By", 60)) {
      return false;
    }
    if (
      !checkContentlength("#nab_featured_block_description", "Description", 200)
    ) {
      return false;
    }
    if (
      !checkContentlength(
        "#nab_featured_block_button_label",
        "Button label",
        60
      )
    ) {
      return false;
    }

    form_data.append("action", "nab_edit_feature_block");
    form_data.append("company_id", amplifyJS.postID);
    form_data.append(
      "nab_featured_block_headline",
      nab_featured_block_headline
    );
    form_data.append("nab_featured_block_title", nab_featured_block_title);
    form_data.append(
      "nab_featured_block_posted_by",
      nab_featured_block_posted_by
    );
    form_data.append(
      "nab_featured_block_description",
      nab_featured_block_description
    );
    form_data.append(
      "nab_featured_block_button_label",
      nab_featured_block_button_label
    );
    form_data.append(
      "nab_featured_block_button_link",
      nab_featured_block_button_link
    );

    if (jQuery("#product_featured_image")[0].files.length > 0) {
      $.each($("#product_featured_image")[0].files, function (key, file) {
        form_data.append("nab_feature_block_bg_image", file);
      });
    }
    form_data.append(
      "nab_featured_block_remove_attachment",
      remove_featured_attachment_arr
    );
    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      processData: false,
      contentType: false,
      type: "POST",
      data: form_data,
      beforeSend: function () {
        $("body").addClass("is-loading");
      },
      success: function (data) {
        if (data.data.type == "success") {
          $("body").removeClass("is-loading");
          addSuccessMsg(
            ".add-product-content-popup",
            "Featured Block Updated Sucessfully!"
          );
        } else {
          $("body").removeClass("is-loading");
        }
      },
    });
  });

  $(document).click(function (e) {
    if (!$(e.target).is(".color-picker, .iris-picker, .iris-picker-inner") && 'function' === typeof iris) {
      $(".color-picker").iris("hide");
      //return false
    }
  });
  $(document).on("click", ".color-picker", function (event) {
    if( 'function' === typeof iris ) {
      $(".color-picker").iris("hide");
      $(this).iris("show");
      //return false
    }
  });

  $(document).on("click", "#addProductModal .nab-modal-close", function (e) {
    if (
      ($("body").hasClass("single-company") &&
        $("body").hasClass("nab-close-reload")) ||
      $("#addProductModal .woocommerce-notices-wrapper").length > 0
    ) {
      location.reload();
    }
  });

  // Content submissions.
  $(document).on( 'click', '.company-content #company-content-list .content-add-action', function () {
    $('body').addClass('is-loading');
    $('#addProductModal').remove();
    $.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: {
        action: 'nab_add_company_content_form',
        company_id: undefined !== $(this).data('company-id') ? $(this).data('company-id') : '',
        nabNonce: amplifyJS.nabNonce
      },
      success: function (response) {
        $('body').removeClass('is-loading');
        $('body').append(response);
        load_tinyMCE_withPlugins('#content-copy');
        $('#addProductModal').show().addClass('nab-modal-active');
      }
    });
  });

  $(document).on( 'change', '#nab-add-content-form #content-featured-image', function() {
    contentUploadedFeaturedImg(this);
  });

  $(document).on('click', '#content_media_wrapper .remove-featred-img', function(){
    if ( confirm( 'Are you sure want to remove?' ) ) {
      $(this).parents('.nab-content-media-item').remove();
      $(this).parents('#nab-add-content-form').find('#content-featured-image').val('');
    }
  });

  $(document).on( 'click', '.modal-content-wrap #nab-add-content-submit', function(){
    tinyMCE.triggerSave();

    var titleLimit = 60;
    var contentCopy =  $(this).parents('.modal-content-wrap').find('#nab-add-content-form #content-copy').val();

    $(this).parents('.modal-content-wrap').find('.global-notice').hide();

    if ( $(this).parents('.modal-content-wrap').find('#nab-add-content-form #content-title').val().length > titleLimit ) {
      $(this).parents('.modal-content-wrap').find('.global-notice').text('Title can not be more than ' + titleLimit + ' characters.').show();
      return false;
    } else if ( '' === $(this).parents('.modal-content-wrap').find('#nab-add-content-form #content-title').val() ) {
      $(this).parents('.modal-content-wrap').find('.global-notice').text('Title can not be empty.').show();
      return false;
    }

    if ( '' === contentCopy ) {
      $(this).parents('.modal-content-wrap').find('.global-notice').text('Content copy can not be empty.').show();
      return false;
    }

    $('body').addClass('nab-close-reload');

    var form_data = new FormData();
    var companyId = 0 < $(this).parents('.modal-content-wrap').find('#nab_company_id').length ? $(this).parents('.modal-content-wrap').find('#nab_company_id').val() : 0;
    var _this = $(this);
    form_data.append( 'action', 'nab_content_submission' );
    form_data.append( 'nabNonce', amplifyJS.nabNonce );
    form_data.append( 'company_id', companyId );
    form_data.append( 'content_title', $(this).parents('.modal-content-wrap').find('#nab-add-content-form #content-title').val() );
    form_data.append( 'content_copy', contentCopy );

    if ( '' !== $(this).parents('.modal-content-wrap').find('#nab-add-content-form #content-featured-image').val() ) {
      form_data.append( 'featured_img', $(this).parents('.modal-content-wrap').find('#nab-add-content-form #content-featured-image')[0].files[0] );
    }

    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      processData: false,
      contentType: false,
      type: 'POST',
      data: form_data,
      beforeSend: function () {
        $('body').addClass('is-loading');
      },
      success: function (response) {
        $('body').removeClass('is-loading');
        var contentData = response;

        if ( undefined !== contentData.data.msg ) {
          _this.parents('.modal-content-wrap').find('.global-notice').text(contentData.data.msg).show();
        }
        if ( contentData.success ) {
          _this.parents('.modal-content-wrap').find('#nab-add-content-form .nab-content-media-item').remove();
          _this.parents('.modal-content-wrap').find('#nab-add-content-form').trigger('reset');
        }
      }
    });
    return false;

  });

  function contentUploadedFeaturedImg(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        var fileExt = input.value.split('.').pop().toLowerCase();
        if ( $.inArray( fileExt, ['png','jpg','jpeg'] ) === -1 ) {
            $('#nab-add-content-form #content-featured-image').parents('.form-row').append('<p class="form-field-error">Invalid file type. Acceptable File Types: .jpeg. .jpg, .png.</p>');
            input.value = '';
            return false;
        } else {
          $('#nab-add-content-form #content-featured-image').parents('.form-row').find('.form-field-error').remove();
        }
        if ( 0 < $('#content_media_wrapper .preview-content-featured-img').length ) {
          $('#content_media_wrapper .preview-content-featured-img').attr('src', e.target.result);
        } else {
          var previewImg = '<div class="nab-content-media-item common-media-item"><i class="fa fa-times remove-featred-img" aria-hidden="true"></i><img src="' + e.target.result + '" class="preview-content-featured-img common-preview-img" /></div>';
          $('#content_media_wrapper').append(previewImg);
        }
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  /**
   * Downloadable PDF
   */
   $(document).on( 'click', '.company-pdfs #downloadable-pdfs-list .pdf-add-edit-action', function () {
    $('body').addClass('is-loading');
    $('#addProductModal').remove();
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
    });
  });

  $(document).on( 'change', '#nab-add-edit-pdf-form #pdf-featured-image', function() {
    renderUploadedFeaturedImg(this);
  });

  $(document).on( 'change', '#nab-add-edit-pdf-form #pdf-document', function() {
    renderUploadedPDFFile(this);
  });

  $(document).on('click', '#pdf_media_wrapper .remove-featred-img', function(){
    if ( confirm( 'Are you sure want to remove?' ) ) {
      $(this).parents('.nab-pdf-media-item').remove();
      $(this).parents('#nab-add-edit-pdf-form').find('#pdf-featured-image').val('');
    }
  });

  $(document).on('click', '#pdf_document_wrapper .remove-attached-pdf', function(){
    if ( confirm( 'Are you sure want to remove?' ) ) {
      $(this).parents('.nab-pdf-media-item').remove();
      $(this).parents('#nab-add-edit-pdf-form').find('#pdf-document').val('');
    }
  });

  $(document).on( 'keyup', '#nab-add-edit-pdf-form #pdf-description', function(){
    var maxLimit  = 200;
    var currentCount = $(this).val().length;
    var remaining = currentCount > 200 ? 0 : maxLimit - currentCount;
    $(this).parents('.form-row').find('.info-msg #pdf-desc-count').text( remaining + ' Characters Remaining');
  });

  $(document).on( 'change', '.download-pdf-input .dowload-checkbox', function(){

    if ( this.checked ) {
      $(this).parents('.amp-item-content').find('.amp-actions a.button').removeAttr('disabled');
      $(this).parents('.amp-item-content').find('.amp-actions a.button').attr('href', $(this).parents('.amp-item-content').find('.amp-actions a.button').attr('data-pdf') );
    } else {
      $(this).parents('.amp-item-content').find('.amp-actions a.button').attr('disabled', 'disabled');
      $(this).parents('.amp-item-content').find('.amp-actions a.button').attr('href', 'javascript:void(0);' );
    }
  });

  $(document).on( 'click', '#downloadable-pdfs-list .amp-action-remove .remove-pdf', function(){

    $('body').addClass('nab-modal-off-scroll');

    var pdf_id = $(this).attr('data-id');
    if ( undefined === pdf_id || '' === pdf_id ) {
      return false;
    }

    $('.error-message-popup').remove();

    var modalOuter = document.createElement('div');
    modalOuter.setAttribute('class', 'nab-modal theme-dark error-message-popup trash-pdf');

    var modalInner = document.createElement('div');
    modalInner.setAttribute('class', 'nab-modal-inner');

    var modalContent = document.createElement('div');
    modalContent.setAttribute('class', 'modal-content');

    var modalClose = document.createElement('div');
    modalClose.setAttribute('class', 'nab-modal-close fa fa-times');

    modalContent.appendChild(modalClose);

    var contentWrapper = document.createElement('div');
    contentWrapper.setAttribute('class', 'modal-content-wrap');

    var heading = document.createElement('h3');
    heading.innerText = 'Are you sure want to remove?';

    contentWrapper.appendChild(heading);

    var buttonGroup = document.createElement('div');
    buttonGroup.setAttribute('class', 'btn-group');

    var buttonYes = document.createElement('button');
    buttonYes.setAttribute('class', 'btn btn-confirm-yes');
    buttonYes.innerText = 'Yes';
    buttonYes.setAttribute('data-pdf-id', pdf_id);

    buttonGroup.appendChild( buttonYes );

    var buttonNo = document.createElement('button');
    buttonNo.setAttribute('class', 'btn btn-confirm-no');
    buttonNo.innerText = 'No';

    buttonGroup.appendChild( buttonNo );
    contentWrapper.appendChild( buttonGroup );
    modalContent.appendChild( contentWrapper );
    modalInner.appendChild(modalContent);
    modalOuter.appendChild(modalInner);

    $('body').append(modalOuter);

    $('.error-message-popup').show();

  });

  $(document).on('click', '.error-message-popup.trash-pdf .btn-confirm-yes', function(){
    var pdf_id = $(this).attr('data-pdf-id');
    $('body').addClass('is-loading');
    $('.error-message-popup').remove();
    $.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: {
        action: 'nab_remove_downloadable_pdf',
        pdf_id: pdf_id,
        nabNonce: amplifyJS.nabNonce
      },
      success: function (response) {
        $('body').removeClass('is-loading');
        location.reload();
      }
    });

  });

  $(document).on('click', '.error-message-popup.trash-pdf .btn-confirm-no', function(){
    $('.error-message-popup').remove();
    $('body').removeClass('nab-modal-off-scroll');
  });

  $(document).on( 'click', '#nab-add-edit-pdf-form #nab-edit-pdf-submit', function(){
    var doumentLimit = 60;
    var descLimit = 200;
    $(this).parents('#nab-add-edit-pdf-form').find('.global-notice').hide();

    if ( $(this).parents('#nab-add-edit-pdf-form').find('#pdf-document-name').val().length > doumentLimit ) {
      $(this).parents('#nab-add-edit-pdf-form').find('.global-notice').text('Document name can not be more than ' + doumentLimit + ' characters.').show();
      return false;
    } else if ( '' === $(this).parents('#nab-add-edit-pdf-form').find('#pdf-document-name').val() ) {
      $(this).parents('#nab-add-edit-pdf-form').find('.global-notice').text('Document name can not be empty.').show();
      return false;
    }

    if ( $(this).parents('#nab-add-edit-pdf-form').find('#pdf-description').val().length > descLimit ) {
      $(this).parents('#nab-add-edit-pdf-form').find('.global-notice').text('Document description not more than ' + descLimit + ' characters.').show();
      return false;
    }

    if ( '' === $(this).parents('#nab-add-edit-pdf-form').find('#pdf-document').val() && ( undefined === $(this).parents('#nab-add-edit-pdf-form').find('.remove-attached-pdf').attr('data-attachment-id') || '' === $(this).parents('#nab-add-edit-pdf-form').find('.remove-attached-pdf').attr('data-attachment-id') ) ) {
      $(this).parents('#nab-add-edit-pdf-form').find('.global-notice').text('Document attachment is required field.').show();
      return false;
    }

    $('body').addClass('nab-close-reload');

    var form_data = new FormData();
    var companyId = 0 < $(this).parents('#nab-add-edit-pdf-form').find('#nab_company_id').length ? $(this).parents('#nab-add-edit-pdf-form').find('#nab_company_id').val() : 0;
    var pdfId = 0 < $(this).parents('#nab-add-edit-pdf-form').find('#pdf_id').length ? $(this).parents('#nab-add-edit-pdf-form').find('#pdf_id').val() : 0;
    var _this = $(this);
    form_data.append( 'action', 'nab_downloadable_pdf' );
    form_data.append( 'nabNonce', amplifyJS.nabNonce );
    form_data.append( 'company_id', companyId );
    form_data.append( 'pdf_id', pdfId );
    form_data.append( 'pdf_title', $(this).parents('#nab-add-edit-pdf-form').find('#pdf-document-name').val() );
    form_data.append( 'pdf_desc', $(this).parents('#nab-add-edit-pdf-form').find('#pdf-description').val() );

    if ( 0 === $(this).parents('#nab-add-edit-pdf-form').find('#pdf_media_wrapper .remove-featred-img').length ) {
      form_data.append( 'remove_featured_img', true );
    }

    if ( '' !== $(this).parents('#nab-add-edit-pdf-form').find('#pdf-featured-image').val() ) {
      form_data.append( 'featured_img', $(this).parents('#nab-add-edit-pdf-form').find('#pdf-featured-image')[0].files[0] );
    }
    if ( '' !== $(this).parents('#nab-add-edit-pdf-form').find('#pdf-document').val() ) {
      form_data.append( 'pdf_file', $(this).parents('#nab-add-edit-pdf-form').find('#pdf-document')[0].files[0] );
    }

    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      processData: false,
      contentType: false,
      type: 'POST',
      data: form_data,
      beforeSend: function () {
        $('body').addClass('is-loading');
      },
      success: function (response) {
        $('body').removeClass('is-loading');
        var pdfData = response;

        if ( undefined !== pdfData.data.msg ) {
          _this.parents('#nab-add-edit-pdf-form').find('.global-notice').text(pdfData.data.msg).show();
        }
        if ( pdfData.success ) {
          if ( undefined !== pdfData.data.featured_attachment_id ) {
            _this.parents('#nab-add-edit-pdf-form').find('.remove-featred-img').attr('data-attachment-id', pdfData.data.featured_attachment_id );
          }
          if ( undefined !== pdfData.data.pdf_attachment_id ) {
            _this.parents('#nab-add-edit-pdf-form').find('.remove-attached-pdf').attr('data-attachment-id', pdfData.data.pdf_attachment_id );
          }
          if ( undefined !== pdfData.data.pdf_id ) {
            _this.parents('#nab-add-edit-pdf-form').find('#pdf_id').val( pdfData.data.pdf_id );
          }
          _this.parents('#nab-add-edit-pdf-form').find('#pdf-featured-image').val('');
          _this.parents('#nab-add-edit-pdf-form').find('#pdf-document').val('');
          _this.parents('#nab-add-edit-pdf-form').find('#nab-edit-pdf-submit').val('Update');
          _this.parents('.nab-modal-with-form').find('.add-product-content-popup h2').text('Update Downloadable PDF');
        }
      }
    });
    return false;
  });

  function renderUploadedFeaturedImg(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        var fileExt = input.value.split('.').pop().toLowerCase();
        if ( $.inArray( fileExt, ['png','jpg','jpeg'] ) === -1 ) {
            $('#nab-add-edit-pdf-form #pdf-featured-image').parents('.form-row').append('<p class="form-field-error">Invalid file type. Acceptable File Types: .jpeg. .jpg, .png.</p>');
            input.value = '';
            return false;
        } else {
          $('#nab-add-edit-pdf-form #pdf-featured-image').parents('.form-row').find('.form-field-error').remove();
        }
        if ( 0 < $('#pdf_media_wrapper .preview-pdf-featured-img').length ) {
          $('#pdf_media_wrapper .preview-pdf-featured-img').attr('src', e.target.result);
        } else {
          var previewImg = '<div class="nab-pdf-media-item"><i class="fa fa-times remove-featred-img" aria-hidden="true"></i><img src="' + e.target.result + '" class="preview-pdf-featured-img" /></div>';
          $('#pdf_media_wrapper').append(previewImg);
        }
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  function renderUploadedPDFFile(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        var fileExt = input.value.split('.').pop().toLowerCase();
        if ( 'pdf' !== fileExt ) {
            $('#nab-add-edit-pdf-form #pdf-document').parents('.form-row').append('<p class="form-field-error">Invalid file type. Only .pdf file type acceptable.</p>');
            input.value = '';
            return false;
        } else {
          $('#nab-add-edit-pdf-form #pdf-document').parents('.form-row').find('.form-field-error').remove();
        }
        if ( 0 == $('#pdf_document_wrapper .pdf-icon').length ) {
          var previewFile = '<div class="nab-pdf-media-item"><i class="fa fa-times remove-attached-pdf" aria-hidden="true"></i><span class="pdf-icon fa fa-file-pdf-o"></span></div>';
          $('#pdf_document_wrapper').append(previewFile);
        }
      }
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  // PDF Search Filters
  $(document).on('click', '#load-more-pdf a', function () {
    let pdfPageNumber = parseInt( $(this).attr('data-page-number') );
    nabSearchDownloadablePDFAjax( true, pdfPageNumber );
  })

  $(document).on( 'click', '.other-search-filter .sort-pdf a.sort-order', function () {
    if ( ! $(this).hasClass('active') ) {
      $(this).addClass('active').siblings().removeClass('active');
      nabSearchDownloadablePDFAjax(false, 1);
    }
  });
  // Downloadable PDF code end.

  // Add Events
  $(document).on( 'click', '#company-events-list .event-add-edit-action', function () {
    $('body').addClass('is-loading');
    $('#addProductModal').remove();
    $.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: {
        action: 'nab_edit_company_event',
        event_id: undefined !== $(this).data('id') ? $(this).data('id') : '',
        company_id: undefined !== $(this).data('company-id') ? $(this).data('company-id') : '',
        nabNonce: amplifyJS.nabNonce
      },
      success: function (response) {
        $('body').removeClass('is-loading');
        $('body').append(response);
        $('#addProductModal').show().addClass('nab-modal-active');
        $('#event-date').datepicker();
        $('#event-start-time').select2({ width: '100%', minimumResultsForSearch: -1 });
        $('#event-end-time').select2({ width: '100%', minimumResultsForSearch: -1 });
      }
    });
  });

  $(document).on( 'keyup', '#nab-add-edit-event-form #event-description', function(){
    var maxLimit  = 200;
    var currentCount = $(this).val().length;
    var remaining = currentCount > 200 ? 0 : maxLimit - currentCount;
    $(this).parents('.form-row').find('.info-msg #event-desc-count').text( remaining + ' Characters Remaining');
  });

  $(document).on( 'change', '#nab-add-edit-event-form #event-featured-image', function() {
    eventUploadedFeaturedImg(this);
  });

  $(document).on('click', '#event_media_wrapper .remove-featred-img', function(){
    if ( confirm( 'Are you sure want to remove?' ) ) {
      $(this).parents('.nab-event-media-item').remove();
      $(this).parents('#nab-add-edit-event-form').find('#event-featured-image').val('');
    }
  });

  $(document).on('change', '#nab-add-edit-event-form #event-start-time', function(){
    var startTimeIndex = $(this)[0].selectedIndex;
    var endTimeIndex = $(this).parents('#nab-add-edit-event-form').find('#event-end-time')[0].selectedIndex;
    if ( endTimeIndex < startTimeIndex ) {
      $(this).parents('#nab-add-edit-event-form').find('#event-end-time').val($(this).val());
      $(this).parents('#nab-add-edit-event-form').find('#event-end-time').trigger('change');
    }
  });

  $(document).on('change', '#nab-add-edit-event-form #event-end-time', function(){
    var startTimeIndex = $(this).parents('#nab-add-edit-event-form').find('#event-start-time')[0].selectedIndex;
    var endTimeIndex = $(this)[0].selectedIndex;
    if ( endTimeIndex < startTimeIndex ) {
      $(this).val($(this).parents('#nab-add-edit-event-form').find('#event-start-time').val());
      $(this).trigger('change');
    }
  });

  $(document).on( 'click', '#company-events-list .amp-action-remove .remove-event', function(){

    $('body').addClass('nab-modal-off-scroll');

    var event_id = $(this).attr('data-id');
    if ( undefined === event_id || '' === event_id ) {
      return false;
    }

    $('.error-message-popup').remove();

    var modalOuter = document.createElement('div');
    modalOuter.setAttribute('class', 'nab-modal theme-dark error-message-popup trash-event');

    var modalInner = document.createElement('div');
    modalInner.setAttribute('class', 'nab-modal-inner');

    var modalContent = document.createElement('div');
    modalContent.setAttribute('class', 'modal-content');

    var modalClose = document.createElement('div');
    modalClose.setAttribute('class', 'nab-modal-close fa fa-times');

    modalContent.appendChild(modalClose);

    var contentWrapper = document.createElement('div');
    contentWrapper.setAttribute('class', 'modal-content-wrap');

    var heading = document.createElement('h3');
    heading.innerText = 'Are you sure want to remove?';

    contentWrapper.appendChild(heading);

    var buttonGroup = document.createElement('div');
    buttonGroup.setAttribute('class', 'btn-group');

    var buttonYes = document.createElement('button');
    buttonYes.setAttribute('class', 'btn btn-confirm-yes');
    buttonYes.innerText = 'Yes';
    buttonYes.setAttribute('data-event-id', event_id);

    buttonGroup.appendChild( buttonYes );

    var buttonNo = document.createElement('button');
    buttonNo.setAttribute('class', 'btn btn-confirm-no');
    buttonNo.innerText = 'No';

    buttonGroup.appendChild( buttonNo );
    contentWrapper.appendChild( buttonGroup );
    modalContent.appendChild( contentWrapper );
    modalInner.appendChild(modalContent);
    modalOuter.appendChild(modalInner);

    $('body').append(modalOuter);

    $('.error-message-popup').show();

  });

  $(document).on('click', '.error-message-popup.trash-event .btn-confirm-yes', function(){
    var event_id = $(this).attr('data-event-id');
    $('body').addClass('is-loading');
    $('.error-message-popup').remove();
    $.ajax({
      type: 'POST',
      url: amplifyJS.ajaxurl,
      data: {
        action: 'nab_remove_company_event',
        event_id: event_id,
        nabNonce: amplifyJS.nabNonce
      },
      success: function (response) {
        $('body').removeClass('is-loading');
        location.reload();
      }
    });

  });

  $(document).on('click', '.error-message-popup.trash-event .btn-confirm-no', function(){
    $('.error-message-popup').remove();
    $('body').removeClass('nab-modal-off-scroll');
  });

  $(document).on( 'click', '#nab-add-edit-event-form #nab-edit-event-submit', function(){
    var titleLimit = 60;
    var descLimit = 200;
    $(this).parents('#nab-add-edit-event-form').find('.global-notice').hide();

    if ( $(this).parents('#nab-add-edit-event-form').find('#event-name').val().length > titleLimit ) {
      $(this).parents('#nab-add-edit-event-form').find('.global-notice').text('Event name can not be more than ' + doumentLimit + ' characters.').show();
      return false;
    } else if ( '' === $(this).parents('#nab-add-edit-event-form').find('#event-name').val() ) {
      $(this).parents('#nab-add-edit-event-form').find('.global-notice').text('Event name can not be empty.').show();
      return false;
    }

    if ( $(this).parents('#nab-add-edit-event-form').find('#event-description').val().length > descLimit ) {
      $(this).parents('#nab-add-edit-event-form').find('.global-notice').text('Event description can not more than ' + descLimit + ' characters.').show();
      return false;
    }

    if ( '' === $(this).parents('#nab-add-edit-event-form').find('#event-date').val() ) {
      $(this).parents('#nab-add-edit-event-form').find('.global-notice').text('Event date is required field.').show();
      return false;
    }

    if ( '' === $(this).parents('#nab-add-edit-event-form').find('#event-url').val() ) {
      $(this).parents('#nab-add-edit-event-form').find('.global-notice').text('Event URL is required field.').show();
      return false;
    }

    if ( ! validateURL( $(this).parents('#nab-add-edit-event-form').find('#event-url').val() ) ) {
      $(this).parents('#nab-add-edit-event-form').find('.global-notice').text('Please enter valid event URL.').show();
      return false;
    }

    $('body').addClass('nab-close-reload');

    var form_data = new FormData();
    var companyId = 0 < $(this).parents('#nab-add-edit-event-form').find('#nab_company_id').length ? $(this).parents('#nab-add-edit-event-form').find('#nab_company_id').val() : 0;
    var eventId = 0 < $(this).parents('#nab-add-edit-event-form').find('#event_id').length ? $(this).parents('#nab-add-edit-event-form').find('#event_id').val() : 0;
    var _this = $(this);
    form_data.append( 'action', 'nab_company_events' );
    form_data.append( 'nabNonce', amplifyJS.nabNonce );
    form_data.append( 'company_id', companyId );
    form_data.append( 'event_id', eventId );
    form_data.append( 'event_name', $(this).parents('#nab-add-edit-event-form').find('#event-name').val() );
    form_data.append( 'event_desc', $(this).parents('#nab-add-edit-event-form').find('#event-description').val() );
    form_data.append( 'event_date', $(this).parents('#nab-add-edit-event-form').find('#event-date').val() );
    form_data.append( 'event_start_time', $(this).parents('#nab-add-edit-event-form').find('#event-start-time').val() );
    form_data.append( 'event_end_time', $(this).parents('#nab-add-edit-event-form').find('#event-end-time').val() );
    form_data.append( 'event_url', $(this).parents('#nab-add-edit-event-form').find('#event-url').val() );

    if ( 0 === $(this).parents('#nab-add-edit-event-form').find('#event_media_wrapper .remove-featred-img').length ) {
      form_data.append( 'remove_featured_img', true );
    }

    if ( '' !== $(this).parents('#nab-add-edit-event-form').find('#event-featured-image').val() ) {
      form_data.append( 'featured_img', $(this).parents('#nab-add-edit-event-form').find('#event-featured-image')[0].files[0] );
    }

    jQuery.ajax({
      url: amplifyJS.ajaxurl,
      processData: false,
      contentType: false,
      type: 'POST',
      data: form_data,
      beforeSend: function () {
        $('body').addClass('is-loading');
      },
      success: function (response) {
        $('body').removeClass('is-loading');
        var eventData = response;

        if ( undefined !== eventData.data.msg ) {
          _this.parents('#nab-add-edit-event-form').find('.global-notice').text(eventData.data.msg).show();
        }
        if ( eventData.success ) {
          if ( undefined !== eventData.data.featured_attachment_id ) {
            _this.parents('#nab-add-edit-event-form').find('.remove-featred-img').attr('data-attachment-id', eventData.data.featured_attachment_id );
          }
          if ( undefined !== eventData.data.event_id ) {
            _this.parents('#nab-add-edit-event-form').find('#event_id').val( eventData.data.event_id );
          }
          _this.parents('#nab-add-edit-event-form').find('#event-featured-image').val('');
          _this.parents('#nab-add-edit-event-form').find('#nab-edit-event-submit').val('Update');
          _this.parents('.nab-modal-with-form').find('.add-product-content-popup h2').text('Update Event');
        }
      }
    });
    return false;
  });

  function eventUploadedFeaturedImg(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        var fileExt = input.value.split('.').pop().toLowerCase();
        if ( $.inArray( fileExt, ['png','jpg','jpeg'] ) === -1 ) {
            $('#nab-add-edit-event-form #event-featured-image').parents('.form-row').append('<p class="form-field-error">Invalid file type. Acceptable File Types: .jpeg. .jpg, .png.</p>');
            input.value = '';
            return false;
        } else {
          $('#nab-add-edit-event-form #event-featured-image').parents('.form-row').find('.form-field-error').remove();
        }
        if ( 0 < $('#event_media_wrapper .preview-event-featured-img').length ) {
          $('#event_media_wrapper .preview-event-featured-img').attr('src', e.target.result);
        } else {
          var previewImg = '<div class="nab-event-media-item common-media-item"><i class="fa fa-times remove-featred-img" aria-hidden="true"></i><img src="' + e.target.result + '" class="preview-event-featured-img common-preview-img" /></div>';
          $('#event_media_wrapper').append(previewImg);
        }
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  
})(jQuery);

// Downloadable PDF Search Ajax.
function nabSearchDownloadablePDFAjax (loadMore, pageNumber) {

  let postPerPage = jQuery('#load-more-pdf a').attr('data-post-limit') ? parseInt(jQuery('#load-more-pdf a').attr('data-post-limit')) : 12;
  let searchTerm = 0 < jQuery('.search-result-filter .search-form input[name="s"]').length ? jQuery('.search-result-filter .search-form input[name="s"]').val() : '';
  let orderBy = 0 < jQuery('.other-search-filter .sort-pdf a.active').length ? jQuery('.other-search-filter .sort-pdf a.active').attr('data-order') : 'date';

  jQuery('body').addClass('is-loading');

  jQuery.ajax({
    url: amplifyJS.ajaxurl,
    type: 'POST',
    data: {
      action: 'nab_pdf_search_filter',
      nabNonce: amplifyJS.nabNonce,
      page_number: pageNumber,
      post_limit: postPerPage,
      search_term: searchTerm,
      orderby: orderBy
    },
    success: function (response) {
      if (!loadMore) {
        jQuery('#downloadable-pdfs-list').empty()
      }
      let pdfObj = jQuery.parseJSON(response)

      if ('' !== pdfObj.result_post && 0 < pdfObj.result_post.length ) {
        let pdfListDiv = document.getElementById('downloadable-pdfs-list');

        jQuery.each(pdfObj.result_post, function (key, value) {
          let itemCol = document.createElement('div');
          itemCol.setAttribute('class', 'amp-item-col');

          let itemInner = document.createElement('div');
          itemInner.setAttribute('class', 'amp-item-inner');

          let searchItemCover = document.createElement('div');
          searchItemCover.setAttribute('class', 'amp-item-cover');

          let thumbnail = document.createElement('img');
          thumbnail.setAttribute('src', value.thumbnail);
          thumbnail.setAttribute('alt', 'PDF Thumbnail');

          searchItemCover.appendChild(thumbnail);

          itemInner.appendChild(searchItemCover);

          let itemInfo = document.createElement('div');
          itemInfo.setAttribute('class', 'amp-item-info');

          let itemContent = document.createElement('div');
          itemContent.setAttribute('class', 'amp-item-content');

          let heading = document.createElement('h4');
          heading.innerText = value.title;

          itemContent.appendChild(heading);

          if ( pdfObj.login ) {
            let inputDiv = document.createElement('div');
            inputDiv.setAttribute('class', 'download-pdf-input');

            let checkContainer = document.createElement('div');
            checkContainer.setAttribute('class', 'amp-check-container');

            let checkWrp = document.createElement('div');
            checkWrp.setAttribute('class', 'amp-check-wrp');

            let inputCheckBox = document.createElement('input');
            inputCheckBox.setAttribute('class', 'dowload-checkbox');
            inputCheckBox.setAttribute('type', 'checkbox');
            inputCheckBox.setAttribute('id', 'download-checkbox-' + value.pdf_id);

            let checkSpan = document.createElement('span');
            checkSpan.setAttribute('class', 'amp-check');

            checkWrp.appendChild(inputCheckBox);
            checkWrp.appendChild(checkSpan);
            checkContainer.appendChild(checkWrp);

            let inputLabel = document.createElement('label');
            inputLabel.setAttribute('for', 'download-checkbox-' + value.pdf_id );
            inputLabel.innerText = 'I agree to receive additional information and communications from ' + value.company;

            checkContainer.appendChild(inputLabel);
            inputDiv.appendChild(checkContainer);
            itemContent.appendChild(inputDiv);

            let actions = document.createElement('div');
            actions.setAttribute('class', 'amp-actions');

            let searchActions = document.createElement('div');
            searchActions.setAttribute('class', 'search-actions nab-action');

            let downloadLink = document.createElement('a');
            downloadLink.setAttribute('class', 'button');
            downloadLink.setAttribute('data-pdf', value.pdf_url);
            downloadLink.setAttribute('disabled', 'disabled');
            downloadLink.setAttribute('download', 'download');
            downloadLink.setAttribute('href', 'javascript:void(0);');
            downloadLink.innerText = 'Download';

            searchActions.appendChild(downloadLink);
            actions.appendChild(searchActions);
            itemContent.appendChild(actions);

            if ( undefined !== value.content && '' !== value.content ) {
              let iIcon = document.createElement('i');
              iIcon.setAttribute('class', 'fa fa-info-circle tooltip-wrap');
              iIcon.setAttribute('aria-hidden', 'true');

              let contentTooltip = document.createElement('span');
              contentTooltip.setAttribute('class', 'tooltip');
              contentTooltip.innerText = value.content;

              iIcon.appendChild(contentTooltip);
              itemContent.appendChild(iIcon);
            }
          } else {
            let msgDiv = document.createElement('div');
            msgDiv.setAttribute('class', 'amp-pdf-login-msg');

            let msgP = document.createElement('p');

            let loginLink = document.createElement('a');
            loginLink.setAttribute('href', pdfObj.login_url);
            loginLink.innerText = "Sign in now";

            msgP.innerText = "You must be signed in to download this content. ";
            msgP.appendChild(loginLink);
            msgP.innerHTML = msgP.innerHTML + '.';
            msgDiv.appendChild(msgP);
            itemContent.appendChild(msgDiv);
          }

          itemInfo.appendChild(itemContent);
          itemInner.appendChild(itemInfo);
          itemCol.appendChild(itemInner);

          pdfListDiv.appendChild(itemCol);

          if ( value.banner ) {
            jQuery('#downloadable-pdfs-list').append(value.banner);
          }
        });
      }
      jQuery('#load-more-pdf a').attr('data-page-number', pdfObj.next_page_number );

      if ( pdfObj.next_page_number > pdfObj.total_page ) {
        jQuery('#load-more-pdf').hide();
      } else {
        jQuery('#load-more-pdf').show();
      }

      if (0 === pdfObj.total_page) {
        jQuery('#downloadable-pdfs-list').empty().parents('.nab-search-result-wrapper').find('p.no-search-data').show();
      } else {
        jQuery('#downloadable-pdfs-list').parents('.nab-search-result-wrapper').find('p.no-search-data').hide();
      }
      jQuery('.search-view-top-head .pdf-search-count').text( pdfObj.total_pdf + ' Results for ');
      jQuery('body').removeClass('is-loading');
    }
  })
}

function nabAddProdBlankImage(unique_key) {
  jQuery('#product_media_wrapper').append(
      '<div class="nab-product-media-item" ><button type="button" class="nab-remove-attachment" data-attach-id="0"><i class="fa fa-times" aria-hidden="true"></i></button><img id="product_media_preview_' +
      unique_key +
      '" src="#" alt="your image" style="display:none;"/></div>'
  );
}

// Get friend button
function nab_get_friend_button(_this) {
  let itemId = _this.parent().attr("data-item");

  jQuery.ajax({
    url: amplifyJS.ajaxurl,
    type: "POST",
    data: {
      action: "nab_get_friend_button",
      nabNonce: amplifyJS.nabNonce,
      item_id: itemId,
    },
    success: function (response) {
      let buttonObj = jQuery.parseJSON(response);

      if (buttonObj.success) {
        _this.parents(".search-actions").replaceWith(buttonObj.content);
      }
    },
  });
}

/** User Search Ajax */
function nabSearchUserAjax(loadMore, pageNumber) {
  let connected = "";
  let country = "";
  let state = "";
  let city = "";
  let pageType = jQuery("#load-more-user a").attr("data-page-type");
  let postPerPage = jQuery("#load-more-user a").attr("data-post-limit")
    ? parseInt(jQuery("#load-more-user a").attr("data-post-limit"))
    : 15;
  let searchTerm =
    0 < jQuery('.search-result-filter .search__form input[name="s"]').length
      ? jQuery('.search-result-filter .search__form input[name="s"]').val()
      : "";
  let company =
    0 < jQuery(".other-search-filter .company-search .input-company").length
      ? jQuery(".other-search-filter .company-search .input-company").val()
      : "";
  let orderBy =
    0 < jQuery(".other-search-filter .sort-user a.active").length
      ? jQuery(".other-search-filter .sort-user a.active").attr("data-order")
      : "newest";

  let jobTitle =
    0 < jQuery(".other-search-filter .job-title-search .input-job-title").length
      ? jQuery(".other-search-filter .job-title-search .input-job-title").val()
      : "";

  if (0 < jQuery(".other-search-filter #people-connect").length) {
    connected =
      0 === jQuery(".other-search-filter #people-connect")[0].selectedIndex
        ? ""
        : jQuery(".other-search-filter #people-connect").val();
  }

  if (0 < jQuery(".other-search-filter #search-country-select").length) {
    country =
      0 ===
      jQuery(".other-search-filter #search-country-select")[0].selectedIndex
        ? ""
        : jQuery(".other-search-filter #search-country-select").val();
  }
  if (0 < jQuery(".other-search-filter #search-state-select").length) {
    state =
      0 === jQuery(".other-search-filter #search-state-select")[0].selectedIndex
        ? ""
        : jQuery(".other-search-filter #search-state-select").val();
  }

  if (0 < jQuery(".other-search-filter #search-city-select").length) {
    city =
      0 === jQuery(".other-search-filter #search-city-select")[0].selectedIndex
        ? ""
        : jQuery(".other-search-filter #search-city-select").val();
  }

  jQuery("body").addClass("is-loading");

  jQuery.ajax({
    url: amplifyJS.ajaxurl,
    type: "POST",
    data: {
      action: "nab_member_search_filter",
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
      orderby: orderBy,
    },
    success: function (response) {
      if (!loadMore) {
        jQuery("#search-user-list").empty();
      }
      let userObj = jQuery.parseJSON(response);

      if ("" !== userObj.result_user && 0 < userObj.result_user.length) {
        if ("connections" === pageType) {
          var userListDiv = "#connections-user-list";
          var userCardDiv = "amp-item-col";
          var userCardInnerDiv = "amp-item-inner";
          var userCardCoverDiv = "amp-item-cover";
          var userRemoveIconDiv = "amp-action-remove";
          var userCardInfoDiv = "amp-item-info";
          var userCardAvtarDiv = "amp-item-avtar";
          var userCardContentDiv = "amp-item-content";
        } else {
          var userListDiv = "#search-user-list";
          var userCardDiv = "";
          var userCardInnerDiv = "result _person";
          var userCardCoverDiv = "result__hide";
          var userRemoveIconDiv = "";
          var userCardInfoDiv = "";
          var userCardAvtarDiv = "result__imageWrap";
          var userCardContentDiv = "search-item-content";
        }

        jQuery.each(userObj.result_user, function (key, value) {
          let searchItemDiv = document.createElement("li");
          searchItemDiv.setAttribute("class", userCardDiv);

          let searchItemInner = document.createElement("div");
          searchItemInner.setAttribute("class", userCardInnerDiv);

          if (
            "connections" === pageType &&
            undefined !== value.cancel_friendship_button &&
            "" !== value.cancel_friendship_button
          ) {
            let cancelFriendshipButton = document.createElement("div");
            cancelFriendshipButton.setAttribute("class", userRemoveIconDiv);
            cancelFriendshipButton.innerHTML = value.cancel_friendship_button;
            searchItemInner.appendChild(cancelFriendshipButton);
          }

          let searchItemCover = document.createElement("div");
          searchItemCover.setAttribute("class", userCardCoverDiv);

          let coverImg = document.createElement("img");
          coverImg.setAttribute("src", value.cover_img);
          coverImg.setAttribute("alt", "Cover Image");

          searchItemCover.appendChild(coverImg);
          searchItemInner.appendChild(searchItemCover);

          let searchItemInfo = document.createElement("div");
          searchItemInfo.setAttribute("class", userCardInfoDiv);

          let avatarDiv = document.createElement("div");
          avatarDiv.setAttribute("class", userCardAvtarDiv);

          avatarImgLink = document.createElement("a");
          avatarImgLink.setAttribute("href", value.link);
          avatarImgLink.innerHTML = value.avatar;

          avatarDiv.appendChild(avatarImgLink);
          searchItemInfo.appendChild(avatarDiv);

          let searchContent = document.createElement("div");
          searchContent.setAttribute("class", userCardContentDiv);

          let userName = document.createElement("h4");
          userName.setAttribute("class", "result__title");

          nameLink = document.createElement("a");
          nameLink.setAttribute("href", value.link);
          nameLink.innerText = value.name;

          userName.appendChild(nameLink);
          searchContent.appendChild(userName);

          let userCompany = document.createElement("span");
          userCompany.setAttribute("class", "company-name");
          userCompany.innerText =
            "" !== value.title
              ? value.title + " | " + value.company
              : value.company;

          searchContent.appendChild(userCompany);

          if (
            0 <
            jQuery('.search-result-filter .search__form input[name="s"]').length
          ) {
            let viewSearchAction = document.createElement("div");
            viewSearchAction.setAttribute("class", "search-actions");

            let viewButton = document.createElement("a");
            viewButton.setAttribute("href", value.link);
            viewButton.setAttribute("class", "button");
            viewButton.innerText = "View";

            viewSearchAction.appendChild(viewButton);
            searchContent.appendChild(viewSearchAction);
          }

          if (undefined !== value.action_button && "" !== value.action_button) {
            let searchAction = document.createElement("div");
            searchAction.setAttribute("class", "search-actions");
            searchAction.innerHTML = value.action_button;

            searchContent.appendChild(searchAction);
          }

          searchItemInfo.appendChild(searchContent);
          searchItemInner.appendChild(searchItemInfo);
          searchItemDiv.appendChild(searchItemInner);

          jQuery(userListDiv).append(searchItemDiv);

          if (value.banner) {
            jQuery(userListDiv).append(value.banner);
          }
        });
      }
      jQuery("#load-more-user a").attr(
        "data-page-number",
        userObj.next_page_number
      );

      if (userObj.next_page_number > userObj.total_page) {
        jQuery("#load-more-user").hide();
      } else {
        jQuery("#load-more-user").show();
      }

      if (0 === userObj.total_page) {
        jQuery(userListDiv)
          .empty()
          .parents(".nab-search-result-wrapper")
          .find("p.no-search-data")
          .show();
      } else {
        jQuery(userListDiv)
          .parents(".nab-search-result-wrapper")
          .find("p.no-search-data")
          .hide();
      }

      if (0 !== jQuery(".search-view-top-head .user-search-count").length) {
        jQuery(".search-view-top-head .user-search-count").text(
          userObj.total_user + " Results for "
        );
      }

      jQuery("body").removeClass("is-loading");
    },
  });
}

/** company search ajax */
function nabSearchCompanyAjax(loadMore, pageNumber) {
  let category;
  let postPerPage = jQuery("#load-more-company a").attr("data-post-limit")
    ? parseInt(jQuery("#load-more-company a").attr("data-post-limit"))
    : 15;
  let searchTerm =
    0 < jQuery('.search-result-filter .search__form input[name="s"]').length
      ? jQuery('.search-result-filter .search__form input[name="s"]').val()
      : "";
  let orderBy =
    0 < jQuery(".other-search-filter .sort-company a.active").length
      ? jQuery(".other-search-filter .sort-company a.active").attr("data-order")
      : "meta";

  if (0 < jQuery(".other-search-filter #company-category-filter").length) {
    category =
      0 ===
      jQuery(".other-search-filter #company-category-filter")[0].selectedIndex
        ? ""
        : jQuery(".other-search-filter #company-category-filter").val();
  }

  jQuery("body").addClass("is-loading");

  jQuery.ajax({
    url: amplifyJS.ajaxurl,
    type: "POST",
    data: {
      action: "nab_company_search_filter",
      nabNonce: amplifyJS.nabNonce,
      page_number: pageNumber,
      post_limit: postPerPage,
      search_term: searchTerm,
      product_category: category,
      orderby: orderBy,
    },
    success: function (response) {
      if (!loadMore) {
        jQuery("#search-company-list").empty();
      }
      let companyObj = jQuery.parseJSON(response);

      if ("" !== companyObj.result_post && 0 < companyObj.result_post.length) {
        let companyListDiv = document.getElementById("search-company-list");

        jQuery.each(companyObj.result_post, function (key, value) {
          let searchItemDiv = document.createElement("li");
          searchItemDiv.setAttribute("class", "");

          let searchItemInner = document.createElement("div");
          searchItemInner.setAttribute("class", "result");

          let searchItemCover = document.createElement("div");
          searchItemCover.setAttribute("class", "search-item-cover");

          let coverImg = document.createElement("img");
          coverImg.setAttribute("src", value.cover_img);
          coverImg.setAttribute("alt", "Cover Image");

          searchItemCover.appendChild(coverImg);

          //searchItemInner.appendChild(searchItemCover)

          let searchItemInfo = document.createElement("div");
          searchItemInfo.setAttribute("class", "result__info");

          let searchItemProfile = document.createElement("div");
          searchItemProfile.setAttribute("class", "result__avtar");

          let avatarLink = document.createElement("a");
          avatarLink.setAttribute("href", value.link);

          let companyProfile;

          if (undefined !== value.profile) {
            companyProfile = document.createElement("img");
            companyProfile.setAttribute("class", "result__image");
            companyProfile.setAttribute("src", value.profile);
          } else {
            companyProfile = document.createElement("div");
            companyProfile.setAttribute(
              "class",
              "result__image no-image-avtar"
            );
            companyProfile.innerText = value.no_pic;
          }

          //avatarLink.appendChild(companyProfile)
          searchItemProfile.appendChild(companyProfile);
          searchItemInfo.appendChild(searchItemProfile);

          let searchContent = document.createElement("div");
          searchContent.setAttribute("class", "result__content");

          let companyTitle = document.createElement("h4");
          companyTitle.setAttribute("class", "result__title");
          companyTitle.innerText = value.title;
          searchContent.appendChild(companyTitle);

          let searchAction = document.createElement('div')
          searchAction.innerHTML = value.button

          searchContent.appendChild(searchAction);

          searchItemInfo.appendChild(searchContent);
          searchItemInner.appendChild(searchItemInfo);
          searchItemDiv.appendChild(searchItemInner);

          companyListDiv.appendChild(searchItemDiv);

          if (value.banner) {
            jQuery("#search-company-list").append(value.banner);
          }
        });
      }
      jQuery("#load-more-company a").attr(
        "data-page-number",
        companyObj.next_page_number
      );

      if (companyObj.next_page_number > companyObj.total_page) {
        jQuery("#load-more-company").hide();
      } else {
        jQuery("#load-more-company").show();
      }

      if (0 === companyObj.total_page) {
        jQuery("#search-company-list")
          .empty()
          .parents(".nab-search-result-wrapper")
          .find("p.no-search-data")
          .show();
      } else {
        jQuery("#search-company-list")
          .parents(".nab-search-result-wrapper")
          .find("p.no-search-data")
          .hide();
      }

      jQuery(".search-view-top-head .company-search-count").text(
        companyObj.total_company + " Results for "
      );

      jQuery("body").removeClass("is-loading");
    },
  });
}

/** company product search ajax */
function nabSearchCompanyProductAjax(loadMore, pageNumber) {
  let category;
  let postPerPage = jQuery("#load-more-company-product a").attr(
    "data-post-limit"
  )
    ? parseInt(jQuery("#load-more-company-product a").attr("data-post-limit"))
    : 15;
  let searchTerm =
    0 < jQuery('.search-result-filter .search__form input[name="s"]').length
      ? jQuery('.search-result-filter .search__form input[name="s"]').val()
      : "";
  let orderBy =
    0 < jQuery(".other-search-filter .sort-company-product a.active").length
      ? jQuery(".other-search-filter .sort-company-product a.active").attr(
          "data-order"
        )
      : "date";

  if (0 < jQuery(".other-search-filter #company-product-category").length) {
    category =
      0 ===
      jQuery(".other-search-filter #company-product-category")[0].selectedIndex
        ? ""
        : jQuery(".other-search-filter #company-product-category").val();
  }

  jQuery("body").addClass("is-loading");

  jQuery.ajax({
    url: amplifyJS.ajaxurl,
    type: "POST",
    data: {
      action: "nab_company_product_search_filter",
      nabNonce: amplifyJS.nabNonce,
      page_number: pageNumber,
      post_limit: postPerPage,
      search_term: searchTerm,
      product_category: category,
      orderby: orderBy,
    },
    success: function (response) {
      if (!loadMore) {
        jQuery("#company-products-list").empty();
      }
      let productObj = jQuery.parseJSON(response);

      if ("" !== productObj.result_post && 0 < productObj.result_post.length) {
        let productListDiv = document.getElementById("company-products-list");

        jQuery.each(productObj.result_post, function (key, value) {
          let searchItemDiv = document.createElement("li");
          searchItemDiv.setAttribute("class", "");

          let searchItemInner = document.createElement("div");
          searchItemInner.setAttribute("class", "result _content");

          let searchItemCover = document.createElement("a");
          searchItemCover.setAttribute("class", "result__imgLink");
          searchItemCover.setAttribute("href", value.link);

          let coverImg = document.createElement("img");
          coverImg.setAttribute("class", "result__image");
          coverImg.setAttribute("src", value.thumbnail);
          coverImg.setAttribute("alt", "Product Image");

          searchItemCover.appendChild(coverImg);

          if (value.bookmark_class) {
            let bookmarkSpan = document.createElement("span");

            bookmarkSpan.setAttribute("class", value.bookmark_class);
            bookmarkSpan.setAttribute(
              "data-bp-tooltip",
              value.bookmark_tooltip
            );
            bookmarkSpan.setAttribute("data-product", value.bookmark_id);

            searchItemCover.appendChild(bookmarkSpan);
          }

          searchItemInner.appendChild(searchItemCover);

          let searchItemInfo = document.createElement("div");
          searchItemInfo.setAttribute("class", "result__info");

          let searchContent = document.createElement("div");
          searchContent.setAttribute("class", "result__content");

          let porductTitle = document.createElement("h4");
          porductTitle.setAttribute("class", "result__title");

          let productTitleLink = document.createElement("a");
          productTitleLink.setAttribute("href", value.link);
          productTitleLink.innerText = value.title;

          porductTitle.appendChild(productTitleLink);

          let productCompany = document.createElement("h5");
          productCompany.setAttribute("class", "result__lede");
          productCompany.innerText = value.company;

          searchContent.appendChild(porductTitle);
          searchContent.appendChild(productCompany);

          let searchActionWrap = document.createElement("div");
          searchActionWrap.setAttribute("class", "");

          let searchAction = document.createElement("div");
          searchAction.setAttribute("class", "");

          let viewProdutLink = document.createElement("a");
          viewProdutLink.setAttribute("href", value.link);
          viewProdutLink.setAttribute("class", "button result__button");
          viewProdutLink.innerText = "View";

          searchAction.appendChild(viewProdutLink);
          searchActionWrap.appendChild(searchAction);
          searchContent.appendChild(searchActionWrap);

          searchItemInfo.appendChild(searchContent);
          searchItemInner.appendChild(searchItemInfo);
          searchItemDiv.appendChild(searchItemInner);

          productListDiv.appendChild(searchItemDiv);

          if (value.banner) {
            jQuery("#company-products-list").append(value.banner);
          }
        });
      }
      jQuery("#load-more-company-product a").attr(
        "data-page-number",
        productObj.next_page_number
      );

      if (productObj.next_page_number > productObj.total_page) {
        jQuery("#load-more-company-product").hide();
      } else {
        jQuery("#load-more-company-product").show();
      }

      if (0 === productObj.total_page) {
        jQuery("#company-products-list")
          .empty()
          .parents(".nab-search-result-wrapper")
          .find("p.no-search-data")
          .show();
      } else {
        jQuery("#company-products-list")
          .parents(".nab-search-result-wrapper")
          .find("p.no-search-data")
          .hide();
      }

      jQuery(".search-view-top-head .company-product-search-count").text(
        productObj.total_product + " Results for "
      );

      jQuery("body").removeClass("is-loading");
    },
  });
}

/** Product Search Ajax */
function nabSearchProductAjax(loadMore, pageNumber) {
  let category = "";
  let postPerPage = jQuery("#load-more-product a").attr("data-post-limit")
    ? parseInt(jQuery("#load-more-product a").attr("data-post-limit"))
    : 15;
  let searchTerm =
    0 < jQuery('.search-result-filter .search__form input[name="s"]').length
      ? jQuery('.search-result-filter .search__form input[name="s"]').val()
      : "";
  let orderBy =
    0 < jQuery(".other-search-filter .sort-product a.active").length
      ? jQuery(".other-search-filter .sort-product a.active").attr("data-order")
      : "popularity";
  if (0 < jQuery(".other-search-filter #product-category").length) {
    category =
      0 === jQuery(".other-search-filter #product-category")[0].selectedIndex
        ? ""
        : jQuery(".other-search-filter #product-category").val();
  }

  jQuery("body").addClass("is-loading");

  jQuery.ajax({
    url: amplifyJS.ajaxurl,
    type: "POST",
    data: {
      action: "nab_product_search_filter",
      nabNonce: amplifyJS.nabNonce,
      page_number: pageNumber,
      post_limit: postPerPage,
      search_term: searchTerm,
      category: category,
      orderby: orderBy,
    },
    success: function (response) {
      if (!loadMore) {
        jQuery("#search-product-list").empty();
      }
      let productObj = jQuery.parseJSON(response);

      if ("" !== productObj.result_post && 0 < productObj.result_post.length) {
        let productListDiv = document.getElementById("search-product-list");

        jQuery.each(productObj.result_post, function (key, value) {
          let searchItemDiv = document.createElement("div");
          searchItemDiv.setAttribute("class", "search-item");

          let searchItemInner = document.createElement("div");
          searchItemInner.setAttribute("class", "search-item-inner");

          let searchItemCover = document.createElement("div");
          searchItemCover.setAttribute("class", "search-item-cover");

          let coverImg = document.createElement("img");
          coverImg.setAttribute("src", value.thumbnail);
          coverImg.setAttribute("alt", "product thumbnail");

          searchItemCover.appendChild(coverImg);

          if (value.bookmark_class) {
            let bookmarkSpan = document.createElement("span");

            bookmarkSpan.setAttribute("class", value.bookmark_class);
            bookmarkSpan.setAttribute(
              "data-bp-tooltip",
              value.bookmark_tooltip
            );
            bookmarkSpan.setAttribute("data-product", value.bookmark_id);

            searchItemCover.appendChild(bookmarkSpan);
          }

          searchItemInner.appendChild(searchItemCover);

          let searchItemInfo = document.createElement("div");
          searchItemInfo.setAttribute("class", "search-item-info");

          let searchContent = document.createElement("div");
          searchContent.setAttribute("class", "search-item-content");

          let porductTitle = document.createElement("h4");

          let productTitleLink = document.createElement("a");
          productTitleLink.setAttribute("href", value.link);
          productTitleLink.innerText = value.title;

          porductTitle.appendChild(productTitleLink);

          searchContent.appendChild(porductTitle);

          let searchAction = document.createElement("div");
          searchAction.setAttribute("class", "search-actions");

          let viewProdutLink = document.createElement("a");
          viewProdutLink.setAttribute("href", value.link);
          viewProdutLink.setAttribute("class", "button");
          viewProdutLink.innerText = "View Product";

          searchAction.appendChild(viewProdutLink);
          searchContent.appendChild(searchAction);

          searchItemInfo.appendChild(searchContent);
          searchItemInner.appendChild(searchItemInfo);
          searchItemDiv.appendChild(searchItemInner);

          productListDiv.appendChild(searchItemDiv);

          if (value.banner) {
            jQuery("#search-product-list").append(value.banner);
          }
        });
      }
      jQuery("#load-more-product a").attr(
        "data-page-number",
        productObj.next_page_number
      );

      if (productObj.next_page_number > productObj.total_page) {
        jQuery("#load-more-product").hide();
      } else {
        jQuery("#load-more-product").show();
      }

      if (0 === productObj.total_page) {
        jQuery("#search-product-list")
          .empty()
          .parents(".nab-search-result-wrapper")
          .find("p.no-search-data")
          .show();
      } else {
        jQuery("#search-product-list")
          .parents(".nab-search-result-wrapper")
          .find("p.no-search-data")
          .hide();
      }

      jQuery(".search-view-top-head .product-search-count").text(
        productObj.total_product + " Results for "
      );

      jQuery("body").removeClass("is-loading");
    },
  });
}

/** Event Search Ajax */
function nabSearchEventAjax(loadMore, pageNumber) {
  let postPerPage = jQuery("#load-more-event a").attr("data-post-limit")
    ? parseInt(jQuery("#load-more-event a").attr("data-post-limit"))
    : 15;
  let searchTerm =
    0 < jQuery('.search-result-filter .search__form input[name="s"]').length
      ? jQuery('.search-result-filter .search__form input[name="s"]').val()
      : "";
  let eventType =
    0 < jQuery(".other-search-filter .event-type a.active").length
      ? jQuery(".other-search-filter .event-type a.active").attr("data-event")
      : "upcoming";

  jQuery("body").addClass("is-loading");

  jQuery.ajax({
    url: amplifyJS.ajaxurl,
    type: "POST",
    data: {
      action: "nab_event_search_filter",
      nabNonce: amplifyJS.nabNonce,
      page_number: pageNumber,
      post_limit: postPerPage,
      search_term: searchTerm,
      event_type: eventType,
    },
    success: function (response) {
      if (!loadMore) {
        jQuery("#search-event-list").empty();
      }
      let eventObj = jQuery.parseJSON(response);

      if ("" !== eventObj.result_post && 0 < eventObj.result_post.length) {
        let contentListDiv = document.getElementById("search-event-list");

        jQuery.each(eventObj.result_post, function (key, value) {
          let searchItemDiv = document.createElement("li");
          searchItemDiv.setAttribute("class", "");

          let searchItemInner = document.createElement("a");
          searchItemInner.setAttribute("class", "event");
          searchItemInner.setAttribute("href", value.link);

          if (value.target) {
            searchItemInner.setAttribute("target", value.target);
          }

          let eventDate = document.createElement("div");
          eventDate.setAttribute("class", "event__date");

          let eventMonth = document.createElement("div");
          eventMonth.setAttribute("class", "event__month");
          eventMonth.innerText = value.event_month;

          let eventDay = document.createElement("div");
          eventDay.setAttribute("class", "event__day text-gradient _blue");
          eventDay.innerText = value.event_day;

          eventDate.appendChild(eventMonth);
          eventDate.appendChild(eventDay);
          searchItemInner.appendChild(eventDate);

          let searchItemCover = document.createElement("div");
          searchItemCover.setAttribute("class", "event__photo");

          if (undefined !== value.past_event && value.past_event) {
            let labelWrapper = document.createElement("div");
            labelWrapper.setAttribute("class", "amp-draft-wrapper");

            let lableSpan = document.createElement("span");
            lableSpan.setAttribute("class", "company-product-draft");
            lableSpan.innerText = "Past Event";

            labelWrapper.appendChild(lableSpan);
            searchItemCover.appendChild(labelWrapper);
          }

          let coverImg = document.createElement("img");
          coverImg.setAttribute("class", "event__image");
          coverImg.setAttribute("src", value.thumbnail);
          coverImg.setAttribute("alt", "event thumbnail");

          searchItemCover.appendChild(coverImg);
          searchItemInner.appendChild(searchItemCover);

          let searchItemInfo = document.createElement("div");
          searchItemInfo.setAttribute("class", "event__info");

          let postTitle = document.createElement("h4");
          postTitle.setAttribute("class", "event__title");
          postTitle.innerText = value.title;

          let eventLink = document.createElement("div");
          eventLink.setAttribute("class", "event__link link _plus");
          eventLink.innerText = "Learn More";

          searchItemInfo.appendChild(postTitle);

          if ( undefined !== value.event_time ) {
            let eventTime = document.createElement('span');
            eventTime.setAttribute('class', 'event-time');
            eventTime.innerText = value.event_time;
            searchItemInfo.appendChild(eventTime);
          }

          if ( undefined !== value.company_title ) {
            let titleP = document.createElement('p');
            titleP.setAttribute('class', 'company-info');

            let companyLink = document.createElement('a');
            companyLink.setAttribute('href', value.company_link);
            companyLink.innerText = value.company_title;

            titleP.appendChild(companyLink);
            searchItemInfo.appendChild(titleP);
          }

          searchItemInfo.appendChild(eventLink);

          if ( undefined !== value.event_content && '' !== value.event_content ) {
            let iIcon = document.createElement('i');
            iIcon.setAttribute('class', 'fa fa-info-circle tooltip-wrap');
            iIcon.setAttribute('aria-hidden', 'true');

            let contentSpan = document.createElement('span');
            contentSpan.setAttribute('class', 'tooltip');
            contentSpan.innerText = value.event_content;

            iIcon.appendChild(contentSpan);
            searchItemInfo.appendChild(iIcon);
          }
          
          searchItemInner.appendChild(searchItemInfo);
          searchItemDiv.appendChild(searchItemInner);

          contentListDiv.appendChild(searchItemDiv);

          if (value.banner) {
            jQuery("#search-event-list").append(value.banner);
          }
        });
      }
      jQuery("#load-more-event a").attr(
        "data-page-number",
        eventObj.next_page_number
      );

      if (eventObj.next_page_number > eventObj.total_page) {
        jQuery("#load-more-event").hide();
      } else {
        jQuery("#load-more-event").show();
      }

      if (0 === eventObj.total_page) {
        jQuery("#search-event-list")
          .empty()
          .parents(".nab-search-result-wrapper")
          .find("p.no-search-data")
          .show();
      } else {
        jQuery("#search-event-list")
          .parents(".nab-search-result-wrapper")
          .find("p.no-search-data")
          .hide();
      }

      jQuery(".search-view-top-head .event-search-count").text(
        eventObj.total_event + " Results for "
      );

      jQuery("body").removeClass("is-loading");
    },
  });
}

/** Content Search Ajax */
function nabSearchContentAjax(loadMore, pageNumber) {
  let community = "",
    subject = "",
    contentType = "";
  let postPerPage = jQuery("#load-more-content a").attr("data-post-limit")
    ? parseInt(jQuery("#load-more-content a").attr("data-post-limit"))
    : 15;
  let searchTerm =
    0 < jQuery('.search-result-filter .search__form input[name="s"]').length
      ? jQuery('.search-result-filter .search__form input[name="s"]').val()
      : "";
  let orderBy =
    0 < jQuery(".other-search-filter .sort-content a.active").length
      ? jQuery(".other-search-filter .sort-content a.active").attr("data-order")
      : "date";

  if (0 < jQuery(".other-search-filter #content-community").length) {
    community =
      0 === jQuery(".other-search-filter #content-community")[0].selectedIndex
        ? ""
        : jQuery(".other-search-filter #content-community").val();
  }
  if (0 < jQuery(".other-search-filter #content-subject").length) {
    subject =
      0 === jQuery(".other-search-filter #content-subject")[0].selectedIndex
        ? ""
        : jQuery(".other-search-filter #content-subject").val();
  }
  if (0 < jQuery(".other-search-filter #content-type").length) {
    contentType =
      0 === jQuery(".other-search-filter #content-type")[0].selectedIndex
        ? ""
        : jQuery(".other-search-filter #content-type").val();
  }

  jQuery("body").addClass("is-loading");

  jQuery.ajax({
    url: amplifyJS.ajaxurl,
    type: "POST",
    data: {
      action: "nab_content_search_filter",
      nabNonce: amplifyJS.nabNonce,
      page_number: pageNumber,
      post_limit: postPerPage,
      search_term: searchTerm,
      community: community,
      subject: subject,
      content_type: contentType,
      orderby: orderBy,
    },
    success: function (response) {
      if (!loadMore) {
        jQuery("#search-content-list").empty();
      }
      let contentObj = jQuery.parseJSON(response);

      if ("" !== contentObj.result_post && 0 < contentObj.result_post.length) {
        let contentListDiv = document.getElementById("search-content-list");

        jQuery.each(contentObj.result_post, function (key, value) {
          let searchItemDiv = document.createElement("li");
          searchItemDiv.setAttribute("class", "");

          let searchItemInner = document.createElement("a");
          searchItemInner.setAttribute("href", value.link);
          searchItemInner.setAttribute("class", "result _content");

          if (value.target) {
            searchItemInner.setAttribute("target", value.target);
          }

          // let searchItemCover = document.createElement('div')
          // searchItemCover.setAttribute('class', 'search-item-cover')

          let coverImg = document.createElement("img");
          coverImg.setAttribute("class", "result__image");
          coverImg.setAttribute("src", value.thumbnail);
          coverImg.setAttribute("alt", "content thumbnail");

          //searchItemCover.appendChild(coverImg)
          searchItemInner.appendChild(coverImg);

          let postTitle = document.createElement("h4");
          postTitle.setAttribute("class", "result__title");
          postTitle.innerText = value.title;

          searchItemInner.appendChild(postTitle);

          searchItemDiv.appendChild(searchItemInner);

          contentListDiv.appendChild(searchItemDiv);

          if (value.banner) {
            jQuery("#search-content-list").append(value.banner);
          }
        });
      }
      jQuery("#load-more-content a").attr(
        "data-page-number",
        contentObj.next_page_number
      );

      if (contentObj.next_page_number > contentObj.total_page) {
        jQuery("#load-more-content").hide();
      } else {
        jQuery("#load-more-content").show();
      }

      if (0 === contentObj.total_page) {
        jQuery("#search-content-list")
          .empty()
          .parents(".nab-search-result-wrapper")
          .find("p.no-search-data")
          .show();
      } else {
        jQuery("#search-content-list")
          .parents(".nab-search-result-wrapper")
          .find("p.no-search-data")
          .hide();
      }

      jQuery(".search-view-top-head .content-search-count").text(
        contentObj.total_content + " Results for "
      );

      jQuery("body").removeClass("is-loading");
    },
  });
}
