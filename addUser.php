<?php

	/*
	Логин пароль
	почта для проверки
	*/
	include 'connectBD.php';
	
	if(!empty($_POST)){
		if($_POST['new_pass'] != $_POST['new_pass2']){
			echo "Пароли должны совпадать!";
		}
		else{
			$nNewUser = $_POST['new_user'];
			$nNewMail = $_POST['new_mail'];
			$nNewPass = $_POST['new_pass'];
			$nNewDes = $_POST['new_descri'];
			
			$NewUser = $db->real_escape_string($nNewUser);
			$NewMail = $db->real_escape_string($nNewMail);
			$NewPass = $db->real_escape_string($nNewPass);
			$NewDes = $db->real_escape_string($nNewDes);
			$NewDob = $_POST['new_dob'];
		
			$result = $db->query("INSERT INTO `users` (`username`,`email`,`password`,`description`,`dob`,`created_at`)VALUES ('$NewUser','$NewMail','$NewPass','$NewDes','$NewDob',NOW())");
				echo "Профиль создан!";
		}
	}
?>


<form method="POST" action="addUser.php">
	<label>Введите имя (login)</label><br/>
	<input type=text name='new_user'><br/><br/>
	<label>Почтовый ящик</label><br/>
	<input type=text name='new_mail'><br/><br/>
	<label>Ваш пароль</label><br/>
	<input type=password name='new_pass'><br/><br/>
	<label>Повторите пароль</label><br/>
	<input type=password name='new_pass2'><br/><br/>
	<label>Пару слов о себе? (необязательно)</label><br/>
	<input type=text name='new_descri'><br/>
	<label>День рожденья </label><br/>
	<input type=date name="new_dob"> <br/><br/>
	<input type=submit value='Зарегестрироваться'><br/>
	<a href="http://127.0.0.1/welcom.php">Назад</a>
		
</form>