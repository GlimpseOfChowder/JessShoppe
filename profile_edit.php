<?php include 'header.php'; ?>
<!-- ending div tag of container from header.php -->
			</div>
<!-- ending div tag of header from header.php -->
		</div>

<title>Edit Profile</title>

	<?php
			if(isset($_GET["user"])) {
				
				$user_id = $_GET['user'];
				
				$sql = "SELECT * FROM users WHERE usersId = $user_id";
			   	$result = mysqli_query($conn, $sql);
				
				while($row=mysqli_fetch_array($result)) {
				
	?>
	<div class = "content-wrapper">
		<div class="row container">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
				<!-- Form action to process updating of profile -->
				<form action="" method="post">	
                  <div class="d-flex flex-column align-items-center text-center">
				   <?php
							$username = $_SESSION['useruid'];
							if($row['image'] == ""){
								
								echo "<img class='img-profile 'src='admin/img/undraw_profile_1.svg'>";
							}
							else {
					?>			
                    <img src="admin/upload/users/<?php echo $username ?>/<?php echo $row['image'];?>" class="img-profile" width="100px;" height="100px">
					  <?php 
							} 
					  ?>
                    <div class="mt-3">
                      <h4><?php echo $row['usersUid']; ?></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row-profile">	
                    <div class="col-sm-3-profile">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9-profile text-secondary">
						<input type="text" class="form-control-modal" name="profile_name" id="profile_name" placeholder="Full Name" value="<?php echo $row['usersName']; ?>">
					</div>
                  </div>
                  <div style="height:10px;"></div>
                  <div class="row-profile">
                    <div class="col-sm-3-profile">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9-profile text-secondary">
						<input type="text" class="form-control-modal" name="profile_email" id="profile_email" placeholder="Email address" value="<?php echo $row['usersEmail']; ?>">
					</div>
                  </div>
                  <div style="height:10px;"></div>
                  <div class="row-profile">
                    <div class="col-sm-3-profile">
                      <h6 class="mb-0">Mobile #</h6>
                    </div>
                    <div class="col-sm-9-profile text-secondary">
						<input type="text" class="form-control-modal" name="profile_mobile" id="profile_mobile" placeholder="Mobile #" value="<?php echo $row['mobile']; ?>">
					</div>
                  </div>
                  <div style="height:10px;"></div>
                  <div class="row-profile">
                    <div class="col-sm-3-profile">
                      <h6 class="mb-0">Address 1</h6>
                    </div>
                    <div class="col-sm-9-profile text-secondary">
						<textarea class="form-control-modal" name="profile_address" id="profile_address" placeholder="Complete address" value="<?php echo $row['address']; ?>"></textarea>
					</div>
                  </div>
				  <div style="height:10px;"></div>
                  <div class="row-profile">
                    <div class="col-sm-3-profile">
                      <h6 class="mb-0">Address 2</h6>
                    </div>
                    <div class="col-sm-9-profile text-secondary">
						<textarea class="form-control-modal" name="ship_address" id="ship_address" placeholder="Address 2" value="<?php echo $row['ship_address']; ?>"></textarea>
					</div>
                  </div>
				  <div style="height:10px;"></div>
                  <div class="row-profile">
                    <div class="col-sm-3-profile">
                      <h6 class="mb-0">Address 3</h6>
                    </div>
                    <div class="col-sm-9-profile text-secondary">
						<textarea class="form-control-modal" name="bill_address" id="bill_address" placeholder="Address 3" value="<?php echo $row['bill_address']; ?>"></textarea>
					</div>
                  </div>	
				  <?php
							}
						}
				  ?>
                  <div class="row-profile">
                    <div class="col-sm-12">
					  <a type="button" class="btn btn-edit" style="background: gray; margin-right: 2px" href="profile.php">Close</a>	
                      <button type="submit" class="btn btn-edit" style="margin-left: 2px">Save</button>
                    </div>
                  </div>
				</form>	  
				<!-- End of Card body div -->
                </div>
			  <!-- End of card mb-3 div -->	  
              </div>
			<!-- End of col-md-8 -->
            </div>
	
			<!-- php function for updating the profile -->
          	<?php
					if ($_SERVER['REQUEST_METHOD'] == 'POST'){


						$username = $_POST["profile_name"];
						$email = $_POST["profile_email"];
						$mobile = $_POST["profile_mobile"];
						$address = $_POST["profile_address"];
						$ship_address = $_POST["ship_address"];
						$bill_address = $_POST["bill_address"];

						$sql = "UPDATE users SET usersName='$username', usersEmail='$email', mobile='$mobile', address='$address', ship_address='$ship_address', bill_address='$bill_address' WHERE usersId = $user_id";
						$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));


						if($result)
						{	
							echo "<script> alert('Your account information has been updated!') </script>, 
					  			  <script> location.href='profile.php'; </script>";
						}
						else 
						{
							echo 'Error: '.mysqli_error($conn);
						}	
					}
				?>

			<!-- End of row container div -->
			</div>
		<!-- End of Content-wrapper -->
        </div>

<?php include 'footer.php'; ?>
<?php include 'includes/scripts.php'; ?>

</body>
</html>