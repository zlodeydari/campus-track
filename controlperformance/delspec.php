	<?
require "option.php";
//считывание идентификатора
$Arr=$_POST['Arr'];
$id=$Arr[0];

//выполнение запроса на удаление данных
mysqli_query($dbcnx,"DELETE FROM spec  WHERE idspec=$id");

?>
 <script language="javascript">
 location.href='spec.php';
 </script>
