<?
require "option.php";
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
$Arr=$_POST['arrstudy'];
$id=$Arr[0];
mysqli_query($dbcnx,"DELETE FROM study  WHERE idstudy=$id");
?>
 <script language="javascript">
 location.href='studyteacher.php';
 </script>
