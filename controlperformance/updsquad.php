<?
$upd=0;

require "option.php";//файл с параметрами подключения к БД
$menugroup=3;

if ($permission!="Декан")
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

$datebirth =  $_POST["datebirth"];
$idspec =  $_POST["idspec"];
$squad =  $_POST["squad"];
$department =  $_POST["department"];



  {//формирование SQL-запроса на добавление данных
	 mysqli_query($dbcnx, "INSERT INTO squad ( department, idspec, squad) VALUES ('$department', '$idspec', '$squad')");

  }	
  
  ?>
	 <script language="javascript">
 location.href='squad.php?filter=0';
	 </script>
	 <?
}

     ?>


<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><? echo $permission;?></title>
	<meta charset="utf-8" content='width=squadexec-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
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
										<div>Добавление группы</div>
                                    <?
									}
									else
									{
									?>
										<div>Редактирование группы (<? echo $f["squad"];?>)</div>
									<?
                                    					}
									?>  
                                         
									</div>
                                    
									<div>
				  <table border="0">

          
                        <tr>
                      <td><font color="#000000" >  Группа: </font> </td>
                      <td><input    name="squad"  value="<? echo(""); ?>"   type="text" ></td>
                    </tr>    
             
 <tr> 
 <td><font color="#000000" >   Специальность: </font></td>
        <td ><select name="idspec"  style="height:22; width:auto" >
  <?

$d=mysqli_query($dbcnx, "select * from spec");
for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
    $m=mysqli_fetch_array($d);
	echo "<option value=".$m["idspec"];
	if (($upd==1)&&    ($m["idspec"]==$f["idspec"]))
	 echo " selected=selected";
	echo ">".$m["spec"];
	echo "</option>";	 		
  }

?>
					  
</select></td>
</tr>    
                 
                         
 
                    <tr>
                      <td><font color="#000000" >  Отделение: </font> </td>
                      <td><input    name="department"  value="<? echo(""); ?>"   type="text" ></td>
                    </tr>    
                      
                  </table>
<br>
				<input  type="button"  name="button"   onclick="this.form.action='updsquad.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>'; this.form.submit();"   value="Сохранить" width="500">
				<input   type="button"  name="button"  onClick="javascript:history.back();"  value="Отмена">
                                    
                                    
                                    	
									</div>

      </form>
</main>
</body>
</html>
