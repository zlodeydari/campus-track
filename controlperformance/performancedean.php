<?
require "option.php";//файл с параметрами подключения к БД
$menugroup=6;
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
<style>@media(max-width:991px){.sidebar{transform:none!important;position:static!important;width:100%}.sidebar .sidebar-wrapper{width:100%;padding-top:0;max-height:none}.main-panel{width:100%;margin-left:0}}</style>
</head>
<body>
<?
if ($permission!="Декан")
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
	<? require "menu.php"; ?>
<main>
<form name="form2"  method="post"  >

								
									<div>
										<div>Перечень успеваемости</div>         
     		   


 <div align="left">



   </div>            
           
									</div>
									<div>
										<table >
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
                <label>
				<input type="radio" name="arrperformance[]" value=<? echo $f["idperformance"];?>  <? if (($i==0) || ($f["idperformance"]==$idperformance))  echo "checked=checked";?>>
				<span> <? echo $f["idperformance"];?></span>
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
</main>
</body>
</html>
