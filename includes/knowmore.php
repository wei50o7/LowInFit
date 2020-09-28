<?php
session_start();

if (isset($_POST['knowmore-submit'])) {

  require 'dbh.php';
  $kUID = $_SESSION['userId'];
  $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
  $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
  $gender = mysqli_real_escape_string($conn, $_POST['gender']);
  $age = mysqli_real_escape_string($conn, $_POST['age']);
  $weight = mysqli_real_escape_string($conn, $_POST['weight']);
  $height = mysqli_real_escape_string($conn, $_POST['height']);
  $levelOfActivity = mysqli_real_escape_string($conn, $_POST['levelOfActivity']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
  $custPicture = "img/profpic/default.png";

  if($levelOfActivity == "Mild") {
      $levelOfActivityT = 1.2;
  }
  else if ($levelOfActivity == "Morderate") {
      $levelOfActivityT = 1.3;
  }
  else if ($levelOfActivity == "Slightly Active") {
      $levelOfActivityT = 1.5;
  }
  else if ($levelOfActivity == "Active") {
      $levelOfActivityT = 1.7;
  }
  else if ($levelOfActivity == "Very Active") {
      $levelOfActivityT = 1.9;
  }

  //print_r($levelOfActivityT);

  if ($gender == "Male") {
    $tdee = (((9.9*$weight)+(6.25*$height)-(4.9*$age+5))*$levelOfActivityT);
  } else if ($gender == "Female") {
    $tdee = (((9.9*$weight)+(6.25*$height)-(4.9*$age-161))*$levelOfActivityT);
  }

  if (empty($firstName) || empty($lastName) || empty($phoneNumber) || empty($height) || empty($age) || empty($levelOfActivity) || empty($address) || empty($weight)) {
    header("Location:../knowmore.php?error=emptyfields");
    exit();
  } else {
    $sql = "INSERT INTO customer (UserID, FirstName, LastName, Gender, Age, Weight, Height, ActivityLevel, Address, Phone, CustPicture, TDEE )  VALUES (?,?,?,?,?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:../knowmore.php?error=sqlerror");
      exit();
    } else {

        $a = mysqli_stmt_bind_param($stmt, "isssiiisssss", $kUID, $firstName, $lastName, $gender, $age, $weight, $height,  $levelOfActivityT, $address, $phoneNumber, $custPicture, $tdee);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $sql = "SELECT * FROM customer WHERE UserID = $kUID";
        $result = mysqli_query($conn, $sql);
        $row1 = mysqli_fetch_assoc($result);

        $_SESSION['customerId'] = $row1['CustomerID'];
        $_SESSION['customerFirstName'] = $row1['FirstName'];
        $_SESSION['customerLastName'] = $row1['LastName'];
        $_SESSION['customerGender'] = $row1['Gender'];
        $_SESSION['customerAge'] = $row1['Age'];
        $_SESSION['customerWeight'] = $row1['Weight'];
        $_SESSION['customerHeight'] = $row1['Height'];
        $_SESSION['customerActivitylevel'] = $row1['ActivityLevel'];
        $_SESSION['customerAddress'] = $row1['Address'];
        $_SESSION['customerPhone'] = $row1['Phone'];

        header("Location:../index.php?success");
    }
  }
}

else  {
  header("Location:../index.php");
  exit();
}
