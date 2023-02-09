<?php include 'header.php'; ?>
<!-- ending div tag of container from header.php -->
			</div>
<!-- ending div tag of header from header.php -->
		</div>

<title>My Profile</title>
	<?php
			if(isset($_SESSION["userid"])) {
				
				include 'includes/dbh.inc.php';
				
				$sql = "SELECT * FROM users WHERE usersId = '".$_SESSION['userid']."'";
			   	$result = mysqli_query($conn, $sql);
				
				while($row=mysqli_fetch_array($result)) {
				
	?>
	<div class = "content-wrapper">
		<div class="row container">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
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
					  <a href="profilepic_edit.php?user=<?php echo $row['usersId']; ?>"><i class="bi bi-images"></i></a>   
                    <div>
                      <h4><?php echo $row['usersUid']; ?></h4>
                     <!-- <a href="#" style="font-size: 7px">Change Password?</a>-->
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
                    <div class="col-sm-9-profile text-secondary">
						<?php 
								if($row['mobile'] == ""){
									
									echo "<p style='font-size: 10px;padding-top: 3px; color: gray'>No data available yet.</p>";
								}
								else {
									
									echo $row['mobile'];
								}
						?>
					</div>
                  </div>
                  <div style="height:10px;"></div>
                  <div class="row-profile">
                    <div class="col-sm-3-profile">
                      <h6 class="mb-0">Address 1</h6>
                    </div>
                    <div class="col-sm-9-profile text-secondary">
						<?php 
								if($row['address'] == ""){
									
									echo "<p style='font-size: 10px;padding-top: 3px; color: gray'>No data available yet.</p>";
								}
								else {
									
									echo $row['address'];
								}
						?>
					</div>
                  </div>
				  <div style="height:10px;"></div>
                  <div class="row-profile">
                    <div class="col-sm-3-profile">
                      <h6 class="mb-0">Address 2</h6>
                    </div>
                    <div class="col-sm-9-profile text-secondary">
						<?php 	
								if($row['ship_address'] == ""){
									
									echo "<p style='font-size: 10px;padding-top: 3px; color: gray'>No data available yet.</p>";
								}
								else {
									echo $row['ship_address'];
								}
						?>
					</div>
                  </div>
				  <div style="height:10px;"></div>
                  <div class="row-profile">
                    <div class="col-sm-3-profile">
                      <h6 class="mb-0">Address 3</h6>
                    </div>
                    <div class="col-sm-9-profile text-secondary">
						<?php 
								if($row['bill_address'] == ""){
									
									echo "<p style='font-size: 10px;padding-top: 3px; color: gray'>No data available yet.</p>";
								}
								else {
									
									echo $row['bill_address'];
								}
						?>
					</div>
                  </div>	

                  <div class="row-profile">
                    <div class="col-sm-12">
                      <a href="profile_edit.php?user=<?php echo $row['usersId']; ?>" class="btn btn-edit" >Edit</a>
                    </div>
					<?php
							if($row['status'] == "pending" || $row['status'] == "bogusBuyer"){
					?>
					<div class="col-sm-12">
                      <a href="profile_verify.php?user=<?php echo $row['usersId']; ?>" class="btn btn-edit" >Verify your account</a>
                    </div>
					<?php
							}
					?>
                  </div>
				<!-- End of Card body div -->
                </div>
			  <!-- End of card mb-3 div -->	  
              </div>
			<!-- End of col-md-8 -->
            </div>
          
				<!-- Purchase History -->
				<div class = "col-6 box box-solid">
					<div class="box-header with-border">
						<h4 class="box-title"><i class="bi bi-calendar"></i><b> Purchase History</b></h4>
					</div>
						<div class="box-body  table-responsive">
							<table class="table table-bordered" id = "transactionRec">
								<thead>
									<th style="text-align: center">Transaction#</th>
									<th style="text-align: center">Amount</th>
									<th style="text-align: left">Full Details</th>
									<th></th>
								</thead>
								<tbody>
								<?php 
										include 'includes/dbh.inc.php';
										
										$sql = "SELECT * FROM purchase_history WHERE usersId = '".$_SESSION['userid']."'";
										$result = mysqli_query($conn, $sql);
										$count=1;
					
										while($row=mysqli_fetch_array($result)){
								?>
								<tr style="text-align: center">
									<td><?php echo $row['order_id']; ?></td>
									<td style="text-align: center"><?php echo $row['total']; ?></td>
									<td style="text-align: left">
										<p>Product Name: <?php echo $row['product_name']; ?></p>
										<p>Quantity: <?php echo $row['quantity']; ?></p>
										<p>Delivery Method: <?php echo $row['delivery']; ?></p>
										<p>Shipping Fee: <?php echo $row['shipping']; ?></p>
										<p>Payment Method: <?php echo $row['payment']; ?></p>
										<p>Order Status: <span style="color: #ba348b"><?php echo $row['order_status']; ?></span></p>
									</td>
									<td style="text-align: center">
										<!-- Feedback button -->
										<a href="#feedback<?php echo $count; ?>" class="text-white feedBack" <?php echo $row['product_id']; ?> data-toggle="modal"><button class='btn-block btn-circle btn-sm'><i class="bi bi-bookmark-star"></i></button></a>
									</td>	
								</tr>
									<!-- Feedback Modal -->
								 <div class="modal fade" id="feedback<?php echo $count; ?>" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" style="font-size: 18px">Leave a review</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="" method="POST" enctype="multipart/form-data">
												<div class="modal-body">
													<input type="text" class="form-control disabled" value="<?php echo $row['product_name']; ?>">
													<div style="height:10px;"></div>
													<input type="hidden" name="usersId" class="form-control" value="<?php echo $row['usersId']; ?>">
													<input type="hidden" name="product_id" class="form-control" value="<?php echo $row['product_id']; ?>">
													<textarea name="feedback" class="form-control" placeholder="Type a text"></textarea>
													<div style="height:10px;"></div>
													<input type="file" name="feedback_image" class="form-control">
												</div>
												<div style="height:10px;"></div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" style="background: gray" data-dismiss="modal">Back</button>
													<a href="product.php?id=<?php echo $row['product_id']; ?>">
													<button type="submit" name="post" class="btn btn-primary">Post</button></a>
												</div>
											</form>
										</div>
									</div>
								</div>	
								<?php
										$count++;
										}
								?>
								</tbody>
							</table>
						</div>
				</div>
			<!-- End of row container div -->
			</div>
		<!-- End of Content-wrapper -->
        </div>

		<?php 		
				}
			}
				else {
					include 'includes/404.php';
				}
		?>
	
		<?php
			include 'dbh.inc.php';

			if($_SERVER['REQUEST_METHOD'] == 'POST') {

				$image = $_FILES["feedback_image"]['name'];
				$user_id = $_POST['usersId'];
				$prod_id = $_POST['product_id'];
				$feedback = $_POST['feedback'];
				$username= $_SESSION['useruid'];

				$sql = "INSERT INTO feedback (usersId, product_id, feedback, feedback_image) VALUES ('$user_id', '$prod_id', '$feedback', '$image')";
				$result = mysqli_query($conn, $sql);

				$img_extensions = array('image/jpg', 'image/jpeg', 'image/png', 'image/jfif');
				$validate_img_extension = in_array($image = $_FILES["feedback_image"]['type'], $img_extensions);

				if($validate_img_extension) {

					if($result) {	

						move_uploaded_file($_FILES["feedback_image"]["tmp_name"], "admin/upload/users/$username/".$_FILES["feedback_image"]["name"]);
						echo "<script> alert('Your feedback has been submitted!') </script>,
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

		
<?php include 'footer.php'; ?>
<?php include 'includes/scripts.php'; ?>

</body>
</html>