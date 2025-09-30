<?
require "option.php";//файл с параметрами подключения к БД
$menugroup=8;
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
 


$s="SELECT performance.*, control, teacher, student, subject FROM performance, control, teacher, student, subject where control.idcontrol=performance.idcontrol and performance.idstudent=student.idstudent and performance.idsubject=subject .idsubject and performance.idteacher=teacher.idteacher ";
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
										<div class="card-title">Перечень успеваемости</div>         
     		   


 <div align="left">
 <input  type="button" class="btn btn-success"  name="button4"    onclick="this.form.action='updperformanceteacher.php?upd=0&step=1'; this.form.submit();" value="Добавить">
 <input  type="button" class="btn btn-success"   name="button4" <? if (mysqli_num_rows($r)==0) {?>    disabled="disabled"<? }?>   onclick="this.form.action='updperformanceteacher.php?upd=1&step=1'; this.form.submit();" value="Редактирование"> 
 <input  class="btn btn-danger"  type="button"  name="button" <? if (mysqli_num_rows($r)==0) {?>    disabled="disabled"<? }?>  onclick="qwest=window.confirm('Вы действительно хотите удалить запись?');  if (qwest) {this.form.action='delperformanceteacher.php'; this.form.submit();}" value="Удалить">    


   </div>            
           
									</div>
									<div class="card-body">
										<table class="table table-head-bg-success" >
											<thead>
												<tr>
		<th scope="col">&nbsp;</th>      
		<th scope="col">Студент</th>		 
		<th scope="col">Предмет</th>
  		<th scope="col">Оценка</th> 

                                       			        
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
				<input class="form-radio-input" type="radio" name="arrperformance[]" value=<? echo $f["idperformance"];?>  <? if (($i==0) || ($f["idperformance"]==$idperformance))  echo "checked=checked";?>>
				<span class="form-radio-sign"> <? echo $f["idperformance"];?></span>
                </label>
                </td>			
				<?
				echo "
				<td> ".$f['student']."</td>	
				<td> ".$f['subject']."</td>				
				<td> ".$f['performance']."</td>														
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
				
			</div>
		</div>
	</div>
</div>

</body>














</html>