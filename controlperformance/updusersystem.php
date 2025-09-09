<?
require "option.php";//файл с параметрами подключения к БД
$menugroup=1;
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
if ($permission!="Администратор")
{
?>
<script language="javascript">
alert("Требуется авторизация!");
</script>
<?
exit;
}

$now=(date("Y"))."-".date("m")."-".date("d"); 

$step=$_REQUEST["step"];
if ($step==2)
{
//признак редактирования
$upd=$_REQUEST["upd"];
//считывание данных
$usersystem =  $_POST["usersystem"];
$phone =  $_POST["phone"];
$mail =  $_POST["mail"];
$login =  $_POST["login"];
$parol =  $_POST["parol"];
$permission =  $_POST["permission"];

if ($upd==1)
     $id=$_REQUEST["id"];


$error=0;

//формируем сообщение об ошибке
if ( (trim($login)=="") or (trim($phone)=="") or (trim($usersystem)=="") or (trim($mail)=="") or (trim($parol)=="") ) 
$error=1;

if (trim($usersystem)=="")
$alert=$alert."Введите данные в поле 'ФИО'! <br>";
	
if (trim($mail)=="")
$alert=$alert."Введите данные в поле 'Почта'! <br>";

if (trim($phone)=="")
$alert=$alert."Введите данные в поле 'Телефон'! <br>";

if (trim($login)=="")
$alert=$alert."Введите данные в поле 'Логин'! <br>";

if (trim($parol)=="")
$alert=$alert."Введите данные в поле 'Пароль'! <br>";


if ((strlen ($login)>$shortstring) or (strlen ($usersystem)>$shortstring) or (strlen ($mail)>$shortstring) or (strlen ($parol)>$shortstring) or (strlen ($login)<$requiredstring) or (strlen ($parol)<$requiredstring) ) 
$error=1;




if (strlen ($usersystem)>$shortstring)
$alert=$alert."Введите корректные данные (<$shortstring) в поле 'ФИО'! <br>";

if (strlen ($mail)>$shortstring)
$alert=$alert."Введите корректные данные (<$shortstring) в поле 'Почта'! <br>";

if (strlen ($phone)>$shortstring)
$alert=$alert."Введите корректные данные (<$shortstring) в поле 'Телефон'! <br>";

if ((strlen ($login)>$shortstring) or (strlen ($login)<$requiredstring))
$alert=$alert."Введите корректные данные ($requiredstring-$shortstring) в поле 'Логин'! <br>";

if ((strlen ($parol)>$shortstring) or (strlen ($parol)<$requiredstring))
$alert=$alert."Введите корректные данные ($requiredstring-$shortstring) в поле 'Пароль'! <br>";



if ($error==1)
{
$alert="Ошибка ввода данных!<br>".$alert;

?>
		<script language="javascript">

var text = "<? echo $alert;?>";
text=text.replace(new RegExp("<br>",'g'),"\n");
alert(text);
history.back();
		</script>
<?
exit();
}	
	
//выполнение запроса на редактирование или добавление данных	
if ($upd==1)
  {  
	 mysqli_query($dbcnx,"UPDATE usersystem set login='$login', parol='$parol', permission='$permission', phone='$phone', usersystem='$usersystem', mail='$mail' WHERE idusersystem=$id");
	 ?>
	 <script language="javascript">
	 location.href='usersystem.php?filter=0';
	 </script>
	 <?
  }  else
  {//формирование SQL-запроса на добавление данных
	 mysqli_query($dbcnx,"INSERT INTO usersystem (login, parol, phone, permission, usersystem, mail) VALUES ('$login', '$parol', '$phone', '$permission', '$usersystem', '$mail')");
	?>
	 <script language="javascript">
	 location.href='usersystem.php?filter=0';
	 </script>
	 <?
  }
exit;
}

$date=(date("Y")-40)."-".date("m")."-".date("d"); 

$upd=$_REQUEST["upd"];
if ($upd==1)
{
$Arr=$_REQUEST["Arr"];
//phpinfo(32);
$r=mysqli_query($dbcnx,"select * from usersystem where idusersystem="."$Arr[0]");

$f=mysqli_fetch_array($r);//считывание текующей записи
}
 
?>
	<? require "menu.php"; ?>
<main>
<form name="form2"  method="post"  >

								
									<div>
	 								<? 
									if ($upd==0){ 
									?>
										<div>Добавление пользователя</div>
                                    <?
									}
									else
									{
									?>
										<div>Редактирование пользователя (<? echo $f["usersystem"];?>)</div>
									<?
                                    }
									?>  
                                         
									</div>
                                    
									<div>
								
									
                                    <table  border="0">
                    <tr>
                      <td width="40%"><font   color="#000000" >   ФИО*: </font> </td>
                      <td><input    name="usersystem" size="30"   type="text"  value="<? if ($upd==1) echo $f['usersystem']; else echo(""); ?>"  ></td>
                    </tr>  	                                                                   
                    <tr>
                      <td><font color="#000000" >   Телефон*: </font> </td>
                      <td><input    name="phone" size="30"  type="text"  value="<? if ($upd==1) echo $f['phone']; else echo(""); ?>"  ></td>
                    </tr>  	                                                                                     
                    <tr>
                      <td><font color="#000000" > Почта*: </font> </td>
                      <td><input    name="mail" size="30"  value="<? if ($upd==1) echo $f['mail']; else echo(""); ?>"   type="text" ></td>
                    </tr> 
<tr>
                      <td><font color="#000000" >   Права*: </font></td>
                      <td>
                 <select  name="permission"  style="height:22; width:auto"    >
					<option   value="Администратор"  <?	if (($upd==1)&& ($f['permission']=="Администратор")) echo "selected"; ?> > Администратор </option>	   
			                <option  value="Студент" <?	if (($upd==1)&& ($f['permission']=="Студент")) echo "selected"; ?> >Студент </option>
					<option  value="Преподаватель" <?	if (($upd==1)&& ($f['permission']=="Преподаватель")) echo "selected"; ?> >Преподаватель </option>
					<option  value="Декан" <?	if (($upd==1)&& ($f['permission']=="Декан")) echo "selected"; ?> >Декан </option>
				</select>                    
				      </td> 
                      </tr>                     
                    <tr>
                      <td><font color="#000000" > Логин*: </font> </td>
                      <td><input    name="login" size="30"  value="<? if ($upd==1) echo $f['login']; else echo(""); ?>"   type="text" ></td>
                    </tr>  	                      			  
                    <tr>
                      <td><font color="#000000" >  Пароль*: </font> </td>
                      <td><input    name="parol" size="30" value="<? if ($upd==1) echo $f['parol']; else echo(""); ?>"   type="text" ></td>
                    </tr>      
                  
                                   
                      
                  </table>
<br>
				<input   type="button"   name="button"    onclick="this.form.action='updusersystem.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>'; this.form.submit();"   value="Сохранить" width="500">
				<input   type="button"  name="button"   onClick="javascript:history.back();"  value="Отмена">
                                    
                                    
                                    	
									</div>

      </form>
</main>
</body>
</html>
