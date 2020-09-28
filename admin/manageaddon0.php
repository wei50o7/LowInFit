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
            <h1 style="color:pink;font-family:"Poppins";font-size:20px">Current Order</h1>
            <div class="searchbar-container">
              <input type="text" name="" value="" class="searchbar">
            </div>
          </div>
          <table class="order-table">
            <thead>
              <tr>
                <th>AddOnMenuID</th>
                <th>AddOn Menu Name</th>
                <th>AddOn Price per 10 grams</th>
                <th>AddOn Calories</th>
                <th>AddOn Carbohydrates</th>
                <th>AddOn Protein</th>
                <th>AddOn Fats</th>
                <th>AddOn Fibre</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <?php
              include ("../includes/dbh.php");
              $result = mysqli_query($conn,"SELECT * from addonmenu ORDER BY AddOnMenuID ASC");
              while($row = mysqli_fetch_array($result))
              {
                echo "<tbody><tr>";
                echo "<td>";
                echo $row['AddOnMenuID'];
                echo "</td>";
                echo "<td>";
                echo $row['AddOnMenuName'];
                echo "</td>";
                echo "<td>";
                echo $row['AddOnPricePer10g'];
                echo "</td>";
                echo "<td>";
                echo $row['AddOnCalories'];
                echo "</td>";
                echo "<td>";
                echo $row['AddOnCarbohydrates'];
                echo "</td>";
                echo "<td>";
                echo $row['AddOnProtein'];
                echo "</td>";
                echo "<td>";
                echo $row['AddOnFats'];
                echo "</td>";
                echo "<td>";
                echo $row['AddOnFibre'];
                echo "</td>";
                echo "<td><a href=\"editaddon.php?addonid=";
                echo $row['AddOnMenuID'];
                echo "\">Edit</a></td>";
                echo "<td><a href=\"deleteaddon.php?addonid=";
                echo $row['AddOnMenuID'];
                echo "\" onClick=\"return confirm('Delete AddOnMenuID=";
                echo $row['AddOnMenuID'];
                echo "?');\">Delete</a></td></tr></tbody>";
              }
              echo "<tr>";
              echo "<td><a href=\"addaddon.php";
              echo "\">Add New AddOn</a></td></tr>";

              ?>
          </thead>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
