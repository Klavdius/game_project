<?php
	$jsData = file_get_contents('conf_dev_db.json');
	$jsArrData = json_decode($jsData, true);
	$db = new mysqli($jsArrData["host"] , $jsArrData["name"] , $jsArrData["password"] , $jsArrData["db_name"]);
	
	
	if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully";




?>