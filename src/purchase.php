<?php
function purchase_add($con, $products, $info, $price) {
	$q = "INSERT INTO `" . _TBL_PURCHASE . "` ";
	$q .= "(`products`, `info`, `price`) ";
	$q .= "VALUES ('$products', '$info', $price)";
	return sql_query($con, $q);
}
function purchase_list($con, $n) {
	$q = "SELECT * FROM `" . _TBL_PURCHASE . "` ";
	$q .= "ORDER BY id DESC ";
	$q .= "LIMIT $n";
	$r = sql_query($con, $q);
	if($r and sql_num_rows($r))
		return sql_get_rows($r);
	return false;
}
function purchase_get($con, $id) {
	$q = "SELECT * FROM `" . _TBL_PURCHASE . "` WHERE id=$id";
	$r = sql_query($con, $q);
	if($r and sql_num_rows($r)) {
		$acc = sql_get_rows($r);
		return $acc[0];
	}
	return false;
}
function purchase_del($con, $id) {
	$q = "DELETE FROM `" . _TBL_PURCHASE . "` WHERE id=$id";
	return sql_query($con, $q);
}
?>
