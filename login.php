<?php 
	require 'header.php';
	require "db.php";

	$data = $_POST;

	if (isset($data['do_login']) ) 
	{
		$errors = array();
		$user = R:: find ('users' , 'login = ?' , array($data['login']));
		if ($user)
		 {		// проверка пароля
				if ( password_verify ($data['password'] , $user->password ))  
			{
			} else
			{
				$errors [] = 'Неверный пароль !' ;
			}
			}	else 
		{
			$errors [] = 'Пользователь с таким логином не найден!' ;
		}
		if (empty($errors) )
		 {
		 	echo ' <div style="color: red;" > '. array_shift($errors) .'</div><hr> ';
		 }
	}



	?>

	<form action="login.php" method="POST">
		<p>
 		<p><strong>Ваш логин</strong></p>
 		<input type="text" name="login">
 	</p>
 	<p>
 		<p><strong>Ваш пароль</strong></p>
 		<input type="password" name="password">
 	</p>
 	<p>
 		<button type="submit" name="do_login">Войти</button>
 	</p>
	</form>