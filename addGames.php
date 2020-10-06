<a href="http://127.0.0.1/MainPost.php">На главную</a>

<?php
	include 'connectBD.php';
	
	if(!empty($_POST)){
		$NewTitle = $_POST['title_game'];
		$NewDevel = $_POST['select_devel']; //   должен быть выбор из разработчиков
		$NewPubli = $_POST['select_publish']; //   так же поле издателей. или сделать всё 
		
		
		$result = $db->query("INSERT INTO games (title, developer_id, publisher_id) VALUES ('$NewTitle','$NewDevel','$NewPubli')");
			
	}
	// start html
?>	
	<form method='POST' action='add_games.php'>
		<label> Введите название игры </label>
			<br/>
			<br/>
		<input name='title_game' type=text>
			<br/>
			<br/>
		<label> Выберите разработчика </label>
			<br/>
		<select name="select_devel">
<?php	
	$getDevel = $db->query("SELECT * FROM developers ");
	while($row = $getDevel->fetch_assoc() )
	{
		echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
	}
?>	
		</select>
		<a href="http://127.0.0.1/add_developers.php"> + </a>
			<br/>
			<br/>
		<label> Издатель </label>
			<br/>
		<select name="select_publish">';
<?php	
	$getPublish = $db->query("SELECT * FROM publishers");
	while($row = $getPublish->fetch_assoc())
	{
		echo "<option value='" . $row['id'] . "'>" . $row['name']. "</option>";
	}
?>		
		</select>
			<br/>
			<br/>
		<input type=submit value="Создать запись">
	</form>
