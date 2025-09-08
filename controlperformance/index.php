<?
require "option.php";//файл с показателями подключения к БД

$step=$_REQUEST["step"];

if ($step==1)
{
$login=$_POST["login"];
$parol=$_POST["parol"];

//авторизация пользователя (проверка наличие пользователя с введенными данными авторизации в базе данных)
//выполнение запроса на выборку данных
$SET_USER=mysqli_query($dbcnx,"select * from usersystem where login='$login' and parol='$parol'");
$COUNT_USER=mysqli_num_rows($SET_USER);

if ($COUNT_USER>0)
{//пользователь есть

		$f=mysqli_fetch_array($SET_USER);//считывание текующей записи
		//заполнение cookie
		$idusersystem=$f["idusersystem"];
		setcookie ( 'idusersystem', $idusersystem); 
		$permission=$f["permission"];	
		setcookie ( 'permission', $permission); 
		$usersystem=$f["usersystem"];
		setcookie ( 'usersystem', $usersystem); 
		$mail=$f["mail"];
		setcookie ( 'mail', $mail); 		


//переход в зависимости от прав доступа
if ($permission=="Администратор")
 {
?>
<script language="javascript">
location.href='usersystem.php?step=0';
</script>
<?	 
 }





}


}


if ($step==2)
{
//выход из системы

//очищение значений в cookie
		$idusersystem='';
		setcookie ( 'idusersystem', $idusersystem); 
		$permission='';	
		setcookie ( 'permission', $permission); 
		$usersystem='';
		setcookie ( 'usersystem', $usersystem); 
		$mail='';
		setcookie ( 'mail', $mail); 
}


if ( ($step==1) && ($COUNT_USER==0))
{
//ошибка авторизации
?>
<script language="javascript">
alert("Не верный ввод!");
location.href='index.php';
</script>
<?
} 


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
