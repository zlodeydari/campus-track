<?
require "option.php";//файл с параметрами подключения к БД
$menugroup=8;
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><? echo $permission;?></title>
	<meta charset="utf-8" content='width=ticket-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
<style>@media(max-width:991px){.sidebar{transform:none!important;position:static!important;width:100%}.sidebar .sidebar-wrapper{width:100%;padding-top:0;max-height:none}.main-panel{width:100%;margin-left:0}}</style>
</head>
<body>
<?
if ($permission!="Декан")
{
?>
<script language="javascript">
alert("Требуется авторизация!");
</script>
<?
exit;
}
 


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

?>
	<? require "menu.php"; ?>
<main>
<form name="form2"  method="post"  >

								
									<div>
  
     		<div align="right">	


&nbsp;Группа: 
			
<select  name="FilterValue1"   >	
<option value="Все" selected=selected> Все</option>			
  <?
  
$d=mysqli_query($dbcnx,"select * from squad, spec where squad.idspec=spec.idspec");

for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
 	$m=mysqli_fetch_array($d);
	echo "<option value=".$m['idsquad'];
	if ($m ['idsquad']==$value1)
	 echo " selected=selected";
	echo ">".$m["squad"];
	echo "</option>";	 		
  }
  
?>	
 </select>   


с:<input   name="date1"  value="<? echo "$date1";?>"   type="date">
по:<input   name="date2"   type="date"  value="<? echo "$date2";?>" >

				<br>
				<input  type="button"  name="button1"  onclick="this.form.action='controldean.php?filter=1&sort=<? echo $sort;?>'; this.form.submit();"   value="Фильтр">
				<input  type="button"  name="button2"  onclick="this.form.action='controldean.php?filter=0&sort=<? echo $sort;?>'; this.form.submit();"   value="Очистить">
           <br>          <br>    <br>      
        </div>   




<?
$s="SELECT performance.*, control, teacher, student, subject FROM performance, control, teacher, student, subject where control.idcontrol=performance.idcontrol and performance.idstudent=student.idstudent and performance.idsubject=subject .idsubject and performance.idteacher=teacher.idteacher and performance=2 and control like 'Экзамен'";
	
if ($filter==1)/*есть ли фильтрация данных*/
{
if ($value1!="Все") /*есть ли фильтрация данных*/
 $s=$s." and idsquad= $value1 ";	

$s=$s." and dateperformance>='$date1' and dateperformance<='$date2' ";
}

$r=mysqli_query($dbcnx,$s);	
?>
<div>Перечень двоечников. Общее количество: <? echo mysqli_num_rows($r);?></div>       

 <div align="right">

    <input  type="button"  name="button4"  onclick="this.form.action='expcontroldean1.php?sort=<? echo $sort;?>&filter=<? echo $filter;?>'; this.form.submit();" value="Печать ведомости"> 
   </div>            
           
									</div>
									<div>
										<table >
											<thead>
												<tr>
		<th scope="col">Студент</th>		 
		<th scope="col">Предмет</th>
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
				<td> ".$f['student']."</td>	
				<td> ".$f['subject']."</td>				
				<td> ".$f['performance']."</td>														
				";		
											
				echo "</tr>";
			  }		 
		?>
      
</tbody>
</table>
										
									







<br><br>






<?
$s="SELECT performance.*, control, teacher, student, subject FROM performance, control, teacher, student, subject where control.idcontrol=performance.idcontrol and performance.idstudent=student.idstudent and performance.idsubject=subject .idsubject and performance.idteacher=teacher.idteacher and performance=3 and control like 'Экзамен'";
	
if ($filter==1)/*есть ли фильтрация данных*/
{
if ($value1!="Все") /*есть ли фильтрация данных*/
 $s=$s." and idsquad= $value1 ";	

$s=$s." and dateperformance>='$date1' and dateperformance<='$date2' ";
}

$r=mysqli_query($dbcnx,$s);	
?>
<div>Перечень троечников. Общее количество: <? echo mysqli_num_rows($r);?></div>       

 <div align="right">

    <input  type="button"  name="button4"  onclick="this.form.action='expcontroldean2.php?sort=<? echo $sort;?>&filter=<? echo $filter;?>'; this.form.submit();" value="Печать ведомости"> 
   </div>            
           
									</div>
									<div>
										<table >
											<thead>
												<tr>    
		<th scope="col">Студент</th>		 
		<th scope="col">Предмет</th>
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
				<td> ".$f['student']."</td>	
				<td> ".$f['subject']."</td>				
				<td> ".$f['performance']."</td>														
				";		
											
				echo "</tr>";
			  }		 
		?>
      
