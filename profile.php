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
    <link rel="stylesheet" href="css/profile.css">
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
<!--====================================HEADER======================================================================================= -->
    <?php
      include 'includes/header.php';
     ?>
     <?php
       include 'includes/dbh.php';

       $uid = $_SESSION['userId'];
       $getCustomerInfo = 'SELECT * FROM customer WHERE UserID = ?';
       $getUserEmail = "SELECT Email FROM customer JOIN useraccount ON customer.UserID=useraccount.UserID WHERE customer.UserID = ?;";
       $stmtCustomerInfo = mysqli_stmt_init($conn);
       $stmtUserEmail = mysqli_stmt_init($conn);

       if (!mysqli_stmt_prepare($stmtCustomerInfo, $getCustomerInfo)) {
         echo 'fail';
         exit();
       } else {
         mysqli_stmt_bind_param($stmtCustomerInfo, "s", $uid);
         mysqli_stmt_execute($stmtCustomerInfo);
         $result = mysqli_stmt_get_result($stmtCustomerInfo);
         $row = mysqli_fetch_array($result);

         $firstname = $row['FirstName'];
         $lastname = $row['LastName'];
         $address = $row['Address'];
         $phone = $row['Phone'];
         $picture = $row['CustPicture'];
         $tdee = $row['TDEE'];
         $_SESSION['image'] = $picture;
       }

       if (!mysqli_stmt_prepare($stmtUserEmail, $getUserEmail)) {
         echo 'fail';
         exit();
       } else {
         mysqli_stmt_bind_param($stmtUserEmail, "s", $uid);
         mysqli_stmt_execute($stmtUserEmail);
         $result = mysqli_stmt_get_result($stmtUserEmail);
         $row = mysqli_fetch_array($result);

         $email = $row['Email'];
       }
      ?>
<!--================================MAIN CONTENT================================================================================= -->
    <div class="bigboss-container">
      <div class="whole-container">
        <div class="left-container">
          <div class="top-picture">
            <div class="round-picture">
              <img src="<?php echo $picture; ?>" alt="profile picture">
            </div>
          </div>
          <div class="bottom-font">
            <h2>Profile</h2>
            <h2><a href="edit.php">Edit Profile</a></h2>
            <h2><a href="order.php">Orders</a></h2>
          </div>
        </div>
        <div class="right-container">
          <div class="row1">
            <h2>Profile</h2>
          </div>
          <div class="row2">
            <div class="left-side">Name:</div>
            <div class="right-side"><?php echo $firstname.' '.$lastname; ?></div>
          </div>
          <div class="row2">
            <div class="left-side">Email:</div>
            <div class="right-side"><?php echo $email; ?></div>
          </div>
          <div class="row2">
            <div class="left-side">Address:</div>
            <div class="right-side"><?php echo $address; ?></div>
          </div>
          <div class="row2">
            <div div class="left-side">Phone:</div>
            <div class="right-side"><?php echo $phone; ?></div>
          </div>
          <div class="row2">
            <div div class="left-side">Daily Maintenance Calories:</div>
            <div class="right-side"><?php echo $tdee ?></div>
          </div>
          <div class="row2">
            <div div class="left-side">Recommended Calories:</div>
            <div class="right-side"><?php echo $tdee - 200 ?> for Weight Loss<br><?php echo $tdee + 200 ?> for Weight Gain</div>
          </div>
        </div>
      </div>
    </div>


  <?php
    include 'includes/footer.php';
   ?>

 </body>
</html>
