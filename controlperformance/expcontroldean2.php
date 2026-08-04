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
$date1=(date("Y")-1)."-".date("m")."-".date("d");    
$date2=(date("Y")+1)."-".date("m")."-".date("d");    
}
else
{
$date1=$_POST['date1'];    
$date2=$_POST['date2'];    
 
$value1 = $_POST['FilterValue1'];//значение первого поля
}


$s="SELECT performance.*, control, teacher, student, subject FROM performance, control, teacher, student, subject where control.idcontrol=performance.idcontrol and performance.idstudent=student.idstudent and performance.idsubject=subject .idsubject and performance.idteacher=teacher.idteacher and performance=3 and control like 'Экзамен'";
		
if ($filter==1)/*есть ли фильтрация данных*/
{
if ($value1!="Все") /*есть ли фильтрация данных*/
 $s=$s." and idsquad= $value1 ";	

$s=$s." and dateperformance>='$date1' and dateperformance<='$date2' ";
}

$r=mysqli_query($dbcnx,$s);


?>


     
<font  size="+1" >   Перечень троечников от <? echo $date;?>  </font> 

 
 <table border=1>
											<thead>
												<tr>
		<th scope="col">Дата оценки</th>                             
		<th scope="col">Тип контроля</th>
		<th scope="col">Студент</th>		 
		<th scope="col">Предмет</th>
		<th scope="col">Преподаватель</th>	
  		<th scope="col">Оценка</th> 
          
            

                                       			        
                                                    </tr>
											</thead>
											<tbody>
        
        
      <?
		 
		

			for ($i=0;$i<mysqli_num_rows($r);$i++)//вывод данных в цикле по количеству записей
			  {
				$f=mysqli_fetch_array($r);//считывание текующей записи				
				echo "<tr>";

?>			 
		
				<?
				echo "
				<td> ".$f['dateperformance']."</td>	
				<td> ".$f['control']."</td>
				<td> ".$f['student']."</td>	
				<td> ".$f['subject']."</td>				
				<td> ".$f['teacher']."</td>			
				<td> ".$f['performance']."</td>					
				";		
											
				echo "</tr>";
			  }		 
		?>
      
</tbody>
										</table>

       

</body>
</html>
