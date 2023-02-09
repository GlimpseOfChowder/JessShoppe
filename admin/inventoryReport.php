<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/topbar.php'; ?>

		   <title>Admin - Inventory Report</title>
			<?php
				if(isset($_SESSION["useruid"])) {

				$sql = "SELECT * FROM users WHERE usersId = '".$_SESSION['userid']."'";
				$result = mysqli_query($conn, $sql);

				while($row=mysqli_fetch_array($result)) {

					if($row["usertype"] == "admin"){
			?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
					
				<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text bg-info text-white"><i class="fas fa-calendar-alt"></i></span>
								</div>
								<input type="text" class="form-control" id="start_date" placeholder="Start Date" readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text bg-info text-white"><i class="fas fa-calendar-alt"></i></span>
								</div>
								<input type="text" class="form-control" id="end_date" placeholder="End Date" readonly>
							</div>
						</div>
					</div>
					<div style="margin-bottom: 10px">
						<button name="filter" id="filterInventory" class="btn btn-outline-info btn-sm" style="background: #dc377e; color: white;">Filter</button>
						<button id="reset" class="btn btn-outline-warning btn-sm">Reset</button>
						<a href="print1.php" id="print" class="btn btn-outline-warning btn-sm">Print</a>
					</div>
					
					
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Inventory Report</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="inventoryList" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th hidden>Inventory ID</th>
											<th>Supplier</th>
											<th>Product Name</th>
											<th style="text-align: center">Beginning Quantity</th><!-- quantity sold + current stock -->
											<th>Unit Cost</th>
											<th style="text-align: center">Quantity Sold</th>
											<th style="text-align: center">Ending Balance</th><!-- beginning qty - qty sold = ending balance -->
											<th>Total Amount</th>
											<th style="text-align: center">Stock Valuation</th> <!-- qty sold * selling price -->
											<th>Transaction Date</th>
                                        </tr>
                                    </thead>
									<tbody>
									<?php
											include 'includes/dbh.inc.php';
											
											$sql = "SELECT * FROM inventoryreport
											LEFT JOIN products ON inventoryreport.product_name = products.product_name
											LEFT JOIN supplies ON products.product_id = supplies.product_id ORDER BY inv_id DESC";
											$result = mysqli_query($conn, $sql);
											
											while($row=mysqli_fetch_array($result)){
												
												$beginQty = $row['quantity'] + $row['inventory'];
												$endingBalance = $beginQty - $row['quantity'];
												$stockValuation = $row['quantity'] * $row['price'];
												
												$date = new DateTime($row['order_date']);
									?>
									<tr>
										<td hidden><?php echo $row['inv_id']; ?></td>
										<td><?php echo $row['supplier_name']; ?></td>
										<td><?php echo $row['product_name']; ?></td>
										<td style="text-align: center"><?php echo $beginQty; ?></td>
										<td><?php echo $row['cost']; ?></td>
										<td style="text-align: center"><?php echo $row['quantity']; ?></td>
										<td style="text-align: center"><?php echo $endingBalance; ?></td>
										<td><?php echo $row['revenue']; ?></td>
										<td style="text-align: center"><?php echo $stockValuation; ?></td>
										<td><?php echo $date->format('M d Y'); ?></td>
									</tr>
									<?php		
											}
									?>
									</tbody>
                                </table>
                            </div>
                        </div>
                    </div>

				<!-- End of container-fluid -->
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
			
			
			
<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>


</body>

</html>