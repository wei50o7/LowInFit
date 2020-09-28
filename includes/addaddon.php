<?php

if (isset($_POST['btnAddAddOnMenu'])) {
  include ("dbh.php");

  $AddOnMenuName = $_POST['addonmenuname'];
  $AddOnPricePer10g = $_POST['addonpriceper10g'];
  $AddOnCalories = $_POST['addoncalories'];
  $AddOnCarbohydrates = $_POST['addoncarbohydrates'];
  $AddOnProtein = $_POST['addonprotein'];
  $AddOnFats = $_POST['addonfats'];
  $AddOnFibre = $_POST['addonfibre'];

  $result = mysqli_query($conn, "INSERT INTO addonmenu(AddOnMenuName,AddOnPricePer10g,AddOnCalories,AddOnCarbohydrates,AddOnProtein,AddOnFats,AddOnFibre) VALUES ('$AddOnMenuName',$AddOnPricePer10g,$AddOnCalories,$AddOnCarbohydrates,$AddOnProtein,$AddOnFats,$AddOnFibre)");
  if ($result) {
    echo "<script type='text/javascript'>alert('Success!');</script>";
    echo "<script>window.history.go(-2);</script>";
  } else {
    echo "<script type='text/javascript'>alert('ERROR!');</script>";
    echo "<script>window.history.go(-2);</script>";
  }
}
?>
