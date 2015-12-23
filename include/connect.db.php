<?php

/* =============================================
 * Connect
 * ============================================= */

$conn = null;

if ($mode == "MYSQL") {
	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Could not connect: ' . mysql_error());
	mysql_set_charset($character,$conn);
	mysql_select_db($dbname);
} 

if ($mode == "PDO_MYSQL") {
	try {
	  	$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->exec("SET CHARACTER SET " . $character);
	} catch(PDOException $e) {
		echo $e->getMessage();
		exit();
	}
}