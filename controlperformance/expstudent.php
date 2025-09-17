<?
require "option.php";//файл с параметрами подключения к БД
date_default_timezone_set("Europe/Moscow");
$date=date("Y")."-".date("m")."-".date("d");   



 	?>				   
		
<html >
<head><meta charset="utf-8"><title>Ведомость</title></head>
<body>


<br>

   <?


$s="SELECT student.*, squad FROM student INNER JOIN squad ON squad.idsquad=student.idsquad where idstudent=idstudent ";
$r=mysqli_query($dbcnx,$s);

	 ?>
     
<font  size="+1" >   Перечень студентов от <? echo $date;?>  </font> 

 
 <ol>
<?
for ($i=0; $i<mysqli_num_rows($r); $i++) {
    $row=mysqli_fetch_array($r);
    echo "<li>".implode(" — ", array($row['student'], $row['squad'], $row['datebirth'], $row['ticket']))."</li>";
}
?>
</ol>

       

</body>
</html>
