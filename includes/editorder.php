<?php
include ("dbh.php");
$sql = "UPDATE orderfood SET OrderStatus='$_POST[orderstatus]', StaffID='$_POST[staffid]'
WHERE OrderID='$_POST[orderid]'";

if (mysqli_query($conn,$sql) ==1)
{
  echo "<script type='text/javascript'>alert('Edit successfully');</script>";
  die ("<script>window.history.go(-2);</script>");
mysqli_close($conn);
}
else {
  echo "<script type='text/javascript'>alert('ERROR!');</script>";
  echo "<script>window.history.go(-2);</script>";
}
?>
