<?
require "option.php";//файл с параметрами подключения к БД
$menugroup=6;
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
	<? require "menu.php"; ?>
<main>
<form name="form2"  method="post"  >

								
									<div>
										<div>Перечень успеваемости</div>         
     		<div align="right">	

				  


&nbsp;Тип контроля: 
			
<select  name="FilterValue1"   >	
<option value="Все" selected=selected> Все</option>			
  <?
  
$d=mysqli_query($dbcnx,"select * from control");

for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
 	$m=mysqli_fetch_array($d);
	echo "<option value=".$m['idcontrol'];
	if ($m ['idcontrol']==$value2)
	 echo " selected=selected";
	echo ">".$m["control"];
	echo "</option>";	 		
  }
  
?>	
 </select>   
                            
&nbsp;Студент: 
			
<select  name="FilterValue2"   >	
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

&nbsp;Предмет: 
			
    

&nbsp;Преподаватель: 
			
     


				<br>
				<input  type="button"  name="button1"  onclick="this.form.action='performancedean.php?filter=1&sort=<? echo $sort;?>'; this.form.submit();"   value="Фильтр">
				<input  type="button"  name="button2"  onclick="this.form.action='performancedean.php?filter=0&sort=<? echo $sort;?>'; this.form.submit();"   value="Очистить">
           <br>            
        </div>   


 <div align="left">



    <input  type="button"  name="button4" <? if (mysqli_num_rows($r)==0) {?>    disabled="disabled"<? }?>   onclick="this.form.action='expperformancedean.php?sort=<? echo $sort;?>&filter=<? echo $filter;?>'; this.form.submit();" value="Печать ведомости"> 
   </div>            
           
									</div>
									<div>
										<table >
											<thead>
												<tr>
		<th scope="col">&nbsp;</th>      
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
				<td>
                <label>
				<input type="radio" name="arrperformance[]" value=<? echo $f["idperformance"];?>  <? if (($i==0) || ($f["idperformance"]==$idperformance))  echo "checked=checked";?>>
				<span> <? echo $f["idperformance"];?></span>
                </label>
                </td>			
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
										
									</div>

      </form>
</main>
</body>
</html>
