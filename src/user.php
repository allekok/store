<?php
function hash_pass($pass) {
	return hash("SHA512", $pass);
}
function user_add($con, $user, $pass, $pos) {
	$pass = hash_pass($pass);
	$q = "INSERT INTO `" . _TBL_USER . "` VALUES('$user', '$pass', $pos)";
	if(sql_query($con, $q))
		return true;
	return false;
}
function user_list($con, $n) {
	$q = "SELECT * FROM `" . _TBL_USER . "` ";
	$q .= "ORDER BY id DESC ";
	$q .= "LIMIT $n";
	$r = sql_query($con, $q);
	if($r and sql_num_rows($r))
		return sql_get_rows($r);
	return false;
}
function user_get($con, $user, $pass) {
	$pass = hash_pass($pass);
	$q = "SELECT pos FROM `" . _TBL_USER . "` ";
	$q .= "WHERE user='$user' AND pass='$pass'";
	$r = sql_query($con, $q);
	if($r and sql_num_rows($r)) {
		$acc = sql_get_rows($r);
		return $acc[0]["pos"];
	}
	return false;
}
function user_del($con, $user) {
	$q = "DELETE FROM `" . _TBL_USER . "` WHERE user='$user'";
	return sql_query($con, $q);
}
?>
