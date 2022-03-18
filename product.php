<?php
require("src/head.php");
?>
<?php
require("src/config.php");
require("src/sql.php");
require("src/product.php");
require("src/common.php");

function print_product($id) {
	if(!$id)
		return false;

	$con = sql_connection();
	$product = product_get($con, $id);
	if(!$product)
		return false;
	$id = $product["id"];
	$name = $product["name"];
	$desc = $product["desc"];
	$img = _PATH . $product["img"];
	$price = fa_price($product["price"]);
	
	echo "<div class='product'>";
	echo "<img src='$img'>";
	echo "<h2>$name</h2>";
	echo "<span>$price</span>";
	echo "<button type='button' onclick=";
	echo "\"add_to_cart_btn(this, $id,'$name','$img','$price')\">";
	echo "<i class='icon'>add_shopping_cart</i> ";
	echo "افزودن به سبد خرید";
	echo "</button>";
	echo "<p>$desc</p>";
	echo "</div>";
	return true;
}

$id = get_num("id");
print_product($id);
?>
<?php
require("src/foot.php");
?>
