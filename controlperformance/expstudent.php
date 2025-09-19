<?
require "option.php";//файл с параметрами подключения к БД
date_default_timezone_set("Europe/Moscow");
$date=date("Y")."-".date("m")."-".date("d");   

	header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=Перечень студентов от '.$date.'.xls');
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

 
 <table border=1>
											<thead>
												<tr>
                                  

		<th scope="col">Студент</th>
		<th scope="col">Группа</th>		 
		<th scope="col">Дата рождения</th>

		<th scope="col">Билет</th>      
          
            

                                       			        
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

				<td> ".$f['student']."</td>		
				<td> ".$f['squad']."</td>
				<td> ".$f['datebirth']."</td>													
					
				<td> ".$f['ticket']."</td>				
				";		
											
				echo "</tr>";
			  }		 
		?>
      
</tbody>
										</table>

       

</body>
</html>
