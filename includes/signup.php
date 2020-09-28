<?php
if (isset($_POST['signup-submit'])) {
  require 'dbh.php';

  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $copassword = mysqli_real_escape_string($conn, $_POST['confirm_password']);
  $role = 3;

  if (empty($username) || empty($email) || empty($password) || empty($copassword)) {
    header("Location:../signup.php?error=emptyfields&username=".$username."&email=".$email);
    exit();
  }
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username)) {
    header("Location:../signup.php?error=invalidemail&username");
    exit();
  }
  else if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
    header("Location:../signup.php?error=invalidusername&email=".$email);
    exit();
  }
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location:../signup.php?error=invalidemail&username=".$username);
    exit();
  }

  else if ($password !== $copassword) {
    header("Location:../signup.php?error=passwordcheck");
    exit();
  }
  else {

    $sql = 'SELECT Username FROM useraccount WHERE Username=?';
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location:../signup.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck>0) {
        header("Location:../signup.php?error=usertaken");
        exit();
      }
      else {
        $sql = 'INSERT INTO useraccount (Username, Email, Password, RoleID,Hashemail,Active)  VALUES (?, ?, ?, ?,?,0)';
        $sql2 = 'INSERT INTO customer (UserID, FirstName, LastName,Gender,Age,Weight,Height,ActivityLevel, Address,Phone)  VALUES (?,?,?,?,?,?,?,?,?,?)';
        $sql3 = 'SELECT * FROM useraccount WHERE Username =?';
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location:../signup.php?error=sqlerror");
          exit();
        }
        else {
          $hasedPwd = password_hash($password, PASSWORD_DEFAULT);
          $hashemail = md5( rand(0,1000) );
          mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $hasedPwd, $role,$hashemail);
          mysqli_stmt_execute($stmt);

          if (!mysqli_stmt_prepare($stmt, $sql3)) {
            header('Location:../signup.php?error=sqlerror');
            exit();
          }
          else {
              mysqli_stmt_bind_param($stmt, "s", $username);
              mysqli_stmt_execute($stmt);
              
          }

          //header("Location:../knowmore.php");
          $msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
          $to      = $email; // Send email to our user
          $subject = 'Verification'; // Give the email a subject
          $message = '
          Thanks for signing up!
          Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
          ------------------------
          Username: '.$username.'
          ------------------------
          Please click this link to activate your account:
          http://localhost/lowinfit/verify.php?email='.$email.'&hash='.$hashemail.''; // Our message above including the link
          // $message = 'hello';
          $headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
          // Please specify your Mail Server - Example: mail.example.com.
          ini_set("SMTP","ssl://smtp.gmail.com");
          ini_set("smtp_port","587");
          mail($to, $subject, $message, $headers); // Send our email

          echo "<script type='text/javascript'>alert('1 More Step To Go!');</script>";
          echo "<script>location.href = '../signup.php?verify'</script>";
          exit();
        }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}

else {
  header("Location:../index.php?error");
  echo "wadwd";
  exit();
}
