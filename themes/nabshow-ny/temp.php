<?php
/**
 * Template Name: Test
 */

get_header();
?>

<div class="nab-ny-temp-listings">
	<div class="temp-cart">
		<h3>Cart - <span class="temp-cart-qty"><?php echo nab_ny_get_cart(); ?></span></h3>
	</div>
	<form method="post" action="">
		<div>
			<img src="https://amplify.nabshow.com/wp-content/uploads/sites/12/2020/08/radio-1.png?resize=150,150">
			<input type="button" data-pid="118" class="testCartSubmit" value="Add to Cart">
		</div>
		<br><br>
		<div>
			<img src="https://amplify.nabshow.com/wp-content/uploads/sites/12/2020/08/rain-1.png?resize=150,150">
			<input type="button" data-pid="120" class="testCartSubmit" value="Add to Cart">
		</div>
		<br><br>
		<input type="button" class="proceedToCheckout" value="Checkout">
		
	</form>
</div>
<br><br>

<input type="button" value="logout all" id="nabLotOut">

<?php
get_footer();
