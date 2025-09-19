<?
$upd=0;

require "option.php";//файл с параметрами подключения к БД
$menugroup=7;


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
$upd=0;

$datestudy =  $_POST["datestudy"];
$idsquad =  $_POST["idsquad"];
$idcategory =  $_POST["idcategory"];
$idsubject =  $_POST["idsubject"];
$idteacher =  $_POST["idteacher"];




  {//формирование SQL-запроса на добавление данных
	 mysqli_query($dbcnx, "INSERT INTO study ( idcategory, idsquad, datestudy, idsubject, idteacher) VALUES ('$idcategory', '$idsquad', '$datestudy', '$idsubject', '$idteacher')");
	
  }	
  
  ?>
	 <script language="javascript">
 location.href='studyteacher.php?filter=0';
	 </script>
	 <?
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
     
	<? require "menu.php"; ?>
<main>
<form name="form2"  method="post"  enctype="multipart/form-data" >

								
									<div>
	 								<? 
									if ($upd==0){ 
									?>
										<div>Добавление занятия</div>
                                    <?
									}
									else
									{
									?>
										<div>Редактирование занятия (<? echo $f["idstudy"];?>)</div>
									<?
                                    					}
									?>  
                                         
									</div>
                                    
									<div>
				  <table border="0">


                    <tr>
                      <td><font color="#000000" >  Дата занятий: </font> </td>
                      <td><input    name="datestudy"  value="<? echo("$date"); ?>"   type="date" ></td>
                    </tr>   
          
            
 <tr> 
 <td><font color="#000000" >   Тип занятий: </font></td>
        <td ><select name="idcategory"  style="height:22; width:auto" >
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
        <td ><select name="idsquad"  style="height:22; width:auto" >
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
        <td ><select name="idsubject"  style="height:22; width:auto" >
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
        <td ><select name="idteacher"  style="height:22; width:auto" >
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
				<input  type="button"  name="button"   onclick="this.form.action='updstudyteacher.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>'; this.form.submit();"   value="Сохранить" width="500">
				<input   type="button"  name="button"  onClick="javascript:history.back();"  value="Отмена">
                                    
                                    
                                    	
									</div>

      </form>
</main>
</body>
</html>
