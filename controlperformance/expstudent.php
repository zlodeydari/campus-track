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
$value2 = "Все"; 
}


$s="SELECT student.*, squad FROM student INNER JOIN squad ON squad.idsquad=student.idsquad where idstudent=idstudent ";
	
if ($filter==1)/*есть ли фильтрация данных*/
{
$fieldfind = $_POST['findname'];//первое поле
$value1 = $_POST['FilterValue1'];//значение первого поля
$value2 = $_POST['FilterValue2'];//значение первого поля

if ($value1!="Все")
$s=$s." and UPPER($fieldfind) LIKE UPPER('%$value1"."%')  ";
else
$s=$s." and $fieldfind=$fieldfind ";

if ($value2!="Все") /*есть ли фильтрация данных*/
 $s=$s." and squad.idsquad= $value2 ";	
}


if ($sort==1)/*есть ли сортировка данных*/
{
$fieldsort = $_POST['sortname'];//первое поле
$s=$s." order by $fieldsort";
}
else
$s=$s." order by squad";

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
