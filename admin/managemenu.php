<?php
  session_start();
  if (!isset($_SESSION['roleId']) || !in_array($_SESSION['roleId'], array(1,2), true)) {
    header("Location: ../index.php");
    exit();
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>LowInFit ADMIN</title>
    <link rel="stylesheet" href="../css/leftnavbar.css">
    <link rel="stylesheet" href="../css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    <header>
      <?php
        include "../includes/header.php";
       ?>
    </header>
    <div class="container-wrapper">
      <?php
        include '../includes/staffheader.php';
      ?>
      <div class="table-wrapper">
        <div class="table-container">
          <div class="table-h1">
            <h1 style="color:#e83f77;font-family:"Poppins";font-size:20px">Menu List</h1>
          </div>
          <table class="order-table">
            <thead>
              <tr>
                <th>MealID</th>
                <th>MealName</th>
                <th>Meal Desc</th>
                <th>Meal Price per unit</th>
                <th>Meal Cals</th>
                <th>Meal Carbs</th>
                <th>Meal Protein</th>
                <th>Meal Fats</th>
                <th>Meal Fibre</th>
                <th>Meal Picture</th>
                <th>Meal Category</th>
                <th> </th>
                <th> </th>
              </tr>
              <?php
                include ("../includes/dbh.php");
                $result = mysqli_query($conn,"SELECT meal.*, mealcategory.CategoryName from meal JOIN mealcategory on mealcategory.CategoryID=meal.CategoryID ORDER BY meal.MealID ASC");
                //$result2 = mysqli_query($conn,"SELECT CategoryName from mealcategory JOIN meal ON meal.CategoryID=mealcategory.CategoryID");//show categoryname
                while($row = mysqli_fetch_array($result))
                {
                  echo "<tbody><tr>";
                  echo "<td>";
                  echo $row['MealID'];
                  echo "</td>";
                  echo "<td>";
                  echo $row['MealName'];
                  echo "</td>";
                  echo "<td>";
                  echo $row['MealDesc'];
                  echo "</td>";
                  echo "<td>";
                  echo $row['MealPricePerUnit'];
                  echo "</td>";
                  echo "<td>";
                  echo $row['MealCalories'];
                  echo "</td>";
                  echo "<td>";
                  echo $row['MealCarbohydrates'];
                  echo "</td>";
                  echo "<td>";
                  echo $row['MealProtein'];
                  echo "</td>";
                  echo "<td>";
                  echo $row['MealFats'];
                  echo "</td>";
                  echo "<td>";
                  echo $row['MealFibre'];
                  echo "</td>";
                  echo "<td class='mealpicture'>";
                  echo $row['MealPicture'];
                  echo "</td>";
                  echo "<td>";
                  echo $row['CategoryName'];
                  echo "</td>";
                  echo "<td><a href=\"editmenu.php?mealid=";
                  echo $row['MealID'];
                  echo "\">Edit</a></td>";
                  echo "<td><a href=\"../includes/deletemenu.php?mealid=";
                  echo $row['MealID'];
                  echo "\" onClick=\"return confirm('Delete details for MealID=";
                  echo $row['MealID'];
                  echo "?');\">Delete</a></td></tr></tbody>";

                }
                echo "<tr>";
                echo "<td><a href=\"addmenu.php";
                echo "\">Add New Menu</a></td></tr>";
                ?>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
