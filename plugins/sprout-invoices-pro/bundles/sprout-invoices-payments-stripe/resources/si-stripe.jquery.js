var $ = jQuery.noConflict(), plaid_token = null;
jQuery(function ($) {
	window.stripe = Stripe(si_stripe_js_object.pub_key);

	function sbStoreAccountID(auth) {


		var $plaid_auth_button = $('#plaid_auth');

		$plaid_auth_button.hide();
		$plaid_auth_button.after(si_js_object.inline_spinner);

		$.post(si_js_object.ajax_url, { action: '' + si_stripe_js_object.callback_action + '', public_token: auth.public_token, account_id: auth.account_id, nonce: si_js_object.security, invoice_id: si_js_object.invoice_id },
			function (response) {
				console.log(response);
				location.reload();

			}
		);
	};

	var plaid_request = function () {

		if (plaid_token) {
			var plaidHandler = Plaid.create({
				token: plaid_token,
				onLoad: function () {
					// finished loading button
				},
				onSuccess: function (public_token, metadata) {

					sbStoreAccountID({
						public_token: public_token,
						account_id: metadata.account_id
					});

				},
				onExit: function (err, metadata) {
					// The user exited the Link flow.
					console.log(err);
					if (err != null) {
						// The user encountered a Plaid API error prior to exiting.
					}
					// metadata contains information about the institution
					// that the user selected and the most recent API request IDs.
				},
			});
			plaidHandler.open();
			// open up the authorization
		}
	}

	$(document).ready(function ($) {


		if (typeof Plaid !== 'undefined') {
			$.post(si_js_object.ajax_url, { action: '' + si_stripe_js_object.callback_create_token + '', client_name: '' + si_stripe_js_object.clientName + '' }, function (data) {
				if (data.link_token) {

					plaid_token = data.link_token;
					$('#plaid_auth').removeAttr('disabled');
					return;
				}

				alert('Error: ' + data.message)
			})
		}


		$('#plaid_auth').on('click', function (event) {
			event.preventDefault();
			plaid_request();
		});

		$("#stripe_card_button").on('click', function () {
			$("#stripe_card").slideDown();
			createPaymentIntentCard();
		});

		$("#sepa_debit_button").on('click', function () {
			$("#sepa_debit").slideDown();
			createPaymentIntentSepa();
		});


	});

	var showError = function (errorMsgText) {
		changeLoadingStateCard(false);
		$('#error-message').addClass('sa-message error').html('<p class="si_error">' + errorMsgText + '</p>');
	};
	// Show a spinner on payment submission
	var changeLoadingStateCard = function (isLoading) {
		if (isLoading) {
			document.querySelector("#stripe_card button").disabled = true;
			document.querySelector("#stripe_card #spinner").classList.remove("hidden");
			document.querySelector("#stripe_card #button-text").classList.add("hidden");
		} else {
			document.querySelector("#stripe_card button").disabled = false;
			document.querySelector("#stripe_card #spinner").classList.add("hidden");
			document.querySelector("#stripe_card #button-text").classList.remove("hidden");
		}
	};
	if (document.querySelector("#stripe_card")) {
		//Start Another card
		var orderData = {
			items: [{ id: si_js_object.invoice_id }],
			currency: si_stripe_js_data_attributes.currency,
		};

		var setupElementsPayByCard = function (d) {
			/* ------- Set up Stripe Elements to use in checkout form ------- */
			var elements = stripe.elements();
			var style = {
				base: {
					color: "#32325d",
					fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
					fontSmoothing: "antialiased",
					fontSize: "16px",
					"::placeholder": {
						color: "#aab7c4"
					}
				},
				invalid: {
					color: "#fa755a",
					iconColor: "#fa755a"
				}
			};

			var card = elements.create("card", { style: style });
			card.mount("#stripe_card #card-element");

			d(card);
		};

		/*
		 * Collect card details and pay for the order
		 */
		var payByCard = function (stripe, card) {
			changeLoadingStateCard(true);

			// Collects card details and creates a PaymentMethod
			stripe
				.createPaymentMethod("card", card)
				.then(function (result) {
					if (result.error) {
						showError(result.error.message);
					} else {
						orderData.paymentMethodId = result.paymentMethod.id;
						let content = { invoice_id: si_js_object.invoice_id, paymentMethodId: result.paymentMethod.id, action: si_stripe_js_object.callback_payment_intent };
						const searchParams = Object.keys(content).map((key) => {
							return encodeURIComponent(key) + '=' + encodeURIComponent(content[key]);
						}).join('&');
						return fetch(si_js_object.ajax_url, {
							method: "POST",
							headers: {
								"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
							},
							body: searchParams
						});
					}
				})
				.then(function (result) {
					return result.json();
				})
				.then(function (response) {
					if (response.error || (response.success && response.success === false)) {
						showError(response.error ? response.error : response.data);
					} else if (response.requiresAction) {
						// Request authentication
						handleActionCard(response.clientSecret);
					} else {
						orderCompleteCard(response.clientSecret);
					}
				});
		};

		/* ------- Post-payment helpers ------- */

		var handleActionCard = function (clientSecret) {

			stripe.handleCardAction(clientSecret).then(function (data) {

				if (data.error) {
					showError("Your card was not authenticated, please try again");
				} else if (data.paymentIntent.status === "requires_confirmation") {
					let content = { invoice_id: si_js_object.invoice_id, paymentIntentId: data.paymentIntent.id, action: si_stripe_js_object.callback_payment_intent };
					const searchParams = Object.keys(content).map((key) => {
						return encodeURIComponent(key) + '=' + encodeURIComponent(content[key]);
					}).join('&');
					fetch(si_js_object.ajax_url, {
						method: "POST",
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						body: searchParams
					})
						.then(function (result) {
							return result.json();
						})
						.then(function (json) {
							if (json.error) {
								showError(json.error);
							} else {
								orderCompleteCard(clientSecret);
							}
						});
				}
			});
		};

		/* Shows a success / error message when the payment is complete */
		var orderCompleteCard = function (clientSecret) {

			stripe.retrievePaymentIntent(clientSecret).then(function (result) {
				var paymentIntent = result.paymentIntent;
				var paymentIntentJson = JSON.stringify(paymentIntent, null, 2);
				let content = { invoice_id: si_js_object.invoice_id, completeOrder: paymentIntent.id, action: si_stripe_js_object.callback_payment_intent };
				const searchParams = Object.keys(content).map((key) => {
					return encodeURIComponent(key) + '=' + encodeURIComponent(content[key]);
				}).join('&');
				fetch(si_js_object.ajax_url, {
					method: "POST",
					headers: {
						"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
					},
					body: searchParams
				})
					.then(function (result) {
						return result.json();
					}).then(function (data) {
						console.log(data);
						location.reload();

					});

				changeLoadingStateCard(false);
			});
		};

		// Disable the button until we have Stripe set up on the page
		var createPaymentIntentCard = function () {
			setupElementsPayByCard((card) => {
				document.querySelector("#stripe_card button").disabled = false;
				var form = document.querySelector("#stripe_card #payment-form");
				form.addEventListener("submit", function (event) {
					event.preventDefault();
					payByCard(window.stripe, card);
				});
			});

		}
		//End Another card


		
	}

	if (document.querySelector("#sepa_debit")) {
		//Start sepa debit
		var createPaymentIntentSepa = function () {
			let content = { invoice_id: si_js_object.invoice_id, action: si_stripe_js_object.callback_payment_intent, payment_method_types: 'sepa_debit' };
			const searchParams = Object.keys(content).map((key) => {
				return encodeURIComponent(key) + '=' + encodeURIComponent(content[key]);
			}).join('&');
			return fetch(si_js_object.ajax_url, {
				method: "post",
				headers: {
					"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
				},
				body: searchParams
			})
				.then(function (response) {
					return response.json();
				})
				.then(function (data) {
					if (data.client_secret) {
						return setupElements(data);
					}
					showError(data.data)
				})
				.then(function (data) {
					// Handle form submission.
					if (data) {
						console.log(data);
						let { stripe, iban, clientSecret } = data;
						var form = document.querySelector("#sepa_debit #payment-form");
						form.addEventListener("submit", function (event) {
							event.preventDefault();
							// Validate the form input
							if (!event.target.reportValidity()) {
								// Form not valid, abort!
								return;
							}
							// Initiate payment when the submit button is clicked
							console.log(stripe, iban, clientSecret);
							pay(stripe, iban, clientSecret);
						});

					}
				});
		}
		// Set up Stripe.js and Elements to use in checkout form
		var setupElements = function (data) {
			var elements = stripe.elements();
			var style = {
				base: {
					color: "#32325d",
					fontFamily:
						'-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif',
					fontSmoothing: "antialiased",
					fontSize: "16px",
					"::placeholder": {
						color: "#aab7c4"
					},
					":-webkit-autofill": {
						color: "#32325d"
					}
				},
				invalid: {
					color: "#fa755a",
					iconColor: "#fa755a",
					":-webkit-autofill": {
						color: "#fa755a"
					}
				}
			};

			var options = {
				style: style,
				supportedCountries: ["SEPA"],
				// If you know the country of the customer, you can optionally pass it to
				// the Element as placeholderCountry. The example IBAN that is being used
				// as placeholder reflects the IBAN format of that country.
				placeholderCountry: si_stripe_js_object.sepa_country.toUpperCase()
			};

			var iban = elements.create("iban", options);
			iban.mount("#iban-element");

			iban.on("change", function (event) {
				// Handle real-time validation errors from the iban Element.
				if (event.error) {
					showError(event.error.message);
				}
			});

			// Enable button.
			document.querySelector("#sepa_debit button").disabled = false;

			return {
				stripe: stripe,
				iban: iban,
				clientSecret: data.client_secret
			};
		};

		/*
		 * Calls stripe.confirmSepaDebitPayment to generate the mandate and initaite the debit.
		 */
		var pay = function (stripe, iban, clientSecret) {
			changeLoadingState(true);

			// Initiate the payment.
			stripe
				.confirmSepaDebitPayment(clientSecret, {
					payment_method: {
						sepa_debit: iban,
						billing_details: {
							name: document.querySelector('input[name="name"]').value,
							email: document.querySelector('input[name="email"]').value
						}
					}
				})
				.then(function (result) {
					if (result.error) {
						// Show error to your customer
						showError(result.error.message);
					} else {
						orderComplete(result.paymentIntent.client_secret);
					}
				});
		};

		/* ------- Post-payment helpers ------- */

		/* Shows a success / error message when the payment is complete */
		var orderComplete = function (clientSecret) {
			stripe.retrievePaymentIntent(clientSecret).then(function (result) {
				var paymentIntent = result.paymentIntent;
				var paymentIntentJson = JSON.stringify(paymentIntent, null, 2);
				let content = { invoice_id: si_js_object.invoice_id, completeOrder: paymentIntent.id, action: si_stripe_js_object.callback_payment_intent };
				const searchParams = Object.keys(content).map((key) => {
					return encodeURIComponent(key) + '=' + encodeURIComponent(content[key]);
				}).join('&');
				fetch(si_js_object.ajax_url, {
					method: "POST",
					headers: {
						"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
					},
					body: searchParams
				})
					.then(function (result) {
						return result.json();
					}).then(function (data) {
						console.log(data);
						location.reload();
					});

			});
		};



		// Show a spinner on payment submission
		var changeLoadingState = function (isLoading) {
			if (isLoading) {
				document.querySelector("#sepa_debit_button").disabled = true;
				document.querySelector("#sepa_debit #spinner").classList.remove("hidden");
				document.querySelector("#sepa_debit #button-text").classList.add("hidden");
			} else {
				document.querySelector("#sepa_debit_button").disabled = false;
				document.querySelector("#sepa_debit #spinner").classList.add("hidden");
				document.querySelector("#sepa_debit #button-text").classList.remove("hidden");
			}
		};

		var orderData = {
			items: [{ id: si_js_object.invoice_id }]
		};

		// Disable the button until we have Stripe set up on the page
		document.querySelector("#sepa_debit button").disabled = true;

		// Show formatted price information.
		var price = si_js_object.invoice_balance;

		var numberFormat = new Intl.NumberFormat([si_js_object.locale_standard], {
			style: "currency",
			currency: si_stripe_js_data_attributes.currency,
			currencyDisplay: "symbol"
		});
		console.log(numberFormat.format(
			price
		));
		document.querySelector("#sepa_debit #order-amount").innerText = numberFormat.format(
			price
		);


		//End sepa debit
	}
});