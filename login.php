<?php
  include 'includes/dbh.php';
  session_start();
  if (isset($_SESSION['userId'])) {
  	header("Location: index.php");
  	exit();
 	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>LowInFit</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================
	<link rel="icon" type="image/png" href="img/icons/favicon.ico"/>-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/loginutil.css">
	<link rel="stylesheet" type="text/css" href="css/loginmain.css">
	<link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
<!--===============================================================================================-->
</head>
<body>

	<?php
		include 'includes/header.php';
	 ?>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-50 p-b-90">
				<form class="login100-form validate-form flex-sb flex-w" action="includes/login.php" method="post">
					<span class="login100-form-title p-b-51">
						Login
					</span>
          <p style="font-weight: bolder; width: 100%; display: flex; justify-content: center"><?php if(isset($_GET['error'])) {
            if ($_GET['error'] == "wrongpassword") {
              echo "Wrong Password!";
            } else if ($_GET['error'] == "nouser") {
              echo "Username doesn't exist!";
            } else if ($_GET['error'] == "emptyfields") {
              echo "Empty Fields!";
            } else if ($_GET['error']) {
              echo "Failed to connect to database";
            }
          } ?></p>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Username is required">
						<input class="input100" type="text" name="usernameOrEmail" placeholder="Username" value="<?php if (isset($_GET['username'])) {
              echo $_GET['username'];
            } ?>">
						<span class="focus-input100"></span>
					</div>


					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" name="login_pass" placeholder="Password">
						<span class="focus-input100"></span>
					</div>


				<div class="flex-sb-m w-full p-t-3 p-b-24">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me" value='checked'>
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn" name="login-submit">
							Log In
						</button>
					</div>

				</form>
				<div class="container-login100-form-btn m-t-17">
					<button class="login100-form-btn">
						<a class="login100-form-btn" href="signup.php">Sign Up</a>
					</button>
				</div>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<?php
		include 'includes/footer.php';
	 ?>

</body>
</html>
