<?
require "option.php";
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
$Arr=$_POST['arrperformance'];
$id=$Arr[0];
mysqli_query($dbcnx,"DELETE FROM performance  WHERE idperformance=$id");
?>
 <script language="javascript">
 location.href='performanceteacher.php';
 </script>
