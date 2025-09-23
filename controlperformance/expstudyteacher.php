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


$s="SELECT study.*, squad, teacher, category, subject FROM study, squad, teacher, category, subject where squad.idsquad=study.idsquad and study.idcategory=category.idcategory and study.idsubject=subject .idsubject and study.idteacher=teacher.idteacher ";
	
if ($filter==1)/*есть ли фильтрация данных*/
{
$date1=$_POST['date1'];    
$date2=$_POST['date2'];    
 
$value1 = $_POST['FilterValue1'];//значение первого поля
$value2 = $_POST['FilterValue2'];//значение первого поля
$value3 = "Все";//значение первого поля
$value4 = "Все";//значение первого поля

if ($value1!="Все") /*есть ли фильтрация данных*/
 $s=$s." and study.idcategory= $value1 ";	

if ($value2!="Все") /*есть ли фильтрация данных*/
 $s=$s." and study.idsquad= $value2 ";	

}


if ($sort==1)/*есть ли сортировка данных*/
{
$fieldsort = $_POST['sortname'];//первое поле
$s=$s." order by $fieldsort";
}
else
$s=$s." order by datestudy";

$r=mysqli_query($dbcnx,$s);


	 ?>
     
<font  size="+1" >   Перечень занятий от <? echo $date;?>  </font> 

 
 <ol>
<?
for ($i=0; $i<mysqli_num_rows($r); $i++) {
    $row=mysqli_fetch_array($r);
    echo "<li>".implode(" — ", array($row['datestudy'], $row['category'], $row['squad'], $row['subject'], $row['teacher']))."</li>";
}
?>
</ol>

       

</body>
</html>
