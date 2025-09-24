<?
require "option.php";//файл с параметрами подключения к БД
$menugroup=7;

if (isset ($_POST['arrstudy']))
{
 $Arr=$_POST['arrstudy'];
 $idstudy=$Arr[0];
 setcookie ( 'idstudy', $idstudy); 
}

if ($permission!="Преподаватель")
{
?>
<meta charset="utf-8">
<script language="javascript">
alert("Требуется авторизация!");
</script>
<?
exit;
}

$step=$_REQUEST["step"];

if ($step==1)
setcookie ('file', '');



date_default_timezone_set("Europe/Moscow");
$date=date("Y")."-".date("m")."-".date("d");   



if ($step==2)
{
$upd=$_REQUEST["upd"];

$datestudy =  $_POST["datestudy"];
$idsquad =  $_POST["idsquad"];
$idcategory =  $_POST["idcategory"];
$idsubject =  $_POST["idsubject"];
$idteacher =  $_POST["idteacher"];




if ($upd==1)
  {  
     $idstudy=$_REQUEST["id"];
     	 $s="UPDATE study set datestudy='$datestudy', idsquad='$idsquad', idcategory='$idcategory', idsubject='$idsubject', idteacher='$idteacher' WHERE idstudy=$idstudy";
	 mysqli_query($dbcnx,$s);

	mysqli_query($dbcnx, "delete from attendance where idstudy=$idstudy");
	$r=mysqli_query($dbcnx, "select idstudent from student where idsquad=$idsquad");

		for ($i=0;$i<mysqli_num_rows($r);$i++)
		  {
		  $f=mysqli_fetch_array($r);//считывание текующей записи
		  $idstudent=$f["idstudent"];
		  mysqli_query($dbcnx, "insert into attendance (idstudent, idstudy, attendance) values ('$idstudent', '$idstudy', 'Присутствовал')");

		  }

  }  else
  {//формирование SQL-запроса на добавление данных
	 mysqli_query($dbcnx, "INSERT INTO study ( idcategory, idsquad, datestudy, idsubject, idteacher) VALUES ('$idcategory', '$idsquad', '$datestudy', '$idsubject', '$idteacher')");
	$idstudy=mysqli_insert_id($dbcnx);

	$r=mysqli_query($dbcnx, "select idstudent from student where idsquad=$idsquad");

		for ($i=0;$i<mysqli_num_rows($r);$i++)
		  {
		  $f=mysqli_fetch_array($r);//считывание текующей записи
		  $idstudent=$f["idstudent"];
		  mysqli_query($dbcnx, "insert into attendance (idstudent, idstudy, attendance) values ('$idstudent', '$idstudy', 'Присутствовал')");

		  }
	
  }	
  
  ?>
	 <script language="javascript">
 location.href='studyteacher.php?filter=0';
	 </script>
	 <?
}

	 $upd=$_REQUEST["upd"];

	 if ($upd==1)
		{
	 $Arr=$_REQUEST["arrstudy"];
	 $idstudy=$Arr[0];
	 $r=mysqli_query($dbcnx, "select * from study where idstudy=$idstudy");
	 $f=mysqli_fetch_array($r);
	 }
     ?>


<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><? echo $permission;?></title>
	<meta charset="utf-8" content='width=studyexec-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
</head>
<body>     
     
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
				
				
				
				
<form name="form2"  method="post"  enctype="multipart/form-data" >

								
									<div class="card-header">
	 								<? 
									if ($upd==0){ 
									?>
										<div class="card-title">Добавление занятия</div>
                                    <?
									}
									else
									{
									?>
										<div class="card-title">Редактирование занятия (<? echo $f["idstudy"];?>)</div>
									<?
                                    					}
									?>  
                                         
									</div>
                                    
									<div class="card-body">
				  <table border="0">


                    <tr>
                      <td><font color="#000000" >  Дата занятий: </font> </td>
                      <td><input  class="form-control input-full"   name="datestudy"  value="<? if ($upd==1) echo $f['datestudy']; else echo("$date"); ?>"   type="date" ></td>
                    </tr>   
          
            
 <tr> 
 <td><font color="#000000" >   Тип занятий: </font></td>
        <td ><select class="form-control" name="idcategory"  style="height:22; width:auto" >
  <?

$d=mysqli_query($dbcnx, "select * from category");
for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
    $m=mysqli_fetch_array($d);
	echo "<option value=".$m["idcategory"];
	if (($upd==1)&&    ($m["idcategory"]==$f["idcategory"]))
	 echo " selected=selected";
	echo ">".$m["category"];
	echo "</option>";	 		
  }

?>
					  
</select></td>
</tr>    
                 
  <tr> 
 <td><font color="#000000" >   Группа: </font></td>
        <td ><select class="form-control" name="idsquad"  style="height:22; width:auto" >
  <?

$d=mysqli_query($dbcnx, "select * from squad");
for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
    $m=mysqli_fetch_array($d);
	echo "<option value=".$m["idsquad"];
	if (($upd==1)&&    ($m["idsquad"]==$f["idsquad"]))
	 echo " selected=selected";
	echo ">".$m["squad"];
	echo "</option>";	 		
  }

?>
					  
</select></td>
</tr>                            

  <tr> 
 <td><font color="#000000" >   Предмет: </font></td>
        <td ><select class="form-control" name="idsubject"  style="height:22; width:auto" >
  <?

$d=mysqli_query($dbcnx, "select * from subject");
for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
    $m=mysqli_fetch_array($d);
	echo "<option value=".$m["idsubject"];
	if (($upd==1)&&    ($m["idsubject"]==$f["idsubject"]))
	 echo " selected=selected";
	echo ">".$m["subject"];
	echo "</option>";	 		
  }

?>
					  
</select></td>
</tr>

  <tr> 
 <td><font color="#000000" >   Преподаватель: </font></td>
        <td ><select class="form-control" name="idteacher"  style="height:22; width:auto" >
  <?

$d=mysqli_query($dbcnx, "select * from teacher");
for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
    $m=mysqli_fetch_array($d);
	echo "<option value=".$m["idteacher"];
	if (($upd==1)&&    ($m["idteacher"]==$f["idteacher"]))
	 echo " selected=selected";
	echo ">".$m["teacher"];
	echo "</option>";	 		
  }

?>
					  
</select></td>
</tr>
                  </table>
<br>
				<input  class="btn btn-success" type="button"  name="button"   onclick="this.form.action='updstudyteacher.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>'; this.form.submit();"   value="Сохранить" width="500">
				<input   class="btn btn-danger" type="button"  name="button"  onClick="javascript:history.back();"  value="Отмена">
                                    
                                    
                                    	
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