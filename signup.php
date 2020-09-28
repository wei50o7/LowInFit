<?php
	session_start();
	if (isset($_SESSION['userId']) && $_SESSION['active'] != 0) {
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
				<form class="login100-form validate-form flex-sb flex-w" method="post" action="includes/signup.php">
					<span class="login100-form-title p-b-51">
						Sign Up
					</span>
					<?php
						if (isset($_GET['error'])) {
							if ($_GET['error'] == "emptyfields") {
								echo 'There are empty fields';
							} else if($_GET['error'] == "usertaken") {
								echo 'This Username is taken';
							}
							else if($_GET['error'] == "passwordcheck") {
								echo 'Password and Confirm Password not matching.';
							}
						} else if (isset($_GET['verify'])) {
							echo 'Please Verify Ur Account via Email';
						}
				 ?>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="Username" value="<?php
							if (isset($_GET['username'])){
								echo $_GET['username'];
							}
						 ?>">
						<span class="focus-input100"></span>
					</div>


						<div class="wrap-input100 validate-input m-b-16" data-validate = "Email is required">
								<input class="input100" type="text" name="email" placeholder="E-Mail" value="<?php
									if (isset($_GET['email'])){
										echo $_GET['email'];
									}
								 ?>">
							  <span class="focus-input100">
								</span>
						</div>


						<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
										<input class="input100" type="password" name="password" placeholder="Password">
										<span class="focus-input100"></span>
						</div>



					<div class="wrap-input100 validate-input m-b-16" data-validate = "Confirm-Password is required">
						<input class="input100" type="password" name="confirm_password" placeholder="Confirm Password">
						<span class="focus-input100"></span>
					</div>


					<div class="flex-sb-m w-full p-t-3 p-b-24">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="acceptance_rule">
							<label class="label-checkbox100" for="ckb1">
								 I accept the terms and use
							</label>
						</div>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn" name="signup-submit">
							Sign Up
						</button>
					</div>

				</form>
				<div class="container-login100-form-btn m-t-17">
					<button class="login100-form-btn">
						<a class="login100-form-btn" href="index.php">Cancel</a>
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

	<footer>
		<?php
			include 'includes/footer.php';
		 ?>
	</footer>

</body>
</html>
