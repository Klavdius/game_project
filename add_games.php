<?php
	
	
	$jsData = file_get_contents('conf_dev_db.json');
	$jsArrData = json_decode($jsData, true);
	$db = new mysqli($jsArrData["host"] , $jsArrData["name"] , $jsArrData["password"] , $jsArrData["db_name"]);
	
	if ($db->connect_errno) {
		exit("Connection failed: ");
    }
	
	$content = file_get_contents('FormAddGame.txt');
	echo $content;
	
	if($_POST != null){
		$NewTitle = $_POST['title_game'];
		$NewDevel = $_POST['develGame']; //   должен быть выбор из разработчиков
		$NewPubli = $_POST['publiGame']; //   так же поле издателей. или сделать всё 
		
		
		$otvet = $db->query("SELECT games.title FROM 'games' WHERE games.title = $title");
		echo $otvet;
		//$result = $db->query("INSERT INTO games (title, developer_id, publisher_id) VALUES ('$NewTitle','$NewDevel','$NewPubli')");
		
		if($result == true){
			echo "Записалось";
		}else{
			echo "Ошибка";
		}
	}
	
	




?>