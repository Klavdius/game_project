<a href="http://127.0.0.1/MainPost.php">На главную</a>

<?php
	include 'connectBD.php';
	
	if(!empty($_POST)){
		$nNewTitle = $_POST['title_game'];
		$NewDevel = $_POST['select_devel']; //   должен быть выбор из разработчиков
		$NewPubli = $_POST['select_publish']; //   так же поле издателей. или сделать всё 
		$NewGenres = $_POST['select_genres'];
		$nNewDes = $_POST['description'];
		$NewReleaseDate = $_POST['release'];
		
		
		$NewTitle = $db->real_escape_string($nNewTitle);
		$NewDes = $db->real_escape_string($nNewDes);
		$result = $db->query("INSERT INTO `games` (`title`, `developer_id`, `publisher_id`, `genres`, `description`, `release_date`, `created_at`) 
		VALUES ('$NewTitle','$NewDevel','$NewPubli','$NewGenres','$NewDes', '$NewReleaseDate', NOW())");
			
	}
	// start html
?>	
	<form method='POST' action='addGames.php'>
		<input name='title_game' type=text placeholder='Введите название игры'> <br/><br/>
		<label> Выберите разработчика </label> <br/>
		<select name="select_devel">
<?php	
	$getDevel = $db->query("SELECT * FROM `developers` ");
	while($row = $getDevel->fetch_assoc() )
	{
		echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
	}
?>	
		</select>
		<a href="http://127.0.0.1/add_developers.php"> + </a> <br/><br/>			
			<label> Издатель </label> <br/>
		<select name="select_publish">';
<?php	
	$getPublish = $db->query("SELECT * FROM `publishers`");
	while($row = $getPublish->fetch_assoc())
	{
		echo "<option value='" . $row['id'] . "'>" . $row['name']. "</option>";
	}
?>		
		</select>
		<a href="http://127.0.0.1/add_publish.php"> + </a>	<br/>
		<label> Игра в жанре </label> <br/>
		<select name="select_genres">
<?php
	$getGenres = $db->query("SELECT * FROM `genres` ");
	while($row = $getGenres->fetch_assoc()){
		echo "<option value='".$row['id']."'>". $row['name'] ."</option>";
	}
?>
		</select>
		<a href="http://127.0.0.1/addGenres.php"> + </a> <br/><br/>
		<input name='description' type=text placeholder='Описание игры'> <br/><br/> 
		
		<input type=date name="release"> <br/><br/> 

		<input type=submit value="Создать запись">
	</form>
