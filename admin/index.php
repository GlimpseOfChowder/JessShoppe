<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/topbar.php'; ?>

    <title>Admin - Dashboard</title>
	<?php
			if(isset($_SESSION["useruid"])) {
			
			$sql = "SELECT * FROM users WHERE usersId = '".$_SESSION['userid']."'";
			$result = mysqli_query($conn, $sql);
			$counter = 0;	
			while($row=mysqli_fetch_array($result)) {
				
				if($row["usertype"] == "admin"){
		?>	
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                    </div>

                    <!-- Content Row -->
                    <div class="row">
						
                        <!-- Total Verified Users Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
							<a href="index.php?users=active">
                            <div class="card border-left-info shadow h-100 py-2 feature-box-1">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><p>Shop's Active Members</p>
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
													<h5>	
													<?php
														include 'includes/dbh.inc.php';
											
														$sql = "SELECT * FROM users WHERE status = 'verified'";
														$result = mysqli_query($conn, $sql);
														$rows_count_value = mysqli_num_rows($result);
														
														echo $rows_count_value -1;
													?>
													</h5>	
													</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
							</a>
                        </div>	
						
						<!-- Pending Orders -->
                        <div class="col-xl-3 col-md-6 mb-4">
							<a href="index.php?orders=pending">
                            <div class="card border-left-primary shadow h-100 py-2 feature-box-1">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <p>Pending Orders</p></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
												<h5>
												<?php
													include 'includes/dbh.inc.php';

													$sql = "SELECT * FROM orders WHERE order_status = 'pending'";
													$result = mysqli_query($conn, $sql);
													$pending = mysqli_num_rows($result);

														echo $pending;
												
												?>
												</h5>	
											</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
							</a>	
                        </div>

                        <!-- Bogus Buyer Users -->
                        <div class="col-xl-3 col-md-6 mb-4">
							<a href="index.php?users=bogus">
                            <div class="card border-left-success shadow h-100 py-2 feature-box-1">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <p>List of Bogus Buyers</p></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
												<h5>
												<?php
														include 'includes/dbh.inc.php';

														$sql = "SELECT * FROM users WHERE status = 'bogusBuyer'";
														$result = mysqli_query($conn, $sql);
														$bogus = mysqli_num_rows($result);

														   echo $bogus;
												?>
												</h5>
											</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-person-x-fill" style="color: #dddfeb; font-size: 30px"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
							</a>	
                        </div>
		

                        <!-- Pending Unverified Users -->
                        <div class="col-xl-3 col-md-6 mb-4">
							<a href="index.php?users=pending">
                            <div class="card border-left-warning shadow h-100 py-2 feature-box-1">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                <p>Pending Users to be verified</p></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
												<h5>
												<?php
														include 'includes/dbh.inc.php';

														$sql = "SELECT * FROM users WHERE status = 'pending'";
														$result = mysqli_query($conn, $sql);
														$pending = mysqli_num_rows($result);

														   echo $pending;
												?>
												</h5>
											</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						</a>	
                    </div>	
					
					<?php
							//for pending users
							if(isset($_GET['users'])){
								
								if($_GET['users'] == "pending"){

					?>
					<div class='card shadow mb-4'>
						<div class='card-header py-3'>
							<h6 class='m-0 font-weight-bold text-primary text-warning'>Pending Users</h6>
						</div>
						<div class='card-body'>
							<div class='table-responsive'>
								<table class='table table-bordered' id='userAccounts' width='100%' cellspacing='0'>
									<thead>
										<tr>
											<th hidden>ID</th>
											<th>Full Name</th>
											<th>Username</th>
											<th>Email</th>
											<th>Identification</th>
											<th>Status</th>
											<th></th>
										</tr>
										</thead>
										<tbody>
										<?php
											include 'includes/dbh.inc.php';

											$sql = "SELECT * FROM users WHERE status = 'pending'";
											$result = mysqli_query($conn, $sql);
											while($row=mysqli_fetch_array($result)){

											if($row["usertype"] == "user") {
										?>   
										<tr>
											<td hidden><?php echo $row['usersId']; ?></td>
											<td><?php echo $row['usersName']; ?></td>
											<td><?php echo $username = $row['usersUid']; ?></td>
											<td><?php echo $row['usersEmail']; ?></td>
											<td>
											<?php
													if($row['verifyImage'] == ""){

														echo "<img class='img' width='100px' height='100px' src='img/id.jpg'>";
													}
													else {
											?>		
												<a href="#viewModal" onclick="search<?php echo $counter ?>('<?php echo $row['usersId']; ?>')" <?php echo $row['usersId']; ?> data-toggle="modal"><img src="upload/users/<?php echo $username ?>/<?php echo $row['verifyImage'];?>" class="image" width="100px" height="100px"></a>
											<?php 
													}
											?>
											</td>
											<td><?php echo $row['status']; ?></td>
											<script>
												//script for fetching image modal
												var imageLink
												function search<?php echo $counter;?>(vals) {
												  $.ajax({
												  url : 'idsearch.php',
												  data : {'vals' : vals},
												  dataType : 'JSON',
												  type : 'POST',
												  cache : false,	  	
												  success : function(result) {
													imageLink = "upload/users/<?php echo $username ?>/"+result;
													document.getElementById('verifyIMG').src = imageLink;
												  },

												  error: function(xhr, status, error) {
													imageLink = "upload/users/<?php echo $username ?>/"+xhr.responseText;
													document.getElementById('verifyIMG').src = imageLink;

												  }
												  });
												}
											</script>
											<td style="text-align: center">
											<!--Verify Button -->
											<a href="#verifyModal" class="text-white verify" <?php echo $row['usersId']; ?> data-toggle="modal"><button class='btn-check btn-circle btn-sm'><i class="bi bi-check-circle"></i></button></a>
										</tr>
										<?php
              								$counter++;
													}
												}
										?>		
										</tbody>
									</table>   
								</div>	   
							</div>
						</div>
						<!-- Verify Modal -->							
						<div class='modal fade' id='verifyModal' tabindex='-1' role='dialog' aria-hidden='true'>
							<div class='modal-dialog modal-dialog-centered' role='document'>
								<div class='modal-content'>
									<div class='modal-header'>
										<h5 class='modal-title'>Verify user:</h5>
										<input type='text' name='email' id='email' class='custom-form-control' disabled>
										<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
											<span aria-hidden='true'>&times;</span>
										</button>
									</div>
								<div class='modal-body'>
									<form action="includes/verify1.php" method='POST'>
										<div class='form-group'>
											<p>Click 'verified' status if you want to verify this user.</p>	
											<input type='hidden' name='update_id' id='update_id'>	
											<select name="status" id="status">
												<option disabled selected hidden>status</option>
												<option value="verified">Verified</option>
												<option value="bogusBuyer">Bogus Buyer</option>
											</select>
										</div>
								</div>		
								<div class='modal-footer'>
										<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
										<a href="verify.php?id=<?php echo $row['usersId']; ?>">
											<button type='submit' name='verify' class='btn btn-primary'>Verify</button></a>
									</form>
								</div>
								</div>
							</div>
						</div>

						<!--ID viewing-->
						<div class='modal fade' id='viewModal' tabindex='-1' role='dialog' aria-hidden='true'>
							<div class='modal-dialog modal-dialog-centered' role='document'>
								<div class='modal-content'>
									<div class='modal-header'>
										<h5 class='modal-title'>View ID:</h5>
										<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
											<span aria-hidden='true'>&times;</span>
										</button>
									</div>
									<div class='modal-body'>
											<img src="" id="verifyIMG" class="image" width="100%" height="100%">
									</div>
								</div>
							</div>
						</div>
						<?php
							//end of pending user php tag		
									}
								}
						?>
					
						<?php
							//for pendig orders
							if(isset($_GET['orders'])){
								
								if($_GET['orders'] == "pending"){
											

						?>
						<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pending Orders</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="orderList" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
											<th>Proof of Payment</th>
											<th>Customer Name</th>
											<th hidden>Email</th>
											<th hidden>User ID</th>
											<th hidden>Mobile#</th>
											<th hidden>Shipping</th>
											<th>Product Name</th>
											<th>Quantity</th>
                                            <th>Total Amount</th>
											<th hidden>Address</th>
                                            <th>Status</th>
											<th hidden>Delivery</th>
											<th hidden>Payment</th>
											<th>Order Date</th>
											<th hidden>Reference#</th>
                                            <th></th>
                                        </tr>
                                    </thead>
									<tbody>
									<?php
											include 'includes/dbh.inc.php';
											$sql = "SELECT * FROM orders LEFT JOIN users ON orders.usersId = users.usersId WHERE order_status = 'pending'";
											$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
											$counter1 = 1;
											while($row=mysqli_fetch_array($result)){
												
												$date = new DateTime($row['order_date']);
									?>
									<tr>
										<td><?php echo $row['order_id']; ?></td>
										<td>
										<?php
														if($row['proofImage'] == ""){
								
													echo "<img class='img' width='100px' height='100px' src='img/receipt.jpg'>";
												}
												else {
										?>	
											<a href="#viewModal" onclick="search<?php echo $counter ?>('<?php echo $row['usersId']; ?>')" <?php echo $row['usersId']; ?> data-toggle="modal"><img src="upload/users/<?php echo $row['usersUid'];?>/<?php echo $row['proofImage'];?>" class="image" width="100px" height="100px"></a>
										<?php
												}
										?>
										</td>
										<script>
											//script for fetching image modal
											var proofimage
											function search<?php echo $counter;?>(vals) {
											  $.ajax({
											  url : 'proofsearch.php',
											  data : {'vals' : vals},
											  dataType : 'JSON',
											  type : 'POST',
											  cache : false,

											  success : function(result) {
												proofimage = "upload/users/<?php echo $row['usersUid'];?>/"+result;
												document.getElementById('proof').src = proofimage;
											  },

											  error: function(xhr, status, error) {
												proofimage = "upload/users/<?php echo $row['usersUid'];?>/"+xhr.responseText;
												document.getElementById('proof').src = proofimage;

											  }
											  });
											}
										</script>
										<td><?php echo $row['usersName']; ?><br><br></td>
										<td hidden><?php echo $row['usersEmail'];?></td>
										<td hidden><?php echo $row['usersId']; ?></td>
										<td hidden><?php echo $row['mobile']; ?></td>
										<td hidden><?php echo $row['shipping']; ?></td>
										<td><?php echo $row['product_name']; ?></td>
										<td><?php echo $row['quantity']; ?></td>
										<td><?php echo $row['total']; ?></td>
										<td hidden><?php echo $row['address']; ?></td>
										<td><?php echo $row['order_status']; ?></td>
										<td hidden><?php echo $row['delivery']; ?></td>
										<td hidden><?php echo $row['payment']; ?></td>
										<td><?php echo $date->format('h:i a - M d Y '); ?></td>
										<td hidden><?php echo $row['reference'];?></td>
										<td style="text-align: center">
										<!-- Check User / Update Button -->
										<a href="#checkUserModal" class="text-white checkUser" data-toggle="modal"><button class='btn-edit btn-circle btn-sm'><i class="bi bi-pen"></i></button></a>
										
										<!-- Cancel Order Button -->
										<a href="#cancelOrders" class="text-white cancelOrders" <?php echo $row['order_id']; ?> data-toggle="modal"><button class='btn-block btn-circle btn-sm' style="background: gray; padding-top: 6px;"><i class="bi bi-x-circle"></i></button></a>
										</td>
									</tr>
									<?php
											$counter++;
											}
									?>
									</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
					<!-- Check User Modal -->
				<?php
						include 'includes/dbh.inc.php';
						$sql = "SELECT * FROM orders LEFT JOIN users ON orders.usersId = users.usersId";
						$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

						while($row=mysqli_fetch_array($result)){

							$date = new DateTime($row['order_date']);
				?>
				<div class='modal fade' id='checkUserModal' tabindex='-1' role='dialog' aria-hidden='true'>
					<div class='modal-dialog modal-dialog-centered' role='document'>
						<div class='modal-content'>
							<form action="includes/update_orders1.php" method='POST'>
							<div class='modal-header'>
								<h5 class='modal-title'>user:</h5>
														
								<input type="hidden" name="update_order_id" id="update_order_id">
								<input type='text' name='email' id='email' class='custom-form-control' disabled>
								<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
								</button>
							</div>
							<div class='modal-body'>
									<div class="row row-order-modal" style="margin-left: 10px">
										<label class="label-order-modal">Full Name</label>
										<input type="text" class="form-control disabled" style="width: 70%; font-size: 12px; border: 1px solid #eaeaea" name="userName" id="userName">
										<input type="hidden" name="usersId" id="usersId">
									</div>
									<div style="height:10px;"></div>
									<div class="row row-order-modal">
										<label class="label-order-modal">Product Name</label>
										<input type="text" class="form-control disabled" style="width: 67%; font-size: 12px; border: 1px solid #eaeaea" name="product_name" id="product_name">
									</div>
									<div style="height:10px;"></div>
									<div class="row row-order-modal" style="margin-left: 2px">
										<label class="label-order-modal">Quantity</label>
										<input type="text" class="form-control disabled" style="width: 20%; font-size: 12px; border: 1px solid #eaeaea" name="quantity" id="quantity">

										<div style="margin-left:30px;"></div>

										<label class="label-order-modal">Total Amount</label>
										<input type="text" class="form-control disabled" style="width: 22%; font-size: 12px; border: 1px solid #eaeaea" name="total" id="total" >
									</div>
									<div style="height:10px;"></div>
									<div class="row row-order-modal" style="padding-left: 20px;">
										<label class="label-order-modal">Shipping</label>
										<input type="text" class="form-control disabled" style="width: 25%; font-size: 12px; border: 1px solid #eaeaea" name="deliveryMethod" id="deliveryMethod">

										<div style="margin-left:10px;"></div>

										<label class="label-order-modal">Payment </label>
										<input type="text" class="form-control disabled" name="paymentMethod" id="paymentMethod" style="width: 30%; font-size: 12px; border: 1px solid #eaeaea">

									</div>
									<div style="height:10px;"></div>
									<div class="row row-order-modal">
										<label class="label-order-modal">Order Status</label>
										<select name="order_status" id="order_status" style="width: 70%; font-size: 12px; border: 1px solid #eaeaea">
											<option disabled selected hidden>Order Status</option>
											<option value="preparing items">preparing items</option>
											<option value="package in-transit">package in-transit</option>
											<option value="arrived in the Philippines">arrived in the Philippines</option>
											<option value="packing of the items">packing of the items</option>
											<option value="order shipped out">order shipped out</option>
										</select>
									</div>
									<div style="height:10px;"></div>
									<div class="row row-order-modal">
										<label class="label-order-modal">Order Date</label>
											<input type="text" class="form-control disabled" style="width: 69%; font-size: 12px; border: 1px solid #eaeaea" name="order_date" id="order_date">
									</div>
									<div style="height:10px;"></div>
									<div class="row row-order-modal" style="margin-left: 2px;">
										<label class="label-order-modal">Address</label>
											<textarea class="form-control disabled" style="width: 70%; font-size: 12px; border: 1px solid #eaeaea" name="address" id="address" value=""></textarea>
									</div>
									<div style="height:10px;"></div>
									<div class="row row-order-modal">
										<label class="label-order-modal">Mobile No.</label>
											<input type="text" class="form-control disabled" style="width: 70%; font-size: 12px; border: 1px solid #eaeaea" name="mobile" id="mobile">
									</div>
									<div style="height:10px;"></div>
									<div class="row row-order-modal">
										<label class="label-order-modal">Reference#</label>
											<input type="text" class="form-control disabled" style="width: 69%; font-size: 12px; border: 1px solid #eaeaea" name="reference" id="reference">
									</div>
									<input type="hidden" name="shipping" id="shipping">
									<input type="hidden" name="revenue">
							</div>		
							<div class='modal-footer'>	
								<a href="paid_order.php?id=<?php echo $row['order_id']; ?>">	
								<button type='submit' name='paid_order' class='btn btn-primary' style="margin-right: 188px; background: green">Mark as Paid</button></a>

								<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
								<a href="update_order.php?id=<?php echo $row['order_id']; ?>">	
								<button type='submit' name='update_orders' class='btn btn-primary'>Update</button></a>
							</div>
								</form>
						</div>
					</div>
				</div>
				<?php 	
					}
				?>
							
				<!-- See proof of payment photo -->
				<div class='modal fade' id='viewModal' tabindex='-1' role='dialog' aria-hidden='true'>
					<div class='modal-dialog modal-dialog-centered' role='document'>
						<div class='modal-content'>
							<div class='modal-header'>
								<h5 class='modal-title'>Proof of payment:</h5>
								<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
								</button>
							</div>
							<div class='modal-body'>
									<img src="" id="proof" class="image" width="100%" height="100%">
							</div>
						</div>
					</div>
				</div>

				  <!-- Cancel Order Modal -->
					<?php
							include 'includes/dbh.inc.php';
							$sql = "SELECT * FROM orders LEFT JOIN users ON orders.usersId = users.usersId";
							$result = mysqli_query($conn, $sql);

							while($row=mysqli_fetch_array($result)){

					?>
				  <div class="modal fade" id="cancelOrders" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">user: </h5>
								<input type='text' name='email' id='email' class='custom-form-control' value="<?php echo $row['usersEmail']; ?>" disabled>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="includes/delete_orders.php" method="POST">
								<div class="modal-body row-order-modal">Do you want to cancel this user's order?</div>
									<div class="row row-order-modal">
										<label class="label-order-modal">Order ID</label>
											<input type="text" name="cancel_order_id" id="cancel_order_id" class="disabled" style="font-size: 12px; border: 1px solid #eaeaea">
									</div>
								<div style="height:10px;"></div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
									<a href="cancel_order.php?id=<?php echo $row['order_id']; ?>">
									<button type="submit" name="cancel_orders" class="btn btn-primary">Cancel Order</button></a>
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php
						}
				?>
				<?php 
					//end of pending order php tag			
							}
						}
				?>
					
				<?php
						//for bogus users
						if(isset($_GET['users'])){
								
							if($_GET['users'] == "bogus"){

				?>	
				<div class="card shadow mb-4">
					   <div class="card-header py-3">
						   <h6 class="m-0 font-weight-bold text-primary text-success">List of Bogus Buyers</h6>
					   </div>
					   <div class="card-body">
						   <div class="table-responsive">
							   <table class="table table-bordered" id="userAccounts" width="100%" cellspacing="0">
								   <thead>
									   <tr>
										   <th hidden>ID</th>
										   <th>Full Name</th>
										   <th>Username</th>
										   <th>Email</th>
										   <th>Identification</th>
										   <th>Status</th>
										   <th></th>
									   </tr>
								   </thead>
								   <tbody>
									<?php
										include 'includes/dbh.inc.php';

										$sql = "SELECT * FROM users WHERE status = 'bogusBuyer'";
										$result = mysqli_query($conn, $sql);
										while($row=mysqli_fetch_array($result)){

										if($row["usertype"] == "user") {
									?>
									<tr>
										<td hidden><?php echo $row['usersId']; ?></td>
										<td><?php echo $row['usersName']; ?></td>
										<td><?php echo $username = $row['usersUid']; ?></td>
										<td><?php echo $row['usersEmail']; ?></td>
										<td>
										<?php
												if($row['verifyImage'] == ""){

													echo "<img class='img' width='100px' height='100px' src='img/id.jpg'>";
												}
												else {
										?>		
											<a href="#viewModal" onclick="search<?php echo $counter ?>('<?php echo $row['usersId']; ?>')" <?php echo $row['usersId']; ?> data-toggle="modal"><img src="upload/users/<?php echo $username ?>/<?php echo $row['verifyImage'];?>" class="image" width="100px" height="100px"></a>
										<?php 
												}
										?>
										</td>
										<td><?php echo $row['status']; ?></td>
										<script>
											//script for fetching image modal
											var imageLink
											function search<?php echo $counter;?>(vals) {
											  $.ajax({
											  url : 'idsearch.php',
											  data : {'vals' : vals},
											  dataType : 'JSON',
											  type : 'POST',
											  cache : false,	  	
											  success : function(result) {
												imageLink = "upload/users/<?php echo $username ?>/"+result;
												document.getElementById('verifyIMG').src = imageLink;
											  },

											  error: function(xhr, status, error) {
												imageLink = "upload/users/<?php echo $username ?>/"+xhr.responseText;
												document.getElementById('verifyIMG').src = imageLink;

											  }
											  });
											}
										</script>
										<td style="text-align: center">
										<!--Verify Button -->
										<a href="#verifyModal" class="text-white verify" <?php echo $row['usersId']; ?> data-toggle="modal"><button class='btn-check btn-circle btn-sm'><i class="bi bi-check-circle"></i></button></a>
									</tr>
									<?php
										$counter++;
											}
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
					<!-- Verify Modal -->							
					<div class='modal fade' id='verifyModal' tabindex='-1' role='dialog' aria-hidden='true'>
						<div class='modal-dialog modal-dialog-centered' role='document'>
							<div class='modal-content'>
								<div class='modal-header'>
									<h5 class='modal-title'>Verify user:</h5>
									<input type='text' name='email' id='email' class='custom-form-control' disabled>
									<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
										<span aria-hidden='true'>&times;</span>
									</button>
								</div>
							<div class='modal-body'>
								<form action="includes/verify.php" method='POST'>
									<div class='form-group'>
										<p>Click 'verified' status if you want to verify this user.</p>	
										<input type='hidden' name='update_id' id='update_id'>	
										<select name="status" id="status">
											<option disabled selected hidden>status</option>
											<option value="verified">Verified</option>
											<option value="bogusBuyer">Bogus Buyer</option>
										</select>
									</div>
							</div>		
							<div class='modal-footer'>
									<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
									<a href="verify.php?id=<?php echo $row['usersId']; ?>">
										<button type='submit' name='verify' class='btn btn-primary'>Verify</button></a>
								</form>
							</div>
							</div>
						</div>
					</div>

					<!--ID viewing-->
					<div class='modal fade' id='viewModal' tabindex='-1' role='dialog' aria-hidden='true'>
						<div class='modal-dialog modal-dialog-centered' role='document'>
							<div class='modal-content'>
								<div class='modal-header'>
									<h5 class='modal-title'>View ID:</h5>
									<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
										<span aria-hidden='true'>&times;</span>
									</button>
								</div>
								<div class='modal-body'>
										<img src="" id="verifyIMG" class="image" width="100%" height="100%">
								</div>
							</div>
						</div>
					</div>	
				<?php 
						//end of bogus users php tag	
							}
						}
				?>
					
				<?php
							//for active users
							if(isset($_GET['users'])){
								
								if($_GET['users'] == "active"){

				?>	
				<div class="card shadow mb-4">
				   <div class="card-header py-3">
					   <h6 class="m-0 font-weight-bold text-primary text-info">Active Members</h6>
				   </div>
				   <div class="card-body">
					   <div class="table-responsive">
						   <table class="table table-bordered" id="userAccounts" width="100%" cellspacing="0">
							   <thead>
								   <tr>
									   <th hidden>ID</th>
									   <th>Full Name</th>
									   <th>Username</th>
									   <th>Email</th>
									   <th>Identification</th>
									   <th>Status</th>
									   <th></th>
								   </tr>
							   </thead>
							   <tbody>
								<?php
									include 'includes/dbh.inc.php';

									$sql = "SELECT * FROM users WHERE status = 'verified'";
									$result = mysqli_query($conn, $sql);
									while($row=mysqli_fetch_array($result)){

									if($row["usertype"] == "user") {
								?>
								<tr>
									<td hidden><?php echo $row['usersId']; ?></td>
									<td><?php echo $row['usersName']; ?></td>
									<td><?php echo $username = $row['usersUid']; ?></td>
									<td><?php echo $row['usersEmail']; ?></td>
									<td>
									<?php
											if($row['verifyImage'] == ""){

												echo "<img class='img' width='100px' height='100px' src='img/id.jpg'>";
											}
											else {
									?>		
										<a href="#viewModal" onclick="search<?php echo $counter ?>('<?php echo $row['usersId']; ?>')" <?php echo $row['usersId']; ?> data-toggle="modal"><img src="upload/users/<?php echo $username ?>/<?php echo $row['verifyImage'];?>" class="image" width="100px" height="100px"></a>
									<?php 
											}
									?>
									</td>
									<td><?php echo $row['status']; ?></td>
									<script>
										//script for fetching image modal
										var imageLink
										function search<?php echo $counter;?>(vals) {
										  $.ajax({
										  url : 'idsearch.php',
										  data : {'vals' : vals},
										  dataType : 'JSON',
										  type : 'POST',
										  cache : false,	  	
										  success : function(result) {
											imageLink = "upload/users/<?php echo $username ?>/"+result;
											document.getElementById('verifyIMG').src = imageLink;
										  },

										  error: function(xhr, status, error) {
											imageLink = "upload/users/<?php echo $username ?>/"+xhr.responseText;
											document.getElementById('verifyIMG').src = imageLink;

										  }
										  });
										}
									</script>
									<td style="text-align: center">
									<!--Verify Button -->
									<a href="#verifyModal" class="text-white verify" <?php echo $row['usersId']; ?> data-toggle="modal"><button class='btn-check btn-circle btn-sm'><i class="bi bi-check-circle"></i></button></a>
								</tr>
								<?php
									$counter++;
										}
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>	
					
	<!-- Verify Modal -->							
	<div class='modal fade' id='verifyModal' tabindex='-1' role='dialog' aria-hidden='true'>
		<div class='modal-dialog modal-dialog-centered' role='document'>
			<div class='modal-content'>
				<div class='modal-header'>
					<h5 class='modal-title'>Verify user:</h5>
					<input type='text' name='email' id='email' class='custom-form-control' disabled>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
			<div class='modal-body'>
				<form action="includes/verify.php" method='POST'>
					<div class='form-group'>
						<p>Click 'verified' status if you want to verify this user.</p>	
						<input type='hidden' name='update_id' id='update_id'>	
						<select name="status" id="status">
							<option disabled selected hidden>status</option>
							<option value="verified">Verified</option>
							<option value="bogusBuyer">Bogus Buyer</option>
						</select>
					</div>
			</div>		
			<div class='modal-footer'>
					<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
					<a href="verify.php?id=<?php echo $row['usersId']; ?>">
						<button type='submit' name='verify' class='btn btn-primary'>Verify</button></a>
				</form>
			</div>
			</div>
		</div>
	</div>

	<!--ID viewing-->
	<div class='modal fade' id='viewModal' tabindex='-1' role='dialog' aria-hidden='true'>
		<div class='modal-dialog modal-dialog-centered' role='document'>
			<div class='modal-content'>
				<div class='modal-header'>
					<h5 class='modal-title'>View ID:</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
				<div class='modal-body'>
						<img src="" id="verifyIMG" class="image" width="100%" height="100%">
				</div>
			</div>
		</div>
	</div>		
			<?php
							}
						}
			?>
					
				<!-- /.container-fluid -->
                </div>
			<!-- End of Main Content from topbar.php -->
            </div>
			<?php			
						}
					}
				}
				else {
			?>	
				<!-- For unwelcome visitors -->			
				<div class = "content-wrapper">
					<div class = "container box-body" style="padding-top: 200px; padding-left: 400px">
						<div class="container-fluid">
							<!-- 404 Error Text -->
							<div class="text-center">
								<div class="error mx-auto" data-text="404">404</div>
								<p class="lead text-gray-800 mb-5">Page Not Found</p>
								<p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
								<a href="../index.php" style="color: #f5a6b9">&larr; Back to Homepage</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
					}
			?>
			
<?php include 'includes/scripts.php'; ?>
<?php include 'includes/footer.php'; ?>

</body>
</html>