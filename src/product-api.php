<?php
require("config.php");
require("sql.php");
require("product.php");
require("common.php");

function dispatch($job) {
	if(!$job)
		return false;
	if($job == "add")
		return _add();
	if($job == "list")
		return _list();
	if($job == "get")
		return _get();
	if($job == "cats")
		return _cats();
	if($job == "del")
		return _del();
	return false;
}
function _add() {
	$name = get_str("name");
	$cat = get_str("cat");
	$desc = get_str("desc");
	$img = get_str("img");
	$price = get_num("price");

	if(!$name or !$cat or !$desc or !$img or !$price)
		return false;
	
	$con = sql_connection();
	return product_add($con, $name, $cat, $desc, $img, $price);
}
function _list() {
	$cat = get_str("cat");
	$n = get_num("n");

	if(!$cat or !$n)
		return false;

	$con = sql_connection();
	return product_list($con, $cat, $n);
}
function _get() {
	$id = get_num("id");

	if(!$id)
		return false;

	$con = sql_connection();
	return product_get($con, $id);
}
function _cats() {
	$con = sql_connection();
	return product_cats($con);
}
function _del() {
	$id = get_num("id");

	if(!$id)
		return false;

	$con = sql_connection();
	return product_del($con, $id);
}

$job = get_str("job");
echo_json(dispatch($job));
?>
