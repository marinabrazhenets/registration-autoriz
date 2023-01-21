 <?php
    session_start();
?>

<!DOCTYPE html>
	<html lang="en">
	<head>
	<meta charset="utf-8"> 
 <title> registration</title>
 <link rel="stylesheet" href="ou.css">
	</head>
	<body>

		 <?php

		 	$nameform = $passwordform = $emailform = "";
		 	$a = $b = $c = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])) {
    $nameform  = test_input($_POST['username']);
    $passwordform = test_input($_POST['password']);
    $passwordform = md5($passwordform);
    $emailform = test_input(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
}
else{

  if (empty($_POST['password'])) {
    $passErr = "Введите пароль";
    $c = 1;
  } 

  if (empty($_POST['email'])) {
    $emailErr = "Введите email";
    $b = 2;
  } 

 if (empty($_POST['username']))
  { $nameErr = "Введите имя";
    $a = 3;
  }
}
}

 function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
  return $data;
}
?>
<div class="container mregister">
<div id="login">
 <h1>Регистрационная форма</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="registerform" method="post"name="registerform">
<p><label for="user_pass">Имя:<br>
<input class="<?php if ($a>0) { echo 'errorss'; } ?>" name="username"size="32" type="text"  > </label></p>
<span class="error" > <?php echo $nameErr;?></span>
<p><label for="user_pass">Email:<br>
<input class="<?php if ($b>0) { echo 'errorsss'; } ?>" name="email" size="32"type="email" value="" ></label></p>
<span class="error"> <?php echo $emailErr;?></span>
<p><label for="user_pass">Пароль:<br>
<input class="<?php if ($c>0) { echo 'errorsss'; } ?>" name="password"size="32"   type="password" value="" ></label></p>
<span class="error"> <?php echo $passErr;?></span>
<p class="submit"><input class="button" name="register" type="submit" value="Зарегистрироваться"></p>
	  <p class="regtext">Уже зарегистрированы? <a href= "authorization.php">Авторизируйтсь</a>!</p>
 </form>

 <?php

	define('DB_SERVER', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'my_db');
$con = @new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($con->connect_errno) {exit('Ошибка');}



if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])) {
	$name = '"'.$con->real_escape_string($nameform).'"';
	$email = '"'.$con->real_escape_string($emailform).'"';
	$password = '"'.$con->real_escape_string($passwordform).'"';

	$query="INSERT INTO users (name, email, password) VALUES ($name, $email, $password)";
	$result=$con->query($query);
	$con->close();
	echo "Успешно";
}
elseif (!empty($_POST['username']) || !empty($_POST['password']) || !empty($_POST['email'])) {echo "Пожалуйста, заполните все данные!";}


	?>
</div>
</div>
</body>
</html>