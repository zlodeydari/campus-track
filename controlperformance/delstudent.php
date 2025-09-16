<?
require "option.php";
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
$Arr=$_POST['arrstudent'];
$id=$Arr[0];
mysqli_query($dbcnx,"DELETE FROM student  WHERE idstudent=$id");
?>
 <script language="javascript">
 location.href='student.php';
 </script>
