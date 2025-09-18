<?
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


$filter=$_GET["filter"];//считывание параметра фильтра
$value1 = $_POST['FilterValue1'];//значение первого поля
$sort=$_GET["sort"];//считывание параметра фильтра		
//выполнение запроса на выборку данных
$s="SELECT subject.* FROM subject ";

if (($value1!="") and ($filter==1))/*есть ли фильтрация данных*/
{
$s=$s." WHERE UPPER(subject)" ;
if ($value1!="Все")
$s=$s." LIKE UPPER('%$value1"."%')  ";
else
$s=$s."=UPPER(subject) ";

}

		 


if ($sort==1)/*есть ли сортировка данных*/
{
$fieldsort = $_POST['sortname'];//первое поле
$s=$s." order by $fieldsort";
}

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
										<div class="card-title">Перечень предметов</div>
                                        <div align="right">	
Сортировка:
				<select name="sortname"  style="height:22; width:auto" onChange="this.form.action='subject.php?sort=1&filter=<? echo $filter;?>'; this.form.submit();" >
				  <option value="subject"  <? if ($fieldsort=="subject") {?> selected="selected" <? }?>>Предмет </option>



                </select>            	
&nbsp;&nbsp;Предмет: 
                
				<input   name="FilterValue1"  onFocus="if (this.value=='Все') this.value=''"  value="<? if ($filter==1)/*есть ли фильтрация данных*/ echo "$value1"; else echo(""); ?>" onBlur="checkFilterValue1()"  type="text">


				<br>
				<input  type="button"  name="button1"  onclick="this.form.action='subject.php?filter=1&sort=<? echo $sort;?>'; this.form.submit();"   value="Фильтр">
				<input  type="button"  name="button2"  onclick="this.form.action='subject.php?filter=0&sort=<? echo $sort;?>'; this.form.submit();"   value="Очистить">
                
           <br>
             </div>  
 <div align="left">
<input   type="button"  class="btn btn-success"  name="button4"    onclick="this.form.action='updsubject.php?upd=0&step=1'; this.form.submit();" value="Добавить">
<input   type="button"  class="btn btn-success"  name="button"  <? if (mysqli_num_rows($r)==0) {?>    disabled="disabled"<? }?>  onclick="this.form.action='updsubject.php?upd=1&step=1'; this.form.submit();" value="Редактировать">   
<input   type="button"  class="btn btn-danger"  name="button"  <? if (mysqli_num_rows($r)==0) {?>    disabled="disabled"<? }?>  onclick="qwest=window.confirm('Вы дествительно хотите удалить запись?');  if (qwest) {this.form.action='delsubject.php'; this.form.submit();}" value="Удалить">      
   </div>            
           
									</div>
                                    
									<div class="card-body">
										<table class="table table-head-bg-success" >
											<thead>
												<tr>
													<th scope="col">#</th>
                                                    <th scope="col">Предмет</th>                                                 										

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
				<input class="form-radio-input" type="radio" name="Arr[]" value=<? echo $f["idsubject"];?>  <? if ($i==0) echo "checked=checked";?>>
				<span class="form-radio-sign"></span>
                </label>
                </td>
                                                <?
		
				echo "
				<td> $f[subject]</td>																	

																			
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