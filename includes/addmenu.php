<?php

if (isset($_POST['btnAddMenu'])) {
  include ("dbh.php");

  $MealName = $_POST['mealname'];
  $MealDesc = $_POST['mealdesc'];
  $MealPricePerUnit = $_POST['mealpriceperunit'];
  $MealCalories = $_POST['mealcalories'];
  $MealCarbohydrates = $_POST['mealcarbohydrates'];
  $MealProtein = $_POST['mealprotein'];
  $MealFats = $_POST['mealfats'];
  $MealFibre = $_POST['mealfibre'];
  $MealCategory = $_POST['mealcategory'];

  $target_dir = "../img/";
  $target_dir1 = "img/";
  $target_file1 = $target_dir1 . basename($_FILES["mealpicture"]["name"]);
  $target_file = $target_dir . basename($_FILES["mealpicture"]["name"]);
  move_uploaded_file($_FILES["mealpicture"]["tmp_name"], $target_file);

  $result = mysqli_query($conn, "INSERT INTO meal(MealName,MealDesc,MealPricePerUnit,MealCalories,MealCarbohydrates,MealProtein,MealFats,MealFibre,MealPicture,CategoryID) VALUES ('$MealName','$MealDesc',$MealPricePerUnit,$MealCalories,$MealCarbohydrates,$MealProtein,$MealFats,$MealFibre,'$target_file1',$MealCategory)");
  if ($result) {
    echo "<script type='text/javascript'>alert('Success!');</script>";
    echo "<script>window.history.go(-2);</script>";
  } else {
      echo "<script type='text/javascript'>alert('ERROR!');</script>";
      echo "<script>window.history.go(-2);</script>";
  }
}
?>
