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
			<img src="https://nabshow-com-develop.go-vip.net/amplify/wp-content/uploads/sites/9/2020/08/belt-2.jpg?resize=150,150">
			<input type="button" data-pid="197" class="testCartSubmit" value="Add to Cart">
		</div>
		<br><br>
		<div>
			<img src="https://nabshow-com-develop.go-vip.net/amplify/wp-content/uploads/sites/9/2020/08/cap-2.jpg?resize=150,150">
			<input type="button" data-pid="198" class="testCartSubmit" value="Add to Cart">
		</div>
		<br><br>
		<input type="button" class="proceedToCheckout" value="Cart">
		
	</form>
</div>
<br><br>

<?php
get_footer();
