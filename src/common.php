<?php
function is_num($num) {
	return filter_var($num, FILTER_VALIDATE_INT);
}
function clean_num($num) {
	return intval($num);
}
function clean_str($str) {
	return filter_var($str, FILTER_SANITIZE_STRING);
}
function get_input($key) {
	return isset($_REQUEST[$key]) ? $_REQUEST[$key] : false;
}
function get_str($key) {
	$inp = get_input($key);
	return $inp ? clean_str($inp) : false;
}
function get_num($key) {
	$inp = get_input($key);
	return is_num($inp) ? clean_num($inp) : false;
}
function get_json($key) {
	$inp = get_input($key);
	return $inp ? json_decode($inp, true) : false;
}
function echo_json($obj) {
	header("Content-type: application/json; charset=utf-8");
	echo json_encode($obj);
}
function echo_text($x) {
	header("Content-type: text/plain; charset=utf-8");
	if(is_array($x))
		print_r($x);
	else
		echo "$str\n";
}
function fa_num($str) {
	return str_replace(
		["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"],
		["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"],
		$str);
}
function fa_price($price) {
	return fa_num(number_format($price)) . " " . _UNIT;
}
?>
