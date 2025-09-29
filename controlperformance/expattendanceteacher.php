<?
require "option.php";//файл с параметрами подключения к БД
date_default_timezone_set("Europe/Moscow");
$date=date("Y")."-".date("m")."-".date("d");   

	header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=Посещаемость от '.$date.'.xls');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0'); 
    header('Cache-Control: must-revalidate');
    header('Pragma: public');   


 	?>				   
		
<html >
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><? echo $permission;?></title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>


<br>

   <?
$filter=$_GET["filter"];//считывание показателя фильтра
$value1 = $_POST['FilterValue1'];//значение первого поля
$value2 = $_POST['FilterValue2'];//значение первого поля
$value3 = $_POST['FilterValue3'];//значение первого поля
$value4 = $_POST['FilterValue4'];//значение первого поля

$sort=$_GET["sort"];//считывание показателя фильтра		

if ($filter==0)/*есть ли фильтрация данных*/
{
$value1 = "Все"; 
$value2 = "Все"; 
$value3 = "Все"; 
$value4 = "Все"; 
$date1=(date("Y")-1)."-".date("m")."-".date("d");    
$date2=(date("Y")+1)."-".date("m")."-".date("d");    
}
else
{
$date1=$_POST['date1'];    
$date2=$_POST['date2'];   
}

//выполнение запроса на выборку данных
$s="SELECT *  from study, attendance, student, teacher, subject where study.idstudy=attendance.idstudy and attendance.idstudent=student.idstudent  and study.idsubject=subject.idsubject and study.idteacher=teacher.idteacher";


 if (($value1!="Все") and ($filter==1))/*есть ли фильтрация данных*/
 $s=$s." and attendance.idstudent = $value1 ";	
  if (($value2!="Все") and ($filter==1))/*есть ли фильтрация данных*/
 $s=$s." and study.idteacher = $value2 ";	
 if (($value3!="Все") and ($filter==1))/*есть ли фильтрация данных*/
 $s=$s." and study.idsubject = $value3 ";	
 if (($value4!="Все") and ($filter==1))/*есть ли фильтрация данных*/
 $s=$s." and attendance like '$value4' ";	

$s=$s." and datestudy>='$date1' and datestudy<='$date2' ";

if ($sort==1)/*есть ли сортировка данных*/
{
$fieldsort = $_POST['sortname'];//первое поле
$s=$s." order by $fieldsort";
}
else
$s=$s." order by student";

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
