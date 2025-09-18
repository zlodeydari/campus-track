<?
$upd=0;

require "option.php";//файл с параметрами подключения к БД
$menugroup=5;
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
if ($permission!="Декан")
{
?>
<script language="javascript">
alert("Требуется авторизация!");
location.href='index.php';
</script>
<?
exit;
}



$step=$_REQUEST["step"];
if ($step==2)
{
//признак редактирования
$upd=0;

//считывание данных
$subject =  $_POST["subject"];




if ($upd==1)
     $id=$_REQUEST["id"];


//выполнение запроса на редактирование или добавление данных	
  {//формирование SQL-запроса на добавление данных
	 mysqli_query($dbcnx,"INSERT INTO subject (subject) VALUES ('$subject')");
	?>
	 <script language="javascript">
	 location.href='subject.php?filter=0';
	 </script>
	 <?
  }
exit;
}


 
?>
	<? require "menu.php"; ?>
<main>
<form name="form2"  method="post"  >

								
									<div>
	 								<? 
									if ($upd==0){ 
									?>
										<div>Добавление предмета</div>
                                    <?
									}
									else
									{
									?>
										<div>Редактирование предмета (<? echo $f["subject"];?>)</div>
									<?
                                    }
									?>  
                                         
									</div>
                                    
									<div>
								
									
                                    <table  border="0">
                    <tr>
                      <td width="25%"><font   color="#000000" >   Предмет*: </font> </td>
                      <td><input    name="subject" size="55"   type="text"  value="<? echo(""); ?>"  ></td>
                    </tr>  	   
                                                                               


              
                                   
                      
                  </table>
<br>
				<input   type="button"   name="button"    onclick="this.form.action='updsubject.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>'; this.form.submit();"   value="Сохранить" width="500">
				<input   type="button"  name="button"   onClick="javascript:history.back();"  value="Отмена">
                                    
                                    
                                    	
									</div>

      </form>
</main>
</body>
</html>
