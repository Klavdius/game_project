<?php
include 'connectBD.php';

	if(!empty($_POST)){
		$nNewDevel = $_POST['devel_name'];
		$NewDevel = $db->real_escape_string($nNewDevel);
		$result = $db->query(
			"INSERT INTO `developers` (`name`)
			VALUE ('$NewDevel')"
			);
	}
	
	
?>
<form method='POST' action='add_developers.php'>
	<label>Введите название разработчиков</label>
		<br/>
	<input name='devel_name' value='' type=text>
		<br/>
		<br/>
	<input type=submit value='Создать запись'> 
		<br/>
		<br/>
	<a href="http://127.0.0.1/addGames.php"> Назад </a>	
</form>	