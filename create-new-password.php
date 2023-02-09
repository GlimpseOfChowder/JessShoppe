<?php include 'header.php'; ?>

	<title>Forgot Password?</title>
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
						<div class = "form-container" style="height: 250px">
						<div class = "form-btn" style="font-weight: bold; color: #555">
								Reset Password
						</div>		
						<?php
							require 'includes/reset-password.inc.php';
							//getting tokens
							$selector = $_GET["selector"];
							$validator = $_GET["validator"];
							
							if(empty($selector) || empty($validator)) {
								
								echo "Could not validate your request!";
							}
							else {
								
								if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
						?>	
							<form action="includes/reset-password.inc.php" method="post">
								<input type="hidden" name="selector" value="<?php echo $selector; ?>">
								<input type="hidden" name="validator" value="<?php echo $validator; ?>">
								<input type="password" name="pwd" placeholder="Enter your new password">
								<input type="password" name="pwd-repeat" placeholder="Repeat your new password">
								<button type="submit" name="reset-password-submit" class="btn btn-primary">Reset Password</button>
							</form>
						<?php	
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