<?
require "option.php";//файл с показателями подключения к БД

$step=$_REQUEST["step"];



?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Успеваемость студентов</title>
	<meta charset="utf-8" content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
</head>
<body>

	<? require "menu.php"; ?>
<main>
<form method="post" >
						<input     name='login' placeholder='Логин *'/> <br>
						<input    type="password"    name='parol' placeholder='Пароль *'/>

<br>
<div align="center">
                            <input    type="button" value="Войти" onclick="this.form.action='index.php?step=1'; this.form.submit();" >       
               		    <input    type="button" value="Очистить" onclick="this.form.action='index.php'; this.form.submit();" >     
</div>
<br>							
						
					</form>
</main>
</body>
</html>
