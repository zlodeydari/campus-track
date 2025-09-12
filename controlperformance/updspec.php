<?
require "option.php";//файл с параметрами подключения к БД
$menugroup=2;
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
$upd=$_REQUEST["upd"];

//считывание данных
$spec =  $_POST["spec"];




if ($upd==1)
     $id=$_REQUEST["id"];

$error=0;

//формируем сообщение об ошибке
if ( (trim($spec)=="")  )
$error=1;

if (trim($spec)=="")
$alert=$alert."Введите данные в поле 'Специальность'! <br>";



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
	 mysqli_query($dbcnx,"UPDATE spec set spec='$spec' WHERE idspec=$id");
	 ?>
	 <script language="javascript">
	 location.href='spec.php?filter=0';
	 </script>
	 <?
  }  else
  {//формирование SQL-запроса на добавление данных
	 mysqli_query($dbcnx,"INSERT INTO spec (spec) VALUES ('$spec')");
	?>
	 <script language="javascript">
	 location.href='spec.php?filter=0';
	 </script>
	 <?
  }
exit;
}


$upd=$_REQUEST["upd"];
if ($upd==1)
{
$Arr=$_REQUEST["Arr"];

$r=mysqli_query($dbcnx,"select * from spec where idspec="."$Arr[0]");
$f=mysqli_fetch_array($r);//считывание текующей записи

}
 
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
	 								<? 
									if ($upd==0){ 
									?>
										<div class="card-title">Добавление специальности</div>
                                    <?
									}
									else
									{
									?>
										<div class="card-title">Редактирование специальности (<? echo $f["spec"];?>)</div>
									<?
                                    }
									?>  
                                         
									</div>
                                    
									<div class="card-body">
								
									
                                    <table  border="0">
                    <tr>
                      <td width="25%"><font   color="#000000" >   Специальность*: </font> </td>
                      <td><input class="form-control input-full"    name="spec" size="55"   type="text"  value="<? if ($upd==1) echo htmlentities($f['spec']); else echo(""); ?>"  ></td>
                    </tr>  	   
                                                                               


              
                                   
                      
                  </table>
<br>
				<input class="btn btn-success"   type="button"   name="button"    onclick="this.form.action='updspec.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>'; this.form.submit();"   value="Сохранить" width="500">
				<input class="btn btn-danger"   type="button"  name="button"   onClick="javascript:history.back();"  value="Отмена">
                                    
                                    
                                    	
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

<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
</body>














</html>