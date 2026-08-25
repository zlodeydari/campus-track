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
$s="SELECT student, ticket, ROUND(AVG(performance), 2) as avgperformance FROM performance, control, student where control.idcontrol=performance.idcontrol and performance.idstudent=student.idstudent and control like 'Экзамен' ";
$s=$s." GROUP BY student, ticket ORDER BY avgperformance DESC";
$r=mysqli_query($dbcnx,$s);


?>


     
<font  size="+1" >   Средний балл от <? echo $date;?>  </font> 

 
 <ol>
<?
for ($i=0; $i<mysqli_num_rows($r); $i++) {
    $row=mysqli_fetch_array($r);
    echo "<li>".implode(" — ", array($row['student'], $row['ticket'], $row['avgperformance']))."</li>";
}
?>
</ol>

       

</body>
</html>
