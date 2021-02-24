<script src="https://js.stripe.com/v3/"></script>
<script>
	function initCheckout() {
		const stripe = window.Stripe('<?php echo $pubkey ?>');

		const preview = document.querySelector('#stripe_checkout_button');

		preview.addEventListener('click', function(e) {
		  stripe
			    .redirectToCheckout({
			      sessionId: '<?php echo $session_id ?>'
			    })
			    .then(function(result) {
			      if (result.error) {
			        alert(result.error.message);
			      }
			    })
			    .catch(function(error) {
			      alert(error.message);
			});
		});

	};
  if (document.readyState !== 'loading') {
    initCheckout();
  } else {
    document.addEventListener("DOMContentLoaded", initCheckout);
  }
</script>
<a id="stripe_checkout_button" class="payment_option toggle stripe_checkout"><span class="process_label"><?php _e( 'Secure Credit Card', 'sprout-invoices' ) ?></span></a>
