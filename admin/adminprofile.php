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
    <link rel="stylesheet" href="../css/adminprofile.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/leftnavbar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>
<!-- ================================HEADER================================================================================== -->
    <?php
      include '../includes/header.php';
     ?>
<!-- ==========================MAIN CONTENT================================================================================== -->
    <div class="container-wrapper">
      <?php
    include '../includes/staffheader.php';
    ?>

    <div class="bigboss-container">
      <div class="whole-container">
        <div class="left-container">
          <div class="top-picture">
            <div class="round-picture">
              <img src="../img/salmon.jpg" alt="">
            </div>
          </div>
          <div class="bottom-font">
            <h2>Profile</h2>
            <h2><a href="editprofile.php">Edit Profile</a></h2>
          </div>
        </div>
        <div class="right-container">
          <div class="row1">
            <h2>Profile</h2>
          </div>
          <div class="row2">
            <div class="left-side">Name:</div>
            <div class="right-side">Jet Jun</div>
          </div>
          <div class="row2">
            <div class="left-side">Email:</div>
            <div class="right-side">a@gmail.com</div>
          </div>
          <div class="row2">
            <div class="left-side">Address:</div>
            <div class="right-side">a Premium Outlet</div>
          </div>
          <div class="row2">
            <div div class="left-side">Phone:</div>
            <div class="right-side">696969696969</div>
          </div>
        </div>
      </div>
    </div>
    </div>


  </body>
</html>
