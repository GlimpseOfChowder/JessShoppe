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
								Forgot Password
							</div>					
							<form method="post" action="includes/reset-request.inc.php" style="padding-left: 45px">
								<label><strong>Enter Your Email Address:</strong></label><br><br>
								<input type="email" name="email" placeholder="username@email.com"/>
								<button type="submit" name="reset-request-submit" class="btn btn-primary" style="padding-bottom: 6px">Receive New Password</button>
							</form>
							<?php
								if(isset($_GET['reset'])){
									
									if($_GET['reset'] == "success"){
										
										echo "<script> alert('Check your email!')</script>";
									}
								}	
								else if(isset($_GET['newpwd'])){
									
									if($_GET['newpwd'] == "passwordupdated"){
										
										echo "<script> alert('Your password has been reset!')</script>";
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