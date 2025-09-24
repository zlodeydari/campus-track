<?
require "option.php";//файл с параметрами подключения к БД
$menugroup=7;



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


$s="SELECT study.*, squad, teacher, category, subject FROM study, squad, teacher, category, subject where squad.idsquad=study.idsquad and study.idcategory=category.idcategory and study.idsubject=subject .idsubject and study.idteacher=teacher.idteacher ";
	
if ($filter==1)/*есть ли фильтрация данных*/
{
$date1=$_POST['date1'];    
$date2=$_POST['date2'];    
 
$value1 = $_POST['FilterValue1'];//значение первого поля
$value2 = $_POST['FilterValue2'];//значение первого поля
$value3 = $_POST['FilterValue3'];//значение первого поля
$value4 = $_POST['FilterValue4'];//значение первого поля

if ($value1!="Все") /*есть ли фильтрация данных*/
 $s=$s." and study.idcategory= $value1 ";	

if ($value2!="Все") /*есть ли фильтрация данных*/
 $s=$s." and study.idsquad= $value2 ";	

if ($value3!="Все") /*есть ли фильтрация данных*/
 $s=$s." and study.idsubject= $value3 ";	

if ($value4!="Все") /*есть ли фильтрация данных*/
 $s=$s." and study.idteacher= $value4 ";	

$s=$s." and datestudy>='$date1' and datestudy<='$date2' ";
}


if ($sort==1)/*есть ли сортировка данных*/
{
$fieldsort = $_POST['sortname'];//первое поле
$s=$s." order by $fieldsort";
}
else
$s=$s." order by datestudy DESC";

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
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					

					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

						
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <span ><? echo $usersystem;?></span></span> </a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										
										<div class="u-text">
											<h4><? echo $usersystem;?></h4>
											<p class="text-muted"><? echo $permission;?></p>
											<p class="text-muted"><? echo $mail;?></p>
                                        </div>
									</div>
								</li>
									<div class="dropdown-divider"></div>
									
									<a class="dropdown-item" href="index.php?step=2"><i class="fa fa-power-off"></i> Выход</a>
								</ul>
								<!-- /.dropdown-user -->
							</li>
						</ul>
					</div>
				</nav>
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
										<div class="card-title">Перечень занятий</div>         
     		<div align="right">	
Сортировка:
				<select name="sortname"  style="height:22; width:auto" onChange="this.form.action='studyteacher.php?sort=1&filter=<? echo $filter;?>'; this.form.submit();" >  
					<option value="datestudy DESC"  <? if ($fieldsort=="datestudy DESC") {?> selected="selected" <? }?>>Дата занятий </option>	        
					<option value="category"  <? if ($fieldsort=="category") {?> selected="selected" <? }?>>Тип занятия </option>	
					<option value="squad"  <? if ($fieldsort=="squad") {?> selected="selected" <? }?>>Группа </option>		                    		                                 
					<option value="subject"  <? if ($fieldsort=="subject") {?> selected="selected" <? }?>>Предмет </option>							                
					<option value="teacher"  <? if ($fieldsort=="teacher") {?> selected="selected" <? }?>>Преподаватель </option>                          
                                       
			  </select>  


&nbsp;Тип занятия: 
			
<select  name="FilterValue1"   >	
<option value="Все" selected=selected> Все</option>			
  <?
  
$d=mysqli_query($dbcnx,"select * from category");

for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
 	$m=mysqli_fetch_array($d);
	echo "<option value=".$m['idcategory'];
	if ($m ['idcategory']==$value1)
	 echo " selected=selected";
	echo ">".$m["category"];
	echo "</option>";	 		
  }
  
?>	
 </select>   
                            
&nbsp;Группа: 
			
<select  name="FilterValue2"   >	
<option value="Все" selected=selected> Все</option>			
  <?
  
$d=mysqli_query($dbcnx,"select * from squad");

