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
$s="SELECT *  from study, attendance, student, teacher, subject where study.idstudy=attendance.idstudy and attendance.idstudent=student.idstudent  and study.idsubject=subject.idsubject and study.idteacher=teacher.idteacher";
$r=mysqli_query($dbcnx,$s);


	 ?>
     
<font  size="+1" >   Перечень успеваемости от <? echo $date;?>  </font> 

 
 <ol>
<?
for ($i=0; $i<mysqli_num_rows($r); $i++) {
    $row=mysqli_fetch_array($r);
    echo "<li>".implode(" — ", array($row['datestudy'], $row['student'], $row['teacher'], $row['subject'], $row['attendance'], $row['cause']))."</li>";
}
?>
</ol>

       

</body>
</html>
