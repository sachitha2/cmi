<?php
	session_start();
	if(isset($_SESSION['login']['status'])){
		
	
		if($_SESSION['login']['status'] == 1){
			header("location:../en/admin/html/dashboard.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>CMS login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
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
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/img-01.jpg');">
			<div class="wrap-login100  p-b-30">
				<form class="login100-form validate-form" action="../en/admin/html/logInChecker.php" method="post">
					<div class="login100-form-avatar">
						<img src="images/shop-icon.png" alt="AVATAR">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						CMS
					</span>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>
					<div align="center" style="width: 100%;color: white">
						<?php
							if(isset($_SESSION['login'])){
								if($_SESSION['login']['pass'] == 0){
									echo("Login Error");
								}
							}
						?>
					
					</div>
					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

<!--
					<div class="text-center w-full p-t-25 p-b-230">
						<a href="#" class="txt1">
							Forgot Username / Password?
						</a>
					</div>

					
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>