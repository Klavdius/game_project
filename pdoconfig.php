<?php
    $host = '127.0.0.1';
    $dbname = 'dev_db';
    $username = 'root';
    $password = '';
	
	$db = new mysqli($jsArrData["host"] , $jsArrData["username"] , $jsArrData["password"] , $jsArrData["db_name"]);
	
	if ($db->connect_errno) {
		exit("Connection failed: ");
    }
?>