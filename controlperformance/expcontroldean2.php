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
$s="SELECT performance.*, control, teacher, student, subject FROM performance, control, teacher, student, subject where control.idcontrol=performance.idcontrol and performance.idstudent=student.idstudent and performance.idsubject=subject .idsubject and performance.idteacher=teacher.idteacher and performance=3 and control like 'Экзамен'";
$r=mysqli_query($dbcnx,$s);


?>


     
<font  size="+1" >   Перечень троечников от <? echo $date;?>  </font> 

 
 <ol>
<?
for ($i=0; $i<mysqli_num_rows($r); $i++) {
    $row=mysqli_fetch_array($r);
    echo "<li>".implode(" — ", array($row['dateperformance'], $row['control'], $row['student'], $row['subject'], $row['teacher'], $row['performance']))."</li>";
}
?>
</ol>

       

</body>
</html>
