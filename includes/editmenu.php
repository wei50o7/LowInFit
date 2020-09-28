<?php
include ("dbh.php");
$sql = "UPDATE meal SET MealName='$_POST[mealname]', MealDesc='$_POST[mealdesc]', MealPricePerUnit='$_POST[mealpriceperunit]', MealCalories='$_POST[mealcalories]', MealCarbohydrates='$_POST[mealcarbohydrates]', MealProtein='$_POST[mealprotein]', MealFats='$_POST[mealfats]',  MealFibre='$_POST[mealfibre]',  MealPicture='$_POST[mealpicture]',  CategoryID='$_POST[mealcategory]'
WHERE MealID='$_POST[mealid]'";

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
