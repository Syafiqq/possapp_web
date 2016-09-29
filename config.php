	<?php
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'posapp';
	$connect = mysql_connect($host,$user,$pass) or die('CONNECTION ERROR | '.mysql_error());
	mysql_select_db($db,$connect) or die('DATABASE ERROR | '.mysql_error());
?>
