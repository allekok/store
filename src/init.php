<?php
require("config.php");
require("sql.php");
require("common.php");

function create_table_user($con) {
	$q = "CREATE TABLE IF NOT EXISTS `" . _TBL_USER . "` (";
	$q .= "`user` VARCHAR(20) NOT NULL, ";
	$q .= "`pass` VARCHAR(128) NOT NULL, ";
	$q .= "`pos` TINYINT(1) NOT NULL, ";
	$q .= "PRIMARY KEY (`user`)) ";
	$q .= "ENGINE = MyISAM ";
	$q .= "CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci";
	return sql_query($con, $q);
}
function create_table_product($con) {
	$q = "CREATE TABLE IF NOT EXISTS `" . _TBL_PRODUCT . "` (";
	$q .= "`id` INT(10) NOT NULL AUTO_INCREMENT, ";
	$q .= "`name` VARCHAR(100) NOT NULL, ";
	$q .= "`cat` VARCHAR(100) NOT NULL, ";
	$q .= "`desc` TEXT NOT NULL, ";
	$q .= "`img` VARCHAR(100) NOT NULL, ";
	$q .= "`price` INT(10) NOT NULL, ";
	$q .= "PRIMARY KEY (`id`)) ";
	$q .= "ENGINE = MyISAM ";
	$q .= "CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci";
	return sql_query($con, $q);
}
function create_table_purchase($con) {
	$q = "CREATE TABLE IF NOT EXISTS `" . _TBL_PURCHASE . "` (";
	$q .= "`id` INT(10) NOT NULL AUTO_INCREMENT, ";
	$q .= "`products` TEXT NOT NULL, ";
	$q .= "`info` TEXT NOT NULL, ";
	$q .= "`price` INT(20) NOT NULL, ";
	$q .= "PRIMARY KEY (`id`)) ";
	$q .= "ENGINE = MyISAM ";
	$q .= "CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci";
	return sql_query($con, $q);
}
function create_tables($con) {
	return [
		create_table_user($con),
		create_table_product($con),
		create_table_purchase($con),
	];
}

$con = sql_connection();
echo_text(create_tables($con));
?>
