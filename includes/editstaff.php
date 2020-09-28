<?php
include ("dbh.php");
$sql = "UPDATE staff SET StaffFName='$_POST[stafffname]', StaffLName='$_POST[stafflname]'
WHERE StaffID='$_POST[staffid]'";

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
