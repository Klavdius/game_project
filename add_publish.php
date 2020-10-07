<?php
include 'connectBD.php';

	if(!empty($_POST)){
		$nNewPublish = $_POST['name_pub'];
		$NewPublish = $db->real_escape_string($nNewPublish);
		
		$result = $db->query(
				"INSERT INTO `publishers` (`name`)
				VALUE ('$NewPublish')"
				);
	}
?>

<form method='POST' action='add_publish.php'>
	<label> Введите название издателя </label>
		<br/>
	<input type=text name='name_pub' value=''>
		<br/>
		<br/>
	<input type=submit value=' Создать запись '>
		<br/>
		<br/>
	<a href="http://127.0.0.1/addGames.php"> Назад </a>
</form>

	