for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
 	$m=mysqli_fetch_array($d);
	echo "<option value=".$m['idsquad'];
	if ($m ['idsquad']==$value2)
	 echo " selected=selected";
	echo ">".$m["squad"];
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
				<input  type="button"  name="button1"  onclick="this.form.action='studyteacher.php?filter=1&sort=<? echo $sort;?>'; this.form.submit();"   value="Фильтр">
				<input  type="button"  name="button2"  onclick="this.form.action='studyteacher.php?filter=0&sort=<? echo $sort;?>'; this.form.submit();"   value="Очистить">
           <br>            
        </div>   


 <div align="left">
 <input  type="button" class="btn btn-success"  name="button4"    onclick="this.form.action='updstudyteacher.php?upd=0&step=1'; this.form.submit();" value="Добавить">
 <input  type="button" class="btn btn-success"   name="button4" <? if (mysqli_num_rows($r)==0) {?>    disabled="disabled"<? }?>   onclick="this.form.action='updstudyteacher.php?upd=1&step=1'; this.form.submit();" value="Редактирование"> 
 <input  class="btn btn-danger"  type="button"  name="button" <? if (mysqli_num_rows($r)==0) {?>    disabled="disabled"<? }?>  onclick="qwest=window.confirm('Вы действительно хотите удалить запись?');  if (qwest) {this.form.action='delstudyteacher.php'; this.form.submit();}" value="Удалить">    

    <input  type="button" class="btn btn-success"  name="button4" <? if (mysqli_num_rows($r)==0) {?>    disabled="disabled"<? }?>   onclick="this.form.action='attendanceperformance.php'; this.form.submit();" value="Посещаемость"> 
    <input  type="button" class="btn btn-success"  name="button4" <? if (mysqli_num_rows($r)==0) {?>    disabled="disabled"<? }?>   onclick="this.form.action='expstudyteacher.php?sort=<? echo $sort;?>&filter=<? echo $filter;?>'; this.form.submit();" value="Печать ведомости"> 
   </div>            
           
									</div>
									<div class="card-body">
										<table class="table table-head-bg-success" >
											<thead>
												<tr>
		<th scope="col">&nbsp;</th>      
		<th scope="col">Дата занятий</th>                             
		<th scope="col">Тип занятия</th>
		<th scope="col">Группа</th>		 
		<th scope="col">Предмет</th>
		<th scope="col">Преподаватель</th>	
   

                                       			        
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
				<input class="form-radio-input" type="radio" name="arrstudy[]" value=<? echo $f["idstudy"];?>  <? if (($i==0) || ($f["idstudy"]==$idstudy))  echo "checked=checked";?>>
				<span class="form-radio-sign"> <? echo $f["idstudy"];?></span>
                </label>
                </td>			
				<?
				echo "
				<td> ".$f['datestudy']."</td>	
				<td> ".$f['category']."</td>		
				<td> ".$f['squad']."</td>
				<td> ".$f['subject']."</td>				
				<td> ".$f['teacher']."</td>																
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
				<footer class="footer">
					<div class="container-fluid"  >
						<nav class="pull-left">
							<ul class="nav">

							</ul>
						</nav>
						<div class="copyright ml-auto">
							<p><? echo Date("Y");?>, Все права защищены</p>
						</div>				
					</div>
				</footer>
			</div>
		</div>
	</div>
</div>

</body>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/chartist/chartist.min.js"></script>
<script src="assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
<script>
	$('#displayNotif').on('click', function(){
		var placementFrom = $('#notify_placement_from option:selected').val();
		var placementAlign = $('#notify_placement_align option:selected').val();
		var state = $('#notify_state option:selected').val();
		var style = $('#notify_style option:selected').val();
		var content = {};

		content.message = 'Turning standard Bootstrap alerts into "notify" like notifications';
		content.title = 'Bootstrap notify';
		if (style == "withicon") {
			content.icon = 'la la-bell';
		} else {
			content.icon = 'none';
		}
		content.url = 'index.html';
		content.target = '_blank';

		$.notify(content,{
			type: state,
			placement: {
				from: placementFrom,
				align: placementAlign
			},
			time: 1000,
		});
	});
</script>
</html>