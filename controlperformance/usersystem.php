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


$filter=$_GET["filter"];//считывание параметра фильтра
$value1 = $_POST['FilterValue1'];//значение первого поля
$sort=$_GET["sort"];//считывание параметра фильтра		

$s="SELECT usersystem.* FROM usersystem";

if (($value1!="") and ($filter==1))/*есть ли фильтрация данных*/
{
$s=$s." where UPPER(usersystem)" ;
if ($value1!="Все")
$s=$s." LIKE UPPER('%$value1"."%')  ";
else
$s=$s."=UPPER(usersystem) ";

}

		 


if ($sort==1)/*есть ли сортировка данных*/
{
$fieldsort = $_POST['sortname'];//первое поле
$s=$s." order by $fieldsort";
}

//выполнение хапроса на выборку данных
$r=mysqli_query($dbcnx,$s);
	

?>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="#" class="logo">
					Администратор
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
										<div class="card-title">Перечень пользователей</div>
                                        <div align="right">	
Сортировка:
				<select name="sortname"  style="height:30; width:auto" onChange="this.form.action='usersystem.php?sort=1&filter=<? echo $filter;?>'; this.form.submit();" >
				  <option value="usersystem"  <? if ($fieldsort=="usersystem") {?> selected="selected" <? }?>>ФИО </option>
                  <option value="phone"  <? if ($fieldsort=="phone") {?> selected="selected" <? }?> >Телефон </option>
                  <option value="mail"  <? if ($fieldsort=="mail") {?> selected="selected" <? }?> >Почта </option>
                  <option value="permission"  <? if ($fieldsort=="permission") {?> selected="selected" <? }?> >Права доступа </option>
                  <option value="login"  <? if ($fieldsort=="ligin") {?> selected="selected" <? }?> >Логин </option>
                  <option value="parol"  <? if ($fieldsort=="parol") {?> selected="selected" <? }?> >Пароль </option>
                </select>            	
&nbsp;&nbsp;ФИО: 
                
				<input   name="FilterValue1"  onFocus="if (this.value=='Все') this.value=''"  value="<? if ($filter==1)/*есть ли фильтрация данных*/ echo "$value1"; else echo(""); ?>" onBlur="checkFilterValue1()"  type="text">


				<br>
				<input  type="button"  name="button1"  onclick="this.form.action='usersystem.php?filter=1&sort=<? echo $sort;?>'; this.form.submit();"   value="Фильтр">
				<input  type="button"  name="button2"  onclick="this.form.action='usersystem.php?filter=0&sort=<? echo $sort;?>'; this.form.submit();"   value="Очистить">
                
           <br>
             </div>  
 <div align="left">
<input   type="button"  class="btn btn-success"  name="button4"    onclick="this.form.action='updusersystem.php?upd=0&step=1'; this.form.submit();" value="Добавить">
<input   type="button"  class="btn btn-success"  name="button"  <? if (mysqli_num_rows($r)==0) {?>    disabled="disabled"<? }?>  onclick="this.form.action='updusersystem.php?upd=1&step=1'; this.form.submit();" value="Редактировать">   
<input   type="button"  class="btn btn-danger"  name="button"  <? if (mysqli_num_rows($r)==0) {?>    disabled="disabled"<? }?>  onclick="qwest=window.confirm('Вы дествительно хотите удалить запись?');  if (qwest) {this.form.action='delusersystem.php'; this.form.submit();}" value="Удалить">      
   </div>            
           
									</div>
                                    
									<div class="card-body">
										<table class="table table-head-bg-success" >
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
                <label class="form-radio-input">
				<input class="form-radio-input" type="radio" name="Arr[]" value=<? echo $f["idusersystem"];?>  <? if ($i==0) echo "checked=checked";?>>
				<span class="form-radio-sign"></span>
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