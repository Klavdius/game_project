<?php
	session_start();
	include "connectBD.php";
	
	if(!empty($_POST)){
	$nname = $_SESSION['IdUser'];
	$npost = $_POST['post'];
	$nmevalue = $_POST['value'];
	
	$name = $db->real_escape_string($nname);
	$post = $db->real_escape_string($npost);
	$nmevalue = $db->real_escape_string($nmevalue);
	
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