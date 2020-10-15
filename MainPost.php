<?php
	session_start();
	
	include "connectBD.php";
	if(!empty($_SESSION)){
		$id = $_SESSION['IdUser'];
		echo $id . "<br/>";
	}else{
		echo "sdfsdfsdf" . "<br/>";
	}
	
?>

<form method='POST' action='MainPost.php'>
	<label>Добро пожаловать <?php  echo $_SESSION['UserName']?></label><br/>

<a href="http://127.0.0.1/addGames.php">Новая игра!</a><br/><br/>

<a href="http://127.0.0.1/addPost.php"> Новый пост!</a><br/><br/>

<a href="http://127.0.0.1/welcom.php">Выход</a>

</form>