<?
require "option.php";//файл с показателями подключения к БД
$menugroup=5;

$upd=$_REQUEST["upd"];

$step=$_REQUEST["step"];
if ($step==2)
{
//признак редактирования
$upd=$_REQUEST["upd"];

if ($upd==1)
     $idattendance=$_REQUEST["id"];

//считывание данных
$cause = "";
$attendance =  $_POST["attendance"];




//выполнение запроса на редактирование или добавление данных	
if ($upd==1)
  {  
	 mysqli_query($dbcnx,"UPDATE attendance set cause='$cause', attendance='$attendance'  WHERE idattendance=$idattendance");
	 ?>
	 <script language="javascript">
	 location.href='attendanceperformance.php?filter=0';
	 </script>
	 <?
  }  



exit;
}


 


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
$upd=$_REQUEST["upd"];
if ($upd==1)
{
$Arr=$_POST['arrattendance'];
$idattendance=$Arr[0];
//выполнение запроса на выборку данных
$r=mysqli_query($dbcnx,"select * from attendance where idattendance=$idattendance");
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
										<div class="card-title">Добавление посещаемости занятия №<? echo $idstudy;?></div>      
                                    <?
									}
									else
									{
									?>
										<div class="card-title">Редактирование посещаемости занятия №<? echo $idstudy;?></div>      
									<?
                                    }
									?>  
                                   
									</div>
									<div class="card-body">



                                    <table width="40%" border="0">


 <tr>
                      <td><font color="#000000" >   Посещаемость: </font></td>
                      <td>
                 <select class="form-control"  name="attendance"  style="height:22; width:auto"    >
					<option  value="Присутствовал" <?	if (($upd==1)&& ($f['attendance']=="Присутствовал")) echo "selected"; ?> >Присутствовал </option>
					<option  value="Отсутствовал" <?	if (($upd==1)&& ($f['attendance']=="Отсутствовал")) echo "selected"; ?> >Отсутствовал </option>
				</select>                    
				      </td> 
                      </tr>               
               
		  	                                                                                     


                                      </table>
                  
                  
<br>
				<input class="btn btn-success"   type="button"   name="button"    onclick="this.form.action='updattendanceperformance.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>';  this.form.submit();"   value="Сохранить" width="500">
				<input class="btn btn-danger"   type="button"  name="button"   onClick="this.form.action='attendanceperformance.php'; this.form.submit();"  value="Отмена">
                                    
                                    
                                    	
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

</body>















</html>
