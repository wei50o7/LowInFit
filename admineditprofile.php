<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="css/admineditprofile.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/leftnavbar.css">
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

  <?php
    include 'includes/header.php';
   ?>

   <div class="main-wrapper">
     <?php
    include 'includes/staffheader.php';
    ?>
  <div class="container-wrapper">
    <div class="whole-container">
      <div class="left-container">
        <div class="top-picture">
          <img src="img/gary.jfif" alt="">
        </div>
        <div class="bottom-font">
          <h2><a href="adminviewprofile.php">Profile</a></h2>
          <h2>Edit Profile</h2>
        </div>
      </div>
      <div class="right-container">
        <div class="row1">
          <h2>Profile</h2>
        </div>
        <div class="row2-container">
        <div class="row2">
        <div class="left-side">Name:</div>
        <div class="right-side"><input type="text" name="" value="Jetwdadwadawdwaawdadaawdwd Jun"></div>
      </div>
      <div class="row2">
        <div class="left-side">Email:</div>
        <div class="right-side"><input type="text" name="" value="a@gmail.com"></div>
      </div>
      <div class="row2">
        <div class="left-side">Address:</div>
        <div class="right-side"><input type="text" name="" value="a Premium Outlet"></div>
      </div>
      <div class="row2">
        <div div class="left-side">Phone:</div>
        <div class="right-side"><input type="text" name="" value="696969696969"></div>
      </div>
      </div>
    </div>
  </div>
  </div>
   </div>


  </body>
</html>
