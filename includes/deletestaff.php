<?php
include ("dbh.php");

$id = intval($_GET['staffid']);
$result = mysqli_query($conn,"DELETE FROM useraccount WHERE UserID = (SELECT UserID FROM staff WHERE StaffID = $id)");

if ($result == 1) {
  echo "<script type='text/javascript'>alert('Deleted successfully');</script>";
  die ("<script>window.history.go(-1);</script>");
}
else {
  //echo "<script type='text/javascript'> alert('This menu still exist in customers' order, cannot be deleted!'); </script>";
  //echo "<script>window.history.go(-1)</script>";
  echo "<script type='text/javascript'>alert('This menu still exist in customers\' order, cannot be deleted!');</script>";
  die ("<script>window.history.go(-1);</script>");
  //echo "<script>window.location.href='../admin/managemenu.php?error=menuexistinorder'</script>";

}
?>
