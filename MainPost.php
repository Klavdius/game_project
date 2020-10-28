<?php
	session_start();

	include "connectBD.php";
	if(!empty($_POST)){
		$_SESSION['valueTit'] = $_POST['valueTit'];
		header("Location: /scanPost.php/");
	}
?>

<form method='POST' action='MainPost.php'>
	<label>Добро пожаловать <?php  echo $_SESSION['UserName']?></label><br/>

<a href="/addGames.php">Новая игра!</a><br/><br/>

<a href="/addPost.php"> Новый пост!</a><br/><br/>

<div>
<?php
	$result = $db->query("SELECT *, posts.id as post_id FROM `posts`, `games` WHERE posts.author_game_id = games.id");

	while($row = $result->fetch_assoc()){
		echo "<label>" .$row['title']. "</label><br/>";
//		echo "<input type=submit name=valueTit value='" .$row['titul']. "' ><br/>";
        echo <<<HTML
<a href="/scanPost.php?id={$row['post_id']}">{$row['titul']}</a>
HTML;

	}
?>
</div>

<a href="/welcom.php">Выход</a>

</form>