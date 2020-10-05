<?php

	$jsDate = file_get_contents('conf_dev_db.json');
	$jsArray = json_decode($jsDate,true);
	$db = new mysqli($jsArray["host"] , $jsArray["name"] , $jsArray["password"] , $jsArray["db_name"]);

	if($db->connect_errno){
		exit("Error connect ");
	}
	
	
	if($_POST != NULL){
		$NewPublich = $_POST['name_pub'];
		
	$result = $db->query(
	"INSERT INTO publishers (name)
	VALUE ('$NewPublich')
	");
	
	//protecd
	$_POST = null;
	//
			
	}
	header("Location: http://127.0.0.1/add_develPub.php");
	
?>