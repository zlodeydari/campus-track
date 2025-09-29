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
								<!-- /.dropdown-user-->
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
										<div class="card-title">Посещаемость</div>
                                        <div align="right">	
Сортировка:
				<select name="sortname"  style="height:22; width:auto" onChange="this.form.action='attendanceteacher.php?sort=1&filter=<? echo $filter;?>'; this.form.submit();" >


                  <option value="student"  <? if ($fieldsort=="student") {?> selected="selected" <? }?> >Студент </option>
                  <option value="attendance"  <? if ($fieldsort=="attendance") {?> selected="selected" <? }?> >Посещаемость </option>

                </select>   

                               

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

    &nbsp;&nbsp;Присутствие: 
			
<select  name="FilterValue4"   >	
<option value="Все" selected=selected> Все</option>			
<option value="Присутствовал" <? 	if ($value4=='Присутствовал') {echo "selected=selected";}?>> Присутствовал</option>	
<option value="Отсутствовал" <? 	if ($value4=='Отсутствовал') {echo "selected=selected";}?>> Отсутствовал</option>					
</select>

с:<input   name="date1"  value="<? echo "$date1";?>"   type="date">
по:<input   name="date2"   type="date"  value="<? echo "$date2";?>" >

				<br>
				<input  type="button"  name="button1"  onclick="this.form.action='attendanceteacher.php?filter=1&sort=<? echo $sort;?>'; this.form.submit();"   value="Фильтр">
				<input  type="button"  name="button2"  onclick="this.form.action='attendanceteacher.php?filter=0&sort=<? echo $sort;?>'; this.form.submit();"   value="Очистить">
                
           <br>
             </div>  
 <div align="left">
<input   type="button"  class="btn btn-success"  name="button"  onclick="this.form.action='expattendanceteacher.php?sort=<? echo $sort;?>&filter=<? echo $filter;?>'; this.form.submit();" value="Печать ведомости"> 

   </div>            
           
									</div>
                                    
									<div class="card-body">
										<table class="table table-head-bg-success" >
											<thead>
												<tr>
													<th scope="col">#</th>
                                                    <th scope="col">Дата занятия</th> 
                                                    <th scope="col">Студент</th> 
                                                    <th scope="col">Преподаватель</th> 
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
                <label class="form-radio-input">
				<input class="form-radio-input" type="radio" name="arrattendance[]" value=<? echo $f["idattendance"];?>  <? if ($i==0)  echo "checked=checked";?>>
				<span class="form-radio-sign"></span>
                </label>
               </td>
        <?
		
				echo "
				<td> $f[datestudy]</td>				
				<td> $f[student]</td>		
				<td> $f[teacher]</td>
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
							 &copy; <? echo Date("Y");?>,  Все права защищены
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
		var store = $('#notify_store option:selected').val();
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
			type: store,
			placement: {
				from: placementFrom,
				align: placementAlign
			},
			time: 1000,
		});
	});
</script>
</html>