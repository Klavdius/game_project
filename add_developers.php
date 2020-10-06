<?php
include 'connectBD.php';

	if(!empty($_POST)){
		$NewDevel = $_POST['devel_name'];
		$result = $db->query(
			"INSERT INTO developers (name)
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
</form>	