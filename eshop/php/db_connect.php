<?php

error_reporting(E_ALL ^ E_DEPRECATED);
$link = mysql_connect('localhost', 'root', '');
if (!$link) {
	die('Could not connect: ' . mysql_error());
}
$database = 'eshop';
$db_selected = mysql_select_db($database, $link);
if (!$db_selected) {
	die ('Can\'t select database: ' . mysql_error());
}
mysql_set_charset('utf8',$link);

?>