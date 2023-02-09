<?php include 'header.php'; ?>
<!-- ending div tag of container from header.php -->
			</div>
<!-- ending div tag of header from header.php -->
		</div>

<title>Verify Profile</title>

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
				<form action="" method="post" enctype="multipart/form-data">	
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
                      <h6 class="mb-0" style="font-family: inherit"><p>Upload a picture of any of the following: <br><br>student ID,<br> license, <br>government IDs, <br>national ID</p></h6>
                    </div>
                    <div class="col-sm-9-profile text-secondary">
						<input type="file" class="form-control" name="verificationImage" id="verificationImage">
					</div>
                  </div>
                  <div style="height:10px;"></div>
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


						$verifyImage = $_FILES["verificationImage"]['name'];
						$username= $_SESSION['useruid'];
						$sql = "UPDATE users SET verifyImage='$verifyImage' WHERE usersId = $user_id";
						$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

						$img_extensions = array('image/jpg', 'image/jpeg', 'image/png', 'image/jfif');
						$validate_img_extension = in_array($image = $_FILES["verificationImage"]['type'], $img_extensions);

						if($validate_img_extension) {

							if($result)
							{	
								move_uploaded_file($_FILES["verificationImage"]["tmp_name"], "admin/upload/users/$username/".$_FILES["verificationImage"]["name"]);
								
								echo "<script> alert('Your ID has been submitted!') </script>,
					  				  <script> location.href='profile.php'; </script>";
							}
							else 
							{
								echo 'Error: '.mysqli_error($conn);
							}	
						}
						else {

							echo "<script> alert(Only PNG, JPG, JPEG and JFIF images are allowed)</script>";
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