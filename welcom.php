<?php
	if (!empty($_SESSION)){
		session_destroy();
	}
	session_start();
	include "connectBD.php";

	if(!empty($_POST)){
		$verifName = $_POST['user_name'];
		$verifPass = $_POST['pass_user'];

		$Chek = $db->query("SELECT * FROM `users`");
		while($ChekArr = $Chek->fetch_assoc())
		{
			if($verifName != $ChekArr['username'])
			{
				echo "не верное имя";
			}else
			{	if($verifPass != $ChekArr['password'])
				{
					echo "Не верный пароль";
				}else
				{
					$realId = $ChekArr['id'];
					$_SESSION['IdUser'] = $realId;
					$_SESSION['UserName'] = $verifName;
					$_SESSION['Password'] = $verifPass;
					header("Location: /MainPost.php/");
				}
			}
		}
	}
?>

<form method='POST' action='/welcom.php'>
	<input type=text name='user_name' placeholder='Введите имя'><br/><br/>
	<input type=password name='pass_user' placeholder='Введите пароль'><br/><br/>
	<input type=submit value='Зайти'>
	<a href='/addUser.php'>Зарегистрироваться </a>
</form>