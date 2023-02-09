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
				<form action="" method="post" enctype="multipart/form-data">	
                  <div class="d-flex flex-column align-items-center text-center">
                   <input type="file" class="form-control" name="profile_pic" id="profile_pic">
                    <div class="mt-3">
                      <h4><?php echo $row['usersUid']; ?></h4>
                    </div> 
					<button type="submit" style="background-color: transparent"><i class="bi bi-save"></i></button>
					<a type="button" href="profile.php"><i class="bi bi-backspace"></i></a>
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
                    <div class="col-sm-9-profile text-secondary"><?php echo $row['usersName']; ?></div>
                  </div>
                  <div style="height:10px;"></div>
                  <div class="row-profile">
                    <div class="col-sm-3-profile">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9-profile text-secondary"><?php echo $row['usersEmail']; ?></div>
                  </div>
                  <div style="height:10px;"></div>
                  <div class="row-profile">
                    <div class="col-sm-3-profile">
                      <h6 class="mb-0">Mobile #</h6>
                    </div>
                    <div class="col-sm-9-profile text-secondary"><?php echo $row['mobile']; ?></div>
                  </div>
                  <div style="height:10px;"></div>
                  <div class="row-profile">
                    <div class="col-sm-3-profile">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9-profile text-secondary"><?php echo $row['address']; ?></div>
                  </div>

                  <div class="row-profile">
                    <div class="col-sm-12">
                      <a href="profile_edit.php?user=<?php echo $row['usersId']; ?>" class="btn btn-edit" >Edit</a>
                    </div>
                  </div>
				<!-- End of Card body div -->
                </div>
			  <!-- End of card mb-3 div -->	  
              </div>
			<!-- End of col-md-8 -->
            </div>
			<?php
					}
			}
			?>	
				
			<!-- php function for updating the profile -->
          	<?php
					if ($_SERVER['REQUEST_METHOD'] == 'POST'){


						$profilepic = $_FILES['profile_pic']['name'];
						$username= $_SESSION['useruid'];

						$sql = "UPDATE users SET image='$profilepic' WHERE usersId = '$user_id'";
						$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

						$img_extensions = array('image/jpg', 'image/jpeg', 'image/png', 'image/jfif');
						$validate_img_extension = in_array($image = $_FILES["profile_pic"]['type'], $img_extensions);

						if($validate_img_extension) {

							if($result)
							{	
								move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "admin/upload/users/$username/".$_FILES["profile_pic"]["name"]);
								echo "<script> alert('Your profile picture has been updated!') </script>,
					  				  <script> location.href='profile.php'; </script>";
							}
							else 
							{
								echo 'Error: '.mysqli_error($conn);
							}	
						}
						else {

							echo "Only PNG, JPG, JPEG and JFIF images are allowed";
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