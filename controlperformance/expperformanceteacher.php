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

$filter=$_GET["filter"];//считывание параметра фильтра
$sort=$_GET["sort"];//считывание параметра фильтра		

if ($filter==0)/*есть ли фильтрация данных*/
{
$value1 = "Все"; 
$value2 = "Все"; 
$value3 = "Все"; 
$value4 = "Все"; 
$date1=(date("Y")-1)."-".date("m")."-".date("d");    
$date2=(date("Y")+1)."-".date("m")."-".date("d");    
}


$s="SELECT performance.*, control, teacher, student, subject FROM performance, control, teacher, student, subject where control.idcontrol=performance.idcontrol and performance.idstudent=student.idstudent and performance.idsubject=subject .idsubject and performance.idteacher=teacher.idteacher ";
	
if ($filter==1)/*есть ли фильтрация данных*/
{
$date1=$_POST['date1'];    
$date2=$_POST['date2'];    
 
$value1 = $_POST['FilterValue1'];//значение первого поля
$value2 = $_POST['FilterValue2'];//значение первого поля
$value3 = "Все";//значение первого поля
$value4 = "Все";//значение первого поля

if ($value1!="Все") /*есть ли фильтрация данных*/
 $s=$s." and performance.idstudent= $value1 ";	

if ($value2!="Все") /*есть ли фильтрация данных*/
 $s=$s." and performance.idcontrol= $value2 ";	

}




$r=mysqli_query($dbcnx,$s);


	 ?>
     
<font  size="+1" >   Перечень успеваемости от <? echo $date;?>  </font> 

 
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
