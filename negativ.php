<?php
	session_start();
	include "connectBD.php";
	
	if(!empty($_GET)){
	$name = $_GET['name'];
	$post = $_GET['post'];
	
	$result = $db->query("INSERT INTO `likes` (`post_id`, `author_id`, `text`, `created_at`) VALUES ('$post','$name','0', NOW() )");
	json_encode(array('success' => 1));
	}else{
		$result = $db->query("INSERT INTO `likes` (`post_id`, `author_id`, `text`, `created_at`) VALUES ('69','69','0', NOW() )");
	}
?>