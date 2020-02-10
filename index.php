<?php
	include('web/functions.php');
	if(isset($_POST['logOut'])){
		setcookie("loggedIn",1,time() - 3600);
		redirectPage('index.php',0);
	}
	//Display error message
	if(isset($_GET['ec'])){
		$code = $_GET['ec'];
		echo getErrorMessage($code);
	}
	//check for sessions
	if(isset($_COOKIE['loggedIn'])){
		if($_COOKIE['loggedIn'] == 1){
			//echo '<span style="width:100%;color: white;background-color:green;">Redirecting to das</span>';
			redirectPage('web/web_dashBoard.php',0);
		}
	}else{
		//Check if logged in is pressed
		if(isset($_POST['loginUser'])){
			//clearSesstions();
			if($_POST['userName'] == 'cttmo' && $_POST['userPass'] == 'admin'){
				//session_start();
				setcookie("loggedIn",1);
				setcookie("userId",1);
				//$_SESSION['loggedIn'] = TRUE;
				//$_SESSION['userId'] = 1;
				redirectPage('index.php',1);
			}elseif($_POST['userName'] == 'ltfrb' && $_POST['userPass'] == 'admin'){
				//session_start();
				//$_SESSION['loggedIn'] = TRUE;
				//$_SESSION['userId'] = 2;
				setcookie("loggedIn",1);
				setcookie("userId",2);
				redirectPage('index.php',0);
			}else{
				redirectPage('index.php?ec=1',0);
			}
		}
	}
?>
<html>
	<header>
		<title>DC-Tracker</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--===============================================================================================-->	
		<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
		<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
		<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
		<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
		<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
		<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
		<link rel="stylesheet" type="text/css" href="css/util.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<!--===============================================================================================-->
	</header>

	<body>
		<!--
		<div>
			<form action="" method="post">
				<input type="text" name="userName" id="" placeholder="Username">
				<br>
				<input type="password" name="userPass" id="" placeholder="Password">
				<br>
				<button type="submit" name="loginUser">Login</button>
				<br>
				<a href="">Forgot Password?</a>
			</form>
		</div>-->

		<div class="limiter">

			<div class="container-login100" style="background-image: linear-gradient(to right, #ffe732 , #ffa010);">

			<div id="left" style="background-image: url(loginimg2.png); height: 140px; width: 596px;margin-right: 50px;margin-bottom: 150px;"></div>

				<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
					
					<form class="login100-form validate-form flex-sb flex-w" action="" method="post">		

						<span class="txt1 p-b-11">
							Username
						</span>
						<div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
							<input class="input100" type="text" name="userName">
							<span class="focus-input100"></span>
						</div>
						
						<span class="txt1 p-b-11">
							Password
						</span>
						<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
							<span class="btn-show-pass">
								<i class="fa fa-eye"></i>
							</span>
							<input class="input100" type="password" name="userPass">
							<span class="focus-input100"></span>
						</div>
						
						<!--<div class="flex-sb-m w-full p-b-48">
							<div class="contact100-form-checkbox">
								<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
								<label class="label-checkbox100" for="ckb1">
									Remember me
								</label>
							</div>

							<div>
								<a href="#" class="txt3">
									Forgot Password?
								</a>
							</div>
						</div>-->

						<div class="container-login100-form-btn">
							<button class="login100-form-btn" type="submit" name="loginUser">
								Login
							</button>
						</div>

					</form>
					
				</div>
			</div>
		</div>

		<div id="dropDownSelect1"></div>
	
	<!--===============================================================================================-->

		<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="vendor/animsition/js/animsition.min.js"></script>
		<script src="vendor/bootstrap/js/popper.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/daterangepicker/moment.min.js"></script>
		<script src="vendor/daterangepicker/daterangepicker.js"></script>
		<script src="vendor/countdowntime/countdowntime.js"></script>
		<script src="js/main.js"></script>
	<!--===============================================================================================-->
	</body>
</html>