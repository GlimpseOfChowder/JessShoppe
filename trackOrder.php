<?php include 'header.php'; ?>
<!-- ending div tag of container from header.php -->
			</div>
<!-- ending div tag of header from header.php -->
		</div>
			
			<?php
					if(isset($_GET['checkout'])){
						if($_GET['checkout'] == "orderplaced"){
							
							echo "<script> alert('Order has been placed. Thank you for ordering!') </script>";
						}
					}
			?>

<title>Track My Orders</title>
	<?php
			if(isset($_SESSION["userid"])) {

				include 'includes/dbh.inc.php';

				$sql = "SELECT * FROM users WHERE usersId = '".$_SESSION['userid']."'";
			   	$result = mysqli_query($conn, $sql);

				while($row=mysqli_fetch_array($result)) {

	?>
	<div class = "content-wrapper" style="min-height: 70%;">
		<div class="row container">
            <div class="col-md-8" style="width: 100%;">
              <div class="card mb-3 transparent">
                <div class="card-body">
					<!-- Order Tracker -->
					<div class = "col-6 box box-solid transparent">
						<div class="box-header with-border">
							<h4 class="box-title"><i class="bi bi-calendar"></i><b> Track your order</b></h4>
						</div>
								<div class="table-responsive">
									<table class="table" id = "transactionRec" style="overflow: auto;">
									<thead  style="background: #f4acbd;">
										<th style="text-align: left">Order Date</th>
										<th style="text-align: center">Order#</th>
										<th style="text-align: center">Status</th>
										<th style="text-align: left">Details</th>
										<th style="text-align: center">Proof of Payment</th>
										<th></th>
									</thead>
									<tbody class="transparent" style="border-bottom: pink">
									<?php
										include 'includes/dbh.inc.php';

										$sql = "SELECT * FROM orders WHERE usersId = '".$_SESSION['userid']."'";
										$result = mysqli_query($conn, $sql);
										$count = 1;
										$count1 = 1;
										while($row=mysqli_fetch_array($result)){

											$date = new DateTime($row['order_date']);
									?>
									<tr style="background-color: transparent;">
										<td><?php echo $date->format('h:i a - M d Y '); ?></td>
										<td style="text-align: center"><?php echo $row['order_id']; ?></td>
										<td style="text-align: center"><span class="order_status"><?php echo $row['order_status']; ?></span></td>
										<td style="text-align: left">
											<p>Product Name: <?php echo $row['product_name']; ?></p>
											<p>Quantity: <?php echo $row['quantity']; ?></p>
											<p>Delivery Method: <?php echo $row['delivery']; ?></p>
											<p>Payment Method: <?php echo $row['payment']; ?></p>
											<p>Total Amount: <?php echo $row['total']; ?></p>
										</td>
										<td style="text-align: center">
											<?php 
													$username = $_SESSION['useruid'];
													if($row['proofImage'] == ""){
														
														echo "<img class='img'width='auto' src='admin/img/receipt.jpg'>";
													}
													else {
											?>
											<img src="admin/upload/users/<?php echo $username ?>/<?php echo $row['proofImage'];?>" class="img-proof"></td>
											<?php
													}
											?>
										<td style="text-align: center">
											<!-- Update Button -->
											<a href="#uploadProofPayment<?php echo $count; ?>" class="text-white uploadProof" <?php echo $row['order_id']; ?> data-toggle="modal"><button class='btn-edit btn-circle btn-sm' style="background: #f4acbd"><i class="bi bi-camera"></i></button></a>
											<!-- See full details button -->
											<a href="#seeFullDetails<?php echo $count1; ?>" class="text-white seeDetails" <?php echo $row['order_id']; ?> data-toggle="modal"><button class='btn-edit btn-circle btn-sm' style="background: #f4acbd"><i class="bi bi-card-list"></i></button></a>
										</td>
									</tr>
										<!-- Upload button modal -->
									<div class='modal fade' id='uploadProofPayment<?php echo $count; ?>' tabindex='-1' role='dialog' aria-hidden='true'>
										<div class='modal-dialog modal-dialog-centered' role='document'>
											<div class='modal-content'>
												<div class='modal-header'>
													<h5 class='modal-title'>Upload a proof of payment</h5>
													<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
														<span aria-hidden='true'>&times;</span>
													</button>
												</div>
												<div class='modal-body'>
													<form action="" method='POST' enctype="multipart/form-data">
														<div class="row">
															<div class="col-lg-10">
																<input type="hidden" class="form-control disabled" name="order_id" value="<?php echo $row['order_id']; ?>">
													
																<input type="file" class="form-control" style="padding-bottom: 35px" name="proof_payment" id="proof_payment">
															</div>
														</div>
														<div style="margin-bottom: 10px"></div>
														<div class="row">
															<div class="col-lg-10">
																<input type="text" class="form-control" name="reference" id="reference" placeholder="Enter reference #">
															</div>
														</div>
												</div>
												<div class='modal-footer'>
													<button type='button' class='btn btn-secondary' style="background: gray" data-dismiss='modal'>Close</button>
													<a href="trackOrder.php?id=<?php echo $row['order_id']; ?>">
													<button type='submit' name='upload_proof' class='btn btn-primary' style="background: #ed7b97">Save</button></a>
												</div>
													</form>
											</div>
										</div>
									</div>
										<!-- Order summary button modal -->
									<div class='modal fade' id='seeFullDetails<?php echo $count1; ?>' tabindex='-1' role='dialog' aria-hidden='true'>
										<div class='modal-dialog modal-dialog-centered' role='document'>
											<div class='modal-content'>
												<div class='modal-header'>
													<h5 class='modal-title'>Order# <?php echo $row['order_id'];?> Full Details</h5>
													<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
														<span aria-hidden='true'>&times;</span>
													</button>
												</div>
												<div class='modal-body'>
													<form action="" method='POST'>
														<div class="row row-order-modal" style="justify-content: center">
													<label class="label-order-modal" style="width: auto; font-size: 10px;">Product Name</label>
													<input type="text" class="form-control disabled" style="width: 65%; font-size: 12px; border: 1px solid #eaeaea" name="product_name" id="product_name" value="<?php echo $row['product_name']; ?>">
												</div>
												<div style="height:10px;"></div>
												<div class="row row-order-modal" style="margin-left: 2px; justify-content: center">
													<label class="label-order-modal" style="width: auto; font-size: 10px; ">Quantity</label>
													<input type="text" class="form-control disabled orderQty" name="quantity" id="quantity" value="<?php echo $row['quantity']; ?>">

													<label class="label-order-modal" style="width: auto; font-size: 10px;">Total Amount</label>
													<input type="text" class="form-control disabled" style="width: 21%; font-size: 12px; border: 1px solid #eaeaea; margin-right: 17px;" name="total" id="total" value="<?php echo $row['total']; ?>">
												</div>
												<div style="height:10px;"></div>
												<div class="row row-order-modal" style="justify-content: center;">
													<label class="label-order-modal deliveryLabel" >Delivery</label>
													<input type="text" class="form-control disabled deliveryInput" name="deliveryMethod" id="deliveryMethod" value="<?php echo $row['delivery']; ?>">

													<label class="label-order-modal paymentLabel">Payment </label>
													<input type="text" class="form-control disabled paymentInput" name="paymentMethod" id="paymentMethod" value="<?php echo $row['payment']; ?>">
												</div>
												<div style="height:10px;"></div>
												<div class="row row-order-modal" style="justify-content: center">
													<label class="label-order-modal" style="width: auto; font-size: 10px;">Order Status</label>
													<input type="text" class="form-control disabled" name="order_status" id="order_status" style="width: 65%; margin-left: 10px;" value="<?php echo $row['order_status']; ?>">
												</div>
												<div style="height:10px;"></div>
												<div class="row row-order-modal" style="justify-content: center">
													<label class="label-order-modal" style="width: auto; font-size: 10px;">Order Date</label>
														<input type="text" class="form-control disabled" style="width: 65%; font-size: 12px; border: 1px solid #eaeaea; margin-left: 20px" name="order_date" id="order_date" value="<?php echo $date->format('h:i a - M d Y '); ?>">
												</div>
												<div style="height:10px;"></div>
												</div>
												<div class='modal-footer'>
													<button type='button' class='btn btn-secondary' style="background: gray" data-dismiss='modal'>Close</button>
												</div>
													</form>
											</div>
										</div>
									</div>	
									<?php
									$count++;
									$count1++;
											}
									?>
									</tbody>
								</table>
								</div>
					</div>

				<!-- End of Card body div -->
                </div>
			  <!-- End of card mb-3 div -->
              </div>
			<!-- End of col-md-8 -->
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
			//uploading of proof of payment
			include 'includes/dbh.inc.php';

			if($_SERVER['REQUEST_METHOD'] == 'POST') {

				$orderId = $_POST['order_id'];
				$image = $_FILES["proof_payment"]['name'];
				$ref = $_POST['reference'];

				$username= $_SESSION['useruid'];
				$sql = "UPDATE orders SET proofImage='$image', reference='$ref' WHERE order_id = $orderId";
				$result = mysqli_query($conn, $sql);

				$img_extensions = array('image/jpg', 'image/jpeg', 'image/png', 'image/jfif');
				$validate_img_extension = in_array($image = $_FILES["proof_payment"]['type'], $img_extensions);

				if($validate_img_extension) {

					if(file_exists("../upload/".$_FILES['proof_payment']['name']))
					{
						$store = $_FILES["proof_payment"]["name"];
						echo "File $store already exists";
					}
					else 
					{	

						if($result) {

							move_uploaded_file($_FILES["proof_payment"]["tmp_name"], "admin/upload/users/$username/".$_FILES["proof_payment"]["name"]);
							echo "<script> alert('Proof of payment image has been added') </script>,
									 <meta http-equiv='refresh' content='0'>";
						}
						else {

							echo 'Error: '.mysqli_error($conn);
						}
					}

				}
				else {

					echo "<script> alert(Only PNG, JPG, JPEG and JFIF images are allowed) </script>";
				}
			}
		?>


<?php include 'footer.php'; ?>
<?php include 'includes/scripts.php'; ?>

</body>
</html>
