	<?
require "option.php";
//считывание идентификатора
$Arr=$_POST['Arr'];
$id=$Arr[0];

//выполнение запроса на удаление данных
mysqli_query($dbcnx,"DELETE FROM subject  WHERE idsubject=$id");

?>
 <script language="javascript">
 location.href='subject.php';
 </script>
