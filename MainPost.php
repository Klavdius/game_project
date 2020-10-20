<?php
	session_start();
	
	include "connectBD.php";
	if(!empty($_POST)){
		$_SESSION['valueTit'] = $_POST['valueTit'];
		header("Location: http://127.0.0.1/scanPost.php/");
	}	
?>

<form method='POST' action='MainPost.php'>
	<label>Добро пожаловать <?php  echo $_SESSION['UserName']?></label><br/>

<a href="http://127.0.0.1/addGames.php">Новая игра!</a><br/><br/>

<a href="http://127.0.0.1/addPost.php"> Новый пост!</a><br/><br/>

<div>
<?php
	$result = $db->query("SELECT * FROM `posts`, `games` WHERE posts.author_game_id = games.id");
	
	while($row = $result->fetch_assoc()){
		echo "<label>" .$row['title']. "</label><br/>";
		echo "<input type=submit name=valueTit value='" .$row['titul']. "' ><br/>";
	}
?>	
</div>

<a href="http://127.0.0.1/welcom.php">Выход</a>

</form>