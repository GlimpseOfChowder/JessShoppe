<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/topbar.php'; ?>
	 
	    <title>Admin - Item Data</title>
		<?php
			if(isset($_SESSION["useruid"])) {
			
			$sql = "SELECT * FROM users WHERE usersId = '".$_SESSION['userid']."'";
			$result = mysqli_query($conn, $sql);
				
			while($row=mysqli_fetch_array($result)) {
				
				if($row["usertype"] == "admin"){
		?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
				
                    <!-- DataTable -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <a href="#addsupply" data-toggle="modal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add New Supply</a>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Item Data</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="productList" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th hidden>Supply ID</th>
											<th>Supplier Name</th>
											<th hidden>Product ID</th>
											<th>Product Name</th>
                                            <th>Stock</th>
                                            <th>Cost</th>
                                            <th></th>
                                        </tr>
                                    </thead>
									<tbody>
									<?php
										include 'includes/dbh.inc.php';
										
										$sql = "SELECT * from supplies";
										$result = mysqli_query($conn, $sql);
										
										while($row=mysqli_fetch_array($result)){
																			
									?>
									<tr>
										<td hidden><?php echo $row['supply_id']; ?></td>
										<td><?php echo $row['supplier_name']; ?></td>
										<td hidden><?php echo $row['product_id']; ?></td>
										<td><?php echo $row['product_name']; ?></td>
										<td><?php echo $row['inventory']; ?></td>
										<td><?php echo $row['cost']; ?></td>
										<td style="text-align: center">
										<!-- Edit Button -->
										<a href="#editsupply" class="text-white editsupply" value="<?php echo $row['supply_id']; ?>" data-toggle="modal"><button class='btn-edit btn-circle btn-sm'><i class="bi bi-pen"></i></button></a>
										<!--Delete Button
										<a href="#deletesupplymodal" class="text-white deletesupply" <?php echo $row['supply_id']; ?> data-toggle="modal"><button class='btn-block btn-circle btn-sm'><i class='fas fa-ban'></i></button></a>-->
										</td>
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
	<!-- Add New Modal-->
	<?php 
			$sql = "SELECT product_id FROM products WHERE product_id = (SELECT MAX(product_id) FROM products)";
			$result = mysqli_query($conn, $sql);
		
			while($row=mysqli_fetch_array($result)){
	?>
    <div class="modal fade" id="addsupply" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class='modal-header'>
					<h5 class='modal-title'>Add new supply</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="includes/add_supply.php">
					<div class="row row-order-modal">
							<label class="label-order-modal">Supplier</label>
							<select name="supplier_name" style="width: 35%">
								<option disabled selected hidden>Supplier Name</option>
								<option value="Ktown">Ktown</option>
								<option value="YGSelect">YGSelect</option>
							</select> 
							<div style="margin-left: 9px"></div>
							<label class="label-order-modal">Product ID</label>
							<input type="text" class="form-control disabled" name="product_id" value="<?php echo $row['product_id'] + 1?>" style="width: 20%">
						  
					</div>
					<div style="height:10px;"></div>
					<div class="row row-order-modal" style="margin-right: 3px">
							<label class="label-order-modal">Product Name</label>
							<input type="text" class="form-control" name="product_name" style="width: 78%">
					</div>
					<div style="height:10px;"></div>
					<div class="row row-order-modal" style="margin-left: 5px">
							<label class="label-order-modal">In-stock</label>
							<input type="text" class="form-control" name="inventory" style="width: 30%">
							<div style="margin-left: 10px"></div>
							<label class="label-order-modal">Item Cost</label>
							<input type="text" class="form-control" name="cost" style="width: 30%">
					</div>
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="addsupply" class="btn btn-primary">Add</a>
				</form>
                </div>
            </div>
        </div>
    </div>
	<?php 
			} 
	?>
	<!-- Edit Modal -->							
	<div class='modal fade' id='editsupply' tabindex='-1' role='dialog' aria-hidden='true'>
		<div class='modal-dialog modal-dialog-centered' role='document'>
			<div class='modal-content'>
				<div class='modal-header'>
					<h5 class='modal-title'>Edit supply details</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
				<div class='modal-body'>
					<form action="includes/edit_supply.php" method='POST'>
						<input type="hidden" name="update_supply_id" id="update_supply_id">
						<div class="row row-order-modal">	
							<label class="label-order-modal">Supplier</label>
							<select name="supplier_name" id="supplier_name" style="width: 33%">
								<option disabled selected hidden>Supplier Name</option>
								<option value="Ktown">Ktown</option>
								<option value="YGSelect">YGSelect</option>
							</select>	  
							<div style="margin-left: 10px"></div>
							<label class="label-order-modal">Product ID</label>
							<input type="text" class="form-control disabled" name="product_id" id="product_id" style="width: 20%">
						</div>
						<div style="height:10px;"></div>
						<div class="row row-order-modal">
							<label class="label-order-modal">Product Name</label>
							<input type="text" class="form-control" name="product_name" id="product_name" style="width: 70%; margin-right: 30px">
						</div>	
						<div style="height:10px;"></div>
						<div class="row row-order-modal" style="margin-right: 6px">	
							<label class="label-order-modal">Current Stock</label>
							<input type="text" class="form-control disabled" name="inventory" id="inventory" style="width: 20%">
							<div style="margin-left:10px"></div>
							<label class="label-order-modal">+</label>
							<input type="number" class="form-control number" name="addStock" id="addStock" style="width: 20%">
							<div style="margin-left:5px"></div>
							<button type="button" class="btn btn-primary" onClick="addNewStock()">Add Stock</button>
						</div>
						<div style="height:10px;"></div>
						<div class="row row-order-modal">
								<label class="label-order-modal">Item Cost</label>
								<input type="text" class="form-control" name="cost" id="cost" placeholder="Cost" style="width: 70%">
						</div>
					</div>		
					<div class='modal-footer'>
						<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
						<a href="edit_supply.php?id=<?php echo $row['supply_id']; ?>">	
						<button type='submit' name='editsupply' class='btn btn-primary'>Save</button></a>
					</div>
						</form>
				</div>
			</div>
		</div>
	  <!-- Delete Modal -->
	  <div class="modal fade" id="deletesupplymodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove supply</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="includes/delete_supply.php" method="POST">
                    <div class="modal-body">Do you want to remove this supply?</div>
                        <input type="hidden" name="delete_supply_id" id="delete_supply_id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<a href="delete_supply.php?id=<?php echo $row['supply_id']; ?>">
                        <button type="submit" name="deletesupply" class="btn btn-primary">Remove</button></a>
                    </div>
				</form>
            </div>
        </div>
    </div>
	

<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>



</body>
</html>