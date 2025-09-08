<?
$permission=""; $usersystem=""; $mail=""; $idusersystem=0; $idstudy=0;


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
