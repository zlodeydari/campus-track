<?
require "option.php";//файл с параметрами подключения к БД
$menugroup=3;
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><? echo $permission;?></title>
	<meta charset="utf-8" content='width=department-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
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
</script>
<?
exit;
}
 


$s="SELECT squad.*, spec FROM squad INNER JOIN spec ON spec.idspec=squad.idspec where idsquad=idsquad ";
$r=mysqli_query($dbcnx,$s);

	 ?>
	<? require "menu.php"; ?>
<main>
<form name="form2"  method="post"  >

								
									<div>
										<div>Перечень групп</div>         
     		   


 <div align="left">
 <input  type="button"  name="button4"    onclick="this.form.action='updsquad.php?upd=0&step=1'; this.form.submit();" value="Добавить">


   </div>            
           
									</div>
									<div>
										<table >
											<thead>
												<tr>
		<th scope="col">&nbsp;</th>                                   
		<th scope="col">Группа</th>
		<th scope="col">Специальность</th>		 
		<th scope="col">Отделение</th>        

                                       			        
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
				<input type="radio" name="arrsquad[]" value=<? echo $f["idsquad"];?>  <? if (($i==0) || ($f["idsquad"]==$idsquad))  echo "checked=checked";?>>
				<span> <? echo $f["idsquad"];?></span>
                </label>
                </td>			
				<?
				echo "
				<td> ".$f['squad']."</td>		
				<td> ".$f['spec']."</td>																
				<td> ".$f['department']."</td>				
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
