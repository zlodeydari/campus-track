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


$s="SELECT usersystem.* FROM usersystem";
$r=mysqli_query($dbcnx,$s);
	

?>
	<? require "menu.php"; ?>
<main>
<form name="form2"  method="post"  >

								
									<div>
										<div>Перечень пользователей</div>
                                          
 <div align="left">
<input   type="button"   name="button4"    onclick="this.form.action='updusersystem.php?upd=0&step=1'; this.form.submit();" value="Добавить">
   </div>            
           
									</div>
                                    
									<div>
										<table >
											<thead>
												<tr>
													<th scope="col">#</th>
                                                    <th scope="col">ФИО</th> 
                                                    <th scope="col">Телефон</th>
                                                    <th scope="col">Почта</th>
                                                    <th scope="col">Права доступа</th>
                                                    <th scope="col">Логин</th>                         
                                                    <th scope="col">Пароль</th>    
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
				<input type="radio" name="Arr[]" value=<? echo $f["idusersystem"];?>  <? if ($i==0) echo "checked=checked";?>>
				<span></span>
                </label>
                </td>
                                                <?
		
				echo "
				<td> $f[usersystem]</td>																			
				<td> $f[phone]</td>	
				<td> $f[mail]</td>			
				<td> $f[permission]</td>											
				<td> $f[login]</td>		
				<td> $f[parol]</td>													
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
