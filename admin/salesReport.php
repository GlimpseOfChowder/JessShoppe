<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/topbar.php'; ?>

		   <title>Admin - Sales Report</title>
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
						<button name="filter" id="filterSales" class="btn btn-outline-info btn-sm" style="background: #dc377e; color: white;">Filter</button>
						<button id="reset" class="btn btn-outline-warning btn-sm">Reset</button>
						<a href="print.php" name="print" id="print" class="btn btn-outline-warning btn-sm">Print</a>
					</div>
					
					
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Sales Report</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="salesList" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th hidden>Sales ID</th>
											<th>Supplier</th>
											<th>Product Name</th>
											<th>Unit Cost</th>
											<th>Unit Price</th>
											<th>Quantity Sold</th>
											<th>Shipping Cost</th>
											<th>Total Amount</th>
											<th>Transaction Date</th>
                                        </tr>
                                    </thead>
									<tbody>
									<?php
											include 'includes/dbh.inc.php';
											
											$sql = "SELECT * FROM sales
											LEFT JOIN products ON sales.product_name = products.product_name
											LEFT JOIN supplies ON products.product_id = supplies.product_id ORDER BY sales_id DESC";
											$result = mysqli_query($conn, $sql);
											$unitCost = 0;
											$unitPrice = 0;
											$shipping = 0;
											$total = 0;
											while($row=mysqli_fetch_array($result)){
												
												$date = new DateTime($row['order_date']);
									?>
									<tr>
										<td hidden><?php echo $row['sales_id']; ?></td>
										<td><?php echo $row['supplier_name']; ?></td>
										<td><?php echo $row['product_name']; ?></td>
										<td><?php echo $row['cost']; ?></td>
										<td><?php echo $row['price']; ?></td>
										<td style="text-align: center"><?php echo $row['quantity']; ?></td>
										<td><?php echo $row['shipping']; ?></td>
										<td><?php echo $row['revenue']; ?></td>
										<td><?php echo $date->format('M d Y'); ?></td>
									</tr>
									<?php
											$unitCost += $row['cost'];	
											$unitPrice += $row['price'];
											$shipping += $row['shipping'];	
											$total+= $row['revenue'];	
											
											$profit = $total - $unitCost;	
											}
									?>
									</tbody>
										<tr>
											<td></td>
											<td></td>
											<td>Total Unit Cost: <?php echo $unitCost; ?></td>
											<td>Total Unit Price: <?php echo $unitPrice; ?></td>
											<td></td>
											<td>Total Shipping Cost: <?php echo $shipping; ?></td>
											<td>Grand Total: <?php echo $total; ?></td>
											<td>Profit: <?php echo $profit; ?></td>
										</tr>
                                </table>
                            </div>
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