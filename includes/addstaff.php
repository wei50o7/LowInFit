<?php

if (isset($_POST['btnAddStaff'])) {
  include ("dbh.php");

  $StaffUsername = $_POST['staffuname'];
  $StaffPassword = $_POST['staffpassword'];
  $hashpassword = password_hash($StaffPassword, PASSWORD_DEFAULT);
  $StaffEmail = $_POST['staffemail'];
  $StaffFname = $_POST['stafffname'];
  $StaffLname = $_POST['stafflname'];
  $result1 = mysqli_query($conn, "SELECT UserID FROM useraccount WHERE Username='$StaffUsername'");//test username , no repeated username
  $row = mysqli_fetch_array($result1);

  if ($row > 0) {
    echo "<script type='text/javascript'>alert('Username Exist!');</script>";
    echo "<script>window.history.go(-2);</script>";
  } else {
    $result2 = mysqli_query($conn, "INSERT INTO useraccount (Username, Password, Email, RoleID, Active) VALUES ('$StaffUsername', '$hashpassword', '$StaffEmail', 2, 1)");
    if ($result2) {
       $result3 = mysqli_query($conn, "SELECT UserID FROM useraccount WHERE Username='$StaffUsername'");
       $row2 = mysqli_fetch_assoc($result3);
       $uid = $row2['UserID'];
       if (!empty($row2)) {
         mysqli_query($conn, "INSERT INTO staff(StaffFname,StaffLname,UserID) VALUES ('$StaffFname','$StaffLname','$uid')");
         echo "<script type='text/javascript'>alert('Staff successfully registered!');</script>";
         echo "<script>window.history.go(-2);</script>";
       } else {
         echo "<script type='text/javascript'>alert('No User');</script>";
         echo "<script>window.history.go(-2);</script>";
         exit();
       }
    } else {
      echo "<script type='text/javascript'>alert('Username Exist!');</script>";
      echo "<script>window.history.go(-2);</script>";
    }
  }
}
?>
