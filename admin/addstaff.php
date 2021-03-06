<?php
  session_start();
  if (!isset($_SESSION['roleId']) || !in_array($_SESSION['roleId'], array(1,2), true)) {
    header("Location: ../index.php");
    exit();
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
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

    <title>Add New Menu</title>
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
      <form action = '../includes/addstaff.php' method='post'>
        <table style="width: 100%" class="menu-table">
          <thead>
          <tr>
              <td style="width: 156px">StaffUsername:</td>
              <td><input name="staffuname" type="text" required></td>
            </tr>
            <tr>
                <td style="width: 156px">StaffPassword:</td>
                <td><input name="staffpassword" type="password" required></td>
              </tr>
              <tr>
                  <td style="width: 156px">StaffEmail:</td>
                  <td><input name="staffemail" type="email" required></td>
                </tr>
        <tr>
            <td style="width: 156px">StaffFirstName:</td>
            <td><input name="stafffname" type="text" required></td>
          </tr>
          <tr>
            <td style="width: 156px">StaffLastName</td>
            <td><input name="stafflname" type="text" required ></td>
          </tr>
          <tr>
            <td><input name="btnAddStaff" type="submit" value="Submit"><br></td>
            <td><input type="button" value="Back" onclick="history.back()"></td>
          </tr>
        </thead>
        </table>
        </form>;
  </body>
</html>
