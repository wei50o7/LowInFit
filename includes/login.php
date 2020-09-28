<?php
include 'dbh.php';
  if (isset($_POST['login-submit'])) {

    $usernameOrEmail = mysqli_real_escape_string($conn, $_POST['usernameOrEmail']);
    $password = mysqli_real_escape_string($conn, $_POST['login_pass']);
    // $password = password_hash($password, PASSWORD_DEFAULT);

    if(empty($usernameOrEmail) || empty($password)) {
      header("Location:../login.php?error=emptyfields");
      exit();
    }

    $sql1 = 'SELECT * FROM useraccount WHERE (Username = ? AND Active=1) or (Email=? AND Active=1)';
    $sql2 = 'SELECT * FROM customer JOIN useraccount ON useraccount.UserID = customer.UserID WHERE useraccount.Username = ? OR useraccount.Email=?';
    $sql3 = 'SELECT * FROM staff JOIN useraccount ON useraccount.UserID = staff.UserID WHERE useraccount.Username = ?';
    $stmt = mysqli_stmt_init($conn);

    if(empty($usernameOrEmail) || empty($password)) {
      header("Location:../login.php?error=emptyfields");
      exit();
    }
    else {
      if (!mysqli_stmt_prepare($stmt, $sql1)) {
        header("Location:../login.php?error=sqlerror");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "ss", $usernameOrEmail,$usernameOrEmail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
          $pwdCheck = password_verify($password, $row['Password']);


          if ($pwdCheck == false) {
            header("Location:../login.php?error=wrongpassword&username=".$usernameOrEmail);
            exit();
          }

          elseif ($pwdCheck == true) {
            session_start();

            if ($row['RoleID'] == '1') {
              // admin

              $_SESSION['userId'] = $row['UserID'];
              $_SESSION['userName'] = $row['Username'];
              $_SESSION['email'] = $row['Email'];
              $_SESSION['roleId'] = $row['RoleID'];
              if (!mysqli_stmt_prepare($stmt, $sql3)) {
                header('Location: ../login.php?error=sql');
                exit();
              }
              else {
                mysqli_stmt_bind_param($stmt, 's', $username);
                mysqli_stmt_execute($stmt);
                $result2 = mysqli_stmt_get_result($stmt);
                $row2 = mysqli_fetch_assoc($result2);

                $_SESSION['staffID'] = $row2['StaffID'];
                $_SESSION['staffFirst'] = $row2['StaffFName'];
                $_SESSION['StaffLast'] = $row2['StaffLName'];
                header('Location: ../admin/manageorder.php');
              }
            }

            elseif ($row['RoleID'] == '2') {
              //staff
              $_SESSION['userId'] = $row['UserID'];
              $_SESSION['userName'] = $row['Username'];
              $_SESSION['email'] = $row['Email'];
              $_SESSION['roleId'] = $row['RoleID'];
              if (!mysqli_stmt_prepare($stmt, $sql3)) {
                header('Location: ../login.php?error=sql');
                exit();
              }
              else {
                mysqli_stmt_bind_param($stmt, 's', $username);
                mysqli_stmt_execute($stmt);
                $result2 = mysqli_stmt_get_result($stmt);
                $row2 = mysqli_fetch_assoc($result2);

                $_SESSION['staffID'] = $row2['StaffID'];
                $_SESSION['staffFirst'] = $row2['StaffFName'];
                $_SESSION['StaffLast'] = $row2['StaffLName'];
                header('Location: ../admin/manageorder.php?');
              }
            }
            elseif ($row['RoleID'] == '3') {
              //customer
              $_SESSION['userId'] = $row['UserID'];
              $_SESSION['userName'] = $row['Username'];
              $_SESSION['email'] = $row['Email'];
              $_SESSION['roleId'] = $row['RoleID'];
              $_SESSION['active'] = 1;

              if (!mysqli_stmt_prepare($stmt, $sql2)) {
                header('Location: ../login.php?error=sql');
                  exit();
                }
              else {
                mysqli_stmt_bind_param($stmt, 'ss', $usernameOrEmail,$usernameOrEmail);
                mysqli_stmt_execute($stmt);
                $result1 = mysqli_stmt_get_result($stmt);
                $row1 = mysqli_fetch_assoc($result1);

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
                $_SESSION['image'] = $row1['CustPicture'];

                if (isset($_POST['remember-me']) && $_POST['remember-me'] == 'checked') {
                  $hash = password_hash($_SESSION['userName'], PASSWORD_DEFAULT);
                  $userid = $row['UserID'];
                  $insertCookie = "UPDATE useraccount SET LoginCookieHash = ? WHERE UserID = ?;";
                  if (!mysqli_stmt_prepare($stmt, $insertCookie)) {
                    header('Location: ../index.php?error=sqlerror');
                    exit();
                  } else {
                    mysqli_stmt_bind_param($stmt, 'ss', $hash, $userid);
                    mysqli_stmt_execute($stmt);
                    print_r($stmt);
                    mysqli_stmt_get_result($stmt);
                    setcookie("usert", password_hash($hash, PASSWORD_DEFAULT), time()+(86400*7), '/');
                    setcookie("user", $row['Username'], time()+(86400*7), '/');

                    header('Location: ../index.php?login=success');
                    exit();
                  }
                }

                header("Location: ../index.php");
                exit();
              }
            }
          }
        }
        else {
          header("Location:../login.php?error=nouser");
          exit();
        }
      }
    }
  }

  else {
    header("Location:../index.php");
    exit();
  }

 ?>
