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
$s="SELECT study.*, squad, teacher, category, subject FROM study, squad, teacher, category, subject where squad.idsquad=study.idsquad and study.idcategory=category.idcategory and study.idsubject=subject .idsubject and study.idteacher=teacher.idteacher ";
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
