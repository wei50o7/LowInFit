<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>NETTUTS > Sign up</title>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
        <?php

		 	require './includes/dbh.php';
            if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
				// Verify data
				$email = mysqli_real_escape_string($conn, $_GET['email']); // Set email variable
				$hash = mysqli_real_escape_string($conn, $_GET['hash']); // Set hash variable
				$sql = "SELECT Email, Hashemail, Active FROM useraccount WHERE Email=? AND Hashemail=? AND active='0'";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
				  header("Location:../signup.php?error=sqlerror");
				  exit();
				}
				else {
					mysqli_stmt_bind_param($stmt, "ss", $email,$hash);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);
					$match = mysqli_stmt_num_rows($stmt);
					if($match > 0){
						// We have a match, activate the account
						$sql = "UPDATE useraccount SET active='1' WHERE Email=? AND Hashemail=? AND Active='0'";
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							header("Location:../signup.php?error=sqlerror");
							exit();
						}
						else {
							mysqli_stmt_bind_param($stmt, "ss", $email,$hash);
							mysqli_stmt_execute($stmt);

              $sql = "SELECT * FROM useraccount WHERE Email='$email';";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);

              session_start();
              $_SESSION['userId'] = $row['UserID'];
              $_SESSION['userName'] = $row['Username'];
              $_SESSION['email'] = $row['Email'];
              $_SESSION['roleId'] = $row['RoleID'];
              $_SESSION['active'] = 1;
							header("Location: http://localhost/lowinfit/knowmore.php?verify=success");
							exit();
							// mysqli_stmt_store_result($stmt);
							// echo '<div class="statusmsg">Your account has been activated, you can now login</div>';
						}
					}else{
						// No match -> invalid url or account has already been activated.
						echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
					}
				}
			}else{
				// Invalid approach-
				echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
			}
        ?>
</body>
</html>
