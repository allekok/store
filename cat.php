<?php
require("src/head.php");
?>
<?php
require("src/config.php");
require("src/sql.php");
require("src/product.php");
require("src/common.php");

function print_products($cat) {
	if(!$cat)
		return false;

	$con = sql_connection();
	$products = product_list($con, $cat, 100);
	if(!$products)
		return false;
	echo "<div class='cat-sec'>";
	echo "<h1>محصولات گروه $cat</h1>";
	echo "<div class='cat-items'>";
	
	foreach($products as $product) {
		$id = $product["id"];
		$name = $product["name"];
		$img = $product["img"];
		$price = fa_price($product["price"]);
		
		echo "<div class='cat-item'>";
		echo "<a href='product.php?id=$id'>";
		echo "<img src='$img'>";
		echo "<h3>$name</h3>";
		echo "</a>";
		echo "<span>$price</span>";
		echo "</div>";
	}

	echo "</div>";
	echo "</div>";
	return true;
}

$cat = get_str("cat");
print_products($cat);
?>
<?php
require("src/foot.php");
?>
