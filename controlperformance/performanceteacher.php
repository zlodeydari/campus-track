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
</head>
<body>
<?
if ($permission!="Преподаватель")
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
$value3 = $_POST['FilterValue3'];//значение первого поля
$value4 = $_POST['FilterValue4'];//значение первого поля

if ($value1!="Все") /*есть ли фильтрация данных*/
 $s=$s." and performance.idstudent= $value1 ";	

if ($value2!="Все") /*есть ли фильтрация данных*/
 $s=$s." and performance.idcontrol= $value2 ";	

if ($value3!="Все") /*есть ли фильтрация данных*/
 $s=$s." and performance.idsubject= $value3 ";	

if ($value4!="Все") /*есть ли фильтрация данных*/
 $s=$s." and performance.idteacher= $value4 ";	

$s=$s." and dateperformance>='$date1' and dateperformance<='$date2' ";
}


if ($sort==1)/*есть ли сортировка данных*/
{
$fieldsort = $_POST['sortname'];//первое поле
$s=$s." order by $fieldsort";
}
else
$s=$s." order by dateperformance DESC";

$r=mysqli_query($dbcnx,$s);

	 ?>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="#" class="logo">
					<? echo $permission;?>
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			
			</div>

<?
require "menu.php";//файл с меню
?>

			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">

                    
                   
				<div class="card">
                     
<form name="form2"  method="post"  >

								
									<div class="card-header">
										<div class="card-title">Перечень успеваемости</div>         
     		<div align="right">	
Сортировка:
				<select name="sortname"  style="height:22; width:auto" onChange="this.form.action='performanceteacher.php?sort=1&filter=<? echo $filter;?>'; this.form.submit();" >  
					<option value="dateperformance DESC"  <? if ($fieldsort=="dateperformance DESC") {?> selected="selected" <? }?>>Дата оценки </option>	        
					<option value="student"  <? if ($fieldsort=="student") {?> selected="selected" <? }?>>Тип контроля </option>	
					<option value="control"  <? if ($fieldsort=="control") {?> selected="selected" <? }?>>Студент </option>		                    		                                 
					<option value="subject"  <? if ($fieldsort=="subject") {?> selected="selected" <? }?>>Предмет </option>							                
					<option value="teacher"  <? if ($fieldsort=="teacher") {?> selected="selected" <? }?>>Преподаватель </option>                          
                                       
			  </select>  


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
			
<select  name="FilterValue3"   >	
<option value="Все" selected=selected> Все</option>			
  <?
  
$d=mysqli_query($dbcnx,"select * from subject");

for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
 	$m=mysqli_fetch_array($d);
	echo "<option value=".$m['idsubject'];
	if ($m ['idsubject']==$value3)
	 echo " selected=selected";
	echo ">".$m["subject"];
	echo "</option>";	 		
  }
  
?>	
 </select>    

&nbsp;Преподаватель: 
			
<select  name="FilterValue4"   >	
<option value="Все" selected=selected> Все</option>			
  <?
  
$d=mysqli_query($dbcnx,"select * from teacher");

for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
 	$m=mysqli_fetch_array($d);
	echo "<option value=".$m['idteacher'];
	if ($m ['idteacher']==$value4)
	 echo " selected=selected";
	echo ">".$m["teacher"];
	echo "</option>";	 		
  }
  
?>	
 </select>     

с:<input   name="date1"  value="<? echo "$date1";?>"   type="date">
по:<input   name="date2"   type="date"  value="<? echo "$date2";?>" >

				<br>
				<input  type="button"  name="button1"  onclick="this.form.action='performanceteacher.php?filter=1&sort=<? echo $sort;?>'; this.form.submit();"   value="Фильтр">
				<input  type="button"  name="button2"  onclick="this.form.action='performanceteacher.php?filter=0&sort=<? echo $sort;?>'; this.form.submit();"   value="Очистить">
           <br>            
        </div>   


 <div align="left">
 <input  type="button" class="btn btn-success"  name="button4"    onclick="this.form.action='updperformanceteacher.php?upd=0&step=1'; this.form.submit();" value="Добавить">
 <input  type="button" class="btn btn-success"   name="button4" <? if (mysqli_num_rows($r)==0) {?>    disabled="disabled"<? }?>   onclick="this.form.action='updperformanceteacher.php?upd=1&step=1'; this.form.submit();" value="Редактирование"> 
 <input  class="btn btn-danger"  type="button"  name="button" <? if (mysqli_num_rows($r)==0) {?>    disabled="disabled"<? }?>  onclick="qwest=window.confirm('Вы действительно хотите удалить запись?');  if (qwest) {this.form.action='delperformanceteacher.php'; this.form.submit();}" value="Удалить">    


    <input  type="button" class="btn btn-success"  name="button4" <? if (mysqli_num_rows($r)==0) {?>    disabled="disabled"<? }?>   onclick="this.form.action='expperformanceteacher.php?sort=<? echo $sort;?>&filter=<? echo $filter;?>'; this.form.submit();" value="Печать ведомости"> 
   </div>            
           
									</div>
									<div class="card-body">
										<table class="table table-head-bg-success" >
											<thead>
												<tr>
		<th scope="col">&nbsp;</th>      
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
				<td>
                <label class="form-radio-input">
				<input class="form-radio-input" type="radio" name="arrperformance[]" value=<? echo $f["idperformance"];?>  <? if (($i==0) || ($f["idperformance"]==$idperformance))  echo "checked=checked";?>>
				<span class="form-radio-sign"> <? echo $f["idperformance"];?></span>
                </label>
                </td>			
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
										
									</div>

      </form>	            
           								</div>

					</div>
				</div>     
                <div>

                                               
                </div>
				
			</div>
		</div>
	</div>
</div>

<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
</body>














</html>