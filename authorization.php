 <?php
    session_start();
?>

<!DOCTYPE html>
	<html lang="en">
	<head>
	<meta charset="utf-8"> 
 <title> avtorization</title>
	</head>
	<body>
<div class="container mregister">
<div id="login">
 <h1>Вход на сайт</h1>
<form action="" method="post">
<p><label for="user_pass">Email:<br>
<input class="input" name="email" size="32" required/></label></p>
<p><label for="user_pass">Пароль:<br>
<input class="input" name="password"  size="32" type="password" required/></label></p>
<p class="submit"><input class="button" name= "enter" type="submit" value="Войти"></p>
	  <p class="regtext">Ещё нет аккаунта? <a href= "registration.php">Зарегистрируйтесь</a>!</p>
 </form>

  <?php

  	define('DB_SERVER', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'my_db');
$con = @new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	if ($con->connect_errno) {exit('Ошибка');}

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $chek_user = mysqli_query($con, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
    if (mysqli_num_rows($chek_user)>0)
    {header('Location:page.php');}
    else 
    {echo "Неправильные данные";}
$con->close();
	?>

	<?php


		if ($_SESSION['message'])
		{ echo '<p class="msg">'.$_SESSION['message'].'</p>';

		}
		unset($_SESSION['message']);
	?>

 </div>
</div>
</body>
</html>