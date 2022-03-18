<?php
require("../src/head.php");
?>
<h1>
	سفارشات
</h1>
<?php
require("../src/config.php");
require("../src/sql.php");
require("../src/purchase.php");
require("../src/product.php");
require("../src/common.php");

function all_purchases() {
	$con = sql_connection();
	$q = "SELECT * FROM `" . _TBL_PURCHASE . "` ";
	$q .= "ORDER BY id DESC";
	$r = sql_query($con, $q);
	if($r and sql_num_rows($r))
		return sql_get_rows($r);
	return false;
}
function print_purchases() {
	$list = all_purchases();
	if(!$list)
		return false;

	$con = sql_connection();
	
	$html = "<div class='purchases-sec'>";
	foreach($list as $item) {
		$products = explode(",", $item["products"]);
		$P = "";
		foreach($products as $i => $p) {
			$p = product_get($con, $p);
			$P .= "<a href='../product.php?id={$p["id"]}'>";
			$P .= "{$p["name"]}</a> ، ";
		}
		$P = trim($P);
		$P = $P ? substr($P, 0, -2) : $P;
		$info = json_decode($item["info"], true);
		$price = fa_num(number_format($item["price"]));
		$html .= "<div class='purchases-item'>";
		$html .= "<p>$P</p>";
		$html .= "<p>{$info["name"]}</p>";
		$html .= "<p>{$info["phone"]}</p>";
		$html .= "<p>{$info["address"]}</p>";
		$html .= "<p>{$price} " . _UNIT . "</p>";
		$html .= "<p><a class='icon' title='حذف' href=";
		$html .= "'../src/purchase-api.php?job=del&id={$item["id"]}'>";
		$html .= "delete";
		$html .= "</a></p>";
		$html .= "</div>";
	}
	$html .= "</div>";
	echo $html;
}

print_purchases();
?>
<?php
require("../src/foot.php");
?>
