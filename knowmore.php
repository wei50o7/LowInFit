<?php
  session_start();
  if (!isset($_SESSION['customerId']) && isset($_SESSION['userId'])) {

	} else if (isset($_SESSION['customerId']) && isset($_SESSION['userId'])) {
		header("Location: edit.php");
		exit();
  } else {
		header("Location: login.php");
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
				<form class="login100-form validate-form flex-sb flex-w" action="includes/knowmore.php" method="post">
					<span class="login100-form-title p-b-51">
						LET US KNOW MORE
					</span>


			<div class="wrap-input100 validate-input m-b-16">
			<input class="input100" type="text" name="firstName" placeholder="First Name">
			<span class="focus-input100"></span>
			</div>

          <div class="wrap-input100 validate-input m-b-16">
            <input class="input100" type="text" name="lastName" placeholder="Last Name">
            <span class="focus-input100"></span>
          </div>

		  	<select id="levelOfActivity" name="gender" class="levelOfActivity wrap-input100">
        	 <option value='Select Your Gender' disabled selected class=''>Select your Gender</option>
        	<option value="Male">Male</option>
			<option value="Female">Female</option>
          	</select>

			<div class="wrap-input100 validate-input m-b-16">
        	<input class="input100" type="int" name="age" placeholder="Age">
        	<span class="focus-input100"></span>
       		 </div>

			<div class="wrap-input100 validate-input m-b-16">
            <input class="input100" type="int" name="weight" placeholder="Weight">
            <span class="focus-input100"></span>
          	</div>

          	<div class="wrap-input100 validate-input m-b-16">
            <input class="input100" type="int" name="height" placeholder="Height">
            <span class="focus-input100"></span>
          	</div>

	        <select id="levelOfActivity" name="levelOfActivity" class="levelOfActivity wrap-input100">
            <option value='Select Your Level Of Activity' disabled selected class=''>Select your Level Of Activity</option>
            <option value="Mild">Mild</option>
            <option value="Morderate">Morderate</option>
			<option value="Slightly Active">Slightly Active</option>
			<option value="Active">Active</option>
            <option value="Very Active">Very Active</option>
          	</select>

			<div class="wrap-input100 validate-input m-b-16" id="txtarea" >
			<textarea class="txtarea" type="text" name="address" rows="5" column="9" placeholder="Address"></textarea>
			<span class="focus-textarea focus-input100"></span>
			</div>

			<div class="wrap-input100 validate-input m-b-16">
            <input class="input100" type="tel" name="phoneNumber" placeholder="Phone Number">
            <span class="focus-input100"></span>
          	</div>

			<div class="container-login100-form-btn m-t-17">
			<button class="login100-form-btn" name="knowmore-submit">
			Submit
			</button>
			</div>


				</form>
				<div class="container-login100-form-btn m-t-17">
					<button class="login100-form-btn">
						<a class="login100-form-btn" href="index.php">Ask Me later</a>
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
