<?php
require("../src/head.php");
?>
<h1>
	افزودن محصول
</h1>
<form id="product-form" onsubmit="add_product(event)">
	<input type="text" id="name" placeholder="نام محصول">
	<input type="text" id="cat" placeholder="گروه محصول">
	<input type="text" id="desc" placeholder="توضیحات">
	<input type="text" id="img" placeholder="نشانی تصویر">
	<input type="text" id="price" placeholder="قیمت">
	<button type="submit">
		افزودن محصول
	</button>
</form>
<?php
require("../src/config.php");
require("../src/sql.php");
require("../src/product.php");
require("../src/common.php");

function all_products() {
	$con = sql_connection();
	$q = "SELECT * FROM `" . _TBL_PRODUCT . "` ";
	$q .= "ORDER BY id DESC";
	$r = sql_query($con, $q);
	if($r and sql_num_rows($r))
		return sql_get_rows($r);
	return false;
}
function print_products() {
	$list = all_products();
	if(!$list)
		return false;

	$html = "<div class='products-sec'>";
	$html .= "<h1>لیست محصولات</h1>";
	foreach($list as $item) {
		$html .= "<div class='products-item'>";
		$html .= "<img src='../{$item["img"]}'>";
		$html .= "<p><a href='../product.php?id={$item["id"]}' ";
		$html .= "title='لینک'>";
		$html .= "{$item["name"]}</a></p>";
		$html .= "<p>{$item["cat"]}</p>";
		$html .= "<p><a class='icon' title='حذف' href=";
		$html .= "'../src/product-api.php?job=del&id={$item["id"]}'>";
		$html .= "delete";
		$html .= "</a></p>";
		$html .= "</div>";
	}
	$html .= "</div>";
	echo $html;
}

print_products();
?>
<?php
require("../src/foot.php");
?>
