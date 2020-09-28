<?php
  session_start();
  if (!isset($_SESSION['userId'])) {
    header("Location: index.php");
    exit();
  } else if (isset($_SESSION['userId']) && !isset($_SESSION['customerId'])) {
    header("Location: knowmore.php");
    exit();
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/editprofile.css">
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
    <header>
      <?php
        include "includes/header.php";
      ?>
    </header>
    <div class="bigboss-container">
      <form method="post" enctype="multipart/form-data" action="includes/editprofile.php">
      <div class="whole-container">
        <div class="left-container">
          <div class="top-picture">
            <div class="round-picture" id="changePicture">
              <div class="overlay"></div>
              <h3>Select image to upload</h3>
              <input class="hidden" type="file" name="fileToUpload" id="fileToUpload" onchange="preview_image(event)">
              <input type="hidden" name="editProfilePicture">
              <img id="output_image" src="<?php echo $_SESSION['image']; ?>" alt="">
            </div>
          </div>
          <div class="bottom-font">
            <h2><a href="profile.php">Profile</a></h2>
            <h2>Edit Profile</h2>
            <h2><a href="order.php">Orders</a></h2>
          </div>
        </div>
        <div class="right-container">
          <div class="row1">
            <h2>EDIT PROFILE</h2>
          </div>
            <div class="row2">
              <div class="left-side">First Name:</div>
              <div class="right-side">
                <input type="text" name="editFirstName" class="textb" placeholder="Your First Name" value="<?php echo $_SESSION['customerFirstName'] ?>">
              </div>
            </div>
            <div class="row2">
              <div class="left-side">Last Name:</div>
              <div class="right-side">
                <input type="text" name="editLastName" class="textb" placeholder="Your Last Name" value="<?php echo $_SESSION['customerLastName'] ?>">
              </div>
            </div>
            <div class="row2">
              <div class="left-side">Address:</div>
              <div class="right-side">
                <input type="text" name="editAddress" class="textb" placeholder="Your Address" value="<?php echo $_SESSION['customerAddress'] ?>">
              </div>
            </div>
            <div class="row2">
              <div div class="left-side">Phone:</div>
              <div class="right-side">
                <input type="tel" name="editPhone" class="textb" placeholder="Your Phone" value="<?php echo $_SESSION['customerPhone'] ?>">
              </div>
            </div>
            <div class="submit-btn">
              <input type="submit" class="btn-edit" value="submit" name="submitedit">
            </div>
        </div>
      </div>
      </form>
    </div>

  <?php
    include 'includes/footer.php';
   ?>

  </body>
  <script>
  function preview_image(event) {
    var reader = new FileReader();

    reader.onload = function() {
      var output = document.getElementById('output_image');
      output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
  }

  document.getElementById('changePicture').addEventListener('click', function(){
    document.getElementById('fileToUpload').click();
  })
  </script>
</html>
