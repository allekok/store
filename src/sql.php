<?php
function sql_connection() {
	$con = mysqli_connect(_SQL_HOST, _SQL_USER, _SQL_PASS, _SQL_DB);
	if($con) {
		mysqli_set_charset($con, "utf8");
		return $con;
	}
	return false;
}
function sql_query($con, $q) {
	return mysqli_query($con, $q);
}
function sql_num_rows($r) {
	return mysqli_num_rows($r);
}
function sql_get_rows($r) {
	while($t = mysqli_fetch_assoc($r))
		$acc[] = $t;
	return $acc;
}
?>
