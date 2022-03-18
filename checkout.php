<?php
require("src/head.php");
?>
<h1>
	سبد خرید
</h1>
<div class="cart-items">
</div>
<form id="checkout-form" onsubmit="checkout(event)">
	<input id="name" type="text" placeholder="نام و نام خانوادگی">
	<input id="phone" type="text" placeholder="شماره تماس">
	<input id="address" type="text" placeholder="نشانی">
	<button type="submit">
		نهایی‌کردن خرید
	</button>
</form>
<script>
 window.onload = () => {
	 document.querySelector(".cart-items").innerHTML = print_cart()
	 if(cart.length) {
		 document.querySelector("#checkout-form").
			  style.display = "block"
	 }
 }
</script>
<?php
require("src/foot.php");
?>
