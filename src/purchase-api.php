<?php
require("config.php");
require("sql.php");
require("purchase.php");
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
	if($job == "del")
		return _del();
	return false;
}
function _add() {
	$products_obj = valid_products(get_str("products"));
	$products = $products_obj[0];
	$price = $products_obj[1];
	$info = valid_info(get_json("info"));

	if(!$products or !$info)
		return false;

	$con = sql_connection();
	return purchase_add($con, $products, $info, $price);
}
function valid_products($ids) {
	if(!$ids)
		return false;
	
	$ids = explode(",", $ids);
	foreach($ids as $i => $id) {
		if($id = clean_num($id))
			$ids[$i] = $id;
		else
			return [false, false];
	}

	$price = 0;
	$con = sql_connection();
	foreach($ids as $id) {
		if($p = product_get($con, $id))
			$price += $p["price"];
		else
			return [false, false];
	}

	$ids = implode(",", $ids);
	return [$ids, $price];
}
function valid_info($info) {
	if(!$info)
		return false;
	
	if(empty($info["name"]) or
		empty($info["address"] or
			empty($info["phone"]))) return false;
	
	$obj["name"] = clean_str($info["name"]);
	$obj["address"] = clean_str($info["address"]);
	$obj["phone"] = clean_str($info["phone"]);

	return addslashes(json_encode($obj));
}
function _list() {
	$n = get_num("n");

	if(!$n)
		return false;

	$con = sql_connection();
	$list = purchase_list($con, $n);
	foreach($list as $i => $o) {
		$list[$i]["info"] = json_decode($o["info"], true);
	}
	return $list;
}
function _get() {
	$id = get_num("id");

	if(!$id)
		return false;

	$con = sql_connection();
	$item = purchase_get($con, $id);
	$item["info"] = json_decode($item["info"], true);
	return $item;
}
function _del() {
	$id = get_num("id");

	if(!$id)
		return false;

	$con = sql_connection();
	return purchase_del($con, $id);
}

$job = get_str("job");
echo_json(dispatch($job));
?>
