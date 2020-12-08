<?php
include 'connectBD.php';

	$npost = $_POST['post'];
	$post = $db->real_escape_string($npost);
	
	if(!empty($_POST['post'])){
		$result = $db->query("INSERT INTO `genres` (`name`)	VALUE ('$post')");
		echo json_encode(['success' => 1]);
		exit();
	}else{
		echo json_encode(['success' => 0]);
	}
?>