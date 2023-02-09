<?php include 'header.php';?>
<!-- ending div tag of container from header.php-->
				</div>
<!-- ending div tag of header from header.php-->
		</div>

<title>About Us</title>

	<section class="section services-section" id="services">
		<div class="container">
			<div style="height:20px;"></div>
			<div class="row">
				<!-- PRIVACY -->
				<div class="col-sm-6 col-lg-4">
					<a href ="#privacyModal" data-toggle="modal">
					<div class="feature-box-1">
						<div class="icon">
							<i class="bi bi-shield-lock"></i>
						</div>
						<div class="feature-content">
							<h5>Privacy</h5>
						</div>
					</div>
					</a>
				</div>

				<!-- TERMS AND CONDITIONS -->
				<div class="col-sm-6 col-lg-4">
					<a href ="#tacmodal" data-toggle="modal">
					<div class="feature-box-1">
						<div class="icon">
							<i class="bi bi-journal-text"></i>
						</div>
						<div class="feature-content">
							<h5>Terms and conditions</h5>
						</div>
					</div>
					</a>
				</div>

				<!-- DATA POLICY -->
				<div class="col-sm-6 col-lg-4">
					<a href ="#datapolicyModal" data-toggle="modal">
					<div class="feature-box-1">
						<div class="icon">
							<i class="bi bi-lock-fill"></i>
						</div>
						<div class="feature-content">
							<h5>Data policy</h5>
						</div>
					</div>
					</a>
				</div>
			<div style="height:50px;"></div>
			</div>
		</div>
	</section>
	
	<!-- Privacy Modal -->
	<div class="modal fade" id="privacyModal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content" style="background: radial-gradient(white, #f5a6b9);">
			  <div class="modal-header">
				<h5 class="modal-title" style="color: black">Privacy</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<ul class = "modal-custom">
				<?php
					include 'includes/dbh.inc.php';

					$sql = "SELECT privacy FROM shop_info";
					$result = mysqli_query($conn, $sql);

					while($row=mysqli_fetch_array($result)){
				?>
				<li><?php echo $row['privacy']; ?></li>
				<br>
				<?php
					}
				?>
				</ul>
			  </div>
		  </div>
		</div>
	  </div>

		<!-- Terms and Conditions Modal -->
		<div class="modal fade" id="tacmodal" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content" style="background: radial-gradient(white, #f5a6b9);">
				  <div class="modal-header">
					<h5 class="modal-title" style="color: black">Terms and Conditions</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<ul class = "modal-custom">
					<?php
						include 'includes/dbh.inc.php';

						$sql = "SELECT terms_conditions FROM shop_info";
						$result = mysqli_query($conn, $sql);

						while($row=mysqli_fetch_array($result)){
					?>
					<li><?php echo $row['terms_conditions']; ?></li>
					<br>
					<?php
						}
					?>
					</ul>
				  </div>
			  </div>
			</div>
		  </div>
	
		<!-- Privacy Modal -->
		<div class="modal fade" id="datapolicyModal" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content" style="background: radial-gradient(white, #f5a6b9);">
				  <div class="modal-header">
					<h5 class="modal-title" style="color: black">Privacy</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<ul class = "modal-custom">
					<?php
						include 'includes/dbh.inc.php';

						$sql = "SELECT data_policy FROM shop_info";
						$result = mysqli_query($conn, $sql);

						while($row=mysqli_fetch_array($result)){
					?>
					<li><?php echo $row['data_policy']; ?></li>
					<br>
					<?php
						}
					?>
					</ul>
				  </div>
			  </div>
			</div>
		  </div>


<?php include 'footer.php';?>

</body>
</html>