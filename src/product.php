<?php
function product_add($con, $name, $cat, $desc, $img, $price) {
	$q = "INSERT INTO `" . _TBL_PRODUCT . "` ";
	$q .= "(`name`, `cat`, `desc`, `img`, `price`) ";
	$q .= "VALUES ('$name', '$cat', '$desc', '$img', $price)";
	return sql_query($con, $q);
}
function product_list($con, $cat, $n) {
	$q = "SELECT * FROM `" . _TBL_PRODUCT . "` ";
	$q .= "WHERE cat='$cat' ";
	$q .= "ORDER BY id DESC ";
	$q .= "LIMIT $n";
	$r = sql_query($con, $q);
	if($r and sql_num_rows($r))
		return sql_get_rows($r);
	return false;
}
function product_get($con, $id) {
	$q = "SELECT * FROM `" . _TBL_PRODUCT . "` WHERE id=$id";
	$r = sql_query($con, $q);
	if($r and sql_num_rows($r)) {
		$acc = sql_get_rows($r);
		return $acc[0];
	}
	return false;
}
function product_cats($con) {
	$q = "SELECT cat FROM `" . _TBL_PRODUCT . "`";
	$r = sql_query($con, $q);
	if($r and sql_num_rows($r)) {
		$acc = sql_get_rows($r);
		foreach($acc as $a) {
			$cats[$a["cat"]] = true;
		}
		$cats = array_keys($cats);
		sort($cats);
		return $cats;
	}
	return false;
}
function product_del($con, $id) {
	$q = "DELETE FROM `" . _TBL_PRODUCT . "` WHERE id=$id";
	return sql_query($con, $q);
}
?>
