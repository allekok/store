<?php
require("config.php");
require("sql.php");
require("user.php");
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
	$user = get_str("user");
	$pass = get_str("pass");
	$pos = get_num("pos");

	if(!$user or !$pass or !$pos)
		return false;

	$con = sql_connection();
	return user_add($con, $user, $pass, $pos);
}
function _list() {
	$n = get_num("n");

	if(!$n)
		return false;

	$con = sql_connection();
	return user_list($con, $n);
}
function _get() {
	$user = get_str("user");
	$pass = get_str("pass");

	if(!$user or !$pass)
		return false;

	$con = sql_connection();
	return user_get($con, $user, $pass);
}
function _del() {
	$user = get_str("user");

	if(!$user)
		return false;

	$con = sql_connection();
	return user_del($con, $user);
}

$job = get_str("job");
echo_json(dispatch($job));
?>
