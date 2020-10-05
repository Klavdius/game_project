<?php

$content = file_get_contents('FormAddDevPul.txt');
echo $content;

	$jsDate = file_get_contents('conf_dev_db.json');
	$jsArray = json_decode($jsDate,true);
	$db = new mysqli($jsArray["host"] , $jsArray["name"] , $jsArray["password"] , $jsArray["db_name"]);

	if($db->connect_errno){
		exit("Error connect ");
	}
	
	
	if($_POST != NULL){
		$flag = $_POST['id'];
		if($flag = toMain){
			header("Location: http://127.0.0.1/MainPost.php");
			exit();
		}
		
		$NewDevel = $_POST['devel_name'];
		
	$result = $db->query(
	"INSERT INTO developers (name)
	VALUE ('$NewDevel')
	");
	
	//protecd
	$_POST = null;
	//
	
	
	//$db->query("INSERT INTO games (title, developer_id, publisher_id) VALUES ('$NewTitle','$NewDevel','$NewPubli')");
	
	if($result == true){
		echo "записалось";
		
	}else{
		echo "ошибка записи ";
	}
		
	}
	
?>