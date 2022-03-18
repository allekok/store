<?php
require("src/head.php");
?>
<h1>
	محصولات
</h1>
<?php
require("src/config.php");
require("src/sql.php");
require("src/product.php");
require("src/common.php");

function print_products() {
	$con = sql_connection();
	$cats = product_cats($con);
	if(!$cats)
		return false;
	foreach($cats as $cat) {
		$cat_enc = urlencode($cat);
		echo "<div class='cat-sec'>";
		echo "<h2>گروه <a href='cat.php?cat=$cat_enc'>$cat</a></h2>";
		echo "<div class='cat-items'>";
		$products = product_list($con, $cat, 3);
		if(!$products)
			continue;
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
	}
	return true;
}

print_products();
?>
<?php
require("src/foot.php");
?>
