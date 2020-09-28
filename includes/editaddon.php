<?php
include ("dbh.php");
$sql = "UPDATE addonmenu SET AddOnMenuName='$_POST[addonmenuname]', AddOnPricePer10g='$_POST[addonpriceper10g]', AddOnCalories='$_POST[addoncalories]', AddOnCarbohydrates='$_POST[addoncarbohydrates]', AddOnProtein='$_POST[addonprotein]', AddOnFats='$_POST[addonfats]',  AddOnFibre='$_POST[addonfibre]'
WHERE AddOnMenuID='$_POST[addonmenuid]'";

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
