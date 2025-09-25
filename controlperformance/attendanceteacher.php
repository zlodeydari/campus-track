<?
require "option.php";//файл с показателями подключения к БД
$menugroup=5;


	//выполнение запроса на выборку данных
	$r=mysqli_query($dbcnx,"select * from study where idstudy=$idstudy");	
	$f=mysqli_fetch_array($r);//считывание текующей записи	
	$status=$f[status];	

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><? echo $permission;?></title>
	<meta charset="utf-8" content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
</head>
<body>
<?
$filter=$_GET["filter"];//считывание показателя фильтра
$value1 = $_POST['FilterValue1'];//значение первого поля
$value2 = $_POST['FilterValue2'];//значение первого поля
$value3 = "Все";//значение первого поля
$value4 = "Все";//значение первого поля

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




$r=mysqli_query($dbcnx,$s);


?>
	<? require "menu.php"; ?>
<main>
<form name="form2"  method="post"  >
						
									<div>
										<div>Посещаемость</div>
                                        <div align="right">	

				   

                               

    &nbsp;&nbsp;Студент: 
			
<select  name="FilterValue1"   >	
<option value="Все" selected=selected> Все</option>			
  <?
  
$d=mysqli_query($dbcnx,"select * from student");

for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
 	$m=mysqli_fetch_array($d);
	echo "<option value=".$m['idstudent'];
	if ($m ['idstudent']==$value1)
	 echo " selected=selected";
	echo ">".$m["student"];
	echo "</option>";	 		
  }
  
?>				
</select>


    &nbsp;&nbsp;Преподаватель: 
			
<select  name="FilterValue2"   >	
<option value="Все" selected=selected> Все</option>			
  <?
  
$d=mysqli_query($dbcnx,"select * from teacher");

for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
 	$m=mysqli_fetch_array($d);
	echo "<option value=".$m['idteacher'];
	if ($m ['idteacher']==$value2)
	 echo " selected=selected";
	echo ">".$m["teacher"];
	echo "</option>";	 		
  }
  
?>				
</select>



    &nbsp;&nbsp;Предмет: 
			


    &nbsp;&nbsp;Присутствие: 
			



				<br>
				<input  type="button"  name="button1"  onclick="this.form.action='attendanceteacher.php?filter=1&sort=<? echo $sort;?>'; this.form.submit();"   value="Фильтр">
				<input  type="button"  name="button2"  onclick="this.form.action='attendanceteacher.php?filter=0&sort=<? echo $sort;?>'; this.form.submit();"   value="Очистить">
                
           <br>
             </div>  
 <div align="left">

   </div>            
           
									</div>
                                    
									<div>
										<table >
											<thead>
												<tr>
													<th scope="col">#</th>
                                                    <th scope="col">Дата занятия</th> 
                                                    <th scope="col">Студент</th> 
                                                    <th scope="col">Предмет</th> 
                                                    <th scope="col">Посещаемость</th>
                                                    <th scope="col">Причина</th>       
                                                    </tr>
											</thead>
											<tbody>
<?
		 


			for ($i=0;$i<mysqli_num_rows($r);$i++)//вывод данных в цикле по количеству записей
			  {
				$f=mysqli_fetch_array($r);//считывание текующей записи				
				echo "<tr>";
?>
				<td>
                <label>
				<input type="radio" name="arrattendance[]" value=<? echo $f["idattendance"];?>  <? if ($i==0)  echo "checked=checked";?>>
				<span></span>
                </label>
               </td>
        <?
		
				echo "
				<td> $f[datestudy]</td>				
				<td> $f[student]</td>		
				<td> $f[subject]</td>	
				<td> $f[attendance]</td>
				<td> $f[cause]</td>	

				";							
				
				echo "</tr>";
			  }		 
		?>
											</tbody>
										</table>
										
									</div>

      </form>
</main>
</body>
</html>
