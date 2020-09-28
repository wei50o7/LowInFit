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
            <h1 style="color:#e83f77;font-family:"Poppins";font-size:20px">Customer List</h1>
          </div>
          <table class="order-table">
            <thead>
              <tr>
                <th>CustID</th>
                <th>Cust First Name</th>
                <th>Cust Last Name</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <?php
              include ("../includes/dbh.php");
              $result = mysqli_query($conn,"SELECT * from customer ORDER BY StaffFName ASC");
              while($row = mysqli_fetch_array($result))
              {
                echo "<tbody><tr>";
                echo "<td>";
                echo $row['StaffID'];
                echo "</td>";
                echo "<td>";
                echo $row['StaffFName'];
                echo "</td>";
                echo "<td>";
                echo $row['StaffLName'];
                echo "</td>";
                echo "<td><a href=\"editstaff.php?staffid=";
                echo $row['StaffID'];
                echo "\">Edit</a></td>";
                echo "<td><a href=\"../includes/deletestaff.php?staffid=";
                echo $row['StaffID'];
                echo "\" onClick=\"return confirm('Delete StaffID=";
                echo $row['StaffID'];
                echo "?');\">Delete</a></td></tr></tbody>";
              }
              echo "<tr>";
              echo "<td><a href=\"addstaff.php";
              echo "\">Add New Staff</a></td></tr>";

              ?>
          </thead>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
