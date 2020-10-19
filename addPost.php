<?php
	session_start();
	include "connectBD.php";
	// id avtora id game titul + text + data
	
	if(!empty($_POST)){
		$nNewTitle = $_POST['new_title'];
		$nNewText = $_POST['mainText'];
		
		$NewTitle = $db->real_escape_string($nNewTitle);
		$NewText = $db->real_escape_string($nNewText);
		$idAuthor = $_SESSION['IdUser'];
		$idGame = $_POST['post_game'];
		
		$result = $db->query("INSERT INTO `posts` (`author_user_id`, `author_game_id`, `titul`, `content`, `created_at`) VALUES ('$idAuthor', '$idGame', '$NewTitle' , '$NewText', NOW())");
		header("Location: http://127.0.0.1/MainPost.php/");
	}

?>


<form method='POST' action='addPost.php'>
<label>Выберите игру</label><br/>
	<select name="post_game">
<?php
	$selArray = $db->query("SELECT * FROM `games`");
	while($row = $selArray->fetch_assoc()){
		echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
	}
?>
	<label>Заговоловок новости</label><br/>
	<input type=text name='new_title'><br/><br/>
	
	</select><br/>
	<label>Не нашли свою игру? Добавьте её! </label><br/>
	<a href="http://127.0.0.1/addGames.php">Добавить игру</a><br/><br/>
	<label>Текст</label><br/>
	<input type=text name='mainText'><br/>
	<input type=submit value='Опубликовать'><br/><br/>
	
	<a href="http://127.0.0.1/MainPost.php">Вернуться назад</a><br/><br/>
	
</form>