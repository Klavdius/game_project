<?php
	session_start();
	include "connectBD.php";
	
	if(!empty($_POST)){
	$name = $_SESSION['IdUser'];
	$post = $_POST['post'];
	$mevalue = $_POST['value'];
	
	//проверка на оригинальность
	$OneStep = $db->query("SELECT * from `likes` WHERE likes.post_id = $post AND likes.user_id = $name ");
	$resOneStep = $OneStep->fetch_assoc();
		if(empty($resOneStep)){
		//новая запись
			$result = $db->query("INSERT INTO `likes` (`post_id`, `user_id`, `value`, `created_at`) VALUES ('$post','$name','$mevalue', NOW() )");
			echo json_encode(['success' => 1]);
			exit();
		}else{
		//проверка на смену лайка
			if($resOneStep['value'] != $mevalue){
			//замена
				$result = $db->query("UPDATE `likes` SET `value` = '$mevalue' WHERE `post_id` = '$post' AND `user_id` = '$name' ");
				echo json_encode(['success' => 1]);
				exit();
			}else{
				//отмена оценки
				$result = $db->query("DELETE FROM `likes` WHERE `post_id` = '$post' AND `user_id` = '$name' ");
				echo json_encode(['success' => 1]);
				exit();
			}
		echo json_encode(['success' => 1]);
		}
	}else{
		echo json_encode(['success' => 0]);
	}
?>