<?php
	include 'pdoconfig.php';
	
	
	
	if(!empty($_POST)){
		$NewTitle = $_POST['title_game'];
		$NewDevel = $_POST['select_devel']; //   должен быть выбор из разработчиков
		$NewPubli = $_POST['select_publish']; //   так же поле издателей. или сделать всё 
		
		
		$result = $db->query("INSERT INTO games (title, developer_id, publisher_id) VALUES ('$NewTitle','$NewDevel','$NewPubli')");
		
		if($result == true){
			echo "Записалось";
		}else{
			echo "Ошибка";
		}
	}
	
			
	
	//$content = file_get_contents('FormAddGame.txt');
	//echo $content;
	
	// start html 
	echo '<form method=`POST` action=`add_games.php`>
		<label> Введите название игры </label>
		<br/>
		<br/>
		<input name=`title_game` type=text>
		<br/>
		<br/>';
	
	// add select form developer
	$getDevel = $db->query("SELECT developers.`name` FROM developers ");
	if($getDevel == null){echo "error ";}
	
	echo '<label> Выберите разработчика </label>
	<br/>
	<select name="select_devel">';
	
	foreach($getDevel as $value){
		
		echo '<option>'. $value['name'] .'</option>';
	}
	
	echo '</select>
	<br/>
	<br/>
	<label> Издатель </label>
	<br/>
	<select name="select_publish">';
	$getPublish = $db->query("SELECT publishers.`name` FROM publishers");
	
	foreach($getPublish as $value){
		echo '<option>'. $value['name'] . '</option>';
	}
	// end select
	
	echo '</select>
	<br/>
	<br/>
	<input type=submit value="Создать запись"></form>';
	//end html
	
	
	
	




?>