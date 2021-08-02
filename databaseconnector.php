<?php

$db_host = 'localhost';
$db_name = 'u_180081875_db';
$username = 'u-180081875';
$password = 'W9hB3MwFREHbQQB';

try {
	$db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo('Database connected successfuly');
} catch(PDOException $ex) {
	echo("Failed to connect to the database.");
	echo($ex->getMessage());
	exit;
}
?>