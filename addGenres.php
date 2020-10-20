<?php
include "connectBD.php";

if(!empty($_POST)){
	$nNewGenres = $_POST['name_genres'];
	$NewGenres = $db->real_escape_string($nNewGenres);
	$result = $db->query("
	INSERT INTO `genres` (`name`) 
	VALUES ('$NewGenres')
	");
}
?>

<form method='POST' action='addGenres.php'>
	<input type=text name='name_genres' placeholder='Введите название жанра'><br/><br/>
	<input type=submit value="Добавить жанр"> <br/><br/>
<a href="http://127.0.0.1/addGames.php"> Вернуться </a>
</form>