</tbody>
</table>







<br><br>




<?
$s="SELECT DISTINCT student, ticket FROM performance, control, teacher, student, subject where control.idcontrol=performance.idcontrol and performance.idstudent=student.idstudent and performance.idsubject=subject .idsubject and performance.idteacher=teacher.idteacher and performance=4 and control like 'Экзамен' and student.idstudent not in (select idstudent from performance where performance<4 and idcontrol =1 )";
	
if ($filter==1)/*есть ли фильтрация данных*/
{
if ($value1!="Все") /*есть ли фильтрация данных*/
 $s=$s." and idsquad= $value1 ";	

$s=$s." and dateperformance>='$date1' and dateperformance<='$date2' ";
}

$r=mysqli_query($dbcnx,$s);	
?>
<div>Перечень ударников. Общее количество: <? echo mysqli_num_rows($r);?></div>       

 <div align="right">

    <input  type="button"  name="button4"  onclick="this.form.action='expcontroldean3.php?sort=<? echo $sort;?>&filter=<? echo $filter;?>'; this.form.submit();" value="Печать ведомости"> 
   </div>            
           
									</div>
									<div>
										<table >
											<thead>
												<tr>    

		<th scope="col">Студент</th>		 

                                       			        
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
				";		
											
				echo "</tr>";
			  }		 
		?>
      
</tbody>
</table>














<br><br>




<?
$s="SELECT DISTINCT student, ticket FROM performance, control, teacher, student, subject where control.idcontrol=performance.idcontrol and performance.idstudent=student.idstudent and performance.idsubject=subject .idsubject and performance.idteacher=teacher.idteacher and performance=5 and control like 'Экзамен' and student.idstudent not in (select idstudent from performance where performance<5 and idcontrol =1 )";
	
if ($filter==1)/*есть ли фильтрация данных*/
{
if ($value1!="Все") /*есть ли фильтрация данных*/
 $s=$s." and idsquad= $value1 ";	

$s=$s." and dateperformance>='$date1' and dateperformance<='$date2' ";
}

$r=mysqli_query($dbcnx,$s);	
?>
<div>Перечень отличников. Общее количество: <? echo mysqli_num_rows($r);?></div>       

 <div align="right">

    <input  type="button"  name="button4"  onclick="this.form.action='expcontroldean4.php?sort=<? echo $sort;?>&filter=<? echo $filter;?>'; this.form.submit();" value="Печать ведомости"> 
   </div>            
           
									</div>
									<div>
										<table >
											<thead>
												<tr>    

		<th scope="col">Студент</th>		 

                                       			        
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
				";		
											
				echo "</tr>";
			  }		 
		?>
      
</tbody>
</table>
















<br><br>




<?
$s="SELECT student, ticket, ROUND(AVG(performance), 2) as avgperformance FROM performance, control, student where control.idcontrol=performance.idcontrol and performance.idstudent=student.idstudent and control like 'Экзамен' ";
	
if ($filter==1)/*есть ли фильтрация данных*/
{
if ($value1!="Все") /*есть ли фильтрация данных*/
 $s=$s." and idsquad= $value1 ";	

$s=$s." and dateperformance>='$date1' and dateperformance<='$date2' ";
}
$s=$s." GROUP BY student, ticket ORDER BY avgperformance DESC";

$r=mysqli_query($dbcnx,$s);	
?>
<div>Средний балл</div>       

 <div align="right">

    <input  type="button"  name="button4"  onclick="this.form.action='expcontroldean5.php?sort=<? echo $sort;?>&filter=<? echo $filter;?>'; this.form.submit();" value="Печать ведомости"> 
   </div>            
           
									</div>
									<div>
										<table >
											<thead>
												<tr>    

		<th scope="col">Студент</th>		 
  		<th scope="col">Средний балл</th>

                                       			        
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
				<td> ".$f['avgperformance']."</td>
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
