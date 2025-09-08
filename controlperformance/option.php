<?
//считывание cookie
$permission=$_COOKIE["permission"];  
$usersystem=$_COOKIE["usersystem"];  
$idusersystem=$_COOKIE["idusersystem"];  
$idstudy=$_COOKIE["idstudy"];  
$mail=$_COOKIE["mail"];  

$now=date("Y")."-".date("m")."-".date("d");    
	
//константы
$yearstring = 4;
$requiredstring = 6;
$shortstring = 100;
$longstring = 200;


//подключение к БД
$dblocation = "localhost";
$dbname = "controlperformance";
$dbuser = "root";
$dbpasswd = "";

$dbcnx = mysqli_connect($dblocation,$dbuser,$dbpasswd,$dbname);

    if(!$dbcnx)
    {
    ?>
    <meta charset="utf-8">
    <?
      echo 'Невозможно соединиться с БД';
      exit;
	}

?>
