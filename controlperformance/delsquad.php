<?
require "option.php";
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
$Arr=$_POST['arrsquad'];
$id=$Arr[0];
mysqli_query($dbcnx,"DELETE FROM squad  WHERE idsquad=$id");
?>
 <script language="javascript">
 location.href='squad.php';
 </script>
