<?php 
	require "header.php";
	require "db.php";

	$data = $_POST;
	if ( isset( $data[ 'register' ] ) ) 
	{

		$errors = array( );
		if   ( trim($data['login']) == '') 
		{
			$errors [] = 'Введите логин!';
		}

		if   ( trim($data['email']) == '')
		 {
			$errors [] = 'Введите email!';
		}

		if   ($data['password'] == '') 
		{
			$errors [] = 'Введите пароль!';
		}

		if   ($data['password_2'] != $data [ 'password' ] ) 
		{
			$errors [] = 'Пароли не совпадают!';
		}

		if   (R::count('users' ,"login = ? " , array($data['login']))  >0 ) 
		{
			$errors [] = 'Этот логин уже используется';
		}

		if   (R::count('users' ,"email = ? " , array($data['email']))  >0 ) 
		{
			$errors [] = 'Этот email уже используется';
		}
		if (empty($errors) )
		 {
		 	$user = R::dispense('users');
		 	$user->login = $data['login'];
		 	$user->email = $data['email'];
		 	$user->password = $data['password'];
		 	$user->join_data = date('Y-m-d');
		 	R::store($user);

		 	echo ' <div style="color: green;" > Вы успешно зарегистрировались !</div><hr> ';
		}
		else
		{
			echo ' <div style="color: red;" > '. array_shift($errors) .'</div><hr> ';
		}
	}
 ?>
 <form action="reg.php" method="POST">
 	<p>
 		<p><strong>Ваш логин</strong></p>
 		<input type="text" name="login">
 	</p>

 	<p>
 		<p><strong>Ваш email</strong></p>
 		<input type="text" name="email">
 	</p>

 	<p>
 		<p><strong>Ваш пароль</strong></p>
 		<input type="password" name="password">
 	</p>

 	<p>
 		<p><strong>Повторите пароль</strong></p>
 		<input type="password" name="password_2">
 	</p>

 	<p>
 		<button type="submit" name="register">Регистрация</button>
 	</p>
 	
 </form>
