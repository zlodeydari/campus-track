<?
require "option.php";//файл с параметрами подключения к БД
$menugroup=8;

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

$dateperformance =  $_POST["dateperformance"];
$idcontrol =  $_POST["idcontrol"];
$idstudent =  $_POST["idstudent"];
$idsubject =  $_POST["idsubject"];
$idteacher =  $_POST["idteacher"];
$performance =  $_POST["performance"];



if ($upd==1)
  {  
     $id=$_REQUEST["id"];
     	 $s="UPDATE performance set dateperformance='$dateperformance', idcontrol='$idcontrol', idstudent='$idstudent', idsubject='$idsubject', idteacher='$idteacher' , performance='$performance' WHERE idperformance=$id";
	 mysqli_query($dbcnx,$s);
  }  else
  {//формирование SQL-запроса на добавление данных
	 mysqli_query($dbcnx, "INSERT INTO performance ( idstudent, idcontrol, dateperformance, idsubject, idteacher, performance) VALUES ('$idstudent', '$idcontrol', '$dateperformance', '$idsubject', '$idteacher', '$performance')");
  }	
  
  ?>
	 <script language="javascript">
 location.href='performanceteacher.php?filter=0';
	 </script>
	 <?
}

	 $upd=$_REQUEST["upd"];

	 if ($upd==1)
		{
	 $Arr=$_REQUEST["arrperformance"];
	 $idperformance=$Arr[0];
	 $r=mysqli_query($dbcnx, "select * from performance where idperformance=$idperformance");
	 $f=mysqli_fetch_array($r);
	 }
     ?>


<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><? echo $permission;?></title>
	<meta charset="utf-8" content='width=performanceexec-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
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
										<div class="card-title">Редактирование занятия (<? echo $f["idperformance"];?>)</div>
									<?
                                    					}
									?>  
                                         
									</div>
                                    
									<div class="card-body">
				  <table border="0">


                    <tr>
                      <td><font color="#000000" >  Дата оценки: </font> </td>
                      <td><input  class="form-control input-full"   name="dateperformance"  value="<? if ($upd==1) echo $f['dateperformance']; else echo("$date"); ?>"   type="date" ></td>
                    </tr>   
          
            
    
                 
  <tr> 
 <td><font color="#000000" >   Тип успеваемости: </font></td>
        <td ><select class="form-control" name="idcontrol"  style="height:22; width:auto" >
  <?

$d=mysqli_query($dbcnx, "select * from control");
for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
    $m=mysqli_fetch_array($d);
	echo "<option value=".$m["idcontrol"];
	if (($upd==1)&&    ($m["idcontrol"]==$f["idcontrol"]))
	 echo " selected=selected";
	echo ">".$m["control"];
	echo "</option>";	 		
  }

?>
					  
</select></td>
</tr>                            

 <tr> 
 <td><font color="#000000" >   Студент: </font></td>
        <td ><select class="form-control" name="idstudent"  style="height:22; width:auto" >
  <?

$d=mysqli_query($dbcnx, "select * from student");
for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
    $m=mysqli_fetch_array($d);
	echo "<option value=".$m["idstudent"];
	if (($upd==1)&&    ($m["idstudent"]==$f["idstudent"]))
	 echo " selected=selected";
	echo ">".$m["student"];
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


                    <tr>
                      <td><font color="#000000" >  Оценка: </font> </td>
                      <td><input  class="form-control input-full"   name="performance" max="5" min="2"  value="<? if ($upd==1) echo $f['performance']; else echo(""); ?>"   type="number" ></td>
                    </tr>  


                  </table>
<br>
				<input  class="btn btn-success" type="button"  name="button"   onclick="this.form.action='updperformanceteacher.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>'; this.form.submit();"   value="Сохранить" width="500">
				<input   class="btn btn-danger" type="button"  name="button"  onClick="javascript:history.back();"  value="Отмена">
                                    
                                    
                                    	
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