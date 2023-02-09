<?php include 'header.php'; ?>

	<title>Login / Register</title>
	<div class = "account-page">
		<div class = "container">
			<div class = "row">
				<div class = "col-2">
						<h1> Welcome to Jess Shoppe!</h1>
						<p>PH GROUP ORDERS OF ALL KPOP GROUPS | 
							<br> UPDATES 
							<a href="https://twitter.com/JESSSHOPPE_Q"><b><font color = "#E93DD8">@JESSSHOPPE_Q</font></b></a>
						| PAYMENT ACCOUNT <a href = "https://twitter.com/JESSSHOPPE_P"><b><font color = "#E93DD8">@JESSSHOPPE_P</font></b></a>
						| DTI REGISTERED |</p>
						<a href = "allproducts.php" class = "btn-shop">Shop Now</a>
				</div>
				
				<div class = "col-2">
					<div class = "form-container">
							<div class = "form-btn">
								<span onClick="login()">Login</span>
								<span onClick="register()">Register</span>
								<hr id = "Indicator">
							</div>					
								<!-- For Login -->
								<form id = "LoginForm" action = "includes/login.inc.php" method = "post">
										<input type = "text" name = "uid" placeholder = "Username" required>
										<input type = "password" name = "pwd" placeholder = "Password" required>
									<button type = "submit" class = "btn btn-primary btn-block" name = "submit">Log In</button>
									<a href="forgot_password.php" >Forgot Password</a>
								</form>
								<?php
									if(isset($_GET["error"])){
										 if($_GET["error"] == "wronglogin"){
											echo "<p>Incorrect login information!</p>";
										}	
									}
								?>
								<!-- For Registration -->
								<form id = "RegisterForm" action = "includes/register.inc.php" method = "post"  onsubmit="return checkform(this);">
									<input type = "text"  name = "name" placeholder = "Full Name" required>
									<input type = "text"  name = "email" placeholder = "Email" required>
									<input type = "text"  name = "uid" placeholder = "Username" required>
									<input type = "password"  name = "pwd" placeholder = "Password" required>
									<input type = "password"  name = "pwdrepeat" placeholder = "Repeat Password" required>

									<!-- START CAPTCHA -->
									<br>
									<div class="capbox">

									<div id="CaptchaDiv"></div>

									<div class="capbox-inner">
									Type the number:<br>

									<input type="hidden" id="txtCaptcha">
									<input type="text" name="CaptchaInput" id="CaptchaInput" size="15"><br>

									</div>
									</div>
									<!-- END CAPTCHA -->
									<button type = "submit" class = "btn btn-primary btn-block" name = "submit">Register</button>
								</form>
								<?php
									if(isset($_GET["error"])){
										if($_GET["error"] == "invaliduid"){

											echo "<script> alert('Choose a proper username!')</script>";
										}
										else if($_GET["error"] == "invalidpwd"){
											
											echo "<script> alert('Password must at least be greater than 8 characters.') </script>";
										}
										else if($_GET["error"] == "pwdPattern"){
											
											echo "<script> alert('Password must contain at least 1 uppercase, 1 lowercase letter and 1 numeric value.') </script>";
										}
										else if($_GET["error"] == "invalidemail"){

											echo "<script> alert('Email is already taken!')</script>";
										}
										else if($_GET["error"] == "passwordsdontmatch"){

											echo "<script> alert('Passwords does not match!')</script>";
										}
										else if($_GET["error"] == "stmtfailed"){

											echo "<script> alert('Something went wrong, Try again!')</script>";
										}
										else if($_GET["error"] == "usernametaken"){

											echo "<script> alert('Username already taken!')</script>";
										}
										else if($_GET["error"] == "none"){

											echo "<script> alert('You are now signed up!')</script>";
										}
									}
								?>
						</div>
					</div>	
				</div>
			</div>
		</div>
							
<!-- ending div tag of container from header.php -->
			</div>
<!-- ending div tag of header from header.php -->
		</div>
		
<?php include 'footer.php'; ?>
<?php include 'includes/scripts.php'; ?>

</body>
</html>